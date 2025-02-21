<?php
	require_once "../../dev/config.php";
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
		$get_dataEnergyLimiter = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportenergylimiter_detail WHERE id = '$id'"));
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Barcode</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="barcode" value="<?php echo $get_dataEnergyLimiter['barcode']; ?>" required>
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Power Limit</label>
	    <div class="col-sm-3">
	      <input type="text" class="form-control form-control-sm" name="power_limit" value="<?php echo $get_dataEnergyLimiter['power_limit']; ?>" required>
	    </div>
	    <div class="col-sm-1"><small>Watt</small></div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Credit Setting</label>
	    <div class="col-sm-3">
	      <input type="text" class="form-control form-control-sm" name="credit_setting" value="<?php echo $get_dataEnergyLimiter['credit_setting']; ?>" required>
	    </div>
	    <div class="col-sm-1"><small>Wh</small></div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Time Reset</label>
	    <div class="col-sm-3">
	      <input type="time" class="form-control form-control-sm" name="time_reset" value="<?php echo $get_dataEnergyLimiter['time_reset']; ?>" required>
	    </div>
	    <div class="col-sm-3">
		      <select class="form-control form-control-sm" name="time_region" required>
		      	<option value="WIB" <?php if($get_dataEnergyLimiter['time_region'] == "WIB"){ echo "selected"; } ?>>WIB</option>
		      	<option value="WITA" <?php if($get_dataEnergyLimiter['time_region'] == "WITA"){ echo "selected"; } ?>>WITA</option>
		      	<option value="WIT" <?php if($get_dataEnergyLimiter['time_region'] == "WIT"){ echo "selected"; } ?>>WIT</option>
		      </select>
		 </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-sm-9">
	    	<img src="dokumentasi_report/<?php echo $get_dataEnergyLimiter['foto']; ?>" width="40%">
	      <input type="file" class="form-control form-control-sm" name="file">
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_data_energylimiter" value="Ubah">
	<!-- /.card-footer -->
</form>