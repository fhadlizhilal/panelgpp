<?php
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
      $id = $_POST['getID'];
      $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$id'"));
  }
?>

<!-- Timelime example  -->
  <div class="row">
    <div class="col-md-12">
      <!-- The time line -->
      <div class="timeline">
        <?php
          $q_get_projectLog = mysqli_query($conn, "SELECT * FROM hse_project_log WHERE hse_projectid = '$id' ORDER BY id DESC");
          while($get_projectLog = mysqli_fetch_array($q_get_projectLog)){

            if($get_projectLog['status_log'] == "edited"){
        ?>
              <!-- timeline item -->
              <div>
                <i class="fas fa-edit bg-yellow"></i>
                <div class="timeline-item">
                  <span class="time" style="font-size: 10px;"><i class="fas fa-calendar"></i> <?php echo date("d-m-Y H:i:s",strtotime($get_projectLog['created_at'])); ?></span>
                  <h3 class="timeline-header"><a href="#">Project Diubah</a></h3>

                  <div class="timeline-body" style="font-size: 10px;">
                    <?php echo $get_projectLog['keterangan']; ?>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
          <?php }elseif($get_projectLog['status_log'] == "created"){ ?>
              <!-- timeline item -->
              <div>
                <i class="fas fa-check bg-green"></i>
                <div class="timeline-item">
                  <span class="time" style="font-size: 10px;"><i class="fas fa-calendar"></i> <?php echo date("d-m-Y H:i:s",strtotime($get_projectLog['created_at'])); ?></span>
                  <h3 class="timeline-header"><a href="#"><?php echo $get_projectLog['keterangan']; ?></a></h3>
                </div>
              </div>
              <!-- END timeline item -->
          <?php }elseif($get_projectLog['status_log'] == "handover"){ ?>
            <!-- timeline item -->
              <div>
                <i class="fas fa-group bg-purple"></i>
                <div class="timeline-item">
                  <span class="time" style="font-size: 10px;"><i class="fas fa-calendar"></i> <?php echo date("d-m-Y H:i:s",strtotime($get_projectLog['created_at'])); ?></span>
                  <h3 class="timeline-header"><a href="#">Handover</a></h3>

                  <div class="timeline-body" style="font-size: 10px;">
                    <?php echo $get_projectLog['keterangan']; ?>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
        <?php } } ?>
        <div>
          <i class="fas fa-clock bg-gray"></i>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </div>
<!-- /.timeline -->