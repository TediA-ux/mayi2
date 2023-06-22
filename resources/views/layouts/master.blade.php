<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> @yield('title')| CODE 3:16</title>
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicons -->
    <link href="{{ URL::asset('assets/images/favicon.png')}}" rel="icon">

    @include('layouts.head-css')
</head>

@yield('body-start')
    @include('layouts.left-sidebar')
    @include('layouts.topbar')

    <!-- Begin page -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

            <div class="page-content-tab">
                <!-- Start content -->
                <div class="container-fluid">
                    @yield('breadcrumb')
                    @yield('content')
                </div> <!-- content -->
            </div>


            @include('layouts.footer')
            <a href="javascript:void(0)" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    @include('layouts.vendor-script')
@yield('body-end')

</html>
