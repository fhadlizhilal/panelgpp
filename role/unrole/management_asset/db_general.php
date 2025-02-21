<?php
  if(isset($_POST['submit_add_dbgeneral'])){
    if($_POST['submit_add_dbgeneral'] == "Tambah"){
      $push_dbgeneral = mysqli_query($conn, "INSERT INTO asset_db_general VALUES('','$_POST[general_code]','$_POST[nama_barang]','$_POST[tipe_barang]','$_POST[sub_barang]','$_POST[satuan]','$_POST[jenis]')");

      if($push_dbgeneral){
        $_SESSION['alert_success'] = "Berhasil! DB General Baru Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! DB General Baru gagal ditambahkan";
      }
    }
  }

  if(isset($_POST['delete_dbgeneral'])){
    if($_POST['delete_dbgeneral'] == "delete"){
      $delete_dbgeneral = mysqli_query($conn, "DELETE FROM asset_db_general WHERE id = '$_POST[id]'");

      if($delete_dbgeneral){
        $_SESSION['alert_success'] = "Berhasil! DB General berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! DB General berhasil dihapus";
      }
    }
  }

  if(isset($_POST['edit_dbgeneral'])){
    if($_POST['edit_dbgeneral'] == "Ubah"){
      $edit_dbgeneral = mysqli_query($conn, "UPDATE asset_db_general SET general_code = '$_POST[general_code]', nama_barang = '$_POST[nama_barang]', tipe_barang = '$_POST[tipe_barang]', sub_barang = '$_POST[sub_barang]', satuan = '$_POST[satuan]', jenis = '$_POST[jenis]' WHERE id = '$_POST[id]'");

      if($edit_dbgeneral){
        $_SESSION['alert_success'] = "Berhasil! DB General berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! DB General berhasil diubah";
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
            <h1>Database General</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database General</li>
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
                    <a href="#modal" data-toggle='modal' data-target='#show_add_dbgeneral' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah DB General">
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
                      <th>General Code</th>
                      <th>Nama Barang</th>
                      <th>Tipe Barang</th>
                      <th>Sub Barang</th>
                      <th>Satuan</th>
                      <th>Jenis</th>
                      <?php if($_SESSION['role'] == "management_asset"){ ?>
                        <th width="8%">#</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getDBgeneral = mysqli_query($conn, "SELECT * FROM asset_db_general ORDER BY jenis ASC, general_code ASC");
                      while($get_DBgeneral = mysqli_fetch_array($q_getDBgeneral)){
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_DBgeneral['general_code']; ?></td>
                        <td><?php echo $get_DBgeneral['nama_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['tipe_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['sub_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['satuan']; ?></td>
                        <td><?php echo $get_DBgeneral['jenis']; ?></td>
                        <?php if($_SESSION['role'] == "management_asset"){ ?>
                          <td style="font-size: 14px;">
                            <form id="myFormA" method="POST" action="">
                              <input type="hidden" name="id" value="<?php echo $get_DBgeneral['id']; ?>">
                              <a href="#modal" class="btn btn-info btn-xs btn-flat" data-toggle='modal' data-target='#show_edit_dbgeneral' data-id='<?php echo $get_DBgeneral['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> 
                              <button type="submit" class="btn btn-danger btn-xs btn-flat" name="delete_dbgeneral" value="delete" onclick="return confirm('Yakin Delete General Code : <?php echo $get_DBgeneral['general_code']; ?>')">
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
  <div class="modal fade" id="show_add_dbgeneral" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah DB General</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="myForm" method="POST" action="">
          <div class="modal-body">
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">General Code</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="general_code" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Barang</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="nama_barang" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tipe Barang</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="tipe_barang" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Sub Barang</label>
              <div class="col-sm-4">
                <select class="form-control form-control-sm" name="sub_barang" required>
                  <option value="" selected disabled>-- Pilih Sub --</option>
                  <option value="Continue">Continue</option>
                  <option value="Habis Pakai">Habis Pakai</option>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Satuan</label>
              <div class="col-sm-4">
                <select class="form-control form-control-sm" name="satuan" required>
                  <option value="" selected disabled>-- Pilih Satuan --</option>
                  <option value="Lembar">Lembar</option>
                  <option value="Lot">Lot</option>
                  <option value="Meter">Meter</option>
                  <option value="Pack">Pack</option>
                  <option value="Pair">Pair</option>
                  <option value="Pcs">Pcs</option>
                  <option value="Roll">Roll</option>
                  <option value="Set">Set</option>
                  <option value="Unit">Unit</option>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 6px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jenis</label>
              <div class="col-sm-4">
                <select class="form-control form-control-sm" name="jenis" required>
                  <option value="" selected disabled>-- Pilih Jenis --</option>
                  <option value="APD">APD</option>
                  <option value="Tools">Tools</option>
                  <option value="Inventaris">Inventaris</option>
                  <option value="Alat Ukur">Alat Ukur</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-info float-right" name="submit_add_dbgeneral" value="Tambah">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_dbgeneral" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit DB General</h4>
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