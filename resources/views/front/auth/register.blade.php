<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Register | Shreyu - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- App css -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="assets/css/bootstrap-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled />
		<link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet"  disabled />

		<!-- icons -->
		<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/toastr.min.js') }}">

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

                                        <h6 class="h5 mb-0 mt-3">Create your account</h6>
                                        <p class="text-muted mt-1 mb-4">Create a free account and start using Shreyu</p>

                                        @if(session()->has('message'))
                                            <div class="mt-3 alert alert-{{ session()->get('level') }}">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <form action="#" method="POST" class="authentication-form">
                                            <h6 class=" mt-3">Sign Up</h6>
                                            @csrf
                                            {{-- <input type="hidden" name="type" value="as_society"> --}}

                                            <input type="hidden" name="society_id" value="{{ request()->get('society', '') }}">

                                            <div class="mb-3 mt-4">
                                                <div class="form-group input-group">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="user"></i>
                                                    </span>
                                                    <input name="name" type="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="Enter Your Name">
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-4">
                                                <div class="form-group input-group">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="mail"></i>
                                                    </span>
                                                    <input name="email" type="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Enter Your Email">
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-4">
                                                <div class="form-group input-group">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="phone"></i>
                                                    </span>
                                                    <input name="phone" type="text" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="Enter Your Number">
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-4">
                                                <div class="form-group input-group">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="lock"></i>
                                                    </span>
                                                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter Your Password">
                                                    {{-- <i class="uil uil-eye position-absolute toggle-password"></i> --}}
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-4">
                                                <div class="form-group input-group">
                                                    <span class="input-group-text">
                                                        <i class="icon-dual" data-feather="lock"></i>
                                                    </span>
                                                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password">
                                                    {{-- <i class="uil uil-eye position-absolute toggle-password"></i> --}}
                                                </div>
                                            </div>


                                            <div class="mb-3 mt-4">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" name="checkbox">
                                                    <p class="form-check-label user-team" for="checkbox-signin">I accept the Mysmartaudio <a href="{{ url('user/terms-of-use') }}" class="user-form-check" target="_blank">User Agreement</a> and have read the <a href="{{ url('user/privacy-policy') }}" class="user-form-check" target="_blank">Privacy Statement</a>.</p>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            
                                            <div class="mb-3 mt-3 text-center d-grid">
                                                <button class="btn btn-primary" type="submit">Sign Up</button>
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
                                                I Already Have an Account <a href="{{ route('user.login') }}" class="sign-up ms-1">Sign In</a>
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
                                <p class="text-muted">Already have account? <a href="pages-login.html" class="text-primary fw-bold ms-1">Login</a></p>
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
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

        <script src="{{ asset('assets/js/mask.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#phone').mask('(999) 999-9999');

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                @endif

                $('#password').on('input', function() {
                    var password = $(this).val();

                    if(password.length >= 8){

                        $('#password').css("border-color", "green");
                    }else{
                        $('#password').css("border-color", "red");
                    }
                });

                $('#password_confirmation').on('input', function() {
                    var password_confirmation = $(this).val();

                    if(password_confirmation.length >= 8){

                        $('#password_confirmation').css("border-color", "green");
                    }else{
                        $('#password_confirmation').css("border-color", "red");
                    }
                });

                $('.toggle-password').on('click', function() {

                    var input = $(this).siblings('input');

                    var type = input.attr('type') === 'password' ? 'text' : 'password';

                    input.attr('type', type);

                    $(this).toggleClass('uil-eye uil-eye-slash');
                });

                var $form = $('#authentication-form');
                var $checkbox = $('#checkbox-signin');

                $form.on('submit', function(e) {
                    if(!$checkbox.is(':checked')) {
                        alert('Accept the Mysmartaudio User Agreement and have read the Privacy Statement.');
                        e.preventDefault();
                    }
                });

            });
        </script>
        
    </body>
</html>