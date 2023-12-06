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
  <style>
    .inner-page {
        padding: 50px 0;
    }

    .nav-tabs {
        margin-bottom: 20px;
    }

    .nav-tabs .nav-item {
        margin-bottom: 0;
    }

    .nav-tabs .nav-link {
        color: #333;
        border: 1px solid #ddd;
        border-radius: 4px 4px 0 0;
        background-color: #f8f9fa;
    }

    .nav-tabs .nav-link.active {
        background-color: #01148C;
        color: #fff;
        border-color: #040B86;
    }

    .tab-content {
        border: 1px solid #ddd;
        border-radius: 0 4px 4px 4px;
        padding: 15px;
    }
     .custom-tabs .nav-item {
        flex: 1; /* Adjust the width as needed */
        text-align: center; /* Optional: Center-align the text */
    }

</style>

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
          <li><a class="nav-link scrollto" href="<?= base_url('antrian/masyarakat')?>">Ambil Antrian</a></li>
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



<section class="inner-page mb-5">
    <div class="container mb-5">
        <?php $isFirst = true; // Variable to track whether it's the first iteration ?>

        <?php foreach ($layanandetail as $data_instansi) : ?>
            <?php if ($isFirst) : // Check if it's the first iteration ?>
                <center>
                    <h1 class="mb-1"><?= $data_instansi['nama_layanan_detail']; ?></h1>
                    <h4 class="mb-5">Daftar Layanan</h4>
                </center>
                <?php $isFirst = false; // Set to false after the first iteration ?>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Bootstrap Nav Tabs -->
        <ul class="nav nav-tabs custom-tabs" id="myTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#tab0">Syarat</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <div class="tab-content">
             <div class="tab-pane fade show active" id="tab0">
    <?php foreach ($syarat as $index => $data_syarat) : ?>
        <?php if (isset($data_syarat['syarat'])) : ?>
            <ul>
                <?php
                // Explode the 'syarat' string into an array
                $syarat_items = explode('<br>', $data_syarat['syarat']);
                
                // Iterate over each item and display it in a list
                foreach ($syarat_items as $syarat_item) {
                    echo '<li>' . $syarat_item . '</li>';
                }
                ?>
            </ul>
        <?php else : ?>
            <p>No data available for Syarat</p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
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