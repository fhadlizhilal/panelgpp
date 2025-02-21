<?php
  $tgl_now = date("Y-m-d H:i:s");

  if(isset($_POST['submit_add_milestoneList'])){
    if($_POST['submit_add_milestoneList'] == "Add Milestone"){
      $push_add_milestoneList = mysqli_query($conn, "INSERT INTO milestone_list VALUES('','$_POST[job_description]','$_POST[person]','$_POST[due_date]','open','$tgl_now','waiting for submission')");

      if($push_add_milestoneList){
        $_SESSION['alert_success'] = "Berhasil! Milestone List Baru berhasil ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Milestone List Baru gagal ditambahkan";
      }
    }
  }

  if(isset($_POST['submit_edit_milestoneList'])){
    if($_POST['submit_edit_milestoneList'] == "Simpan"){
      $edit_milestoneList = mysqli_query($conn, "UPDATE milestone_list SET job_description = '$_POST[job_description]', person = '$_POST[person]', due_date = '$_POST[due_date]', status = '$_POST[status]' WHERE id = '$_POST[id]'");

      if($edit_milestoneList){
        $_SESSION['alert_success'] = "Berhasil! Milestone List berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Milestone List gagal diubah";
      }
    }
  }

  if(isset($_POST['delete_milestoneList'])){
    if($_POST['delete_milestoneList'] == "Delete"){
      $delete_milestoneList = mysqli_query($conn, "DELETE FROM milestone_list WHERE id = '$_POST[id]'");

      if($delete_milestoneList){
        $_SESSION['alert_success'] = "Berhasil! Milestone List berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Milestone List gagal dihapus";
      }
    }
  }

  if(isset($_POST['completed_submission'])){
    if($_POST['completed_submission'] == "completed"){
      $edit_to_completed = mysqli_query($conn, "UPDATE milestone_list SET status = 'closed', submission = 'submission completed' WHERE id = '$_POST[id]'");

      if($edit_to_completed){
        $_SESSION['alert_success'] = "Berhasil! Submission Completed";
      }else{
        $_SESSION['alert_error'] = "Gagal! Submission Completed Gagal";
      }
    }
  }

  if(isset($_POST['comments_submission'])){
    if($_POST['comments_submission'] == "comments"){
      $create_milestone_revisi = mysqli_query($conn, "INSERT INTO milestone_list_revisi VALUES('','$_POST[id]','$_POST[comments]','$tgl_now','')");
      $update_milestoneList = mysqli_query($conn, "UPDATE milestone_list SET submission = 'waiting for revision' WHERE id = '$_POST[id]'");
      $last_id = $conn->insert_id;

      if($create_milestone_revisi){
        header("Location: index.php?pages=formrevisi&id=".$_POST['id']."&revid=".$last_id);
      }else{
        $_SESSION['alert_error'] = "Gagal! Comments Submission Gagal";
      }
    }
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Milestone List - <?php echo $_GET['show']; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Milestone</li>
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
                    <a href="#modal" data-toggle='modal' data-target='#show_add_milestoneList' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Milestone List Baru">
                      <span class="fa fa-plus"></span> Add Milestone List
                    </a>
                  </h3>
                </div>
              <?php } ?>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-striped table-lg" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Job Description</th>
                      <th width="15%">Person</th>
                      <th width="15%">Due Date</th>
                      <th width="6%">Submission</th>
                      <?php if($_SESSION['nama'] == "Akbar Kurnia"){ ?>
                        <th width="5%">#</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      if($_SESSION['nama'] == "Akbar Kurnia"){
                        $q_get_milestoneList = mysqli_query($conn, "SELECT * FROM milestone_list WHERE status = '$_GET[show]' ORDER BY id DESC");
                      }else{
                        $q_get_milestoneList = mysqli_query($conn, "SELECT * FROM milestone_list WHERE person = '$_SESSION[nik]' AND status = '$_GET[show]' ORDER BY id DESC");
                      }

                      while($get_milestoneList = mysqli_fetch_array($q_get_milestoneList)){
                        $get_person = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_milestoneList[person]'"));
                        $q_get_submissionList = mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_list_id = '$get_milestoneList[id]'");
                        $get_submissionList = mysqli_fetch_array($q_get_submissionList);
                        $cek_submission = mysqli_num_rows($q_get_submissionList);
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_timeline_milestone' data-id='<?php echo $get_milestoneList['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Milestone">
                            <?php
                              echo $get_milestoneList['job_description']."<br>";
                            ?>
                          </a>
                          <?php
                            echo "<small>".date("d F Y H:i:s", strtotime($get_milestoneList['created_at']))."</small>";
                          ?>    
                        </td>
                        <td>
                          <?php
                            $nama_person = explode(' ', trim($get_person['nama']));
                            echo $nama_person[0]." ".$nama_person[1]; 
                          ?>
                        </td>
                        <td>
                          <?php echo date("d F Y", strtotime($get_milestoneList['due_date'])); ?><br>
                          <?php
                            $msg_sukses = "Open";
                            $tgl_y = $get_milestoneList['due_date'];
                            $tgl_x = date('Y-m-d');
                            if($cek_submission > 0){ $tgl_x = $get_submissionList['submitted_at']; $msg_sukses = "In Time"; }

                            if($tgl_y < $tgl_x){
                          ?>
                              <span class="badge badge-danger">Overdue</span>
                          <?php }else{ ?>
                              <span class="badge badge-success"><?php echo $msg_sukses; ?></span>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($get_milestoneList['submission'] == "waiting for submission"){ ?>
                            <span class="badge badge-secondary"><?php echo $get_milestoneList['submission']; ?></span>
                          <?php }elseif($get_milestoneList['submission'] == "waiting for review"){ ?>
                            <span class="badge badge-info"><?php echo $get_milestoneList['submission']; ?></span>
                          <?php }elseif($get_milestoneList['submission'] == "waiting for revision"){ ?>
                            <span class="badge badge-warning"><?php echo $get_milestoneList['submission']; ?></span>
                          <?php }elseif($get_milestoneList['submission'] == "submission completed"){ ?>
                            <span class="badge badge-success"><?php echo $get_milestoneList['submission']; ?></span>
                          <?php } ?>
                        </td>
                        <?php if($_SESSION['nama'] == "Akbar Kurnia"){ ?>
                          <td style="font-size: 14px;">
                            <a href="#modal" data-toggle='modal' data-target='#edit_milestone_list' data-id='<?php echo $get_milestoneList['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Milestone">
                              <span class="fa fa-edit"></span>
                            </a>
                          </td>
                        <?php } ?>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_milestoneList" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Milestone List Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Job Description</label>
              <div class="col-sm-9">
                <textarea class="form-control form-control-sm" name="job_description" required></textarea>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Person</label>
              <div class="col-sm-9">
                <select class="form-control" name="person" required>
                  <option value="" selected disabled>--- Pilih Person ---</option>
                  <?php
                    $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama = 'Hikmah Permana' OR nama = 'Deny Santika Permana' OR nama = 'Janu Abdu Rohman' OR nama = 'Gilvan Achmad Maulana Azhar' OR nama = 'Eldy Darmawan Sendy Pratama' OR nama = 'Gian Hartaman' OR nama = 'M Ihsan Mansur' OR nama = 'Andi Tyas' OR nama = 'Rai Purnama Rizki' OR nama = 'Dedi Mulyana' OR nama = 'Yosep Saepul Milah' OR nama = 'Whega Mahesa' OR nama = 'Novandy Iqbal Fadhillah' ORDER BY nama ASC");
                    while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
                  ?>
                      <option value="<?php echo $get_karyawan['nik'] ?>"><?php echo $get_karyawan['nama'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Due Date</label>
              <div class="col-sm-4">
                <input type="date" class="form-control form-control-sm" name="due_date" required>
              </div>
            </div>
            <br>
            <input type="submit" class="btn btn-primary" name="submit_add_milestoneList" value="Add Milestone">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="edit_milestone_list" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Milestone List</h4>
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
  <div class="modal fade" id="show_timeline_milestone" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Timeline Milestone</h4>
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

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>