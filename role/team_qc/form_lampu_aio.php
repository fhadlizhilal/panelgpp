<?php
  $get_report_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlist WHERE id = '$_GET[id]'"));
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Report Lampu All In One</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Report Lampu All In One</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row" style="font-size: 12px; margin-bottom: -10px;">
          <div class="col-12">
            <div class="card">
              <!-- ./card-header -->
              <div class="card-body table-responsive">
                <table id="" class="table table-bordered table-striped table-sm text-nowrap" style="font-size: 10px;">
                  <tr>
                    <td width="20%" align="center"><img src="../../dist/img/logo/gpp-logo.png" width="30%"></td>
                    <td align="center" style="vertical-align: middle;"><h4>Report QC Lampu All In One</h4></td>
                  </tr>
                </table>
                <br>
                <table class="table table-sm col-md-6 col-12" style="margin-bottom: -10px;">
                  <tr>
                    <td width="25%">Nama Pekerjaan</td>
                    <td width="2%">:</td>
                    <td><?php echo $get_report_list['nm_pekerjaan']; ?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Report</td>
                    <td>:</td>
                    <td><?php echo date("d-m-Y", strtotime($get_report_list['tgl'])); ?></td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
        <div class="row" style="font-size: 10px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header no-print">
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_lampuaio' data-id='<?php echo $_GET['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data">
                      <span class="fa fa-plus"></span> Tambah Data
                  </a>
                </div>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 10px; margin-top: -10px;">
                  <thead>
                    <tr align="center">
                      <th width="1%" style="vertical-align: middle;">No</th>
                      <th width="" style="vertical-align: middle;">No Serial Lampu / Barcode</th>
                      <th width="20%" style="vertical-align: middle;">Foto Lampu</th>
                      <th width="8%" style="vertical-align: middle;">Kondisi Lampu</th>
                      <th width="8%" style="vertical-align: middle;">Aksesoris</th>
                      <th width="8%" style="vertical-align: middle;">Random Check</th>
                      <th width="20%" style="vertical-align: middle;">Foto Random Check</th>
                      <th width="1%" style="vertical-align: middle;" class="no-print">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_getDataLampu = mysqli_query($conn, "SELECT * FROM qc_reportlampuaio_detail WHERE report_id = '$_GET[id]'");
                      while($getDataLampu = mysqli_fetch_array($q_getDataLampu)){
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $getDataLampu['no_seri']; ?></td>
                        <td><img src="dokumentasi_report/<?php echo $getDataLampu['foto_lampu']; ?>" width="100%"></td>
                        <td align="center"><?php echo $getDataLampu['kondisi_lampu']; ?></td>
                        <td align="center"><?php echo $getDataLampu['aksesoris']; ?></td>
                        <td align="center"><?php echo $getDataLampu['random_check']; ?></td>
                        <td>
                          <?php if($getDataLampu['foto_random_check'] != ""){ ?>
                            <img src="dokumentasi_report/<?php echo $getDataLampu['foto_random_check']; ?>" width="100%">
                          <?php } ?>
                        </td>
                        <td align="center" style="font-size: 14px;" class="no-print">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_data_lampuaio' data-id='<?php echo $getDataLampu['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_data_lampuaio' data-id='<?php echo $getDataLampu['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
                        </td>
                      </tr>
                    <?php $no++; } ?>
                  </tbody>
                </table>
                <br>
                <center>
                  <input type="submit" class="no-print btn btn-secondary btn-sm" onclick="window.print()" value="Print">
                </center>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_data_lampuaio" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Lampu All In One</h4>
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
  <div class="modal fade" id="show_edit_data_lampuaio" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Lampu All In One</h4>
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
  <div class="modal fade" id="show_delete_data_lampuaio" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data Lampu All In One</h4>
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