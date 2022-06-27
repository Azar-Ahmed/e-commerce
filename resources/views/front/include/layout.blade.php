<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from htmldemo.net/eliza/eliza/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Jun 2022 14:36:33 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('front_assets/assets/images/favicon.png')}}">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/assets/css/vendor/bootstrap.min.css')}}">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/assets/css/vendor/line-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/assets/css/vendor/themify.css')}}">

    <!-- othres CSS -->
    <link rel="stylesheet" href="{{asset('front_assets/assets/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/assets/css/plugins/owl-carousel.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/assets/css/plugins/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/assets/css/plugins/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('front_assets/assets/css/style.css')}}">

</head>
<body>
    <div class="main-wrapper wrapper-2">
        @include('front/include/header')
        @yield('container')
        @include('front/include/footer')
        @include('front/include/modal')
    </div>


    <!-- Js Plugins -->

    <!-- Modernizer JS -->
    <script src="{{asset('front_assets/assets/js/vendor/modernizr-3.11.7.min.js')}}"></script>
    <!-- jQuery JS -->
    <script src="{{asset('front_assets/assets/js/vendor/jquery-v3.6.0.min.js')}}"></script>
    <!-- jquery migrate JS -->
    <script src="{{asset('front_assets/assets/js/vendor/jquery-migrate-v3.3.2.min.js')}}"></script>
    <!-- Popper JS -->
    <script src="{{asset('front_assets/assets/js/vendor/popper.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('front_assets/assets/js/vendor/bootstrap.min.js')}}"></script>

    <!-- Slick Slider JS -->
    <script src="{{asset('front_assets/assets/js/plugins/countdown.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/counterup.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/instafeed.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/jquery-ui.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/jquery-ui-touch-punch.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/owl-carousel.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/wow.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/slick.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/elevatezoom.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/sticky-sidebar.js')}}"></script>
    <script src="{{asset('front_assets/assets/js/plugins/ajax-mail.js')}}"></script>
    <!-- Main JS -->
    <script src="{{asset('front_assets/assets/js/main.js')}}"></script>
 
   
    @yield('custom_script')
</body>
</html>