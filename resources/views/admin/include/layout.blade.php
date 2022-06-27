<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page_title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin_assets/images/favicon.png') }}">
    <!-- Custom CSS -->
    <link href="{{ asset('admin_assets/css/style.min.css') }}" rel="stylesheet">
    @stack('custom_styles')
</head>
<body>
    <!-- Main wrapper -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        @include('admin/include/header')
        @include('admin/include/sidebar')
        <div class="page-wrapper">
            @yield('container')
            @include('admin/include/footer')
        </div>
    </div>
    <!-- End Wrapper -->

    <!-- All Jquery -->
    <script src="{{ asset('admin_assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    @yield('custom_script')
</body>

</html>
