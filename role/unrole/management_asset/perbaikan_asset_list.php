<?php
  if(isset($_POST['delete_realisasi_perbaikan'])){
    $delete_realisasi_perbaikan = mysqli_query($conn, "DELETE FROM asset_perbaikan_realisasi WHERE perbaikan_id = '$_POST[perbaikan_id]'");

    if($delete_realisasi_perbaikan){
      mysqli_query($conn, "UPDATE asset_perbaikan SET status = 'belum realisasi' WHERE id = '$_POST[perbaikan_id]'");
      $_SESSION['alert_success'] = "Realisasi perbaikan no ".$_POST['perbaikan_no']." berhasil dihapus";
    }else{
      $_SESSION['alert_error'] = "Gagal! Realisasi gagal dihapus!";
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
            <h1>List Perbaikan Asset</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Perbaikan Asset</li>
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
                  <a href="#modal" class="small-box-footer" data-toggle='modal' data-target='#show_pengajuan_perbaikan_pilihentitas' data-id='<?php echo $get_pengajuan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah DB Detail">
                    <span class="fa fa-plus"></span> Tambah Perbaikan Baru
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="11%">No Perbaikan</th>
                      <th width="1%">Entitas</th>
                      <th width="">Project</th>
                      <th width="12%">Pelaksana</th>
                      <th width="6%">Tgl Pengajuan</th>
                      <th width="">Keterangan</th>
                      <th width="1%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_perbaikan_list = mysqli_query($conn, "SELECT * FROM asset_perbaikan ORDER BY id DESC");
                      while($get_perbaikan_list = mysqli_fetch_array($q_get_perbaikan_list)){
                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_perbaikan_list[entitas_id]'"));
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_perbaikan_list[kd_project]'"));
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_perbaikan_list[pelaksana]'"));
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td>
                            <a href="#modal" class="small-box-footer" data-toggle='modal' data-target='#show_perbaikan_detail' data-id='<?php echo $get_perbaikan_list['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Perbaikan">
                              <?php echo $get_perbaikan_list['id']."FIX/MA/".date('m/Y', strtotime($get_perbaikan_list['tgl_pengajuan'])); ?>
                            </a>
                          </td>
                          <td><?php echo $get_entitas['entitas']; ?></td>
                          <td><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></td>
                          <td><?php echo $get_karyawan['nama']; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($get_perbaikan_list['tgl_pengajuan'])); ?></td>
                          <td><?php echo $get_perbaikan_list['keterangan']; ?></td>
                          <td>
                            <?php
                              if($get_perbaikan_list['status'] == "belum realisasi"){
                                echo "<div class='badge badge-warning'>Belum Realisasi</div>";
                              }else{
                                echo "<div class='badge badge-success'>Sudah Realisasi</div>";
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
  <div class="modal fade" id="show_pengajuan_perbaikan_pilihentitas" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pengajuan Perbaikan Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" method="POST" action="index.php?pages=formpengajuanperbaikan">
            <div class="card-body">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Entitas</label>
                <div class="col-sm-10">
                  <select class="form-control" name="entitas_id" required>
                    <option value="" selected disabled>--- Pilih Entitas ---</option>
                    <?php
                      $q_get_entitas = mysqli_query($conn, "SELECT * FROM asset_db_entitas ORDER BY entitas ASC");
                      while($get_entitas = mysqli_fetch_array($q_get_entitas)){
                    ?>
                        <option value="<?php echo $get_entitas['id']; ?>"><?php echo $get_entitas['entitas']; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <small style="color: red; font-style: italic;">*Pilih entitas untuk pengajuan perbaikan</small>
                </div>
              </div>
            </div>
            <div class="card-footer" style="text-align: center;">
              <button type="submit" class="btn btn-success" name="open_form_perbaikan" value="open_form">Open Form</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_perbaikan_detail" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Perbaikan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myFormA" method="POST" action="">
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