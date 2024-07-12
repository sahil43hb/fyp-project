@extends('layouts.master')
@section('title')
    Footcase
@endsection

@section('css')
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-5">
                    <h1>Shopping Cart</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                                <tr data-cart-id="{{ $cart->id }}">
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </td>
                                    <td>

                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset('uploads/' . $cart->product->product_image) }}"
                                                    height="150" width="150" alt="">
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $cart->product->sku }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>Rs.
                                            {{ intVal($cart->product->price) - intVal($cart->product->price) * (intVal($cart->product->discount) / 100) }}
                                        </h5>
                                    </td>
                                    <td class="product" data-cart-id="{{ $cart->id }}">
                                        <div class="product_count product_qty"
                                            data-product-quantity="{{ $cart->product->quantity }}">
                                            <input type="text" name="qty" maxlength="12"
                                                value="{{ $cart->quantity }}" title="Quantity:" class="input-text">
                                            <button class="increase items-count" type="button"><i
                                                    class="lnr lnr-chevron-up"></i></button>
                                            <button class="reduced items-count" type="button"><i
                                                    class="lnr lnr-chevron-down"></i></button>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="price" data-cart-price="{{ intVal($cart->product->price) }}">
                                            Rs.{{ ($cart->product->discount
                                                ? intval($cart->product->price) - intval($cart->product->price) * (intval($cart->product->discount) / 100)
                                                : intval($cart->product->price)) * $cart->quantity }}
                                        </h5>
                                    </td>
                                    <td>
                                        <form action="{{ route('delete_cart', ['id' => $cart->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border:none">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            <tr class="bottom_button">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Subtotal</h5>
                                </td>
                                <td>
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

                                    <h5 id="totalSum">Rs.{{ $totalSum }}</h5>
                                </td>
                                <td></td>
                            </tr>
                            <tr class="out_button_area">
                                <td>
                                    <a class="gray_btn" href="{{ url('/') }}">Continue Shopping</a>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                    <form method="post" id="checkoutForm">
                                        @csrf
                                        <div class="checkout_btn_inner d-flex align-items-center justify-content-end">
                                            <button type="submit" class="primary-btn border-0">Proceed to checkout</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
@section('script')
@endsection



{{-- <tr class="shipping_area">
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                    <h5>Shipping</h5>
                                </td>
                                <td>
                                    <div class="shipping_box">
                                        <ul class="list">
                                            <li><a href="#">Flat Rate: $5.00</a></li>
                                            <li><a href="#">Free Shipping</a></li>
                                            <li><a href="#">Flat Rate: $10.00</a></li>
                                            <li class="active"><a href="#">Local Delivery: $2.00</a></li>
                                        </ul>
                                        <h6>Calculate Shipping <i class="fa fa-caret-down" aria-hidden="true"></i></h6>
                                        <select class="shipping_select">
                                            <option value="1">Bangladesh</option>
                                            <option value="2">India</option>
                                            <option value="4">Pakistan</option>
                                        </select>
                                        <select class="shipping_select">
                                            <option value="1">Select a State</option>
                                            <option value="2">Select a State</option>
                                            <option value="4">Select a State</option>
                                        </select>
                                        <input type="text" placeholder="Postcode/Zipcode">
                                        <a class="gray_btn" href="#">Update Details</a>
                                    </div>
                                </td>
                            </tr> --}}
