<!-- ... Bagian Header dan Konten sebelumnya ... -->

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Berkas Permohonan</h4>
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
                        <h4 class="card-title">Berkas Permohonan</h4>
                    </div>
                    <div class="card-header">
                        <!-- <a href="<?= base_url('admin/berkas/view/tambah')?>" type="button" class="btn btn-primary">Tambah Data<span class="btn-icon-right"><i class="fa fa-plus"></i></span></a> -->
                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPermohonan">Tambah Data<span class="btn-icon-right"><i class="fa fa-plus"></i></span></button> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-dark">
                            <!-- Display Pemohon, Nama Layanan, Nama Layanan Detail -->
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Pemohon:</strong> <?= $permohonan[0]->nama; ?>
                                </div>
                                <div class="col-md-4">
                                    <strong>Nama Layanan:</strong> <?= $permohonan[0]->nama_layanan; ?>
                                </div>
                                <div class="col-md-4">
                                    <strong>Nama Layanan Detail:</strong> <?= $permohonan[0]->nama_layanan_detail; ?>
                                </div>
                            </div>

                            <!-- Embedded PDF File -->
                           <div class="row mt-3">
                               <div class="col-md-12">
                                   <?php if (!empty($permohonan)) : ?>
                                    <?php foreach ($permohonan as $fileInfo) : ?>
                                        <?php if (isset($fileInfo->file)) : ?>
                                            <iframe src="<?= base_url('./uploads/berkas/' . $fileInfo->file) ?>" width="100%" height="500px"></iframe>
                                            <?php else : ?>
                                                <p>No file available</p>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                                <?php else : ?>
                                                    <p>No files available</p>
                                                    <?php endif; ?>
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
    