<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_db WHERE id_tools = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-tools">
      <div class="card-body">
        <div class="form-group">
          <label>ID Tools</label>
          <input type="text" class="form-control" name="id_tools" value="<?php echo $get_tools['id_tools']; ?>" required>
        </div>
        <div class="form-group">
          <label>Nama Tools</label>
          <input type="text" class="form-control" name="nama" value="<?php echo $get_tools['nama_tools']; ?>" required>
        </div>
        <div class="form-group">
          <label>Jenis</label>
          <input type="text" class="form-control" name="jenis" value="<?php echo $get_tools['jenis_tools']; ?>" required>
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <select class="form-control" name="satuan" required>
            <option value="" selected disabled>-- Pilih Satuan --</option>
            <option value="Pcs" <?php if($get_tools['satuan'] == "Pcs"){ echo "selected"; } ?>>Pcs</option>
            <option value="Unit" <?php if($get_tools['satuan'] == "Unit"){ echo "selected"; } ?>>Unit</option>
            <option value="Set" <?php if($get_tools['satuan'] == "Set"){ echo "selected"; } ?>>Set</option>
            <option value="Lot" <?php if($get_tools['satuan'] == "Lot"){ echo "selected"; } ?>>Lot</option>
          </select>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $get_tools['id']; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_tools" value="Ubah Tools">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->