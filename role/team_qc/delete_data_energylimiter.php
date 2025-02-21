<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_dataEnergyLimiter = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportenergylimiter_detail WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table table-sm" style="font-size: 12px;">
          <tr>
            <td width="30%"><b>Barcode</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataEnergyLimiter['barcode']; ?></td>
          </tr>
          <tr>
            <td><b>Power Limit</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataEnergyLimiter['power_limit']." Watt"; ?></td>
          </tr>
          <tr>
            <td><b>Time Reset</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataEnergyLimiter['time_reset']." ".$get_dataEnergyLimiter['time_region']; ?></td>
          </tr>
          <tr>
            <td><b>Time Reset</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataEnergyLimiter['credit_setting']." Wh"; ?></td>
          </tr>
          <tr>
            <td><b>Foto</b></td>
            <td width="1%">:</td>
            <td><img src="dokumentasi_report/<?php echo $get_dataEnergyLimiter['foto']; ?>" width="50%"></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Data Energy Limiter ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_data_energylimiter" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->