<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_foto_inspeksi_apd = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM hse_inspeksilist_fotoapd WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="30%"><b>Foto</b></td>
            <td width="1%">:</td>
            <td><img src="../../role/HSE/foto_inspeksi_apd/<?php echo $get_foto_inspeksi_apd["foto"]; ?>" width="90%"></td>
          </tr>
          <tr>
            <td><b>Keterangan</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_foto_inspeksi_apd["keterangan"]; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Foto Inspeksi ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_foto_inspeksi_apd" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->