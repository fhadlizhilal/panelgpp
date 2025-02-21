<?php
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $array = explode("/", $_POST['getID']);
    $id = $array[0];
    $spkid = $array[1];

    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE nik = '$id'"));
  }
?>

    
      <div style="font-size: 12px; margin-bottom: 8px; text-align: center; font-weight: bold;">Data Pribadi</div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">NIK</label>
        <input type="text" class="form-control form-control-sm col-8" name="nik" value="<?php echo $getKaryawan['nik']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Nama Lengkap</label>
        <input type="text" class="form-control form-control-sm col-8" name="nama" value="<?php echo $getKaryawan['nama']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Tempat Lahir</label>
        <input type="text" class="form-control form-control-sm col-8" name="tempat_lahir" value="<?php echo $getKaryawan['tempat_lahir']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Tanggal Lahir</label>
        <input type="date" class="form-control form-control-sm col-8" name="tgl_lahir" value="<?php echo $getKaryawan['tgl_lahir']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Golongan Darah</label>
        <input type="text" class="form-control form-control-sm col-2" name="golongan_darah" value="<?php echo $getKaryawan['golongan_darah']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Riwayat Penyakit</label>
        <input type="text" class="form-control form-control-sm col-8" name="riwayat_penyakit" value="<?php echo $getKaryawan['riwayat_penyakit']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">No Telepon</label>
        <input type="text" class="form-control form-control-sm col-8" name="no_telpon" value="<?php echo $getKaryawan['no_telpon']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Alamat</label>
        <textarea class="form-control form-control-sm col-8" name="alamat"><?php echo $getKaryawan['alamat']; ?></textarea>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Posisi Kerja</label>
        <input type="text" class="form-control form-control-sm col-8" name="posisi_kerja" value="<?php echo $getKaryawan['posisi_kerja']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4"></label>
        <div class="col-8">
          <img src="../../role/HSE/foto_manpower/<?php echo $getKaryawan['foto']; ?>" width="40%">
        </div>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Foto Diri</label>
        <input type="file" class="form-control form-control-sm col-8" name="file">
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4"></label>
        <div class="col-8">
          <img src="../../role/HSE/foto_ktp/<?php echo $getKaryawan['ktp']; ?>" width="60%">
        </div>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Foto KTP</label>
        <input type="file" class="form-control form-control-sm col-8" name="file2">
      </div>
     
     <hr>
      <div style="font-size: 12px; margin-bottom: 8px; text-align: center; font-weight: bold;">Data Kerabat</div>
       <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Nama Kerabat</label>
        <input type="text" class="form-control form-control-sm col-7" name="nama_kerabat" value="<?php echo $getKaryawan['nama_kerabat']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">Hubungan Kerabat</label>
        <input type="text" class="form-control form-control-sm col-7" name="hubungan_kerabat" value="<?php echo $getKaryawan['hubungan_kerabat']; ?>" required>
      </div>
      <div class="form-group row" style="margin-bottom: 5px;">
        <label class="col-4">No Telepon</label>
        <input type="text" class="form-control form-control-sm col-7" name="no_telpon_kerabat" value="<?php echo $getKaryawan['no_telpon_kerabat']; ?>" required>
      </div>

      <input type="hidden" name="nik_old" value="<?php echo $getKaryawan['nik']; ?>">