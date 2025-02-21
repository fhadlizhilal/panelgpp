<form method="POST" action="">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Pekerjaan</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="nama_pekerjaan" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tgl Report</label>
	    <div class="col-sm-4">
	      <input type="date" class="form-control form-control-sm" name="tgl_report" value="<?php echo date("Y-m-d"); ?>" required>
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="submit" class="btn btn-primary btn-sm" name="open_form_reportlampuaio" value="Buka Form">
	<!-- /.card-footer -->
</form>