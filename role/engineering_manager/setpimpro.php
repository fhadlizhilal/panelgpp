<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Set Pimpro</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Set Pimpro</li>
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
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th>Nama Project</th>
                      <th>Initiate</th>
                      <th>Pimpro</th>
                      <th width="10%" style="text-align: center;">Created at</th>
                      <th width="5%" style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                      $q_approval_list = mysqli_query($conn, "SELECT * FROM v_approval_list");
                      if(mysqli_num_rows($q_approval_list) > 0){
                        $i = 0;
                        while($get_approval_list = mysqli_fetch_array($q_approval_list)){
                          $i++;
                    ?>

                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $get_approval_list['nama_project']; ?></td>
                            <td><?php echo $get_approval_list['nama']; ?></td>
                            <td>
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
                            <td><?php echo $get_approval_list['created_at']; ?></td>
                            <td style="text-align: center; font-size: 12px;"><a href="#modal" data-toggle='modal' data-target='#show_setpimpro' data-id='<?php echo $get_approval_list['id']; ?>' class="btn btn-xs bg-gradient-primary">Pilih Pimpro</a></td>
                          </tr>

                    <?php
                        }
                      }else{
                    ?>
                          <tr style="background-color: white;">
                            <td colspan="6" style="text-align: center;"><i>belum ada data approval</i></td>
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
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_setpimpro" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Set Pimpro</h4>
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
    
  ?>