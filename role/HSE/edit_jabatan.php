<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_jabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_jabatan WHERE id = '$id'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">ID</label>
		    <div class="col-sm-3">
		      <input type="number" name="id_jabatan" class="form-control form-control-sm" value="<?php echo $get_jabatan['id']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jabatan</label>
		    <div class="col-sm-9">
		      <input type="text" name="jabatan" class="form-control form-control-sm" value="<?php echo $get_jabatan['jabatan']; ?>" required>
		    </div>
		</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_jabatan" value="Simpan">
	<!-- /.card-footer -->
</form>