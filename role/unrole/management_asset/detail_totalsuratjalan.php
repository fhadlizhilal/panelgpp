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

    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL SURAT JALAN APD</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th>Sub Barang</th>
          <th>Qty</th>
          <th>Satuan</th>
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $grand_total_apd = 0;
          $q_total_suratjalan = mysqli_query($conn, "SELECT a.detail_code, e.nama_barang, e.tipe_barang, d.tipe_detail, f.merek, e.sub_barang, SUM(a.qty) AS total_qty, e.satuan FROM asset_suratjalan_detail a JOIN asset_suratjalan b ON a.suratjalan_id = b.id JOIN asset_peminjaman c ON b.peminjaman_id = c.id JOIN asset_db_detail d ON a.detail_code = d.detail_code JOIN asset_db_general e ON d.general_code_id = e.id JOIN asset_db_merek f ON d.merek_id = f.id WHERE c.jenis = 'apd' AND c.kd_project = '$kd_project' GROUP BY a.detail_code ORDER BY e.nama_barang ASC");
          while($get_total_suratjalan = mysqli_fetch_array($q_total_suratjalan)){
            $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_total_suratjalan[detail_code]' ORDER BY id DESC"));
            $total_harga = $get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'];
            $grand_total_apd = $grand_total_apd + $total_harga;
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_total_suratjalan['nama_barang']; ?></td>
              <td><?php echo $get_total_suratjalan['tipe_barang']; ?></td>
              <td><?php echo $get_total_suratjalan['tipe_detail']; ?></td>
              <td><?php echo $get_total_suratjalan['merek']; ?></td>
              <td><?php echo $get_total_suratjalan['sub_barang']; ?></td>
              <td><?php echo $get_total_suratjalan['total_qty']; ?></td>
              <td><?php echo $get_total_suratjalan['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="9" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_total_apd, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>


    <br>
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL SURAT JALAN TOOLS</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th>Sub Barang</th>
          <th>Qty</th>
          <th>Satuan</th>
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $grand_total_tools = 0;
          $q_total_suratjalan = mysqli_query($conn, "SELECT a.detail_code, e.nama_barang, e.tipe_barang, d.tipe_detail, f.merek, e.sub_barang, SUM(a.qty) AS total_qty, e.satuan FROM asset_suratjalan_detail a JOIN asset_suratjalan b ON a.suratjalan_id = b.id JOIN asset_peminjaman c ON b.peminjaman_id = c.id JOIN asset_db_detail d ON a.detail_code = d.detail_code JOIN asset_db_general e ON d.general_code_id = e.id JOIN asset_db_merek f ON d.merek_id = f.id WHERE c.jenis = 'tools' AND c.kd_project = '$kd_project' GROUP BY a.detail_code ORDER BY e.nama_barang ASC");
          while($get_total_suratjalan = mysqli_fetch_array($q_total_suratjalan)){
            $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_total_suratjalan[detail_code]' ORDER BY id DESC"));
            $total_harga = $get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'];
            $grand_total_tools = $grand_total_tools + $total_harga;
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_total_suratjalan['nama_barang']; ?></td>
              <td><?php echo $get_total_suratjalan['tipe_barang']; ?></td>
              <td><?php echo $get_total_suratjalan['tipe_detail']; ?></td>
              <td><?php echo $get_total_suratjalan['merek']; ?></td>
              <td><?php echo $get_total_suratjalan['sub_barang']; ?></td>
              <td><?php echo $get_total_suratjalan['total_qty']; ?></td>
              <td><?php echo $get_total_suratjalan['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="9" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_total_tools, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>



    <br>
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">TOTAL SURAT JALAN INVENTARIS</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th>Sub Barang</th>
          <th>Qty</th>
          <th>Satuan</th>
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $grand_total_inv = 0;
          $q_total_pengajuan = mysqli_query($conn, "SELECT a.detail_code, e.nama_barang, e.tipe_barang, d.tipe_detail, f.merek, e.sub_barang, SUM(a.qty) AS total_qty, e.satuan FROM asset_suratjalan_detail a JOIN asset_suratjalan b ON a.suratjalan_id = b.id JOIN asset_peminjaman c ON b.peminjaman_id = c.id JOIN asset_db_detail d ON a.detail_code = d.detail_code JOIN asset_db_general e ON d.general_code_id = e.id JOIN asset_db_merek f ON d.merek_id = f.id WHERE c.jenis = 'inventaris' AND c.kd_project = '$kd_project' GROUP BY a.detail_code ORDER BY e.nama_barang ASC");
          while($get_total_suratjalan = mysqli_fetch_array($q_total_pengajuan)){
            $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_total_suratjalan[detail_code]' ORDER BY id DESC"));
            $total_harga = $get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'];
            $grand_total_inv = $grand_total_inv + $total_harga;
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_total_suratjalan['nama_barang']; ?></td>
              <td><?php echo $get_total_suratjalan['tipe_barang']; ?></td>
              <td><?php echo $get_total_suratjalan['tipe_detail']; ?></td>
              <td><?php echo $get_total_suratjalan['merek']; ?></td>
              <td><?php echo $get_total_suratjalan['sub_barang']; ?></td>
              <td><?php echo $get_total_suratjalan['total_qty']; ?></td>
              <td><?php echo $get_total_suratjalan['satuan']; ?></td>
              <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="9" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
              <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_total_inv, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>


    <hr>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>TOTAL SURAT JALAN APD</th>
          <th>TOTAL SURAT JALAN TOOLS</th>
          <th>TOTAL SURAT JALAN INVENTARIS</th>
          <th>TOTAL SURAT JALAN</th>
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