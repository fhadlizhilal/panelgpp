<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-merek">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="20%"><b>ID</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_merek['id']; ?></td>
          </tr>
          <tr>
            <td><b>Merek</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_merek['merek']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Merek Ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_merek" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->