   

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
              <!-- row -->
            <div class="container-fluid">
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">
                                <h3>Selamat Datang! di Gerai Pelayanan Terpadu</h3></div>
                            <div class="stat-digit"><?= $this->session->userdata('nama') ;?></div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
            <!-- row -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Jumlah Pelayanan Seluruh Instansi </div>
                                    <div class="stat-digit"><?= $total_permohonan; ?></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" style="width: <?= $total_permohonan; ?>%;" aria-valuenow="<?= $total_permohonan; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $total_permohonan; ?>%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Jumlah Antrian</div>
                                    <div class="stat-digit"><?= $total_antrian; ?></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary" role="progressbar" style="width: <?= $total_antrian; ?>%;" aria-valuenow="<?= $total_antrian; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $total_antrian; ?>%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Permohonan Selesai</div>
                                    <div class="stat-digit"><?= $total_permohonan_selesai; ?></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" style="width: <?= $total_permohonan_selesai; ?>%;" aria-valuenow="<?= $total_permohonan_selesai; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $total_permohonan_selesai; ?>%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Permohonan Diajukan</div>
                                    <div class="stat-digit"><?= $total_permohonan_diajukan; ?></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" style="width: <?= $total_permohonan_diajukan; ?>%;" aria-valuenow="<?= $total_permohonan_diajukan; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?= $total_permohonan_diajukan; ?>%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
              <div class="row">
    <div class="col-xl-8 col-lg-8">
        <div class="card" style="height: auto;">
            <div class="card-header">
                <h4 class="card-title">Pelayanan Per Instansi</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12"  style="height: 340px;">
                        <!-- Menampilkan grafik Chart.js -->
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


                     <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="m-t-10">
                            <h4 class="card-title">Tingkat Kepuasan Masyarakat</h4>
                            <h2 class="mt-5"><?= isset($total_kepuasan) ? $total_kepuasan : 0 ?></h2>
                        </div>
                        <div class="widget-card-circle mt-4 mb-5">
                            <img src="<?= base_url();?>assets/emojis/emoji-3.png" alt="" width="90px">
                        </div>
                        <ul class="widget-line-list mb-5 mb-1">
                               <ul class="widget-line-list m-b-15">
   <li class="border-right" style="font-size: 25px;"><?= $total_kepuasan * $komentar_rate->positive * 10?>% <br><span class="text-success"><i class="ti-hand-point-up"></i> Positive</span></li>

    <li style="font-size: 25px;"><?= $total_kepuasan * $komentar_rate->negative * 10  ?>% <br><span class="text-danger"><i class="ti-hand-point-down"></i>Negative</span></li>
</ul>

                        </ul>
                    </div>
                </div>
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

<script>
    // Data dari PHP diubah ke dalam variabel JavaScript
    var permohonanByInstansi = <?php echo json_encode($permohonan_by_instansi); ?>;

    // Ambil data nama_instansi, jumlah_selesai, dan jumlah_diajukan
    var labels = permohonanByInstansi.map(data => data.nama_instansi);
    var dataSelesai = permohonanByInstansi.map(data => data.jumlah_selesai);
    var dataDiajukan = permohonanByInstansi.map(data => data.jumlah_diajukan);

    // Buat grafik menggunakan Chart.js
    var ctx = document.getElementById('barChart').getContext('2d');
    var myBarChart = new Chart(ctx, {
        type: 'bar',
      data: {
    labels: labels,
    datasets: [{
        label: 'Jumlah Selesai',
        data: dataSelesai,
        backgroundColor: 'rgba(0, 123, 255, 0.5)', // Warna biru
        borderColor: 'rgba(0, 123, 255, 1)',
        borderWidth: 1
    }, {
        label: 'Jumlah Diajukan',
        data: dataDiajukan,
        backgroundColor: 'rgba(40, 167, 69, 0.5)', // Warna hijau
        borderColor: 'rgba(40, 167, 69, 1)',
        borderWidth: 1
    }]
},

        options: {
            scales: {
                x: { type: 'category', position: 'bottom' },
                y: { beginAtZero: true }
            }
        }
    });
</script>
