<?php
  error_reporting(0);
  ob_start(); 
  session_start();
  date_default_timezone_set('Asia/Jakarta');

  // if(!isset($_SESSION["role"]) || $_SESSION["role"] != "management_asset" || $_SESSION["role"] != "HSE"){
  //   header("location: ../../login.php");
  // }

  $this_datetime = date('Y-m-d H:i:s');
  $this_date = date('Y-m-d');
  require_once "../../../dev/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../dist/img/logo/Logo-Marketing-2.png" /> 
  <title>
    <?php 
      if(isset($_GET['pages'])){
        if($_GET['pages'] == "listforecast"){
          echo "Panel GPP | List Forecast";
        }else{
          echo $_GET['pages'];
        }
      }else{
        echo "Panel GPP | Global Pratama Powerindo";
      }
    ?>
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../../../https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../../https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../../plugins/jqvmap/jqvmap.min.css">
  <!-- Sweet Alarm -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../../plugins/summernote/summernote-bs4.min.css">
  <!-- ckeditor -->
  <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/logo/Logo-Marketing.png" alt="AdminLTELogo" height="80" width="80">
  </div> -->

  <!-- /.navbar -->
  <!-- Konten Wrapper -->
  
    <?php
      if(isset($_GET['kd'])){
        $kd_project = $_GET['kd'];
        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$kd_project'"));
      }
    ?>

      <div class="card-body" style="margin-top: -20px;">
        <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PROJECT</div>
          <div class="row">
            <div class="col-12">
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
              $grand_totalpeminjaman_apd = 0;
              $q_total_peminjamanapd = mysqli_query($conn, "SELECT t3.general_code, t3.nama_barang, t3.tipe_barang, t3.sub_barang, SUM(t1.qty) AS total_qty, t3.satuan, t3.jenis FROM asset_peminjaman_detail t1 JOIN asset_peminjaman t2 ON t1.peminjaman_id = t2.id JOIN asset_db_general t3 ON t1.general_code = t3.general_code WHERE t2.kd_project = '$kd_project' AND t3.jenis = 'APD' GROUP BY t1.general_code");
              while($get_total_peminjamanapd = mysqli_fetch_array($q_total_peminjamanapd)){
                $harga_satuan_max = mysqli_fetch_array(mysqli_query($conn, "SELECT t1.id, t3.general_code, t1.detail_code, t1.harga_satuan FROM asset_realisasi t1 JOIN asset_db_detail t2 ON t1.detail_code = t2.detail_code JOIN asset_db_general t3 ON t2.general_code_id = t3.id WHERE t3.general_code = '$get_total_peminjamanapd[general_code]' ORDER BY t1.harga_satuan DESC"));

                $total_harga = $harga_satuan_max['harga_satuan'] * $get_total_peminjamanapd['total_qty'];
                $grand_totalpeminjaman_apd = $grand_totalpeminjaman_apd + $total_harga;
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
                  <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_totalpeminjaman_apd, 0, ',', '.'); ?></td>
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
              $grand_totalpeminjaman_tools = 0;
              $q_total_peminjamantools = mysqli_query($conn, "SELECT t3.general_code, t3.nama_barang, t3.tipe_barang, t3.sub_barang, SUM(t1.qty) AS total_qty, t3.satuan, t3.jenis FROM asset_peminjaman_detail t1 JOIN asset_peminjaman t2 ON t1.peminjaman_id = t2.id JOIN asset_db_general t3 ON t1.general_code = t3.general_code WHERE t2.kd_project = '$kd_project' AND t3.jenis = 'Tools' GROUP BY t1.general_code");
              while($get_total_peminjamanapd = mysqli_fetch_array($q_total_peminjamantools)){
                $harga_satuan_max = mysqli_fetch_array(mysqli_query($conn, "SELECT t1.id, t3.general_code, t1.detail_code, t1.harga_satuan FROM asset_realisasi t1 JOIN asset_db_detail t2 ON t1.detail_code = t2.detail_code JOIN asset_db_general t3 ON t2.general_code_id = t3.id WHERE t3.general_code = '$get_total_peminjamanapd[general_code]' ORDER BY t1.harga_satuan DESC"));

                $total_harga = $harga_satuan_max['harga_satuan'] * $get_total_peminjamanapd['total_qty'];
                $grand_totalpeminjaman_tools = $grand_totalpeminjaman_tools + $total_harga;
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
                  <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_totalpeminjaman_tools, 0, ',', '.'); ?></td>
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
              $grand_totalpeminjaman_inv = 0;
              $q_total_peminjamaninv = mysqli_query($conn, "SELECT t3.general_code, t3.nama_barang, t3.tipe_barang, t3.sub_barang, SUM(t1.qty) AS total_qty, t3.satuan, t3.jenis FROM asset_peminjaman_detail t1 JOIN asset_peminjaman t2 ON t1.peminjaman_id = t2.id JOIN asset_db_general t3 ON t1.general_code = t3.general_code WHERE t2.kd_project = '$kd_project' AND t3.jenis = 'Inventaris' GROUP BY t1.general_code");
              while($get_total_peminjamanapd = mysqli_fetch_array($q_total_peminjamaninv)){
                $harga_satuan_max = mysqli_fetch_array(mysqli_query($conn, "SELECT t1.id, t3.general_code, t1.detail_code, t1.harga_satuan FROM asset_realisasi t1 JOIN asset_db_detail t2 ON t1.detail_code = t2.detail_code JOIN asset_db_general t3 ON t2.general_code_id = t3.id WHERE t3.general_code = '$get_total_peminjamanapd[general_code]' ORDER BY t1.harga_satuan DESC"));

                $total_harga = $harga_satuan_max['harga_satuan'] * $get_total_peminjamanapd['total_qty'];
                $grand_totalpeminjaman_inv = $grand_totalpeminjaman_inv + $total_harga;
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
                  <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_totalpeminjaman_inv, 0, ',', '.'); ?></td>
                </tr>
          </tbody>
        </table>
      </div>


      <div style="page-break-before: always;"></div>
      <!-- ------------------------------------------------------------------ -->

      <div class="card-body" style="margin-top: -20px;">
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
              $grand_totalrealisasi_apd = 0;
              $q_total_pengajuan = mysqli_query($conn, "SELECT t4.nama_barang, t4.tipe_barang, t3.tipe_detail, t5.merek, SUM(t2.qty) AS total_qty, t4.satuan, t2.harga_satuan FROM asset_realisasi t2 JOIN asset_pengajuan t1 ON t2.pengajuan_id = t1.id JOIN asset_db_detail t3 ON t2.detail_code = t3.detail_code JOIN asset_db_general t4 ON t3.general_code_id = t4.id JOIN asset_db_merek t5 ON t3.merek_id = t5.id WHERE t1.kd_project = '$kd_project' AND t4.jenis = 'APD' GROUP BY t2.detail_code ORDER BY t4.nama_barang ASC");
              while($get_total_pengajuan = mysqli_fetch_array($q_total_pengajuan)){
                $total_harga = $get_total_pengajuan['total_qty'] * $get_total_pengajuan['harga_satuan'];
                $grand_totalrealisasi_apd = $grand_totalrealisasi_apd + $total_harga;
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
                  <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_totalrealisasi_apd, 0, ',', '.'); ?></td>
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
              $grand_totalrealisasi_tools = 0;
              $q_total_pengajuan = mysqli_query($conn, "SELECT t4.nama_barang, t4.tipe_barang, t3.tipe_detail, t5.merek, SUM(t2.qty) AS total_qty, t4.satuan, t2.harga_satuan FROM asset_realisasi t2 JOIN asset_pengajuan t1 ON t2.pengajuan_id = t1.id JOIN asset_db_detail t3 ON t2.detail_code = t3.detail_code JOIN asset_db_general t4 ON t3.general_code_id = t4.id JOIN asset_db_merek t5 ON t3.merek_id = t5.id WHERE t1.kd_project = '$kd_project' AND t4.jenis = 'Tools' GROUP BY t2.detail_code ORDER BY t4.nama_barang ASC");
              while($get_total_pengajuan = mysqli_fetch_array($q_total_pengajuan)){
                $total_harga = $get_total_pengajuan['total_qty'] * $get_total_pengajuan['harga_satuan'];
                $grand_totalrealisasi_tools = $grand_totalrealisasi_tools + $total_harga;
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
                  <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_totalrealisasi_tools, 0, ',', '.'); ?></td>
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
              $grand_totalrealisasi_inv = 0;
              $q_total_pengajuan = mysqli_query($conn, "SELECT t4.nama_barang, t4.tipe_barang, t3.tipe_detail, t5.merek, SUM(t2.qty) AS total_qty, t4.satuan, t2.harga_satuan FROM asset_realisasi t2 JOIN asset_pengajuan t1 ON t2.pengajuan_id = t1.id JOIN asset_db_detail t3 ON t2.detail_code = t3.detail_code JOIN asset_db_general t4 ON t3.general_code_id = t4.id JOIN asset_db_merek t5 ON t3.merek_id = t5.id WHERE t1.kd_project = '$kd_project' AND t4.jenis = 'Inventaris' GROUP BY t2.detail_code ORDER BY t4.nama_barang ASC");
              while($get_total_pengajuan = mysqli_fetch_array($q_total_pengajuan)){
                $total_harga = $get_total_pengajuan['total_qty'] * $get_total_pengajuan['harga_satuan'];
                $grand_totalrealisasi_inv = $grand_totalrealisasi_inv + $total_harga;
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
                  <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_totalrealisasi_inv, 0, ',', '.'); ?></td>
                </tr>
          </tbody>
        </table>

      </div>



      <div style="page-break-before: always;"></div>
      <!-- ------------------------------------------------------------------ -->


      <div class="card-body" style="margin-top: -20px;">
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
              $grand_totalsuratjalan_apd = 0;
              $q_total_suratjalan = mysqli_query($conn, "SELECT a.detail_code, e.nama_barang, e.tipe_barang, d.tipe_detail, f.merek, e.sub_barang, SUM(a.qty) AS total_qty, e.satuan FROM asset_suratjalan_detail a JOIN asset_suratjalan b ON a.suratjalan_id = b.id JOIN asset_peminjaman c ON b.peminjaman_id = c.id JOIN asset_db_detail d ON a.detail_code = d.detail_code JOIN asset_db_general e ON d.general_code_id = e.id JOIN asset_db_merek f ON d.merek_id = f.id WHERE c.jenis = 'apd' AND c.kd_project = '$kd_project' GROUP BY a.detail_code ORDER BY e.nama_barang ASC");
              while($get_total_suratjalan = mysqli_fetch_array($q_total_suratjalan)){
                $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_total_suratjalan[detail_code]'"));
                $total_harga = $get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'];
                $grand_totalsuratjalan_apd = $grand_totalsuratjalan_apd + $total_harga;
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
                  <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_totalsuratjalan_apd, 0, ',', '.'); ?></td>
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
              $grand_totalsuratjalan_tools = 0;
              $q_total_suratjalan = mysqli_query($conn, "SELECT a.detail_code, e.nama_barang, e.tipe_barang, d.tipe_detail, f.merek, e.sub_barang, SUM(a.qty) AS total_qty, e.satuan FROM asset_suratjalan_detail a JOIN asset_suratjalan b ON a.suratjalan_id = b.id JOIN asset_peminjaman c ON b.peminjaman_id = c.id JOIN asset_db_detail d ON a.detail_code = d.detail_code JOIN asset_db_general e ON d.general_code_id = e.id JOIN asset_db_merek f ON d.merek_id = f.id WHERE c.jenis = 'tools' AND c.kd_project = '$kd_project' GROUP BY a.detail_code ORDER BY e.nama_barang ASC");
              while($get_total_suratjalan = mysqli_fetch_array($q_total_suratjalan)){
                $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_total_suratjalan[detail_code]'"));
                $total_harga = $get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'];
                $grand_totalsuratjalan_tools = $grand_totalsuratjalan_tools + $total_harga;
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
                  <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_totalsuratjalan_tools, 0, ',', '.'); ?></td>
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
              $grand_totalsuratjalan_inv = 0;
              $q_total_pengajuan = mysqli_query($conn, "SELECT a.detail_code, e.nama_barang, e.tipe_barang, d.tipe_detail, f.merek, e.sub_barang, SUM(a.qty) AS total_qty, e.satuan FROM asset_suratjalan_detail a JOIN asset_suratjalan b ON a.suratjalan_id = b.id JOIN asset_peminjaman c ON b.peminjaman_id = c.id JOIN asset_db_detail d ON a.detail_code = d.detail_code JOIN asset_db_general e ON d.general_code_id = e.id JOIN asset_db_merek f ON d.merek_id = f.id WHERE c.jenis = 'inventaris' AND c.kd_project = '$kd_project' GROUP BY a.detail_code ORDER BY e.nama_barang ASC");
              while($get_total_suratjalan = mysqli_fetch_array($q_total_pengajuan)){
                $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_total_suratjalan[detail_code]'"));
                $total_harga = $get_total_suratjalan['total_qty'] * $harga_terbaru['harga_satuan'];
                $grand_totalsuratjalan_inv = $grand_totalsuratjalan_inv + $total_harga;
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
                  <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($grand_totalsuratjalan_inv, 0, ',', '.'); ?></td>
                </tr>
          </tbody>
        </table>

      </div>


      <div style="page-break-before: always;"></div>
      <!-- ----------------------------REPORT AKHIR-------------------------------------- -->


      <div class="card-body" style="margin-top: -20px;">
        <div style="text-align: center; font-weight: bold; margin-bottom: 20px;">REPORT ASSET PROJECT</div>
        <table class="table table-sm table-bordered" style="font-size: 11px">
          <thead>
            <tr>
              <th width="25%">Total Peminjaman APD</th>
              <th width="25%">Total Peminjaman Tools</th>
              <th width="25%">Total Peminjaman Inventaris</th>
              <th width="25%">Total Peminjaman</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo "Rp. " . number_format($grand_totalpeminjaman_apd, 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($grand_totalpeminjaman_tools, 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($grand_totalpeminjaman_inv, 0, ',', '.'); ?></td>
              <td><b><?php echo "Rp. " . number_format($grand_totalpeminjaman_apd + $grand_totalpeminjaman_tools + $grand_totalpeminjaman_inv, 0, ',', '.'); ?></b></td>
            </tr>
          </tbody>
        </table>

        <br>
        <table class="table table-sm table-bordered" style="font-size: 11px">
          <thead>
            <tr>
              <th width="25%">Total Realisasi APD</th>
              <th width="25%">Total Realisasi Tools</th>
              <th width="25%">Total Realisasi Inventaris</th>
              <th width="25%">Total Realisasi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo "Rp. " . number_format($grand_totalrealisasi_apd, 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($grand_totalrealisasi_tools, 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($grand_totalrealisasi_inv, 0, ',', '.'); ?></td>
              <td><b><?php echo "Rp. " . number_format($grand_totalrealisasi_apd + $grand_totalrealisasi_tools + $grand_totalrealisasi_inv, 0, ',', '.'); ?></b></td>
            </tr>
          </tbody>
        </table>

        <br>
        <table class="table table-sm table-bordered" style="font-size: 11px">
          <thead>
            <tr>
              <th width="25%">Total Surat Jalan APD</th>
              <th width="25%">Total Surat Jalan Tools</th>
              <th width="25%">Total Surat Jalan Inventaris</th>
              <th width="25%">Total Surat Jalan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo "Rp. " . number_format($grand_totalsuratjalan_apd, 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($grand_totalsuratjalan_tools, 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format($grand_totalsuratjalan_inv, 0, ',', '.'); ?></td>
              <td><b><?php echo "Rp. " . number_format($grand_totalsuratjalan_apd + $grand_totalsuratjalan_tools + $grand_totalsuratjalan_inv, 0, ',', '.'); ?></b></td>
            </tr>
          </tbody>
        </table>

        <br>
        <hr>
        <table class="table table-sm table-bordered" style="font-size: 11px">
          <thead>
            <tr>
              <th width="33%">Total Beli</th>
              <th width="33%">Total Stock</th>
              <th width="33%">Total Asset Dikirim</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo "Rp. " . number_format($grand_totalrealisasi_apd + $grand_totalrealisasi_tools + $grand_totalrealisasi_inv, 0, ',', '.'); ?></td>
              <td><?php echo "Rp. " . number_format(($grand_totalsuratjalan_apd + $grand_totalsuratjalan_tools + $grand_totalsuratjalan_inv) - ($grand_totalrealisasi_apd + $grand_totalrealisasi_tools + $grand_totalrealisasi_inv), 0, ',', '.'); ?></td>
              <td><b><?php echo "Rp. " . number_format($grand_totalsuratjalan_apd + $grand_totalsuratjalan_tools + $grand_totalsuratjalan_inv, 0, ',', '.'); ?></b></td>
            </tr>
          </tbody>
        </table>
      </div>


  <!-- ./Konten Wrapper -->
</div>
<!-- ./wrapper -->
</body>

<script>
    window.onload = function() {
        window.print(); // Memanggil dialog cetak saat halaman dimuat
    }
</script>

<?php require_once "../../all_role/footer.php"; ?>