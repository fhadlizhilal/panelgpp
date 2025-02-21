<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_hseUser = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_user WHERE id = '$id'"));
    $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_hseUser[manpower_id]'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="20%"><b>Nama</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_manpower['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Email</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_manpower['alamat']; ?></td>
          </tr>
          <tr>
            <td><b>No HP</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_manpower['no_telpon']; ?></td>
          </tr>
          <tr>
            <td><b>Foto</b></td>
            <td width="1%">:</td>
            <td>
              <?php if($get_manpower['foto'] == ""){ ?>
                <img src="../../dist/img/karyawan/vector_user.png" width="25%">
              <?php }else{ ?>
                <img src="foto_manpower/<?php echo $get_manpower['foto']; ?>" width="25%">
              <?php } ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete User HSE Ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_userhse" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->