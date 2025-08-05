<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Wathiq-Dashboard')</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('asset/admin/images/favicon.ico') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <!-- Vendor css -->
    <link href="{{ asset('asset/admin/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('asset/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons css -->
    <link href="{{ asset('asset/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Datatable -->
    <link href="//cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" rel="stylesheet">
    <!-- Sweet Alert css-->
    <link href=" {{ asset('asset/admin/vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div class="wrapper">
        <!-- Sidenav Menu Start -->
        @include('layouts.sidebar')
        <!-- Sidenav Menu End -->

        <!-- Topbar Start -->
        @include('layouts.topbar')
        <!-- Topbar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">
            @yield('content')
            <!-- Footer Start -->
            @include('layouts.footer')
            <!-- end Footer -->
        </div>

        <!-- ============================================================= -->
        <!-- End Page content -->
        <!-- ============================================================= -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    @include('layouts.theme-setting')
    @include('layouts.script')
</body>

</html>