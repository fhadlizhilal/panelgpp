<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_dbgeneral = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$id'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">General Code</label>
      <div class="col-sm-9">
        <input type="text" class="form-control form-control-sm" name="general_code" value="<?php echo $get_dbgeneral['general_code']; ?>" required>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Barang</label>
      <div class="col-sm-9">
        <input type="text" class="form-control form-control-sm" name="nama_barang" value="<?php echo $get_dbgeneral['nama_barang']; ?>" required>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tipe Barang</label>
      <div class="col-sm-9">
        <input type="text" class="form-control form-control-sm" name="tipe_barang" value="<?php echo $get_dbgeneral['tipe_barang']; ?>" required>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">Sub Barang</label>
      <div class="col-sm-4">
        <select class="form-control form-control-sm" name="sub_barang" required>
          <option value="" selected disabled>-- Pilih Sub --</option>
          <option value="Continue" <?php if($get_dbgeneral['sub_barang'] == "Continue"){ echo "selected"; } ?>>Continue</option>
          <option value="Habis Pakai" <?php if($get_dbgeneral['sub_barang'] == "Habis Pakai"){ echo "selected"; } ?>>Habis Pakai</option>
        </select>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">Satuan</label>
      <div class="col-sm-4">
        <select class="form-control form-control-sm" name="satuan" required>
          <option value="" selected disabled>-- Pilih Satuan --</option>
          <option value="Lembar" <?php if($get_dbgeneral['satuan'] == "Lembar"){ echo "selected"; } ?>>Lembar</option>
          <option value="Lot" <?php if($get_dbgeneral['satuan'] == "Lot"){ echo "selected"; } ?>>Lot</option>
          <option value="Meter" <?php if($get_dbgeneral['satuan'] == "Meter"){ echo "selected"; } ?>>Meter</option>
          <option value="Pack" <?php if($get_dbgeneral['satuan'] == "Pack"){ echo "selected"; } ?>>Pack</option>
          <option value="Pair" <?php if($get_dbgeneral['satuan'] == "Pair"){ echo "selected"; } ?>>Pair</option>
          <option value="Pcs" <?php if($get_dbgeneral['satuan'] == "Pcs"){ echo "selected"; } ?>>Pcs</option>
          <option value="Roll" <?php if($get_dbgeneral['satuan'] == "Roll"){ echo "selected"; } ?>>Roll</option>
          <option value="Set" <?php if($get_dbgeneral['satuan'] == "Set"){ echo "selected"; } ?>>Set</option>
          <option value="Unit" <?php if($get_dbgeneral['satuan'] == "Unit"){ echo "selected"; } ?>>Unit</option>
        </select>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jenis</label>
      <div class="col-sm-4">
        <select class="form-control form-control-sm" name="jenis" required>
          <option value="" selected disabled>-- Pilih Jenis --</option>
          <option value="APD" <?php if($get_dbgeneral['jenis'] == "APD"){ echo "selected"; } ?>>APD</option>
          <option value="Tools" <?php if($get_dbgeneral['jenis'] == "Tools"){ echo "selected"; } ?>>Tools</option>
          <option value="Inventaris" <?php if($get_dbgeneral['jenis'] == "Inventaris"){ echo "selected"; } ?>>Inventaris</option>
          <option value="Alat Ukur" <?php if($get_dbgeneral['jenis'] == "Alat Ukur"){ echo "selected"; } ?>>Alat Ukur</option>
        </select>
      </div>
    </div>
  </div>
  <div class="card-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" class="btn btn-info float-right" name="edit_dbgeneral" value="Ubah">
  </div>