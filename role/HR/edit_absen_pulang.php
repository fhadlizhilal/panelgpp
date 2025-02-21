<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getAbsenPulang = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getAbsenPulang[nik]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=dbabsenpulang">
      <div class="card-body">
        <table width="100%" style="font-size: 12px;">
          <tr>
            <td width="35%"><b>NIK</b></td>
            <td width="3%">:</td>
            <td><?php echo $getAbsenPulang['nik']; ?></td>
          </tr>
          <tr>
            <td><b>Nama</b></td>
            <td width="3%">:</td>
            <td><?php echo $getKaryawan['nama']; ?></td>
          </tr>
          <tr>
            <td width="35%"><b>Hari/Tgl</b></td>
            <td width="3%">:</td>
            <td><?php echo date("D", strtotime($getAbsenPulang['tanggal']))." / ".date("d M Y", strtotime($getAbsenPulang['tanggal'])); ?></td>
          </tr>
        </table>
        <br>
        <table width="100%" style="font-size: 12px;">
          <tr>
            <td width="35%"><label style="font-size: 12px;">Jam Keluar</label></td>
            <td width="3%">:</td>
            <td><input type="time" name="jam_keluar" class="form-control form-control-sm" value="<?php echo $getAbsenPulang['jam']; ?>" style='font-size: 12px;'></td>
          </tr>
          <tr>
            <td width="35%"><label style="font-size: 12px;">Jam Pulang</label></td>
            <td width="3%">:</td>
            <td><input type="time" name="" class="form-control form-control-sm" value="<?php echo $getAbsenPulang['jam_pulang']; ?>" style="font-size: 12px;" disabled></td>
          </tr>
          <tr>
            <td width="35%"><label style="font-size: 12px;">Status</label></td>
            <td width="3%">:</td>
            <td>
              <select name="status" class="form-control form-control-sm" style="font-size: 12px;">
                <option value="Pulang" <?php if($getAbsenPulang['status'] == "Pulang"){ echo "selected" ;} ?>>Pulang</option>
                <option value="Pulang Cepat" <?php if($getAbsenPulang['status'] == "Pulang Cepat"){ echo "selected" ;} ?>>Pulang Cepat</option>
                <option value="Izin Pulang Cepat" <?php if($getAbsenPulang['status'] == "Izin Pulang Cepat"){ echo "selected" ;} ?>>Izin Pulang Cepat</option>
              </select>
            </td>
          </tr>
          <tr>
            <td width="35%"><label style="font-size: 12px;">Fingerprint</label></td>
            <td width="3%">:</td>
            <td>
              <select name="fingerprint" class="form-control form-control-sm" style="font-size: 12px;">
                <option value="-">-</option>
                <option value="Ya" <?php if($getAbsenPulang['fingerprint'] == "Ya"){ echo "selected" ;} ?>>Ya</option>
                <option value="Tidak/Lupa" <?php if($getAbsenPulang['fingerprint'] == "Tidak/Lupa"){ echo "selected" ;} ?>>Tidak/Lupa</option>
              </select>
            </td>
          </tr>
          <tr>
            <td width="35%"><label style="font-size: 12px;">Keterangan</label></td>
            <td width="3%">:</td>
            <td><input type="text" class="form-control form-control-sm" name="keterangan" value="<?php echo $getAbsenPulang['keterangan']; ?>" style="font-size: 12px;"></td>
          </tr>
        </table>
        <br>
        <input type="hidden" name="jam_pulang" value="<?php echo $getAbsenPulang['jam_pulang']; ?>">
        <input type="hidden" name="tanggal_absen" value="<?php echo $getAbsenPulang['tanggal']; ?>">
        <input type="hidden" name="nik" value="<?php echo $getAbsenPulang['nik']; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <center><input type="submit" class="btn btn-info" name="edit_absen_pulang" value="Ubah"></center>
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->