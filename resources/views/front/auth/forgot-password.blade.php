<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Recover Password | Shreyu - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

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

                                        <h6 class="h5 mb-0 mt-3">Reset Password</h6>
                                        <p class="text-muted mt-1 mb-4">Enter your email address and we'll send you an email with instructions to reset your password.</p>

                                        <form action="#" method="POST" class="authentication-form">
                                            <h6 class=" mt-3">Reset Password</h6>
                                            @csrf
                                            <div class="mb-3 mt-4">
                                                <div class="form-group position-relative">
                                                    <i class="icon-dual position-absolute" data-feather="mail"></i>
                                                    <input autocomplete="username" name="email" type="email" class="form-control" id="email" placeholder="Enter Your Email">
                                                </div>
                                            </div>

                                            <div class="mb-3 text-center d-grid">
                                                <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
                                            </div>
                                            <div class="text-center mt-3 sign-up-link">
                                                Remember Password? <a href="{{ route('user.login') }}" class="sign-up ms-1">Sign In</a>
                                            </div>
                                            <div class="download-buttons pb-3">
                                                <a href="javascript:" class="btn me-2"><i class="uil uil-apple"></i> App store</a>
                                                <a href="javascript:" class="btn"><i class="uil uil-google-play"></i> Google play</a>
                                            </div>
                                        </form>
                                        
                                    </div>
                                    <div class="col-lg-6 d-none d-lg-inline-block">
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
                                <p class="text-muted">Back to <a href="pages-login.html" class="text-primary fw-bold ms-1">Login</a></p>
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
            });
        </script>
        
    </body>
</html>