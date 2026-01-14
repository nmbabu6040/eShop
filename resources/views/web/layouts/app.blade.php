<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpOceans">
    <link rel="shortcut icon" type="image/png" href="{{ asset('web/assets/images/favicon.png') }}">
    <title>Themart - eCommerce HTML5 Template</title>
    <link href="{{ asset('web/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/flaticon_ecommerce.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/owl.theme.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/odometer-theme-default.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/sass/style.css') }}" rel="stylesheet">
</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <!-- start preloader -->
        <div class="preloader">
            <div class="vertical-centered-box">
                <div class="content">
                    <div class="loader-circle"></div>
                    <div class="loader-line-mask">
                        <div class="loader-line"></div>
                    </div>
                    <img src="{{ asset('web/assets/images/preloader.png') }}" alt="">
                </div>
            </div>
        </div>
        <!-- end preloader -->

        <!-- start header -->
        @include('web.layouts.partials.header')
        <!-- end of header -->

        @yield('content')

        <!-- start of wpo-site-footer-section -->
        @include('web.layouts.partials.footer')
        <!-- end of wpo-site-footer-section -->

        <!-- start wpo-newsletter-popup-area-section -->
        <section class="wpo-newsletter-popup-area-section">
            <div class="wpo-newsletter-popup-area">
                <div class="wpo-newsletter-popup-ineer">
                    <button class="btn newsletter-close-btn"><i class="ti-close"></i></button>
                    <div class="img-holder">
                        <img src="{{ asset('web/assets/images/newsletter.jpg') }}" alt>
                    </div>
                    <div class="details">
                        <h4>Get 30% discount shipped to your inbox</h4>
                        <p>Subscribe to the Themart eCommerce newsletter to receive timely updates to your favorite
                            products</p>
                        <form>
                            <div>
                                <input type="email" placeholder="Enter your email">
                                <button type="submit">Subscribe</button>
                            </div>
                            <div>
                                <label class="checkbox-holder"> Don't show this popup again!
                                    <input type="checkbox" class="show-message">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- end wpo-newsletter-popup-area-section -->

    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('web/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('web/assets/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.dlmenu.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery-plugin-collection.js') }}"></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('web/assets/js/script.js') }}"></script>
</body>

</html>
