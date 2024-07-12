<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', Auth::user()->id)->get();

        return view('cart', compact("carts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $existingCart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request['productId'])
            ->first();
        if ($existingCart) {
            // Check if increasing the quantity exceeds the available quantity in the products table
            $product = Product::find($request['productId']);
            if ($product && ($existingCart->quantity + $request['quantity']) <= $product->quantity) {
                // If quantity can be increased without exceeding available quantity
                $existingCart->quantity += $request['quantity'];
                $existingCart->save();
                $totalCarts = Cart::where('user_id', Auth::user()->id)->count();
                return response()->json(['status' => true, 'message' => 'Quantity updated successfully', 'totalCarts' => $totalCarts], 200);
            } else {
                // If increasing quantity exceeds available quantity, return an error response
                return response()->json(['status' => false, 'message' => 'Already added to cart.Quantity exceeds available stock!'], 200);
            }
        } else {
            // If the product is not in the cart, create a new cart item
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $request['productId'];
            $cart->quantity = $request['quantity'];
            if ($cart->save()) {
                $totalCarts = Cart::where('user_id', Auth::user()->id)->count();
                return response()->json(['status' => true, 'message' => 'Product added to cart succesfully!.', 'totalCarts' => $totalCarts], 200);
            } else {
                // Data saving failed, return an error response
                return response()->json(['status' => false, 'message' => 'Failed to cart the product'], 200);
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->quantity = $request['quantity'];
        if ($cart->update()) {
            return response()->json(['status' => true, 'message' => 'Data updated successfully'], 200);
        } else {
            // Data saving failed, return an error response
            return response()->json(['status' => false, 'message' => 'Failed to save data'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        // Find the cart item by ID
        $cartItem = Cart::find($id);

        // Check if the cart item exists
        if ($cartItem) {
            // Delete the cart item
            $cartItem->delete();
            return redirect()->back()->with('success', 'Cart item deleted successfully');
        } else {
            // Cart item not found
            return redirect()->back()->with('error', 'Cart item not found');
        }
    }
}
