<!--**********************************
    Footer start
***********************************-->
<div class="footer">
    <div class="copyright">
        <p>Copyright © <?= Date('Y')?></p>
    </div>
</div>
<!--**********************************
    Footer end
***********************************-->

<!--**********************************
    Support ticket button start
***********************************-->

<!--**********************************
    Support ticket button end
***********************************-->

</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="<?= base_url('assets/vendor/global/global.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/quixnav-init.js'); ?>"></script>
<script src="<?= base_url('assets/js/custom.min.js'); ?>"></script>

<!-- Vectormap -->
<script src="<?= base_url('assets/vendor/raphael/raphael.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/morris/morris.min.js'); ?>"></script>

<script src="<?= base_url('assets/vendor/circle-progress/circle-progress.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/chart.js/Chart.bundle.min.js'); ?>"></script>

<script src="<?= base_url('assets/vendor/gaugeJS/dist/gauge.min.js'); ?>"></script>

<!-- flot-chart js -->
<script src="<?= base_url('assets/vendor/flot/jquery.flot.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/flot/jquery.flot.resize.js'); ?>"></script>

<!-- Owl Carousel -->
<script src="<?= base_url('assets/vendor/owl-carousel/js/owl.carousel.min.js'); ?>"></script>

<!-- Counter Up -->
<script src="<?= base_url('assets/vendor/jqvmap/js/jquery.vmap.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/jqvmap/js/jquery.vmap.usa.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/jquery.counterup/jquery.counterup.min.js'); ?>"></script>

<script src="<?= base_url('assets/js/dashboard/dashboard-1.js'); ?>"></script>

<!-- Required vendors -->
<script src="<?= base_url('assets/vendor/global/global.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/quixnav-init.js'); ?>"></script>
<script src="<?= base_url('assets/js/custom.min.js'); ?>"></script>

<!-- Datatable -->
<script src="<?= base_url('assets/vendor/datatables/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/plugins-init/datatables.init.js'); ?>"></script>

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
        url: "<?= base_url('ADMIN/Berkas/proses_upload'); ?>",
        method: "post",
        paramName: "userFile",
        addRemoveLinks: true,
    });

    file_upload.on('sending', function (a, b, c) {
        a.token = Math.random();
        c.append('token', a.token);
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

</body>

</html>
