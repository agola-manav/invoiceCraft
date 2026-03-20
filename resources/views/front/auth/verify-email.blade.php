<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sign In |</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/smartaudio-sm.png') }}">

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="{{ asset('assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

        <!-- icons -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/front-auth.css') }}" rel="stylesheet" type="text/css" />

        <style type="text/css">
            .btn.btn-primary {
                padding: 15px 20px;
            }
            @media only screen and (max-width: 767px){
                .title {
                    color: white;
                }
                .description {
                    color: white;
                }
            }
        </style>
    </head>

    <body>
        <div class="row overflow-hidden g-0">

            <div class="col-lg-6 col-md-6 col-12 auth-left-side  d-none d-md-inline-block">
                <div class="gradient-bg-color-top"></div>
                <div class="gradient-bg-color-bottom"></div>
                <div class="inner-content pb-4">
                    <div class="content position-relative pb-5">
                        <h2 class="text-white">
                            Unlock Your Potential with SMART Audio
                        </h2>
                        <p class="text-white">
                            Sign up Now to Get Started 🌟
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12 auth-right-side">
                <div class="row align-middle">
                    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-8 offset-sm-2 col-10 offset-1">
                        @if(session()->has('message'))
                            <div class="mt-3 alert alert-{{ session()->get('level') }}">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <form class="authentication-form" method="POST" action="{{ route('verification.resend') }}">
                            <h2 class="title mt-3 text-center">Verify Your Email Address</h2>
                            @csrf
                            <div class="description mb-3 mt-4 text-center">
                                <p>
                                    Before proceeding, please check your email for a verification link. If you did not receive the email.
                                </p>
                            </div>


                            <div class="mb-3 text-center d-grid">
                                <button class="btn btn-primary" type="submit">click here to request another</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
    </body>
</html>