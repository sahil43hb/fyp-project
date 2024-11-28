@extends('layouts.master')
@section('title')
AgileSole
@endsection
@section('css')
@endsection

@section('content')
    <!-- start banner Area -->
    <section class="banner-area organic-breadcrumb1">
        <div class="container">
            <div class="row fullscreen align-items-center">
                <div class="col-lg-12">
                    <div class="{{ headerProductData()->count() !== 1 ? 'active-banner-slider' : '' }} owl-carousel">
                        <!-- single-slide -->   
                        @foreach (headerProductData() as $product)
                        <div class="row single-slide align-items-center d-flex"> 
                            <div class="fix-bordr col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1 >{{$product->name}}</h1>
                                    <p>
                                       {{$product->description}}
                                    </p>
                                </div>
                                <div class="card_area d-flex align-items-center pt-5 pl-2">
                                    @if ($product->quantity == 0)
                                        <button class="btn btn-success disabled-link" >Out of stock</button>
                                    @else
                                        <a href="{{ url('product-detail/' . $product->id) }}" class="btn-success btn bg-color"
                                        >View Detail</a>
                                    @endif
                                </div>
                            </div>
                            <div class="adjst-pic col-lg-7 justify-content-end d-flex" >
                                <div class="banner-img banner-set">
                                    <img class="img-fluid" src="{{ asset('uploads/' . $product->product_image) }}" alt="" />
                                </div>
                            </div>
                        </div>
                        @endforeach                     
                     
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section_gap">
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Latest Footwear</h1>
                            <p>AgileSole, From Sole to Soul, Be the King of Style!</p>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row" id="products-container">
                        <!-- Products will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="owl-carousel active-product-area">
        <!-- single product slide -->
        @foreach ($categoriesProduct as $category)
        @if ($category->active_status === '1')
              <div class="single-product-slider">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <div class="section-title">
                                <h1>{{ $category->title }} Footwear</h1>
                                <p>AgileSole, From Sole to Soul, Be the King of Style!</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- single product -->
                        @foreach ($category->products as $product)
                            <div class="col-lg-3 col-md-6 d-flex">
                                <div class="single-product card flex-fill product-image shadow-sm shadow-hover">
                                    <img class="img-fluid custom-height" src="{{ asset('uploads/' . $product->product_image) }}"
                                        alt="product_image" />
                                    <div class="product-details pl-2">
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
                                            <a href="javascript:void(0)" class="social-info add-to-cart-btn {{ $product->quantity === 0 ? 'disabled-link' : '' }}"
                                                auth="{{ Auth::check() ? json_encode(Auth::user()) : null }}"
                                                data-product-id="{{$product->quantity === 0   ? null : $product->id }}"
                                                >
                                                <span class="ti-bag"></span>
                                                <p class="hover-text" style="color:{{$product->quantity === 0  ? 'red' : 'black'}};">{{$product->quantity === 0 ? 'no in stock' : 'add to bag'}}</p>
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
                </div>
            </div> 
        @endif         
        @endforeach        
    </section>

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

    <section class="features-area section_gap">
        <div class="container">
            <div class="row features-inner">

                <!-- single features -->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('img/features/f-icon3.png') }}" alt="" />
                        </div>
                        <h6>24/7 Support</h6>
                        <p>We're here to help, anytime.</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="{{ asset('img/features/icon5.jpg') }}" alt=""  style="height: 30px;width:40px"/>
                        </div>
                        <h6>Free Delivery</h6>
                        <p>Free Shipping on all order</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="single-features" style="border-right:0px">
                        <div class="f-icon">
                            <img src="{{ asset('img/features/icon6.png') }}" alt="" style="height: 30px;width:40px" />
                        </div>
                        <h6>Secure Payment</h6>
                        <p>Safe and streamlined transactions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end product Area -->
    
    <!-- End brand Area -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('dashboard') }}",
                type: "GET",
                data: {
                    loadData: 'loadData'
                },
                success: function(response) {
                    console.log(response);
                    let productHtml = "";
                    
                    response.products.forEach((product) => {
                        let priceContent;
                        let notQuantity = product.quantity === 0 ? true : false ;
                        if (product.sale === "0") {
                            priceContent = `
                         <div class="price">
                          <h6>Size: ${product.size_no}</h6>
                          <h6>Price: ${product.price}</h6>
                          </div>
                    `;
                        } else {
                            priceContent = `
                <div class="price">
                  <h6>Size: ${product.size_no}</h6>
                  </div>
            <div class="price">
                <h6>Rs. ${
                    parseInt(product.price) - parseInt(product.price) * (parseInt(product.discount) / 100)
                }</h6>
                <h6 class="l-through"> Rs. ${parseInt(product.price)*(parseInt(product.discount) / 100)}</h6>
            </div>
        `;
                        }
                        productHtml += `
                <div class="col-lg-3 col-md-6 d-flex">
                    <div class="single-product  flex-fill card product-image shadow-sm shadow-hover">
                        <img class="img-fluid custom-height" src="uploads/${product.product_image}" alt="${product.product_image}" />
                        <div class="product-details pl-3">
                            <h6>${product.name}</h6>
                            ${priceContent}
                            <div class="prd-bottom">
                                <a href="javascript:void(0)" class="social-info add-to-cart ${notQuantity ? 'disabled-link' : ''}"
                                    ${notQuantity ? '' : `data-product-id=${product.id}`}>
                                    <span class="ti-bag"></span>
                                    <p class="hover-text" style="color:${notQuantity ? 'red' : 'black'};">
                                        ${notQuantity ? 'no in stock' : 'add to bag'}
                                    </p>
                                </a>
                                <a href="product-detail/${product.id}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">view more</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            `;
                    });

                    $("#products-container").html(productHtml);
                    // Attach event listeners
                    $(".add-to-cart").on("click", function() {
                        let authUser = response.user_status;
                        if (!authUser) {
                            $("#loginModal").modal("show");
                        } else {
                            if (authUser.email_verified_at) {
                                var productId = $(this).data("product-id");
                                const quantity = $("#sst").val();
                                const productQuantity = quantity ? quantity : 1;
                                $.ajax({
                                    url: "/add-to-cart",
                                    method: "POST",
                                    data: {
                                        productId: productId,
                                        quantity: productQuantity,
                                    },
                                    headers: {
                                        "X-CSRF-TOKEN": $(
                                            'meta[name="csrf-token"]'
                                        ).attr("content"),
                                    },
                                    success: function(response) {
                                        if (response.status) {
                                            toastr.success(response.message);
                                            $("#cartData").text(response
                                                .totalCarts);
                                            setTimeout(() => {
                                                window.location = "/cart";
                                            }, 2000);
                                        } else {
                                            toastr.error(response.message);
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(
                                            "Error adding product to cart:",
                                            error
                                        );
                                    },
                                });
                            } else {
                                alert(
                                    "Please verify your email before adding to cart."
                                );
                            }
                        }
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(error);
                },
            });
        });
    </script>
@endsection
