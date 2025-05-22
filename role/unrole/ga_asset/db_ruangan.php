<?php
  if(isset($_POST['submit_add_ruangan'])){
    if($_POST['submit_add_ruangan'] == "Tambah"){
      $push_add_ruangan = mysqli_query($conn, "INSERT INTO ga_ruangan VALUES('','$_POST[nm_ruangan]')");

      if($push_add_ruangan){
        $_SESSION['alert_success'] = "Berhasil! Ruangan Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Ruangan gagal Ditambahkan";
      }
    }
  }

  if(isset($_POST['submit_edit_ruangan'])){
    if($_POST['submit_edit_ruangan'] == "Simpan"){
      $push_edit_ruangan = mysqli_query($conn, "UPDATE ga_ruangan SET nm_ruangan = '$_POST[nm_ruangan]' WHERE id = '$_POST[id]'");

      if($push_edit_ruangan){
        $_SESSION['alert_success'] = "Berhasil! Ruangan Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Ruangan gagal Diubah";
      }
    }
  }

  if(isset($_POST['delete_ruangan'])){
    if($_POST['delete_ruangan'] == "delete"){
      $push_delete_ruangan = mysqli_query($conn, "DELETE FROM ga_ruangan WHERE id = '$_POST[id]'");

      if($push_delete_ruangan){
        $_SESSION['alert_success'] = "Berhasil! Ruangan Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Ruangan gagal Dihapus";
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
            <h1>Database Ruangan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Ruangan</li>
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
                    <a href="#modal" data-toggle='modal' data-target='#show_add_ruangan' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Ruangan">
                      <span class="fa fa-plus"></span> Tambah Ruangan
                    </a>
                  </h3>
                </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th>Nama Ruangan</th>
                      <th width="6%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_ruangan = mysqli_query($conn, "SELECT * FROM ga_ruangan ORDER BY nm_ruangan ASC");
                      while($get_ruangan = mysqli_fetch_array($q_get_ruangan)){
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_ruangan['nm_ruangan']; ?></td>
                        <td style="font-size: 14px;">
                          <form id="myFormA" method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $get_ruangan['id']; ?>">
                            <a href="#modal" class="btn btn-info btn-xs btn-flat" data-toggle='modal' data-target='#show_edit_ruangan' data-id='<?php echo $get_ruangan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                            <button type="submit" class="btn btn-danger btn-xs btn-flat" name="delete_ruangan" value="delete" onclick="return confirm('Yakin Delete Ruangan : <?php echo $get_ruangan['nm_ruangan']; ?>')">
                              <span class="fa fa-close"></span>
                            </button>
                          </form>
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
  <div class="modal fade" id="show_add_ruangan" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Ruangan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="myForm" method="POST" action="">
          <div class="modal-body">
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Ruangan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="nm_ruangan" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-info float-right" name="submit_add_ruangan" value="Tambah">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_ruangan" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Ruangan</h4>
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

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>