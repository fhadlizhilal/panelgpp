<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $kd_project = $_POST['getID'];
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$kd_project'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PROJECT</div>
    <div class="row">
      <div class="col-10">
        <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
          <tr>
            <td width="30%"><b>Kode Project</b></td>
            <td width="1%">:</td>
            <td><?php echo $kd_project; ?></td>
          </tr>
          <tr>
            <td><b>Nama Project</b></td>
            <td>:</td>
            <td><?php echo $get_project['nm_project']; ?></td>
          </tr>
          <tr>
            <td><b>Lokasi / Kota</b></td>
            <td>:</td>
            <td><?php echo $get_project['lokasi_project']; ?></td>
          </tr>
          <tr>
            <td><b>Tanggal Update</b></td>
            <td>:</td>
            <td><?php echo date('d-m-Y'); ?></td>
          </tr>
        </table>
      </div>

      <div class="col-2">
        <center>
          <a href="../unrole/management_asset/cetak_totalrealisasi.php?kd=<?php echo $kd_project; ?>" target="_blank">
            <div class="btn btn-secondary btn-lg" style="font-family: sans-serif; width: 100%; font-size: 16px;">
              <span class="fa fa-print"> Print</span>
            </div>
          </a>
        </center>
      </div>
    </div>

    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL REALISASI APD</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th>Total Qty</th>
          <th>Satuan</th>
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $grand_total_apd = 0;
          $q_total_pengajuan = mysqli_query($conn, "SELECT t4.nama_barang, t4.tipe_barang, t3.tipe_detail, t5.merek, SUM(t2.qty) AS total_qty, t4.satuan, t2.harga_satuan FROM asset_realisasi t2 JOIN asset_pengajuan t1 ON t2.pengajuan_id = t1.id JOIN asset_db_detail t3 ON t2.detail_code = t3.detail_code JOIN asset_db_general t4 ON t3.general_code_id = t4.id JOIN asset_db_merek t5 ON t3.merek_id = t5.id WHERE t1.kd_project = '$kd_project' AND t4.jenis = 'APD' GROUP BY t2.detail_code ORDER BY t4.nama_barang ASC");
          while($get_total_pengajuan = mysqli_fetch_array($q_total_pengajuan)){
            $total_harga = $get_total_pengajuan['total_qty'] * $get_total_pengajuan['harga_satuan'];
            $grand_total_apd = $grand_total_apd + $total_harga;
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_total_pengajuan['nama_barang']; ?></td>
              <td><?php echo $get_total_pengajuan['tipe_barang']; ?></td>
              <td><?php echo $get_total_pengajuan['tipe_detail']; ?></td>
              <td><?php echo $get_total_pengajuan['merek']; ?></td>
              <td><?php echo $get_total_pengajuan['total_qty']; ?></td>
              <td><?php echo $get_total_pengajuan['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($get_total_pengajuan['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($total_harga, 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="8" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_total_apd, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>


    <br>
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL REALISASI TOOLS</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th>Total Qty</th>
          <th>Satuan</th>
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $grand_total_tools = 0;
          $q_total_pengajuan = mysqli_query($conn, "SELECT t4.nama_barang, t4.tipe_barang, t3.tipe_detail, t5.merek, SUM(t2.qty) AS total_qty, t4.satuan, t2.harga_satuan FROM asset_realisasi t2 JOIN asset_pengajuan t1 ON t2.pengajuan_id = t1.id JOIN asset_db_detail t3 ON t2.detail_code = t3.detail_code JOIN asset_db_general t4 ON t3.general_code_id = t4.id JOIN asset_db_merek t5 ON t3.merek_id = t5.id WHERE t1.kd_project = '$kd_project' AND t4.jenis = 'Tools' GROUP BY t2.detail_code ORDER BY t4.nama_barang ASC");
          while($get_total_pengajuan = mysqli_fetch_array($q_total_pengajuan)){
            $total_harga = $get_total_pengajuan['total_qty'] * $get_total_pengajuan['harga_satuan'];
            $grand_total_tools = $grand_total_tools + $total_harga;
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_total_pengajuan['nama_barang']; ?></td>
              <td><?php echo $get_total_pengajuan['tipe_barang']; ?></td>
              <td><?php echo $get_total_pengajuan['tipe_detail']; ?></td>
              <td><?php echo $get_total_pengajuan['merek']; ?></td>
              <td><?php echo $get_total_pengajuan['total_qty']; ?></td>
              <td><?php echo $get_total_pengajuan['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($get_total_pengajuan['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($total_harga, 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="8" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_total_tools, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>


    <br>
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL REALISASI INVENTARIS</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th>Total Qty</th>
          <th>Satuan</th>
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $grand_total_inv = 0;
          $q_total_pengajuan = mysqli_query($conn, "SELECT t4.nama_barang, t4.tipe_barang, t3.tipe_detail, t5.merek, SUM(t2.qty) AS total_qty, t4.satuan, t2.harga_satuan FROM asset_realisasi t2 JOIN asset_pengajuan t1 ON t2.pengajuan_id = t1.id JOIN asset_db_detail t3 ON t2.detail_code = t3.detail_code JOIN asset_db_general t4 ON t3.general_code_id = t4.id JOIN asset_db_merek t5 ON t3.merek_id = t5.id WHERE t1.kd_project = '$kd_project' AND t4.jenis = 'Inventaris' GROUP BY t2.detail_code ORDER BY t4.nama_barang ASC");
          while($get_total_pengajuan = mysqli_fetch_array($q_total_pengajuan)){
            $total_harga = $get_total_pengajuan['total_qty'] * $get_total_pengajuan['harga_satuan'];
            $grand_total_inv = $grand_total_inv + $total_harga;
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_total_pengajuan['nama_barang']; ?></td>
              <td><?php echo $get_total_pengajuan['tipe_barang']; ?></td>
              <td><?php echo $get_total_pengajuan['tipe_detail']; ?></td>
              <td><?php echo $get_total_pengajuan['merek']; ?></td>
              <td><?php echo $get_total_pengajuan['total_qty']; ?></td>
              <td><?php echo $get_total_pengajuan['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($get_total_pengajuan['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($total_harga, 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="8" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_total_inv, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>

    <hr>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>TOTAL PENGAJUAN APD</th>
          <th>TOTAL PENGAJUAN TOOLS</th>
          <th>TOTAL PENGAJUAN INVENTARIS</th>
          <th>TOTAL PENGAJUAN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><b><?php echo "Rp. " . number_format($grand_total_apd, 0, ',', '.'); ?></b></td>
          <td><b><?php echo "Rp. " . number_format($grand_total_tools, 0, ',', '.'); ?></b></td>
          <td><b><?php echo "Rp. " . number_format($grand_total_inv, 0, ',', '.'); ?></b></td>
          <td style="background-color: yellow;"><b><?php echo "Rp. " . number_format($grand_total_apd + $grand_total_tools + $grand_total_inv, 0, ',', '.'); ?></b></td>
        </tr>
      </tbody>
    </table>

  </div>