<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$array_hasil = explode("/", $id);
    	$project_id = $array_hasil[0];
    	$tgl_report = $array_hasil[1];
	}
?>
 <form method="POST" action="">
	<div style="font-size: 12px;">Anda akan mengambil data manpower terbaru untuk project ini, tindakan ini akan mengubah status absensi dan jam kerja manpower menjadi kembali ke default awal, silahkan sesuaikan kembali jam kerja manpower setelah ini.</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
	<input type="hidden" name="kd_report" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-success btn-sm" name="get_datamanpower" value="Get Data">
	<!-- /.card-footer -->
</form>