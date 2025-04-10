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
	<div style="font-size: 12px; margin-bottom: 8px">Anda akan membuat report untuk project <b>"<?php echo $get_project['nama_project']; ?>"</b> tanggal <b>"<?php echo date("d-m-Y", strtotime($tgl_report));?>"</b> sebagai <b>Project Hold</b>, tindakan ini akan menghapus semua data report pada hari ini yang mungkin sudah anda input.
		<br><br>Silahkan masukan keterangan / alasan projectnya hold dibawah ini :</div>
	<textarea class="form-control form-control-sm" name="keterangan" placeholder="masukan alasan / keterangan hold" minlength="25" required></textarea>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="kd_report" value="<?php echo $id; ?>">
	<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
	<input type="submit" class="btn btn-warning btn-sm" name="project_hold" value="Project Hold">
	<!-- /.card-footer -->
</form>