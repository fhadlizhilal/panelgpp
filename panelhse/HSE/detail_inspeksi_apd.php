<?php
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
      $id = $_POST['getID'];
      $get_inspeksilist = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE id = '$id'"));
      $get_weekly = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE kd_weekly = '$get_inspeksilist[kd_weekly]'"));
      $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_weekly[project_id]'"));
      $get_hseofficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inspeksilist[hse_officer]'"));

      $array = explode("_", $get_inspeksilist['jenis_inspeksi']);
      $jenis_inspeksi = ucwords($array[0]." ".$array[1]);
  }
?>

<table id="" class="table table-sm" style="font-size: 11px;">
  <tr>
    <th width="35%">Nama Project</th>
    <td width="1%">:</td>
    <td><?php echo $get_project['nama_project']; ?></td>
  </tr>
  <tr>
    <th>Jenis Inspeksi</th>
    <td>:</td>
    <td><?php echo $jenis_inspeksi; ?></td>
  </tr>
  <tr>
    <th>Week</th>
    <td>:</td>
    <td><?php echo "Week ".$get_weekly['week']; ?></td>
  </tr>
  <tr>
    <th>Tanggal Inspeksi</th>
    <td>:</td>
    <td><?php echo date("d-m-Y", strtotime($get_inspeksilist['tanggal_inspeksi'])); ?></td>
  </tr>
</table>

<table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
  <tr>
    <th width="1%" style="vertical-align: middle;">No</th>
    <th width="" style="vertical-align: middle;">Nama Barang</th>
    <th width="1%" style="vertical-align: middle; font-size: 8px;"><center>Total Asset</center></th>
    <th width="1%" style="vertical-align: middle; font-size: 8px;"><center>Jumlah Minggu Ini</center></th>
    <th width="1%" style="vertical-align: middle; font-size: 8px;">Deviasi</th>
    <th width="1%" style="vertical-align: middle; font-size: 8px;">Baik</th>
    <th width="1%" style="vertical-align: middle; font-size: 8px;">Rusak</th>
    <th width="1%" style="vertical-align: middle; font-size: 8px;">Hilang</th>
    <th width="1%" style="vertical-align: middle; font-size: 8px;">Satuan</th>
  </tr>
  <?php
    $no=1;
    $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$id'");
    while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
      $get_apd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_apd WHERE id ='$get_inspeksi_detailapd[apd_id]'"));
  ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $get_apd['nama_apd']; ?></td>
      <td><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
      <td><?php echo $get_inspeksi_detailapd['jumlah_minggu_ini']; ?></td>
      <td><?php echo number_format($get_inspeksi_detailapd['deviasi'],0)."%"; ?></td>
      <td><?php echo $get_inspeksi_detailapd['baik']; ?></td>
      <td><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
      <td><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
      <td><?php echo $get_apd['satuan']; ?></td>
    </tr>
  <?php $no++; } ?>
</table>

<br>
<div style="font-size: 24px; font-weight: bold; margin-bottom: -5px;">Dokumentasi</div>
<table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
  <thead>
    <tr>
      <th width="1%">No</th>
      <th>Foto</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no=1;
      $q_getfoto_inspeksi_apd = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotoapd WHERE inspeksi_id = '$id'");
      while($getfoto_inspeksi_apd = mysqli_fetch_array($q_getfoto_inspeksi_apd)){
    ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td>
            <img src="../../role/HSE/foto_inspeksi_apd/<?php echo $getfoto_inspeksi_apd["foto"]; ?>" width="100%"><br>
            <center>Ket : <?php echo $getfoto_inspeksi_apd["keterangan"]; ?></center>
          </td>
        </tr>
    <?php $no++; } ?>
  </tbody>
</table>

<div style="font-size: 24px; font-weight: bold; margin-bottom: -5px;">Rekomendasi</div>
<textarea class="form-control form-control-sm" style="height: 100px;" disabled><?php echo $get_inspeksilist['rekomendasi']; ?></textarea>

<br>
<hr>
<div class="row">
  <div class="col-6">
    <center>
      Diperiksa Oleh<br>
      <img src="../../role/HSE/signatures/<?php echo $get_inspeksilist["ttd_hse"]; ?>" width="90%"><br>
      <?php echo $get_hseofficer['nama']; ?><br>
      HSE Officer
    </center>
  </div>
  <div class="col-6">
    <center>
      Disetujui Oleh<br>
      <img src="../../role/HSE/signatures/<?php echo $get_inspeksilist["ttd_sm"]; ?>" width="90%"><br>
      <?php echo $get_inspeksilist['site_manager']; ?><br>
      Site Manager
    </center>
  </div>
</div>

<br>
<center><a href="index.php?pages=report_inspeksiapd&idinspeksi=<?php echo $id; ?>" target="_blank"><div class="btn btn-info btn-md"><span class="fa fa-save"> Simpan / Cetak</span></div></a></center>