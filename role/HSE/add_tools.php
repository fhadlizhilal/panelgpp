<?php
	require_once "../../dev/config.php";
?>
 <form method="POST" action="">
	  <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tools</label>
	    <div class="col-sm-9">
	      <input type="text" name="tools" class="form-control form-control-sm" placeholder="Nama Tools" required>
	    </div>
	  </div>
	<!-- /.card-body -->
	<hr>
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_tools" value="Submit">
	<!-- /.card-footer -->
</form>