<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In | Shreyu - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

        <link href="{{ asset('assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
        <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

        <!-- icons -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">
        
        <div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-6 p-4">
                                        <div class="mx-auto">
                                            <a href="index.html">
                                                <img src="assets/images/logo-dark.png" alt="" height="24" />
                                            </a>
                                        </div>

                                        <h6 class="h5 mb-0 mt-3">Welcome back!</h6>
                                        <p class="text-muted mt-1 mb-4">
                                            Enter your email address and password to access admin panel.
                                        </p>

                                        <form action="#" method="POST" class="authentication-form">
                                            <h6 class=" mt-3">Sign In</h6>
                                            @csrf
                                            <div class="mb-3 mt-4">
                                                <div class="form-group position-relative">
                                                    <i class="icon-dual position-absolute" data-feather="mail"></i>
                                                    <input autocomplete="username" name="email" type="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-4">
                                                <div class="form-group d-flex align-items-center position-relative">
                                                    <i class="icon-dual position-absolute start-0 ms-2 top-50 translate-middle-y" data-feather="lock"></i>
                                                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter Your Password" autocomplete="current-password">
                                                    <i class="uil uil-eye position-absolute end-0 me-2 top-50 translate-middle-y toggle-password"></i>
                                                </div>
                                            </div>

                                            <div class="mb-0 mt-1 float-end">
                                                <a href="{{ route('user.forgot-password') }}" class="forgot-password">Forgot Password?</a>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="mb-3 mt-3 text-center d-grid">
                                                <button class="btn btn-primary" type="submit">Sign In</button>
                                            </div>
                                            <div class="mt-4 mb-3 text-center divider d-none">
                                                - OR Continue with -
                                            </div>

                                            <div class="mt-4 mb-3 text-center d-flex flex-row justify-content-center align-items-center d-none">
                                                <div class="facebook-icon pe-2">
                                                    <img src="{{ asset('assets/images/front/facebook.svg') }}">
                                                </div>
                                                <div class="google-icon ps-2">
                                                    <img src="{{ asset('assets/images/front/google.svg') }}">
                                                </div>
                                            </div>

                                            <div class="text-center mt-3 sign-up-link">
                                                Create New Account? <a href="{{ route('user.register') }}" class="sign-up ms-1">Sign Up</a>
                                            </div>

                                        </form>
                                        
                                        <div class="py-3 text-center"><span class="fs-16 fw-bold">OR</span></div>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <a href="" class="btn btn-white mb-2 mb-sm-0"><i class='uil uil-google icon-google me-2'></i>With Google</a>
                                                <a href="" class="btn btn-white mb-2 mb-sm-0"><i class='uil uil-facebook me-2 icon-fb'></i>With Facebook</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-none d-md-inline-block">
                                        <div class="auth-page-sidebar">
                                            <div class="overlay"></div>
                                            <div class="auth-user-testimonial">
                                                <p class="fs-24 fw-bold text-white mb-1">I simply love it!</p>
                                                <p class="lead">"It's a elegent templete. I love it very much!"</p>
                                                <p>- Admin User</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-primary fw-bold ms-1">Sign Up</a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.form.js') }}"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                @if(session()->has('message'))
                    var type = "{{ session()->get('level') }}";
                    var message = "{{ session()->get('message') }}";

                    if(type == 'success'){
                        toastr.success(message);
                    } else if(type == 'error'){
                        toastr.error(message);
                    } else if(type == 'warning'){
                        toastr.warning(message);
                    } else {
                        toastr.info(message);
                    }

                @endif

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                @endif

                $('.toggle-password').on('click', function() {
                    let passwordInput = $('#password');
                    let icon = $(this);

                    if (passwordInput.attr('type') === 'password') {
                        passwordInput.attr('type', 'text');
                        icon.removeClass('uil-eye').addClass('uil-eye-slash');
                    } else {
                        passwordInput.attr('type', 'password');
                        icon.removeClass('uil-eye-slash').addClass('uil-eye');
                    }
                });
            });
        </script>
        
    </body>
</html>