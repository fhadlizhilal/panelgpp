<?php
  session_start();
  require_once "../../dev/config.php";
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-assets">
      <div class="card-body">
        <div class="form-group">
          <label>ID Asset</label>
          <input type="text" class="form-control" name="id_asset" required>
        </div>
        <div class="form-group">
          <label>Nama Asset</label>
          <input type="text" class="form-control" name="nama" required>
        </div>
        <div class="form-group">
          <label>Jenis</label>
          <input type="text" class="form-control" name="jenis" required>
        </div>
        <div class="form-group">
          <label>Merek</label>
          <select class="form-control" name="merek" required>
            <option value="" selected disabled>-- Pilih Merek --</option>
            <?php
              $q_getMerek = mysqli_query($conn, "SELECT * FROM merek");
              while($get_merek = mysqli_fetch_array($q_getMerek)){
            ?>
                <option value="<?php echo $get_merek['id']; ?>"><?php echo $get_merek['merek']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <select class="form-control" name="satuan" required>
            <option value="" selected disabled>-- Pilih Satuan --</option>
            <option value="Unit">Unit</option>
            <option value="Pcs">Pcs</option>
            <option value="Set">Set</option>
            <option value="Lot">Lot</option>
          </select>
        </div>
        <div class="form-group">
          <label>Gudang</label>
          <select class="form-control" name="gudang" required>
            <option value="" selected disabled>-- Pilih Gudang --</option>
            <option value="Gudang Inventaris">Gudang Inventaris</option>
          </select>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-info float-right" name="add_asset" value="Simpan Asset">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->