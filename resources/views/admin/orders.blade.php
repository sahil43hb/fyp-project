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
                    <td>{{ $order->payment->payment_status }}</td>
                    <td>
                        <a href="{{ route('download.invoice', ['order_id' => $order->id]) }}"
                            class="btn bg-color text-white border-0">Invoice</a>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@endsection
@section('script')
@endsection
