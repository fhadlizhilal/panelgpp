<?php
  session_start();
  require_once "../../dev/config.php";

  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$_POST[getID]'"));
?>
  
  <table class="table table-sm table-striped" style="font-size: 12px;">
    <tr>
      <td width="22%"><b>Kode Project</b></td>
      <td width="1%">:</td>
      <td><?php echo $_POST['getID']; ?></td>
    </tr>
    <tr>
      <td><b>Nama Project</b></td>
      <td>:</td>
      <td><?php echo $get_project['nm_project']; ?></td>
    </tr>
    <tr>
      <td><b>Perusahaan</b></td>
      <td>:</td>
      <td><?php echo $get_project['perusahaan']; ?></td>
    </tr>
    <tr>
      <td><b>Kapasitas</b></td>
      <td>:</td>
      <td><?php echo $get_project['kapasitas']." ".$get_project['satuan_kapasitas']; ?></td>
    </tr>
    <tr>
      <td><b>Lokasi</b></td>
      <td>:</td>
      <td><?php echo $get_project['lokasi_project']; ?></td>
    </tr>
  </table>