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
            <h1 class="m-0">Form Evaluasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Evaluasi</li>
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
              <form method="GET" action="index.php?pages=form_evaluasi">
                <div class="inner">
                  <div class="row">
                    <div class="col-2"></div>
                    <div class="col-lg-2 col-sm-2 col-xs-2 col-2">
                      <div class="form-group">
                        <center><label>Tanggal Evaluasi</label></center>
                        <input type="date" name="tanggal_penilaian" maxlength="255" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-xs-2 col-2">
                      <div class="form-group">
                        <center><label>Karyawan</label></center>
                        <select class="form-control" name="nik_karyawan" style="font-size: 11px;" required>
                          <option value="" selected disabled>----- Pilih Karyawan -----</option>
                          <?php
                            $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150103100159' AND nik != '12150211080696' ORDER BY nama ASC");
                            while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                          ?>
                            <option value="<?php echo $get_karyawan['nik']; ?>"><?php echo $get_karyawan['nama']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-xs-2 col-2">
                      <div class="form-group">
                        <center><label>Periode Penilaian</label></center>
                        <select class="form-control" name="semester" style="font-size: 11px;" required>
                          <option value="" selected disabled>Pilih Periode Penilaian</option>
                          <option value="3 Bulan (Training)">3 Bulan (Training)</option>
                          <option value="6 bulan (Training) + Semester 1">6 bulan (Training)</option>
                          <option value="2">Semester 2 (1 Tahun)</option>
                          <option value="3">Semester 3 (1 Tahun 6 bulan)</option>
                          <option value="4">Semester 4 (2 Tahun)</option>
                          <option value="5">Semester 5 (2 Tahun 6 bulan)</option>
                          <option value="6">Semester 6 (3 Tahun)</option>
                          <option value="7">Semester 7 (3 Tahun 6 bulan)</option>
                          <option value="8">Semester 8 (4 Tahun)</option>
                          <option value="9">Semester 9 (4 Tahun 6 bulan)</option>
                          <option value="10">Semester 10 (5 Tahun)</option>
                          <option value="11">Semester 11 (5 Tahun 6 bulan)</option>
                          <option value="12">Semester 12 (6 Tahun)</option>
                          <option value="13">Semester 13 (6 Tahun 6 bulan)</option>
                          <option value="14">Semester 14 (7 Tahun)</option>
                          <option value="15">Semester 15 (7 Tahun 6 bulan)</option>
                          <option value="16">Semester 16 (8 Tahun)</option>
                          <option value="17">Semester 17 (8 Tahun 6 bulan)</option>
                          <option value="18">Semester 18 (9 Tahun)</option>
                          <option value="19">Semester 19 (9 Tahun 6 bulan)</option>
                          <option value="20">Semester 20 (10 Tahun)</option>
                          <option value="21">Semester 21 (10 Tahun 6 bulan)</option>
                          <option value="22">Semester 22 (11 Tahun)</option>
                          <option value="23">Semester 23 (11 Tahun 6 bulan)</option>
                          <option value="24">Semester 24 (12 Tahun)</option>
                          <option value="25">Semester 25 (12 Tahun 6 bulan)</option>
                          <option value="26">Semester 26 (13 Tahun)</option>
                          <option value="27">Semester 27 (13 Tahun 6 bulan)</option>
                          <option value="28">Semester 28 (14 Tahun)</option>
                          <option value="29">Semester 29 (14 Tahun 6 bulan)</option>
                          <option value="30">Semester 30 (15 Tahun)</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-xs-2 col-2">
                      <div class="form-group">
                        <center><label>Jabatan</label></center>
                        <select class="form-control" name="jabatan" style="font-size: 11px;" required>
                          <option value="" selected disabled>---- Pilih Jabatan ----</option>
                          <option value="Magang">Magang</option>
                          <option value="Kontrak">Kontrak</option>
                          <option value="Staff">Staff</option>
                          <option value="Fungsional">Fungsional</option>
                          <option value="Manager">Manager</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="form_evaluasi">
                        <input type="submit" class="btn btn-info btn-md" name="form_evaluasi" value="Open Form">
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

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <div class="card">
                <div class="card-body">
                  <br>
                  <!-- ------------------------------------------- MAGANG -------------------------------------------- -->
                  <?php
                    if(isset($_GET['form_evaluasi']) AND $_GET['form_evaluasi'] == "Open Form"){
                      if($_GET['jabatan']=="Magang"){
                        $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[nik_karyawan]'"));
                        $getJabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jabatan WHERE id = '$getKaryawan[jabatan_id]'"));
                  ?>
                        <center><b>FORMULIR PENILAIAN PRESTASI KERJA</b></center>
                        <br>
                        <div class="row">
                          <div class="col-6">
                            <table width="100%" class="table table-sm" style="font-size: 12px;">
                              <tr>
                                <td width="30%"><b>Nomor</b></td>
                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    function getRomawi($bln){
                                      switch ($bln){
                                        case 1:
                                            return "I";
                                            break;
                                        case 2:
                                            return "II";
                                            break;
                                        case 3:
                                            return "III";
                                            break;
                                        case 4:
                                            return "IV";
                                            break;
                                        case 5:
                                            return "V";
                                            break;
                                        case 6:
                                            return "VI";
                                            break;
                                        case 7:
                                            return "VII";
                                            break;
                                        case 8:
                                            return "VIII";
                                            break;
                                        case 9:
                                            return "IX";
                                            break;
                                        case 10:
                                            return "X";
                                            break;
                                        case 11:
                                            return "XI";
                                            break;
                                        case 12:
                                            return "XII";
                                            break;
                                      }
                                    }

                                    $bln = date("m", strtotime($_GET['tanggal_penilaian']));
                                    $get_nomor = mysqli_fetch_array(mysqli_query($conn, "SELECT max(id) AS id_max FROM evaluasi"));
                                    $nomor_incr = ($get_nomor['id_max'])+1;
                                    if($nomor_incr < 10){
                                      $nomor_incr = "00".$nomor_incr;
                                    }elseif($nomor_incr < 100){
                                      $nomor_incr = "0".$nomor_incr;
                                    } 

                                    $nomor_fppk = $nomor_incr."/SK-HR/FPPK/".getRomawi($bln)."/".date("Y", strtotime($_GET['tanggal_penilaian']));
                                    echo $nomor_fppk;
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Nama</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $getKaryawan['nama']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>NIK</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $_GET['nik_karyawan']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Jabatan</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo "<b>[".$_GET['jabatan']."]</b> - ".$getJabatan['jabatan']; ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-6">
                            <table width="100%" class="table table-sm" style="font-size: 12px;">
                              <tr>
                                <td width="30%"><b>Tanggal Evaluasi</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo date("d M Y", strtotime($_GET['tanggal_penilaian'])); ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Divisi<b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $getJabatan['jabatan']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Masa Kerja</b></td>
                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    $date1 = date_create($getKaryawan['tgl_masuk']); 
                                    $date2 = date_create($_GET['tanggal_penilaian']); 
                                     
                                    $interval = date_diff($date1, $date2); 
                                     
                                    echo $masa_kerja = "" . $interval->y . " Tahun, " . $interval->m." Bulan, ".$interval->d." Hari";
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Periode Penilaian</b></td>

                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    if($_GET['semester'] != "3 Bulan (Training)" AND $_GET['semester'] != "6 bulan (Training) + Semester 1"){
                                      $dari = date('Y-m-d', strtotime('+'.(6*($_GET['semester']-1)).' month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+'.(6*$_GET['semester']).' month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo "Semester ".$_GET['semester']." <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }elseif($_GET['semester'] == "3 Bulan (Training)"){
                                      $dari = date('Y-m-d', strtotime('+0 month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }elseif($_GET['semester'] == "6 bulan (Training) + Semester 1"){
                                      $dari = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+6 month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }
                                  ?>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <form method="POST" action="index.php?pages=dbevaluasi">
                            <input type="hidden" name="nomor_fppk" value="<?php echo $nomor_fppk; ?>">
                            <input type="hidden" name="nik_karyawan" value="<?php echo $_GET['nik_karyawan']; ?>">
                            <input type="hidden" name="tgl_evaluasi" value="<?php echo $_GET['tanggal_penilaian']; ?>">
                            <input type="hidden" name="divisi" value="<?php echo $getJabatan['jabatan'];  ?>">
                            <input type="hidden" name="masa_kerja" value="<?php echo $masa_kerja; ?>">
                            <input type="hidden" name="semester" value="<?php echo $_GET['semester']; ?>">
                            <input type="hidden" name="penilaian_dari" value="<?php echo $dari; ?>">
                            <input type="hidden" name="penilaian_sampai" value="<?php echo $sampai; ?>">
                            <input type="hidden" name="jabatan" value="<?php echo $_GET['jabatan']; ?>">

                            <table class="table table-sm table-striped" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th>Aspek Penilaian</th>
                                  <th width="2%">Nilai Point</th>
                                  <th width="8%">Dirut</th>
                                  <th width="8%">Dirop</th>
                                  <th width="8%">Manager/ Leader</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td colspan="6"><b>Aspek Kepribadian</b></td>
                                </tr>
                                <tr>
                                  <td><b>1.</b></td>
                                  <td colspan="5"><b>Adaptasi, komunikasi, tanggung jawab dan perilaku</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Adaptasi</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Komunikasi</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Tanggung Jawab</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Perilaku</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td><b>2.</b></td>
                                  <td colspan="5"><b>Penerapan ilmu, keaktifan, ketepatan waktu dalam menjalankan tugas, dan inisiatif</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Penerapan ilmu</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Keaktifan</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Ketepatan waktu dalam menjalankan tugas</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Inisiatif</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_leader" max="1" required></td>
                                </tr>
                              </tbody>
                            </table>

                            <div class="row">
                              <div class="col-3">
                                <center><b>KLASIFIKASI NILAI</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr style="text-align: center;">
                                    <td width="30%" style="font-size: 11px; font-weight: bold;">NILAI MUTU</td>
                                    <td width="70%" style="font-size: 11px; font-weight: bold;">KUALITAS</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">A : 5</td>
                                    <td width="" style="text-align: center;">Sangat Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">B : 4</td>
                                    <td width="" style="text-align: center;">Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">C : 3</td>
                                    <td width="" style="text-align: center;">Cukup</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">D : 2</td>
                                    <td width="" style="text-align: center;">Buruk</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">E : 1</td>
                                    <td width="" style="text-align: center;">Sangat Buruk</td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-3">
                                <center><b>ABSENSI DAN KETERLAMBATAN</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr>
                                    <td width="50%">Sakit</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_sakit = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari' AND tanggal <= '$sampai'"));
                                        echo $count_sakit." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Izin</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_ijin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Alpa</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_alpa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Terlambat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_terlambat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Datang Siang</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Pulang Cepat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-4">
                                <center><b>SARAN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="saran_perbaikan" required></textarea>
                                <br>
                                <center><b>KOMITMEN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="komitmen_perbaikan" required></textarea>
                              </div>
                            </div>


                            <div class="row">

                            <?php if($_GET['semester'] != '3 Bulan (Training)' AND $_GET['semester'] != '6 bulan (Training) + Semester 1'){ ?>
                              <!-- --------------------------------- 6 Bulan MAGANG ---------------------------->
                              <div class="col-12">
                                <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
                                <table width="100%" class="table table-sm table-bordered" style="font-size: 9px;">
                                  <tr style="text-align: center;">
                                    <td width="1%" style="font-size: 9px; font-weight: bold;">NO</td>
                                    <td width="8%" style="font-size: 9px; font-weight: bold;">BULAN</td>
                                    <td width="19%" style="font-size: 9px; font-weight: bold;">TANGGAL</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SAKIT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">IZIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">ALPA</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">TERLAM BAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">DATANG SIANG</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">PULANG CEPAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">JUMLAH IJIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SERAGAM (X)</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEHADIRAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEDISIPLINAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT GROOMING</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT TERTIB ADMINISTRASI</td>
                                  </tr>
                                  <tr>
                                    <td width="">1</td>
                                    <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;"> 
                                      <?php
                                        $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                                        $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                                        $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $count_sakit_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_1 = $count_ijin_1+$count_alpa_1+$count_terlambat_1+$count_masukSiang_1+$count_pulangCepat_1." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $seragam_x_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_1 == 0){
                                          $point_kehadiran_1 = 5;
                                        }elseif($jml_ijin_1 >= 1 AND $jml_ijin_1 <= 3){
                                          $point_kehadiran_1 = 4;
                                        }elseif($jml_ijin_1 >= 4 AND $jml_ijin_1 <= 7){
                                          $point_kehadiran_1 = 3;
                                        }elseif($jml_ijin_1 >7){
                                          $point_kehadiran_1 = 2;
                                        }

                                        echo $point_kehadiran_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_1 == 5 OR $point_kehadiran_1 == 4){
                                          $point_kedisiplinan_1 = 3;
                                        }elseif($point_kehadiran_1 == 3 OR $point_kehadiran_1 == 2){
                                          $point_kedisiplinan_1 = 2;
                                        }

                                        echo $point_kedisiplinan_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_1 == 0){
                                          $point_grooming_1 = 2;
                                        }elseif($seragam_x_1 == 1){
                                          $point_grooming_1 = 1.5;
                                        }elseif($seragam_x_1 == 2){
                                          $point_grooming_1 = 1;
                                        }elseif($seragam_x_1 > 2){
                                          $point_grooming_1 = 0.5;
                                        }

                                        echo $point_grooming_1;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_1 = $point_kedisiplinan_1 + $point_grooming_1;
                                        echo $point_administrasi_1;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">2</td>
                                    <td width=""><?php echo date('F', strtotime('+2 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                                        $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                                        $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $count_sakit_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_2 = $count_ijin_2+$count_alpa_2+$count_terlambat_2+$count_masukSiang_2+$count_pulangCepat_2." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $seragam_x_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_2 == 0){
                                          $point_kehadiran_2 = 5;
                                        }elseif($jml_ijin_2 >= 1 AND $jml_ijin_2 <= 3){
                                          $point_kehadiran_2 = 4;
                                        }elseif($jml_ijin_2 >= 4 AND $jml_ijin_2 <= 7){
                                          $point_kehadiran_2 = 3;
                                        }elseif($jml_ijin_2 >7){
                                          $point_kehadiran_2 = 2;
                                        }

                                        echo $point_kehadiran_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_2 == 5 OR $point_kehadiran_2 == 4){
                                          $point_kedisiplinan_2 = 3;
                                        }elseif($point_kehadiran_2 == 3 OR $point_kehadiran_2 == 2){
                                          $point_kedisiplinan_2 = 2;
                                        }

                                        echo $point_kedisiplinan_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_2 == 0){
                                          $point_grooming_2 = 2;
                                        }elseif($seragam_x_2 == 1){
                                          $point_grooming_2 = 1.5;
                                        }elseif($seragam_x_2 == 2){
                                          $point_grooming_2 = 1;
                                        }elseif($seragam_x_2 > 2){
                                          $point_grooming_2 = 0.5;
                                        }

                                        echo $point_grooming_2;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_2 = $point_kedisiplinan_2 + $point_grooming_2;
                                        echo $point_administrasi_2;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">3</td>
                                    <td width=""><?php echo date('F', strtotime('+3 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                                        $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                                        $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $count_sakit_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_3 = $count_ijin_3+$count_alpa_3+$count_terlambat_3+$count_masukSiang_3+$count_pulangCepat_3." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $seragam_x_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_3 == 0){
                                          $point_kehadiran_3 = 5;
                                        }elseif($jml_ijin_3 >= 1 AND $jml_ijin_3 <= 3){
                                          $point_kehadiran_3 = 4;
                                        }elseif($jml_ijin_3 >= 4 AND $jml_ijin_3 <= 7){
                                          $point_kehadiran_3 = 3;
                                        }elseif($jml_ijin_3 >7){
                                          $point_kehadiran_3 = 2;
                                        }

                                        echo $point_kehadiran_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_3 == 5 OR $point_kehadiran_3 == 4){
                                          $point_kedisiplinan_3 = 3;
                                        }elseif($point_kehadiran_3 == 3 OR $point_kehadiran_3 == 2){
                                          $point_kedisiplinan_3 = 2;
                                        }

                                        echo $point_kedisiplinan_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_3 == 0){
                                          $point_grooming_3 = 2;
                                        }elseif($seragam_x_3 == 1){
                                          $point_grooming_3 = 1.5;
                                        }elseif($seragam_x_3 == 2){
                                          $point_grooming_3 = 1;
                                        }elseif($seragam_x_3 > 2){
                                          $point_grooming_3 = 0.5;
                                        }

                                        echo $point_grooming_3;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_3 = $point_kedisiplinan_3 + $point_grooming_3;
                                        echo $point_administrasi_3;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">4</td>
                                    <td width=""><?php echo date('F', strtotime('+4 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari4 = date('Y-m-d', strtotime('+3 month',strtotime($dari)));
                                        $sampai4_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari4)));
                                        $sampai4 = date('Y-m-d', strtotime('-1 days',strtotime($sampai4_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari4))."</b> s/d <b>".date("d M Y", strtotime($sampai4))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $count_sakit_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_4 = $count_ijin_4+$count_alpa_4+$count_terlambat_4+$count_masukSiang_4+$count_pulangCepat_4." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $seragam_x_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_4 == 0){
                                          $point_kehadiran_4 = 5;
                                        }elseif($jml_ijin_4 >= 1 AND $jml_ijin_4 <= 3){
                                          $point_kehadiran_4 = 4;
                                        }elseif($jml_ijin_4 >= 4 AND $jml_ijin_4 <= 7){
                                          $point_kehadiran_4 = 3;
                                        }elseif($jml_ijin_4 >7){
                                          $point_kehadiran_4 = 2;
                                        }

                                        echo $point_kehadiran_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_4 == 5 OR $point_kehadiran_4 == 4){
                                          $point_kedisiplinan_4 = 3;
                                        }elseif($point_kehadiran_4 == 3 OR $point_kehadiran_4 == 2){
                                          $point_kedisiplinan_4 = 2;
                                        }

                                        echo $point_kedisiplinan_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_4 == 0){
                                          $point_grooming_4 = 2;
                                        }elseif($seragam_x_4 == 1){
                                          $point_grooming_4 = 1.5;
                                        }elseif($seragam_x_4 == 2){
                                          $point_grooming_4 = 1;
                                        }elseif($seragam_x_4 > 2){
                                          $point_grooming_4 = 0.5;
                                        }

                                        echo $point_grooming_4;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_4 = $point_kedisiplinan_4 + $point_grooming_4;
                                        echo $point_administrasi_4;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">5</td>
                                    <td width=""><?php echo date('F', strtotime('+5 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari5 = date('Y-m-d', strtotime('+4 month',strtotime($dari)));
                                        $sampai5_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari5)));
                                        $sampai5 = date('Y-m-d', strtotime('-1 days',strtotime($sampai5_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari5))."</b> s/d <b>".date("d M Y", strtotime($sampai5))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $count_sakit_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_5 = $count_ijin_5+$count_alpa_5+$count_terlambat_5+$count_masukSiang_5+$count_pulangCepat_5." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $seragam_x_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_5 == 0){
                                          $point_kehadiran_5 = 5;
                                        }elseif($jml_ijin_5 >= 1 AND $jml_ijin_5 <= 3){
                                          $point_kehadiran_5 = 4;
                                        }elseif($jml_ijin_5 >= 4 AND $jml_ijin_5 <= 7){
                                          $point_kehadiran_5 = 3;
                                        }elseif($jml_ijin_5 >7){
                                          $point_kehadiran_5 = 2;
                                        }

                                        echo $point_kehadiran_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_5 == 5 OR $point_kehadiran_5 == 4){
                                          $point_kedisiplinan_5 = 3;
                                        }elseif($point_kehadiran_5 == 3 OR $point_kehadiran_5 == 2){
                                          $point_kedisiplinan_5 = 2;
                                        }

                                        echo $point_kedisiplinan_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_5 == 0){
                                          $point_grooming_5 = 2;
                                        }elseif($seragam_x_5 == 1){
                                          $point_grooming_5 = 1.5;
                                        }elseif($seragam_x_5 == 2){
                                          $point_grooming_5 = 1;
                                        }elseif($seragam_x_5 > 2){
                                          $point_grooming_5 = 0.5;
                                        }

                                        echo $point_grooming_5;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_5 = $point_kedisiplinan_5 + $point_grooming_5;
                                        echo $point_administrasi_5;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">6</td>
                                    <td width=""><?php echo date('F', strtotime('+6 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari6 = date('Y-m-d', strtotime('+5 month',strtotime($dari)));
                                        $sampai6_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari6)));
                                        $sampai6 = date('Y-m-d', strtotime('-1 days',strtotime($sampai6_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari6))."</b> s/d <b>".date("d M Y", strtotime($sampai6))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_sakit_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $count_sakit_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_6 = $count_ijin_6+$count_alpa_6+$count_terlambat_6+$count_masukSiang_6+$count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $seragam_x_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_6 == 0){
                                          $point_kehadiran_6 = 5;
                                        }elseif($jml_ijin_6 >= 1 AND $jml_ijin_6 <= 3){
                                          $point_kehadiran_6 = 4;
                                        }elseif($jml_ijin_6 >= 4 AND $jml_ijin_6 <= 7){
                                          $point_kehadiran_6 = 3;
                                        }elseif($jml_ijin_6 >7){
                                          $point_kehadiran_6 = 2;
                                        }

                                        echo $point_kehadiran_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_6 == 5 OR $point_kehadiran_6 == 4){
                                          $point_kedisiplinan_6 = 3;
                                        }elseif($point_kehadiran_6 == 3 OR $point_kehadiran_6 == 2){
                                          $point_kedisiplinan_6 = 2;
                                        }

                                        echo $point_kedisiplinan_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_6 == 0){
                                          $point_grooming_6 = 2;
                                        }elseif($seragam_x_6 == 1){
                                          $point_grooming_6 = 1.5;
                                        }elseif($seragam_x_6 == 2){
                                          $point_grooming_6 = 1;
                                        }elseif($seragam_x_6 > 2){
                                          $point_grooming_6 = 0.5;
                                        }

                                        echo $point_grooming_6;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_6 = $point_kedisiplinan_6 + $point_grooming_6;
                                        echo $point_administrasi_6;
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">TOTAL</td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_administrasi_1+$point_administrasi_2+$point_administrasi_3+$point_administrasi_4+$point_administrasi_5+$point_administrasi_6; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">
                                      RATA-RATA
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6)/6),1)." Hari"; 
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6)/6),1)." Hari";
                                      ?>  
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6)/6),1)." Hari";
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6)/6),1);
                                      ?>
                                    </td>  
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6)+(($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                                      ?>
                                    </td>
                                  </tr>
                                </table>

                              </div>

                            <?php }else{ ?>
                              <!-- --------------------------------- 3 Bulan MAGANG ---------------------------->

                              <div class="col-12">
                                <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
                                <table width="100%" class="table table-sm table-bordered" style="font-size: 9px;">
                                  <tr style="text-align: center;">
                                    <td width="1%" style="font-size: 9px; font-weight: bold;">NO</td>
                                    <td width="8%" style="font-size: 9px; font-weight: bold;">BULAN</td>
                                    <td width="19%" style="font-size: 9px; font-weight: bold;">TANGGAL</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SAKIT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">IZIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">ALPA</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">TERLAM BAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">DATANG SIANG</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">PULANG CEPAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">JUMLAH IJIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SERAGAM (X)</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEHADIRAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEDISIPLINAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT GROOMING</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT TERTIB ADMINISTRASI</td>
                                  </tr>
                                  <tr>
                                    <td width="">1</td>
                                    <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;"> 
                                      <?php
                                        $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                                        $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                                        $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $count_sakit_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_1 = $count_ijin_1+$count_alpa_1+$count_terlambat_1+$count_masukSiang_1+$count_pulangCepat_1." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $seragam_x_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_1 == 0){
                                          $point_kehadiran_1 = 5;
                                        }elseif($jml_ijin_1 >= 1 AND $jml_ijin_1 <= 3){
                                          $point_kehadiran_1 = 4;
                                        }elseif($jml_ijin_1 >= 4 AND $jml_ijin_1 <= 7){
                                          $point_kehadiran_1 = 3;
                                        }elseif($jml_ijin_1 >7){
                                          $point_kehadiran_1 = 2;
                                        }

                                        echo $point_kehadiran_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_1 == 5 OR $point_kehadiran_1 == 4){
                                          $point_kedisiplinan_1 = 3;
                                        }elseif($point_kehadiran_1 == 3 OR $point_kehadiran_1 == 2){
                                          $point_kedisiplinan_1 = 2;
                                        }

                                        echo $point_kedisiplinan_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_1 == 0){
                                          $point_grooming_1 = 2;
                                        }elseif($seragam_x_1 == 1){
                                          $point_grooming_1 = 1.5;
                                        }elseif($seragam_x_1 == 2){
                                          $point_grooming_1 = 1;
                                        }elseif($seragam_x_1 > 2){
                                          $point_grooming_1 = 0.5;
                                        }

                                        echo $point_grooming_1;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_1 = $point_kedisiplinan_1 + $point_grooming_1;
                                        echo $point_administrasi_1;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">2</td>
                                    <td width=""><?php echo date('F', strtotime('+2 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                                        $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                                        $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $count_sakit_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_2 = $count_ijin_2+$count_alpa_2+$count_terlambat_2+$count_masukSiang_2+$count_pulangCepat_2." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $seragam_x_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_2 == 0){
                                          $point_kehadiran_2 = 5;
                                        }elseif($jml_ijin_2 >= 1 AND $jml_ijin_2 <= 3){
                                          $point_kehadiran_2 = 4;
                                        }elseif($jml_ijin_2 >= 4 AND $jml_ijin_2 <= 7){
                                          $point_kehadiran_2 = 3;
                                        }elseif($jml_ijin_2 >7){
                                          $point_kehadiran_2 = 2;
                                        }

                                        echo $point_kehadiran_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_2 == 5 OR $point_kehadiran_2 == 4){
                                          $point_kedisiplinan_2 = 3;
                                        }elseif($point_kehadiran_2 == 3 OR $point_kehadiran_2 == 2){
                                          $point_kedisiplinan_2 = 2;
                                        }

                                        echo $point_kedisiplinan_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_2 == 0){
                                          $point_grooming_2 = 2;
                                        }elseif($seragam_x_2 == 1){
                                          $point_grooming_2 = 1.5;
                                        }elseif($seragam_x_2 == 2){
                                          $point_grooming_2 = 1;
                                        }elseif($seragam_x_2 > 2){
                                          $point_grooming_2 = 0.5;
                                        }

                                        echo $point_grooming_2;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_2 = $point_kedisiplinan_2 + $point_grooming_2;
                                        echo $point_administrasi_2;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">3</td>
                                    <td width=""><?php echo date('F', strtotime('+3 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                                        $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                                        $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $count_sakit_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_3 = $count_ijin_3+$count_alpa_3+$count_terlambat_3+$count_masukSiang_3+$count_pulangCepat_3." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $seragam_x_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_3 == 0){
                                          $point_kehadiran_3 = 5;
                                        }elseif($jml_ijin_3 >= 1 AND $jml_ijin_3 <= 3){
                                          $point_kehadiran_3 = 4;
                                        }elseif($jml_ijin_3 >= 4 AND $jml_ijin_3 <= 7){
                                          $point_kehadiran_3 = 3;
                                        }elseif($jml_ijin_3 >7){
                                          $point_kehadiran_3 = 2;
                                        }

                                        echo $point_kehadiran_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_3 == 5 OR $point_kehadiran_3 == 4){
                                          $point_kedisiplinan_3 = 3;
                                        }elseif($point_kehadiran_3 == 3 OR $point_kehadiran_3 == 2){
                                          $point_kedisiplinan_3 = 2;
                                        }

                                        echo $point_kedisiplinan_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_3 == 0){
                                          $point_grooming_3 = 2;
                                        }elseif($seragam_x_3 == 1){
                                          $point_grooming_3 = 1.5;
                                        }elseif($seragam_x_3 == 2){
                                          $point_grooming_3 = 1;
                                        }elseif($seragam_x_3 > 2){
                                          $point_grooming_3 = 0.5;
                                        }

                                        echo $point_grooming_3;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_3 = $point_kedisiplinan_3 + $point_grooming_3;
                                        echo $point_administrasi_3;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">TOTAL</td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_sakit_1+$count_sakit_2+$count_sakit_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_ijin_1+$count_ijin_2+$count_ijin_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_alpa_1+$count_alpa_2+$count_alpa_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_terlambat_1+$count_terlambat_2+$count_terlambat_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $jml_ijin_1+$jml_ijin_2+$jml_ijin_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $seragam_x_1+$seragam_x_2+$seragam_x_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_grooming_1+$point_grooming_2+$point_grooming_3; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_administrasi_1+$point_administrasi_2+$point_administrasi_3; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">
                                      RATA-RATA
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_sakit_1+$count_sakit_2+$count_sakit_3)/3),1)." Hari"; 
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_ijin_1+$count_ijin_2+$count_ijin_3)/3),1)." Hari";
                                      ?>  
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_alpa_1+$count_alpa_2+$count_alpa_3)/3),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3)/3),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3)/3),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($jml_ijin_1+$jml_ijin_2+$jml_ijin_3)/3),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($seragam_x_1+$seragam_x_2+$seragam_x_3)/3),1)." Hari";
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3)/3),1);
                                      ?>
                                    </td>  
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3)/3),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3)/3),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3)/3)+(($point_grooming_1+$point_grooming_2+$point_grooming_3)/3),1);
                                      ?>
                                    </td>
                                  </tr>
                                </table>

                              </div>
                              
                            <?php } ?>
                            </div>

                            <div class="row">
                              <table class="table table-sm table-striped" style="font-size: 12px;">
                                <thead>
                                  <tr align="center">
                                    <th width="5%">#</th>
                                    <th>Aspek Penilaian</th>
                                    <th width="15%">Nilai Point</th>
                                    <th width="15%">Nilai Value</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><b>3.</b></td>
                                    <td colspan="2"><b>Tertib Administrasi (Grooming, kedisiplinan)</b></td>
                                    <td align="center">
                                      <?php
                                        echo (($point_grooming_1+$point_grooming_2+$point_grooming_3)/3)+(($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3)/3)
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Grooming</td>
                                    <td align="center">2</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_grooming" max="2" value="<?php echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3)/3),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kedisiplinan</td>
                                    <td align="center">3</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kedisiplinan" max="3" value="<?php echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3)/3),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td><b>4.</b></td>
                                    <td colspan="3"><b>Kehadiran</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kehadiran</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kehadiran" max="5" value="<?php echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3)/3),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"><b>Aspek Kerohanian (Bonus)</b></td>
                                  </tr>
                                  <tr>
                                    <td><b>6.</b></td>
                                    <td colspan="3"><b>Program OWOJ</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>OWOJ</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_owoj" max="5" required></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>

                            <br>
                            <div class="row">
                              <div class="col-4"></div>
                              <div class="col-4">
                                <center>
                                  <?php
                                    $cek_data_evaluasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM evaluasi WHERE nik = '$_GET[nik_karyawan]' AND semester = '$_GET[semester]'"));
                                    if($cek_data_evaluasi > 0){
                                  ?>
                                    <small><i style="color: red;">*Data penilaian ini sudah ada</i></small>
                                    <input type="button" class="form-control btn btn-success disabled" value="Submit">
                                  <?php }else{ ?>
                                    <input type="submit" class="form-control btn btn-success" name="submit_evaluasi" value="Submit">
                                  <?php } ?>
                                </center>
                              </div>
                            </div>

                          </form>

                  <!-- ------------------------------------------- KONTRAK -------------------------------------------- -->
                  <?php
                      }elseif($_GET['jabatan']=="Kontrak"){
                        $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[nik_karyawan]'"));
                        $getJabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jabatan WHERE id = '$getKaryawan[jabatan_id]'"));
                  ?>
                        <center><b>FORMULIR PENILAIAN PRESTASI KERJA</b></center>
                        <br>
                        <div class="row">
                          <div class="col-6">
                            <table width="100%" class="table table-sm" style="font-size: 12px;">
                              <tr>
                                <td width="30%"><b>Nomor</b></td>
                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    function getRomawi($bln){
                                      switch ($bln){
                                        case 1:
                                            return "I";
                                            break;
                                        case 2:
                                            return "II";
                                            break;
                                        case 3:
                                            return "III";
                                            break;
                                        case 4:
                                            return "IV";
                                            break;
                                        case 5:
                                            return "V";
                                            break;
                                        case 6:
                                            return "VI";
                                            break;
                                        case 7:
                                            return "VII";
                                            break;
                                        case 8:
                                            return "VIII";
                                            break;
                                        case 9:
                                            return "IX";
                                            break;
                                        case 10:
                                            return "X";
                                            break;
                                        case 11:
                                            return "XI";
                                            break;
                                        case 12:
                                            return "XII";
                                            break;
                                      }
                                    }

                                    $bln = date("m", strtotime($_GET['tanggal_penilaian']));
                                    $get_nomor = mysqli_fetch_array(mysqli_query($conn, "SELECT max(id) AS id_max FROM evaluasi"));
                                    $nomor_incr = ($get_nomor['id_max'])+1;
                                    if($nomor_incr < 10){
                                      $nomor_incr = "00".$nomor_incr;
                                    }elseif($nomor_incr < 100){
                                      $nomor_incr = "0".$nomor_incr;
                                    } 

                                    $nomor_fppk = $nomor_incr."/SK-HR/FPPK/".getRomawi($bln)."/".date("Y", strtotime($_GET['tanggal_penilaian']));
                                    echo $nomor_fppk;
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Nama</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $getKaryawan['nama']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>NIK</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $_GET['nik_karyawan']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Jabatan</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo "<b>[".$_GET['jabatan']."]</b> - ".$getJabatan['jabatan']; ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-6">
                            <table width="100%" class="table table-sm" style="font-size: 12px;">
                              <tr>
                                <td width="30%"><b>Tanggal Evaluasi</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo date("d M Y", strtotime($_GET['tanggal_penilaian'])); ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Divisi<b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $getJabatan['jabatan']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Masa Kerja</b></td>
                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    $date1 = date_create($getKaryawan['tgl_masuk']); 
                                    $date2 = date_create($_GET['tanggal_penilaian']); 
                                     
                                    $interval = date_diff($date1, $date2); 
                                     
                                    echo $masa_kerja = "" . $interval->y . " Tahun, " . $interval->m." Bulan, ".$interval->d." Hari";
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Periode Penilaian</b></td>

                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    if($_GET['semester'] != "3 Bulan (Training)" AND $_GET['semester'] != "6 bulan (Training) + Semester 1"){
                                      $dari = date('Y-m-d', strtotime('+'.(6*($_GET['semester']-1)).' month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+'.(6*$_GET['semester']).' month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo "Semester ".$_GET['semester']." <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }elseif($_GET['semester'] == "3 Bulan (Training)"){
                                      $dari = date('Y-m-d', strtotime('+0 month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }elseif($_GET['semester'] == "6 bulan (Training) + Semester 1"){
                                      $dari = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+6 month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }
                                  ?>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <form method="POST" action="index.php?pages=dbevaluasi">
                            <input type="hidden" name="nomor_fppk" value="<?php echo $nomor_fppk; ?>">
                            <input type="hidden" name="nik_karyawan" value="<?php echo $_GET['nik_karyawan']; ?>">
                            <input type="hidden" name="tgl_evaluasi" value="<?php echo $_GET['tanggal_penilaian']; ?>">
                            <input type="hidden" name="divisi" value="<?php echo $getJabatan['jabatan'];  ?>">
                            <input type="hidden" name="masa_kerja" value="<?php echo $masa_kerja; ?>">
                            <input type="hidden" name="semester" value="<?php echo $_GET['semester']; ?>">
                            <input type="hidden" name="penilaian_dari" value="<?php echo $dari; ?>">
                            <input type="hidden" name="penilaian_sampai" value="<?php echo $sampai; ?>">
                            <input type="hidden" name="jabatan" value="<?php echo $_GET['jabatan']; ?>">

                            <table class="table table-sm table-striped" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th>Aspek Penilaian</th>
                                  <th width="2%">Nilai Point</th>
                                  <th width="8%">Dirut</th>
                                  <th width="8%">Dirop</th>
                                  <th width="8%">Manager/ Leader</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td colspan="6"><b>Aspek Kepribadian</b></td>
                                </tr>
                                <tr>
                                  <td><b>1.</b></td>
                                  <td colspan="5"><b>Adaptasi, komunikasi, tanggung jawab dan perilaku & karakter</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Adaptasi</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Komunikasi</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Tanggung Jawab</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Perilaku & karakter</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td><b>2.</b></td>
                                  <td colspan="5"><b>Kerjasama dalam team, ketepatan waktu menyelesaikan tugas, pemahaman job description, dan kualitas hasil pekerjaan</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kerjasama dalam team</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Ketepatan waktu menyelesaikan tugas</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pemahaman job description</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kualitas hasil pekerjaan</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_leader" max="1" required></td>
                                </tr>
                              </tbody>
                            </table>

                            <div class="row">
                              <div class="col-3">
                                <center><b>KLASIFIKASI NILAI</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr style="text-align: center;">
                                    <td width="30%" style="font-size: 11px; font-weight: bold;">NILAI MUTU</td>
                                    <td width="70%" style="font-size: 11px; font-weight: bold;">KUALITAS</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">A : 5</td>
                                    <td width="" style="text-align: center;">Sangat Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">B : 4</td>
                                    <td width="" style="text-align: center;">Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">C : 3</td>
                                    <td width="" style="text-align: center;">Cukup</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">D : 2</td>
                                    <td width="" style="text-align: center;">Buruk</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">E : 1</td>
                                    <td width="" style="text-align: center;">Sangat Buruk</td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-3">
                                <center><b>ABSENSI DAN KETERLAMBATAN</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr>
                                    <td width="50%">Sakit</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_sakit = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari' AND tanggal <= '$sampai'"));
                                        echo $count_sakit." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Izin</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_ijin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Alpa</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_alpa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Terlambat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_terlambat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Datang Siang</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Pulang Cepat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-4">
                                <center><b>SARAN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="saran_perbaikan" required></textarea>
                                <br>
                                <center><b>KOMITMEN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="komitmen_perbaikan" required></textarea>
                              </div>
                            </div>


                            <div class="row">

                            <?php if($_GET['semester'] != '3 Bulan (Training)' AND $_GET['semester'] != '6 bulan (Training) + Semester 1'){ ?>
                              <!-- --------------------------------- 6 Bulan KONTRAK ---------------------------->
                              <div class="col-12">
                                <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
                                <table width="100%" class="table table-sm table-bordered" style="font-size: 9px;">
                                  <tr style="text-align: center;">
                                    <td width="1%" style="font-size: 9px; font-weight: bold;">NO</td>
                                    <td width="8%" style="font-size: 9px; font-weight: bold;">BULAN</td>
                                    <td width="19%" style="font-size: 9px; font-weight: bold;">TANGGAL</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SAKIT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">IZIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">ALPA</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">TERLAM BAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">DATANG SIANG</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">PULANG CEPAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">JUMLAH IJIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SERAGAM (X)</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEHADIRAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEDISIPLINAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT GROOMING</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT TERTIB ADMINISTRASI</td>
                                  </tr>
                                  <tr>
                                    <td width="">1</td>
                                    <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;"> 
                                      <?php
                                        $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                                        $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                                        $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $count_sakit_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_1 = $count_ijin_1+$count_alpa_1+$count_terlambat_1+$count_masukSiang_1+$count_pulangCepat_1." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $seragam_x_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_1 == 0){
                                          $point_kehadiran_1 = 5;
                                        }elseif($jml_ijin_1 >= 1 AND $jml_ijin_1 <= 3){
                                          $point_kehadiran_1 = 4;
                                        }elseif($jml_ijin_1 >= 4 AND $jml_ijin_1 <= 7){
                                          $point_kehadiran_1 = 3;
                                        }elseif($jml_ijin_1 >7){
                                          $point_kehadiran_1 = 2;
                                        }

                                        echo $point_kehadiran_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_1 == 5 OR $point_kehadiran_1 == 4){
                                          $point_kedisiplinan_1 = 3;
                                        }elseif($point_kehadiran_1 == 3 OR $point_kehadiran_1 == 2){
                                          $point_kedisiplinan_1 = 2;
                                        }

                                        echo $point_kedisiplinan_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_1 == 0){
                                          $point_grooming_1 = 2;
                                        }elseif($seragam_x_1 == 1){
                                          $point_grooming_1 = 1.5;
                                        }elseif($seragam_x_1 == 2){
                                          $point_grooming_1 = 1;
                                        }elseif($seragam_x_1 > 2){
                                          $point_grooming_1 = 0.5;
                                        }

                                        echo $point_grooming_1;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_1 = $point_kedisiplinan_1 + $point_grooming_1;
                                        echo $point_administrasi_1;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">2</td>
                                    <td width=""><?php echo date('F', strtotime('+2 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                                        $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                                        $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $count_sakit_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_2 = $count_ijin_2+$count_alpa_2+$count_terlambat_2+$count_masukSiang_2+$count_pulangCepat_2." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $seragam_x_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_2 == 0){
                                          $point_kehadiran_2 = 5;
                                        }elseif($jml_ijin_2 >= 1 AND $jml_ijin_2 <= 3){
                                          $point_kehadiran_2 = 4;
                                        }elseif($jml_ijin_2 >= 4 AND $jml_ijin_2 <= 7){
                                          $point_kehadiran_2 = 3;
                                        }elseif($jml_ijin_2 >7){
                                          $point_kehadiran_2 = 2;
                                        }

                                        echo $point_kehadiran_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_2 == 5 OR $point_kehadiran_2 == 4){
                                          $point_kedisiplinan_2 = 3;
                                        }elseif($point_kehadiran_2 == 3 OR $point_kehadiran_2 == 2){
                                          $point_kedisiplinan_2 = 2;
                                        }

                                        echo $point_kedisiplinan_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_2 == 0){
                                          $point_grooming_2 = 2;
                                        }elseif($seragam_x_2 == 1){
                                          $point_grooming_2 = 1.5;
                                        }elseif($seragam_x_2 == 2){
                                          $point_grooming_2 = 1;
                                        }elseif($seragam_x_2 > 2){
                                          $point_grooming_2 = 0.5;
                                        }

                                        echo $point_grooming_2;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_2 = $point_kedisiplinan_2 + $point_grooming_2;
                                        echo $point_administrasi_2;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">3</td>
                                    <td width=""><?php echo date('F', strtotime('+3 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                                        $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                                        $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $count_sakit_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_3 = $count_ijin_3+$count_alpa_3+$count_terlambat_3+$count_masukSiang_3+$count_pulangCepat_3." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $seragam_x_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_3 == 0){
                                          $point_kehadiran_3 = 5;
                                        }elseif($jml_ijin_3 >= 1 AND $jml_ijin_3 <= 3){
                                          $point_kehadiran_3 = 4;
                                        }elseif($jml_ijin_3 >= 4 AND $jml_ijin_3 <= 7){
                                          $point_kehadiran_3 = 3;
                                        }elseif($jml_ijin_3 >7){
                                          $point_kehadiran_3 = 2;
                                        }

                                        echo $point_kehadiran_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_3 == 5 OR $point_kehadiran_3 == 4){
                                          $point_kedisiplinan_3 = 3;
                                        }elseif($point_kehadiran_3 == 3 OR $point_kehadiran_3 == 2){
                                          $point_kedisiplinan_3 = 2;
                                        }

                                        echo $point_kedisiplinan_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_3 == 0){
                                          $point_grooming_3 = 2;
                                        }elseif($seragam_x_3 == 1){
                                          $point_grooming_3 = 1.5;
                                        }elseif($seragam_x_3 == 2){
                                          $point_grooming_3 = 1;
                                        }elseif($seragam_x_3 > 2){
                                          $point_grooming_3 = 0.5;
                                        }

                                        echo $point_grooming_3;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_3 = $point_kedisiplinan_3 + $point_grooming_3;
                                        echo $point_administrasi_3;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">4</td>
                                    <td width=""><?php echo date('F', strtotime('+4 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari4 = date('Y-m-d', strtotime('+3 month',strtotime($dari)));
                                        $sampai4_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari4)));
                                        $sampai4 = date('Y-m-d', strtotime('-1 days',strtotime($sampai4_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari4))."</b> s/d <b>".date("d M Y", strtotime($sampai4))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $count_sakit_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_4 = $count_ijin_4+$count_alpa_4+$count_terlambat_4+$count_masukSiang_4+$count_pulangCepat_4." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $seragam_x_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_4 == 0){
                                          $point_kehadiran_4 = 5;
                                        }elseif($jml_ijin_4 >= 1 AND $jml_ijin_4 <= 3){
                                          $point_kehadiran_4 = 4;
                                        }elseif($jml_ijin_4 >= 4 AND $jml_ijin_4 <= 7){
                                          $point_kehadiran_4 = 3;
                                        }elseif($jml_ijin_4 >7){
                                          $point_kehadiran_4 = 2;
                                        }

                                        echo $point_kehadiran_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_4 == 5 OR $point_kehadiran_4 == 4){
                                          $point_kedisiplinan_4 = 3;
                                        }elseif($point_kehadiran_4 == 3 OR $point_kehadiran_4 == 2){
                                          $point_kedisiplinan_4 = 2;
                                        }

                                        echo $point_kedisiplinan_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_4 == 0){
                                          $point_grooming_4 = 2;
                                        }elseif($seragam_x_4 == 1){
                                          $point_grooming_4 = 1.5;
                                        }elseif($seragam_x_4 == 2){
                                          $point_grooming_4 = 1;
                                        }elseif($seragam_x_4 > 2){
                                          $point_grooming_4 = 0.5;
                                        }

                                        echo $point_grooming_4;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_4 = $point_kedisiplinan_4 + $point_grooming_4;
                                        echo $point_administrasi_4;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">5</td>
                                    <td width=""><?php echo date('F', strtotime('+5 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari5 = date('Y-m-d', strtotime('+4 month',strtotime($dari)));
                                        $sampai5_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari5)));
                                        $sampai5 = date('Y-m-d', strtotime('-1 days',strtotime($sampai5_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari5))."</b> s/d <b>".date("d M Y", strtotime($sampai5))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $count_sakit_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_5 = $count_ijin_5+$count_alpa_5+$count_terlambat_5+$count_masukSiang_5+$count_pulangCepat_5." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $seragam_x_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_5 == 0){
                                          $point_kehadiran_5 = 5;
                                        }elseif($jml_ijin_5 >= 1 AND $jml_ijin_5 <= 3){
                                          $point_kehadiran_5 = 4;
                                        }elseif($jml_ijin_5 >= 4 AND $jml_ijin_5 <= 7){
                                          $point_kehadiran_5 = 3;
                                        }elseif($jml_ijin_5 >7){
                                          $point_kehadiran_5 = 2;
                                        }

                                        echo $point_kehadiran_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_5 == 5 OR $point_kehadiran_5 == 4){
                                          $point_kedisiplinan_5 = 3;
                                        }elseif($point_kehadiran_5 == 3 OR $point_kehadiran_5 == 2){
                                          $point_kedisiplinan_5 = 2;
                                        }

                                        echo $point_kedisiplinan_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_5 == 0){
                                          $point_grooming_5 = 2;
                                        }elseif($seragam_x_5 == 1){
                                          $point_grooming_5 = 1.5;
                                        }elseif($seragam_x_5 == 2){
                                          $point_grooming_5 = 1;
                                        }elseif($seragam_x_5 > 2){
                                          $point_grooming_5 = 0.5;
                                        }

                                        echo $point_grooming_5;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_5 = $point_kedisiplinan_5 + $point_grooming_5;
                                        echo $point_administrasi_5;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">6</td>
                                    <td width=""><?php echo date('F', strtotime('+6 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari6 = date('Y-m-d', strtotime('+5 month',strtotime($dari)));
                                        $sampai6_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari6)));
                                        $sampai6 = date('Y-m-d', strtotime('-1 days',strtotime($sampai6_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari6))."</b> s/d <b>".date("d M Y", strtotime($sampai6))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_sakit_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $count_sakit_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_6 = $count_ijin_6+$count_alpa_6+$count_terlambat_6+$count_masukSiang_6+$count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $seragam_x_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_6 == 0){
                                          $point_kehadiran_6 = 5;
                                        }elseif($jml_ijin_6 >= 1 AND $jml_ijin_6 <= 3){
                                          $point_kehadiran_6 = 4;
                                        }elseif($jml_ijin_6 >= 4 AND $jml_ijin_6 <= 7){
                                          $point_kehadiran_6 = 3;
                                        }elseif($jml_ijin_6 >7){
                                          $point_kehadiran_6 = 2;
                                        }

                                        echo $point_kehadiran_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_6 == 5 OR $point_kehadiran_6 == 4){
                                          $point_kedisiplinan_6 = 3;
                                        }elseif($point_kehadiran_6 == 3 OR $point_kehadiran_6 == 2){
                                          $point_kedisiplinan_6 = 2;
                                        }

                                        echo $point_kedisiplinan_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_6 == 0){
                                          $point_grooming_6 = 2;
                                        }elseif($seragam_x_6 == 1){
                                          $point_grooming_6 = 1.5;
                                        }elseif($seragam_x_6 == 2){
                                          $point_grooming_6 = 1;
                                        }elseif($seragam_x_6 > 2){
                                          $point_grooming_6 = 0.5;
                                        }

                                        echo $point_grooming_6;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_6 = $point_kedisiplinan_6 + $point_grooming_6;
                                        echo $point_administrasi_6;
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">TOTAL</td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_administrasi_1+$point_administrasi_2+$point_administrasi_3+$point_administrasi_4+$point_administrasi_5+$point_administrasi_6; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">
                                      RATA-RATA
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6)/6),1)." Hari"; 
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6)/6),1)." Hari";
                                      ?>  
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6)/6),1)." Hari";
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6)/6),1);
                                      ?>
                                    </td>  
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6)+(($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                                      ?>
                                    </td>
                                  </tr>
                                </table>

                              </div>

                            <?php }else{ ?>
                              <!-- --------------------------------- 3 Bulan KONTRAK ---------------------------->

                              <div class="col-12">
                                <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
                                <table width="100%" class="table table-sm table-bordered" style="font-size: 9px;">
                                  <tr style="text-align: center;">
                                    <td width="1%" style="font-size: 9px; font-weight: bold;">NO</td>
                                    <td width="8%" style="font-size: 9px; font-weight: bold;">BULAN</td>
                                    <td width="19%" style="font-size: 9px; font-weight: bold;">TANGGAL</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SAKIT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">IZIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">ALPA</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">TERLAM BAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">DATANG SIANG</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">PULANG CEPAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">JUMLAH IJIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SERAGAM (X)</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEHADIRAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEDISIPLINAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT GROOMING</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT TERTIB ADMINISTRASI</td>
                                  </tr>
                                  <tr>
                                    <td width="">1</td>
                                    <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;"> 
                                      <?php
                                        $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                                        $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                                        $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $count_sakit_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_1 = $count_ijin_1+$count_alpa_1+$count_terlambat_1+$count_masukSiang_1+$count_pulangCepat_1." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $seragam_x_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_1 == 0){
                                          $point_kehadiran_1 = 5;
                                        }elseif($jml_ijin_1 >= 1 AND $jml_ijin_1 <= 3){
                                          $point_kehadiran_1 = 4;
                                        }elseif($jml_ijin_1 >= 4 AND $jml_ijin_1 <= 7){
                                          $point_kehadiran_1 = 3;
                                        }elseif($jml_ijin_1 >7){
                                          $point_kehadiran_1 = 2;
                                        }

                                        echo $point_kehadiran_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_1 == 5 OR $point_kehadiran_1 == 4){
                                          $point_kedisiplinan_1 = 3;
                                        }elseif($point_kehadiran_1 == 3 OR $point_kehadiran_1 == 2){
                                          $point_kedisiplinan_1 = 2;
                                        }

                                        echo $point_kedisiplinan_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_1 == 0){
                                          $point_grooming_1 = 2;
                                        }elseif($seragam_x_1 == 1){
                                          $point_grooming_1 = 1.5;
                                        }elseif($seragam_x_1 == 2){
                                          $point_grooming_1 = 1;
                                        }elseif($seragam_x_1 > 2){
                                          $point_grooming_1 = 0.5;
                                        }

                                        echo $point_grooming_1;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_1 = $point_kedisiplinan_1 + $point_grooming_1;
                                        echo $point_administrasi_1;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">2</td>
                                    <td width=""><?php echo date('F', strtotime('+2 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                                        $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                                        $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $count_sakit_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_2 = $count_ijin_2+$count_alpa_2+$count_terlambat_2+$count_masukSiang_2+$count_pulangCepat_2." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $seragam_x_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_2 == 0){
                                          $point_kehadiran_2 = 5;
                                        }elseif($jml_ijin_2 >= 1 AND $jml_ijin_2 <= 3){
                                          $point_kehadiran_2 = 4;
                                        }elseif($jml_ijin_2 >= 4 AND $jml_ijin_2 <= 7){
                                          $point_kehadiran_2 = 3;
                                        }elseif($jml_ijin_2 >7){
                                          $point_kehadiran_2 = 2;
                                        }

                                        echo $point_kehadiran_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_2 == 5 OR $point_kehadiran_2 == 4){
                                          $point_kedisiplinan_2 = 3;
                                        }elseif($point_kehadiran_2 == 3 OR $point_kehadiran_2 == 2){
                                          $point_kedisiplinan_2 = 2;
                                        }

                                        echo $point_kedisiplinan_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_2 == 0){
                                          $point_grooming_2 = 2;
                                        }elseif($seragam_x_2 == 1){
                                          $point_grooming_2 = 1.5;
                                        }elseif($seragam_x_2 == 2){
                                          $point_grooming_2 = 1;
                                        }elseif($seragam_x_2 > 2){
                                          $point_grooming_2 = 0.5;
                                        }

                                        echo $point_grooming_2;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_2 = $point_kedisiplinan_2 + $point_grooming_2;
                                        echo $point_administrasi_2;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">3</td>
                                    <td width=""><?php echo date('F', strtotime('+3 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                                        $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                                        $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $count_sakit_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_3 = $count_ijin_3+$count_alpa_3+$count_terlambat_3+$count_masukSiang_3+$count_pulangCepat_3." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $seragam_x_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_3 == 0){
                                          $point_kehadiran_3 = 5;
                                        }elseif($jml_ijin_3 >= 1 AND $jml_ijin_3 <= 3){
                                          $point_kehadiran_3 = 4;
                                        }elseif($jml_ijin_3 >= 4 AND $jml_ijin_3 <= 7){
                                          $point_kehadiran_3 = 3;
                                        }elseif($jml_ijin_3 >7){
                                          $point_kehadiran_3 = 2;
                                        }

                                        echo $point_kehadiran_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_3 == 5 OR $point_kehadiran_3 == 4){
                                          $point_kedisiplinan_3 = 3;
                                        }elseif($point_kehadiran_3 == 3 OR $point_kehadiran_3 == 2){
                                          $point_kedisiplinan_3 = 2;
                                        }

                                        echo $point_kedisiplinan_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_3 == 0){
                                          $point_grooming_3 = 2;
                                        }elseif($seragam_x_3 == 1){
                                          $point_grooming_3 = 1.5;
                                        }elseif($seragam_x_3 == 2){
                                          $point_grooming_3 = 1;
                                        }elseif($seragam_x_3 > 2){
                                          $point_grooming_3 = 0.5;
                                        }

                                        echo $point_grooming_3;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_3 = $point_kedisiplinan_3 + $point_grooming_3;
                                        echo $point_administrasi_3;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">TOTAL</td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_sakit_1+$count_sakit_2+$count_sakit_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_ijin_1+$count_ijin_2+$count_ijin_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_alpa_1+$count_alpa_2+$count_alpa_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_terlambat_1+$count_terlambat_2+$count_terlambat_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $jml_ijin_1+$jml_ijin_2+$jml_ijin_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $seragam_x_1+$seragam_x_2+$seragam_x_3." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_grooming_1+$point_grooming_2+$point_grooming_3; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_administrasi_1+$point_administrasi_2+$point_administrasi_3; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">
                                      RATA-RATA
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_sakit_1+$count_sakit_2+$count_sakit_3)/3),1)." Hari"; 
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_ijin_1+$count_ijin_2+$count_ijin_3)/3),1)." Hari";
                                      ?>  
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_alpa_1+$count_alpa_2+$count_alpa_3)/3),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3)/3),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3)/3),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($jml_ijin_1+$jml_ijin_2+$jml_ijin_3)/3),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($seragam_x_1+$seragam_x_2+$seragam_x_3)/3),1)." Hari";
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3)/3),1);
                                      ?>
                                    </td>  
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3)/3),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3)/3),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3)/3)+(($point_grooming_1+$point_grooming_2+$point_grooming_3)/3),1);
                                      ?>
                                    </td>
                                  </tr>
                                </table>

                              </div>
                              
                            <?php } ?>
                            </div>

                            <div class="row">
                              <table class="table table-sm table-striped" style="font-size: 12px;">
                                <thead>
                                  <tr align="center">
                                    <th width="5%">#</th>
                                    <th>Aspek Penilaian</th>
                                    <th width="15%">Nilai Point</th>
                                    <th width="15%">Nilai Value</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><b>3.</b></td>
                                    <td colspan="2"><b>Tertib Administrasi (Grooming, kedisiplinan)</b></td>
                                    <td align="center">
                                      <?php
                                        echo (($point_grooming_1+$point_grooming_2+$point_grooming_3)/3)+(($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3)/3)
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Grooming</td>
                                    <td align="center">2</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_grooming" max="2" value="<?php echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3)/3),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kedisiplinan</td>
                                    <td align="center">3</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kedisiplinan" max="3" value="<?php echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3)/3),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td><b>4.</b></td>
                                    <td colspan="3"><b>Kehadiran</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kehadiran</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kehadiran" max="5" value="<?php echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3)/3),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"><b>Aspek Kerohanian (Bonus)</b></td>
                                  </tr>
                                  <tr>
                                    <td><b>6.</b></td>
                                    <td colspan="3"><b>Program OWOJ</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>OWOJ</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_owoj" max="5" required></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>

                            <br>
                            <div class="row">
                              <div class="col-4"></div>
                              <div class="col-4">
                                <center>
                                  <?php
                                    $cek_data_evaluasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM evaluasi WHERE nik = '$_GET[nik_karyawan]' AND semester = '$_GET[semester]'"));
                                    if($cek_data_evaluasi > 0){
                                  ?>
                                    <small><i style="color: red;">*Data penilaian ini sudah ada</i></small>
                                    <input type="button" class="form-control btn btn-success disabled" value="Submit">
                                  <?php }else{ ?>
                                    <input type="submit" class="form-control btn btn-success" name="submit_evaluasi" value="Submit">
                                  <?php } ?>
                                </center>
                              </div>
                            </div>

                          </form>

                  <!-- ------------------------------------------- STAFF -------------------------------------------- -->
                  <?php
                      }elseif($_GET['jabatan']=="Staff"){
                        $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[nik_karyawan]'"));
                        $getJabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jabatan WHERE id = '$getKaryawan[jabatan_id]'"));
                  ?>
                        <center><b>FORMULIR PENILAIAN PRESTASI KERJA</b></center>
                        <br>
                        <div class="row">
                          <div class="col-6">
                            <table width="100%" class="table table-sm" style="font-size: 12px;">
                              <tr>
                                <td width="30%"><b>Nomor</b></td>
                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    function getRomawi($bln){
                                      switch ($bln){
                                        case 1:
                                            return "I";
                                            break;
                                        case 2:
                                            return "II";
                                            break;
                                        case 3:
                                            return "III";
                                            break;
                                        case 4:
                                            return "IV";
                                            break;
                                        case 5:
                                            return "V";
                                            break;
                                        case 6:
                                            return "VI";
                                            break;
                                        case 7:
                                            return "VII";
                                            break;
                                        case 8:
                                            return "VIII";
                                            break;
                                        case 9:
                                            return "IX";
                                            break;
                                        case 10:
                                            return "X";
                                            break;
                                        case 11:
                                            return "XI";
                                            break;
                                        case 12:
                                            return "XII";
                                            break;
                                      }
                                    }

                                    $bln = date("m", strtotime($_GET['tanggal_penilaian']));
                                    $get_nomor = mysqli_fetch_array(mysqli_query($conn, "SELECT max(id) AS id_max FROM evaluasi"));
                                    $nomor_incr = ($get_nomor['id_max'])+1;
                                    if($nomor_incr < 10){
                                      $nomor_incr = "00".$nomor_incr;
                                    }elseif($nomor_incr < 100){
                                      $nomor_incr = "0".$nomor_incr;
                                    } 

                                    $nomor_fppk = $nomor_incr."/SK-HR/FPPK/".getRomawi($bln)."/".date("Y", strtotime($_GET['tanggal_penilaian']));
                                    echo $nomor_fppk;
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Nama</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $getKaryawan['nama']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>NIK</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $_GET['nik_karyawan']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Jabatan</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo "<b>[".$_GET['jabatan']."]</b> - ".$getJabatan['jabatan']; ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-6">
                            <table width="100%" class="table table-sm" style="font-size: 12px;">
                              <tr>
                                <td width="30%"><b>Tanggal Evaluasi</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo date("d M Y", strtotime($_GET['tanggal_penilaian'])); ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Divisi<b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $getJabatan['jabatan']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Masa Kerja</b></td>
                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    $date1 = date_create($getKaryawan['tgl_masuk']); 
                                    $date2 = date_create($_GET['tanggal_penilaian']); 
                                     
                                    $interval = date_diff($date1, $date2); 
                                     
                                    echo $masa_kerja = "" . $interval->y . " Tahun, " . $interval->m." Bulan, ".$interval->d." Hari";
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Periode Penilaian</b></td>

                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    if($_GET['semester'] != "3 Bulan (Training)" AND $_GET['semester'] != "6 bulan (Training) + Semester 1"){
                                      $dari = date('Y-m-d', strtotime('+'.(6*($_GET['semester']-1)).' month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+'.(6*$_GET['semester']).' month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo "Semester ".$_GET['semester']." <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }elseif($_GET['semester'] == "3 Bulan (Training)"){
                                      $dari = date('Y-m-d', strtotime('+0 month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }elseif($_GET['semester'] == "6 bulan (Training) + Semester 1"){
                                      $dari = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+6 month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }
                                  ?>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <form method="POST" action="index.php?pages=dbevaluasi">
                            <input type="hidden" name="nomor_fppk" value="<?php echo $nomor_fppk; ?>">
                            <input type="hidden" name="nik_karyawan" value="<?php echo $_GET['nik_karyawan']; ?>">
                            <input type="hidden" name="tgl_evaluasi" value="<?php echo $_GET['tanggal_penilaian']; ?>">
                            <input type="hidden" name="divisi" value="<?php echo $getJabatan['jabatan'];  ?>">
                            <input type="hidden" name="masa_kerja" value="<?php echo $masa_kerja; ?>">
                            <input type="hidden" name="semester" value="<?php echo $_GET['semester']; ?>">
                            <input type="hidden" name="penilaian_dari" value="<?php echo $dari; ?>">
                            <input type="hidden" name="penilaian_sampai" value="<?php echo $sampai; ?>">
                            <input type="hidden" name="jabatan" value="<?php echo $_GET['jabatan']; ?>">

                            <table class="table table-sm table-striped" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th>Aspek Penilaian</th>
                                  <th width="2%">Nilai Point</th>
                                  <th width="8%">Dirut</th>
                                  <th width="8%">Dirop</th>
                                  <th width="8%">Manager/ Leader</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td colspan="6"><b>Aspek Kepribadian</b></td>
                                </tr>
                                <tr>
                                  <td><b>1.</b></td>
                                  <td colspan="5"><b>Inisiatif & komunikatif, perilaku, skill & inovasi, dan loyalitas</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Inisiatif dan Komunikatif</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Perilaku dan Karakter</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Skill dan Inovasi</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Loyalitas</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td><b>2.</b></td>
                                  <td colspan="5"><b>Kerjasama dalam team, kemampuan mengembangkan diri, kualitas hasil pekerjaan dan ketepatan waktu dalam menjalankan tugas</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kerjasama dalam team</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point13_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point13_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point13_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Tangung jawab</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point14_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point14_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point14_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pengembangan diri dan team</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point15_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point15_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point15_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pengembangan aturan</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point16_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point16_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point16_leader" max="1" required></td>
                                </tr>
                              </tbody>
                            </table>

                            <div class="row">
                              <div class="col-3">
                                <center><b>KLASIFIKASI NILAI</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr style="text-align: center;">
                                    <td width="30%" style="font-size: 11px; font-weight: bold;">NILAI MUTU</td>
                                    <td width="70%" style="font-size: 11px; font-weight: bold;">KUALITAS</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">A : 5</td>
                                    <td width="" style="text-align: center;">Sangat Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">B : 4</td>
                                    <td width="" style="text-align: center;">Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">C : 3</td>
                                    <td width="" style="text-align: center;">Cukup</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">D : 2</td>
                                    <td width="" style="text-align: center;">Buruk</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">E : 1</td>
                                    <td width="" style="text-align: center;">Sangat Buruk</td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-3">
                                <center><b>ABSENSI DAN KETERLAMBATAN</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr>
                                    <td width="50%">Sakit</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_sakit = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari' AND tanggal <= '$sampai'"));
                                        echo $count_sakit." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Izin</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_ijin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Alpa</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_alpa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Terlambat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_terlambat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Datang Siang</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Pulang Cepat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-4">
                                <center><b>SARAN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="saran_perbaikan" required></textarea>
                                <br>
                                <center><b>KOMITMEN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="komitmen_perbaikan" required></textarea>
                              </div>
                            </div>


                            <div class="row">

                            <?php if($_GET['semester'] != '3 Bulan (Training)' AND $_GET['semester'] != '6 bulan (Training) + Semester 1'){ ?>
                              <!-- --------------------------------- 6 Bulan STAFF ---------------------------->
                              <div class="col-12">
                                <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
                                <table width="100%" class="table table-sm table-bordered" style="font-size: 9px;">
                                  <tr style="text-align: center;">
                                    <td width="1%" style="font-size: 9px; font-weight: bold;">NO</td>
                                    <td width="8%" style="font-size: 9px; font-weight: bold;">BULAN</td>
                                    <td width="19%" style="font-size: 9px; font-weight: bold;">TANGGAL</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SAKIT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">IZIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">ALPA</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">TERLAM BAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">DATANG SIANG</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">PULANG CEPAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">JUMLAH IJIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SERAGAM (X)</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEHADIRAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEDISIPLINAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT GROOMING</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT TERTIB ADMINISTRASI</td>
                                  </tr>
                                  <tr>
                                    <td width="">1</td>
                                    <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;"> 
                                      <?php
                                        $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                                        $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                                        $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $count_sakit_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_1 = $count_ijin_1+$count_alpa_1+$count_terlambat_1+$count_masukSiang_1+$count_pulangCepat_1." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $seragam_x_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_1 == 0){
                                          $point_kehadiran_1 = 5;
                                        }elseif($jml_ijin_1 >= 1 AND $jml_ijin_1 <= 3){
                                          $point_kehadiran_1 = 4;
                                        }elseif($jml_ijin_1 >= 4 AND $jml_ijin_1 <= 7){
                                          $point_kehadiran_1 = 3;
                                        }elseif($jml_ijin_1 >7){
                                          $point_kehadiran_1 = 2;
                                        }

                                        echo $point_kehadiran_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_1 == 5 OR $point_kehadiran_1 == 4){
                                          $point_kedisiplinan_1 = 3;
                                        }elseif($point_kehadiran_1 == 3 OR $point_kehadiran_1 == 2){
                                          $point_kedisiplinan_1 = 2;
                                        }

                                        echo $point_kedisiplinan_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_1 == 0){
                                          $point_grooming_1 = 2;
                                        }elseif($seragam_x_1 == 1){
                                          $point_grooming_1 = 1.5;
                                        }elseif($seragam_x_1 == 2){
                                          $point_grooming_1 = 1;
                                        }elseif($seragam_x_1 > 2){
                                          $point_grooming_1 = 0.5;
                                        }

                                        echo $point_grooming_1;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_1 = $point_kedisiplinan_1 + $point_grooming_1;
                                        echo $point_administrasi_1;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">2</td>
                                    <td width=""><?php echo date('F', strtotime('+2 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                                        $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                                        $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $count_sakit_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_2 = $count_ijin_2+$count_alpa_2+$count_terlambat_2+$count_masukSiang_2+$count_pulangCepat_2." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $seragam_x_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_2 == 0){
                                          $point_kehadiran_2 = 5;
                                        }elseif($jml_ijin_2 >= 1 AND $jml_ijin_2 <= 3){
                                          $point_kehadiran_2 = 4;
                                        }elseif($jml_ijin_2 >= 4 AND $jml_ijin_2 <= 7){
                                          $point_kehadiran_2 = 3;
                                        }elseif($jml_ijin_2 >7){
                                          $point_kehadiran_2 = 2;
                                        }

                                        echo $point_kehadiran_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_2 == 5 OR $point_kehadiran_2 == 4){
                                          $point_kedisiplinan_2 = 3;
                                        }elseif($point_kehadiran_2 == 3 OR $point_kehadiran_2 == 2){
                                          $point_kedisiplinan_2 = 2;
                                        }

                                        echo $point_kedisiplinan_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_2 == 0){
                                          $point_grooming_2 = 2;
                                        }elseif($seragam_x_2 == 1){
                                          $point_grooming_2 = 1.5;
                                        }elseif($seragam_x_2 == 2){
                                          $point_grooming_2 = 1;
                                        }elseif($seragam_x_2 > 2){
                                          $point_grooming_2 = 0.5;
                                        }

                                        echo $point_grooming_2;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_2 = $point_kedisiplinan_2 + $point_grooming_2;
                                        echo $point_administrasi_2;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">3</td>
                                    <td width=""><?php echo date('F', strtotime('+3 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                                        $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                                        $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $count_sakit_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_3 = $count_ijin_3+$count_alpa_3+$count_terlambat_3+$count_masukSiang_3+$count_pulangCepat_3." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $seragam_x_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_3 == 0){
                                          $point_kehadiran_3 = 5;
                                        }elseif($jml_ijin_3 >= 1 AND $jml_ijin_3 <= 3){
                                          $point_kehadiran_3 = 4;
                                        }elseif($jml_ijin_3 >= 4 AND $jml_ijin_3 <= 7){
                                          $point_kehadiran_3 = 3;
                                        }elseif($jml_ijin_3 >7){
                                          $point_kehadiran_3 = 2;
                                        }

                                        echo $point_kehadiran_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_3 == 5 OR $point_kehadiran_3 == 4){
                                          $point_kedisiplinan_3 = 3;
                                        }elseif($point_kehadiran_3 == 3 OR $point_kehadiran_3 == 2){
                                          $point_kedisiplinan_3 = 2;
                                        }

                                        echo $point_kedisiplinan_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_3 == 0){
                                          $point_grooming_3 = 2;
                                        }elseif($seragam_x_3 == 1){
                                          $point_grooming_3 = 1.5;
                                        }elseif($seragam_x_3 == 2){
                                          $point_grooming_3 = 1;
                                        }elseif($seragam_x_3 > 2){
                                          $point_grooming_3 = 0.5;
                                        }

                                        echo $point_grooming_3;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_3 = $point_kedisiplinan_3 + $point_grooming_3;
                                        echo $point_administrasi_3;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">4</td>
                                    <td width=""><?php echo date('F', strtotime('+4 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari4 = date('Y-m-d', strtotime('+3 month',strtotime($dari)));
                                        $sampai4_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari4)));
                                        $sampai4 = date('Y-m-d', strtotime('-1 days',strtotime($sampai4_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari4))."</b> s/d <b>".date("d M Y", strtotime($sampai4))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $count_sakit_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_4 = $count_ijin_4+$count_alpa_4+$count_terlambat_4+$count_masukSiang_4+$count_pulangCepat_4." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $seragam_x_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_4 == 0){
                                          $point_kehadiran_4 = 5;
                                        }elseif($jml_ijin_4 >= 1 AND $jml_ijin_4 <= 3){
                                          $point_kehadiran_4 = 4;
                                        }elseif($jml_ijin_4 >= 4 AND $jml_ijin_4 <= 7){
                                          $point_kehadiran_4 = 3;
                                        }elseif($jml_ijin_4 >7){
                                          $point_kehadiran_4 = 2;
                                        }

                                        echo $point_kehadiran_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_4 == 5 OR $point_kehadiran_4 == 4){
                                          $point_kedisiplinan_4 = 3;
                                        }elseif($point_kehadiran_4 == 3 OR $point_kehadiran_4 == 2){
                                          $point_kedisiplinan_4 = 2;
                                        }

                                        echo $point_kedisiplinan_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_4 == 0){
                                          $point_grooming_4 = 2;
                                        }elseif($seragam_x_4 == 1){
                                          $point_grooming_4 = 1.5;
                                        }elseif($seragam_x_4 == 2){
                                          $point_grooming_4 = 1;
                                        }elseif($seragam_x_4 > 2){
                                          $point_grooming_4 = 0.5;
                                        }

                                        echo $point_grooming_4;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_4 = $point_kedisiplinan_4 + $point_grooming_4;
                                        echo $point_administrasi_4;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">5</td>
                                    <td width=""><?php echo date('F', strtotime('+5 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari5 = date('Y-m-d', strtotime('+4 month',strtotime($dari)));
                                        $sampai5_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari5)));
                                        $sampai5 = date('Y-m-d', strtotime('-1 days',strtotime($sampai5_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari5))."</b> s/d <b>".date("d M Y", strtotime($sampai5))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $count_sakit_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_5 = $count_ijin_5+$count_alpa_5+$count_terlambat_5+$count_masukSiang_5+$count_pulangCepat_5." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $seragam_x_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_5 == 0){
                                          $point_kehadiran_5 = 5;
                                        }elseif($jml_ijin_5 >= 1 AND $jml_ijin_5 <= 3){
                                          $point_kehadiran_5 = 4;
                                        }elseif($jml_ijin_5 >= 4 AND $jml_ijin_5 <= 7){
                                          $point_kehadiran_5 = 3;
                                        }elseif($jml_ijin_5 >7){
                                          $point_kehadiran_5 = 2;
                                        }

                                        echo $point_kehadiran_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_5 == 5 OR $point_kehadiran_5 == 4){
                                          $point_kedisiplinan_5 = 3;
                                        }elseif($point_kehadiran_5 == 3 OR $point_kehadiran_5 == 2){
                                          $point_kedisiplinan_5 = 2;
                                        }

                                        echo $point_kedisiplinan_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_5 == 0){
                                          $point_grooming_5 = 2;
                                        }elseif($seragam_x_5 == 1){
                                          $point_grooming_5 = 1.5;
                                        }elseif($seragam_x_5 == 2){
                                          $point_grooming_5 = 1;
                                        }elseif($seragam_x_5 > 2){
                                          $point_grooming_5 = 0.5;
                                        }

                                        echo $point_grooming_5;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_5 = $point_kedisiplinan_5 + $point_grooming_5;
                                        echo $point_administrasi_5;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">6</td>
                                    <td width=""><?php echo date('F', strtotime('+6 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari6 = date('Y-m-d', strtotime('+5 month',strtotime($dari)));
                                        $sampai6_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari6)));
                                        $sampai6 = date('Y-m-d', strtotime('-1 days',strtotime($sampai6_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari6))."</b> s/d <b>".date("d M Y", strtotime($sampai6))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_sakit_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $count_sakit_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_6 = $count_ijin_6+$count_alpa_6+$count_terlambat_6+$count_masukSiang_6+$count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $seragam_x_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_6 == 0){
                                          $point_kehadiran_6 = 5;
                                        }elseif($jml_ijin_6 >= 1 AND $jml_ijin_6 <= 3){
                                          $point_kehadiran_6 = 4;
                                        }elseif($jml_ijin_6 >= 4 AND $jml_ijin_6 <= 7){
                                          $point_kehadiran_6 = 3;
                                        }elseif($jml_ijin_6 >7){
                                          $point_kehadiran_6 = 2;
                                        }

                                        echo $point_kehadiran_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_6 == 5 OR $point_kehadiran_6 == 4){
                                          $point_kedisiplinan_6 = 3;
                                        }elseif($point_kehadiran_6 == 3 OR $point_kehadiran_6 == 2){
                                          $point_kedisiplinan_6 = 2;
                                        }

                                        echo $point_kedisiplinan_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_6 == 0){
                                          $point_grooming_6 = 2;
                                        }elseif($seragam_x_6 == 1){
                                          $point_grooming_6 = 1.5;
                                        }elseif($seragam_x_6 == 2){
                                          $point_grooming_6 = 1;
                                        }elseif($seragam_x_6 > 2){
                                          $point_grooming_6 = 0.5;
                                        }

                                        echo $point_grooming_6;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_6 = $point_kedisiplinan_6 + $point_grooming_6;
                                        echo $point_administrasi_6;
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">TOTAL</td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_administrasi_1+$point_administrasi_2+$point_administrasi_3+$point_administrasi_4+$point_administrasi_5+$point_administrasi_6; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">
                                      RATA-RATA
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6)/6),1)." Hari"; 
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6)/6),1)." Hari";
                                      ?>  
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6)/6),1)." Hari";
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6)/6),1);
                                      ?>
                                    </td>  
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6)+(($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                                      ?>
                                    </td>
                                  </tr>
                                </table>

                              </div>

                            <?php }else{ ?>

                              <!-- --------------------------------- 3 Bulan STAFF ---------------------------->
                              
                            <?php } ?>
                            </div>

                            <div class="row">
                              <table class="table table-sm table-striped" style="font-size: 12px;">
                                <thead>
                                  <tr align="center">
                                    <th width="5%">#</th>
                                    <th>Aspek Penilaian</th>
                                    <th width="15%">Nilai Point</th>
                                    <th width="15%">Nilai Value</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><b>3.</b></td>
                                    <td colspan="2"><b>Tertib Administrasi (Grooming, kedisiplinan)</b></td>
                                    <td align="center">
                                      <?php
                                        echo (($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6)+(($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6)
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Grooming</td>
                                    <td align="center">2</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_grooming" max="2" value="<?php echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kedisiplinan</td>
                                    <td align="center">3</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kedisiplinan" max="3" value="<?php echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td><b>4.</b></td>
                                    <td colspan="3"><b>Kehadiran</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kehadiran</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kehadiran" max="5" value="<?php echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6)/6),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"><b>Aspek Kerohanian (Bonus)</b></td>
                                  </tr>
                                  <tr>
                                    <td><b>6.</b></td>
                                    <td colspan="3"><b>Program OWOJ</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>OWOJ</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_owoj" max="5" required></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>

                            <br>
                            <div class="row">
                              <div class="col-4"></div>
                              <div class="col-4">
                                <center>
                                  <?php
                                    $cek_data_evaluasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM evaluasi WHERE nik = '$_GET[nik_karyawan]' AND semester = '$_GET[semester]'"));
                                    if($cek_data_evaluasi > 0){
                                  ?>
                                    <small><i style="color: red;">*Data penilaian ini sudah ada</i></small>
                                    <input type="button" class="form-control btn btn-success disabled" value="Submit">
                                  <?php }else{ ?>
                                    <input type="submit" class="form-control btn btn-success" name="submit_evaluasi" value="Submit">
                                  <?php } ?>
                                </center>
                              </div>
                            </div>

                          </form>
                        
                  
                  <!-- ------------------------------------------- FUNGSIONAL -------------------------------------------- -->
                  <?php
                      }elseif($_GET['jabatan']=="Fungsional"){
                        $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[nik_karyawan]'"));
                        $getJabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jabatan WHERE id = '$getKaryawan[jabatan_id]'"));
                  ?>
                        <center><b>FORMULIR PENILAIAN PRESTASI KERJA</b></center>
                        <br>
                        <div class="row">
                          <div class="col-6">
                            <table width="100%" class="table table-sm" style="font-size: 12px;">
                              <tr>
                                <td width="30%"><b>Nomor</b></td>
                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    function getRomawi($bln){
                                      switch ($bln){
                                        case 1:
                                            return "I";
                                            break;
                                        case 2:
                                            return "II";
                                            break;
                                        case 3:
                                            return "III";
                                            break;
                                        case 4:
                                            return "IV";
                                            break;
                                        case 5:
                                            return "V";
                                            break;
                                        case 6:
                                            return "VI";
                                            break;
                                        case 7:
                                            return "VII";
                                            break;
                                        case 8:
                                            return "VIII";
                                            break;
                                        case 9:
                                            return "IX";
                                            break;
                                        case 10:
                                            return "X";
                                            break;
                                        case 11:
                                            return "XI";
                                            break;
                                        case 12:
                                            return "XII";
                                            break;
                                      }
                                    }

                                    $bln = date("m", strtotime($_GET['tanggal_penilaian']));
                                    $get_nomor = mysqli_fetch_array(mysqli_query($conn, "SELECT max(id) AS id_max FROM evaluasi"));
                                    $nomor_incr = ($get_nomor['id_max'])+1;
                                    if($nomor_incr < 10){
                                      $nomor_incr = "00".$nomor_incr;
                                    }elseif($nomor_incr < 100){
                                      $nomor_incr = "0".$nomor_incr;
                                    } 

                                    $nomor_fppk = $nomor_incr."/SK-HR/FPPK/".getRomawi($bln)."/".date("Y", strtotime($_GET['tanggal_penilaian']));
                                    echo $nomor_fppk;
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Nama</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $getKaryawan['nama']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>NIK</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $_GET['nik_karyawan']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Jabatan</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo "<b>[".$_GET['jabatan']."]</b> - ".$getJabatan['jabatan']; ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="col-6">
                            <table width="100%" class="table table-sm" style="font-size: 12px;">
                              <tr>
                                <td width="30%"><b>Tanggal Evaluasi</b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo date("d M Y", strtotime($_GET['tanggal_penilaian'])); ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Divisi<b></td>
                                <td width="1%">:</td>
                                <td widtd=""><?php echo $getJabatan['jabatan']; ?></td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Masa Kerja</b></td>
                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    $date1 = date_create($getKaryawan['tgl_masuk']); 
                                    $date2 = date_create($_GET['tanggal_penilaian']); 
                                     
                                    $interval = date_diff($date1, $date2); 
                                     
                                    echo $masa_kerja = "" . $interval->y . " Tahun, " . $interval->m." Bulan, ".$interval->d." Hari";
                                  ?>
                                </td>
                              </tr>
                              <tr>
                                <td width="30%"><b>Periode Penilaian</b></td>

                                <td width="1%">:</td>
                                <td widtd="">
                                  <?php
                                    if($_GET['semester'] != "3 Bulan (Training)" AND $_GET['semester'] != "6 bulan (Training) + Semester 1"){
                                      $dari = date('Y-m-d', strtotime('+'.(6*($_GET['semester']-1)).' month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+'.(6*$_GET['semester']).' month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo "Semester ".$_GET['semester']." <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }elseif($_GET['semester'] == "3 Bulan (Training)"){
                                      $dari = date('Y-m-d', strtotime('+0 month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }elseif($_GET['semester'] == "6 bulan (Training) + Semester 1"){
                                      $dari = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                      $sampai = date('Y-m-d', strtotime('+6 month', strtotime($getKaryawan['tgl_masuk'])));
                                      echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                    }
                                  ?>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>

                        <form method="POST" action="index.php?pages=dbevaluasi">
                            <input type="hidden" name="nomor_fppk" value="<?php echo $nomor_fppk; ?>">
                            <input type="hidden" name="nik_karyawan" value="<?php echo $_GET['nik_karyawan']; ?>">
                            <input type="hidden" name="tgl_evaluasi" value="<?php echo $_GET['tanggal_penilaian']; ?>">
                            <input type="hidden" name="divisi" value="<?php echo $getJabatan['jabatan'];  ?>">
                            <input type="hidden" name="masa_kerja" value="<?php echo $masa_kerja; ?>">
                            <input type="hidden" name="semester" value="<?php echo $_GET['semester']; ?>">
                            <input type="hidden" name="penilaian_dari" value="<?php echo $dari; ?>">
                            <input type="hidden" name="penilaian_sampai" value="<?php echo $sampai; ?>">
                            <input type="hidden" name="jabatan" value="<?php echo $_GET['jabatan']; ?>">

                            <table class="table table-sm table-striped" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th>Aspek Penilaian</th>
                                  <th width="2%">Nilai Point</th>
                                  <th width="8%">Dirut</th>
                                  <th width="8%">Dirop</th>
                                  <th width="8%">Manager/ Leader</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td colspan="6"><b>Aspek Kepribadian</b></td>
                                </tr>
                                <tr>
                                  <td><b>1.</b></td>
                                  <td colspan="5"><b>Inisiatif & komunikatif, perilaku, skill & inovasi, dan loyalitas</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Inisiatif dan Komunikatif</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Perilaku dan Karakter</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Skill dan Inovasi</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Loyalitas</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td><b>2.</b></td>
                                  <td colspan="5"><b>Performance management, kepemimpinan, kemampuan mentorship, dan kemampuan mengorganisasi</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><i>Performance management</i></td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kepemimpinan</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kemampuan <i>mentorship</i></td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kemampuan mengorganisasi</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td><b>3.</b></td>
                                  <td colspan="5"><b>Kerjasama dalam team, kemampuan mengembangkan diri, kualitas hasil pekerjaan dan ketepatan waktu dalam menjalankan tugas</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kerjasama dalam team</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point13_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point13_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point13_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Tangung jawab</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point14_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point14_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point14_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pengembangan diri dan team</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point15_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point15_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point15_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pengembangan aturan</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point16_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point16_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point16_leader" max="1" required></td>
                                </tr>
                              </tbody>
                            </table>

                            <div class="row">
                              <div class="col-3">
                                <center><b>KLASIFIKASI NILAI</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr style="text-align: center;">
                                    <td width="30%" style="font-size: 11px; font-weight: bold;">NILAI MUTU</td>
                                    <td width="70%" style="font-size: 11px; font-weight: bold;">KUALITAS</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">A : 5</td>
                                    <td width="" style="text-align: center;">Sangat Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">B : 4</td>
                                    <td width="" style="text-align: center;">Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">C : 3</td>
                                    <td width="" style="text-align: center;">Cukup</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">D : 2</td>
                                    <td width="" style="text-align: center;">Buruk</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">E : 1</td>
                                    <td width="" style="text-align: center;">Sangat Buruk</td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-3">
                                <center><b>ABSENSI DAN KETERLAMBATAN</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr>
                                    <td width="50%">Sakit</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_sakit = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari' AND tanggal <= '$sampai'"));
                                        echo $count_sakit." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Izin</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_ijin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Alpa</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_alpa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Terlambat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_terlambat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Datang Siang</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Pulang Cepat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-4">
                                <center><b>SARAN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="saran_perbaikan" required></textarea>
                                <br>
                                <center><b>KOMITMEN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="komitmen_perbaikan" required></textarea>
                              </div>
                            </div>


                            <div class="row">

                            <?php if($_GET['semester'] != '3 Bulan (Training)' AND $_GET['semester'] != '6 bulan (Training) + Semester 1'){ ?>
                              <!-- --------------------------------- 6 Bulan FUNGSIONAL ---------------------------->
                              <div class="col-12">
                                <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
                                <table width="100%" class="table table-sm table-bordered" style="font-size: 9px;">
                                  <tr style="text-align: center;">
                                    <td width="1%" style="font-size: 9px; font-weight: bold;">NO</td>
                                    <td width="8%" style="font-size: 9px; font-weight: bold;">BULAN</td>
                                    <td width="19%" style="font-size: 9px; font-weight: bold;">TANGGAL</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SAKIT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">IZIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">ALPA</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">TERLAM BAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">DATANG SIANG</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">PULANG CEPAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">JUMLAH IJIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SERAGAM (X)</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEHADIRAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEDISIPLINAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT GROOMING</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT TERTIB ADMINISTRASI</td>
                                  </tr>
                                  <tr>
                                    <td width="">1</td>
                                    <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;"> 
                                      <?php
                                        $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                                        $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                                        $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $count_sakit_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_1 = $count_ijin_1+$count_alpa_1+$count_terlambat_1+$count_masukSiang_1+$count_pulangCepat_1." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $seragam_x_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_1 == 0){
                                          $point_kehadiran_1 = 5;
                                        }elseif($jml_ijin_1 >= 1 AND $jml_ijin_1 <= 3){
                                          $point_kehadiran_1 = 4;
                                        }elseif($jml_ijin_1 >= 4 AND $jml_ijin_1 <= 7){
                                          $point_kehadiran_1 = 3;
                                        }elseif($jml_ijin_1 >7){
                                          $point_kehadiran_1 = 2;
                                        }

                                        echo $point_kehadiran_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_1 == 5 OR $point_kehadiran_1 == 4){
                                          $point_kedisiplinan_1 = 3;
                                        }elseif($point_kehadiran_1 == 3 OR $point_kehadiran_1 == 2){
                                          $point_kedisiplinan_1 = 2;
                                        }

                                        echo $point_kedisiplinan_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_1 == 0){
                                          $point_grooming_1 = 2;
                                        }elseif($seragam_x_1 == 1){
                                          $point_grooming_1 = 1.5;
                                        }elseif($seragam_x_1 == 2){
                                          $point_grooming_1 = 1;
                                        }elseif($seragam_x_1 > 2){
                                          $point_grooming_1 = 0.5;
                                        }

                                        echo $point_grooming_1;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_1 = $point_kedisiplinan_1 + $point_grooming_1;
                                        echo $point_administrasi_1;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">2</td>
                                    <td width=""><?php echo date('F', strtotime('+2 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                                        $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                                        $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $count_sakit_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_2 = $count_ijin_2+$count_alpa_2+$count_terlambat_2+$count_masukSiang_2+$count_pulangCepat_2." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $seragam_x_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_2 == 0){
                                          $point_kehadiran_2 = 5;
                                        }elseif($jml_ijin_2 >= 1 AND $jml_ijin_2 <= 3){
                                          $point_kehadiran_2 = 4;
                                        }elseif($jml_ijin_2 >= 4 AND $jml_ijin_2 <= 7){
                                          $point_kehadiran_2 = 3;
                                        }elseif($jml_ijin_2 >7){
                                          $point_kehadiran_2 = 2;
                                        }

                                        echo $point_kehadiran_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_2 == 5 OR $point_kehadiran_2 == 4){
                                          $point_kedisiplinan_2 = 3;
                                        }elseif($point_kehadiran_2 == 3 OR $point_kehadiran_2 == 2){
                                          $point_kedisiplinan_2 = 2;
                                        }

                                        echo $point_kedisiplinan_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_2 == 0){
                                          $point_grooming_2 = 2;
                                        }elseif($seragam_x_2 == 1){
                                          $point_grooming_2 = 1.5;
                                        }elseif($seragam_x_2 == 2){
                                          $point_grooming_2 = 1;
                                        }elseif($seragam_x_2 > 2){
                                          $point_grooming_2 = 0.5;
                                        }

                                        echo $point_grooming_2;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_2 = $point_kedisiplinan_2 + $point_grooming_2;
                                        echo $point_administrasi_2;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">3</td>
                                    <td width=""><?php echo date('F', strtotime('+3 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                                        $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                                        $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $count_sakit_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_3 = $count_ijin_3+$count_alpa_3+$count_terlambat_3+$count_masukSiang_3+$count_pulangCepat_3." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $seragam_x_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_3 == 0){
                                          $point_kehadiran_3 = 5;
                                        }elseif($jml_ijin_3 >= 1 AND $jml_ijin_3 <= 3){
                                          $point_kehadiran_3 = 4;
                                        }elseif($jml_ijin_3 >= 4 AND $jml_ijin_3 <= 7){
                                          $point_kehadiran_3 = 3;
                                        }elseif($jml_ijin_3 >7){
                                          $point_kehadiran_3 = 2;
                                        }

                                        echo $point_kehadiran_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_3 == 5 OR $point_kehadiran_3 == 4){
                                          $point_kedisiplinan_3 = 3;
                                        }elseif($point_kehadiran_3 == 3 OR $point_kehadiran_3 == 2){
                                          $point_kedisiplinan_3 = 2;
                                        }

                                        echo $point_kedisiplinan_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_3 == 0){
                                          $point_grooming_3 = 2;
                                        }elseif($seragam_x_3 == 1){
                                          $point_grooming_3 = 1.5;
                                        }elseif($seragam_x_3 == 2){
                                          $point_grooming_3 = 1;
                                        }elseif($seragam_x_3 > 2){
                                          $point_grooming_3 = 0.5;
                                        }

                                        echo $point_grooming_3;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_3 = $point_kedisiplinan_3 + $point_grooming_3;
                                        echo $point_administrasi_3;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">4</td>
                                    <td width=""><?php echo date('F', strtotime('+4 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari4 = date('Y-m-d', strtotime('+3 month',strtotime($dari)));
                                        $sampai4_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari4)));
                                        $sampai4 = date('Y-m-d', strtotime('-1 days',strtotime($sampai4_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari4))."</b> s/d <b>".date("d M Y", strtotime($sampai4))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $count_sakit_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_4 = $count_ijin_4+$count_alpa_4+$count_terlambat_4+$count_masukSiang_4+$count_pulangCepat_4." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $seragam_x_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_4 == 0){
                                          $point_kehadiran_4 = 5;
                                        }elseif($jml_ijin_4 >= 1 AND $jml_ijin_4 <= 3){
                                          $point_kehadiran_4 = 4;
                                        }elseif($jml_ijin_4 >= 4 AND $jml_ijin_4 <= 7){
                                          $point_kehadiran_4 = 3;
                                        }elseif($jml_ijin_4 >7){
                                          $point_kehadiran_4 = 2;
                                        }

                                        echo $point_kehadiran_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_4 == 5 OR $point_kehadiran_4 == 4){
                                          $point_kedisiplinan_4 = 3;
                                        }elseif($point_kehadiran_4 == 3 OR $point_kehadiran_4 == 2){
                                          $point_kedisiplinan_4 = 2;
                                        }

                                        echo $point_kedisiplinan_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_4 == 0){
                                          $point_grooming_4 = 2;
                                        }elseif($seragam_x_4 == 1){
                                          $point_grooming_4 = 1.5;
                                        }elseif($seragam_x_4 == 2){
                                          $point_grooming_4 = 1;
                                        }elseif($seragam_x_4 > 2){
                                          $point_grooming_4 = 0.5;
                                        }

                                        echo $point_grooming_4;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_4 = $point_kedisiplinan_4 + $point_grooming_4;
                                        echo $point_administrasi_4;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">5</td>
                                    <td width=""><?php echo date('F', strtotime('+5 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari5 = date('Y-m-d', strtotime('+4 month',strtotime($dari)));
                                        $sampai5_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari5)));
                                        $sampai5 = date('Y-m-d', strtotime('-1 days',strtotime($sampai5_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari5))."</b> s/d <b>".date("d M Y", strtotime($sampai5))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $count_sakit_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_5 = $count_ijin_5+$count_alpa_5+$count_terlambat_5+$count_masukSiang_5+$count_pulangCepat_5." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $seragam_x_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_5 == 0){
                                          $point_kehadiran_5 = 5;
                                        }elseif($jml_ijin_5 >= 1 AND $jml_ijin_5 <= 3){
                                          $point_kehadiran_5 = 4;
                                        }elseif($jml_ijin_5 >= 4 AND $jml_ijin_5 <= 7){
                                          $point_kehadiran_5 = 3;
                                        }elseif($jml_ijin_5 >7){
                                          $point_kehadiran_5 = 2;
                                        }

                                        echo $point_kehadiran_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_5 == 5 OR $point_kehadiran_5 == 4){
                                          $point_kedisiplinan_5 = 3;
                                        }elseif($point_kehadiran_5 == 3 OR $point_kehadiran_5 == 2){
                                          $point_kedisiplinan_5 = 2;
                                        }

                                        echo $point_kedisiplinan_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_5 == 0){
                                          $point_grooming_5 = 2;
                                        }elseif($seragam_x_5 == 1){
                                          $point_grooming_5 = 1.5;
                                        }elseif($seragam_x_5 == 2){
                                          $point_grooming_5 = 1;
                                        }elseif($seragam_x_5 > 2){
                                          $point_grooming_5 = 0.5;
                                        }

                                        echo $point_grooming_5;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_5 = $point_kedisiplinan_5 + $point_grooming_5;
                                        echo $point_administrasi_5;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">6</td>
                                    <td width=""><?php echo date('F', strtotime('+6 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari6 = date('Y-m-d', strtotime('+5 month',strtotime($dari)));
                                        $sampai6_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari6)));
                                        $sampai6 = date('Y-m-d', strtotime('-1 days',strtotime($sampai6_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari6))."</b> s/d <b>".date("d M Y", strtotime($sampai6))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_sakit_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $count_sakit_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_6 = $count_ijin_6+$count_alpa_6+$count_terlambat_6+$count_masukSiang_6+$count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $seragam_x_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_6 == 0){
                                          $point_kehadiran_6 = 5;
                                        }elseif($jml_ijin_6 >= 1 AND $jml_ijin_6 <= 3){
                                          $point_kehadiran_6 = 4;
                                        }elseif($jml_ijin_6 >= 4 AND $jml_ijin_6 <= 7){
                                          $point_kehadiran_6 = 3;
                                        }elseif($jml_ijin_6 >7){
                                          $point_kehadiran_6 = 2;
                                        }

                                        echo $point_kehadiran_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_6 == 5 OR $point_kehadiran_6 == 4){
                                          $point_kedisiplinan_6 = 3;
                                        }elseif($point_kehadiran_6 == 3 OR $point_kehadiran_6 == 2){
                                          $point_kedisiplinan_6 = 2;
                                        }

                                        echo $point_kedisiplinan_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_6 == 0){
                                          $point_grooming_6 = 2;
                                        }elseif($seragam_x_6 == 1){
                                          $point_grooming_6 = 1.5;
                                        }elseif($seragam_x_6 == 2){
                                          $point_grooming_6 = 1;
                                        }elseif($seragam_x_6 > 2){
                                          $point_grooming_6 = 0.5;
                                        }

                                        echo $point_grooming_6;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_6 = $point_kedisiplinan_6 + $point_grooming_6;
                                        echo $point_administrasi_6;
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">TOTAL</td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_administrasi_1+$point_administrasi_2+$point_administrasi_3+$point_administrasi_4+$point_administrasi_5+$point_administrasi_6; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">
                                      RATA-RATA
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6)/6),1)." Hari"; 
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6)/6),1)." Hari";
                                      ?>  
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6)/6),1)." Hari";
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6)/6),1);
                                      ?>
                                    </td>  
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6)+(($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                                      ?>
                                    </td>
                                  </tr>
                                </table>

                              </div>

                            <?php }else{ ?>

                              <!-- --------------------------------- 3 Bulan FUNGSIONAL ---------------------------->
                              
                            <?php } ?>
                            </div>

                            <div class="row">
                              <table class="table table-sm table-striped" style="font-size: 12px;">
                                <thead>
                                  <tr align="center">
                                    <th width="5%">#</th>
                                    <th>Aspek Penilaian</th>
                                    <th width="15%">Nilai Point</th>
                                    <th width="15%">Nilai Value</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><b>4.</b></td>
                                    <td colspan="2"><b>Tertib Administrasi (Grooming, kedisiplinan)</b></td>
                                    <td align="center">
                                      <?php
                                        echo (($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6)+(($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6)
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Grooming</td>
                                    <td align="center">2</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_grooming" max="2" value="<?php echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kedisiplinan</td>
                                    <td align="center">3</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kedisiplinan" max="3" value="<?php echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td><b>5.</b></td>
                                    <td colspan="3"><b>Kehadiran</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kehadiran</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kehadiran" max="5" value="<?php echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6)/6),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"><b>Aspek Kerohanian (Bonus)</b></td>
                                  </tr>
                                  <tr>
                                    <td><b>6.</b></td>
                                    <td colspan="3"><b>Program OWOJ</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>OWOJ</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_owoj" max="5" required></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>

                            <br>
                            <div class="row">
                              <div class="col-4"></div>
                              <div class="col-4">
                                <center>
                                  <?php
                                    $cek_data_evaluasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM evaluasi WHERE nik = '$_GET[nik_karyawan]' AND semester = '$_GET[semester]'"));
                                    if($cek_data_evaluasi > 0){
                                  ?>
                                    <small><i style="color: red;">*Data penilaian ini sudah ada</i></small>
                                    <input type="button" class="form-control btn btn-success disabled" value="Submit">
                                  <?php }else{ ?>
                                    <input type="submit" class="form-control btn btn-success" name="submit_evaluasi" value="Submit">
                                  <?php } ?>
                                </center>
                              </div>
                            </div>

                          </form>


                  <!-- ------------------------------------------- MANAGER -------------------------------------------- -->
                  <?php

                      }elseif($_GET['jabatan']=="Manager"){
                        $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[nik_karyawan]'"));
                        $getJabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jabatan WHERE id = '$getKaryawan[jabatan_id]'"));
                  ?>

                        <center><b>FORMULIR PENILAIAN PRESTASI KERJA</b></center>
                          <br>
                          <div class="row">
                            <div class="col-6">
                              <table width="100%" class="table table-sm" style="font-size: 12px;">
                                <tr>
                                  <td width="30%"><b>Nomor</b></td>
                                  <td width="1%">:</td>
                                  <td widtd="">
                                    <?php
                                      function getRomawi($bln){
                                        switch ($bln){
                                          case 1:
                                              return "I";
                                              break;
                                          case 2:
                                              return "II";
                                              break;
                                          case 3:
                                              return "III";
                                              break;
                                          case 4:
                                              return "IV";
                                              break;
                                          case 5:
                                              return "V";
                                              break;
                                          case 6:
                                              return "VI";
                                              break;
                                          case 7:
                                              return "VII";
                                              break;
                                          case 8:
                                              return "VIII";
                                              break;
                                          case 9:
                                              return "IX";
                                              break;
                                          case 10:
                                              return "X";
                                              break;
                                          case 11:
                                              return "XI";
                                              break;
                                          case 12:
                                              return "XII";
                                              break;
                                        }
                                      }

                                      $bln = date("m", strtotime($_GET['tanggal_penilaian']));
                                      $get_nomor = mysqli_fetch_array(mysqli_query($conn, "SELECT max(id) AS id_max FROM evaluasi"));
                                      $nomor_incr = ($get_nomor['id_max'])+1;
                                      if($nomor_incr < 10){
                                        $nomor_incr = "00".$nomor_incr;
                                      }elseif($nomor_incr < 100){
                                        $nomor_incr = "0".$nomor_incr;
                                      } 

                                      $nomor_fppk = $nomor_incr."/SK-HR/FPPK/".getRomawi($bln)."/".date("Y", strtotime($_GET['tanggal_penilaian']));
                                      echo $nomor_fppk;
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>Nama</b></td>
                                  <td width="1%">:</td>
                                  <td widtd=""><?php echo $getKaryawan['nama']; ?></td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>NIK</b></td>
                                  <td width="1%">:</td>
                                  <td widtd=""><?php echo $_GET['nik_karyawan']; ?></td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>Jabatan</b></td>
                                  <td width="1%">:</td>
                                  <td widtd=""><?php echo "<b>[".$_GET['jabatan']."]</b> - ".$getJabatan['jabatan']; ?></td>
                                </tr>
                              </table>
                            </div>
                            <div class="col-6">
                              <table width="100%" class="table table-sm" style="font-size: 12px;">
                                <tr>
                                  <td width="30%"><b>Tanggal Evaluasi</b></td>
                                  <td width="1%">:</td>
                                  <td widtd=""><?php echo date("d M Y", strtotime($_GET['tanggal_penilaian'])); ?></td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>Divisi<b></td>
                                  <td width="1%">:</td>
                                  <td widtd=""><?php echo $getJabatan['jabatan']; ?></td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>Masa Kerja</b></td>
                                  <td width="1%">:</td>
                                  <td widtd="">
                                    <?php
                                      $date1 = date_create($getKaryawan['tgl_masuk']); 
                                      $date2 = date_create($_GET['tanggal_penilaian']); 
                                       
                                      $interval = date_diff($date1, $date2); 
                                       
                                      echo $masa_kerja = "" . $interval->y . " Tahun, " . $interval->m." Bulan, ".$interval->d." Hari";
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="30%"><b>Periode Penilaian</b></td>

                                  <td width="1%">:</td>
                                  <td widtd="">
                                    <?php
                                      if($_GET['semester'] != "3 Bulan (Training)" AND $_GET['semester'] != "6 bulan (Training) + Semester 1"){
                                        $dari = date('Y-m-d', strtotime('+'.(6*($_GET['semester']-1)).' month', strtotime($getKaryawan['tgl_masuk'])));
                                        $sampai = date('Y-m-d', strtotime('+'.(6*$_GET['semester']).' month', strtotime($getKaryawan['tgl_masuk'])));
                                        echo "Semester ".$_GET['semester']." <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                      }elseif($_GET['semester'] == "3 Bulan (Training)"){
                                        $dari = date('Y-m-d', strtotime('+0 month', strtotime($getKaryawan['tgl_masuk'])));
                                        $sampai = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                        echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                      }elseif($_GET['semester'] == "6 bulan (Training) + Semester 1"){
                                        $dari = date('Y-m-d', strtotime('+3 month', strtotime($getKaryawan['tgl_masuk'])));
                                        $sampai = date('Y-m-d', strtotime('+6 month', strtotime($getKaryawan['tgl_masuk'])));
                                        echo $_GET['semester']."<br> <small>(".date("d M Y", strtotime($dari))." s/d ".date("d M Y", strtotime($sampai)).")</small>";
                                      }
                                    ?>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                          <form method="POST" action="index.php?pages=dbevaluasi">
                            <input type="hidden" name="nomor_fppk" value="<?php echo $nomor_fppk; ?>">
                            <input type="hidden" name="nik_karyawan" value="<?php echo $_GET['nik_karyawan']; ?>">
                            <input type="hidden" name="tgl_evaluasi" value="<?php echo $_GET['tanggal_penilaian']; ?>">
                            <input type="hidden" name="divisi" value="<?php echo $getJabatan['jabatan'];  ?>">
                            <input type="hidden" name="masa_kerja" value="<?php echo $masa_kerja; ?>">
                            <input type="hidden" name="semester" value="<?php echo $_GET['semester']; ?>">
                            <input type="hidden" name="penilaian_dari" value="<?php echo $dari; ?>">
                            <input type="hidden" name="penilaian_sampai" value="<?php echo $sampai; ?>">
                            <input type="hidden" name="jabatan" value="<?php echo $_GET['jabatan']; ?>">

                            <table class="table table-sm table-striped" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="5%">#</th>
                                  <th>Aspek Penilaian</th>
                                  <th width="2%">Nilai Point</th>
                                  <th width="8%">Dirut</th>
                                  <th width="8%">Dirop</th>
                                  <th width="8%">Manager/ Leader</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td colspan="6"><b>Aspek Kepribadian</b></td>
                                </tr>
                                <tr>
                                  <td><b>1.</b></td>
                                  <td colspan="5"><b>Inisiatif & komunikatif, perilaku, skill & inovasi, dan loyalitas</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Inisiatif dan Komunikatif</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point1_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Perilaku dan Karakter</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point2_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Skill dan Inovasi</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point3_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Loyalitas</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point4_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td><b>2.</b></td>
                                  <td colspan="5"><b>Performance management, kepemimpinan, kemampuan mentorship, dan kemampuan mengorganisasi</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td><i>Performance management</i></td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point5_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kepemimpinan</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point6_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kemampuan <i>mentorship</i></td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point7_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kemampuan mengorganisasi</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point8_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td><b>3.</b></td>
                                  <td colspan="5"><b>Pemecahan masalah & solusi, pengendalian & pengembangan team, perencanaan dan pemikiran strategis, dan pengambilan keputusan</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pemecahan masalah dan Solusi</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point9_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point9_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point9_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pengendalian dan pengembangan team</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point10_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point10_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point10_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Perencanaan dan pemikiran strategis</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point11_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point11_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point11_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pengambilan keputusan</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point12_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point12_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point12_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td><b>4.</b></td>
                                  <td colspan="5"><b>Kerjasama dalam team, kemampuan mengembangkan diri, kualitas hasil pekerjaan dan ketepatan waktu dalam menjalankan tugas</b></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Kerjasama dalam team</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point13_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point13_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point13_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Tangung jawab</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point14_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point14_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point14_leader" max="1" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pengembangan diri dan team</td>
                                  <td align="center">2</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point15_dirut" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point15_dirop" max="2" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point15_leader" max="2" required></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td>Pengembangan aturan</td>
                                  <td align="center">1</td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point16_dirut" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point16_dirop" max="1" required></td>
                                  <td><input type="number" class="form-control form-control-sm" step="0.01" name="point16_leader" max="1" required></td>
                                </tr>
                              </tbody>
                            </table>

                            <div class="row">
                              <div class="col-3">
                                <center><b>KLASIFIKASI NILAI</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr style="text-align: center;">
                                    <td width="30%" style="font-size: 11px; font-weight: bold;">NILAI MUTU</td>
                                    <td width="70%" style="font-size: 11px; font-weight: bold;">KUALITAS</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">A : 5</td>
                                    <td width="" style="text-align: center;">Sangat Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">B : 4</td>
                                    <td width="" style="text-align: center;">Baik</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">C : 3</td>
                                    <td width="" style="text-align: center;">Cukup</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">D : 2</td>
                                    <td width="" style="text-align: center;">Buruk</td>
                                  </tr>
                                  <tr>
                                    <td width="25%">E : 1</td>
                                    <td width="" style="text-align: center;">Sangat Buruk</td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-3">
                                <center><b>ABSENSI DAN KETERLAMBATAN</b></center>
                                <table width="100%" class="table table-sm" style="font-size: 11px;">
                                  <tr>
                                    <td width="50%">Sakit</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_sakit = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari' AND tanggal <= '$sampai'"));
                                        echo $count_sakit." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Izin</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_ijin = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Alpa</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_alpa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Terlambat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_terlambat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Datang Siang</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="50%">Pulang Cepat</td>
                                    <td width="">:</td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari' AND tanggal <= '$sampai' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat." Hari";
                                      ?>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                              <div class="col-1"></div>
                              <div class="col-4">
                                <center><b>SARAN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="saran_perbaikan" required></textarea>
                                <br>
                                <center><b>KOMITMEN DAN PERBAIKAN</b></center>
                                <textarea class="form-control" name="komitmen_perbaikan" required></textarea>
                              </div>
                            </div>


                            <div class="row">

                            <?php if($_GET['semester'] != '3 Bulan (Training)' AND $_GET['semester'] != '6 bulan (Training) + Semester 1'){ ?>
                              <!-- --------------------------------- 6 Bulan MANAGER ---------------------------->
                              <div class="col-12">
                                <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
                                <table width="100%" class="table table-sm table-bordered" style="font-size: 9px;">
                                  <tr style="text-align: center;">
                                    <td width="1%" style="font-size: 9px; font-weight: bold;">NO</td>
                                    <td width="8%" style="font-size: 9px; font-weight: bold;">BULAN</td>
                                    <td width="19%" style="font-size: 9px; font-weight: bold;">TANGGAL</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SAKIT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">IZIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">ALPA</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">TERLAM BAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">DATANG SIANG</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">PULANG CEPAT</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">JUMLAH IJIN</td>
                                    <td width="7%" style="font-size: 9px; font-weight: bold;">SERAGAM (X)</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEHADIRAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT KEDISIPLINAN</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT GROOMING</td>
                                    <td width="6%" style="font-size: 8px; font-weight: bold;">POINT TERTIB ADMINISTRASI</td>
                                  </tr>
                                  <tr>
                                    <td width="">1</td>
                                    <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;"> 
                                      <?php
                                        $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                                        $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                                        $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $count_sakit_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_1." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_1 = $count_ijin_1+$count_alpa_1+$count_terlambat_1+$count_masukSiang_1+$count_pulangCepat_1." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                                        echo $seragam_x_1." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_1 == 0){
                                          $point_kehadiran_1 = 5;
                                        }elseif($jml_ijin_1 >= 1 AND $jml_ijin_1 <= 3){
                                          $point_kehadiran_1 = 4;
                                        }elseif($jml_ijin_1 >= 4 AND $jml_ijin_1 <= 7){
                                          $point_kehadiran_1 = 3;
                                        }elseif($jml_ijin_1 >7){
                                          $point_kehadiran_1 = 2;
                                        }

                                        echo $point_kehadiran_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_1 == 5 OR $point_kehadiran_1 == 4){
                                          $point_kedisiplinan_1 = 3;
                                        }elseif($point_kehadiran_1 == 3 OR $point_kehadiran_1 == 2){
                                          $point_kedisiplinan_1 = 2;
                                        }

                                        echo $point_kedisiplinan_1;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_1 == 0){
                                          $point_grooming_1 = 2;
                                        }elseif($seragam_x_1 == 1){
                                          $point_grooming_1 = 1.5;
                                        }elseif($seragam_x_1 == 2){
                                          $point_grooming_1 = 1;
                                        }elseif($seragam_x_1 > 2){
                                          $point_grooming_1 = 0.5;
                                        }

                                        echo $point_grooming_1;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_1 = $point_kedisiplinan_1 + $point_grooming_1;
                                        echo $point_administrasi_1;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">2</td>
                                    <td width=""><?php echo date('F', strtotime('+2 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                                        $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                                        $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $count_sakit_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_2." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_2 = $count_ijin_2+$count_alpa_2+$count_terlambat_2+$count_masukSiang_2+$count_pulangCepat_2." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                                        echo $seragam_x_2." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_2 == 0){
                                          $point_kehadiran_2 = 5;
                                        }elseif($jml_ijin_2 >= 1 AND $jml_ijin_2 <= 3){
                                          $point_kehadiran_2 = 4;
                                        }elseif($jml_ijin_2 >= 4 AND $jml_ijin_2 <= 7){
                                          $point_kehadiran_2 = 3;
                                        }elseif($jml_ijin_2 >7){
                                          $point_kehadiran_2 = 2;
                                        }

                                        echo $point_kehadiran_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_2 == 5 OR $point_kehadiran_2 == 4){
                                          $point_kedisiplinan_2 = 3;
                                        }elseif($point_kehadiran_2 == 3 OR $point_kehadiran_2 == 2){
                                          $point_kedisiplinan_2 = 2;
                                        }

                                        echo $point_kedisiplinan_2;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_2 == 0){
                                          $point_grooming_2 = 2;
                                        }elseif($seragam_x_2 == 1){
                                          $point_grooming_2 = 1.5;
                                        }elseif($seragam_x_2 == 2){
                                          $point_grooming_2 = 1;
                                        }elseif($seragam_x_2 > 2){
                                          $point_grooming_2 = 0.5;
                                        }

                                        echo $point_grooming_2;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_2 = $point_kedisiplinan_2 + $point_grooming_2;
                                        echo $point_administrasi_2;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">3</td>
                                    <td width=""><?php echo date('F', strtotime('+3 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                                        $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                                        $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $count_sakit_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_3." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_3 = $count_ijin_3+$count_alpa_3+$count_terlambat_3+$count_masukSiang_3+$count_pulangCepat_3." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                                        echo $seragam_x_3." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_3 == 0){
                                          $point_kehadiran_3 = 5;
                                        }elseif($jml_ijin_3 >= 1 AND $jml_ijin_3 <= 3){
                                          $point_kehadiran_3 = 4;
                                        }elseif($jml_ijin_3 >= 4 AND $jml_ijin_3 <= 7){
                                          $point_kehadiran_3 = 3;
                                        }elseif($jml_ijin_3 >7){
                                          $point_kehadiran_3 = 2;
                                        }

                                        echo $point_kehadiran_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_3 == 5 OR $point_kehadiran_3 == 4){
                                          $point_kedisiplinan_3 = 3;
                                        }elseif($point_kehadiran_3 == 3 OR $point_kehadiran_3 == 2){
                                          $point_kedisiplinan_3 = 2;
                                        }

                                        echo $point_kedisiplinan_3;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_3 == 0){
                                          $point_grooming_3 = 2;
                                        }elseif($seragam_x_3 == 1){
                                          $point_grooming_3 = 1.5;
                                        }elseif($seragam_x_3 == 2){
                                          $point_grooming_3 = 1;
                                        }elseif($seragam_x_3 > 2){
                                          $point_grooming_3 = 0.5;
                                        }

                                        echo $point_grooming_3;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_3 = $point_kedisiplinan_3 + $point_grooming_3;
                                        echo $point_administrasi_3;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">4</td>
                                    <td width=""><?php echo date('F', strtotime('+4 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari4 = date('Y-m-d', strtotime('+3 month',strtotime($dari)));
                                        $sampai4_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari4)));
                                        $sampai4 = date('Y-m-d', strtotime('-1 days',strtotime($sampai4_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari4))."</b> s/d <b>".date("d M Y", strtotime($sampai4))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $count_sakit_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_4." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_4 = $count_ijin_4+$count_alpa_4+$count_terlambat_4+$count_masukSiang_4+$count_pulangCepat_4." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                                        echo $seragam_x_4." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_4 == 0){
                                          $point_kehadiran_4 = 5;
                                        }elseif($jml_ijin_4 >= 1 AND $jml_ijin_4 <= 3){
                                          $point_kehadiran_4 = 4;
                                        }elseif($jml_ijin_4 >= 4 AND $jml_ijin_4 <= 7){
                                          $point_kehadiran_4 = 3;
                                        }elseif($jml_ijin_4 >7){
                                          $point_kehadiran_4 = 2;
                                        }

                                        echo $point_kehadiran_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_4 == 5 OR $point_kehadiran_4 == 4){
                                          $point_kedisiplinan_4 = 3;
                                        }elseif($point_kehadiran_4 == 3 OR $point_kehadiran_4 == 2){
                                          $point_kedisiplinan_4 = 2;
                                        }

                                        echo $point_kedisiplinan_4;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_4 == 0){
                                          $point_grooming_4 = 2;
                                        }elseif($seragam_x_4 == 1){
                                          $point_grooming_4 = 1.5;
                                        }elseif($seragam_x_4 == 2){
                                          $point_grooming_4 = 1;
                                        }elseif($seragam_x_4 > 2){
                                          $point_grooming_4 = 0.5;
                                        }

                                        echo $point_grooming_4;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_4 = $point_kedisiplinan_4 + $point_grooming_4;
                                        echo $point_administrasi_4;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">5</td>
                                    <td width=""><?php echo date('F', strtotime('+5 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari5 = date('Y-m-d', strtotime('+4 month',strtotime($dari)));
                                        $sampai5_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari5)));
                                        $sampai5 = date('Y-m-d', strtotime('-1 days',strtotime($sampai5_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari5))."</b> s/d <b>".date("d M Y", strtotime($sampai5))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_sakit_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $count_sakit_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_5." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_5 = $count_ijin_5+$count_alpa_5+$count_terlambat_5+$count_masukSiang_5+$count_pulangCepat_5." Hari"; 
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                                        echo $seragam_x_5." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_5 == 0){
                                          $point_kehadiran_5 = 5;
                                        }elseif($jml_ijin_5 >= 1 AND $jml_ijin_5 <= 3){
                                          $point_kehadiran_5 = 4;
                                        }elseif($jml_ijin_5 >= 4 AND $jml_ijin_5 <= 7){
                                          $point_kehadiran_5 = 3;
                                        }elseif($jml_ijin_5 >7){
                                          $point_kehadiran_5 = 2;
                                        }

                                        echo $point_kehadiran_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_5 == 5 OR $point_kehadiran_5 == 4){
                                          $point_kedisiplinan_5 = 3;
                                        }elseif($point_kehadiran_5 == 3 OR $point_kehadiran_5 == 2){
                                          $point_kedisiplinan_5 = 2;
                                        }

                                        echo $point_kedisiplinan_5;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_5 == 0){
                                          $point_grooming_5 = 2;
                                        }elseif($seragam_x_5 == 1){
                                          $point_grooming_5 = 1.5;
                                        }elseif($seragam_x_5 == 2){
                                          $point_grooming_5 = 1;
                                        }elseif($seragam_x_5 > 2){
                                          $point_grooming_5 = 0.5;
                                        }

                                        echo $point_grooming_5;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_5 = $point_kedisiplinan_5 + $point_grooming_5;
                                        echo $point_administrasi_5;
                                      ?>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td width="">6</td>
                                    <td width=""><?php echo date('F', strtotime('+6 month',strtotime($dari))); ?></td>
                                    <td width="" style="font-size: 8px;">
                                      <?php
                                        $dari6 = date('Y-m-d', strtotime('+5 month',strtotime($dari)));
                                        $sampai6_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari6)));
                                        $sampai6 = date('Y-m-d', strtotime('-1 days',strtotime($sampai6_tmp)));

                                        echo "<b>".date("d M Y", strtotime($dari6))."</b> s/d <b>".date("d M Y", strtotime($sampai6))."</b>";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_sakit_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $count_sakit_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_ijin_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                                        echo $count_ijin_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_alpa_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Tanpa Keterangan'"));
                                        echo $count_alpa_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_terlambat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                                        echo $count_terlambat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php
                                        $count_masukSiang_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Izin Masuk Siang'"));
                                        echo $count_masukSiang_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $count_pulangCepat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$_GET[nik_karyawan]' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
                                        echo $count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo $jml_ijin_6 = $count_ijin_6+$count_alpa_6+$count_terlambat_6+$count_masukSiang_6+$count_pulangCepat_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        $seragam_x_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$_GET[nik_karyawan]' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                                        echo $seragam_x_6." Hari";
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($jml_ijin_6 == 0){
                                          $point_kehadiran_6 = 5;
                                        }elseif($jml_ijin_6 >= 1 AND $jml_ijin_6 <= 3){
                                          $point_kehadiran_6 = 4;
                                        }elseif($jml_ijin_6 >= 4 AND $jml_ijin_6 <= 7){
                                          $point_kehadiran_6 = 3;
                                        }elseif($jml_ijin_6 >7){
                                          $point_kehadiran_6 = 2;
                                        }

                                        echo $point_kehadiran_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($point_kehadiran_6 == 5 OR $point_kehadiran_6 == 4){
                                          $point_kedisiplinan_6 = 3;
                                        }elseif($point_kehadiran_6 == 3 OR $point_kehadiran_6 == 2){
                                          $point_kedisiplinan_6 = 2;
                                        }

                                        echo $point_kedisiplinan_6;
                                      ?>
                                    </td>
                                    <td width="">
                                      <?php 
                                        if($seragam_x_6 == 0){
                                          $point_grooming_6 = 2;
                                        }elseif($seragam_x_6 == 1){
                                          $point_grooming_6 = 1.5;
                                        }elseif($seragam_x_6 == 2){
                                          $point_grooming_6 = 1;
                                        }elseif($seragam_x_6 > 2){
                                          $point_grooming_6 = 0.5;
                                        }

                                        echo $point_grooming_6;
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        $point_administrasi_6 = $point_kedisiplinan_6 + $point_grooming_6;
                                        echo $point_administrasi_6;
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">TOTAL</td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6." Hari"; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6; ?></td>
                                    <td width="" style="font-weight: bold;"><?php echo $point_administrasi_1+$point_administrasi_2+$point_administrasi_3+$point_administrasi_4+$point_administrasi_5+$point_administrasi_6; ?></td>
                                  </tr>
                                  <tr>
                                    <td width="" colspan="3" style="font-size: 11px; font-weight: bold; text-align: center;">
                                      RATA-RATA
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_sakit_1+$count_sakit_2+$count_sakit_3+$count_sakit_4+$count_sakit_5+$count_sakit_6)/6),1)." Hari"; 
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_ijin_1+$count_ijin_2+$count_ijin_3+$count_ijin_4+$count_ijin_5+$count_ijin_6)/6),1)." Hari";
                                      ?>  
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($count_alpa_1+$count_alpa_2+$count_alpa_3+$count_alpa_4+$count_alpa_5+$count_alpa_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_terlambat_1+$count_terlambat_2+$count_terlambat_3+$count_terlambat_4+$count_terlambat_5+$count_terlambat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_masukSiang_1+$count_masukSiang_2+$count_masukSiang_3+$count_masukSiang_4+$count_masukSiang_5+$count_masukSiang_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($count_pulangCepat_1+$count_pulangCepat_2+$count_pulangCepat_3+$count_pulangCepat_4+$count_pulangCepat_5+$count_pulangCepat_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($jml_ijin_1+$jml_ijin_2+$jml_ijin_3+$jml_ijin_4+$jml_ijin_5+$jml_ijin_6)/6),1)." Hari";
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($seragam_x_1+$seragam_x_2+$seragam_x_3+$seragam_x_4+$seragam_x_5+$seragam_x_6)/6),1)." Hari";
                                      ?>    
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6)/6),1);
                                      ?>
                                    </td>  
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php
                                        echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                                      ?>
                                    </td>
                                    <td width="" style="font-weight: bold;">
                                      <?php 
                                        echo number_format((($point_administrasi_1+$point_administrasi_2+$point_administrasi_3+$point_administrasi_4+$point_administrasi_5+$point_administrasi_6)/6),1);
                                      ?>
                                    </td>
                                  </tr>
                                </table>

                              </div>

                            <?php }else{ ?>

                              <!-- --------------------------------- 3 Bulan MANAGER ---------------------------->
                              
                            <?php } ?>
                            </div>

                            <div class="row">
                              <table class="table table-sm table-striped" style="font-size: 12px;">
                                <thead>
                                  <tr align="center">
                                    <th width="5%">#</th>
                                    <th>Aspek Penilaian</th>
                                    <th width="15%">Nilai Point</th>
                                    <th width="15%">Nilai Value</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td><b>5.</b></td>
                                    <td colspan="2"><b>Tertib Administrasi (Grooming, kedisiplinan)</b></td>
                                    <td align="center">
                                      <?php
                                        echo (($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6)+(($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6)
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Grooming</td>
                                    <td align="center">2</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_grooming" max="2" value="<?php echo number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kedisiplinan</td>
                                    <td align="center">3</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kedisiplinan" max="3" value="<?php echo number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td><b>6.</b></td>
                                    <td colspan="3"><b>Kehadiran</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>Kehadiran</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_kehadiran" max="5" value="<?php echo $avg_point_kehadiran = number_format((($point_kehadiran_1+$point_kehadiran_2+$point_kehadiran_3+$point_kehadiran_4+$point_kehadiran_5+$point_kehadiran_6)/6),1); ?>" required></td>
                                  </tr>
                                  <tr>
                                    <td colspan="3"><b>Aspek Kerohanian (Bonus)</b></td>
                                  </tr>
                                  <tr>
                                    <td><b>7.</b></td>
                                    <td colspan="3"><b>Program OWOJ</b></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td>OWOJ</td>
                                    <td align="center">5</td>
                                    <td><input type="number" class="form-control form-control-sm" step="0.01" name="point_owoj" max="5" required></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>

                            <br>
                            <div class="row">
                              <div class="col-4"></div>
                              <div class="col-4">
                                <center>
                                  <?php
                                    $cek_data_evaluasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM evaluasi WHERE nik = '$_GET[nik_karyawan]' AND semester = '$_GET[semester]'"));
                                    if($cek_data_evaluasi > 0){
                                  ?>
                                    <small><i style="color: red;">*Data penilaian ini sudah ada</i></small>
                                    <input type="button" class="form-control btn btn-success disabled" value="Submit">
                                  <?php }else{ ?>
                                    <input type="submit" class="form-control btn btn-success" name="submit_evaluasi" value="Submit">
                                  <?php } ?>
                                </center>
                              </div>
                            </div>

                          </form>

                  <?php
                      }
                    }else{
                      echo "<center><small><i>Slilahkan klik open form untuk membuka form evaluasi</i></small></center>";
                    }
                  ?>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
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