<?php
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Barcode</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="barcode" required>
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Power Limit</label>
	    <div class="col-sm-3">
	      <input type="text" class="form-control form-control-sm" name="power_limit" required>
	    </div>
	    <div class="col-sm-1"><small>Watt</small></div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Credit Setting</label>
	    <div class="col-sm-3">
	      <input type="text" class="form-control form-control-sm" name="credit_setting" required>
	    </div>
	    <div class="col-sm-1"><small>Wh</small></div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Time Reset</label>
	    <div class="col-sm-3">
	      <input type="time" class="form-control form-control-sm" name="time_reset" required>
	    </div>
	    <div class="col-sm-3">
		      <select class="form-control form-control-sm" name="time_region" required>
		      	<option value="WIB">WIB</option>
		      	<option value="WITA">WITA</option>
		      	<option value="WIT">WIT</option>
		      </select>
		 </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-sm-9">
	      <input type="file" class="form-control form-control-sm" name="file" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="report_id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="add_data_energylimiter" value="Simpan">
	<!-- /.card-footer -->
</form>