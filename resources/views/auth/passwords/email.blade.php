<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="Bootstrap Admin App" />
        <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin" />
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <title>{{ config('app.name') }}</title>
        <!-- =============== VENDOR STYLES ===============-->
        <!-- FONT AWESOME-->
        <link rel="stylesheet" href="{{ url('assets/vendor/fortawesome/fontawesome-free/css/brands.css') }}" />
        <link rel="stylesheet" href="{{ url('assets/vendor/fortawesome/fontawesome-free/css/regular.css') }}" />
        <link rel="stylesheet" href="{{ url('assets/vendor/fortawesome/fontawesome-free/css/solid.css') }}" />
        <link rel="stylesheet" href="{{ url('assets/vendor/fortawesome/fontawesome-free/css/fontawesome.css') }}" />
        <!-- SIMPLE LINE ICONS-->
        <link rel="stylesheet" href="{{ url('assets/vendor/simple-line-icons/css/simple-line-icons.css') }}" />
        <!-- =============== BOOTSTRAP STYLES ===============-->
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}" id="bscss" />
        <!-- =============== APP STYLES ===============-->
        <link rel="stylesheet" href="{{ url('assets/css/app.css') }}" id="maincss" />
        <style>
        .show {
            display: block !important;
        }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="block-center mt-4 wd-xl" style="margin-top: 100px !important">
                @if (session('status'))
                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                @endif
                <!-- START card-->
                <div class="card card-flat">
                    <div class="card-header text-center bg-dark">
                        <a href="#"><img class="block-center rounded" src="{{ url('assets/img/logo.png') }}" alt="Image" /></a>
                    </div>
                    <div class="card-body">
                        <p class="text-center py-2">{{ __('Reset Password') }}</p>
                        <form class="mb-3 needs-validation" id="loginForm" action="{{ route('password.email') }}" method="POST" novalidate>
                            @csrf
                            <div class="form-group">
                                <div class="input-group with-focus">
                                    <input class="form-control border-right-0" id="email" name="email" type="email" placeholder="Enter email" autocomplete="off" required />
                                    <div class="input-group-append">
                                        <span class="input-group-text text-muted bg-transparent border-left-0"><em class="fa fa-envelope"></em></span>
                                    </div>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback show" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="btn btn-block btn-primary mt-3" type="submit">{{ __('Send Password Reset Link') }}</button>
                        </form>
                    </div>
                </div>
                <!-- END card-->
                <div class="p-3 text-center">
                    <span class="mr-2">&copy;</span><span>{{ date('Y') }}</span><span class="mr-2">-</span><span>{{ config('app.name') }}</span>
                </div>
            </div>
        </div>
        <!-- =============== VENDOR SCRIPTS ===============-->
        <!-- MODERNIZR-->
        <script src="{{ url('assets/vendor/modernizr/modernizr.custom.js') }}"></script>
        <!-- STORAGE API-->
        <script src="{{ url('assets/vendor/js-storage/js.storage.js') }}"></script>
        <!-- i18next-->
        <script src="{{ url('assets/vendor/i18next/i18next.js') }}"></script>
        <script src="{{ url('assets/vendor/i18next-xhr-backend/i18nextXHRBackend.js') }}"></script>
        <!-- JQUERY-->
        <script src="{{ url('assets/vendor/jquery/dist/jquery.js') }}"></script>
        <!-- BOOTSTRAP-->
        <script src="{{ url('assets/vendor/popper.js/dist/umd/popper.js') }}"></script>
        <script src="{{ url('assets/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
        <!-- =============== APP SCRIPTS ===============-->
        <script src="{{ url('assets/js/app.js') }}"></script>
    </body>
</html>