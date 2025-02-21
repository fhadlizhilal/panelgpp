<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM v_tools_detail WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-tools-detail">
      <div class="card-body">
        <table class="table table-sm table-striped" style="font-size: 12px;">
          <tr>
            <td width="20%">ID Tools</td>
            <td width="1%">:</td>
            <td><?php echo $get_tools['tools_id']; ?></td>
          </tr>
          <tr>
            <td>Nama Tools</td>
            <td>:</td>
            <td><?php echo $get_tools['nama_tools']; ?></td>
          </tr>
          <tr>
            <td>Jenis</td>
            <td>:</td>
            <td><?php echo $get_tools['jenis_tools']; ?></td>
          </tr>
          <tr>
            <td>Satuan</td>
            <td>:</td>
            <td><?php echo $get_tools['satuan']; ?></td>
          </tr>
        </table>
        <br>
        <div class="form-group">
          <label>ID Detail</label>
          <input type="text" class="form-control" name="detail_id" value="<?php echo $get_tools['detail_id']; ?>" required>
        </div>
        <div class="form-group">
          <label>Sub</label>
          <select class="form-control" name="sub" required>
            <option value="" selected disabled>-- Pilih Sub --</option>
            <option value="Continue" <?php if($get_tools['sub_tools'] == "Continue"){ echo "selected"; } ?>>Continue</option>
            <option value="Habis Pakai" <?php if($get_tools['sub_tools'] == "Habis Pakai"){ echo "selected"; } ?>>Habis Pakai</option>
          </select>
        </div>
        <div class="form-group">
          <label>Tipe</label>
          <input type="text" class="form-control" name="tipe" value="<?php echo $get_tools['tipe_detail']; ?>" required>
        </div>
        <div class="form-group">
          <label>Merek</label>
          <select class="form-control" name="merek_id" required>
            <option value="" selected disabled>-- Pilih Merek --</option>
            <?php
              $q_merek = mysqli_query($conn, "SELECT * FROM merek");
              while($get_merek = mysqli_fetch_array($q_merek)){
            ?>
              <option value="<?php echo $get_merek['id']; ?>" <?php if($get_tools['merek_id'] == $get_merek['id']){ echo "selected"; } ?>><?php echo $get_merek['merek']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $get_tools['id']; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_tools_detail" value="Ubah Tools">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->