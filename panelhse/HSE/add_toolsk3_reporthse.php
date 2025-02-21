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
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tools K3</label>
	    <div class="col-sm-9">
	      <select class="form-control form-control-sm" name="toolsk3_id" required>
	      		<option value="">---- Pilih Tools K3 ----</option>
	      	<?php
	      		$q_getToolsk3 = mysqli_query($conn, "SELECT * FROM hse_toolsk3 WHERE hse_toolsk3.id NOT IN (SELECT toolsk3_id FROM hse_dailyreport_toolsk3 WHERE kd_report = '$id')");
	      		while($getToolsk3 = mysqli_fetch_array($q_getToolsk3)){
	      	?>
	      			<option value="<?php echo $getToolsk3['id']; ?>"><?php echo $getToolsk3['nama_tools']; ?></option>
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
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_toolsk3_reporthse" value="Simpan">
	<!-- /.card-footer -->
</form>