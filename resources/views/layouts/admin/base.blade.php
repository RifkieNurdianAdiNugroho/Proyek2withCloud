<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('adminmart/assets/images/favicon.png') }}">
    <title>Sistem Penjualan Sayur</title>
    <!-- This Page CSS -->
    @stack('style')
    <!-- Style -->
    <link href="{{ asset('adminmart/dist/css/style.min.css') }}" rel="stylesheet">
</head>

<body>

    @yield('slot')
    
    <!-- All Jquery -->
    <script src="{{ asset('adminmart/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <script src="{{ asset('adminmart/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('adminmart/dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('adminmart/dist/js/sidebarmenu.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('adminmart/dist/js/custom.min.js') }}"></script>
    <!-- This page JavaScript -->
    @stack('script')
</body>

</html>