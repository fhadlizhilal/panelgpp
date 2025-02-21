<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$id'"));
	}
?>
<form method="POST" action="">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Nama Project</label>
	    <div class="col-9">
	      <input type="text" class="form-control form-control-sm" value="<?php echo $get_project['nama_project']; ?>" disabled>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Week</label>
	    <div class="col-3">
	      <select class="form-control form-control-sm" name="week" required>
	      	<?php
	      		for($i=1;$i<=54;$i++){
	      			$cek_week = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE project_id = '$id' AND week = '$i'"));
	      			if($cek_week < 1){
	      	?>
	      			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	      	<?php } } ?>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Tgl Awal</label>
	    <div class="col-4">
	      <input type="date" class="form-control form-control-sm" name="tgl_awal" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Tgl Akhir</label>
	    <div class="col-4">
	      <input type="date" class="form-control form-control-sm" name="tgl_akhir" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="project_id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-success btn-sm" name="submit_add_weeklyreport" value="Generate">
	<!-- /.card-footer -->
</form>