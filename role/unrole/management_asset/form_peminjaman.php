<?php
  if($_GET['pages'] == "formpeminjamantools"){
    $jenis_form = 'tools';
    $judul = 'Tools';
  }elseif($_GET['pages'] == "formpeminjamanapd"){
    $jenis_form = 'apd';
    $judul = 'APD';
  }elseif($_GET['pages'] == "formpeminjamaninventaris"){
    $jenis_form = 'inventaris';
    $judul = 'Inventaris';
  }elseif($_GET['pages'] == "formpeminjamanalatukur"){
    $jenis_form = 'alat ukur';
    $judul = 'Alat Ukur';
  }

  $total_tools = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE jenis = '$jenis_form'"));
  $jml_tools1 = $total_tools/2;
  $jml_tools1 = ceil($jml_tools1);
  $jml_tools2 = $total_tools - $jml_tools1;
  $tgl_jam = date("Y-m-d H:i:s");

  if(isset($_POST['save_draft'])){
    if($_POST['save_draft'] == "simpan"){
      //delete draft info & detail
      $get_id = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman_draft WHERE jenis = '$jenis_form' AND peminjam = '$_POST[peminjam]'"));
      mysqli_query($conn, "DELETE FROM asset_peminjaman_draft_detail WHERE draft_id = '$get_id[id]'");
      mysqli_query($conn, "DELETE FROM asset_peminjaman_draft WHERE id = '$get_id[id]'");
      
      if($_POST['kode_project'] == "non_project"){
        $push_peminjaman_draft = mysqli_query($conn, "INSERT INTO asset_peminjaman_draft VALUES('','$jenis_form','$_POST[peminjam]',NULL,'$_POST[keterangan_pinjam]')");
      }else{
        $push_peminjaman_draft = mysqli_query($conn, "INSERT INTO asset_peminjaman_draft VALUES('','$jenis_form','$_POST[peminjam]','$_POST[kode_project]','$_POST[keterangan_pinjam]')");
      }

      if($push_peminjaman_draft){
        $last_id = $conn->insert_id;
        $q_get_db_general = mysqli_query($conn, "SELECT * FROM asset_db_general WHERE jenis = '$jenis_form'");
        while($get_db_general = mysqli_fetch_array($q_get_db_general)){
          $post_qty = "qty_".$get_db_general['general_code'];
          $post_keterangan = "keterangan_".$get_db_general['general_code'];
          if($_POST[$post_qty] > 0){
            $push_draft_detail = mysqli_query($conn, "INSERT INTO asset_peminjaman_draft_detail VALUES('','$last_id','$get_db_general[general_code]','$_POST[$post_qty]','$_POST[$post_keterangan]')");
          }
        }
      }

      $_SESSION['alert_info'] = "Draft Berhasil Disimpan!";

    }
  }

  if(isset($_POST['submit_peminjaman'])){
    if($_POST['submit_peminjaman'] == "submit"){

      if($_POST[kode_project] == 'non_project'){
        $push_peminjaman = mysqli_query($conn, "INSERT INTO asset_peminjaman VALUES('','$jenis_form','$_POST[peminjam]','$tgl_jam',null,'$_POST[keterangan_pinjam]', 'waiting for MA')");
      }else{
        $push_peminjaman = mysqli_query($conn, "INSERT INTO asset_peminjaman VALUES('','$jenis_form','$_POST[peminjam]','$tgl_jam','$_POST[kode_project]','$_POST[keterangan_pinjam]', 'waiting for MA')");
      }

      if($push_peminjaman){
        $last_id = $conn->insert_id;
        $q_get_db_general = mysqli_query($conn, "SELECT * FROM asset_db_general WHERE jenis = '$jenis_form'");
        while($get_db_general = mysqli_fetch_array($q_get_db_general)){
          $post_qty = "qty_".$get_db_general['general_code'];
          $post_keterangan = "keterangan_".$get_db_general['general_code'];
          if($_POST[$post_qty] > 0){
            $push_peminjaman_detail = mysqli_query($conn, "INSERT INTO asset_peminjaman_detail VALUES('','$last_id','$get_db_general[general_code]','$_POST[$post_qty]','$_POST[$post_keterangan]')");
          }
        }
      }

      //delete draft
      $get_id_draft = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman_draft WHERE jenis = '$jenis_form' AND peminjam = '$_POST[peminjam]'"));
      mysqli_query($conn, "DELETE FROM asset_peminjaman_draft_detail WHERE draft_id = '$get_id_draft[id]'");
      mysqli_query($conn, "DELETE FROM asset_peminjaman_draft WHERE id = '$get_id_draft[id]'");

      $_SESSION['alert_success'] = "Peminjaman Berhasil Disubmit!<br>Tunggu sampai halaman diarahkan ke Peminjaman Saya";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=peminjamansaya'>";
    }
  }



  $get_peminjaman_draft = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman_draft WHERE jenis = '$jenis_form' AND peminjam = '$_SESSION[nik]'"));
  $cek_draft = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_peminjaman_draft WHERE jenis = '$jenis_form' AND peminjam = '$_SESSION[nik]'"));  
