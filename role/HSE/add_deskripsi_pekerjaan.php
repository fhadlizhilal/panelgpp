<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$array_hasil = explode("-", $id);
    	$kd_weekly = $array_hasil[0];
    	$manpower_id = $array_hasil[1];
    	$jabatan_id = $array_hasil[2];

    	$get_weeklyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE kd_weekly = '$kd_weekly'"));
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_weeklyreport[project_id]'"));
    	$get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$manpower_id'"));

    	$get_dailyreport_deskripsipekerjaan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_deskripsipekerjaan WHERE kd_weekly = '$kd_weekly' AND manpower_id = '$manpower_id' AND jabatan_id = '$jabatan_id'"));
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
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Manpower</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" value="<?php echo $get_manpower['nama']; ?>" disabled>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Deksripsi Pekerjaan</label>
	    <div class="col-sm-9">
	      <textarea class="form-control form-control-sm" name="deskripsi_pekerjaan" required><?php echo $get_dailyreport_deskripsipekerjaan['deskripsi_pekerjaan']; ?></textarea>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $get_dailyreport_deskripsipekerjaan['id']; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_deskripsipekerjaan" value="Simpan">
	<!-- /.card-footer -->
</form>