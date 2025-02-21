<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_dailyreport_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower WHERE id = '$id'"));
		$get_dailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$get_dailyreport_manpower[kd_report]'"));
		$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_dailyreport[project_id]'"));
		$get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_dailyreport_manpower[manpower_id]'"));
	}
?>
 <form method="POST" action="">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
	    <div class="col-sm-9">
	      <input type="text" name="nama_project" class="form-control form-control-sm" value="<?php echo $get_project['nama_project']; ?>" disabled>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Manpower</label>
	    <div class="col-sm-9">
	      <input type="text" name="nama_project" class="form-control form-control-sm" value="<?php echo $get_manpower['nama']; ?>" disabled>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tgl Report</label>
	    <div class="col-sm-9">
	      <input type="text" name="nama_project" class="form-control form-control-sm" value="<?php echo date("d-m-Y", strtotime($get_dailyreport['tgl_report'])); ?>" disabled>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Masuk</label>
	    <div class="col-sm-3">
	      <input type="time" name="jam_masuk" class="form-control form-control-sm" value="<?php echo $get_dailyreport_manpower['jam_masuk']; ?>" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Pulang</label>
	    <div class="col-sm-3">
	      <input type="time" name="jam_pulang" class="form-control form-control-sm" value="<?php echo $get_dailyreport_manpower['jam_pulang']; ?>" required>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_jamKerjaManpower" value="Ubah">
	<!-- /.card-footer -->
</form>