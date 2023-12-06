<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Komentar</h4>
                </div>
            </div>
        </div>
        <!-- row -->

        <div class="row">
            <div class="col-12">
               <?php if ($this->session->flashdata('pesan')): ?>
                    <?= $this->session->flashdata('pesan'); ?>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <?= $this->session->flashdata('error'); ?>
                    <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Komentar</h4>
                    </div>
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSyarat">Tambah Data<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-dark">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Instansi</th>
                                        <th>Layanan</th>
                                        <th>Usulan / Komentar</th>
                                        <th class="text-center">Tingkat Kepuasan</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($komentar as $user): ?>
                                         <?php if ($user->id_instansi == $this->session->userdata('id_instansi')): ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $user->username; ?></td>
                                            <td><?php echo $user->nama_instansi; ?></td>
                                            <td><?php echo $user->nama_layanan; ?></td>
                                            <td><?php echo $user->komentar; ?></td>
                                            <td>
    <?php
    $rating = $user->rate;

    // Menggunakan switch untuk menentukan ikon berdasarkan nilai rating
    switch ($rating) {
        case 1:
            echo '<center><img src="' . base_url() . 'assets/emojis/emoji-1.png" width="50px" alt=""></center>';
            break;
        case 2:
            echo '<center><img src="' . base_url() . 'assets/emojis/emoji-2.png" width="50px" alt=""></center>';
            break;
        case 3:
            echo '<center><img src="' . base_url() . 'assets/emojis/emoji-3.png" width="50px" alt=""></center>';
            break;
        case 4:
            echo '<center><img src="' . base_url() . 'assets/emojis/emoji-4.png" width="50px" alt=""></center>';
            break;
        case 5:
            echo '<center><img src="' . base_url() . 'assets/emojis/emoji-5.png" width="50px" alt=""></center>';
            break;
        default:
            echo 'Tidak ada rating';
    }
    ?>
</td>

                                            <td><?php echo $user->waktu_komentar; ?></td>
                                            <td>
                                                <!-- <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdateSyarat" data-id="<?= $user->id_komentar ?>" data-nama="<?= $user->komentar ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a> -->
                                                <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_komentar ?>" data-toggle="modal" data-target="#modalKonfirmasiHapus"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
                                                <!-- <a type="button" href="<?php echo base_url('anggota/detail/'.$user->id_instansi); ?>" class="btn btn-primary"><i class="mdi mdi-eye"></i> <span>Detail</span></a> -->
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

<!-- Modal Tambah Berita -->
<div class="modal fade" id="modalTambahSyarat" tabindex="-1" role="dialog" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBeritaLabel">Tambah Data Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Berita -->
                <form id="formTambahKomentar" action="<?= base_url('petugas/komentar/tambah')?>" method="POST">
    <div class="form-group">
        <label for="id_user">Nama</label>
        <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user')?>">
        <input type="text" class="form-control" id="layanan" name="nama_layanan" value="<?= $this->session->userdata('nama')?>" placeholder="Nama Layanan" readonly required>
    </div>
    <div class="form-group">
        <label for="komentar">Komentar</label>
        <textarea class="form-control" id="komentar" name="komentar" placeholder="Isi Komentar" required></textarea>
    </div>
    <center>
    <div class="wrapper mb-3">
        <input type="radio" name="rate" id="star-1" value="1">
        <input type="radio" name="rate" id="star-2" value="2">
        <input type="radio" name="rate" id="star-3" value="3">
        <input type="radio" name="rate" id="star-4" value="4">
        <input type="radio" name="rate" id="star-5" value="5">
        <div class="content">
            <div class="outer">
                <div class="emojis">
                    <li class="slideImg" data-value="1"><img src="<?= base_url();?>assets/emojis/emoji-1.png" alt=""></li>
                    <li data-value="2"><img src="<?= base_url();?>assets/emojis/emoji-2.png" alt=""></li>
                    <li data-value="3"><img src="<?= base_url();?>assets/emojis/emoji-3.png" alt=""></li>
                    <li data-value="4"><img src="<?= base_url();?>assets/emojis/emoji-4.png" alt=""></li>
                    <li data-value="5"><img src="<?= base_url();?>assets/emojis/emoji-5.png" alt=""></li>
                </div>
            </div>
            <div class="stars">
                <label for="star-1" class="star-1 fa fa-star"></label>
                <label for="star-2" class="star-2 fa fa-star"></label>
                <label for="star-3" class="star-3 fa fa-star"></label>
                <label for="star-4" class="star-4 fa fa-star"></label>
                <label for="star-5" class="star-5 fa fa-star"></label>
            </div>
        </div>
        <div class="footer">
            <span class="text"></span>
            <span class="numb"></span>
        </div>
    </div>
    </center>
    <button type="submit" class="btn btn-success text-white mt-3">Simpan</button>
</form>

                <!-- Akhir Form Tambah Berita -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Berita -->
