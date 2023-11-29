<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Users</h4>
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
                        <h4 class="card-title">Data Users</h4>
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
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Email</th>
                                        <th>Nomor Telepon</th>
                                        <th>Hak Akses</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($users as $user): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $user->nama; ?></td>
                                            <td><?= $user->username; ?></td>
                                            <td><?php echo str_repeat('●', min(strlen($user->password), 8)); ?></td>
                                            <td><?= $user->email; ?></td>
                                            <td><?= $user->nomor_telepon; ?></td>
                                            <td><?= $user->level; ?></td>
                                            <td><img src="<?= base_url('./uploads/users/'.$user->gambar_user); ?>" width="100px" height="100px" alt="Gambar User"></td>
                                            <td>
                                                <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdateUser" data-id="<?= $user->id_user ?>" data-nama="<?= $user->nama ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a>
                                                <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_user ?>"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
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

<!-- Modal Tambah User -->
<div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="tambahDivisiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDivisiModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah User -->
                <form id="formTambahUser" action="<?= base_url('admin/user/tambah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_user">Nama</label>
                        <input type="text" class="form-control" id="nama_user" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_user">Username</label>
                        <input type="text" class="form-control" id="nama_user" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_user">Password</label>
                        <input type="password" class="form-control" id="nama_user" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Nomor Telepon" required>
                    </div>
                    <div class="form-group">
                    <label for="level_label">Level</label>
                    <select class="form-control" id="id_level" name="id_level" required>
                        <option value="">Pilih Level</option>
                        <?php foreach ($level as $row): ?>
                            <option value="<?= $row->id_level; ?>"><?= $row->level; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="instansi_label" id="instansi_label">Instansi</label>
                    <select class="form-control" id="id_instansi" name="id_instansi">
                        <option value="">Pilih Instansi</option>
                        <?php foreach ($instansi as $row): ?>
                            <option value="<?= $row->id_instansi; ?>"><?= $row->nama_instansi; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar_user">Gambar</label>
                        <input type="file" class="form-control" id="gambar_user" name="gambar_user" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Tambah User -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Update User -->
<div class="modal fade" id="modalUpdateUser" tabindex="-1" role="dialog" aria-labelledby="modalUpdateInstansiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateInstansiLabel">Ubah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Update User -->
                 <form id="formTambahUser" action="<?= base_url('admin/user/tambah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama_user">Nama</label>
                        <input type="text" class="form-control" id="nama_user" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_user">Username</label>
                        <input type="text" class="form-control" id="nama_user" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_user">Password</label>
                        <input type="password" class="form-control" id="nama_user" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Nomor Telepon" required>
                    </div>
                    <div class="form-group">
                    <label for="level_label">Level</label>
                    <select class="form-control" id="id_level" name="id_level" required>
                        <option value="">Pilih Level</option>
                        <?php foreach ($level as $row): ?>
                            <option value="<?= $row->id_level; ?>"><?= $row->level; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="instansi_label" id="instansi_label">Instansi</label>
                    <select class="form-control" id="id_instansi" name="id_instansi">
                        <option value="">Pilih Instansi</option>
                        <?php foreach ($instansi as $row): ?>
                            <option value="<?= $row->id_instansi; ?>"><?= $row->nama_instansi; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar_user">Gambar</label>
                        <input type="file" class="form-control" id="gambar_user" name="gambar_user" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Update User -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus User -->
<div class="modal fade" id="modalKonfirmasiHapusUser" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiHapusLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-danger btn-hapus-user-confirm">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Menampilkan modal konfirmasi saat tombol hapus di-klik
        $('.btn-hapus').click(function () {
            var idUser = $(this).data('id');
            $('#modalKonfirmasiHapusUser').modal('show');

            // Menangani aksi penghapusan setelah konfirmasi
            $('.btn-hapus-user-confirm').click(function () {
                // Kirim permintaan penghapusan ke server
                window.location.href = '<?= base_url('admin/user/delete/') ?>' + idUser;
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Sembunyikan dropdown Instansi secara awal
        $('#id_instansi').hide();
        $('#instansi_label').hide();

        // Tampilkan/Sembunyikan dropdown Instansi berdasarkan Level yang dipilih
        $('#id_level').change(function () {
            if ($(this).val() == '2') {
                $('#id_instansi').show();
                $('#instansi_label').show();
            } else {
                $('#id_instansi').hide();
                // Setel nilai default untuk Instansi saat tersembunyi
                $('#id_instansi').val(6);
            }
        });
        
    });
</script>

<script>
    $(document).ready(function () {
        // Sembunyikan dropdown Instansi secara awal
        $('#id_instansi2').hide();
        $('#instansi_label2').hide();

        // Tampilkan/Sembunyikan dropdown Instansi berdasarkan Level yang dipilih
        $('#id_level').change(function () {
            if ($(this).val() == '2') {
                $('#id_instansi2').show();
                $('#instansi_label2').show();
            } else {
                $('#id_instansi2').hide();
                // Setel nilai default untuk Instansi saat tersembunyi
                $('#id_instansi2').val(6);
            }
        });
        
    });
</script>


