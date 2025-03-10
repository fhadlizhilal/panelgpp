<?php
  $project_id = explode('/',$_GET['kdweekly']);
  $get_weeklyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE kd_weekly = '$_GET[kdweekly]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_weeklyreport[project_id]'"));
  $get_hseofficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_project[hse_officer]'"));
?>

<style>
    @media print {
        .page-break {
            page-break-before: always;
        }
    }
</style>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Weekly Report HSE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Data Project</li>
              <li class="breadcrumb-item">Detail Project</li>
              <li class="breadcrumb-item active">Weekly Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card" style="margin-right: -10px;">
              <div class="card-body">
                <div class="row" style="margin-bottom: 10px">
                  <div class="col-12">
                    <table border="1">
                      <tr>
                        <td width="15%">
                          <center>
                            <img src="../../dist/img/logo/gpp-logo.png" width="33%">
                          </center>
                        </td>
                        <td width="60%"><center><h4>GLOBAL PRATAMA POWERINDO HSE STATISTICS</h4></center></td>
                        <td width="15%">
                          <center>
                            <img src="../../dist/img/logo/logo-k3.png" width="50%">
                          </center>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="row" style="margin-bottom: 15px">
                  <div class="col-9">
                    <table style="font-size: 11px;" cellpadding="2px">
                      <tr>
                        <td width="20%"><b>Project Name</b></td>
                        <td width="1%">:</td>
                        <td><?php echo $get_project['nama_project']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Work Week No</b></td>
                        <td>:</td>
                        <td>Week <?php echo $get_weeklyreport['week']; ?></td>
                      </tr>
                      <tr>
                        <td><b>Date</b></td>
                        <td>:</td>
                        <td><?php echo date("d/m/Y", strtotime($get_weeklyreport['tgl_awal']))." - ".date("d/m/Y", strtotime($get_weeklyreport['tgl_akhir'])); ?></td>
                      </tr>
                      <tr>
                        <td><b>Date Submited</b></td>
                        <td>:</td>
                        <td><?php echo date("d/m/Y", strtotime($get_weeklyreport['tgl_akhir'])); ?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-3">
                    <table style="font-size: 10px; border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;" width="100%">
                      <tr>
                        <td style="padding-left: 5px;">
                          <b>NM - Near-Miss</b><br>
                          <b>FA - First Aid</b><br>
                          <b>MT - Medical Treatmen</b>
                        </td>
                        <td style="padding-left: 5px; vertical-align: top;">
                          <b>LTI - Lost Time Incident</b><br>
                          <b>FAT - Fatality</b>
                        </td>
                      </tr>
                    </table>
                    <table style="font-size: 10px; margin-top: 8px;" width="100%">
                      <tr>
                        <td width="35%"><b>Total Rain Hours</b></td>
                        <td width="1%">:</td>
                        <td>
                          <?php
                            $get_RainHours = mysqli_fetch_array(mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(jam_selesai, jam_mulai)))) AS rain_hours FROM hse_dailyreport_cuaca INNER JOIN hse_dailyreport WHERE hse_dailyreport_cuaca.cuaca != 'Full Cerah' AND hse_dailyreport_cuaca.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));
                            $t_detik = strtotime($get_RainHours['rain_hours']);

                            if($t_detik == ""){
                              echo "00 Hours 00 Minutes";
                            }else{
                              echo date("H", $t_detik)." Hours ".date("i", $t_detik)." Minutes";
                            }

                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                      <thead style="text-align: center;">
                        <tr>
                          <th width="1%" rowspan="2" style="vertical-align: middle;">No</th>
                          <th rowspan="2" style="vertical-align: middle;">Manpower</th>
                          <th width="12%" rowspan="2" style="vertical-align: middle;">Position</th>
                          <th rowspan="2" style="vertical-align: middle;">Description of Work</th>
                          <th colspan="3" style="vertical-align: middle;">Attendance</th>
                          <th width="8%" rowspan="2" style="vertical-align: middle;">Total No. of Man-Hours</th>
                          <th colspan="5">Accidents</th>
                        </tr>
                        <tr>
                          <th width="2%">I</th>
                          <th width="2%">S</th>
                          <th width="2%">A</th>
                          <th width="5%">NM</th>
                          <th width="5%">FA</th>
                          <th width="5%">MT</th>
                          <th width="5%">LTI</th>
                          <th width="5%">FAT</th>
                        </tr>
                      <thead>
                      <tbody>
                        <?php
                          $datake=0;
                          $total_permission = 0;
                          $total_sakit = 0;
                          $total_alpha = 0;
                          $total_manhours = 0;
                          $total_NM = 0;
                          $total_FA = 0;
                          $total_MT = 0;
                          $total_LTI = 0;
                          $total_FAT = 0;

                          $q_get_distincManpower = mysqli_query($conn, "SELECT DISTINCT manpower_id FROM hse_dailyreport_manpower INNER JOIN hse_dailyreport WHERE hse_dailyreport_manpower.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'");
                          while($get_distincManpower = mysqli_fetch_array($q_get_distincManpower)){
                            $get_jabatan_project = mysqli_fetch_array(mysqli_query($conn, "SELECT manpower_id, jabatan_id FROM hse_dailyreport_manpower INNER JOIN hse_dailyreport WHERE hse_dailyreport_manpower.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND manpower_id = '$get_distincManpower[manpower_id]'"));

                            $data_manpower_id[$datake] = $get_distincManpower['manpower_id'];
                            $data_jabatan_id[$datake] = $get_jabatan_project['jabatan_id'];
                            $datake++;
                          }

                          //SORT DATA BERDASARKAN JABATAN
                          for($i=0;$i<$datake;$i++){
                            for($j=0;$j<$datake-1;$j++){
                              if($data_jabatan_id[$j] > $data_jabatan_id[$j+1]){
                                $temp_manpower_id = $data_manpower_id[$j];
                                $temp_jabatan_id = $data_jabatan_id[$j];

                                $data_manpower_id[$j] = $data_manpower_id[$j+1];
                                $data_jabatan_id[$j] = $data_jabatan_id[$j+1];

                                $data_manpower_id[$j+1] = $temp_manpower_id;
                                $data_jabatan_id[$j+1] = $temp_jabatan_id;
                              }
                            }
                          }                            

                            for($k=0;$k<$datake;$k++){
                              $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$data_manpower_id[$k]'"));
                              $get_jabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_jabatan WHERE id = '$data_jabatan_id[$k]'"));

                              //Auto Fill Description of Work
                              $cek_descripWork = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_deskripsipekerjaan WHERE kd_weekly = '$_GET[kdweekly]' AND manpower_id = '$data_manpower_id[$k]' AND jabatan_id = '$data_jabatan_id[$k]'"));
                              if($cek_descripWork<1){
                                if($get_jabatan['jabatan'] == "Project Manager"){
                                  $deskripsi_pekerjaan = "Bertanggung jawab untuk merencanakan, melaksanakan, dan mengawasi proyek dari awal hingga selesai.";
                                }elseif($get_jabatan['jabatan'] == "Site Manager"){
                                  $deskripsi_pekerjaan = "Bertanggung jawab untuk mengelola operasional dan kegiatan di lokasi proyek (site).";
                                }elseif($get_jabatan['jabatan'] == "HSE Officer"){
                                  $deskripsi_pekerjaan = "Bertanggung jawab untuk mengawasi, mengelola, dan memastikan penerapan kebijakan serta prosedur kesehatan, keselamatan, dan lingkungan (HSE) di tempat kerja.";
                                }elseif($get_jabatan['jabatan'] == "Project Control"){
                                  $deskripsi_pekerjaan = "Membantu pengawasan untuk mengontrol, dan memantau progres proyek guna memastikan pekerjaan sudah sesuai dengan standar yang ditentukan.";
                                }elseif($get_jabatan['jabatan'] == "SPV"){
                                  $deskripsi_pekerjaan = "Supervisor memiliki peran untuk memastikan bahwa proses kerja berjalan sesuai dengan standar yang ditetapkan, produktivitas tercapai, dan tim dapat bekerja dengan efisien serta efektif.";
                                }elseif($get_jabatan['jabatan'] == "Teknisi"){
                                  $deskripsi_pekerjaan = "Seseorang yang memiliki keterampilan teknis untuk mengoperasikan, memelihara, memperbaiki, dan menginstal perangkat, peralatan, atau sistem dalam berbagai sektor industri.";
                                }elseif($get_jabatan['jabatan'] == "Helper"){
                                  $deskripsi_pekerjaan = "Memiliki tanggung jawab untuk mendukung pekerjaan teknis atau operasional di lapangan dengan memberikan bantuan langsung kepada teknisi, supervisor, atau pekerja lain.";
                                }elseif($get_jabatan['jabatan'] == "Operator Boomlift"){
                                  $deskripsi_pekerjaan = "Bertanggung jawab untuk mengoperasikan boomlift untuk mengangkat pekerja atau material ke ketinggian yang diperlukan dalam berbagai kegiatan konstruksi, pemeliharaan, atau proyek lainnya.";
                                }elseif($get_jabatan['jabatan'] == "Operator Forklift"){
                                  $deskripsi_pekerjaan = "Bertanggung jawab untuk mengoperasikan forklift, yang digunakan untuk mengangkat, memindahkan, dan menyusun material atau barang dalam jumlah besar di gudang, pabrik, atau area lain.";
                                }elseif($get_jabatan['jabatan'] == "Operator Crane"){
                                  $deskripsi_pekerjaan = "Bertanggung jawab untuk mengoperasikan, mengangkat, memindahkan, dan menurunkan material, peralatan, atau struktur berat di area konstruksi, pelabuhan, atau pabrik.";
                                }elseif($get_jabatan['jabatan'] == "Operator Scissor"){
                                  $deskripsi_pekerjaan = "Bertanggung jawab untuk mengoperasikan scissor lift, alat angkat vertikal yang digunakan untuk mengangkat pekerja, material, atau peralatan ke ketinggian tertentu di area yang sulit dijangkau.";
                                }elseif($get_jabatan['jabatan'] == "Admin Project"){
                                  $deskripsi_pekerjaan = "admin proyek bertanggung jawab untuk mendukung kelancaran operasional proyek dan memastikan semua administrasi berjalan efisien.";
                                }else{
                                  $deskripsi_pekerjaan = "Input Description of Work";
                                }
                                mysqli_query($conn, "INSERT INTO hse_dailyreport_deskripsipekerjaan VALUES ('','$_GET[kdweekly]','$data_manpower_id[$k]','$data_jabatan_id[$k]','$deskripsi_pekerjaan')");
                              }

                              //Sum ManHours
                              $get_manHours = mysqli_fetch_array(mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(jam_pulang, jam_masuk)))) AS selisih_waktu FROM hse_dailyreport_manpower INNER JOIN hse_dailyreport WHERE hse_dailyreport_manpower.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport_manpower.manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_manpower.absensi = 'Hadir' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM Near Miss
                              $get_nearMiss = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu INNER JOIN hse_dailyreport WHERE kejadian = 'Near Miss' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM First Aid
                              $get_FirstAid = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu INNER JOIN hse_dailyreport WHERE kejadian = 'First Aid' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM Medical Treatment
                              $get_MedicalTreatment = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu INNER JOIN hse_dailyreport WHERE kejadian = 'Medical Treatment Injury' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM LTI
                              $get_LTI = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu INNER JOIN hse_dailyreport WHERE kejadian = 'Loss Time Injury' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM Fatality
                              $get_Fatality = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu INNER JOIN hse_dailyreport WHERE kejadian = 'Fatallity' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM Permission
                              $get_permission = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower INNER JOIN hse_dailyreport WHERE absensi = 'Izin' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_manpower.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM Sick
                              $get_sick = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower INNER JOIN hse_dailyreport WHERE absensi = 'Sakit' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_manpower.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM Alpa
                              $get_alpa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower INNER JOIN hse_dailyreport WHERE absensi = 'Alpa' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_manpower.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));
                        ?>
                              <tr>
                                <td><?php echo $k+1; ?></td>
                                <td><?php echo $get_manpower['nama']; ?></td>
                                <td><?php echo $get_jabatan['jabatan']; ?></td>
                                <td>
                                    <?php
                                      $get_descWork = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_deskripsipekerjaan WHERE kd_weekly = '$_GET[kdweekly]' AND manpower_id = '$data_manpower_id[$k]' AND jabatan_id = '$data_jabatan_id[$k]'"));
                                      if($get_descWork['deskripsi_pekerjaan'] == "Input Description of Work"){
                                    ?>
                                        Input Description of Work
                                    <?php }else{ echo $get_descWork['deskripsi_pekerjaan']; } ?>

                                  <a href="#modal" class="no-print" data-toggle='modal' data-target='#show_add_deskrippekerjaan' data-id='<?php echo $_GET['kdweekly']."-".$data_manpower_id[$k]."-".$data_jabatan_id[$k]; ?>' data-toggle="tooltip" data-placement="bottom" title="Generate Weekly Report Baru">
                                    <span class="fa fa-edit"></span>
                                  </a>
                                </td>
                                <td align="center"><?php echo $get_permission; ?></td>
                                <td align="center"><?php echo $get_sick; ?></td>
                                <td align="center"><?php echo $get_alpa; ?></td>
                                <td align="center">
                                  <?php
                                    $data_array = explode(":", $get_manHours['selisih_waktu']);
                                    echo $data_array[0];
                                  ?>
                                </td>
                                <td align="center"><?php echo $get_nearMiss; ?></td>
                                <td align="center"><?php echo $get_FirstAid; ?></td>
                                <td align="center"><?php echo $get_MedicalTreatment; ?></td>
                                <td align="center"><?php echo $get_LTI; ?></td>
                                <td align="center"><?php echo $get_Fatality; ?></td>
                              </tr>

                            <?php
                                $total_permission = $total_permission + $get_permission;
                                $total_sakit = $total_sakit + $get_sick;
                                $total_alpha = $total_alpha + $get_alpa;
                                $total_manhours = $total_manhours + $data_array[0];
                                $total_NM = $total_NM + $get_nearMiss;
                                $total_FA = $total_FA + $get_FirstAid;
                                $total_MT = $total_MT + $get_MedicalTreatment;
                                $total_LTI = $total_LTI + $get_LTI;
                                $total_FAT = $total_FAT + $get_Fatality;
                              } 
                            ?>
                            <tr style="font-weight: bold;">
                              <td colspan="4" align="center">TOTAL</td>
                              <td align="center"><?php echo $total_permission; ?></td>
                              <td align="center"><?php echo $total_sakit; ?></td>
                              <td align="center"><?php echo $total_alpha; ?></td>
                              <td align="center"><?php echo $total_manhours; ?></td>
                              <td align="center"><?php echo $total_NM; ?></td>
                              <td align="center"><?php echo $total_FA; ?></td>
                              <td align="center"><?php echo $total_MT; ?></td>
                              <td align="center"><?php echo $total_LTI; ?></td>
                              <td align="center"><?php echo $total_FAT; ?></td>
                            </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="page-break"></div>


        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card" style="margin-right: -10px;">
              <div class="card-body">
                <div class="row" style="margin-bottom: 10px">
                  <div class="col-12">
                    <table border="1">
                      <tr>
                        <td width="15%">
                          <center>
                            <img src="../../dist/img/logo/gpp-logo.png" width="33%">
                          </center>
                        </td>
                        <td width="60%">
                          <center>
                            <h4>KEY PERFORMANCE INDICATOR PROJECT</h4>
                            <small><h8>Periode : <?php echo date("d/m/Y", strtotime($get_weeklyreport['tgl_awal']))." - ".date("d/m/Y", strtotime($get_weeklyreport['tgl_akhir'])); ?></h8></small>
                          </center>
                        </td>
                        <td width="15%">
                          <center>
                            <img src="../../dist/img/logo/logo-k3.png" width="50%">
                          </center>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>

                <?php
                  $total_FAT = 0;
                  $total_LTI = 0;
                  $total_MT = 0;
                  $total_FA = 0;
                  $total_NM = 0;
                  $total_ENV = 0;

                  $total_TBM = 0;
                  $total_HC = 0;
                  $total_HK = 0;

                  $total_inspeksi_apd = 0;

                  for($a = strtotime($get_weeklyreport['tgl_awal']); $a <= strtotime($get_weeklyreport['tgl_akhir']); $a = strtotime("+1 day", $a) ){
                    $tgl_report = ltrim(date("d-m-Y", $a), "0");
                    $kd_report = $project_id[2]."/".$tgl_report;

                    $jml_FAT = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu JOIN hse_dailyreport ON hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report WHERE hse_dailyreport_isu.kd_report = '$kd_report' AND hse_dailyreport_isu.kejadian = 'Fatallity' AND hse_dailyreport.status_report = 'completed'"));
                    $jml_LTI = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu JOIN hse_dailyreport ON hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report WHERE hse_dailyreport_isu.kd_report = '$kd_report' AND hse_dailyreport_isu.kejadian = 'Loss Time Injury' AND hse_dailyreport.status_report = 'completed'"));
                    $jml_MT = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu JOIN hse_dailyreport ON hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report WHERE hse_dailyreport_isu.kd_report = '$kd_report' AND hse_dailyreport_isu.kejadian = 'Medical Treatment Injury' AND hse_dailyreport.status_report = 'completed'"));
                    $jml_FA = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu JOIN hse_dailyreport ON hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report WHERE hse_dailyreport_isu.kd_report = '$kd_report' AND hse_dailyreport_isu.kejadian = 'First Aid Injury' AND hse_dailyreport.status_report = 'completed'"));
                    $jml_NM = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu JOIN hse_dailyreport ON hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report WHERE hse_dailyreport_isu.kd_report = '$kd_report' AND hse_dailyreport_isu.kejadian = 'Near Miss' AND hse_dailyreport.status_report = 'completed'"));
                    $jml_ENV = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu JOIN hse_dailyreport ON hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report WHERE hse_dailyreport_isu.kd_report = '$kd_report' AND hse_dailyreport_isu.kejadian = 'Enviroment Incident' AND hse_dailyreport.status_report = 'completed'"));

                    $total_FAT = $total_FAT + $jml_FAT;
                    $total_LTI = $total_LTI + $jml_LTI;
                    $total_MT = $total_MT + $jml_MT;
                    $total_FA = $total_FA + $jml_FA;
                    $total_NM = $total_NM + $jml_NM;
                    $total_ENV = $total_ENV + $jml_ENV;

                    // Hitung TBM, HC, DLL
                    $jml_TBM = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT hse_dailyreport_dokumentasi.kd_report FROM hse_dailyreport_dokumentasi JOIN hse_dailyreport ON hse_dailyreport_dokumentasi.kd_report = hse_dailyreport.kd_report WHERE hse_dailyreport.status_report = 'completed' AND hse_dailyreport_dokumentasi.kd_report = '$kd_report' AND hse_dailyreport_dokumentasi.pekerjaan = 'Toolbox Meeting'"));
                    $jml_HC = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT hse_dailyreport_dokumentasi.kd_report FROM hse_dailyreport_dokumentasi JOIN hse_dailyreport ON hse_dailyreport_dokumentasi.kd_report = hse_dailyreport.kd_report WHERE hse_dailyreport.status_report = 'completed' AND hse_dailyreport_dokumentasi.kd_report = '$kd_report' AND hse_dailyreport_dokumentasi.pekerjaan = 'Lampiran TBM & HC'"));
                    $jml_HK = mysqli_num_rows(mysqli_query($conn, "SELECT DISTINCT hse_dailyreport_dokumentasi.kd_report FROM hse_dailyreport_dokumentasi JOIN hse_dailyreport ON hse_dailyreport_dokumentasi.kd_report = hse_dailyreport.kd_report WHERE hse_dailyreport.status_report = 'completed' AND hse_dailyreport_dokumentasi.kd_report = '$kd_report' AND hse_dailyreport_dokumentasi.pekerjaan = 'House Keeping'"));

                    $total_TBM = $total_TBM + $jml_TBM;
                    $total_HC = $total_HC + $jml_HC;
                    $total_HK = $total_HK + $jml_HK;

                  }

                  // Hitung Inspeksi
                    $jml_inspeksi_apd = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$_GET[kdweekly]' AND tanggal_inspeksi >= '$get_weeklyreport[tgl_awal]' AND tanggal_inspeksi <= '$get_weeklyreport[tgl_akhir]' AND status = 'completed' AND jenis_inspeksi = 'inspeksi_apd'"));
                    $jml_inspeksi_apar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$_GET[kdweekly]' AND tanggal_inspeksi >= '$get_weeklyreport[tgl_awal]' AND tanggal_inspeksi <= '$get_weeklyreport[tgl_akhir]' AND status = 'completed' AND jenis_inspeksi = 'inspeksi_apar'"));

                ?>

                <div class="row">
                  <div class="col-12">
                    <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                      <thead style="text-align: center;">
                        <tr>
                          <th width="" colspan="5" style="vertical-align: middle; background-color: red;">KEY PERFORMANCE INDICATOR</th>
                        </tr>
                        <tr bgcolor="yellow">
                          <th width="" colspan="2" style="text-align: left;">Lagging Performance Indicator</th>
                          <th width="10%">Target</th>
                          <th width="10%">Actual</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td width="3%" align="center">1</td>
                          <td>Fatality</td>
                          <td align="center">0</td>
                          <td align="center"><?php echo $total_FAT; ?></td>
                        </tr>
                        <tr>
                          <td align="center">2</td>
                          <td>Lost Time Injury</td>
                          <td align="center">0</td>
                          <td align="center"><?php echo $total_LTI; ?></td>
                        </tr>
                        <tr>
                          <td align="center">3</td>
                          <td>Medical Treatment Injury</td>
                          <td align="center">0</td>
                          <td align="center"><?php echo $total_MT; ?></td>
                        </tr>
                        <tr>
                          <td align="center">4</td>
                          <td>First Aid Injury</td>
                          <td align="center">0</td>
                          <td align="center"><?php echo $total_FA; ?></td>
                        </tr>
                        <tr>
                          <td align="center">5</td>
                          <td>Near Miss</td>
                          <td align="center">0</td>
                          <td align="center"><?php echo $total_NM; ?></td>
                        </tr>
                        <tr>
                          <td align="center">6</td>
                          <td>Enviroment Incident</td>
                          <td align="center">0</td>
                          <td align="center"><?php echo $total_ENV; ?></td>
                        </tr>
                      </tbody>
                    </table>

                    <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                      <thead>
                        <tr bgcolor="yellow">
                          <th width="" colspan="2" style="text-align: left;">Leading Performance Indicator</th>
                          <th width="10%">Target</th>
                          <th width="10%">Actual</th>
                          <th width="10%">Percentage</th>
                        </tr>
                      </thead>

                      <?php
                        $cek_hari_libur = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE project_id = '$project_id[2]' AND tgl_report >= '$get_weeklyreport[tgl_awal]' AND tgl_report <= '$get_weeklyreport[tgl_akhir]' AND (status_report = 'hold' OR status_report = 'libur/tidak ada pekerjaan')"));
                        $jml_hari_report = (strtotime($get_weeklyreport['tgl_akhir']) - strtotime($get_weeklyreport['tgl_awal'])) / (60 * 60 * 24);
                        $jml_hari_report = $jml_hari_report+1;
                      ?>

                      <tbody>
                        <tr>
                          <td align="center" width="3%">1</td>
                          <td>Toolbox Meeting</td>
                          <td align="center"><?php echo $target_tbm = $jml_hari_report-$cek_hari_libur; ?></td>
                          <td align="center"><?php echo $total_TBM; ?></td>
                          <td align="center"><?php echo number_format(($total_TBM/$target_tbm*100), 2)." %"; ?></td>
                        </tr>
                        <tr>
                          <td align="center">2</td>
                          <td>Daily Check up</td>
                          <td align="center"><?php echo $target_hc = $jml_hari_report-$cek_hari_libur; ?></td>
                          <td align="center"><?php echo $total_HC; ?></td>
                          <td align="center"><?php echo number_format(($total_HC/$target_hc*100), 2)." %"; ?></td>
                        </tr>
                        <tr>
                          <td align="center">3</td>
                          <td>Permit to work</td>
                          <td align="center">1</td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td align="center">4</td>
                          <td colspan="4">Inspection</td>
                        </tr>
                        <tr>
                          <td align="center"></td>
                          <td style="text-indent: 20px;">a. Heavy Equipment</td>
                          <td align="center">1</td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td align="center"></td>
                          <td style="text-indent: 20px;">b. Safety K3</td>
                          <td align="center">1</td>
                          <td align="center"><?php echo $jml_inspeksi_apar; ?></td>
                          <td align="center"><?php echo number_format(($jml_inspeksi_apar/1*100), 2)." %"; ?></td>
                        </tr>
                        <tr>
                          <td align="center"></td>
                          <td style="text-indent: 20px;">c. Power Tool</td>
                          <td align="center">1</td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td align="center"></td>
                          <td style="text-indent: 20px;">d. PPE</td>
                          <td align="center">1</td>
                          <td align="center"><?php echo $jml_inspeksi_apd; ?></td>
                          <td align="center"><?php echo number_format(($jml_inspeksi_apd/1*100), 2)." %"; ?></td>
                        </tr>
                        <tr>
                          <td align="center">5</td>
                          <td>House Keeping</td>
                          <td align="center"><?php echo $target_HK = $jml_hari_report-$cek_hari_libur; ?></td>
                          <td align="center"><?php echo $total_HK; ?></td>
                          <td align="center"><?php echo number_format(($total_HK/$target_HK*100), 2)." %"; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- -------------------------------------------- ROW ------------------------------------- -->


        <div class="page-break"></div>

        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card" style="margin-right: -10px;">
              <div class="card-body">
                <div class="row" style="margin-bottom: 10px">
                  <div class="col-12">
                    <table class="table table-bordered table-sm" style="font-size: 12px; margin-bottom: 15px;">
                      <tr>
                        <td width="40%" rowspan="4" align="center" style="vertical-align: middle;">
                          <div style="font-size: 16px; font-weight: bold; padding-bottom: 10px;">CHECKLIST DAILY REPORT</div>
                          <img src="../../dist/img/logo/gpp-logo.png" width="15%">
                          <img src="../../dist/img/logo/logo-k3.png" width="22%">
                        </td>
                        <td width="15%">Nama Project</td>
                        <td><?php echo $get_project['nama_project']; ?></td>
                      </tr>
                      <tr>
                        <td>Lokasi</td>
                        <td><?php echo $get_project['kota']; ?></td>
                      </tr>
                      <tr>
                        <td>HSE Officer</td>
                        <td><?php echo $get_hseofficer['nama']; ?></td>
                      </tr>
                      <tr>
                        <td>Week <?php echo $get_weeklyreport['week']; ?></td>
                        <td><?php echo date("d F Y", strtotime($get_weeklyreport['tgl_awal']))." - ".date("d F Y", strtotime($get_weeklyreport['tgl_akhir'])); ?></td>
                      </tr>
                    </table>
                    <table class="table table-bordered table-sm" style="font-size: 12px; margin-bottom: 15px;">
                      <thead>
                        <tr align="center">
                          <th width="1%">No</th>
                          <th>Hari / Tanggal</th>
                          <th width="10%">TBM</th>
                          <th width="10%">Health Check</th>
                          <th width="10%">House Keeping</th>
                          <th width="10%">Tgl Submit</th>
                          <th width="10%">Jam Submit</th>
                          <th width="15%">Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no=1;
                          for ($tanggal = strtotime($get_weeklyreport['tgl_awal']); $tanggal <= strtotime($get_weeklyreport['tgl_akhir']); $tanggal = strtotime("+1 day", $tanggal)) {
                            $tgl_report = ltrim(date("d-m-Y", $tanggal), "0");
                            $kd_report = $project_id[2]."/".$tgl_report;
                            $get_dailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$kd_report'"));

                            $nilai_TBM = 0;
                            $nilai_HC = 0;
                            $nilai_HK = 0;

                            $cek_TBM = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE kd_report = '$kd_report' AND pekerjaan = 'Toolbox Meeting'"));
                            $cek_HC = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE kd_report = '$kd_report' AND pekerjaan = 'Lampiran TBM & HC'"));
                            $cek_HK = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE kd_report = '$kd_report' AND pekerjaan = 'House Keeping'"));

                            if($cek_TBM > 0){ $nilai_TBM = 1; }
                            if($cek_HC > 0){ $nilai_HC = 1; }
                            if($cek_HK > 0){ $nilai_HK = 1; }

                            $total_report = $nilai_TBM + $nilai_HC + $nilai_HK;
                            $report_tgl = date("Y-m-d", ($tanggal));
                            $tgl_submit = date("Y-m-d", strtotime($get_dailyreport['tgl_submit']));
                            $jam_submit = date("H:i:s", strtotime($get_dailyreport['tgl_submit']));

                            if($get_dailyreport['status_report'] == 'libur/tidak ada pekerjaan'){
                              $keterangan = "Libur/Tidak ada pekerjaan";
                              $nilai_TBM = "-";
                              $nilai_HC = "-";
                              $nilai_HK = "-";
                            }elseif($total_report == 3 AND $tgl_submit <= $report_tgl AND $jam_submit <= "22:00:00"){
                              $keterangan = "SANGAT BAIK";
                            }elseif($total_report == 3 AND $tgl_submit <= $report_tgl AND $jam_submit > "22:00:00"){
                              $keterangan = "BAIK";
                            }elseif($total_report == 3 AND $tgl_submit > $report_tgl){
                              $keterangan = "KURANG BAIK";
                            }elseif($total_report == 2 AND $tgl_submit <= $report_tgl AND $jam_submit <= "22:00:00"){
                              $keterangan = "KURANG BAIK";
                            }elseif($total_report == 2 AND $tgl_submit <= $report_tgl AND $jam_submit > "22:00:00"){
                              $keterangan = "KURANG BAIK";
                            }elseif($total_report == 2 AND $tgl_submit > $report_tgl){
                              $keterangan = "TIDAK BAIK";
                            }elseif($total_report == 1 OR $total_report == 0){
                              $keterangan = "TIDAK BAIK";
                            }else{
                              $keterangan = "KONDISI TIDAK ADA";
                            }

                        ?>
                          <tr>
                            <td align="center"><?php echo $no; ?></td>
                            <td><?php echo date("l , d-m-Y", ($tanggal)); ?></td>
                            <td align="center"><?php echo $nilai_TBM; ?></td>
                            <td align="center"><?php echo $nilai_HC; ?></td>
                            <td align="center"><?php echo $nilai_HK; ?></td>
                            <td align="center">
                              <?php
                                if($get_dailyreport['status_report'] == 'libur/tidak ada pekerjaan'){
                                  echo "-";
                                }else{
                                  echo date("d-m-Y", strtotime($get_dailyreport['tgl_submit']));
                                }
                              ?>
                            </td>
                            <td align="center">
                              <?php
                                if($get_dailyreport['status_report'] == 'libur/tidak ada pekerjaan'){
                                  echo "-";
                                }else{
                                  echo date("H:i:s", strtotime($get_dailyreport['tgl_submit']));
                                }
                              ?>
                            </td>
                            <td align="center" style="color: white;" <?php if($keterangan == "SANGAT BAIK" OR $keterangan == "BAIK"){ echo "bgcolor='#4bba43'";}elseif($keterangan == "KURANG BAIK"){echo "bgcolor='#ffae00'";}elseif($keterangan == "TIDAK BAIK"){echo "bgcolor='#de0c00'";}elseif($keterangan == "Libur/Tidak ada pekerjaan"){echo "bgcolor='#bdbdbd'";} ?>><?php echo $keterangan; ?></td>
                          </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>

                    <table class="table table-bordered table-sm" style="font-size: 12px">
                      <tr>
                        <td align="center" colspan="4"><b>Weekly Inspeksi</b></td>
                      </tr>
                      <tr align="center">
                        <td width="25%">APD</td>
                        <td width="25%">APAR</td>
                        <td width="25%">P3K</td>
                        <td width="25%">ALAT KERJA</td>
                      </tr>
                      <tr align="center">
                        <td width="25%">-</td>
                        <td width="25%">-</td>
                        <td width="25%">-</td>
                        <td width="25%">-</td>
                      </tr>
                      <tr align="center">
                        <td>KETERANGAN</td>
                        <td colspan="3" >SANGAT BAIK</td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <center>
            <button class="btn btn-secondary no-print" onclick="window.print()"><span class="fa fa-print"></span> Cetak / Simpan</button>
          </a>
        </center>
        <br>

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_deskrippekerjaan" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Deskripsi Pekerjaan</h4>
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