<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <title>...</title>
    <!-- plugins:css -->
    <link href="{{ asset('admin') }}/assets/vendors/mdi/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/vendors/css/vendor.bundle.base.css" rel="stylesheet">
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        referrerpolicy="no-referrer" rel="stylesheet" />
    <link href="{{ asset('css/mermaid.min.css') }}" rel="stylesheet">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link href="{{ asset('admin') }}/assets/css/style.css" rel="stylesheet">
    <!-- End layout styles -->
    <link href="{{ asset('admin') }}/assets/images/favicon.png" rel="shortcut icon" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        .poppins-thin {
            font-family: "Poppins", sans-serif;
            font-weight: 100;
            font-style: normal;
        }

        .poppins-extralight {
            font-family: "Poppins", sans-serif;
            font-weight: 200;
            font-style: normal;
        }

        .poppins-light {
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        .poppins-regular {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .poppins-medium {
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        .poppins-semibold {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-style: normal;
        }

        .poppins-bold {
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        .poppins-extrabold {
            font-family: "Poppins", sans-serif;
            font-weight: 800;
            font-style: normal;
        }

        .poppins-black {
            font-family: "Poppins", sans-serif;
            font-weight: 900;
            font-style: normal;
        }

        .poppins-thin-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 100;
            font-style: italic;
        }

        .poppins-extralight-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 200;
            font-style: italic;
        }

        .poppins-light-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: italic;
        }

        .poppins-regular-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: italic;
        }

        .poppins-medium-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            font-style: italic;
        }

        .poppins-semibold-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-style: italic;
        }

        .poppins-bold-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            font-style: italic;
        }

        .poppins-extrabold-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 800;
            font-style: italic;
        }

        .poppins-black-italic {
            font-family: "Poppins", sans-serif;
            font-weight: 900;
            font-style: italic;
        }

        .main-panel {
            font-family: "Poppins", sans-serif !important;
        }

        .form-control {
            height: 0px;
            border: 1px solid #000;
        }

        select.form-control {
            height: 35px;
            border: 1px solid #000;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        input::placeholder,
        textarea::placeholder {
            color: #6c757d !important;
            /* abu-abu elegan */
            opacity: 1 !important;
            /* 1 = 100% terlihat */
            font-weight: 500 !important;
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    @stack('style')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="topbar navbar default-layout-navbar bg-gray-200 col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="../../index.html"><img alt="logo"
                        src="{{ asset('admin') }}/assets/images/logo.svg" /></a>
                <a class="navbar-brand brand-logo-mini" href="../../index.html"><img alt="logo"
                        src="{{ asset('admin') }}/assets/images/logo-mini.svg" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" data-toggle="minimize" type="button">
                    <span class="mdi mdi-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">

                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" data-toggle="offcanvas"
                    id="navbar-toggler-sidebar" type="button">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-category">Main</li>

                    {{-- Dashboard - semua role --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.index') }}">
                            <span class="icon-bg"><i class="mdi mdi-view-dashboard menu-icon"></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    {{-- Menu untuk ADMIN --}}
                    @if (auth()->user()->role == 'admin')
                        <li class="nav-item nav-category">Manajemen</li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('unit_usaha.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-domain menu-icon"></i></span>
                                <span class="menu-title">Unit Usaha</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kategori_usaha.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-folder-multiple menu-icon"></i></span>
                                <span class="menu-title">Kategori Usaha</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('produk_unit.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-cube-outline menu-icon"></i></span>
                                <span class="menu-title">Produk Unit</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-file-document-box menu-icon"></i></span>
                                <span class="menu-title">Laporan Masuk</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.rekapitulasi') }}">
                                <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
                                <span class="menu-title">Rekapitulasi</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengumuman.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-bullhorn menu-icon"></i></span>
                                <span class="menu-title">Pengumuman</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('log-activity.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-history menu-icon"></i></span>
                                <span class="menu-title">Log Aktivitas</span>
                            </a>
                        </li>
                    @endif

                    {{-- Menu untuk UNIT --}}
                    @if (auth()->user()->role == 'unit')
                        <li class="nav-item nav-category">Unit Usaha</li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('produk_saya.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                                <span class="menu-title">Produk Saya</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan-me.index') }}">
                                <span class="icon-bg"><i class="mdi mdi-file-chart menu-icon"></i></span>
                                <span class="menu-title">Laporan Saya</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pengumuman.show') }}">
                                <span class="icon-bg"><i class="mdi mdi-bullhorn menu-icon"></i></span>
                                <span class="menu-title">Pengumuman</span>
                            </a>
                        </li>
                    @endif

                    {{-- Setting - semua role --}}
                    <li class="nav-item nav-category">Pengaturan</li>
                    @if (auth()->user()->role == 'unit')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.data') }}">
                                <span class="icon-bg">
                                    <i class="fa fa-user"></i>
                                </span>
                                <span class="menu-title">User</span>
                            </a>
                        </li>
                    @endif
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="icon-bg"><i class="mdi mdi-account-settings menu-icon"></i></span>
                            <span class="menu-title">Profil Saya</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="icon-bg"><i class="mdi mdi-logout menu-icon"></i></span>
                            <span class="menu-title">Keluar</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper !p-1 flex flex-1">
                    @yield('content')
                </div>

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('admin') }}/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('admin') }}/assets/js/off-canvas.js"></script>
    <script src="{{ asset('admin') }}/assets/js/hoverable-collapse.js"></script>
    <script src="{{ asset('admin') }}/assets/js/misc.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.8/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/gridjs.umd.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('js/table.js') }}"></script>
    <script>
        function formatRupiah(angka, prefix = 'Rp') {
            let numberString = angka.toString().replace(/[^,\d]/g, '');
            let split = numberString.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix ? prefix + ' ' + rupiah : rupiah;
        }

        function deleted(url) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(url)
                        .then((result) => {
                            toastr.success("Template berhasil dibuat!");
                            window.location.reload();
                        }).catch((err) => {
                            const errorMessage = err.response?.data?.message || "Gagal membuat template!";
                            toastr.error(errorMessage);
                        });
                }
            });
        }
    </script>
    @stack('script')
</body>

</html>
