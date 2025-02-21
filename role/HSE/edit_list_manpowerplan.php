<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
	}
?>
 <form method="POST" action="">
	<div class="card-body">
		<table id="setHariLibur1" class="table table-sm table-striped" style="font-size: 12px">
			<thead>
				<tr>
					<th width="1%">No</th>
					<th>NIK</th>
					<th>Nama</th>
					<th width="1%">#</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no=1;
					$q_get_manpower = mysqli_query($conn, "SELECT * FROM hse_manpower");
					while($get_manpower = mysqli_fetch_array($q_get_manpower)){
				?>
					<tr>
						<td><?php echo $no; ?></td>
						<td><?php echo $get_manpower['nik']; ?></td>
						<td><?php echo $get_manpower['nama']; ?></td>
						<td><input type="checkbox" name="check_<?php echo $get_manpower['nik']; ?>"></td>
					</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		<br>
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<center><input type="submit" class="btn btn-primary btn-sm" name="edit_list_manpowerplan" value="Simpan"></center>
	</div>
</form>