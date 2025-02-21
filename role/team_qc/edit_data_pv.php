<?php
	require_once "../../dev/config.php";
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
		$get_dataPV = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportpv_detail WHERE id = '$id'"));
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Serial PV</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="no_seri" value="<?php echo $get_dataPV['no_seri']; ?>" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tegangan</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control form-control-sm" name="tegangan" value="<?php echo $get_dataPV['tegangan']; ?>" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kondisi Fisik</label>
	    <div class="col-sm-4">
	      <select class="form-control form-control-sm" name="kondisi_fisik" required>
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK" <?php if($get_dataPV['kondisi_fisik']=="OK"){ echo "selected"; } ?>>OK</option>
	      	<option value="TIDAK OK" <?php if($get_dataPV['kondisi_fisik']=="TIDAK OK"){ echo "selected"; } ?>>TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jarak Lubang Frame</label>
	    <div class="col-sm-9">
	      <textarea class="form-control form-control-sm" name="jarak_lubang_frame" required><?php echo $get_dataPV['jarak_lubang_frame']; ?></textarea>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-sm-9">
	    	<img src="dokumentasi_report/<?php echo $get_dataPV['foto']; ?>" width="60%">
	      	<input type="file" class="form-control form-control-sm" name="file">
	    </div>
	 </div>
	 <hr>
	 <br><br>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Random Check</label>
	    <div class="col-sm-4">
	      <select class="form-control form-control-sm" name="random_check">
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK" <?php if($get_dataPV['random_check']=="OK"){ echo "selected"; } ?>>OK</option>
	      	<option value="TIDAK OK" <?php if($get_dataPV['random_check']=="TIDAK OK"){ echo "selected"; } ?>>TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-sm-9">
	    	<?php if($get_dataPV['foto_random_check'] != ""){ ?>
	    		<img src="dokumentasi_report/<?php echo $get_dataPV['foto_random_check']; ?>" width="60%">
	    	<?php } ?>
	      	<input type="file" class="form-control form-control-sm" name="file2">
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_data_pv" value="Ubah">
	<!-- /.card-footer -->
</form>