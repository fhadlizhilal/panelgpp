<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_Manpowerproject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower_project WHERE id = '$id'"));
    $getProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_Manpowerproject[project_id]'"));
    $getManpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_Manpowerproject[manpower_id]'"));
    $getJabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_jabatan WHERE id = '$get_Manpowerproject[jabatan_id]'"));
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
            <td><b>Manpower</b></td>
            <td width="1%">:</td>
            <td><?php echo $getManpower['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Jabatan</b></td>
            <td width="1%">:</td>
            <td><?php echo $getJabatan['jabatan']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Manpower dari Project ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_manpowerproject" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->