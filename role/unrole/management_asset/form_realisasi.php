<?php
  $id = $_GET['id'];
  $cek_data_realisasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_realisasi WHERE pengajuan_id = '$id'"));

  if($cek_data_realisasi < 1){
    $q_get_pengjuan_detail = mysqli_query($conn, "SELECT * FROM asset_pengajuan_detail WHERE pengajuan_id = '$id'");
    
    //Push realisasi from pengajuan
    while($get_pengajuan_detail = mysqli_fetch_array($q_get_pengjuan_detail)){
      $push_realisasi = mysqli_query($conn, "INSERT INTO asset_realisasi VALUES('','$id','$get_pengajuan_detail[detail_code]','$get_pengajuan_detail[qty]',$get_pengajuan_detail[harga_satuan])");
    }
  }

  $get_pengajuan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE id = '$id'"));
  $get_pelaksana = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengajuan[pelaksana]'"));
  $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengajuan[entitas_id]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_pengajuan[kd_project]'"));

  if(isset($_POST['add_barang_realisasi'])){
    if($_POST['add_barang_realisasi'] == "add_barang_realisasi"){
      $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail");
      while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
        $post_qty = "qty_".$get_db_detail['detail_code'];
        $post_harga = "harga_satuan_".$get_db_detail['detail_code'];
        $_POST[$post_qty] = str_replace('.', '', $_POST[$post_qty]);
        $_POST[$post_harga] = str_replace('.', '', $_POST[$post_harga]);

        if($_POST[$post_qty]>0){
          //Push to realisasi
          $push_realisasi = mysqli_query($conn, "INSERT INTO asset_realisasi VALUES('','$_POST[pengajuan_id]','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga]')");
        }
      }
      $_SESSION['alert_success'] = "Berhasil menambahkan barang!";
    }
  }

  if(isset($_POST['delete_barang_realisasi'])){
    if($_POST['delete_barang_realisasi'] == "Delete"){
      $delete_barang_realisasi = mysqli_query($conn, "DELETE FROM asset_realisasi WHERE id = '$_POST[id]'");

      if($delete_barang_realisasi){
        $_SESSION['alert_success'] = "Barang Berhasil Dihapus!";
      }else{
        $_SESSION['alert_danger'] = "Barang Gagal Dihapus!";
      }
    }
  }

  if(isset($_POST['reset_form_realisasi'])){
    if($_POST['reset_form_realisasi'] == "reset"){
      //delete realisasi
      $delete_realisasi = mysqli_query($conn, "DELETE FROM asset_realisasi WHERE pengajuan_id = '$_POST[pengajuan_id]'");

      //Push realisasi from pengajuan
      $q_get_pengjuan_detail = mysqli_query($conn, "SELECT * FROM asset_pengajuan_detail WHERE pengajuan_id = '$_POST[pengajuan_id]'");
      while($get_pengajuan_detail = mysqli_fetch_array($q_get_pengjuan_detail)){
        $push_realisasi = mysqli_query($conn, "INSERT INTO asset_realisasi VALUES('','$_POST[pengajuan_id]','$get_pengajuan_detail[detail_code]','$get_pengajuan_detail[qty]',$get_pengajuan_detail[harga_satuan])");
      }

      $_SESSION['alert_info'] = "Form Realisasi Berhasil Direset!";
    }
  }

  if(isset($_POST['simpan_form_realisasi'])){
    if($_POST['simpan_form_realisasi'] == "simpan"){
      //delete realisasi
      $delete_realisasi = mysqli_query($conn, "DELETE FROM asset_realisasi WHERE pengajuan_id = '$_POST[pengajuan_id]'");

      //Simpan realisasi baru
      $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail");
      while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
        $post_qty = "qty_".$get_db_detail['detail_code'];
        $post_harga = "harga_satuan_".$get_db_detail['detail_code'];

        if(isset($_POST[$post_qty])){
          $_POST[$post_qty] = str_replace('.', '', $_POST[$post_qty]);
          $_POST[$post_harga] = str_replace('.', '', $_POST[$post_harga]);
          
          //Push to realisasi
          $push_realisasi = mysqli_query($conn, "INSERT INTO asset_realisasi VALUES('','$_POST[pengajuan_id]','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga]')");
        }
      }
      $_SESSION['alert_info'] = "Form Realisasi Berhasil Disimpan!";
    }
  }

  if(isset($_POST['submit_form_realisasi'])){
    if($_POST['submit_form_realisasi'] == "submit"){
      if($_POST['tgl_realisasi'] == ""){
        //delete realisasi
        $delete_realisasi = mysqli_query($conn, "DELETE FROM asset_realisasi WHERE pengajuan_id = '$_POST[pengajuan_id]'");

        //Simpan realisasi baru
        $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail");
        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $post_qty = "qty_".$get_db_detail['detail_code'];
          $post_harga = "harga_satuan_".$get_db_detail['detail_code'];

          if(isset($_POST[$post_qty])){
            $_POST[$post_qty] = str_replace('.', '', $_POST[$post_qty]);
            $_POST[$post_harga] = str_replace('.', '', $_POST[$post_harga]);
            
            //Push to realisasi
            $push_realisasi = mysqli_query($conn, "INSERT INTO asset_realisasi VALUES('','$_POST[pengajuan_id]','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga]')");
          }
        }
        $_SESSION['alert_warning'] = "Harap isi tanggal realisasi terlebih dahulu!";

      }else{
        //delete realisasi
        $delete_realisasi = mysqli_query($conn, "DELETE FROM asset_realisasi WHERE pengajuan_id = '$_POST[pengajuan_id]'");

        //Simpan realisasi baru
        $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail");
        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $post_qty = "qty_".$get_db_detail['detail_code'];
          $post_harga = "harga_satuan_".$get_db_detail['detail_code'];

          if(isset($_POST[$post_qty])){
            $_POST[$post_qty] = str_replace('.', '', $_POST[$post_qty]);
            $_POST[$post_harga] = str_replace('.', '', $_POST[$post_harga]);
            
            //Push to realisasi
            $push_realisasi = mysqli_query($conn, "INSERT INTO asset_realisasi VALUES('','$_POST[pengajuan_id]','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga]')");
          }
        }

        //Edit pengajuan menjadi sudah realisasi
        $update_pengajuan = mysqli_query($conn, "UPDATE asset_pengajuan SET tgl_realisasi = '$_POST[tgl_realisasi]', status = 'sudah realisasi' WHERE id = '$_POST[pengajuan_id]'");
        if($update_pengajuan){
          echo "<meta http-equiv='refresh' content='0;url=index.php?pages=pengajuancompleted'>";
          $_SESSION['alert_info'] = "Form Realisasi Berhasil Disubmit!<br>Tunggu sampai halaman diarahkan ke halaman selanjutnya!";
        }else{
          $_SESSION['alert_info'] = "OK";
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Realisasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Realisasi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <form id="myFormA" method="POST" action="">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PENGAJUAN</div>
                  <table class="table table-sm" style="font-size: 11px; margin-bottom: 15px;">
                    <tr>
                      <td width="15%">No Pengajuan</td>
                      <td width="1%">:</td>
                      <td><b><?php echo "PN".$id."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></b></td>
                    </tr>
                    <tr>
                      <td width="15%">Nama Pelaksana</td>
                      <td width="1%">:</td>
                      <td><?php echo $get_pelaksana['nama']; ?></td>
                    </tr>
                    <tr>
                      <td>Entitas</td>
                      <td>:</td>
                      <td><?php echo $get_entitas['entitas']; ?></td>
                    </tr>
                    <tr>
                      <td>Jenis Pengajuan</td>
                      <td>:</td>
                      <td>
                        <?php if($get_pengajuan['jenis'] == "tools"){ ?>
                          <span class="badge badge-info">Tools</span>
                        <?php }elseif($get_pengajuan['jenis'] == "apd"){ ?>
                          <span class="badge badge-success">APD</span>
                        <?php }elseif($get_pengajuan['jenis'] == "inventaris"){ ?>
                          <span class="badge badge-warning">Inventaris</span>
                        <?php }elseif($get_pengajuan['jenis'] == "alat ukur"){ ?>
                          <span class="badge badge-danger">Alat Ukur</span>
                        <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Tanggal Pengajuan</td>
                      <td>:</td>
                      <td><?php echo date("d F Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Realisasi</td>
                      <td>:</td>
                      <td><input type="date" width="100px" name="tgl_realisasi"></td>
                    </tr>
                    <tr>
                      <td>Project</td>
                      <td>:</td>
                      <td><?php echo $get_pengajuan['kd_project']." - ".$get_project['nm_project']; ?></td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>:</td>
                      <td><?php echo $get_pengajuan['keterangan']; ?></td>
                    </tr>
                    <tr>
                      <td colspan="3"></td>
                    </tr>
                  </table>

                  <div style="margin-bottom: 10px; text-align: center;">
                    <b>DETAIL BARANG</b>
                    <a href="#modal" data-toggle='modal' data-target='#show_add_barang_realisasi' data-id='<?php echo $id; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Barang">
                      <small><div style="float: right;" class="btn btn-xs btn-info"><span class="fa fa-plus"></span> Tambah Barang</div></small>
                    </a>
                  </div>
                  <table class="table table-sm" style="font-size: 11px">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tipe Barang</th>
                        <th>Tipe Detail</th>
                        <th>Merek</th>
                        <th width="1%">Qty</th>
                        <th width="1%">Satuan</th>
                        <th>Total Harga</th>
                        <th width="5%" style="background-color: lightgray;">Qty Realisasi</th>
                        <th width="8%" style="background-color: lightgray;">Realisasi Satuan</th>
                        <th width="8%" style="background-color: lightgray;">Total Realisasi</th>
                        <th width="8%" style="background-color: lightgray;">Sisa Uang</th>
                        <th style="background-color: lightgray; text-align: center;">
                          <span class="fa fa-trash" style="font-size: 14px; color: red;"></span>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        $total_harga = 0;
                        $q_get_realisasi_detail = mysqli_query($conn, "SELECT * FROM asset_realisasi JOIN asset_db_detail ON asset_realisasi.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE pengajuan_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
                        while($get_realisasi_detail = mysqli_fetch_array($q_get_realisasi_detail)){

                          $get_db_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_detail WHERE detail_code = '$get_realisasi_detail[detail_code]'"));

                          $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_detail[general_code_id]'"));

                          $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_detail[merek_id]'"));

                          $get_pengajuan_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengajuan_detail WHERE pengajuan_id = '$id' AND detail_code = '$get_realisasi_detail[detail_code]'"));

                          $get_realisasi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_realisasi WHERE pengajuan_id = '$id' AND detail_code = '$get_db_detail[detail_code]'"));

                          $total_harga = $total_harga + ($get_pengajuan_detail['qty'] * $get_pengajuan_detail['harga_satuan']);
                          $total_realisasi = $total_realisasi + ($get_realisasi_detail['qty']*$get_realisasi_detail['harga_satuan']);
                          $total_sisa = $total_sisa + (($get_pengajuan_detail['qty']*$get_pengajuan_detail['harga_satuan'])-($get_realisasi_detail['qty']*$get_realisasi_detail['harga_satuan']));
                      ?>
                          <tr>
                            <td width="1%"><?php echo $no; ?></td>
                            <td><?php echo $get_db_general['nama_barang']; ?></td>
                            <td><?php echo $get_db_general['tipe_barang']; ?></td>
                            <td><?php echo $get_db_detail['tipe_detail']; ?></td>
                            <td><?php echo $get_merek['merek']; ?></td>
                            <td><?php echo $get_pengajuan_detail['qty']; ?></td>
                            <td><?php echo $get_db_general['satuan']; ?></td>
                            <td>
                              <?php echo "Rp ".number_format($get_pengajuan_detail['qty']*$get_pengajuan_detail['harga_satuan'], 0, ',', '.'); ?>
                              <input type="hidden" id="nilai_pengajuan_<?php echo $no; ?>" style="width: 100%" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)" value="<?php echo $get_pengajuan_detail['qty']*$get_pengajuan_detail['harga_satuan']; ?>">
                            </td>
                            <td>
                              <input type="text" id="qty_<?php echo $no; ?>" style="width: 100%" name="qty_<?php echo $get_db_detail['detail_code']; ?>" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)" value="<?php echo number_format($get_realisasi_detail['qty'], 0, ',', '.'); ?>">
                            </td>
                            <td>
                              <input type="text" id="harga_satuan_<?php echo $no; ?>" style="width: 100%" name="harga_satuan_<?php echo $get_db_detail['detail_code']; ?>" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)" value="<?php echo number_format($get_realisasi_detail['harga_satuan'], 0, ',', '.'); ?>">
                            </td>
                            <td><input type="text" id="harga_total_<?php echo $no; ?>" style="width: 100%" value="<?php echo number_format($get_realisasi_detail['qty']*$get_realisasi_detail['harga_satuan'], 0, ',', '.'); ?>" disabled></td>
                            <td>
                              <input type="text" id="sisa_uang_<?php echo $no; ?>" style="width: 100%" value="<?php echo number_format(($get_pengajuan_detail['qty']*$get_pengajuan_detail['harga_satuan'])-($get_realisasi_detail['qty']*$get_realisasi_detail['harga_satuan']), 0, ',', '.'); ?>" disabled>
                            </td>
                            <td align="center">
                              <?php
                                $cek_pengajuan_detail = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_pengajuan_detail WHERE pengajuan_id = '$id' AND detail_code = '$get_realisasi_detail[detail_code]'"));
                                if($cek_pengajuan_detail<1){
                              ?>
                                    <a href="#modal" data-toggle='modal' data-target='#show_delete_barang_realisasi' data-id='<?php echo $get_realisasi['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Barang">
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
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: center;">
                  <input type="hidden" name="pengajuan_id" value="<?php echo $id; ?>">

                  <button type="submit" class="btn btn-info btn-sm" name="simpan_form_realisasi" value="simpan">
                    <span class="fa fa-save"> Simpan</span>
                  </button>

                  <button type="submit" class="btn btn-danger btn-sm" name="reset_form_realisasi" value="reset" onclick="return confirm('Form realisasi akan dikembalikan ke awal, anda yakin?');">
                    <span class="fa fa-rotate-left"> Reset</span>
                  </button>

                  <button type="submit" class="btn btn-success btn-sm" name="submit_form_realisasi" value="submit" onclick="return confirm('Yakin data realisasi sudah benar?');">
                    <span class="fa fa-upload"> Submit</span>
                  </button>
                </div>
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
    </form>


  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_barang_realisasi" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang Realisasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" method="POST" action="">
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
  <div class="modal fade" id="show_delete_barang_realisasi" role="dialog">
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