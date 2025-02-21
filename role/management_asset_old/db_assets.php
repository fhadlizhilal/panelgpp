<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Database Assets</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Assets</li>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_assets' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Hari Libur">
                    <span class="fa fa-plus"></span> Tambah Asset Baru
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">ID Asset</th>
                      <th width="">Nama Asset</th>
                      <th width="">Jenis</th>
                      <th width="">Merek</th>
                      <th width="">Satuan</th>
                      <th width="">Gudang</th>
                      <th width="10%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getAssets = mysqli_query($conn, "SELECT * FROM assets_database ORDER BY id DESC");
                      while($get_assets = mysqli_fetch_array($q_getAssets)){
                        $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_assets[merek]'"));
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <span class="badge badge-info" style="padding: 4px;">
                            <?php echo $get_assets['id_asset']; ?>
                          </span>
                        </td>
                        <td><?php echo $get_assets['nama']; ?></td>
                        <td><?php echo $get_assets['jenis']; ?></td>
                        <td><?php echo $get_merek['merek']; ?></td>
                        <td><?php echo $get_assets['satuan']; ?></td>
                        <td><?php echo $get_assets['gudang']; ?></td>
                        <td style="font-size: 14px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_assets' data-id='<?php echo $get_assets['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_assets' data-id='<?php echo $get_assets['id_asset']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
                        </td>
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
  <div class="modal fade" id="show_add_assets" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Asset Baru</h4>
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

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_assets" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Asset</h4>
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

  <!-- Modal start here -->
  <div class="modal fade" id="show_delete_assets" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Asset</h4>
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