<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$kd_project = $_POST['getID'];
    	
	}
?>
 
 <table class="table table-sm table-striped" style="font-size: 11px">
 	<tr>
 		<td width="1%" style="font-weight: bold;">No</td>
 		<td width="16%" style="font-weight: bold;">No Surat Jalan</td>
 		<td width="5%" style="font-weight: bold;">Jenis</td>
 		<td width="5%" style="font-weight: bold;">Entitas</td>
 		<td width="10%" style="font-weight: bold;">Tanggal</td>
 		<td width="18%" style="font-weight: bold;">Peminjam</td>
 		<td width="" style="font-weight: bold;">Alamat Kirim</td>
 		<td width="" style="font-weight: bold;">Expedisi</td>
 		<td width="5%" style="font-weight: bold;">Status</td>
 	</tr>
 	<?php
 		$no=1;
 		$q_get_suratjalan = mysqli_query($conn, "SELECT a.*, a.status AS status_suratjalan, b.* FROM asset_suratjalan a JOIN asset_peminjaman b ON a.peminjaman_id = b.id WHERE b.kd_project = '$kd_project'");
 		while($get_suratjalan = mysqli_fetch_array($q_get_suratjalan)){
 			$get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_suratjalan[entitas_id]'"));

            $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_suratjalan[peminjam]'"));
 	?>
	 	<tr>
	 		<td><?php echo $no; ?></td>
	 		<td><?php echo "SJ".$get_suratjalan['id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?></td>
	 		<td align="left">
		 		<?php if($get_suratjalan['jenis'] == "tools"){ ?>
	            	<span class="badge badge-info">Tools</span>
	            <?php }elseif($get_suratjalan['jenis'] == "apd"){ ?>
	                <span class="badge badge-success">APD</span>
	            <?php }elseif($get_suratjalan['jenis'] == "inventaris"){ ?>
	                <span class="badge badge-warning">Inventaris</span>
	            <?php }elseif($get_suratjalan['jenis'] == "alat ukur"){ ?>
	                <span class="badge badge-danger">Alat Ukur</span>
	            <?php } ?>
	 		</td>
	 		<td><?php echo $get_entitas['entitas']; ?></td>
	 		<td><?php echo date("d-m-Y", strtotime($get_suratjalan['tanggal'])); ?></td>
	 		<td><?php echo $get_karyawan['nama']; ?></td>
	 		<td><?php echo $get_suratjalan['alamat_kirim']; ?></td>
	 		<td><?php echo $get_suratjalan['expedisi']; ?></td>
	 		<td>
	 			<?php if($get_suratjalan['status_suratjalan'] == "dalam pengiriman"){ ?>
                    <span class="badge badge-secondary">Dalam Pengiriman</span>
                <?php }elseif($get_suratjalan['status_suratjalan'] == "diterima & sesuai"){ ?>
                    <span class="badge badge-success">Diterima & Sesuai</span>
                <?php } ?>
	 		</td>
	 	</tr>
	 <?php $no++;} ?>
 </table>