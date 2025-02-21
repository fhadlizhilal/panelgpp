<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="20%"><b>Nik</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_manpower['nik']; ?></td>
          </tr>
          <tr>
            <td><b>Nama</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_manpower['nama']; ?></td>
          </tr>
          <tr>
            <td><b>No HP</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_manpower['no_telpon']; ?></td>
          </tr>
          <tr>
            <td><b>Alamat</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_manpower['alamat']; ?></td>
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
        <b>Yakin Delete Manpower ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_manpower" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->