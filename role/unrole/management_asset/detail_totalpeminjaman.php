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
            <a href="../unrole/management_asset/cetak_totalpeminjaman.php?kd=<?php echo $kd_project; ?>" target="_blank">
              <div class="btn btn-secondary btn-lg" style="font-family: sans-serif; width: 100%; font-size: 16px;">
                <span class="fa fa-print"> Print</span>
              </div>
            </a>
          </center>
        </div>
      </div>

    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL PEMINJAMAN APD</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Sub Barang</th>
          <th>Total Qty</th>
          <th>Satuan</th>
          <th width="12%" style="text-align: center;">Harga Satuan<br>Max</th>
          <th width="12%" style="text-align: center;">Total Harga<br>Max</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $grand_total_apd = 0;
          $q_total_peminjamanapd = mysqli_query($conn, "SELECT t3.general_code, t3.nama_barang, t3.tipe_barang, t3.sub_barang, SUM(t1.qty) AS total_qty, t3.satuan, t3.jenis FROM asset_peminjaman_detail t1 JOIN asset_peminjaman t2 ON t1.peminjaman_id = t2.id JOIN asset_db_general t3 ON t1.general_code = t3.general_code WHERE t2.kd_project = '$kd_project' AND t3.jenis = 'APD' GROUP BY t1.general_code");
          while($get_total_peminjamanapd = mysqli_fetch_array($q_total_peminjamanapd)){
            $harga_satuan_max = mysqli_fetch_array(mysqli_query($conn, "SELECT t1.id, t3.general_code, t1.detail_code, t1.harga_satuan FROM asset_realisasi t1 JOIN asset_db_detail t2 ON t1.detail_code = t2.detail_code JOIN asset_db_general t3 ON t2.general_code_id = t3.id WHERE t3.general_code = '$get_total_peminjamanapd[general_code]' ORDER BY t1.id DESC"));

            $total_harga = $harga_satuan_max['harga_satuan'] * $get_total_peminjamanapd['total_qty'];
            $grand_total_apd = $grand_total_apd + $total_harga;
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_total_peminjamanapd['nama_barang']; ?></td>
              <td><?php echo $get_total_peminjamanapd['tipe_barang']; ?></td>
              <td><?php echo $get_total_peminjamanapd['sub_barang']; ?></td>
              <td><?php echo $get_total_peminjamanapd['total_qty']; ?></td>
              <td><?php echo $get_total_peminjamanapd['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($harga_satuan_max['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($total_harga, 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="7" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_total_apd, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>


    <br>
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL PEMINJAMAN TOOLS</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Sub Barang</th>
          <th>Total Qty</th>
          <th>Satuan</th>
          <th width="12%" style="text-align: center;">Harga Satuan<br>Max</th>
          <th width="12%" style="text-align: center;">Total Harga<br>Max</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $grand_total_tools = 0;
          $q_total_peminjamantools = mysqli_query($conn, "SELECT t3.general_code, t3.nama_barang, t3.tipe_barang, t3.sub_barang, SUM(t1.qty) AS total_qty, t3.satuan, t3.jenis FROM asset_peminjaman_detail t1 JOIN asset_peminjaman t2 ON t1.peminjaman_id = t2.id JOIN asset_db_general t3 ON t1.general_code = t3.general_code WHERE t2.kd_project = '$kd_project' AND t3.jenis = 'Tools' GROUP BY t1.general_code");
          while($get_total_peminjamanapd = mysqli_fetch_array($q_total_peminjamantools)){
            $harga_satuan_max = mysqli_fetch_array(mysqli_query($conn, "SELECT t1.id, t3.general_code, t1.detail_code, t1.harga_satuan FROM asset_realisasi t1 JOIN asset_db_detail t2 ON t1.detail_code = t2.detail_code JOIN asset_db_general t3 ON t2.general_code_id = t3.id WHERE t3.general_code = '$get_total_peminjamanapd[general_code]' ORDER BY t1.id DESC"));

            $total_harga = $harga_satuan_max['harga_satuan'] * $get_total_peminjamanapd['total_qty'];
            $grand_total_tools = $grand_total_tools + $total_harga;
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_total_peminjamanapd['nama_barang']; ?></td>
              <td><?php echo $get_total_peminjamanapd['tipe_barang']; ?></td>
              <td><?php echo $get_total_peminjamanapd['sub_barang']; ?></td>
              <td><?php echo $get_total_peminjamanapd['total_qty']; ?></td>
              <td><?php echo $get_total_peminjamanapd['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($harga_satuan_max['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_satuan_max['harga_satuan'] * $get_total_peminjamanapd['total_qty'], 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="7" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_total_tools, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>



    <br>
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL PEMINJAMAN INVENTARIS</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Sub Barang</th>
          <th>Total Qty</th>
          <th>Satuan</th>
          <th width="12%" style="text-align: center;">Harga Satuan<br>Max</th>
          <th width="12%" style="text-align: center;">Total Harga<br>Max</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $grand_total_inv = 0;
          $q_total_peminjamaninv = mysqli_query($conn, "SELECT t3.general_code, t3.nama_barang, t3.tipe_barang, t3.sub_barang, SUM(t1.qty) AS total_qty, t3.satuan, t3.jenis FROM asset_peminjaman_detail t1 JOIN asset_peminjaman t2 ON t1.peminjaman_id = t2.id JOIN asset_db_general t3 ON t1.general_code = t3.general_code WHERE t2.kd_project = '$kd_project' AND t3.jenis = 'Inventaris' GROUP BY t1.general_code");
          while($get_total_peminjamanapd = mysqli_fetch_array($q_total_peminjamaninv)){
            $harga_satuan_max = mysqli_fetch_array(mysqli_query($conn, "SELECT t1.id, t3.general_code, t1.detail_code, t1.harga_satuan FROM asset_realisasi t1 JOIN asset_db_detail t2 ON t1.detail_code = t2.detail_code JOIN asset_db_general t3 ON t2.general_code_id = t3.id WHERE t3.general_code = '$get_total_peminjamanapd[general_code]' ORDER BY t1.id DESC"));

            $total_harga = $harga_satuan_max['harga_satuan'] * $get_total_peminjamanapd['total_qty'];
            $grand_total_inv = $grand_total_inv + $total_harga;
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_total_peminjamanapd['nama_barang']; ?></td>
              <td><?php echo $get_total_peminjamanapd['tipe_barang']; ?></td>
              <td><?php echo $get_total_peminjamanapd['sub_barang']; ?></td>
              <td><?php echo $get_total_peminjamanapd['total_qty']; ?></td>
              <td><?php echo $get_total_peminjamanapd['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($harga_satuan_max['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_satuan_max['harga_satuan'] * $get_total_peminjamanapd['total_qty'], 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="7" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
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