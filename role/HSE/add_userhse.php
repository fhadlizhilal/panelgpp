<?php
	require_once "../../dev/config.php";
?>
 <form method="POST" action="">
	<div class="card-body">
		 <div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Manpower</label>
		    <div class="col-sm-9">
		      <select name="manpower_id" class="form-control form-control-sm" required>
		      	<option value="" selected disabled>--- Pilih Manpower ---</option>
		      	<?php
		      		$q_getManpower = mysqli_query($conn, "SELECT * FROM hse_manpower"); 
		      		while($getManpower = mysqli_fetch_array($q_getManpower)){
		      	?>
		      			<option value="<?php echo $getManpower['id'] ?>"><?php echo $getManpower['nama']; ?></option>
		      	<?php } ?>
		      </select>
		    </div>
		 </div>
	  	<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Username</label>
		    <div class="col-sm-9">
		      <input type="text" name="username" class="form-control form-control-sm" placeholder="Username" required>
		    </div>
	  	</div>
		 <div class="form-group row" style="margin-bottom: 0px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Password</label>
		    <div class="col-sm-9">
		      <input type="text" name="password" class="form-control form-control-sm" placeholder="Password" required>
		    </div>
		 </div>
	</div>
	<!-- /.card-body -->
	<hr>
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_hseuser" value="Submit">
	<!-- /.card-footer -->
</form>
