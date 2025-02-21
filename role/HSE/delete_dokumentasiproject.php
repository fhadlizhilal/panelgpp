<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_dokumentasiproject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE id='$id'"));
      $get_dailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$get_dokumentasiproject[kd_report]'"));
      $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_dailyreport[project_id]'"));
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
            <td width="25%"><b>Tgl Report</b></td>
            <td width="1%">:</td>
            <td><?php echo date("d-m-Y", strtotime($get_dailyreport['tgl_report'])); ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Pekerjaan</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dokumentasiproject['pekerjaan']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Foto</b></td>
            <td width="1%">:</td>
            <td><img src="dokumentasi_project/<?php echo $get_dokumentasiproject['foto']; ?>" width="80%"></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Dokumentasi ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_dokumentasiproject" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->