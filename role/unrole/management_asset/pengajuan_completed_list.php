<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Pengajuan Sudah Realisasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengajuan Sudah Realisasi</li>
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
                      <th width="10%">No Pengajuan</th>
                      <th width="1%">Jenis</th>
                      <th>Entitas</th>
                      <th width="12%">Pelaksana</th>
                      <th>Project</th>
                      <th width="13%">Tanggal Pengajuan</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_pengajuan = mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE status = 'sudah realisasi' ORDER BY id DESC");
                      while($get_pengajuan = mysqli_fetch_array($q_get_pengajuan)){
                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengajuan[entitas_id]'"));
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengajuan[pelaksana]'"));
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_pengajuan[kd_project]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" style="font-weight: bold;" data-toggle='modal' data-target='#show_realisasi_asset' data-id='<?php echo $get_pengajuan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Realisasi">
                            <?php echo "PN".$get_pengajuan['id']."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?>
                          </a>
                        </td>
                        <td>
                          <?php if($get_pengajuan['jenis'] == "tools"){ ?>
                            <span class="badge badge-info">Tools</span>
                          <?php }elseif($get_pengajuan['jenis'] == "apd"){ ?>
                            <span class="badge badge-success">APD</span>
                          <?php }elseif($get_pengajuan['jenis'] == "inventaris"){ ?>
                            <span class="badge badge-warning">Inventaris</span>
                          <?php }elseif($get_pengajuan['jenis'] == "alat ukur"){ ?>
                            <span class="badge badge-danger">Alat Ukur</span>
                          <?php } ?>
                        </td>
                        <td><?php echo $get_entitas['entitas']; ?></td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td>
                          <?php
                            if($get_project['nm_project'] == NULL){
                              echo "Non Project";
                            }else{
                              echo $get_pengajuan['kd_project']." - ".$get_project['nm_project'];
                            }
                          ?> 
                        </td>
                        <td><?php echo date("d F Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></td>
                        <td><?php echo $get_pengajuan['keterangan']; ?></td>
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
  <div class="modal fade" id="show_realisasi_asset" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
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