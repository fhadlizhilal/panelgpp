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
    $tgl_indo = $split[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[2];
    
    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
  }

?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Report Absen</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Absen</li>
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
            <div class="small-box" style="background-color: white;">
              <br>
              <form action="index.php?pages=history_absen" method="GET" enctype="multipart/form-data">
                <div class="inner">
                  <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-3 col-sm-3 col-xs-3 col-3"></div>
                    <div class="col-lg-3 col-sm-3 col-xs-3 col-3">
                      <div class="form-group">
                        <center><label>Dari Tanggal</label></center>
                        <input type="date" name="dari_tanggal" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-3 col-3">
                      <div class="form-group">
                        <center><label>Sampai Tanggal</label></center>
                        <input type="date" name="sampai_tanggal" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="reportabsen">
                        <input type="submit" class="btn btn-info btn-md" name="report_absen" value="Get Data">
                      </center>
                    </div>                  
                  </div>
                </div>
              </form>
              <br>
            </div>
          </div>
        </div>
        <div class="card"><!-- 
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">

                <table id="dbabsen1" class="table table-bordered table-sm table-striped" width="100%" style="font-size: 10px;">
                    <thead>
                    <tr style="text-align: center;">
                      <th width="8%">Dari</th>
                      <th width="8%">Sampai</th>
                      <th width="15%">NIK</th>
                      <th width="">Nama Karyawan</th>
                      <th width="5%">Hari Kerja</th>
                      <th width="5%">Masuk</th>
                      <th width="5%">Cuti/ Sakit SKD</th>
                      <th width="5%">Tidak Masuk</th>
                      <th width="5%" style="font-size: 9px;">Ter lambat</th>
                      <th width="5%" style="font-size: 9px;">Pulang Cepat</th>
                      <th width="5%">Terlambat & Pulang Cepat [t]</th>
                      <th width="5%">Persentase Kehadiran</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $harikerja = 0;
                        $bulanini = date('m');
                        $tahunini = date('Y');
                        $tgl_awal = date('Y')."-".date('m')."-01";
                        $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulanini, $tahunini);
                        $tgl_akhir = date('Y')."-".date('m')."-".$jumHari;
                        
                        if(isset($_GET['report_absen']) AND $_GET['report_absen'] == "Get Data"){
                          $tgl_awal = $_GET['dari_tanggal'];
                          $tgl_akhir = $_GET['sampai_tanggal'];

                          $jarak = strtotime($tgl_akhir) - strtotime($tgl_awal);
                          $jumHari = ($jarak / 60 / 60 / 24) + 1;
                        }

                        $tgl = $tgl_awal;

                        for($i=1;$i<=$jumHari;$i++){
                          $hari = date("l", strtotime($tgl));
                          $cekharilibur = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM harilibur WHERE tanggal = '$tgl'"));

                          if($hari != "Saturday" AND $hari != "Sunday" AND $cekharilibur < 1){
                            $harikerja = $harikerja + 1;
                          }

                          $tgl = date('Y-m-d', strtotime('+1 days', strtotime($tgl)));
                        }

                        $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY jabatan_id ASC");
                        while($getKaryawan = mysqli_fetch_array($q_getKaryawan)){
                      ?>
                      <tr>
                        <td style="font-size: 10px;"><?php echo date("d M Y",strtotime($tgl_awal)); ?></td>
                        <td style="font-size: 10px;"><?php echo date("d M Y",strtotime($tgl_akhir)); ?></td>
                        <td style="font-size: 10px;"><?php echo $getKaryawan['nik']; ?></td>
                        <td style="font-size: 10px;"><?php echo $getKaryawan['nama']; ?></td>
                        <td style="font-size: 10px;" align="center"><?php echo $harikerja." Hari"; ?></td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            echo $masuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND (status = 'Masuk' OR status = 'Tugas Kantor' OR status = 'Terlambat' OR status = 'Izin Terlambat' OR status = 'Izin Masuk Siang' OR status = 'Pulang Tugas Kantor')"))." Hari";
                          ?>
                        </td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            echo $cuti_sakit = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND (status = 'Sakit - Dengan SKD' OR status = 'Cuti - Tahunan' OR status = 'Cuti - Menikah' OR status = 'Cuti - Melahirkan' OR status = 'Cuti - Ibadah')"))." Hari";
                          ?>
                        </td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            echo $tidak_masuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND (status = 'Izin Tidak Masuk' OR status = 'Sakit - Tanpa SKD' OR status = 'Tanpa Keterangan')"))." Hari";
                          ?>
                        </td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            $c_terlambat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND terlambat > 0"));

                            echo $c_terlambat." Hari";
                          ?>
                        </td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            $c_cepat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND cepat > 0"));

                            echo $c_cepat." Hari";
                          ?>
                        </td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            $sumTerlambat = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(terlambat) AS sumTerlambat FROM absen_masuk WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir'"));

                            $sumCepat = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(cepat) AS sumCepat FROM absen_pulang WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir'"));

                            if($sumTerlambat['sumTerlambat'] < 1){
                              $sumTerlambat['sumTerlambat'] = 0;
                            }

                            if($sumCepat['sumCepat'] < 1){
                              $sumCepat['sumCepat'] = 0;
                            }
                            $TelatCepat = ($sumTerlambat['sumTerlambat'] + $sumCepat['sumCepat']);
                            echo $TelatCepat." Menit";
                          ?>
                        </td>
                        <td style="font-size: 12px;" align="center">
                          <?php
                            $getSetting = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM setting"));

                            $point_terlambat = ($TelatCepat)/60/8;
                            $persentase = ($masuk + $cuti_sakit - $point_terlambat)/$harikerja;

                            if($persentase*100 < 70){
                              echo "<span class='badge bg-danger'>".number_format($persentase*100, 2)."%</span>";
                            }elseif($persentase*100 < 80){
                              echo "<span class='badge bg-warning'>".number_format($persentase*100, 2)."%</span>";
                            }else{
                              echo "<span class='badge bg-success'>".number_format($persentase*100, 2)."%</span>";
                            }
                            
                          ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
    </section>

  </div>