<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getAbsenTmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk_tmp WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getAbsenTmp[nik]'"));

    $jam_kantor = strtotime($_SESSION['tanggal_masuk_set']." ".$_SESSION['jam_masuk_set']);
    $jam_karyawan = strtotime($_SESSION['tanggal_masuk_set']." ".$getAbsenTmp['jam']);
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=form_absen_masuk">
      <div class="card-body">
        <table width="100%" style="font-size: 12px;">
          <tr>
            <td width="20%"><b>NIK</b></td>
            <td width="3%">:</td>
            <td><?php echo $getAbsenTmp['nik']; ?></td>
          </tr>
          <tr>
            <td><b>Nama</b></td>
            <td width="3%">:</td>
            <td><?php echo $getKaryawan['nama']; ?></td>
          </tr>
        </table>
        <br>
        <div class="form-group">
          <label style="font-size: 12px;">Status</label>
          <select name="status" class="form-control" style="font-size: 12px;">
            <?php if($getAbsenTmp['jam'] == "-"){ ?>
              <option value="Tugas Kantor">Tugas Kantor</option>
              <option value="Izin Tidak Masuk" <?php if($getAbsenTmp['status'] == "Izin Tidak Masuk"){ echo "selected" ;} ?>>Izin Tidak Masuk</option>
              <option value="Sakit - Dengan SKD" <?php if($getAbsenTmp['status'] == "Sakit - Dengan SKD"){ echo "selected" ;} ?>>Sakit - Dengan SKD</option>
              <option value="Sakit - Tanpa SKD" <?php if($getAbsenTmp['status'] == "Sakit - Tanpa SKD"){ echo "selected" ;} ?>>Sakit - Tanpa SKD</option>
              <option value="Cuti - Tahunan" <?php if($getAbsenTmp['status'] == "Cuti - Tahunan"){ echo "selected" ;} ?>>Cuti - Tahunan</option>
              <option value="Cuti - Menikah" <?php if($getAbsenTmp['status'] == "Cuti - Menikah"){ echo "selected" ;} ?>>Cuti - Menikah</option>
              <option value="Cuti - Melahirkan" <?php if($getAbsenTmp['status'] == "Cuti - Melahirkan"){ echo "selected" ;} ?>>Cuti - Melahirkan</option>
              <option value="Cuti - Ibadah" <?php if($getAbsenTmp['status'] == "Cuti - Ibadah"){ echo "selected" ;} ?>>Cuti - Ibadah</option>
              <option value="Tanpa Keterangan" <?php if($getAbsenTmp['status'] == "Tanpa Keterangan"){ echo "selected" ;} ?>>Tanpa Keterangan</option>
            <?php
              }elseif($jam_karyawan > $jam_kantor){
            ?>
              <option value="Terlambat" <?php if($getAbsenTmp['status'] == "Terlambat"){ echo "selected" ;} ?>>Terlambat</option>
              <option value="Izin Terlambat" <?php if($getAbsenTmp['status'] == "Izin Terlambat"){ echo "selected" ;} ?>>Izin Terlambat</option>
              <option value="Izin Masuk Siang" <?php if($getAbsenTmp['status'] == "Izin Masuk Siang"){ echo "selected" ;} ?>>Izin Masuk Siang</option>
              <option value="Pulang Tugas Kantor" <?php if($getAbsenTmp['status'] == "Pulang Tugas Kantor"){ echo "selected" ;} ?>>Pulang Tugas Kantor</option>
            <?php }else{ ?>
              <option value="Masuk">Masuk</option>
            <?php } ?>
          </select>
        </div>
        <?php if($getAbsenTmp['jam'] != "-"){ ?>
          <div class="form-group">
            <label style="font-size: 12px;">Fingerprint</label>
            <select name="fingerprint" class="form-control" style="font-size: 12px;">
              <?php if($getAbsenTmp['jam'] == "-"){ ?>
                <option value="-">-</option>
              <?php }else{ ?>
                <option value="Ya">Ya</option>
                <option value="Lupa/Tidak" <?php if($getAbsenTmp['fingerprint'] == "Lupa/Tidak"){ echo "selected" ;} ?>>Lupa/Tidak</option>
              <?php } ?>
            </select>
          </div>
        <?php }else{ ?>
          <input type="hidden" name="fingerprint" value="-">
        <?php } ?>
        <div class="form-group">
          <label style="font-size: 12px;">Keterangan</label>
          <input type="text" name="keterangan" class="form-control" value="<?php echo $getAbsenTmp['keterangan']; ?>">
          <br>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <center><input type="submit" class="btn btn-info" name="edit_status_masuk" value="Ubah"></center>
        </div>
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->