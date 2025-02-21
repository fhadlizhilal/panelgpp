<?php
	require_once "../../dev/config.php";
?>
 <form method="POST" action="">
	<div class="card-body">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
	    <div class="col-sm-9">
	      <input type="text" name="nama_project" class="form-control form-control-sm" placeholder="Nama Project" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kota</label>
	    <div class="col-sm-9">
	      <input type="text" name="kota" class="form-control form-control-sm" placeholder="Kota" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">HSE Officer</label>
	    <div class="col-sm-9">
	      <select name="hse_officer" class="form-control form-control-sm" required>
	      	<option value="">--- Pilih HSE Officer ---</option>\
	      	<?php
	      		$q_getHSEOfficer = mysqli_query($conn, "SELECT * FROM hse_user");
	      		while($getHSEOfficer = mysqli_fetch_array($q_getHSEOfficer)){
	      			$get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$getHSEOfficer[manpower_id]'"));
	      	?>
	      			<option value="<?php echo $getHSEOfficer['manpower_id']; ?>"><?php echo $get_manpower['nama']; ?></option>
	      	<?php } ?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Masuk</label>
	    <div class="col-sm-4">
	      <input type="time" name="jam_masuk" class="form-control form-control-sm" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Pulang</label>
	    <div class="col-sm-4">
	      <input type="time" name="jam_pulang" class="form-control form-control-sm" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tanggal Start</label>
	    <div class="col-sm-4">
	      <input type="date" name="tgl_start" class="form-control form-control-sm" required>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_project" value="Submit">
	<!-- /.card-footer -->
</form>