<?php
  error_reporting(0);
  ob_start(); 
  session_start();
  date_default_timezone_set('Asia/Jakarta');

  // if(!isset($_SESSION["role"]) || $_SESSION["role"] != "management_asset"){
  //   header("location: ../../login.php");
  // }

  $tgl_now = date('Y-m-d');
  require_once "../../../dev/config.php";

  $id = $_GET['id'];
  $get_perbaikan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_perbaikan WHERE id = '$_GET[id]'"));
  $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_perbaikan[entitas_id]'"));
  $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_perbaikan[pelaksana]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_perbaikan[kd_project]'"));
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
      <div class="row" style="text-align: center; margin-bottom: 20px">
        <div class="col-12">
          <div><b>PENGAJUAN PERBAIKAN</b></div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
            <tr>
              <td width="20%">No Perbaikan</td>
              <td width="1%">:</td>
              <td>
                <?php echo $id."FIX/MA/".date('m/Y', strtotime($get_perbaikan['tgl_pengajuan'])); ?>
              </td>
            </tr>
            <tr>
              <td width="20%">Nama Pelaksana</td>
              <td width="1%">:</td>
              <td>
                <?php echo $get_karyawan['nama'] ?>
              </td>
            </tr>
            <tr>
              <td>Entitas</td>
              <td>:</td>
              <td><?php echo $get_entitas['entitas']; ?></td>
            </tr>
            <tr>
              <td>Jenis Pengajuan</td>
              <td>:</td>
              <td><span class="badge badge-secondary">Perbaikan</span></td>
            </tr>
            <tr>
              <td>Tanggal Pengajuan</td>
              <td>:</td>
              <td><?php echo date("d F Y", strtotime($get_perbaikan['tgl_pengajuan'])); ?></td>
            </tr>
            <tr>
              <td>Tanggal Realisasi</td>
              <td>:</td>
              <td>
                <?php
                  if($get_perbaikan['tgl_realisasi'] == "0000-00-00"){
                    echo "-";
                  }else{
                    echo date("d F Y", strtotime($get_perbaikan['tgl_realisasi']));
                  }
                ?> 
              </td>
            </tr>
            <tr>
              <td>Project</td>
              <td>:</td>
              <td><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></td>
            </tr>
            <tr>
              <td>Keterangan</td>
              <td>:</td>
              <td><?php echo $get_perbaikan['keterangan']; ?></td>
            </tr>
            <tr>
              <td>Keterangan</td>
              <td>:</td>
              <td>
                <?php
                  if($get_perbaikan['status'] == "belum realisasi"){
                    echo "<div class='badge badge-warning'>Belum Realisasi</div>";
                  }else{
                    echo "<div class='badge badge-success'>Sudah Realisasi</div>";
                  }
                ?>    
              </td>
            </tr>
          </table>
        </div>

        <div class="col-12">
          <?php if($get_perbaikan['status'] == "belum realisasi"){ ?>
            <table class="table table-sm table-striped" style="font-size: 11px">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Tipe</th>
                  <th>Tipe Detail</th>
                  <th>Merek</th>
                  <th width="5%">Qty</th>
                  <th width="1%">Satuan</th>
                  <th width="7%">Harga Satuan</th>
                  <th width="8%">Harga Total</th>
                  <th width="12%">Keterangan Perbaikan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no=1;
                  $total_harga = 0;
                  $q_get_asset_perbaikan_detail = mysqli_query($conn, "SELECT * FROM asset_perbaikan_detail JOIN asset_db_detail ON asset_perbaikan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE asset_perbaikan_detail.perbaikan_id = '$_GET[id]' ORDER BY asset_db_general.nama_barang, asset_db_general.tipe_barang ASC");
                  while($get_asset_perbaikan_detail = mysqli_fetch_array($q_get_asset_perbaikan_detail)){
                ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_asset_perbaikan_detail['nama_barang']; ?></td>
                        <td><?php echo $get_asset_perbaikan_detail['tipe_barang']; ?></td>
                        <td><?php echo $get_asset_perbaikan_detail['tipe_detail']; ?></td>
                        <td><?php echo $get_asset_perbaikan_detail['merek']; ?></td>
                        <td><?php echo $get_asset_perbaikan_detail['qty']; ?></td>
                        <td><?php echo $get_asset_perbaikan_detail['satuan']; ?></td>
                        <td><?php echo number_format($get_asset_perbaikan_detail['harga_satuan'], 0, ',', '.'); ?></td>
                        <td>
                          <?php
                            $harga_total = $get_asset_perbaikan_detail['qty']*$get_asset_perbaikan_detail['harga_satuan'];
                            echo number_format($harga_total, 0, ',', '.');
                          ?>
                          </td>
                        <td><?php echo $get_asset_perbaikan_detail['keterangan']; ?></td>
                      </tr>
                <?php $total_harga = $total_harga+$harga_total; $no++; } ?>

                      <tr style="background-color: yellow; font-weight: bold;">
                        <td colspan="8" align="center">TOTAL HARGA</td>
                        <td colspan="3"><?php echo number_format($total_harga, 0, ',', '.'); ?></td>
                      </tr>
              </tbody>
            </table>

          <?php }elseif($get_perbaikan['status'] == "sudah realisasi"){ ?>

            <table class="table table-sm table-striped" style="font-size: 11px">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Tipe</th>
                  <th>Tipe Detail</th>
                  <th>Merek</th>
                  <th width="5%">Qty</th>
                  <th width="1%">Satuan</th>
                  <th width="8%">Harga Total</th>
                  <th width="5%" style="background-color: lightgray;">Qty Realisasi</th>
                  <th width="8%" style="background-color: lightgray;">Realisasi Satuan</th>
                  <th width="8%" style="background-color: lightgray;">Total Realisasi</th>
                  <th width="8%" style="background-color: lightgray;">Sisa Uang</th>
                  <th width="12%">Keterangan Perbaikan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no=1;
                  $total_harga = 0;
                  $total_realisasi = 0;
                  $total_sisa_uang = 0;
                  $q_get_perbaikan_realisasi = mysqli_query($conn, "SELECT * FROM asset_perbaikan_realisasi JOIN asset_db_detail ON asset_perbaikan_realisasi.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE asset_perbaikan_realisasi.perbaikan_id = '$id' ORDER BY asset_db_general.nama_barang, asset_db_general.tipe_barang ASC");
                  while($get_perbaikan_realisasi = mysqli_fetch_array($q_get_perbaikan_realisasi)){
                    $get_perbaikan_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_perbaikan_detail WHERE perbaikan_id = '$id' AND detail_code = '$get_perbaikan_realisasi[detail_code]'"));
                ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_perbaikan_realisasi['nama_barang']; ?></td>
                        <td><?php echo $get_perbaikan_realisasi['tipe_barang']; ?></td>
                        <td><?php echo $get_perbaikan_realisasi['tipe_detail']; ?></td>
                        <td><?php echo $get_perbaikan_realisasi['merek']; ?></td>
                        <td><?php if($get_perbaikan_detail['qty']==""){ echo 0; }else{ echo $get_perbaikan_detail['qty']; }; ?></td>
                        <td><?php echo $get_perbaikan_realisasi['satuan']; ?></td>
                        <td>
                          <?php
                            $harga_total = $get_perbaikan_detail['qty']*$get_perbaikan_detail['harga_satuan'];
                            echo "Rp ".number_format($harga_total, 0, ',', '.');
                          ?>
                        </td>
                        <td><?php echo $get_perbaikan_realisasi['qty']; ?></td>
                        <td><?php echo "Rp ".number_format($get_perbaikan_realisasi['harga_satuan'],0,',','.'); ?></td>
                        <td>
                          <?php
                            $realisasi_total = $get_perbaikan_realisasi['qty']*$get_perbaikan_realisasi['harga_satuan'];
                            echo "Rp ".number_format($realisasi_total,0,',','.');
                          ?>
                        </td>
                        <td>
                          <?php
                            $sisa_uang = $harga_total-$realisasi_total;
                            echo "Rp ".number_format($sisa_uang,0,',','.');
                          ?>
                        </td>
                        <td><?php echo $get_perbaikan_detail['keterangan']; ?></td>
                      </tr>
                <?php
                    $total_harga = $total_harga+$harga_total;
                    $total_realisasi = $total_realisasi+$realisasi_total;
                    $total_sisa_uang = $total_sisa_uang+$sisa_uang;
                    $no++; 
                  }
                ?>

                      <tr style="background-color: yellow; font-weight: bold;">
                        <td colspan="7" align="center">TOTAL HARGA</td>
                        <td><?php echo "Rp ".number_format($total_harga, 0, ',', '.'); ?></td>
                        <td colspan="2"></td>
                        <td><?php echo "Rp ".number_format($total_realisasi, 0, ',', '.'); ?></td>
                        <td><?php echo "Rp ".number_format($total_sisa_uang, 0, ',', '.'); ?></td>
                        <td></td>
                      </tr>
              </tbody>
            </table>

          <?php } ?>
        </div>
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