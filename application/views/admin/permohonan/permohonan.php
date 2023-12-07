<!-- ... Bagian Header dan Konten sebelumnya ... -->

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Permohonan</h4>
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
                        <h4 class="card-title">Data Permohonan</h4>
                    </div>
                    <div class="card-header">
                        <!-- <a href="<?= base_url('admin/berkas/view/tambah')?>" type="button" class="btn btn-primary">Tambah Data<span class="btn-icon-right"><i class="fa fa-plus"></i></span></a> -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPermohonan">Tambah Data<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-dark">
                            <table id="example" class="display" style="min-width: 845px">
                                 <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pemohon</th>
                                        <th>Nama Layanan</th>
                                        <th>Jenis Layanan</th>
                                        <th>Syarat Layanan</th>
                                        <th class="text-center">Status Permohonan</th>
                                        <th>Berkas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($permohonan as $user): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $user->nama; ?></td>
                                            <td><?= $user->nama_layanan; ?></td>
                                            <td><?= $user->nama_layanan_detail; ?></td>
                                            <td><?php echo nl2br(implode(explode('<br>', $user->syarat))); ?></td>
                                            <td>
                                                <center>
                                            <?php
                                                $status_permohonan = $user->status_permohonan;
                                                if ($status_permohonan == 'Diajukan') {
                                                    echo '<a class="text-white badge badge-rounded badge-primary">' . $status_permohonan . '</a>';
                                                } elseif ($status_permohonan == 'Diverifikasi') {
                                                    echo '<a class="text-white badge badge-rounded badge-secondary">' . $status_permohonan . '</a>';
                                                } elseif ($status_permohonan == 'Diproses') {
                                                    echo '<a class="text-white badge badge-rounded badge-info">' . $status_permohonan . '</a>';
                                                } elseif ($status_permohonan == 'Ditolak') {
                                                    echo '<a class="text-white badge badge-rounded badge-danger">' . $status_permohonan . '</a>';
                                                } elseif ($status_permohonan == 'Selesai') {
                                                    echo '<a class="text-white badge badge-rounded badge-success">' . $status_permohonan . '</a>';
                                                } else {
                                                    echo $status_permohonan; // Display the status as is for other cases
                                                }
                                            ?>
                                            </center>
                                            </td>
                                            <td>
    <?php
    $id_permohonan = $user->id_permohonan;
    $hasBerkas = $this->db->where('id_permohonan', $id_permohonan)->get('berkas')->num_rows() > 0;

    echo '<div class="form-group">';
    echo '<input type="hidden" class="form-control" id="id_permohonan" name="id_permohonan" value="' . $user->id_permohonan . '" required>';

    // Retrieve existing files and display them
    $existingFiles = $this->db->where('id_permohonan', $id_permohonan)->get('berkas')->result();

    if ($existingFiles) {
        echo '<div class="row mb-3">';
        foreach ($existingFiles as $file) {
            echo '<div class="col-md-6">';
            echo '<div class="d-flex justify-content-between align-items-center">';
            // Truncate the file name if it's too long
            $truncatedFileName = (strlen($file->file) > 20) ? substr($file->file, 0, 20) . '...' : $file->file;
            echo '<span title="' . $file->file . '">' . $truncatedFileName . '</span>';
            // Add a delete button for each file
            echo '<a class="btn btn-sm btn-danger" href="' . base_url('ADMIN/Berkas/delete_berkas/' . $file->id_berkas) . '"><i class="mdi mdi-delete"></i></a>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }

    echo '<div id="demo-upload" class="dropzone needsclick">';
    echo '<div class="dz-message needsclick">';
    echo 'Klik atau Tarik File Kesini.';
    echo '<span class="note needsclick">atau pilih file dari komputer anda</span>';
    echo '</div>';
    echo '</div>';

    echo '<center><button type="button" class="mt-3 btn btn-success" id="uploadTrigger">Upload Files</button></center>';
    echo '</div>';
    ?>
</td>

                                            <td>
                                                <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdatePermohonan" data-id="<?= $user->id_permohonan ?>" data-nama="<?= $user->nama ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a>
                                                <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_permohonan ?>"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
                                               <a href="<?= base_url('admin/permohonan/proses/'.$user->id_permohonan)?>" class="btn btn-info btn-proses"><i class="mdi mdi-check"></i> <span>Proses</span></a>
                                               <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modalTolak" data-id-permohonan="<?= $user->id_permohonan ?>"><i class="mdi mdi-close"></i> <span>Tolak</span></a>
                                                <a href="#" class="btn btn-success btn-selesai" data-toggle="modal" data-target="#modalSelesai" data-id-permohonan="<?= $user->id_permohonan ?>"><i class="mdi mdi-check-all"></i> <span>Selesai</span></a>

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

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Sweet Success</h4>
        <div class="card-content">
            <div class="sweetalert mt-5">
                <button class="btn btn-success btn sweet-success" style="display: none;">Sweet Success</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data Permohonan -->
<div class="modal fade" id="modalTambahPermohonan" tabindex="-1" role="dialog" aria-labelledby="modalTambahPermohonanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPermohonanLabel">Tambah Data Permohonan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Data Permohonan -->
                <form id="formTambahPermohonan" action="<?= base_url('admin/permohonan/tambah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $this->session->userdata('nama'); ?>" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="nama" name="id_user" value="<?= $this->session->userdata('id_user'); ?>" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="id_instansi">Instansi</label>
                        <select class="form-control" id="id_instansi" name="id_instansi" required onchange="getLayanan()">
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
                        <?php foreach ($layanan as $row): ?>
                            <option value="<?= $row->id_layanan; ?>"><?= $row->nama_layanan; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="layanan_detail">Layanan Detail</label>
                    <select class="form-control" id="id_layanan_detail" name="id_layanan_detail" required>
                        <option value="">Pilih Layanan Detail</option>
                        <?php foreach ($detaillayanan as $row): ?>
                            <option value="<?= $row->id_layanan_detail; ?>"><?= $row->nama_layanan_detail; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div> 
                    <div class="form-group">
                        <label for="status_permohonan">Status Permohonan</label>
                        <select class="form-control" id="status_permohonan" name="status_permohonan" required>
                            <option value="Diajukan">Diajukan</option>
                            <option value="Diverifikasi">Diverifikasi</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Ditolak">Ditolak</option>
                            <option value="Selesai">Selesai</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Tambah Data Permohonan -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Data Permohonan -->
<div class="modal fade" id="modalUpdatePermohonan" tabindex="-1" role="dialog" aria-labelledby="modalTambahPermohonanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPermohonanLabel">Ubah Data Permohonan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Data Permohonan -->
                <form id="formTambahPermohonan" action="<?= base_url('admin/permohonan/ubah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="hidden" class="form-control" id="nama" name="id_permohonan" value="<?= $user->id_permohonan; ?>" placeholder="Nama" required>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $this->session->userdata('nama'); ?>" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="nama" name="id_user" value="<?= $this->session->userdata('id_user'); ?>" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="id_instansi">Instansi</label>
                        <select class="form-control" id="id_instansi" name="id_instansi" required onchange="getLayanan()">
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
                        <?php foreach ($layanan as $row): ?>
                            <option value="<?= $row->id_layanan; ?>"><?= $row->nama_layanan; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="layanan_detail">Layanan Detail</label>
                    <select class="form-control" id="id_layanan_detail" name="id_layanan_detail" required>
                        <option value="">Pilih Layanan Detail</option>
                        <?php foreach ($detaillayanan as $row): ?>
                            <option value="<?= $row->id_layanan_detail; ?>"><?= $row->nama_layanan_detail; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div> 
                    <div class="form-group">
                        <label for="status_permohonan">Status Permohonan</label>
                        <select class="form-control" id="status_permohonan" name="status_permohonan" required>
                            <option value="Diajukan">Diajukan</option>
                            <option value="Diverifikasi">Diverifikasi</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Ditolak">Ditolak</option>
                            <option value="Selesai">Selesai</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success text-white">Simpan</button>
                </form>
                <!-- Akhir Form Tambah Data Permohonan -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUploadBerkas" tabindex="-1" role="dialog" aria-labelledby="modalTambahPermohonanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPermohonanLabel">Unggah Berkas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Data Permohonan -->
                 <div class="form-group">
        <label for="jenis_izin">Pilih Berkas</label>
        <input type="hidden" class="form-control" id="id_permohonan" name="id_permohonan" value="<?= $user->id_permohonan?>" required>
        <div id="demo-upload" class="dropzone needsclick" >
            <div class="dz-message needsclick">
                Click or drag files here to upload.
                <span class="note needsclick">(Or click to select files from your computer)</span>
            </div>
        </div>
    </div>
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

<!-- Modal Tolak -->
<div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="modalTolakLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTolakLabel">Alasan Penolakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTolak" action="<?= base_url('admin/permohonan/tolak') ?>" method="POST">
                     <input type="hidden" class="form-control" id="nama" name="id_permohonan" value="<?= $user->id_permohonan; ?>">
                    <div class="form-group">
                        <label for="alasan_tolak">Alasan Penolakan</label>
                        <textarea class="form-control" id="alasan_tolak" name="alasan" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger">Tolak Permohonan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Selesai -->
<div class="modal fade" id="modalSelesai" tabindex="-1" role="dialog" aria-labelledby="modalSelesaiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSelesaiLabel">Konfirmasi Selesai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formSelesai" action="<?= base_url('admin/permohonan/selesai') ?>" method="POST">
                    <input type="hidden" class="form-control" id="id_permohonan_selesai" name="id_permohonan" value="<?= $user->id_permohonan; ?>">
                    <div class="form-group">
                        <label for="keterangan_selesai">Keterangan Selesai</label>
                        <textarea class="form-control" id="keterangan_selesai" name="keterangan" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Selesai Permohonan</button>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<!-- Include Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css" integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA==" crossorigin="anonymous" referrerpolicy="no-referrer">

<!-- Include Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js" integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Your custom scripts, including Dropzone initialization -->
<script>
    Dropzone.autoDiscover = false;

    var file_upload = new Dropzone('#demo-upload', {
        url: "<?= base_url('ADMIN/Berkas/proses_upload'); ?>",
        method: "post",
        paramName: "userFile",
        addRemoveLinks: true,
    });

    file_upload.on('sending', function (a, b, c) {
        a.token = Math.random();
        c.append('token', a.token);

        // Append id_permohonan to the form data
        var id_permohonan = document.getElementById('id_permohonan').value;
        c.append('id_permohonan', id_permohonan);

        console.log(file_upload);
    });

    file_upload.on('removedfile', function (a) {
        var token = a.token;
        $.ajax({
            type: "post",
            data: { token: token },
            url: "<?= base_url('ADMIN/Berkas/remove_berkas'); ?>",
            cache: false,
            dataType: "json",
            success: function () {
                console.log('file berhasil dihapus');
            },
            error: function () {
                console.log('gagal dihapus');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Menampilkan modal konfirmasi saat tombol hapus di-klik
        $('.btn-hapus').click(function () {
            var idPermohonan = $(this).data('id');
            $('#modalKonfirmasiHapus').modal('show');
            
            // Remove any existing click event handlers on btn-hapus-confirm
            $('.btn-hapus-confirm').off('click');

            // Menangani aksi penghapusan setelah konfirmasi
            $('.btn-hapus-confirm').on('click', function () {
                // Kirim permintaan penghapusan ke server
                window.location.href = '<?= base_url('admin/permohonan/delete/') ?>' + idPermohonan;
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.btn-proses').click(function (e) {
            e.preventDefault();

            // Ambil URL proses dari atribut href
            var urlProses = $(this).attr('href');

            // Lakukan proses menggunakan AJAX
            $.ajax({
                url: urlProses,
                type: 'GET',
                dataType: 'json', // Explicitly specify that you expect a JSON response
                success: function (data) {
                    // Tampilkan SweetAlert jika proses berhasil
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Proses Berhasil!',
                            text: 'Permohonan Diproses',
                            timer: 2000, // Waktu tampilan alert (ms)
                            showConfirmButton: false // Menyembunyikan tombol OK
                        });

                        // Auto reload page after 2 seconds (same duration as SweetAlert)
                        setTimeout(function () {
                            location.reload();
                        }, 2000);

                        // Show the success card
                        $('.sweet-success').click();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Proses Gagal!',
                            text: data.message // Display the error message from the server
                        });
                    }
                },
                error: function () {
                    // Tampilkan SweetAlert jika terjadi kesalahan dalam AJAX
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: 'Gagal terhubung ke server.'
                    });
                }
            });
        });
    });
</script>






