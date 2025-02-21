<?php
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Keterangan</label>
	    <div class="col-9">
	      <textarea class="form-control form-control-sm" name="keterangan" required></textarea>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-9">
	      <input type="file" class="form-control form-control-sm" name="file" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="report_id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="add_lampiran_energylimiter" value="Simpan">
	<!-- /.card-footer -->
</form>