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
            <h1>List Forecast</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Forecast</li>
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
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example3" class="table table-bordered table-striped" style="font-size: 10px;">
                  <thead>
                  <tr>
                    <th width="1%">Kode Forecast</th>
                    <th width="12%">Nama Customer</th>
                    <th width="12%">Perusahaan</th>
                    <th>Deskripsi</th>
                    <th width="10%">Penawaran</th>
                    <th width="12%">Status Forecast</th>
                    <th width="1%">Peluang</th>
                    <th width="10%">#</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $q_listforecast = mysqli_query($conn, "SELECT * FROM forecast WHERE nik_sales = '$_SESSION[nik]' AND status_view = 'view' ORDER BY tgl_dibuat DESC");
                      while($get_forecast = mysqli_fetch_array($q_listforecast)){
                        $get_status_forecast = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM status_forecast WHERE id = '$get_forecast[status_forecast]'"));

                        $q_get_activity = mysqli_query($conn, "SELECT * FROM activity_update WHERE kd_forecast = '$get_forecast[kd_forecast]' ORDER BY kd_activity DESC");
                        $get_activity_forecast = mysqli_fetch_array($q_get_activity);

                        $threshold = $get_status_forecast['threshold'];
                        $updated_at = $get_activity_forecast['tgl_update'];
                        $now = date('Y-m-d');

                        $tgl1 = strtotime($updated_at);
                        $tgl2 = strtotime($now);
                        $jarak = $tgl2 - $tgl1;
                        $diff = $jarak / 60 / 60 / 24;

                        $d_threshold = $threshold - $diff;
                    ?>
                      <tr <?php if($threshold != "-" && $d_threshold < 1){ echo "style='background-color: #b3000a;'";} ?>>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_forecast' data-id='<?php echo $get_forecast['kd_forecast']; ?>'>
                            <?php echo $get_forecast['kd_forecast']; ?>
                          </a>
                        </td>
                        <td><?php echo $get_forecast['nm_customer']; ?></td>
                        <td><?php echo $get_forecast['perusahaan']; ?></td>
                        <td><?php echo $get_forecast['kebutuhan']; ?></td>
                        <td><?php echo rupiah($get_forecast['penawaran']); ?></td>
                        <td style="font-size: 8px;"><?php echo $get_status_forecast['status']; ?></td>
                        <td><?php echo $get_activity_forecast['peluang']; ?></td>
                        <td style="font-size: 14px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_forecast' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit">
                            <span class="fa fa-edit"></span> 
                          </a>
                            
                          <a href="#modal" data-toggle='modal' data-target='#show_update_activity' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Update Activity">
                            <span class="fa fa-upload"></span> 
                          </a>
                            
                          <a href="#modal" data-toggle='modal' data-target='#show_history_activity' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Time Line">
                            <span class="fa fa-history"></span>
                          </a>
                            
                          <a href="#modal" data-toggle='modal' data-target='#show_to_project' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="To Project">
                            <span class="fa fa-arrow-right"></span>
                          </a>
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
  <div class="modal fade" id="show_detail_forecast" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Forecast</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-data"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- Modal start here -->
  <div class="modal fade" id="show_update_activity" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Activity Forecast</h4>
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
  <div class="modal fade" id="show_history_activity" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">History Activity</h4>
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
  <div class="modal fade" id="show_edit_forecast" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Forecast</h4>
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
  <div class="modal fade" id="show_to_project" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form To Project</h4>
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