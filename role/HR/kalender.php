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

  function hari_indo($tanggal){
    $hari = array ( 1 =>    'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        );

    $num = date('N', strtotime($tanggal));
    return $hari[$num];
  }
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kalender</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kalender</li>
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
              <form method="GET" action="index.php?pages=dailyreport">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-4 col-sm-2 col-xs-2 col-2"></div>
                    <div class="col-lg-2 col-sm-4 col-xs-4 col-4">
                      <div class="form-group">
                        <center><label for="Bulan">Bulan</label></center>
                        <select class="form-control" name="bulan">
                          <option value="1" <?php if(Date('m') == "01"){ echo "selected" ; } ?> >Januari</option>
                          <option value="2" <?php if(Date('m') == "02"){ echo "selected" ; } ?> >Februari</option>
                          <option value="3" <?php if(Date('m') == "03"){ echo "selected" ; } ?> >Maret</option>
                          <option value="4" <?php if(Date('m') == "04"){ echo "selected" ; } ?> >April</option>
                          <option value="5" <?php if(Date('m') == "05"){ echo "selected" ; } ?> >Mei</option>
                          <option value="6" <?php if(Date('m') == "06"){ echo "selected" ; } ?> >Juni</option>
                          <option value="7" <?php if(Date('m') == "07"){ echo "selected" ; } ?> >Juli</option>
                          <option value="8" <?php if(Date('m') == "08"){ echo "selected" ; } ?> >Agustus</option>
                          <option value="9" <?php if(Date('m') == "09"){ echo "selected" ; } ?> >September</option>
                          <option value="10" <?php if(Date('m') == "10"){ echo "selected" ; } ?> >Oktober</option>
                          <option value="11" <?php if(Date('m') == "11"){ echo "selected" ; } ?> >November</option>
                          <option value="12" <?php if(Date('m') == "12"){ echo "selected" ; } ?> >Desember</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-xs-4 col-4">
                      <div class="form-group">
                        <center><label for="Bulan">Tahun</label></center>
                        <select class="form-control" name="tahun">
                          <option value="2022" <?php if(Date('Y') == "2022"){ echo "selected" ; } ?> >2022</option>
                          <option value="2023" <?php if(Date('Y') == "2023"){ echo "selected" ; } ?> >2023</option>
                          <option value="2024" <?php if(Date('Y') == "2024"){ echo "selected" ; } ?> >2024</option>
                          <option value="2025" <?php if(Date('Y') == "2025"){ echo "selected" ; } ?> >2025</option>
                          <option value="2026" <?php if(Date('Y') == "2026"){ echo "selected" ; } ?> >2026</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="calender">
                        <input type="submit" name="getKalender" class="btn btn-primary" value="Get Data">
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
                              <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap table-sm" style="font-size: 12px;">
                                  <thead>
                                    <tr align="center">
                                      <th width="1%">No</th>
                                      <th width="5%">Hari</th>
                                      <th width="5%">Tanggal</th>
                                      <th width="15%">Data Absen Masuk</th>
                                      <th width="15%">Data Absen Pulang</th>
                                      <th width="15%">Data Penilaian Harian</th>
                                      <th width="20%">Keterangan</th>
                                    </tr>
                                  </thead>
                                  <tbody align="center">
                                    <?php if (!isset($_GET['bulan']) OR !isset($_GET['tahun'])){ ?>
                                      <tr>
                                        <td colspan="7" style="text-align: center;"><i><small>silahkan pilih bulan dan tahun terlebih dahulu</small></i></td>
                                      </tr>
                                    <?php 
                                      }else{
                                        $no = 0;
                                        $jml_hari = cal_days_in_month(CAL_GREGORIAN, $_GET['bulan'], $_GET['tahun']);
                                        for($i=1;$i<=$jml_hari;$i++){
                                          $no = $no + 1;
                                          $tgl = date('Y-m-d', strtotime($_GET['tahun']."-".$_GET['bulan']."-".$i));
                                          $hari = date('l', strtotime($tgl));
                                          $cek_libur = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM harilibur WHERE tanggal = '$tgl'"));
                                    ?>
                                          <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                              <?php
                                                if($hari == "Saturday" OR $hari == "Sunday" OR $cek_libur > 0){
                                                  echo "<div style='color:red'>".hari_indo($tgl)."</div>"; 
                                                }else{
                                                  echo hari_indo($tgl); 
                                                }
                                              ?> 
                                            </td>
                                            <td>
                                              <?php
                                                if($hari == "Saturday" OR $hari == "Sunday" OR $cek_libur > 0){
                                                  echo "<div style='color:red'>".tanggal_indo($tgl)."</div>"; 
                                                }else{
                                                  echo tanggal_indo($tgl);
                                                }
                                              ?>
                                            </td>
                                            <td>
                                              <?php
                                                $cekAbsenMasuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE tanggal = '$tgl'"));
                                                if($hari == "Saturday" OR $hari == "Sunday"){
                                                  echo "<div class='badge badge-secondary'>Weekend</div>";
                                                }elseif($cek_libur > 0){
                                                  echo "<div class='badge badge-info'>Hari Libur</div>";
                                                }elseif($cekAbsenMasuk > 0){
                                                  echo "<div class='badge badge-success'>Data Absen Sudah Ada</div>";
                                                }else{
                                                  echo "<div class='badge badge-danger'>Data Absen Belum Ada</div>";
                                                }
                                              ?>
                                            </td>
                                            <td>
                                              <?php
                                                $cekAbsenPulang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE tanggal = '$tgl'"));
                                                if($hari == "Saturday" OR $hari == "Sunday"){
                                                  echo "<div class='badge badge-secondary'>Weekend</div>";
                                                }elseif($cek_libur > 0){
                                                  echo "<div class='badge badge-info'>Hari Libur</div>";
                                                }elseif($cekAbsenPulang > 0){
                                                  echo "<div class='badge badge-success'>Data Absen Sudah Ada</div>";
                                                }else{
                                                  echo "<div class='badge badge-danger'>Data Absen Belum Ada</div>";
                                                }
                                              ?>
                                            </td>
                                            <td>
                                              <?php
                                                $cekPenilaian = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE tanggal = '$tgl'"));
                                                if($hari == "Saturday" OR $hari == "Sunday"){
                                                  echo "<div class='badge badge-secondary'>Weekend</div>";
                                                }elseif($cek_libur > 0){
                                                  echo "<div class='badge badge-info'>Hari Libur</div>";
                                                }elseif($cekPenilaian > 0){
                                                  echo "<div class='badge badge-success'>Data Penilaian Sudah Ada</div>";
                                                }else{
                                                  echo "<div class='badge badge-danger'>Data Penilaian Belum Ada</div>";
                                                }
                                              ?>
                                            </td>
                                            <td>
                                              <?php
                                                $getHariLibur = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM harilibur WHERE tanggal = '$tgl'"));
                                                if($cek_libur > 0){
                                                  echo $getHariLibur['keterangan'];
                                                }
                                              ?>
                                            </td>
                                          </tr>
                                    <?php 
                                        }
                                      }
                                    ?>
                                  </tbody>
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