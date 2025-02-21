<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_dbdetail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_detail WHERE id = '$id'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">Detail Code</label>
      <div class="col-sm-9">
        <input type="text" class="form-control form-control-sm" name="detail_code" value="<?php echo $get_dbdetail["detail_code"]; ?>" required>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">General Code</label>
      <div class="col-sm-9">
        <select class="form-control form-control-sm" name="general_code_id" style="font-size: 11px;" required>
          <option value="" selected disabled>-- Pilih General Code --</option>
          <?php
            $q_get_generalcode = mysqli_query($conn, "SELECT * FROM asset_db_general ORDER BY general_code ASC");
            while($get_generalcode = mysqli_fetch_array($q_get_generalcode)){
          ?>
            <option value="<?php echo $get_generalcode['id']; ?>" <?php if($get_dbdetail['general_code_id'] == $get_generalcode['id']){ echo "selected"; } ?>>
              <?php echo $get_generalcode['general_code']." : ".$get_generalcode['nama_barang']." ".$get_generalcode['tipe_barang']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tipe Detail</label>
      <div class="col-sm-9">
        <input type="text" class="form-control form-control-sm" name="tipe_detail" value="<?php echo $get_dbdetail['tipe_detail']; ?>" required>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 6px;">
      <label class="col-sm-3 col-form-label" style="font-size: 12px;">Merek</label>
      <div class="col-sm-4">
        <select class="form-control form-control-sm" name="merek_id" required>
          <option value="" selected disabled>-- Pilih Merek --</option>
          <?php
            $q_get_merek = mysqli_query($conn, "SELECT * FROM asset_db_merek ORDER BY merek ASC");
            while($get_merek = mysqli_fetch_array($q_get_merek)){
          ?>
            <option value="<?php echo $get_merek['id']; ?>" <?php if($get_dbdetail['merek_id'] == $get_merek['id']){ echo "selected"; } ?>>
              <?php echo $get_merek['merek']; ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="card-footer">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" class="btn btn-info float-right" name="edit_dbdetail" value="Ubah">
  </div>