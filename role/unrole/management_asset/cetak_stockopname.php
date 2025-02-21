<?php
  error_reporting(0);
  ob_start(); 
  session_start();
  date_default_timezone_set('Asia/Jakarta');

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "management_asset"){
    header("location: ../../login.php");
  }

  $this_datetime = date('Y-m-d H:i:s');
  $this_date = date('Y-m-d');
  require_once "../../../dev/config.php";

  $id = $_GET['id'];
  $get_stockopname = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_stockopname WHERE id = '$id'"));
  $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_stockopname[entitas_id]'"));
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
      <div class="card-body" style="margin-top: -20px;">
        <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">DETAIL STOCK OPNAME</div>
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

        <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI ASSET</div>
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
      </div>
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