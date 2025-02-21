<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_toolsTmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_tmp WHERE id = '$id'"));
    $get_tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_database WHERE id_tools = '$get_toolsTmp[id_tools]'"));
    $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_tools[merek]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=add-peminjaman">
      <div class="card-body">
       <table class="table table-sm" style="font-size: 14px;">
          <tr>
            <td width="30%">ID Tools</td>
            <td width="1%">:</td>
            <td><?php echo $get_toolsTmp['id_tools']; ?></td>
          </tr>
          <tr>
            <td>Nama Tools</td>
            <td>:</td>
            <td><?php echo $get_tools['nama']; ?></td>
          </tr>
          <tr>
            <td>Jenis</td>
            <td>:</td>
            <td><?php echo $get_tools['jenis']; ?></td>
          </tr>
          <tr>
            <td>Merek</td>
            <td>:</td>
            <td><?php echo $get_merek['merek']; ?></td>
          </tr>
          <tr>
            <td>Jumlah Pinjam</td>
            <td>:</td>
            <td><?php echo $get_toolsTmp['jumlah']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger float-right" name="delete_toolspinjam" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->