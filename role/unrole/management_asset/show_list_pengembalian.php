<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$kd_project = $_POST['getID'];
    	
	}
?>
 
 <table class="table table-sm table-striped" style="font-size: 12px">
 	<tr>
 		<td width="1%" style="font-weight: bold;">No</td>
 		<td width="20%" style="font-weight: bold;">No Pengembalian</td>
 		<td width="10%" style="font-weight: bold;">Entitas</td>
 		<td width="15%" style="font-weight: bold;">Tanggal</td>
 		<td width="25%" style="font-weight: bold;">Penanggungjawab</td>
 		<td width="" style="font-weight: bold;">Status</td>
 	</tr>
 	<?php
 		$no=1;
 		$q_get_pengembalian = mysqli_query($conn, "SELECT * FROM asset_pengembalian WHERE kd_project = '$kd_project'");
 		while($get_pengembalian = mysqli_fetch_array($q_get_pengembalian)){
 			$get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengembalian[entitas_id]'"));

            $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengembalian[penanggungjawab]'"));
 	?>
	 	<tr>
	 		<td><?php echo $no; ?></td>
	 		<td><?php echo "RTN".$get_pengembalian['id']."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
	 		<td><?php echo $get_entitas['entitas']; ?></td>
	 		<td><?php echo date("d-m-Y", strtotime($get_pengembalian['tanggal'])); ?></td>
	 		<td><?php echo $get_karyawan['nama']; ?></td>
	 		<td>
	 			<?php if($get_pengembalian['status'] == "waiting for approval"){ ?>
                    <span class="badge badge-secondary">Waiting for Approval</span>
                <?php }elseif($get_pengembalian['status'] == "BA approved"){ ?>
                    <span class="badge badge-success">BA Approved</span>
                <?php } ?>
	 		</td>
	 	</tr>
	 <?php $no++;} ?>
 </table>