<?php
  require_once "../../dev/config.php";

  function tanggal_indo($tanggal, $cetak_hari = false)
  {
    $hari = array ( 1 =>    'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        );
        
    $bulan = array (1 =>   'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
        );
    $split    = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    
    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
  }

  if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[karyawan]'")) > 0){
    $q_get_nm = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[karyawan]'"));
    $get_nm = $q_get_nm['nama'];
  }elseif(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM jabatan WHERE id = '$_GET[karyawan]'")) > 0){
    $q_get_nm = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jabatan WHERE id = '$_GET[karyawan]'"));
    $get_nm = $q_get_nm['jabatan'];
  }else{
    $get_nm = $_GET['karyawan'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../dist/img/logo/Logo-Marketing-2.png" /> 
  <title>Panel GPP | Global Pratama Powerindo</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="../../https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
  <!-- Sweet Alarm -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
  <!-- ckeditor -->
  <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

  <script type="text/javascript">
      window.print()
  </script>
</head>

<body>

  <div class="row">
    <div class="col-1"></div>
    <div class="col-10">
      <center>
        <font style="font-size: 18px; font-weight: bold;">DAILY REPORT</font><br>
        <font style="font-size: 15px;"><?php echo $get_nm; ?></font><br/>
        <font style="font-size: 12px;"><?php echo "[".date('d-m-Y', strtotime($_GET['tanggal_awal']))." s/d ".date('d-m-Y', strtotime($_GET['tanggal_akhir']))."]" ?></font><br>
      </center>
      <br>
      <table id="example2" class="table table-sm" width="100%" style="font-size: 12px;">
        <thead>
        <tr>
          <th width="18%">Nama Karyawan</th>
          <th width="12%">Tanggal</th>
          <th width="70%">Report</th>
        </tr>
        </thead>
        <tbody>
          <?php
            if($_GET['karyawan'] == "all_karyawan"){
              $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan");
            }else{
              $cek_nik = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[karyawan]'"));
              if($cek_nik > 0){
                $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[karyawan]'");
              }else{
                $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE jabatan_id = '$_GET[karyawan]'");
              }
            }
            
            while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
          ?>
            
            <?php
              $tgl_awal = strtotime($_GET['tanggal_awal']);
              $tgl_akhir = strtotime($_GET['tanggal_akhir']);
              $jarak = $tgl_akhir - $tgl_awal;
              $d_diff = $jarak / 60 / 60 / 24;

              $t_1 = $_GET['tanggal_awal'];

              for($i=0;$i<=$d_diff;$i++){
                $get_report = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM dailyreport where nik = '$get_karyawan[nik]' AND tanggal = '$t_1'"));
            ?>
              <tr>
                <td style="font-size: 10px;"><?php echo $get_karyawan['nama'];  ?></td>
                <td>
                  <?php
                    if(date('l', strtotime($t_1)) == "Saturday" || date('l', strtotime($t_1)) == "Sunday"){
                      echo "<div style='color: red;'>".tanggal_indo($t_1, false)."</div>";
                    }else{
                      echo tanggal_indo($t_1, false);
                    }
                  ?>
                </td>
                <td>
                  <?php
                    if(date('l', strtotime($t_1)) == "Saturday" || date('l', strtotime($t_1)) == "Sunday"){
                      echo "<div style='color: red;'>Akhir Pekan</div>";
                    }else{
                      echo $get_report['report'];
                    }
                    
                  ?>
                </td>
              </tr>
          <?php
                $t_1 = date('Y-m-d', strtotime('+1 days', strtotime($t_1)));
              }
            } 
          ?>
        </tbody>
      </table>
    </div>
  </div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Sweet Alarm -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>

</body>
</html>