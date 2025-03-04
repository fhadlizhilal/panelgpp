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

<table class="table table-bordered table-hover" style="font-size: 12px; margin-bottom: 10px;">
  <thead>
    <tr>
      <th width="1%">#</th>
      <th>Merek / Tipe</th>
      <th>Tgl Update</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no = 1;
      $q_get_detailinspeksi_apar = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapar WHERE inspeksi_id = '$id'");
      while($get_detailinspeksi_apar = mysqli_fetch_array($q_get_detailinspeksi_apar)){
    ?>
      <tr data-widget="expandable-table" aria-expanded="false">
        <td><?php echo $no; ?></td>
        <td><?php echo $get_detailinspeksi_apar['merek_tipe']; ?></td>
        <td><?php echo date("d-m-Y H:i:s", strtotime($get_detailinspeksi_apar['tgl_submit'])); ?></td>
      </tr>
      <tr class="expandable-body">
        <td colspan="3">
          <table class="table table-sm" style="background-color: #e8e8e8; margin-bottom: 10px;">
            <tr>
              <td width="70%">1. Nomor tabung sesuai</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_1']; ?></td>
            </tr>
            <tr>
              <td width="70%">2. Penempatan APAR benar</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_2']; ?></td>
            </tr>
            <tr>
              <td width="70%">3. Penempatan APAR pada area kerja dan mudah dicapai</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_3']; ?></td>
            </tr>
            <tr>
              <td width="70%">4. APAR dalam kondisi bersih</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_4']; ?></td>
            </tr>
            <tr>
              <td width="70%">5. Terdapat data kelas kebakaran pada APAR</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_5']; ?></td>
            </tr>
            <tr>
              <td width="70%">6. Terdapat data media pemadam</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_6']; ?></td>
            </tr>
            <tr>
              <td width="70%">7. Terdapat instruk atau petunjuk penggunaan</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_7']; ?></td>
            </tr>
            <tr>
              <td width="70%">8. Terpasang tagging / label pemeriksaan</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_8']; ?></td>
            </tr>
            <tr>
              <td width="70%">9. Isi APAR cukup (tidak < 10% dari berat normal)</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_9']; ?></td>
            </tr>
            <tr>
              <td width="70%">10. Seal dan pin pengaman terpasang dengan baik</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_10']; ?></td>
            </tr>
            <tr>
              <td width="70%">11. Jarum indikator tekanan menunjukan kondisi normal</td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['point_11']; ?></td>
            </tr>
            <tr>
              <td width="70%"><b>Hasil Akhir</b></td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_detailinspeksi_apar['hasil_akhir']; ?></td>
            </tr>
          </table>
        </td>
      </tr>
    <?php $no++; } ?>
  </tbody>
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
      $q_getfoto_inspeksi_apar = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotoapar WHERE inspeksi_id = '$id'");
      while($getfoto_inspeksi_apar = mysqli_fetch_array($q_getfoto_inspeksi_apar)){
    ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td>
            <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $getfoto_inspeksi_apar["foto"]; ?>" width="100%"><br>
            <center>Ket : <?php echo $getfoto_inspeksi_apar["keterangan"]; ?></center>
          </td>
        </tr>
    <?php $no++; } ?>
  </tbody>
</table>

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
<center><a href="index.php?pages=reportinspeksiapar&kd=<?php echo $id; ?>" target="_blank"><div class="btn btn-info btn-md"><span class="fa fa-save"> Simpan / Cetak</span></div></a></center>