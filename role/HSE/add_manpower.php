<?php
	require_once "../../dev/config.php";
?>
 <form method="POST" action="" enctype="multipart/form-data">
	<div class="card-body">
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">NIK</label>
		    <div class="col-sm-9">
		    	<input type="text" name="nik" class="form-control form-control-sm" placeholder="NIK" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Lengkap</label>
		    <div class="col-sm-9">
		    	<input type="text" name="nama" class="form-control form-control-sm" placeholder="Nama Lengkap" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tempat Lahir</label>
		    <div class="col-sm-9">
		    	<input type="text" name="tempat_lahir" class="form-control form-control-sm" placeholder="Tempat Lahir" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tanggal Lahir</label>
		    <div class="col-sm-6">
		    	<input type="date" name="tgl_lahir" class="form-control form-control-sm" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Gol Darah</label>
		    <div class="col-sm-9">
		    	<input type="text" name="golongan_darah" class="form-control form-control-sm" placeholder="Golongan Darah" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Riwayat Penyakit</label>
		    <div class="col-sm-9">
		      <textarea class="form-control form-control-sm" name="riwayat_penyakit" required></textarea>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Telpon</label>
		    <div class="col-sm-9">
		    	<input type="text" name="no_telpon" class="form-control form-control-sm" placeholder="No Telpon" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Alamat</label>
		    <div class="col-sm-9">
		    	<input type="text" name="alamat" class="form-control form-control-sm" placeholder="Alamat Lengkap" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Posisi Kerja</label>
		    <div class="col-sm-9">
		    	<input type="text" name="posisi_kerja" class="form-control form-control-sm" placeholder="Posisi Kerja" required>
		    </div>
		</div>
		<hr>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Kerabat</label>
		    <div class="col-sm-9">
		    	<input type="text" name="nama_kerabat" class="form-control form-control-sm" placeholder="Nama Kerabat" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Hubungan</label>
		    <div class="col-sm-9">
		    	<input type="text" name="hubungan_kerabat" class="form-control form-control-sm" placeholder="Hubungan Kerabat" required>
		    </div>
		</div>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">No Telpon</label>
		    <div class="col-sm-9">
		    	<input type="text" name="no_telpon_kerabat" class="form-control form-control-sm" placeholder="No Telpon Kerabat" required>
		    </div>
		</div>
		<hr>
		<div class="form-group row" style="margin-bottom: 8px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto Diri</label>
		    <div class="col-sm-9">
		    	<input type="file" name="file" class="form-control form-control-sm">
		    </div>
	  	</div>
	  	<div class="form-group row" style="margin-bottom: 0px;">
		    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto KTP</label>
		    <div class="col-sm-9">
		    	<input type="file" name="file2" class="form-control form-control-sm">
		    </div>
	  	</div>
	</div>
	<!-- /.card-body -->
	<hr>
	<input type="submit" class="btn btn-primary btn-sm" name="submit_add_manpower_v2" value="Submit">
	</div>
</form>