<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login Dashboard Owner Backoffice">
    <meta name="author" content="Login Dashboard Owner">
    <title>Login Dashboard Owner</title>
    <!-- Favicon -->
    <link href="/assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="/assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body class="bg-grey">
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-default py-6 py-lg-6">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">

                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            @include('components.alert')
                            <form role="form" action="{{ route('authenticate') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                        </div>
                                        <input class="form-control" name="phone" placeholder="Telepon" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                        </div>
                                        <input class="form-control" name="password" placeholder="Password" type="password">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary my-4" value="Masuk"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-12">
                    <div class="copyright text-center text-xl-center text-muted">
                        &copy; {{ date('Y') }} <a href="javascript:;" class="font-weight-bold ml-1" target="_blank">Login Dashboard Owner</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="/assets/js/argon.js?v=1.0.0"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>
