<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::with('product')->whereIn('id', $request['carts'])->get();
        // $cartsData = $carts->toJson(); // Convert carts data to JSON
        // $redirectUrl = '/checkout?carts=' . urlencode($cartsData);
        return response()->json(['status' => 200, 'data' => $carts]);
    }
}
