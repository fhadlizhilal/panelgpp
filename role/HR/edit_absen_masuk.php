<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getAbsenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getAbsenMasuk[nik]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=dbabsenmasuk">
      <div class="card-body">
        <table width="100%" style="font-size: 12px;">
          <tr>
            <td width="35%"><b>NIK</b></td>
            <td width="3%">:</td>
            <td><?php echo $getAbsenMasuk['nik']; ?></td>
          </tr>
          <tr>
            <td><b>Nama</b></td>
            <td width="3%">:</td>
            <td><?php echo $getKaryawan['nama']; ?></td>
          </tr>
          <tr>
            <td width="35%"><b>Hari/Tgl</b></td>
            <td width="3%">:</td>
            <td><?php echo date("D", strtotime($getAbsenMasuk['tanggal']))." / ".date("d M Y", strtotime($getAbsenMasuk['tanggal'])); ?></td>
          </tr>
        </table>
        <br>
        <table width="100%" style="font-size: 12px;">
          <tr>
            <td width="35%"><label style="font-size: 12px;">Jam Keluar</label></td>
            <td width="3%">:</td>
            <td><input type="time" name="jam_tiba" class="form-control form-control-sm" value="<?php echo $getAbsenMasuk['jam']; ?>" style='font-size: 12px;'></td>
          </tr>
          <tr>
            <td width="35%"><label style="font-size: 12px;">Jam Masuk</label></td>
            <td width="3%">:</td>
            <td><input type="time" name="" class="form-control form-control-sm" value="<?php echo $getAbsenMasuk['jam_masuk']; ?>" style="font-size: 12px;" disabled></td>
          </tr>
          <tr>
            <td width="35%"><label style="font-size: 12px;">Status</label></td>
            <td width="3%">:</td>
            <td>
              <select name="status" class="form-control form-control-sm" style="font-size: 12px;">
                <option value="Masuk" <?php if($getAbsenMasuk['status'] == "Masuk"){ echo "selected" ;} ?>>Masuk</option>
                <option value="Terlambat" <?php if($getAbsenMasuk['status'] == "Terlambat"){ echo "selected" ;} ?>>Terlambat</option>
                <option value="Izin Terlambat" <?php if($getAbsenMasuk['status'] == "Izin Terlambat"){ echo "selected" ;} ?>>Izin Terlambat</option>
                <option value="Izin Masuk Siang" <?php if($getAbsenMasuk['status'] == "Izin Masuk Siang"){ echo "selected" ;} ?>>Izin Masuk Siang</option>
                <option value="Pulang Tugas Kantor" <?php if($getAbsenMasuk['status'] == "Pulang Tugas Kantor"){ echo "selected" ;} ?>>Pulang Tugas Kantor</option>
                <option value="Tugas Kantor" <?php if($getAbsenMasuk['status'] == "Tugas Kantor"){ echo "selected" ;} ?>>Tugas Kantor</option>
                <option value="Izin Tidak Masuk" <?php if($getAbsenMasuk['status'] == "Izin Tidak Masuk"){ echo "selected" ;} ?>>Izin Tidak Masuk</option>
                <option value="Sakit - Dengan SKD" <?php if($getAbsenMasuk['status'] == "Sakit - Dengan SKD"){ echo "selected" ;} ?>>Sakit - Dengan SKD</option>
                <option value="Sakit - Tanpa SKD" <?php if($getAbsenMasuk['status'] == "Sakit - Tanpa SKD"){ echo "selected" ;} ?>>Sakit - Tanpa SKD</option>
                <option value="Cuti - Tahunan" <?php if($getAbsenMasuk['status'] == "Cuti - Tahunan"){ echo "selected" ;} ?>>Cuti - Tahunan</option>
                <option value="Cuti - Menikah" <?php if($getAbsenMasuk['status'] == "Cuti - Menikah"){ echo "selected" ;} ?>>Cuti - Menikah</option>
                <option value="Cuti - Melahirkan" <?php if($getAbsenMasuk['status'] == "Cuti - Melahirkan"){ echo "selected" ;} ?>>Cuti - Melahirkan</option>
                <option value="Cuti - Ibadah" <?php if($getAbsenMasuk['status'] == "Cuti - Ibadah"){ echo "selected" ;} ?>>Cuti - Ibadah</option>
                <option value="Tanpa Keterangan" <?php if($getAbsenMasuk['status'] == "Tanpa Keterangan"){ echo "selected" ;} ?>>Tanpa Keterangan</option>
              </select>
            </td>
          </tr>
          <tr>
            <td width="35%"><label style="font-size: 12px;">Fingerprint</label></td>
            <td width="3%">:</td>
            <td>
              <select name="fingerprint" class="form-control form-control-sm" style="font-size: 12px;">
                <option value="-">-</option>
                <option value="Ya" <?php if($getAbsenMasuk['fingerprint'] == "Ya"){ echo "selected" ;} ?>>Ya</option>
                <option value="Lupa/Tidak" <?php if($getAbsenMasuk['fingerprint'] == "Lupa/Tidak"){ echo "selected" ;} ?>>Lupa/Tidak</option>
              </select>
            </td>
          </tr>
          <tr>
            <td width="35%"><label style="font-size: 12px;">Keterangan</label></td>
            <td width="3%">:</td>
            <td><input type="text" class="form-control form-control-sm" name="keterangan" value="<?php echo $getAbsenMasuk['keterangan']; ?>" style="font-size: 12px;"></td>
          </tr>
        </table>
        <br>
        <input type="hidden" name="jam_masuk" value="<?php echo $getAbsenMasuk['jam_masuk']; ?>">
        <input type="hidden" name="tanggal_absen" value="<?php echo $getAbsenMasuk['tanggal']; ?>">
        <input type="hidden" name="nik" value="<?php echo $getAbsenMasuk['nik']; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <center><input type="submit" class="btn btn-info" name="edit_absen_masuk" value="Ubah"></center>
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->