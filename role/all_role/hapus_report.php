<?php
session_start();
require_once "../../dev/config.php";

  //--------- delete -------
  if(isset($_POST['report_hapus'])){
    if($_POST['report_hapus'] == "YA"){
      $tanggal = $_POST['tgl'];
      $m_ = Date("m", strtotime($tanggal));
      $y_ = Date("Y", strtotime($tanggal));

      $delete = mysqli_query($conn, "DELETE FROM dailyreport WHERE nik = '$_SESSION[nik]' AND tanggal = '$tanggal'");

      if($delete){
        header("location: ../".$_SESSION['role']."/index.php?bulan=".$m_."&tahun=".$y_."&pages=dailyreport&delete_report=success_delete");
      }else{
        header("location: ../".$_SESSION['role']."/index.php?bulan=".$m_."&tahun=".$y_."&pages=dailyreport&delete_report=error_delete");
      }
    }
  }

  if(isset($_POST['getDetail'])) {
    $tgl = $_POST['getDetail'];
    $get_report = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM dailyreport WHERE nik = '$_SESSION[nik]' AND tanggal = '$tgl'"));
?>
    Yakin Hapus Report?
    <br><br>
    <form action="../all_role/hapus_report.php" method="POST">
      <input type="hidden" name="tgl" value="<?php echo $tgl; ?>">
      <input type="submit" class="btn btn-danger" name="report_hapus" value="YA">
    </form>

<?php } ?>