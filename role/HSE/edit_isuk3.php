<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_isuk3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE id = '$id'"));
	}
?>
<form method="POST" action="">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kejadian</label>
	    <div class="col-sm-9">
	      <select class="form-control form-control-sm" name="kejadian" required>
	      		<option value="" selected disabled>----- Pilih Kejadian -----</option>
	      		<option value="Fatallity" <?php if($get_isuk3['kejadian'] == "Fatallity"){ echo "selected"; }  ?>>Fatallity</option>
	      		<option value="Loss Time Injury" <?php if($get_isuk3['kejadian'] == "Loss Time Injury"){ echo "selected"; }  ?>>Loss Time Injury</option>
	      		<option value="Medical Treatment Injury" <?php if($get_isuk3['kejadian'] == "Medical Treatment Injury"){ echo "selected"; }  ?>>Medical Treatment Injury</option>
	      		<option value="First Aid Injury" <?php if($get_isuk3['kejadian'] == "First Aid Injury"){ echo "selected"; }  ?>>First Aid Injury</option>
	      		<option value="Near Miss" <?php if($get_isuk3['kejadian'] == "Near Miss"){ echo "selected"; }  ?>>Near Miss</option>
	      		<option value="Enviroment Incident" <?php if($get_isuk3['kejadian'] == "Enviroment Incident"){ echo "selected"; }  ?>>Enviroment Incident</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Manpower</label>
	    <div class="col-sm-9">
	      <select class="form-control form-control-sm" name="manpower_id" required>
	      		<option value="" selected disabled>----- Pilih Manpower -----</option>
	      		<?php
	      			$q_get_manpower = mysqli_query($conn, "SELECT * FROM hse_manpower ");
	      			while($get_manpower = mysqli_fetch_array($q_get_manpower)){
	      		?>
	      				<option value="<?php echo $get_manpower['id']; ?>" <?php if($get_manpower['id'] == $get_isuk3['manpower_id']){ echo "selected"; } ?>><?php echo $get_manpower['nama']; ?></option>
	      		<?php } ?>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Kejadian</label>
	    <div class="col-sm-3">
	      <input type="time" class="form-control form-control-sm" name="jam" value="<?php echo $get_isuk3['jam']; ?>" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Keterangan Kejadian</label>
	    <div class="col-sm-9">
	      <textarea class="form-control form-control-sm" name="keterangan_kejadian" minlength="25" required><?php echo $get_isuk3['keterangan_kejadian']; ?></textarea>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;"><i>Corrective Action</i></label>
	    <div class="col-sm-9">
	      <textarea class="form-control form-control-sm" name="corrective_action" minlength="25" required><?php echo $get_isuk3['corrective_action']; ?></textarea>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_ubah_isuk3_v2" value="Ubah">
	<!-- /.card-footer -->
</form>