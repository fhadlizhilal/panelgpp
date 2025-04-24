<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$kd_project = $_POST['getID'];
    	
	}
?>
 
 <table class="table table-sm table-striped" style="font-size: 11px">
 	<tr>
 		<td width="1%" style="font-weight: bold;">No</td>
 		<td width="18%" style="font-weight: bold;">No Pinjam</td>
 		<td width="10%" style="font-weight: bold;">Jenis</td>
 		<td width="18%" style="font-weight: bold;">Peminjam</td>
 		<td width="18%" style="font-weight: bold;">Tgl Pinjam</td>
 		<td width="" style="font-weight: bold;">Keterangan</td>
 		<td width="12%" style="font-weight: bold;">Status</td>
 	</tr>
 	<?php
 		$no=1;
 		$q_get_peminjaman = mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE kd_project = '$kd_project'");
 		while($get_peminjaman = mysqli_fetch_array($q_get_peminjaman)){
 			$get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
 	?>
	 	<tr>
	 		<td><?php echo $no; ?></td>
	 		<td><?php echo $get_peminjaman['id']."/MA/".date('m/Y', strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
	 		<td align="left">
		 		<?php if($get_peminjaman['jenis'] == "tools"){ ?>
	            	<span class="badge badge-info">Tools</span>
	            <?php }elseif($get_peminjaman['jenis'] == "apd"){ ?>
	                <span class="badge badge-success">APD</span>
	            <?php }elseif($get_peminjaman['jenis'] == "inventaris"){ ?>
	                <span class="badge badge-warning">Inventaris</span>
	            <?php }elseif($get_peminjaman['jenis'] == "alat ukur"){ ?>
	                <span class="badge badge-danger">Alat Ukur</span>
	            <?php } ?>
	 		</td>
	 		<td><?php echo $get_karyawan['nama']; ?></td>
	 		<td><?php echo $get_peminjaman['tgl_pinjam']; ?></td>
	 		<td><?php echo $get_peminjaman['keterangan']; ?></td>
	 		<td>
	 			<?php if($get_peminjaman['status'] == "waiting for MA"){ ?>
                    <span class="badge badge-secondary">Waiting for MA</span>
                <?php }elseif($get_peminjaman['status'] == "on progress by MA"){ ?>
                    <span class="badge badge-warning">On Progress by MA</span>
                <?php }elseif($get_peminjaman['status'] == "rejected by MA"){ ?>
                    <span class="badge badge-danger">Rejected by MA</span>
                <?php }elseif($get_peminjaman['status'] == "canceled by user"){ ?>
                    <span class="badge badge-danger">Canceled by User</span>
                <?php }elseif($get_peminjaman['status'] == "completed"){ ?>
                    <span class="badge badge-success">Completed</span>
                <?php } ?>
	 		</td>
	 	</tr>
	 <?php $no++;} ?>
 </table>