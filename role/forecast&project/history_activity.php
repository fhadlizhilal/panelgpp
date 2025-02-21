<?php 
  if(isset($_POST['getID'])){
    $id = $_POST['getID'];       
    require_once "../../dev/config.php";       
?>

 <!-- Main content -->
    <section class="content">
      <div class="card card-primary" style="font-size: 12px;">
        <div class="card-header">
          <h2 class="card-title" style="font-size: 14px;"><b>Kode Forecast : </b><?php echo $id; ?></h2>
        </div>

        <!-- Timelime example  -->
        <div class="row" style="padding-left: 5px; padding-top: 8px;">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <?php
                $data = mysqli_query($conn,"select * from v_activity where kd_forecast = '$id' order by kd_activity DESC");
                while($d = mysqli_fetch_array($data)){
                  $hari_ini = strtotime(date('d-m-Y'));
                  $hari_update = strtotime($d['tgl_update']);
                  $jarak = $hari_ini - $hari_update;
                  $selisih_hari = $jarak/60/60/24;

                  if($d['threshold'] == "-1" AND $d['keterangan'] == "New Forecast Created"){
              ?>
                    <!-- Awal Loop -->
                    <!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-yellow"><?php echo date('d-m-Y',strtotime($d['tgl_update'])); ?></span>
                    </div>
                    <div>
                      <i class="fa fa-angle-double-right bg-blue" style="font-size: 16px;"></i>
                      <div class="timeline-item">
                        <span class="time" style="font-size: 10px;"><i class="fas fa-clock"></i> <?php echo $selisih_hari; ?> days ago</span>
                        <h3 class="timeline-header" style="font-size: 12px;"><?php echo $d['keterangan']; ?></h3>
                      </div>
                    </div>
                    <!-- END timeline item -->

                <?php }elseif($d['threshold'] == "-" AND $d['keterangan'] == "To Project"){ ?>

                    <!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-yellow"><?php echo date('d-m-Y',strtotime($d['tgl_update'])); ?></span>
                    </div>
                    <div>
                      <i class="fa fa-check bg-green" style="font-size: 16px;"></i>
                      <div class="timeline-item">
                        <span class="time" style="font-size: 10px;"><i class="fas fa-clock"></i> <?php echo $selisih_hari; ?> days ago</span>
                        <h3 class="timeline-header" style="font-size: 12px;">Status : <a href="#"><?php echo $d['status']; ?></a> <font color="orange">(<?php echo $d['peluang']; ?>)</font></h3>
                        <div class="timeline-body" style="font-size: 12px;">
                          <?php echo $d['keterangan']; ?>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->

                <?php }else{ ?>
                    
                    <!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-yellow"><?php echo date('d-m-Y',strtotime($d['tgl_update'])); ?></span>
                    </div>
                    <div>
                      <i class="fa fa-angle-double-up bg-blue" style="font-size: 16px;"></i>
                      <div class="timeline-item">
                        <span class="time" style="font-size: 10px;"><i class="fas fa-clock"></i> <?php echo $selisih_hari; ?> days ago</span>
                        <h3 class="timeline-header" style="font-size: 12px;">Status : <a href="#"><?php echo $d['status']; ?></a> <font color="orange">(<?php echo $d['peluang']; ?>)</font></h3>
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
                    <!-- Akhir Loop -->
              <?php
                  }
                } 
              ?>
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
    <!-- /.content -->

<?php } ?>