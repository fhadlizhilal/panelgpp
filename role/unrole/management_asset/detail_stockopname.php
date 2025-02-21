<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_stockopname = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_stockopname WHERE id = '$id'"));
    $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_stockopname[entitas_id]'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">DETAIL STOCK OPNAME</div>
    <div class="row">
      <div class="col-lg-2 col-0"></div>
      <div class="col-lg-8 col12">
        <table class="table table-sm" style="font-size: 12px">
          <tr>
            <td width="30%"><b>No Stock Opname</b></td>
            <td width="1%">:</td>
            <td><?php echo "SO".$get_entitas['id']."/MA/".date("m/Y", strtotime($get_stockopname['tanggal'])); ?></td>
          </tr>
          <tr>
            <td width="30%"><b>Entitas</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_entitas['entitas']; ?></td>
          </tr>
          <tr>
            <td width="30%"><b>Tanggal Stock Opname</b></td>
            <td width="1%">:</td>
            <td><?php echo date("d F Y", strtotime($get_stockopname['tanggal'])); ?></td>
          </tr>
          <tr>
            <td><b>Keterangan</b></td>
            <td>:</td>
            <td><?php echo $get_stockopname['keterangan']; ?></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <table class="table table-sm table-striped" style="font-size: 11px">
          <thead>
            <tr>
              <th width="1%">No</th>
              <th width="">Nama Barang</th>
              <th>Tipe Barang</th>
              <th>Tipe Detail</th>
              <th>Merek</th>
              <th>Sub Barang</th>
              <th width="6%">Jenis</th>
              <th width="1%" style="text-align: center;">Satuan</th>
              <th width="1%" style="text-align: center;">Real Stock</th>
              <th width="15%">Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 1;
              $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id ORDER BY nama_barang ASC, tipe_barang ASC");
              while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_detail[merek_id]'"));

                $get_stockopname_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_stockopname_detail WHERE stockopname_id = '$id' AND detail_code = '$get_db_detail[detail_code]'"));
            ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $get_db_detail['nama_barang']; ?></td>
                <td><?php echo $get_db_detail['tipe_barang']; ?></td>
                <td><?php echo $get_db_detail['tipe_detail']; ?></td>
                <td><?php echo $get_merek['merek']; ?></td>
                <td><?php echo $get_db_detail['sub_barang']; ?></td>
                <td><?php echo $get_db_detail['jenis']; ?></td>
                <td align="center"><?php echo $get_db_detail['satuan']; ?></td>
                <td align="center"><?php echo $get_stockopname_detail['real_stock']; ?></td>
                <td><?php echo $get_stockopname_detail['remarks']; ?></td>
              </tr>
            <?php $no++; } ?>
          </tbody>
        </table>

        <div style="text-align: center;">
          <a href="../unrole/management_asset/cetak_stockopname.php?id=<?php echo $id; ?>" target="_blank"><div class="btn btn-secondary"><span class="fa fa-print"></span> Cetak</div></a>
        </div>
      </div>
    </div>

  </div>
  <!-- <div class="card-footer" style="text-align: center;">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <a href="index.php?pages=formeditrealisasi&id=<?php echo $id; ?>"><div class="btn btn-secondary"><span class="fa fa-edit"></span> Edit Realisasi</div></a>
    <a href="../unrole/management_asset/cetak_realisasi_detail.php?id=<?php echo $id; ?>" target="_blank"><div class="btn btn-info"><span class="fa fa-download"></span> Cetak / Download</div></a>
  </div> -->
  