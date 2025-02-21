<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getDetail'])) {
    $tgl = $_POST['getDetail'];

    $get_report = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM dailyreport WHERE nik = '$_SESSION[nik]' AND tanggal = '$tgl'"));
  }
?>

<div class="card-body p-0">
  <table class="table table-sm">
    <tbody>
      <tr>
        <td><b>Nama</b></td>
        <td>:</td>
        <td><?php echo $_SESSION['nama']; ?></td>
      </tr>
      <tr>
        <td><b>Tanggal</b></td>
        <td>:</td>
        <td><?php echo Date("d-m-Y", strtotime($tgl)); ?></td>
      </tr>
      <tr>
        <td><b>Report</b></td>
        <td>:</td>
        <td><?php echo $get_report['report']; ?></td>
      </tr>
    </tbody>
  </table>
</div>