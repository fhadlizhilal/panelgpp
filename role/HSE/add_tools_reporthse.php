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
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tools</label>
	    <div class="col-sm-9">
	      <select class="form-control form-control-sm" name="tools_id" required>
	      		<option value="">---- Pilih Tools ----</option>
	      	<?php
	      		$q_getTools = mysqli_query($conn, "SELECT * FROM hse_tools WHERE hse_tools.id NOT IN (SELECT tools_id FROM hse_dailyreport_tools WHERE kd_report = '$id')");
	      		while($getTools = mysqli_fetch_array($q_getTools)){
	      	?>
	      			<option value="<?php echo $getTools['id']; ?>"><?php echo $getTools['tools']; ?></option>
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
	 <hr>
	 <div class="form-group row" style="margin-bottom: 8px;">
	 	<label class="col-9 col-form-label" style="font-size: 12px;"><center>Nama Tools</center></label>
	 	<label class="col-3 col-form-label" style="font-size: 12px;"><center>Jumlah</center></label>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	 	<div class="col-9">
	      <select class="form-control form-control-sm" name="tools_id" required>
	      		<option value="">---- Pilih Tools ----</option>
	      	<?php
	      		$q_getTools = mysqli_query($conn, "SELECT * FROM hse_tools WHERE hse_tools.id NOT IN (SELECT tools_id FROM hse_dailyreport_tools WHERE kd_report = '$id')");
	      		while($getTools = mysqli_fetch_array($q_getTools)){
	      	?>
	      			<option value="<?php echo $getTools['id']; ?>"><?php echo $getTools['tools']; ?></option>
	      	<?php } ?>
	      </select>
	    </div>
	    <div class="col-3">
	      <input type="number" class="form-control form-control-sm" name="jumlah" min="1" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="kd_report" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_tools_reporthse" value="Simpan">
	<!-- /.card-footer -->
</form>