<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_apd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_apd WHERE id = '$id'"));
	}
?>
 <form method="POST" action="">
	<div class="card-body">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jenis APD</label>
	    <div class="col-sm-9">
	      <select class="form-control" name="jenis_apd" style="font-size: 13px;" required>
	      	<option value="" selected disabled>--- Pilih Jenis APD ---</option>
	      	<option value="Pelindung Kepala" <?php if($get_apd['jenis'] == 'Pelindung Kepala'){ echo "selected"; } ?>>Pelindung Kepala</option>
	      	<option value="Pelindung Mata" <?php if($get_apd['jenis'] == 'Pelindung Mata'){ echo "selected"; } ?>>Pelindung Mata</option>
	      	<option value="Pelindung Wajah" <?php if($get_apd['jenis'] == 'Pelindung Wajah'){ echo "selected"; } ?>>Pelindung Wajah</option>
	      	<option value="Pelindung Telinga" <?php if($get_apd['jenis'] == 'Pelindung Telinga'){ echo "selected"; } ?>>Pelindung Telinga</option>
	      	<option value="Pelindung Pernafasan" <?php if($get_apd['jenis'] == 'Pelindung Pernafasan'){ echo "selected"; } ?>>Pelindung Pernafasan</option>
	      	<option value="Pelindung Tubuh" <?php if($get_apd['jenis'] == 'Pelindung Tubuh'){ echo "selected"; } ?>>Pelindung Tubuh</option>
	      	<option value="Pelindung Tangan" <?php if($get_apd['jenis'] == 'Pelindung Tangan'){ echo "selected"; } ?>>Pelindung Tangan</option>
	      	<option value="Pelindung Kaki" <?php if($get_apd['jenis'] == 'Pelindung Kaki'){ echo "selected"; } ?>>Pelindung Kaki</option>
	      	<option value="Full Body Harness" <?php if($get_apd['jenis'] == 'Full Body Harness'){ echo "selected"; } ?>>Full Body Harness</option>
	      	<option value="Pelindung Alat Kerja / Material" <?php if($get_apd['jenis'] == 'Pelindung Alat Kerja / Material'){ echo "selected"; } ?>>Pelindung Alat Kerja / Material</option>
	      </select>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama APD</label>
	    <div class="col-sm-9">
	      <input type="text" name="nama_apd" class="form-control form-control-sm" placeholder="Nama APD" value="<?php echo $get_apd['nama_apd']; ?>" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Satuan</label>
	    <div class="col-sm-9">
	      <select class="form-control" name="satuan" style="font-size: 13px;" required>
	      	<option value="" selected disabled>--- Pilih Satuan ---</option>
	      	<option value="Pcs" <?php if($get_apd['satuan'] == 'Pcs'){ echo "selected"; } ?>>Pcs</option>
	      	<option value="Unit" <?php if($get_apd['satuan'] == 'Unit'){ echo "selected"; } ?>>Unit</option>
	      	<option value="Set" <?php if($get_apd['satuan'] == 'Set'){ echo "selected"; } ?>>Set</option>
	      	<option value="Pasang" <?php if($get_apd['satuan'] == 'Pasang'){ echo "selected"; } ?>>Pasang</option>
	      	<option value="Lot" <?php if($get_apd['satuan'] == 'Lot'){ echo "selected"; } ?>>Lot</option>
	      </select>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_hseapd" value="Simpan">
	<!-- /.card-footer -->
</form>