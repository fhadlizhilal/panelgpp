<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_toolsMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_masuk_detail WHERE id = '$id'"));
    $get_toolsDetail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM v_tools_detail WHERE detail_id = '$get_toolsMasuk[id_detail]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=edit-toolsmasuk&id=<?php echo $_POST['getID2']; ?>">
      <div class="card-body">
        <table class="table table-sm table-striped" style="font-size: 12px;"> 
          <tr>
            <td width="25%"><b>ID Detail</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_toolsMasuk['id_detail']; ?></td>
          </tr>
          <tr>
            <td><b>Nama Tools</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_toolsDetail['nama_tools']; ?></td>
          </tr>
          <tr>
            <td><b>Jenis</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_toolsDetail['jenis_tools']; ?></td>
          </tr>
          <tr>
            <td><b>Merek</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_toolsDetail['merek']; ?></td>
          </tr>
          <tr>
            <td><b>Qty</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_toolsMasuk['qty']." ".$get_toolsDetail['satuan']; ?></td>
          </tr>
          <tr>
            <td><b>Harga Satuan</b></td>
            <td width="1%">:</td>
            <td><?php echo "Rp ".number_format($get_toolsMasuk['harga_satuan'],0); ?></td>
          </tr>
          <tr>
            <td><b>Total Harga</b></td>
            <td width="1%">:</td>
            <td><?php echo "Rp ".number_format($get_toolsMasuk['qty']*$get_toolsMasuk['harga_satuan'],0); ?></td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <b>Yakin Delete Tools Ini ?</b><br><br>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-danger" name="delete_toolsmasuk_detail" value="Delete">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->