<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Entitas</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="entitas" value="<?php echo $get_entitas['entitas']; ?>" required>
            <small style="color: red; font-style: italic;">*Semua yang menggunakan Entitas ini akan diubah ke entitas yang baru</small>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_entitas" value="Ubah">
      </div>
    </form>
  </div>
    <!-- /.card-body -->