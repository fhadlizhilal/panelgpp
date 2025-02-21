<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_realisasi_perbaikan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_perbaikan_realisasi WHERE id = '$id'"));
    $get_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE asset_db_detail.detail_code = '$get_realisasi_perbaikan[detail_code]'"));
  }
?>

    <div class="card-body">
      <table class="table table-sm" style="font-size: 11px">
        <tr>
          <td width="25%">Nama Barang</td>
          <td width="1%">:</td>
          <td><?php echo $get_asset['nama_barang']; ?></td>
        </tr>
        <tr>
          <td>Tipe Barang</td>
          <td>:</td>
          <td><?php echo $get_asset['tipe_barang']; ?></td>
        </tr>
        <tr>
          <td>Tipe Detail</td>
          <td>:</td>
          <td><?php echo $get_asset['tipe_detail']; ?></td>
        </tr>
        <tr>
          <td>Merek</td>
          <td>:</td>
          <td><?php echo $get_asset['merek']; ?></td>
        </tr>
        <tr>
          <td>Qty Realisasi</td>
          <td>:</td>
          <td><?php echo $get_realisasi_perbaikan['qty']; ?></td>
        </tr>
        <tr>
          <td>Harga Satuan</td>
          <td>:</td>
          <td><?php echo "Rp ".number_format($get_realisasi_perbaikan['harga_satuan'],0,',','.'); ?></td>
        </tr>
        <tr>
          <td>Total Realisasi</td>
          <td>:</td>
          <td><?php echo "Rp ".number_format(($get_realisasi_perbaikan['qty']*$get_realisasi_perbaikan['harga_satuan']),0,',','.'); ?></td>
        </tr>
        <tr>
          <td colspan="3">
        </tr>
      </table>
    </div>
    <div class="card-footer">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger float-right" name="delete_barang_realisasi_perbaikan" value="Delete" onclick="return confirm('Yakin delete barang ini?');">
    </div>