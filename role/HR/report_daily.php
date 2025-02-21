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
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Report Daily</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Daily</li>
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
              <form method="GET" action="index.php?pages=report_daily">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-2 col-sm-2 col-xs-2 col-2"></div>
                    <div class="col-lg-2 col-sm-2 col-xs-2 col-2">
                      <div class="form-group">
                        <center><label>Dari Tanggal</label></center>
                        <input type="date" name="tanggal_awal" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-xs-2 col-2">
                      <div class="form-group">
                        <center><label>Sampai Tanggal</label></center>
                        <input type="date" name="tanggal_akhir" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-4 col-4">
                      <div class="form-group">
                        <center><label>Karyawan</label></center>
                        <select class="form-control" name="karyawan" required style="font-size: 12px;">
                            <option value="all_karyawan" selected>Semua Karyawan</option>
                            <option value="_karyawan" disabled>----- Karyawan -----</option>
                            <?php 
                            $q_karyawan = mysqli_query($conn, "SELECT * from karyawan");
                            while($get_karyawan = mysqli_fetch_array($q_karyawan)){
                          ?>
                            <option value="<?php echo $get_karyawan['nik']; ?>"><?php echo $get_karyawan['nama']; ?></option>
                          <?php } ?>
                            <option value="_jabatan" disabled>----- Jabatan -----</option>
                          <?php 
                            $q_jabatan = mysqli_query($conn, "SELECT * from jabatan");
                            while($get_jabatan = mysqli_fetch_array($q_jabatan)){
                          ?>
                            <option value="<?php echo $get_jabatan['id']; ?>"><?php echo $get_jabatan['jabatan']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="report_daily">
                        <input type="submit" class="btn btn-info btn-md" value="Get Report">
                        <?php if(isset($_GET['karyawan']) AND isset($_GET['tanggal_awal']) AND isset($_GET['tanggal_akhir'])){ ?>
                          <a href="../all_role/download_dailyreport.php?tanggal_awal=<?php echo $_GET['tanggal_awal'] ?>&tanggal_akhir=<?php echo $_GET['tanggal_akhir'] ?>&karyawan=<?php echo $_GET['karyawan'] ?>&download=1" target="_blank" class="btn btn-success btn-md">Download Report</a>
                        <?php } ?>
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
        <div class="card"><!-- 
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-sm" width="100%" style="font-size: 12px;">
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
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
    </section>

  </div>