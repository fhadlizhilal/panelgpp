<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$id'"));
	}
?>
 <form method="POST" action="">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
	    <div class="col-sm-9">
	      <input type="text" name="nama_project" class="form-control form-control-sm" placeholder="Nama Jabatan" value="<?php echo $get_project['nama_project']; ?>" disabled>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Masuk</label>
	    <div class="col-sm-3">
	      <input type="time" name="jam_masuk" class="form-control form-control-sm" value="<?php echo $get_project['jam_masuk']; ?>" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jam Pulang</label>
	    <div class="col-sm-3">
	      <input type="time" name="jam_pulang" class="form-control form-control-sm" value="<?php echo $get_project['jam_pulang']; ?>" required>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_jamkerja" value="Ubah">
	<!-- /.card-footer -->
</form>