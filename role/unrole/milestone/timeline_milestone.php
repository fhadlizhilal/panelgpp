<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_milestone = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM milestone_list WHERE id = '$id'"));
    $get_person = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_milestone[person]'"));
    $id_detail_terakhir = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE milestone_id = '$id' ORDER BY id DESC"));
    $id_submission_terakhir = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_detail_id = '$id_detail_terakhir[id]'"));
  }
?>

<?php if($_SESSION['nama'] == "Akbar Kurnia"){ ?>

    <section class="content">
      <div class="container-fluid">
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">

              <?php
                $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE milestone_id = '$id'");
                while($get_milestone_detail = mysqli_fetch_array($q_get_milestone_detail)){

                  $q_get_submission = mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                  $get_submission = mysqli_fetch_array($q_get_submission);
                  $cek_submission = mysqli_num_rows($q_get_submission);

              ?>

                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-envelope bg-blue"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y H:i", strtotime($get_milestone_detail['created_at'])); ?></span>
                        <h3 class="timeline-header">
                          <a href="#">Akbar Kurnia</a> request a task for <a href="#"><?php echo $get_person['nama']; ?></a>
                        </h3>
                        <div class="timeline-body">
                          <?php
                            echo $get_milestone_detail['job_description'];
                            echo "<br><small><span class='badge badge-secondary'>Due Date : ".date("d F Y H:i", strtotime($get_milestone_detail['due_date']))."</span></small>";
                          ?>
                        </div>

                        <div class="card-body">
                          <div class="row">
                            <?php
                              $no=11;
                              $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranimg WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                              while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                            ?>
                                <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                                  <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%" class="img-thumbnail" alt="Image 1" onclick="openFullscreen(this)">
                                </div>
                            <?php $no++; } ?>
                          </div>

                          <div class="row">
                            <table class="table table-sm" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="1%">No</th>
                                  <th>Nama File</th>
                                  <th width="5%">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $no=1;
                                  $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranfile WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                                  while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                    <td style="font-size: 14px;">
                                      <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                        <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                      </a>
                                    </td>
                                  </tr>
                                <?php $no++; } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <?php if($cek_submission < 1){ ?>
                            <div class="timeline-footer" style="text-align: center;">
                              <a href="index.php?pages=formmilestonetask&id=<?php echo $get_milestone_detail['id']; ?>" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span> Edit Task</a>
                            </div>
                        <?php } ?>

                      </div>
                    </div>
                    <!-- END timeline item ------------------------------->


                  <?php if($cek_submission > 0){ ?>
                    <!-- timeline item ------------------------------------->
                    <div>
                      <i class="fas fa-user bg-green"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y H:i", strtotime($get_submission['submitted_at'])); ?></span>
                        <h3 class="timeline-header no-border"><a href="#"><?php echo $get_person['nama']; ?></a> submitted a submission</h3>

                        <div class="timeline-body">
                          <?php
                            echo $get_submission['comments'];
                            echo "<br><small><span class='badge badge-secondary'>Submitted at : ".date("d F Y H:i", strtotime($get_submission['submitted_at']))."</span></small>";

                            if($get_submission['submitted_at'] <= $get_milestone_detail['due_date']){
                              echo "&nbsp;<small><span class='badge badge-success'>In Time</span></small>";
                            }else{
                              echo "&nbsp;<small><span class='badge badge-danger'>Overdue</span></small>";
                            }
                          ?>
                        </div>

                        <div class="card-body">
                          <div class="row">
                            <?php
                              $no=11;
                              $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM submission_list_lampiranimg WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                              while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                            ?>
                                <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                                  <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%" class="img-thumbnail" alt="Image 1" onclick="openFullscreen(this)">
                                </div>
                            <?php $no++; } ?>
                          </div>

                          <div class="row">
                            <table class="table table-sm" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="1%">No</th>
                                  <th>Nama File</th>
                                  <th width="5%">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $no=1;
                                  $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM submission_list_lampiranfile WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                                  while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                    <td style="font-size: 14px;">
                                      <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                        <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                      </a>
                                    </td>
                                  </tr>
                                <?php $no++; } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <?php if($get_milestone['submission'] == "waiting for review" AND $get_milestone_detail['id'] == $id_detail_terakhir['id']){ ?>
                          <div class="timeline-footer" style="text-align: center;">
                            <form method="POST" action="">
                              <textarea class="form-control" name="comments" placeholder="write your comments here" style="margin-bottom: 8px;" required></textarea>
                              <input type="hidden" name="milestone_id" value="<?php echo $id; ?>">
                              <input type="hidden" name="submission_id" value="<?php echo $get_submission['id']; ?>">
                              <input type="hidden" name="milestone_detail_id" value="<?php echo $get_milestone_detail['id']; ?>">

                              <button type="submit" class="btn btn-primary btn-sm" name="submit_review_revisi" value="revisi">
                                <span class="fa fa-edit"> Comment / Revisi</span>
                              </button>

                              <button type="submit" class="btn btn-success btn-sm" name="submit_review_completed" value="completed">
                                <span class="fa fa-check"> Submission Completed</span>
                              </button>

                              <button type="submit" class="btn btn-danger btn-sm" name="submit_review_incomplete" value="incomplete">
                                <span class="fa fa-close"> Submission Incomplete</span>
                              </button>
                            </form>
                          </div>
                        <?php } ?>

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


