<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_apd_report = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_apd WHERE id = '$id'"));
    	$get_apd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_apd WHERE id = '$get_apd_report[apd_id]'"));
	}
?>
<form method="POST" action="">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama APD</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" value="<?php echo $get_apd['nama_apd']; ?>" disabled>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jumlah</label>
	    <div class="col-sm-3">
	      <input type="number" class="form-control form-control-sm" name="jumlah" min="1" value="<?php echo $get_apd_report['jumlah']; ?>" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_apd_reporthse" value="Simpan">
	<!-- /.card-footer -->
</form>