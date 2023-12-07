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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


  <!-- =======================================================
  * Template Name: Bootslander
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    .center-text {
        text-align: center;
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
          <li><a class="nav-link scrollto" href="<?= base_url('')?>">Beranda</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('')?>">Tentang GPPT</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('')?>">Instansi</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('')?>">Galeri</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('')?>">Berita</a></li>
          <li><a class="nav-link scrollto" href="<?= base_url('')?>">Kontak</a></li>
          <li class="dropdown"><a href="#"><span>Cetak Mandiri</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="<?= base_url('blanko')?>">Cetak Form Pendaftaran</a></li>
              <!-- <li><a href="#">Drop Down 2</a></li> -->
            </ul>
          </li>
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
          <!-- <h2>Inner Page</h2>
          <ol>
            <li><a href="index.html">Home</a></li>
            <li>Inner Page</li>
          </ol> -->
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs Section -->

<section class="inner-page">
    <div class="container">
         <div class="section-title" data-aos="fade-up">
            <h2>Blanko</h2>
            <p>Download Berkas</p>
        </div>
                        <div class="table-responsive text-dark">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Blanko</th>
                                        <th>Keterangan</th>
                                        <th style="text-align: center;">File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($blanko as $user): ?>
                                        <tr>
                                          <td><?php echo $no++ ?></td>
                                          <td><?php echo $user->nama_blanko; ?></td>
                                          <td><?php echo $user->keterangan; ?></td>
                                         <td>
    <?php
    $file_path = base_url('uploads/blanko/' . $user->file);
    echo '<center><a href="' . $file_path . '" class="btn btn-success" download><i class="fa fa-download"></i> Unduh File</a></center>';
    ?>
</td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <!-- Template Main JS File -->
  <script src="<?= base_url();?>assets2/js/main.js"></script>
  <script>
    new DataTable('#example');
  </script>

</body>

</html>