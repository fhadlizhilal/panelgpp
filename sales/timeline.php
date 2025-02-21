<!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?php echo $_POST['getDetail']; ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="row" style="padding-left: 5px; padding-top: 8px;">
      <div class="col-md-12">
        <!-- The time line -->
        <div class="timeline">
          <?php
            require_once "../dev/config.php";
            $data = mysqli_query($conn,"select * from v_activity where kd_forecast = '$_POST[getDetail]' order by kd_activity DESC");
            while($d = mysqli_fetch_array($data)){
              $hari_ini = strtotime(date('d-m-Y'));
              $hari_update = strtotime($d['tgl_update']);
              $jarak = $hari_ini - $hari_update;
              $selisih_hari = $jarak/60/60/24;
          ?>
            <!-- Loop Awal -->
            <!-- timeline time label -->
            <div class="time-label">
              <span class="bg-yellow" style="font-size: 12px;"><?php echo $d['tgl_update']; ?></span>
            </div>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
              <i class="fa fa-angle-double-up bg-blue" style="font-size: 16px;"></i>
              <div class="timeline-item">
                <span class="time" style="font-size: 10px;"><i class="fas fa-clock"></i> <?php echo $selisih_hari; ?> days ago</span>
                <h3 class="timeline-header" style="font-size: 12px;">Status : <a href="#"><?php echo $d['status']; ?></a> <font color="orange">(<?php echo $d['peluang']; ?>%)</font></h3>
                <div class="timeline-body" style="font-size: 12px;">
                  <?php echo $d['keterangan']; ?>
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
              <i class="fa fa-paper-plane-o bg-green" style="font-size: 16px;"></i>
              <div class="timeline-item">
                <h3 class="timeline-header" style="font-size: 12px;">Plan Followup</h3>
                <?php if($d['plan_followup'] != "-"){ ?>
                  <div class="timeline-body" style="font-size: 12px;">
                    <?php echo $d['plan_followup']; ?>
                  </div>
                <?php } ?>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- timeline item -->
            <div>
              <i class="fas fa-ban bg-red" style="font-size: 16px;"></i>
              <div class="timeline-item">
                <h3 class="timeline-header" style="font-size: 12px;">Kendala</h3>
                <?php if($d['kendala'] != "-"){ ?>
                  <div class="timeline-body" style="font-size: 12px;">
                    <?php echo $d['kendala']; ?>
                  </div>
                <?php } ?>
              </div>
            </div>
            <!-- END timeline item -->
            <!-- Loop Akhir -->
          <?php } ?>
          <div>
            <i class="fas fa-clock bg-gray"></i>
          </div>
        </div>
      </div>
      <!-- /.col -->
    </div>
  </div>
<!-- END general form elements -->