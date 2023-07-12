<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="sproutwings is real time gps tracking system in all over india .our products are personal tracker,asset tracker,vechicle tracker,personal tracker,fleet tracker etc..,">
    <meta name="keywords" content="">
    <meta name="author" content="TRACKING WINGS">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/icheck/custom.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components.min.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core/menu/menu-types/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/login-register.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
    <title>

    </title>
    <!-- END: Custom CSS-->


</head>

<!-- END: Head-->
<!-- bg-full-screen-image -->

<!-- BEGIN: Body-->

<body style="background-image: assets('img/road_back.png');" class="vertical-layout vertical-menu-modern 1-column blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1">
                                            <img src=" {{asset('img/APEMC.png')}}" class="img-responsive" height="200px" alt="APEMC">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content">

                                    <div class="card-body">
                                        <form class="form-horizontal" id="loginForm" action="{{ route('login') }}" name="myForm" method="post">
                                            @csrf
                                           
                                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }} <span>*</span></label>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            </fieldset>
                                           
                                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="fa fa-key"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row" style="display:none;">
                                                <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                                    <fieldset>
                                                        <input type="checkbox" id="remember-me" class="chk-remember">
                                                        <label for="remember-me"> Remember Me</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"></div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-primary btn-block"><i class="feather icon-unlock"></i> {{ __('Login') }}</button>
                                        </form>
                                    </div>
                                    <!--<p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>New to Stack ?</span></p>-->
                                    <!--                            <div class="text-center">
                                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span
                                        class="fa fa-facebook"></span></a>
                                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span
                                        class="fa fa-twitter"></span></a>
                                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span
                                        class="fa fa-linkedin font-medium-4"></span></a>
                                <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-github"><span
                                        class="fa fa-github font-medium-4"></span></a>
                            </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- END: Content-->
    <script src="{{ asset('vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{ asset('vendors/js/forms/icheck/icheck.min.js')}}"></script>
    <!-- END: Page JS-->
    <script type="text/javascript">
        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 30000);


        function check() {
            if (document.myForm.username.value == "") {
                alert("Enter Username");
                document.myForm.username.focus();
                return false;
            }

            if (document.myForm.password.value == "") {
                alert("Enter Password");
                document.myForm.password.focus();
                return false;
            }

        }
    </script>
</body>
<!-- END: Body-->

</html>