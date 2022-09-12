<head>
    <meta charset="utf-8" />
    <meta name="author" content="infotechgravity.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:title" content="{{Helper::webinfo()->meta_title}}" />
    <meta property="og:description" content="{{Helper::webinfo()->meta_description}}" />
    <meta property="og:image" content='{{Helper::webinfo()->og_image}}' />

    <!-- favicon-icon  -->
    <link rel="icon" href='{{Helper::webinfo()->favicon}}' type="image/x-icon">
    
    <title>@yield('title')</title>
     
    <!-- Custom CSS -->
    <link href="{{asset('Webassets/css/styles.css')}}" rel="stylesheet">
    <link href="{!! asset('Webassets/sweetalert/css/sweetalert.css') !!}" rel="stylesheet">
    <link href="{{asset('Webassets/css/toasty.css')}}" rel="stylesheet" />
</head>