<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_assets = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM assets_database WHERE id_asset = '$id'"));
    $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_assets[merek]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-assets">
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
            <td><?php echo $get_assets['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Jenis</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_assets['jenis']; ?></td>
          </tr>
          <tr>
            <td><b>Merek</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_merek['merek']; ?></td>
          </tr>
          <tr>
            <td><b>Satuan</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_assets['satuan']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Asset Ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_asset" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->