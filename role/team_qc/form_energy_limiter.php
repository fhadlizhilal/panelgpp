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
            <h1>Form Report Energy Limiter</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Report Energy Limiter</li>
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
                    <td align="center" style="vertical-align: middle;"><h4>Report QC Energy Limiter</h4></td>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_energylimiter' data-id='<?php echo $_GET['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data">
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
                      <th width="15%" style="vertical-align: middle;">No Barcode</th>
                      <th width="15%" style="vertical-align: middle;">Power Limit</th>
                      <th width="" style="vertical-align: middle;">Time Reset</th>
                      <th width="" style="vertical-align: middle;">Credit Setting</th>
                      <th width="" style="vertical-align: middle;">Foto</th>
                      <th width="1%" style="vertical-align: middle;" class="no-print">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_getDataEnergyLimiter = mysqli_query($conn, "SELECT * FROM qc_reportenergylimiter_detail WHERE report_id = '$_GET[id]'");
                      while($getEnergyLimiter = mysqli_fetch_array($q_getDataEnergyLimiter)){
                    ?>
                      <tr>
                        <td align="center" style="font-size: 12px; vertical-align: middle;"><?php echo $no; ?></td>
                        <td align="center" style="font-size: 12px; vertical-align: middle;"><?php echo $getEnergyLimiter['barcode']; ?></td>
                        <td align="center" style="font-size: 12px; vertical-align: middle;"><?php echo $getEnergyLimiter['power_limit']." Watt"; ?></td>
                        <td align="center" style="font-size: 12px; vertical-align: middle;"><?php echo date("H:i", strtotime($getEnergyLimiter['time_reset']))." ".$getEnergyLimiter['time_region']; ?></td>
                        <td align="center" style="font-size: 12px; vertical-align: middle;"><?php echo $getEnergyLimiter['credit_setting']." Wh"; ?></td>
                        <td align="center"><img src="dokumentasi_report/<?php echo $getEnergyLimiter['foto']; ?>" style="width: 200px;"></td>
                        <td align="center" style="font-size: 12px; vertical-align: middle;" class="no-print">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_data_energylimiter' data-id='<?php echo $getEnergyLimiter['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_data_energylimiter' data-id='<?php echo $getEnergyLimiter['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
                        </td>
                      </tr>
                    <?php $no++; } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
        <div class="row" style="font-size: 10px; margin-top: -10px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Lampiran</h5>
                <div class="float-right no-print">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_lampiran_energylimiter' data-id='<?php echo $_GET['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Lampiran">
                      <span class="fa fa-plus"></span> Tambah Lampiran
                  </a>
                </div>
              </div>
              <!-- ./card-header -->
              <div class="card-body table-responsive">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr align="center">
                      <th width="1%" style="vertical-align: middle;">No</th>
                      <th width="60%" style="vertical-align: middle;">Keterangan</th>
                      <th width="40%" style="vertical-align: middle;">Foto</th>
                      <th width="1%" style="vertical-align: middle;" class="no-print">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_getLampiranEnergyLimiter = mysqli_query($conn, "SELECT * FROM qc_reportenergylimiter_lampiran WHERE report_id = '$_GET[id]'");
                      while($getLampiranEnergyLimiter = mysqli_fetch_array($q_getLampiranEnergyLimiter)){
                    ?>
                      <tr>
                        <td align="center" style="vertical-align: middle;"><?php echo $no; ?></td>
                        <td style="vertical-align: middle;"><?php echo $getLampiranEnergyLimiter['keterangan']; ?></td>
                        <td align="center"><img src="dokumentasi_report/<?php echo $getLampiranEnergyLimiter['foto']; ?>" style="width: 200px;"></td>
                        <td align="center" style="font-size: 14px; vertical-align: middle;" class="no-print">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_lampiran_energylimiter' data-id='<?php echo $getLampiranEnergyLimiter['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_lampiran_energylimiter' data-id='<?php echo $getLampiranEnergyLimiter['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
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
  <div class="modal fade" id="show_add_data_energylimiter" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Energy Limiter</h4>
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
  <div class="modal fade" id="show_edit_data_energylimiter" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Energy Limiter</h4>
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
  <div class="modal fade" id="show_delete_data_energylimiter" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data Energy Limiter</h4>
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
  <div class="modal fade" id="show_add_lampiran_energylimiter" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Lampiran</h4>
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
  <div class="modal fade" id="show_delete_lampiran_energylimiter" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Lampiran</h4>
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
  <div class="modal fade" id="show_edit_lampiran_energylimiter" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Lampiran</h4>
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