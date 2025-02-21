<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_milestoneList = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM milestone_list WHERE id = '$id'"));
	}
?>
<form method="POST" action="">
	<div class="form-group row" style="margin-bottom: 8px;">
	  <label class="col-sm-3 col-form-label" style="font-size: 12px;">Job Description</label>
	  <div class="col-sm-9">
	    <textarea class="form-control form-control-sm" name="job_description" required><?php echo $get_milestoneList['job_description']; ?></textarea>
	  </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	  <label class="col-sm-3 col-form-label" style="font-size: 12px;">Person</label>
	  <div class="col-sm-9">
	    <select class="form-control" name="person" required>
	      <option value="" selected disabled>--- Pilih Person ---</option>
	      <?php
	        $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama = 'Hikmah Permana' OR nama = 'Deny Santika Permana' OR nama = 'Janu Abdu Rohman' OR nama = 'Gilvan Achmad Maulana Azhar' OR nama = 'Eldy Darmawan Sendy Pratama' OR nama = 'Gian Hartaman' OR nama = 'M Ihsan Mansur' OR nama = 'Andi Tyas' OR nama = 'Rai Purnama Rizki' OR nama = 'Dedi Mulyana' OR nama = 'Yosep Saepul Milah' OR nama = 'Whega Mahesa' OR nama = 'Novandy Iqbal Fadhillah' ORDER BY nama ASC");
	        while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
	      ?>
	          <option value="<?php echo $get_karyawan['nik'] ?>" <?php if($get_karyawan['nik'] == $get_milestoneList['person']){ echo "selected"; } ?>><?php echo $get_karyawan['nama'] ?></option>
	      <?php } ?>
	    </select>
	  </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	  <label class="col-sm-3 col-form-label" style="font-size: 12px;">Due Date</label>
	  <div class="col-sm-4">
	    <input type="date" class="form-control form-control-sm" name="due_date" value="<?php echo $get_milestoneList['due_date']; ?>" required>
	  </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	  <label class="col-sm-3 col-form-label" style="font-size: 12px;">Status</label>
	  <div class="col-sm-4">
	    <select class="form-control form-control-sm" name="status">
	    	<option value="open" <?php if($get_milestoneList['status'] == "open"){ echo "selected"; } ?>>Open</option>
	    	<option value="closed" <?php if($get_milestoneList['status'] == "closed"){ echo "selected"; } ?>>Closed</option>
	    </select>
	  </div>
	</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary" name="submit_edit_milestoneList" value="Simpan">
	<input type="submit" class="btn btn-danger" name="delete_milestoneList" value="Delete" style="float: right;" onclick="return confirm('Apakah Anda yakin ingin menghapus milestone ini?')">
	<!-- /.card-footer -->
</form>