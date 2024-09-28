@extends('layouts.master')
@section('title')
AgileSole
@endsection

@section('css')
@endsection

@section('content')
    {{-- {{ print $carts }} --}}
    {{-- {{ print $response }} --}}
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-5">
                    <h1>Confirmation</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Order Details Area =================-->
    <section class="order_details section_gap">
        <div class="container">
            <h3 class="title_confirmation">Thank you {{ Auth::user()->name }}!. Your order has been confirmed.</h3>
            <div class="row order_d_inner">
                <div class="col-lg-5">
                    <div class="details_item">
                        <h4>Order Info</h4>
                        <ul class="list">
                            <li><a href="#"><span>Order number</span> : {{ $response->payment_intent }}</a></li>
                            <li><a href="#"><span>Total</span> : Rs. {{ $response->amount_total / 100 }}</a></li>
                            <li><a href="#"><span>Payment method</span> : Stripe</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="details_item">
                        <h4>Delivery Address</h4>
                        <ul class="list">
                            <li><a href="#"><span>Name</span> : {{ $response->customer_details->name }}</a>
                            </li>
                            <li><a href="#"><span>Email</span> : {{ $response->customer_details->email }}</a>
                            </li>
                            <li><a href="#"><span>Phone no</span> : {{ $response->customer_details->phone }}</a>
                            </li>
                            <li><a href="#"><span>Country</span> :
                                    {{ $response->customer_details->address->city }}</a></li>
                            <li><a href="#"><span>City</span> :
                                    {{ $response->customer_details->address->country }}</a>
                            </li>
                            <li><a href="#"><span>Address</span> :
                                    {{ $response->customer_details->address->line1 }}</a>
                            </li>

                            <li><a href="#"><span>Postcode </span> :
                                    {{ $response->customer_details->address->postal_code }}</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="order_details_table">
                <h2>Order Details</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr>
                                    <td>
                                        <p>{{ $cart->product->sku }}</p>
                                    </td>
                                    <td>
                                        <h5>x {{ $cart->quantity }}</h5>
                                    </td>
                                    <td>
                                        <p>Rs.
                                            {{ ($cart->product->discount
                                                ? intval($cart->product->price) - intval($cart->product->price) * (intval($cart->product->discount) / 100)
                                                : intval($cart->product->price)) * $cart->quantity }}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                @php
                                    $totalSum = 0; // Initialize total sum variable
                                @endphp

                                @foreach ($carts as $cart)
                                    @php
                                        $totalSum +=
                                            ($cart->product->discount
                                                ? intval($cart->product->price) -
                                                    intval($cart->product->price) *
                                                        (intval($cart->product->discount) / 100)
                                                : intval($cart->product->price)) * $cart->quantity; // Accumulate total sum
                                    @endphp
                                @endforeach
                                <td>
                                    <h4>Subtotal</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>Rs. {{ $totalSum }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Delivery</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>Rs. 0</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>Rs. {{ $totalSum }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end my-3 out_button_area">
                <a class="gray_btn" href="{{ url('/') }}">Continue Shopping</a>
            </div>

        </div>
    </section>
    <!--================End Order Details Area =================-->
@endsection
@section('script')
@endsection
