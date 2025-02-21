<?php
  if(isset($_POST['pengembalian_completed'])){
    if($_POST['pengembalian_completed'] == "completed"){
      $add_pengembalian_selesai = mysqli_query($conn, "INSERT INTO asset_pengembalian_selesai VALUES('','$_POST[kd_project]',null)");

      if($add_pengembalian_selesai){
        $_SESSION['alert_success'] = 'Pengembalian berhasil diselesaikan!';
      }else{
        $_SESSION['alert_danger'] = 'Pengembalian gagal diselesaikan!';
      }
    }
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Peminjaman Selesai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Selesai</li>
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
                <h5>Peminjaman Project</h5>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Project</th>
                      <th width="10%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_project IN (SELECT kd_project FROM asset_peminjaman) AND kd_project IN (SELECT kd_project FROM asset_pengembalian_selesai WHERE kd_project IS NOT NULL)");
                      while($get_project = mysqli_fetch_array($q_get_project)){
                        $cek_pengembalian = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_pengembalian WHERE kd_project = '$get_project[kd_project]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_pengembalian' data-id='<?php echo $get_project['kd_project']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail pengembalian">
                            <?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?>
                          </a>
                        </td>
                        <td><span class="badge badge-success">pengembalian selesai</span></td>
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


        <!-- <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>Peminjaman Non-Project</h5>
              </div>
              <div class="card-body">
                <table id="example3" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="10%">No Pinjam</th>
                      <th width="20%">Peminjam</th>
                      <th width="15%">Tgl Pinjam</th>
                      <th width="">Keterangan</th>
                      <th width="10%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_peminjaman = mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE kd_project IS NULL AND id NOT IN (SELECT peminjaman_id FROM asset_pengembalian_selesai WHERE peminjaman_id IS NOT NULL) ORDER BY id DESC");
                      while($get_peminjaman = mysqli_fetch_array($q_get_peminjaman)){
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
                        $cek_pengembalian = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_pengembalian WHERE peminjaman_id = '$get_peminjaman[id]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_peminjaman['id']."/MA/".date("m/Y", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td><?php echo date("d F Y", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
                        <td><?php echo $get_peminjaman['keterangan']; ?></td>
                        <td><span class="badge badge-success">pengembalian selesai</span></td>
                      </tr>
                    <?php $no++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div> -->

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_pengembalian" role="dialog">
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