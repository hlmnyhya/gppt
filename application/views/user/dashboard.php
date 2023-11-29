<!--**********************************
Content body start
***********************************-->
<!-- row -->
<div class="content-body">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">
                            <h3>Selamat Datang! di Gerai Pelayanan Terpadu</h3>
                        </div>
                        <div class="stat-digit"><?= $this->session->userdata('nama'); ?></div>
                    </div>
                </div>
<?php
// var_dump($permohonan_data);exit;
foreach ($permohonan_data as $permohonan) : ?>
            <div class="sweetalert mt-5">
                <button class="sweet-success-cancel" data-id="<?= $permohonan['id_user']; ?>"></button>
</div>
<?php endforeach; ?>



            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Jumlah Permohonan Diajukan </div>
                        <div class="stat-digit"><?= $count_diajukan; ?></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success w-<?= $count_diajukan; ?>" role="progressbar" aria-valuenow="<?= $count_diajukan; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Jumlah Permohonan Selesai</div>
                        <div class="stat-digit"><?= $count_selesai; ?></div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary w-<?= $count_selesai; ?>" role="progressbar" aria-valuenow="<?= $count_selesai; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
            <!-- /# column -->
            
            
        </div>
</div>
</div>
</div>
<!--**********************************
Content body end
***********************************-->

<script>
    $(document).ready(function () {
        // Fungsi untuk menampilkan SweetAlert saat halaman dimuat
        function showSweetAlert() {
            var id_user = $('.sweet-success-cancel').data('id');

            // Fetch additional data based on the id_permohonan using AJAX
            $.ajax({
                url: 'Dashboard/get_permohonan_data/' + id_user,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    // Check for errors
                    if (data.error) {
                        Swal.fire('Error', data.error, 'error');
                    } else {
                        // Use SweetAlert to display the data
                        Swal.fire({
                            title: '<h2>Pemberitahuan!</h2>',
                            html: `
                                <h3>${data[0].nama}</h3>
                                <h3>${data[0].alasan}</h3>
                                <!-- Add other fields as needed -->
                            `,
                        });
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                    Swal.fire('Error', 'Failed to fetch data', 'error');
                }
            });
        }

        // Panggil fungsi saat halaman dimuat
        showSweetAlert();
    });
</script>
