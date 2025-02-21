<?php
  $get_weeklyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE kd_weekly = '$_GET[kdweekly]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_weeklyreport[project_id]'"));
?>
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

                            echo date("H", $t_detik)." Hours ".date("i", $t_detik)." Minutes";
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
                          <th width="2%">P</th>
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
                                mysqli_query($conn, "INSERT INTO hse_dailyreport_deskripsipekerjaan VALUES ('','$_GET[kdweekly]','$data_manpower_id[$k]','$data_jabatan_id[$k]','Input Description of Work')");
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
                              $get_Fatality = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu INNER JOIN hse_dailyreport WHERE kejadian = 'Loss Time Injury' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_isu.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM Permission
                              $get_permission = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower INNER JOIN hse_dailyreport WHERE absensi = 'Izin' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_manpower.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));

                              //SUM Sick
                              $get_sick = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower INNER JOIN hse_dailyreport WHERE absensi = 'Sakit' AND manpower_id = '$data_manpower_id[$k]' AND hse_dailyreport_manpower.kd_report = hse_dailyreport.kd_report AND hse_dailyreport.project_id = '$get_weeklyreport[project_id]' AND hse_dailyreport.tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]' AND hse_dailyreport.status_report = 'completed'"));
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
                                <td align="center">4</td>
                                <td align="center">4</td>
                                <td align="center">
                                  <?php
                                    list($jam, $menit, $detik) = explode(":", $get_manHours['selisih_waktu']);
                                    echo date("H", strtotime($jam)); 
                                  ?>    
                                </td>
                                <td align="center"><?php echo $get_nearMiss; ?></td>
                                <td align="center"><?php echo $get_FirstAid; ?></td>
                                <td align="center"><?php echo $get_MedicalTreatment; ?></td>
                                <td align="center"><?php echo $get_LTI; ?></td>
                                <td align="center"><?php echo $get_Fatality; ?></td>
                              </tr>
                            <?php } ?>
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