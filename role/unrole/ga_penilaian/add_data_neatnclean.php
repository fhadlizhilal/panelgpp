<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$tanggal = $_POST['getID'];
	}
?>
 
 		<center>
 			<h5 style="margin-bottom: -5px;">FORM NEAT & CLEAN</h5>
 			<small>Tanggal : <?php echo date("d-m-Y", strtotime($tanggal)); ?></small>
 		</center>
		<br>
		<table class="table table-sm table-striped" style="font-size: 14px">
			<thead>
				<tr>
					<td width="1%">No</td>
					<td>Nama</td>
					<td width="25%">Nilai</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					$q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama != 'Erwansyah HMS' AND nama != 'Fadhli Aoliana' AND nama != 'Heriyanto Kurniawan' AND nama != 'M. Badrudin' AND nama != 'Sutisman' AND nama != 'Dadang Romansyah' AND nama != 'Asep Saepul' AND nama != 'Suhaedin' AND nama != 'Solahudin Pebriana' AND nama != 'Iman Maryadi' ORDER BY nama ASC");
					while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
				?>
					<tr>
						<td style="vertical-align: middle;"><?php echo $no; ?></td>
						<td style="vertical-align: middle;"><?php echo $get_karyawan['nama']; ?></td>
						<td>
							<input type="number" name="nilai_<?php echo $get_karyawan['nik']; ?>" min="0" max="100" value="100">
						</td>
					</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		<hr>
		<input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">