<div class="modal fade" id="modalUpdateSyarat" tabindex="-1" role="dialog" aria-labelledby="modalUpdateBeritaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateBeritaLabel">Ubah Data Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Update Berita -->
                <!-- Form Tambah Berita -->
                <form id="formUbahKomentar" action="<?= base_url('petugas/komentar/ubah')?>" method="POST">
    <div class="form-group">
        <label for="id_user">Nama</label>
        <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user')?>">
        <input type="hidden" name="id_komentar" value="<?= $user->id_komentar?>">
        <input type="text" class="form-control" id="layanan" name="nama_layanan" value="<?= $this->session->userdata('nama')?>" placeholder="Nama Layanan" readonly required>
    </div>
     <div class="form-group">
                    <label for="id_instansi">Instansi</label>
                    <select class="form-control" id="id_instansi" name="id_instansi" required>
                        <option value="">Pilih Instansi</option>
                        <?php foreach ($instansi as $row): ?>
                            <option value="<?= $row->id_instansi; ?>"><?= $row->nama_instansi; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div> 
    <div class="form-group">
        <label for="id_layanan">Layanan</label>
        <select class="form-control" id="id_layanan" name="id_layanan" required>
            <option value="">Pilih Layanan</option>
            <?php foreach ($komentar as $layanan): ?>
                <option value="<?= $layanan->id_layanan; ?>"><?= $layanan->nama_layanan; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="komentar">Komentar</label>
        <textarea class="form-control" id="komentar" name="komentar" placeholder="Isi Komentar" required></textarea>
    </div>
    <!-- <center>
    <div class="wrapper mb-3">
        <input type="radio" name="rate" id="star-1" value="1">
        <input type="radio" name="rate" id="star-2" value="2">
        <input type="radio" name="rate" id="star-3" value="3">
        <input type="radio" name="rate" id="star-4" value="4">
        <input type="radio" name="rate" id="star-5" value="5">
        <div class="content">
            <div class="outer">
                <div class="emojis">
                    <li class="slideImg" data-value="1"><img src="<?= base_url();?>assets/emojis/emoji-1.png" alt=""></li>
                    <li data-value="2"><img src="<?= base_url();?>assets/emojis/emoji-2.png" alt=""></li>
                    <li data-value="3"><img src="<?= base_url();?>assets/emojis/emoji-3.png" alt=""></li>
                    <li data-value="4"><img src="<?= base_url();?>assets/emojis/emoji-4.png" alt=""></li>
                    <li data-value="5"><img src="<?= base_url();?>assets/emojis/emoji-5.png" alt=""></li>
                </div>
            </div>
            <div class="stars">
                <label for="star-1" class="star-1 fa fa-star"></label>
                <label for="star-2" class="star-2 fa fa-star"></label>
                <label for="star-3" class="star-3 fa fa-star"></label>
                <label for="star-4" class="star-4 fa fa-star"></label>
                <label for="star-5" class="star-5 fa fa-star"></label>
            </div>
        </div>
        <div class="footer">
            <span class="text"></span>
            <span class="numb"></span>
        </div>
    </div>
    </center> -->
    <button type="submit" class="btn btn-success text-white mt-3">Simpan</button>
</form>

                <!-- Akhir Form Tambah Berita -->
            </div>
        </div>
    </div>
</div>


<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiHapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKonfirmasiHapusLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-dark">Anda yakin ingin menghapus data ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-hapus-confirm">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Menampilkan modal konfirmasi saat tombol hapus di-klik
        $('.btn-hapus').click(function () {
            var idSyarat = $(this).data('id');
            $('#modalKonfirmasiHapus').modal('show');

            // Menangani aksi penghapusan setelah konfirmasi
            $('.btn-hapus-confirm').click(function () {
                // Kirim permintaan penghapusan ke server
                window.location.href = '<?= base_url('petugas/komentar/delete/') ?>' + idSyarat;
            });
        });
    });
</script>
<script>
    // Function to handle emoji click for a specific form
    function handleEmojiClick(formId) {
        const form = document.getElementById(formId);
        const emojis = form.querySelectorAll('.emojis li');
        const ratingInput = form.querySelector('input[name="rate"]');

        emojis.forEach(emoji => {
            emoji.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;
            });
        });
    }

    // Call the function for both forms
    handleEmojiClick('formTambahKomentar');
    handleEmojiClick('formUbahKomentar');
</script>

<script>
    // Vanilla JavaScript script for updating UI based on rating
    document.addEventListener('DOMContentLoaded', function () {
        const ratingIcons = document.querySelectorAll('.emojis li');
        const ratingInput = document.querySelector('input[name="rate"]');

        ratingIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                const value = this.getAttribute('data-value');
                ratingInput.value = value;

                // You can add additional logic here, such as updating the UI to reflect the selected rating
                updateRatingUI(value);
            });
        });

        function updateRatingUI(value) {
            // You can implement UI updates here if needed
            console.log('Selected rating:', value);
        }
    });
</script>
