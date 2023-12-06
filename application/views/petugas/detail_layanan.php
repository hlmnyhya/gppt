 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Data Detail Layanan</h4>
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
                                        <h4 class="card-title">Data Detail Layanan</h4>
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
                                                <th>Layanan</th>
                                                <th>Detail Layanan</th>
                                                <th>Deskripsi Detail Layanan</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($detaillayanan as $user): ?>
                                                <?php if ($user->id_instansi == $this->session->userdata('id_instansi')): ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $user->nama_layanan; ?></td>
                                                    <td><?php echo $user->nama_layanan_detail; ?></td>
                                                    <td><?php echo $user->deskripsi_layanan_detail; ?></td>
                                                    <td><img src="<?php echo base_url('./uploads/layanan_detail/'.$user->gambar_layanan_detail); ?>" width="100px" height="120px" alt="Gambar User"></td>
                                                    <td>
                                                        <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdateInstansi" data-id="<?= $user->id_layanan_detail ?>" data-nama="<?= $user->nama_layanan_detail ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a>
                                                        <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_layanan_detail ?>"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
                                                        <!-- <a type="button" href="<?php echo base_url('anggota/detail/'.$user->id_layanan); ?>" class="btn btn-primary"><i class="mdi mdi-eye"></i> <span>Detail</span></a> -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <?php endif;?>
                                            <?php endforeach;?>
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
                <h5 class="modal-title" id="tambahDivisiModalLabel">Tambah Data Detail Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Instansi -->
                <form id="formTambahData" action="<?= base_url('admin/layanan_detail/tambah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                    <label for="id_layanan">Layanan</label>
                    <select class="form-control" id="id_layanan" name="id_layanan" required>
                        <option value="">Pilih Layanan</option>
                        <?php foreach ($layanan as $row): ?>
                            <option value="<?= $row->id_layanan; ?>"><?= $row->nama_layanan; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="layanan">Detail Layanan</label>
                        <input type="text" class="form-control" id="layanan" name="nama_layanan_detail" placeholder="Nama Detail Layanan" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_layanan">Deskripsi Layanan</label>
                        <input type="text" class="form-control" id="deskripsi_layanan" name="deskripsi_layanan_detail" placeholder="Deskripsi Layanan" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar_layanan_detail" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Tambah Instansi -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Instansi -->
<!-- Modal Update Instansi -->
<div class="modal fade" id="modalUpdateInstansi" tabindex="-1" role="dialog" aria-labelledby="modalUpdateInstansiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateInstansiLabel">Ubah Data Detail Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Update Instansi -->
                <form id="formUpdateInstansi" action="<?= base_url('admin/layanan_detail/ubah')?>" method="POST" enctype="multipart/form-data">
                   <div class="form-group">
                    <label for="id_layanan">Layanan</label>
                    <input type="hidden" name="id_layanan_detail" value="<?= $user->id_layanan_detail?>">
                    <select class="form-control" id="id_layanan" name="id_layanan" required>
                        <option value="">Pilih Layanan</option>
                        <?php foreach ($layanan as $row): ?>
                            <option value="<?= $row->id_layanan; ?>"><?= $row->nama_layanan; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="layanan">Detail Layanan</label>
                        <input type="text" class="form-control" id="layanan" name="nama_layanan_detail"  value="<?= $user->nama_layanan_detail?>" placeholder="Nama Detail Layanan" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_layanan">Deskripsi Layanan</label>
                        <input type="text" class="form-control" id="deskripsi_layanan" name="deskripsi_layanan_detail"  value="<?= $user->deskripsi_layanan_detail?>" placeholder="Deskripsi Layanan" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar_layanan_detail" accept="image/*">
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
            var idLayananDetail = $(this).data('id');
            $('#modalKonfirmasiHapus').modal('show');

            // Menangani aksi penghapusan setelah konfirmasi
            $('.btn-hapus-confirm').click(function () {
                // Kirim permintaan penghapusan ke server
                window.location.href = '<?= base_url('admin/layanan_detail/delete/') ?>' + idLayananDetail;
            });
        });
    });
</script>
