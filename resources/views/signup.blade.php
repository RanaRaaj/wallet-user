<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Factu">
    <meta name="keywords" content="Factu">
    <meta name="author" content="Factu">
    <title>Taco Collect System  </title>
    <link rel="apple-touch-icon" href="{{asset('assets/images/logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/logo.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/components.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/app-assets/css/pages/login-register.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/sidebar.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard/assets/css/style.css')}}">
    <!-- END: Custom CSS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
 

</head>
<style>
.card-header {
    color: #fff;
    background-color: #00000000 !important;
}
.card.border-grey.border-lighten-3.px-1.py-1.m-0 {
    background: #2a303c !important;
    background-size: contain;
    FONT-WEIGHT: 500;
    border-radius: 24px;
}
.round {
    border-radius: 0.5rem !important;
}
html body.bg-full-screen-image {
    background: #212530 !important;
}
form .form-group {
    margin-bottom: 1.5rem;
}
.support-sub > a > img {
    width: 42px;
}
a.nxt-link {
    color: #ffc107 !important;
    text-decoration: underline;
}
</style>
<!-- END: Head-->

<!-- BEGIN: Body-->
@php
  $links = DB::table('links')->where('status',1)->get();
@endphp
<div class="support-icon">
  <div class="support-main">
    <a href="#">
      <i class="fas fa-headset fa-2x"></i>
    </a>
  </div>
    <span class="head-set-title">CSKH</span>
  <div class="support-sub">
    @if($links)
    @foreach($links as $link)
      <a href="{{$link->link}}" target="_blank">
        <img src="{{$link->icon}}">
        <!-- <i class="fas fa-envelope fa-2x"></i> -->
      </a>
      @endforeach
    @endif
  </div>
</div>
<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-color="bg-gradient-x-purple-red" data-col="1-column">
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success mb-2" style="width: 500px;position: absolute;right: 0;top: 50px;" id="alert-success-message" role="alert">
                <strong>Success! </strong> {{$message}}
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert alert-danger mb-2" id="alert-error-message" style="width: 500px;position: absolute;right: 0;top: 50px;" role="alert">
                <strong>Error! </strong> {{$message}}
            </div>
        @endif
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <div class="text-center mb-1">
                                    <!-- <img src="{{asset('assets/images/logo.png')}}" width="100" alt="branding logo"> -->
                                </div>
                                <div class="font-large-1 text-center" style="color:#ffc107;">
                                Đăng ký
                                </div>
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success mb-2" style="position: absolute;right: 0;top: 50px;" id="alert-success-message" role="alert">
                                        <strong>Success! </strong> {{$message}}
                                    </div>
                                @endif
                            </div>
                            <div class="card-content">

                                <div class="card-body">
                                    <form class="form-horizontal" action="{{route('admin.register')}}" method="post" novalidate>
                                        @csrf
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control round" id="user-name" name="name" placeholder="Họ và Tên">
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                            @if($errors->has('name'))
                                                <div class="error"
                                                     style="color:red">{{$errors->first('name')}}</div>
                                            @endif
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control round" id="user-name" name="email" placeholder="Tên đăng nhập">
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                            @if($errors->has('email'))
                                                <div class="error"
                                                     style="color:red">{{$errors->first('email')}}</div>
                                            @endif
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control round" id="user-password" name="password" placeholder="Mật khẩu">
                                            <div class="form-control-position">
                                                <i class="ft-lock"></i>
                                            </div>
                                            @if($errors->has('password'))
                                                <div class="error" style="color:red">{{$errors->first('password')}}</div>
                                            @endif
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control round" id="user-password" name="c_password" placeholder="Nhập lại mật khẩu">
                                            <div class="form-control-position">
                                                <i class="ft-lock"></i>
                                            </div>
                                            @if($errors->has('password'))
                                                <div class="error" style="color:red">{{$errors->first('password')}}</div>
                                            @endif
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12 text-center text-sm-left"></div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Đăng ký</button>
                                        </div>
                                        <div class="form-group text-center">
                                            <a href="{{ url('/') }}" class="nxt-link col-12 mr-1 mb-1">Đăng nhập</a>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- END: Content-->
<script>
$(document).ready(function() {
    $('.support-icon .support-main').click(function() {
      $('.support-icon').toggleClass('active');
    });
});
</script>
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

<!-- BEGIN: Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('assets/dashboard/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}" type="text/javascript"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('assets/dashboard/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/dashboard/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('assets/dashboard/app-assets/js/scripts/forms/form-login-register.js')}}" type="text/javascript"></script>
<!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
