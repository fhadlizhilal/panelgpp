<?php
  $id = $_GET['id'];
  $get_peminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE id = '$id'"));
  $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));

  if(isset($_POST['submit_surat_jalan'])){
    if($_POST['submit_surat_jalan'] == "Submit"){
      $push_suratjalan = mysqli_query($conn, "INSERT INTO asset_suratjalan VALUES('','$_POST[id]','$_POST[entitas_id]','$_POST[tgl_suratjalan]','$_POST[alamat_kirim]','$_POST[expedisi]','dalam pengiriman')");

      if($push_suratjalan){
        $_SESSION['alert_success'] = "Berhasil! Surat Jalan Berhasil Disubmit!";
      }else{
        $_SESSION['alert_error'] = "Gagal! Surat Jalan Gagal Disubmit!";
      }
    }
  }

  if(isset($_POST['simpan_surat_jalan'])){
    if($_POST['simpan_surat_jalan'] == "Simpan"){
      //Edit surat_jalan
      $edit_suratjalan = mysqli_query($conn, "UPDATE asset_suratjalan SET tanggal = '$_POST[tgl_suratjalan]', alamat_kirim = '$_POST[alamat_kirim]', expedisi = '$_POST[expedisi]' WHERE id = '$_POST[id]'");

      if($edit_suratjalan){
        //Delete surat_jalan_detail
        mysqli_query($conn, "DELETE FROM asset_suratjalan_detail WHERE suratjalan_id = '$_POST[id]'");

        $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail");
        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $post_qty = "qty_".$get_db_detail['detail_code'];
          if($_POST[$post_qty] > 0){
            mysqli_query($conn, "INSERT INTO asset_suratjalan_detail VALUES('','$_POST[id]','$get_db_detail[detail_code]','$_POST[$post_qty]')");
          }
        }

        $_SESSION['alert_success'] = "Berhasil! Surat Jalan Berhasil Diubah!";
      }else{
        $_SESSION['alert_error'] = "Berhasil! Surat Jalan Gagal Diubah!";
      }

    }
  }

  if(isset($_POST['submit_peminjaman_completed'])){
    if($_POST['submit_peminjaman_completed'] == "completed"){

      $cek_suratjalan_belumselesai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_suratjalan WHERE peminjaman_id = '$_POST[peminjaman_id]' AND status = 'dalam pengiriman'"));

      if($cek_suratjalan_belumselesai > 0){
        $_SESSION['alert_warning'] = "Gagal! Surat Jalan masih ada yang belum selesai!";
      }else{
        $peminjaman_to_completed = mysqli_query($conn, "UPDATE asset_peminjaman SET status = 'completed' WHERE id = '$_POST[peminjaman_id]'");

        if($peminjaman_to_completed){
          $_SESSION['alert_success'] = "Berhasil! Peminjaman Berhasil Diselesaikan!<br>Tunggu sampai halaman selesai diarahkan";
          echo "<meta http-equiv='refresh' content='0;url=index.php?pages=peminjamanonprogress'>";
        }else{
          $_SESSION['alert_error'] = "Gagal! Peminjaman Gagal Diselesaikan!";
        }
      }
      
    }
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Detail Peminjaman</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Peminjaman</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-5">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- ///.card-header -->
                  <div class="card-body">
                    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PEMINJAMAN</div>
                    <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
                      <tr>
                        <td width="25%">Kode Pinjam</td>
                        <td width="1%">:</td>
                        <td><?php echo $get_peminjaman['id']."/MA/".date("m/Y", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
                      </tr>
                      <tr>
                        <td width="25%">Nama Peminjam</td>
                        <td width="1%">:</td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                      </tr>
                      <tr>
                        <td>Tanggal Pinjam</td>
                        <td>:</td>
                        <td><?php echo date("d F Y H:i", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
                      </tr>
                      <tr>
                        <td>Project</td>
                        <td>:</td>
                        <td><?php echo $get_peminjaman['kd_project']." - ".$get_project['nm_project']; ?></td>
                      </tr>
                      <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>
                          <?php echo $get_peminjaman['keterangan']; ?></td>
                      </tr>
                      <tr>
                        <td>Jenis / Status</td>
                        <td>:</td>
                        <td>
                          <?php if($get_peminjaman['jenis'] == "tools"){ ?>
                            <span class="badge badge-info">Tools</span>
                          <?php }elseif($get_peminjaman['jenis'] == "apd"){ ?>
                            <span class="badge badge-success">APD</span>
                          <?php }elseif($get_peminjaman['jenis'] == "inventaris"){ ?>
                            <span class="badge badge-warning">Inventaris</span>
                          <?php }elseif($get_peminjaman['jenis'] == "alat ukur"){ ?>
                            <span class="badge badge-danger">Alat Ukur</span>
                          <?php } ?>

                          <?php if($get_peminjaman['status'] == "waiting for MA"){ ?>
                            <span class="badge badge-secondary">Waiting for MA</span>
                          <?php }elseif($get_peminjaman['status'] == "on progress by MA"){ ?>
                            <span class="badge badge-warning">On Progress by MA</span>
                          <?php }elseif($get_peminjaman['status'] == "rejected by MA"){ ?>
                            <span class="badge badge-danger">Rejected by MA</span>
                          <?php }elseif($get_peminjaman['status'] == "canceled by user"){ ?>
                            <span class="badge badge-danger">Canceled by User</span>
                          <?php }elseif($get_peminjaman['status'] == "completed"){ ?>
                            <span class="badge badge-success">Completed</span>
                          <?php } ?>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <!-- -------------------------------- SURAT JALAN & PACKING LIST --------------------- -->
                <div class="card">
                  <div class="card-body">
                    <div style="text-align: center; font-weight: bold; margin-bottom: 10px; float: left;">SURAT JALAN & PACKING LIST</div>

                    <?php if($_SESSION['role'] == "management_asset"){ ?>
                      <a href="#modal" data-toggle='modal' data-target='#show_add_suratjalan' data-id='<?php echo $get_peminjaman['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Buat Surat Jalan Baru">
                        <div class="btn btn-success btn-xs" style="float: right;"><small><span class="fa fa-plus"></span> Buat Surat Jalan</small></div>
                      </a>
                    <?php } ?>

                    <table class="table table-sm" style="font-size: 11px">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>No Surat Jalan</th>
                          <th>Entitas</th>
                          <th>Tanggal</th>
                          <th>Ekspedisi</th>
                          <th>Status</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no=1;
                          $q_get_suratjalan = mysqli_query($conn, "SELECT * FROM asset_suratjalan WHERE peminjaman_id = '$id' ORDER BY id DESC");
                          while($get_suratjalan = mysqli_fetch_array($q_get_suratjalan)){
                            $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_suratjalan[entitas_id]'"));
                        ?>
                            <tr>
                              <td width="1%"><?php echo $no; ?></td>
                              <td>
                                <a href="#modal" data-toggle='modal' data-target='#show_detail_suratjalan' data-id='<?php echo $get_suratjalan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Surat Jalan">
                                  <?php echo "SJ".$get_suratjalan['id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?>
                                </a>
                              </td>
                              <td><?php echo $get_entitas['entitas']; ?></td>
                              <td><?php echo date("d-m-Y", strtotime($get_suratjalan['tanggal'])); ?></td>
                              <td><?php echo $get_suratjalan['expedisi']; ?></td>
                              <td>
                                <?php if($get_suratjalan['status'] == "dalam pengiriman"){ ?>
                                  <span class="badge badge-warning">dalam pengiriman</span>
                                <?php }elseif($get_suratjalan['status'] == "tiba ditujuan"){ ?>
                                  <span class="badge badge-secondary">tiba ditujuan</span>
                                <?php }elseif($get_suratjalan['status'] == "diterima & sesuai"){ ?>
                                  <span class="badge badge-success">diterima & sesuai</span>
                                <?php }elseif($get_suratjalan['status'] == "diterima tapi tidak sesuai"){ ?>
                                  <span class="badge badge-danger">diterima tapi tidak sesuai</span>
                                <?php } ?>
                              </td>
                              <td>
                                <?php if($get_suratjalan['status'] == "dalam pengiriman"){ ?>
                                  <a href="#modal" data-toggle='modal' data-target='#show_edit_suratjalan' data-id='<?php echo $get_suratjalan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Surat Jalan">
                                    <span class="fa fa-edit"></span>
                                  </a>
                                <?php } ?>
                              </td>
                            </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.col -->

          <div class="col-7">
            <div class="card">
              <div class="card-body">
                <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PEMINJAMAN ASSET</div>
                <table class="table table-sm" style="font-size: 11px">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Tipe Barang</th>
                      <th width="1%">Qty</th>
                      <th width="1%">Satuan</th>
                      <th>Catatan</th>
                      <th width="8%">Sudah Kirim</th>
                      <th width="8%">Sisa</th>
                      <th width="1%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_peminjaman_detail = mysqli_query($conn, "SELECT * FROM asset_peminjaman_detail JOIN asset_db_general ON asset_peminjaman_detail.general_code = asset_db_general.general_code WHERE peminjaman_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
                      while($get_peminjaman_detail = mysqli_fetch_array($q_get_peminjaman_detail)){
                        $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE general_code = '$get_peminjaman_detail[general_code]'"));

                        //sudah kirim dari surat jalan (non tidak sesuai)
                        $sudahkirim_dari_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sudah_kirim FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_db_detail ON asset_suratjalan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_db_general.general_code = '$get_peminjaman_detail[general_code]' AND asset_suratjalan.status <> 'diterima tapi tidak sesuai' AND peminjaman_id = '$id'"));
                    ?>
                        <tr>
                          <td width="1%"><?php echo $no; ?></td>
                          <td><?php echo $get_db_general['nama_barang']; ?></td>
                          <td><?php echo $get_db_general['tipe_barang']; ?></td>
                          <td><?php echo $get_peminjaman_detail ['qty']; ?></td>
                          <td><?php echo $get_db_general['satuan']; ?></td>
                          <td><?php echo $get_peminjaman_detail['keterangan']; ?></td>
                          <td><?php if($sudahkirim_dari_suratjalan['sudah_kirim'] < 1){ echo 0; }else{ echo $sudahkirim_dari_suratjalan['sudah_kirim']; } ?></td>
                          <td><?php echo $sisa = $get_peminjaman_detail ['qty'] - $sudahkirim_dari_suratjalan['sudah_kirim']; ?></td>
                          <td><?php if($sisa > 0){ echo "<span class='fa fa-close' style='color:red'></span>"; }else{ echo "<span class='fa fa-check' style='color:green'></span>"; } ?></td>
                        </tr>
                    <?php $no++; } ?>
                  </tbody>
                </table>

                <?php if($_SESSION['role'] == "management_asset"){ ?>
                  <div style="text-align: center; margin-top: 20px;">
                    <form method="POST" action="">
                      <input type="hidden" name="peminjaman_id" value="<?php echo $id; ?>">
                      <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin peminjaman ini sudah selesai?');" name="submit_peminjaman_completed" value="completed"><span class="fa fa-check"> Peminjaman Completed</span></button>
                    </form>
                  </div>
                <?php } ?>
                
              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_suratjalan" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="myForm" method="POST" action="">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="card-body" style="margin-top: -20px;">
              <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI SURAT JALAN</div>
              <table class="table table-sm" style="font-size: 12px;">
                <tr>
                  <td width="22%">Jenis</td>
                  <td width="1%">:</td>
                  <td>
                    <?php if($get_peminjaman['jenis'] == "tools"){ ?>
                      <span class="badge badge-info">Tools</span>
                    <?php }elseif($get_peminjaman['jenis'] == "apd"){ ?>
                      <span class="badge badge-success">APD</span>
                    <?php }elseif($get_peminjaman['jenis'] == "inventaris"){ ?>
                      <span class="badge badge-warning">Inventaris</span>
                    <?php }elseif($get_peminjaman['jenis'] == "alat ukur"){ ?>
                      <span class="badge badge-danger">Alat Ukur</span>
                    <?php } ?>
                  </td>
                </tr>
                <tr>
                  <td width="15%">Entitas</td>
                  <td width="1%">:</td>
                  <td>
                    <select name="entitas_id" style="width: 120px" required>
                      <option value="" selected disabled>--- Pilih Entitas ---</option>
                      <?php
                        $q_get_entitas = mysqli_query($conn, "SELECT * FROM asset_db_entitas ORDER BY id ASC");
                        while($get_entitas = mysqli_fetch_array($q_get_entitas)){
                      ?>
                          <option value="<?php echo $get_entitas['id']; ?>"><?php echo $get_entitas['entitas']; ?></option>
                      <?php } ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td width="15%">Tanggal</td>
                  <td width="1%">:</td>
                  <td><input type="date" name="tgl_suratjalan" style="width: 120px" required></td>
                </tr>
                <tr>
                  <td>Project</td>
                  <td>:</td>
                  <td><?php echo $get_peminjaman['kd_project']." - ".$get_project['nm_project']; ?></td>
                </tr>
                <tr>
                  <td>Peminjam</td>
                  <td>:</td>
                  <td><?php echo $get_karyawan['nama']; ?></td>
                </tr>
                <tr>
                  <td>Alamat Kirim</td>
                  <td>:</td>
                  <td><input type="text" style="width: 100%" name="alamat_kirim" required></td>
                </tr>
                <tr>
                  <td>Nama Expedisi</td>
                  <td>:</td>
                  <td><input type="text" name="expedisi" style="width: 120px" required></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>
          </div>
          <div style="text-align: center; margin-bottom: 20px; margin-top: -10px;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-success btn-sm" name="submit_surat_jalan" value="Submit"><span class="fa fa-upload"></span> Buat Surat Jalan</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_suratjalan" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Peminjaman</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myFormA" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_suratjalan" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Peminjaman</h4>
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