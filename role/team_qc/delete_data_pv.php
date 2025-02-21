<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_dataPV = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportpv_detail WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table table-sm" style="font-size: 12px;">
          <tr>
            <td width="30%"><b>No Serial</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataPV['no_seri']; ?></td>
          </tr>
          <tr>
            <td><b>Tegangan</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataPV['tegangan']; ?></td>
          </tr>
          <tr>
            <td><b>Kondisi Fisik</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataPV['kondisi_fisik']; ?></td>
          </tr>
          <tr>
            <td><b>Jarak Lubang Frame</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataPV['jarak_lubang_frame']; ?></td>
          </tr>
          <tr>
            <td><b>Foto</b></td>
            <td width="1%">:</td>
            <td><img src="dokumentasi_report/<?php echo $get_dataPV['foto']; ?>" width="60%"></td>
          </tr>
          <tr>
            <td><b>Random Check</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_dataPV['random_check']; ?></td>
          </tr>
          <tr>
            <td><b>Foto</b></td>
            <td width="1%">:</td>
            <td>
              <?php if($get_dataPV['foto_random_check'] != ""){ ?>
                <img src="dokumentasi_report/<?php echo $get_dataPV['foto_random_check']; ?>" width="60%">
              <?php } ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Data PV ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_data_pv" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->