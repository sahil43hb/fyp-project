@extends('admin.layouts.master')

@section('title')
AgileSole - Users
@endsection

@section('css')
@endsection

@section('content')
    @php
        // print $orders;
    @endphp
    <table id="order_table" class="display text-center">
        <thead>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Total</th>
                <th>Currency</th>
                <th>Payment</th>
                <th>Shipment</th>                
                <th>Invoice</th>                
            </tr>

        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $order->customer->fullname }}</td>
                <td>{{ $order->customer->email }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->payment->currency }}</td>
                <td>
                    <span class="badge bg-color text-white text-capitalize fs-6">
                        {{ $order->payment->payment_status }}
                    </span>
                </td>
                <td>
                    <div class="dropdown">
                        <a class="btn dropdown-toggle text-capitalize text-white border-0
                           @if ($order->shipment_status === 'pending') bg-primary
                           @elseif ($order->shipment_status === 'return') bg-danger
                           @elseif ($order->shipment_status === 'complete') bg-success
                           @else bg-secondary @endif"
                           href="#"
                           role="button"
                           id="dropdownMenuButton{{ $order->id }}"
                           data-bs-toggle="dropdown"
                           aria-expanded="false"
                           data-order-id="{{ $order->id }}">
                            {{ $order->shipment_status }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $order->id }}">
                            <li><a class="dropdown-item order-item" href="#" data-value="Pending">Pending</a></li>
                            <li><a class="dropdown-item order-item" href="#" data-value="Complete">Complete</a></li>
                            <li><a class="dropdown-item order-item" href="#" data-value="Return">Return</a></li>
                        </ul>
                    </div>
                </td>
                <td>
                    <a href="{{ route('download.invoice', ['order_id' => $order->id]) }}" 
                       class="btn bg-color text-white border-0">
                        Invoice
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('script')
@endsection
