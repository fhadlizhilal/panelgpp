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
        <div class="form-group">
          <label>Tanggal</label>
          <input type="date" class="form-control" name="tanggal" value="<?php echo $getHariLibur['tanggal']; ?>" required>
        </div>
        <div class="form-group">
          <label>Keterangan Libur</label>
          <textarea class="form-control" name="keterangan" required><?php echo $getHariLibur['keterangan']; ?></textarea>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $getHariLibur['id']; ?>">
        <input type="hidden" name="tanggal_old" value="<?php echo $getHariLibur['tanggal']; ?>">
        <input type="hidden" name="keterangan_old" value="<?php echo $getHariLibur['keterangan']; ?>">
        <input type="hidden" name="created_at_old" value="<?php echo $getHariLibur['created_at']; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_hari_libur" value="Ubah Hari">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->