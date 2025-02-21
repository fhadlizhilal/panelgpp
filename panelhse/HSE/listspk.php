<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Induction</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Induction & SPK</li>
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
              <div class="card-header">
                <h3 class="card-title float-sm-right" style="font-size: 12px;">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_list_induction' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Induction Baru">
                    <span class="fa fa-plus"></span> Tambah Induction
                  </a>
                </h3>
              </div>
              
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm text-nowrap" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Project</th>
                      <th width="8%">HSE OFFicer</th>
                      <th width="7%">Tanggal</th>
                      <th width="10%">Tampat</th>
                      <th width="5%">Data SPK</th>
                      <th width="5%">Status</th>
                      <th width="5%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_getListInduction = mysqli_query($conn, "SELECT * FROM hse_project JOIN hse_inductionreport ON hse_inductionreport.project_id = hse_project.id WHERE hse_inductionreport.hse_officer = '$_SESSION[manpower_id]' AND hse_project.status_project = 'ongoing'");
                      while($get_listInduction = mysqli_fetch_array($q_getListInduction)){
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_listInduction[project_id]'"));
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_listInduction[hse_officer]'"));
                        $sum_data_spk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inductionreport_spk WHERE induction_id = '$get_listInduction[id]'"));
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_project['nama_project']; ?></td>
                          <td><?php echo $get_manpower['nama']; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($get_listInduction['tanggal'])); ?></td>
                          <td><?php echo $get_listInduction['tempat']; ?></td>
                          <td align="center">
                            <a href="#modal" data-toggle='modal' data-target='#show_data_spk' data-id='<?php echo $get_listInduction['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Status">
                              <?php echo $sum_data_spk." Data"; ?>
                            </a>
                          </td>
                          <td align="center">
                            <?php if($get_listInduction['status'] == "open"){ ?>
                              <a href="#modal" data-toggle='modal' data-target='#show_edit_status_linkspk' data-id='<?php echo $get_listInduction['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Status">
                                <span class="badge badge-success">OPEN</span>
                              </a>
                            <?php }elseif($get_listInduction['status'] == "closed"){ ?>
                              <a href="#modal" data-toggle='modal' data-target='#show_edit_status_linkspk' data-id='<?php echo $get_listInduction['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Status">
                                <span class="badge badge-danger">CLOSED</span>
                              </a>
                            <?php }else{ echo "ERROR"; } ?>
                          </td>
                          <td>
                            <a href="../SPK/index.php?pages=ceknik&spkid=<?php echo $get_listInduction['id']; ?>" title="Link SPK" target="_blank"><span class="fa fa-external-link"></span> Link SPk</a> |
                            <a href="#modal" data-toggle='modal' data-target='#show_delete_list_induction' data-id='<?php echo $get_listInduction['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete">
                              <span class="fa fa-trash"> Delete</span>
                            <!-- </a> -->
                          </td>
                        </tr>
                    <?php } ?>
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

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_list_induction" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah List Induction</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" method="POST" action="" enctype="multipart/form-data">
            <div class="modal-data"></div>
            <input id="submitBtn" type="submit" class="btn btn-primary btn-sm" name="submit_add_list_induction" value="Simpan">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_delete_list_induction" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete List Induction</h4>
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
  <div class="modal fade" id="show_edit_status_linkspk" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Status</h4>
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
  <div class="modal fade" id="show_data_spk" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">List Data SPK</h4>
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