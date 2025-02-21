<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$array_hasil = explode("/", $id);
    	$project_id = $array_hasil[0];
    	$tgl_report = $array_hasil[1];

    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$project_id'"));
	}
?>
<form method="POST" action="" enctype="multipart/form-data">
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" value="<?php echo $get_project['nama_project']; ?>" disabled>
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tgl Report</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" value="<?php echo date("d-m-Y", strtotime($tgl_report)); ?>" disabled>
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Pekerjaan</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="pekerjaan" required>
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-sm-9">
	      <input type="file" class="form-control form-control-sm" accept="image/*" name="file" required>
	    </div>
	</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="kd_report" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_dokumentasiproject_v2" value="Simpan">
	<!-- /.card-footer -->
</form>