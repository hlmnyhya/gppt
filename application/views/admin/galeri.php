<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Gallery</h4>
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
                        <h4 class="card-title">Data Gallery</h4>
                    </div>
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahdata">Tambah Data<span
                                class="btn-icon-right"><i class="fa fa-plus"></i></span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-dark">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Gallery</th>
                                        <th>Deskripsi Gallery</th>
                                        <th>Waktu Upload</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($gallery as $user): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $user->judul_gallery; ?></td>
                                            <td><?= $user->deskripsi_gallery; ?></td>
                                            <td><?= $user->waktu_upload; ?></td>
                                            <td><img src="<?= base_url('./uploads/galeri/'.$user->gambar_gallery); ?>" width="100px" height="120px" alt="Gambar Gallery"></td>
                                            <td>
                                                <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdateGallery" data-id="<?= $user->id_gallery ?>" data-nama="<?= $user->judul_gallery ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a>
                                                <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_gallery ?>"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
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

<!-- Modal Tambah Instansi -->
<div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="tambahDivisiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDivisiModalLabel">Tambah Data Gallery</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Instansi -->
                <form id="formTambahData" action="<?= base_url('admin/gallery/tambah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="instansi">Judul Gallery</label>
                        <input type="text" class="form-control" id="instansi" name="judul_gallery" placeholder="Judul Gallery" required>
                    </div>
                    <div class="form-group">
                        <label for="isiberita">Deskripsi Gallery</label>
                        <textarea class="form-control" id="isiberita" name="deskripsi_gallery" placeholder="Deskripsi Gallery" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="instansi">Tanggal</label>
                        <input type="date" class="form-control" id="instansi" name="waktu_upload" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar_gallery" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Tambah Instansi -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Instansi -->
<div class="modal fade" id="modalUpdateGallery" tabindex="-1" role="dialog" aria-labelledby="modalUpdateInstansiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateInstansiLabel">Ubah Data Instansi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Update Instansi -->
                <form id="formUpdateInstansi" action="<?= base_url('admin/gallery/ubah')?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_berita" id="id_gallery" value="<?= $user->id_gallery?>">
                    <div class="form-group">
                        <label for="instansi">Judul Gallery</label>
                        <input type="text" class="form-control" id="instansi" name="judul_gallery" value="<?= $user->judul_gallery?>" placeholder="Judul Gallery" required>
                    </div>
                    <div class="form-group">
                        <label for="isiberita">Deskripsi Gallery</label>
                        <textarea class="form-control" id="isiberita" name="deskripsi_gallery" placeholder="Deskripsi Gallery" required><?= $user->deskripsi_gallery?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="instansi">Tanggal</label>
                        <input type="date" class="form-control" id="instansi" name="waktu_upload" value="<?= $user->waktu_upload?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar_gallery" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Update Instansi -->
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
            var idGallery = $(this).data('id');
            $('#modalKonfirmasiHapus').modal('show');

            // Menangani aksi penghapusan setelah konfirmasi
            $('.btn-hapus-confirm').click(function () {
                // Kirim permintaan penghapusan ke server
                window.location.href = '<?= base_url('admin/gallery/delete/') ?>' + idGallery;
            });
        });
    });
</script>
