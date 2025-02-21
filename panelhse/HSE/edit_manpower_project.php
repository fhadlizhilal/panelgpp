<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_Manpowerproject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower_project WHERE id = '$id'"));
    	$getProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_Manpowerproject[project_id]'"));
		$getManpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_Manpowerproject[manpower_id]'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-4 col-form-label" style="font-size: 12px;">Nama Project</label>
		    <div class="col-sm-8">
		      <input type="text" name="nama_project" class="form-control form-control-sm" value="<?php echo $getProject['nama_project']; ?>" disabled>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-4 col-form-label" style="font-size: 12px;">Nama Manpower</label>
		    <div class="col-sm-8">
		      <select class="form-control form-control-sm" name="manpower_id" required>
		      	<option value="<?php echo $get_Manpowerproject['manpower_id']; ?>" selected disabled><?php echo $getManpower['nama']; ?></option>
		      	<option value="" disabled>---- Pilih Manpower ----</option>
		      	<?php
		      		$q_getManpower = mysqli_query($conn, "SELECT * FROM hse_manpower WHERE NOT EXISTS (SELECT * FROM hse_manpower_project WHERE hse_manpower.id = hse_manpower_project.manpower_id AND project_id = '$get_Manpowerproject[project_id]')");
		      		while($get_manpower = mysqli_fetch_array($q_getManpower)){
		      	?>
		      		<option value="<?php echo $get_manpower['id']; ?>"><?php echo $get_manpower['nama']; ?></option>
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
		      		<option value="<?php echo $get_jabatan['id']; ?>" <?php if($get_Manpowerproject['jabatan_id'] == $get_jabatan['id']){ echo "selected"; } ?>><?php echo $get_jabatan['jabatan']; ?></option>
		      	<?php } ?>
		      </select>
		    </div>
		</div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="manpowerproject_id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_manpowerproject" value="Ubah">
	<!-- /.card-footer -->
</form>