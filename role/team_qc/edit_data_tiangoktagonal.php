<?php
	require_once "../../dev/config.php";
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
		$get_dataTiangOktagonal = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reporttiangoktagonal_detail WHERE id = '$id'"));
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Panjang Segmen 1</label>
	    <div class="col-9">
	      <input type="text" class="form-control form-control-sm" name="panjang_segmen1" value="<?php echo $get_dataTiangOktagonal['panjang_segmen1']; ?>" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Panjang Segmen 2</label>
	    <div class="col-9">
	      <input type="text" class="form-control form-control-sm" name="panjang_segmen2" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Panjang Arm</label>
	    <div class="col-9">
	      <input type="text" class="form-control form-control-sm" name="panjang_arm" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Tinggi Arm</label>
	    <div class="col-9">
	      <input type="text" class="form-control form-control-sm" name="tinggi_arm" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Klem & Mur Baut</label>
	    <div class="col-4">
	      <select class="form-control form-control-sm" name="klem_murbaut" required>
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK">OK</option>
	      	<option value="TIDAK OK">TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Support Modul</label>
	    <div class="col-4">
	      <select class="form-control form-control-sm" name="support_modul" required>
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK">OK</option>
	      	<option value="TIDAK OK">TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Anti Panjat</label>
	    <div class="col-4">
	      <select class="form-control form-control-sm" name="anti_panjat" required>
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK">OK</option>
	      	<option value="TIDAK OK">TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Jarak Lubang Baut</label>
	    <div class="col-9">
	      <input type="text" class="form-control form-control-sm" name="jarak_lubang_baut" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Panjang & Lebar Baseplate</label>
	    <div class="col-9">
	      <input type="text" class="form-control form-control-sm" name="panjanglebar_baseplate" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Kemiringan Arm</label>
	    <div class="col-9">
	      <input type="text" class="form-control form-control-sm" name="kemiringan_arm" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Kemiringan Support Modul</label>
	    <div class="col-9">
	      <input type="text" class="form-control form-control-sm" name="kemiringan_support_modul" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Foto Tiang</label>
	    <div class="col-9">
	      <input type="file" class="form-control form-control-sm" name="file" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_data_tiangoktagonal" value="Ubah">
	<!-- /.card-footer -->
</form>