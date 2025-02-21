<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_pengajuan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE id = '$id'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th width="7%">Qty</th>
          <th width="1%">Satuan</th>
          <th width="12%">Harga Satuan</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_db_general.jenis = '$get_pengajuan[jenis]' AND detail_code NOT IN (SELECT detail_code FROM asset_realisasi WHERE pengajuan_id = '$id') ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
          while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
            $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_detail[general_code_id]'"));
            $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_detail[merek_id]'"));
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_db_general['nama_barang']; ?></td>
              <td><?php echo $get_db_general['tipe_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_detail']; ?></td>
              <td><?php echo $get_merek['merek']; ?></td>
              <td><input type="text" style="width: 100%" name="qty_<?php echo $get_db_detail['detail_code']; ?>" oninput="formatNumber(this)"></td>
              <td><?php echo $get_db_general['satuan']; ?></td>
              <td><input type="text" style="width: 100%" name="harga_satuan_<?php echo $get_db_detail['detail_code']; ?>" oninput="formatNumber(this)"></td>
            </tr>
        <?php $no++; } ?>
      </tbody>
    </table>
  </div>
  <div class="card-footer" style="text-align: center;">
    <input type="hidden" name="pengajuan_id" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-success btn-sm" name="add_barang_realisasi" value="add_barang_realisasi"><span class="fa fa-plus"></span> Tambah Barang</button>
  </div>

<script>
  // Fungsi untuk memformat angka dengan pemisah ribuan
  function formatNumber(input) {
      var value = input.value.replace(/\D/g, '');
      var formattedValue = new Intl.NumberFormat('id-ID').format(value);
      input.value = formattedValue;
  }
</script>