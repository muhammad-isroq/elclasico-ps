<script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Yakin ingin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, logout',
                cancelButtonText: 'Tidak, tetap disini'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?=base_url('Auth/logout');?>";
                }
            });
        });
    </script>

  <!-- Vendor JS Files -->
  <script src="https://cdn.tiny.cloud/1/your-API-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="<?= base_url('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js');?>"></script>
  <script src="<?= base_url('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <script src="<?= base_url('NiceAdmin/assets/vendor/chart.js/chart.umd.js');?>"></script>
  <script src="<?= base_url('NiceAdmin/assets/vendor/echarts/echarts.min.js');?>"></script>
  <script src="<?= base_url('NiceAdmin/assets/vendor/quill/quill.js');?>"></script>
  <script src="<?= base_url('NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js');?>"></script>
  <script src="<?= base_url('NiceAdmin/assets/vendor/tinymce/tinymce.min.js');?>"></script>
  <script src="<?= base_url('NiceAdmin/assets/vendor/php-email-form/validate.js');?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('NiceAdmin/assets/js/main.js');?>"></script>
  
  <!-- Popper.js dan Bootstrap JS -->
<script src="<?= base_url('NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    
</body>

</html>