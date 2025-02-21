<?php
	require_once "../../dev/config.php";
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
		$get_dataLampuaio = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuaio_detail WHERE id = '$id'"));
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	<div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Serial Lampu</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control form-control-sm" name="no_seri" value="<?php echo $get_dataLampuaio['no_seri']; ?>" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto Lampu</label>
	    <div class="col-sm-9">
	    	<?php if($get_dataLampuaio['foto_lampu'] != ""){ ?>
	    		<img src="dokumentasi_report/<?php echo $get_dataLampuaio['foto_lampu']; ?>" width="60%">
	    	<?php } ?>
	      <input type="file" class="form-control form-control-sm" name="file">
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kondisi Lampu</label>
	    <div class="col-sm-4">
	      <select class="form-control form-control-sm" name="kondisi_lampu" required>
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK" <?php if($get_dataLampuaio['kondisi_lampu'] == "OK"){ echo "selected"; } ?>>OK</option>
	      	<option value="TIDAK OK" <?php if($get_dataLampuaio['kondisi_lampu'] == "TIDAK OK"){ echo "selected"; } ?>>TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Aksesoris</label>
	    <div class="col-sm-4">
		      <select class="form-control form-control-sm" name="aksesoris" required>
		      	<option value="" selected disabled>-- Aksesoris --</option>
		      	<option value="LENGKAP" <?php if($get_dataLampuaio['aksesoris'] == "LENGKAP"){ echo "selected"; } ?>>LENGKAP</option>
		      	<option value="TIDAK LENGKAP" <?php if($get_dataLampuaio['aksesoris'] == "TIDAK LENGKAP"){ echo "selected"; } ?>>TIDAK LENGKAP</option>
		      </select>
		 </div>
	 </div>
	 <hr>
	 <br><br>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Random Check</label>
	    <div class="col-sm-4">
	      <select class="form-control form-control-sm" name="random_check">
	      	<option value="" selected disabled>-- Pilih Kondisi --</option>
	      	<option value="OK" <?php if($get_dataLampuaio['random_check']=="OK"){ echo "selected"; } ?>>OK</option>
	      	<option value="TIDAK OK" <?php if($get_dataLampuaio['random_check']=="TIDAK OK"){ echo "selected"; } ?>>TIDAK OK</option>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-sm-9">
	    	<?php if($get_dataLampuaio['foto_random_check'] != ""){ ?>
	    		<img src="dokumentasi_report/<?php echo $get_dataLampuaio['foto_random_check']; ?>" width="60%">
	    	<?php } ?>
	      	<input type="file" class="form-control form-control-sm" name="file2">
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_data_lampuaio" value="Ubah">
	<!-- /.card-footer -->
</form>