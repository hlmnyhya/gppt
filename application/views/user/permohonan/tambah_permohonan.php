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
                    <div class="card-body">
                       <!-- Form Tambah Data Permohonan -->
    <div class="form-group">
        <label for="jenis_izin">Pilih Berkas</label>
        <input type="text" class="form-control" id="id_permohonan" name="id_permohonan" value=<?= ?> required>
        <div id="demo-upload" class="dropzone needsclick" >
            <div class="dz-message needsclick">
                Click or drag files here to upload.
                <span class="note needsclick">(Or click to select files from your computer)</span>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success text-white">Simpan</button>
                <!-- Akhir Form Tambah Data Permohonan -->
            </div>    
            </div>
        </div>
    </div>
</div>
</div>
<!--**********************************
    Content body end
***********************************-->
