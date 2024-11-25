@extends('layouts.master')
@section('title')
AgileSole - Cart
@endsection

@section('css')
@endsection

@section('content')

   {{-- Loading Screen --}}
   <div id="loading-overlay" style="display: none;">
      <div id="loading-spinner">
        <img src="img/AgileSoleLogoslider.png" alt="Loading..." />
        <h1>Loading ...</h1>
      </div>
    </div>
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
                                <th scope="col"></th>
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
                                                <p>{{ $cart->product->name }}</p>
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
                                                value="{{ $cart->quantity }}" title="Quantity:" class="input-text" readonly>
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
                                                <i class="fa-solid fa-trash cartDel"></i>
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
                            <tr><td colspan="6">
                                <h6 class="fw-bold">We recommend reviewing our <a href="#" class="border-0 cartDel fs-1" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a> before completing your purchase to ensure a smooth shopping experience.</h6>
                               </td></tr>
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
    <!-- The Modal -->
        <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p>
                            Welcome to our e-commerce website. By accessing or using our services, you agree to the following terms and conditions:
                        </p>
                        
                        <h6>1. Use of the Website</h6>
                        <p>
                            The content of the pages of this website is for your general information and use only. It is subject to change without notice.
                        </p>
        
                        <h6>2. Privacy Policy</h6>
                        <p>
                            We are committed to protecting your privacy. Please review our Privacy Policy for more information on how we handle your data.
                        </p>
        
                        <h6>3. Product Information</h6>
                        <p>
                            We make every effort to ensure that the information on this website is accurate and complete. However, we do not guarantee that the product descriptions or other content on this site are accurate, complete, reliable, current, or error-free.
                        </p>
        
                        <h6>4. Return Policy</h6>
                        <p>
                            If you wish to return a product, please contact our support team within 15 days of delivery. Please note that a 20% deduction will be applied to your refund.
                        </p>
        
                        <h6>5. Governing Law</h6>
                        <p>
                            These terms and conditions are governed by and construed in accordance with the laws of pakistan.
                        </p>
                    </div>
                    
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
    <!--================End Cart Area =================-->
@endsection
@section('script')
@endsection