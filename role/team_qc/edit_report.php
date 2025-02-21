<?php
	require_once "../../dev/config.php";
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
		$get_dataReport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlist WHERE id = '$id'"));
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Pekerjaan</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="nm_pekerjaan" value="<?php echo $get_dataReport['nm_pekerjaan']; ?>" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tgl Report</label>
	    <div class="col-sm-4">
	      <input type="date" class="form-control form-control-sm" name="tgl_report" value="<?php echo $get_dataReport['tgl']; ?>" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_report" value="Ubah">
	<!-- /.card-footer -->
</form>