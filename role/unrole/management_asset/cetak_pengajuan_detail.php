<?php
  error_reporting(0);
  ob_start(); 
  session_start();
  date_default_timezone_set('Asia/Jakarta');

  // if(!isset($_SESSION["role"]) || ($_SESSION["role"] != "management_asset" AND $_SESSION["role"] != "director")){
  //   header("location: ../../../login.php");
  // }

  $this_datetime = date('Y-m-d H:i:s');
  $this_date = date('Y-m-d');
  require_once "../../../dev/config.php";

  $id = $_GET['id'];
  $get_pengajuan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE id = '$id'"));
  $get_pelaksana = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengajuan[pelaksana]'"));
  $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengajuan[entitas_id]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_pengajuan[kd_project]'"));
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
  
    <div class="card-body">
      <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PENGAJUAN</div>
      <table class="table table-sm" style="font-size: 14px; margin-bottom: 15px;">
        <tr>
          <td width="20%">No Pengajuan</td>
          <td width="1%">:</td>
          <td><b><?php echo "PN".$id."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></b></td>
        </tr>
        <tr>
          <td width="20%">Nama Pelaksana</td>
          <td width="1%">:</td>
          <td><?php echo $get_pelaksana['nama']; ?></td>
        </tr>
        <tr>
          <td>Entitas</td>
          <td>:</td>
          <td><?php echo $get_entitas['entitas']; ?></td>
        </tr>
        <tr>
          <td>Jenis Pengajuan</td>
          <td>:</td>
          <td>
            <?php if($get_pengajuan['jenis'] == "tools"){ ?>
              <span class="badge badge-info">Tools</span>
            <?php }elseif($get_pengajuan['jenis'] == "apd"){ ?>
              <span class="badge badge-success">APD</span>
            <?php }elseif($get_pengajuan['jenis'] == "inventaris"){ ?>
              <span class="badge badge-warning">Inventaris</span>
            <?php }elseif($get_pengajuan['jenis'] == "alat ukur"){ ?>
              <span class="badge badge-danger">Alat Ukur</span>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td>Tanggal Pengajuan</td>
          <td>:</td>
          <td><?php echo date("d F Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></td>
        </tr>
        <tr>
          <td>Project</td>
          <td>:</td>
          <td><?php echo $get_pengajuan['kd_project']." - ".$get_project['nm_project']; ?></td>
        </tr>
        <tr>
          <td>Keterangan</td>
          <td>:</td>
          <td><?php echo $get_pengajuan['keterangan']; ?></td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
      </table>

      <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">DETAIL BARANG</div>
      <table class="table table-sm" style="font-size: 14px">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Tipe Barang</th>
            <th>Tipe Detail</th>
            <th>Merek</th>
            <th width="1%">Qty</th>
            <th width="1%">Satuan</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no=1;
            $total_harga = 0;
            $q_get_pengajuan_detail = mysqli_query($conn, "SELECT * FROM asset_pengajuan_detail JOIN asset_db_detail ON asset_pengajuan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE pengajuan_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
            while($get_pengajuan_detail = mysqli_fetch_array($q_get_pengajuan_detail)){
              $get_db_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_detail WHERE detail_code = '$get_pengajuan_detail[detail_code]'"));
              $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_detail[general_code_id]'"));
              $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_detail[merek_id]'"));

              $total_harga = $total_harga + ($get_pengajuan_detail['qty'] * $get_pengajuan_detail['harga_satuan']);
          ?>
              <tr>
                <td width="1%"><?php echo $no; ?></td>
                <td><?php echo $get_db_general['nama_barang']; ?></td>
                <td><?php echo $get_db_general['tipe_barang']; ?></td>
                <td><?php echo $get_db_detail['tipe_detail']; ?></td>
                <td><?php echo $get_merek['merek']; ?></td>
                <td><?php echo $get_pengajuan_detail['qty']; ?></td>
                <td><?php echo $get_db_general['satuan']; ?></td>
                <td><?php echo "Rp ".number_format($get_pengajuan_detail['harga_satuan'], 0, ',', '.'); ?></td>
                <td><?php echo "Rp ".number_format($get_pengajuan_detail['qty']*$get_pengajuan_detail['harga_satuan'], 0, ',', '.'); ?></td>
              </tr>
          <?php $no++; } ?>
              <tr style="font-weight: bold; background-color: yellow;">
                <td colspan="8" align="center">TOTAL</td>
                <td><?php echo "Rp ".number_format($total_harga, 0, ',', '.'); ?></td>
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