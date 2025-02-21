<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_note = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_note WHERE id = '$id'"));
    	$get_dailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$get_note[kd_report]'"));
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_dailyreport[project_id]'"));
	}
?>
<form method="POST" action="">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" value="<?php echo $get_project['nama_project']; ?>" disabled>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tgl Report</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" value="<?php echo date("d-m-Y", strtotime($get_dailyreport['tgl_report'])); ?>" disabled>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Note / Kendala</label>
	    <div class="col-sm-9">
	      <textarea class="form-control form-control-sm" name="note" required><?php echo $get_note['note']; ?></textarea>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_dailyreportnote" value="Ubah">
	<!-- /.card-footer -->
</form>