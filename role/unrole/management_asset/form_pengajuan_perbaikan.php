<?php
  if(!isset($_POST['entitas_id'])){
    $_SESSION['alert_warning'] = "Data Entitas tidak ditemukan!<br>Ulangi buka form perbaikan dari awal!";
    echo "<meta http-equiv='refresh' content='0;url=index.php?pages=listperbaikan'>";
  }

  $tgl_now = date('Y-m-d');

  if(isset($_POST['submit_pengajuan_perbaikan'])){
    if($_POST['submit_pengajuan_perbaikan'] == "submit"){
      $push_to_perbaikan = mysqli_query($conn, "INSERT INTO asset_perbaikan VALUES('','$_POST[entitas_id]','$_POST[kd_project]','$_POST[pelaksana]','$tgl_now','','$_POST[keterangan]','belum realisasi')");
      $last_id = $conn->insert_id;

      if($push_to_perbaikan){
        $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail ORDER BY id ASC");
        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $post_qty = "qty_".$get_db_detail['detail_code'];
          $post_harga_satuan = "harga_satuan_".$get_db_detail['detail_code'];
          $post_keterangan_perbaikan = "keterangan_perbaikan_".$get_db_detail['detail_code'];

          if($_POST[$post_qty] > 0){
            $_POST[$post_harga_satuan] = str_replace(".", "", $_POST[$post_harga_satuan]);
            mysqli_query($conn, "INSERT INTO asset_perbaikan_detail VALUES('','$last_id','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga_satuan]','$_POST[$post_keterangan_perbaikan]')");
          }
        }
      }
      $_SESSION['alert_success'] = "Data pengajuan perbaikan berhasil disimpan!";
      echo "<meta http-equiv='refresh' content='0;url=index.php?pages=listperbaikan'>";
    }
  }
?>

