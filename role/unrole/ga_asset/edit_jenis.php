<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_jenis = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ga_jenis WHERE id = '$id'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jenis</label>
		    <div class="col-sm-9">
		      <input type="text" name="jenis" class="form-control form-control-sm" value="<?php echo $get_jenis['jenis']; ?>" required>
		    </div>
		</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_jenis" value="Simpan">
	<!-- /.card-footer -->
</form>