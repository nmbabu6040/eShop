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
                            <li>About Us</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- start of wpo-about-section -->
    <section class="wpo-about-section section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="wpo-about-wrap">
                        <div class="wpo-about-img">
                            <img src="{{ asset('web/assets/images/about.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="wpo-about-text">
                        <h4>ABOUT US</h4>
                        <h2>We Help Your
                            <b>Digital<span>&</span>Business Grow.</b>
                        </h2>
                        <p>Aliquam erat volutpat. Duis ac turpis.
                            Integer rutrum ante eu lacus.Vestibulum libero nisl,
                            porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh.
                            Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros.
                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                            Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of wpo-about-section -->

    <!-- start wpo-service-section -->
    <section class="wpo-service-section">
        <div class="container">
            <div class="service-wrap">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="service-item">
                            <div class="service-item-img">
                                <img src="{{ asset('web/assets/images/service/1.png') }}" alt="">
                            </div>
                            <div class="service-item-text">
                                <h2>Free Shipping</h2>
                                <p>Free Shipping World Wide.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="service-item">
                            <div class="service-item-img">
                                <img src="{{ asset('web/assets/images/service/2.png') }}" alt="">
                            </div>
                            <div class="service-item-text">
                                <h2>24 X 7 Service</h2>
                                <p>Online Service For New Customer.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="service-item">
                            <div class="service-item-img">
                                <img src="{{ asset('web/assets/images/service/3.png') }}" alt="">
                            </div>
                            <div class="service-item-text">
                                <h2>Festival Offer</h2>
                                <p>New Online Special Festival Offer.</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- end wpo-service-section -->

    <!-- start themart-gallery-section-->
    <section class="themart-gallery-section themart-gallery-section-s2 section-padding" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="wpo-section-title">
                        <h2>Image Gallery</h2>
                    </div>
                </div>
            </div>
            <div class="sortable-gallery">
                <div class="gallery-filters"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portfolio-grids gallery-container clearfix">
                            <div class="grid">
                                <div class="img-holder">
                                    <a href="{{ asset('web/assets/images/portfolio/1.jpg') }}" class="fancybox"
                                        data-fancybox-group="gall-1">
                                        <img src="{{ asset('web/assets/images/portfolio/1.jpg') }}" alt
                                            class="img img-responsive">
                                        <div class="hover-content">
                                            <i class="fi flaticon-eye"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="img-holder">
                                    <a href="{{ asset('web/assets/images/portfolio/2.jpg') }}" class="fancybox"
                                        data-fancybox-group="gall-1">
                                        <img src="{{ asset('web/assets/images/portfolio/2.jpg') }}" alt
                                            class="img img-responsive">
                                        <div class="hover-content">
                                            <i class="fi flaticon-eye"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="img-holder">
                                    <a href="{{ asset('web/assets/images/portfolio/4.jpg') }}" class="fancybox"
                                        data-fancybox-group="gall-1">
                                        <img src="{{ asset('web/assets/images/portfolio/4.jpg') }}" alt
                                            class="img img-responsive">
                                        <div class="hover-content">
                                            <i class="fi flaticon-eye"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="img-holder">
                                    <a href="{{ asset('web/assets/images/portfolio/3.jpg') }}" class="fancybox"
                                        data-fancybox-group="gall-1">
                                        <img src="{{ asset('web/assets/images/portfolio/3.jpg') }}" alt
                                            class="img img-responsive">
                                        <div class="hover-content">
                                            <i class="fi flaticon-eye"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end themart-gallery-section-->


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
