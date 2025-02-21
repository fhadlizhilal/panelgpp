<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_petaproject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM am_petaproject WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table table-sm" style="font-size: 12px;">
          <tr>
            <td width="25%"><b>Nama Project</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_petaproject['nama_project']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Kota</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_petaproject['kota']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Provinsi</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_petaproject['provinsi']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Latitude / Longtitude</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_petaproject['latitude']." / ".$get_petaproject['longtitude']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Kapasitas</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_petaproject['kapasitas']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Foto</b></td>
            <td width="1%">:</td>
            <td><img src="../unrole/petaproject/fotoproject/<?php echo $get_petaproject['foto']; ?>" width='70%'></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Peta Project ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_petaproject" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->