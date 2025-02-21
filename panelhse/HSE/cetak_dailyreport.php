<?php
  error_reporting(0);
  ob_start(); 
  session_start();

  require_once "../all_role/header.php";
  require_once "../../dev/config.php";

  setlocale(LC_TIME, 'id_ID');

  $kodeReport = $_GET['kdproject']."/".$_GET['tgl'];
  $tgl_report = date("Y-m-d", strtotime($_GET['tgl']));

  $getDailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$kodeReport'"));
  $get_Project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$_GET[kdproject]'"));
  $getOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_Project[hse_officer]'"));

  //---- GET CUACA ----
  $q_getCuaca = mysqli_query($conn, "SELECT * FROM hse_dailyreport_cuaca WHERE kd_report = '$kodeReport'");
  $itterasi = 0;
  while($getCuaca = mysqli_fetch_array($q_getCuaca)){
    $cuacaid[$itterasi] = $getCuaca['id'];
    $datacuaca[$itterasi] = $getCuaca['cuaca']." (".date("H:i", strtotime($getCuaca['jam_mulai']))." - ".date("H:i", strtotime($getCuaca['jam_selesai'])).")";
    $itterasi++;
  }

  if($getDailyreport['status_report'] == "completed"){
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daily Report HSE</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2 col-3">
            <div class="card">
              <div class="card-body">
                <center>
                  <img src="../../dist/img/logo/gpp-logo.png" width="35%" style="margin-top: 8px; margin-bottom: 2px;">
                  <br>
                  <h3 style="font-size: 14px; margin-bottom: 15px;">LAPORAN HARIAN K3L PROYEK</h3>
                </center>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-lg-5 col-5">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm" style="font-size: 12px;">
                  <tbody>
                    <tr>
                      <td width="28%"><b>Nama Project</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_Project['nama_project']; ?></td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Lokasi / Kota</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_Project['kota']; ?></td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Tanggal Report</b></td>
                      <td width="1%">:</td>
                      <td><?php echo strftime("%A, %d %B %Y", strtotime($_GET['tgl'])); ?></td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Safety Officer</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $getOfficer['nama']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-lg-5 col-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Jam Kerja & Cuaca</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm" style="font-size: 12px;">
                  <tbody>
                    <tr>
                      <td width="30%"><b>Jam Kerja</b></td>
                      <td width="1%">:</td>
                      <td><?php echo date("H:i", strtotime($get_Project['jam_masuk']))." - ".date("H:i", strtotime($get_Project['jam_pulang'])); ?></td>
                    </tr>
                    <tr>
                      <td><b>Cuaca</b></td>
                      <td>:</td>
                      <td>
                        <?php echo $datacuaca[0]; ?>
                      </td>
                    </tr>
                    <?php if($datacuaca[1] != ""){ ?>
                      <tr>
                        <td></td>
                        <td>:</td>
                        <td>
                          <?php echo $datacuaca[1]; ?>
                        </td>
                      </tr>
                    <?php } ?>
                    <?php if($datacuaca[2] != ""){ ?>
                      <tr>
                        <td></td>
                        <td>:</td>
                        <td>
                          <?php echo $datacuaca[2]; ?>
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
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- -------------------------------------------- ROW ------------------------------------- -->

        <div class="row">
          <div class="col-lg-6 col-7">
            <div class="card">
              <div class="card-body" style="margin-bottom: -10px; margin-right: -15px;">
                <h3 class="card-title" style="margin-bottom: 6px">Daftar Tenaga Kerja (<i>Man Power</i>)</h3>
                <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Manpower</th>
                      <th width="25%">Jabatan</th>
                      <th width="10%">Absensi</th>
                      <th width="15%">Jam Kerja</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_get_dailyreport_manpower = mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower WHERE kd_report = '$kodeReport'");
                      while($get_dailyreport_manpower = mysqli_fetch_array($q_get_dailyreport_manpower)){
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_dailyreport_manpower[manpower_id]'"));
                        $get_jabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_jabatan WHERE id = '$get_dailyreport_manpower[jabatan_id]'"));
                        $no++;
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_manpower['nama']; ?></td>
                        <td><?php echo $get_jabatan['jabatan']; ?></td>
                        <td><?php echo $get_dailyreport_manpower['absensi']; ?></td>
                        <td>
                          <?php
                            if($get_dailyreport_manpower['absensi'] == "Hadir"){
                              echo date("H:i", strtotime($get_dailyreport_manpower['jam_masuk']))." - ".date("H:i", strtotime($get_dailyreport_manpower['jam_pulang']));
                            }
                          ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card" style="margin-top: -10px">
              <div class="card-body" style="margin-top: -10px; margin-bottom: -10px; margin-right: -15px;">
                <h3 class="card-title" style="margin-bottom: 6px">Daftar Tools K3 yang digunakan</h3>
                <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Tools K3</th>
                      <th width="5%">Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_getToolsk3Project = mysqli_query($conn, "SELECT * FROM hse_dailyreport_toolsk3 WHERE kd_report = '$kodeReport'");
                      while($getToolsk3Project = mysqli_fetch_array($q_getToolsk3Project)){
                        $getToolsk3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsk3 WHERE id = '$getToolsk3Project[toolsk3_id]'"));
                        $no++;
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $getToolsk3['nama_tools']; ?></td>
                        <td><?php echo $getToolsk3Project['jumlah']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <!-- ------------------------------------- COL ------------------------------------------ -->

          <div class="col-lg-6 col-5">
            <div class="card">
              <div class="card-body" style="margin-bottom: -10px; margin-left: -15px;">
                <h3 class="card-title" style="margin-bottom: 6px;">Daftar Tools Yang Digunakan</h3>
                <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Tools</th>
                      <th width="5%">Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_getToolsProject = mysqli_query($conn, "SELECT * FROM hse_dailyreport_tools WHERE kd_report = '$kodeReport'");
                      while($getToolsProject = mysqli_fetch_array($q_getToolsProject)){
                        $getTools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_tools WHERE id = '$getToolsProject[tools_id]'"));
                        $no++;
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $getTools['tools']; ?></td>
                        <td><?php echo $getToolsProject['jumlah']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card" style="margin-top: -10px">
              <div class="card-body" style="margin-top: -10px; margin-bottom: -10px; margin-left: -15px;">
                <h3 class="card-title" style="margin-bottom: 6px">Daftar APD Yang Digunakan</h3>
                <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama APD</th>
                      <th width="5%">Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_getAPDProject = mysqli_query($conn, "SELECT * FROM hse_dailyreport_apd WHERE kd_report = '$kodeReport'");
                      while($getAPDProject = mysqli_fetch_array($q_getAPDProject)){
                        $getAPD = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_apd WHERE id = '$getAPDProject[apd_id]'"));
                        $no++;
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $getAPD['nama_apd']; ?></td>
                        <td><?php echo $getAPDProject['jumlah']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12">
            <div class="card" style="margin-top: -10px">
              <div class="card-body" style="margin-top: -10px">
                <h3 class="card-title" style="margin-bottom: 6px">Isu Keselamatan Kerja (<i>Workplace Safety Issues</i>)</h3>
                <?php
                  $total_FAT = 0;
                  $total_LTI = 0;
                  $total_MT = 0;
                  $total_FA = 0;
                  $total_NM = 0;
                  $total_ENV = 0;

                  $total_FAT = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Fatallity'"));
                  $total_LTI = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Loss Time Injury'"));
                  $total_MT = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Medical Treatment Injury'"));
                  $total_FA = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'First Aid Injury'"));
                  $total_NM = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Near Miss'"));
                  $total_ENV = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Enviroment Incident'"));
                ?>
                <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead style="text-align: center;">
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
                    <tr>
                      <th width="1%">No</th>
                      <th width="13%">Kejadian</th>
                      <th width="10%">Manpower</th>
                      <th width="5%">Jam</th>
                      <th width="">Keterangan Kejadian</th>
                      <th width="">Corrective Action</th>
                      <th width="15%">Foto</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_get_dailyreport_isu = mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport'");
                      while($get_dailyreport_isu = mysqli_fetch_array($q_get_dailyreport_isu)){
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_dailyreport_isu[manpower_id]'"));
                        $no++;
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <?php if($get_dailyreport_isu['kejadian'] == "Fatallity"){ ?>
                            <div class="bg-black color-palette" style="padding-left: 5px; padding-right: 5px">
                              <?php echo $get_dailyreport_isu['kejadian']; ?>
                            </div>
                          <?php }elseif($get_dailyreport_isu['kejadian'] == "Loss Time Injury"){ ?>
                            <div class="bg-danger color-palette" style="padding-left: 5px; padding-right: 5px">
                              <?php echo $get_dailyreport_isu['kejadian']; ?>
                            </div>
                          <?php }elseif($get_dailyreport_isu['kejadian'] == "Medical Treatment Injury"){ ?>
                            <div class="bg-pink color-palette" style="padding-left: 5px; padding-right: 5px">
                              <?php echo $get_dailyreport_isu['kejadian']; ?>
                            </div>
                          <?php }elseif($get_dailyreport_isu['kejadian'] == "First Aid Injury"){ ?>
                            <div class="bg-orange color-palette" style="padding-left: 5px; padding-right: 5px">
                              <?php echo $get_dailyreport_isu['kejadian']; ?>
                            </div>
                          <?php }elseif($get_dailyreport_isu['kejadian'] == "Near Miss"){ ?>
                            <div class="bg-warning color-palette" style="padding-left: 5px; padding-right: 5px">
                              <?php echo $get_dailyreport_isu['kejadian']; ?>
                            </div>
                          <?php }elseif($get_dailyreport_isu['kejadian'] == "Enviroment Incident"){ ?>
                            <div class="bg-purple color-palette" style="padding-left: 5px; padding-right: 5px">
                              <?php echo $get_dailyreport_isu['kejadian']; ?>
                            </div>
                          <?php } ?>
                        </td>
                        <td><?php echo $get_manpower['nama']; ?></td>
                        <td><?php echo date("H:i", strtotime($get_dailyreport_isu['jam'])); ?></td>
                        <td><?php echo $get_dailyreport_isu['keterangan_kejadian']; ?></td>
                        <td><?php echo $get_dailyreport_isu['corrective_action']; ?></td>
                        <td><img src="../../role/HSE/foto_isuk3/<?php echo $get_dailyreport_isu['foto']; ?>" style="height: 80px;"></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12">
            <div class="card" style="margin-top: -10px">
              <div class="card-header" style="margin-top: -10px; margin-bottom: -10px">
                <h3 class="card-title">Aktivitas Pekerjaan</h3>
              </div>
              <!-- /.card-header -->
              <?php
                $datake = 1;
                $q_get_dokumentasiproject = mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE kd_report = '$kodeReport'");
                while($get_dokumentasiproject = mysqli_fetch_array($q_get_dokumentasiproject)){
                  $data_id[$datake] = $get_dokumentasiproject['id'];
                  $data_pekerjaan[$datake] = $get_dokumentasiproject['pekerjaan'];
                  $data_foto[$datake] = $get_dokumentasiproject['foto'];
                  $datake++;
                }
              ?>

              <div class="card-body row"style="margin-bottom: -20px">
                <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right: 4px;">
                  <table class="table table-head-fixed table-bordered table-striped table-sm" style="font-size: 11px;">
                    <thead>
                      <tr>
                        <th width="1%">No</th>
                        <th width="">Pekerjaan</th>
                        <th width="40%">Foto</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        for($i=1;$i<$datake;$i++){
                          if($i % 2 != 0){
                      ?>
                          <tr>
                            <td width="1%"><?php echo $i; ?></td>
                            <td width=""><?php echo $data_pekerjaan[$i]; ?></td>
                            <td width=""><img src="../../role/HSE/dokumentasi_project/<?php echo $data_foto[$i]; ?>" height="120px"></td>
                          </tr>
                      <?php }} ?>
                    </tbody>
                  </table>
                </div>

                <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-left: 4px;">
                  <table class="table table-head-fixed table-bordered table-striped table-sm" style="font-size: 11px;">
                    <thead>
                      <tr>
                        <th width="1%">No</th>
                        <th width="">Pekerjaan</th>
                        <th width="40%">Foto</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        for($i=1;$i<$datake;$i++){
                          if($i % 2 == 0){
                      ?>
                          <tr>
                            <td width="1%"><?php echo $i; ?></td>
                            <td width=""><?php echo $data_pekerjaan[$i]; ?></td>
                            <td width=""><img src="../../role/HSE/dokumentasi_project/<?php echo $data_foto[$i]; ?>" height="120px"></td>
                          </tr>
                      <?php }} ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12">
            <div class="card" style="margin-top: -10px">
              <div class="card-body" style="margin-top: -10px">
                <h3 class="card-title" style="margin-bottom: 6px">Note / Kendala</h3>
                <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Note / Kendala</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_get_dailyreport_note = mysqli_query($conn, "SELECT * FROM hse_dailyreport_note WHERE kd_report = '$kodeReport'");
                      while($get_dailyreport_note = mysqli_fetch_array($q_get_dailyreport_note)){
                        $no++;
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_dailyreport_note['note']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  <!-------------------------------------------------- AKHIR PROJECT COMPLETED --------------------------------------->

  <?php }elseif($getDailyreport['status_report'] == "hold" || $getDailyreport['status_report'] == "libur/tidak ada pekerjaan"){ ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Daily Report HSE</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2 col-5">
            <div class="card">
              <div class="card-body">
                <center>
                  <img src="../../dist/img/logo/gpp-logo.png" width="35%" style="margin-top: 8px; margin-bottom: 2px;">
                  <br>
                  <h3 style="font-size: 14px; margin-bottom: 15px;">LAPORAN HARIAN K3L PROYEK</h3>
                </center>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-lg-5 col-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm" style="font-size: 12px;">
                  <tbody>
                    <tr>
                      <td width="28%"><b>Nama Project</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_Project['nama_project']; ?></td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Lokasi / Kota</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_Project['kota']; ?></td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Tanggal Report</b></td>
                      <td width="1%">:</td>
                      <td><?php echo strftime("%A, %d %B %Y", strtotime($_GET['tgl'])); ?></td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Safety Officer</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $getOfficer['nama']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-lg-5 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Status Project</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm" style="font-size: 12px;">
                  <tbody>
                    <tr>
                      <td width="28%"><b>Status Project</b></td>
                      <td width="1%">:</td>
                      <td>
                        <?php if($getDailyreport['status_report'] == "hold"){ ?>
                          <span class="badge badge-danger">Project Hold</span>
                        <?php }elseif($getDailyreport['status_report'] == "libur/tidak ada pekerjaan"){ ?>
                          <span class="badge badge-info">Libur / Tidak Ada Pekerjaan</span>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Keterangan</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $getDailyreport['keterangan']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- -------------------------------------------- ROW ------------------------------------- -->

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <!-------------------------------------------------- AKHIR PROJECT HOLD / LIBUR --------------------------------------->

  <?php }else{ echo "------------------------------------------- DATA TIDAK DITEMUKAN"; }?>



<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Sweet Alarm -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>

<script src="../finance/dynamic-form.js"></script>

<script>
// JavaScript untuk mencetak halaman otomatis saat dimuat
window.onload = function() {
    window.print();
}
</script>