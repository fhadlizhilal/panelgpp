<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$array_hasil = explode("/", $id);
    	$project_id = $array_hasil[0];
    	$tgl_report = $array_hasil[1];
	}
?>
<form method="POST" action="">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama APD</label>
	    <div class="col-sm-9">
	      <select class="form-control form-control-sm" name="apd_id" required>
	      		<option value="">---- Pilih APD ----</option>
	      	<?php
	      		$q_getAPD = mysqli_query($conn, "SELECT * FROM hse_apd WHERE hse_apd.id NOT IN (SELECT apd_id FROM hse_dailyreport_apd WHERE kd_report = '$id')");
	      		while($getAPD = mysqli_fetch_array($q_getAPD)){
	      	?>
	      			<option value="<?php echo $getAPD['id']; ?>"><?php echo $getAPD['nama_apd']; ?></option>
	      	<?php } ?>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jumlah</label>
	    <div class="col-sm-3">
	      <input type="number" class="form-control form-control-sm" name="jumlah" min="1" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="kd_report" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_apd_reporthse" value="Simpan">
	<!-- /.card-footer -->
</form>