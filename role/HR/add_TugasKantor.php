<?php
  session_start();
  require_once "../../dev/config.php";
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=STK">
      <div class="card-body">
        <div class="form-group">
          <label>Karyawan</label>
          <select name=" nik" class="form-control" required>
                <option value="" selected disabled>--- Pilih Karyawan ---</option>
            <?php
              $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' ORDER BY nama ASC");
              while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
            ?>
                <option value="<?php echo $get_karyawan['nik']; ?>"><?php echo $get_karyawan['nama']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Dari</label>
          <input type="date" class="form-control" name="dari" required>
        </div>
        <div class="form-group">
          <label>Sampai</label>
          <input type="date" class="form-control" name="sampai" required>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea class="form-control" name="keterangan" required></textarea>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-info float-right" name="add_tugas_kantor" value="Simpan">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->