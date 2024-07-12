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
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end" style="margin:16px">
                <div class="col-5">
                    <h1> {{ $brandsWithProducts->title }} Shop </h1>

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

                        @foreach ($brandsWithProducts->products as $product)
                            <div class="col-lg-3 col-md-6">
                                <div class="single-product">
                                    <img class="img-fluid" src="{{ asset('uploads/' . $product->product_image) }}"
                                        alt="product_image" />
                                    <div class="product-details">
                                        <h6>{{ $product->sku }}</h6>
                                        @if ($product->sale === '0')
                                            <div class="price">
                                                <h6>Size: {{ $product->size_no }}</h6>
                                                <h6>Rs. {{ $product->price }}</h6>
                                            </div>
                                        @else
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
                                        @endif
                                        <div class="prd-bottom">
                                            <a href="javascript:void(0)" class="social-info add-to-cart-btn"
                                                auth="{{ Auth::check() ? json_encode(Auth::user()) : 'null' }}"
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
                        {{-- <!-- single product -->
                        <div class="col-lg-3 col-md-4">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p2.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-3 col-md-4">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p3.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-3 col-md-4">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p4.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-3 col-md-4">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p5.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product -->
                        <div class="col-lg-3 col-md-4">
                            <div class="single-product">
                                <img class="img-fluid" src="img/product/p6.jpg" alt="">
                                <div class="product-details">
                                    <h6>addidas New Hammer sole
                                        for Sports person</h6>
                                    <div class="price">
                                        <h6>$150.00</h6>
                                        <h6 class="l-through">$210.00</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="" class="social-info">
                                            <span class="ti-bag"></span>
                                            <p class="hover-text">add to bag</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-heart"></span>
                                            <p class="hover-text">Wishlist</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-move"></span>
                                            <p class="hover-text">view more</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- start footer Area -->
@endsection
@section('script')
@endsection
