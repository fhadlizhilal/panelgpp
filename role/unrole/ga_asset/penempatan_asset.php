<?php
  $harga_raw = $_POST['harga_satuan'];
  $harga_satuan = preg_replace('/[^\d]/', '', $harga_raw); // hasil: 1500000
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penempatan Asset</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Penempatan Asset</li>
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
                  <h1 class="card-title">
                    Ruangan
                  </h1>
                </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="40%">Ruangan</th>
                      <th>Data Asset</th>
                      <th width="6%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_ruangan = mysqli_query($conn, "SELECT * FROM ga_ruangan");
                      while($get_ruangan = mysqli_fetch_array($q_get_ruangan)){
                        $get_data_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT count(*) AS jumlah_asset, sum(qty) AS total_qty FROM ga_asset WHERE lokasi_asset = '$get_ruangan[id]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_dataasset' data-id='<?php echo $get_ruangan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail">
                            <?php echo $get_ruangan['nm_ruangan']; ?>
                          </a>
                        </td>
                        <td style="font-size: 12px">
                          <?php echo "<span class='badge badge-info'>Jumlah Asset : ".$get_data_asset['jumlah_asset']."</span> <span class='badge badge-secondary'>Total Qty : ".$get_data_asset['total_qty']."</span>"; ?>
                        </td>
                        <td style="font-size: 14px;"></td>
                      </tr>
                    <?php $no++; } ?>
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


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                  <h1 class="card-title">
                    Karyawan
                  </h1>
                </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="dbabsen1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="40%">Nama Karyawan</th>
                      <th>Data Asset</th>
                      <th width="6%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_karyawan = mysqli_query($conn, "SELECT nik, nama FROM karyawan WHERE nama <> 'Fadhli Aoliana' AND nama <> 'Winda Fauziah'");
                      while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
                        $get_data_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT count(*) AS jumlah_asset, sum(qty) AS total_qty FROM ga_asset WHERE lokasi_asset = '$get_karyawan[nik]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_dataasset' data-id='<?php echo $get_karyawan['nik']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail">
                            <?php echo $get_karyawan['nama']; ?></td>
                          </a>
                        <td style="font-size: 12px">
                          <?php echo "<span class='badge badge-info'>Jumlah Asset : ".$get_data_asset['jumlah_asset']."</span> <span class='badge badge-secondary'>Total Qty : ".$get_data_asset['total_qty']."</span>"; ?>
                        </td>
                        <td style="font-size: 14px;"></td>
                      </tr>
                    <?php $no++; } ?>
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
  <div class="modal fade" id="show_detail_dataasset" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Data Asset</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myFormB" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>