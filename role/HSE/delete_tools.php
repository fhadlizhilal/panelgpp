<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_tools WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="25%"><b>Tools</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_tools['tools']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Tools ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_hsetools" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->