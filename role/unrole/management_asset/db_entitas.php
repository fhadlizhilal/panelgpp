<?php
  if(isset($_POST['submit_add_entitas'])){
    if($_POST['submit_add_entitas'] == "Tambah"){
      $push_entitas = mysqli_query($conn, "INSERT INTO asset_db_entitas VALUES('','$_POST[entitas]')");

      if($push_entitas){
        $_SESSION['alert_success'] = "Berhasil! Entitas Baru Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Entitas Baru gagal ditambahkan";
      }
    }
  }

  if(isset($_POST['delete_entitas'])){
    if($_POST['delete_entitas'] == "delete"){
      $delete_entitas = mysqli_query($conn, "DELETE FROM asset_db_entitas WHERE id = '$_POST[id]'");

      if($delete_entitas){
        $_SESSION['alert_success'] = "Berhasil! Entitas berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Entitas gagal dihapus";
      }
    }
  }

  if(isset($_POST['edit_entitas'])){
    if($_POST['edit_entitas'] == "Ubah"){
      $edit_entitas = mysqli_query($conn, "UPDATE asset_db_entitas SET entitas = '$_POST[entitas]' WHERE id = '$_POST[id]'");

      if($edit_entitas){
        $_SESSION['alert_success'] = "Berhasil! Entitas berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Entitas gagal diubah";
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
            <h1>Database Entitas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Entitas</li>
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
              <?php if($_SESSION['role'] == "management_asset" || $_SESSION['role'] == "HSE"){ ?>
                <div class="card-header">
                  <h3 class="card-title float-sm-right" style="font-size: 12px;">
                    <a href="#modal" data-toggle='modal' data-target='#show_add_entitas' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data Entitas">
                      <span class="fa fa-plus"></span> Tambah Entitas Baru
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
                      <th width="">Nama Entitas</th>
                      <?php if($_SESSION['role'] == "management_asset" || $_SESSION['role'] == "HSE" ){ ?>
                        <th width="10%">#</th>
                      <?php } ?> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_get_entitas = mysqli_query($conn, "SELECT * FROM asset_db_entitas ORDER BY entitas ASC");
                      while($get_entitas = mysqli_fetch_array($q_get_entitas)){
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_entitas['entitas']; ?></td>
                        <?php if($_SESSION['role'] == "management_asset" || $_SESSION['role'] == "HSE"){ ?>
                          <td style="font-size: 14px;">
                            <form method="POST" action="">
                              <input type="hidden" name="id" value="<?php echo $get_entitas['id']; ?>">
                              <a href="#modal" class="btn btn-info btn-xs btn-flat" data-toggle='modal' data-target='#show_edit_entitas' data-id='<?php echo $get_entitas['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                              <button type="submit" class="btn btn-danger btn-xs btn-flat" name="delete_entitas" value="delete" onclick="return confirm('Yakin Delete Entitas : <?php echo $get_entitas['entitas']; ?>')">
                                <span class="fa fa-close"></span>
                              </button>
                            </form>
                          </td>
                        <?php } ?>
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
  <div class="modal fade" id="show_add_entitas" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Entitas Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="myForm" method="POST" action="">
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Entitas</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="entitas" required>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-info float-right" name="submit_add_entitas" value="Tambah">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_entitas" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Entitas</h4>
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