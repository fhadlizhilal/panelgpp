<?php
  $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$_GET[entitas]'"));

  if(isset($_POST['submit_stock_opname'])){
    if($_POST['submit_stock_opname'] == "submit"){
      $push_to_stockopname = mysqli_query($conn, "INSERT INTO asset_stockopname VALUES('','$_POST[entitas_id]','$_POST[tanggal]','$_POST[keterangan]')");

      if($push_to_stockopname){
        $last_id = $conn->insert_id;

        $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail ORDER BY id ASC");
        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $post_stockreal = "stock_real_".$get_db_detail['detail_code'];
          $post_remarks = "remarks_".$get_db_detail['detail_code'];
          $post_stock = "stock_".$get_db_detail['detail_code'];
          $adjustment = $_POST[$post_stockreal] - $_POST[$post_stock];

          if($_POST[$post_stockreal] === "") {
            
          }elseif ($_POST[$post_stockreal] === "0" || $_POST[$post_stockreal] == 0 || $_POST[$post_stockreal] > 0) {
            mysqli_query($conn, "INSERT INTO asset_stockopname_detail VALUES('','$last_id','$get_db_detail[detail_code]','$_POST[$post_stockreal]','$adjustment','$_POST[$post_remarks]')");
          }
          
        }
        $_SESSION['alert_success'] = "Berhasil, Stock Opname Berhasil Disubmit";

      }else{
        $_SESSION['alert_error'] = "Gagal, Stock Opname Gagal Disubmit";
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
            <h1>Data Stock Opname <?php echo $get_entitas['entitas']; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Stock Opname</li>
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

              <?php if($_SESSION['role'] == "management_asset" || $_SESSION['role'] == "HSE"){ ?>
                <div class="card-header">
                  <h3 class="card-title float-sm-right" style="font-size: 12px;">
                    <a href="#modal" data-toggle='modal' data-target='#show_add_stockopname' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Stock Opname Baru">
                      <span class="fa fa-plus"></span> Stock Opname Baru
                    </a>
                  </h3>
                </div>
              <?php } ?>

              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="15%">No Stock Opname</th>
                      <th width="10%">Entitas</th>
                      <th width="12%">Tanggal</th>
                      <th width="">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 1;
                      $q_get_stockopname = mysqli_query($conn, "SELECT * FROM asset_stockopname WHERE entitas_id = '$_GET[entitas]' ORDER BY id DESC");
                      while($get_stockopname = mysqli_fetch_array($q_get_stockopname)){
                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_stockopname[entitas_id]'"));
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_stockopname' data-id='<?php echo $get_stockopname['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Stock Opname Baru">
                            <?php echo "SO".$get_stockopname['id']."/MA/".date("m/Y", strtotime($get_stockopname['tanggal'])); ?>
                          </a>
                        </td>
                        <td><?php echo $get_entitas['entitas']; ?></td>
                        <td><?php echo date("d F Y", strtotime($get_stockopname['tanggal'])); ?></td>
                        <td><?php echo $get_stockopname['keterangan']; ?></td>
                      </tr>
                    <?php $i++; } ?>
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
  <div class="modal fade" id="show_add_stockopname" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form Stock Opname</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="myForm" method="POST" action="">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-2 col-0"></div>
              <div class="col-lg-8 col12">
                <table class="table table-sm" style="font-size: 12px">
                  <tr>
                    <td width="30%"><b>Entitas</b></td>
                    <td width="1%">:</td>
                    <td><?php echo $get_entitas['entitas']; ?></td>
                  </tr>
                  <tr>
                    <td width="30%"><b>Tanggal Stock Opname</b></td>
                    <td width="1%">:</td>
                    <td><input type="date" style="width: 130px" name="tanggal" required></td>
                  </tr>
                  <tr>
                    <td><b>Keterangan</b></td>
                    <td>:</td>
                    <td><input type="text" style="width: 100%;" name="keterangan" required></td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <table class="table table-sm table-striped" style="font-size: 11px">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Barang</th>
                      <th>Tipe Barang</th>
                      <th>Tipe Detail</th>
                      <th>Merek</th>
                      <th>Sub Barang</th>
                      <th width="1%">Jenis</th>
                      <th width="1%" style="text-align: center;">Satuan</th>
                      <th width="1%" style="text-align: center;">Stock In DB</th>
                      <th width="1%" style="text-align: center;">Real Stock</th>
                      <th width="15%">Remarks</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id ORDER BY nama_barang ASC, tipe_barang ASC");
                      while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                        $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_detail[merek_id]'"));

                        // STOCK DARI REALISASI
                        $get_stock_from_realisasi = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(asset_realisasi.qty) AS total_realisasi FROM asset_realisasi JOIN asset_pengajuan ON asset_realisasi.pengajuan_id = asset_pengajuan.id WHERE asset_realisasi.detail_code = '$get_db_detail[detail_code]' AND asset_pengajuan.status = 'sudah realisasi' AND asset_pengajuan.entitas_id = '$_GET[entitas]'"));

                        //PENGURANG STOCK dari surat jalan
                        $sudahkirim_dari_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sudah_kirim FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id WHERE detail_code = '$get_db_detail[detail_code]' AND asset_suratjalan.entitas_id = '$_GET[entitas]'"));

                        //PENAMBAHAN DARI Pengembalian Approved
                        $pengembalian_approved = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS jml_kembalibaik FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE status = 'BA approved' AND detail_code = '$get_db_detail[detail_code]' AND entitas_id = '$_GET[entitas]'"));

                        //ADJUSMENT DARI STOCK OPNAME
                        $total_adjustment = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(adjustment) AS t_adjust FROM asset_stockopname_detail JOIN asset_stockopname ON asset_stockopname_detail.stockopname_id = asset_stockopname.id WHERE detail_code = '$get_db_detail[detail_code]' AND entitas_id = '$_GET[entitas]'"));

                        $total_stock = $get_stock_from_realisasi['total_realisasi'] - $sudahkirim_dari_suratjalan['sudah_kirim'] + $pengembalian_approved['jml_kembalibaik'] + $total_adjustment['t_adjust'];
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_db_detail['nama_barang']; ?></td>
                        <td><?php echo $get_db_detail['tipe_barang']; ?></td>
                        <td><?php echo $get_db_detail['tipe_detail']; ?></td>
                        <td><?php echo $get_merek['merek']; ?></td>
                        <td><?php echo $get_db_detail['sub_barang']; ?></td>
                        <td><?php echo $get_db_detail['jenis']; ?></td>
                        <td align="center"><?php echo $get_db_detail['satuan']; ?></td>
                        <td align="center">
                          <?php echo $total_stock; ?>
                          <input type="hidden" name="stock_<?php echo $get_db_detail['detail_code']; ?>" value="<?php echo $total_stock; ?>">
                        </td>
                        <td><input type="number" min="0" style="width: 50px" name="stock_real_<?php echo $get_db_detail['detail_code']; ?>"></td>
                        <td>
                          <input type="text" style="width: 100%" name="remarks_<?php echo $get_db_detail['detail_code']; ?>">
                        </td>
                      </tr>
                    <?php $no++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div>
            <center>
              <input type="hidden" name="entitas_id" value="<?php echo $_GET['entitas']; ?>">
              <button type="submit" class="btn btn-success" name="submit_stock_opname" value="submit" onclick="return confirm('Yakin data stock opname sudah benar?')"><span class="fa fa-upload"></span> Submit Stock Opname</button>
            </center>
          </div>
          <br>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_stockopname" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
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