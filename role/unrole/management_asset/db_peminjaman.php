<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Database Peminjaman</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Peminjaman</li>
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
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="10%">Kode Pinjam</th>
                      <th width="">Jenis</th>
                      <th width="">Peminjam</th>
                      <th width="">Project</th>
                      <th width="">Keterangan</th>
                      <th width="15%">Tgl Pinjam</th>
                      <th width="">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_peminjaman = mysqli_query($conn, "SELECT * FROM asset_peminjaman ORDER BY id ASC");
                      while($get_peminjaman = mysqli_fetch_array($q_get_peminjaman)){
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_peminjamansaya' data-id='<?php echo $get_peminjaman['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Peminjaman">
                            <b>
                              <?php echo $get_peminjaman['id']."/MA/".date('m/Y', strtotime($get_peminjaman['tgl_pinjam'])); ?>  
                            </b>
                          </a>
                        </td>
                        <td>
                          <?php if($get_peminjaman['jenis'] == "tools"){ ?>
                            <span class="badge badge-info">Tools</span>
                          <?php }elseif($get_peminjaman['jenis'] == "apd"){ ?>
                            <span class="badge badge-success">APD</span>
                          <?php }elseif($get_peminjaman['jenis'] == "inventaris"){ ?>
                            <span class="badge badge-warning">Inventaris</span>
                          <?php }elseif($get_peminjaman['jenis'] == "alat ukur"){ ?>
                            <span class="badge badge-danger">Alat Ukur</span>
                          <?php } ?>
                        </td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td><?php echo $get_peminjaman['kd_project']." - ".$get_project['nm_project']; ?></td>
                        <td><?php echo $get_peminjaman['keterangan']; ?></td>
                        <td><?php echo date("d F Y H:i", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
                        <td>
                          <?php if($get_peminjaman['status'] == "waiting for MA"){ ?>
                            <span class="badge badge-secondary">Waiting for MA</span>
                          <?php }elseif($get_peminjaman['status'] == "on progress by MA"){ ?>
                            <span class="badge badge-warning">On Progress by MA</span>
                          <?php }elseif($get_peminjaman['status'] == "rejected by MA"){ ?>
                            <span class="badge badge-danger">Rejected by MA</span>
                          <?php }elseif($get_peminjaman['status'] == "canceled by user"){ ?>
                            <span class="badge badge-danger">Canceled by User</span>
                          <?php }elseif($get_peminjaman['status'] == "completed"){ ?>
                            <span class="badge badge-success">Completed</span>
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
  <div class="modal fade" id="show_detail_peminjamansaya" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Peminjaman</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myForm" method="POST" action="">
            <div class="modal-data"></div>
          </form>
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