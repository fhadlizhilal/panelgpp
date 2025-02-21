<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
      $id = $_POST['getID'];
      $get_milestoneList = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM milestone_list WHERE id = '$id'"));
      $get_submissionList = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_list_id = '$id'"));
      $get_person = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_milestoneList[person]'"));
      $cek_submission = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_list_id = '$id'"));
      $cek_milestone_revisi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM milestone_list_revisi WHERE milestone_list_id = '$id'"));
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
            <!-- timeline item -->
            <div>
              <i class="fas fa-user bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y H:i:s", strtotime($get_milestoneList["created_at"])); ?></span>
                <h3 class="timeline-header"><a href="#">Akbar Kurnia</a> request a task for <a href="#"><?php echo $get_person['nama']; ?></a></h3>
                <div class="timeline-body">
                  <?php echo $get_milestoneList["job_description"]; ?>
                  <br><span class="badge badge-info">Due Date : <?php echo date("d F Y", strtotime($get_milestoneList["due_date"])); ?></span>
                </div>
                <?php if($cek_submission < 1){ ?>
                  <div class="timeline-footer">
                    <a href="index.php?pages=addattachment_milestonelist&id=<?php echo $id; ?>" class="btn btn-primary btn-sm"><span class="fa fa-paperclip"></span> Edit Attachment</a>
                  </div>
                <?php } ?>
                <div class="timeline-body">
                  <div class="card-body p-0">
                    <div class="row">
                      <?php
                        $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranimg WHERE milestone_list_id = '$id'");
                        while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                      ?>
                          <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                            <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">
                          </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>

                <?php
                  $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranfile WHERE milestone_list_id = '$id'");
                  $cek_lampiranFile = mysqli_num_rows($q_get_lampiran_file);

                  if($cek_lampiranFile > 0){
                ?>
                    <div class="timeline-body">
                      <div class="card-body p-0">
                        <table class="table table-sm" style="font-size: 12px;">
                          <thead>
                            <tr>
                              <th width="1%">No</th>
                              <th>Nama File</th>
                              <th width="8%">#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no=1;
                              while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                            ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                <td style="font-size: 14px;">
                                  <form id="myForm<?php echo $no; ?>" method="POST" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="nama_file" value="<?php echo $get_lampiran_file['nama_file']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $get_lampiran_file['id']; ?>">
                                    <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                      <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                    </a>
                                  </form>
                                </td>
                              </tr>
                            <?php $no++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                <?php } ?>

              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php if($cek_submission > 0){ ?>
              <div>
                <i class="fas fa-user bg-green"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y", strtotime($get_submissionList["submitted_at"])); ?></span>
                  <h3 class="timeline-header"><a href="#"><?php echo $get_person["nama"]; ?></a> submitted a submission</h3>
                  <div class="timeline-body">
                    <?php echo $get_submissionList['comments']; ?>
                    <br><span class="badge badge-info">Submitted Date : <?php echo date("d F Y", strtotime($get_submissionList["submitted_at"])); ?></span>
                    <?php if($get_submissionList["submitted_at"] > $get_milestoneList['due_date']){ ?>
                      <span class="badge bg-danger">Overdue</span>
                    <?php }else{ ?>
                      <span class="badge bg-success">In Time</span>
                    <?php } ?>
                  </div>
                  <div class="timeline-body">
                    <div class="card-body p-0">
                      <div class="row">
                        <?php
                          $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM submission_list_lampiranimg WHERE milestone_list_id = '$id'");
                          while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                        ?>
                            <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                              <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">
                            </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                  
                  <?php
                    $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM submission_list_lampiranfile WHERE milestone_list_id = '$id'");
                    $cek_lampiranFile = mysqli_num_rows($q_get_lampiran_file);

                    if($cek_lampiranFile > 0){
                  ?>
                      <div class="timeline-body">
                        <div class="card-body p-0">
                          <table class="table table-sm" style="font-size: 12px;">
                            <thead>
                              <tr>
                                <th width="1%">No</th>
                                <th>Nama File</th>
                                <th width="8%">#</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $no=1;
                                while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                              ?>
                                <tr>
                                  <td><?php echo $no; ?></td>
                                  <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                  <td style="font-size: 14px;">
                                    <form id="myForm<?php echo $no; ?>" method="POST" action="" enctype="multipart/form-data">
                                      <input type="hidden" name="nama_file" value="<?php echo $get_lampiran_file['nama_file']; ?>">
                                      <input type="hidden" name="id" value="<?php echo $get_lampiran_file['id']; ?>">
                                      <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                        <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                      </a>
                                    </form>
                                  </td>
                                </tr>
                              <?php $no++; } ?>
                            </tbody> 
                          </table>
                        </div>
                      </div>
                  <?php } ?>

                  <?php if($cek_milestone_revisi < 1){ ?>
                    <div class="timeline-footer" style="text-align: center;">
                      <form id="myFormA" method="POST" action="" style="margin-bottom: 2px;">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <textarea class="form-control form-control-sm" name="comments" style="margin-bottom: 5px;" placeholder="Tambahkan Comments di sini" required></textarea>
                        <button type="submit" class="btn btn-danger" name="comments_submission" value="comments" onclick="return confirm('Yakin comment/revisi submission ini?')" style="width: 100%;">Comments</button>
                      </form>
                      <form id="myFormB" method="POST" action="">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit" class="btn btn-success" name="completed_submission" value="completed" onclick="return confirm('Yakin completed submission ini?')" style="width: 100%;">Completed</button>
                      </form>
                    </div>
                  <?php } ?>
                </div>
              </div>
            <?php } ?>
            <!-- END timeline item -->

            <!-- -------------------------------- TIME LINE REVISI ADMIN ----------------- -->
            <!-- -------------------------------- TIME LINE REVISI ADMIN ----------------- -->
            <!-- -------------------------------- TIME LINE REVISI ADMIN ----------------- -->
            <!-- timeline item -->
          <?php
            $q_get_milestoneRevisi = mysqli_query($conn, "SELECT * FROM milestone_list_revisi WHERE milestone_list_id = '$id'");
            while($get_milestoneRevisi = mysqli_fetch_array($q_get_milestoneRevisi)){
              $q_get_submissionRevisi = mysqli_query($conn, "SELECT * FROM submission_list_revisi WHERE milestone_revisi_id = '$get_milestoneRevisi[id]'");
              $cek_submissionRevisi = mysqli_num_rows($q_get_submissionRevisi);
          ?>
            <div>
              <i class="fas fa-user bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y H:i:s", strtotime($get_milestoneRevisi["created_at"])); ?></span>
                <h3 class="timeline-header"><a href="#">Akbar Kurnia</a> request a revision for <a href="#"><?php echo $get_person['nama']; ?></a></h3>
                <div class="timeline-body">
                  <?php echo $get_milestoneRevisi["comments"]; ?>
                  <br><span class="badge badge-info">Due Date : <?php echo date("d F Y", strtotime($get_milestoneRevisi["due_date"])); ?></span>
                </div>
                <?php if($cek_submission < 1){ ?>
                  <div class="timeline-footer">
                    <a href="index.php?pages=addattachment_milestonelist&id=<?php echo $id; ?>" class="btn btn-primary btn-sm"><span class="fa fa-paperclip"></span> Edit Attachment</a>
                  </div>
                <?php } ?>
                <div class="timeline-body">
                  <div class="card-body p-0">
                    <div class="row">
                      <?php
                        $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM milestone_list_revisi_lampiranimg WHERE milestone_revisi_id = '$get_milestoneRevisi[id]'");
                        while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                      ?>
                          <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                            <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">
                          </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>

                <?php
                  $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM milestone_list_revisi_lampiranfile WHERE milestone_revisi_id = '$get_milestoneRevisi[id]'");
                  $cek_lampiranFile = mysqli_num_rows($q_get_lampiran_file);

                  if($cek_lampiranFile > 0){
                ?>
                    <div class="timeline-body">
                      <div class="card-body p-0">
                        <table class="table table-sm" style="font-size: 12px;">
                          <thead>
                            <tr>
                              <th width="1%">No</th>
                              <th>Nama File</th>
                              <th width="8%">#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no=1;
                              while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                            ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                <td style="font-size: 14px;">
                                  <form id="myForm<?php echo $no; ?>" method="POST" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="nama_file" value="<?php echo $get_lampiran_file['nama_file']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $get_lampiran_file['id']; ?>">
                                    <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                      <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                    </a>
                                  </form>
                                </td>
                              </tr>
                            <?php $no++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                <?php } ?>

                <?php if($cek_submissionRevisi < 1){ ?>
                  <div class="timeline-footer">
                    <a href="index.php?pages=formrevisi&id=<?php echo $id ?>&revid=<?php echo $get_milestoneRevisi['id']; ?>">
                      <div class="btn btn-primary btn-sm"><span class="fa fa-paperclip"></span> Edit Attachment</div>
                    </a>
                  </div>
                <?php } ?>

              </div>
            </div>
            <!-- END timeline item ---------------------------------->
            <!-- Timeline Item -------------------------------------->
            <?php
              if($cek_submissionRevisi > 0){
            ?>
                <div>
                  <i class="fas fa-user bg-green"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y", strtotime($get_submissionList["submitted_at"])); ?></span>
                    <h3 class="timeline-header"><a href="#"><?php echo $get_person["nama"]; ?></a> submitted a revision</h3>
                    <div class="timeline-body">
                      <?php echo $get_submissionList['comments']; ?>
                      <br><span class="badge badge-info">Submitted Date : <?php echo date("d F Y", strtotime($get_submissionList["submitted_at"])); ?></span>
                      <?php if($get_submissionList["submitted_at"] > $get_milestoneList['due_date']){ ?>
                        <span class="badge bg-danger">Overdue</span>
                      <?php }else{ ?>
                        <span class="badge bg-success">In Time</span>
                      <?php } ?>
                    </div>
                    <div class="timeline-body">
                      <div class="card-body p-0">
                        <div class="row">
                          <?php
                            $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM submission_list_lampiranimg WHERE milestone_list_id = '$id'");
                            while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                          ?>
                              <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                                <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">
                              </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    
                    <?php
                      $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM submission_list_lampiranfile WHERE milestone_list_id = '$id'");
                      $cek_lampiranFile = mysqli_num_rows($q_get_lampiran_file);

                      if($cek_lampiranFile > 0){
                    ?>
                        <div class="timeline-body">
                          <div class="card-body p-0">
                            <table class="table table-sm" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="1%">No</th>
                                  <th>Nama File</th>
                                  <th width="8%">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $no=1;
                                  while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                    <td style="font-size: 14px;">
                                      <form id="myForm<?php echo $no; ?>" method="POST" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="nama_file" value="<?php echo $get_lampiran_file['nama_file']; ?>">
                                        <input type="hidden" name="id" value="<?php echo $get_lampiran_file['id']; ?>">
                                        <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                          <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                        </a>
                                      </form>
                                    </td>
                                  </tr>
                                <?php $no++; } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>
          <?php } ?>
            <!----------------------------------- END TIMELINE REVISI ------------------------------------->
            <!----------------------------------- END TIMELINE REVISI ------------------------------------->
            <!----------------------------------- END TIMELINE REVISI ------------------------------------->

            <!-- END timeline item -->
            <div>
              <i class="fas fa-clock bg-gray"></i>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </div>
    <!-- /.timeline -->
  </section>

