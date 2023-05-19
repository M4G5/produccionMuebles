
<script>
  const base_url = "<?php echo URL; ?>";
</script>
<script src="<?php echo JS ?>jquery.min.js"></script>
<script src="<?php echo JS ?>jquery-ui.min.js"></script>
<script src="<?php echo JS ?>bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo JS ?>adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php echo JS ?>pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo JS ?>demo.min.js"></script> -->
<script src="<?php echo JS ?>datatables.min.js"></script>
<script src="<?php echo JS ?>bootstrap-datepicker.min.js"></script>
<script src="<?php echo JS ?>spanish/datapiker_es.js"></script>
<script src="<?php echo JS ?>select2.min.js"></script>
<script src="<?php echo JS ?>spanish/select2_es.js"></script>

<?php 
if( $d->page == 'users'){ ?>
  <script src="<?php echo JS ?>files_js/user.js"></script>
<?php } 
if($d->page == 'porcentaje'){ ?>
  <script src="<?php echo JS ?>files_js/control.js"></script>
<?php }
if($d->page == 'reportes_muebles'){ ?>
  <script src="<?php echo JS ?>files_js/muebles.js"></script>
<?php } ?>

</body>
</html>