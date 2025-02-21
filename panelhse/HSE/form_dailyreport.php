<?php
  date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan lokasi
  $date_time_now = date("Y-m-d H:i:s");
  $get_Project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$_GET[kdproject]'"));

  $kodeReport = $_GET['kdproject']."/".$_GET['tgl'];
  $tgl_report = date("Y-m-d", strtotime($_GET['tgl']));
  $getDailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$kodeReport'"));
  $getOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$getDailyreport[hse_officer]'"));

  $cek_kdreport = mysqli_num_rows(mysqli_query($conn, "SELECT kd_report FROM hse_dailyreport WHERE kd_report = '$kodeReport'"));
  if($cek_kdreport < 1){
    $add_kode_report = mysqli_query($conn, "INSERT INTO hse_dailyreport VALUES('$kodeReport','$_GET[kdproject]','$tgl_report','$get_Project[hse_officer]','onprogress','','')");
  }

  //---- GET CUACA ----
  $q_getCuaca = mysqli_query($conn, "SELECT * FROM hse_dailyreport_cuaca WHERE kd_report = '$kodeReport'");
  $itterasi = 0;
  while($getCuaca = mysqli_fetch_array($q_getCuaca)){
    $cuacaid[$itterasi] = $getCuaca['id'];
    $datacuaca[$itterasi] = $getCuaca['cuaca']." (".date("H:i", strtotime($getCuaca['jam_mulai']))." - ".date("H:i", strtotime($getCuaca['jam_selesai'])).")";
    $itterasi++;
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Daily Report HSE</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Data Project</li>
              <li class="breadcrumb-item">Detail Project</li>
              <li class="breadcrumb-item active">Form Report</li>
            </ol>
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

          <div class="col-lg-5">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Jam Kerja & Cuaca</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm" style="font-size: 12px;">
                  <tbody>
                    <tr>
                      <td width="25%"><b>Jam Kerja</b></td>
                      <td width="1%">:</td>
                      <td><?php echo date("H:i", strtotime($get_Project['jam_masuk']))." - ".date("H:i", strtotime($get_Project['jam_pulang'])); ?></td>
                      <td width="20%">
                        <a href="#modal" data-toggle='modal' data-target='#show_edit_jamKerja' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="edit jam kerja">
                          <span class="fa fa-edit"></span> Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td width="25%"><b>Cuaca</b></td>
                      <td width="1%">:</td>
                      <td>
                        <?php echo $datacuaca[0]; if($datacuaca[0] != ""){?> <a href="#modal" data-toggle='modal' data-target='#show_delete_cuacaproject' data-id='<?php echo $cuacaid[0]; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close" style="color: red"></span></a> <?php } ?>
                      </td>
                      <td width="20%">
                        <a href="#modal" data-toggle='modal' data-target='#show_add_cuaca_project' data-id='<?php echo $kodeReport; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Cuaca"><span class="fa fa-pencil"></span> Tambah</a>
                      </td>
                    </tr>
                    <tr>
                      <td width="25%"></td>
                      <td width="1%">:</td>
                      <td colspan="2">
                        <?php echo $datacuaca[1]; if($datacuaca[1] != ""){?> <a href="#modal" data-toggle='modal' data-target='#show_delete_cuacaproject' data-id='<?php echo $cuacaid[1]; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close" style="color: red"></span></a> <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="25%"></td>
                      <td width="1%">:</td>
                      <td colspan="2">
                        <?php echo $datacuaca[2]; if($datacuaca[2] != ""){?> <a href="#modal" data-toggle='modal' data-target='#show_delete_cuacaproject' data-id='<?php echo $cuacaid[2]; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close" style="color: red"></span></a> <?php } ?>
                      </td>
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

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Tenaga Kerja (<i>Man Power</i>)</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#get_datamanpower' data-id='<?php echo $kodeReport; ?>' data-toggle="tooltip" data-placement="bottom" title="Get Data Manpower">
                    <div class="btn btn-success btn-xs" style="font-size:11px;"><span class="fa fa-download"></span> Get Data</div>
                  </a>

                  <a href="index.php?pages=detailproject&kd=<?php echo $_GET['kdproject'] ?>"><div class="btn btn-success btn-xs" style="font-size:11px;"><span class="fa fa-edit"></span> Edit Data</div></a>

                  <a href="#modal" data-toggle='modal' data-target='#clear_datamanpower' data-id='<?php echo $kodeReport; ?>' data-toggle="tooltip" data-placement="bottom" title="Clear Data Manpower">
                    <div class="btn btn-danger btn-xs" style="font-size:11px;"><span class="fa fa-trash"></span> Clear Data</div>
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table text-nowrap table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Manpower</th>
                      <th width="25%">Jabatan</th>
                      <th width="10%">Absensi</th>
                      <th width="18%">Jam Kerja</th>
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
                        <td>
                          <?php if($get_dailyreport_manpower['absensi'] == "Hadir"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_absensi_dailyreporthse' data-id='<?php echo $get_dailyreport_manpower['id'] ; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Tools Project"><div class="bg-success color-palette" style="text-align: center;"><?php echo $get_dailyreport_manpower['absensi']; ?></div></a>
                          <?php }elseif($get_dailyreport_manpower['absensi'] == "Izin"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_absensi_dailyreporthse' data-id='<?php echo $get_dailyreport_manpower['id'] ; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Tools Project"><div class="bg-warning color-palette" style="text-align: center;"><?php echo $get_dailyreport_manpower['absensi']; ?></div></a>
                          <?php }elseif($get_dailyreport_manpower['absensi'] == "Sakit"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_absensi_dailyreporthse' data-id='<?php echo $get_dailyreport_manpower['id'] ; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Tools Project"><div class="bg-secondary color-palette" style="text-align: center;"><?php echo $get_dailyreport_manpower['absensi']; ?></div></a>
                          <?php }elseif($get_dailyreport_manpower['absensi'] == "Alpa"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_absensi_dailyreporthse' data-id='<?php echo $get_dailyreport_manpower['id'] ; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Tools Project"><div class="bg-danger color-palette" style="text-align: center;"><?php echo $get_dailyreport_manpower['absensi']; ?></div></a>
                          <?php } ?>
                        </td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_jamKerjaManpower' data-id='<?php echo $get_dailyreport_manpower['id'] ; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Tools Project">
                            <?php
                              if($get_dailyreport_manpower['absensi'] == "Hadir"){
                                echo date("H:i", strtotime($get_dailyreport_manpower['jam_masuk']))." - ".date("H:i", strtotime($get_dailyreport_manpower['jam_pulang']));
                              }
                            ?>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Tools K3 yang digunakan</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_toolsk3_reporthse_new' data-id='<?php echo $_GET['kdproject']."/".$_GET['tgl']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Tools K3">
                    <div class="btn btn-info btn-xs" style="font-size:11px;">
                      <span class="fa fa-pencil"></span> Tambah Data Tools K3
                    </div>
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table text-nowrap table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Tools K3</th>
                      <th width="5%">Jumlah</th>
                      <th width="8%">#</th>
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
                        <td style="font-size: 11px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_toolsk3_reporthse' data-id='<?php echo $getToolsk3Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Ubah Jumlah Tools K3">
                            <span class="fa fa-edit"></span>
                          </a>
                          | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_toolsk3_reporthse' data-id='<?php echo $getToolsk3Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Tools">
                            <span class="fa fa-trash"></span>
                          </a>
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

          <!-- ------------------------------------- COL ------------------------------------------ -->

          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Tools Yang Digunakan</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_tools_reporthse_new' data-id='<?php echo $_GET['kdproject']."/".$_GET['tgl']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Tools Project">
                    <div class="btn btn-info btn-xs" style="font-size:11px;">
                        <span class="fa fa-pencil"></span> Tambah Data Tools
                    </div>
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table text-nowrap table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Tools</th>
                      <th width="5%">Jumlah</th>
                      <th width="5%">#</th>
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
                        <td style="font-size: 11px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_tools_reporthse' data-id='<?php echo $getToolsProject['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Ubah Jumlah Tools">
                            <span class="fa fa-edit"></span>
                          </a>
                          | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_tools_reporthse' data-id='<?php echo $getToolsProject['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Tools">
                            <span class="fa fa-trash"></span>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar APD Yang Digunakan</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_apd_reporthse_new' data-id='<?php echo $_GET['kdproject']."/".$_GET['tgl']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data APD">
                    <div class="btn btn-info btn-xs" style="font-size:11px;"><span class="fa fa-pencil"></span> Tambah Data APD</div>
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table text-nowrap table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama APD</th>
                      <th width="5%">Jumlah</th>
                      <th width="5%">#</th>
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
                        <td style="font-size: 11px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_apd_reporthse' data-id='<?php echo $getAPDProject['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Ubah Jumlah APD">
                            <span class="fa fa-edit"></span>
                          </a>
                          | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_apd_reporthse' data-id='<?php echo $getAPDProject['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete APD">
                            <span class="fa fa-trash"></span>
                          </a>
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

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Isu Keselamatan Kerja (<i>Workplace Safety Issues</i>)</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_isuk3' data-id='<?php echo $_GET['kdproject']."/".$_GET['tgl']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Isu K3">
                    <div class="btn btn-info btn-xs" style="font-size:11px;"><span class="fa fa-pencil"></span> Tambah Isu</div>
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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
                <table id="showallnosearch" class="table text-nowrap table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Kejadian</th>
                      <th width="">Manpower</th>
                      <th width="5%">Jam</th>
                      <th width="">Keterangan Kejadian</th>
                      <th width="">Corrective Action</th>
                      <th width="15%">Foto</th>
                      <th width="5%">#</th>
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
                          <?php }elseif($get_dailyreport_isu['kejadian'] == "Unsafe Action"){ ?>
                            <div class="bg-warning color-palette" style="padding-left: 5px; padding-right: 5px">
                              <?php echo $get_dailyreport_isu['kejadian']; ?>
                            </div>
                          <?php }elseif($get_dailyreport_isu['kejadian'] == "Unsafe Condition"){ ?>
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
                        <td style="font-size: 13px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_isuk3' data-id='<?php echo $get_dailyreport_isu['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Ubah Isu K3">
                            <span class="fa fa-edit"></span>
                          </a>
                          | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_isuk3' data-id='<?php echo $get_dailyreport_isu['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Isu K3">
                            <span class="fa fa-trash"></span>
                          </a>
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

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Aktivitas HSE</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_dokumentasiproject' data-id='<?php echo $_GET['kdproject']."/".$_GET['tgl']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Dokumentasi Pekerjaan">
                    <div class="btn btn-info btn-xs" style="font-size:11px;"><span class="fa fa-pencil"></span> Tambah Aktivitas</div>
                  </a>
                </div>
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

              <div class="card-body row">
                <div class="col-md-6 col-12" style="padding-right: 4px;">
                  <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                    <thead>
                      <tr>
                        <th width="1%">No</th>
                        <th width="">Pekerjaan</th>
                        <th width="60%">Foto</th>
                        <th width="5%">#</th>
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
                            <td width=""><img src="../../role/hse/dokumentasi_project/<?php echo $data_foto[$i]; ?>" height="120px"></td>
                            <td width="5%" style="font-size: 14px">
                              <a href="#modal" data-toggle='modal' data-target='#show_edit_dokumentasiproject' data-id='<?php echo $data_id[$i]; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Dokumentasi Pekerjaan">
                                <span class="fa fa-edit"></span>
                              </a>

                              <a href="#modal" data-toggle='modal' data-target='#show_delete_dokumentasiproject' data-id='<?php echo $data_id[$i]; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Dokumentasi Pekerjaan">
                                <span class="fa fa-trash"></span>
                              </a>
                            </td>
                          </tr>
                      <?php }} ?>
                    </tbody>
                  </table>
                </div>

                <div class="col-md-6 col-12" style="padding-left: 4px;">
                  <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                    <thead>
                      <tr>
                        <th width="1%">No</th>
                        <th width="">Pekerjaan</th>
                        <th width="60%">Foto</th>
                        <th width="5%">#</th>
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
                            <td width=""><img src="../../role/hse/dokumentasi_project/<?php echo $data_foto[$i]; ?>" height="120px"></td>
                            <td width="5%" style="font-size: 14px">
                              <a href="#modal" data-toggle='modal' data-target='#show_edit_dokumentasiproject' data-id='<?php echo $data_id[$i]; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Dokumentasi Pekerjaan">
                                <span class="fa fa-edit"></span>
                              </a>

                              <a href="#modal" data-toggle='modal' data-target='#show_delete_dokumentasiproject' data-id='<?php echo $data_id[$i]; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Dokumentasi Pekerjaan">
                                <span class="fa fa-trash"></span>
                              </a>
                            </td>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Note / Kendala</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_dailyreportnote' data-id='<?php echo $_GET['kdproject']."/".$_GET['tgl']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Isu K3">
                    <div class="btn btn-info btn-xs" style="font-size:11px;"><span class="fa fa-pencil"></span> Tambah Note/Kendala</div>
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Note / Kendala</th>
                      <th width="5%">#</th>
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
                        <td style="font-size: 13px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_dailyreportnote' data-id='<?php echo $get_dailyreport_note['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Ubah Note/Kendala">
                            <span class="fa fa-edit"></span>
                          </a>
                          | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_dailyreportnote' data-id='<?php echo $get_dailyreport_note['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Note/Kendala">
                            <span class="fa fa-trash"></span>
                          </a>
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

        <div class="row">
          <div class="col-md-1 col-0"></div>
          <div class="col-md-3 col-4">
            <a href="#modal" data-toggle='modal' data-target='#project_libur' data-id='<?php echo $_GET['kdproject']."/".$_GET['tgl']; ?>' data-toggle="tooltip" data-placement="bottom" title="Project Libur">
              <button class="btn btn-info" style="width: 100%">Libur</button>
            </a>
          </div>
          <div class="col-md-3 col-4">
            <a href="#modal" data-toggle='modal' data-target='#project_hold' data-id='<?php echo $_GET['kdproject']."/".$_GET['tgl']; ?>' data-toggle="tooltip" data-placement="bottom" title="Project Hold">
              <button class="btn btn-warning" style="width: 100%">Hold</button>
            </a>
          </div>
          <div class="col-md-4 col-4">
            <a href="#modal" data-toggle='modal' data-target='#report_complete' data-id='<?php echo $_GET['kdproject']."/".$_GET['tgl']; ?>' data-toggle="tooltip" data-placement="bottom" title="Report Complete">
              <button class="btn btn-success" style="width: 100%">Complete</button>
            </a>
          </div>
        </div>
        <br>

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_manpower_project" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Manpower Project</h4>
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
  <div class="modal fade" id="show_add_tools_reporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Tools</h4>
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
  <div class="modal fade" id="show_edit_tools_reporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Tools</h4>
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
  <div class="modal fade" id="show_delete_tools_reporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Tools</h4>
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
  <div class="modal fade" id="show_edit_jamKerja" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Jam Kerja</h4>
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
  <div class="modal fade" id="show_add_cuaca_project" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Cuaca</h4>
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
  <div class="modal fade" id="show_delete_cuacaproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Cuaca</h4>
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
  <div class="modal fade" id="get_datamanpower" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Get Data Manpower</h4>
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
  <div class="modal fade" id="clear_datamanpower" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Clear Data Manpower</h4>
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
  <div class="modal fade" id="show_edit_absensi_dailyreporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Absensi Manpower</h4>
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
  <div class="modal fade" id="show_add_toolsk3_reporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Tools K3</h4>
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
  <div class="modal fade" id="show_edit_toolsk3_reporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Tools K3</h4>
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
  <div class="modal fade" id="show_delete_toolsk3_reporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Tools K3</h4>
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
  <div class="modal fade" id="show_add_apd_reporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data APD</h4>
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
  <div class="modal fade" id="show_edit_apd_reporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data APD</h4>
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
  <div class="modal fade" id="show_delete_apd_reporthse" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data APD</h4>
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
  <div class="modal fade" id="show_edit_jamKerjaManpower" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Jam Kerja Manpower</h4>
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
  <div class="modal fade" id="show_add_isuk3" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Isu K3</h4>
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
  <div class="modal fade" id="show_edit_isuk3" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Isu K3</h4>
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
  <div class="modal fade" id="show_delete_isuk3" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Isu K3</h4>
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
  <div class="modal fade" id="show_add_dokumentasiproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Aktivitas</h4>
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
  <div class="modal fade" id="show_edit_dokumentasiproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Aktivitas</h4>
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
  <div class="modal fade" id="show_delete_dokumentasiproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Aktivitas</h4>
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
  <div class="modal fade" id="show_add_dailyreportnote" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Note / Kendala</h4>
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
  <div class="modal fade" id="show_edit_dailyreportnote" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Note / Kendala</h4>
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
  <div class="modal fade" id="show_delete_dailyreportnote" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Note / Kendala</h4>
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
  <div class="modal fade" id="report_complete" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Report Complete</h4>
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
  <div class="modal fade" id="project_hold" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Project Hold</h4>
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
  <div class="modal fade" id="project_libur" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Project Libur</h4>
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

<!-- ---------------------------- NEW FORM ADD APD, TOOLS, TOOLSK3, dll ------------------------------- -->

<!-- Modal -->
    <div class="modal fade" id="show_add_tools_reporthse_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tools</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dynamicForm" method="POST" action="">
                        <div id="dynamicInputContainer">
                          <div class="form-group row" style="margin-bottom: 8px; margin-top: -5px;">
                            <label class="col-8 col-form-label" style="font-size: 12px;"><center>Nama Tools</center></label>
                            <label class="col-3 col-form-label" style="font-size: 12px;"><center>Jumlah</center></label>
                            <label class="col-1 col-form-label" style="font-size: 12px;"><center>#</center></label>
                           </div>
                           <div class="form-group row" style="margin-bottom: 8px;">
                              <div class="col-8">
                                  <select class="form-control form-control-sm" name="tools_id[]" required>
                                      <option value="">---- Pilih Tools ----</option>
                                    <?php
                                      $q_getTools = mysqli_query($conn, "SELECT * FROM hse_tools WHERE hse_tools.id NOT IN (SELECT tools_id FROM hse_dailyreport_tools WHERE kd_report = '$kodeReport')");
                                      while($getTools = mysqli_fetch_array($q_getTools)){
                                    ?>
                                        <option value="<?php echo $getTools['id']; ?>"><?php echo $getTools['tools']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="col-3">
                                  <input type="number" class="form-control form-control-sm" name="jumlah[]" min="1" required>
                                </div>
                            </div>
                            <!-- Dinamic Inputs will be appended here -->
                        </div>
                        <hr>
                        <input type="hidden" name="kd_report" value="<?php echo $kodeReport; ?>">
                        <button type="button" class="btn btn-danger btn-sm" id="addInputButton">Tambah Data</button>
                        <input type="submit" class="btn btn-primary btn-sm" name="submit_add_tools_reporthse_new" value="Simpan">
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveButton">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let inputCount = 0;

            $('#addInputButton').on('click', function() {
                inputCount++;
                $('#dynamicInputContainer').append(`
                    <div class="form-group row" style="margin-bottom: 8px;">
                      <div class="col-8">
                          <select class="form-control form-control-sm" name="tools_id[]" required>
                              <option value="">---- Pilih Tools ----</option>
                            <?php
                              $q_getTools = mysqli_query($conn, "SELECT * FROM hse_tools WHERE hse_tools.id NOT IN (SELECT tools_id FROM hse_dailyreport_tools WHERE kd_report = '$kodeReport')");
                              while($getTools = mysqli_fetch_array($q_getTools)){
                            ?>
                                <option value="<?php echo $getTools['id']; ?>"><?php echo $getTools['tools']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-3">
                          <input type="number" class="form-control form-control-sm" name="jumlah[]" min="1" required>
                        </div>
                        <div class="col-1">
                          <a href="#"><span class="fa fa-close removeInputButton"></span></a>
                        </div>
                    </div>
                `);
            });

            $(document).on('click', '.removeInputButton', function() {
                $(this).closest('.form-group').remove();
            });
        });
    </script>


  <!-- Modal -->
    <div class="modal fade" id="show_add_toolsk3_reporthse_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tools K3</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dynamicForm" method="POST" action="">
                        <div id="dynamicInputContainer2">
                          <div class="form-group row" style="margin-bottom: 8px;">
                            <label class="col-8 col-form-label" style="font-size: 12px;"><center>Nama Tools K3</center></label>
                            <label class="col-3 col-form-label" style="font-size: 12px;"><center>Jumlah</center></label>
                            <label class="col-1 col-form-label" style="font-size: 12px;"><center>#</center></label>
                         </div>
                         <div class="form-group row" style="margin-bottom: 8px;">
                            <div class="col-8">
                              <select class="form-control form-control-sm" name="toolsk3_id[]" required>
                                  <option value="">---- Pilih Tools K3 ----</option>
                                <?php
                                  $q_getToolsk3 = mysqli_query($conn, "SELECT * FROM hse_toolsk3 WHERE hse_toolsk3.id NOT IN (SELECT toolsk3_id FROM hse_dailyreport_toolsk3 WHERE kd_report = '$kodeReport')");
                                  while($getToolsk3 = mysqli_fetch_array($q_getToolsk3)){
                                ?>
                                    <option value="<?php echo $getToolsk3['id']; ?>"><?php echo $getToolsk3['nama_tools']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="col-3">
                              <input type="number" class="form-control form-control-sm" name="jumlah[]" min="1" required>
                            </div>
                         </div>
                            <!-- Dinamic Inputs will be appended here -->
                        </div>
                        <hr>
                        <input type="hidden" name="kd_report" value="<?php echo $kodeReport; ?>">
                        <button type="button" class="btn btn-danger btn-sm" id="addInputButtonToolsK3">Tambah Data</button>
                        <input type="submit" class="btn btn-primary btn-sm" name="submit_add_toolsk3_reporthse_new" value="Simpan">
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveButton">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let inputCount = 0;

            $('#addInputButtonToolsK3').on('click', function() {
                inputCount++;
                $('#dynamicInputContainer2').append(`
                    <div class="form-group row" style="margin-bottom: 8px;">
                      <div class="col-8">
                        <select class="form-control form-control-sm" name="toolsk3_id[]" required>
                            <option value="">---- Pilih Tools K3 ----</option>
                          <?php
                            $q_getToolsk3 = mysqli_query($conn, "SELECT * FROM hse_toolsk3 WHERE hse_toolsk3.id NOT IN (SELECT toolsk3_id FROM hse_dailyreport_toolsk3 WHERE kd_report = '$kodeReport')");
                            while($getToolsk3 = mysqli_fetch_array($q_getToolsk3)){
                          ?>
                              <option value="<?php echo $getToolsk3['id']; ?>"><?php echo $getToolsk3['nama_tools']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-3">
                        <input type="number" class="form-control form-control-sm" name="jumlah[]" min="1" required>
                      </div>
                      <div class="col-1">
                        <a href="#"><span class="fa fa-close removeInputButton"></span></a>
                      </div>
                    </div>
                `);
            });

            $(document).on('click', '.removeInputButton', function() {
                $(this).closest('.form-group').remove();
            });
        });
    </script>



    <!-- Modal -->
    <div class="modal fade" id="show_add_apd_reporthse_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data APD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dynamicForm" method="POST" action="">
                        <div id="dynamicInputContainer3">
                          <div class="form-group row" style="margin-bottom: 8px;">
                            <label class="col-8 col-form-label" style="font-size: 12px;"><center>Nama APD</center></label>
                            <label class="col-3 col-form-label" style="font-size: 12px;"><center>Jumlah</center></label>
                            <label class="col-1 col-form-label" style="font-size: 12px;"><center>#</center></label>
                         </div>
                         <div class="form-group row" style="margin-bottom: 8px;">
                            <div class="col-8">
                              <select class="form-control form-control-sm" name="apd_id[]" required>
                                  <option value="">---- Pilih APD ----</option>
                                <?php
                                  $q_getAPD = mysqli_query($conn, "SELECT * FROM hse_apd WHERE hse_apd.id NOT IN (SELECT apd_id FROM hse_dailyreport_apd WHERE kd_report = '$kodeReport')");
                                  while($getAPD = mysqli_fetch_array($q_getAPD)){
                                ?>
                                    <option value="<?php echo $getAPD['id']; ?>"><?php echo $getAPD['nama_apd']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="col-3">
                              <input type="number" class="form-control form-control-sm" name="jumlah[]" min="1" required>
                            </div>
                         </div>
                            <!-- Dinamic Inputs will be appended here -->
                        </div>
                        <hr>
                        <input type="hidden" name="kd_report" value="<?php echo $kodeReport; ?>">
                        <button type="button" class="btn btn-danger btn-sm" id="addInputButtonAPD">Tambah Data</button>
                        <input type="submit" class="btn btn-primary btn-sm" name="submit_add_apd_reporthse_new" value="Simpan">
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveButton">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let inputCount = 0;

            $('#addInputButtonAPD').on('click', function() {
                inputCount++;
                $('#dynamicInputContainer3').append(`
                    <div class="form-group row" style="margin-bottom: 8px;">
                      <div class="col-8">
                        <select class="form-control form-control-sm" name="apd_id[]" required>
                            <option value="">---- Pilih APD ----</option>
                          <?php
                            $q_getAPD = mysqli_query($conn, "SELECT * FROM hse_apd WHERE hse_apd.id NOT IN (SELECT apd_id FROM hse_dailyreport_apd WHERE kd_report = '$kodeReport')");
                            while($getAPD = mysqli_fetch_array($q_getAPD)){
                          ?>
                              <option value="<?php echo $getAPD['id']; ?>"><?php echo $getAPD['nama_apd']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-3">
                        <input type="number" class="form-control form-control-sm" name="jumlah[]" min="1" required>
                      </div>
                      <div class="col-1">
                        <a href="#"><span class="fa fa-close removeInputButton"></span></a>
                      </div>
                    </div>
                `);
            });

            $(document).on('click', '.removeInputButton', function() {
                $(this).closest('.form-group').remove();
            });
        });
    </script>