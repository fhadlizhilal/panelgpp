<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_isuk3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE id = '$id'"));
    $get_dailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$get_isuk3[kd_report]'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_dailyreport[project_id]'"));
    $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_isuk3[manpower_id]'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table table-sm" style="font-size: 12px;">
          <tr>
            <td width="25%"><b>Nama Project</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_project['nama_project']; ?></td>
          </tr>
          <tr>
            <td><b>Tanggal</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dailyreport['tgl_report']; ?></td>
          </tr>
          <tr>
            <td><b>Manpower</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_manpower['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Kejadian</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_isuk3['kejadian']; ?></td>
          </tr>
          <tr>
            <td><b>Keterangan Kejadian</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_isuk3['keterangan_kejadian']; ?></td>
          </tr>
          <tr>
            <td><b>Corrective Action</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_isuk3['corrective_action']; ?></td>
          </tr>
          <tr>
            <td><b>Corrective Action</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_isuk3['foto']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Isu K3 ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_isuk3" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->