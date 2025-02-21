<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $getAPDProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_apd WHERE id = '$id'"));
    $get_apd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_apd WHERE id = '$getAPDProject[apd_id]'"));
    $get_dailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$getAPDProject[kd_report]'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_dailyreport[project_id]'"));
  }
?>

  <div class="card">
    <form class="form-prevent" id="myForm" method="POST" action="">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="25%"><b>Nama Project</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_project['nama_project']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Nama APD</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_apd['nama_apd']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Jumlah</b></td>
            <td width="1%">:</td>
            <td><?php echo $getAPDProject['jumlah']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete APD ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_apd_reporthse" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->