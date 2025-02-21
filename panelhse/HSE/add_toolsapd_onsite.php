<?php
	error_reporting(0);
	session_start();
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
		$project_id = $_POST['getID'];
		$jml_list = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite WHERE project_id = '$project_id'"))+1;
	}
?>


	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-4 col-form-label" style="font-size: 12px;">Keterangan</label>
	    <div class="col-8">
	    	<input type="text" name="cc" value="<?php echo "Tools & APD Onsite - ".$jml_list; ?>" disabled>
	    	<input type="hidden" name="keterangan" value="<?php echo "Tools & APD Onsite - ".$jml_list; ?>">
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-4 col-form-label" style="font-size: 12px;">Tanggal Onsite</label>
	    <div class="col-5">
	      <input type="date" class="form-control form-control-sm" name="tanggal" required>
	    </div>
	</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
	<input type="hidden" name="hse_officer" value="<?php echo $_SESSION['manpower_id'] ?>">
	<!-- /.card-footer -->