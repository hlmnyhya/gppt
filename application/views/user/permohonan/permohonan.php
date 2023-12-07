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
    <?php
        // Dapatkan id_user dari sesi
        $id_user_sesi = $this->session->userdata('id_user');
    ?>
    <?php if ($user->id_user == $id_user_sesi): ?>
        <tr>
                <td><?= $no++ ?></td>
                <td><?= $user->permohonan_nama; ?></td>
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
                                echo '<a class="text-white badge badge-rounded badge-danger">' . $status_permohonan . '</a>';
                            } elseif ($status_permohonan == 'Ditolak') {
                                echo '<a class="text-white badge badge-rounded badge-warning">' . $status_permohonan . '</a>';
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
                <?php if ($user->status_permohonan == 'Selesai'): ?>
                    <a type="button" class="btn btn-info btn-ulasan" data-toggle="modal" data-target="#modalKomentar" data-id="<?= $user->id_permohonan ?>" data-nama="<?= $user->permohonan_nama ?>"><i class="mdi mdi-bell"></i> <span>Berikan Ulasan</span></a>
                <?php endif; ?>
                <?php if ($user->status_permohonan != 'Selesai'): ?>
                    <a type="button" class="btn btn-warning btn-ubah" data-toggle="modal" data-target="#modalUpdateBerita" data-id="<?= $user->id_permohonan ?>" data-nama="<?= $user->permohonan_nama ?>"><i class="mdi mdi-pencil"></i> <span>Ubah</span></a>
                    <a href="#" class="btn btn-danger btn-hapus" data-id="<?= $user->id_permohonan ?>"><i class="mdi mdi-delete"></i> <span>Hapus</span></a>
                <?php endif; ?>
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
<div class="modal fade" id="modalKomentar" tabindex="-1" role="dialog" aria-labelledby="modalTambahBeritaLabel" aria-hidden="true">
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
                <form id="formTambahKomentar" action="<?= base_url('user/komentar/tambah')?>" method="POST">
    <div class="form-group">
        <label for="id_user">Nama</label>
        <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user')?>">
        <input type="text" class="form-control" id="layanan" name="nama_layanan" value="<?= $this->session->userdata('nama')?>" placeholder="Nama Layanan" readonly required>
    </div>
        <input type="hidden" name="id_instansi" value="<?= $user->id_instansi?>">
        <input type="hidden" name="id_layanan" value="<?= $user->layanan_instansi?>">
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
                <form id="formTambahPermohonan" action="<?= base_url('user/permohonan/tambah')?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $this->session->userdata('nama'); ?>" placeholder="Nama" required>
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
                            <select class="form-control" id="id_layanan" name="id_layanan" required onchange="getDetailLayanan()">
                                <option value="">Pilih Layanan</option>
                                <!-- Opsi Layanan akan diisi melalui JavaScript -->
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="id_layanan_detail">Layanan Detail</label>
                            <select class="form-control" id="id_layanan_detail" name="id_layanan_detail" required>
                                <option value="">Pilih Layanan Detail</option>
                                <!-- Opsi Layanan Detail akan diisi melalui JavaScript -->
                            </select>
                        </div>
                            <div class="form-group">
                                <label for="status_permohonan">Status Permohonan</label>
                                <select class="form-control" id="status_permohonan" name="status_permohonan" required>
                                    <option value="Diajukan">Diajukan</option>
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
            <?php foreach ($layanan as $layanan): ?>
                <option value="<?= $layanan->id_layanan; ?>"><?= $layanan->nama_layanan; ?></option>
            <?php endforeach; ?>
        </select>
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


<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<!-- Include Dropzone CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css" integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA==" crossorigin="anonymous" referrerpolicy="no-referrer">

<!-- Include Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js" integrity="sha512-Mn7ASMLjh+iTYruSWoq2nhoLJ/xcaCbCzFs0ZrltJn7ksDBx+e7r5TS7Ce5WH02jDr0w5CmGgklFoP9pejfCNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Your custom scripts, including Dropzone initialization -->
<script>
    Dropzone.autoDiscover = false;

    var file_upload = new Dropzone('#demo-upload', {
        // Dropzone configuration options
        url: "<?= base_url('USER/Berkas/proses_upload'); ?>",
        method: "post",
        paramName: "userFile",
        addRemoveLinks: true,
        autoProcessQueue: false, // Disable auto-upload
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
        // Code to remove file from the server
    });

    // Event listener for the trigger button
    document.getElementById('uploadTrigger').addEventListener('click', function () {
        // Process and upload files
        file_upload.processQueue();
    });
</script>
<script>
    // Your existing Dropzone initialization script

    // Event listener for the trigger button
    document.getElementById('uploadTrigger').addEventListener('click', function () {
        // Process and upload files
        file_upload.processQueue();
    });

    // Retrieve existing files from the server and display them in Dropzone
    Dropzone.on('init', function () {
        var id_permohonan = document.getElementById('id_permohonan').value;

        // Ajax request to fetch existing files for the specific id_permohonan
        $.ajax({
            url: "<?= base_url('USER/Berkas/get_existing_files'); ?>",
            type: "post",
            data: { id_permohonan: id_permohonan },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    // Display existing files in Dropzone
                    response.files.forEach(function (file) {
                        var mockFile = { name: file.nama_file, size: file.ukuran_file };
                        file_upload.emit('addedfile', mockFile);
                        file_upload.emit('thumbnail', mockFile, file.thumbnail_url);
                        file_upload.emit('complete', mockFile);
                    });
                }
            },
            error: function () {
                console.log('Failed to fetch existing files.');
            }
        });
    });
</script>

<script>
    // Fungsi untuk mengambil data layanan berdasarkan instansi
    function getLayanan() {
        var id_instansi = $('#id_instansi').val();

        $.ajax({
            url: '<?= base_url('USER/Permohonan/get_layanan_by_instansi'); ?>',
            method: 'post',
            data: {id_instansi: id_instansi},
            dataType: 'json',
            success: function(data) {
                // Hapus opsi layanan yang ada
                $('#id_layanan').empty();
                $('#id_layanan_detail').empty();

                // Tambahkan opsi layanan baru
                $('#id_layanan').append('<option value="">Pilih Layanan</option>');
                $.each(data, function(index, value) {
                    $('#id_layanan').append('<option value="' + value.id_layanan + '">' + value.nama_layanan + '</option>');
                });
            }
        });
    }

    // Fungsi untuk mengambil data layanan detail berdasarkan layanan
    function getDetailLayanan() {
        var id_layanan = $('#id_layanan').val();

        $.ajax({
            url: '<?= base_url('USER/Permohonan/get_detail_layanan_by_layanan'); ?>',
            method: 'post',
            data: {id_layanan: id_layanan},
            dataType: 'json',
            success: function(data) {
                // Hapus opsi detail layanan yang ada
                $('#id_layanan_detail').empty();

                // Tambahkan opsi detail layanan baru
                $('#id_layanan_detail').append('<option value="">Pilih Layanan Detail</option>');
                $.each(data, function(index, value) {
                    $('#id_layanan_detail').append('<option value="' + value.id_layanan_detail + '">' + value.nama_layanan_detail + '</option>');
                });
            }
        });
    }
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
                window.location.href = '<?= base_url('admin/syarat/delete/') ?>' + idPermohonan;
            });
        });
    });
</script>