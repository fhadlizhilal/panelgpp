<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_inductionreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport WHERE id = '$id'"));
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_inductionreport[project_id]'"));
    	$get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_project[hse_officer]'"));
	}
?>

<table width="100%" style="font-size: 10px">
	<tr>
		<td width="35%">Nama Project</td>
		<td>:</td>
		<td><?php echo $get_project['nama_project']; ?></td>
	</tr>
	<tr>
		<td>HSE Officer</td>
		<td>:</td>
		<td><?php echo $get_hseOfficer['nama']; ?></td>
	</tr>
	<tr>
		<td>Tanggal Induction</td>
		<td>:</td>
		<td><?php echo $get_inductionreport['tanggal']; ?></td>
	</tr>
	<tr>
		<td>Tempat</td>
		<td>:</td>
		<td><?php echo $get_inductionreport['tempat']; ?></td>
	</tr>
</table>

<table class="table table-sm table-striped" width="100%" style="font-size: 10px; margin-top: 15px;">
	<tr>
		<th width="1%">No</th>
		<th width="35%">NIK</th>
		<th>NAMA</th>
		<th width="8%">#</th>
	</tr>
	<?php
		$no=1;
		$q_inductionreport_spk = mysqli_query($conn, "SELECT * FROM hse_inductionreport JOIN hse_inductionreport_spk ON hse_inductionreport.id = hse_inductionreport_spk.induction_id WHERE hse_inductionreport.project_id = '$get_inductionreport[project_id]'");
		while($get_inductionreport_spk = mysqli_fetch_array($q_inductionreport_spk)){
	?>
		<tr>
			<td align="center"><?php echo $no; ?></td>
			<td><?php echo $get_inductionreport_spk['nik']; ?></td>
			<td><?php echo $get_inductionreport_spk['nama']; ?></td>
			<td style="font-size: 14px">
				<a href="../../panelhse/SPK/index.php?pages=reportspk&induction_spk_id=<?php echo $get_inductionreport_spk['id']; ?>&file_name=<?php echo "SPK_".$get_project['nama_project']."_".$get_inductionreport_spk['nama']; ?>" target="_blank"><span class="fa fa-file-text-o"></span></a>
			</td>
		</tr>
	<?php $no++; } ?>
</table>