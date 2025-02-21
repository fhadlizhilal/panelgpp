<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_apdMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM apd_masuk WHERE id = '$id'"));
    $get_apd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM apd_database WHERE id_apd = '$get_apdMasuk[id_apd]'"));
    $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_apd[merek]'"));

  }

  function rupiah($angka){
  
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
 
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=in-apd">
      <div class="card-body">
        <table class="table" style="font-size: 12px;">
          <tr>
            <td width="25%"><b>ID APD</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_apdMasuk['id_apd']; ?></td>
          </tr>
          <tr>
            <td><b>Nama APD</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_apd['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Tipe</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_apd['tipe']; ?></td> 
          </tr>
          <tr>
            <td><b>Merek</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_merek['merek']; ?></td>
          </tr>
          <tr>
            <td><b>Jenis</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_apd['jenis']; ?></td> 
          </tr>
          <tr>
            <td><b>Harga Satuan</b></td>
            <td width="1%">:</td>
            <td><?php echo rupiah($get_apdMasuk['harga_satuan']); ?></td>
          </tr>
          <tr>
            <td><b>Jumlah</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_apdMasuk['jumlah']; ?></td>
          </tr>
          <tr>
            <td><b>Tgl Masuk</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_apdMasuk['tgl_masuk']; ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete APD Masuk Ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_apdMasuk" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->