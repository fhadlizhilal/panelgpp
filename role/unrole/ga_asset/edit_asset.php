<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ga_asset WHERE id = '$id'"));
	}
?>
 	<table class="table table-sm" style="font-size: 11px;">
	  <tr>
	    <td width="26%" style="vertical-align: middle;">Nama Asset</td>
	    <td width="1%" style="vertical-align: middle;">:</td>
	    <td><input class="form-control form-control-sm" type="text" name="nama_asset" value="<?php echo $get_asset['nama_asset']; ?>" required></td>
	  </tr>
	  <tr>
	    <td style="vertical-align: middle;">Detail Asset</td>
	    <td style="vertical-align: middle;">:</td>
	    <td style="vertical-align: middle;">
	      <input class="form-control form-control-sm" type="text" name="detail_asset" value="<?php echo $get_asset['detail_asset']; ?>" required>
	    </td>
	  </tr>
	  <tr>
	    <td style="vertical-align: middle;">Jenis Asset</td>
	    <td style="vertical-align: middle;">:</td>
	    <td style="vertical-align: middle;">
	      <select class="form-control form-control-sm" name="jenis_id" required>
	        <option value="" disabled selected>--- Pilih Jenis ---</option>
	        <?php
	          $q_get_jenis = mysqli_query($conn, "SELECT * FROM ga_jenis");
	          while($get_jenis = mysqli_fetch_array($q_get_jenis)){
	        ?>
	            <option value="<?php echo $get_jenis['id']; ?>" <?php if($get_jenis['id']==$get_asset['jenis_id']){ echo "selected"; } ?>><?php echo $get_jenis['jenis']; ?></option>
	        <?php } ?>
	      </select>
	    </td>
	  </tr>
	  <tr>
	    <td style="vertical-align: middle;">Tanggal Perolehan</td>
	    <td style="vertical-align: middle;">:</td>
	    <td style="vertical-align: middle;">
	      <input class="form-control form-control-sm" type="date" name="tgl_perolehan" value="<?php echo $get_asset['tgl_perolehan']; ?>" required>
	    </td>
	  </tr>
	  <tr>
	    <td style="vertical-align: middle;">Qty</td>
	    <td style="vertical-align: middle;">:</td>
	    <td style="vertical-align: middle;">
	      <input class="form-control form-control-sm" type="number" name="qty" value="<?php echo $get_asset['qty']; ?>" required>
	    </td>
	  </tr>
	  <tr>
        <td style="vertical-align: middle;">Satuan</td>
        <td style="vertical-align: middle;">:</td>
        <td style="vertical-align: middle;">
          <select class="form-control form-control-sm" name="satuan" required>
            <option value="" disabled selected>--- Pilih Satuan ---</option>
            <option value="Pcs" <?php if($get_asset['satuan'] == "Pcs"){ echo "selected"; } ?>>Pcs</option>
            <option value="Unit" <?php if($get_asset['satuan'] == "Unit"){ echo "selected"; } ?>>Unit</option>
            <option value="Set" <?php if($get_asset['satuan'] == "Set"){ echo "selected"; } ?>>Set</option>
            <option value="Lot" <?php if($get_asset['satuan'] == "Lot"){ echo "selected"; } ?>>Lot</option>
          </select>
        </td>
      </tr>
	  <tr>
	    <td style="vertical-align: middle;">Harga Satuan</td>
	    <td style="vertical-align: middle;">:</td>
	    <td style="vertical-align: middle;">
	      <input class="form-control form-control-sm" type="text" id="rupiah" name="harga_satuan" value="<?php echo $get_asset['harga_satuan']; ?>" required>
	    </td>
	  </tr>
	  <tr>
	    <td style="vertical-align: middle;">Metode Penyusutan</td>
	    <td style="vertical-align: middle;">:</td>
	    <td style="vertical-align: middle;">
	      <select class="form-control form-control-sm" name="metode_penyusutan" required>
	        <option value="" disabled selected>--- Pilih Metode ---</option>
	        <option value="Garis Lurus" <?php if($get_asset['metode_penyusutan'] == 'Garis Lurus'){ echo "selected"; } ?>>Garis Lurus</option>
	      </select>
	    </td>
	  </tr>
	  <tr>
	    <td style="vertical-align: middle;">Umur Manfaat</td>
	    <td style="vertical-align: middle;">:</td>
	    <td style="vertical-align: middle;">
	      <input class="form-control form-control-sm" type="number" name="umur_manfaat" value="<?php echo $get_asset['umur_manfaat']; ?>" required>
	    </td>
	  </tr>
	  <tr>
	    <td style="vertical-align: middle;">Lokasi Asset</td>
	    <td style="vertical-align: middle;">:</td>
	    <td style="vertical-align: middle;">
	      <select class="form-control form-control-sm" name="lokasi_asset" required>
	        <option value="" disabled selected>--- Pilih Lokasi Asset ---</option>
	        <optgroup label="RUANGAN">
	        <?php
	          $q_get_ruangan = mysqli_query($conn, "SELECT * FROM ga_ruangan");
	          while($get_ruangan = mysqli_fetch_array($q_get_ruangan)){
	        ?>
	            <option value="<?php echo $get_ruangan['id']; ?>" <?php if($get_asset['lokasi_asset'] == $get_ruangan['id']){ echo "selected"; } ?>><?php echo $get_ruangan['nm_ruangan']; ?></option>
	        <?php } ?>

	        <optgroup label="KARYAWAN">
	        <?php
	          $q_get_karyawan = mysqli_query($conn, "SELECT nik, nama FROM karyawan WHERE nama <> 'Fadhli Aoliana' AND nama <> 'Winda Fauziah'");
	          while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
	        ?>
	            <option value="<?php echo $get_karyawan['nik']; ?>" <?php if($get_asset['lokasi_asset'] == $get_karyawan['nik']){ echo "selected"; } ?>><?php echo $get_karyawan['nama']; ?></option>
	        <?php } ?>
	      </select>
	    </td>
	  </tr>
	</table>

	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_asset" value="Simpan">