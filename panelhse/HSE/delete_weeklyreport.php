<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_weeklyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE kd_weekly = '$id'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_weeklyreport[project_id]'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="30%"><b>Nama Project</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_project['nama_project']; ?></td>
          </tr>
          <tr>
            <td><b>Week</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_weeklyreport['week']; ?></td>
          </tr>
          <tr>
            <td><b>Tgl Weekly</b></td>
            <td width="1%">:</td>
            <td><?php echo date("d-m-Y",strtotime($get_weeklyreport['tgl_awal']))." s/d ".date("d-m-Y",strtotime($get_weeklyreport['tgl_akhir'])); ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Weekly Report ini ?</b><br><br>
        <input type="hidden" name="kd_weekly" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_weeklyreport" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->