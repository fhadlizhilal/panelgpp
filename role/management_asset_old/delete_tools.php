<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_db WHERE id_tools = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-tools">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="25%"><b>ID</b></td>
            <td width="1%">:</td>
            <td><?php echo $id; ?></td>
          </tr>
          <tr>
            <td><b>Nama Tools</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools['nama_tools']; ?></td>
          </tr>
          <tr>
            <td><b>Jenis</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools['jenis_tools']; ?></td>
          </tr>
          <tr>
            <td><b>Satuan</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools['satuan']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Tools Ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_tools" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->