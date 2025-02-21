<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_hseProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$id'"));
    	$get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_hseProject[hse_officer]'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-4 col-form-label" style="font-size: 12px;">Nama Project</label>
		    <div class="col-sm-8">
		      <input type="text" name="nama_project" class="form-control form-control-sm" value="<?php echo $get_hseProject['nama_project']; ?>" disabled>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-4 col-form-label" style="font-size: 12px;">Kota</label>
		    <div class="col-sm-8">
		      <input type="text" name="kota" class="form-control form-control-sm" value="<?php echo $get_hseProject['kota']; ?>" disabled>
		    </div>
		</div>
	  	<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-4 col-form-label" style="font-size: 12px;">HSE Officer</label>
		    <div class="col-sm-8">
		      <input type="text" name="" class="form-control form-control-sm" value="<?php echo $get_manpower['nama']; ?>" disabled>
		      <input type="hidden" name="hse_officer_nama" value="<?php echo $get_manpower['nama']; ?>">
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 0px;">
		    <label class="col-sm-4 col-form-label" style="font-size: 12px;">Handover to</label>
		    <div class="col-sm-8">
		      <select name="handover_to" class="form-control form-control-sm" required>
		      	<option value="" selected disabled>--- Pilih HSE Officer ---</option>
		      	<?php
		      		$q_getHseOfficer = mysqli_query($conn, "SELECT * FROM hse_user WHERE manpower_id != '$get_manpower[id]'");
		      		while($getHseOfficer = mysqli_fetch_array($q_getHseOfficer)){
		      			$get_manpower_name = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$getHseOfficer[manpower_id]'"));
		      	?>
		      			<option value="<?php echo $getHseOfficer['manpower_id']; ?>"><?php echo $get_manpower_name['nama']; ?></option>
		      	<?php } ?>
		      </select>
		    </div>
		</div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_handover_project" value="Handover">
	<!-- /.card-footer -->
</form>