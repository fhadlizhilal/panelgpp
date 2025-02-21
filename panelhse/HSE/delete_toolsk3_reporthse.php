<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $getToolsk3Project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_toolsk3 WHERE id = '$id'"));
    $get_toolsk3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsk3 WHERE id = '$getToolsk3Project[toolsk3_id]'"));
    $get_dailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$getToolsk3Project[kd_report]'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_dailyreport[project_id]'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="25%"><b>Nama Project</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_project['nama_project']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Tools K3</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_toolsk3['nama_tools']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Jumlah</b></td>
            <td width="1%">:</td>
            <td><?php echo $getToolsk3Project['jumlah']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Tools K3 ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_toolsk3_reporthse" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->