<?php
$harga_raw = $_POST['harga_satuan'];
$harga_satuan = preg_replace('/[^\d]/', '', $harga_raw); // hasil: 1500000

  if(isset($_POST['submit_add_data_asset'])){
    if($_POST['submit_add_data_asset'] == "Tambah"){
      $push_add_data_asset = mysqli_query($conn, "INSERT INTO ga_asset VALUES('', '$_POST[nama_asset]', '$_POST[detail_asset]', '$_POST[jenis_id]', '$_POST[tgl_perolehan]', '$_POST[qty]', '$_POST[satuan]', '$harga_satuan', '$_POST[metode_penyusutan]', '$_POST[umur_manfaat]', '$_POST[lokasi_asset]')");

      if($push_add_data_asset){
        $_SESSION['alert_success'] = "Berhasil! Asset Baru Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Asset Baru gagal Ditambahkan";
      }
    }
  }

  if(isset($_POST['submit_edit_asset'])){
    if($_POST['submit_edit_asset'] == "Simpan"){
      $push_edit_asset = mysqli_query($conn, "UPDATE ga_asset SET nama_asset = '$_POST[nama_asset]', detail_asset = '$_POST[detail_asset]', jenis_id = '$_POST[jenis_id]', tgl_perolehan = '$_POST[tgl_perolehan]', qty = '$_POST[qty]', satuan = '$_POST[satuan]', harga_satuan = '$harga_satuan', metode_penyusutan = '$_POST[metode_penyusutan]', umur_manfaat = '$_POST[umur_manfaat]', lokasi_asset = '$_POST[lokasi_asset]' WHERE id = '$_POST[id]'");

      if($push_edit_asset){
        $_SESSION['alert_success'] = "Berhasil! Asset Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Asset Gagal Diubah <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['delete_asset'])){
    if($_POST['delete_asset'] == "delete"){
      $delete_asset = mysqli_query($conn, "DELETE FROM ga_asset WHERE id = '$_POST[id]'");

      if($delete_asset){
        $_SESSION['alert_success'] = "Berhasil! Asset Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Asset Gagal Dihapus <br>".mysqli_error($conn);
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
            <h1>Data Asset</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Asset</li>
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
              <div class="card-header">
                  <h3 class="card-title float-sm-right" style="font-size: 12px;">
                    <a href="#modal" data-toggle='modal' data-target='#show_add_data_asset' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Asset">
                      <span class="fa fa-plus"></span> Tambah Asset
                    </a>
                  </h3>
                </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th>Nama Asset</th>
                      <th>Detail Asset</th>
                      <th>Jenis</th>
                      <th width="1%">Tgl Perolehan</th>
                      <th width="1%">Qty</th>
                      <th width="10%">Harga Satuan</th>
                      <th width="1%">Metode Penyusutan</th>
                      <th width="1%">Umur Manfaat</th>
                      <th>Lokasi Asset</th>
                      <th width="10%">Nilai Satuan Hari Ini</th>
                      <th width="10%">Total Nilai Hari Ini</th>
                      <th width="6%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_data_asset = mysqli_query($conn, "SELECT t1.id, t1.nama_asset, t1.detail_asset, t1.jenis_id, t1.tgl_perolehan, t1.qty, t1.satuan, t1.harga_satuan, t1.metode_penyusutan, t1.umur_manfaat, t1.lokasi_asset, t2.jenis FROM ga_asset t1 JOIN ga_jenis t2 ON t1.jenis_id = t2.id ORDER BY nama_asset ASC");
                      while($get_data_asset = mysqli_fetch_array($q_get_data_asset)){
                        $get_ruangan = mysqli_fetch_array(mysqli_query($conn, "SELECT nm_ruangan FROM ga_ruangan WHERE id = '$get_data_asset[lokasi_asset]'"));
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT nama FROM karyawan WHERE nik = '$get_data_asset[lokasi_asset]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $get_data_asset['nama_asset']; ?></td>
                        <td><?php echo $get_data_asset['detail_asset']; ?></td>
                        <td><?php echo $get_data_asset['jenis']; ?></td>
                        <td><?php echo $get_data_asset['tgl_perolehan']; ?></td>
                        <td><?php echo $get_data_asset['qty']." ".$get_data_asset['satuan']; ?></td>
                        <td><?php echo "Rp " . number_format($get_data_asset['harga_satuan'], 0, ',', '.'); ?></td>
                        <td><?php echo $get_data_asset['metode_penyusutan']; ?></td>
                        <td><?php echo $get_data_asset['umur_manfaat']; ?></td>
                        <td>
                          <?php
                            if($get_karyawan['nama'] <> ""){
                              echo $get_karyawan['nama'];
                            }elseif($get_ruangan['nm_ruangan'] <> ""){
                              echo $get_ruangan['nm_ruangan'];
                            }
                          ?>    
                        </td>
                        <td>
                          <?php
                            $jml_tahun = $get_data_asset['umur_manfaat'];
                            $tanggal_akhir = date('Y-m-d', strtotime($get_data_asset['tgl_perolehan'] . "+$jml_tahun years"));
                            $total_hari = (strtotime($tanggal_akhir) - strtotime($get_data_asset['tgl_perolehan'])) / 86400;

                            $hari_ini = time(); // timestamp sekarang
                            $hari_berjalan = floor(($hari_ini -  strtotime($get_data_asset['tgl_perolehan'])) / 86400);
                            $harga_hari_ini = $get_data_asset['harga_satuan'] - ($get_data_asset['harga_satuan']/$total_hari*$hari_berjalan);

                            if($hari_berjalan <1){
                              $harga_hari_ini = $get_data_asset['harga_satuan'];
                            }
                            echo "Rp " . number_format($harga_hari_ini, 0, ',', '.');
                          ?>    
                        </td>
                        <td><?php echo "Rp " . number_format($harga_hari_ini*$get_data_asset['qty'], 0, ',', '.'); ?></td>
                        <td style="font-size: 14px;">
                          <form id="myFormA" method="POST" action="">
                            <input type="hidden" name="id" value="<?php echo $get_data_asset['id']; ?>">
                            <a href="#modal" class="btn btn-info btn-xs btn-flat" data-toggle='modal' data-target='#show_edit_dataasset' data-id='<?php echo $get_data_asset['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                            <button type="submit" class="btn btn-danger btn-xs btn-flat" name="delete_asset" value="delete" onclick="return confirm('Yakin Delete Asset : <?php echo $get_data_asset['nama_asset']; ?>')">
                              <span class="fa fa-close"></span>
                            </button>
                          </form>
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

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_data_asset" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Asset</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="myForm" method="POST" action="">
          <div class="modal-body">
            <table class="table table-sm" style="font-size: 11px;">
              <tr>
                <td width="26%" style="vertical-align: middle;">Nama Asset</td>
                <td width="1%" style="vertical-align: middle;">:</td>
                <td><input class="form-control form-control-sm" type="text" name="nama_asset" required></td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Detail Asset</td>
                <td style="vertical-align: middle;">:</td>
                <td style="vertical-align: middle;">
                  <input class="form-control form-control-sm" type="text" name="detail_asset" required>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Jenis Asset</td>
                <td style="vertical-align: middle;">:</td>
                <td style="vertical-align: middle;">
                  <select class="form-control form-control-sm" name="jenis_id" required>
                    <option value="" disabled selected>--- Pilih Jenis ---</option>
                    <?php
                      $q_get_jenis = mysqli_query($conn, "SELECT * FROM ga_jenis");
                      while($get_jenis = mysqli_fetch_array($q_get_jenis)){
                    ?>
                        <option value="<?php echo $get_jenis['id']; ?>"><?php echo $get_jenis['jenis']; ?></option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Tanggal Perolehan</td>
                <td style="vertical-align: middle;">:</td>
                <td style="vertical-align: middle;">
                  <input class="form-control form-control-sm" type="date" name="tgl_perolehan" required>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Qty</td>
                <td style="vertical-align: middle;">:</td>
                <td style="vertical-align: middle;">
                  <input class="form-control form-control-sm" type="number" name="qty" required>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Satuan</td>
                <td style="vertical-align: middle;">:</td>
                <td style="vertical-align: middle;">
                  <select class="form-control form-control-sm" name="satuan" required>
                    <option value="" disabled selected>--- Pilih Satuan ---</option>
                    <option value="Pcs">Pcs</option>
                    <option value="Unit">Unit</option>
                    <option value="Set">Set</option>
                    <option value="Lot">Lot</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Harga Satuan</td>
                <td style="vertical-align: middle;">:</td>
                <td style="vertical-align: middle;">
                  <input class="form-control form-control-sm" type="text" id="rupiah" name="harga_satuan" required>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Metode Penyusutan</td>
                <td style="vertical-align: middle;">:</td>
                <td style="vertical-align: middle;">
                  <select class="form-control form-control-sm" name="metode_penyusutan" required>
                    <option value="" disabled selected>--- Pilih Metode ---</option>
                    <option value="Garis Lurus">Garis Lurus</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Umur Manfaat</td>
                <td style="vertical-align: middle;">:</td>
                <td style="vertical-align: middle;">
                  <input class="form-control form-control-sm" type="number" name="umur_manfaat" required>
                </td>
              </tr>
              <tr>
                <td style="vertical-align: middle;">Lokasi Asset</td>
                <td style="vertical-align: middle;">:</td>
                <td style="vertical-align: middle;">
                  <select class="form-control form-control-sm" name="lokasi_asset" required>
                    <option value="" disabled selected>--- Pilih Lokasi Asset ---</option>
                    <optgroup label="RUANGAN">
                    <?php
                      $q_get_ruangan = mysqli_query($conn, "SELECT * FROM ga_ruangan");
                      while($get_ruangan = mysqli_fetch_array($q_get_ruangan)){
                    ?>
                        <option value="<?php echo $get_ruangan['id']; ?>"><?php echo $get_ruangan['nm_ruangan']; ?></option>
                    <?php } ?>

                    <optgroup label="KARYAWAN">
                    <?php
                      $q_get_karyawan = mysqli_query($conn, "SELECT nik, nama FROM karyawan WHERE nama <> 'Fadhli Aoliana' AND nama <> 'Winda Fauziah'");
                      while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
                    ?>
                        <option value="<?php echo $get_karyawan['nik']; ?>"><?php echo $get_karyawan['nama']; ?></option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-info float-right" name="submit_add_data_asset" value="Tambah">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_dataasset" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Asset</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
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

  <script>
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('input', function (e) {
      let value = this.value.replace(/[^,\d]/g, '').toString();
      let split = value.split(',');
      let sisa = split[0].length % 3;
      let rupiah = split[0].substr(0, sisa);
      let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
      this.value = 'Rp ' + rupiah;
    });
  </script>