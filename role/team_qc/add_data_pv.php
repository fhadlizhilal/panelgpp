<?php
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Serial PV</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="no_seri" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tegangan</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control form-control-sm" name="tegangan" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kondisi Fisik</label>
	    <div class="col-sm-4">
	      <select class="form-control form-control-sm" name="kondisi_fisik" required>
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK">OK</option>
	      	<option value="TIDAK OK">TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jarak Lubang Frame</label>
	    <div class="col-sm-9">
	      <textarea class="form-control form-control-sm" name="jarak_lubang_frame" required></textarea>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-sm-9">
	      <input type="file" class="form-control form-control-sm" name="file" required>
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
	<input type="submit" class="btn btn-primary btn-sm" name="add_data_pv" value="Simpan">
	<!-- /.card-footer -->
</form>