<?php
  $id = $_GET['id'];
  $tgl_now = date('Y-m-d');

  if(isset($_POST['reset_pengajuan_perbaikan'])){
    if($_POST['reset_pengajuan_perbaikan'] == "reset"){
      //delete data realisasi perbaikan
      $delete_realisasi_perbaikan_all = mysqli_query($conn, "DELETE FROM asset_perbaikan_realisasi WHERE perbaikan_id = '$_POST[perbaikan_id]'");

      if($delete_realisasi_perbaikan_all){
        $_SESSION['alert_success'] = "Form berhasil direset";
      }else{
        $_SESSION['alert_error'] = "Gagal! Form gagal direset";
      }
    }
  }

  // Get Data Asset Detail From perbaikan detail to perbaikan realisasi
  $q_get_perbaikan_detail = mysqli_query($conn, "SELECT * FROM asset_perbaikan_detail WHERE perbaikan_id = '$id'");
  $cek_perbaikan_realisasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_perbaikan_realisasi WHERE perbaikan_id = '$id'"));

  if($cek_perbaikan_realisasi < 1){
    while($get_perbaikan_detail = mysqli_fetch_array($q_get_perbaikan_detail)){
      $push_to_perbaikan_realisasi = mysqli_query($conn, "INSERT INTO asset_perbaikan_realisasi VALUES('','$id','$get_perbaikan_detail[detail_code]','$get_perbaikan_detail[qty]','$get_perbaikan_detail[harga_satuan]')");
    }
  }
  

  $get_perbaikan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_perbaikan WHERE id = '$_GET[id]'"));
  $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_perbaikan[entitas_id]'"));
  $get_pelaksana = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_perbaikan[pelaksana]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_perbaikan[kd_project]'"));

  if(isset($_POST['add_barang_realisasi_perbaikan'])){
    if($_POST['add_barang_realisasi_perbaikan'] == "tambahkan"){
      $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail");
      while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
        $post_qty = "qty_".$get_db_detail['detail_code'];
        $post_harga_satuan = "harga_satuan_".$get_db_detail['detail_code'];
        $_POST[$post_harga_satuan] = str_replace(".", "", $_POST[$post_harga_satuan]);

        if($_POST[$post_qty] > 0){
          mysqli_query($conn, "INSERT INTO asset_perbaikan_realisasi VALUES('','$_POST[perbaikan_id]','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga_satuan]')");
        }

      }
      $_SESSION['alert_success'] = "Data barang realisasi perbaikan berhasil ditambah";
    }
  }

  if(isset($_POST['delete_barang_realisasi_perbaikan'])){
    if($_POST['delete_barang_realisasi_perbaikan'] == "Delete"){
      $delete_realisasi_perbaikan = mysqli_query($conn, "DELETE FROM asset_perbaikan_realisasi WHERE id = '$_POST[id]'");

      if($delete_realisasi_perbaikan){
        $_SESSION['alert_success'] = "Barang berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Barang gagal dihapus";
      }
    }
  }

  if(isset($_POST['simpan_pengajuan_perbaikan'])){
    if($_POST['simpan_pengajuan_perbaikan'] == "simpan"){
      //delete data realisasi perbaikan
      $delete_realisasi_perbaikan_all = mysqli_query($conn, "DELETE FROM asset_perbaikan_realisasi WHERE perbaikan_id = '$_POST[perbaikan_id]'");

      if($delete_realisasi_perbaikan_all){
        //Push Data Baru
        $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail");
        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $post_qty = "qty_".$get_db_detail['detail_code'];
          $post_harga_satuan = "harga_satuan_".$get_db_detail['detail_code'];
          $_POST[$post_harga_satuan] = str_replace(".", "", $_POST[$post_harga_satuan]);
       
          if($_POST[$post_qty] > 0){
            mysqli_query($conn, "INSERT INTO asset_perbaikan_realisasi VALUES('','$_POST[perbaikan_id]','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga_satuan]')");
          }
        }
        $_SESSION['alert_success'] = "Form berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Form gagal disimpan";
      }
    }
  }

  if(isset($_POST['submit_pengajuan_perbaikan'])){
    if($_POST['submit_pengajuan_perbaikan'] == "submit"){
      //delete data realisasi perbaikan
      $delete_realisasi_perbaikan_all = mysqli_query($conn, "DELETE FROM asset_perbaikan_realisasi WHERE perbaikan_id = '$_POST[perbaikan_id]'");

      if($delete_realisasi_perbaikan_all){
        //Push Data Baru
        $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail");
        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $post_qty = "qty_".$get_db_detail['detail_code'];
          $post_harga_satuan = "harga_satuan_".$get_db_detail['detail_code'];
          $_POST[$post_harga_satuan] = str_replace(".", "", $_POST[$post_harga_satuan]);
       
          if($_POST[$post_qty] > 0){
            mysqli_query($conn, "INSERT INTO asset_perbaikan_realisasi VALUES('','$_POST[perbaikan_id]','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga_satuan]')");
          }
        }

        mysqli_query($conn, "UPDATE asset_perbaikan SET tgl_realisasi = '$_POST[tgl_realisasi]', status = 'sudah realisasi' WHERE id = '$_POST[perbaikan_id]'");
        $_SESSION['alert_success'] = "Realisasi berhasil disubmit<br><b>Tunggu sampai halaman selesai diarahkan!</b>";
        echo "<meta http-equiv='refresh' content='0;url=index.php?pages=listperbaikan'";
      }else{
        $_SESSION['alert_error'] = "Gagal! Realisasi gagal disubmit";
      }
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
              <h1>Realisasi Perbaikan</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Realisasi Perbaikan</li>
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
                      <div class="col-2"></div>
                      <div class="col-2" align="right">
                        <img src="../../dist/img/logo/gpp-logo.png" width="25%">
                      </div>
                      <div class="col-5" align="left" style="vertical-align: bottom; font-size: 22px;">
                        <b>REALISASI PENGAJUAN PERBAIKAN</b>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PENGAJUAN PERBAIKAN</div>
                  <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
                    <tr>
                      <td width="25%">No Perbaikan</td>
                      <td width="1%">:</td>
                      <td>
                        <?php echo $id."FIX/MA/".date('m/Y', strtotime($get_perbaikan['tgl_pengajuan'])); ?>
                      </td>
                    </tr>
                    <tr>
                      <td width="25%">Nama Pelaksana</td>
                      <td width="1%">:</td>
                      <td>
                        <input type="hidden" name="pelaksana" value="<?php echo $_SESSION['nik']; ?>">
                        <?php echo $get_pelaksana['nama']; ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Entitas</td>
                      <td>:</td>
                      <td>
                        <?php
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
                      <td><?php echo date("d F Y", strtotime($get_perbaikan['tgl_pengajuan'])); ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Realisasi</td>
                      <td>:</td>
                      <td><input type="date" name="tgl_realisasi" <?php if($get_perbaikan['status'] == "sudah realisasi"){ echo "value='".$get_perbaikan['tgl_realisasi']."'"; } ?> required></td>
                    </tr>
                    <tr>
                      <td>Project</td>
                      <td>:</td>
                      <td><?php echo $get_perbaikan['kd_project']." - ".$get_project['nm_project']; ?></td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td><?php echo $get_perbaikan['keterangan']; ?></td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>:</td>
                      <td>
                        <?php
                          if($get_perbaikan['status'] == "belum realisasi"){
                            echo "<div class='badge badge-warning'>Belum Realisasi</div>";
                          }else{
                            echo "<div class='badge badge-success'>Sudah Realisasi</div>";
                          }
                        ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-body">

                  <div style="margin-bottom: 10px; text-align: center;">
                    <b>DETAIL ASSET</b>
                    <a href="#modal" data-toggle='modal' data-target='#show_add_asset_realisasi_perbaikan' data-id='<?php echo $id; ?>' data-toggle="tooltip" data-placement="bottom" title="Add barang">
                      <small><div style="float: right;" class="btn btn-xs btn-info"><span class="fa fa-plus"></span> Tambah Barang</div></small>
                    </a>
                  </div>
                  <table class="table table-sm table-striped" style="font-size: 11px">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tipe Barang</th>
                        <th>Tipe Detail</th>
                        <th>Merek</th>
                        <th width="1%">Qty</th>
                        <th width="1%">Satuan</th>
                        <th width="7%">Total Harga</th>
                        <th width="1%" style="background-color: lightgray;">Qty Realisasi</th>
                        <th width="7%" style="background-color: lightgray;">Realisasi Satuan</th>
                        <th width="7%" style="background-color: lightgray;">Total Realisasi</th>
                        <th width="7%" style="background-color: lightgray;">Sisa Uang</th>
                        <th width="3%" style="background-color: lightgray;">
                          <span class="fa fa-trash" style="color: red; font-size: 14px;"></span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        $total_harga = 0;
                        
                        $q_get_perbaikan_realisasi = mysqli_query($conn, "SELECT asset_perbaikan_realisasi.id AS perbaikan_realisasi_id, asset_perbaikan_realisasi.*, asset_db_detail.*, asset_db_general.*, asset_db_merek.* FROM asset_perbaikan_realisasi JOIN asset_db_detail ON asset_perbaikan_realisasi.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE perbaikan_id = '$id' ORDER BY nama_barang, tipe_barang ASC");
                        while($get_perbaikan_realisasi = mysqli_fetch_array($q_get_perbaikan_realisasi)){
                          $jumlah_harga = 0;
                          $jumlah_harga = $get_perbaikan_realisasi['qty']*$get_perbaikan_realisasi['harga_satuan'];

                          $get_pengajuan_perbaikan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_perbaikan_detail WHERE perbaikan_id = '$id' AND detail_code = '$get_perbaikan_realisasi[detail_code]'"));

                          //Cek di pengajuan perbaikan
                          $cek_pengajuan_perbaikan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_perbaikan_detail WHERE perbaikan_id = '$id' AND detail_code = '$get_perbaikan_realisasi[detail_code]'"));

                          $total_harga = $total_harga + ($get_pengajuan_perbaikan['qty'] * $get_pengajuan_perbaikan['harga_satuan']);
                          $total_realisasi = $total_realisasi + ($get_perbaikan_realisasi['qty']*$get_perbaikan_realisasi['harga_satuan']);
                          $total_sisa = $total_sisa + (($get_pengajuan_perbaikan['qty']*$get_pengajuan_perbaikan['harga_satuan'])-($get_perbaikan_realisasi['qty']*$get_perbaikan_realisasi['harga_satuan']));
                      ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $get_perbaikan_realisasi['nama_barang']; ?></td>
                              <td><?php echo $get_perbaikan_realisasi['tipe_barang']; ?></td>
                              <td><?php echo $get_perbaikan_realisasi['tipe_detail']; ?></td>
                              <td><?php echo $get_perbaikan_realisasi['merek']; ?></td>
                              <td>
                                <?php
                                  if($get_pengajuan_perbaikan['qty'] == "" ){
                                    echo "0";
                                  }else{
                                    echo $get_pengajuan_perbaikan['qty'];
                                  }
                                ?>   
                              </td>
                              <td><?php echo $get_perbaikan_realisasi['satuan']; ?></td>
                              <td>
                                <?php echo number_format($get_pengajuan_perbaikan['qty']*$get_pengajuan_perbaikan['harga_satuan'],0,',','.'); ?>
                                <input type="hidden" id="nilai_pengajuan_<?php echo $no; ?>" style="width: 100%" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)" value="<?php echo $get_pengajuan_perbaikan['qty']*$get_pengajuan_perbaikan['harga_satuan']; ?>">    
                              </td>
                              <td>
                                <input type="text" id="qty_<?php echo $no; ?>" style="width: 100%" name="qty_<?php echo $get_perbaikan_realisasi['detail_code']; ?>" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)" value="<?php echo number_format($get_perbaikan_realisasi['qty'], 0, ',', '.'); ?>">
                              </td>
                              <td>
                                <input type="text" id="harga_satuan_<?php echo $no; ?>" style="width: 100%" name="harga_satuan_<?php echo $get_perbaikan_realisasi['detail_code']; ?>" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)" value="<?php echo number_format($get_perbaikan_realisasi['harga_satuan'], 0, ',', '.'); ?>">
                              </td>
                              <td>
                                <input type="text" id="harga_total_<?php echo $no; ?>" style="width: 100%" value="<?php echo number_format($jumlah_harga, 0, ',', '.'); ?>" disabled></td>
                              </td>
                              <td>
                                <input type="text" id="sisa_uang_<?php echo $no; ?>" style="width: 100%" value="<?php echo number_format(($get_pengajuan_perbaikan['qty']*$get_pengajuan_perbaikan['harga_satuan'])-($get_perbaikan_realisasi['qty']*$get_perbaikan_realisasi['harga_satuan']), 0, ',', '.'); ?>" disabled>
                              </td>
                              <td>
                                <?php
                                  if($cek_pengajuan_perbaikan < 1){
                                ?>
                                  <a href="#modal" data-toggle='modal' data-target='#show_delete_barang_realisasi_perbaikan' data-id='<?php echo $get_perbaikan_realisasi['perbaikan_realisasi_id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Barang">
                                      <button class="btn btn-danger btn-xs"><span class="fa fa-trash"></span></button>
                                    </a>
                                <?php } ?>
                              </td>
                            </tr>
                      <?php $no++; } ?>

                            <tr style="font-weight: bold; background-color: yellow;">
                            <td colspan="7" align="center">TOTAL</td>
                            <td><?php echo "Rp ".number_format($total_harga, 0, ',', '.'); ?></td>
                            <td></td>
                            <td></td>
                            <td><input type="text" id="total_pengajuan" style="width: 100%; font-weight: bold;" value="<?php echo number_format($total_realisasi, 0, ',', '.'); ?>" disabled></td>
                            <td><input type="text" id="sisa_uang" style="width: 100%; font-weight: bold;" value="<?php echo number_format($total_sisa, 0, ',', '.'); ?>" disabled></td>
                            <td></td>
                          </tr>
                    </tbody>
                  </table>
                  <br>
                  <center>
                    <input type="hidden" name="perbaikan_id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit" class="btn btn-info btn-sm" name="simpan_pengajuan_perbaikan" value="simpan" onclick="return confirm('Simpan Form Ini?')">
                      <span class="fa fa-save"></span> Simpan
                    </button>

                    <button type="submit" class="btn btn-danger btn-sm" name="reset_pengajuan_perbaikan" value="reset" onclick="return confirm('Yakin reset form ini?')">
                      <span class="fa fa-refresh"></span> Reset
                    </button>

                    <button type="submit" class="btn btn-success btn-sm" name="submit_pengajuan_perbaikan" value="submit" onclick="return confirm('Yakin submit form ini?')">
                      <span class="fa fa-upload"></span> Submit
                    </button>
                  </center>
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
  </form>

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_asset_realisasi_perbaikan" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Realisasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myFormA" method="POST" action="">
            <table class="table table-striped table-sm" style="font-size: 10px">
              <tr>
                <th width="1%">No</th>
                <th>Nama Barang</th>
                <th>Tipe Barang</th>
                <th>Tipe Detail</th>
                <th>Merek</th>
                <th width="6%">Qty</th>
                <th>Satuan</th>
                <th width="10%">Harga Satuan</th>
              </tr>

              <?php
                $no2=1;
                $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE detail_code NOT IN (SELECT detail_code FROM asset_perbaikan_realisasi WHERE perbaikan_id = '$id') ORDER BY nama_barang, tipe_barang ASC");
                while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
              ?>
                <tr>
                  <td><?php echo $no2; ?></td>
                  <td><?php echo $get_db_detail['nama_barang']; ?></td>
                  <td><?php echo $get_db_detail['tipe_barang']; ?></td>
                  <td><?php echo $get_db_detail['tipe_detail']; ?></td>
                  <td><?php echo $get_db_detail['merek']; ?></td>
                  <td>
                    <input type="text" name="qty_<?php echo $get_db_detail['detail_code']; ?>" oninput="formatNumber(this)" style="width: 100%;">
                  </td>
                  <td><?php echo $get_db_detail['satuan']; ?></td>
                  <td>
                    <input type="text" name="harga_satuan_<?php echo $get_db_detail['detail_code']; ?>" oninput="formatNumber(this)" style="width: 100%;"> 
                  </td>
                </tr>
              <?php $no2++; } ?>
            </table>
            <br>
            <center>
              <input type="hidden" name="perbaikan_id" value="<?php echo $_GET['id']; ?>">
              <button type="submit" class="btn btn-success btn-sm" name="add_barang_realisasi_perbaikan" value="tambahkan"><span class="fa fa-upload"></span> Tambahkan</button>
            </center>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_delete_barang_realisasi_perbaikan" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="margin-top: -20px">
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
        var nilaiPengajuan = parseFloat(document.getElementById('nilai_pengajuan_' + index).value.replace(/\./g, '')) || 0;

        // Hitung total harga untuk baris tersebut
        var totalHarga = jumlahBarang * hargaBarang;
        var sisaUang = nilaiPengajuan - totalHarga;
        
        // Tampilkan hasil total harga dengan format ribuan
        document.getElementById('harga_total_' + index).value = new Intl.NumberFormat('id-ID').format(totalHarga);
        document.getElementById('sisa_uang_' + index).value = new Intl.NumberFormat('id-ID').format(sisaUang);
        
        // Hitung total keseluruhan
        hitungTotalKeseluruhan();
    }

    // Fungsi untuk menghitung total keseluruhan dari semua barang
    function hitungTotalKeseluruhan() {
      var totalKeseluruhan = 0;
      var totalSisaKeseluruhan = 0;

      var jmlData = <?php echo $no-1; ?>;
      for (var i = 1; i <= jmlData; i++) {
          var totalHarga = parseFloat(document.getElementById('harga_total_' + i).value.replace(/\./g, '')) || 0;
          totalKeseluruhan += totalHarga;

          var totalSisa = parseFloat(document.getElementById('sisa_uang_' + i).value.replace(/\./g, '')) || 0;
          totalSisaKeseluruhan += totalSisa;

      }
      
      // Tampilkan total keseluruhan dengan format ribuan
      document.getElementById('total_pengajuan').value = new Intl.NumberFormat('id-ID').format(totalKeseluruhan);
      document.getElementById('sisa_uang').value = new Intl.NumberFormat('id-ID').format(totalSisaKeseluruhan);
    }
</script>