<?php
	require_once "../../dev/config.php";
?>
 <form method="POST" action="">
	<div class="card-body">
	   <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jenis APD</label>
	    <div class="col-sm-9">
	      <select class="form-control" name="jenis_apd" style="font-size: 12px;" required>
	      	<option value="" selected disabled>--- Pilih Jenis APD ---</option>
	      	<option value="Pelindung Kepala">Pelindung Kepala</option>
	      	<option value="Pelindung Mata">Pelindung Mata</option>
	      	<option value="Pelindung Wajah">Pelindung Wajah</option>
	      	<option value="Pelindung Telinga">Pelindung Telinga</option>
	      	<option value="Pelindung Pernafasan">Pelindung Pernafasan</option>
	      	<option value="Pelindung Tubuh">Pelindung Tubuh</option>
	      	<option value="Pelindung Tangan">Pelindung Tangan</option>
	      	<option value="Pelindung Kaki">Pelindung Kaki</option>
	      	<option value="Full Body Harness">Full Body Harness</option>
	      	<option value="Pelindung Alat Kerja / Material">Pelindung Alat Kerja / Material</option>
	      </select>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama APD</label>
	    <div class="col-sm-9">
	      <input type="text" name="nama_apd" class="form-control form-control-sm" placeholder="Nama APD" required>
	    </div>
	  </div>
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Satuan</label>
	    <div class="col-sm-9">
	      <select class="form-control" name="satuan" style="font-size: 12px;" required>
	      	<option value="" selected disabled>--- Pilih Satuan ---</option>
	      	<option value="Pcs">Pcs</option>
	      	<option value="Unit">Unit</option>
	      	<option value="Set">Set</option>
	      	<option value="Pasang">Pasang</option>
	      	<option value="Lot">Lot</option>
	      </select>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_apd" value="Submit">
	<!-- /.card-footer -->
</form>