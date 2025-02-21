<?php
  if(isset($_POST['submit_add_projectcardList'])){
    if($_POST['submit_add_projectcardList'] == "Simpan"){
      if($_POST['pm'] == "NULL"){
        $push_projectcardList = mysqli_query($conn, "INSERT INTO projectcard_list VALUES('','$_POST[kd_project]',NULL,'$_POST[sm]','$_POST[actual_start]','','','','','progress')");
      }elseif($_POST['sm'] == "NULL"){
        $push_projectcardList = mysqli_query($conn, "INSERT INTO projectcard_list VALUES('','$_POST[kd_project]','$_POST[pm]',NULL,'$_POST[actual_start]','','','','','progress')");
      }elseif($_POST['pm'] == "NULL" && $_POST['sm'] == "NULL"){
        $push_projectcardList = mysqli_query($conn, "INSERT INTO projectcard_list VALUES('','$_POST[kd_project]',NULL,NULL,'$_POST[actual_start]','','','','','progress')");
      }else{
        $push_projectcardList = mysqli_query($conn, "INSERT INTO projectcard_list VALUES('','$_POST[kd_project]','$_POST[pm]','$_POST[sm]','$_POST[actual_start]','','','','','progress')");
      }

      if($push_projectcardList){
        $_SESSION['alert_success'] = "Berhasil! Project berhasil ditambahkan ke Project Card";
      }else{
        $_SESSION['alert_error'] = "Gagal! Project gagal ditambahkan ke Project Card";
      }
    }
  }

  if(isset($_POST['submit_update_projectcard'])){
    if($_POST['submit_update_projectcard'] == "Update"){
      $update_projectcardList = mysqli_query($conn, "UPDATE projectcard_list SET tgl_update = '$_POST[tanggal_update]', update_plan = '$_POST[update_plan]', update_progress = '$_POST[update_progress]' WHERE kd_project = '$_POST[kd_project]'");

      if($update_projectcardList){
        $_SESSION['alert_success'] = "Berhasil! Progress Project Berhasil Diupdate";
      }else{
        $_SESSION['alert_error'] = "Gagal! Progress Project Gagal Diupdate";
      }
    }
  }

  if(isset($_POST['submit_edit_projectcard'])){
    if($_POST['submit_edit_projectcard'] == "Simpan"){
      if($_POST['pm'] == "NULL"){
        $edit_projectcardList = mysqli_query($conn, "UPDATE projectcard_list SET pm = NULL, sm = '$_POST[sm]', actual_start = '$_POST[actual_start]', actual_end = '$_POST[actual_end]' WHERE kd_project = '$_POST[kd_project]'");
      }elseif($_POST['sm'] == "NULL"){
        $edit_projectcardList = mysqli_query($conn, "UPDATE projectcard_list SET pm = '$_POST[pm]', sm = NULL, actual_start = '$_POST[actual_start]', actual_end = '$_POST[actual_end]' WHERE kd_project = '$_POST[kd_project]'");
      }elseif($_POST['pm'] == "NULL" && $_POST['sm'] == "NULL"){
        $edit_projectcardList = mysqli_query($conn, "UPDATE projectcard_list SET pm = NULL, sm = NULL, actual_start = '$_POST[actual_start]', actual_end = '$_POST[actual_end]' WHERE kd_project = '$_POST[kd_project]'");
      }else{
        $edit_projectcardList = mysqli_query($conn, "UPDATE projectcard_list SET pm = '$_POST[pm]', sm = '$_POST[sm]', actual_start = '$_POST[actual_start]', actual_end = '$_POST[actual_end]' WHERE kd_project = '$_POST[kd_project]'");
      }
      
      if($edit_projectcardList){
        $_SESSION['alert_success'] = "Berhasil! Project Card Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Project Card Gagal Diubah";
      }
    }
  }

  if(isset($_POST['projectcard_done'])){
    if($_POST['projectcard_done'] == "Project Done"){
      $projectcard_done = mysqli_query($conn, "UPDATE projectcard_list SET status = 'done' WHERE kd_project = '$_POST[kd_project]'");

      if($projectcard_done){
        $_SESSION['alert_success'] = "Berhasil! Project ".$_POST['kd_project']." Berhasil diselesaikan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Project ".$_POST['kd_project']." Gagal diselesaikan!";
      }
    }
  }

  if(isset($_POST['projectcard_delete'])){
    if($_POST['projectcard_delete'] == "Delete Project"){
      $projectcard_delete = mysqli_query($conn, "DELETE FROM projectcard_list WHERE kd_project = '$_POST[kd_project]'");

      if($projectcard_delete){
        $_SESSION['alert_success'] = "Berhasil! Project ".$_POST['kd_project']." Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Project ".$_POST['kd_project']." Gagal dihapus!";
      }
    }
  }

  if(isset($_POST['projectcard_to_progress'])){
    if($_POST['projectcard_to_progress'] == "To Progress"){
      $projectcard_to_progress = mysqli_query($conn, "UPDATE projectcard_list SET status = 'progress' WHERE kd_project = '$_POST[kd_project]'");

      if($projectcard_to_progress){
        $_SESSION['alert_success'] = "Berhasil! Project ".$_POST['kd_project']." Berhasil dikembalikan ke progress";
      }else{
        $_SESSION['alert_error'] = "Gagal! Project ".$_POST['kd_project']." Gagal dikembalikan ke progress!";
      }
    }
  }

