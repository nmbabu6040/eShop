@extends('web.layouts.app')

@section('content')
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <h2 class="d-none">Hide</h2>
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="{{ route('root') }}">Home</a></li>
                            <li><a href="{{ route('shop') }}">Product</a></li>
                            <li>Wishlist</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- cart-area start -->
    <div class="cart-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-page-title">
                        <h2>Your Wishlist</h2>
                        <p>There are {{ count($wishList) }} products in this list</p>
                    </div>
                </div>
            </div>
            <div class="form">
                <div class="cart-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <table class="table-responsive cart-wrap">
                                <thead>
                                    <tr>
                                        <th class="images images-b">Product</th>
                                        <th class="ptice">Price</th>
                                        <th class="stock">Stock Status</th>
                                        <th class="remove remove-b">Action</th>
                                        <th class="remove remove-b">Remove</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($wishList ?? [] as $item)
                                        <tr class="wishlist-item">
                                            <td class="product-item-wish">
                                                <div class="check-box"><input type="checkbox" class="myproject-checkbox">
                                                </div>
                                                <div class="images">
                                                    <span>
                                                        <img src="{{ $item?->product?->thumbnail }}" alt="">
                                                    </span>
                                                </div>
                                                <div class="product">
                                                    <ul>
                                                        <li class="first-cart">{{ $item?->product?->name }}</li>
                                                        <li>
                                                            <div class="rating-product">
                                                                <i class="fi flaticon-star"></i>
                                                                <i class="fi flaticon-star"></i>
                                                                <i class="fi flaticon-star"></i>
                                                                <i class="fi flaticon-star"></i>
                                                                <i class="fi flaticon-star"></i>
                                                                <span>130</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="ptice">$
                                                {{ $item?->product?->discount_price > 0 ? $item?->product?->discount_price : $item?->product?->price }}
                                            </td>

                                            @if ($item?->product?->inventories?->sum('quantity') > 0)
                                                <td class="stock"><span class="in-stock">In Stock</span></td>
                                            @else
                                                <td class="stock"><span class="in-stock out-stock">Out Stock</span></td>
                                            @endif
                                            <td class="add-wish">
                                                <a class="theme-btn-s2"
                                                    href="{{ route('singleProduct', $item?->product?->slug) }}">Shop
                                                    Now</a>
                                            </td>
                                            <td class="action">
                                                <ul>
                                                    <li class="w-btn"><a data-bs-toggle="tooltip" data-bs-html="true"
                                                            title=""
                                                            href="{{ route('wishlist.destroy', $item?->product?->slug) }}"
                                                            data-bs-original-title="Remove" aria-label="Remove"><i
                                                                class="fi flaticon-remove"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr class="wishlist-item">
                                        <td class="product-item-wish">
                                            <div class="check-box"><input type="checkbox" class="myproject-checkbox">
                                            </div>
                                            <div class="images">
                                                <span>
                                                    <img src="assets/images/cart/img-2.jpg" alt="">
                                                </span>
                                            </div>
                                            <div class="product">
                                                <ul>
                                                    <li class="first-cart">Blue Bag</li>
                                                    <li>
                                                        <div class="rating-product">
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <span>30</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="ptice">$200</td>
                                        <td class="stock"><span class="in-stock">In Stock</span></td>
                                        <td class="add-wish">
                                            <a class="theme-btn-s2" href="cart.html">Shop Now</a>
                                        </td>
                                        <td class="action">
                                            <ul>
                                                <li class="w-btn"><a data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="" href="#" data-bs-original-title="Remove"
                                                        aria-label="Remove"><i class="fi flaticon-remove"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="wishlist-item">
                                        <td class="product-item-wish">
                                            <div class="check-box"><input type="checkbox" class="myproject-checkbox">
                                            </div>
                                            <div class="images">
                                                <span>
                                                    <img src="assets/images/cart/img-3.jpg" alt="">
                                                </span>
                                            </div>
                                            <div class="product">
                                                <ul>
                                                    <li class="first-cart">Kids Blue Shoes</li>
                                                    <li>
                                                        <div class="rating-product">
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <span>50</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="ptice">$270</td>
                                        <td class="stock"><span class="in-stock out-stock">Out Stock</span></td>
                                        <td class="add-wish">
                                            <a class="theme-btn-s2" href="cart.html">Shop Now</a>
                                        </td>
                                        <td class="action">
                                            <ul>
                                                <li class="w-btn"><a data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="" href="#" data-bs-original-title="Remove"
                                                        aria-label="Remove"><i class="fi flaticon-remove"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr class="wishlist-item">
                                        <td class="product-item-wish">
                                            <div class="check-box"><input type="checkbox" class="myproject-checkbox">
                                            </div>
                                            <div class="images">
                                                <span>
                                                    <img src="assets/images/cart/img-4.jpg" alt="">
                                                </span>
                                            </div>
                                            <div class="product">
                                                <ul>
                                                    <li class="first-cart">Hand Made Hat</li>
                                                    <li>
                                                        <div class="rating-product">
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <i class="fi flaticon-star"></i>
                                                            <span>15</span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td class="ptice">$ 100</td>
                                        <td class="stock"><span class="in-stock">In Stock</span></td>
                                        <td class="add-wish">
                                            <a class="theme-btn-s2" href="cart.html">Shop Now</a>
                                        </td>
                                        <td class="action">
                                            <ul>
                                                <li class="w-btn"><a data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="" href="#" data-bs-original-title="Remove"
                                                        aria-label="Remove"><i class="fi flaticon-remove"></i></a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection
