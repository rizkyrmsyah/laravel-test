<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dashboard Owner">
    <meta name="author" content="Pasar Modern">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Dashboard Owner</title>
    <!-- Favicon -->
    <link rel="icon" href="/assets/img/brand/favicon.png" type="'image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="/assets/css/main.css" type="text/css">

    @stack('styles-vendor')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

    <link rel="stylesheet" type="text/css" href="/assets/vendor/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/vendor/datatables/css/responsive.bootstrap4.min.css" />
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="/assets/vendor/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/vendor/select2/css/select2-bootstrap4.min.css" />

    <!-- Include the CSS file to use the plugin default themes and loaders -->
    <link rel="stylesheet" type="text/css" href="/assets/vendor/jquery-loading/jquery.loading.css">

    <style type="text/css">
        .swal-title {
            font-size: 18px;
            font-weight: 600;
            text-align: center;
        }

        .swal-text {
            text-align: center;
        }
        #chatBtn {
            position: fixed;
            bottom: 10px;
            right: 10px;
        }

    </style>
    @stack('styles')
</head>

<body>
    <!-- Sidenav -->
    @hasSection('sidebar')
        @include('components.sidebar')
    @endif
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        @hasSection('navbar')
            @include('components.navbar')
        @endif

        @yield('content')

    </div>

    @stack('scripts-vendor')
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="/assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="/assets/vendor/chart.js/dist/Chart.extension.js"></script>

    <script type="text/javascript" src="/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="/assets/vendor/datatables/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="/assets/vendor/datatables/js/responsive.bootstrap4.min.js"></script>

    <!-- Argon JS -->
    <script src="/assets/js/argon.js?v=1.2.0"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/assets/vendor/select2/js/select2.min.js"></script>

    <script type="text/javascript" src="/assets/vendor/jquery-loading/jquery.loading.js"></script>

    @stack('scripts')

</body>

</html>
