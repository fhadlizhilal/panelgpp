<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_inspeksip3k = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailp3k WHERE id = '$id'"));
    }
?>
    <div class="form-group row" style="margin-bottom: 8px;">
      <label class="col-3 col-form-label" style="font-size: 12px;">Tipe Kotak</label>
      <div class="col-9">
        <input type="text" class="form-control form-control-sm" value="<?php echo $get_data_inspeksip3k['tipe_kotak']; ?>" disabled>
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 8px;">
      <label class="col-3 col-form-label" style="font-size: 12px;">Foto</label>
      <div class="col-9">
        <input type="file" class="form-control form-control-sm" name="file">
      </div>
    </div>
    <div class="form-group row" style="margin-bottom: 8px;">
      <label class="col-3 col-form-label" style="font-size: 12px;">Keterangan</label>
      <div class="col-9">
        <textarea class="form-control form-control-sm" name="keterangan"></textarea>
      </div>
    </div>

    <br>
    <center>
      <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd'] ?>">
      <input type="submit" class="btn btn-info" name="add_dokumentasi_inspeksip3k" value="Simpan">
    </center>