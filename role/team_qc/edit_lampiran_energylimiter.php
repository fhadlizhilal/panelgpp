<?php
	require_once "../../dev/config.php";
	if(isset($_POST['getID'])){
		$id = $_POST['getID'];
		$get_dataLampiranEnergyLimiter = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportenergylimiter_lampiran WHERE id = '$id'"));
	}
?>

<form method="POST" action="" enctype="multipart/form-data">
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Keterangan</label>
	    <div class="col-9">
	      <textarea class="form-control form-control-sm" name="keterangan" required><?php echo $get_dataLampiranEnergyLimiter['keterangan']; ?></textarea>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Foto</label>
	    <div class="col-9">
	      <img src="dokumentasi_report/<?php echo $get_dataLampiranEnergyLimiter['foto']; ?>" width="60%">
	      <input type="file" class="form-control form-control-sm" name="file">
	    </div>
	 </div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="edit_lampiran_energylimiter" value="Ubah">
	<!-- /.card-footer -->
</form>