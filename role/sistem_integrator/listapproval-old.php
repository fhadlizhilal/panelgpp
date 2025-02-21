<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Approval Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Approval Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="float: right;"><a href="#modal" data-toggle='modal' data-target='#show_add_list' data-id='<?php echo $_SESSION['nik']; ?>'><span class="fa fa-plus"></span> Tambah Project</a></h3>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table class="table table-bordered" style="font-size: 12px; background-color: #f5f5f5;">
                  <thead>
                    <tr style="text-align: center;">
                      <th width="1%">No</th>
                      <th width="48%">Nama Project</th>
                      <th width="22%">Initiate</th>
                      <th>Pimpro</th>
                      <th width="10%">Created at</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                      $q_approval_list = mysqli_query($conn, "SELECT * FROM v_approval_list ORDER BY created_at DESC");

                      if(mysqli_num_rows($q_approval_list) > 0){
                        $i = 0;
                        while($get_approval_list = mysqli_fetch_array($q_approval_list)){
                        $i++;
                    ?>

                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $get_approval_list['nama_project']; ?></td>
                          <td><?php echo $get_approval_list['nama']; ?></td>
                          <td align="center">
                            <?php
                              if($get_approval_list['pimpro'] == NULL){
                                  echo "<span class='badge badge-secondary'>belum diset</span>";
                              }else{
                                $q_getNamaKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_approval_list[pimpro]'");
                                $get_NamaKaryawan = mysqli_fetch_array($q_getNamaKaryawan);
                                echo $get_NamaKaryawan['nama'];
                              }
                            ?>  
                          </td>
                          <td><?php echo date('d-m-Y',strtotime($get_approval_list['created_at'])); ?></td>
                        </tr>
                        <tr class="expandable-body">
                          <td colspan="5">

                            <!-- /.card -->
                            <div class="card">
                              <!-- <div class="card-header">
                                <h3 class="card-title" style="float: right;">
                                  <a href="#modal" data-toggle='modal' data-target='#show_upload_file' data-id='<?php echo $get_approval_list['id']; ?>'>
                                    <small><span class="fa fa-upload"></span> Upload File</small>
                                  </a>
                                </h3>
                              </div> -->
                              <div class="card-body p-0">
                                <table class="table table-sm">
                                  <thead>
                                    <tr style="text-align: center;">
                                      <th style="vertical-align: middle;">File Name </th>
                                      <th width="20%" style="vertical-align: middle;">Uploader</th>
                                      <th width="9%" style="vertical-align: middle;"><small><b>Checked by Pimpro</b></small></th>
                                      <th width="9%" style="vertical-align: middle;"><small><b>Approved by PM</b></small></th>
                                      <th width="1%" style="vertical-align: middle;"><small><b>Action</b></small></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                      $q_approval_file = mysqli_query($conn, "SELECT * FROM approval_file WHERE approval_list_id = '$get_approval_list[id]'");
                                      $count_approval_file = mysqli_num_rows($q_approval_file);
                                      if($count_approval_file > 0){
                                        while($get_approval_file = mysqli_fetch_array($q_approval_file)){
                                          $get_uploader = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_approval_file[uploader]'"));
                                    ?>

                                          <tr>
                                            <td>
                                              <a href="#modal" data-toggle='modal' data-target='#show_file' data-id='<?php echo $get_approval_file['id']; ?>'>
                                                <?php echo $get_approval_file['nama_file']; ?>
                                              </a>    
                                            </td>
                                            <td><?php echo $get_uploader['nama']; ?></td>
                                            <td align="center">
                                              <?php if($get_approval_file['pimpro_status'] == ""){ ?>
                                                <span class="badge bg-secondary">waiting..</span>
                                              <?php }else if($get_approval_file['pimpro_status'] == "checked"){ ?>
                                                <span class="badge bg-success">Checked</span>
                                              <?php }else{ ?>
                                                <span class="badge bg-danger">Rejected</span>
                                              <?php } ?>
                                              
                                            </td>
                                            <td align="center">
                                             <?php if($get_approval_file['PM_status'] == ""){ ?>
                                                <span class="badge bg-secondary">waiting..</span>
                                              <?php }else if($get_approval_file['PM_status'] == "approved"){ ?>
                                                <span class="badge bg-success">Approved</span>
                                              <?php }else{ ?>
                                                <span class="badge bg-danger">Rejected</span>
                                              <?php } ?>
                                             
                                            </td>
                                            <td align="center">
                                              <?php if($get_approval_list['pimpro'] == $_SESSION['nik']){ ?>
                                                <a href="#modal" data-toggle='modal' data-target='#show_action' data-id='<?php echo $get_approval_file['id']; ?>' class="btn btn-block bg-gradient-info btn-sm" style="font-size: 10px; font-weight: bold;">F/U</a>
                                              <?php }else{ ?>
                                                <button class="btn btn-block bg-gradient-info btn-sm disabled" style="font-size: 10px; font-weight: bold;">F/U</button>
                                              <?php } ?>
                                            </td>
                                          </tr>

                                    <?php 
                                        }
                                      }else{
                                    ?>
                                          <tr style="background-color: white;">
                                            <td colspan="5" style="text-align: center;"><i>belum ada file approval</i></td>
                                          </tr>
                                    <?php } ?>

                                  </tbody>
                                </table>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                          </td>
                        </tr>

                    <?php 
                        }
                      }else{ 
                    ?>

                    <tr style="background-color: white;">
                      <td colspan="5" style="text-align: center;"><i>belum ada data approval</i></td>
                    </tr>

                    <?php } ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal start here -->
  <div class="modal fade" id="show_add_list" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Add Approval Project</h4>
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
  <div class="modal fade" id="show_upload_file" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Upload File Approval</h4>
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
  <div class="modal fade" id="show_file" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">File Approval</h4>
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
  <div class="modal fade" id="show_action" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Approved / Reject</h4>
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

  <?php
    function getNamaKaryawan($nik){
      $q_getNamaKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$nik'");
      $get_NamaKaryawan = mysqli_fetch_array($q_getNamaKaryawan);

      return $get_NamaKaryawan['nama'];
    }
  ?>