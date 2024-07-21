@extends('layouts.master')
@section('title')
    FootStep
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end" style="margin:16px">
                <div class="col-5">
                    <h1> Orders History </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <div class="container">

        @if ($orders->isNotEmpty())
            <table id="users_order" class="display text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $order->customer->fullname }}</td>
                            <td>{{ $order->customer->email }}</td>
                            <td>{{ $order->customer->phone_no }}</td>
                            <td>Rs. {{ $order->total }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('download.invoice', ['order_id' => $order->id]) }}"
                                    class="btn btn-primary bg-danger border-0">Invoice</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="d-flex justify-content-center">
                <p class="no-order-text">You haven't placed any order yet.</p>
            </div>
        @endif


    </div>
    <!-- start footer Area -->
@endsection
@section('script')
@endsection
