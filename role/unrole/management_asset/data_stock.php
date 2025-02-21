<?php
  $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$_GET[entitas]'"));
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Stock <?php echo $get_entitas['entitas'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Stock</li>
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
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th>Detail Code</th>
                      <th>General Code</th>
                      <th>Nama Barang</th>
                      <th>Tipe Barang</th>
                      <th>Tipe Detail</th>
                      <th>Merek</th>
                      <th>Sub Barang</th>
                      <th>Jenis</th>
                      <th>Stock</th>
                      <th>Satuan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
                      while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                        $get_DBgeneral = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_detail[general_code_id]'"));
                        $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_detail[merek_id]'"));

                        // STOCK DARI REALISASI
                        $get_stock_from_realisasi = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(asset_realisasi.qty) AS total_realisasi FROM asset_realisasi JOIN asset_pengajuan ON asset_realisasi.pengajuan_id = asset_pengajuan.id WHERE asset_realisasi.detail_code = '$get_db_detail[detail_code]' AND asset_pengajuan.status = 'sudah realisasi' AND asset_pengajuan.entitas_id = '$_GET[entitas]'"));

                        //PENGURANG STOCK dari surat jalan
                        $sudahkirim_dari_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sudah_kirim FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id WHERE detail_code = '$get_db_detail[detail_code]' AND asset_suratjalan.entitas_id = '$_GET[entitas]'"));

                        //PENAMBAHAN DARI Pengembalian Approved
                        $pengembalian_approved = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS jml_kembalibaik FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE status = 'BA approved' AND detail_code = '$get_db_detail[detail_code]' AND entitas_id = '$_GET[entitas]'"));

                        //ADJUSMENT DARI STOCK OPNAME
                        $total_adjustment = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(adjustment) AS t_adjust FROM asset_stockopname_detail JOIN asset_stockopname ON asset_stockopname_detail.stockopname_id = asset_stockopname.id WHERE detail_code = '$get_db_detail[detail_code]' AND entitas_id = '$_GET[entitas]'"));

                        //DATA ASSET SUDAH DIPERBAIKI
                        $sudah_diperbaiki = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS t_perbaikan FROM asset_perbaikan_realisasi JOIN asset_perbaikan ON asset_perbaikan_realisasi.perbaikan_id = asset_perbaikan.id WHERE asset_perbaikan.status = 'sudah realisasi' AND asset_perbaikan_realisasi.detail_code = '$get_db_detail[detail_code]' AND entitas_id = '$_GET[entitas]'"));

                        $total_stock = $get_stock_from_realisasi['total_realisasi'] - $sudahkirim_dari_suratjalan['sudah_kirim'] + $pengembalian_approved['jml_kembalibaik'] + $total_adjustment['t_adjust'] + $sudah_diperbaiki['t_perbaikan'];
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_db_detail['detail_code']; ?></td>
                        <td><?php echo $get_DBgeneral['general_code']; ?></td>
                        <td><?php echo $get_DBgeneral['nama_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['tipe_barang']; ?></td>
                        <td><?php echo $get_db_detail['tipe_detail']; ?></td>
                        <td><?php echo $get_merek['merek']; ?></td>
                        <td><?php echo $get_DBgeneral['sub_barang']; ?></td>
                        <td><?php echo $get_DBgeneral['jenis']; ?></td>
                        <td align="center"><?php echo $total_stock; ?></td>
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