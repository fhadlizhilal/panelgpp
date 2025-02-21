<?php
  $tgl_jam = date("Y-m-d H:i:s");

  if(isset($_POST['submit_add_milestoneList'])){
    if($_POST['submit_add_milestoneList'] == "Add Milestone"){
      $push_milestone = mysqli_query($conn, "INSERT INTO milestone_list VALUES('','$_POST[job_description]','$_POST[person]','open','waiting for submission','')");

      if($push_milestone){
        $last_id = $conn->insert_id;
        $push_milestone_detail = mysqli_query($conn, "INSERT INTO milestone_list_detail VALUES('','$last_id','$_POST[job_description]','$_POST[due_date]','$tgl_jam')");

        if($push_milestone_detail){
          $_SESSION['alert_success'] = "Berhasil! Milestone baru berhasil dibuat";
        }else{
          $delete_milestone = mysqli_query($conn, "DELETE FROM milestone_list WHERE id = '$last_id'");
          $_SESSION['alert_error'] = "Gagal! Milestone baru gagal dibuat [2]";
        }
      }else{
        $_SESSION['alert_error'] = "Gagal! Milestone baru gagal dibuat [1]";
      }

    }
  }

  if(isset($_POST['delete_milestoneList'])){
    if($_POST['delete_milestoneList'] == 'Delete'){
      $delete_milestone_detail = mysqli_query($conn, "DELETE FROM milestone_list_detail WHERE milestone_id = '$_POST[id]'");
      $delete_milestoneList = mysqli_query($conn, "DELETE FROM milestone_list WHERE id = '$_POST[id]'");

      if($delete_milestoneList){
        $_SESSION['alert_success'] = "Berhasil! Milestone berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Milestone gagal dihapus";
      }
    }
  }

  if(isset($_POST['submit_edit_milestoneList'])){
    if($_POST['submit_edit_milestoneList'] == "Simpan"){
      $edit_milestone = mysqli_query($conn, "UPDATE milestone_list SET job_description = '$_POST[job_description]', person = '$_POST[person]', status = '$_POST[status]' WHERE id = '$_POST[id]'");

      if($edit_milestone){
        $_SESSION['alert_success'] = "Berhasil! Milestone berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Milestone berhasil diubah";
      }
    }
  }

  if(isset($_POST['simpan_milestone_task'])){
    if($_POST['simpan_milestone_task'] == "Simpan"){
      $edit_milestone_detail = mysqli_query($conn, "UPDATE milestone_list_detail SET job_description = '$_POST[job_description]', due_date = '$_POST[due_date]' WHERE id = '$_POST[id]'");

      if($edit_milestone_detail){
        $_SESSION['alert_success'] = "Berhasil! Task berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Task berhasil disimpan";
      }
    }
  }

  if(isset($_POST['submit_submission'])){
    if($_POST['submit_submission'] == "Submit Submission"){
      $delete_submission_old = mysqli_query($conn, "DELETE FROM submission_list WHERE milestone_detail_id = '$_POST[milestone_detail_id]'");
      $push_submission = mysqli_query($conn, "INSERT INTO submission_list VALUES('','$_POST[milestone_detail_id]','$_POST[comments]','$tgl_jam')");
      $edit_status_milestone = mysqli_query($conn, "UPDATE milestone_list SET submission = 'waiting for review' WHERE id = '$_POST[milestone_id]'");

      if($delete_submission_old && $push_submission && $edit_status_milestone){
        $_SESSION['alert_success'] = "Berhasil! Submission berhasil disubmit";
      }else{
        $_SESSION['alert_error'] = "Gagal! Submission gagal disubmit";
      }
    }
  }

  if(isset($_POST['submit_review_revisi'])){
    if($_POST['submit_review_revisi'] == "revisi"){
      $push_milestone_detail = mysqli_query($conn, "INSERT INTO milestone_list_detail VALUES('','$_POST[milestone_detail_id]','$_POST[comments]',NULL,'$tgl_jam')");

      if($push_milestone_detail){
        $id_baru = $conn->insert_id;
        $edit_milestone_status = mysqli_query($conn, "UPDATE milestone_list SET submission = 'waiting for revision' WHERE id = '$_POST[milestone_id]'");

        header("Location: index.php?pages=formrevisi&subid=".$_POST['submission_id']."&id=".$id_baru);
        exit();
      }else{
        $_SESSION['alert_error'] = "Gagal! Task Revisi gagal dibuat";
      }
    }
  }

  if(isset($_POST['submit_milestone_revisi'])){
    if($_POST['submit_milestone_revisi'] == "Submit Comments"){
      $edit_milestone_detail = mysqli_query($conn, "UPDATE milestone_list_detail SET job_description = '$_POST[comments]', due_date = '$_POST[due_date]' WHERE id = '$_POST[milestone_detail_id]'");

      if($edit_milestone_detail){
        $_SESSION['alert_success'] = "Berhasil! Comments berhasil disubmit";
      }else{
        $_SESSION['alert_error'] = "Gagal! Comments gagal disubmit";
      }
    }
  }

  if(isset($_POST['submit_review_completed'])){
    if($_POST['submit_review_completed'] == "completed"){
      $milestone_completed = mysqli_query($conn, "UPDATE milestone_list SET status = 'closed', submission = 'milestone completed', keterangan = '$_POST[comments]' WHERE id = '$_POST[milestone_id]'");

      if($milestone_completed){
        $_SESSION['alert_success'] = "Berhasil! Milestone Completed berhasil";
      }else{
        $_SESSION['alert_error'] = "Gagal! Milestone Completed gagal";
      }
    }
  }

  if(isset($_POST['submit_review_incomplete'])){
    if($_POST['submit_review_incomplete'] == "incomplete"){
      $milestone_incomplete = mysqli_query($conn, "UPDATE milestone_list SET status = 'closed', submission = 'milestone incomplete', keterangan = '$_POST[comments]' WHERE id = '$_POST[milestone_id]'");

      if($milestone_incomplete){
        $_SESSION['alert_success'] = "Berhasil! Milestone Incomplete berhasil";
      }else{
        $_SESSION['alert_error'] = "Gagal! Milestone Incomplete gagal";
      }
    }
  }
  
