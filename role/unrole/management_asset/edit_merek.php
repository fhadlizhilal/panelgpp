<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Merek</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="merek" value="<?php echo $get_merek['merek']; ?>" required>
            <small style="color: red; font-style: italic;">*Semua yang menggunakan Merek ini akan diubah ke merek yang baru</small>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_merek" value="Ubah">
      </div>
    </form>
  </div>
    <!-- /.card-body -->