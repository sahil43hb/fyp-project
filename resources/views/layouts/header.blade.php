    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <a class="navbar-brand logo_h" href="{{ url('/') }}">
                        <img width="100px" height="70px"
                            style="border-radius:12px;" src="{{ asset('img/AgileSoleLogo.png') }}" alt="" />
                        </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Collection</a>
                                <ul class="dropdown-menu">
                                    @foreach (brandsData() as $brand)
                                        <li class="nav-item"><a class="nav-link"
                                                href="{{ url('brands/' . $brand->id) }}">{{ $brand->title }}</a></li>
                                    @endforeach

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('sale') }}">Sale</a>
                            </li>
                            @if (categoriesData()->isNotEmpty())
                                @foreach (categoriesData() as $category)
                                    <li class="nav-item submenu dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                            role="button" aria-haspopup="true"
                                            aria-expanded="false">{{ $category->title }}</a>
                                        <ul class="dropdown-menu">
                                            @foreach ($category->sub_categories as $subCategory)
                                                <li class="nav-item"><a class="nav-link"
                                                        href="{{ url('sub_categories/' . $subCategory->id) }}">{{ $subCategory->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            @endif

                            <li class="nav-item submenu dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false"><span class="ti-user"></span></a>
                                @if (Auth::check())
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="{{ url('profile') }}">Profile</a>
                                        </li>

                                        <li class="nav-item"><a class="nav-link" href="{{ url('orders') }}">Order
                                                History</a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="{{ url('logout') }}">Logout</a>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">Login</a>
                                        </li>
                                    </ul>
                                @endif
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item">
                                <a href="{{ url('cart') }}" class="add_to_cart_container">
                                    <span class="ti-bag" style="color:#44D62C"></span>
                                    @if (Auth::check())
                                        <sup class="add_to_cart" id="cartData">{{ cartData() }}</sup>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <button class="search">
                                    <span class="lnr lnr-magnifier" id="search" style="color:#44D62C"></span>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <input type="text" class="form-control" id="search_input"
                        placeholder="Search by name or price" />
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </div>
            </div>
        </div>
    </header>
