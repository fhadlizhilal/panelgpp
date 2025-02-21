<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_assets = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM assets_database WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-assets">
      <div class="card-body">
        <div class="form-group">
          <label>ID Asset</label>
          <input type="text" class="form-control" name="id_asset" value="<?php echo $get_assets['id_asset']; ?>" required>
        </div>
        <div class="form-group">
          <label>Nama Asset</label>
          <input type="text" class="form-control" name="nama" value="<?php echo $get_assets['nama']; ?>" required>
        </div>
        <div class="form-group">
          <label>Jenis</label>
          <input type="text" class="form-control" name="jenis" value="<?php echo $get_assets['jenis']; ?>" required>
        </div>
        <div class="form-group">
          <label>Merek</label>
          <select class="form-control" name="merek" required>
            <option value="" selected disabled>-- Pilih Merek --</option>
            <?php
              $q_getMerek = mysqli_query($conn, "SELECT * FROM merek");
              while($get_merek = mysqli_fetch_array($q_getMerek)){
            ?>
                <option value="<?php echo $get_merek['id']; ?>" <?php if($get_merek['id'] == $get_assets['merek']){ echo "selected"; } ?>><?php echo $get_merek['merek']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <select class="form-control" name="satuan" required>
            <option value="" selected disabled>-- Pilih Satuan --</option>
            <option value="Unit" <?php if($get_assets['satuan'] == "Unit"){ echo "selected"; } ?>>Unit</option>
            <option value="Pcs" <?php if($get_assets['satuan'] == "Pcs"){ echo "selected"; } ?>>Pcs</option>
            <option value="Set" <?php if($get_assets['satuan'] == "Set"){ echo "selected"; } ?>>Set</option>
            <option value="Lot" <?php if($get_assets['satuan'] == "Lot"){ echo "selected"; } ?>>Lot</option>
          </select>
        </div>
        <div class="form-group">
          <label>Gudang</label>
          <select class="form-control" name="gudang" required>
            <option value="" selected disabled>-- Pilih Gudang --</option>
            <option value="Gudang Inventaris" <?php if($get_assets['gudang'] == "Gudang Inventaris"){ echo "selected"; } ?>>Gudang Inventaris</option>
          </select>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_asset" value="Ubah Asset">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->