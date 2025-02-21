<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_realisasi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_realisasi WHERE id = '$id'"));
    $get_db_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_detail WHERE detail_code = '$get_realisasi[detail_code]'"));
    $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_detail[general_code_id]'"));
    $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_db_detail[merek_id]'"));
  }
?>

    <div class="card-body">
      <table class="table table-sm" style="font-size: 11px">
        <tr>
          <td width="25%">Nama Barang</td>
          <td width="1%">:</td>
          <td><?php echo $get_db_general['nama_barang']; ?></td>
        </tr>
        <tr>
          <td>Tipe Barang</td>
          <td>:</td>
          <td><?php echo $get_db_general['tipe_barang']; ?></td>
        </tr>
        <tr>
          <td>Tipe Detail</td>
          <td>:</td>
          <td><?php echo $get_db_detail['tipe_detail']; ?></td>
        </tr>
        <tr>
          <td>Merek</td>
          <td>:</td>
          <td><?php echo $get_merek['merek']; ?></td>
        </tr>
        <tr>
          <td>Qty Realisasi</td>
          <td>:</td>
          <td><?php echo $get_realisasi['qty']; ?></td>
        </tr>
        <tr>
          <td>Harga Satuan</td>
          <td>:</td>
          <td><?php echo "Rp ".number_format($get_realisasi['harga_satuan'],0,',','.'); ?></td>
        </tr>
        <tr>
          <td>Total Realisasi</td>
          <td>:</td>
          <td><?php echo "Rp ".number_format(($get_realisasi['qty']*$get_realisasi['harga_satuan']),0,',','.'); ?></td>
        </tr>
        <tr>
          <td colspan="3">
        </tr>
      </table>
    </div>
    <div class="card-footer">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger float-right" name="delete_barang_realisasi" value="Delete" onclick="return confirm('Yakin delete barang asset ini?');">
    </div>