<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_tools_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM v_tools_detail WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-tools-detail">
      <div class="card-body">
        <table class="table table-sm table-striped" style="font-size: 12px;">
          <tr>
            <td width="25%"><b>ID Detail</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools_detail['detail_id']; ?></td>
          </tr>
          <tr>
            <td><b>ID Tools</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools_detail['tools_id']; ?></td>
          </tr>
          <tr>
            <td><b>Nama Tools</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools_detail['nama_tools']; ?></td>
          </tr>
          <tr>
            <td><b>Jenis</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools_detail['jenis_tools']; ?></td>
          </tr>
          <tr>
            <td><b>Satuan</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools_detail['satuan']; ?></td>
          </tr>
          <tr>
            <td><b>Sub</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools_detail['sub_tools']; ?></td>
          </tr>
          <tr>
            <td><b>Tipe</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools_detail['tipe_detail']; ?></td>
          </tr>
          <tr>
            <td><b>Merek</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools_detail['merek']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Tools Ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_tools_detail" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->