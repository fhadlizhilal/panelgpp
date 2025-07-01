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
            <h1 class="m-0">Form Absen Masuk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Absen Masuk</li>
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
                    <div class="col-12">
                      <center>
                        <input type="submit" class="btn btn-success btn-md" name="upload" value="Upload">
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
              <form method="POST" action="index.php?pages=form_absen_masuk">
                <div class="inner">
                  <div class="row">
                    <div class="col-1"></div>
                    <div class="col-lg-5 col-sm-5 col-xs-5 col-5">
                      <div class="form-group">
                        <center><label>Set Tanggal</label></center>
                        <input type="date" name="tanggal_masuk" maxlength="255" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-5 col-sm-5 col-xs-5 col-5">
                      <div class="form-group">
                        <center><label>Set Jam Masuk</label></center>
                        <input type="time" name="jam_masuk" maxlength="255" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="submit" class="btn btn-info btn-md" name="set_absen_masuk" value="SET">
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
                  <div class="col-lg-1"></div>
                  <div class="col-lg-10 col-sm-10 col-xs-10 col-10">
                    <div class="form-group">
                      <center><label>Summary</label></center>
                      <table width="100%" style=" font-size: 12px;">
                        <tr>
                          <td width="40%">Tanggal Absen</td>
                          <td width="3%">:</td>
                          <td><b>
                            <?php
                              $tgl = date("Y-m-d",strtotime($_SESSION['tanggal_masuk_set']));
                              $hari = date('l', strtotime($_SESSION['tanggal_masuk_set']));
                              $cekLibur = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM harilibur WHERE tanggal = '$tgl'"));
                              if($hari == "Saturday" OR $hari == "Sunday" OR $cekLibur > 0){
                                $hari_libur = "ya";
                                echo "<div style='color:red'>".tanggal_indo($_SESSION['tanggal_masuk_set'], TRUE)."</div>";
                              }else{
                                $hari_libur = "tidak";
                                echo tanggal_indo($_SESSION['tanggal_masuk_set'], TRUE);
                              } 
                            ?>    
                          </b></td>
                        </tr>
                        <tr>
                          <td>Jam Masuk</td>
                          <td>:</td>
                          <td><b><?php echo $_SESSION['jam_masuk_set']; ?></b></td>
                        </tr>
                        <tr>
                          <td>Jml Karyawan</td>
                          <td>:</td>
                          <td><b><?php echo $count_karyawan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC")); ?></b></td>
                        </tr>
                        <tr>
                          <td>Jml Data</td>
                          <td>:</td>
                          <td>
                            <?php
                              //count field
                              $jml_data = 0;
                              $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");
                              while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                                $getTmpAbsen = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk_tmp WHERE nik = '$get_karyawan[nik]'"));
                                if($getTmpAbsen['jam'] != "-" AND $getTmpAbsen['status'] != "-" AND $getTmpAbsen['fingerprint'] != "-"){
                                  $jml_data = $jml_data + 1;
                                }elseif($getTmpAbsen['jam'] == "-" AND $getTmpAbsen['status'] != "-" AND $getTmpAbsen['fingerprint'] == "-"){
                                  $jml_data = $jml_data + 1;
                                }
                              }
                                echo "<b>".$jml_data."</b> ";
                                if($count_karyawan != $jml_data){
                                  $data_absen = "belum lengkap";
                                  echo "<small class='badge badge-danger'>belum lengkap</small";
                                }else{
                                  $data_absen = "lengkap";
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
                              $tgl_masuk = date("Y-m-d", strtotime($_SESSION['tanggal_masuk_set']));
                              $cek_db = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE tanggal = '$tgl_masuk'"));

                              if($cek_db < 1){
                                $cek_tanggal = "belum ada";
                                echo "<span class='badge badge-success'>data belum ada</span>";
                              }else{
                                $cek_tanggal = "sudah ada";
                                echo "<span class='badge badge-danger'>data sudah ada</span>";
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
                    <th width="6%">Jam Masuk</th>
                    <th width="5%">Status</th>
                    <th width="5%">Fingerprint</th>
                    <th width="5%">Terlambat</th>
                    <th width="15%">Keterangan</th>
                    <th width="1%">#</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");
                      while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                        $getTmpAbsen = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk_tmp WHERE nik = '$get_karyawan[nik]'"));
                    ?>
                      <tr>
                        <td style="font-size: 10px;"><?php echo $get_karyawan['nik']; ?></td>
                        <td style="font-size: 10px;"><?php echo $get_karyawan['nama']; ?></td>
                        <td style="font-size: 10px; text-align: center;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_jam_absen_masuk' data-id='<?php echo $getTmpAbsen['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Jam Masuk">
                            <?php echo $getTmpAbsen['jam']; ?>
                          </a>
                        </td>
                        <td style="font-size: 12px; text-align: center;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_status' data-id='<?php echo $getTmpAbsen['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Status">
                            <?php 
                              if($getTmpAbsen['status'] == "Masuk"){
                                echo "<div class='badge badge-success'> ".$getTmpAbsen['status']." </div>";
                              }elseif($getTmpAbsen['status'] == "-"){
                                echo "<div> ".$getTmpAbsen['status']." </div>";
                              }elseif($getTmpAbsen['status'] == "Terlambat" || $getTmpAbsen['status'] == "Izin Terlambat" || $getTmpAbsen['status'] == "Izin Masuk Siang" || $getTmpAbsen['status'] == "Pulang Tugas Kantor"){
                                echo "<div class='badge badge-info'> ".$getTmpAbsen['status']." </div>";
                              }elseif($getTmpAbsen['status'] == "Tugas Kantor" || $getTmpAbsen['status'] == "Izin Tidak Masuk" || $getTmpAbsen['status'] == "Sakit - Dengan SKD" || $getTmpAbsen['status'] == "Sakit - Tanpa SKD" || $getTmpAbsen['status'] == "Cuti - Tahunan" || $getTmpAbsen['status'] == "Cuti - Menikah" || $getTmpAbsen['status'] == "Cuti - Melahirkan" || $getTmpAbsen['status'] == "Cuti - Ibadah"){
                                echo "<div class='badge badge-warning'> ".$getTmpAbsen['status']." </div>";
                              }elseif($getTmpAbsen['status'] == "Tanpa Keterangan"){
                                echo "<div class='badge badge-danger'> ".$getTmpAbsen['status']." </div>";
                              }
                            ?>
                          </a>
                        </td>
                        <td style="font-size: 12px; text-align: center;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_fingerprint' data-id='<?php echo $getTmpAbsen['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Fingerprint">
                            <?php 
                              if($getTmpAbsen['fingerprint'] == "Ya"){
                                echo "<div class='badge badge-success'> &nbsp;".$getTmpAbsen['fingerprint']."&nbsp; </div>";
                              }elseif($getTmpAbsen['fingerprint'] == "Lupa/Tidak"){
                                echo "<div class='badge badge-warning'> ".$getTmpAbsen['fingerprint']." </div>";
                              }else{
                                echo "<div> ".$getTmpAbsen['fingerprint']." </div>";
                              } 
                            ?>
                          </a>
                        </td>
                        <td style="font-size: 10px; text-align: center;">
                          <?php
                            $jam_kantor = strtotime($_SESSION['tanggal_masuk_set']." ".$_SESSION['jam_masuk_set']);
                            $jam_karyawan = strtotime($_SESSION['tanggal_masuk_set']." ".$getTmpAbsen['jam']);
                            $diff = $jam_karyawan - $jam_kantor;
                            $jam   = floor($diff / (60 * 60));
                            $menit = $diff - ( $jam * (60 * 60) );
                            $detik = $diff % 60;
                            $terlambat = 0;

                            if($jam_karyawan > $jam_kantor){
                              $terlambat = ($jam*60)+floor( $menit / 60 );
                              echo "<div style='color:red;'> ".$terlambat." menit </div>";
                            }else{
                              echo $terlambat." menit";
                            }
                          ?> 
                        </td>
                        <td style="font-size: 10px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_keterangan_absen' data-id='<?php echo $getTmpAbsen['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Keterangan">
                            <?php
                              if($getTmpAbsen['keterangan'] == "-"){
                                echo "<div style='text-align:center;'>".$getTmpAbsen['keterangan']."</div>";
                              }else{
                                echo "<div style='text-align:left;'>".$getTmpAbsen['keterangan']."</div>";
                              }
                            ?>
                          </a>
                        </td>
                        <td>
                          <?php
                            if($getTmpAbsen['jam'] != "-" AND $getTmpAbsen['status'] != "-" AND $getTmpAbsen['fingerprint'] != "-"){
                              echo "<div style='background-color:green;'>&nbsp;</div>";
                            }elseif($getTmpAbsen['jam'] == "-" AND $getTmpAbsen['status'] != "-" AND $getTmpAbsen['fingerprint'] == "-"){
                              echo "<div style='background-color:green;'>&nbsp;</div>";
                            }else{
                              echo "<div style='background-color:red;'>&nbsp;</div>";
                            }
                          ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <br>
                <form action="index.php?pages=form_absen_masuk" method="POST">
                  <input type="hidden" name="tgl_absen" value="<?php echo date("Y-m-d", strtotime($_SESSION['tanggal_masuk_set'])); ?>">
                  <input type="hidden" name="jam_absen" value="<?php echo $_SESSION['jam_masuk_set']; ?>">
                  <input type="hidden" name="data_absen" value="<?php echo $data_absen; ?>">
                  <input type="hidden" name="cek_tanggal" value="<?php echo $cek_tanggal; ?>">
                  <input type="hidden" name="hari_libur" value="<?php echo $hari_libur; ?>">
                  <center><input type="submit" class="btn btn-primary" onclick="return confirm('Yakin data absen sudah benar?')" name="submit_absen_masuk" value="Submit"></center>
                </form>
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