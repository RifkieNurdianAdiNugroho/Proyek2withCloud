@extends('layouts.admin.base')

@section('slot')
<!-- Preloader -->
@include('layouts.admin.partials.preloader')
<!-- End Preloader -->

<!-- Main wrapper -->
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    <!-- Topbar header -->
    @include('layouts.admin.partials.header')
    <!-- End Topbar header -->
    
    <!-- Left Sidebar -->
    @include('layouts.admin.partials.sidebar')
    <!-- End Left Sidebar -->

    <!-- Page wrapper  -->
    <div class="page-wrapper">
        <!-- Bread crumb -->
        @include('layouts.admin.partials.breadcrumb')
        <!-- End Bread crumb-->

        <!-- Container fluid  -->
        @yield('content')
        <!-- End Container fluid  -->

        <!-- footer -->
        @include('layouts.admin.partials.footer')
        <!-- End footer -->
    </div>
    <!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->
@endsection
