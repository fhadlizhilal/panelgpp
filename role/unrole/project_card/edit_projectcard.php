<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$kd_project = $_POST['getID'];
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$kd_project'"));
    	$get_projectcardList = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM projectcard_list WHERE kd_project = '$kd_project'"));
	}
?>
<form method="POST" action="">
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kode Project</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" value="<?php echo $kd_project; ?>" style="font-size: 12px;" disabled>
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama project</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="jumlah" value="<?php echo $get_project['nm_project']; ?>" style="font-size: 12px;" disabled>
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">PM</label>
	    <div class="col-sm-9">
	      	<select class="form-control" name="pm" style="font-size: 12px;" required>
                <option value="" selected disabled>--- Pilih PM ---</option>
                <option value="NULL">-</option>
                	<?php
                    	$q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama = 'Hikmah Permana' OR nama = 'Deny Santika Permana' OR nama = 'Janu Abdu Rohman' OR nama = 'Gilvan Achmad Maulana Azhar' OR nama = 'Eldy Darmawan Sendy Pratama' OR nama = 'Gian Hartaman' OR nama = 'M Ihsan Mansur' OR nama = 'Andi Tyas' OR nama = 'Rai Purnama Rizki' OR nama = 'Dedi Mulyana' OR nama = 'Yosep Saepul Milah' OR nama = 'Whega Mahesa' ORDER BY nama ASC");
                    	while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
                  	?>
                      		<option value="<?php echo $get_karyawan['nik'] ?>" <?php if($get_karyawan['nik'] == $get_projectcardList['pm']){ echo "selected"; } ?>><?php echo $get_karyawan['nama'] ?></option>
                  	<?php } ?>
            </select>
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">SM</label>
	    <div class="col-sm-9">
	      	<select class="form-control" name="sm" style="font-size: 12px;" required>
                <option value="" selected disabled>--- Pilih SM ---</option>
                <option value="NULL"<?php if($get_projectcardList['sm'] == NULL){ echo "selected"; } ?>>-</option>
                	<?php
                    	$q_get_karyawan_sm = mysqli_query($conn, "SELECT * FROM karyawan_sm ORDER BY nama ASC");
                    while($get_karyawan_sm = mysqli_fetch_array($q_get_karyawan_sm)){
                  	?>
                      		<option value="<?php echo $get_karyawan_sm['id'] ?>" <?php if($get_karyawan_sm['id'] == $get_projectcardList['sm']){ echo "selected"; } ?>><?php echo $get_karyawan_sm['nama'] ?></option>
                  	<?php } ?>
            </select>
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Actual Start</label>
	    <div class="col-sm-4">
	      <input type="date" class="form-control" name="actual_start" value="<?php echo $get_projectcardList['actual_start']; ?>" style="font-size: 12px;">
	    </div>
	</div>
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Actual End</label>
	    <div class="col-sm-4">
	      <input type="date" class="form-control" name="actual_end" value="<?php echo $get_projectcardList['actual_end']; ?>" style="font-size: 12px;">
	    </div>
	</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="kd_project" value="<?php echo $kd_project; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_projectcard" value="Simpan">
	<!-- /.card-footer -->
</form>