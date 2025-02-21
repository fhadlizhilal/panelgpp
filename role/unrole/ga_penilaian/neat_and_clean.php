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


  if(isset($_GET['tglawal'])){
    $tglawal = $_GET['tglawal'];
  }else{
    $tglawal = date('Y')."-01-01";
  }

  if(isset($_GET['tglakhir'])){
    $tglakhir = $_GET['tglakhir'];
  }else{
    $tglakhir = date('Y')."-12-31";
  }

  $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama != 'Erwansyah HMS' AND nama != 'Fadhli Aoliana' AND nama != 'Heriyanto Kurniawan' AND nama != 'M. Badrudin' AND nama != 'Sutisman' AND nama != 'Dadang Romansyah' AND nama != 'Asep Saepul' AND nama != 'Suhaedin' AND nama != 'Solahudin Pebriana' AND nama != 'Iman Maryadi' ORDER BY nama ASC");

// ----------------------------------------------------- ACTION -------------------------------------------------
  if(isset($_POST['submit_data_neatnclean'])){
    if($_POST['submit_data_neatnclean'] == "Submit"){
      $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan");
      while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
        if(isset($_POST['nilai_'.$get_karyawan['nik']])){
          $nilai = $_POST['nilai_'.$get_karyawan['nik']];
          $push_neatnclean = mysqli_query($conn, "INSERT INTO ga_neatnclean VALUES('','$_POST[tanggal]','$get_karyawan[nik]','$nilai')");
        }
      }
      $_SESSION['alert_success'] = "Berhasil! Data Neat & Clean Berhasil Disimpan";
    }
  }

  if(isset($_POST['delete_data_neatnclean'])){
    if($_POST['delete_data_neatnclean'] == "Delete"){
      $delete_neatnclean = mysqli_query($conn, "DELETE FROM ga_neatnclean WHERE tanggal = '$_POST[tanggal]'");

      if($delete_neatnclean){
        $_SESSION['alert_success'] = "Berhasil! Data Neat & Clean Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Neat & Clean Gagal Dihapus".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['edit_data_neatnclean'])){
    if($_POST['edit_data_neatnclean'] == "Simpan"){
      mysqli_query($conn, "DELETE FROM ga_neatnclean WHERE tanggal = '$_POST[tanggal]'");

      $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan");
      while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
        if(isset($_POST['nilai_'.$get_karyawan['nik']])){
          $nilai = $_POST['nilai_'.$get_karyawan['nik']];
          $push_neatnclean = mysqli_query($conn, "INSERT INTO ga_neatnclean VALUES('','$_POST[tanggal]','$get_karyawan[nik]','$nilai')");
        }
      }
      $_SESSION['alert_success'] = "Berhasil! Data Neat & Clean Berhasil Disimpan";
    }
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Neat And Clean</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Neat And Clean</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row no-print">
          <div class="col-12">
            <div class="card">
              <div class="card-body">

                <div class="row">
                  <div class="col-lg-12 col-12">
                    <!-- small box -->
                    <div class="small-box">
                      <br>
                      <form id="" method="GET" action="index.php?pages=cleaning">
                        <div class="inner">
                          <div class="row">
                            <div class="col-lg-4 col-sm-2 col-xs-1 col-1"></div>
                            <div class="col-lg-2 col-sm-4 col-xs-5 col-5">
                              <div class="form-group">
                                <center><label for="Bulan">Bulan</label></center>
                                <select class="form-control" name="bulan">
                                  <option value="1" <?php if($_GET['bulan'] == '1'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "01"){ echo "selected" ; } ?> >Januari</option>
                                  <option value="2" <?php if($_GET['bulan'] == '2'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "02"){ echo "selected" ; } ?> >Februari</option>
                                  <option value="3" <?php if($_GET['bulan'] == '3'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "03"){ echo "selected" ; } ?> >Maret</option>
                                  <option value="4" <?php if($_GET['bulan'] == '4'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "04"){ echo "selected" ; } ?> >April</option>
                                  <option value="5" <?php if($_GET['bulan'] == '5'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "05"){ echo "selected" ; } ?> >Mei</option>
                                  <option value="6" <?php if($_GET['bulan'] == '6'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "06"){ echo "selected" ; } ?> >Juni</option>
                                  <option value="7" <?php if($_GET['bulan'] == '7'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "07"){ echo "selected" ; } ?> >Juli</option>
                                  <option value="8" <?php if($_GET['bulan'] == '8'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "08"){ echo "selected" ; } ?> >Agustus</option>
                                  <option value="9" <?php if($_GET['bulan'] == '9'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "09"){ echo "selected" ; } ?> >September</option>
                                  <option value="10" <?php if($_GET['bulan'] == '10'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "10"){ echo "selected" ; } ?> >Oktober</option>
                                  <option value="11" <?php if($_GET['bulan'] == '11'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "11"){ echo "selected" ; } ?> >November</option>
                                  <option value="12" <?php if($_GET['bulan'] == '12'){ echo "selected" ; }elseif(!isset($_GET['bulan']) AND Date('m') == "12"){ echo "selected" ; } ?> >Desember</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 col-xs-5 col-5">
                              <div class="form-group">
                                <center><label for="Bulan">Tahun</label></center>
                                <select class="form-control" name="tahun">
                                  <option value="2022" <?php if($_GET['tahun'] == '2022'){ echo "selected"; }elseif(!isset($_GET['tahun']) AND Date('Y') == "2022"){ echo "selected" ; } ?> >2022</option>
                                  <option value="2023" <?php if($_GET['tahun'] == '2023'){ echo "selected"; }elseif(!isset($_GET['tahun']) AND Date('Y') == "2023"){ echo "selected" ; } ?> >2023</option>
                                  <option value="2024" <?php if($_GET['tahun'] == '2024'){ echo "selected"; }elseif(!isset($_GET['tahun']) AND Date('Y') == "2024"){ echo "selected" ; } ?> >2024</option>
                                  <option value="2025" <?php if($_GET['tahun'] == '2025'){ echo "selected"; }elseif(!isset($_GET['tahun']) AND Date('Y') == "2025"){ echo "selected" ; } ?> >2025</option>
                                  <option value="2026" <?php if($_GET['tahun'] == '2026'){ echo "selected"; }elseif(!isset($_GET['tahun']) AND Date('Y') == "2026"){ echo "selected" ; } ?> >2026</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-12">
                              <center>
                                <input type="hidden" name="pages" value="neatandclean">
                                <input type="submit" class="btn btn-primary" value="Submit">
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
                
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-sm text-nowrap" style="font-size: 12px;">
                          <thead>
                            <tr align="center">
                              <th width="1%">NO</th>
                              <th width="30%">Tanggal</th>
                              <th width="50%">Report</th>
                              <th width="10%">#</th>
                            </tr>
                          </thead>
                          <tbody align="center">
                            <?php if (!isset($_GET['bulan']) OR !isset($_GET['tahun'])){ ?>
                              <tr>
                                <td colspan="5" style="text-align: center;"><i><small>silahkan pilih bulan dan tahun terlebih dahulu</small></i></td>
                              </tr>
                            <?php 
                              }else{
                                $jml_hari = cal_days_in_month(CAL_GREGORIAN, $_GET['bulan'], $_GET['tahun']);

                                for($i=1;$i<=$jml_hari;$i++){
                                  $tgl_report = date('Y-m-d', strtotime($_GET['tahun']."-".$_GET['bulan']."-".$i));
                                  $cek_hari = date('l', strtotime($tgl_report));

                            ?>
                                  <tr>
                                    <td><?php echo $i; ?></td>
                                    <td style="text-align: left; font-size: 10px"><?php echo tanggal_indo($tgl_report, true); ?></td>
                                    <td>
                                      <?php
                                        $query = mysqli_query($conn, "SELECT * FROM ga_neatnclean WHERE tanggal = '$tgl_report'");
                                        $query2 = mysqli_query($conn, "SELECT * FROM harilibur WHERE tanggal = '$tgl_report'");
                                        $result = mysqli_num_rows($query);
                                        $result2 = mysqli_num_rows($query2);

                                        if ($result > 0 AND $cek_hari != "Saturday" AND $cek_hari != "Sunday") {
                                      ?>
                                          <span class="badge badge-success">Data Sudah Ada</span>

                                      <?php }elseif($cek_hari == "Saturday" OR $cek_hari == "Sunday"){ ?>

                                          <span class="badge badge-default">Akhir Pekan / Libur</span>

                                      <?php }elseif($result2 > 0){ ?>

                                          <span class="badge badge-info">Hari Libur</span>

                                      <?php }else{ ?>
                                          
                                          <span class="badge badge-danger">Data Belum Ada</span>

                                      <?php } ?>
                                    </td>
                                    <?php if ($result > 0) { ?>
                                      <td style='text-align:center;'>
                                        <a href="#modal" data-toggle='modal' data-target='#show_data_neatnclean' data-id='<?php echo $tgl_report; ?>'>Lihat </a>
                                      </td>
                                    <?php }else if($result2 > 0){ ?>
                                      <td></td>
                                    <?php }else if($cek_hari != "Saturday" AND $cek_hari != "Sunday"){ ?>
                                      <td style='text-align:center;'><a href="#modal" data-toggle='modal' data-target='#add_data_neatnclean' data-id='<?php echo $tgl_report; ?>'>Insert</a></td>
                                    <?php }else{ ?>
                                      <td></td>
                                    <?php } ?>
                                  </tr>

                            <?php }} ?>
                          </tbody>
                        </table>
                      </div>
                  </div>
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <br>
              <form method="GET" action="" class="no-print">
                <div class="row">
                  <div class="col-lg-4 col-sm-2 col-xs-1 col-1"></div>
                  <div class="col-lg-2 col-sm-4 col-xs-5 col-5">
                    <div class="form-group">
                      <center><label for="Bulan">Dari</label></center>
                      <input type="date" class="form-control form-control-sm" name="tglawal" value="<?php echo $tglawal; ?>">
                    </div>
                  </div>
                  <div class="col-lg-2 col-sm-4 col-xs-5 col-5">
                    <div class="form-group">
                      <center><label for="Bulan">Sampai</label></center>
                      <input type="date" class="form-control form-control-sm" name="tglakhir" value="<?php echo $tglakhir; ?>">
                    </div>
                  </div>
                </div>
                <center>
                  <input type="hidden" name="pages" value="neatandclean">
                  <?php if(isset($_GET['bulan'])){ ?>
                    <input type="hidden" name="bulan" value="<?php echo $_GET['bulan'] ?>">
                    <input type="hidden" name="tahun" value="<?php echo $_GET['tahun'] ?>">
                  <?php } ?>
                  <input type="submit" class="btn btn-info btn-sm no-print" name="get_report_cleaning" value="Tampilkan Data">
                </center>
              </form>
              <br>
              <hr class="no-print">
              <center>
                <h5 style="margin-bottom: -6px;">LAPORAN GA - NEAT & CLEAN</h5>
                <small><?php echo date("d-m-Y", strtotime($tglawal))." s/d ".date("d-m-Y", strtotime($tglakhir)); ?></small>
              </center>

              <br>
              <div class="chart">
                <canvas id="barChartNeat" style="min-height: 250px; height: 350px; max-height: 350px; width: 1000px;"></canvas>
              </div>
              <br>
              
              <table class="table table-sm table-bordered table-responsive" style="font-size: 10px; margin-left: 10px; margin-right: 10px;">
                <thead>
                  <tr>
                    <th width="1%" style="vertical-align: middle;">No</th>
                    <th width="20%" style="vertical-align: middle;">
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </th>
                    <?php
                      while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
                    ?>
                      <th width="1%" style="vertical-align: middle; text-align: center; font-size: 6px"><?php echo $get_karyawan['nama']; ?></th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no=1;
                    $mulai = new DateTime($tglawal);
                    $akhir = new DateTime($tglakhir);

                    for($date = clone $mulai; $date <= $akhir; $date->modify('+1 day')){
                      $cek_tgl = $date->format('Y-m-d');
                      $get_neatnclean = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ga_neatnclean WHERE tanggal = '$cek_tgl'"));
                      if($get_neatnclean > 0){
                  ?>
                        <tr>
                          <td align="center"><?php echo $no; ?></td>
                          <td><?php echo $date->format('d-m-Y'); ?></td>
                          
                          <?php
                            $q_get_karyawan2 = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama != 'Erwansyah HMS' AND nama != 'Fadhli Aoliana' AND nama != 'Heriyanto Kurniawan' AND nama != 'M. Badrudin' AND nama != 'Sutisman' AND nama != 'Dadang Romansyah' AND nama != 'Asep Saepul' AND nama != 'Suhaedin' AND nama != 'Solahudin Pebriana' AND nama != 'Iman Maryadi' ORDER BY nama ASC");
                            while($get_karyawan2 = mysqli_fetch_array($q_get_karyawan2)){
                              $get_nilai_neatnclean = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ga_neatnclean WHERE nik = '$get_karyawan2[nik]' AND tanggal = '$cek_tgl'"));
                          ?>
                            <td align="center"><?php echo $get_nilai_neatnclean['nilai']; ?></td>
                          <?php } ?>

                        </tr>
                  <?php $no++; }} ?>

                  <tr>
                    <th colspan="2">TOTAL NILAI</th>
                    <?php
                      $q_get_karyawan3 = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama != 'Erwansyah HMS' AND nama != 'Fadhli Aoliana' AND nama != 'Heriyanto Kurniawan' AND nama != 'M. Badrudin' AND nama != 'Sutisman' AND nama != 'Dadang Romansyah' AND nama != 'Asep Saepul' AND nama != 'Suhaedin' AND nama != 'Solahudin Pebriana' AND nama != 'Iman Maryadi' ORDER BY nama ASC");
                      while($get_karyawan3 = mysqli_fetch_array($q_get_karyawan3)){
                        $get_nilai_neatnclean = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai) AS sum_nilai FROM ga_neatnclean WHERE nik = '$get_karyawan3[nik]' AND tanggal >= '$tglawal' AND tanggal <= '$tglakhir'"));
                    ?>
                      <th style="text-align: center;"><?php echo $get_nilai_neatnclean['sum_nilai']; ?></th>
                    <?php } ?>
                  </tr>
                  <tr>
                    <th colspan="2">RATA-RATA</th>
                    <?php
                      $q_get_karyawan3 = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama != 'Erwansyah HMS' AND nama != 'Fadhli Aoliana' AND nama != 'Heriyanto Kurniawan' AND nama != 'M. Badrudin' AND nama != 'Sutisman' AND nama != 'Dadang Romansyah' AND nama != 'Asep Saepul' AND nama != 'Suhaedin' AND nama != 'Solahudin Pebriana' AND nama != 'Iman Maryadi' ORDER BY nama ASC");
                      while($get_karyawan3 = mysqli_fetch_array($q_get_karyawan3)){
                        $get_nilai_neatnclean = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai) AS sum_nilai FROM ga_neatnclean WHERE nik = '$get_karyawan3[nik]' AND tanggal >= '$tglawal' AND tanggal <= '$tglakhir'"));
                    ?>
                      <th style="text-align: center;"><?php echo number_format($get_nilai_neatnclean['sum_nilai']/($no-1),2); ?></th>
                    <?php } ?>
                  </tr>

                </tbody>
              </table>

            </div>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.card-body -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Modal start here -->
<div class="modal fade" id="add_data_neatnclean" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Form Data Cleaning</h4> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="myForm" method="POST" action="">
          <div class="modal-data"></div>
          <center><input type="submit" class="btn btn-primary" name="submit_data_neatnclean" value="Submit"></center>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal start here -->
<div class="modal fade" id="show_data_neatnclean" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h4 class="modal-title">Data Neat & Clean</h4> -->
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

<div class="loading-overlay" id="loadingOverlay">
  <div class="loading-spinner"></div>
</div>