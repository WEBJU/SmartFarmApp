<!DOCTYPE html>
<html lang="en" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="Login">
    <meta name="author" content="Gravity Infotech">
    <title>{{Helper::webinfo()->site_title}} | {{ trans('labels.key_verification') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{Helper::webinfo()->favicon}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/vendors/css/prism.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('storage/app/public/Adminassets/css/app.css')}}">
    
  </head>
  <body data-col="1-column" class=" 1-column  blank-page blank-page">
    @if(Session::has('error'))
        <div class="alert alert-danger" style="text-align: center; color: #fff !important; font-weight: bold;">
            {{ Session::get('error') }}
        </div>
    @endif
    <div class="wrapper">
      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper">
                <section id="login">
                    <div class="container-fluid gradient-red-pink">
                        <div class="row full-height-vh">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="card bg-blue-grey bg-darken-3 text-center width-400">
                                    <div class="card-body">
                                        <div class="card-block">

                                        	@if(session()->has('danger'))
                                        	    <div class="alert alert-danger" style="text-align: center;">
                                        	        {{ session()->get('danger') }}
                                        	    </div>
                                        	@endif

                                            <div class="form-group mt-4">
                                                <div class="col-md-12">
                                                    <img alt="element 06" class="mb-1" src="{{Helper::webinfo()->image}}" width="190">
                                                </div>
                                            </div>

                                            <form method="POST" class="mt-5 mb-5 login-input" action="{{ URL::to('/admin/otp_verification') }}">
                                                @csrf

                                                <div class="form-group">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Session::get('email')}}" readonly="" placeholder="{{ trans('labels.email') }}">
                                                </div>

                                                <div class="form-group">
                                                    <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" required autocomplete="current-otp" placeholder="{{ trans('labels.otp') }}">

                                                    @error('otp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <?php
                                                $text = str_replace('verification', '', url()->current());
                                                ?>

                                                <div class="form-group">
                                                    <input id="domain" type="hidden" class="form-control @error('domain') is-invalid @enderror" name="domain" required autocomplete="current-domain" value="{{$text}}"  readonly="">
                                                </div>

                                                <button type="submit" class="btn login-form__btn submit w-100">
                                                    {{ __('Submit') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <!--Login Page Ends-->
          </div>
        </div>
      </div>
    </div>

    <script src="{{asset('storage/app/public/Adminassets/vendors/js/core/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/prism.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/vendors/js/pace/pace.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('storage/app/public/Adminassets/js/app-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/js/notification-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('storage/app/public/Adminassets/js/customizer.js')}}" type="text/javascript"></script>

  </body>

</html>