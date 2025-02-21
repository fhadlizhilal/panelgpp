<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Database Surat Jalan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Surat Jalan</li>
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
                      <th width="10%">No Surat Jalan</th>
                      <th width="1%">Jenis</th>
                      <th width="1%">Entitas</th>
                      <th>Tanggal</th>
                      <th>Project</th>
                      <th width="12%">Peminjam</th>
                      <th>Alamat Kirim</th>
                      <th>Expedisi</th>
                      <th width="1%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_suratjalan = mysqli_query($conn, "SELECT * FROM asset_suratjalan ORDER BY id DESC");
                      while($get_suratjalan = mysqli_fetch_array($q_get_suratjalan)){
                        $get_peminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE id = '$get_suratjalan[peminjaman_id]'"));

                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_suratjalan[entitas_id]'"));

                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));

                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_suratjalan' data-id='<?php echo $get_suratjalan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah DB Detail">
                            <?php echo "SJ".$get_suratjalan['id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?>
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
                        <td><?php echo $get_entitas['entitas']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($get_suratjalan['tanggal'])); ?></td>
                        <td><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td><?php echo $get_suratjalan['alamat_kirim']; ?></td>
                        <td><?php echo $get_suratjalan['expedisi']; ?></td>
                        <td>
                          <?php if($get_suratjalan['status'] == "dalam pengiriman"){ ?>
                            <span class="badge badge-warning">dalam pengiriman</span>
                          <?php }elseif($get_suratjalan['status'] == "diterima & sesuai"){ ?>
                            <span class="badge badge-success">diterima & sesuai</span>
                          <?php }else{ echo $get_suratjalan['status']; } ?>
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
  <div class="modal fade" id="show_detail_suratjalan" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
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

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>