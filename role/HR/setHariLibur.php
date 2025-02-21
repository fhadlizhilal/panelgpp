<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Hari Libur</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Set Hari Libur</li>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_hari_libur' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Hari Libur">
                    <span class="fa fa-plus"></span> Tambah Hari Libur
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="10%">Tanggal</th>
                      <th width="">Keterangan Libur</th>
                      <th width="15%">Tanggal Dibuat</th>
                      <th width="8%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getHariLibur = mysqli_query($conn, "SELECT * FROM harilibur ORDER BY tanggal DESC");
                      while($get_HariLibur = mysqli_fetch_array($q_getHariLibur)){
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_HariLibur['tanggal']; ?></td>
                        <td><?php echo $get_HariLibur['keterangan']; ?></td>
                        <td><?php echo $get_HariLibur['created_at']; ?></td>
                        <td style="font-size: 14px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_hari_libur' data-id='<?php echo $get_HariLibur['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_hari_libur' data-id='<?php echo $get_HariLibur['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
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
  <div class="modal fade" id="show_add_hari_libur" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Hari Libur</h4>
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
  <div class="modal fade" id="show_edit_hari_libur" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Hari Libur</h4>
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
  <div class="modal fade" id="show_delete_hari_libur" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Hari Libur</h4>
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