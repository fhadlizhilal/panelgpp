<?php
  if(isset($_POST['submit_add_merek'])){
    if($_POST['submit_add_merek'] == "Tambah"){
      $push_merek = mysqli_query($conn, "INSERT INTO asset_db_merek VALUES('','$_POST[merek]')");

      if($push_merek){
        $_SESSION['alert_success'] = "Berhasil! Merek Baru Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Merek Baru gagal ditambahkan";
      }
    }
  }

  if(isset($_POST['delete_merek'])){
    if($_POST['delete_merek'] == "delete"){
      $delete_merek = mysqli_query($conn, "DELETE FROM asset_db_merek WHERE id = '$_POST[id]'");

      if($delete_merek){
        $_SESSION['alert_success'] = "Berhasil! Merek Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Merek gagal dihapus";
      }
    }
  }

  if(isset($_POST['edit_merek'])){
    if($_POST['edit_merek'] == "Ubah"){
      $edit_merek = mysqli_query($conn, "UPDATE asset_db_merek SET merek = '$_POST[merek]' WHERE id = '$_POST[id]'");

      if($edit_merek){
        $_SESSION['alert_success'] = "Berhasil! Merek Berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Merek gagal diubah";
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
            <h1>Database Merek</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Merek</li>
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
                    <a href="#modal" data-toggle='modal' data-target='#show_add_merek' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data Merek">
                      <span class="fa fa-plus"></span> Tambah Merek Baru
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
                      <th width="">Nama Merek</th>
                      <?php if($_SESSION['role'] == "management_asset" || $_SESSION['role'] == "HSE"){ ?>
                        <th width="10%">#</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getMerek = mysqli_query($conn, "SELECT * FROM asset_db_merek ORDER BY merek ASC");
                      while($get_merek = mysqli_fetch_array($q_getMerek)){
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_merek['merek']; ?></td>
                        <?php if($_SESSION['role'] == "management_asset" || $_SESSION['role'] == "HSE"){ ?>
                          <td style="font-size: 14px;">
                            <form method="POST" action="">
                              <input type="hidden" name="id" value="<?php echo $get_merek['id']; ?>">
                              <a href="#modal" class="btn btn-info btn-xs btn-flat" data-toggle='modal' data-target='#show_edit_merek' data-id='<?php echo $get_merek['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> 
                              <button type="submit" class="btn btn-danger btn-xs btn-flat" name="delete_merek" value="delete" onclick="return confirm('Yakin Delete Merek : <?php echo $get_merek['merek']; ?>')">
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
  <div class="modal fade" id="show_add_merek" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Merek Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="myForm" method="POST" action="">
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Merek</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="merek" required>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-info float-right" name="submit_add_merek" value="Tambah">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_merek" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Merek</h4>
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