?>


<style>
  .progress-bar-container {
      width: 100%;
      background-color: #707070;
      border-radius: 0px;
      overflow: hidden;
      position: relative;
      height: 20px;
      margin: 0px 0;
  }

  .progress-bar {
      height: 100%;
      background-color: #4caf50;
      text-align: center;
      line-height: 30px;
      color: white;
      font-weight: bold;
      border-radius: 0px 0 0 0px;
  }

  .progress-text {
      position: absolute;
      width: 100%;
      text-align: center;
      top: 0;
      left: 0;
      line-height: 20px;
      color: white;
      font-weight: bold;
  }
</style>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Card - <?php echo $_GET['status'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Card</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <?php if($_SESSION['nama'] == "Akbar Kurnia"){ ?>
                <div class="card-header">
                  <h3 class="card-title float-sm-right" style="font-size: 12px;">
                    <a href="#modal" data-toggle='modal' data-target='#show_add_projectcardList' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Project">
                      <span class="fa fa-plus"></span> Add Project
                    </a>
                  </h3>
                </div>
              <?php } ?>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%" style="text-align: center;">No</th>
                      <th width="" style="text-align: center;">Nama Project</th>
                      <th width="1%" style="text-align: center;">PM</th>
                      <th width="8%" style="text-align: center;">Penyerapan Barang</th>
                      <th width="8%" style="text-align: center;">Penyerapan Jasa</th>
                      <th width="8%" style="text-align: center;">Penyerapan Asset</th>
                      <th width="8%" style="text-align: center;">Total Penyerapan</th>
                      <th width="8%" style="text-align: center;">S-Curve Progress</th>
                      <th width="1%" style="text-align: center;">Deviasi</th>
                      <?php if($_SESSION['nama'] == "Akbar Kurnia"){ ?>
                        <th width="1%" style="text-align: center;">#</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 1;
                      $q_getprojectcardList = mysqli_query($conn, "SELECT * FROM projectcard_list WHERE status = '$_GET[status]'");
                      while($get_projectcardList = mysqli_fetch_array($q_getprojectcardList)){
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_projectcardList[kd_project]'"));
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_projectcardList[pm]'"));
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <?php if($_SESSION['nama'] == "Akbar Kurnia" || $_SESSION['nama'] == "Ati Nurhayati" || $_SESSION['nama'] == "Maldiyanti Nispi Kurnia"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_detail_projectcard' data-id='<?php echo $get_projectcardList['kd_project']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Project Card">
                              <?php echo $get_projectcardList['kd_project']." - ".$get_project['nm_project']; ?>
                            </a>
                          <?php }else{ 
                              echo $get_projectcardList['kd_project']." - ".$get_project['nm_project'];
                            }
                          ?>
                        </td>
                        <td>
                          <?php
                            $x_nama = explode(" ", $get_karyawan['nama']);
                            echo $x_nama[0]; 
                          ?>  
                        </td>
                        <td>
                          <!-- Penyerapan Barang -->
                          <?php
                            $t_penyerapanBarang = 0;
                            $persen_penyerapan_barang = 0;
                            $q_get_pengajuanProject = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kode_project = '$get_projectcardList[kd_project]' AND jenis = 'Barang'");
                            while($get_pengajuanProject = mysqli_fetch_array($q_get_pengajuanProject)){
                              $get_realisasiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$get_pengajuanProject[no_npb]'"));
                              $t_penyerapanBarang = $t_penyerapanBarang + $get_realisasiProject["jml_realisasi"];
                            }

                            //hitung penyerapan barang
                            $persen_penyerapan_barang = $t_penyerapanBarang/$get_project['hpp_barang']*100;
                            if($t_penyerapanBarang<1){
                              $persen_penyerapan_barang = 0;
                            }
                          ?>
                          <div class="progress-bar-container">
                            <div class="progress-bar bg-info" style="width: <?php echo $persen_penyerapan_barang ?>%;"></div>
                            <div class="progress-text"><?php echo number_format($persen_penyerapan_barang,2); ?>%</div>
                          </div>
                        </td>
                        <td>
                          <!-- Penyerapan Jasa -->
                          <?php
                            $t_penyerapanJasa = 0;
                            $persen_penyerapan_jasa = 0;
                            $q_get_pengajuanProject = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kode_project = '$get_projectcardList[kd_project]' AND jenis = 'Jasa'");
                            while($get_pengajuanProject = mysqli_fetch_array($q_get_pengajuanProject)){
                              $get_realisasiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$get_pengajuanProject[no_npb]'"));
                              $t_penyerapanJasa = $t_penyerapanJasa + $get_realisasiProject["jml_realisasi"];
                            }

                            //hitung penyerapan barang
                            $persen_penyerapan_jasa = $t_penyerapanJasa/$get_project['hpp_jasa']*100;
                            if($t_penyerapanJasa<1){
                              $persen_penyerapan_jasa = 0;
                            }
                          ?>
                          <div class="progress-bar-container">
                            <div class="progress-bar bg-info" style="width: <?php echo $persen_penyerapan_jasa ?>%;"></div>
                            <div class="progress-text"><?php echo number_format($persen_penyerapan_jasa,2); ?>%</div>
                          </div>
                        </td>
                        <td>
                          <!-- Penyerapan Asset -->
                          <?php
                            $t_penyerapanAsset = 0;
                            $persen_penyerapan_asset = 0;
                            $q_get_pengajuanProject = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kode_project = '$get_projectcardList[kd_project]' AND jenis = 'Asset'");
                            while($get_pengajuanProject = mysqli_fetch_array($q_get_pengajuanProject)){
                              $get_realisasiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$get_pengajuanProject[no_npb]'"));
                              $t_penyerapanAsset = $t_penyerapanAsset + $get_realisasiProject["jml_realisasi"];
                            }

                            //hitung penyerapan barang
                            $persen_penyerapan_asset = $t_penyerapanAsset/$get_project['hpp_asset']*100;
                            if($t_penyerapanAsset<1){
                              $persen_penyerapan_asset = 0;
                            }
                          ?>
                          <div class="progress-bar-container">
                            <div class="progress-bar bg-info" style="width: <?php echo $persen_penyerapan_asset ?>%;"></div>
                            <div class="progress-text"><?php echo number_format($persen_penyerapan_asset,2); ?>%</div>
                          </div>
                        </td>
                        <td>
                          <!-- Total Penyerapan -->
                          <?php
                            $total_penyerapan = $t_penyerapanBarang + $t_penyerapanJasa + $t_penyerapanAsset;
                            $persen_t_penyerapan = $total_penyerapan/($get_project['hpp_barang'] + $get_project['hpp_jasa'] + $get_project['hpp_asset'])*100;
                            if($total_penyerapan < 1){
                              $persen_t_penyerapan = 0;
                            }
                          ?>
                          <div class="progress-bar-container">
                            <div class="progress-bar bg-success" style="width: <?php echo $persen_t_penyerapan ?>%;"></div>
                            <div class="progress-text"><?php echo number_format($persen_t_penyerapan,2); ?>%</div>
                          </div>
                        </td>
                        <td>
                          <!-- % Progress -->
                          <a href="#modal" data-toggle='modal' data-target='#show_update_progress' data-id='<?php echo $get_projectcardList['kd_project']; ?>' data-toggle="tooltip" data-placement="bottom" title="Update Progress">
                            <div class="progress-bar-container">
                              <div class="progress-bar bg-success" style="width: <?php echo $get_projectcardList['update_progress']; ?>%;"></div>
                              <div class="progress-text"><?php echo $get_projectcardList['update_progress']; ?>%</div>
                            </div>
                          </a>
                        </td>
                        <td style="font-weight: bold;">
                          <!-- Deviasi -->
                          <?php 
                            $deviasi_penyerapan = $get_projectcardList['update_progress'] - $persen_t_penyerapan;

                            if($deviasi_penyerapan > 0){
                          ?>
                              <span class="description-percentage text-success">
                                <i class="fas fa-caret-up"></i>
                                  <?php echo number_format($deviasi_penyerapan,1)."%";?>
                              </span>
                          <?php }else{ ?>
                              <span class="description-percentage text-danger">
                                <i class="fas fa-caret-down"></i>
                                  <?php echo number_format($deviasi_penyerapan,1)."%";?>
                              </span>
                          <?php } ?>
                        </td>
                        <?php if($_SESSION['nama'] == "Akbar Kurnia"){ ?>
                          <td style="font-size: 14px;">
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_projectcard' data-id='<?php echo $get_projectcardList['kd_project']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Project Card">
                              <span class="fa fa-edit"></span>
                            </a>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php $i++; } ?>
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
  <div class="modal fade" id="show_add_projectcardList" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Project Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
             <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Project</label>
              <div class="col-sm-9">
                <select class="form-control" name="kd_project" style="font-size: 12px;" required>
                  <option value="" selected disabled>--- Pilih Project ---</option>
                  <option value="" disabled>--------------- GPP ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                  <option value="" disabled>--------------- GPS ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                  <option value="" disabled>--------------- GPW ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPW' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                  <option value="" disabled>--------------- GSS ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                  <option value="" disabled>--------------- SI ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">PM</label>
              <div class="col-sm-9">
                <select class="form-control" name="pm" style="font-size: 12px;" required>
                  <option value="" selected disabled>--- Pilih PM ---</option>
                  <option value="NULL">-</option>
                  <?php
                    $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama = 'Hikmah Permana' OR nama = 'Deny Santika Permana' OR nama = 'Janu Abdu Rohman' OR nama = 'Rai Purnama Rizki' OR nama = 'Rachmat Aditio' OR nama = 'Zidan Muhamad Fajar' ORDER BY nama ASC");
                    while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
                  ?>
                      <option value="<?php echo $get_karyawan['nik'] ?>"><?php echo $get_karyawan['nama'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">SM</label>
              <div class="col-sm-9">
                <select class="form-control" name="sm" style="font-size: 12px;" required>
                  <option value="" selected disabled>--- Pilih SM ---</option>
                  <option value="NULL">-</option>
                  <?php
                    $q_get_karyawan_sm = mysqli_query($conn, "SELECT * FROM karyawan_sm ORDER BY nama ASC");
                    while($get_karyawan_sm = mysqli_fetch_array($q_get_karyawan_sm)){
                  ?>
                      <option value="<?php echo $get_karyawan_sm['id'] ?>"><?php echo $get_karyawan_sm['nama'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Actual Start</label>
              <div class="col-sm-4">
                <input type="date" class="form-control" name="actual_start" style="font-size: 12px;">
              </div>
            </div>
            <!-- /.card-body -->
            <hr>
            <input type="submit" class="btn btn-primary btn-sm" name="submit_add_projectcardList" value="Simpan">
            <!-- /.card-footer -->
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_update_progress" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Progress</h4>
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
  <div class="modal fade" id="show_detail_projectcard" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Project Card</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body" style="background-color: white">
          <div class="modal-data"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_projectcard" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Project Card</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="background-color: white">
          <div class="modal-data"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->