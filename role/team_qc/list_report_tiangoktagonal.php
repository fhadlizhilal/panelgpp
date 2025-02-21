<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Report QC Tiang Oktagonal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tiang Oktagonal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row" style="font-size: 12px;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_report_tiangoktagonal' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Report Tiang Oktagonal Baru">
                    <span class="fa fa-plus"></span> Tambah Report Tiang Oktagonal Baru
                  </a>
                </div>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table id="show_search_and_pagging2" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr align="center">
                      <th width="1%">No</th>
                      <th width="">Nama Pekerjaan</th>
                      <th width="20%">Tanggal</th>
                      <th width="10%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_getListReportQC = mysqli_query($conn, "SELECT * FROM qc_reportlist WHERE form = 'tiang_oktagonal'");
                      while($getListReportQC = mysqli_fetch_array($q_getListReportQC)){
                        $no++;
                    ?>
                      <tr>
                        <td align="center"><?php echo $no; ?></td>
                        <td>
                          <a href="index.php?pages=formreporttiangoktagonal&id=<?php echo $getListReportQC['id']; ?>">
                            <?php echo $getListReportQC['nm_pekerjaan']; ?>
                          </a>
                        </td>
                        <td align="center"><?php echo date("d-m-Y", strtotime($getListReportQC['tgl'])); ?></td>
                        <td align="center">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_report' data-id='<?php echo $getListReportQC['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                          |
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_listreport' data-id='<?php echo $getListReportQC['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-trash"></span></a>
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
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal start here -->
  <div class="modal fade" id="show_add_report_tiangoktagonal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Report Tiang Oktagonal Baru</h4>
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
  <div class="modal fade" id="show_edit_report" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Report PV</h4>
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
  <div class="modal fade" id="show_delete_listreport" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete List Report</h4>
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