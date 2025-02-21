<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_hseProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$id'"));
    	$get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_hseProject[hse_officer]'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-4 col-form-label" style="font-size: 12px;">Nama Project</label>
		    <div class="col-sm-8">
		      <input type="text" name="nama_project" class="form-control form-control-sm" value="<?php echo $get_hseProject['nama_project']; ?>" disabled>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-4 col-form-label" style="font-size: 12px;">Nama Manpower</label>
		    <div class="col-sm-8">
		      <select class="form-control form-control-sm" name="manpower_id" required>
		      	<option value="" selected disabled>---- Pilih Manpower ----</option>
		      	<?php
		      		$q_getManpower = mysqli_query($conn, "SELECT * FROM hse_manpower JOIN hse_inductionreport_spk ON hse_manpower.nik = hse_inductionreport_spk.nik JOIN hse_inductionreport ON hse_inductionreport.id = hse_inductionreport_spk.induction_id WHERE hse_inductionreport.project_id = '$id' AND NOT EXISTS (SELECT * FROM hse_manpower_project WHERE hse_manpower.id = hse_manpower_project.manpower_id AND hse_manpower_project.project_id = '$id')");
		      		while($get_manpower = mysqli_fetch_row($q_getManpower)){
		      	?>
		      		<option value="<?php echo $get_manpower[0]; ?>"><?php echo $get_manpower['2']; ?></option>
		      	<?php } ?>
		      </select>
		    </div>
		</div>
	  	<div class="form-group row">
		    <label class="col-sm-4 col-form-label" style="font-size: 12px;">Jabatan</label>
		    <div class="col-sm-8">
		      <select class="form-control form-control-sm" name="jabatan_id" required>
		      	<option value="" selected disabled>---- Pilih Jabatan ----</option>
		      	<?php
		      		$q_getJabatan = mysqli_query($conn, "SELECT * FROM hse_jabatan");
		      		while($get_jabatan = mysqli_fetch_array($q_getJabatan)){
		      	?>
		      		<option value="<?php echo $get_jabatan['id']; ?>"><?php echo $get_jabatan['jabatan']; ?></option>
		      	<?php } ?>
		      </select>
		    </div>
		</div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="project_id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_manpowerproject" value="Tambah">
	<!-- /.card-footer -->
</form>