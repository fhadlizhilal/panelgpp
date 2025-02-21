<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Report - Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Project</li>
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
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th>Project</th>
                      <th width="14%">Peminjaman</th>
                      <th width="14%">Pengembalian</th>
                      <th width="1%">% Kembali</th>
                      <th width="1%">Status Pengembalian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_project IN (SELECT kd_project FROM asset_peminjaman WHERE status = 'waiting for MA' OR status = 'on progress by MA' OR status = 'completed') ORDER BY id DESC");
                      while($get_project = mysqli_fetch_array($q_get_project)){
                        $cek_pengembalian_selesai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_pengembalian_selesai WHERE kd_project = '$get_project[kd_project]'"));
                        $sum_qty_pinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sum_pinjam FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE asset_peminjaman.kd_project = '$get_project[kd_project]'"));

                        $sum_qty_kembali = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS sum_kembali FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE asset_pengembalian.kd_project = '$get_project[kd_project]' AND asset_pengembalian.status = 'BA approved'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></td>
                        <td style="font-size: 12px;">
                          <span class="badge badge-success">
                            <?php
                              if($sum_qty_pinjam['sum_pinjam']>0){
                                echo $sum_qty_pinjam['sum_pinjam']." Asset";
                              }else{
                                echo "0 Asset";
                              }
                            ?>
                          </span>
                          <span class="badge badge-info">Rp 110.000.000</span>
                        </td>
                        <td style="font-size: 12px;">
                          <span class="badge badge-success">
                            <?php
                              if($sum_qty_kembali['sum_kembali']>0){
                                echo $sum_qty_kembali['sum_kembali']." Asset";
                              }else{
                                echo "0 Asset";
                              }
                            ?>
                          </span>
                          <span class="badge badge-info">Rp 100.000.000</span>
                        </td>
                        <td style="font-size: 12px;">
                          <?php if((100*$sum_qty_kembali['sum_kembali']/$sum_qty_pinjam['sum_pinjam'])>=85){ ?>
                            <span class="badge badge-success"><?php echo number_format(100*$sum_qty_kembali['sum_kembali']/$sum_qty_pinjam['sum_pinjam'],2,'.',',')." %"; ?>
                            </span>
                          <?php }elseif((100*$sum_qty_kembali['sum_kembali']/$sum_qty_pinjam['sum_pinjam'])>=75){ ?>
                            <span class="badge badge-warning"><?php echo number_format(100*$sum_qty_kembali['sum_kembali']/$sum_qty_pinjam['sum_pinjam'],2,'.',',')." %"; ?>
                            </span>
                          <?php }elseif((100*$sum_qty_kembali['sum_kembali']/$sum_qty_pinjam['sum_pinjam'])<75){ ?>
                            <span class="badge badge-danger"><?php echo number_format(100*$sum_qty_kembali['sum_kembali']/$sum_qty_pinjam['sum_pinjam'],2,'.',',')." %"; ?>
                            </span>
                          <?php }else{ ?>
                            <span class="badge badge-secondary"><?php echo number_format(100*$sum_qty_kembali['sum_kembali']/$sum_qty_pinjam['sum_pinjam'],2,'.',',')." %"; ?>
                            </span>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if($cek_pengembalian_selesai > 0){ ?>
                            <span class="badge badge-success">pengembalian selesai</span>
                          <?php }else{ ?>
                            <span class="badge badge-secondary">pengembalian belum selesai</span>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->