?>

<!-- Content Wrapper. Contains page content -->
  <form id="myForm" method="POST" action="">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Form Peminjaman <?php echo $judul; ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Form Peminjaman</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-body table-responsive p-0">
                  <table class="table table-sm table-responsive p-0" style="font-size: 11px">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tipe Barang</th>
                        <th width="1%" style="text-align: center; font-size: 8px">Stock Berjalan</th>
                        <th style="text-align: center; font-size: 8px;">Qty</th>
                        <th width="1%" style="font-size: 8px;">Satuan</th>
                        <th width="1%" style="font-size: 8px;">Catatan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        $total_stock = 0;
                        $q_get_db_tools_general1 = mysqli_query($conn, "SELECT * FROM asset_db_general WHERE jenis = '$jenis_form' ORDER BY nama_barang ASC, tipe_barang ASC LIMIT $jml_tools1");
                        while($get_db_tools_general1 = mysqli_fetch_array($q_get_db_tools_general1)){
                          
                          $get_peminjaman_draft_detail1 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman_draft_detail WHERE draft_id = '$get_peminjaman_draft[id]' AND general_code = '$get_db_tools_general1[general_code]'"));

                          $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail WHERE general_code_id = '$get_db_tools_general1[id]'");
                          while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){

                            // STOCK DARI REALISASI
                            $get_stock_from_realisasi = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(asset_realisasi.qty) AS total_realisasi FROM asset_realisasi JOIN asset_pengajuan ON asset_realisasi.pengajuan_id = asset_pengajuan.id WHERE asset_realisasi.detail_code = '$get_db_detail[detail_code]' AND asset_pengajuan.status = 'sudah realisasi' AND asset_pengajuan.entitas_id = '$_GET[entitas]'"));

                            //PENGURANG STOCK dari surat jalan
                            $sudahkirim_dari_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sudah_kirim FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id WHERE detail_code = '$get_db_detail[detail_code]' AND asset_suratjalan.entitas_id = '1'"));

                            //PENAMBAHAN DARI Pengembalian Approved
                            $pengembalian_approved = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS jml_kembalibaik FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE status = 'BA approved' AND detail_code = '$get_db_detail[detail_code]' AND entitas_id = '1'"));

                            //ADJUSMENT DARI STOCK OPNAME
                            $total_adjustment = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(adjustment) AS t_adjust FROM asset_stockopname_detail JOIN asset_stockopname ON asset_stockopname_detail.stockopname_id = asset_stockopname.id WHERE detail_code = '$get_db_detail[detail_code]' AND entitas_id = '1'"));

                            //DATA ASSET SUDAH DIPERBAIKI
                            $sudah_diperbaiki = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS t_perbaikan FROM asset_perbaikan_realisasi JOIN asset_perbaikan ON asset_perbaikan_realisasi.perbaikan_id = asset_perbaikan.id WHERE asset_perbaikan.status = 'sudah realisasi' AND asset_perbaikan_realisasi.detail_code = '$get_db_detail[detail_code]' AND entitas_id = '1'"));

                            $jml_stock = $get_stock_from_realisasi['total_realisasi'] - $sudahkirim_dari_suratjalan['sudah_kirim'] + $pengembalian_approved['jml_kembalibaik'] + $total_adjustment['t_adjust'] + $sudah_diperbaiki['t_perbaikan'];

                            $total_stock = $total_stock+$jml_stock;
                          }
                      ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $get_db_tools_general1['nama_barang']; ?></td>
                              <td><?php echo $get_db_tools_general1['tipe_barang']; ?></td>
                              <td align="center"><?php echo $total_stock; ?></td>
                              <td>
                                <input type="number" min="1" style="width: 40px;" name="<?php echo "qty_".$get_db_tools_general1['general_code']; ?>" value="<?php echo $get_peminjaman_draft_detail1['qty'] ?>">
                              </td>
                              <td><?php echo $get_db_tools_general1['satuan']; ?></td>
                              <td>
                                <input type="text" style="width: 80px" name="<?php echo "keterangan_".$get_db_tools_general1['general_code']; ?>" value="<?php echo $get_peminjaman_draft_detail1['keterangan'] ?>">
                              </td>
                            </tr>
                      <?php $no++; $total_stock = 0; } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-body table-responsive p-0">
                  <table class="table table-sm table-responsive p-0" style="font-size: 11px">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tipe Barang</th>
                        <th width="1%" style="text-align: center; font-size: 8px">Stock Berjalan</th>
                        <th style="text-align: center;">Qty</th>
                        <th width="1%" style="font-size: 8px;">Satuan</th>
                        <th width="1%">Catatan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $total_stock = 0;
                        $q_get_db_tools_general1 = mysqli_query($conn, "SELECT * FROM asset_db_general WHERE jenis = '$jenis_form' ORDER BY nama_barang ASC, tipe_barang ASC LIMIT $jml_tools2 OFFSET $jml_tools2");
                        while($get_db_tools_general1 = mysqli_fetch_array($q_get_db_tools_general1)){

                          $get_peminjaman_draft_detail1 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman_draft_detail WHERE draft_id = '$get_peminjaman_draft[id]' AND general_code = '$get_db_tools_general1[general_code]'"));

                          $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail WHERE general_code_id = '$get_db_tools_general1[id]'");
                          while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){

                            // STOCK DARI REALISASI
                            $get_stock_from_realisasi = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(asset_realisasi.qty) AS total_realisasi FROM asset_realisasi JOIN asset_pengajuan ON asset_realisasi.pengajuan_id = asset_pengajuan.id WHERE asset_realisasi.detail_code = '$get_db_detail[detail_code]' AND asset_pengajuan.status = 'sudah realisasi' AND asset_pengajuan.entitas_id = '$_GET[entitas]'"));

                            //PENGURANG STOCK dari surat jalan
                            $sudahkirim_dari_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sudah_kirim FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id WHERE detail_code = '$get_db_detail[detail_code]' AND asset_suratjalan.entitas_id = '1'"));

                            //PENAMBAHAN DARI Pengembalian Approved
                            $pengembalian_approved = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS jml_kembalibaik FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE status = 'BA approved' AND detail_code = '$get_db_detail[detail_code]' AND entitas_id = '1'"));

                            //ADJUSMENT DARI STOCK OPNAME
                            $total_adjustment = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(adjustment) AS t_adjust FROM asset_stockopname_detail JOIN asset_stockopname ON asset_stockopname_detail.stockopname_id = asset_stockopname.id WHERE detail_code = '$get_db_detail[detail_code]' AND entitas_id = '1'"));

                            $jml_stock = $get_stock_from_realisasi['total_realisasi'] - $sudahkirim_dari_suratjalan['sudah_kirim'] + $pengembalian_approved['jml_kembalibaik'] + $total_adjustment['t_adjust'];

                            $total_stock = $total_stock+$jml_stock;
                          }
                      ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_db_tools_general1['nama_barang']; ?></td>
                            <td><?php echo $get_db_tools_general1['tipe_barang']; ?></td>
                            <td align="center"><?php echo $total_stock; ?></td>
                            <td>
                              <input type="number" min="1" style="width: 40px;" name="<?php echo "qty_".$get_db_tools_general1['general_code']; ?>" value="<?php echo $get_peminjaman_draft_detail1['qty'] ?>">
                            </td>
                            <td><?php echo $get_db_tools_general1['satuan']; ?></td>
                            <td><input type="text" style="width: 80px" name="<?php echo "keterangan_".$get_db_tools_general1['general_code']; ?>" value="<?php echo $get_peminjaman_draft_detail1['keterangan'] ?>"></td>
                          </tr>
                      <?php $no++; $total_stock = 0; } ?>
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

          <!----------------------------------------- ROW ------------------------------------------>
          
          <div class="row">
            <div class="col-lg-8 col-12">
              <div class="card">
                <div class="card-body">
                  <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PEMINJAMAN</div>
                  
                    <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
                      <tr>
                        <td width="20%">Nama Peminjam</td>
                        <td width="1%">:</td>
                        <td>
                          <input type="hidden" name="peminjam" value="<?php echo $_SESSION['nik']; ?>">
                          <?php echo $_SESSION['nama'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td width="20%">Jenis Peminjaman</td>
                        <td width="1%">:</td>
                        <td>
                          <?php if($jenis_form == "tools"){ ?>
                            <span class="badge badge-info">Tools</span>
                          <?php }elseif($jenis_form == "apd"){ ?>
                            <span class="badge badge-success">APD</span>
                          <?php }elseif($jenis_form == "inventaris"){ ?>
                            <span class="badge badge-warning">Inventaris</span>
                          <?php }elseif($jenis_form == "alat ukur"){ ?>
                            <span class="badge badge-danger">Alat Ukur</span>
                          <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Tanggal Pinjam</td>
                        <td>:</td>
                        <td><?php echo date("d F Y H:i:s"); ?></td>
                      </tr>
                      <tr>
                        <td>Project</td>
                        <td>:</td>
                        <td>
                          <select class="" style="width: 100%" name="kode_project" required>
                            <option value="" selected disabled>--- Pilih Project ---</option>
                            <!-- <option value="non_project" <?php if($get_peminjaman_draft['kd_project'] === null AND $cek_draft>0){ echo "selected"; } ?>>Non-Project</option> -->
                            <option value="" disabled>--------------- GPP ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman_draft['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                            <option value="" disabled>--------------- GPS ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman_draft['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                            <option value="" disabled>--------------- GPW ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPW' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman_draft['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                            <option value="" disabled>--------------- GSS ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman_draft['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                            <option value="" disabled>--------------- SI ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman_draft['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Keterangan Pinjam</td>
                        <td>:</td>
                        <td><input type="text" style="width: 100%" name="keterangan_pinjam" placeholder="Isi keterangan peminjaman disini" value="<?php echo $get_peminjaman_draft['keterangan']; ?>" required></td>
                      </tr>
                    </table>
                    <center>
                      <button type="submit" class="btn btn-info btn-sm" name="save_draft" value="simpan">
                        <span class="fa fa-save"></span> Simpan Draft
                      </button>

                      <button type="submit" class="btn btn-success btn-sm" name="submit_peminjaman" value="submit" onclick="return confirm('Yakin Peminjaman sudah sesuai dengan kebutuhan?')">
                        <span class="fa fa-send"></span> Submit Peminjaman
                      </button>
                    </center>
                  
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-12">
              <div class="card">
                <div class="card-body" style="text-align: center;">
                  <img src="../../dist/img/logo/gpp-logo.png" width="30%" style="margin-bottom: 30px;">
                  <div><b>FORM PEMINJAMAN <?php echo strtoupper($judul); ?></b></div>
                  <div style="margin-bottom: 15px"><b>PT GLOBAL PRATAMA POWERINDO</b></div>
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
  </form>

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>