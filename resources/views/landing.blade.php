<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Web</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('web') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('web') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('web') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('web') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('web') }}/assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: eNno
  * Template URL: https://bootstrapmade.com/enno-free-simple-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header class="header d-flex align-items-center sticky-top" id="header">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a class="logo d-flex align-items-center me-auto" href="index.html">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img alt="" src="assets/img/logo.png"> -->
                <h1 class="sitename">Koperasi Desa Langgeng</h1>
            </a>

            <nav class="navmenu" id="navmenu">
                <ul>
                    <li><a class="active" href="#hero">Home</a></li>
                    <li><a href="#about">Tentang</a></li>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section class="hero section" id="hero">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="fade-up">
                        <h1>Koperasi Produsen Unit Desa Langgeng</h1>
                        <p>Marsawa Kecamatan Sentajo Raya Kabupaten Kuantan Singingi</p>

                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos-delay="100" data-aos="zoom-out">
                        <img alt="" class="img-fluid animated" src="{{ asset('IMG_8999.JPG') }}">
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Featured Services Section -->
        <section class="featured-services section" id="featured-services">
            @php
                $pengumumaan = \App\Models\Pengumuman::orderBy('id', 'desc')->first();
            @endphp
            <div class="container">

                <div class="row gy-4">

                    <h2>Pengumuman Terbaru</h2>
                    <h4>{{ $pengumumaan->judul }}</h4>
                    <div><span>{{ $pengumumaan->created_at }}</span></div>
                    <div class="card p-2">
                        <p>
                            {!! $pengumumaan->isi !!}
                        </p>
                    </div>
                </div>

            </div>

        </section><!-- /Featured Services Section -->

        <!-- About Section -->
        <section class="about section" id="about">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Tentang<br></span>
                <h2>Tentang</h2>
                <p>Tentang Koperasi Produsen Unit Desa Langgeng</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6 position-relative align-self-start" data-aos-delay="100" data-aos="fade-up">
                        <img alt="" class="img-fluid" src="assets/img/about.png">
                        <a class="glightbox pulsating-play-btn" href="https://www.youtube.com/watch?v=Y7f98aduVJ8"></a>
                    </div>
                    <div class="col-lg-6 content" data-aos-delay="200" data-aos="fade-up">
                        <h3>Sejarah</h3>
                        <p class="fst-italic">
                            Koperasi Produsen Unit Desa Langgeng berdiri pada tahun 1980. Berdirinya Koperasi Produsen
                            Unit Desa Langgeng dilatarbelakangi oleh kondisi perekonomian masyarakat transmigrasi pada
                            waktu itu yang belum stabil dan penduduknya yang berasal dari berbagai daerah dengan adat
                            istiadat yang berbeda-beda. Menyadari bahwa masyarakat transmigrasi tidak seharusnya
                            menggantungkan harapan hidupnya untuk memperoleh kebutuhan sehari-hari dari bantuan
                            pemerintah, maka masyarakat berinisiatif membentuk suatu Lembaga perekonomian pedesaan yang
                            berbentuk koperasi. Melalui koperasi itulah masyarakat diharapkan dapat memperoleh manfaat
                            yang lebih besar terutama dalam memenuhi kebutuhan sehari-hari. Selain itu, diharapkan
                            kemampuan ekonomi masyarakat pedesaan dapat semakin meningkat

                        </p>
                        <h3>Visi & Misi</h3>
                        <p>
                            <strong> Menjadi Koperasi Mandiri yang dapat mensejahterakan anggota dan masyarakat
                                sekitarnya</strong>
                        </p>
                        <ul>
                            <li>Melaksanakan ketentuan-ketentuan pemerintah dalam menunjang perekonomian masyarakat
                                pedesaan</li>
                            <li>Memfasilitasi anggota dalam memperoleh keuntungan pribadi</li>
                            <li>Menghindari tengkulak-tengkulak yang bertujuan untuk memperoleh keuntungan pribadi</li>
                            <li>Menjaga kestabilan harga dan kondisi perekonomian masyarakat anggota</li>
                            <li>Membantu pemasaran hasil produksi milik anggota</li>
                        </ul>

                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Portfolio Section -->
        <section class="portfolio section" id="portfolio">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Kegiatan Koperasi</span>
                <h2>Kegiatan Koperasi</h2>
                <p>
                    Kegiatan Koperasi Produsen Unit Desa Langgeng meliputi berbagai macam usaha yang bertujuan untuk
                    meningkatkan kesejahteraan anggota dan masyarakat sekitar. Beberapa kegiatan tersebut antara lain
                    adalah pengadaan barang kebutuhan pokok, penjualan hasil pertanian, dan penyediaan layanan simpan
                    pinjam bagi anggota koperasi.
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos-delay="100" data-aos="fade-up">
                        <li class="filter-active" data-filter="*">-</li>
                    </ul><!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos-delay="200" data-aos="fade-up">
                        @foreach ($listKegiatan as $item)
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
                                <img alt="" class="img-fluid" src="{{ asset('img-kegiatan/' . $item) }}">
                                <div class="portfolio-info">
                                    <h4>Kegiatan</h4>
                                    <a class="glightbox preview-link" data-gallery="portfolio-gallery-app"
                                        href="{{ asset('web/assets/img/portfolio/app-1.jpg') }}" title="App 1"><i
                                            class="bi bi-zoom-in"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- End Portfolio Container -->
                </div>
            </div>
        </section><!-- /Portfolio Section -->


        <section class="portfolio section" id="portfolio">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <span>Struktur Organisasi</span>
                <h2>Struktur Organisasi</h2>

            </div><!-- End Section Title -->

            <div class="container">
                <img alt="" src="{{ asset('struktur.png') }}" style="width: 100%">
            </div>
        </section>
    </main>

    <footer class="footer" id="footer">

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">.</strong> <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">...</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a class="scroll-top d-flex align-items-center justify-content-center" href="#" id="scroll-top"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('web') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('web') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="{{ asset('web') }}/assets/js/main.js"></script>

</body>

</html>
