<?php
	require_once "../../dev/config.php";
?>
 
	<div class="card-body">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Sertifikat</label>
	    <div class="col-sm-9">
	      <select name="sertifikat_id" class="form-control form-control-sm" required>
	      	<option value="" selected disabled>-- Pilih Jenis Sertifikat --</option>
	      	<?php
	      		$q_getSertifikat = mysqli_query($conn, "SELECT * FROM hse_sertifikat");
	      		while($get_sertifikat = mysqli_fetch_array($q_getSertifikat)){
	      	?>
	      			<option value="<?php echo $get_sertifikat['id'] ?>"><?php echo $get_sertifikat['nama_sertifikat']; ?></option>
	      	<?php } ?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Manpower</label>
	    <div class="col-sm-9">
	      <select name="hsemanpower_id" class="form-control form-control-sm" required>
	      	<option value="" selected disabled>-- Pilih Nama Manpower --</option>
	      	<?php
	      		$q_getManpower = mysqli_query($conn, "SELECT * FROM hse_manpower");
	      		while($get_manpower = mysqli_fetch_array($q_getManpower)){
	      	?>
	      			<option value="<?php echo $get_manpower['id'] ?>"><?php echo $get_manpower['nama']; ?></option>
	      	<?php } ?>
	      </select>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">File Sertifikat</label>
	    <div class="col-sm-9">
	      <input type="file" class="form-control form-control-sm" name="file" required>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_sertifikasi" value="Submit">
	<!-- /.card-footer -->