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
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-5 ">
                    <h1>Product Details</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->


    <!--================Single Product Area =================-->
    <div class="product_image_area section_gap">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="single-prd-item">
                        <img src="{{ asset('uploads/' . $product->product_image) }}" height="450" width="450"
                            alt="">
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $product->sku }}</h3>
                        <h5>size: {{ $product->size_no }}</h5>
                        <h2>Rs.
                            {{ intVal($product->price) - intVal($product->price) * (intVal($product->discount) / 100) }}
                        </h2>
                        <ul class="list">
                            <li><a class="active"><span>Category</span> : {{ $product->category->title }}</a>
                            </li>
                            <li><a class="active"><span>Sub category</span> :
                                    {{ $product->sub_category->title }}</a>
                            </li>
                            <li><a class="active"><span>Brand</span> : {{ $product->brand->title }}</a>
                            </li>

                            <li><a><span>Availibility</span> :
                                    {{ $product->quantity > 0 ? 'In Stock' : 'Out of stock' }}</a></li>
                        </ul>
                        <p>{{ $product->description }}</p>
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <input type="text" name="qty" id="sst" maxlength="12" value="1"
                                title="Quantity:" class="input-text qty">
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; var maxQuantity = {{ $product->quantity }}; if( !isNaN( sst ) && sst < maxQuantity) result.value++; return false;"
                                class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                            <button
                                onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;"
                                class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                        </div>
                        <div class="card_area d-flex align-items-center">
                            @if ($product->quantity == 0)
                                <button class="primary-btn" disabled>Add to Cart</button>
                            @else
                                <a href="javascript:void(0)" class="primary-btn  add-to-cart-btn"
                                    auth="{{ Auth::check() ? json_encode(Auth::user()) : null }}"
                                    data-product-id="{{ $product->id }}">Add to Cart</a>
                            @endif
                        </div>
                    </div>
                </div>
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
                                <a href="">Forgot Password?</a>

                            </div>
                        </form>
                        <div class="d-flex row justify-content-center py-2"><span>Don't have a
                                account? </span><a href="">
                                &nbsp;&nbsp;SignUp</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- End brand Area -->
@endsection
@section('script')
@endsection
