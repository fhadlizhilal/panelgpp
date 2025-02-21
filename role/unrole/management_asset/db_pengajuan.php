<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Database Pengajuan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Pengajuan</li>
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
              <?php if($_SESSION['role'] == "management_asset"){ ?>
                <div class="card-header">
                  <h3 class="card-title float-sm-right" style="font-size: 12px;">
                    <a href="index.php?pages=pilihformpengajuan">
                      <span class="fa fa-plus"></span> Tambah Pengajuan Baru
                    </a>
                  </h3>
                </div>
              <?php } ?>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="10%">No Pengajuan</th>
                      <th width="1%">Jenis</th>
                      <th width="1%">Entitas</th>
                      <th width="8%">Pelaksana</th>
                      <th>Project</th>
                      <th width="1%">Tgl Pengajuan</th>
                      <th width="1%">Tgl Realisasi</th>
                      <th>Keterangan</th>
                      <th width="1%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_pengajuan = mysqli_query($conn, "SELECT * FROM asset_pengajuan ORDER BY id DESC");
                      while($get_pengajuan = mysqli_fetch_array($q_get_pengajuan)){
                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengajuan[entitas_id]'"));
                        $get_pelaksana = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE NIK = '$get_pengajuan[pelaksana]'"));
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_pengajuan[kd_project]'"));

                        $nama_pelaksana = explode(" ", $get_pelaksana['nama']);
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <?php if($get_pengajuan['status'] == "belum realisasi"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_fu_pengajuan_asset' data-id='<?php echo $get_pengajuan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah DB Detail">
                                <?php echo "PN".$get_pengajuan['id']."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?>
                            </a>
                          <?php }else{ ?>
                            <a href="#modal" style="font-weight: bold;" data-toggle='modal' data-target='#show_realisasi_asset' data-id='<?php echo $get_pengajuan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Realisasi">
                              <?php echo "PN".$get_pengajuan['id']."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?>
                            </a>
                          <?php } ?>
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
                        <td><?php echo $nama_pelaksana[0]." ".$nama_pelaksana[1]; ?></td>
                        <td>
                          <?php
                            if($get_project['nm_project'] == NULL){
                              echo "Non Project";
                            }else{
                              echo $get_project['nm_project'];
                            }
                          ?>
                        </td>
                        <td><?php echo date("d-m-Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></td>
                        <td>
                          <?php
                            if($get_pengajuan['tgl_realisasi'] == NULL){
                              echo "";
                            }else{
                              echo date("d-m-Y", strtotime($get_pengajuan['tgl_realisasi']));
                            } 
                          ?>
                        </td>
                        <td><?php echo $get_pengajuan['keterangan']; ?></td>
                        <td>
                          <?php
                            if($get_pengajuan['status'] == "belum realisasi"){
                              echo "<span class='badge badge-danger'>belum realisasi</span>";
                            }elseif($get_pengajuan['status'] == "sudah realisasi"){
                              echo "<span class='badge badge-success'>sudah realisasi</span>";
                            }
                          ?>    
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
  <div class="modal fade" id="show_fu_pengajuan_asset" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pengajuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myFormB" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

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