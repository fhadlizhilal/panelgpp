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
  $get_peminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE id = '$id'"));
  $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));
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
        <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PEMINJAMAN</div>
        <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
          <tr>
            <td width="30%">Kode Pinjam</td>
            <td width="1%">:</td>
            <td><?php echo $id."/MA/".date("m/Y", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
          </tr>
          <tr>
            <td>Nama Peminjam</td>
            <td>:</td>
            <td><?php echo $get_karyawan['nama']; ?></td>
          </tr>
          <tr>
            <td>Tanggal Pinjam</td>
            <td>:</td>
            <td><?php echo date("d F Y H:i", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
          </tr>
          <tr>
            <td>Project</td>
            <td>:</td>
            <td>
              <?php
                if($get_peminjaman['kd_project'] == NULL){
                  echo "Non Project";
                }else{
                  echo $get_peminjaman['kd_project']." - ".$get_project['nm_project'];
                }                            
              ?>
            </td>
          </tr>
          <tr>
            <td>Keterangan Pinjam</td>
            <td>:</td>
            <td>
              <?php echo $get_peminjaman['keterangan']; ?></td>
          </tr>
          <tr>
            <td>Jenis / Status</td>
            <td>:</td>
            <td>
              <?php if($get_peminjaman['jenis'] == "tools"){ ?>
                <span class="badge badge-info">Tools</span>
              <?php }elseif($get_peminjaman['jenis'] == "apd"){ ?>
                <span class="badge badge-success">APD</span>
              <?php }elseif($get_peminjaman['jenis'] == "inventaris"){ ?>
                <span class="badge badge-warning">Inventaris</span>
              <?php }elseif($get_peminjaman['jenis'] == "alat ukur"){ ?>
                <span class="badge badge-danger">Alat Ukur</span>
              <?php } ?>

              <?php if($get_peminjaman['status'] == "waiting for MA"){ ?>
                <span class="badge badge-secondary">Waiting for MA</span>
              <?php }elseif($get_peminjaman['status'] == "on progress by MA"){ ?>
                <span class="badge badge-warning">On Progress by MA</span>
              <?php }elseif($get_peminjaman['status'] == "rejected by MA"){ ?>
                <span class="badge badge-danger">Rejected by MA</span>
              <?php }elseif($get_peminjaman['status'] == "canceled by user"){ ?>
                <span class="badge badge-danger">Canceled by User</span>
              <?php }elseif($get_peminjaman['status'] == "completed"){ ?>
                <span class="badge badge-success">Completed</span>
              <?php } ?>
            </td>
          </tr>
        </table>

        <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI ASSET</div>
        <table class="table table-sm" style="font-size: 11px">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Barang</th>
              <th>Tipe Barang</th>
              <th width="1%">Qty</th>
              <th width="1%">Satuan</th>
              <th>Catatan</th>
              <th width="4%">Sudah Kirim</th>
              <th width="4%">Sisa</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no=1;
              $q_get_peminjaman_detail = mysqli_query($conn, "SELECT * FROM asset_peminjaman_detail JOIN asset_db_general ON asset_peminjaman_detail.general_code = asset_db_general.general_code WHERE peminjaman_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
              while($get_peminjaman_detail = mysqli_fetch_array($q_get_peminjaman_detail)){
                $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE general_code = '$get_peminjaman_detail[general_code]'"));

                //sudah kirim dari surat jalan (non tidak sesuai)
                $sudahkirim_dari_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sudah_kirim FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_db_detail ON asset_suratjalan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_db_general.general_code = '$get_peminjaman_detail[general_code]' AND asset_suratjalan.status <> 'diterima tapi tidak sesuai'"));
            ?>
                <tr>
                  <td width="1%"><?php echo $no; ?></td>
                  <td><?php echo $get_db_general['nama_barang']; ?></td>
                  <td><?php echo $get_db_general['tipe_barang']; ?></td>
                  <td><?php echo $get_peminjaman_detail ['qty']; ?></td>
                  <td><?php echo $get_db_general['satuan']; ?></td>
                  <td><?php echo $get_peminjaman_detail['keterangan'];  ?></td>
                  <td><?php if($sudahkirim_dari_suratjalan['sudah_kirim'] < 1){echo 0;}else{echo $sudahkirim_dari_suratjalan['sudah_kirim'];} ?></td>
                  <td><?php echo $get_peminjaman_detail ['qty'] - $sudahkirim_dari_suratjalan['sudah_kirim']; ?></td>
                </tr>
            <?php $no++; } ?>
                <tr>
                  <td colspan="8"></td>
                </tr>
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