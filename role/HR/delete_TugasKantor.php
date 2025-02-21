<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getTugasKantor = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tugas_kantor WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getTugasKantor[nik]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=STK">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="20%"><b>Nik</b></td>
            <td width="1%">:</td>
            <td><?php echo $getTugasKantor['nik']; ?></td>
          </tr>
          <tr>
            <td width="20%"><b>Nama</b></td>
            <td width="1%">:</td>
            <td><?php echo $getKaryawan['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Dari</b></td>
            <td width="1%">:</td>
            <td><?php echo date('d-m-Y', strtotime($getTugasKantor['dari'])); ?></td>
          </tr>
          <tr>
            <td><b>Sampai</b></td>
            <td width="1%">:</td>
            <td><?php echo date('d-m-Y', strtotime($getTugasKantor['sampai'])); ?></td>
          </tr>
          <tr>
            <td><b>Keterangan</b></td>
            <td width="1%">:</td>
            <td><?php echo $getTugasKantor['keterangan']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Tugas Kantor Ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="dari" value="<?php echo $getTugasKantor['dari']; ?>">
        <input type="hidden" name="sampai" value="<?php echo $getTugasKantor['sampai']; ?>">
        <input type="hidden" name="keterangan" value="<?php echo $getTugasKantor['keterangan']; ?>">
        <input type="hidden" name="created_at" value="<?php echo $getTugasKantor['created_at']; ?>">
        <input type="submit" class="btn btn-danger" name="delete_tugas_kantor" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->