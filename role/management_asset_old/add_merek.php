<?php
  session_start();
  require_once "../../dev/config.php";
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-merek">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Merek</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="merek" required>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-info float-right" name="add_merek" value="Tambah">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->