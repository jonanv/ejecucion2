<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo SERVERURL ?>views/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo SERVERURL ?>views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SERVERURL ?>views/plugins/adminlte/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo SERVERURL ?>views/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo SERVERURL ?>views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Moment JS -->
<script src="<?php echo SERVERURL ?>views/plugins/moment/moment.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo SERVERURL ?>views/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo SERVERURL ?>views/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo SERVERURL ?>views/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Vue -->
<script src="<?php echo SERVERURL ?>views/public/libs/vue/vue.min.js"></script>
<!-- Axios -->
<script src="<?php echo SERVERURL ?>views/public/libs/axios/axios.min.js"></script>
<!-- Vuelidate -->
<script src="<?php echo SERVERURL ?>views/public/libs/vuelidate/vuelidate.min.js"></script>
<script src="<?php echo SERVERURL ?>views/public/libs/vuelidate/validators.min.js"></script>
<!-- V-mask -->
<script src="<?php echo SERVERURL ?>views/public/libs/v-mask/v-mask.min.js"></script>
<!-- Vue libs -->
<script src="<?php echo SERVERURL ?>views/public/js/vue-libs.js"></script>

<?php
    if (isset($_GET['route'])) {
        $route = explode("/", $_GET['route']);
        $response = $route[0];
    } else {
        $response = "index";
    }

    if (($response == "index")) { ?>
        <script src="<?php echo SERVERURL ?>views/public/js/vue-login.js"></script>
<?php } elseif (($response == "login")) {?>
        <script src="<?php echo SERVERURL ?>views/public/js/vue-login.js"></script>
<?php } elseif (($response == "admin")) {?>
        <script src="<?php echo SERVERURL ?>views/public/js/vue-admin.js"></script>
<?php } elseif (($response == "entry-guardianships")) { ?>
        <script src="<?php echo SERVERURL ?>views/public/js/vue-entry-guardianships.js"></script>
<?php } elseif (($response == "executory")) { ?>
        <script src="<?php echo SERVERURL ?>views/public/js/vue-executory.js"></script>
<?php } ?>