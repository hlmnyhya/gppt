<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GPPT | BANJARBARU</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url();?>assets2/img/mpp_icon.png" rel="icon">
  <link href="<?= base_url();?>assets2/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url();?>assets2/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= base_url();?>assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url();?>assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url();?>assets2/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url();?>assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= base_url();?>assets2/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url();?>assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url();?>assets2/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bootslander
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

   <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="<?= base_url('')?>"><span>GERAI PELAYANAN PUBLIK</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang GPPT</a></li>
          <li><a class="nav-link scrollto" href="#features">Instansi</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Galeri</a></li>
          <li><a class="nav-link scrollto" href="#team">Berita</a></li>
          <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs Section -->

<section class="inner-page">
    <div class="container">
        <?php $isFirst = true; // Variable to track whether it's the first iteration ?>

        <?php foreach ($layanan as $data_instansi) : ?>
            <?php if ($isFirst) : // Check if it's the first iteration ?>
                <center>
                    <h1 class="mb-1"><?= $data_instansi['nama_layanan']; ?></h1>
                    <h4>Daftar Layanan</h4>
                </center>
                <?php $isFirst = false; // Set to false after the first iteration ?>
            <?php endif; ?>
        <?php endforeach; ?>

        <div class="row" data-aos="fade-left">
            <?php foreach ($layanan as $user) : ?>
                <?php if (isset($user['gambar_layanan_detail'])) : ?>
                    <div class="col-lg-3 col-md-4 mt-4">
                        <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
                            <a href="<?= base_url('detail_layanan_detail/' . $user['id_layanan_detail']); ?>">
                                <center>
                                    <?php if ($user['gambar_layanan_detail'] !== null) : ?>
                                        <img src="<?php echo base_url('./uploads/layanan_detail/' . $user['gambar_layanan_detail']); ?>" class="card-img-top" alt="Gambar Instansi" height="200px">
                                    <?php else : ?>
                                        <!-- Handle case where 'gambar_layanan_detail' is null -->
                                        <p>Layanan Tidak Tersedia</p>
                                    <?php endif; ?>
                                    <div class="card-body mt-5">
                                        <h5 class="card-title"><a href="#"><span><?php echo $user['nama_layanan_detail']; ?></span></a></h5>
                                    </div>
                                </center>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>






  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>GPPT Kota Banjarbaru</span></strong>. All Rights Reserved
      </div>
      <div class="credits"></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url();?>assets2/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url();?>assets2/vendor/aos/aos.js"></script>
  <script src="<?= base_url();?>assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url();?>assets2/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url();?>assets2/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url();?>assets2/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url();?>assets2/js/main.js"></script>

</body>

</html>