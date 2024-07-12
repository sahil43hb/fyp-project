<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function ordersHistory()
    {
        $orders = Auth::user()->orders;
        return view('orders', compact('orders'));
    }
}
