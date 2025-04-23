<?php
  if($_GET['pages'] == "formpengajuantools"){
    $jenis_form = 'tools';
    $judul = 'Tools';
  }elseif($_GET['pages'] == "formpengajuanapd"){
    $jenis_form = 'apd';
    $judul = 'APD';
  }elseif($_GET['pages'] == "formpengajuaninventaris"){
    $jenis_form = 'inventaris';
    $judul = 'Inventaris';
  }elseif($_GET['pages'] == "formpengajuanalatukur"){
    $jenis_form = 'alat ukur';
    $judul = 'Alat Ukur';
  }
?>

<!-- Content Wrapper. Contains page content -->
  <form id="myForm" method="POST" action="index.php?pages=pengajuanonprogress">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Form Pengajuan <?php echo $judul; ?></h1>
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
            <div class="col-lg-4 col-12">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body row" style="text-align: center;">
                      <div class="col-1"></div>
                      <div class="col-2" style="vertical-align: middle;">
                        <img src="../../dist/img/logo/gpp-logo.png" width="100%">
                      </div>
                      <div class="col-8" style="vertical-align: middle; font-size: 12px;">
                        <div><b>FORM PENGAJUAN <?php echo strtoupper($judul); ?></b></div>
                        <div><b>PT GLOBAL PRATAMA POWERINDO</b></div>
                      </div>
                    </div>
                  </div>
                </div>
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
                              <select name="entitas_id" style="width: 100%;" required>
                                <option value="" selected disabled>--- Pilih Entitas ---</option>
                                <?php
                                  $q_get_entitas = mysqli_query($conn, "SELECT * FROM asset_db_entitas ORDER BY entitas");
                                  while($get_entitas = mysqli_fetch_array($q_get_entitas)){
                                ?>
                                    <option value="<?php echo $get_entitas['id']; ?>"><?php echo $get_entitas['entitas']; ?></option>
                                <?php } ?>
                                ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>Jenis Pengajuan</td>
                            <td>:</td>
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
                              <input type="hidden" name="jenis_form" value="<?php echo $jenis_form; ?>">
                            </td>
                          </tr>
                          <tr>
                            <td>Tanggal Pengajuan</td>
                            <td>:</td>
                            <td><input type="date" name="tgl_pengajuan" style="width: 100%;" required></td>
                          </tr>
                          <tr>
                            <td>Project</td>
                            <td>:</td>
                            <td>
                              <select class="" style="width: 100%" name="kode_project" required>
                                <option value="" selected disabled>--- Pilih Project ---</option>
                                <option value="non_project">Non-Project</option>
                                <option value="" disabled>--------------- GPP ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>"><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                                <?php } ?>
                                <option value="" disabled>--------------- GPS ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>"><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                                <?php } ?>
                                <option value="" disabled>--------------- GPW ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPW' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>"><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                                <?php } ?>
                                <option value="" disabled>--------------- GSS ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>"><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                                <?php } ?>
                                <option value="" disabled>--------------- SI ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>"><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
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
                          <button type="submit" class="btn btn-success btn-sm" name="submit_pengajuan" value="submit" onclick="return confirm('Yakin data pengajuan sudah sesuai?')">
                            <span class="fa fa-upload"></span> Submit Pengajuan
                          </button>
                        </center>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-lg-8 col-12">
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
                        <th width="5%">Qty</th>
                        <th width="1%">Satuan</th>
                        <th width="10%">Harga Satuan</th>
                        <th width="12%">Harga Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        $q_get_db_tools_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_db_general.jenis = '$jenis_form' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
                        while($get_db_tools_detail = mysqli_fetch_array($q_get_db_tools_detail)){
                          $get_db_tools_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_tools_detail[general_code_id]'"));
                          $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_tools_detail[merek_id]'"));
                          $get_harga_terbaru = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_realisasi WHERE detail_code = '$get_db_tools_detail[detail_code]' ORDER BY id DESC"));
                          
                      ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $get_db_tools_general['nama_barang']; ?></td>
                              <td><?php echo $get_db_tools_general['tipe_barang']; ?></td>
                              <td><?php echo $get_db_tools_detail['tipe_detail']; ?></td>
                              <td><?php echo $get_merek['merek']; ?></td>
                              <td><input type="text" id="qty_<?php echo $no; ?>" style="width: 100%" name="qty_<?php echo $get_db_tools_detail['detail_code']; ?>" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)"></td>
                              <td><?php echo $get_db_tools_general['satuan']; ?></td>
                              <td>
                                <input type="text" id="harga_satuan_<?php echo $no; ?>" style="width: 100%" name="harga_satuan_<?php echo $get_db_tools_detail['detail_code']; ?>" value="<?php echo $get_harga_terbaru['harga_satuan']; ?>" oninput="formatNumber(this); hitungTotalHarga(<?php echo $no; ?>)">
                              </td>
                              <td><input type="text" id="harga_total_<?php echo $no; ?>" style="width: 100%" disabled></td>
                            </tr>
                      <?php $no++; } ?>

                            <tr style="background-color: yellow; text-align: center; font-weight: bold;">
                              <td colspan="8">TOTAL HARGA</td>
                              <td><input type="text" id="total_pengajuan" style="width: 100%; font-weight: bold;" value="<?php echo $harga_total; ?>" disabled></td>
                            </tr>
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