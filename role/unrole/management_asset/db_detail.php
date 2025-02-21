<?php
  if(isset($_POST['submit_add_dbdetail'])){
    if($_POST['submit_add_dbdetail'] == "Tambah"){
      if($_POST['general_code_id'] == "tanpa_general_code"){
        $push_dbdetail = mysqli_query($conn, "INSERT INTO asset_db_detail VALUES('','$_POST[detail_code]',NULL,'$_POST[tipe_detail]','$_POST[merek_id]')");
      }else{
        $push_dbdetail = mysqli_query($conn, "INSERT INTO asset_db_detail VALUES('','$_POST[detail_code]','$_POST[general_code_id]','$_POST[tipe_detail]','$_POST[merek_id]')");
      }
      

      if($push_dbdetail){
        $_SESSION['alert_success'] = "Berhasil! DB Detail Baru Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! DB Detail Baru gagal ditambahkan";
      }
    }
  }

  if(isset($_POST['delete_dbdetail'])){
    if($_POST['delete_dbdetail'] == "delete"){
      $delete_dbdetail = mysqli_query($conn, "DELETE FROM asset_db_detail WHERE id = '$_POST[id]'");

      if($delete_dbdetail){
        $_SESSION['alert_success'] = "Berhasil! DB Detail Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! DB Detail gagal Dihapus";
      }
    }
  }

  if(isset($_POST['edit_dbdetail'])){
    if($_POST['edit_dbdetail'] == "Ubah"){
      $edit_dbdetail = mysqli_query($conn, "UPDATE asset_db_detail SET detail_code = '$_POST[detail_code]', general_code_id = '$_POST[general_code_id]', tipe_detail = '$_POST[tipe_detail]', merek_id = '$_POST[merek_id]' WHERE id = '$_POST[id]'");

      if($edit_dbdetail){
        $_SESSION['alert_success'] = "Berhasil! DB Detail Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! DB Detail gagal Diubah";
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
            <h1>Database Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Detail</li>
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
                    <a href="#modal" data-toggle='modal' data-target='#show_add_dbdetail' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah DB Detail">
                      <span class="fa fa-plus"></span> Tambah DB General Baru
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
                      <th>Detail Code</th>
                      <th>General Code</th>
                      <th>Nama Barang</th>
                      <th>Tipe Barang</th>
                      <th>Sub Barang</th>
                      <th>Satuan</th>
                      <th>Tipe Detail</th>
                      <th>Merek</th>
                      <th>Jenis</th>
                      <?php if($_SESSION['role'] == "management_asset"){ ?>
                        <th width="6%">#</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_getDBDetail = mysqli_query($conn, "SELECT * FROM asset_db_detail ORDER BY detail_code ASC");
                      while($get_DBDetail = mysqli_fetch_array($q_getDBDetail)){
                        $get_DBgeneral = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_DBDetail[general_code_id]'"));
                        $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_DBDetail[merek_id]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_DBDetail['detail_code']; ?></td>
                        <td><?php echo $get_DBgeneral['general_code']; ?></td>
                        <td><?php echo $get_DBgeneral['nama_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['tipe_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['sub_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['satuan']; ?></td>
                        <td><?php echo $get_DBDetail['tipe_detail']; ?></td>
                        <td><?php echo $get_merek['merek']; ?></td>
                        <td><?php echo $get_DBgeneral['jenis']; ?></td>
                        <?php if($_SESSION['role'] == "management_asset"){ ?>
                          <td style="font-size: 14px;">
                            <form id="myFormA" method="POST" action="">
                              <input type="hidden" name="id" value="<?php echo $get_DBDetail['id']; ?>">
                              <a href="#modal" class="btn btn-info btn-xs btn-flat" data-toggle='modal' data-target='#show_edit_dbdetail' data-id='<?php echo $get_DBDetail['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> 
                              <button type="submit" class="btn btn-danger btn-xs btn-flat" name="delete_dbdetail" value="delete" onclick="return confirm('Yakin Delete Detail Code : <?php echo $get_DBDetail['detail_code']; ?>')">
                                <span class="fa fa-close"></span>
                              </button>
                            </form>
                          </td>
                        <?php } ?>
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
  <div class="modal fade" id="show_add_dbdetail" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah DB Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="myForm" method="POST" action="">
          <div class="modal-body">
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Detail Code</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="detail_code" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">General Code</label>
              <div class="col-sm-9">
                <select class="form-control form-control-sm" name="general_code_id" style="font-size: 11px;" required>
                  <option value="" selected disabled>-- Pilih General Code --</option>
                  <option value="tanpa_general_code">Tanpa General Code</option>
                  <?php
                    $q_get_generalcode = mysqli_query($conn, "SELECT * FROM asset_db_general ORDER BY general_code ASC");
                    while($get_generalcode = mysqli_fetch_array($q_get_generalcode)){
                  ?>
                    <option value="<?php echo $get_generalcode['id']; ?>">
                      <?php echo $get_generalcode['general_code']." : ".$get_generalcode['nama_barang']." ".$get_generalcode['tipe_barang']; ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tipe Detail</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="tipe_detail" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Merek</label>
              <div class="col-sm-4">
                <select class="form-control form-control-sm" name="merek_id" required>
                  <option value="" selected disabled>-- Pilih Merek --</option>
                  <?php
                    $q_get_merek = mysqli_query($conn, "SELECT * FROM asset_db_merek ORDER BY merek ASC");
                    while($get_merek = mysqli_fetch_array($q_get_merek)){
                  ?>
                    <option value="<?php echo $get_merek['id']; ?>"><?php echo $get_merek['merek']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-info float-right" name="submit_add_dbdetail" value="Tambah">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_dbdetail" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit DB Detail</h4>
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