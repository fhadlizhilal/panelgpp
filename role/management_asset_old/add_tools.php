<?php
  session_start();
  require_once "../../dev/config.php";
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-tools">
      <div class="card-body">
        <div class="form-group">
          <label>ID Tools</label>
          <input type="text" class="form-control" name="id_tools" required>
        </div>
        <div class="form-group">
          <label>Nama Tools</label>
          <input type="text" class="form-control" name="nama" required>
        </div>
        <div class="form-group">
          <label>Jenis</label>
          <input type="text" class="form-control" name="jenis" required>
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <select class="form-control" name="satuan" required>
            <option value="" selected disabled>-- Pilih Satuan --</option>
            <option value="Pcs">Pcs</option>
            <option value="Unit">Unit</option>
            <option value="Set">Set</option>
            <option value="Lot">Lot</option>
          </select>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-info float-right" name="add_tools" value="Simpan Tools">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->