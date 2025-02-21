<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$getToolsReport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_tools WHERE id = '$id'"));
    	$getTools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_tools WHERE id = '$getToolsReport[tools_id]'"));
	}
?>
<form method="POST" action="">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tools</label>
	    <div class="col-sm-9">
	    	<input type="text" class="form-control form-control-sm" value="<?php echo $getTools['tools']; ?>" disabled>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jumlah</label>
	    <div class="col-sm-3">
	     	<input type="number" class="form-control form-control-sm" name="jumlah" min="1" value="<?php echo $getToolsReport['jumlah']; ?>" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_tools_reporthse" value="Ubah">
	<!-- /.card-footer -->
</form>