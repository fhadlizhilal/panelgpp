<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$id'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
	    <div class="col-sm-9">
	      <input type="text" name="nama_project" class="form-control form-control-sm" placeholder="Nama Project" value="<?php echo $get_project['nama_project'] ?>" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kota</label>
	    <div class="col-sm-9">
	      <input type="text" name="kota" class="form-control form-control-sm" placeholder="Kota" value="<?php echo $get_project['kota'] ?>" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Masuk</label>
	    <div class="col-sm-9">
	      <input type="time" name="jam_masuk" class="form-control form-control-sm" value="<?php echo $get_project['jam_masuk'] ?>">
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Pulang</label>
	    <div class="col-sm-9">
	      <input type="time" name="jam_pulang" class="form-control form-control-sm" value="<?php echo $get_project['jam_pulang'] ?>">
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tgl Start</label>
	    <div class="col-sm-9">
	      <input type="date" name="tgl_start" class="form-control form-control-sm" value="<?php echo $get_project['tgl_start'] ?>">
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 0px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tgl End</label>
	    <div class="col-sm-9">
	      <input type="date" name="tgl_end" class="form-control form-control-sm" value="<?php echo $get_project['tgl_end'] ?>">
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_project" value="Simpan">
	<!-- /.card-footer -->
</form>