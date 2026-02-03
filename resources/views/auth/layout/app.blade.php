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
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.26.2/dist/sweetalert2.min.css
" rel="stylesheet">
    <link href="{{ asset('web/assets/css/slick-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/owl.transitions.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/odometer-theme-default.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/sass/style.css') }}" rel="stylesheet">

    @stack('style')
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

        @yield('content')


    </div>
    <!-- end of page-wrapper -->

    <!-- All JavaScript files
    ================================================== -->
    <script src="{{ asset('web/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Plugins for this template -->
    <script src="{{ asset('web/assets/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('web/assets/js/jquery.dlmenu.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.2/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('web/assets/js/jquery-plugin-collection.js') }}"></script>
    <!-- Custom script for this template -->
    <script src="{{ asset('web/assets/js/script.js') }}"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
    </script>

    @if (session('success'))
        <script>
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            Toast.fire({
                icon: "warning",
                title: "{{ session('warning') }}"
            });
        </script>
    @endif

    @stack('script')
</body>


<!-- Mirrored from wpocean.com/html/tf/themart/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 15 Jun 2023 08:56:29 GMT -->

</html>
