<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
      $id = $_POST['getID'];
      $get_inspeksilist = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE id = '$id'"));
      $get_weeklyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE kd_weekly = '$get_inspeksilist[kd_weekly]'"));
      $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_weeklyreport[project_id]'"));
  }
?>

<table id="" class="table table-sm" style="font-size: 11px;">
  <tr>
    <th width="35%">Nama Project</th>
    <td width="1%">:</td>
    <td><?php echo $get_project['nama_project']; ?></td>
  </tr>
  <tr>
    <th>Lokasi</th>
    <td>:</td>
    <td><?php echo $get_project['kota']; ?></td>
  </tr>
  <tr>
    <th>Jenis Inspeksi</th>
    <td>:</td>
    <td><?php echo $get_inspeksilist['jenis_inspeksi']; ?></td>
  </tr>
  <tr>
    <th>Tanggal Inspeksi</th>
    <td>:</td>
    <td><?php echo $get_inspeksilist['tanggal_inspeksi']; ?></td>
  </tr>
</table>

<?php if(isset($_SESSION['role']) AND $_SESSION['role'] == "HSE"){ ?>
  <form method="POST" action="">
    <center>
      <input type="hidden" name="inspeksi_id" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-warning btn-sm" name="inspeksi_to_progress" value="to progress" onclick="return confirm('Yakin ingin mengubah status inspeksi ini menjadi progress kembali?')">
    </center>
  </form>
<?php }else{ ?>
  <div style="font-size: 12px; color: red;"><small>*Hubungi Admin HSE untuk mengubah status kembali menjadi progress</small></div>
<?php } ?>