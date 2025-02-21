<?php
  session_start();
  error_reporting(0);
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $nomor_fppk = $_POST['getID'];

    $get_evaluasi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM evaluasi WHERE nomor = '$nomor_fppk'"));
    $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_evaluasi[nik]'"));
    $get_jabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jabatan WHERE id = '$get_karyawan[jabatan_id]'"));

    $dari = $get_evaluasi['penilaian_dari'];
    $sampai = $get_evaluasi['penilaian_sampai'];
    $nik_karyawan = $get_evaluasi['nik'];
  }
?>

  <div class="card">
    <div class="card-body">
      <center><b>PENILAIAN PRESTASI KERJA</b></center>
      <br>
      <div class="row">
        <div class="col-6">
          <table width="100%" class="table table-sm" style="font-size: 12px;">
            <tr>
              <td width="30%"><b>Nomor</b></td>
              <td width="1%">:</td>
              <td width=""><?php echo $nomor_fppk; ?></td>
            </tr>
            <tr>
              <td width="30%"><b>Nama</b></td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_karyawan['nama']; ?></td>
            </tr>
            <tr>
              <td width="30%"><b>NIK</b></td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_evaluasi['nik']; ?></td>
            </tr>
            <tr>
              <td width="30%"><b>Jabatan</b></td>
              <td width="1%">:</td>
              <td width=""><?php echo "<b>[".$get_evaluasi['jabatan']."]</b> - ".$get_jabatan["jabatan"]; ?></td>
            </tr>
          </table>
        </div>
        <div class="col-6">
          <table width="100%" class="table table-sm" style="font-size: 12px;">
            <tr>
              <td width="40%"><b>Tanggal Evaluasi</b></td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_evaluasi['tanggal_evaluasi']; ?></td>
            </tr>
            <tr>
              <td width="40%"><b>Divisi<b></td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_evaluasi['divisi']; ?></td>
            </tr>
            <tr>
              <td width="40%"><b>Masa Kerja</b></td>
              <td width="1%">:</td>
              <td width=""><?php echo $get_evaluasi['masa_kerja']; ?></td>
            </tr>
            <tr>
              <td width="40%"><b>Periode Penilaian</b></td>

              <td width="1%">:</td>
              <td width="">
                <?php
                  if($get_evaluasi['semester'] != "3 Bulan (Training)" AND $get_evaluasi['semester'] != "6 bulan (Training) + Semester 1"){
                    echo "Semester ".$get_evaluasi['semester']."<br><small>(".$get_evaluasi['penilaian_dari']." s/d ".$get_evaluasi['penilaian_sampai'].")</small>";
                  }else{
                    echo $get_evaluasi['semester']."<br><small>(".$get_evaluasi['penilaian_dari']." s/d ".$get_evaluasi['penilaian_sampai'].")</small>";
                  }
                ?>  
              </td>
            </tr>
          </table>
        </div>
      </div>

      <!-- --------------------------------------------------------- MANAGER ----------------------------------------------------- -->
      <?php
        if($get_evaluasi['jabatan'] == "Manager"){
      ?>
      <div class="row">
        <table class="table table-sm table-striped" style="font-size: 12px;">
          <thead>
            <tr align="center">
              <th width="5%">#</th>
              <th>Aspek Penilaian</th>
              <th width="2%">Nilai Point</th>
              <th width="8%">Dirut</th>
              <th width="8%">Dirop</th>
              <th width="8%">Manager/ Leader</th>
              <th width="8%">Nilai Akhir</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="7"><b>Aspek Kepribadian</b></td>
            </tr>
            <tr>
              <td><b>1.</b></td>
              <td colspan="5"><b>Inisiatif & komunikatif, perilaku, skill & inovasi, dan loyalitas</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  $avg_point1 = ($get_evaluasi['point1_dirut']+$get_evaluasi['point1_dirop'])/2;
                  $avg_point2 = ($get_evaluasi['point2_dirut']+$get_evaluasi['point2_dirop'])/2;
                  $avg_point3 = ($get_evaluasi['point3_dirut']+$get_evaluasi['point3_dirop'])/2;
                  $avg_point4 = ($get_evaluasi['point4_dirut']+$get_evaluasi['point4_dirop'])/2;

                  echo $nilai_point1 = number_format(($avg_point1+$avg_point2+$avg_point3+$avg_point4),2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Inisiatif dan Komunikatif</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point1_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point1_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point1,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Perilaku dan Karakter</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point2_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point2_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point2,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Skill dan Inovasi</td>
              <td align="center">2</td>
              <td align="center"><?php echo $get_evaluasi['point3_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point3_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point3,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Loyalitas</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point4_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point4_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point4,2); ?></td>
            </tr>
            <tr>
              <td><b>2.</b></td>
              <td colspan="5"><b>Performance management, kepemimpinan, kemampuan mentorship, dan kemampuan mengorganisasi</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  $avg_point5 = ($get_evaluasi['point5_dirut']+$get_evaluasi['point5_dirop'])/2;
                  $avg_point6 = ($get_evaluasi['point6_dirut']+$get_evaluasi['point6_dirop'])/2;
                  $avg_point7 = ($get_evaluasi['point7_dirut']+$get_evaluasi['point7_dirop'])/2;
                  $avg_point8 = ($get_evaluasi['point8_dirut']+$get_evaluasi['point8_dirop'])/2;

                  echo $nilai_point2 = number_format(($avg_point5+$avg_point6+$avg_point7+$avg_point8),2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td><i>Performance management</i></td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point5_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point5_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point5,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Kepemimpinan</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point6_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point6_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point6,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Kemampuan <i>mentorship</i></td>
              <td align="center">2</td>
              <td align="center"><?php echo $get_evaluasi['point7_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point7_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point7,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Kemampuan mengorganisasi</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point8_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point8_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point8,2); ?></td>
            </tr>
            <tr>
              <td><b>3.</b></td>
              <td colspan="5"><b>Pemecahan masalah & solusi, pengendalian & pengembangan team, perencanaan dan pemikiran strategis, dan pengambilan keputusan</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  $avg_point9 = ($get_evaluasi['point9_dirut']+$get_evaluasi['point9_dirop'])/2;
                  $avg_point10 = ($get_evaluasi['point10_dirut']+$get_evaluasi['point10_dirop'])/2;
                  $avg_point11 = ($get_evaluasi['point11_dirut']+$get_evaluasi['point11_dirop'])/2;
                  $avg_point12 = ($get_evaluasi['point12_dirut']+$get_evaluasi['point12_dirop'])/2;

                  echo $nilai_point3 = number_format(($avg_point9+$avg_point10+$avg_point11+$avg_point12),2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Pemecahan masalah dan Solusi</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point9_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point9_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point9,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Pengendalian dan pengembangan team</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point10_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point10_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point10,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Perencanaan dan pemikiran strategis</td>
              <td align="center">2</td>
              <td align="center"><?php echo $get_evaluasi['point11_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point11_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point11,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Pengambilan keputusan</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point12_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point12_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point12,2); ?></td>
            </tr>
            <tr>
              <td><b>4.</b></td>
              <td colspan="5"><b>Kerjasama dalam team, kemampuan mengembangkan diri, kualitas hasil pekerjaan dan ketepatan waktu dalam menjalankan tugas</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  $avg_point13 = ($get_evaluasi['point13_dirut']+$get_evaluasi['point13_dirop'])/2;
                  $avg_point14 = ($get_evaluasi['point14_dirut']+$get_evaluasi['point14_dirop'])/2;
                  $avg_point15 = ($get_evaluasi['point15_dirut']+$get_evaluasi['point15_dirop'])/2;
                  $avg_point16 = ($get_evaluasi['point16_dirut']+$get_evaluasi['point16_dirop'])/2;

                  echo $nilai_point4 = number_format(($avg_point13+$avg_point14+$avg_point15+$avg_point16),2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Kerjasama dalam team</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point13_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point13_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point13,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Tangung jawab</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point14_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point14_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point14,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Pengembangan diri dan team</td>
              <td align="center">2</td>
              <td align="center"><?php echo $get_evaluasi['point15_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point15_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point15,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Pengembangan aturan</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point16_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point16_dirop']; ?></td>
              <td align="center">-</td>
              <td align="center"><?php echo number_format($avg_point16,2); ?></td>
            </tr>
            <tr>
              <td><b>5.</b></td>
              <td colspan="5"><b>Tertib Administrasi (Grooming, kedisiplinan)</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  echo $nilai_point5 = number_format($get_evaluasi['point_grooming']+$get_evaluasi['point_kedisiplinan'],2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Grooming</td>
              <td align="center">2</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_grooming']; ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Kedisiplinan</td>
              <td align="center">3</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_kedisiplinan']; ?></td>
            </tr>
            <tr>
              <td><b>6.</b></td>
              <td colspan="5"><b>Kehadiran</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  echo $nilai_point6 = number_format($get_evaluasi['point_kehadiran'],2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Kehadiran</td>
              <td align="center">5</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_kehadiran']; ?></td>
            </tr>
            <tr>
              <td colspan="7"><b>Aspek Kerohanian (Bonus)</b></td>
            </tr>
             <tr>
              <td><b>7.</b></td>
              <td colspan="5"><b>Program OWOJ</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  echo $nilai_point7 = number_format($get_evaluasi['point_owoj'],2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>OWOJ</td>
              <td align="center">5</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_owoj']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="row">
        <div class="col-6">
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
        <div class="col-6">
          <center><b>NILAI RATA-RATA</b></center>
          <table width="100%" class="table table-sm table-bordered" style="font-size: 11px;">
            <tr style="text-align: center;">
              <td style="font-size: 25px; font-weight: bold; height: 75px; vertical-align: middle;">
                <?php 
                  echo $nilai_akhir = number_format((($nilai_point1+$nilai_point2+$nilai_point3+$nilai_point4+$nilai_point5+$nilai_point6)/6)+($nilai_point7/10),2); 
                ?>
              </td>
            </tr>
            <tr style="text-align: center;">
              <td style="font-size: 25px; font-weight: bold; height: 75px; vertical-align: middle;">
                <?php 
                  if($nilai_akhir < 2){
                    $nilai_huruf = "E";
                  }elseif($nilai_akhir < 3){
                    $nilai_huruf = "D";
                  }elseif($nilai_akhir < 4){
                    $nilai_huruf = "C";
                  }elseif($nilai_akhir < 5){
                    $nilai_huruf = "B";
                  }else{
                    $nilai_huruf = "A";
                  }

                  echo $nilai_huruf;
                ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
                            <!-- -------------------- DETAIL ABSENSI [MANAGER]---------------- -->
      <br>
      <div class="row">
        <div class="col-12">
          <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
          <table width="100%" class="table table-sm table-bordered" style="font-size: 7px;">
            <tr style="text-align: center;">
              <td width="1%" style="font-size: 7px; font-weight: bold;">NO</td>
              <td width="8%" style="font-size: 7px; font-weight: bold;">BULAN</td>
              <td width="25%" style="font-size: 7px; font-weight: bold;">TANGGAL</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">SAKIT</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">IZIN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">ALPA</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">TERLAM BAT</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">DATANG SIANG</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">PULANG CEPAT</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">JUMLAH IJIN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">SERAGAM (X)</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT KEHA DIRAN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT KEDI SIPLI NAN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT GROO MING</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT TERTIB ADMINI STRASI</td>
            </tr>
            <tr>
              <td width="">1</td>
              <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
              <td width="" style="font-size: 7px;"> 
                <?php
                  $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                  $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                  $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                  echo $count_sakit_1." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_1." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_1." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_1." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_1." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                  $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                  $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                  echo $count_sakit_2." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_2." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_2." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_2." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_2." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                  $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                  $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                  echo $count_sakit_3." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_3." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_3." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_3." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_3." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari4 = date('Y-m-d', strtotime('+3 month',strtotime($dari)));
                  $sampai4_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari4)));
                  $sampai4 = date('Y-m-d', strtotime('-1 days',strtotime($sampai4_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari4))."</b> s/d <b>".date("d M Y", strtotime($sampai4))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                  echo $count_sakit_4." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_4." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_4." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_4." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_4." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari5 = date('Y-m-d', strtotime('+4 month',strtotime($dari)));
                  $sampai5_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari5)));
                  $sampai5 = date('Y-m-d', strtotime('-1 days',strtotime($sampai5_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari5))."</b> s/d <b>".date("d M Y", strtotime($sampai5))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                  echo $count_sakit_5." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_5." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_5." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_5." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_5." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari6 = date('Y-m-d', strtotime('+5 month',strtotime($dari)));
                  $sampai6_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari6)));
                  $sampai6 = date('Y-m-d', strtotime('-1 days',strtotime($sampai6_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari6))."</b> s/d <b>".date("d M Y", strtotime($sampai6))."</b>";
                ?>
              </td>
              <td width="">
                <?php
                  $count_sakit_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                  echo $count_sakit_6." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_6." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_6." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_6." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_6." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
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
              <td width="" colspan="3" style="font-size: 8px; font-weight: bold; text-align: center;">TOTAL</td>
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
              <td width="" colspan="3" style="font-size: 8px; font-weight: bold; text-align: center;">
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
      </div>

      <!-- ------------------------------------------------- FUNGSIONAL ---------------------------------------- -->
      <?php }elseif($get_evaluasi['jabatan'] == "Fungsional"){ ?>

      <div class="row">
        <table class="table table-sm table-striped" style="font-size: 12px;">
          <thead>
            <tr align="center">
              <th width="5%">#</th>
              <th>Aspek Penilaian</th>
              <th width="2%">Nilai Point</th>
              <th width="8%">Dirut</th>
              <th width="8%">Dirop</th>
              <th width="8%">Manager/ Leader</th>
              <th width="8%">Nilai Akhir</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="7"><b>Aspek Kepribadian</b></td>
            </tr>
            <tr>
              <td><b>1.</b></td>
              <td colspan="5"><b>Inisiatif & komunikatif, perilaku, skill & inovasi, dan loyalitas</b></td>
              <td align="center" style="font-weight: bold;">
                <?php
                  if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){

                    $avg_point1 = ($get_evaluasi['point1_dirut']+$get_evaluasi['point1_dirop'])/2;
                    $avg_point2 = ($get_evaluasi['point2_dirut']+$get_evaluasi['point2_dirop'])/2;
                    $avg_point3 = ($get_evaluasi['point3_dirut']+$get_evaluasi['point3_dirop'])/2;
                    $avg_point4 = ($get_evaluasi['point4_dirut']+$get_evaluasi['point4_dirop'])/2;

                    echo $nilai_point1 = number_format(($avg_point1+$avg_point2+$avg_point3+$avg_point4),2);

                  }else{
                    $avg_point1 = ($get_evaluasi['point1_dirut']+$get_evaluasi['point1_dirop']+$get_evaluasi['point1_leader'])/3;
                    $avg_point2 = ($get_evaluasi['point2_dirut']+$get_evaluasi['point2_dirop']+$get_evaluasi['point2_leader'])/3;
                    $avg_point3 = ($get_evaluasi['point3_dirut']+$get_evaluasi['point3_dirop']+$get_evaluasi['point3_leader'])/3;
                    $avg_point4 = ($get_evaluasi['point4_dirut']+$get_evaluasi['point4_dirop']+$get_evaluasi['point4_leader'])/3;

                    echo $nilai_point1 = number_format(($avg_point1+$avg_point2+$avg_point3+$avg_point4),2);
                  }
                ?>
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Inisiatif dan Komunikatif</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point1_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point1_dirop']; ?></td>
              <td align="center">
                <?php if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){ echo "-"; } else { echo $get_evaluasi['point1_leader']; } ?>
              </td>
              <td align="center"><?php echo number_format($avg_point1,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Perilaku dan Karakter</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point2_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point2_dirop']; ?></td>
              <td align="center">
                <?php if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){ echo "-"; } else { echo $get_evaluasi['point2_leader']; } ?>
              </td>
              <td align="center"><?php echo number_format($avg_point2,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Skill dan Inovasi</td>
              <td align="center">2</td>
              <td align="center"><?php echo $get_evaluasi['point3_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point3_dirop']; ?></td>
              <td align="center">
                <?php if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){ echo "-"; } else { echo $get_evaluasi['point3_leader']; } ?>
              </td>
              <td align="center"><?php echo number_format($avg_point3,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Loyalitas</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point4_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point4_dirop']; ?></td>
              <td align="center">
                <?php if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){ echo "-"; } else { echo $get_evaluasi['point4_leader']; } ?>
              </td>
              <td align="center"><?php echo number_format($avg_point4,2); ?></td>
            </tr>
            <tr>
              <td><b>2.</b></td>
              <td colspan="5"><b>Performance management, kepemimpinan, kemampuan mentorship, dan kemampuan mengorganisasi</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){

                    $avg_point5 = ($get_evaluasi['point5_dirut']+$get_evaluasi['point5_dirop'])/2;
                    $avg_point6 = ($get_evaluasi['point6_dirut']+$get_evaluasi['point6_dirop'])/2;
                    $avg_point7 = ($get_evaluasi['point7_dirut']+$get_evaluasi['point7_dirop'])/2;
                    $avg_point8 = ($get_evaluasi['point8_dirut']+$get_evaluasi['point8_dirop'])/2;

                    echo $nilai_point2 = number_format(($avg_point5+$avg_point6+$avg_point7+$avg_point8),2);

                  }else{
                    $avg_point5 = ($get_evaluasi['point5_dirut']+$get_evaluasi['point5_dirop']+$get_evaluasi['point5_leader'])/3;
                    $avg_point6 = ($get_evaluasi['point6_dirut']+$get_evaluasi['point6_dirop']+$get_evaluasi['point6_leader'])/3;
                    $avg_point7 = ($get_evaluasi['point7_dirut']+$get_evaluasi['point7_dirop']+$get_evaluasi['point7_leader'])/3;
                    $avg_point8 = ($get_evaluasi['point8_dirut']+$get_evaluasi['point8_dirop']+$get_evaluasi['point8_leader'])/3;

                    echo $nilai_point2 = number_format(($avg_point5+$avg_point6+$avg_point7+$avg_point8),2);
                  }
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td><i>Performance management</i></td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point5_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point5_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point5_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point5,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Kepemimpinan</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point6_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point6_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point6_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point6,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Kemampuan <i>mentorship</i></td>
              <td align="center">2</td>
              <td align="center"><?php echo $get_evaluasi['point7_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point7_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point7_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point7,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Kemampuan mengorganisasi</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point8_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point8_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point8_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point8,2); ?></td>
            </tr>
            <tr>
              <td><b>3.</b></td>
              <td colspan="5"><b>Kerjasama dalam team, kemampuan mengembangkan diri, kualitas hasil pekerjaan dan ketepatan waktu dalam menjalankan tugas</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  $avg_point13 = ($get_evaluasi['point13_dirut']+$get_evaluasi['point13_dirop']+$get_evaluasi['point13_leader'])/3;
                  $avg_point14 = ($get_evaluasi['point14_dirut']+$get_evaluasi['point14_dirop']+$get_evaluasi['point14_leader'])/3;
                  $avg_point15 = ($get_evaluasi['point15_dirut']+$get_evaluasi['point15_dirop']+$get_evaluasi['point15_leader'])/3;
                  $avg_point16 = ($get_evaluasi['point16_dirut']+$get_evaluasi['point16_dirop']+$get_evaluasi['point16_leader'])/3;

                  echo $nilai_point4 = number_format(($avg_point13+$avg_point14+$avg_point15+$avg_point16),2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Kerjasama dalam team</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point13_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point13_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point13_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point13,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Tangung jawab</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point14_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point14_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point14_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point14,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Pengembangan diri dan team</td>
              <td align="center">2</td>
              <td align="center"><?php echo $get_evaluasi['point15_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point15_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point15_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point15,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Pengembangan aturan</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point16_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point16_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point16_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point16,2); ?></td>
            </tr>
            <tr>
              <td><b>4.</b></td>
              <td colspan="5"><b>Tertib Administrasi (Grooming, kedisiplinan)</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  echo $nilai_point5 = number_format($get_evaluasi['point_grooming']+$get_evaluasi['point_kedisiplinan'],2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Grooming</td>
              <td align="center">2</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_grooming']; ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Kedisiplinan</td>
              <td align="center">3</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_kedisiplinan']; ?></td>
            </tr>
            <tr>
              <td><b>5.</b></td>
              <td colspan="5"><b>Kehadiran</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  echo $nilai_point6 = number_format($get_evaluasi['point_kehadiran'],2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Kehadiran</td>
              <td align="center">5</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_kehadiran']; ?></td>
            </tr>
            <tr>
              <td colspan="7"><b>Aspek Kerohanian (Bonus)</b></td>
            </tr>
             <tr>
              <td><b>6.</b></td>
              <td colspan="5"><b>Program OWOJ</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  echo $nilai_point7 = number_format($get_evaluasi['point_owoj'],2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>OWOJ</td>
              <td align="center">5</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_owoj']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="row">
        <div class="col-6">
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
        <div class="col-6">
          <center><b>NILAI RATA-RATA</b></center>
          <table width="100%" class="table table-sm table-bordered" style="font-size: 11px;">
            <tr style="text-align: center;">
              <td style="font-size: 25px; font-weight: bold; height: 75px; vertical-align: middle;">
                <?php 
                  echo $nilai_akhir = number_format((($nilai_point1+$nilai_point2+$nilai_point4+$nilai_point5+$nilai_point6)/5)+($nilai_point7/10),2); 
                ?>
              </td>
            </tr>
            <tr style="text-align: center;">
              <td style="font-size: 25px; font-weight: bold; height: 75px; vertical-align: middle;">
                <?php 
                  if($nilai_akhir < 2){
                    $nilai_huruf = "E";
                  }elseif($nilai_akhir < 3){
                    $nilai_huruf = "D";
                  }elseif($nilai_akhir < 4){
                    $nilai_huruf = "C";
                  }elseif($nilai_akhir < 5){
                    $nilai_huruf = "B";
                  }else{
                    $nilai_huruf = "A";
                  }

                  echo $nilai_huruf;
                ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
                            <!-- -------------------- DETAIL ABSENSI [FUNGSIONAL]---------------- -->
      <br>
      <div class="row">
        <div class="col-12">
          <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
          <table width="100%" class="table table-sm table-bordered" style="font-size: 7px;">
            <tr style="text-align: center;">
              <td width="1%" style="font-size: 7px; font-weight: bold;">NO</td>
              <td width="8%" style="font-size: 7px; font-weight: bold;">BULAN</td>
              <td width="25%" style="font-size: 7px; font-weight: bold;">TANGGAL</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">SAKIT</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">IZIN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">ALPA</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">TERLAM BAT</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">DATANG SIANG</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">PULANG CEPAT</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">JUMLAH IJIN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">SERAGAM (X)</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT KEHA DIRAN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT KEDI SIPLI NAN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT GROO MING</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT TERTIB ADMINI STRASI</td>
            </tr>
            <tr>
              <td width="">1</td>
              <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
              <td width="" style="font-size: 7px;"> 
                <?php
                  $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                  $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                  $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                  echo $count_sakit_1." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_1." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_1." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_1." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_1." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                  $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                  $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                  echo $count_sakit_2." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_2." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_2." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_2." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_2." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                  $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                  $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                  echo $count_sakit_3." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_3." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_3." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_3." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_3." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari4 = date('Y-m-d', strtotime('+3 month',strtotime($dari)));
                  $sampai4_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari4)));
                  $sampai4 = date('Y-m-d', strtotime('-1 days',strtotime($sampai4_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari4))."</b> s/d <b>".date("d M Y", strtotime($sampai4))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                  echo $count_sakit_4." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_4." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_4." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_4." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_4." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari5 = date('Y-m-d', strtotime('+4 month',strtotime($dari)));
                  $sampai5_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari5)));
                  $sampai5 = date('Y-m-d', strtotime('-1 days',strtotime($sampai5_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari5))."</b> s/d <b>".date("d M Y", strtotime($sampai5))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                  echo $count_sakit_5." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_5." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_5." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_5." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_5." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari6 = date('Y-m-d', strtotime('+5 month',strtotime($dari)));
                  $sampai6_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari6)));
                  $sampai6 = date('Y-m-d', strtotime('-1 days',strtotime($sampai6_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari6))."</b> s/d <b>".date("d M Y", strtotime($sampai6))."</b>";
                ?>
              </td>
              <td width="">
                <?php
                  $count_sakit_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                  echo $count_sakit_6." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_6." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_6." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_6." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_6." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
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
              <td width="" colspan="3" style="font-size: 8px; font-weight: bold; text-align: center;">TOTAL</td>
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
              <td width="" colspan="3" style="font-size: 8px; font-weight: bold; text-align: center;">
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
                  echo $avg_kedisiplinan = number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1);
                ?>
              </td>
              <td width="" style="font-weight: bold;">
                <?php
                  echo $avg_grooming = number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                ?>
              </td>
              <td width="" style="font-weight: bold;">
                <?php 
                  echo number_format($avg_kedisiplinan+$avg_grooming,1);
                ?>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <!-- --------------------------------------------------------- STAFF ----------------------------------------- -->
      <?php }elseif($get_evaluasi['jabatan'] == "Staff"){ ?>

        <div class="row">
        <table class="table table-sm table-striped" style="font-size: 12px;">
          <thead>
            <tr align="center">
              <th width="5%">#</th>
              <th>Aspek Penilaian</th>
              <th width="2%">Nilai Point</th>
              <th width="8%">Dirut</th>
              <th width="8%">Dirop</th>
              <th width="8%">Manager/ Leader</th>
              <th width="8%">Nilai Akhir</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="7"><b>Aspek Kepribadian</b></td>
            </tr>
            <tr>
              <td><b>1.</b></td>
              <td colspan="5"><b>Inisiatif & komunikatif, perilaku, skill & inovasi, dan loyalitas</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  $avg_point1 = ($get_evaluasi['point1_dirut']+$get_evaluasi['point1_dirop']+$get_evaluasi['point1_leader'])/3;
                  $avg_point2 = ($get_evaluasi['point2_dirut']+$get_evaluasi['point2_dirop']+$get_evaluasi['point2_leader'])/3;
                  $avg_point3 = ($get_evaluasi['point3_dirut']+$get_evaluasi['point3_dirop']+$get_evaluasi['point3_leader'])/3;
                  $avg_point4 = ($get_evaluasi['point4_dirut']+$get_evaluasi['point4_dirop']+$get_evaluasi['point4_leader'])/3;

                  echo $nilai_point1 = number_format(($avg_point1+$avg_point2+$avg_point3+$avg_point4),2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Inisiatif dan Komunikatif</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point1_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point1_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point1_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point1,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Perilaku dan Karakter</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point2_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point2_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point2_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point2,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Skill dan Inovasi</td>
              <td align="center">2</td>
              <td align="center"><?php echo $get_evaluasi['point3_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point3_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point3_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point3,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Loyalitas</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point4_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point4_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point4_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point4,2); ?></td>
            </tr>
            <tr>
              <td><b>2.</b></td>
              <td colspan="5"><b>Kerjasama dalam team, kemampuan mengembangkan diri, kualitas hasil pekerjaan dan ketepatan waktu dalam menjalankan tugas</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  $avg_point13 = ($get_evaluasi['point13_dirut']+$get_evaluasi['point13_dirop']+$get_evaluasi['point13_leader'])/3;
                  $avg_point14 = ($get_evaluasi['point14_dirut']+$get_evaluasi['point14_dirop']+$get_evaluasi['point14_leader'])/3;
                  $avg_point15 = ($get_evaluasi['point15_dirut']+$get_evaluasi['point15_dirop']+$get_evaluasi['point15_leader'])/3;
                  $avg_point16 = ($get_evaluasi['point16_dirut']+$get_evaluasi['point16_dirop']+$get_evaluasi['point16_leader'])/3;

                  echo $nilai_point4 = number_format(($avg_point13+$avg_point14+$avg_point15+$avg_point16),2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Kerjasama dalam team</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point13_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point13_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point13_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point13,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Tangung jawab</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point14_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point14_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point14_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point14,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Pengembangan diri dan team</td>
              <td align="center">2</td>
              <td align="center"><?php echo $get_evaluasi['point15_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point15_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point15_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point15,2); ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Pengembangan aturan</td>
              <td align="center">1</td>
              <td align="center"><?php echo $get_evaluasi['point16_dirut']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point16_dirop']; ?></td>
              <td align="center"><?php echo $get_evaluasi['point16_leader']; ?></td>
              <td align="center"><?php echo number_format($avg_point16,2); ?></td>
            </tr>
            <tr>
              <td><b>3.</b></td>
              <td colspan="5"><b>Tertib Administrasi (Grooming, kedisiplinan)</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  echo $nilai_point5 = number_format($get_evaluasi['point_grooming']+$get_evaluasi['point_kedisiplinan'],2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Grooming</td>
              <td align="center">2</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_grooming']; ?></td>
            </tr>
            <tr>
              <td></td>
              <td>Kedisiplinan</td>
              <td align="center">3</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_kedisiplinan']; ?></td>
            </tr>
            <tr>
              <td><b>4.</b></td>
              <td colspan="5"><b>Kehadiran</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  echo $nilai_point6 = number_format($get_evaluasi['point_kehadiran'],2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>Kehadiran</td>
              <td align="center">5</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_kehadiran']; ?></td>
            </tr>
            <tr>
              <td colspan="7"><b>Aspek Kerohanian (Bonus)</b></td>
            </tr>
             <tr>
              <td><b>5.</b></td>
              <td colspan="5"><b>Program OWOJ</b></td>
              <td align="center" style="font-weight: bold;">
                <?php 
                  echo $nilai_point7 = number_format($get_evaluasi['point_owoj'],2);
                ?>      
              </td>
            </tr>
            <tr>
              <td></td>
              <td>OWOJ</td>
              <td align="center">5</td>
              <td></td>
              <td></td>
              <td></td>
              <td align="center"><?php echo $get_evaluasi['point_owoj']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="row">
        <div class="col-6">
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
        <div class="col-6">
          <center><b>NILAI RATA-RATA</b></center>
          <table width="100%" class="table table-sm table-bordered" style="font-size: 11px;">
            <tr style="text-align: center;">
              <td style="font-size: 25px; font-weight: bold; height: 75px; vertical-align: middle;">
                <?php 
                  echo $nilai_akhir = number_format((($nilai_point1+$nilai_point2+$nilai_point4+$nilai_point5+$nilai_point6)/4)+($nilai_point7/10),2); 
                ?>
              </td>
            </tr>
            <tr style="text-align: center;">
              <td style="font-size: 25px; font-weight: bold; height: 75px; vertical-align: middle;">
                <?php 
                  if($nilai_akhir < 2){
                    $nilai_huruf = "E";
                  }elseif($nilai_akhir < 3){
                    $nilai_huruf = "D";
                  }elseif($nilai_akhir < 4){
                    $nilai_huruf = "C";
                  }elseif($nilai_akhir < 5){
                    $nilai_huruf = "B";
                  }else{
                    $nilai_huruf = "A";
                  }

                  echo $nilai_huruf;
                ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
                            <!-- -------------------- DETAIL ABSENSI [STAFF]---------------- -->
      <br>
      <div class="row">
        <div class="col-12">
          <center><b>DETAIL ABSENSI & KETERLAMBATAN PER BULAN</b></center>
          <table width="100%" class="table table-sm table-bordered" style="font-size: 7px;">
            <tr style="text-align: center;">
              <td width="1%" style="font-size: 7px; font-weight: bold;">NO</td>
              <td width="8%" style="font-size: 7px; font-weight: bold;">BULAN</td>
              <td width="25%" style="font-size: 7px; font-weight: bold;">TANGGAL</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">SAKIT</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">IZIN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">ALPA</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">TERLAM BAT</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">DATANG SIANG</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">PULANG CEPAT</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">JUMLAH IJIN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">SERAGAM (X)</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT KEHA DIRAN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT KEDI SIPLI NAN</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT GROO MING</td>
              <td width="6%" style="font-size: 7px; font-weight: bold;">POINT TERTIB ADMINI STRASI</td>
            </tr>
            <tr>
              <td width="">1</td>
              <td width=""><?php echo date('F', strtotime('+1 month',strtotime($dari))); ?></td>
              <td width="" style="font-size: 7px;"> 
                <?php
                  $dari1 = date('Y-m-d', strtotime('+0 month',strtotime($dari)));
                  $sampai1_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari1)));
                  $sampai1 = date('Y-m-d', strtotime('-1 days',strtotime($sampai1_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari1))."</b> s/d <b>".date("d M Y", strtotime($sampai1))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
                  echo $count_sakit_1." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_ijin_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_1." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_1." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_1." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_1." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari1' AND tanggal <= '$sampai1' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_1 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari1' AND tanggal <= '$sampai1'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari2 = date('Y-m-d', strtotime('+1 month',strtotime($dari)));
                  $sampai2_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari2)));
                  $sampai2 = date('Y-m-d', strtotime('-1 days',strtotime($sampai2_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari2))."</b> s/d <b>".date("d M Y", strtotime($sampai2))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
                  echo $count_sakit_2." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_2." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_2." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_2." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_2." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari2' AND tanggal <= '$sampai2' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_2 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari2' AND tanggal <= '$sampai2'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari3 = date('Y-m-d', strtotime('+2 month',strtotime($dari)));
                  $sampai3_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari3)));
                  $sampai3 = date('Y-m-d', strtotime('-1 days',strtotime($sampai3_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari3))."</b> s/d <b>".date("d M Y", strtotime($sampai3))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
                  echo $count_sakit_3." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_3." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_3." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_3." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_3." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari3' AND tanggal <= '$sampai3' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari3' AND tanggal <= '$sampai3'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari4 = date('Y-m-d', strtotime('+3 month',strtotime($dari)));
                  $sampai4_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari4)));
                  $sampai4 = date('Y-m-d', strtotime('-1 days',strtotime($sampai4_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari4))."</b> s/d <b>".date("d M Y", strtotime($sampai4))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
                  echo $count_sakit_4." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_4." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_4." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_4." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_4." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari4' AND tanggal <= '$sampai4' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_4 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari4' AND tanggal <= '$sampai4'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari5 = date('Y-m-d', strtotime('+4 month',strtotime($dari)));
                  $sampai5_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari5)));
                  $sampai5 = date('Y-m-d', strtotime('-1 days',strtotime($sampai5_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari5))."</b> s/d <b>".date("d M Y", strtotime($sampai5))."</b>";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_sakit_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
                  echo $count_sakit_5." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_5." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_5." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_5." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_5." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari5' AND tanggal <= '$sampai5' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_5 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari5' AND tanggal <= '$sampai5'"));
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
              <td width="" style="font-size: 7px;">
                <?php
                  $dari6 = date('Y-m-d', strtotime('+5 month',strtotime($dari)));
                  $sampai6_tmp = date('Y-m-d', strtotime('+1 month',strtotime($dari6)));
                  $sampai6 = date('Y-m-d', strtotime('-1 days',strtotime($sampai6_tmp)));

                  echo "<b>".date("d M Y", strtotime($dari6))."</b> s/d <b>".date("d M Y", strtotime($sampai6))."</b>";
                ?>
              </td>
              <td width="">
                <?php
                  $count_sakit_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND status = 'Sakit - Dengan SKD' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
                  echo $count_sakit_6." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_ijin_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Sakit - Tanpa SKD' OR status = 'Izin Tidak Masuk')"));
                  echo $count_ijin_6." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_alpa_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Tanpa Keterangan'"));
                  echo $count_alpa_6." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_terlambat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Terlambat' OR status = 'Izin Terlambat' OR (status = 'Pulang Tugas Kantor' AND terlambat > 0))"));
                  echo $count_terlambat_6." Hari";
                ?>
              </td>
              <td width="">
                <?php
                  $count_masukSiang_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND status = 'Izin Masuk Siang'"));
                  echo $count_masukSiang_6." Hari";
                ?>
              </td>
              <td width="">
                <?php 
                  $count_pulangCepat_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_pulang WHERE nik = '$nik_karyawan' AND tanggal >= '$dari6' AND tanggal <= '$sampai6' AND (status = 'Pulang Cepat' OR status = 'Izin Pulang Cepat')"));
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
                  $seragam_x_6 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$nik_karyawan' AND seragam = 'Tidak/Lupa' AND tanggal >= '$dari6' AND tanggal <= '$sampai6'"));
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
              <td width="" colspan="3" style="font-size: 8px; font-weight: bold; text-align: center;">TOTAL</td>
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
              <td width="" colspan="3" style="font-size: 8px; font-weight: bold; text-align: center;">
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
                  echo $avg_kedisiplinan = number_format((($point_kedisiplinan_1+$point_kedisiplinan_2+$point_kedisiplinan_3+$point_kedisiplinan_4+$point_kedisiplinan_5+$point_kedisiplinan_6)/6),1);
                ?>
              </td>
              <td width="" style="font-weight: bold;">
                <?php
                  echo $avg_grooming = number_format((($point_grooming_1+$point_grooming_2+$point_grooming_3+$point_grooming_4+$point_grooming_5+$point_grooming_6)/6),1);
                ?>
              </td>
              <td width="" style="font-weight: bold;">
                <?php 
                  echo number_format($avg_kedisiplinan+$avg_grooming,1);
                ?>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <?php } ?>
      <div class="row">
        <div class="col-12">
            <center>
              <a href="cetak_report_evaluasi.php?nomor_fppk=<?php echo $nomor_fppk; ?>" class="btn btn-success" target="_blank">Cetak Report</a>
              <a href="cetak_report_evaluasi_detail.php?nomor_fppk=<?php echo $nomor_fppk; ?>" class="btn btn-success" target="_blank">Cetak Report Detail</a>
            </center>
        </div>        
      </div>
    </div>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->