<?php }else{ ?>
<!-- ---------------------------------------------------------------- TIME LINE USER ------------------------------- -->

  <section class="content">
      <div class="container-fluid">
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">

              <?php
                $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE milestone_id = '$id'");
                while($get_milestone_detail = mysqli_fetch_array($q_get_milestone_detail)){

                  $q_get_submission = mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                  $get_submission = mysqli_fetch_array($q_get_submission);
                  $cek_submission = mysqli_num_rows($q_get_submission);

              ?>

                    <!-- timeline item -->
                    <div>
                      <i class="fas fa-envelope bg-blue"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y H:i", strtotime($get_milestone_detail['created_at'])); ?></span>
                        <h3 class="timeline-header">
                          <a href="#">Akbar Kurnia</a> request a task for <a href="#"><?php echo $get_person['nama']; ?></a>
                        </h3>
                        <div class="timeline-body">
                          <?php
                            echo $get_milestone_detail['job_description'];
                            echo "<br><small><span class='badge badge-secondary'>Due Date : ".date("d F Y H:i", strtotime($get_milestone_detail['due_date']))."</span></small>";
                          ?>
                        </div>

                        <div class="card-body">
                          <div class="row">
                            <?php
                              $no=11;
                              $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranimg WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                              while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                            ?>
                                <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                                  <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%" class="img-thumbnail" alt="Image 1" onclick="openFullscreen(this)">
                                </div>
                            <?php $no++; } ?>
                          </div>

                          <div class="row">
                            <table class="table table-sm" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="1%">No</th>
                                  <th>Nama File</th>
                                  <th width="5%">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $no=1;
                                  $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranfile WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                                  while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                    <td style="font-size: 14px;">
                                      <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                        <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                      </a>
                                    </td>
                                  </tr>
                                <?php $no++; } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <?php if($cek_submission < 1){ ?>
                          <div class="timeline-footer" style="text-align: center;">
                            <a href="index.php?pages=formsubmission&id=<?php echo $get_milestone_detail['id']; ?>" class="btn btn-success btn-sm"><span class="fa fa-upload"></span> Submit Submission</a>
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
                        <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y H:i", strtotime($get_submission['submitted_at'])); ?></span>
                        <h3 class="timeline-header no-border"><a href="#"><?php echo $get_person['nama']; ?></a> submitted a submission</h3>

                        <div class="timeline-body">
                          <?php
                            echo $get_submission['comments'];
                            echo "<br><small><span class='badge badge-secondary'>Submitted at : ".date("d F Y H:i", strtotime($get_submission['submitted_at']))."</span></small>";

                            if($get_submission['submitted_at'] <= $get_milestone_detail['due_date']){
                              echo "&nbsp;<small><span class='badge badge-success'>In Time</span></small>";
                            }else{
                              echo "&nbsp;<small><span class='badge badge-danger'>Overdue</span></small>";
                            }
                          ?>
                        </div>

                        <div class="card-body">
                          <div class="row">
                            <?php
                              $no=11;
                              $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM submission_list_lampiranimg WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                              while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                            ?>
                                <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                                  <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%" class="img-thumbnail" alt="Image 1" onclick="openFullscreen(this)">
                                </div>
                            <?php $no++; } ?>
                          </div>

                          <div class="row">
                            <table class="table table-sm" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="1%">No</th>
                                  <th>Nama File</th>
                                  <th width="5%">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $no=1;
                                  $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM submission_list_lampiranfile WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                                  while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                    <td style="font-size: 14px;">
                                      <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                        <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                      </a>
                                    </td>
                                  </tr>
                                <?php $no++; } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <?php if($get_milestone['submission'] == "waiting for review" AND $id_submission_terakhir['id'] == $get_submission['id']){ ?>
                          <div class="timeline-footer" style="text-align: center;">
                            <a href="index.php?pages=formsubmission&id=<?php echo $get_milestone_detail['id']; ?>">
                              <div class="btn btn-primary btn-sm"><span class="fa fa-edit"> Edit Submission</span></div>
                            </a>
                          </div>
                        <?php } ?>

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

<?php } ?>

<div class="loading-overlay" id="loadingOverlay">
  <div class="loading-spinner"></div>
</div>