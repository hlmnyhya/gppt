 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Data Instansi</h4>
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
                                        <h4 class="card-title">Data Instansi</h4>
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
                                                <th>Instansi</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no=1; foreach ($instansi as $user): ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>    
                                                    <td><?php echo $user->nama_instansi; ?></td>
                                                    <td><img src="<?php echo base_url('./uploads/instansi/'.$user->gambar_instansi); ?>" width="100px" height="120px" alt="Gambar User"></td>
                                                    <td>
                                                        <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdateInstansi" data-id="<?= $user->id_instansi ?>" data-nama="<?= $user->nama_instansi ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a>
                                                        <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_instansi ?>"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
                                                        <!-- <a type="button" href="<?php echo base_url('anggota/detail/'.$user->id_instansi); ?>" class="btn btn-primary"><i class="mdi mdi-eye"></i> <span>Detail</span></a> -->
                                                    </td>
                                                </tr>
                                            </tbody>
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
                <h5 class="modal-title" id="tambahDivisiModalLabel">Tambah Data Instansi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Instansi -->
                <form id="formTambahData" action="<?= base_url('admin/instansi/tambah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode" required>
                    </div>    
                    <div class="form-group">
                        <label for="instansi">Instansi</label>
                        <input type="text" class="form-control" id="instansi" name="nama_instansi" placeholder="Nama Instansi" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar_instansi" accept="image/*">
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
                <h5 class="modal-title" id="modalUpdateInstansiLabel">Ubah Data Instansi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Update Instansi -->
                <form id="formUpdateInstansi" action="<?= base_url('admin/instansi/ubah')?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_instansi" id="id_instansi" value="<?= $user->id_instansi?>">
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" class="form-control" id="kode" name="kode" placeholder="Kode" required>
                    </div>
                    <div class="form-group">
                        <label for="instansi">Instansi</label>
                        <input type="text" class="form-control" id="instansi" name="nama_instansi" placeholder="Nama Instansi" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar_instansi" accept="image/*">
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
            var idInstansi = $(this).data('id');
            $('#modalKonfirmasiHapus').modal('show');

            // Menangani aksi penghapusan setelah konfirmasi
            $('.btn-hapus-confirm').click(function () {
                // Kirim permintaan penghapusan ke server
                window.location.href = '<?= base_url('admin/instansi/delete/') ?>' + idInstansi;
            });
        });
    });
</script>
