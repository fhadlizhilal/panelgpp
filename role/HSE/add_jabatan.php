<?php
	require_once "../../dev/config.php";
?>
 <form method="POST" action="">
	<div class="card-body">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jabatan</label>
	    <div class="col-sm-9">
	      <input type="text" name="jabatan" class="form-control form-control-sm" placeholder="Nama Jabatan" required>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_jabatan" value="Submit">
	<!-- /.card-footer -->
	</div>
</form>