<!-- ----------------------------------------------------- USER -------------------------------------- -->
<!-- ----------------------------------------------------- USER -------------------------------------- -->
<!-- ----------------------------------------------------- USER -------------------------------------- -->
<?php }else{ ?>
  <section class="content">
    <div class="container-fluid">
      <!-- Timelime example  -->
      <div class="row">
        <div class="col-md-12">
          <!-- The time line -->
          <div class="timeline">
            <!-- timeline item -->
            <div>
              <i class="fas fa-user bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y H:i:s", strtotime($get_milestoneList["created_at"])); ?></span>
                <h3 class="timeline-header"><a href="#">Akbar Kurnia</a> request a task for <a href="#"><?php echo $get_person['nama']; ?></a></h3>
                <div class="timeline-body">
                  <?php echo $get_milestoneList["job_description"]; ?>
                  <br><span class="badge badge-info">Due Date : <?php echo date("d F Y", strtotime($get_milestoneList["due_date"])); ?></span>
                </div>
                <div class="timeline-body">
                  <div class="card-body p-0">
                    <div class="row">
                      <?php
                        $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranimg WHERE milestone_list_id = '$id'");
                        while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                      ?>
                          <div class="col-lg-3 col-2" style="margin-bottom: 10px;">
                            <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">
                          </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                
                <?php
                  $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranfile WHERE milestone_list_id = '$id'");
                  $cek_lampiranFile = mysqli_num_rows($q_get_lampiran_file);

                  if($cek_lampiranFile > 0){
                ?>
                    <div class="timeline-body">
                      <div class="card-body p-0">
                        <table class="table table-sm" style="font-size: 12px;">
                          <thead>
                            <tr>
                              <th width="1%">No</th>
                              <th>Nama File</th>
                              <th width="8%">#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no=1;
                              while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                            ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                <td style="font-size: 14px;">
                                  <form id="myForm<?php echo $no; ?>" method="POST" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="nama_file" value="<?php echo $get_lampiran_file['nama_file']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $get_lampiran_file['id']; ?>">
                                    <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                      <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                    </a>
                                  </form>
                                </td>
                              </tr>
                            <?php $no++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                <?php } ?>

                <?php
                  if($cek_submission < 1){
                ?>
                  <div class="timeline-footer">
                    <center>
                      <a href="index.php?pages=formsubmission&id=<?php echo $id; ?>">
                        <div class="btn btn-success btn-flat">Submit Submission</div>
                      </a>
                    </center>
                  </div>
                <?php } ?>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php if($cek_submission > 0){ ?>
                <div>
                  <i class="fas fa-user bg-green"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y", strtotime($get_submissionList["submitted_at"])); ?></span>
                    <h3 class="timeline-header"><a href="#"><?php echo date("d F Y", strtotime($get_submissionList["submitted_at"])); ?></a> submitted a submission</h3>
                    <div class="timeline-body">
                      <?php echo $get_submissionList['comments']; ?>
                      <br><span class="badge badge-info">Submitted Date : <?php echo date("d F Y", strtotime($get_submissionList["submitted_at"])); ?></span>
                      <?php if($get_submissionList["submitted_at"] > $get_milestoneList['due_date']){ ?>
                        <span class="badge bg-danger">Overdue</span>
                      <?php }else{ ?>
                        <span class="badge bg-success">In Time</span>
                      <?php } ?>
                    </div>
                    <div class="timeline-body">
                      <div class="card-body p-0">
                        <div class="row">
                          <?php
                            $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM submission_list_lampiranimg WHERE milestone_list_id = '$id'");
                            while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                          ?>
                              <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                                <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">
                              </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <?php
                      $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM submission_list_lampiranfile WHERE milestone_list_id = '$id'");
                      $cek_lampiranFile = mysqli_num_rows($q_get_lampiran_file);

                      if($cek_lampiranFile > 0){
                    ?>
                        <div class="timeline-body">
                          <div class="card-body p-0">
                            <table class="table table-sm" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="1%">No</th>
                                  <th>Nama File</th>
                                  <th width="8%">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $no=1;
                                  while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                    <td style="font-size: 14px;">
                                      <form id="myForm<?php echo $no; ?>" method="POST" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="nama_file" value="<?php echo $get_lampiran_file['nama_file']; ?>">
                                        <input type="hidden" name="id" value="<?php echo $get_lampiran_file['id']; ?>">
                                        <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                          <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                        </a>
                                      </form>
                                    </td>
                                  </tr>
                                <?php $no++; } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    <?php } ?>

                    <?php if($cek_milestone_revisi < 1){ ?>
                      <div class="timeline-footer">
                        <center>
                          <a href="index.php?pages=formsubmission&id=<?php echo $id; ?>">
                            <button class="btn btn-secondary">Edit Submission</button>
                          </a>
                        </center>
                      </div>
                    <?php } ?>

                  </div>
                </div>
            <?php } ?>



















            <!-- -------------------------------- TIME LINE REVISI ADMIN ----------------- -->
            <!-- -------------------------------- TIME LINE REVISI ADMIN ----------------- -->
            <!-- -------------------------------- TIME LINE REVISI ADMIN ----------------- -->
            <!-- timeline item -->
          <?php
            $q_get_milestoneRevisi = mysqli_query($conn, "SELECT * FROM milestone_list_revisi WHERE milestone_list_id = '$id'");
            while($get_milestoneRevisi = mysqli_fetch_array($q_get_milestoneRevisi)){
              $q_get_submissionRevisi = mysqli_query($conn, "SELECT * FROM submission_list_revisi WHERE milestone_revisi_id = '$get_milestoneRevisi[id]'");
              $cek_submissionRevisi = mysqli_num_rows($q_get_submissionRevisi);
          ?>
            <div>
              <i class="fas fa-user bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y H:i:s", strtotime($get_milestoneRevisi["created_at"])); ?></span>
                <h3 class="timeline-header"><a href="#">Akbar Kurnia</a> request a revision for <a href="#"><?php echo $get_person['nama']; ?></a></h3>
                <div class="timeline-body">
                  <?php echo $get_milestoneRevisi["comments"]; ?>
                  <br><span class="badge badge-info">Due Date : <?php echo date("d F Y", strtotime($get_milestoneRevisi["due_date"])); ?></span>
                </div>
                <?php if($cek_submission < 1){ ?>
                  <div class="timeline-footer">
                    <a href="index.php?pages=addattachment_milestonelist&id=<?php echo $id; ?>" class="btn btn-primary btn-sm"><span class="fa fa-paperclip"></span> Edit Attachment</a>
                  </div>
                <?php } ?>
                <div class="timeline-body">
                  <div class="card-body p-0">
                    <div class="row">
                      <?php
                        $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM milestone_list_revisi_lampiranimg WHERE milestone_revisi_id = '$get_milestoneRevisi[id]'");
                        while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                      ?>
                          <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                            <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">
                          </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>

                <?php
                  $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM milestone_list_revisi_lampiranfile WHERE milestone_revisi_id = '$get_milestoneRevisi[id]'");
                  $cek_lampiranFile = mysqli_num_rows($q_get_lampiran_file);

                  if($cek_lampiranFile > 0){
                ?>
                    <div class="timeline-body">
                      <div class="card-body p-0">
                        <table class="table table-sm" style="font-size: 12px;">
                          <thead>
                            <tr>
                              <th width="1%">No</th>
                              <th>Nama File</th>
                              <th width="8%">#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no=1;
                              while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                            ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                <td style="font-size: 14px;">
                                  <form id="myForm<?php echo $no; ?>" method="POST" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="nama_file" value="<?php echo $get_lampiran_file['nama_file']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $get_lampiran_file['id']; ?>">
                                    <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                      <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                    </a>
                                  </form>
                                </td>
                              </tr>
                            <?php $no++; } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                <?php } ?>

                <?php if($cek_submissionRevisi < 1){ ?>
                  <div class="timeline-footer" style="text-align: center;">
                    <a href="index.php?pages=formsubmission_revisi&id=<?php echo $id ?>&revid=<?php echo $get_milestoneRevisi['id']; ?>">
                      <div class="btn btn-success btn-flat">Submit Submission</div>
                    </a>
                  </div>
                <?php } ?>

              </div>
            </div>
            <!-- END timeline item ---------------------------------->
            <!-- Timeline Item -------------------------------------->
            <?php
              if($cek_submissionRevisi > 0){
                $get_submissionListRevisi = mysqli_fetch_array();
            ?>
                <div>
                  <i class="fas fa-user bg-green"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> <?php echo date("d F Y", strtotime($get_submissionList["submitted_at"])); ?></span>
                    <h3 class="timeline-header"><a href="#"><?php echo $get_person["nama"]; ?></a> submitted a revision</h3>
                    <div class="timeline-body">
                      <?php echo $get_submissionList['comments']; ?>
                      <br><span class="badge badge-info">Submitted Date : <?php echo date("d F Y", strtotime($get_submissionList["submitted_at"])); ?></span>
                      <?php if($get_submissionList["submitted_at"] > $get_milestoneList['due_date']){ ?>
                        <span class="badge bg-danger">Overdue</span>
                      <?php }else{ ?>
                        <span class="badge bg-success">In Time</span>
                      <?php } ?>
                    </div>
                    <div class="timeline-body">
                      <div class="card-body p-0">
                        <div class="row">
                          <?php
                            $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM submission_list_lampiranimg WHERE milestone_list_id = '$id'");
                            while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                          ?>
                              <div class="col-lg-3 col-6" style="margin-bottom: 10px;">
                                <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">
                              </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    
                    <?php
                      $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM submission_list_lampiranfile WHERE milestone_list_id = '$id'");
                      $cek_lampiranFile = mysqli_num_rows($q_get_lampiran_file);

                      if($cek_lampiranFile > 0){
                    ?>
                        <div class="timeline-body">
                          <div class="card-body p-0">
                            <table class="table table-sm" style="font-size: 12px;">
                              <thead>
                                <tr>
                                  <th width="1%">No</th>
                                  <th>Nama File</th>
                                  <th width="8%">#</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $no=1;
                                  while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                                ?>
                                  <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                                    <td style="font-size: 14px;">
                                      <form id="myForm<?php echo $no; ?>" method="POST" action="" enctype="multipart/form-data">
                                        <input type="hidden" name="nama_file" value="<?php echo $get_lampiran_file['nama_file']; ?>">
                                        <input type="hidden" name="id" value="<?php echo $get_lampiran_file['id']; ?>">
                                        <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                          <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                                        </a>
                                      </form>
                                    </td>
                                  </tr>
                                <?php $no++; } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>
          <?php } ?>
            <!----------------------------------- END TIMELINE REVISI ------------------------------------->
            <!----------------------------------- END TIMELINE REVISI ------------------------------------->
            <!----------------------------------- END TIMELINE REVISI ------------------------------------->
            <!-- END timeline item -->
            <div>
              <i class="fas fa-clock bg-gray"></i>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </div>
    <!-- /.timeline -->
  </section>
<?php } ?>

<div class="loading-overlay" id="loadingOverlay">
  <div class="loading-spinner"></div>
</div>