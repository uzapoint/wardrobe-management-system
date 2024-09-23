<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="" data-template="vertical-menu-template">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title> {{ env('APP_NAME') }} </title>

        
        <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
        <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
        <!-- Canonical SEO -->
        <link rel="canonical" href="https://1.envato.market/vuexy_admin">
        
        <!-- Favicon -->
        <!-- <link rel="icon" type="image/x-icon" href="https://demos.pixinvent.com/vuexy-html-admin-template/assets/img/favicon/favicon.ico" /> -->

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com/">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

        <!-- Icons -->
        <link rel="stylesheet" href="{{ url('portal/vendor/fonts/fontawesome.css') }}" />
        <link rel="stylesheet" href="{{ url('portal/vendor/fonts/tabler-icons.css') }}"/>
        <link rel="stylesheet" href="{{ url('portal/vendor/fonts/flag-icons.css') }}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ url('portal/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ url('portal/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ url('portal/css/demo.css') }}" />
        
        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ url('portal/vendor/libs/node-waves/node-waves.css') }}" />
        <link rel="stylesheet" href="{{ url('portal/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link rel="stylesheet" href="{{ url('portal/vendor/libs/typeahead-js/typeahead.css') }}" /> 
        <!-- Vendor -->
        <link rel="stylesheet" href="{{ url('portal/vendor/libs/form-validation/form-validation.css') }}" />

        <!-- Page CSS -->
        <!-- Page -->
        <link rel="stylesheet" href="{{ url('portal/vendor/css/pages/page-auth.css') }}">    
    </head>

    <body>

        <div class="authentication-wrapper authentication-cover authentication-bg">
            <div class="authentication-inner row">
                <!-- /Left Text -->
                <div class="d-none d-lg-flex col-lg-7 p-0">
                    <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                        <img src="{{ url('portal/img/illustrations/bulb-light.png') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="{{ url('portal/illustrations/bulb-light.png') }}" data-app-dark-img="illustrations/auth-login-illustration-dark.html">

                        <img src="{{ url('portal/img/illustrations/bg-shape-image-light.png') }}" alt="auth-login-cover" class="platform-bg" data-app-light-img="{{ url('portal/illustrations/bg-shape-image-light.png') }}" data-app-dark-img="illustrations/bg-shape-image-dark.html">
                    </div>
                </div>

                <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                    <div class="w-px-400 mx-auto">
                        <!-- <div class="app-brand mb-4">
                            <a href="index.html" class="app-brand-link gap-2"> <span class="app-brand-logo demo"> <img src="{{ url('portal/img/logo.png') }}"> </span> </a>
                        </div> -->

                        <h3 class="mb-1"> Welcome to {{ env('APP_NAME') }}! 👋</h3>
                        <p class="mb-4"> Please sign-up to your account and start the adventure </p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="first name" class="form-label"> Username </label>

                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">  Phone </label>

                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label"> Email address </label>

                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between"> <label class="form-label" for="password">Password</label> </div>

                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <span class="input-group-text cursor-pointer" onclick="togglePassword('password', this)">
                                        <i class="ti ti-eye-off"></i>
                                    </span>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between"> <label class="form-label" for="password_confirmation"> Confirm Password </label> </div>

                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <span class="input-group-text cursor-pointer" onclick="togglePassword('password_confirmation', this)">
                                        <i class="ti ti-eye-off"></i>
                                    </span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary d-grid w-100"> Sign up </button>
                        </form>

                        <p class="text-center">
                            <span> Already have an account? </span>
                            <a href="{{ route('login') }}"> <span> Login</span> </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ url('portal/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ url('portal/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/node-waves/node-waves.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/hammer/hammer.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/i18n/i18n.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/typeahead-js/typeahead.js') }}"></script>
        <script src="{{ url('portal/vendor/js/menu.js') }}"></script>
      
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ url('portal/vendor/libs/%40form-validation/popular.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/%40form-validation/bootstrap5.js') }}"></script>
        <script src="{{ url('portal/vendor/libs/%40form-validation/auto-focus.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ url('portal/js/main.js') }}"></script>
      

        <!-- Page JS -->
        <script src="{{ url('portal/js/pages-auth.js') }}"></script>

        <script type="text/javascript">
            function togglePassword(fieldId, icon) 
            {
                var passwordField = document.getElementById(fieldId);
                var iconElement = icon.querySelector('i');
                
                // Toggle the password field type
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    iconElement.classList.remove('ti-eye-off');
                    iconElement.classList.add('ti-eye');
                } else {
                    passwordField.type = 'password';
                    iconElement.classList.remove('ti-eye');
                    iconElement.classList.add('ti-eye-off');
                }
            }
        </script>
    </body>
</html>