<!-- Content Wrapper. Contains page content -->
  <form id="myForm" method="POST" action="">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Form Pengajuan Perbaikan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Form Pengajuan</li>
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
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body row" style="text-align: center;">
                      <div class="col-3"></div>
                      <div class="col-2" align="right">
                        <img src="../../dist/img/logo/gpp-logo.png" width="25%">
                      </div>
                      <div class="col-5" align="left" style="vertical-align: middle; font-size: 13px;">
                        <div><b>FORM PENGAJUAN PERBAIKAN</b></div>
                        <div><b>PT GLOBAL PRATAMA POWERINDO</b></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-body">

                  <table class="table table-sm table-striped" style="font-size: 11px">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tipe</th>
                        <th>Tipe Detail</th>
                        <th>Merek</th>
                        <th width="1%">Tersedia</th>
                        <th width="5%">Qty</th>
                        <th width="1%">Satuan</th>
                        <th width="7%">Harga Satuan</th>
                        <th width="8%">Harga Total</th>
                        <th width="12%">Keterangan Perbaikan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        $q_get_db_tools_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_db_general.sub_barang = 'Continue' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
                        while($get_db_tools_detail = mysqli_fetch_array($q_get_db_tools_detail)){
                          $get_db_tools_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_tools_detail[general_code_id]'"));
                          $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_tools_detail[merek_id]'"));

                          $get_pengembalian_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak_sebagian) AS total_rusak_sebagian FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE asset_pengembalian.entitas_id = '$_POST[entitas_id]' AND asset_pengembalian_detail.detail_code = '$get_db_tools_detail[detail_code]'"));

                          //DATA ASSET SUDAH DIPERBAIKI
                          $sudah_diperbaiki = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS t_perbaikan FROM asset_perbaikan_realisasi JOIN asset_perbaikan ON asset_perbaikan_realisasi.perbaikan_id = asset_perbaikan.id WHERE asset_perbaikan.status = 'sudah realisasi' AND asset_perbaikan_realisasi.detail_code = '$get_db_tools_detail[detail_code]' AND entitas_id = '$_POST[entitas_id]'"));

                          $get_pengembalian_detail['total_rusak_sebagian'] = $get_pengembalian_detail['total_rusak_sebagian'] - $sudah_diperbaiki['t_perbaikan'];

                            if($get_pengembalian_detail['total_rusak_sebagian'] == 0 || $get_pengembalian_detail['total_rusak_sebagian'] == ""){
                              $get_pengembalian_detail['total_rusak_sebagian'] = 0;
                            }
                          
                      ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $get_db_tools_general['nama_barang']; ?></td>
                              <td><?php echo $get_db_tools_general['tipe_barang']; ?></td>
                              <td><?php echo $get_db_tools_detail['tipe_detail']; ?></td>
                              <td><?php echo $get_merek['merek']; ?></td>
                              <td align="center"><?php echo $get_pengembalian_detail['total_rusak_sebagian']; ?></td>
                              <td><input type="number" max="<?php echo $get_pengembalian_detail['total_rusak_sebagian']; ?>" id="qty_<?php echo $no; ?>" style="width: 100%" name="qty_<?php echo $get_db_tools_detail['detail_code']; ?>" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)"></td>
                              <td><?php echo $get_db_tools_general['satuan']; ?></td>
                              <td><input type="text" id="harga_satuan_<?php echo $no; ?>" style="width: 100%" name="harga_satuan_<?php echo $get_db_tools_detail['detail_code']; ?>" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)"></td>
                              <td><input type="text" id="harga_total_<?php echo $no; ?>" style="width: 100%" disabled></td>
                              <td><input type="text" name="keterangan_perbaikan_<?php echo $get_db_tools_detail['detail_code']; ?>" style="width: 100%"></td>
                            </tr>
                      <?php $no++; } ?>

                            <tr style="background-color: yellow; text-align: center; font-weight: bold;">
                              <td colspan="8">TOTAL HARGA</td>
                              <td colspan="3"><input type="text" id="total_pengajuan" style="width: 100%; font-weight: bold;" value="<?php echo $harga_total; ?>" disabled></td>
                            </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->


            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PENGAJUAN</div>
                  
                    <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
                      <tr>
                        <td width="40%">Nama Pelaksana</td>
                        <td width="1%">:</td>
                        <td>
                          <input type="hidden" name="pelaksana" value="<?php echo $_SESSION['nik']; ?>">
                          <?php echo $_SESSION['nama'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Entitas</td>
                        <td>:</td>
                        <td>
                          <?php
                            $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$_POST[entitas_id]'"));
                            echo $get_entitas['entitas'];
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Jenis Pengajuan</td>
                        <td>:</td>
                        <td><span class="badge badge-secondary">Perbaikan</span></td>
                      </tr>
                      <tr>
                        <td>Tanggal Pengajuan</td>
                        <td>:</td>
                        <td><?php echo date("d F Y H:i:s"); ?></td>
                      </tr>
                      <tr>
                        <td>Project</td>
                        <td>:</td>
                        <td>
                          <select class="" style="width: 100%" name="kd_project" required>
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
                        <td>Keterangan</td>
                        <td>:</td>
                        <td><input type="text" style="width: 100%" name="keterangan" placeholder="Isi keterangan pengajuan" required></td>
                      </tr>
                    </table>
                    <center>
                      <input type="hidden" name="entitas_id" value="<?php echo $_POST['entitas_id'] ?>">
                      <button type="submit" class="btn btn-success btn-sm" name="submit_pengajuan_perbaikan" value="submit" onclick="return confirm('Yakin data pengajuan sudah sesuai?')" <?php if(!isset($_POST['entitas_id'])){ echo "disabled"; } ?>>
                        <span class="fa fa-upload"></span> Submit Pengajuan
                      </button>
                    </center>
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

  <script>
    // Fungsi untuk memformat angka dengan pemisah ribuan
    function formatNumber(input) {
        var value = input.value.replace(/\D/g, '');
        var formattedValue = new Intl.NumberFormat('id-ID').format(value);
        input.value = formattedValue;
    }

    // Fungsi untuk menghitung total harga barang untuk setiap baris
    function hitungTotalHarga(index) {
        var jumlahBarang = parseFloat(document.getElementById('qty_' + index).value.replace(/\./g, '')) || 0;
        var hargaBarang = parseFloat(document.getElementById('harga_satuan_' + index).value.replace(/\./g, '')) || 0;
        
        // Hitung total harga untuk baris tersebut
        var totalHarga = jumlahBarang * hargaBarang;
        
        // Tampilkan hasil total harga dengan format ribuan
        document.getElementById('harga_total_' + index).value = new Intl.NumberFormat('id-ID').format(totalHarga);
        
        // Hitung total keseluruhan
        hitungTotalKeseluruhan();
    }

    // Fungsi untuk menghitung total keseluruhan dari semua barang
    function hitungTotalKeseluruhan() {
      var totalKeseluruhan = 0;
      var jmlData = <?php echo $no-1; ?>;
      for (var i = 1; i <= jmlData; i++) {
          var totalHarga = parseFloat(document.getElementById('harga_total_' + i).value.replace(/\./g, '')) || 0;
          totalKeseluruhan += totalHarga;
      }
      
      // Tampilkan total keseluruhan dengan format ribuan
      document.getElementById('total_pengajuan').value = new Intl.NumberFormat('id-ID').format(totalKeseluruhan);
    }
</script>