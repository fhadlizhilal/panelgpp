<?php
  session_start();
  require_once "../../dev/config.php";

  $get_toolsMasukTMP = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_masuk_tmp"));
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Input Tools Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Input Tools Masuk</li>
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
            <!-- form start -->
            <form class="form-horizontal" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=in-tools" method="POST">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Info Tools Masuk</h3>
                </div>
              
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Masuk</label>
                    <div class="col-sm-9">
                      <input type="date" name="tgl_masuk" class="form-control" value="<?php echo $get_toolsMasukTMP['tgl_masuk']; ?>" style='font-size: 12px;' required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Project</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="kd_project" style='font-size: 12px;' required>
                        <option value="" selected disabled>--- Pilih Project ---</option>
                        <option value="NON-PROJECT" <?php if($get_toolsMasukTMP['kd_project'] == "NON-PROJECT"){ echo "selected"; } ?>>NON-PROJECT</option>
                        <option value="" disabled>--------------------</option>
                        <?php
                          $q_project = mysqli_query($conn, "SELECT * FROM project");
                          while($get_project = mysqli_fetch_array($q_project)){
                        ?>
                          <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_toolsMasukTMP['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="keterangan" style='font-size: 12px;' required><?php echo $get_toolsMasukTMP['keterangan']; ?></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Detail Tools Masuk</h3>
                  <a href="#modal" data-toggle='modal' data-target='#show_add_detail_tools_masuk' data-id='<?php echo $get_toolsMasuk['id']; ?>' data-toggle="tooltip" data-p lacement="bottom" title="Add Tools Detail"><small style="float: right; font-size: 10px;" class="btn btn-info btn-sm"><span class="fa fa-plus"></span> Add Tools Detail</small></a>
                </div>
                <!-- /.card-header -->
              
                <div class="card-body p-0">
                  <div class="row">
                    <div class="col-sm-12 col-md-12">
                      <table class="table table-sm table-striped" style="font-size: 10px;">
                        <thead>
                          <tr>
                            <th width="1%">No</th>
                            <th>Kode Tools</th>
                            <th>Kode Detail</th>
                            <th>Nama Tools</th>
                            <th>Jenis Tools</th>
                            <th>Sub Tools</th>
                            <th>Tipe</th>
                            <th>Merek</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                            <th width="7%">#</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 0;
                            $q_get_tools_masuk_detail_tmp = mysqli_query($conn, "SELECT * FROM tools_masuk_detail_tmp");
                            while($get_ToolsMasukDetailTMP = mysqli_fetch_array($q_get_tools_masuk_detail_tmp)){
                              $get_tools_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM v_tools_detail WHERE detail_id = '$get_ToolsMasukDetailTMP[id_detail]'"));
                              $sum_qty = $sum_qty + $get_ToolsMasukDetailTMP['qty'];
                              $sum_harga = $sum_harga + ($get_ToolsMasukDetailTMP['qty']*$get_ToolsMasukDetailTMP['harga_satuan']);
                              $no++;
                          ?>
                              <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $get_tools_detail['tools_id']; ?></td>
                                <td><?php echo $get_tools_detail['detail_id']; ?></td>
                                <td><?php echo $get_tools_detail['nama_tools']; ?></td>
                                <td><?php echo $get_tools_detail['jenis_tools']; ?></td>
                                <td><?php echo $get_tools_detail['sub_tools']; ?></td>
                                <td><?php echo $get_tools_detail['tipe_detail']; ?></td>
                                <td><?php echo $get_tools_detail['merek']; ?></td>
                                <td><?php echo $get_ToolsMasukDetailTMP['qty']; ?></td>
                                <td><?php echo $get_tools_detail['satuan']; ?></td>
                                <td><?php echo $format_rupiah = "Rp " . number_format($get_ToolsMasukDetailTMP['harga_satuan'],0,',','.'); ?></td>
                                <td><?php echo $format_rupiah = "Rp " . number_format($get_ToolsMasukDetailTMP['qty']*$get_ToolsMasukDetailTMP['harga_satuan'],0,',','.'); ?></td>
                                <td>
                                  <a href="#modal" data-toggle='modal' data-target='#show_edit_detail_tools_masuk' data-id='<?php echo $get_ToolsMasukDetailTMP['id']; ?>' data-toggle="tooltip" data-p lacement="bottom" title="Edit"><span class="fa fa-edit"></span></a>

                                  <a href="#modal" data-toggle='modal' data-target='#show_delete_detail_tools_masuk' data-id='<?php echo $get_ToolsMasukDetailTMP['id']; ?>' data-toggle="tooltip" data-p lacement="bottom" title="Delete"><span class="fa fa-close"></span></a>
                                </td>
                              </tr>
                          <?php } ?>
                              <tr style="font-weight: bold;">
                                <td colspan="8" align="center">TOTAL</td>
                                <td><?php echo $sum_qty; ?></td>
                                <td colspan="2"></td>
                                <td><?php echo "Rp ".number_format($sum_harga,0,',','.'); ?></td>
                                <td></td>
                              </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" align="center">
                  <input type="submit" class="btn btn-success" name="submit_tools_masuk" onclick="return confirm('Yakin data Tools Masuk sudah benar?')" value="Submit">
                  <input type="submit" class="btn btn-info" name="simpan_tools_masuk" value="Simpan Draft">
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </form>
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
  <div class="modal fade" id="show_add_detail_tools_masuk" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Tools Detail</h4>
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
  <div class="modal fade" id="show_edit_detail_tools_masuk" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Tools Detail</h4>
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
  <div class="modal fade" id="show_delete_detail_tools_masuk" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Tools Detail</h4>
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