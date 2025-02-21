<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getHariLibur = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM harilibur WHERE id = '$id'"));
    $getHariLibur['keterangan'] = substr($getHariLibur['keterangan'], 3);
    $getHariLibur['keterangan'] = substr($getHariLibur['keterangan'],0,-4);
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=SHL">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="20%"><b>Tanggal</b></td>
            <td width="1%">:</td>
            <td><?php echo $getHariLibur['tanggal']; ?></td>
          </tr>
          <tr>
            <td><b>Keterangan</b></td>
            <td width="1%">:</td>
            <td><?php echo $getHariLibur['keterangan']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Hari Libur Ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="tanggal" value="<?php echo $getHariLibur['tanggal']; ?>">
        <input type="hidden" name="keterangan" value="<?php echo $getHariLibur['keterangan']; ?>">
        <input type="hidden" name="created_at" value="<?php echo $getHariLibur['created_at']; ?>">
        <input type="submit" class="btn btn-danger" name="delete_hari_libur" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->