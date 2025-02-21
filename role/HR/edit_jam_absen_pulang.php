<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getAbsenPulangTmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_pulang_tmp WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getAbsenPulangTmp[nik]'"));
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
          <label style="font-size: 12px;">Jam Pulang</label>
          <input type="time" class="form-control" name="jam_pulang" value="<?php echo $getAbsenPulangTmp['jam']; ?>">
          <br>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <center><input type="submit" class="btn btn-info" name="edit_jam_absen_pulang" value="Ubah"></center>
        </div>
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->