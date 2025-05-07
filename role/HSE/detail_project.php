<?php
  setlocale(LC_TIME, 'id_ID');
  $get_Project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$_GET[kd]'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_Project[hse_officer]'"));
  $jml_dataspk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inductionreport JOIN hse_inductionreport_spk ON hse_inductionreport.id = hse_inductionreport_spk.induction_id WHERE hse_inductionreport.project_id = '$_GET[kd]'"));
  $get_data_spk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport_spk JOIN hse_inductionreport ON hse_inductionreport.id = hse_inductionreport_spk.induction_id WHERE hse_inductionreport.project_id = '$_GET[kd]'"));

  $bulan = date("m");
  $tahun = date("Y");

  if(isset($_GET['bulan'])){
    $bulan = $_GET['bulan'];
  }

  if(isset($_GET['tahun'])){
    $tahun = $_GET['tahun'];
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Data Project</li>
              <li class="breadcrumb-item active">Detail Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-5 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm" style="font-size: 12px;">
                  <tbody>
                    <tr>
                      <td width="35%"><b>Nama Project</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_Project['nama_project']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Lokasi / Kota</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_Project['kota']; ?></td>
                    </tr>
                    <tr>
                      <td><b>HSE Officer</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_hseOfficer['nama']; ?></td>
                    </tr>
                    <tr>
                      <td><b>HSE Officer</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_hseOfficer['nama']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Tanggal Start</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_Project['tgl_start']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Tanggal End</b></td>
                      <td width="1%">:</td>
                      <td><?php echo $get_Project['tgl_end']; ?></td>
                    </tr>
                    <tr>
                      <td><b>Status Project</b></td>
                      <td width="1%">:</td>
                      <td>
                        <?php if($get_Project['status_project'] == "ongoing"){ ?>
                          <span class="badge badge-success">Ongoing</span>
                        <?php }elseif($get_Project['status_project'] == "hold"){ ?>
                          <span class="badge badge-warning">Hold</span>
                        <?php }elseif($get_Project['status_project'] == "closed"){ ?>
                          <span class="badge badge-danger">Closed</span>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Jam Kerja</b></td>
                      <td width="1%">:</td>
                      <td>
                        <?php echo date("H:i", strtotime($get_Project['jam_masuk'])); ?> s/d <?php echo date("H:i", strtotime($get_Project['jam_pulang'])); ?>
                        <a href="#modal" data-toggle='modal' data-target='#show_edit_jamKerja' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="edit jam kerja" style="font-size: 14px;"><span class="fa fa-edit"></span></a>
                      </td>
                    </tr>
                    <tr>
                      <td><b>Data SPK</b></td>
                      <td width="1%">:</td>
                      <td>
                        <a href="#modal" data-toggle='modal' data-target='#show_data_spk' data-id='<?php echo $get_data_spk['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Project Baru">
                          <?php echo $jml_dataspk." Data SPK"; ?></a>
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
          <div class="col-lg-7 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-sm-left" style="font-size: 12px;">Data Manpower Project</h3>
                <h3 class="card-title float-sm-right" style="font-size: 10px; float: right;">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_manpower_project' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Project Baru">
                    <span class="fa fa-plus"></span> Tambah Manpower
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="example5_2" class="table table-head-fixed text-nowrap table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Manpower</th>
                      <th width="">Jabatan</th>
                      <th width="7%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_getManpowerProject = mysqli_query($conn, "SELECT * FROM hse_manpower_project WHERE project_id = '$_GET[kd]'");
                      while($get_ManpowerProject = mysqli_fetch_array($q_getManpowerProject)){
                        $getManpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_ManpowerProject[manpower_id]'"));
                        $getJabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_jabatan WHERE id = '$get_ManpowerProject[jabatan_id]'"));
                        $no++;
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $getManpower['nama']; ?></td>
                        <td><?php echo $getJabatan['jabatan']; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_manpowerproject' data-id='<?php echo $get_ManpowerProject['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_manpowerproject' data-id='<?php echo $get_ManpowerProject['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
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
                <h3 class="card-title float-sm-left">Daily Report HSE</h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <div class="card-body" style="margin-top: -10px">
                  <form method="GET" action="">
                    <div class="row">
                      <div class="col-1"></div>
                      <div class="col-5">
                        <select class="form-control form-control-sm" name="bulan">
                          <option value="01" <?php if($bulan == '01'){ echo "selected"; } ?>>Januari</option>
                          <option value="02" <?php if($bulan == '02'){ echo "selected"; } ?>>Februari</option>
                          <option value="03" <?php if($bulan == '03'){ echo "selected"; } ?>>Maret</option>
                          <option value="04" <?php if($bulan == '04'){ echo "selected"; } ?>>April</option>
                          <option value="05" <?php if($bulan == '05'){ echo "selected"; } ?>>Mei</option>
                          <option value="06" <?php if($bulan == '06'){ echo "selected"; } ?>>Juni</option>
                          <option value="07" <?php if($bulan == '07'){ echo "selected"; } ?>>Juli</option>
                          <option value="08" <?php if($bulan == '08'){ echo "selected"; } ?>>Agustus</option>
                          <option value="09" <?php if($bulan == '09'){ echo "selected"; } ?>>September</option>
                          <option value="10" <?php if($bulan == '10'){ echo "selected"; } ?>>Oktober</option>
                          <option value="11" <?php if($bulan == '11'){ echo "selected"; } ?>>November</option>
                          <option value="12" <?php if($bulan == '12'){ echo "selected"; } ?>>Desember</option>
                        </select>
                      </div>
                      <div class="col-4">
                        <select class="form-control form-control-sm" name="tahun">
                          <option value="2024" <?php if($tahun == '2024'){ echo "selected"; } ?>>2024</option>
                          <option value="2025" <?php if($tahun == '2025'){ echo "selected"; } ?>>2025</option>
                          <option value="2026" <?php if($tahun == '2026'){ echo "selected"; } ?>>2026</option>
                          <option value="2027" <?php if($tahun == '2027'){ echo "selected"; } ?>>2027</option>
                          <option value="2028" <?php if($tahun == '2028'){ echo "selected"; } ?>>2028</option>
                        </select>
                      </div>
                      <div class="col-2">
                        <input type="hidden" name="pages" value="<?php echo $_GET['pages'] ?>">
                        <input type="hidden" name="kd" value="<?php echo $_GET['kd'] ?>">
                        <input type="submit" class="btn btn-primary btn-sm" value="Show">
                      </div>
                    </div>
                  </form>
                </div>
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="30%">Nama Project</th>
                      <th width="20%">Hari / Tanggal</th>
                      <th width="">Status </th>
                      <th width="18%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $tgl_awal = "1-".$bulan."-".$tahun;
                      $pengulangan = date("t", strtotime($tgl_awal));
                      for($i=1;$i<=$pengulangan;$i++){
                        $tgl_now = $i."-".$bulan."-".$tahun;
                    ?>
                      <tr>
                        <td><?php echo $get_Project['nama_project']; ?></td>
                        <td><?php echo $tanggal_lengkap = strftime("%A, %d %B %Y", strtotime($tgl_now)); ?></td>
                        <td>
                          <?php
                            $kodeReport = $_GET['kd']."/".$tgl_now;
                            $cek_KodeReport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$kodeReport'"));
                         
                            if($cek_KodeReport['status_report'] == "onprogress"){ ?>
                              <span class="badge badge-warning">Report On Progress</span>
                            <?php }elseif($cek_KodeReport['status_report'] == "libur/tidak ada pekerjaan"){ ?>
                              <span class="badge badge-info">Libur / Tidak Ada Pekerjaan</span>
                            <?php }elseif($cek_KodeReport['status_report'] == "hold"){ ?>
                              <span class="badge badge-danger">Project Hold</span>
                            <?php }elseif($cek_KodeReport['status_report'] == "completed"){ ?>
                              <a href="#modal" data-toggle='modal' data-target='#show_ubah_statusreport' data-id='<?php echo $get_Project['id']."/".$tgl_now; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Status Report">
                                <span class="badge badge-success">Report Completed</span>
                              </a>
                            <?php }else{ ?>
                              <span class="badge badge-secondary">Belum ada data report</span>
                            <?php } ?>
                        </td>
                        <td>
                          <?php if($cek_KodeReport['status_report'] == ""){ ?>
                            <a href="index.php?pages=formdailyreporthse&kdproject=<?php echo $_GET['kd']; ?>&tgl=<?php echo $tgl_now; ?>"><span class="fa fa-pencil"></span> Buat Report</a>

                          <?php }elseif($cek_KodeReport['status_report'] == "completed" || $cek_KodeReport['status_report'] == "libur/tidak ada pekerjaan" || $cek_KodeReport['status_report'] == "hold"){ ?>
                            <a href="index.php?pages=dailyreporthse&kdproject=<?php echo $_GET['kd']; ?>&tgl=<?php echo $tgl_now; ?>"><span class="fa fa-file-text-o"></span> Lihat Report</a>
                            |
                            <a href="#modal" data-toggle='modal' data-target='#show_delete_report' data-id='<?php echo $get_Project['id']."/".$tgl_now; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Report"><span class="fa fa-trash"></span> Delete Report</a>

                          <?php }else{ ?>
                            <a href="index.php?pages=formdailyreporthse&kdproject=<?php echo $_GET['kd']; ?>&tgl=<?php echo $tgl_now; ?>"><span class="fa fa-edit"></span> Edit Report</a>
                            |
                            <a href="#modal" data-toggle='modal' data-target='#show_delete_report' data-id='<?php echo $get_Project['id']."/".$tgl_now; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Report"><span class="fa fa-trash"></span> Delete Report</a>
                          <?php } ?>
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
                <h3 class="card-title float-sm-left">Weekly Report HSE</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_weeklyreport' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Generate Weekly Report Baru">
                    <div class="btn btn-info btn-xs" style="font-size:11px;">
                      <span class="fa fa-pencil"></span> Tambah Week
                    </div>
                  </a>
                </div>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="30%">Nama Project</th>
                      <th width="8%">Week</th>
                      <th width="15%">Tanggal</th>
                      <th width="">Status Data</th>
                      <th width="8%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $q_get_weeklyreport = mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE project_id = $get_Project[id] ORDER BY week ASC");
                      while($get_weeklyreport = mysqli_fetch_array($q_get_weeklyreport)){
                    ?>
                      <tr>
                        <td><?php echo $get_Project['nama_project']; ?></td>
                        <td>Week <?php echo $get_weeklyreport['week']; ?></td>
                        <td>
                          <?php echo date("d-m-Y", strtotime($get_weeklyreport['tgl_awal'])); ?>
                          <small>s/d</small>
                          <?php echo date("d-m-Y", strtotime($get_weeklyreport['tgl_akhir'])); ?>
                        </td>
                        <td>
                          <?php
                            $jml_data_daily = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE project_id = '$get_Project[id]' AND status_report <> 'onprogress' AND tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]'"));
                            
                            $jml_daily_masuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE project_id = '$get_Project[id]' AND status_report = 'completed' AND tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]'"));

                            $jml_daily_libur = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE project_id = '$get_Project[id]' AND status_report = 'libur/tidak ada pekerjaan' AND tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]'"));

                            $jml_daily_hold = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE project_id = '$get_Project[id]' AND status_report = 'hold' AND tgl_report BETWEEN '$get_weeklyreport[tgl_awal]' AND '$get_weeklyreport[tgl_akhir]'"));

                            $selisih_tgl = strtotime($get_weeklyreport['tgl_akhir']) - strtotime($get_weeklyreport['tgl_awal']);
                            $jml_hari = ($selisih_tgl / 60 / 60 / 24) + 1;

                            if($jml_data_daily == $jml_hari){
                          ?>
                            <div class="color-palette-set">
                              <div class="bg-success color-palette"><?php echo $jml_data_daily; ?> data dari <?php echo $jml_hari; ?> hari (<?php echo $jml_daily_masuk; ?> hari masuk, <?php echo $jml_daily_libur; ?> hari libur, <?php echo $jml_daily_hold; ?> hari hold)</div>
                            </div>
                          <?php }elseif($jml_data_daily > 0){ ?>
                            <div class="color-palette-set">
                              <div class="bg-warning color-palette"><?php echo $jml_data_daily; ?> data dari <?php echo $jml_hari; ?> hari (<?php echo $jml_daily_masuk; ?> hari masuk, <?php echo $jml_daily_libur; ?> hari libur, <?php echo $jml_daily_hold; ?> hari hold)</div>
                            </div>
                          <?php }else{ ?>
                            <div class="color-palette-set">
                              <div class="bg-secondary color-palette">Belum ada data dailyreport di pekan ini</div>
                            </div>
                          <?php } ?>
                        </td>
                        <td style="font-size: 14px;">
                          <a href="index.php?pages=weeklyreport&kdweekly=<?php echo $get_weeklyreport['kd_weekly']; ?>" title="Lihat Weekly Report">
                            <span class="fa fa-file-text-o"></span>
                          </a>
                          |
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_weeklyreport' data-id='<?php echo $get_weeklyreport['kd_weekly']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Weekly Report">
                            <span class="fa fa-edit"></span>
                          </a>
                          |
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_weeklyreport' data-id='<?php echo $get_weeklyreport['kd_weekly']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Weekly Report">
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
                <h3 class="card-title float-sm-left">Tools & APD Onsite</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_onsite' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Manpower">
                  </a>
                </div>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Keterangan</th>
                      <th width="">Tanggal</th>
                      <th width="18%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_list_toolsapdonsite = mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite WHERE project_id = '$_GET[kd]'");
                      while($get_list_toolsapdonsite = mysqli_fetch_array($q_list_toolsapdonsite)){
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_report_toolsapdonsite' data-id='<?php echo $get_list_toolsapdonsite['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="">
                              <?php echo $get_list_toolsapdonsite['keterangan']; ?>
                          </a>
                        </td>
                        <td><?php echo date("d-m-Y", strtotime($get_list_toolsapdonsite['tgl_onsite'])); ?></td>
                        <td>
                          <?php if($get_list_toolsapdonsite['status'] == "progress"){ ?>
                            <span class="badge badge-warning">Progress</span>
                          <?php }elseif($get_list_toolsapdonsite['status'] == "completed"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_ubahstatus_onsite' data-id='<?php echo $get_list_toolsapdonsite['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Ubah Status">
                              <span class="badge badge-success">Completed</span>
                            </a>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php $no++; } ?>
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
                <h3 class="card-title float-sm-left">Inspeksi</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_open_form_inspeksi' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Inspeksi">
                  </a>
                </div>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Week</th>
                      <th width="">Tgl Awal</th>
                      <th width="">Tgl Akhir</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $noo=1;
                    $q_get_weekly = mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE project_id = '$_GET[kd]' ORDER BY week ASC");
                    while($get_weekly = mysqli_fetch_array($q_get_weekly)){
                      $cek_datainspeksi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$get_weekly[kd_weekly]'"));

                      $q_get_inspeksilist_apd = mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$get_weekly[kd_weekly]' AND jenis_inspeksi = 'inspeksi_apd'");
                      $cek_inspeksiapd = mysqli_num_rows($q_get_inspeksilist_apd);

                      $q_get_inspeksilist_toolsk3 = mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$get_weekly[kd_weekly]' AND (jenis_inspeksi = 'inspeksi_p3k' OR jenis_inspeksi = 'inspeksi_apar')");
                      $cek_inspeksitoolsk3 = mysqli_num_rows($q_get_inspeksilist_toolsk3);

                      $q_get_inspeksilist_tools = mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$get_weekly[kd_weekly]' AND (jenis_inspeksi = 'inspeksi_gerinda' OR jenis_inspeksi = 'inspeksi_mesinlas' OR jenis_inspeksi = 'inspeksi_borlistrik' OR jenis_inspeksi = 'inspeksi_bordc' OR jenis_inspeksi = 'inspeksi_borduduk' OR jenis_inspeksi = 'inspeksi_cuttingwheel' OR jenis_inspeksi = 'inspeksi_amperemeter' OR jenis_inspeksi = 'inspeksi_megger')");
                      $cek_inspeksitools = mysqli_num_rows($q_get_inspeksilist_tools);

                      $q_get_inspeksilist_alatberat = mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$get_weekly[kd_weekly]' AND (jenis_inspeksi = 'inspeksi_forklift' OR jenis_inspeksi = 'inspeksi_scissorlift' OR jenis_inspeksi = 'inspeksi_boomlift' OR jenis_inspeksi = 'inspeksi_crane')");
                      $cek_inspeksialatberat = mysqli_num_rows($q_get_inspeksilist_alatberat);
                    ?>
                      <tr data-widget="expandable-table" aria-expanded="false">
                        <td><?php echo $noo; ?></td>
                        <td><b><?php echo "Week ".$get_weekly['week']; ?></b></td>
                        <td><?php echo date("d-m-Y", strtotime($get_weekly['tgl_awal'])); ?></td>
                        <td><?php echo date("d-m-Y", strtotime($get_weekly['tgl_akhir'])); ?></td>
                      </tr>
                      <tr class="expandable-body">
                        <td colspan="4">
                          <div>
                            <?php if($cek_datainspeksi > 0){ ?>
                              <table style="background-color: #d9d9d9;">
                                <tr>
                                  <th width="1%">No</th>
                                  <th width="">Jenis Inspeksi</th>
                                  <th width="30%">Tgl Inspeksi</th>
                                  <th width="1%">#</th>
                                </tr>

                              <!-- --------- Inspeksi APD ------------------ -->
                                <?php if($cek_inspeksiapd > 0){ ?>
                                  <tr>
                                    <td colspan="3"><b>Inspeksi APD</b></td>
                                  </tr>
                                <?php
                                  $no=1;
                                  while($get_inspeksilist_apd = mysqli_fetch_array($q_get_inspeksilist_apd)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                      <a href="#modal" data-toggle='modal' data-target='#show_report_inspeksiapd' data-id='<?php echo $get_inspeksilist_apd['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Report Inspeksi">Inspeksi APD</a>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($get_inspeksilist_apd['tanggal_inspeksi'])); ?></td>
                                    <td>
                                      <?php if($get_inspeksilist_apd['status'] == "progress"){ ?>
                                        <div class="badge badge-warning">P</div>
                                      <?php }elseif($get_inspeksilist_apd['status'] == "completed"){ ?>
                                        <a href="#modal" data-toggle='modal' data-target='#show_inspeksi_to_progress' data-id='<?php echo $get_inspeksilist_apd['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="To Progress">
                                          <div class="badge badge-success">C</div>
                                        </a>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php $no++; }} ?>

                              <!-- --------- Inspeksi Tools K3 ------------------ -->
                                <?php if($cek_inspeksitoolsk3 > 0){ ?>
                                  <tr>
                                    <td colspan="3"><b>Inspeksi Tools K3</b></td>
                                  </tr>
                                <?php
                                  $no=1;
                                  while($get_inspeksilist_toolsk3 = mysqli_fetch_array($q_get_inspeksilist_toolsk3)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                      <?php
                                        if($get_inspeksilist_toolsk3['jenis_inspeksi'] == 'inspeksi_apar'){
                                      ?>
                                          <a href="#modal" data-toggle='modal' data-target='#show_report_inspeksiapar' data-id='<?php echo $get_inspeksilist_toolsk3['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Report Inspeksi">Inspeksi APAR</a>
                                      <?php
                                        }elseif($get_inspeksilist_toolsk3['jenis_inspeksi'] == 'inspeksi_p3k'){
                                          echo "<a href='index.php?pages=reportinspeksip3k&kd=".$get_inspeksilist_toolsk3['id']."'>Inspeksi P3K</a>";
                                        }
                                      ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($get_inspeksilist_toolsk3['tanggal_inspeksi'])); ?></td>
                                    <td>
                                      <?php if($get_inspeksilist_toolsk3['status'] == "progress"){ ?>
                                        <div class="badge badge-warning">P</div>
                                      <?php }elseif($get_inspeksilist_toolsk3['status'] == "completed"){ ?>
                                        <a href="#modal" data-toggle='modal' data-target='#show_inspeksi_to_progress' data-id='<?php echo $get_inspeksilist_toolsk3['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="To Progress">
                                          <div class="badge badge-success">C</div>
                                        </a>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php $no++; }} ?>

                              <!-- --------- Inspeksi Tools ------------------ -->
                                <?php if($cek_inspeksitools > 0){ ?>
                                  <tr>
                                    <td colspan="3"><b>Inspeksi Tools</b></td>
                                  </tr>
                                <?php
                                  $no=1;
                                  while($get_inspeksilist_tools = mysqli_fetch_array($q_get_inspeksilist_tools)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                      <?php
                                        if($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_gerinda'){
                                          echo "<a href='index.php?pages=reportinspeksi&kd=".$get_inspeksilist_tools['id']."'>Inspeksi Gerinda AC</a>";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_gerindadc'){
                                          echo "<a href='index.php?pages=reportinspeksi&kd=".$get_inspeksilist_tools['id']."'>Inspeksi Gerinda DC</a>";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_mesinlas'){
                                          echo "<a href='index.php?pages=reportinspeksi&kd=".$get_inspeksilist_tools['id']."'>Inspeksi Mesin Las</a>";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_borac'){
                                          echo "<a href='index.php?pages=reportinspeksi&kd=".$get_inspeksilist_tools['id']."'>Inspeksi Bor AC</a>";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_bordc'){
                                          echo "<a href='index.php?pages=reportinspeksi&kd=".$get_inspeksilist_tools['id']."'>Inspeksi Bor DC</a>";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_borduduk'){
                                          echo "Inspeksi Bor Duduk";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_cuttingwheel'){
                                          echo "Inspeksi Cutting Wheel";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_amperemeter'){
                                          echo "Inspeksi Ampere Meter";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_megger'){
                                          echo "Inspeksi Megger";
                                        }
                                      ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($get_inspeksilist_tools['tanggal_inspeksi'])); ?></td>
                                    <td>
                                      <?php if($get_inspeksilist_tools['status'] == "progress"){ ?>
                                        <div class="badge badge-warning">P</div>
                                      <?php }elseif($get_inspeksilist_tools['status'] == "completed"){ ?>
                                        <a href="#modal" data-toggle='modal' data-target='#show_inspeksi_to_progress' data-id='<?php echo $get_inspeksilist_tools['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="To Progress">
                                          <div class="badge badge-success">C</div>
                                        </a>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php $no++; }} ?>

                              <!-- --------- Inspeksi Alat Berat ------------------ -->
                                <?php if($cek_inspeksialatberat > 0){ ?>
                                  <tr>
                                    <td colspan="3"><b>Inspeksi Alat Berat</b></td>
                                  </tr>
                                <?php
                                  $no=1;
                                  while($get_inspeksilist_alatberat = mysqli_fetch_array($q_get_inspeksilist_alatberat)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                      <?php
                                        if($get_inspeksilist_alatberat['jenis_inspeksi'] == 'inspeksi_gerinda'){
                                          echo "Inspeksi Gerinda";
                                        }elseif($get_inspeksilist_alatberat['jenis_inspeksi'] == 'inspeksi_forklift'){
                                          echo "Inspeksi Fork Lift";
                                        }elseif($get_inspeksilist_alatberat['jenis_inspeksi'] == 'inspeksi_scissorlift'){
                                          echo "Inspeksi Scissor Lift";
                                        }elseif($get_inspeksilist_alatberat['jenis_inspeksi'] == 'inspeksi_boomlift'){
                                          echo "Inspeksi Boom Lift";
                                        }elseif($get_inspeksilist_alatberat['jenis_inspeksi'] == 'inspeksi_crane'){
                                          echo "Inspeksi Crane";
                                        }
                                      ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($get_inspeksilist_alatberat['tanggal_inspeksi'])); ?></td>
                                    <td>
                                      <?php if($get_inspeksilist_alatberat['status'] == "progress"){ ?>
                                        <div class="badge badge-warning">P</div>
                                      <?php }elseif($get_inspeksilist_alatberat['status'] == "completed"){ ?>
                                        <div class="badge badge-success">C</div>
                                      <?php } ?>
                                    </td>
                                  </tr>
                                <?php $no++; }} ?>
                              </table>
                            <?php }else{ echo "<center><i>Belum ada data inspeksi pekan ini.</i></center>";} ?>
                          </div>
                        </td>
                      </tr>
                    <?php $noo++; } ?>
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
  <div class="modal fade" id="show_edit_manpowerproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Manpower Project</h4>
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
  <div class="modal fade" id="show_delete_manpowerproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Manpower Project</h4>
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
  <div class="modal fade" id="show_delete_report" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Report</h4>
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
  <div class="modal fade" id="show_add_weeklyreport" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i>Generate</i> Weekly Report</h4>
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
  <div class="modal fade" id="show_edit_weeklyreport" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Weekly Report</h4>
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
  <div class="modal fade" id="show_delete_weeklyreport" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Weekly Report</h4>
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
  <div class="modal fade" id="show_ubah_statusreport" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Status Report</h4>
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
  <div class="modal fade" id="show_data_spk" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Data SPK</h4>
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
  <div class="modal fade" id="show_report_toolsapdonsite" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Data Tools & APD Onsite</h4>
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
  <div class="modal fade" id="show_report_inspeksiapd" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Data Inspeksi APD</h4>
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
  <div class="modal fade" id="show_report_inspeksiapar" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Data Inspeksi APAR</h4>
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
  <div class="modal fade" id="show_ubahstatus_onsite" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Status Onsite</h4>
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
  <div class="modal fade" id="show_inspeksi_to_progress" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Status Inspeksi</h4>
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