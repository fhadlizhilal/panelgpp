<?php
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Serial Lampu</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="no_seri" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto Lampu</label>
	    <div class="col-sm-9">
	      <input type="file" class="form-control form-control-sm" name="file" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kondisi Lampu</label>
	    <div class="col-sm-4">
	      <select class="form-control form-control-sm" name="kondisi_lampu" required>
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK">OK</option>
	      	<option value="TIDAK OK">TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Aksesoris</label>
	    <div class="col-sm-4">
		      <select class="form-control form-control-sm" name="aksesoris" required>
		      	<option value="" selected disabled>-- Aksesoris --</option>
		      	<option value="LENGKAP">LENGKAP</option>
		      	<option value="TIDAK LENGKAP">TIDAK LENGKAP</option>
		      </select>
		 </div>
	 </div>
	 <hr>
	 <br><br>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Random Check</label>
	    <div class="col-sm-4">
	      <select class="form-control form-control-sm" name="random_check">
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK">OK</option>
	      	<option value="TIDAK OK">TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-sm-9">
	      <input type="file" class="form-control form-control-sm" name="file2">
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="report_id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="add_data_lampuaio" value="Simpan">
	<!-- /.card-footer -->
</form>