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

  if(isset($_GET['report_potongan']) AND $_GET['report_potongan'] == "Get Data"){
    $dari = $_GET['dari_tanggal'];
    $sampai = $_GET['sampai_tanggal'];
  }else{
    $dari = date("Y-m-01");
    $sampai = date("Y-m-t");
  }

?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Report Potongan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Potongan</li>
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
              <form action="index.php?pages=reportpotongan" method="GET" enctype="multipart/form-data">
                <div class="inner">
                  <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-3 col-sm-3 col-xs-3 col-3"></div>
                    <div class="col-lg-3 col-sm-3 col-xs-3 col-3">
                      <div class="form-group">
                        <center><label>Dari Tanggal</label></center>
                        <input type="date" name="dari_tanggal" class="form-control" value="<?php echo $dari; ?>" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-3 col-3">
                      <div class="form-group">
                        <center><label>Sampai Tanggal</label></center>
                        <input type="date" name="sampai_tanggal" class="form-control" value="<?php echo $sampai; ?>" required style="font-size: 12px;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="reportpotongan">
                        <input type="submit" class="btn btn-info btn-md" name="report_potongan" value="Get Data">
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
                <table class="table table-bordered table-hover table-sm" style="font-size: 11px;">
                  <thead>
                    <tr align="center">
                      <th width="1%">No</th>
                      <th>Nik</th>
                      <th>Nama</th>
                      <th width="10%">Potongan Terlambat</th>
                      <th width="10%">Potongan Kehadiran</th>
                      <th width="10%">Potongan Program</th>
                      <th width="10%">Potongan Grooming</th>
                      <th width="10%">Potongan Output</th>
                      <th width="10%">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY nama ASC");
                      while($getKaryawan = mysqli_fetch_array($q_getKaryawan)){
                        $no++;
                        $getPotongan = mysqli_fetch_array(mysqli_query($conn,"SELECT SUM(potongan_terlambat) AS PotonganTerlambat, SUM(potongan_absen) AS PotonganKehadiran, SUM(potongan_program) AS PotonganProgram, SUM(potongan_grooming) AS PotonganGrooming, SUM(potongan_output) AS PotonganOutput FROM potongan WHERE nik = '$getKaryawan[nik]' AND tanggal >= '$dari' AND tanggal <= '$sampai'"));
                    ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td><?php echo $no; ?></td>
                          <td><?php echo $getKaryawan['nik'] ?></td>
                          <td><?php echo $getKaryawan['nama'] ?></td>
                          <td align="center">
                            <?php echo "Rp ".number_format($getPotongan['PotonganTerlambat'],2,',','.'); ?>
                          </td>
                          <td align="center">
                            <?php echo "Rp ".number_format($getPotongan['PotonganKehadiran'],2,',','.'); ?>
                          </td>
                          <td align="center">
                            <?php echo "Rp ".number_format($getPotongan['PotonganProgram'],2,',','.'); ?>
                          </td>
                          <td align="center">
                            <?php echo "Rp ".number_format($getPotongan['PotonganGrooming'],2,',','.'); ?>
                          </td>
                          <td align="center">
                            <?php echo "Rp ".number_format($getPotongan['PotonganOutput'],2,',','.'); ?>
                          </td>
                          <td align="center">
                            <?php
                              $potonganTotal = $getPotongan['PotonganTerlambat'] + $getPotongan['PotonganKehadiran'] + $getPotongan['PotonganProgram'] + $getPotongan['PotonganGrooming'] + $getPotongan['PotonganOutput'];
                              echo "Rp ".number_format($potonganTotal,2,',','.'); 
                            ?>
                          </td>
                        </tr>
                        <tr class="expandable-body">
                          <td colspan="9">
                            <div class="card" style="background-color: #dee1ff; font-size: 10px;">
                              <table class="table table-sm">
                                <thead>
                                  <tr>
                                    <th width="3%">No</th>
                                    <th>Tanggal</th>
                                    <th width="6%">Terlambat</th>
                                    <th width="12%">Potongan Terlambat</th>
                                    <th width="12%">Potongan Kehadiran</th>
                                    <th width="12%">Potongan Program</th>
                                    <th width="12%">Potongan Grooming</th>
                                    <th width="12%">Potongan Output</th>
                                    <th width="12%">Total Potongan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $no_2 = 0;
                                    $t_terlambat = 0;
                                    $t_PotTerlambat = 0;
                                    $t_potoAbsen = 0;
                                    $t_potProgram = 0;
                                    $t_potGrooming = 0;
                                    $t_potOutput = 0;
                                    $t_potTotal = 0;

                                    $q_getPotongan = mysqli_query($conn,"SELECT * FROM potongan WHERE nik ='$getKaryawan[nik]' AND tanggal >= '$dari' AND tanggal <= '$sampai' ORDER BY tanggal ASC");
                                    while($potongan = mysqli_fetch_array($q_getPotongan)){
                                      $no_2++;
                                      $t_terlambat = $t_terlambat + $potongan['toleransi_bulanini'];
                                      $t_PotTerlambat = $t_PotTerlambat + $potongan['potongan_terlambat'];
                                      $t_potoAbsen = $t_potoAbsen + $potongan['potongan_absen'];
                                      $t_potProgram = $t_potProgram + $potongan['potongan_program'];
                                      $t_potGrooming = $t_potGrooming + $potongan['potongan_grooming'];
                                      $t_potOutput = $t_potOutput + $potongan['potongan_output'];
                                      $t_potTotal = $t_potTotal + $potongan['potongan_terlambat'] + $potongan['potongan_absen'] + $potongan['potongan_program'] + $potongan['potongan_grooming'] + $potongan['potongan_output'];
                                  ?>
                                    <tr>
                                      <td><?php echo $no_2; ?></td>
                                      <td><?php echo $potongan['tanggal']; ?></td>
                                      <td><?php echo $potongan['toleransi_bulanini']; ?></td>
                                      <td><?php echo "Rp ".number_format($potongan['potongan_terlambat'],2,',','.'); ?></td>
                                      <td><?php echo "Rp ".number_format($potongan['potongan_absen'],2,',','.'); ?></td>
                                      <td><?php echo "Rp ".number_format($potongan['potongan_program'],2,',','.'); ?></td>
                                      <td><?php echo "Rp ".number_format($potongan['potongan_grooming'],2,',','.'); ?></td>
                                      <td><?php echo "Rp ".number_format($potongan['potongan_output'],2,',','.'); ?></td>
                                      <td><b><?php 
                                        echo "Rp ".number_format($potongan['potongan_terlambat'] + $potongan['potongan_absen'] + $potongan['potongan_program'] + $potongan['potongan_grooming'] + $potongan['potongan_output'],2,',','.');
                                      ?></b></td>
                                    </tr>
                                  <?php } ?>
                                    <tr>
                                      <td colspan="2"><b>TOTAL</b></td>
                                      <td><b><?php echo $t_terlambat; ?></b></td>
                                      <td><b><?php echo "Rp ".number_format($t_PotTerlambat,2,',','.'); ?></b></td>
                                      <td><b><?php echo "Rp ".number_format($t_potoAbsen,2,',','.'); ?></b></td>
                                      <td><b><?php echo "Rp ".number_format($t_potProgram,2,',','.'); ?></b></td>
                                      <td><b><?php echo "Rp ".number_format($t_potGrooming,2,',','.'); ?></b></td>
                                      <td><b><?php echo "Rp ".number_format($t_potOutput,2,',','.'); ?></b></td>
                                      <td><b><?php echo "Rp ".number_format($t_potTotal,2,',','.'); ?></b></td>
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