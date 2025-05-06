<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Report - Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Project</li>
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
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th>Project</th>
                      <th width="9%">Peminjaman</th>
                      <th width="9%">Pengajuan</th>
                      <th width="9%">Surat Jalan</th>
                      <th width="9%">Pengembalian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      // $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_project IN (SELECT kd_project FROM asset_peminjaman WHERE status = 'waiting for MA' OR status = 'on progress by MA' OR status = 'completed') ORDER BY id DESC");
                      $q_get_project = mysqli_query($conn, "SELECT * FROM project ORDER BY id DESC");
                      while($get_project = mysqli_fetch_array($q_get_project)){
                       $jml_peminjaman = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE kd_project = '$get_project[kd_project]'"));

                       $jml_pengajuan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE kd_project = '$get_project[kd_project]'"));

                       $jml_suratjalan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_suratjalan JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE asset_peminjaman.kd_project = '$get_project[kd_project]'"));

                       $jml_pengembalian = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_pengembalian WHERE kd_project = '$get_project[kd_project]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="index.php?pages=reportprojectdetail&kd=<?php echo $get_project['kd_project']; ?>">
                          <?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?>
                        </td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_list_peminjaman' data-id='<?php echo $get_project['kd_project']; ?>' data-toggle="tooltip" data-placement="bottom" title="Show List Peminjaman">
                            <?php echo $jml_peminjaman; ?> Peminjaman
                          </a>
                        </td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_list_pengajuan' data-id='<?php echo $get_project['kd_project']; ?>' data-toggle="tooltip" data-placement="bottom" title="Show List Pengajuan">
                            <?php echo $jml_pengajuan; ?> Pengajuan
                          </a>
                        </td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_list_suratjalan' data-id='<?php echo $get_project['kd_project']; ?>' data-toggle="tooltip" data-placement="bottom" title="Show List Surat Jalan">
                            <?php echo $jml_suratjalan; ?> Surat Jalan
                          </a>
                        </td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_list_pengembalian' data-id='<?php echo $get_project['kd_project']; ?>' data-toggle="tooltip" data-placement="bottom" title="Show List Pengembalian">
                            <?php echo $jml_pengembalian; ?> Pengembalian
                          </a>
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

  <!-- Modal start here -->
  <div class="modal fade" id="show_list_peminjaman" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">List Peminjaman</h4>
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
  <div class="modal fade" id="show_list_pengajuan" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">List Pengajuan</h4>
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
  <div class="modal fade" id="show_list_suratjalan" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">List Surat Jalan</h4>
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
  <div class="modal fade" id="show_list_pengembalian" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">List Pengembalian</h4>
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