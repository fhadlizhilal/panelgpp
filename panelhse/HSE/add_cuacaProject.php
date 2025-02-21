<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$array_hasil = explode("/", $id);
    	$project_id = $array_hasil[0];
    	$tgl_report = $array_hasil[1];

    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$project_id'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Cuaca</label>
		    <div class="col-sm-9">
		     	<select class="form-control form-control-sm" name="cuaca" required>
		      		<option value="Full Cerah">Full Cerah</option>
		      		<option value="Hujan">Hujan</option>
		      		<option value="Petir">Petir</option>
		     	</select>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Dari Jam</label>
		    <div class="col-sm-3">
		     	<input type="time" class="form-control form-control-sm" name="jam_mulai" value="<?php echo $get_project['jam_masuk']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Sampai Jam</label>
		    <div class="col-sm-3">
		     	<input type="time" class="form-control form-control-sm" name="jam_selesai" value="<?php echo $get_project['jam_pulang']; ?>" required>
		    </div>
		</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="kd_report" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_cuacaproject" value="Tambah">
	<!-- /.card-footer -->
</form>