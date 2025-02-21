<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getPelanggaran = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pelanggaran WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getPelanggaran[nik]'"));
    $pelanggaran_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE id = $getPelanggaran[pelanggaran_id]"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=dbpelanggaran">
      <div class="card-body">
        <table width="100%" class="table table-striped table-sm" style="font-size: 11px;">
          <tr>
            <td width="20%"><b>NIK</b></td>
            <td width="1%">:</td>
            <td><?php echo $getPelanggaran['nik']; ?></td>
          </tr>
          <tr>
            <td><b>Nama</b></td>
            <td>:</td>
            <td><?php echo $getKaryawan['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Tgl Pelanggaran</b></td>
            <td>:</td>
            <td><?php echo $getPelanggaran['tanggal']; ?></td>
          </tr>
          <tr>
            <td><b>Pelanggaran</b></td>
            <td>:</td>
            <td><?php echo $pelanggaran_list['nama_pelanggaran']; ?></td>
          </tr>
          <tr>
            <td><b>Keterangan Tambahan</b></td>
            <td>:</td>
            <td><?php echo $getPelanggaran['keterangan']; ?></td>
          </tr>
        </table>
        <br>
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <center><input type="submit" class="btn btn-danger" name="delete_pelanggaran" value="Delete"></center>
        </div>
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->