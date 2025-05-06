<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$kd_project = $_POST['getID'];
    	
	}
?>
 
 <table class="table table-sm table-striped" style="font-size: 11px">
 	<tr>
 		<td width="1%" style="font-weight: bold;">No</td>
 		<td width="18%" style="font-weight: bold;">No Pengajuan</td>
 		<td width="10%" style="font-weight: bold;">Jenis</td>
 		<td width="18%" style="font-weight: bold;">Pelaksana</td>
 		<td width="18%" style="font-weight: bold;">Tgl Pengajuan</td>
 		<td width="18%" style="font-weight: bold;">Tgl Realisasi</td>
 		<td width="" style="font-weight: bold;">Keterangan</td>
 		<td width="12%" style="font-weight: bold;">Status</td>
 	</tr>
 	<?php
 		$no=1;
 		$q_get_pengajuan = mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE kd_project = '$kd_project'");
 		while($get_pengajuan = mysqli_fetch_array($q_get_pengajuan)){
 			$get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengajuan[pelaksana]'"));
 	?>
	 	<tr>
	 		<td><?php echo $no; ?></td>
	 		<td><?php echo "PN".$get_pengajuan['id']."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></td>
	 		<td align="left">
		 		<?php if($get_pengajuan['jenis'] == "tools"){ ?>
	            	<span class="badge badge-info">Tools</span>
	            <?php }elseif($get_pengajuan['jenis'] == "apd"){ ?>
	                <span class="badge badge-success">APD</span>
	            <?php }elseif($get_pengajuan['jenis'] == "inventaris"){ ?>
	                <span class="badge badge-warning">Inventaris</span>
	            <?php }elseif($get_pengajuan['jenis'] == "alat ukur"){ ?>
	                <span class="badge badge-danger">Alat Ukur</span>
	            <?php } ?>
	 		</td>
	 		<td><?php echo $get_karyawan['nama']; ?></td>
	 		<td><?php echo $get_pengajuan['tgl_pengajuan']; ?></td>
	 		<td><?php echo $get_pengajuan['tgl_realisasi']; ?></td>
	 		<td><?php echo $get_pengajuan['keterangan']; ?></td>
	 		<td>
	 			<?php if($get_pengajuan['status'] == "belum realisasi"){ ?>
                    <span class="badge badge-secondary">Belum Realisasi</span>
                <?php }elseif($get_pengajuan['status'] == "sudah realisasi"){ ?>
                    <span class="badge badge-success">Sudah Realisasi</span>
                <?php } ?>
	 		</td>
	 	</tr>
	 <?php $no++;} ?>
 </table>