<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_toolsTmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_tmp WHERE id = '$id'"));
    $getTools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_database WHERE id_tools = '$get_toolsTmp[id_tools]'"));
    $getMerek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$getTools[merek]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=add-peminjaman">
      <div class="card-body">
        <div class="form-group">
          <label>Nama Tools</label>
          <input type="text" class="form-control" name="id_tools" value="<?php echo "[".$getTools['id_tools']."] - ".$getTools['nama']." - ".$getTools['jenis']." [".$getMerek['merek']."][".$getTools['satuan']."]"; ?>" disabled>
        </div>
        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" class="form-control" name="jumlah" value="<?php echo $get_toolsTmp['jumlah']; ?>" required>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_toolspinjam" value="Simpan">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->