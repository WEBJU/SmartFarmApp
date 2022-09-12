<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{{Helper::webinfo()->meta_description}}">
    <meta name="keywords" content="admin">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') </title>
    <link rel="icon" href='{{Helper::webinfo()->favicon}}' type="image/x-icon">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('Adminassets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminassets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminassets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminassets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('Adminassets/vendors/css/prism.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('Adminassets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Adminassets/vendors/css/toastr.css')}}">

    <link href="{{URL::to('Adminassets/css/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('Adminassets/vendors/css/switchery.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('Adminassets/vendors/css/tagging.css')}}">
    @yield('css')

</head>
<!--*******************
    Preloader start
********************-->
<div id="preloader" style="display: none;">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->