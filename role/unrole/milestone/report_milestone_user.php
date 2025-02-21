<?php
  $dateend = date("Y-m-d H:i:s",strtotime($_GET['dateend']." 23:59:59"));

  if(isset($_GET['datestart'])){
    $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail JOIN milestone_list ON milestone_list_detail.milestone_id = milestone_list.id WHERE milestone_list.person = '$_SESSION[nik]' AND milestone_list_detail.due_date >= '$_GET[datestart]' AND milestone_list_detail.due_date <= '$dateend' ORDER BY milestone_list_detail.id DESC");
  }else{
    $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail JOIN milestone_list ON milestone_list_detail.milestone_id = milestone_list.id WHERE milestone_list.person = '$_SESSION[nik]' ORDER BY milestone_list_detail.id DESC");
  }

  $jml_task = mysqli_num_rows($q_get_milestone_detail);
  $jml_intime = 0;
  $jml_overdue = 0;
  $jml_waiting = 0;
  while($get_milestone_detail = mysqli_fetch_array($q_get_milestone_detail)){
    $q_get_submission = mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_detail_id = '$get_milestone_detail[id]'");
    $cek_submission = mysqli_num_rows($q_get_submission);
    $get_submission = mysqli_fetch_array($q_get_submission);
    
    if($cek_submission > 0){
      if($get_submission['submitted_at'] > $get_milestone_detail['due_date']){
        $jml_overdue = $jml_overdue + 1;
      }else{
        $jml_intime = $jml_intime + 1;
      }
    }else{
      $jml_waiting = $jml_waiting + 1;
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
            <h1>Report Milestone</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Milestone</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="card">
              <div class="card-body" style="margin-top: -8px">
                <center><h5>Filter Data</h5></center>
                <form method="GET" action="">                  
                  <div class="row" style="margin-bottom: 10px;">
                    <div class="col-6">
                      <label style="font-size: 12px;">Due Date Start</label>
                      <input type="date" name="datestart" class="form-control form-control-sm" value="<?php echo $_GET['datestart'] ?>" required>
                    </div>
                    <div class="col-6">
                      <label style="font-size: 12px;">Due Date End</label>
                      <input type="date" name="dateend" class="form-control form-control-sm" value="<?php echo $_GET['dateend'] ?>" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <input type="hidden" name="pages" value="reportmilestone">
                      <button type="submit" class="btn btn-success" style="width: 100%">
                        <span class="fa fa-search"></span> Show
                      </button>
                    </div>
                    <div class="col-6">
                      <a href="index.php?pages=reportmilestone">
                        <div class="btn btn-danger" style="width: 100%">
                          <span class="fa fa-close"></span> Reset Filter
                        </div>
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-8">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3><?php echo $jml_task; ?></h3>
                        <p>Total Task</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-file-text" style="font-size: 40px"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3><?php echo $jml_intime; ?></h3>
                        <p>In Time</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-check" style="font-size: 40px"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3><?php echo $jml_overdue; ?></h3>
                        <p>Overdue</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-close" style="font-size: 40px"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                      <div class="inner">
                        <h3><?php echo $jml_waiting; ?></h3>
                        <p>Waiting</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-clock-o" style="font-size: 40px"></i>
                      </div>
                    </div>
                  </div>
                </div>
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
              <div class="card-body">
                <table id="setHariLibur1" class="table table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Job Description</th>
                      <th width="15%">Person</th>
                      <th width="12%">Due Date</th>
                      <th width="12%">Submitted at</th>
                      <th width="1%">Submission</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      if(isset($_GET['datestart'])){
                        $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail JOIN milestone_list ON milestone_list_detail.milestone_id = milestone_list.id WHERE milestone_list.person = '$_SESSION[nik]' AND milestone_list_detail.due_date >= '$_GET[datestart]' AND milestone_list_detail.due_date <= '$dateend' ORDER BY milestone_list_detail.id DESC");
                      }else{
                        $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail JOIN milestone_list ON milestone_list_detail.milestone_id = milestone_list.id WHERE milestone_list.person = '$_SESSION[nik]' ORDER BY milestone_list_detail.id DESC");
                      }
                      
                      
                      while($get_milestone_detail = mysqli_fetch_array($q_get_milestone_detail)){
                        $get_milestone = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM milestone_list WHERE id = '$get_milestone_detail[milestone_id]'"));
                        $get_person = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_milestone[person]'"));

                        $q_get_submission = mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_detail_id = '$get_milestone_detail[id]'");
                        $cek_submission = mysqli_num_rows($q_get_submission);
                        $get_submission = mysqli_fetch_array($q_get_submission);
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_milestone_detail['job_description']; ?></td>
                        <td><?php echo $get_person['nama']; ?></td>
                        <td><?php echo date("d-m-Y H:i", strtotime($get_milestone_detail['due_date'])); ?></td>
                        <td><?php echo date("d-m-Y H:i", strtotime($get_submission['submitted_at'])); ?></td>
                        <td>
                          <?php if($cek_submission < 1){ ?>
                            <span class="badge badge-secondary">waiting for submission</span>
                          <?php }elseif($get_submission['submitted_at'] > $get_milestone_detail['due_date']){ ?>
                            <span class="badge badge-danger">Overdue</span>
                          <?php }else{ ?>
                            <span class="badge badge-success">In Time</span>
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


      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>