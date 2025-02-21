<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_hseUser = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_user WHERE id = '$id'"));
    	$get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_hseUser[manpower_id]'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
		 <div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Lengkap</label>
		    <div class="col-sm-9">
		      <input type="text" class="form-control form-control-sm" value="<?php echo $get_manpower['nama']; ?>" disabled>
		    </div>
		 </div>
		 <div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Username</label>
		    <div class="col-sm-9">
		      <input type="text" name="username" class="form-control form-control-sm" placeholder="Username" value="<?php echo $get_hseUser['username']; ?>" required>
		    </div>
		 </div>
		 <div class="form-group row" style="margin-bottom: 0px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Password</label>
		    <div class="col-sm-9">
		      <input type="text" name="password" class="form-control form-control-sm" placeholder="Password" value="<?php echo $get_hseUser['password']; ?>" required>
		    </div>
		 </div>
	</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_hseuser" value="Simpan">
	<!-- /.card-footer -->
</form>