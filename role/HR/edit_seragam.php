<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_penilaianTmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM penilaian_harian_tmp WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_penilaianTmp[nik]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=form_penilaian_harian">
      <div class="card-body">
        <table width="100%" style="font-size: 12px;">
          <tr>
            <td width="20%"><b>NIK</b></td>
            <td width="3%">:</td>
            <td><?php echo $get_penilaianTmp['nik']; ?></td>
          </tr>
          <tr>
            <td><b>Nama</b></td>
            <td width="3%">:</td>
            <td><?php echo $getKaryawan['nama']; ?></td>
          </tr>
        </table>
        <br>
        <div class="form-group">
          <label style="font-size: 12px;">Seragam</label>
          <select name="seragam" class="form-control" style="font-size: 12px;">
            <?php if($get_penilaianTmp['seragam'] == "-"){ ?>
              <option value="-">-</option>
            <?php }else{ ?>
              <option value="Ya">Ya</option>
              <option value="Lupa/Tidak" <?php if($get_penilaianTmp['seragam'] == "Lupa/Tidak"){ echo "selected" ;} ?>>Lupa/Tidak</option>
            <?php } ?>
          </select>
          <br>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <center><input type="submit" class="btn btn-info" name="edit_seragam" value="Ubah"></center>
        </div>
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->