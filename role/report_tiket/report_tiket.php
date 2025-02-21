<?php
  date_default_timezone_set('Asia/Jakarta');

  function rupiah($angka){
  
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
 
  }

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tiket Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tiket Report</li>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_report_tiket' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="To Project">
                    <span class="fa fa-plus"></span> Tambah Report
                  </a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped" style="font-size: 9px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">NIK</th>
                      <th width="">Tanggal Claim</th>
                      <th width="">No Tiket</th>
                      <th width="">Badan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getReportTiket = mysqli_query($conn, "SELECT * FROM report_tiket WHERE karyawan_nik = '$_SESSION[nik]' ORDER BY tgl_claim DESC");
                      while($get_ReportTiket = mysqli_fetch_array($q_getReportTiket)){
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_ReportTiket['karyawan_nik']; ?></td>
                        <td><?php echo date('d-m-Y', strtotime($get_ReportTiket['tgl_claim'])); ?></td>
                        <td><?php echo $get_ReportTiket['no_tiket']; ?></td>
                        <td><?php echo $get_ReportTiket['badan']; ?></td>
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
  <div class="modal fade" id="show_add_report_tiket" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Report Tiket</h4>
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