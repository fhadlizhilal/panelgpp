<?php
  if(isset($_GET['kdproject'])){
    $kd_project = $_GET['kdproject'];
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$kd_project'"));
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Pengambalian Selesai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Pengambalian</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                <h6>Info Pengambalian</h6>
              </div>
              <!-- ///.card-header -->
              <div class="card-body table-responsive p-0" style="height: 150px;">
                <table class="table table-sm" style="font-size: 12px">
                  <tr>
                    <td width="28%">Kode Project</td>
                    <td width="1%">:</td>
                    <td><?php echo $kd_project; ?></td>
                  </tr>
                  <tr>
                    <td>Nama Project</td>
                    <td>:</td>
                    <td><?php echo $get_project['nm_project']; ?></td>
                  </tr>
                  <tr>
                    <td>Entitas Peminjam</td>
                    <td>:</td>
                    <td>
                      <?php
                        $q_get_entitas_id = mysqli_query($conn, "SELECT DISTINCT entitas_id FROM asset_suratjalan JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE kd_project = '$kd_project'");
                        while($get_entitas_id = mysqli_fetch_array($q_get_entitas_id)){
                          $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_entitas_id[entitas_id]'"));
                          echo $get_entitas['entitas'].", ";
                        }
                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Peminjam</td>
                    <td>:</td>
                    <td>
                      <?php
                        $q_get_peminjam = mysqli_query($conn, "SELECT DISTINCT peminjam FROM asset_peminjaman WHERE kd_project = '$kd_project' AND (status = 'on progress by MA' OR status = 'completed')");
                        while($get_peminjam = mysqli_fetch_array($q_get_peminjam)){
                          $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjam[peminjam]'"));
                          echo $get_karyawan['nama'].", ";
                        }
                      ?>
                    </td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                <h6 style="float: left;">List Pengembaliannn</h6>
              </div>
              <!-- ///.card-header -->
              <div class="card-body table-responsive p-0" style="height: 150px;">
                <table class="table table-head-fixed text-nowrap table-sm" style="font-size: 11px">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Pengembalian</th>
                      <th>Entitas</th>
                      <th>Penanggung Jawab</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                      <th width="1%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $cek_status_waiting = 0;
                      $q_get_pengembalian = mysqli_query($conn, "SELECT * FROM asset_pengembalian WHERE kd_project = '$kd_project' ORDER BY id DESC");
                      while($get_pengembalian = mysqli_fetch_array($q_get_pengembalian)){
                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengembalian[entitas_id]'"));
                        $get_penanggungjawab = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengembalian[penanggungjawab]'"));
                    ?>
                        <tr>
                          <td width="1%"><?php echo $no; ?></td>
                          <td>
                            <a href="#modal" data-toggle='modal' data-target='#show_lihat_pengembalian' data-id='<?php echo $get_pengembalian['id'] ?>' data-toggle="tooltip" data-placement="bottom" title="Lihat Pengembalian">
                              <?php echo "RTN".$get_pengembalian['id']."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?>
                            </a>
                          </td>
                          <td><?php echo $get_entitas['entitas']; ?></td>
                          <td><?php echo $get_penanggungjawab['nama']; ?></td>
                          <td><?php echo date("d/m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
                          <td width="1%">
                            <?php if($get_pengembalian['status'] == "waiting for approval"){ $cek_status_waiting++; ?>
                              <span class="badge badge-warning">waiting for approval</span>
                            <?php }elseif($get_pengembalian['status'] == "BA approved"){ ?>
                              <span class="badge badge-success">BA approved</span>
                            <?php } ?>
                          </td>
                          <td>
                            <?php if($get_pengembalian['status'] == "waiting for approval"){ ?>
                              <a href="#modal" data-toggle='modal' data-target='#show_edit_pengembalian' data-id='<?php echo $get_pengembalian['id'] ?>' data-toggle="tooltip" data-placement="bottom" title="Lihat Pengembalian">
                                <span class="fa fa-edit"></span>
                              </a>
                            <?php }elseif($get_pengembalian['status'] == "BA approved"){ ?>
                              <span class="fa fa-edit"></span>
                            <?php } ?>
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
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h6>Detail Pengembalian</h6>
              </div>
              <!-- ///.card-header -->
              <div class="card-body table-responsive">

                <table class="table table-sm table-striped" style="font-size: 11px">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Tipe Barang</th>
                      <th>Tipe Detail</th>
                      <th>Merek</th>
                      <th width="8%">Sub Barang</th>
                      <th width="1%" style="text-align: center;">Qty Pinjam</th>
                      <th width="1%">Satuan</th>
                      <th width="2%"></th>
                      <th width="1%" style="text-align: center;">Kembali Baik</th>
                      <th width="1%" style="text-align: center;">Habis</th>
                      <th width="1%" style="text-align: center;">Rusak Sebagian</th>
                      <th width="1%" style="text-align: center;">Rusak Total</th>
                      <th width="1%" style="text-align: center;">Hilang</th>
                      <th width="1%" style="text-align: center;">Total Kembali</th>
                      <th width="1%"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $cek_total_kembali = 0;
                      $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id ORDER BY nama_barang ASC, tipe_barang ASC");
                      while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                        $qty_pinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS qty_pinjam FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE asset_peminjaman.kd_project = '$kd_project' AND asset_suratjalan_detail.detail_code = '$get_db_detail[detail_code]'"));

                        $qty_pengembalian = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS sum_baik, SUM(habis) AS sum_habis, SUM(rusak_sebagian) AS sum_rusaksebagian, SUM(rusak_total) AS sum_rusaktotal, SUM(hilang) AS sum_hilang FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE kd_project = '$kd_project' AND detail_code = '$get_db_detail[detail_code]'"));

                        if($qty_pinjam['qty_pinjam'] > 0 || $qty_pengembalian['sum_baik']>0 || $qty_pengembalian['sum_habis']>0 || $qty_pengembalian['sum_rusaksebagian']>0 || $qty_pengembalian['sum_rusaktotal']>0 || $qty_pengembalian['sum_hilang']>0){
                    ?>
                        <tr>
                          <td width="1%"><?php echo $no; ?></td>
                          <td><?php echo $get_db_detail['nama_barang']; ?></td>
                          <td><?php echo $get_db_detail['tipe_barang']; ?></td>
                          <td><?php echo $get_db_detail['tipe_detail']; ?></td>
                          <td><?php echo $get_db_detail['merek']; ?></td>
                          <td><?php echo $get_db_detail['sub_barang']; ?></td>
                          <td align="center"><?php echo $qty_pinjam['qty_pinjam']; ?></td>
                          <td align="center"><?php echo $get_db_detail['satuan']; ?></td>
                          <td></td>
                          <td align="center"><?php echo $qty_pengembalian['sum_baik']; ?></td>
                          <td align="center"><?php echo $qty_pengembalian['sum_habis']; ?></td>
                          <td align="center"><?php echo $qty_pengembalian['sum_rusaksebagian']; ?></td>
                          <td align="center"><?php echo $qty_pengembalian['sum_rusaktotal']; ?></td>
                          <td align="center"><?php echo $qty_pengembalian['sum_hilang']; ?></td>
                          <td align="center"><b><?php echo $total_kembali = $qty_pengembalian['sum_baik']+$qty_pengembalian['sum_habis']+$qty_pengembalian['sum_rusaksebagian']+$qty_pengembalian['sum_rusaktotal']+$qty_pengembalian['sum_hilang'] ?></b></td>
                          <td>
                            <?php if($total_kembali < $qty_pinjam['qty_pinjam']){ $cek_total_kembali++; ?>
                              <span class="fa fa-close" style="color: red"></span>
                            <?php }else{ ?>
                              <span class="fa fa-check" style="color: green"></span>
                            <?php } ?>
                          </td>
                        </tr>
                    <?php $no++; }} ?>
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
  <div class="modal fade" id="show_lihat_pengembalian" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pengembalian</h4>
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

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>