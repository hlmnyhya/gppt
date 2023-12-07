<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Blanko</h4>
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
                        <h4 class="card-title">Data Blanko</h4>
                    </div>
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahBlanko">Tambah Data<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-dark">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Blanko</th>
                                        <th>Keterangan</th>
                                        <th>File</th>
                                        <th>Aksi</th>
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
                                            echo '<a href="' . $file_path . '" target="_blank">' . $user->file . '</a>';
                                            ?>
                                            </td>
                                            <td>
                                                <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdateBlanko" data-id="<?= $user->id_blanko ?>" data-nama="<?= $user->nama_blanko ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a>
                                                <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_blanko ?>"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
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
<div class="modal fade" id="modalTambahBlanko" tabindex="-1" role="dialog" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBeritaLabel">Tambah Data Blanko</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Berita -->
                <form id="formTambahBerita" action="<?= base_url('admin/blanko/tambah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_blanko">Nama Blanko</label>
                        <input type="text" class="form-control" id="nama_blanko" name="nama_blanko" placeholder="Nama Blanko" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control" id="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Tambah Berita -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Blanko -->
<div class="modal fade" id="modalUpdateBlanko" tabindex="-1" role="dialog" aria-labelledby="modalUpdateBlankoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateBlankoLabel">Update Data Blanko</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Update Blanko -->
                <form id="formUpdateBlanko" action="<?= base_url('admin/blanko/ubah') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_blanko" id="id_blanko" value="<?= $user->id_blanko?>">
                    <div class="form-group">
                        <label for="nama_blanko_update">Nama Blanko</label>
                        <input type="text" class="form-control" id="nama_blanko_update" name="nama_blanko" value="<?= $user->nama_blanko?>" placeholder="Nama Blanko" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan_update">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan_update" name="keterangan" value="<?= $user->keterangan?>" placeholder="Keterangan" required>
                    </div>
                    <div class="form-group">
                        <label for="file_update">File</label>
                        <input type="file" class="form-control" id="file_update" name="file">
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Update Blanko -->
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
                window.location.href = '<?= base_url('admin/blanko/delete/') ?>' + idBerita;
            });
        });
    });
</script>