<?php
  require_once "../../dev/config.php";
  $today = date("dd-mm-yyyy H:i:s");

?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Chart Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Chart Karyawan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card">
              <div class="card-body">
                <form action="index.php?pages=reportkaryawan" method="GET" enctype="multipart/form-data">
                  <div class="inner">
                    <div class="row">
                      <div class="col-lg-3 col-sm-3 col-xs-3 col-3"></div>
                      <div class="col-lg-3 col-sm-3 col-xs-3 col-3">
                        <div class="form-group">
                          <center><label>Karyawan</label></center>
                          <select class="form-control" name="nik" required style="font-size: 12px;">
                            <option value="" selected disabled>--------- Pilih Karyawan ---------</option>
                            <?php
                              $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY nama ASC");
                              while($getKaryawan = mysqli_fetch_array($q_getKaryawan)){
                            ?>
                              <option value="<?php echo $getKaryawan["nik"] ?>"><?php echo $getKaryawan["nama"]." - ".$getKaryawan["nik"]; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-3 col-xs-3 col-3">
                        <div class="form-group">
                          <center><label>Tahun</label></center>
                          <select class="form-control" name="tahun" required style="font-size: 12px;">
                            <option value="2022" <?php if(date('Y')=='2022'){ echo 'selected';} ?>>2022</option>
                            <option value="2023" <?php if(date('Y')=='2023'){ echo 'selected';} ?>>2023</option>
                            <option value="2024" <?php if(date('Y')=='2024'){ echo 'selected';} ?>>2024</option>
                            <option value="2025" <?php if(date('Y')=='2025'){ echo 'selected';} ?>>2025</option>
                            <option value="2026" <?php if(date('Y')=='2026'){ echo 'selected';} ?>>2026</option>
                            <option value="2027" <?php if(date('Y')=='2027'){ echo 'selected';} ?>>2027</option>
                            <option value="2028" <?php if(date('Y')=='2028'){ echo 'selected';} ?>>2028</option>
                            <option value="2029" <?php if(date('Y')=='2029'){ echo 'selected';} ?>>2029</option>
                            <option value="2030" <?php if(date('Y')=='2030'){ echo 'selected';} ?>>2030</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <center>
                          <input type="hidden" name="pages" value="reportkaryawan">
                          <input type="submit" class="btn btn-info btn-md" name="report_karyawan" value="Get Data">
                        </center>
                      </div>                  
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
        <?php if(!isset($_GET['report_karyawan'])){ ?>
          <center><h3>CHART DATA SELURUH KARYAWAN<br>TAHUN <?php echo date("Y"); ?></h3></center>
          <br>
            <div class="row">
              <div class="col-md-6">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Chart Absen Karyawan <?php echo date('Y'); ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Chart Penilaian Harian <?php echo date('Y'); ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartPenilaian" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="card card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Chart Pelanggaran <?php echo date('Y'); ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartPelanggaran" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card card-warning">
                  <div class="card-header">
                    <h3 class="card-title">Chart 10 Terlambat Tahun <?php echo date('Y'); ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChart10Terlambat" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Chart Nilai Absensi Tahun <?php echo date('Y'); ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartAbsensiKaryawan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Chart Nilai Penilaiah Harian Tahun <?php echo date('Y'); ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartPenilaianHarianKaryawan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card card-warning">
                  <div class="card-header">
                    <h3 class="card-title">Chart Nilai Evaluasi Tahun <?php echo date('Y'); ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartEvaluasiKaryawan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Chart Nilai Pelanggaran Tahun <?php echo date('Y'); ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartNilaiPelanggaranKaryawan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Chart Report Nilai Karyawan Tahun <?php echo date('Y'); ?></h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartReportNilaiKaryawan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        <?php }else{ ?>

            <div class="card">
              <div class="card-body">
                <center><b>CHART REPORT DATA KARYAWAN</b></center>
                <br>
                <div class="row">
                  <div class="col-12">
                    <table width="100%" class="table table-sm" style="font-size: 12px;">
                      <tr>
                        <td width="15%"><b>NIK</b></td>
                        <td width="1%">:</td>
                        <td widtd=""><?php echo $_GET['nik']; ?></td>
                      </tr>
                      <tr>
                        <td width="15%"><b>Nama</b></td>
                        <td width="1%">:</td>
                        <td widtd="">
                          <?php 
                            $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[nik]'")); 
                            echo $get_karyawan["nama"];
                          ?>  
                        </td>
                      </tr>
                      <tr>
                        <td width="15%"><b>Jabatan</b></td>
                        <td width="1%">:</td>
                        <td widtd="">
                          <?php 
                            $get_jabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jabatan WHERE id = '$get_karyawan[jabatan_id]'")); 
                            echo $get_jabatan["jabatan"];
                          ?>  
                        </td>
                      </tr>
                      <tr>
                        <td width="15%"><b>Tahun</b></td>
                        <td width="1%">:</td>
                        <td widtd="">
                          <?php  
                            echo $_GET['tahun'];
                          ?>  
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Chart Absen</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChart_absenKaryawan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card card-success">
                  <div class="card-header">
                    <h3 class="card-title">Chart Penilaian Harian</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChart_penilaianKaryawan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="card card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Chart Pelanggaran</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChartPelanggaranKaryawan" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card card-warning">
                  <div class="card-header">
                    <h3 class="card-title">Chart Penilaian Evaluasi</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart">
                      <canvas id="barChart_penilaianEvaluasi" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        <?php } ?>

      </div>
    </section>
  </div>