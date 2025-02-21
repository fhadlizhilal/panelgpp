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
            <h1 class="m-0">DB Potongan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DB Potongan</li>
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
              <form action="index.php?pages=dbpotongan" method="GET" enctype="multipart/form-data">
                <div class="inner">
                  <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-1 col-sm-1 col-xs-1 col-1"></div>
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
                    <div class="col-lg-4 col-sm-6 col-xs-6 col-6">
                      <div class="form-group">
                        <center><label>Karyawan</label></center>
                        <select class="form-control" name="karyawan" required style="font-size: 12px;">
                          <option value="" selected disabled>--------- Pilih Karyawan ---------</option>
                          <?php
                            $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan ORDER BY nama ASC");
                            while($getKaryawan = mysqli_fetch_array($q_getKaryawan)){
                          ?>
                            <option value="<?php echo $getKaryawan["nik"] ?>"><?php echo $getKaryawan["nik"]." - ".$getKaryawan["nama"]; ?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="dbpotongan">
                        <input type="submit" class="btn btn-info btn-md" name="report_potongan_karyawan" value="Get Data">
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
                <?php
                  if(isset($_GET['report_absen_tanggal'])){
                    if($_GET['report_absen_tanggal'] == "Get Data"){
                ?>
                  <table id="formabsen1" class="table table-bordered table-sm table-striped" width="100%" style="font-size: 12px;">
                    <thead>
                    <tr style="text-align: center;">
                      <th width="6%">Tgl Absen</th>
                      <th width="2%">NIK</th>
                      <th width="12%">Nama Karyawan</th>
                      <th width="6%">Jam Tiba</th>
                      <th width="6%">Jam Masuk</th>
                      <th width="8%">Status</th>
                      <th width="2%">Fingerprint</th>
                      <th width="2%">Terlambat</th>
                      <th width="15%">Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY jabatan_id ASC");
                        while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                          $getAbsen = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$get_karyawan[nik]' AND tanggal = '$_GET[tanggal_absen]'"));
                      ?>
                        <tr>
                          <td style="font-size: 10px;"><?php echo date("d-m-Y", strtotime($_GET['tanggal_absen'])); ?></td>
                          <td style="font-size: 10px;"><?php echo $get_karyawan['nik']; ?></td>
                          <td style="font-size: 10px;"><?php echo $get_karyawan['nama']; ?></td>
                          <td style="font-size: 10px; text-align: center;"><?php echo $getAbsen['jam']; ?></td>
                          <td style="font-size: 10px; text-align: center;"><?php echo $getAbsen['jam_masuk']; ?></td>
                          <td style="font-size: 10px; text-align: center;"><?php echo $getAbsen["status"]; ?></td>
                          <td style="font-size: 10px; text-align: center;"><?php echo $getAbsen['fingerprint']; ?></td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              $jam_kantor = strtotime($_SESSION['tanggal_masuk_set']." ".$_SESSION['jam_masuk_set']);
                              $jam_karyawan = strtotime($_SESSION['tanggal_masuk_set']." ".$getAbsen['jam']);
                              $diff = $jam_karyawan - $jam_kantor;
                              $jam   = floor($diff / (60 * 60));
                              $menit = $diff - ( $jam * (60 * 60) );
                              $detik = $diff % 60;
                              $terlambat = 0;

                              if($jam_karyawan > $jam_kantor){
                                $terlambat = ($jam*60)+floor( $menit / 60 );
                                echo "<div style=color:red>".$terlambat." menit</div>";
                              }else{
                                echo $terlambat." menit";
                              }
                            ?> 
                          </td>
                          <td style="font-size: 10px;"><?php echo $getAbsen['keterangan']; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                  <!----------------------------- REPORT ABSEN KARYAWAN ----------------------------------->

                <?php
                    }
                  }elseif(isset($_GET['report_potongan_karyawan'])){
                    if($_GET['report_potongan_karyawan'] == "Get Data"){
                ?>
                  <table id="example1" class="table table-bordered table-sm table-striped" width="100%" style="font-size: 10px;">
                    <thead>
                    <tr style="text-align: center;">
                      <th width="6%">Tanggal</th>
                      <th width="">NIK</th>
                      <th width="">Nama Karyawan</th>
                      <th width="2%">Terlambat</th>
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
                        $q_getPotongan = mysqli_query($conn, "SELECT * FROM potongan WHERE nik = '$_GET[karyawan]' AND tanggal BETWEEN '$_GET[dari_tanggal]' AND '$_GET[sampai_tanggal]' ORDER BY tanggal DESC");
                        while($getPotongan = mysqli_fetch_array($q_getPotongan)){
                          $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getPotongan[nik]'"));
                          $getAbsenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getPotongan[nik]' AND tanggal = '$getPotongan[tanggal]'"));
                      ?>
                        <tr>
                          <td style="font-size: 10px;"><?php echo date("d-m-Y", strtotime($getPotongan['tanggal'])); ?></td>
                          <td style="font-size: 10px;"><?php echo $getPotongan['nik']; ?></td>
                          <td style="font-size: 10px;"><?php echo $getKaryawan['nama']; ?></td>
                          <td style="font-size: 10px; text-align: center;"><?php echo $getPotongan['toleransi_bulanini']." Menit"; ?></td>
                          <td style="font-size: 10px; text-align: center;"><?php echo "Rp ".number_format($getPotongan['potongan_terlambat'],2,',','.'); ?></td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              echo "Rp ".number_format($getPotongan['potongan_absen'],2,',','.');
                            ?>
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              echo "Rp ".number_format($getPotongan['potongan_program'],2,',','.');
                            ?>
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              echo "Rp ".number_format($getPotongan['potongan_grooming'],2,',','.');
                            ?>
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              echo "Rp ".number_format($getPotongan['potongan_output'],2,',','.');
                            ?>
                          </td>
                          <td style="font-size: 10px; text-align: center; font-weight: bold;">
                            <?php
                              $totalPotongan = $getPotongan['potongan_terlambat'] + $getPotongan['potongan_absen'] + $getPotongan['potongan_program'] + $getPotongan['potongan_grooming'] + $getPotongan['potongan_output'];
                              echo "Rp ".number_format($totalPotongan,0,',','.');
                            ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                <?php 
                    }
                  }else{
                ?>

                    <table id="example1" class="table table-bordered table-sm table-striped" width="100%" style="font-size: 10px;">
                    <thead>
                    <tr style="text-align: center;">
                      <th width="6%">Tanggal</th>
                      <th width="">NIK</th>
                      <th width="">Nama Karyawan</th>
                      <th width="2%">Terlambat</th>
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
                        $q_getPotongan = mysqli_query($conn, "SELECT * FROM potongan ORDER BY tanggal ASC");
                        while($getPotongan = mysqli_fetch_array($q_getPotongan)){
                          $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getPotongan[nik]'"));
                          $getAbsenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getPotongan[nik]' AND tanggal = '$getPotongan[tanggal]'"));
                      ?>
                        <tr>
                          <td style="font-size: 10px;"><?php echo date("d-m-Y", strtotime($getPotongan['tanggal'])); ?></td>
                          <td style="font-size: 10px;"><?php echo $getPotongan['nik']; ?></td>
                          <td style="font-size: 10px;"><?php echo $getKaryawan['nama']; ?></td>
                          <td style="font-size: 10px; text-align: center;"><?php echo $getPotongan['toleransi_bulanini']." Menit"; ?></td>
                          <td style="font-size: 10px; text-align: center;"><?php echo "Rp ".number_format($getPotongan['potongan_terlambat'],2,',','.'); ?></td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              echo "Rp ".number_format($getPotongan['potongan_absen'],2,',','.');
                            ?>
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              echo "Rp ".number_format($getPotongan['potongan_program'],2,',','.');
                            ?>
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              echo "Rp ".number_format($getPotongan['potongan_grooming'],2,',','.');
                            ?>
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              echo "Rp ".number_format($getPotongan['potongan_output'],2,',','.');
                            ?>
                          </td>
                          <td style="font-size: 10px; text-align: center; font-weight: bold;">
                            <?php
                              $totalPotongan = $getPotongan['potongan_terlambat'] + $getPotongan['potongan_absen'] + $getPotongan['potongan_program'] + $getPotongan['potongan_grooming'] + $getPotongan['potongan_output'];
                              echo "Rp ".number_format($totalPotongan,0,',','.');
                            ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                <?php
                  } 
                ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
    </section>

  </div>

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_jam_absen_masuk" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Jam Absen</h4>
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
  <div class="modal fade" id="show_edit_status" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Status</h4>
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
  <div class="modal fade" id="show_edit_fingerprint" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Fingerprint</h4>
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
  <div class="modal fade" id="show_edit_keterangan_absen" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Keterangan</h4>
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