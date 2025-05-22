<?php
  date_default_timezone_set('Asia/Jakarta');
  $created_at = date("Y-m-d H:i:s");

  if(isset($_POST['submit_add_so_site'])){
    if($_POST['submit_add_so_site'] == "Tambah"){
      $add_so_site = mysqli_query($conn, "INSERT INTO asset_stockopname_site VALUES('','$_POST[kd_project]','','open','$_POST[created_at]', Null)");

      if($add_so_site){
        $_SESSION['alert_success'] = "Berhasil! Stock Opname Site Baru Berhasil Ditambahkan!";
      }else{
        $_SESSION['alert_error'] = "Gagal! Stock Opname Site Baru Gagal Ditambahkan!";
      }
    }
  }

  if(isset($_POST['edit_status_sosite'])){
    if($_POST['edit_status_sosite'] == "Simpan"){
      $edit_status = mysqli_query($conn, "UPDATE asset_stockopname_site SET status = '$_POST[status]' WHERE id = '$_POST[id]'");

      if($edit_status){
        $_SESSION['alert_success'] = "Berhasil! Status Stock Opname Berhasil Diubah!";
      }else{
        $_SESSION['alert_error'] = "Gagal! Status Stock Opname Gagal Diubah!";
      }
    }
  }

  if(isset($_POST['delete_data_sosite'])){
    if($_POST['delete_data_sosite'] == "Delete"){
      // delete data detail
      $delete_data_sosite_detail = mysqli_query($conn, "DELETE FROM asset_stockopname_site_detail WHERE id_so_site = '$_POST[id]'");

      if($delete_data_sosite_detail){
        $delete_data_sosite = mysqli_query($conn, "DELETE FROM asset_stockopname_site WHERE id = '$_POST[id]'");
        if($delete_data_sosite){
          $_SESSION['alert_success'] = "Berhasil! Data Stock Opname Berhasil Dihapus!";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Stock Opname Gagal Dihapus!";
        }
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Detail Gagal Dihapus!!";
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
            <h1>Data Stock Opname - Site</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock Opaneme - Site</li>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_so_site' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data">
                    <span class="fa fa-plus"></span> Tambah Stock Opname
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="11%">Kode Project</th>
                      <th width="">Nama Project</th>
                      <th width="">Nama PIC</th>
                      <th width="15%">Created_at</th>
                      <th width="15%">Submitted_at</th>
                      <th width="8%">Status</th>
                      <th width="7%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 1;
                      $q_get_stockopname_site = mysqli_query($conn, "SELECT * FROM asset_stockopname_site ORDER BY id DESC");
                      while($get_so_site = mysqli_fetch_array($q_get_stockopname_site)){
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_so_site[kd_project]'"));
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_so_site['kd_project']; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_sosite' data-id='<?php echo $get_so_site['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail SO Site">
                            <?php echo $get_project['nm_project']; ?>    
                          </a>
                        </td>
                        <td><?php echo $get_so_site['pic']; ?></td>
                        <td><?php echo $get_so_site['created_at']; ?></td>
                        <td><?php echo $get_so_site['submitted_at']; ?></td>
                        <td align="center" style="font-size: 14px;">
                          <?php if($get_so_site['status'] == "open"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_status_sosite' data-id='<?php echo $get_so_site['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Data">
                              <span class="badge badge-info">
                                <?php echo $get_so_site['status']; ?>
                              </span>
                            </a>
                          <?php }elseif($get_so_site['status'] == "completed"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_status_sosite' data-id='<?php echo $get_so_site['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Data">
                              <span class="badge badge-success">
                                <?php echo $get_so_site['status']; ?>
                              </span>
                            </a>
                          <?php }elseif($get_so_site['status'] == "closed"){ ?>
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_status_sosite' data-id='<?php echo $get_so_site['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Data">
                              <span class="badge badge-danger">
                                <?php echo $get_so_site['status']; ?>
                              </span>
                            </a>
                          <?php } ?>
                        </td>
                        <td>
                          <button class="btn btn-info btn-xs" onclick="navigator.clipboard.writeText('http://localhost/panelgpp/panelhse/form_so/index.php?pages=formso&id=<?php echo $get_so_site['id']; ?>').then(() => alert('Link disalin!'));">
                            <span class="fa fa-link"></span>
                          </button>

                          <a href="#modal" data-toggle='modal' data-target='#show_delete_sosite' data-id='<?php echo $get_so_site['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete">
                            <div class="btn btn-danger btn-xs"><span class="fa fa-trash" style="color: white;"></span></div>
                          </a>
                        </td>
                      </tr>
                    <?php $i++; } ?>
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

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_so_site" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Stock Opname Site Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" action="" method="POST">
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
              <div class="col-sm-9">
                <select class="form-control form-control-sm" name="kd_project">
                  <option value="" selected disabled>---- Pilih Project ----</option>
                  <option value="" disabled>---- GPP ----</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP' ORDER BY id DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>"><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>

                  <option value="" disabled>---- GPS ----</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS' ORDER BY id DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>"><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>

                  <option value="" disabled>---- GSS ----</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS' ORDER BY id DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>"><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>

                  <option value="" disabled>---- SI ----</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI' ORDER BY id DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>"><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Created_at</label>
              <div class="col-sm-9">
                <input type="text" name="" class="form-control form-control-sm" value="<?php echo $created_at; ?>" disabled>
              </div>
            </div>
            <hr>
            <center>
              <input type="hidden" name="created_at" value="<?php echo $created_at; ?>">
              <input type="submit" class="btn btn-primary btn-sm" name="submit_add_so_site" value="Tambah">
            </center>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_status_sosite" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Status</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myFormA" method="POST" target="">
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
  <div class="modal fade" id="show_detail_sosite" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header"> 
          <h4 class="modal-title">Detail Stock Opname - Site</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myForm2" method="POST" target="">
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
  <div class="modal fade" id="show_delete_sosite" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data Stock Opname</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm3" method="POST" target="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->