<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$id'"));
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
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Status Project</label>
	    <div class="col-sm-9">
	      <select name="status_project" class="form-control form-control-sm">
	      	<option value="ongoing" <?php if($get_project['status_project'] == "ongoing"){ echo "selected"; } ?>>Ongoing</option>
	      	<option value="hold" <?php if($get_project['status_project'] == "hold"){ echo "selected"; } ?>>Hold</option>
	      	<option value="closed" <?php if($get_project['status_project'] == "closed"){ echo "selected"; } ?>>Closed</option>
	      </select>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_statusproject" value="Simpan">
	<!-- /.card-footer -->
</form>