<?php
  require_once "../../dev/config.php";
  $today = date("dd-mm-yyyy H:i:s");

  if(isset($_GET['tanggal_pulang']) && isset($_GET['jam_pulang'])){
    $_SESSION['tanggal_pulang_set'] = date("d-m-Y", strtotime($_GET['tanggal_pulang']));
    $_SESSION['jam_pulang_set'] = $_GET['jam_pulang'];
  }

  //Set tanggal dan Jam Absen Pulang
  if(isset($_GET['set_absen_pulang'])){
    if($_GET['set_absen_pulang'] == "SET"){
      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY jabatan_id ASC");
      mysqli_query($conn, "TRUNCATE TABLE absen_pulang_tmp");
      while($getKaryawan = mysqli_fetch_array($q_getKaryawan)){
        $tanggal_pulang = date("Y-m-d", strtotime($_SESSION['tanggal_pulang_set']));
        $nik = $getKaryawan["nik"];
        $jam = "";
        $status = "";
        $fingerprint = "";
        
        $getAbsenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik' AND tanggal = '$tanggal_pulang'"));
        if($getAbsenMasuk["jam"] == "-"){ 
          $jam = "-";
          $status = "-";
          $fingerprint = "-";
        }

        mysqli_query($conn, "INSERT INTO absen_pulang_tmp VALUES ('','$nik','$jam','$status','$fingerprint','')");
      }
    }
  }

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
            <h1 class="m-0">Form Absen Pulang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Absen Pulang</li>
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
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <br>
              <form action="index.php?pages=form_absen_masuk" method="POST" enctype="multipart/form-data">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10 col-sm-10 col-xs-10 col-10">
                      <div class="form-group">
                        <center><label>Upload File XLS</label></center>
                        <input type="file" name="namafile" maxlength="255" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12" style="padding-bottom: 15px;">
                      <center>
                        <input type="submit" class="btn btn-success btn-md" name="upload_pulang" value="Upload">
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
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <br>
              <form method="GET" action="index.php?pages=form_absen_pulang">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5 col-sm-5 col-xs-5 col-5">
                      <div class="form-group">
                        <center><label>Tanggal</label></center>
                        <input type="date" name="tanggal_pulang" maxlength="255" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-5 col-sm-5 col-xs-5 col-5">
                      <div class="form-group">
                        <center><label>Jam Pulang</label></center>
                        <input type="time" name="jam_pulang" maxlength="255" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                  </div>
                  <div class="row" style="padding-bottom: 15px;">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="form_absen_pulang">
                        <input type="submit" class="btn btn-info btn-md" onclick="return confirm('Yakin ganti tanggal pulang?')" name="set_absen_pulang" value="SET">
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
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <div class="inner">
                <div class="row">
                  <div class="col-lg-12 col-sm-12 col-xs-12 col-12">
                    <div class="form-group">
                      <center><label>Summary</label></center>
                      <table width="100%" style=" font-size: 12px; margin-bottom: -3px;">
                        <tr>
                          <td width="35%">Tanggal Absen</td>
                          <td width="3%">:</td>
                          <td><b><?php echo tanggal_indo($_SESSION['tanggal_pulang_set'], TRUE); ?></b></td>
                        </tr>
                        <tr>
                          <td>Jam Pulang</td>
                          <td>:</td>
                          <td><b><?php echo $_SESSION['jam_pulang_set']; ?></b></td>
                        </tr>
                        <tr>
                          <td>Jml Karyawan</td>
                          <td>:</td>
                          <td>
                            <b><?php echo $count_karyawan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159'")); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td>Jml Data</td>
                          <td>:</td>
                          <td>
                            <?php
                              $count_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang_tmp WHERE jam != '' AND status != '' AND fingerprint != ''"));
                              echo "<b>".$count_data."</b> ";
                              if($count_karyawan != $count_data){
                                  $data_absen_pulang = "belum lengkap";
                                  echo "<small class='badge badge-danger'>belum lengkap</small";
                                }else{
                                  $data_absen_pulang = "lengkap";
                                  echo "<small class='badge badge-success'>lengkap</small";
                                }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Cek Tanggal</td>
                          <td>:</td>
                          <td>
                            <?php
                              $tgl_pulang = date("Y-m-d", strtotime($_SESSION['tanggal_pulang_set']));
                              $cek_AbsenMasuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE tanggal = '$tgl_pulang'"));

                              if($cek_AbsenMasuk < 1){
                                $cek_tanggal = "belum ada";
                                echo "<span class='badge badge-danger'>data absen masuk tidak ditemukan!</span>";
                              }else{
                                $cek_tanggal = "sudah ada";
                                echo "<span class='badge badge-success'>data absen masuk ditemukan!</span>";
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td>
                            <?php
                              $tgl_pulang = date("Y-m-d", strtotime($_SESSION['tanggal_pulang_set']));
                              $cek_AbsenPulang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE tanggal = '$tgl_pulang'"));

                              if($cek_AbsenPulang < 1){
                                echo "<span class='badge badge-success'>data absen pulang belum ada</span>";
                              }else{
                                echo "<span class='badge badge-danger'>data absen pulang sudah ada!</span>";
                              }
                              
                            ?>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card"><!-- 
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="formabsen2" class="table table-bordered table-sm table-hover" width="100%" style="font-size: 12px;">
                  <thead>
                  <tr style="text-align: center;">
                    <th width="5%">NIK</th>
                    <th width="15%">Nama Karyawan</th>
                    <th width="6%">Jam Pulang</th>
                    <th width="5%">Status</th>
                    <th width="5%">Fingerprint</th>
                    <th width="5%">Cepat</th>
                    <th width="15%">Keterangan</th>
                    <th width="1%">#</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($cek_AbsenMasuk > 0){
                      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY jabatan_id ASC");
                      while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                        $get_absenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$get_karyawan[nik]' AND tanggal = '$tgl_pulang'"));
                        $get_absenPulangTmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_pulang_tmp WHERE nik = '$get_karyawan[nik]'"));
                    ?>
                      <tr>
                        <td style="font-size: 10px;"><?php echo $get_karyawan['nik']; ?></td>
                        <td style="font-size: 10px;"><?php echo $get_karyawan['nama']; ?></td>
                        <td style="font-size: 10px; text-align: center;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_jam_pulang' data-id='<?php echo $get_absenPulangTmp['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Jam Pulang">
                            <?php
                              if($get_absenPulangTmp['jam'] == "-"){
                                echo "<div class='badge badge-secondary'>".$get_absenMasuk['status']."</div>";
                              }elseif($get_absenPulangTmp['jam'] == ""){
                                echo "-";
                              }else{
                                echo $get_absenPulangTmp['jam'];
                              }
                            ?>
                          </a> 
                        </td>
                        <td style="font-size: 11px; text-align: center;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_status_pulang' data-id='<?php echo $get_absenPulangTmp['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Status Pulang">
                            <?php
                              if($get_absenPulangTmp['jam'] == "-"){
                                echo "<div class='badge badge-secondary'>".$get_absenMasuk['status']."</div>";
                              }elseif($get_absenPulangTmp['jam'] == "" OR $get_absenPulangTmp['status'] == ""){
                                echo "-";
                              }elseif($get_absenPulangTmp['status'] == "Pulang"){
                                echo "<div class='badge badge-success'>".$get_absenPulangTmp['status']."</div>";
                              }else{
                                echo "<div class='badge badge-warning'>".$get_absenPulangTmp['status']."</div>";
                              }
                            ?>
                          </a>
                        </td>
                        <td style="font-size: 11px; text-align: center;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_fingerprint_pulang' data-id='<?php echo $get_absenPulangTmp['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Fingerprint Pulang">
                            <?php
                              if($get_absenPulangTmp['jam'] == "-"){
                                echo "<div class='badge badge-secondary'>".$get_absenMasuk['status']."</div>";
                              }elseif($get_absenPulangTmp['jam'] == "" OR $get_absenPulangTmp['fingerprint'] == ""){
                                echo "-";
                              }elseif($get_absenPulangTmp['fingerprint'] == "Ya"){
                                echo "<div class='badge badge-success'>&nbsp;".$get_absenPulangTmp['fingerprint']."&nbsp;</div>";
                              }else{
                                echo "<div class='badge badge-warning'>&nbsp;".$get_absenPulangTmp['fingerprint']."&nbsp;</div>";
                              }
                            ?>
                          </a>
                        </td>
                        <td style="font-size: 10px; text-align: center;">
                          <?php 
                            $jam_kantor = strtotime($_SESSION['tanggal_pulang_set']." ".$_SESSION['jam_pulang_set']);
                            $jam_karyawan = strtotime($_SESSION['tanggal_pulang_set']." ".$get_absenPulangTmp['jam']);
                            $diff = $jam_kantor - $jam_karyawan;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - ( $jam * (60 * 60) );
                            $detik = $diff % 60;
                            $cepat = 0;

                            if($jam_karyawan < $jam_kantor AND $get_absenPulangTmp['jam'] != "" AND $get_absenPulangTmp['jam'] != "-"){
                              $cepat = ($jam*60)+floor( $menit / 60 );
                              echo "<div style='color:red;'> ".$cepat." menit </div>";
                            }else{
                              echo $cepat." menit";
                            }
                          ?>
                        </td>
                        <td style="font-size: 10px;"><?php echo $get_absenPulangTmp['keterangan']; ?></td>
                        <td>
                          <?php
                            if($get_absenPulangTmp['jam'] != "" AND $get_absenPulangTmp['status'] != "" AND $get_absenPulangTmp['fingerprint'] != ""){
                              echo "<div style='background-color:green;'>&nbsp;</div>";
                            }else{
                              echo "<div style='background-color:red;'>&nbsp;</div>";
                            }
                          ?>
                        </td>
                      </tr>
                    <?php
                       } 
                      }else{
                    ?>
                      <tr>
                        <td colspan="8" align="center" style="color: red;">Data Absen Masuk di Hari ini tidak ditemukan !</td>
                      </tr>

                    <?php } ?>
                  </tbody>
                </table>
                <br>
                <form action="index.php?pages=form_absen_pulang" method="POST">
                  <input type="hidden" name="tgl_absen" value="<?php echo date("Y-m-d", strtotime($_SESSION['tanggal_pulang_set'])); ?>">
                  <input type="hidden" name="jam_absen" value="<?php echo $_SESSION['jam_pulang_set']; ?>">
                  <input type="hidden" name="data_absen_pulang" value="<?php echo $data_absen_pulang; ?>">
                  <input type="hidden" name="cek_tanggal" value="<?php echo $cek_tanggal; ?>">
                  <input type="hidden" name="cek_AbsenPulang" value="<?php echo $cek_AbsenPulang; ?>">
                  <center><input type="submit" class="btn btn-primary" onclick="return confirm('Yakin data absen pulang sudah benar?')" name="submit_absen_pulang" value="Submit"></center>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
    </section>

  </div>

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_status_pulang" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Status Pulang</h4>
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
  <div class="modal fade" id="show_edit_jam_pulang" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Jam Pulang</h4>
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
  <div class="modal fade" id="show_edit_fingerprint_pulang" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Fingerprint Pulang</h4>
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