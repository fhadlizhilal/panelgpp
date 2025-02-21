<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$tanggal = $_POST['getID'];
	}
?>
 <form method="POST" action="">

 		<center>
 			<h5 style="margin-bottom: -5px;">DATA NEAT & CLEAN</h5>
 			<small>Tanggal : <?php echo date("d-m-Y", strtotime($tanggal)); ?></small>
 		</center>
		<br>
		<table class="table table-sm table-striped" style="font-size: 14px">
			<thead>
				<tr>
					<td width="1%">No</td>
					<td>Kategori</td>
					<td width="25%">Nilai</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					$q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama != 'Erwansyah HMS' AND nama != 'Fadhli Aoliana' AND nama != 'Heriyanto Kurniawan' AND nama != 'M. Badrudin' AND nama != 'Sutisman' AND nama != 'Dadang Romansyah' AND nama != 'Asep Saepul' AND nama != 'Suhaedin' AND nama != 'Solahudin Pebriana' AND nama != 'Iman Maryadi' ORDER BY nama ASC");
					while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
						$get_data_neatnclean = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ga_neatnclean WHERE tanggal = '$tanggal' AND nik = '$get_karyawan[nik]'"));
				?>
					<tr>
						<td style="vertical-align: middle;"><?php echo $no; ?></td>
						<td style="vertical-align: middle;"><?php echo $get_karyawan['nama']; ?></td>
						<td>
							<input type="number" name="nilai_<?php echo $get_karyawan['nik']; ?>" min="0" max="100" value="<?php echo $get_data_neatnclean['nilai']; ?>">
						</td>
					</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		<hr>
		<input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
		<center>
			<input type="submit" class="btn btn-success" name="edit_data_neatnclean" value="Simpan">
			<input type="submit" class="btn btn-danger" name="delete_data_neatnclean" value="Delete" onclick="return confirm('Yakin delete data Neat & Clean Ini ?')">
		</center>

	<!-- /.card-footer -->
</form>