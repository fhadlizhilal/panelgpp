<?php
	require_once "../../dev/config.php";
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
		$get_dataLampuac = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuac_detail WHERE id = '$id'"));
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kondisi Lampu</label>
	    <div class="col-sm-4">
		      <select class="form-control form-control-sm" name="kondisi" required>
		      	<option value="" selected disabled>-- Pilih Kondisi --</option>
		      	<option value="BAIK" <?php if($get_dataLampuac['kondisi'] == "BAIK"){ echo "selected"; } ?>>BAIK</option>
		      	<option value="TIDAK BAIK" <?php if($get_dataLampuac['kondisi'] == "TIDAK BAIK"){ echo "selected"; } ?>>TIDAK BAIK</option>
		      </select>
		 </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Stiker QC</label>
	    <div class="col-sm-4">
		      <select class="form-control form-control-sm" name="stiker_qc" required>
		      	<option value="" selected disabled>-- Pilih Kondisi --</option>
		      	<option value="Terpasang" <?php if($get_dataLampuac['stiker_qc'] == "Terpasang"){ echo "selected"; } ?>>Terpasang</option>
		      	<option value="Tidak Dipasang" <?php if($get_dataLampuac['stiker_qc'] == "Tidak Dipasang"){ echo "selected"; } ?>>Tidak Dipasang</option>
		      </select>
		 </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto Lampu</label>
	    <div class="col-sm-9">
	    	<img src="dokumentasi_report/<?php echo $get_dataLampuac['foto']; ?>" width="60%">
	     	<input type="file" class="form-control form-control-sm" name="file">
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_data_lampuac" value="Ubah">
	<!-- /.card-footer -->
</form>