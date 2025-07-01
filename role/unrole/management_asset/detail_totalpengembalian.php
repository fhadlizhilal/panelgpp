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
          <a href="../unrole/management_asset/cetak_totalsuratjalan.php?kd=<?php echo $kd_project; ?>" target="_blank">
            <div class="btn btn-secondary btn-lg" style="font-family: sans-serif; width: 100%; font-size: 16px;">
              <span class="fa fa-print"> Print</span>
            </div>
          </a>
        </center>
      </div>
    </div>

    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL PENGEMBALIAN APD</div>
    <table class="table table-sm" style="font-size: 10px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th width="1%" style="text-align: center;">Qty Pinjam</th>
          <th width="1%">Satuan</th>
          <th width="" style="text-align: center;">Harga Satuan</th>
          <th width="2%"></th>
          <th width="1%" style="text-align: center;">Baik</th>
          <th width="1%" style="text-align: center;">Rusak</th>
          <th width="1%" style="text-align: center;">Hilang</th>
          <th width="1%" style="text-align: center;">Total Kembali</th>
          <th width="" style="text-align: center;">Nilai Baik</th>
          <th width="" style="text-align: center;">Nilai Rusak</th>
          <th width="" style="text-align: center;">Nilai Hilang</th>
          <th width="" style="text-align: center;">Total Nilai</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;

          $t_baik_apd = 0;
          $t_rusak_apd = 0;
          $t_hilang_apd = 0;

          $n_baik_apd = 0;
          $n_rusak_apd = 0;
          $n_hilang_apd = 0;

          $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE asset_db_general.jenis = 'APD' ORDER BY nama_barang ASC, tipe_barang ASC");
          while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
            $qty_pinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS qty_pinjam FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE asset_peminjaman.kd_project = '$kd_project' AND asset_suratjalan_detail.detail_code = '$get_db_detail[detail_code]'"));

            $qty_pengembalian = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS sum_baik, SUM(habis) AS sum_habis, SUM(rusak_sebagian) AS sum_rusaksebagian, SUM(rusak_total) AS sum_rusaktotal, SUM(hilang) AS sum_hilang FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE kd_project = '$kd_project' AND detail_code = '$get_db_detail[detail_code]'"));

            $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_db_detail[detail_code]' ORDER BY id DESC"));

            if($qty_pinjam['qty_pinjam'] > 0 || $qty_pengembalian['sum_baik']>0 || $qty_pengembalian['sum_habis']>0 || $qty_pengembalian['sum_rusaksebagian']>0 || $qty_pengembalian['sum_rusaktotal']>0 || $qty_pengembalian['sum_hilang']>0){
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_db_detail['nama_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_detail']; ?></td>
              <td><?php echo $get_db_detail['merek']; ?></td>
              <td align="center"><?php echo $qty_pinjam['qty_pinjam']; ?></td>
              <td align="center"><?php echo $get_db_detail['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
              <td></td>
              <td align="center"><?php echo $qty_pengembalian['sum_baik']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_rusaktotal']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_hilang']; ?></td>
              <td align="center"><b><?php echo $total_kembali = $qty_pengembalian['sum_baik']+$qty_pengembalian['sum_rusaktotal']+$qty_pengembalian['sum_hilang'] ?></b></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_baik'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_rusaktotal'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_hilang'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*($qty_pengembalian['sum_baik']+$qty_pengembalian['sum_rusaktotal']+$qty_pengembalian['sum_hilang']), 0, ',', '.'); ?></td>
            </tr>
        <?php
            $t_baik_apd = $t_baik_apd + $qty_pengembalian['sum_baik'];
            $t_rusak_apd = $t_rusak_apd + $qty_pengembalian['sum_rusaktotal'];
            $t_hilang_apd = $t_hilang_apd + $qty_pengembalian['sum_hilang'];

            $n_baik_apd = $n_baik_apd + ($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_baik']);
            $n_rusak_apd = $n_rusak_apd + ($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_rusaktotal']);
            $n_hilang_apd = $n_hilang_apd + ($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_hilang']);
          $no++; }} 
        ?>
            <tr>
              <td colspan="9" style="background-color: yellow; font-weight: bold;" align="center">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_baik_apd; ?></td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_rusak_apd; ?></td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_hilang_apd; ?></td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_baik_apd+$t_rusak_apd+$t_hilang_apd; ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_baik_apd, 0, ',', '.'); ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_rusak_apd, 0, ',', '.'); ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_hilang_apd, 0, ',', '.'); ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_baik_apd+$n_rusak_apd+$n_hilang_apd, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>


    <br>
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL SURAT JALAN TOOLS</div>
    <table class="table table-sm" style="font-size: 10px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th width="1%" style="text-align: center;">Qty Pinjam</th>
          <th width="1%">Satuan</th>
          <th width="" style="text-align: center;">Harga Satuan</th>
          <th width="2%"></th>
          <th width="1%" style="text-align: center;">Baik</th>
          <th width="1%" style="text-align: center;">Rusak</th>
          <th width="1%" style="text-align: center;">Hilang</th>
          <th width="1%" style="text-align: center;">Total Kembali</th>
          <th width="" style="text-align: center;">Nilai Baik</th>
          <th width="" style="text-align: center;">Nilai Rusak</th>
          <th width="" style="text-align: center;">Nilai Hilang</th>
          <th width="" style="text-align: center;">Total Nilai</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;

          $t_baik_tools = 0;
          $t_rusak_tools = 0;
          $t_hilang_tools = 0;

          $n_baik_tools = 0;
          $n_rusak_tools = 0;
          $n_hilang_tools = 0;

          $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE asset_db_general.jenis = 'Tools' ORDER BY nama_barang ASC, tipe_barang ASC");
          while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
            $qty_pinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS qty_pinjam FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE asset_peminjaman.kd_project = '$kd_project' AND asset_suratjalan_detail.detail_code = '$get_db_detail[detail_code]'"));

            $qty_pengembalian = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS sum_baik, SUM(habis) AS sum_habis, SUM(rusak_sebagian) AS sum_rusaksebagian, SUM(rusak_total) AS sum_rusaktotal, SUM(hilang) AS sum_hilang FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE kd_project = '$kd_project' AND detail_code = '$get_db_detail[detail_code]'"));

            $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_db_detail[detail_code]' ORDER BY id DESC"));

            if($qty_pinjam['qty_pinjam'] > 0 || $qty_pengembalian['sum_baik']>0 || $qty_pengembalian['sum_habis']>0 || $qty_pengembalian['sum_rusaksebagian']>0 || $qty_pengembalian['sum_rusaktotal']>0 || $qty_pengembalian['sum_hilang']>0){
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_db_detail['nama_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_detail']; ?></td>
              <td><?php echo $get_db_detail['merek']; ?></td>
              <td align="center"><?php echo $qty_pinjam['qty_pinjam']; ?></td>
              <td align="center"><?php echo $get_db_detail['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
              <td></td>
              <td align="center"><?php echo $qty_pengembalian['sum_baik']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_rusaktotal']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_hilang']; ?></td>
              <td align="center"><b><?php echo $total_kembali = $qty_pengembalian['sum_baik']+$qty_pengembalian['sum_rusaktotal']+$qty_pengembalian['sum_hilang'] ?></b></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_baik'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_rusaktotal'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_hilang'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*($qty_pengembalian['sum_baik']+$qty_pengembalian['sum_rusaktotal']+$qty_pengembalian['sum_hilang']), 0, ',', '.'); ?></td>
            </tr>
        <?php
            $t_baik_tools = $t_baik_tools + $qty_pengembalian['sum_baik'];
            $t_rusak_tools = $t_rusak_tools + $qty_pengembalian['sum_rusaktotal'];
            $t_hilang_tools = $t_hilang_tools + $qty_pengembalian['sum_hilang'];

            $n_baik_tools = $n_baik_tools + ($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_baik']);
            $n_rusak_tools = $n_rusak_tools + ($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_rusaktotal']);
            $n_hilang_tools = $n_hilang_tools + ($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_hilang']);
          $no++; }} 
        ?>
            <tr>
              <td colspan="9" style="background-color: yellow; font-weight: bold;" align="center">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_baik_tools; ?></td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_rusak_tools; ?></td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_hilang_tools; ?></td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_baik_tools+$t_rusak_tools+$t_hilang_tools; ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_baik_tools, 0, ',', '.'); ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_rusak_tools, 0, ',', '.'); ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_hilang_tools, 0, ',', '.'); ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_baik_tools+$n_rusak_tools+$n_hilang_tools, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>



    <br>
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL SURAT JALAN INVENTARIS</div>
    <table class="table table-sm" style="font-size: 10px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th width="1%" style="text-align: center;">Qty Pinjam</th>
          <th width="1%">Satuan</th>
          <th width="" style="text-align: center;">Harga Satuan</th>
          <th width="2%"></th>
          <th width="1%" style="text-align: center;">Baik</th>
          <th width="1%" style="text-align: center;">Rusak</th>
          <th width="1%" style="text-align: center;">Hilang</th>
          <th width="1%" style="text-align: center;">Total Kembali</th>
          <th width="" style="text-align: center;">Nilai Baik</th>
          <th width="" style="text-align: center;">Nilai Rusak</th>
          <th width="" style="text-align: center;">Nilai Hilang</th>
          <th width="" style="text-align: center;">Total Nilai</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;

          $t_baik_inv = 0;
          $t_rusak_inv = 0;
          $t_hilang_inv = 0;

          $n_baik_inv = 0;
          $n_rusak_inv = 0;
          $n_hilang_inv = 0;

          $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE asset_db_general.jenis = 'Inventaris' ORDER BY nama_barang ASC, tipe_barang ASC");
          while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
            $qty_pinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS qty_pinjam FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE asset_peminjaman.kd_project = '$kd_project' AND asset_suratjalan_detail.detail_code = '$get_db_detail[detail_code]'"));

            $qty_pengembalian = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS sum_baik, SUM(habis) AS sum_habis, SUM(rusak_sebagian) AS sum_rusaksebagian, SUM(rusak_total) AS sum_rusaktotal, SUM(hilang) AS sum_hilang FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE kd_project = '$kd_project' AND detail_code = '$get_db_detail[detail_code]'"));

            $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_db_detail[detail_code]' ORDER BY id DESC"));

            if($qty_pinjam['qty_pinjam'] > 0 || $qty_pengembalian['sum_baik']>0 || $qty_pengembalian['sum_habis']>0 || $qty_pengembalian['sum_rusaksebagian']>0 || $qty_pengembalian['sum_rusaktotal']>0 || $qty_pengembalian['sum_hilang']>0){
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_db_detail['nama_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_detail']; ?></td>
              <td><?php echo $get_db_detail['merek']; ?></td>
              <td align="center"><?php echo $qty_pinjam['qty_pinjam']; ?></td>
              <td align="center"><?php echo $get_db_detail['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
              <td></td>
              <td align="center"><?php echo $qty_pengembalian['sum_baik']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_rusaktotal']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_hilang']; ?></td>
              <td align="center"><b><?php echo $total_kembali = $qty_pengembalian['sum_baik']+$qty_pengembalian['sum_rusaktotal']+$qty_pengembalian['sum_hilang'] ?></b></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_baik'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_rusaktotal'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_hilang'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan']*($qty_pengembalian['sum_baik']+$qty_pengembalian['sum_rusaktotal']+$qty_pengembalian['sum_hilang']), 0, ',', '.'); ?></td>
            </tr>
        <?php
            $t_baik_inv = $t_baik_inv + $qty_pengembalian['sum_baik'];
            $t_rusak_inv = $t_rusak_inv + $qty_pengembalian['sum_rusaktotal'];
            $t_hilang_inv = $t_hilang_inv + $qty_pengembalian['sum_hilang'];

            $n_baik_inv = $n_baik_inv + ($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_baik']);
            $n_rusak_inv = $n_rusak_inv + ($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_rusaktotal']);
            $n_hilang_inv = $n_hilang_inv + ($harga_terbaru['harga_satuan']*$qty_pengembalian['sum_hilang']);
          $no++; }} 
        ?>
            <tr>
              <td colspan="9" style="background-color: yellow; font-weight: bold;" align="center">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_baik_inv; ?></td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_rusak_inv; ?></td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_hilang_inv; ?></td>
              <td style="background-color: yellow; font-weight: bold;" align="center"><?php echo $t_baik_inv+$t_rusak_inv+$t_hilang_inv; ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_baik_inv, 0, ',', '.'); ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_rusak_inv, 0, ',', '.'); ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_hilang_inv, 0, ',', '.'); ?></td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($n_baik_inv+$n_rusak_inv+$n_hilang_inv, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>

    <?php
      $grand_total_apd = 0;
      $q_total_suratjalan = mysqli_query($conn, "SELECT a.detail_code, e.nama_barang, e.tipe_barang, d.tipe_detail, f.merek, e.sub_barang, SUM(a.qty) AS total_qty, e.satuan FROM asset_suratjalan_detail a JOIN asset_suratjalan b ON a.suratjalan_id = b.id JOIN asset_peminjaman c ON b.peminjaman_id = c.id JOIN asset_db_detail d ON a.detail_code = d.detail_code JOIN asset_db_general e ON d.general_code_id = e.id JOIN asset_db_merek f ON d.merek_id = f.id WHERE c.jenis = 'apd' AND c.kd_project = '$kd_project' GROUP BY a.detail_code ORDER BY e.nama_barang ASC");

      while($get_total_suratjalan = mysqli_fetch_array($q_total_suratjalan)){
        $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_total_suratjalan[detail_code]' ORDER BY id DESC"));
        $total_harga = $get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'];
        $grand_total_apd = $grand_total_apd + $total_harga;
      }

      $grand_total_tools = 0;
      $q_total_suratjalan = mysqli_query($conn, "SELECT a.detail_code, e.nama_barang, e.tipe_barang, d.tipe_detail, f.merek, e.sub_barang, SUM(a.qty) AS total_qty, e.satuan FROM asset_suratjalan_detail a JOIN asset_suratjalan b ON a.suratjalan_id = b.id JOIN asset_peminjaman c ON b.peminjaman_id = c.id JOIN asset_db_detail d ON a.detail_code = d.detail_code JOIN asset_db_general e ON d.general_code_id = e.id JOIN asset_db_merek f ON d.merek_id = f.id WHERE c.jenis = 'tools' AND c.kd_project = '$kd_project' GROUP BY a.detail_code ORDER BY e.nama_barang ASC");
      
      while($get_total_suratjalan = mysqli_fetch_array($q_total_suratjalan)){
        $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_total_suratjalan[detail_code]' ORDER BY id DESC"));
        $total_harga = $get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'];
        $grand_total_tools = $grand_total_tools + $total_harga;
      }

      $grand_total_inv = 0;
      $q_total_suratjalan = mysqli_query($conn, "SELECT a.detail_code, e.nama_barang, e.tipe_barang, d.tipe_detail, f.merek, e.sub_barang, SUM(a.qty) AS total_qty, e.satuan FROM asset_suratjalan_detail a JOIN asset_suratjalan b ON a.suratjalan_id = b.id JOIN asset_peminjaman c ON b.peminjaman_id = c.id JOIN asset_db_detail d ON a.detail_code = d.detail_code JOIN asset_db_general e ON d.general_code_id = e.id JOIN asset_db_merek f ON d.merek_id = f.id WHERE c.jenis = 'inventaris' AND c.kd_project = '$kd_project' GROUP BY a.detail_code ORDER BY e.nama_barang ASC");
      
      while($get_total_suratjalan = mysqli_fetch_array($q_total_suratjalan)){
        $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_total_suratjalan[detail_code]' ORDER BY id DESC"));
        $total_harga = $get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'];
        $grand_total_inv = $grand_total_inv + $total_harga;
      }

    ?>


    <hr>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th width="25%">TOTAL SURAT JALAN APD</th>
          <th width="25%">TOTAL SURAT JALAN TOOLS</th>
          <th width="25%">TOTAL SURAT JALAN INVENTARIS</th>
          <th width="25%">TOTAL SURAT JALAN</th>
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


    <?php
      $persentase_kembali_baik_apd = ($n_baik_apd/$grand_total_apd*100);
      $persentase_kembali_baik_tools = ($n_baik_tools/$grand_total_tools*100);
      $persentase_kembali_baik_inv = ($n_baik_inv/$grand_total_inv*100);
    ?>
    <br>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th width="25%">TOTAL KEMBALI BAIK APD</th>
          <th width="25%">TOTAL KEMBALI BAIK TOOLS</th>
          <th width="25%">TOTAL KEMBALI BAIK INVENTARIS</th>
          <th width="25%">TOTAL KEMBALI BAIK</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <b><?php echo "Rp. " . number_format($n_baik_apd, 0, ',', '.'); ?></b>
            <?php if($persentase_kembali_baik_apd < 75){ ?>
              <span style="font-size: 10px" class="badge badge-danger">
                <?php echo number_format($persentase_kembali_baik_apd, 1)." %"; ?>
              </span>
            <?php }else{ ?>
              <span style="font-size: 10px" class="badge badge-success">
                <?php echo number_format($persentase_kembali_baik_apd, 1)." %"; ?>
              </span>
            <?php } ?>
          </td>
          <td>
            <b><?php echo "Rp. " . number_format($n_baik_tools, 0, ',', '.'); ?></b>
            <?php if($persentase_kembali_baik_tools < 75){ ?>
              <span style="font-size: 10px" class="badge badge-danger">
                <?php echo number_format($persentase_kembali_baik_tools, 1)." %"; ?>
              </span>
            <?php }else{ ?>
              <span style="font-size: 10px" class="badge badge-success">
                <?php echo number_format($persentase_kembali_baik_tools, 1)." %"; ?>
              </span>
            <?php } ?>
          </td>
          <td>
            <b><?php echo "Rp. " . number_format($n_baik_inv, 0, ',', '.'); ?></b>
            <?php if($persentase_kembali_baik_inv < 75){ ?>
              <span style="font-size: 10px" class="badge badge-danger">
                <?php echo number_format($persentase_kembali_baik_inv, 1)." %"; ?>
              </span>
            <?php }else{ ?>
              <span style="font-size: 10px" class="badge badge-success">
                <?php echo number_format($persentase_kembali_baik_inv, 1)." %"; ?>
              </span>
            <?php } ?>
          </td>
          <td style="background-color: yellow;"><b><?php echo "Rp. " . number_format($n_baik_apd + $n_baik_tools + $n_baik_inv, 0, ',', '.'); ?></b></td>
        </tr>
      </tbody>
    </table>


    <?php
      $persentase_total_baik = ($n_baik_apd + $n_baik_tools + $n_baik_inv) / ($grand_total_apd + $grand_total_tools + $grand_total_inv) * 100;
      $persentase_total_rusak = ($n_rusak_apd + $n_rusak_tools + $n_rusak_inv) / ($grand_total_apd + $grand_total_tools + $grand_total_inv) * 100;
      $persentase_total_hilang = ($n_hilang_apd + $n_hilang_tools + $n_hilang_inv) / ($grand_total_apd + $grand_total_tools + $grand_total_inv) * 100;

      $persentase_total = ($n_baik_apd + $n_baik_tools + $n_baik_inv + $n_rusak_apd + $n_rusak_tools + $n_rusak_inv + $n_hilang_apd + $n_hilang_tools + $n_hilang_inv) / ($grand_total_apd + $grand_total_tools + $grand_total_inv) * 100;
    ?>
    <br>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th width="25%">TOTAL KEMBALI BAIK</th>
          <th width="25%">TOTAL KEMBALI RUSAK</th>
          <th width="25%">TOTAL KEMBALI HILANG</th>
          <th width="25%">TOTAL PENGEMBALIAN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <b><?php echo "Rp. " . number_format($n_baik_apd + $n_baik_tools + $n_baik_inv, 0, ',', '.'); ?></b>
            <?php if($persentase_total_baik < 75){ ?>
              <span style="font-size: 10px" class="badge badge-danger">
                <?php echo number_format($persentase_total_baik, 1)." %"; ?>
              </span>
            <?php }else{ ?>
              <span style="font-size: 10px" class="badge badge-success">
                <?php echo number_format($persentase_total_baik, 1)." %"; ?>
              </span>
            <?php } ?>
          </td>
          <td>
            <b><?php echo "Rp. " . number_format($n_rusak_apd + $n_rusak_tools + $n_rusak_inv, 0, ',', '.'); ?></b>
            <?php if($persentase_total_rusak < 75){ ?>
              <span style="font-size: 10px" class="badge badge-danger">
                <?php echo number_format($persentase_total_rusak, 1)." %"; ?>
              </span>
            <?php }else{ ?>
              <span style="font-size: 10px" class="badge badge-success">
                <?php echo number_format($persentase_total_rusak, 1)." %"; ?>
              </span>
            <?php } ?>
          </td>
          <td>
            <b><?php echo "Rp. " . number_format($n_hilang_apd + $n_hilang_tools + $n_hilang_inv, 0, ',', '.'); ?></b>
            <?php if($persentase_total_hilang < 75){ ?>
              <span style="font-size: 10px" class="badge badge-danger">
                <?php echo number_format($persentase_total_hilang, 1)." %"; ?>
              </span>
            <?php }else{ ?>
              <span style="font-size: 10px" class="badge badge-success">
                <?php echo number_format($persentase_total_hilang, 1)." %"; ?>
              </span>
            <?php } ?>
          </td>
          <td style="background-color: yellow;">
            <b><?php echo "Rp. " . number_format($n_baik_apd + $n_baik_tools + $n_baik_inv + $n_rusak_apd + $n_rusak_tools + $n_rusak_inv + $n_hilang_apd + $n_hilang_tools + $n_hilang_inv, 0, ',', '.'); ?></b>
            <?php if($persentase_total < 75){ ?>
              <span style="font-size: 10px" class="badge badge-danger">
                <?php echo number_format($persentase_total, 1)." %"; ?>
              </span>
            <?php }else{ ?>
              <span style="font-size: 10px" class="badge badge-success">
                <?php echo number_format($persentase_total, 1)." %"; ?>
              </span>
            <?php } ?>
          </td>
        </tr>
      </tbody>
    </table>

  </div>