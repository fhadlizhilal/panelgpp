<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$cek_ruangan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ga_ruangan WHERE id = '$id'"));
    	$cek_karyawan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$id'"));

    	if($cek_ruangan > 0){
    		$get_ruangan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ga_ruangan WHERE id = '$id'"));
    	}elseif($cek_karyawan > 0){
    		$get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT nama FROM karyawan WHERE nik = '$id'"));
    	}
	}
?>

<div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PENEMPATAN ASSET</div>
<br>
<table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
	<?php if($cek_ruangan > 0){ ?>
	  <tr>
	    <td width="25%">Lokasi Asset</td>
	    <td width="1%">:</td>
	    <td><?php echo $get_ruangan['nm_ruangan']; ?></td>
	  </tr>
	  <tr>
	    <td width="25%">Tanggal Update</td>
	    <td width="1%">:</td>
	    <td><?php echo date('d-m-Y'); ?></td>
	  </tr>
	 <?php }elseif($cek_karyawan > 0){ ?>
	 	<tr>
	    <td width="25%">Lokasi Asset</td>
	    <td width="1%">:</td>
	    <td><?php echo $id." - ".$get_karyawan['nama']; ?></td>
	  </tr>
	  <tr>
	    <td width="25%">Tanggal Update</td>
	    <td width="1%">:</td>
	    <td><?php echo date('d-m-Y'); ?></td>
	  </tr>
	 <?php } ?>
</table>

<table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
  <thead>
    <tr>
      <th width="1%">No</th>
      <th>Nama Asset</th>
      <th>Detail Asset</th>
      <th>Jenis</th>
      <th width="8%">Tgl Perolehan</th>
      <th width="5%">Qty</th>
      <th width="8%">Harga Satuan</th>
      <th width="8%">Total Harga</th>
      <th width="1%">Metode Penyusutan</th>
      <th width="1%">Umur Manfaat</th>
      <th width="10%">Nilai Satuan Hari Ini</th>
      <th width="9%">Total Nilai Hari Ini</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no = 1;
      $total_harga = 0;
      $total_harga_hariini = 0;
      $q_get_data_asset = mysqli_query($conn, "SELECT t1.id, t1.nama_asset, t1.detail_asset, t1.jenis_id, t1.tgl_perolehan, t1.qty, t1.satuan, t1.harga_satuan, t1.metode_penyusutan, t1.umur_manfaat, t1.lokasi_asset, t2.jenis FROM ga_asset t1 JOIN ga_jenis t2 ON t1.jenis_id = t2.id WHERE t1.lokasi_asset = '$id' ORDER BY t1.nama_asset, t2.jenis ASC");
      
      while($get_data_asset = mysqli_fetch_array($q_get_data_asset)){
    ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $get_data_asset['nama_asset']; ?></td>
        <td><?php echo $get_data_asset['detail_asset']; ?></td>
        <td><?php echo $get_data_asset['jenis']; ?></td>
        <td><?php echo $get_data_asset['tgl_perolehan']; ?></td>
        <td><?php echo $get_data_asset['qty']." ".$get_data_asset['satuan']; ?></td>
        <td><?php echo "Rp " . number_format($get_data_asset['harga_satuan'], 0, ',', '.'); ?></td>
        <td><?php echo "Rp " . number_format($get_data_asset['harga_satuan']*$get_data_asset['qty'], 0, ',', '.'); ?></td>
        <td><?php echo $get_data_asset['metode_penyusutan']; ?></td>
        <td><?php echo $get_data_asset['umur_manfaat']; ?></td>
        <td>
          <?php
            $jml_tahun = $get_data_asset['umur_manfaat'];
            $tanggal_akhir = date('Y-m-d', strtotime($get_data_asset['tgl_perolehan'] . "+$jml_tahun years"));
            $total_hari = (strtotime($tanggal_akhir) - strtotime($get_data_asset['tgl_perolehan'])) / 86400;

            $hari_ini = time(); // timestamp sekarang
            $hari_berjalan = floor(($hari_ini -  strtotime($get_data_asset['tgl_perolehan'])) / 86400);
            $harga_hari_ini = $get_data_asset['harga_satuan'] - ($get_data_asset['harga_satuan']/$total_hari*$hari_berjalan);

            $total_harga = $total_harga + ($get_data_asset['harga_satuan']*$get_data_asset['qty']);
            $total_harga_hariini = $total_harga_hariini + ($harga_hari_ini*$get_data_asset['qty']);

            if($hari_berjalan <1){
              $harga_hari_ini = $get_data_asset['harga_satuan'];
            }
            echo "Rp " . number_format($harga_hari_ini, 0, ',', '.');
          ?>    
        </td>
        <td><?php echo "Rp " . number_format($harga_hari_ini*$get_data_asset['qty'], 0, ',', '.'); ?></td>
      </tr>
    <?php $no++; } ?>

    	<tr style="background-color: yellow; font-weight: bold;">
    		<td colspan="7" align="center">TOTAL</td>
    		<td><?php echo "Rp " . number_format($total_harga, 0, ',', '.'); ?></td>
    		<td colspan="3"></td>
    		<td><?php echo "Rp " . number_format($total_harga_hariini, 0, ',', '.'); ?></td>
    	</tr>
  </tbody>
</table>