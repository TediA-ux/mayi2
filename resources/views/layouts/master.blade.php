<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title> @yield('title')| Mayi</title>
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicons -->
    <link href="{{ URL::asset('assets/images/favicon.png')}}" rel="icon">

    @include('layouts.head-css')
</head>
@yield('body-start')

@include('layouts.horizontal-nav')

    <div style="padding-top:70px;margin-left: auto;
  margin-right: auto;width:90%">
        <!-- Start content -->
    @yield('content')
    <!-- content -->
    </div>
    

    @include('layouts.vendor-script')

@yield('body-end')

</html>
