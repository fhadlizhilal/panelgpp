<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getID'])) {
    $id = $_POST['getID'];
    $q_get_project = mysqli_query($conn, "SELECT * FROM v_project WHERE id = '$id'");
    $get_project = mysqli_fetch_array($q_get_project);
?>

  <!-- Horizontal Form -->
  <div class="card card-info">
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listproject" enctype="multipart/form-data" style="font-size: 12px;">
      <div class="card-body">
          <table class="table table-sm">
            <tr>
              <td width="25%">Kode Project</td>
              <td width="1%">:</td>
              <td><?php echo $get_project['kd_project']; ?></td>
            </tr>
            <tr>
              <td>Nama Project</td>
              <td width="1%">:</td>
              <td><?php echo $get_project['nm_project']; ?></td>
            </tr>
            <tr>
              <td>Badan</td>
              <td width="1%">:</td>
              <td><?php echo $get_project['kd_badan']; ?></td>
            </tr>
          </table>
          <br>
          <div style="font-size: 14; font-weight: bold;">Yakin delete project ini?</div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="kd_project" value="<?php echo $get_project['kd_project'] ?>">
        <input type="submit" class="btn btn-sm btn-danger" name="hapusproject" value="Delete">
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

<?php } ?>