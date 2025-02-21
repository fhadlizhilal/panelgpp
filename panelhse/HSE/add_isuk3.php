<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$array_hasil = explode("/", $id);
    	$project_id = $array_hasil[0];
    	$tgl_report = $array_hasil[1];
	}
?>
<form method="POST" action="" enctype="multipart/form-data">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kejadian</label>
	    <div class="col-sm-9">
	      <select class="form-control form-control-sm" name="kejadian" required>
	      		<option value="" selected disabled>----- Pilih Kejadian -----</option>
	      		<option value="Fatallity">Fatality</option>
	      		<option value="Loss Time Injury">Loss Time Injury</option>
	      		<option value="Medical Treatment Injury">Medical Treatment Injury</option>
	      		<option value="First Aid Injury">First Aid Injury</option>
	      		<option value="Near Miss">Near Miss</option>
	      		<option value="Unsafe Action">Unsafe Action</option>
	      		<option value="Unsafe Condition">Unsafe Condition</option>
	      		<option value="Enviroment Incident">Enviroment Incident</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Manpower</label>
	    <div class="col-sm-9">
	      <select class="form-control form-control-sm" name="manpower_id" required>
	      		<option value="" selected disabled>----- Pilih Manpower -----</option>
	      		<?php
	      			$q_get_manpowerProject = mysqli_query($conn, "SELECT * FROM hse_manpower_project WHERE project_id = '$project_id'");
	      			while($get_manpowerProject = mysqli_fetch_array($q_get_manpowerProject)){
	      				$get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_manpowerProject[manpower_id]'"));
	      		?>
	      				<option value="<?php echo $get_manpower['id'] ?>"><?php echo $get_manpower['nama']; ?></option>
	      		<?php } ?>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Kejadian</label>
	    <div class="col-sm-3">
	      <input type="time" class="form-control form-control-sm" name="jam" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Keterangan Kejadian</label>
	    <div class="col-sm-9">
	      <textarea class="form-control form-control-sm" name="keterangan_kejadian" minlength="25" required></textarea>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;"><i>Corrective Action</i></label>
	    <div class="col-sm-9">
	      <textarea class="form-control form-control-sm" name="corrective_action" minlength="25" required></textarea>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-sm-9">
	      <input type="file" name="file" class="form-control form-control-sm" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="kd_report" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_isuk3_v2" value="Simpan">
	<!-- /.card-footer -->
</form>