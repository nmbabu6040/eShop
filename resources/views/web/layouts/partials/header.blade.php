@php
    $categories = App\Models\Category::with('subCategories')->latest('id')->get();
    $user = auth('web')?->user();

@endphp

<header id="header">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="contact-intro">
                        <span>A Marketplace Initiative by Themart Theme - save more with coupons</span>
                    </div>
                </div>
                <div class="col col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="contact-info">
                        <ul>
                            <li><a href="tel:869968236"><span>Need help? Call Us:</span>+869 968 236</a></li>
                            <li>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        English
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">English</a></li>
                                        <li><a class="dropdown-item" href="#">Bangla</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        USD
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <li><a class="dropdown-item" href="#">BDT</a></li>
                                        <li><a class="dropdown-item" href="#">USD</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end topbar -->
    <!--  start header-middle -->
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('root') }}"><img
                                src="{{ asset('web/assets/images/logo.svg') }}" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <form action="#" class="middle-box">
                        <div class="category">
                            <select name="service" class="form-control">
                                <option disabled="disabled" selected="">All Category</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category?->id }}">{{ $category?->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="search-box">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="What are you looking for?">
                                <button class="search-btn" type="submit"> <i class="fi flaticon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="middle-right">
                        <ul class="d-flex gap-1">
                            <li><a href="{{ route('compare') }}"><i
                                        class="fi flaticon-right-and-left"></i><span>Compare</span></a>
                            </li>
                            <li class="d-flex gap-2 align-items-center">
                                @if ($user)
                                    <div class="">
                                        <img src="{{ $user?->thumbnail }}" alt="" width="30"
                                            class="img-fluid"
                                            style="max-width: 30px; border-radius: 50%; object-fit: cover">
                                    </div>
                                    <span>{{ Str::limit($user?->name, 7) }}</span>
                                    <div class="dropdown-content">
                                        <a href="">Profile</a>
                                        <a href="{{ route('logout') }}">Logout</a>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}"><i
                                            class="fi flaticon-user-profile"></i><span>Login</span></a>
                                @endif
                            </li>
                            <li>
                                <div class="header-wishlist-form-wrapper">
                                    <button class="wishlist-toggle-btn"> <i class="fi flaticon-heart"></i>
                                        <span class="cart-count">3</span></button>
                                    <div class="mini-wislist-content">
                                        <button class="mini-cart-close"><i class="ti-close"></i></button>
                                        <div class="mini-cart-items">
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="{{ route('shop') }}"><img
                                                            src="{{ asset('web/assets/images/cart/img-1.jpg') }}"
                                                            alt></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="{{ route('shop') }}">Stylish Pink Coat</a>
                                                    <span class="mini-cart-item-price">$150</span>
                                                    <span class="mini-cart-item-quantity"><a href="#"><i
                                                                class="ti-close"></i></a></span>
                                                </div>
                                            </div>
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="{{ route('shop') }}"><img
                                                            src="{{ asset('web/assets/images/cart/img-2.jpg') }}"
                                                            alt></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="{{ route('shop') }}">Blue Bag</a>
                                                    <span class="mini-cart-item-price">$120</span>
                                                    <span class="mini-cart-item-quantity"><a href="#"><i
                                                                class="ti-close"></i></a></span>
                                                </div>
                                            </div>
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="{{ route('shop') }}"><img
                                                            src="{{ asset('web/assets/images/cart/img-3.jpg') }}"
                                                            alt></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="{{ route('shop') }}">Kids Blue Shoes</a>
                                                    <span class="mini-cart-item-price">$120</span>
                                                    <span class="mini-cart-item-quantity"><a href="#"><i
                                                                class="ti-close"></i></a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mini-cart-action clearfix">
                                            <div class="mini-btn">
                                                <a href="wishlist.html" class="view-cart-btn">View
                                                    Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="mini-cart">
                                    <button class="cart-toggle-btn"> <i class="fi flaticon-add-to-cart"></i>
                                        <span class="cart-count">2</span></button>
                                    <div class="mini-cart-content">
                                        <button class="mini-cart-close"><i class="ti-close"></i></button>
                                        <div class="mini-cart-items">
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="{{ route('shop') }}"><img
                                                            src="{{ asset('web/assets/images/cart/img-1.jpg') }}"
                                                            alt></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="{{ route('shop') }}">Stylish Pink Coat</a>
                                                    <span class="mini-cart-item-price">$150 x 1</span>
                                                    <span class="mini-cart-item-quantity"><a href="#"><i
                                                                class="ti-close"></i></a></span>
                                                </div>
                                            </div>
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="{{ route('shop') }}"><img
                                                            src="{{ asset('web/assets/images/cart/img-2.jpg') }}"
                                                            alt></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="{{ route('shop') }}">Blue Bag</a>
                                                    <span class="mini-cart-item-price">$120 x 2</span>
                                                    <span class="mini-cart-item-quantity"><a href="#"><i
                                                                class="ti-close"></i></a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mini-cart-action clearfix">
                                            <span class="mini-checkout-price">Subtotal:
                                                <span>$390</span></span>
                                            <div class="mini-btn">
                                                <a href="cart.html" class="view-cart-btn">View Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  end header-middle -->
    <div class="wpo-site-header">
        <nav class="navigation navbar navbar-expand-lg navbar-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 d-lg-none dl-block">
                        <div class="mobail-menu">
                            <button type="button" class="navbar-toggler open-btn">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar first-angle"></span>
                                <span class="icon-bar middle-angle"></span>
                                <span class="icon-bar last-angle"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-6 col-sm-5 col-6 d-block d-lg-none">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="{{ route('root') }}"><img
                                    src="{{ asset('web/assets/images/logo.svg') }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-3">
                        <div class="header-shop-item">
                            <button class="header-shop-toggle-btn"><span>Shop By Category</span> </button>
                            <div class="mini-shop-item">
                                <ul id="metis-menu">
                                    @foreach ($categories ?? [] as $category)
                                        <li class="header-catagory-item">

                                            @if ($category?->subCategories && count($category?->subCategories) > 0)
                                                <a class="menu-down-arrow" href="#">{{ $category->name }}</a>
                                                <ul class="header-catagory-single">
                                                    @foreach ($category?->subCategories as $subCategory)
                                                        <li><a href="#">{{ $subCategory?->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <a href="#">{{ $category?->name }}</a>
                                            @endif
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-1 col-1">
                        <div id="navbar" class="collapse navbar-collapse navigation-holder">
                            <button class="menu-close"><i class="ti-close"></i></button>
                            <ul class="nav navbar-nav mb-2 mb-lg-0">
                                <li class="menu-item-has-children">
                                    <a href="{{ route('root') }}">Home</a>
                                </li>
                                <li><a href="{{ route('about') }}">About</a></li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('shop') }}">Shop</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('faq') }}">FAQ</a>
                                </li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>

                        </div><!-- end of nav-collapse -->
                    </div>
                    <div class="col-lg-2 col-md-1 col-1">
                        <div class="header-right">
                            <a href="{{ route('recentlyView') }}" class="recent-btn"><i
                                    class="fi flaticon-refresh"></i>
                                <span>Recently Viewed</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- end of container -->
        </nav>
    </div>
</header>
