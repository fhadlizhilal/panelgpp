<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Project</li>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_project' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Project Baru">
                    <span class="fa fa-plus"></span> Tambah Project
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm text-nowrap" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Project</th>
                      <th width="10%">Kota / Lokasi</th>
                      <th width="">HSE OFFicer</th>
                      <th width="5%">Manpower Plan</th>
                      <th width="10%">Jam Kerja</th>
                      <th width="10%">Tgl Start</th>
                      <th width="10%">Tgl End</th>
                      <th width="8%">Status Project</th>
                      <th width="7%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getProject = mysqli_query($conn, "SELECT * FROM hse_project");
                      while($get_Project = mysqli_fetch_array($q_getProject)){
                        $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_Project[hse_officer]'"));
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <a href="index.php?pages=detailproject&kd=<?php echo $get_Project['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Detail Project">
                            <?php echo $get_Project['nama_project']; ?>
                          </a>
                        </td>
                        <td><?php echo $get_Project['kota']; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_handover' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Handover Pekerjaan">
                            <?php echo $get_hseOfficer['nama']; ?>
                          </a>
                        </td>
                        <td><a href="index.php?pages=manpowerplan&kd=<?php echo $get_Project['id']; ?>">8 Data</a></td>
                        <td>
                          <?php echo date("H:i", strtotime($get_Project['jam_masuk']))." - ".date("H:i", strtotime($get_Project['jam_pulang'])); ?>
                        </td>
                        <td>
                          <?php echo $get_Project['tgl_start']; ?>
                        </td>
                        <td>
                          <?php echo $get_Project['tgl_end']; ?>
                        </td>
                        <td align="center" style="font-size: 14px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_statusproject' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Status Project">
                            <?php if($get_Project['status_project'] == "ongoing"){ ?>
                              <span class="badge badge-success">Ongoing</span>
                            <?php }elseif($get_Project['status_project'] == "hold"){ ?>
                              <span class="badge badge-warning">Hold</span>
                            <?php }elseif($get_Project['status_project'] == "closed"){ ?>
                              <span class="badge badge-danger">Closed</span>
                            <?php } ?>
                          </a>
                        </td>
                        <td style="font-size: 14px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_data_project' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_hseproject' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
                          |
                          <a href="#modal" data-toggle='modal' data-target='#show_timelineproject' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Lihat Timeline Project">
                            <span class="fa fa-history"></span>
                          </a>
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

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_data_project" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Project</h4>
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
  <div class="modal fade" id="show_edit_data_project" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Project</h4>
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
  <div class="modal fade" id="show_delete_hseproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data Project</h4>
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
  <div class="modal fade" id="show_timelineproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Timeline Project</h4>
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
  <div class="modal fade" id="show_handover" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Handover Pekerjaan</h4>
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
  <div class="modal fade" id="show_statusproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Status Project</h4>
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