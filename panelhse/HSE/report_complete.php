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
	<div style="font-size: 12px;">Anda akan menyelesaikan daily report project <b>"<?php echo $get_project['nama_project']; ?>"</b> tanggal <b>"<?php echo date("d-m-Y", strtotime($tgl_report));?>"</b>, yakin sudah mengisi semua data report dengan benar? <br><br>setelah ini report akan dikirimkan ke Admin HSE untuk diperiksa.</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
	<input type="hidden" name="kd_report" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-success btn-sm" name="report_complete" value="Report Complete">
	<!-- /.card-footer -->
</form>