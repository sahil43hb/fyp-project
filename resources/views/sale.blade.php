@extends('layouts.master')
@section('title')
AgileSole
@endsection

@section('css')
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end" style="margin:16px">
                <div class="col-5">
                    <h1> Sale Collection </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <!-- Start Filter Bar -->
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        <!-- single product -->
                        @foreach ($products as $product)
                            <div class="col-lg-3 col-md-6">
                                <div class="single-product">
                                    <img class="img-fluid" src="{{ asset('uploads/' . $product->product_image) }}"
                                        alt="product_image" />
                                    <div class="product-details">
                                        <h6>{{ $product->sku }}</h6>
                                        <div class="price">
                                            <h6>Size: {{ $product->size_no }}</h6>
                                        </div>
                                        <div class="price">
                                            <h6>Rs.
                                                {{ intval($product->price) - intval($product->price) * (intval($product->discount) / 100) }}
                                            </h6>
                                            <h6 class="l-through">Rs.
                                                {{ intval($product->price) * (intval($product->discount) / 100) }}
                                            </h6>
                                        </div>
                                        <div class="prd-bottom">
                                            <a href="" class="social-info add-to-cart-btn"
                                                auth="{{ Auth::check() ? json_encode(Auth::user()) : null }}"
                                                data-product-id="{{ $product->id }}">
                                                <span class="ti-bag"></span>
                                                <p class="hover-text">add to bag</p>
                                            </a>
                                            <a href="{{ url('product-detail/' . $product->id) }}" class="social-info">
                                                <span class="lnr lnr-move"></span>
                                                <p class="hover-text">view more</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </section>
            </div>
        </div>
    </div>
    <!-- start footer Area -->
@endsection
@section('script')
@endsection
