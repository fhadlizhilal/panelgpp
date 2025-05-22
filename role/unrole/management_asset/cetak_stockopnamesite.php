<?php
  error_reporting(0);
  ob_start(); 
  session_start();

  require_once "../../../dev/config.php";

  setlocale(LC_TIME, 'id_ID');

  $id = $_GET['id'];
  $get_sosite = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_stockopname_site WHERE id = '$id'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_sosite[kd_project]'"));
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
<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-lg-1 col-0"></div>
      <div class="col-lg-10 col-12">
        <table class="table table-sm table-bordered">
          <tr>
            <td width="20%" align="center" style="vertical-align: middle;">
              <img src="../../../dist/img/logo/gpp-logo.png" style="width: 50px">
            </td>
            <td width="" align="center" style="vertical-align: middle;">
              <h6>DATA STOCK OPNAME <br> PT GLOBAL PRATAMA POWERINDO</h6>
            </td>
            <td width="20%" align="center" style="vertical-align: middle;">
              <img src="../../../dist/img/logo/logo-k3-v2.png" style="width: 50px">
            </td>
          </tr>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row" style="margin-bottom: -50px;">
      <div class="col-lg-1 col-0"></div>
      <div class="col-lg-10 col-12">
        <table class="table table-sm table-striped" style="font-size: 11px">
          <tr>
            <td colspan="3" align="center"><b>KETERANGAN PROJECT</b></td>
          </tr>
          <tr>
            <td width="30%">Nama Project</td>
            <td width="1%">:</td>
            <td><?php echo $get_project['nm_project']; ?></td>
          </tr>
          <tr>
            <td>Lokasi</td>
            <td>:</td>
            <td><?php echo $get_project['lokasi_project']; ?></td>
          </tr>
          <tr>
            <td width="30%">Nama PIC</td>
            <td width="1%">:</td>
            <td><?php echo $get_sosite['pic']; ?></td>
          </tr>
          <tr>
            <td>Created_at</td>
            <td>:</td>
            <td><?php echo $get_sosite['created_at']; ?></td>
          </tr>
          <tr>
            <td>Submitted_at</td>
            <td>:</td>
            <td><?php echo $get_sosite['submitted_at']; ?></td>
          </tr>
          <tr>
            <td>Status</td>
            <td>:</td>
            <td>
              <?php if($get_sosite['status'] == "open"){ ?>
                <span class="badge badge-info"><?php echo $get_sosite['status']; ?></span>
              <?php }elseif($get_sosite['status'] == "completed"){ ?>
                <span class="badge badge-success"><?php echo $get_sosite['status']; ?></span>
              <?php }elseif($get_sosite['status'] == "closed"){ ?>
                <span class="badge badge-danger"><?php echo $get_sosite['status']; ?></span>
              <?php } ?>
            </td>
          </tr>
        </table>

        <form id="myForm" method="POST" action="">
          <div class="row">
            <div class="col-lg-12 col-12">
              <table class="table table-sm table-striped" style="font-size: 11px">
                <tr>
                  <td colspan="13" align="center" style="vertical-align: middle;">
                    <b>
                      DATA STOCK OPNAME - TOOLS
                    </b>
                  </td>
                </tr>
                  <tr>
                    <th width=""><b>Nama Barang</b></th>
                    <th width=""><b>Tipe Barang</b></th>
                    <th width=""><b>Tipe Detail</b></th>
                    <th width=""><b>Merek</b></th>
                    <th width=""><b>Baik</b></th>
                    <th width=""><b>Rusak</b></th>
                    <th width=""><b>Hilang</b></th>
                    <th width=""><b>Satuan</b></th>
                    <th width=""><b>Harga Satuan</b></th>
                    <th width=""><b>Baik</b></th>
                    <th width=""><b>Rusak</b></th>
                    <th width=""><b>Hilang</b></th>
                    <th width=""><b>Total</b></th>
                  </tr>
                  <?php
                    $total_baik = 0;
                    $total_rusak = 0;
                    $total_hilang = 0;

                    $q_get_db_detail = mysqli_query($conn, "SELECT t1.detail_code, t2.nama_barang, t2.tipe_barang, t1.tipe_detail, t3.merek, t2.satuan FROM asset_db_detail t1 JOIN asset_db_general t2 ON t1.general_code_id = t2.id JOIN asset_db_merek t3 ON t1.merek_id = t3.id INNER JOIN asset_stockopname_site_detail t4 ON t1.detail_code = t4.detail_code JOIN asset_stockopname_site t5 ON t4.id_so_site = t5.id WHERE t5.kd_project = '$get_sosite[kd_project]' AND t2.jenis = 'Tools' ORDER BY nama_barang ASC");
                    while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                      $get_sosite_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT baik, rusak, hilang FROM asset_stockopname_site_detail WHERE detail_code = '$get_db_detail[detail_code]' AND id_so_site = '$id'"));

                      $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_db_detail[detail_code]'"));
                      $jml_baik = $get_sosite_detail['baik'] * $harga_terbaru['harga_satuan'];
                      $jml_rusak = $get_sosite_detail['rusak'] * $harga_terbaru['harga_satuan'];
                      $jml_hilang = $get_sosite_detail['hilang'] * $harga_terbaru['harga_satuan'];

                      $total_baik = $total_baik + $jml_baik;
                      $total_rusak = $total_rusak + $jml_rusak;
                      $total_hilang = $total_bhilang+ $jml_hilang;
                  ?>
                    <tr>
                      <td width=""><?php echo $get_db_detail['nama_barang']; ?></td>
                      <td width=""><?php echo $get_db_detail['tipe_barang']; ?></td>
                      <td width=""><?php echo $get_db_detail['tipe_detail']; ?></td>
                      <td width=""><?php echo $get_db_detail['merek']; ?></td>
                      <td width=""><?php echo $get_sosite_detail['baik']; ?></td>
                      <td width=""><?php echo $get_sosite_detail['rusak']; ?></td>
                      <td width=""><?php echo $get_sosite_detail['hilang']; ?></td>
                      <td width=""><?php echo $get_db_detail['satuan']; ?></td>
                      <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_baik, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_rusak, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_hilang, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_baik+$jml_rusak+$jml_hilang, 0, ',', '.'); ?></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="9" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_baik, 0, ',', '.'); ?></td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_rusak, 0, ',', '.'); ?></td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_hilang, 0, ',', '.'); ?></td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_baik+$total_rusak+$total_hilang, 0, ',', '.'); ?></td>
                  </tr>
              </table>
            </div>


            <div class="col-lg-12 col-12">
              <table class="table table-sm table-striped" style="font-size: 11px">
                <tr>
                  <td colspan="13" align="center" style="vertical-align: middle;">
                    <b>
                      DATA STOCK OPNAME - APD
                    </b>
                  </td>
                </tr>
                  <tr>
                    <th width=""><b>Nama Barang</b></th>
                    <th width=""><b>Tipe Barang</b></th>
                    <th width=""><b>Tipe Detail</b></th>
                    <th width=""><b>Merek</b></th>
                    <th width=""><b>Baik</b></th>
                    <th width=""><b>Rusak</b></th>
                    <th width=""><b>Hilang</b></th>
                    <th width=""><b>Satuan</b></th>
                    <th width=""><b>Harga Satuan</b></th>
                    <th width=""><b>Baik</b></th>
                    <th width=""><b>Rusak</b></th>
                    <th width=""><b>Hilang</b></th>
                    <th width=""><b>Total</b></th>
                  </tr>
                  <?php
                    $total_baik = 0;
                    $total_rusak = 0;
                    $total_hilang = 0;

                    $q_get_db_detail = mysqli_query($conn, "SELECT t1.detail_code, t2.nama_barang, t2.tipe_barang, t1.tipe_detail, t3.merek, t2.satuan FROM asset_db_detail t1 JOIN asset_db_general t2 ON t1.general_code_id = t2.id JOIN asset_db_merek t3 ON t1.merek_id = t3.id INNER JOIN asset_stockopname_site_detail t4 ON t1.detail_code = t4.detail_code JOIN asset_stockopname_site t5 ON t4.id_so_site = t5.id WHERE t5.kd_project = '$get_sosite[kd_project]' AND t2.jenis = 'APD' ORDER BY nama_barang ASC");
                    while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                      $get_sosite_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT baik, rusak, hilang FROM asset_stockopname_site_detail WHERE detail_code = '$get_db_detail[detail_code]' AND id_so_site = '$id'"));

                      $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_db_detail[detail_code]'"));
                      $jml_baik = $get_sosite_detail['baik'] * $harga_terbaru['harga_satuan'];
                      $jml_rusak = $get_sosite_detail['rusak'] * $harga_terbaru['harga_satuan'];
                      $jml_hilang = $get_sosite_detail['hilang'] * $harga_terbaru['harga_satuan'];

                      $total_baik = $total_baik + $jml_baik;
                      $total_rusak = $total_rusak + $jml_rusak;
                      $total_hilang = $total_bhilang+ $jml_hilang;
                  ?>
                    <tr>
                      <td width=""><?php echo $get_db_detail['nama_barang']; ?></td>
                      <td width=""><?php echo $get_db_detail['tipe_barang']; ?></td>
                      <td width=""><?php echo $get_db_detail['tipe_detail']; ?></td>
                      <td width=""><?php echo $get_db_detail['merek']; ?></td>
                      <td width=""><?php echo $get_sosite_detail['baik']; ?></td>
                      <td width=""><?php echo $get_sosite_detail['rusak']; ?></td>
                      <td width=""><?php echo $get_sosite_detail['hilang']; ?></td>
                      <td width=""><?php echo $get_db_detail['satuan']; ?></td>
                      <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_baik, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_rusak, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_hilang, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_baik+$jml_rusak+$jml_hilang, 0, ',', '.'); ?></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="9" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_baik, 0, ',', '.'); ?></td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_rusak, 0, ',', '.'); ?></td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_hilang, 0, ',', '.'); ?></td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_baik+$total_rusak+$total_hilang, 0, ',', '.'); ?></td>
                  </tr>
              </table>
            </div>


            <div class="col-lg-12 col-12">
              <table class="table table-sm table-striped" style="font-size: 11px">
                <tr>
                  <td colspan="13" align="center" style="vertical-align: middle;">
                    <b>
                      DATA STOCK OPNAME - INVENTARIS
                    </b>
                  </td>
                </tr>
                  <tr>
                    <th width=""><b>Nama Barang</b></th>
                    <th width=""><b>Tipe Barang</b></th>
                    <th width=""><b>Tipe Detail</b></th>
                    <th width=""><b>Merek</b></th>
                    <th width=""><b>Baik</b></th>
                    <th width=""><b>Rusak</b></th>
                    <th width=""><b>Hilang</b></th>
                    <th width=""><b>Satuan</b></th>
                    <th width=""><b>Harga Satuan</b></th>
                    <th width=""><b>Baik</b></th>
                    <th width=""><b>Rusak</b></th>
                    <th width=""><b>Hilang</b></th>
                    <th width=""><b>Total</b></th>
                  </tr>
                  <?php
                    $total_baik = 0;
                    $total_rusak = 0;
                    $total_hilang = 0;

                    $q_get_db_detail = mysqli_query($conn, "SELECT t1.detail_code, t2.nama_barang, t2.tipe_barang, t1.tipe_detail, t3.merek, t2.satuan FROM asset_db_detail t1 JOIN asset_db_general t2 ON t1.general_code_id = t2.id JOIN asset_db_merek t3 ON t1.merek_id = t3.id INNER JOIN asset_stockopname_site_detail t4 ON t1.detail_code = t4.detail_code JOIN asset_stockopname_site t5 ON t4.id_so_site = t5.id WHERE t5.kd_project = '$get_sosite[kd_project]' AND t2.jenis = 'Inventaris' ORDER BY nama_barang ASC");
                    while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                      $get_sosite_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT baik, rusak, hilang FROM asset_stockopname_site_detail WHERE detail_code = '$get_db_detail[detail_code]' AND id_so_site = '$id'"));

                      $harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT harga_satuan FROM asset_realisasi WHERE detail_code = '$get_db_detail[detail_code]'"));
                      $jml_baik = $get_sosite_detail['baik'] * $harga_terbaru['harga_satuan'];
                      $jml_rusak = $get_sosite_detail['rusak'] * $harga_terbaru['harga_satuan'];
                      $jml_hilang = $get_sosite_detail['hilang'] * $harga_terbaru['harga_satuan'];

                      $total_baik = $total_baik + $jml_baik;
                      $total_rusak = $total_rusak + $jml_rusak;
                      $total_hilang = $total_bhilang+ $jml_hilang;
                  ?>
                    <tr>
                      <td width=""><?php echo $get_db_detail['nama_barang']; ?></td>
                      <td width=""><?php echo $get_db_detail['tipe_barang']; ?></td>
                      <td width=""><?php echo $get_db_detail['tipe_detail']; ?></td>
                      <td width=""><?php echo $get_db_detail['merek']; ?></td>
                      <td width=""><?php echo $get_sosite_detail['baik']; ?></td>
                      <td width=""><?php echo $get_sosite_detail['rusak']; ?></td>
                      <td width=""><?php echo $get_sosite_detail['hilang']; ?></td>
                      <td width=""><?php echo $get_db_detail['satuan']; ?></td>
                      <td><?php echo "Rp. " . number_format($harga_terbaru['harga_satuan'], 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_baik, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_rusak, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_hilang, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp. " . number_format($jml_baik+$jml_rusak+$jml_hilang, 0, ',', '.'); ?></td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="9" style="text-align: center; background-color: yellow; font-weight: bold;">TOTAL</td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_baik, 0, ',', '.'); ?></td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_rusak, 0, ',', '.'); ?></td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_hilang, 0, ',', '.'); ?></td>
                    <td style="background-color: yellow; font-weight: bold;"><?php echo "Rp. " . number_format($total_baik+$total_rusak+$total_hilang, 0, ',', '.'); ?></td>
                  </tr>
              </table>
            </div>
          </div>

        </form>
        <br><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  <!-- /.container-fluid -->
</section>
<!-- /.content -->

</div>
</body>

<?php require_once "../../all_role/footer.php"; ?>

<script>
// JavaScript untuk mencetak halaman otomatis saat dimuat
window.onload = function() {
    window.print();
}
</script>