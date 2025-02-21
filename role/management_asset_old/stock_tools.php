<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stock Tools</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database Tools</li>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_tools' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Tools Baru">
                    <span class="fa fa-plus"></span> Tambah Tools Baru
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">ID Tools</th>
                      <th width="">ID Detail</th>
                      <th width="">Nama Tools</th>
                      <th width="">Jenis Tools</th>
                      <th width="">Sub Tools</th>
                      <th width="">Tipe/Detail</th>
                      <th width="">Merek</th>
                      <th width="">Harga Min</th>
                      <th width="">Harga Max</th>
                      <th width="">Harga Rata2</th>
                      <th width="">Stock</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getTools_detail = mysqli_query($conn, "SELECT * FROM v_tools_detail ORDER BY nama_tools ASC");
                      while($get_tools_detail = mysqli_fetch_array($q_getTools_detail)){
                        $i = $i+1;
                        $get_toolsMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT MIN(harga_satuan) AS hargaMin, MAX(harga_satuan) AS hargaMax, SUM(qty) AS sumQty FROM tools_masuk_detail WHERE id_detail = '$get_tools_detail[detail_id]'"));

                        $harga_rata2 = 0;
                        $total_harga = 0;
                        $total_qty = 0;

                        $q_getToolsMasukDetail = mysqli_query($conn, "SELECT * FROM tools_masuk_detail WHERE id_detail = '$get_tools_detail[detail_id]'"); 
                        while($get_toolsMasukDetail = mysqli_fetch_array($q_getToolsMasukDetail)){
                          $total_harga = $total_harga+($get_toolsMasukDetail['qty']*$get_toolsMasukDetail['harga_satuan']);
                          $total_qty = $total_qty+$get_toolsMasukDetail['qty'];
                        }
                        $harga_rata2 = $total_harga/$total_qty;

                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_tools_detail['tools_id']; ?></td>
                        <td><?php echo $get_tools_detail['detail_id']; ?></td>
                        <td><?php echo $get_tools_detail['nama_tools']; ?></td>
                        <td><?php echo $get_tools_detail['jenis_tools']; ?></td>
                        <td><?php echo $get_tools_detail['sub_tools']; ?></td>
                        <td><?php echo $get_tools_detail['tipe_detail']; ?></td>
                        <td><?php echo $get_tools_detail['merek']; ?></td>
                        <td><?php echo "Rp ".number_format($get_toolsMasuk['hargaMin'],0); ?></td>
                        <td><?php echo "Rp ".number_format($get_toolsMasuk['hargaMax'],0); ?></td>
                        <td><?php echo "Rp ".number_format($harga_rata2,0); ?></td>
                        <td><?php echo 0+$get_toolsMasuk['sumQty']." ".$get_tools_detail['satuan']; ?></td>
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
  <div class="modal fade" id="show_add_tools" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Tools Baru</h4>
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
  <div class="modal fade" id="show_edit_tools" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Tools</h4>
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
  <div class="modal fade" id="show_delete_tools" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Tools</h4>
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