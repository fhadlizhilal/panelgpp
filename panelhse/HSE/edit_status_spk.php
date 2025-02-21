<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_inductionreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport WHERE id = '$id'"));
	}
?>
 <form method="POST" action="">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Status</label>
	    <div class="col-sm-9">
	    	<select class="form-control form-control-sm" name="status">
	    		<option value="OPEN" <?php if($get_inductionreport['status'] == "open"){ echo "selected"; } ?>>OPEN</option>
	    		<option value="CLOSED" <?php if($get_inductionreport['status'] == "closed"){ echo "selected"; } ?>>CLOSED</option>
	    	</select>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_status_spk" value="Ubah">
	<!-- /.card-footer -->
</form>