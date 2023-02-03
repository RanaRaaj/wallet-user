<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Factu">
    <meta name="keywords" content="Factu">
    <meta name="author" content="Factu">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/dashboard/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/dashboard/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/dashboard/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/dashboard/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/dashboard/app-assets/css/components.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{ url('assets/dashboard/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ url('assets/dashboard/app-assets/css/core/colors/palette-gradient.css')}}">

    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('assets/dashboard/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    <style type="text/css">
        .border-top-golden {
            border-top: 1px solid #fbc02d;
        }

        .border-top-light {
            border-top: 1px solid #fa62e7;
        }

        .card .card-title {
            font-weight: 700;
            letter-spacing: 0.05rem;
            font-size: 1.07rem;
        }
    </style>

    @stack('dashboard.scripts-head')
</head>

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu 2-columns fixed-navbar pace-done menu-expanded" data-open="click" data-menu="vertical-menu"  data-color="bg-gradient-x-purple-blue" data-col="2-columns">

@include('admin.layouts.site-header')
@include('admin.layouts.site-sidebar')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-2" style="width: 500px;position: absolute;right: 0;top: 0px;" id="alert-success-message" role="alert">
                <strong>Success! </strong> {{$message}}
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger mb-2" id="alert-error-message" style="width: 500px;position: absolute;right: 0;top: 0px;" role="alert">
                <strong>Error! </strong> {{$message}}
            </div>
        @endif
        <div class="content-header row"></div>
        <div class="content-body">
            @yield('dashboard.content-view')
        </div>
    </div>
</div>

@include('admin.layouts.site-footer')

<!-- BEGIN: Vendor JS-->
<script src="{{ url('assets/dashboard/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ url('assets/dashboard/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{ url('assets/dashboard/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<!-- END: Theme JS-->

 @if ($message = Session::get('success'))
     <script>
         setTimeout(function(){
             document.getElementById('alert-success-message').style.display = 'none'
         }, 3000);
     </script>
 @endif
 @if ($message = Session::get('error'))
     <script>
         setTimeout(function(){
             document.getElementById('alert-error-message').style.display = 'none'
         }, 3000);
     </script>
 @endif

@stack('dashboard.scripts-footer')
</body>
<!-- END: Body-->

</html>
