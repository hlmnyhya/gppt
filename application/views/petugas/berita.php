<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Berita</h4>
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
                        <h4 class="card-title">Data Berita</h4>
                    </div>
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBerita">Tambah Data<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-dark">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Berita</th>
                                        <th>Isi Berita</th>
                                        <th>Tanggal</th>
                                        <th>Penulis</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($berita as $user): ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $user->judul_berita; ?></td>
                                            <td><?php echo $user->isi_berita; ?></td>
                                            <td><?php echo $user->waktu_publikasi; ?></td>
                                            <td><?php echo $user->penulis; ?></td>
                                            <td><img src="<?php echo base_url('./uploads/berita/'.$user->gambar_berita); ?>" width="100px" height="120px" alt="Gambar User"></td>
                                            <td>
                                                <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdateBerita" data-id="<?= $user->id_berita ?>" data-nama="<?= $user->judul_berita ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a>
                                                <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_berita ?>"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
                                                <!-- <a type="button" href="<?php echo base_url('anggota/detail/'.$user->id_instansi); ?>" class="btn btn-primary"><i class="mdi mdi-eye"></i> <span>Detail</span></a> -->
                                            </td>
                                        </tr>
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
<div class="modal fade" id="modalTambahBerita" tabindex="-1" role="dialog" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBeritaLabel">Tambah Data Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Berita -->
                <form id="formTambahBerita" action="<?= base_url('admin/berita/tambah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul_berita">Judul Berita</label>
                        <input type="text" class="form-control" id="judul_berita" name="judul_berita" placeholder="Judul Berita" required>
                    </div>
                    <div class="form-group">
                        <label for="isi_berita">Isi Berita</label>
                        <textarea class="form-control" id="isi_berita" name="isi_berita" placeholder="Isi Berita" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="waktu_publikasi">Tanggal</label>
                        <input type="date" class="form-control" id="waktu_publikasi" name="waktu_publikasi" required>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar_berita">Gambar Berita</label>
                        <input type="file" class="form-control" id="gambar_berita" name="gambar_berita" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Tambah Berita -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Berita -->
<div class="modal fade" id="modalUpdateBerita" tabindex="-1" role="dialog" aria-labelledby="modalUpdateBeritaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateBeritaLabel">Ubah Data Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Update Berita -->
                <form id="formUpdateBerita" action="<?= base_url('admin/berita/ubah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="judul_berita">Judul Berita</label>
                        <input type="hidden" class="form-control" id="id_berita" name="id_berita" value="<?= $user->id_berita?>" placeholder="Judul Berita" required>
                        <input type="text" class="form-control" id="judul_berita" name="judul_berita" value="<?= $user->judul_berita?>" placeholder="Judul Berita" required>
                    </div>
                    <div class="form-group">
                        <label for="isi_berita">Isi Berita</label>
                        <textarea class="form-control" id="isi_berita" name="isi_berita" placeholder="Isi Berita" required> <?= $user->isi_berita?> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="waktu_publikasi">Tanggal</label>
                        <input type="date" class="form-control" id="waktu_publikasi" name="waktu_publikasi" required>
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $user->penulis?>" placeholder="Penulis" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar_berita">Gambar Berita</label>
                        <input type="file" class="form-control" id="gambar_berita" name="gambar_berita" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                </form>
                <!-- Akhir Form Update Berita -->
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
            var idBerita = $(this).data('id');
            $('#modalKonfirmasiHapus').modal('show');

            // Menangani aksi penghapusan setelah konfirmasi
            $('.btn-hapus-confirm').click(function () {
                // Kirim permintaan penghapusan ke server
                window.location.href = '<?= base_url('admin/berita/delete/') ?>' + idBerita;
            });
        });
    });
</script>
