<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Antrian</h4>
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
                        <h4 class="card-title">Data Antrian</h4>
                        <button type="button" class="btn btn-danger btn-hapus" id="btnResetAntrian" data-id="<?= $this->session->userdata('id_instansi'); ?>">Reset Antrian<span class="btn-icon-right"><i class="fa fa-refresh"></i></span></button>
                    </div>
                    <div class="card-header">
                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSyarat">Tambah Data<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-dark">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Instansi</th>
                                        <th>Nomor Antrian</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php $no=1; foreach ($antrian as $user): ?>
                                                    <?php
        // Dapatkan id_user dari sesi
        $id_instansi = $this->session->userdata('id_instansi');
    ?>
    <?php if ($user->id_instansi == $id_instansi): ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $user->nama_instansi; ?></td>
            <td><?php echo $user->nomor_antrian ?></td>
            <td>
                <?php
                if ($user->status_antrian == 'Menunggu') {
                    echo '<span class="badge badge-rounded badge-primary">' . $user->status_antrian . '</span>';
                } elseif ($user->status_antrian == 'Selesai') {
                    echo '<span class="badge badge-rounded badge-success">' . $user->status_antrian . '</span>';
                } else {
                    // Handle other cases if needed
                    echo $user->status_antrian;
                }
                ?>
            </td>
            <td>
                <a href="#" class="btn btn-info" onclick="speakPanggil('<?php echo $user->id_antrian; ?>')"><i class="mdi mdi-forward"></i> <span>Panggil</span></a>
                <a href="#" class="btn btn-success btn-selesai" data-id-antrian="<?= $user->id_antrian ?>">
                    <i class="mdi mdi-check-all"></i> <span>Selesai</span>
                </a>
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

<!-- Modal Hapus -->
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
    function speakPanggil(id_antrian) {
        // Gunakan AJAX untuk mengambil data dari server
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url('antrian/getDataByIdAntrian/'); ?>' + id_antrian,
            dataType: 'json',
            success: function (data) {
                if (data) {
                    // Dapatkan data dari respons server
                    var namaInstansi = data.nama_instansi;
                    var nomorAntrian = data.nomor_antrian;
                    var kode = data.kode;

                    // Gabungkan data untuk membentuk teks yang akan dibacakan
                    var textToSpeak = "Nomor Antrian: " + nomorAntrian + " untuk " + namaInstansi + " Silakan menuju loket " + kode;

                    // Cek apakah SpeechSynthesis API tersedia
                    if ('speechSynthesis' in window) {
                        // Dapatkan daftar suara yang tersedia
                        var voices = window.speechSynthesis.getVoices();

                        // Temukan suara wanita berbahasa Indonesia
                        var indonesianFemaleVoice = voices.find(voice => voice.lang === 'id-ID' && voice.name.includes('female'));

                        // Buat instance SpeechSynthesisUtterance
                        var utterance = new SpeechSynthesisUtterance(textToSpeak);

                        // Set suara wanita berbahasa Indonesia
                        utterance.voice = indonesianFemaleVoice;

                        // Opsi tambahan jika diperlukan
                        utterance.rate = 0.7; // Kecepatan bicara
                        utterance.pitch = 1.0; // Tone bicara

                        // Gunakan SpeechSynthesis API untuk membacakan teks
                        speechSynthesis.speak(utterance);
                    } else {
                        alert('Maaf, browser Anda tidak mendukung SpeechSynthesis API.');
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        $(".btn-selesai").click(function (e) {
            e.preventDefault();

            var idAntrian = $(this).data('id-antrian');

            $.ajax({
    type: 'POST',
    url: '<?= base_url('admin/antrian/selesai/') ?>' + idAntrian,
    dataType: 'json',
    success: function (response) {
        if (response.success) {
            // Ganti alert dengan menampilkan pesan flash dari CodeIgniter
            showSuccessMessage(response.message);

            // Handle success, reload or update the page as needed
            location.reload();
        } else {
            // Ganti alert dengan menampilkan pesan flash dari CodeIgniter
            showErrorMessage(response.message);
        }
    },
    error: function (xhr, status, error) {
        console.error('AJAX Error: ' + status + ' - ' + error);
    }
});

function showSuccessMessage(message) {
    // Tambahkan logika untuk menampilkan pesan sukses, misalnya dengan menggunakan elemen HTML atau modal
    console.log('Success: ' + message);
}

function showErrorMessage(message) {
    // Tambahkan logika untuk menampilkan pesan error, misalnya dengan menggunakan elemen HTML atau modal
    console.error('Error: ' + message);
}

        });
    });
</script>


<script>
    $(document).ready(function () {
        // Menampilkan modal konfirmasi saat tombol hapus di-klik
        $('.btn-hapus').click(function () {
            var idInstansi = $(this).data('id');
            $('#modalKonfirmasiHapus').modal('show');

            // Menangani aksi penghapusan setelah konfirmasi
            $('.btn-hapus-confirm').click(function () {
                // Kirim permintaan penghapusan ke server
                window.location.href = '<?= base_url('petugas/antrian/reset/') ?>' + idInstansi;
            });
        });
    });
</script>