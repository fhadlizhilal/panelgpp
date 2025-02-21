<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getAbsenPulangTmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_pulang_tmp WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getAbsenPulangTmp[nik]'"));

    $jam_kantor = strtotime($_SESSION['tanggal_pulang_set']." ".$_SESSION['jam_pulang_set']);
    $jam_karyawan = strtotime($_SESSION['tanggal_pulang_set']." ".$getAbsenPulangTmp['jam']);
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=form_absen_pulang">
      <div class="card-body">
        <table width="100%" style="font-size: 12px;">
          <tr>
            <td width="20%"><b>NIK</b></td>
            <td width="3%">:</td>
            <td><?php echo $getAbsenPulangTmp['nik']; ?></td>
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
            <?php if($getAbsenPulangTmp['jam'] == "-"){ ?>
              <option value="-">-</option>
            <?php
              }elseif($getAbsenPulangTmp['jam'] == ""){
            ?>
              <option value="Pulang" <?php if($getAbsenPulangTmp['status'] == "Pulang"){ echo "selected" ;} ?>>Pulang</option>
              <option value="Pulang Cepat" <?php if($getAbsenPulangTmp['status'] == "Pulang Cepat"){ echo "selected" ;} ?>>Pulang Cepat</option>
              <option value="Izin Pulang Cepat" <?php if($getAbsenPulangTmp['status'] == "Izin Pulang Cepat"){ echo "selected" ;} ?>>Izin Pulang Cepat</option>
            <?php }elseif($jam_karyawan < $jam_kantor){ ?>
              <option value="Pulang Cepat" <?php if($getAbsenPulangTmp['status'] == "Pulang Cepat"){ echo "selected" ;} ?>>Pulang Cepat</option>
              <option value="Izin Pulang Cepat" <?php if($getAbsenPulangTmp['status'] == "Izin Pulang Cepat"){ echo "selected" ;} ?>>Izin Pulang Cepat</option>
            <?php }else{ ?>
              <option value="Pulang">Pulang</option>
            <?php } ?>
          </select>
          <br>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <center><input type="submit" class="btn btn-info" name="edit_status_pulang" value="Ubah"></center>
        </div>
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->