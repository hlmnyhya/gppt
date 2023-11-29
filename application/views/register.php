<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $title;  ?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url();?>assets/images/mpp_icon.png">
    <link href="<?= base_url();?>assets/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                  <center> 
                                        <img class="mb-3" src="<?= base_url('assets/images/mpp_icon.png'); ?>" width="75px" alt="">
                                    </center>
                                    <h4 class="text-center mb-4">Silakan Daftar <br><span>Masukkan data diri anda!</span></h4>
                                    <?php if ($this->session->flashdata('pesan')): ?>
                                        <?= $this->session->flashdata('pesan'); ?>
                                        <?php endif; ?>
                                        <?php if ($this->session->flashdata('error')): ?>
                                            <?= $this->session->flashdata('error'); ?>
                                            <?php endif; ?>
                    <form action="<?= base_url('auth/goauth/register'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nik"><strong>NIK</strong></label>
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" required>
                        </div>

                        <div class="form-group">
                            <label for="nik"><strong>Nama</strong></label>
                            <input type="text" class="form-control" id="nik" name="nama" placeholder="Masukkan Nama" required>
                        </div>

                        <div class="form-group">
                            <label for="username"><strong>Username</strong></label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                        </div>

                        <div class="form-group">
                            <label for="email"><strong>Email</strong></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                        </div>

                        <div class="form-group">
                            <label for="password"><strong>Password</strong></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_telepon"><strong>Nomor Telepon</strong></label>
                            <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Masukkan nomor telepon">
                        </div>

                        <div class="form-group">
                            <label for="gambar_user"><strong>Gambar Pengguna</strong></label>
                            <input type="file" class="form-control-file" id="gambar_user" name="gambar_user">
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Daftar </button>
                        </div>
                    </form>
                                    <div class="new-account mt-3">
                                        <p>Sudah mempunyai akun? <a class="text-primary" href="<?= base_url('auth/login'); ?>">Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?= base_url('assets/vendor/global/global.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/quixnav-init.js'); ?>"></script>
    <script src="<?= base_url('assets/js/custom.min.js'); ?>"></script>

</body>

</html>