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
          
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs Section -->

<!-- ======= Pricing Section ======= -->
   <section id="pricing" class="features">
    <div class="container">

        <div class="section-title" data-aos="fade-up">
            <h2>Antrian</h2>
            <p>Anjungan Antrian Gerai Pelayanan Publik Terpadu</p>
        </div>

      <div class="row" data-aos="fade-left">
    <?php foreach ($instansi as $user): ?>
        <?php 
            // Get the last nomor_antrian and saved date from the database
            $this->db->select('nomor_antrian, tanggal');
            $this->db->from('antrian');
            $this->db->where('id_instansi', $user->id_instansi);
            $this->db->order_by('id_antrian', 'desc');
            $this->db->limit(1);

            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $row = $query->row();
          $last_nomor_antrian = $row->nomor_antrian;
$three_last_digits = substr($last_nomor_antrian, -3);

// Konversi tiga digit terakhir menjadi angka
$last_number = (int)$three_last_digits;

// Tambahkan satu ke nomor terakhir
$new_number = $last_number + 1;

// Format ulang nomor baru ke dalam tiga digit
$new_three_digits = str_pad($new_number, 3, '0', STR_PAD_LEFT);


                $saved_date = $row->tanggal;

                // Check if 24 hours have passed since the saved date
                $current_date = new DateTime();
                $saved_date = new DateTime($saved_date);

                $interval = $current_date->diff($saved_date);

                if ($interval->h >= 24) {
                    // If 24 hours have passed, reset nomor_antrian to 1
                    $nomor_antrian = 1;
                } else {
                    // Increment the last nomor_antrian to get the next value
                    $nomor_antrian = intval(substr($last_nomor_antrian, 1)) + 1;
                }
            } else {
                // If no rows are returned, set default values
                $nomor_antrian = 1;
            }

            // Retrieve the entry count grouped by tanggal
            $this->db->select('COUNT(*) as entry_count');
            $this->db->from('antrian');
            $this->db->where('id_instansi', $user->id_instansi);
            $this->db->group_by('tanggal'); // Group by tanggal
            $entry_query = $this->db->get();
            $entry_count = $entry_query->num_rows() > 0 ? $entry_query->num_rows() : 0;

            // Generate the formatted nomor_antrian (e.g., A001)
            $formatted_nomor_antrian = $user->kode . '00' . $nomor_antrian;

        ?>
        <div class="col-lg-3 col-md-4 mt-4 card-container" 
             data-id="<?= $user->id_instansi; ?>"
             data-nama-instansi="<?= $user->nama_instansi; ?>"
             data-loket="<?= $user->kode; ?>"
             data-nomor-antrian="<?= $formatted_nomor_antrian; ?>"
             data-gambar="<?= $user->gambar_instansi;?>"
             data-sisa="<?= $entry_count;?>">
            <a href="#" class="antrian-link">
                <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
                    <img src="<?= base_url('./uploads/instansi/'.$user->gambar_instansi); ?>" width="80px" height="100px" alt="Gambar Instansi">
                    <h3><?= $user->nama_instansi; ?></h3>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>









    </div>
</section>

	<!-- End Pricing Section -->






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

  <!-- Include SweetAlert library (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!-- Vendor JS Files -->
  <script src="<?= base_url();?>assets2/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= base_url();?>assets2/vendor/aos/aos.js"></script>
  <script src="<?= base_url();?>assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url();?>assets2/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url();?>assets2/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= base_url();?>assets2/vendor/php-email-form/validate.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url();?>assets2/js/main.js"></script>
  
  <script>
    $(document).ready(function () {
        // Use delegated event handling to handle dynamically added elements
        $('.row').on('click', '.card-container a', function (e) {
            e.preventDefault();

            // Get the data attributes from the clicked card
            var id_instansi = $(this).closest('.card-container').data('id');
            var loket = $(this).closest('.card-container').data('loket');
            var nomor_antrian = $(this).closest('.card-container').data('nomor-antrian');
            var nama_instansi = $(this).closest('.card-container').data('nama-instansi');
            var gambar = $(this).closest('.card-container').data('gambar');
            var sisa = $(this).closest('.card-container').data('sisa');

            // Make an AJAX request to the controller
            $.ajax({
                type: 'POST',
                url: 'tambah_data', // Update the URL to the correct controller method
                data: {
                    id_instansi: id_instansi,
                    loket: loket,
                    nomor_antrian: nomor_antrian,
                    status_antrian: 'Menunggu' // You need to set the appropriate status value
                },
                success: function (response) {
                    // Handle the success response if needed
                    console.log(response);

                    // Display SweetAlert after a successful AJAX request
                    var formattedDate = new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                    var formattedTime = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });

                    Swal.fire({
                        title: 'Nomor Antrian Anda',
                       html: '<center><img src="<?= base_url('./uploads/instansi/') ?>' + gambar + '" width="50px"></img></center>' +
'<p>Instansi yang dipilih: ' + nama_instansi + '</p>' +
'<p>Loket: ' + loket + '</p>' +
'<p>Nomor Antrian: ' + nomor_antrian + '</p>' +
'<p>Sisa Antrian: ' + sisa + '</p>',

                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Cetak Kartu Antrian'
                    }).then(function (result) {
                        // Check if the Confirm button is clicked
                        if (result.isConfirmed) {
                            // Handle the logic for printing the queue card (e.g., open a new window or perform AJAX request)
                            // For demonstration purposes, let's open a new window with a print-friendly version
                            var printWindow = window.open('', '_blank');
                var currentDate = new Date();
                var formattedDate = currentDate.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                var formattedTime = currentDate.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                            printWindow.document.write('<html><head><title>Kartu Antrian</title>');
                            printWindow.document.write('<style>');
                            printWindow.document.write('body { font-family: Arial, sans-serif; margin: 20px; width: 30%; }');
                            printWindow.document.write('img { border-top: 1px solid #333; }'); // Add border to the image
                            printWindow.document.write('h5 { color: #333; padding-bottom: 2px; }'); // Add border to h5
                            printWindow.document.write('p { font-size: 10px; padding-bottom: 5px; margin-bottom: 5px; }'); // Add border to p
                            printWindow.document.write('p.kop { font-size: 10px; border-bottom: 1px dashed; padding-bottom: 5px; margin-bottom: 5px; }'); // Add border to p with class "kop"
                            printWindow.document.write('</style>');
                            printWindow.document.write('</head><body>');

                            // Content
                            printWindow.document.write('<center><p class="kop">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU<br>KOTA BANJARBARU</p>');
                            printWindow.document.write('<p>Pelayanan Pada: ' + nama_instansi +'</p>');
                            printWindow.document.write('<h5>Loket: ' + loket +'</h5>');
                            printWindow.document.write('<h5>No Antrian: ' + nomor_antrian + '</h5>');
                            printWindow.document.write('<p>Sisa Antrian: ' + sisa + '</p>');
                            printWindow.document.write('<p>' + formattedDate + ' ' + formattedTime + ' ' + 'Silakan Menunggu, Nomor Antrian Anda Akan Dipanggil <br> Sesuai Urutan, Terima Kasih!</p></center>');
                            // Add date and time
                            // printWindow.document.write('<p>Jam: ' + formattedTime + '</p>');

                            printWindow.document.write('</body></html>');
                            printWindow.document.close();
                            printWindow.print();

                            setTimeout(function () {
                                location.reload();
                            }, 0001);
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Handle errors if needed
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

 
</body>

</html>