<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_dataListReport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlist WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table table-sm" style="font-size: 12px;">
          <tr>
            <td width="30%"><b>Nama Pekerjaan</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataListReport['nm_pekerjaan']; ?></td>
          </tr>
          <tr>
            <td><b>Tanggal</b></td>
            <td width="1%">:</td>
            <td><?php echo date("d-m-Y", strtotime($get_dataListReport['tgl'])); ?></td>
          </tr>         
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Data List Report ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_list_report" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->