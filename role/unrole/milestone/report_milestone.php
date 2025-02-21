<?php
  $dateend = date("Y-m-d H:i:s",strtotime($_GET['dateend']." 23:59:59"));
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
              <div class="card-body">
                <center><h5>Filter Data</h5></center>
                <form method="GET" action="">
                  <label style="font-size: 12px;">Person</label>
                  <select class="form-control form-control-sm" name="person">
                    <option value="all" selected>All Person</option>
                    <?php
                      $q_get_person = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama = 'Hikmah Permana' OR nama = 'Janu Abdu Rohman' OR nama = 'Gilvan Achmad Maulana Azhar' OR nama = 'Eldy Darmawan Sendy Pratama' OR nama = 'Rai Purnama Rizki' OR nama = 'Novandy Iqbal Fadhillah' OR nama = 'Mimi Rohimi' OR nama = 'Yusaribah Haliza' OR nama = 'Zidan Muhamad Fajar' ORDER BY nama ASC");
                      
                      while($get_person = mysqli_fetch_array($q_get_person)){
                    ?>
                        <option value="<?php echo $get_person['nik']; ?>" <?php if($_GET['person'] == $get_person['nik']){ echo "selected"; } ?>><?php echo $get_person['nama']; ?></option>
                    <?php } ?>
                  </select>
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
                <table id="" class="table table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Person</th>
                      <th width="10%">Total Task</th>
                      <th width="10%">In Time</th>
                      <th width="10%">Overdue</th>
                      <th width="10%">Waiting for Submission</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      if(isset($_GET['person']) AND $_GET['person'] != "all"){
                        $q_get_person = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_GET[person]' ORDER BY nama ASC");
                      }elseif(isset($_GET['person']) AND $_GET['person'] == "all"){
                        $q_get_person = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama = 'Hikmah Permana' OR nama = 'Janu Abdu Rohman' OR nama = 'Gilvan Achmad Maulana Azhar' OR nama = 'Eldy Darmawan Sendy Pratama' OR nama = 'Rai Purnama Rizki' OR nama = 'Novandy Iqbal Fadhillah' OR nama = 'Mimi Rohimi' OR nama = 'Yusaribah Haliza' OR nama = 'Zidan Muhamad Fajar' ORDER BY nama ASC");
                      }else{
                        $q_get_person = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama = 'Hikmah Permana' OR nama = 'Janu Abdu Rohman' OR nama = 'Gilvan Achmad Maulana Azhar' OR nama = 'Eldy Darmawan Sendy Pratama' OR nama = 'Rai Purnama Rizki' OR nama = 'Novandy Iqbal Fadhillah' OR nama = 'Mimi Rohimi' OR nama = 'Yusaribah Haliza' OR nama = 'Zidan Muhamad Fajar' ORDER BY nama ASC");
                      }
                      while($get_person = mysqli_fetch_array($q_get_person)){
                        $total_task = 0;
                        $total_intime = 0;
                        $total_overdue = 0;
                        $total_waiting = 0;

                        $q_get_milestone = mysqli_query($conn, "SELECT * FROM milestone_list WHERE person = '$get_person[nik]'");
                        while($get_milestone = mysqli_fetch_array($q_get_milestone)){

                          if(isset($_GET['person'])){
                            $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE milestone_id = '$get_milestone[id]' AND due_date >= '$_GET[datestart]' AND due_date <= '$dateend'");
                            $jml_task = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE milestone_id = '$get_milestone[id]' AND due_date >= '$_GET[datestart]' AND due_date <= '$dateend'"));
                          }else{
                            $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE milestone_id = '$get_milestone[id]'");
                            $jml_task = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE milestone_id = '$get_milestone[id]'"));
                          }

                          $total_task = $total_task + $jml_task;
                          
                          while($get_milestone_detail = mysqli_fetch_array($q_get_milestone_detail)){
                            $cek_submission = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_detail_id = '$get_milestone_detail[id]'"));
                            $get_submission = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM submission_list WHERE milestone_detail_id = '$get_milestone_detail[id]'"));

                            if($cek_submission < 1){
                              $total_waiting = $total_waiting + 1;
                            }elseif($get_submission['submitted_at'] > $get_milestone_detail['due_date']){
                              $total_overdue = $total_overdue + 1;
                            }else{
                              $total_intime = $total_intime + 1;
                            }
                            

                          }
                        }
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_person['nama']; ?></td>
                          <td align="center"><b><?php echo $total_task; ?></b></td>
                          <td align="center"><?php echo $total_intime; ?></td>
                          <td align="center"><?php echo $total_overdue; ?></td>
                          <td align="center"><?php echo $total_waiting; ?></td>
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
                      if(isset($_GET['person']) AND $_GET['person'] != "all"){
                        $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail JOIN milestone_list ON milestone_list_detail.milestone_id = milestone_list.id WHERE milestone_list.person = '$_GET[person]' AND milestone_list_detail.due_date >= '$_GET[datestart]' AND milestone_list_detail.due_date <= '$dateend' ORDER BY milestone_list_detail.id DESC");
                      }elseif(isset($_GET['person']) AND $_GET['person'] == "all"){
                        $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE due_date >= '$_GET[datestart]' AND due_date <= '$dateend' ORDER BY id DESC");
                      }else{
                        $q_get_milestone_detail = mysqli_query($conn, "SELECT * FROM milestone_list_detail ORDER BY id DESC");
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