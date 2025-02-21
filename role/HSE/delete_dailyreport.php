<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_dailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$id'"));
    $getProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_dailyreport[project_id]'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="25%"><b>Nama Project</b></td>
            <td width="1%">:</td>
            <td><?php echo $getProject['nama_project']; ?></td>
          </tr>
          <tr>
            <td><b>Tgl Report</b></td>
            <td width="1%">:</td>
            <td><?php echo date("d-m-Y", strtotime($get_dailyreport['tgl_report'])); ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Dailyreport ini ?</b><br><br>
        <input type="hidden" name="kd_report" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_dailyreport" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->