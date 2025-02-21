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
            <h1>Form Report Tiang Oktagonal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Report Tiang Oktagonal</li>
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
              <div class="card-body">
                <table class="table table-bordered table-sm">
                  <tr>
                    <td width="20%" align="center"><img src="../../dist/img/logo/gpp-logo.png" width="30%"></td>
                    <td align="center" style="vertical-align: middle;"><h4>Report QC Tiang Oktagonal</h4></td>
                  </tr>
                </table>
                <br>
                <table class="table table-sm" style="width: 50%;">
                  <tr>
                    <td width="25%">Nama Pekerjaan</td>
                    <td width="1%">:</td>
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
                <h5 class="card-title">Data Tiang Oktagonal</h5>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_tiang' data-id='<?php echo $_GET['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data Tiang">
                      <span class="fa fa-plus"></span> Tambah Data
                  </a>
                </div>
              </div>
              <!-- ./card-header -->
              <div class="card-body table-responsive">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 10px; margin-bottom: -10px;">
                  <thead>
                    <tr align="center">
                      <th width="1%" style="vertical-align: middle;">No</th>
                      <th width="7%" style="vertical-align: middle;">Panjang Segmen 1</th>
                      <th width="7%" style="vertical-align: middle;">Panjang Segmen 2</th>
                      <th width="7%" style="vertical-align: middle;">Panjang Arm</th>
                      <th width="7%" style="vertical-align: middle;">Tinggi Arm</th>
                      <th width="6%" style="vertical-align: middle;">Klem & Mur Baut</th>
                      <th width="6%" style="vertical-align: middle;">Support Modul</th>
                      <th width="6%" style="vertical-align: middle;">Anti Panjat</th>
                      <th width="7%" style="vertical-align: middle;">Jarak Lubang Baut</th>
                      <th width="7%" style="vertical-align: middle;">Panjang & Lebar Baseplate</th>
                      <th width="7%" style="vertical-align: middle;">Kemiringan Arm</th>
                      <th width="7%" style="vertical-align: middle;">Kemiringan Support Modul</th>
                      <th width="" style="vertical-align: middle;">Foto Tiang</th>
                      <th width="1%" style="vertical-align: middle;" class="no-print">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_getDataTiangOktagonal = mysqli_query($conn, "SELECT * FROM qc_reporttiangoktagonal_detail WHERE report_id = '$_GET[id]'");
                      while($getDataTiangOktagonal = mysqli_fetch_array($q_getDataTiangOktagonal)){
                    ?>
                      <tr>
                        <td align="center"><?php echo $no; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['panjang_segmen1']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['panjang_segmen2']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['panjang_arm']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['tinggi_arm']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['klem_murbaut']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['support_modul']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['anti_panjat']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['jarak_lubang_baut']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['panjang_lebar_baseplate']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['kemiringan_arm']; ?></td>
                        <td align="center"><?php echo $getDataTiangOktagonal['kemiringan_support_modul']; ?></td>
                        <td align="center"><img src="dokumentasi_report/<?php echo $getDataTiangOktagonal['foto_tiang']; ?>" width="100%"></td>
                        <td align="center" style="font-size: 14px;" class="no-print">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_data_tiangoktagonal' data-id='<?php echo $getDataTiangOktagonal['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_data_pv' data-id='<?php echo $getDataTiangOktagonal['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_lampiran_tiang' data-id='<?php echo $_GET['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data Tiang">
                      <span class="fa fa-plus"></span> Tambah Lampiran
                  </a>
                </div>
              </div>
              <!-- ./card-header -->
              <div class="card-body table-responsive">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr align="center">
                      <th width="1%" style="vertical-align: middle;">No</th>
                      <th width="65%" style="vertical-align: middle;">Keterangan</th>
                      <th width="35%" style="vertical-align: middle;">Foto</th>
                      <th width="1%" style="vertical-align: middle;" class="no-print">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_getLampiranTiangOktagonal = mysqli_query($conn, "SELECT * FROM qc_reporttiangoktagonal_lampiran WHERE report_id = '$_GET[id]'");
                      while($getLampiranTiangOktagonal = mysqli_fetch_array($q_getLampiranTiangOktagonal)){
                    ?>
                      <tr>
                        <td align="center"><?php echo $no; ?></td>
                        <td><?php echo $getLampiranTiangOktagonal['keterangan']; ?></td>
                        <td align="center"><img src="dokumentasi_report/<?php echo $getLampiranTiangOktagonal['foto']; ?>" width="100%"></td>
                        <td align="center" style="font-size: 14px;" class="no-print">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_lampiran_tiang' data-id='<?php echo $getLampiranTiangOktagonal['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_lampiran_tiang' data-id='<?php echo $getLampiranTiangOktagonal['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
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
  <div class="modal fade" id="show_add_data_tiang" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Tiang</h4>
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
  <div class="modal fade" id="show_edit_data_tiangoktagonal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Tiang Oktagonal</h4>
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
  <div class="modal fade" id="show_delete_data_pv" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data PV</h4>
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
  <div class="modal fade" id="show_add_lampiran_tiang" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Lampiran</h4>
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
  <div class="modal fade" id="show_edit_lampiran_tiang" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Lampiran</h4>
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
  <div class="modal fade" id="show_delete_lampiran_tiang" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data Lampiran</h4>
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