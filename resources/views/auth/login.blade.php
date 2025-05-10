<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login</title>
    <!-- plugins:css -->
    <link href="{{ asset('admin') }}/assets/vendors/mdi/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/vendors/css/vendor.bundle.base.css" rel="stylesheet">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link href="{{ asset('admin') }}/assets/css/style.css" rel="stylesheet">
    <!-- End layout styles -->
    <link href="{{ asset('admin') }}/assets/images/favicon.png" rel="shortcut icon" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <h2>LOGIN</h2>
                                {{-- <img src="{{ asset('catalyst-logo.png') }}"> --}}
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form accept="{{ route('login.post') }}" class="pt-3" method="post">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control form-control-lg" id="email" name="email"
                                        placeholder="Email" type="email">
                                </div>
                                <div class="form-group">
                                    <input class="form-control form-control-lg" id="password" name="password"
                                        placeholder="Password" type="password">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        SIGN IN
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('admin') }}/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin') }}/assets/js/off-canvas.js"></script>
    <script src="{{ asset('admin') }}/assets/js/hoverable-collapse.js"></script>
    <script src="{{ asset('admin') }}/assets/js/misc.js"></script>
    <!-- endinject -->
</body>

</html>