?>

<style>
    /* Style for the fullscreen image container */
    .fullscreen-img-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s, opacity 0.3s ease;
        z-index: 9999;
    }

    /* Fullscreen image style */
    .fullscreen-img-container img {
        max-width: 100%;
        max-height: 100%;
        border: 2px solid white;
    }

    /* Close button style */
    .close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        color: white;
        font-size: 30px;
        cursor: pointer;
    }

    /* When container is active, make it visible */
    .fullscreen-img-container.active {
        visibility: visible;
        opacity: 1;
    }
</style>

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
                    <a href="#modal" data-toggle='modal' data-target='#show_add_milestoneList' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Milestone Baru">
                      <span class="fa fa-plus"></span> Add Milestone
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
                      <?php if($_GET['show'] == "closed"){ ?>
                        <th width="15%">Keterangan</th>
                      <?php } ?>
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

                        $get_milestone_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE milestone_id = '$get_milestoneList[id]' ORDER BY id DESC"));

                        $q_get_submission = mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_detail_id = '$get_milestone_detail[id]'");

                        $cek_submission = mysqli_num_rows($q_get_submission);
                        $get_submission = mysqli_fetch_array($q_get_submission);
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
                            echo "<small>update created at : ".date("d F Y H:i", strtotime($get_milestone_detail['created_at']))."</small>";
                          ?>
                        </td>
                        <td>
                          <?php
                            $nama_person = explode(' ', trim($get_person['nama']));
                            echo $nama_person[0]." ".$nama_person[1];
                          ?>
                        </td>
                        <td>
                          <?php
                            echo date("d F Y H:i", strtotime($get_milestone_detail['due_date']));

                            if($cek_submission < 1){

                              if($get_milestone_detail['due_date'] >= $tgl_jam){
                                echo "<span class='badge badge-success'>Open</span>";
                              }else{
                                echo "<span class='badge badge-danger'>Overdue</span>";
                              }

                            }else{

                              if($get_submission['submitted_at'] > $get_milestone_detail['due_date']){
                                echo "<span class='badge badge-danger'>Overdue</span>";
                              }else{
                                echo "<span class='badge badge-success'>In Time</span>";
                              }

                            }
                          ?>
                        </td>
                        <td>
                          <?php if($get_milestoneList['submission'] == "waiting for submission"){ ?>
                            <span class="badge badge-secondary"><?php echo $get_milestoneList['submission']; ?></span>
                          <?php }elseif($get_milestoneList['submission'] == "waiting for review"){ ?>
                            <span class="badge badge-info"><?php echo $get_milestoneList['submission']; ?></span>
                          <?php }elseif($get_milestoneList['submission'] == "waiting for revision"){ ?>
                            <span class="badge badge-warning"><?php echo $get_milestoneList['submission']; ?></span>
                          <?php }elseif($get_milestoneList['submission'] == "milestone completed"){ ?>
                            <span class="badge badge-success"><?php echo $get_milestoneList['submission']; ?></span>
                          <?php }elseif($get_milestoneList['submission'] == "milestone incomplete"){ ?>
                            <span class="badge badge-danger"><?php echo $get_milestoneList['submission']; ?></span>
                          <?php } ?>
                        </td>
                        <?php if($_GET['show'] == "closed"){ ?>
                          <td><?php echo $get_milestoneList['keterangan'] ?></td>
                        <?php } ?>
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
          <h4 class="modal-title">Tambah Milestone Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" method="POST" action="">
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
                    $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama = 'Hikmah Permana' OR nama = 'Janu Abdu Rohman' OR nama = 'Gilvan Achmad Maulana Azhar' OR nama = 'Eldy Darmawan Sendy Pratama' OR nama = 'Rai Purnama Rizki' OR nama = 'Novandy Iqbal Fadhillah' OR nama = 'Mimi Rohimi' OR nama = 'Yusaribah Haliza' OR nama = 'Zidan Muhamad Fajar' ORDER BY nama ASC");
                    while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
                  ?>
                      <option value="<?php echo $get_karyawan['nik'] ?>"><?php echo $get_karyawan['nama'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Due Date</label>
              <div class="col-sm-5">
                <input type="datetime-local" class="form-control form-control-sm" name="due_date" required>
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
          <form id="myFormA" method="POST" action="">
            <div class="modal-data"></div>
          </form>
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

  <!-- Fullscreen image preview container -->
<div id="fullscreenImgContainer" class="fullscreen-img-container" onclick="closeFullscreen()">
    <span class="close-btn">&times;</span>
    <img id="fullscreenImg" src="" alt="Fullscreen Image">
</div>

<script>
  // Function to load modal content from a separate file using AJAX
  function loadModalContent() {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'modal-content.html', true);  // Fetch the content from modal-content.html
      xhr.onload = function() {
          if (xhr.status === 200) {
              document.getElementById('modalContent').innerHTML = xhr.responseText;
          }
      };
      xhr.send();
  }

  // Function to display image in fullscreen mode
  function openFullscreen(image) {
      var imgSrc = image.src; // Get the source of the clicked image
      var fullscreenContainer = document.getElementById('fullscreenImgContainer');
      var fullscreenImg = document.getElementById('fullscreenImg');

      fullscreenImg.src = imgSrc; // Set the src to the clicked image src
      fullscreenContainer.classList.add('active'); // Show the fullscreen container
  }

  // Function to close fullscreen mode
  function closeFullscreen() {
      var fullscreenContainer = document.getElementById('fullscreenImgContainer');
      fullscreenContainer.classList.remove('active'); // Hide the fullscreen container
  }
</script>