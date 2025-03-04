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
          <div class="col-md-5 col-12">
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
          <div class="col-md-7 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-sm-left">Data Manpower Project</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_manpower_project' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Manpower">
                    <div class="btn btn-info btn-xs" style="font-size:11px;">
                      <span class="fa fa-pencil"></span> Tambah Manpower
                    </div>
                  </a>
                </div>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="" class="table table-head-fixed text-nowrap table-bordered table-striped table-sm" style="font-size: 12px;">
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
                      <div class="col-md-4 col-1"></div>
                      <div class="col-md-2 col-4">
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
                      <div class="col-md-1 col-4">
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
                      <th width="">Nama Project</th>
                      <th width="">Hari / Tanggal</th>
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
                            <span class="badge badge-success">Report Completed</span>
                          <?php }else{ ?>
                            <span class="badge badge-secondary">Belum ada data report</span>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($cek_KodeReport['status_report'] == ""){ ?>
                            <a href="index.php?pages=formdailyreporthse&kdproject=<?php echo $_GET['kd']; ?>&tgl=<?php echo $tgl_now; ?>"><span class="fa fa-pencil"></span> Buat Report</a>

                          <?php }elseif($cek_KodeReport['status_report'] == "completed" || $cek_KodeReport['status_report'] == "libur/tidak ada pekerjaan" || $cek_KodeReport['status_report'] == "hold"){ ?>
                            <a href="index.php?pages=dailyreporthse&kdproject=<?php echo $_GET['kd']; ?>&tgl=<?php echo $tgl_now; ?>"><span class="fa fa-file-text"></span> Lihat Report</a>
                            |
                            <a href="#modal" data-toggle='modal' data-target='#show_report_text' data-id='<?php echo $kodeReport; ?>' data-toggle="tooltip" data-placement="bottom" title="Lihat Text Report"><span class="fa fa-file-text-o"></span> Lihat Text</a>

                          <?php }else{ ?>
                            <a href="index.php?pages=formdailyreporthse&kdproject=<?php echo $_GET['kd']; ?>&tgl=<?php echo $tgl_now; ?>"><span class="fa fa-edit"></span> Edit Report</a>
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
                <h3 class="card-title float-sm-left">Tools & APD Onsite</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_onsite' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Manpower">
                    <div class="btn btn-info btn-xs" style="font-size:11px;">
                      <span class="fa fa-pencil"></span> Tambah Data
                    </div>
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
                          <?php if($get_list_toolsapdonsite['status'] == "progress"){ ?>
                            <a href="index.php?pages=form_toolsapdonsite_detail&kd=<?php echo $_GET['kd']; ?>&kdonsite=<?php echo $get_list_toolsapdonsite['id']; ?>">
                              <?php echo $get_list_toolsapdonsite['keterangan']; ?>
                            </a>
                          <?php }elseif($get_list_toolsapdonsite['status'] == "completed"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_report_toolsapdonsite' data-id='<?php echo $get_list_toolsapdonsite['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Manpower">
                              <?php echo $get_list_toolsapdonsite['keterangan']; ?>    
                            </a>
                          <?php } ?>
                        </td>
                        <td><?php echo date("d-m-Y", strtotime($get_list_toolsapdonsite['tgl_onsite'])); ?></td>
                        <td>
                          <?php if($get_list_toolsapdonsite['status'] == "progress"){ ?>
                            <span class="badge badge-warning">Progress</span>
                          <?php }elseif($get_list_toolsapdonsite['status'] == "completed"){ ?>
                            <span class="badge badge-success">Completed</span>
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
                    <div class="btn btn-info btn-xs" style="font-size:11px;">
                      <span class="fa fa-pencil"></span> Tambah Inspeksi
                    </div>
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
                        <td>1</td>
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
                                      <?php if($get_inspeksilist_apd['status'] == "progress"){ ?>
                                        <a href="index.php?pages=forminspeksiapd&kd=<?php echo $get_inspeksilist_apd['id']; ?>">Inspeksi APD</a>
                                      <?php }elseif($get_inspeksilist_apd['status'] == "completed"){ ?>
                                        <a href="#modal" data-toggle='modal' data-target='#show_report_inspeksiapd' data-id='<?php echo $get_inspeksilist_apd['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Report Inspeksi">Inspeksi APD</a>
                                      <?php } ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($get_inspeksilist_apd['tanggal_inspeksi'])); ?></td>
                                    <td>
                                      <?php if($get_inspeksilist_apd['status'] == "progress"){ ?>
                                        <div class="badge badge-warning">P</div>
                                      <?php }elseif($get_inspeksilist_apd['status'] == "completed"){ ?>
                                        <div class="badge badge-success">C</div>
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
                                          if($get_inspeksilist_toolsk3['status'] == "progress"){
                                            echo "<a href='index.php?pages=forminspeksiapar&kd=".$get_inspeksilist_toolsk3['id']."'>Inspeksi APAR</a>";
                                          }elseif($get_inspeksilist_toolsk3['status'] == "completed"){
                                            echo "<a href='index.php?pages=reportinspeksiapar&kd=".$get_inspeksilist_toolsk3['id']."'>Inspeksi APAR</a>";
                                          }
                                          
                                        }elseif($get_inspeksilist_toolsk3['jenis_inspeksi'] == 'inspeksi_p3k'){
                                          if($get_inspeksilist_toolsk3['status'] == "progress"){
                                            echo "<a href='index.php?pages=forminspeksip3k&kd=".$get_inspeksilist_toolsk3['id']."'>Inspeksi P3K</a>";
                                          }elseif($get_inspeksilist_toolsk3['status'] == "completed"){
                                            echo "<a href='index.php?pages=reportinspeksip3k&kd=".$get_inspeksilist_toolsk3['id']."'>Inspeksi P3K</a>";
                                          }
                                        }
                                      ?>
                                    </td>
                                    <td><?php echo date('d-m-Y', strtotime($get_inspeksilist_toolsk3['tanggal_inspeksi'])); ?></td>
                                    <td>
                                      <?php if($get_inspeksilist_toolsk3['status'] == "progress"){ ?>
                                        <div class="badge badge-warning">P</div>
                                      <?php }elseif($get_inspeksilist_toolsk3['status'] == "completed"){ ?>
                                        <div class="badge badge-success">C</div>
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
                                          echo "Inspeksi Gerinda";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_mesinlas'){
                                          echo "Inspeksi Mesin Las";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_borlistrik'){
                                          echo "Inspeksi Bor Listrik";
                                        }elseif($get_inspeksilist_tools['jenis_inspeksi'] == 'inspeksi_bordc'){
                                          echo "Inspeksi Bor DC";
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
                                        <div class="badge badge-success">C</div>
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
  </div>
  <!-- /.content-wrapper -->

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>

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
  <div class="modal fade" id="show_report_text" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Text Report</h4>
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
  <div class="modal fade" id="show_add_data_onsite" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Onsite</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" method="POST" action="" enctype="multipart/form-data">
            <div class="modal-data"></div>
            <input id="submitBtn" type="submit" class="btn btn-primary btn-sm" name="submit_add_toolsapd_onsite" value="Simpan">
          </form>
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
  <div class="modal fade" id="show_open_form_inspeksi" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Inspeksi Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm2" action="" method="POST">
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-4 col-form-label" style="font-size: 12px;">Jenis Inspeksi</label>
              <div class="col-8">
                <select class="form-control form-control-sm" name="jenis_inspeksi" required>
                    <option value="" selected disabled>---- Jenis Inspeksi ----</option>
                    <option value="inspeksi_apd">Inspeksi APD</option>
                    <option value="inspeksi_apar">Inspeksi APAR</option>
                    <option value="inspeksi_p3k">Inspeksi P3K</option>
                    <option value="inspeksi_gerinda" disabled>Inspeksi Gerinda</option>
                    <option value="inspeksi_mesinlas" disabled>Inspeksi Mesin Las</option>
                    <option value="inspeksi_borlistrik" disabled>Inspeksi Bor Listrik</option>
                    <option value="inspeksi_borac" disabled>Inspeksi Bor DC</option>
                    <option value="inspeksi_borduduk" disabled>Inspeksi Bor Duduk</option>
                    <option value="inspeksi_cuttingwheel" disabled>Inspeksi Cutting Wheel</option>
                    <option value="inspeksi_amperemeter" disabled>Inspeksi Ampere Meter</option>
                    <option value="inspeksi_meger" disabled>Inspeksi Meger</option>
                    <option value="inspeksi_forklift" disabled>Inspeksi Forklift</option>
                    <option value="inspeksi_scissorlift" disabled>Inspeksi Scissor Lift</option>
                    <option value="inspeksi_boomlift" disabled>Inspeksi Boom Lift</option>
                    <option value="inspeksi_crane" disabled>Inspeksi Crane</option>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-4 col-form-label" style="font-size: 12px;">Week</label>
              <div class="col-5">
                <select class="form-control form-control-sm" name="kd_weekly" required>
                    <option value="" selected disabled>Pilih Week</option>
                    <?php
                      $q_get_weekly = mysqli_query($conn, "SELECT * FROM hse_weeklyreport WHERE project_id = '$_GET[kd]' ORDER BY week ASC");
                      while($get_weekly = mysqli_fetch_array($q_get_weekly)){
                    ?>
                      <option value="<?php echo $get_weekly['kd_weekly']; ?>">Week <?php echo $get_weekly['week']; ?></option>
                    <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 25px;">
              <label class="col-4 col-form-label" style="font-size: 12px;">Tanggal Inspeksi</label>
              <div class="col-5">
                <input type="date" class="form-control form-control-sm" name="tgl_inspeksi" required>
              </div>
            </div>
            <input type="submit" name="open_form_inspeksi" class="btn btn-info btn-sm" value="Tambah Inspeksi">
          </form>
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