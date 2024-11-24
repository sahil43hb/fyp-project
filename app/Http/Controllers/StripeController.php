<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CustomerInfo;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller
{
  public function index(Request $request)
  {
    $carts = Cart::with('product')->whereIn('id', $request['carts'])->get();
    $data = [];
    foreach ($carts as $cart) {

      $total_amount = 0;
      if ($cart->product->sale === '0') {
        $total_amount =  $cart->product->price * 100; // due to stripe
      } else {
        $total_amount =  ($cart->product->price  - $cart->product->price * ($cart->product->discount / 100)) * 100;
      };
      $data[] = [
        'price_data' => [
          'currency' => 'pkr',
          'product_data' => ['name' => $cart->product->name],
          'unit_amount' =>   $total_amount,
          'tax_behavior' => 'exclusive',
        ],
        'quantity' => $cart->quantity,
      ];
    }
    $stripe = new \Stripe\StripeClient(config('stripe.sk'));
    $response =  $stripe->checkout->sessions->create([
      'shipping_address_collection' => ['allowed_countries' => ['PK']],
      'shipping_options' => [
        [
          'shipping_rate_data' => [
            'type' => 'fixed_amount',
            'fixed_amount' => [
              'amount' => 0,
              'currency' => 'pkr',
            ],
            'display_name' => 'Free shipping',
            'delivery_estimate' => [
              'minimum' => [
                'unit' => 'business_day',
                'value' => 5,
              ],
              'maximum' => [
                'unit' => 'business_day',
                'value' => 7,
              ],
            ],
          ],
        ],
      ],
      'line_items' => [
        $data
      ],
      'phone_number_collection' => ['enabled' => true],
      'mode' => 'payment',
      'success_url' => url('/confirmation') . '?session_id={CHECKOUT_SESSION_ID}',
      'cancel_url' => url('/cart'),
    ]);
    if (isset($response->id) && $response->id != '') {
      session()->put('carts', $carts);
      return response()->json(['redirect_url' => $response->url]);
    } else {
      return response()->json(['error' => 'Failed to create session'], 500);
    }
  }


  public function confirmation(Request $request)


  {
    if (isset($request->session_id)) {
      $stripe = new \Stripe\StripeClient(config('stripe.sk'));
      $response = $stripe->checkout->sessions->retrieve($request->session_id);
      $payment = new Payment();
      $payment->amount = $response->amount_total / 100;
      $payment->currency = $response->currency;
      $payment->payment_status = $response->payment_status;
      $payment->payment_method = 'stripe';
      $payment->save();
      $customerInfo = new CustomerInfo();
      $customerInfo->user_id = Auth::user()->id;
      $customerInfo->fullname = $response->customer_details->name;
      $customerInfo->email =  $response->customer_details->email;
      $customerInfo->city =  $response->customer_details->address->city;
      $customerInfo->postal_code = $response->customer_details->address->postal_code;
      $customerInfo->phone_no = $response->customer_details->phone;
      $customerInfo->country = $response->customer_details->address->country;
      $customerInfo->address1 = $response->customer_details->address->line1;
      $customerInfo->suburb = $response->customer_details->address->line2;
      $customerInfo->save();
      $order = new Order();
      $order->customer_info_id   = $customerInfo->id;
      $order->payment_id = $payment->id;
      $order->total = $response->amount_total / 100;
      $order->user_id = Auth::user()->id;
      $order->save();
      $carts = session()->get('carts');
      if ($carts === null || !isset($carts)) {
        return redirect()->route('dashboard');
      }
      foreach ($carts as $cart) {
        $orderItems = new OrderItem();
        $orderItems->order_id = $order->id;
        $orderItems->quantity = $cart->quantity;
        $orderItems->product_id = $cart->product->id;
        $orderItems->save();
        $product = $cart->product;
        $product->quantity -= $cart->quantity;
        $product->save();

        if ($product->quantity < 3) {
          // Send an email to the user
          Mail::send('email.lowStock', ['product' => $product,], function ($message) use ($request) {
            $message->to('manansajjad7826@gmail.com');
            $message->subject('Low Stock Alert');
        });
      }

        $cart->delete();
      }
      session()->forget('carts');
      return view('confirmation', compact('response', 'carts'));
    }
  }

  public function cancel()
  {
  }
}
