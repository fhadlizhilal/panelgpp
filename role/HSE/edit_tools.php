<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_tools WHERE id = '$id'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tools</label>
	    <div class="col-sm-9">
	      <input type="text" name="tools" class="form-control form-control-sm" placeholder="Nama Tools" value="<?php echo $get_tools['tools']; ?>" required>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_tools" value="Simpan">
	<!-- /.card-footer -->
</form>