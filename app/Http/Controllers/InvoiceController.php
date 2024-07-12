<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use PDF;

class InvoiceController extends Controller
{
    public function invoice($id)
    {


        $order = Order::findOrFail($id);
        // Load the related order items and customer
        $order->load('orderItems.product', 'customer');

        // Pass the order data to the invoice view
        $invoiceData = [
            'order' => $order,
        ];
        $pdf = PDF::loadView('pdf.invoice', $invoiceData);
        return $pdf->stream($order->id . 'invoice.pdf');
    }
}
