<?php
  session_start();
  require_once "../../dev/config.php";
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=add-peminjaman">
      <div class="card-body">
        <div class="form-group">
          <label>Nama Tools</label>
          <select name="id_tools" class="form-control" required>
            <?php
              $q_getTools = mysqli_query($conn, "SELECT * FROM tools_database ORDER BY nama");
              while($getTools = mysqli_fetch_array($q_getTools)){
                $getMerek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$getTools[merek]'"));
            ?>
              <option value="<?php echo $getTools['id_tools']; ?>"><?php echo "[".$getTools['id_tools']."] - ".$getTools['nama']." - ".$getTools['jenis']." [".$getMerek['merek']."][".$getTools['satuan']."]"; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" class="form-control" name="jumlah" required>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-info float-right" name="add_toolspinjam" value="Add Tools">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->