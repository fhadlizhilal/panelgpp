<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_apd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM apd_database WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-apd">
      <div class="card-body">
        <div class="form-group">
          <label>ID APD</label>
          <input type="text" class="form-control" name="id_apd" value="<?php echo $get_apd['id_apd']; ?>" required>
        </div>
        <div class="form-group">
          <label>Nama APD</label>
          <input type="text" class="form-control" name="nama" value="<?php echo $get_apd['nama']; ?>" required>
        </div>
        <div class="form-group">
          <label>Merek</label>
          <select class="form-control" name="merek" required>
            <option value="" selected disabled>-- Pilih Merek --</option>
            <?php
              $q_getMerek = mysqli_query($conn, "SELECT * FROM merek");
              while($get_merek = mysqli_fetch_array($q_getMerek)){
            ?>
                <option value="<?php echo $get_merek['id']; ?>"<?php if($get_merek['id'] == $get_apd['merek']){ echo "selected"; } ?>><?php echo $get_merek['merek']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Tipe</label>
          <input type="text" class="form-control" name="tipe" value="<?php echo $get_apd['tipe']; ?>" required>
        </div>
        <div class="form-group">
          <label>Jenis</label>
          <select class="form-control" name="jenis" required>
            <option value="" selected disabled>-- Pilih Jenis --</option>
            <option value="Continue" <?php if($get_apd['jenis'] == "Continue"){ echo "selected"; } ?>>Continue</option>
            <option value="Habis Pakai" <?php if($get_apd['jenis'] == "Habis Pakai"){ echo "selected"; } ?>>Habis Pakai</option>
          </select>
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <select class="form-control" name="satuan" required>
            <option value="" selected disabled>-- Pilih Satuan --</option>
            <option value="Unit" <?php if($get_apd['satuan'] == "Unit"){ echo "selected"; } ?>>Unit</option>
            <option value="Pcs" <?php if($get_apd['satuan'] == "Pcs"){ echo "selected"; } ?>>Pcs</option>
            <option value="Set" <?php if($get_apd['satuan'] == "Set"){ echo "selected"; } ?>>Set</option>
            <option value="Lot" <?php if($get_apd['satuan'] == "Lot"){ echo "selected"; } ?>>Lot</option>
          </select>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_apd" value="Ubah APD">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->