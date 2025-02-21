<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getPenilaianHarian = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getPenilaianHarian[nik]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=dbpenilaian">
      <div class="card-body">
        <table width="100%" style="font-size: 12px;">
          <tr>
            <td><b>NIK</b></td>
            <td width="5%">:</td>
            <td><?php echo $getPenilaianHarian['nik']; ?></td>
          </tr>
          <tr>
            <td><b>Nama</b></td>
            <td width="5%">:</td>
            <td><?php echo $getKaryawan['nama']; ?></td>
          </tr>
          <tr>
            <td width="25%"><b>Tanggal</b></td>
            <td width="5%">:</td>
            <td><?php echo date('d-m-Y', strtotime($getPenilaianHarian['tanggal'])); ?></td>
          </tr>
        </table>
        <br>
        <div class="form-group">
          <label style="font-size: 12px;">Program</label>
          <select name="program" class="form-control" style="font-size: 12px;">
            <?php if($getPenilaianHarian['program'] == "-"){ ?>
              <option value="-">-</option>
            <?php }else{ ?>
              <option value="Ya">Ya</option>
              <option value="Tidak" <?php if($getPenilaianHarian['program'] == "Tidak"){ echo "selected" ;} ?>>Tidak</option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label style="font-size: 12px;">Seragam</label>
          <select name="seragam" class="form-control" style="font-size: 12px;">
            <?php if($getPenilaianHarian['seragam'] == "-"){ ?>
              <option value="-">-</option>
            <?php }else{ ?>
              <option value="Ya">Ya</option>
              <option value="Lupa/Tidak" <?php if($getPenilaianHarian['seragam'] == "Lupa/Tidak"){ echo "selected" ;} ?>>Lupa/Tidak</option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label style="font-size: 12px;">Nametag</label>
          <select name="nametag" class="form-control" style="font-size: 12px;">
            <?php if($getPenilaianHarian['nametag'] == "-"){ ?>
              <option value="-">-</option>
            <?php }else{ ?>
              <option value="Ya">Ya</option>
              <option value="Lupa/Tidak" <?php if($getPenilaianHarian['nametag'] == "Lupa/Tidak"){ echo "selected" ;} ?>>Lupa/Tidak</option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="nik_karyawan" value="<?php echo $getPenilaianHarian['nik']; ?>">
          <input type="hidden" name="tgl_penilaian" value="<?php echo $getPenilaianHarian['tanggal']; ?>">
          <center><input type="submit" class="btn btn-info" name="edit_penilaian_harian" value="Ubah"></center>
        </div>
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->