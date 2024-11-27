<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $orders =  Order::with('customer', 'payment')->get();
        return view('admin.orders', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function updateShipmentStatus(Request $request)
    {
        $validated = $request->validate([
            'shipment_status' => 'required', 
        ]);
        // Retrieve the order using the ID
        $order = Order::findOrFail($request->order_id); 
        if (!$order) {
            return response()->json([
                'status'=>false,
                'message' => 'Order not found!',
            ], 404);
        }
        // Update the shipment status
        $order->shipment_status = $request['shipment_status'];
        if ($order->save()) {
            // Data saved successfully, return a success response
            return response()->json(['status' => true, 'message' => 'Shipment status updated successfully!'], 200);
        } else {
            // Data saving failed, return an error response
            return response()->json(['status' => false, 'message' => 'Failed to update shipment status'], 500);
        }
    }
}
