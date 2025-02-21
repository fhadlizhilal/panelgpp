<?php
  session_start();
  require_once "../../dev/config.php";
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=SHL">
      <div class="card-body">
        <div class="form-group">
          <label>Tanggal</label>
          <input type="date" class="form-control" name="tanggal" required>
        </div>
        <div class="form-group">
          <label>Keterangan Libur</label>
          <textarea class="form-control" name="keterangan" required></textarea>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-info float-right" name="add_hari_libur" value="Simpan Hari">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->