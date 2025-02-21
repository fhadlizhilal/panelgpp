<?php
  require_once "../../dev/config.php";
  $today = date("dd-mm-yyyy H:i:s");

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

  function getHari($date){
   switch ($date) {
    case 'Sunday':
     $hari = 'Minggu';
     break;
    case 'Monday':
     $hari = 'Senin';
     break;
    case 'Tuesday':
     $hari = 'Selasa';
     break;
    case 'Wednesday':
     $hari = 'Rabu';
     break;
    case 'Thursday':
     $hari = 'Kamis';
     break;
    case 'Friday':
     $hari = 'Jum\'at';
     break;
    case 'Saturday':
     $hari = 'Sabtu';
     break;
    default:
     $hari = 'Tidak ada';
     break;
   }
   return $hari;
  }
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Summary Report Tiket</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dailyreport</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box">
              <br>
              <form method="GET" action="index.php?pages=reporttiket">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-3 col-sm-2 col-xs-2 col-2"></div>
                    <div class="col-lg-3 col-sm-5 col-xs-5 col-5">
                      <div class="form-group">
                        <center><label for="Bulan">Dari Tanggal</label></center>
                        <input type="date" class="form-control" name="dari" required>
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-5 col-xs-5 col-5">
                      <div class="form-group">
                        <center><label for="Bulan">Sampai Tanggal</label></center>
                        <input type="date" class="form-control" name="sampai" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="reporttiket">
                        <input type="submit" class="btn btn-primary" value="Get Report">
                      </center>
                    </div>                  
                  </div>
                </div>
              </form>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <br>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <!-- /.row -->
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body table-responsive table-hover p-0">
                        <table class="table table-sm table-bordered" style="font-size: 14px;">

                          <?php
                            if(!isset($_GET['dari']) AND !isset($_GET['sampai'])){
                          ?>
                            <thead>
                              <tr align="center">
                                <td style="font-size: 11px; font-style: italic;">Pilih tanggal terlebih dahulu</td>
                              </tr>
                            </thead>
                          <?php
                            }else{
                              $dari = strtotime($_GET['dari']);
                              $sampai = strtotime($_GET['sampai']);
                              $jarak = $sampai - $dari;
                              $jumlah_hari = ($jarak/60/60/24)+1;

                              if($jumlah_hari>31){
                                $_SESSION['alert_error'] = "Jumlah data belum bisa lebih dari 31 hari";
                              }else{

                          ?>

                          <thead>
                            <tr align="center">
                              <th width="1%" rowspan="4" style="vertical-align: middle;">Nama</th>
                            </tr>
                            <tr align="center">
                              <th colspan="<?php echo $jumlah_hari; ?>">Report Claim Tiket Rekasurya <br><small>[<?php echo date('d-m-Y', $dari); ?> s/d <?php echo date('d-m-Y', $sampai); ?>]</small></th>
                              <th rowspan="4" style="vertical-align: middle;">Total</th>
                            </tr>
                            <tr align="center" style="font-size: 9px;">
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                              ?>
                                  <th <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $hari; ?>
                                  </th>
                              <?php
                                }
                              ?>
                            </tr>
                            <tr align="center" style="font-size: 9px;">
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                              ?>
                                  <th <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $tanggal; ?>
                                  </th>
                              <?php
                                }
                              ?>
                            </tr>
                          </thead>
                          <tbody align="center" style="font-size: 11px;">
                            <tr align="center">
                              <td>Bu Ati</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150201190392' AND tgl_claim = '$tgl_now' AND badan = 'REKA'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150201190392' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'REKA'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></b></td>
                            </tr>
                            <tr align="center">
                              <td>Pak Adi</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150211080696' AND tgl_claim = '$tgl_now' AND badan = 'REKA'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150211080696' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'REKA'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <td>Pak Beben</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150202091084' AND tgl_claim = '$tgl_now' AND badan = 'REKA'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150202091084' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'REKA'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <td style="font-size: 9px;">Pak Cheppy</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150204031297' AND tgl_claim = '$tgl_now' AND badan = 'REKA'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150204031297' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'REKA'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <td style="font-size: 9px;">Pak Fauzan</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150203080195' AND tgl_claim = '$tgl_now' AND badan = 'REKA'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150203080195' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'REKA'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <td>Syifah</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150205070702' AND tgl_claim = '$tgl_now' AND badan = 'REKA'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150205070702' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'REKA'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <th>Total</th>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $sumTiket_hari = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE tgl_claim = '$tgl_now' AND badan = 'REKA'"));
                                  $sumTiketAll = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'REKA'"));
                              ?>
                                  <th <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $sumTiket_hari; ?>
                                  </th>
                              <?php
                                }
                              ?>
                              <th><?php echo $sumTiketAll; ?></th>
                            </tr>
                          </tbody>
                        <?php }} ?>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body table-responsive table-hover p-0">
                        <table class="table table-sm table-bordered" style="font-size: 14px;">

                          <?php
                            if(!isset($_GET['dari']) AND !isset($_GET['sampai'])){
                          ?>
                            <thead>
                              <tr align="center">
                                <td style="font-size: 11px; font-style: italic;">Pilih tanggal terlebih dahulu</td>
                              </tr>
                            </thead>
                          <?php
                            }else{
                              $dari = strtotime($_GET['dari']);
                              $sampai = strtotime($_GET['sampai']);
                              $jarak = $sampai - $dari;
                              $jumlah_hari = ($jarak/60/60/24)+1;

                              if($jumlah_hari>31){
                                $_SESSION['alert_error'] = "Jumlah data belum bisa lebih dari 31 hari";
                              }else{

                          ?>

                          <thead>
                            <tr align="center">
                              <th width="1%" rowspan="4" style="vertical-align: middle;">Nama</th>
                            </tr>
                            <tr align="center">
                              <th colspan="<?php echo $jumlah_hari; ?>">Report Claim Tiket Powersurya <br><small>[<?php echo date('d-m-Y', $dari); ?> s/d <?php echo date('d-m-Y', $sampai); ?>]</small></th>
                              <th rowspan="4" style="vertical-align: middle;">Total</th>
                            </tr>
                            <tr align="center" style="font-size: 9px;">
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                              ?>
                                  <th <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $hari; ?>
                                  </th>
                              <?php
                                }
                              ?>
                            </tr>
                            <tr align="center" style="font-size: 9px;">
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                              ?>
                                  <th <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $tanggal; ?>
                                  </th>
                              <?php
                                }
                              ?>
                            </tr>
                          </thead>
                          <tbody align="center" style="font-size: 11px;">
                            <tr align="center">
                              <td>Bu Ati</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150201190392' AND tgl_claim = '$tgl_now' AND badan = 'PS'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150201190392' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'PS'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></b></td>
                            </tr>
                            <tr align="center">
                              <td>Pak Adi</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150211080696' AND tgl_claim = '$tgl_now' AND badan = 'PS'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150211080696' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'PS'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <td>Pak Beben</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150202091084' AND tgl_claim = '$tgl_now' AND badan = 'PS'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150202091084' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'PS'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <td style="font-size: 9px;">Pak Cheppy</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150204031297' AND tgl_claim = '$tgl_now' AND badan = 'PS'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150204031297' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'PS'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <td style="font-size: 9px;">Pak Fauzan</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150203080195' AND tgl_claim = '$tgl_now' AND badan = 'PS'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150203080195' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'PS'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <td>Syifah</td>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $jmlTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150205070702' AND tgl_claim = '$tgl_now' AND badan = 'PS'"));
                                  $sumTiket = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '12150205070702' AND tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'PS'"));
                              ?>
                                  <td <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $jmlTiket; ?>
                                  </td>
                              <?php
                                }
                              ?>
                              <td><b><?php echo $sumTiket; ?></b></td>
                            </tr>
                            <tr align="center">
                              <th>Total</th>
                              <?php
                                for($i=1;$i<=$jumlah_hari;$i++){
                                  $a=$i-1;
                                  $hari = getHari(date('l', strtotime('+'.$a.'days', $dari)));
                                  $tanggal = date('d/m', strtotime('+'.$a.'days', $dari));
                                  $tgl_now = date('Y-m-d', strtotime('+'.$a.'days', $dari));

                                  $sumTiket_hari = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE tgl_claim = '$tgl_now' AND badan = 'PS'"));
                                  $sumTiketAll = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM report_tiket WHERE tgl_claim >= '$_GET[dari]' AND tgl_claim <= '$_GET[sampai]' AND badan = 'PS'"));
                              ?>
                                  <th <?php if($hari == "Sabtu" || $hari == "Minggu"){ echo "style='color: red;'"; } ?>>
                                    <?php echo $sumTiket_hari; ?>
                                  </th>
                              <?php
                                }
                              ?>
                              <th><?php echo $sumTiketAll; ?></th>
                            </tr>
                          </tbody>
                        <?php }} ?>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
                <!-- /.row -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
    </section>

  </div>

<!-- Modal start here -->
<div class="modal fade" id="show" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Daily Report</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-data"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal start here -->
<div class="modal fade" id="show_lihat" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Daily Report</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-data"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal start here -->
<div class="modal fade" id="show_hapus" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Daily Report</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-data"></div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->