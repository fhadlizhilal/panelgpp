<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_dataLampuac = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuac_detail WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table table-sm" style="font-size: 12px;">
          <tr>
            <td width="30%"><b>Kondisi Lampu</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataLampuac['kondisi']; ?></td>
          </tr>
          <tr>
            <td><b>Stiker QC</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataLampuac['stiker_qc']; ?></td>
          </tr>
          <tr>
            <td><b>Foto</b></td>
            <td width="1%">:</td>
            <td><img src="dokumentasi_report/<?php echo $get_dataLampuac['foto']; ?>" width="50%"></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Data Lampu AC ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_data_lampuac" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->