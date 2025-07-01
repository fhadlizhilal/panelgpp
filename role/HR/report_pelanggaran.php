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
            <h1 class="m-0">Report Pelanggaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Pelanggaran</li>
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
              <form action="index.php?pages=reportpenilaian" method="GET" enctype="multipart/form-data">
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
                        <input type="hidden" name="pages" value="reportpelanggaran">
                        <input type="submit" class="btn btn-info btn-md" name="report_penilaian" value="Get Data">
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
                      <th width="1%" style="font-size: 8px;">Ringan</th>
                      <th width="5%" style="font-size: 8px;">Sedang</th>
                      <th width="5%" style="font-size: 8px;">Sedang Berat</th>
                      <th width="5%" style="font-size: 8px;">Berat</th>
                      <th width="5%" style="font-size: 8px;">Sangat Berat</th>
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
                        
                        if(isset($_GET['report_penilaian']) AND $_GET['report_penilaian'] == "Get Data"){
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

                        $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150103100159' AND nik != '12150211080696' ORDER BY nama ASC");
                        while($getKaryawan = mysqli_fetch_array($q_getKaryawan)){
                          $getPelanggaran_List = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM pelanggaran_list WHERE id = "));
                      ?>
                      <tr data-widget="expandable-table" aria-expanded="false">
                        <td style="font-size: 10px;"><?php echo date("d M Y",strtotime($tgl_awal)); ?></td>
                        <td style="font-size: 10px;"><?php echo date("d M Y",strtotime($tgl_akhir)); ?></td>
                        <td style="font-size: 10px;"><?php echo $getKaryawan['nik']; ?></td>
                        <td style="font-size: 10px;"><?php echo $getKaryawan['nama']; ?></td>
                        <td style="font-size: 10px;" align="center"><?php echo $harikerja." Hari"; ?></td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            echo $ringan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'RINGAN'"))." Kali";
                          ?>
                        </td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            echo $sedang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'SEDANG'"))." Kali";
                          ?>
                        </td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            echo $sedangberat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'SEDANG BERAT'"))." Kali";
                          ?>
                        </td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            echo $berat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'BERAT'"))." Kali";
                          ?>
                        </td>
                        <td style="font-size: 10px;" align="center">
                          <?php
                            echo $sangatberat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'SANGAT BERAT'"))." Kali";
                          ?>
                        </td>
                      </tr>
                      <tr class="expandable-body">
                        <td colspan="10">
                          <div class="card" style="background-color: #dee1ff; font-size: 10px;">
                            <table class="table table-sm">
                              <thead>
                                <tr>
                                  <th width="3%">No</th>
                                  <th width="8%">Tanggal</th>
                                  <th>Pelanggaran</th>
                                  <th width="5%"><center>Ringan</center></th>
                                  <th width="5%"><center>Sedang</center></th>
                                  <th width="5%"><center>Sedang Berat</center></th>
                                  <th width="5%"><center>Berat</center></th>
                                  <th width="5%"><center>Sangat Berat</center></th>
                                  <th width="12%"><center>Keterangan</center></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $no_2 = 0;

                                  $q_get_pelanggaran = mysqli_query($conn,"SELECT * FROM v_pelanggaran WHERE nik ='$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir'");
                                  while($get_pelanggaran = mysqli_fetch_array($q_get_pelanggaran)){
                                    $no_2++;
                                ?>
                                  <tr>
                                    <td><?php echo $no_2; ?></td>
                                    <td><?php echo $get_pelanggaran['tanggal']; ?></td>
                                    <td><?php echo $get_pelanggaran['nama_pelanggaran']; ?></td>
                                    <td>
                                      <?php 
                                        if($get_pelanggaran['status_pelanggaran'] == "RINGAN"){ 
                                          echo "<center><i class='fa fa-check' aria-hidden='true'></i></center>"; } 
                                      ?>    
                                    </td>
                                    <td>
                                      <?php 
                                        if($get_pelanggaran['status_pelanggaran'] == "SEDANG"){ 
                                          echo "<center><i class='fa fa-check' aria-hidden='true'></i></center>"; } 
                                      ?>    
                                    </td>
                                    <td>
                                      <?php 
                                        if($get_pelanggaran['status_pelanggaran'] == "SEDANG BERAT"){ 
                                          echo "<center><i class='fa fa-check' aria-hidden='true'></i></center>"; } 
                                      ?>    
                                    </td>
                                    <td>
                                      <?php 
                                        if($get_pelanggaran['status_pelanggaran'] == "BERAT"){ 
                                          echo "<center><i class='fa fa-check' aria-hidden='true'></i></center>"; } 
                                      ?>    
                                    </td>
                                    <td>
                                      <?php 
                                        if($get_pelanggaran['status_pelanggaran'] == "SANGAT BERAT"){ 
                                          echo "<center><i class='fa fa-check' aria-hidden='true'></i></center>"; } 
                                      ?>    
                                    </td>
                                    <td><?php echo $get_pelanggaran['keterangan']; ?></td>
                                  </tr>
                                <?php } ?>
                                  <tr>
                                    <td colspan="3"><center><b>JUMLAH</b></center></td>
                                    <td>
                                      <center><b><?php echo $jml_pel = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik ='$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'RINGAN'")); ?></b></center>
                                    </td>
                                    <td>
                                      <center><b><?php echo $jml_pel = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik ='$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'SEDANG'")); ?></b></center>
                                    </td>
                                    <td>
                                      <center><b><?php echo $jml_pel = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik ='$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'SEDANG BERAT'")); ?></b></center>
                                    </td>
                                    <td>
                                      <center><b><?php echo $jml_pel = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik ='$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'BERAT'")); ?></b></center>
                                    </td>
                                    <td>
                                      <center><b><?php echo $jml_pel = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik ='$getKaryawan[nik]' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' AND status_pelanggaran = 'SANGAT BERAT'")); ?></b></center>
                                    </td>
                                    <td><b></b></td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
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