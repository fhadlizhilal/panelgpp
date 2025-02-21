<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_listInduction = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport WHERE id = '$id'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_listInduction[project_id]'"));
    $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_listInduction[hse_officer]'"));
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
            <td><b>HSE Officer</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_hseOfficer['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Tanggal</b></td>
            <td width="1%">:</td>
            <td><?php echo date("d-m-Y",strtotime($get_listInduction['tanggal'])); ?></td>
          </tr>
          <tr>
            <td><b>Tempat</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_listInduction['tempat']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete List Induction Report ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_list_induction" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->