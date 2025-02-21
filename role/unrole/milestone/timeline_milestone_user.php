<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_milestone = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM milestone_list_v2 WHERE id = '$id'"));
    $get_person = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_milestone[person]'"));
  }
?>

<section class="content">
  <div class="container-fluid">
    <!-- Timelime example  -->
    <div class="row">
      <div class="col-md-12">
        <!-- The time line -->
        <div class="timeline">

          <?php
            $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_v2_detail WHERE milestone_id = '$id'");
            while($get_milestone_detail = mysqli_fetch_array($q_get_milestone_detail)){

              $q_get_submission = mysqli_query($conn, "SELECT * FROM submission_list_v2 WHERE milestone_detail_id = '$get_milestone_detail[id]'");
              $get_submission = mysqli_fetch_array($q_get_submission);
              $cek_submission = mysqli_num_rows($q_get_submission);

          ?>

                <!-- timeline item -->
                <div>
                  <i class="fas fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y H:i:s", strtotime($get_milestone_detail['created_at'])); ?></span>
                    <h3 class="timeline-header">
                      <a href="#">Akbar Kurnia</a> request a task for <a href="#"><?php echo $get_person['nama']; ?></a>
                    </h3>
                    <div class="timeline-body">
                      <?php echo $get_milestone_detail['job_description']; ?>
                    </div>

                    <?php if($cek_submission < 1){ ?>
                        <div class="timeline-footer">
                          <a href="index.php?pages=formmilestonetask&id=<?php echo $get_milestone_detail['id']; ?>" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span> Edit Task</a>
                        </div>
                    <?php } ?>

                  </div>
                </div>
                <!-- END timeline item -->


              <?php if($cek_submission > 0){ ?>
                <!-- timeline item -->
                <div>
                  <i class="fas fa-user bg-green"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                    <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                  </div>
                </div>
                <!-- END timeline item -->
              <?php } ?>

          <?php } ?>

          <div>
            <i class="fas fa-clock bg-gray"></i>
          </div>


        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.timeline -->  
  </div>
</section>

<div class="loading-overlay" id="loadingOverlay">
  <div class="loading-spinner"></div>
</div>