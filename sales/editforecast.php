<?php
  require_once("../dev/config.php");

  if(isset($_POST['submit']) && $_POST['submit']=="Edit Forecast"){
    $kdforecast = $_POST['kdforecast'];
    $kd_badan = $_POST['badan'];
    $tiketcrm = $_POST['tiketcrm'];
    $namacustomer = $_POST['namacustomer'];
    $perusahaan = $_POST['perusahaan'];
    $nohp = $_POST['nohp'];
    $kategori = $_POST['kategori'];
    $kebutuhan = $_POST['kebutuhan'];
    $pribadi_proyek = $_POST['pribadi_proyek'];
    $penawaran = preg_replace("/[^0-9]/", "", $_POST['penawaran']);

    $query="UPDATE forecast SET badan='$kd_badan', tiketcrm='$tiketcrm', nm_customer='$namacustomer', perusahaan='$perusahaan', nohp='$nohp', kategori_kd='$kategori', kebutuhan='$kebutuhan', pribadi_proyek='$pribadi_proyek', penawaran=$penawaran where kd_forecast='$kdforecast'";
    if(mysqli_query($conn, $query)){
      $_SESSION['alert_success'] = "Forecast Berhasil Diubah! <a href='index.php?pages=listforecast'>Lihat Forecast</a>";
    }else{
      $_SESSION['alert_error'] = "ERROR: Could not able to execute $query. " . mysqli_error($conn);
    }
  }

  if(isset($_GET['id'])){
    $kdforecast = $_GET['id'];

    $data_forecast = mysqli_query($conn,"select * from forecast where kd_forecast = '$kdforecast'");
    while($d_forecast = mysqli_fetch_array($data_forecast)){
      $kd_badan = $d_forecast['badan'];
      $tiketcrm = $d_forecast['tiketcrm'];
      $namacustomer = $d_forecast['nm_customer'];
      $perusahaan = $d_forecast['perusahaan'];
      $nohp = $d_forecast['nohp'];
      $kategori = $d_forecast['kategori_kd'];
      $kebutuhan = $d_forecast['kebutuhan'];
      $pribadi_proyek = $d_forecast['pribadi_proyek'];
      $penawaran = $d_forecast['penawaran'];

      $penawaran = "Rp " . number_format($penawaran,0,',','.');
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
            <h1>Form Edit Forecast</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Forecast</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit Forecast</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form target="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="KDForecast">Kode Forecast</label>
                    <input type="text" class="form-control" name="kdforecast_dis" placeholder="<?php echo $kdforecast; ?>" disabled>
                    <input type="hidden" name="kdforecast" value="<?php echo $kdforecast; ?>">
                  </div>
                  <div class="form-group">
                    <label for="badan">Badan</label>
                    <select name="badan" class="form-control" required>
                      <?php
                        $data_badan = mysqli_query($conn,"select * from badan");
                        while($d_badan = mysqli_fetch_array($data_badan)){
                      ?>
                        <option value="<?php echo $d_badan['kd_badan']; ?>" <?php if($d_badan['kd_badan']==$kd_badan){ echo "selected"; } ?>><?php echo $d_badan['kd_badan']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="TiketCrm">Tiket CRM</label>
                    <input type="text" class="form-control" name="tiketcrm" placeholder="No Tiket CRM (Optional)" value="<?php echo $tiketcrm; ?>">
                  </div>
                  <div class="form-group">
                    <label for="NamaCustomer">Nama Customer</label>
                    <input type="text" class="form-control" name="namacustomer" placeholder="Nama Lengkap Customer" value="<?php echo $namacustomer; ?>">
                  </div>
                  <div class="form-group">
                    <label for="Perusahaan">Perusahaan</label>
                    <input type="text" class="form-control" name="perusahaan" placeholder="Nama Perusahaan Customer" value="<?php echo $perusahaan; ?>">
                  </div>
                  <div class="form-group">
                    <label for="NoHp">No HP</label>
                    <input type="text" class="form-control" name="nohp" placeholder="Nomor Kontak Customer" value="<?php echo $nohp; ?>">
                  </div>
                  <div class="form-group">
                    <label for="Kategori">Kategori</label>
                    <select name="kategori" class="form-control" required>
                      <?php
                        $data = mysqli_query($conn,"select * from kategoripenjualan");
                        while($d = mysqli_fetch_array($data)){
                      ?>
                        <option value="<?php echo $d['kd_kategori']; ?>" <?php if($d['kd_kategori']==$kategori){ echo "selected"; } ?> ><?php echo $d['nm_kategori']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Kebutuhan">Kebutuhan</label>
                    <textarea id="kebutuhan" class="form-control" name="kebutuhan" placeholder="Deskripsi Kabutuhan Customer"><?php echo $kebutuhan; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="Pribadi/Proyek">Pribadi/Proyek</label>
                    <select name="pribadi_proyek" class="form-control" required>
                      <option value="Pribadi" <?php if($pribadi_proyek=="Pribadi"){ echo "selected"; } ?> >Pribadi</option>
                      <option value="Proyek" <?php if($pribadi_proyek=="Proyek"){ echo "selected"; } ?> >Proyek</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="penawaran">Penawaran / Estimasi Nilai Pekerjaan</label>
                    <input type="text" id="dengan-rupiah" class="form-control" name="penawaran" value="<?php echo $penawaran; ?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="pages" value="newforecast">
                  <input type="submit" name="submit" value="Edit Forecast" class="btn btn-primary">
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->