<?php
  require_once "../../dev/config.php";
  $today = date("dd-mm-yyyy H:i:s");

  if(isset($_GET['tanggal_penilaian'])){
    $_SESSION['tanggal_penilaian'] = date("d-m-Y", strtotime($_GET['tanggal_penilaian']));
  }

  //Set tanggal dan Jam Absen Pulang
  if(isset($_GET['set_penilaian'])){
    $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150103100159' AND nik != '12150211080696' ORDER BY jabatan_id ASC");
    $jmlDataAbsenMasuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE tanggal = '$_GET[tanggal_penilaian]'"));
    mysqli_query($conn, "TRUNCATE TABLE penilaian_harian_tmp");
    
    if($jmlDataAbsenMasuk > 0){
      while($getKaryawan = mysqli_fetch_array($q_getKaryawan)){
        $nik = $getKaryawan["nik"];
        $program = "Ya";
        $seragam = "Ya";
        $nametag = "Ya";
        
        $getAbsenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik' AND tanggal = '$_GET[tanggal_penilaian]'"));
        
        if($getAbsenMasuk["jam"] == "-"){
          $program = "-";
          $seragam = "-";
          $nametag = "-";
        }

        if($getAbsenMasuk["terlambat"] > 0){
          $program = "";
        }

        mysqli_query($conn, "INSERT INTO penilaian_harian_tmp VALUES ('','$nik','$program','$seragam','$nametag')");
      }
    }
  }

  $tgl_penilaian = date("Y-m-d", strtotime($_SESSION['tanggal_penilaian']));

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
            <h1 class="m-0">Form Penilaian Harian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penilaian Harian</li>
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
          <div class="col-lg-2 col-2"></div>
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <br>
              <form method="GET" action="index.php?pages=form_penilaian_harian">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10 col-sm-10 col-xs-10 col-10">
                      <div class="form-group">
                        <center><label>Tanggal</label></center>
                        <input type="date" name="tanggal_penilaian" maxlength="255" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="form_penilaian_harian">
                        <input type="submit" class="btn btn-info btn-md" onclick="return confirm('Yakin ganti tanggal penilaian?')" name="set_penilaian" value="SET">
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
            <div class="small-box" style="background-color: white; padding-bottom: 3px;">
              <div class="inner">
                <div class="row">
                  <div class="col-lg-12 col-sm-12 col-xs-12 col-12">
                    <div class="form-group">
                      <center><label>Summary</label></center>
                      <table width="100%" style=" font-size: 12px;">
                        <tr>
                          <td width="40%">Tanggal Absen</td>
                          <td width="3%">:</td>
                          <td><b><?php echo tanggal_indo($_SESSION['tanggal_penilaian'], TRUE); ?></b></td>
                        </tr>
                        <tr>
                          <td>Jml Karyawan</td>
                          <td>:</td>
                          <td>
                            <b><?php echo $count_karyawan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150103100159' AND nik != '12150211080696'")); ?></b>
                          </td>
                        </tr>
                        <tr>
                          <td>Jml Data</td>
                          <td>:</td>
                          <td>
                            <?php
                              $count_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian_tmp WHERE program != '' AND seragam != '' AND nametag != ''"));
                              echo "<b>".$count_data."</b> ";
                              if($count_karyawan != $count_data){
                                  $data_penilaian = "belum lengkap";
                                  echo "<small class='badge badge-danger'>belum lengkap</small";
                                }else{
                                  $data_penilaian = "lengkap";
                                  echo "<small class='badge badge-success'>lengkap</small";
                                }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Data Absen Masuk</td>
                          <td>:</td>
                          <td>
                            <?php
                              $cek_AbsenMasuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE tanggal = '$tgl_penilaian'"));
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
                          <td>Cek Data Penilaian</td>
                          <td>:</td>
                          <td>
                            <?php
                              $cek_dataPenilaian = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE tanggal = '$tgl_penilaian'"));

                              if($cek_dataPenilaian < 1){
                                echo "<span class='badge badge-success'>data penilaian belum ada</span>";
                              }else{
                                echo "<span class='badge badge-danger'>data penilaian sudah ada!</span>";
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
                    <th width="1%">Terlambat</th>
                    <th width="5%">Program</th>
                    <th width="5%">Seragam</th>
                    <th width="5%">Nametag</th>
                    <th width="1%">#</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($cek_AbsenMasuk > 0){
                      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150103100159' AND nik != '12150211080696' ORDER BY nama ASC");
                      while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                        $get_absenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$get_karyawan[nik]' AND tanggal = '$tgl_penilaian'"));
                        $get_penilaianTmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM penilaian_harian_tmp WHERE nik = '$get_karyawan[nik]'"));
                    ?>
                      <tr>
                        <td style="font-size: 10px;"><?php echo $get_karyawan['nik']; ?></td>
                        <td style="font-size: 10px;"><?php echo $get_karyawan['nama']; ?></td>
                        <td style="font-size: 10px; text-align: center;">
                          <?php
                            if($get_absenMasuk['terlambat'] > 0){
                              echo "<div style='color:red'>".$get_absenMasuk['terlambat']." Menit </div>";
                            }else{
                              echo $get_absenMasuk['terlambat']." Menit";
                            }
                          ?>
                        </td>
                        <td style="font-size: 12px; text-align: center;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_program' data-id='<?php echo $get_penilaianTmp['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Program">
                            <?php
                              if($get_penilaianTmp['program'] == "-"){
                                echo "<div class='badge badge-secondary'>".$get_absenMasuk['status']."</div>";
                              }elseif($get_penilaianTmp['program'] == ""){
                                echo "-";
                              }else{
                                if($get_penilaianTmp['program'] == "Ya"){
                                  echo "<div class='badge badge-success'>&nbsp;".$get_penilaianTmp['program']."&nbsp;</div>";
                                }else{
                                  echo "<div class='badge badge-danger'>&nbsp;".$get_penilaianTmp['program']."&nbsp;</div>";
                                }
                              }
                            ?>
                          </a> 
                        </td>
                        <td style="font-size: 12px; text-align: center;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_seragam' data-id='<?php echo $get_penilaianTmp['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Seragam">
                            <?php
                              if($get_penilaianTmp['seragam'] == "-"){
                                echo "<div class='badge badge-secondary'>".$get_absenMasuk['status']."</div>";
                              }elseif($get_penilaianTmp['seragam'] == ""){
                                echo "-";
                              }else{
                                if($get_penilaianTmp['seragam'] == "Ya"){
                                  echo "<div class='badge badge-success'>&nbsp;".$get_penilaianTmp['seragam']."&nbsp;</div>";
                                }else{
                                  echo "<div class='badge badge-danger'>&nbsp;".$get_penilaianTmp['seragam']."&nbsp;</div>";
                                }
                              }
                            ?>
                          </a>
                        </td>
                        <td style="font-size: 12px; text-align: center;"> 
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_nametag' data-id='<?php echo $get_penilaianTmp['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Nametag">
                            <?php
                              if($get_penilaianTmp['nametag'] == "-"){
                                echo "<div class='badge badge-secondary'>".$get_absenMasuk['status']."</div>";
                              }elseif($get_penilaianTmp['nametag'] == ""){
                                echo "-";
                              }else{
                                if($get_penilaianTmp['nametag'] == "Ya"){
                                  echo "<div class='badge badge-success'>&nbsp;".$get_penilaianTmp['nametag']."&nbsp;</div>";
                                }else{
                                  echo "<div class='badge badge-danger'>&nbsp;".$get_penilaianTmp['nametag']."&nbsp;</div>";
                                }
                              }
                            ?>
                          </a>
                        </td>
                        <td>
                          <?php
                            if($get_penilaianTmp['program'] != "" AND $get_penilaianTmp['seragam'] != "" AND $get_penilaianTmp['nametag'] != ""){
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
                <form action="index.php?pages=form_penilaian_harian" method="POST">
                  <input type="hidden" name="tgl_penilaian" value="<?php echo $tgl_penilaian; ?>">
                  <input type="hidden" name="data_penilaian" value="<?php echo $data_penilaian; ?>">
                  <input type="hidden" name="cek_absen_masuk" value="<?php echo $cek_tanggal; ?>">
                  <input type="hidden" name="cek_tgl_penilaian" value="<?php echo $cek_dataPenilaian; ?>">
                  <center><input type="submit" class="btn btn-primary" onclick="return confirm('Yakin data penilaian sudah benar?')" name="submit_penilaian" value="Submit"></center>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
    </section>

  </div>

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_program" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Program</h4>
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
  <div class="modal fade" id="show_edit_seragam" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Seragam</h4>
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
  <div class="modal fade" id="show_edit_nametag" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Nametag</h4>
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