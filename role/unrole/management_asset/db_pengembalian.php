<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Database Pengembalian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Pengembalian</li>
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
                      <th width="12%">No Pengembalian</th>
                      <th>Project</th>
                      <th width="12%">Penanggung Jawab</th>
                      <th width="1%">Entitas</th>
                      <th width="8%">Tanggal</th>
                      <th width="1%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_pengembalian = mysqli_query($conn, "SELECT * FROM asset_pengembalian ORDER BY id DESC");
                      while($get_pengembalian = mysqli_fetch_array($q_get_pengembalian)){
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_pengembalian[kd_project]'"));
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengembalian[penanggungjawab]'"));
                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengembalian[entitas_id]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_lihat_pengembalian' data-id='<?php echo $get_pengembalian['id'] ?>' data-toggle="tooltip" data-placement="bottom" title="Lihat Pengembalian">
                            <?php echo "RTN".$get_pengembalian['id']."/MA/".date("d/Y", strtotime($get_pengembalian['tanggal'])); ?>
                          </a>
                        </td>
                        <td><?php echo $get_project['kd_project']." - ".$get_project["nm_project"] ?></td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td><?php echo $get_entitas['entitas']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($get_pengembalian['tanggal'])); ?></td>
                        <td>
                          <?php if($get_pengembalian['status'] == "waiting for approval"){ ?>
                            <span class="badge badge-warning">waiting for approval</span>
                          <?php }elseif($get_pengembalian['status'] == "BA approved"){ ?>
                            <span class="badge badge-success">BA approved</span>
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

 <!-- Modal start here -->
  <div class="modal fade" id="show_lihat_pengembalian" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pengembalian</h4>
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

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>