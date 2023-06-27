<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <!-- ANIMATE.CSS-->
    <link rel="stylesheet" href="{{ url('assets/vendor/animate.css/animate.css') }}" />
    <!-- WHIRL (spinners)-->
    <link rel="stylesheet" href="{{ url('assets/vendor/whirl/dist/whirl.css') }}" />
    <!-- =============== PAGE VENDOR STYLES ===============-->
    <!-- WEATHER ICONS-->
    <link rel="stylesheet" href="{{ url('assets/vendor/weather-icons/css/weather-icons.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/vendor/animate.css/animate.css') }}"><!-- WHIRL (spinners)-->
    <link rel="stylesheet" href="{{ url('assets/vendor/whirl/dist/whirl.css') }}">
    @yield('page-css')
    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}" id="bscss" />
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}" id="maincss" />
</head>
<body>
    <div class="wrapper">
        @include('layouts.components.navbar')
        @include('layouts.components.sidebar')
        <!-- Main section-->
        <section class="section-container">
            <!-- Page content-->
            <div class="content-wrapper">
                <div class="content-heading">
                    <div>{{ $page['name'] }}<small data-localize="dashboard.WELCOME"></small></div>
                </div>
                @yield('content')
            </div>
        </section>
        <!-- Page footer-->
        <footer class="footer-container"><span>&copy; {{ date('Y') }} - {{ config('app.name') }}</span></footer>
    </div>
    <!-- =============== VENDOR SCRIPTS ===============-->
    <!-- MODERNIZR-->
    <script src="{{ url('assets/vendor/modernizr/modernizr.custom.js') }}"></script>
    <!-- STORAGE API-->
    <script src="{{ url('assets/vendor/js-storage/js.storage.js') }}"></script>
    <!-- SCREENFULL-->
    <script src="{{ url('assets/vendor/screenfull/dist/screenfull.js') }}"></script>
    <!-- i18next-->
    <script src="{{ url('assets/vendor/i18next/i18next.js') }}"></script>
    <script src="{{ url('assets/vendor/i18next-xhr-backend/i18nextXHRBackend.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery/dist/jquery.js') }}"></script>
    <script src="{{ url('assets/vendor/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <!-- SPARKLINE-->
    <script src="{{ url('assets/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
    <!-- FLOT CHART-->
    <script src="{{ url('assets/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery.flot.tooltip/js/jquery.flot.tooltip.js') }}"></script>
    <script src="{{ url('assets/vendor/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ url('assets/vendor/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ url('assets/vendor/flot/jquery.flot.time.js') }}"></script>
    <script src="{{ url('assets/vendor/flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ url('assets/vendor/jquery.flot.spline/jquery.flot.spline.js') }}"></script>
    <!-- EASY PIE CHART-->
    <script src="{{ url('assets/vendor/easy-pie-chart/dist/jquery.easypiechart.js') }}"></script>
    <!-- MOMENT JS-->
    <script src="{{ url('assets/vendor/moment/min/moment-with-locales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    @yield('page-js')
    <!-- =============== APP SCRIPTS ===============-->
    <script src="{{ url('assets/vendor/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ url('assets/js/app.js') }}"></script>
    @if (Session::has('success'))
    <script>
        swal("Great!", "{{ Session::get('success') }}", "success");
    </script>
    @endif
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
</body>
    
</html>
