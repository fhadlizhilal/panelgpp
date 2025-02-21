<?php
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kondisi Lampu</label>
	    <div class="col-sm-4">
		      <select class="form-control form-control-sm" name="kondisi" required>
		      	<option value="" selected disabled>-- Pilih Kondisi --</option>
		      	<option value="BAIK">BAIK</option>
		      	<option value="TIDAK BAIK">TIDAK BAIK</option>
		      </select>
		 </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Stiker QC</label>
	    <div class="col-sm-4">
		      <select class="form-control form-control-sm" name="stiker_qc" required>
		      	<option value="" selected disabled>-- Pilih Kondisi --</option>
		      	<option value="Terpasang">Terpasang</option>
		      	<option value="Tidak Dipasang">Tidak Dipasang</option>
		      </select>
		 </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto Lampu</label>
	    <div class="col-sm-9">
	      <input type="file" class="form-control form-control-sm" name="file" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="report_id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="add_data_lampuac" value="Simpan">
	<!-- /.card-footer -->
</form>