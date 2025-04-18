<?php
  require_once("../dev/config.php");

  if(isset($_GET['msg']) && $_GET['msg']=="success"){
    $_SESSION['alert_success'] = "Project Baru Berhasil Dibuat!";
  }

  if(isset($_POST['updateforecast'])){
    if($_POST['updateforecast']=="Update"){
      $kdforecast = $_POST['kdforecast'];
      $tglUpdate = $_POST['tglUpdate'];
      $StatusForecast = $_POST['StatusForecast'];
      $keterangan = $_POST['keterangan'];
      $plan_followup = $_POST['plan_followup'];
      $kendala = $_POST['kendala'];
      $peluang = $_POST['peluang'];

      //add forecast to database
      $sql = "INSERT INTO activity_update (kd_activity, kd_forecast, tgl_update, status_forecast, keterangan, plan_followup, kendala, peluang) VALUES ('','$kdforecast','$tglUpdate','$StatusForecast','$keterangan','$plan_followup','$kendala','$peluang')";
      if (mysqli_query($conn, $sql)) {
        //update status forecast
        $sql_update = "UPDATE forecast SET status_forecast='$StatusForecast' WHERE kd_forecast='$kdforecast'";
        if (mysqli_query($conn,$sql_update)){

          // if(){
          //   //update status_view
          //   $sql_update = "UPDATE forecast SET status_forecast='$StatusForecast' WHERE kd_forecast='$kdforecast'";
          // }

          $_SESSION['alert_success'] = "Activity Forecast Berhasil Diupdate!";
        }else{
          $_SESSION['alert_error'] = "Activity Forecast Berhasil Ditambahkan tetapi "."ERROR: Could not able to execute $sql_update. " . mysqli_error($conn);
        }
      }else{
        $_SESSION['alert_error'] = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }
    }
  }

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>My Project List</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Project List</li>
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
                <table id="example1" class="table table-bordered table-striped" style="font-size: 10px;">
                  <thead>
                  <tr>
                    <th><span class="fa fa-list-ul"></span></th>
                    <!-- <th width="5%">#</th> -->
                    <th>Kode Project</th>
                    <th>Kode Forecast</th>
                    <th>Nik Sales</th>
                    <th>Kode Badan</th>
                    <th>Nama Project</th>
                    <th>No Ticket</th>
                    <th>No SPH</th>
                    <th>No SPK</th>
                    <th>Nama Customer</th>
                    <th>No HP</th>
                    <th>Perusahaan</th>
                    <th>Kapasitas</th>
                    <th>Satuan Kapasitas</th>
                    <th>Jumlah Order</th>
                    <th>Satuan</th>
                    <th>Lokasi Project</th>
                    <th>Tipe Project</th>
                    <th>Start</th>
                    <th>deadline</th>
                    <th>nilai_project</th>
                    <th>ppn</th>
                    <th>cashback</th>
                    <th>remark</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      require_once("../dev/config.php");
                      $data = mysqli_query($conn,"select * from project");
                      while($d = mysqli_fetch_array($data)){
                        $penawaran_rupiah = "Rp " . number_format($d['penawaran'],0,',','.');

                          // $data_view = mysqli_query($conn,"select * from v_activity where kd_forecast = '$d[kd_forecast]' and  order by kd_activity DESC LIMIT 1");
                          // while($d_view = mysqli_fetch_array($data_view)){
                          //   $tgl_update = $d_view['tgl_update'];
                          //   $plan_followup = $d_view['plan_followup'];
                          //   $kendala = $d_view['kendala'];
                          //   $peluang = $d_view['peluang'];
                          //   $nm_kategori = $d_view['nm_kategori'];
                          //   $status = $d_view['status'];
                          //   $keterangan = $d_view['keterangan'];
                          //   $threshold = $d_view['threshold'];

                          //   $hari_ini = strtotime(date('d-m-Y'));
                          //   $hari_update = strtotime($tgl_update);
                          //   $jarak = $hari_ini - $hari_update;
                          //   $selisih_hari = $jarak/60/60/24;
                          //   $selisih_threshold = $selisih_hari - $threshold;

                          //   if($threshold=="-"){
                          //     $selisih_threshold = 0;
                          //   }
                          // }

                    if($selisih_threshold > 0){
                    ?>
                    <tr style="background-color: #c40000;">
                    <?php }else{ ?>
                      <tr>
                    <?php } ?>
                      <td><?php echo $selisih_threshold; ?></td>
                      <!-- <td>
                        <a href="index.php?pages=toproject&id=<?php echo $d['kd_forecast']; ?>" data-toggle="tooltip" data-placement="right" title="To Project"><span class="fa fa-check-square-o"></span></a>
                        <a href="index.php?pages=editforecast&id=<?php echo $d['kd_forecast']; ?>" data-toggle="tooltip" data-placement="right" title="edit"><span class="fa fa-edit"></span></a>
                        <a href="" data-toggle="modal" data-target="#show2" data-id="<?php echo $d['kd_forecast']; ?>"data-toggle="tooltip" data-placement="right" title="Timeline"><span class="fa fa-history"></span></a>
                        <a href="" data-toggle="modal" data-target="#show" data-id="<?php echo $d['kd_forecast']; ?>" data-toggle="tooltip" data-placement="right" title="update"><span class="fa fa-refresh"></span></a>
                      </td> -->
                      <td><span class="badge badge-primary" style="font-size: 12px;"><?php echo $d['kd_project']; ?></span></td>
                      <td><?php echo $d['kd_forecast']; ?></td>
                      <td><?php echo $d['nik_sales']; ?></td>
                      <td><?php echo $d['kd_badan']; ?></td>
                      <td><?php echo $d['nm_project']; ?></td>
                      <td><?php echo $d['no_ticket']; ?></td>
                      <td><?php echo $d['no_sph']; ?></td>
                      <td><?php echo $d['no_spk']; ?></td>
                      <td><?php echo $d['nm_customer']; ?></td>
                      <td><?php echo $d['nohp']; ?></td>
                      <td><?php echo $d['perusahaan']; ?></td>
                      <td><?php echo $d['kapasitas']; ?></td>
                      <td><?php echo $d['satuan_kapasitas']; ?></td>
                      <td><?php echo $d['jumlah_order']; ?></td>
                      <td><?php echo $d['satuan']; ?></td>
                      <td><?php echo $d['lokasi_project']; ?></td>
                      <td><?php echo $d['tipe_project']; ?></td>
                      <td><?php echo $d['start']; ?></td>
                      <td><?php echo $d['deadline']; ?></td>
                      <td><?php echo $d['nilai_project']; ?></td>
                      <td><?php echo $d['ppn']; ?></td>
                      <td><?php echo $d['cashback']; ?></td>
                      <td><?php echo $d['remark']; ?></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th width="1%">Kode Forecast</th>
                    <th>Badan</th>
                    <th>Tiket CRM</th>
                    <th>Nama Customer</th>
                    <th>Perusahaan</th>
                    <th>No HP</th>
                    <th>Kategori</th>
                    <th>Kebutuhan</th>
                    <th>Pribadi/ Proyek</th>
                    <th>Penawaran</th>
                    <th>Status Forecast</th>
                    <th>#</th>
                  </tr>
                  </tfoot> -->
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
  <div class="modal fade" id="show" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Activity</h4>
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
  <div class="modal fade" id="show2" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">History Timeline</h4>
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