<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$id'"));
	}
?>
 <form method="POST" action="" enctype="multipart/form-data">
	<div class="card-body">
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">NIK</label>
		    <div class="col-sm-9">
		    	<input type="text" name="nik" class="form-control form-control-sm" placeholder="NIK" value="<?php echo $get_manpower['nik']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Lengkap</label>
		    <div class="col-sm-9">
		    	<input type="text" name="nama" class="form-control form-control-sm" placeholder="Nama Lengkap" value="<?php echo $get_manpower['nama']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tempat Lahir</label>
		    <div class="col-sm-9">
		    	<input type="text" name="tempat_lahir" class="form-control form-control-sm" placeholder="Tempat Lahir" value="<?php echo $get_manpower['tempat_lahir']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tanggal Lahir</label>
		    <div class="col-sm-6">
		    	<input type="date" name="tgl_lahir" class="form-control form-control-sm" value="<?php echo $get_manpower['tgl_lahir']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Gol Darah</label>
		    <div class="col-sm-9">
		    	<input type="text" name="golongan_darah" class="form-control form-control-sm" placeholder="Golongan Darah" value="<?php echo $get_manpower['golongan_darah']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Riwayat Penyakit</label>
		    <div class="col-sm-9">
		      <textarea class="form-control form-control-sm" name="riwayat_penyakit" required><?php echo $get_manpower['riwayat_penyakit']; ?></textarea>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Telpon</label>
		    <div class="col-sm-9">
		    	<input type="text" name="no_telpon" class="form-control form-control-sm" placeholder="No Telpon" value="<?php echo $get_manpower['no_telpon']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Alamat</label>
		    <div class="col-sm-9">
		    	<input type="text" name="alamat" class="form-control form-control-sm" placeholder="Alamat Lengkap" value="<?php echo $get_manpower['alamat']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Posisi Kerja</label>
		    <div class="col-sm-9">
		    	<input type="text" name="posisi_kerja" class="form-control form-control-sm" placeholder="Posisi Kerja" value="<?php echo $get_manpower['posisi_kerja']; ?>" required>
		    </div>
		</div>
		<hr>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Kerabat</label>
		    <div class="col-sm-9">
		    	<input type="text" name="nama_kerabat" class="form-control form-control-sm" placeholder="Nama Kerabat" value="<?php echo $get_manpower['nama_kerabat']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Hubungan</label>
		    <div class="col-sm-9">
		    	<input type="text" name="hubungan_kerabat" class="form-control form-control-sm" placeholder="Hubungan Kerabat" value="<?php echo $get_manpower['hubungan_kerabat']; ?>" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Telpon</label>
		    <div class="col-sm-9">
		    	<input type="text" name="no_telpon_kerabat" class="form-control form-control-sm" placeholder="No Telpon Kerabat" value="<?php echo $get_manpower['no_telpon_kerabat']; ?>" required>
		    </div>
		</div>
		<hr>
		<div class="form-group row" style="margin-bottom: 0px;">
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
				<?php if($get_manpower['foto'] == ""){ ?>
					<img src="../../dist/img/karyawan/vector_user.png" width="50%">
				<?php }else{ ?>
					<img src="foto_manpower/<?php echo $get_manpower['foto']; ?>" width="50%">
				<?php } ?>
			</div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
		    <div class="col-sm-9">
		    	<input type="file" name="file" class="form-control form-control-sm">
		    </div>
	  	</div>
	  	<div class="form-group row" style="margin-bottom: 0px;">
			<div class="col-sm-3"></div>
			<div class="col-sm-9">
				<?php if($get_manpower['ktp'] == ""){ ?>
					<img src="../../dist/img//vector-ktp.png" width="50%">
				<?php }else{ ?>
					<img src="foto_ktp/<?php echo $get_manpower['ktp']; ?>" width="50%">
				<?php } ?>
			</div>
		</div>
		<div class="form-group row" style="margin-bottom: 0px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
		    <div class="col-sm-9">
		    	<input type="file" name="file2" class="form-control form-control-sm">
		    </div>
	  	</div>
	</div>
	<!-- /.card-body -->
	<hr>
	<input type="hidden" name="id" value="<?php echo $id; ?>">
	<input type="submit" class="btn btn-primary btn-sm" name="submit_edit_manpower_v2" value="Simpan">
	</div>
</form>