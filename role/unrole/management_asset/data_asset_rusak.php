<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Asset Rusak</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Asset Rusak</li>
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
                      <th>Nama Barang</th>
                      <th>Tipe Barang</th>
                      <th>Sub Barang</th>
                      <th>Tipe Detail</th>
                      <th>Merek</th>
                      <th>Jenis</th>
                      <th width="1%" style="font-size: 8px">Jumlah Rusak Total</th>
                      <th width="1%" style="font-size: 8px">Jumlah Rusak Sebagian</th>
                      <th width="1%" style="font-size: 8px">Jumlah Diper baiki</th>
                      <th width="1%" style="font-size: 8px">Rusak Sebagian Tersisa</th>
                      <th width="1%">Satuan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_getDBDetail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id ORDER BY nama_barang, tipe_barang ASC");
                      while($get_DBDetail = mysqli_fetch_array($q_getDBDetail)){
                        $get_DBgeneral = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_DBDetail[general_code_id]'"));
                        $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_DBDetail[merek_id]'"));

                        //Hitung Jumlah Rusak
                        $get_pengembalian = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak_total) AS jml_rusak_total, SUM(rusak_sebagian) AS jml_rusak_sebagian FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE asset_pengembalian_detail.detail_code = '$get_DBDetail[detail_code]' AND asset_pengembalian.status = 'BA approved'"));

                        //Hitung Jumlah Diperbaiki
                        $get_perbaikan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS jml_diperbaiki FROM asset_perbaikan_realisasi JOIN asset_perbaikan ON asset_perbaikan_realisasi.perbaikan_id = asset_perbaikan.id WHERE asset_perbaikan_realisasi.detail_code = '$get_DBDetail[detail_code]' AND asset_perbaikan.status = 'sudah realisasi'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_DBgeneral['nama_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['tipe_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['sub_barang']; ?></td>
                        <td><?php echo $get_DBDetail['tipe_detail']; ?></td>
                        <td><?php echo $get_merek['merek']; ?></td>
                        <td><?php echo $get_DBgeneral['jenis']; ?></td>
                        <td align="center">
                          <?php
                            if($get_pengembalian['jml_rusak_total'] == ""){
                              echo "0";
                            }else{
                              echo $get_pengembalian['jml_rusak_total'];
                            }
                          ?>
                        </td>
                        <td align="center">
                          <?php
                            if($get_pengembalian['jml_rusak_sebagian'] == ""){
                              echo "0";
                            }else{
                              echo $get_pengembalian['jml_rusak_sebagian'];
                            }
                          ?>
                        </td>
                        <td align="center">
                          <?php
                            if($get_perbaikan['jml_diperbaiki'] == ""){
                              echo "0";
                            }else{
                              echo $get_perbaikan['jml_diperbaiki'];
                            }
                          ?>
                        </td>
                        <td align="center">
                          <?php
                            $sisa_rusak_sebagian = $get_pengembalian['jml_rusak_sebagian'] - $get_perbaikan['jml_diperbaiki'];
                            if($sisa_rusak_sebagian == ""){
                              echo "0";
                            }else{
                              echo $sisa_rusak_sebagian;
                            }
                          ?>
                        </td>
                        <td><?php echo $get_DBgeneral['satuan']; ?></td>
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