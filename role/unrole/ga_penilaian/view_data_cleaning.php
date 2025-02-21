<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$tanggal = $_POST['getID'];
    	$get_data_cleaning = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ga_cleaning WHERE tanggal = '$tanggal'"));
	}
?>
 <form method="POST" action="">

 		<center>
 			<h5 style="margin-bottom: -5px;">DATA CLEANING</h5>
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
				<tr>
					<td style="vertical-align: middle;">1</td>
					<td style="vertical-align: middle;">Lobby</td>
					<td><input type="number" name="nilai_Lobby" min="0" max="100" value="<?php echo $get_data_cleaning['lobby']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">2</td>
					<td style="vertical-align: middle;">Pacific Meeting Room</td>
					<td><input type="number" name="nilai_PMR" min="0" max="100" value="<?php echo $get_data_cleaning['pacific_meeting']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">3</td>
					<td style="vertical-align: middle;">Ruang Kerja Atas</td>
					<td><input type="number" name="nilai_RKA" min="0" max="100" value="<?php echo $get_data_cleaning['ruang_kerja_atas']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">4</td>
					<td style="vertical-align: middle;">Pantry Atas</td>
					<td><input type="number" name="nilai_PantryA" min="0" max="100" value="<?php echo $get_data_cleaning['pantry_atas']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">5</td>
					<td style="vertical-align: middle;">Pantry Bawah dan Koridor</td>
					<td><input type="number" name="nilai_PantryBK" min="0" max="100" value="<?php echo $get_data_cleaning['pantry_bawah_koridor']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">6</td>
					<td style="vertical-align: middle;">Mushola</td>
					<td><input type="number" name="nilai_Mushola" min="0" max="100" value="<?php echo $get_data_cleaning['mushola']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">7</td>
					<td style="vertical-align: middle;">Ruang Kerja Asset</td>
					<td><input type="number" name="nilai_RAsset" min="0" max="100" value="<?php echo $get_data_cleaning['ruang_kerja_asset']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">8</td>
					<td style="vertical-align: middle;">Atlantic Meeting Room</td>
					<td><input type="number" name="nilai_AMR" min="0" max="100" value="<?php echo $get_data_cleaning['atlantic_meeting_room']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">9</td>
					<td style="vertical-align: middle;">Ruang Kerja Logistik</td>
					<td><input type="number" name="nilai_RLogistik" min="0" max="100" value="<?php echo $get_data_cleaning['ruang_kerja_logistic']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">10</td>
					<td style="vertical-align: middle;">Gudang Asset</td>
					<td><input type="number" name="nilai_GAsset" min="0" max="100" value="<?php echo $get_data_cleaning['gudang_asset']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">11</td>
					<td style="vertical-align: middle;">Gudang Logistik</td>
					<td><input type="number" name="nilai_GLogistik" min="0" max="100" value="<?php echo $get_data_cleaning['gudang_logistic']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">12</td>
					<td style="vertical-align: middle;">Halaman Belakang</td>
					<td><input type="number" name="nilai_HalamanB" min="0" max="100" value="<?php echo $get_data_cleaning['halaman_belakang']; ?>"></td>
				</tr>
				<tr>
					<td style="vertical-align: middle;">13</td>
					<td style="vertical-align: middle;">Semua Toilet</td>
					<td><input type="number" name="nilai_Toilet" min="0" max="100" value="<?php echo $get_data_cleaning['toilet']; ?>"></td>
				</tr>
			</tbody>
		</table>
		<hr>
		<input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
		<center>
			<input type="submit" class="btn btn-success" name="edit_data_cleaning" value="Simpan">
			<input type="submit" class="btn btn-danger" name="delete_data_cleaning" value="Delete" onclick="return confirm('Yakin delete data Cleaning Ini ?')">
		</center>

	<!-- /.card-footer -->
</form>