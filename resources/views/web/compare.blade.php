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
                            <li>Compare</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- start themart-compare-section  -->
    <section class="themart-compare-section">
        <h2 class="h-hidden">some</h2>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>Product</td>
                            <td class="text-title">Stylish Pink Coat</td>
                            <td class="text-title">Blue Bag</td>
                            <td class="text-title">Blue Kids Shoes</td>
                            <td class="text-title">Hand Made Hat</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Images</td>
                            <td><img src="{{ asset('web/assets/images/cart/img-1.jpg') }}" alt=""></td>
                            <td><img src="{{ asset('web/assets/images/cart/img-2.jpg') }}" alt=""></td>
                            <td><img src="{{ asset('web/assets/images/cart/img-3.jpg') }}" alt=""></td>
                            <td><img src="{{ asset('web/assets/images/cart/img-4.jpg') }}" alt=""></td>
                        </tr>
                        <tr>
                            <td>Categories</td>
                            <td>Fashion</td>
                            <td>Bags</td>
                            <td>Shoes</td>
                            <td>Hats</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>$250.00</td>
                            <td>$200.00</td>
                            <td>$120.00</td>
                            <td>$200.00</td>
                        </tr>
                        <tr>
                            <td>Color</td>
                            <td>Brown</td>
                            <td>Blue</td>
                            <td>White</td>
                            <td>Yellow</td>
                        </tr>
                        <tr>
                            <td>Size</td>
                            <td>Small</td>
                            <td>Medium</td>
                            <td>Large</td>
                            <td>Extra Large</td>
                        </tr>
                        <tr>
                            <td>Rating</td>
                            <td>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>70</span>
                                </div>
                            </td>
                            <td>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>90</span>
                                </div>
                            </td>
                            <td>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>60</span>
                                </div>
                            </td>
                            <td>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>30</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Availability</td>
                            <td>In Stock</td>
                            <td>In Stock</td>
                            <td>In Stock</td>
                            <td>In Stock</td>
                        </tr>
                        <tr>
                            <td>Purchase</td>
                            <td><a href="cart.html">Add</a></td>
                            <td><a href="cart.html">Add</a></td>
                            <td><a href="cart.html">Add</a></td>
                            <td><a href="cart.html">Add</a></td>
                        </tr>
                        <tr>
                            <td>Action</td>
                            <td>
                                <a data-bs-toggle="tooltip" data-bs-html="true" title="" href="#"
                                    data-bs-original-title="Remove" aria-label="Remove">
                                    <i class="fi flaticon-remove"></i>
                                </a>
                            </td>
                            <td>
                                <a data-bs-toggle="tooltip" data-bs-html="true" title="" href="#"
                                    data-bs-original-title="Remove" aria-label="Remove">
                                    <i class="fi flaticon-remove"></i>
                                </a>
                            </td>
                            <td>
                                <a data-bs-toggle="tooltip" data-bs-html="true" title="" href="#"
                                    data-bs-original-title="Remove" aria-label="Remove">
                                    <i class="fi flaticon-remove"></i>
                                </a>
                            </td>
                            <td>
                                <a data-bs-toggle="tooltip" data-bs-html="true" title="" href="#"
                                    data-bs-original-title="Remove" aria-label="Remove">
                                    <i class="fi flaticon-remove"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- end themart-compare-section  -->

    <!-- start of themart-cta-section -->
    <section class="themart-cta-section section-padding">
        <div class="container">
            <div class="cta-wrap">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-12">
                        <div class="cta-content">
                            <h2>Subscribe Our Newsletter & <br>
                                Get 30% Discounts For Next Order</h2>
                            <form>
                                <div class="input-1">
                                    <input type="email" class="form-control" placeholder="Your Email..." required="">
                                    <div class="submit clearfix">
                                        <button class="theme-btn-s2" type="submit">Subscribe</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of themart-cta-section -->
@endsection
