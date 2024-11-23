@extends('layouts.master')
@section('title')
    AgileSole-Brands
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
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        <!-- single product -->
                        @foreach ($brandsWithProducts->products as $product)
                            <div class="col-lg-3 col-md-6">
                                <div class="single-product shadow-sm product-image flex-fill card border shadow-hover">
                                    <img class="img-fluid custom-height" src="{{ asset('uploads/' . $product->product_image) }}"
                                        alt="product_image" />
                                    <div class="product-details px-3">
                                        <h6>{{ $product->name }}</h6>
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

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
       aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="">
                <button type="button" class="close align-self-end m-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="login_form_inner">
                    <a  href="{{ url('/') }}">
                        <img src="img/AgileSoleLogo.png" alt="" width="100px" class="pb-3">
                    </a>  
                    <h3>Log in</h3>
                    <form class="row login_form" method="post" id="loginForm">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" />
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="password" name="password"
                                placeholder="Password" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Password'" />
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">
                                Log In
                            </button>
                            <a  href="{{ url('/forget-password') }}">Forgot Password?</a>
                        </div>
                    </form>
                    <div class="d-flex row justify-content-center py-2"><span>Don't have a
                            account? </span><a class="theme-color"  href="{{ url('register') }}">
                            &nbsp;&nbsp;SignUp</a></div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <!-- start footer Area -->
@endsection
@section('script')
@endsection
