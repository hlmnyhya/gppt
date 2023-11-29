<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Syarat</h4>
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
                        <h4 class="card-title">Data Syarat</h4>
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
                                        <th>Nama Layanan Detail</th>
                                        <th>Syarat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($syarat as $user): ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $user->nama_layanan_detail; ?></td>
                                            <td><?php echo nl2br(implode(explode('<br>', $user->syarat))); ?></td>
                                            <td>
                                                <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdateSyarat" data-id="<?= $user->id_syarat ?>" data-nama="<?= $user->syarat ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a>
                                                <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_syarat ?>" data-toggle="modal" data-target="#modalKonfirmasiHapus"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
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
<div class="modal fade" id="modalTambahSyarat" tabindex="-1" role="dialog" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahBeritaLabel">Tambah Data Syarat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Berita -->
                <form id="formTambahSyarat" action="<?= base_url('admin/syarat/tambah')?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id_layanan_detail">Layanan Detail</label>
        <select class="form-control" id="id_layanan_detail" name="id_layanan_detail" required>
            <option value="">Pilih Layanan Detail</option>
            <?php foreach ($detaillayanan as $row): ?>
                <option value="<?= $row->id_layanan_detail; ?>"><?= $row->nama_layanan_detail; ?></option>
            <?php endforeach; ?>
        </select>
    </div> 
    <div class="form-group">
        <label for="syarat">Syarat</label>
        <textarea class="form-control" id="syarat" name="syarat" placeholder="Isi Syarat" required></textarea>
    </div>
    <div class="form-group">
        <label for="penjelasan">Penjelasan</label>
        <textarea class="form-control" id="penjelasan" name="penjelasan" placeholder="Penjelasan" required></textarea>
    </div>
    <div class="form-group">
        <label for="dasar_hukum">Dasar Hukum</label>
        <textarea class="form-control" id="dasar_hukum" name="dasar_hukum" placeholder="Dasar Hukum" required></textarea>
    </div>
    <div class="form-group">
        <label for="prosedur">Prosedur</label>
        <textarea class="form-control" id="prosedur" name="prosedur" placeholder="Prosedur" required></textarea>
    </div>
    <div class="form-group">
        <label for="jangka_waktu">Jangka Waktu</label>
        <textarea class="form-control" id="jangka_waktu" name="jangka_waktu" placeholder="Jangka Waktu" required></textarea>
    </div>
    <div class="form-group">
        <label for="biaya">Biaya</label>
        <textarea class="form-control" id="biaya" name="biaya" placeholder="Biaya" required></textarea>
    </div>
    <button type="submit" class="btn btn-success text-white">Simpan</button>
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
                <h5 class="modal-title" id="modalUpdateBeritaLabel">Ubah Data Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Update Berita -->
                <form id="formTambahSyarat" action="<?= base_url('admin/syarat/ubah')?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id_layanan_detail">Layanan Detail</label>
        <input type="hidden" name="id_syarat" value="<?= $user->id_syarat;?>">
        <select class="form-control" id="id_layanan_detail" name="id_layanan_detail" required>
            <option value="">Pilih Layanan Detail</option>
            <?php foreach ($detaillayanan as $row): ?>
                <option value="<?= $row->id_layanan_detail; ?>"><?= $row->nama_layanan_detail; ?></option>
            <?php endforeach; ?>
        </select>
    </div> 
    <div class="form-group">
        <label for="syarat">Syarat</label>
        <textarea class="form-control" id="syarat" name="syarat" placeholder="Isi Syarat" required></textarea>
    </div>
    <div class="form-group">
        <label for="penjelasan">Penjelasan</label>
        <textarea class="form-control" id="penjelasan" name="penjelasan" placeholder="Penjelasan" required></textarea>
    </div>
    <div class="form-group">
        <label for="dasar_hukum">Dasar Hukum</label>
        <textarea class="form-control" id="dasar_hukum" name="dasar_hukum" placeholder="Dasar Hukum" required></textarea>
    </div>
    <div class="form-group">
        <label for="prosedur">Prosedur</label>
        <textarea class="form-control" id="prosedur" name="prosedur" placeholder="Prosedur" required></textarea>
    </div>
    <div class="form-group">
        <label for="jangka_waktu">Jangka Waktu</label>
        <textarea class="form-control" id="jangka_waktu" name="jangka_waktu" placeholder="Jangka Waktu" required></textarea>
    </div>
    <div class="form-group">
        <label for="biaya">Biaya</label>
        <textarea class="form-control" id="biaya" name="biaya" placeholder="Biaya" required></textarea>
    </div>
    <button type="submit" class="btn btn-success text-white">Simpan</button>
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
            var idSyarat = $(this).data('id');
            $('#modalKonfirmasiHapus').modal('show');

            // Menangani aksi penghapusan setelah konfirmasi
            $('.btn-hapus-confirm').click(function () {
                // Kirim permintaan penghapusan ke server
                window.location.href = '<?= base_url('admin/syarat/delete/') ?>' + idSyarat;
            });
        });
    });
</script>
