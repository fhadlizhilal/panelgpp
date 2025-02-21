<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
	}
?>
 <form method="POST" action="">
	<div style="font-size: 12px;">Anda akan menghapus data manpower di project ini, silahkan get data manpower terbaru setelah ini untuk melengkapi dailyreport.</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="kd_report" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-danger btn-sm" name="clear_datamanpower" value="Clear Data">
	<!-- /.card-footer -->
</form>