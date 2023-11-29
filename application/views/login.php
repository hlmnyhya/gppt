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
                                    <h4 class="text-center mb-4">Silakan Masuk <br><span>Menggunakan Akun Anda</span></h4>
                                    <?php if ($this->session->flashdata('pesan')): ?>
                                        <?= $this->session->flashdata('pesan'); ?>
                                        <?php endif; ?>
                                        <?php if ($this->session->flashdata('error')): ?>
                                            <?= $this->session->flashdata('error'); ?>
                                            <?php endif; ?>
                                    <form action="<?= base_url('auth/goauth/login'); ?>" method="POST">
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Belum memiliki akun? <a class="text-primary" href="<?= base_url('auth/register'); ?>">Daftar Sekarang</a></p>
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