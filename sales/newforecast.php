<?php
  require_once("../dev/config.php");

  $sql_forecast = mysqli_query($conn,"SELECT * FROM forecast");
  $jml_forecast = mysqli_num_rows($sql_forecast)+1;
  $year=date('y');
  if($jml_forecast<10){
    $nol="000";
  }elseif($jml_forecast<100){
    $nol="00";
  }elseif($jml_forecast<1000){
    $nol="0";
  }elseif($jml_forecast>=1000){
    $nol="";
  }
  $kd_forecast = "GFC".$year.$nol.$jml_forecast;

  if(isset($_POST['submit'])){
    $badan = $_POST['badan'];
    $tiketcrm = $_POST['tiketcrm'];
    $namacustomer = $_POST['namacustomer'];
    $perusahaan = $_POST['perusahaan'];
    $nohp = $_POST['nohp'];
    $kategori = $_POST['kategori'];
    $kebutuhan = $_POST['kebutuhan'];
    $pribadi_proyek = $_POST['pribadi_proyek'];
    $penawaran = preg_replace("/[^0-9]/", "", $_POST['penawaran']);
    $nik_sales = $_SESSION["nik"];
    $status_forecast = "1";
    $status_view = "view";

    $sql_forecast = mysqli_query($conn,"SELECT * FROM forecast");
    $jml_forecast = mysqli_num_rows($sql_forecast)+1;
    $year=date('y');
    if($jml_forecast<10){
      $nol="000";
    }elseif($jml_forecast<100){
      $nol="00";
    }elseif($jml_forecast<1000){
      $nol="0";
    }elseif($jml_forecast>=1000){
      $nol="";
    }
    $kd_forecast = "GFC".$year.$nol.$jml_forecast;

    //add forecast to database
    $sql = "INSERT INTO forecast (id, kd_forecast, badan, tiketcrm, nm_customer, perusahaan, nohp, kategori_kd, kebutuhan, pribadi_proyek, penawaran, nik_sales, status_forecast, status_view) VALUES ('','$kd_forecast','$badan','$tiketcrm','$namacustomer','$perusahaan','$nohp','$kategori','$kebutuhan','$pribadi_proyek','$penawaran','$nik_sales','$status_forecast','$status_view')";
    if (mysqli_query($conn, $sql)) {
      $_SESSION['alert_success'] = "Forecast Baru Berhasil Dibuat! <a href='index.php?pages=listforecast'>Lihat Forecast</a>";
      // header("Location: index.php?pages=listforecast");
    } else {
      $_SESSION['alert_error'] = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      // echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
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
            <h1>Form New Forecast</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Forecast</li>
            </ol>
            <?php 
              // echo "Kode Forecast : ".$kd_forecast."<br>";
              // echo "Badan : ".$badan."<br>";
              // echo "Tiket CRM : ".$tiketcrm."<br>";
              // echo "Nama Customer : ".$namacustomer."<br>";
              // echo "Perusahaan : ".$perusahaan."<br>";
              // echo "No HP : ".$nohp."<br>";
              // echo "Kategori_kd : ".$kategori."<br>";
              // echo "Kebutuhan : ".$kebutuhan."<br>";
              // echo "Pribadi/Proyek : ".$pribadi_proyek."<br>";
              // echo "Penawaran : ".$penawaran."<br>";
              // echo "Sales_NIK : ".$nik_sales."<br>";
              // echo "Status Forecast : ".$status_forecast."<br>";
              // echo "Status View : ".$status_view."<br>";
            ?>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">New Forecast</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form target="" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="KDForecast">Kode Forecast</label>
                    <input type="text" class="form-control" name="kdforecast" placeholder="<?php echo $kd_forecast; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label for="badan">Badan</label>
                    <select name="badan" class="form-control" required>
                      <?php
                        $data_badan = mysqli_query($conn,"select * from badan");
                        while($d_badan = mysqli_fetch_array($data_badan)){
                      ?>
                        <option value="<?php echo $d_badan['kd_badan']; ?>"><?php echo $d_badan['kd_badan']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="TiketCrm">Tiket CRM</label>
                    <input type="text" class="form-control" name="tiketcrm" placeholder="No Tiket CRM (Optional)">
                  </div>
                  <div class="form-group">
                    <label for="NamaCustomer">Nama Customer</label>
                    <input type="text" class="form-control" name="namacustomer" placeholder="Nama Lengkap Customer">
                  </div>
                  <div class="form-group">
                    <label for="Perusahaan">Perusahaan</label>
                    <input type="text" class="form-control" name="perusahaan" placeholder="Nama Perusahaan Customer">
                  </div>
                  <div class="form-group">
                    <label for="NoHp">No HP</label>
                    <input type="text" class="form-control" name="nohp" placeholder="Nomor Kontak Customer">
                  </div>
                  <div class="form-group">
                    <label for="Kategori">Kategori</label>
                    <select name="kategori" class="form-control" required>
                      <?php
                        $data = mysqli_query($conn,"select * from kategoripenjualan");
                        while($d = mysqli_fetch_array($data)){
                      ?>
                        <option value="<?php echo $d['kd_kategori']; ?>"><?php echo $d['nm_kategori']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="Kebutuhan">Kebutuhan</label>
                    <textarea id="kebutuhan" class="form-control" name="kebutuhan" placeholder="Deskripsi Kabutuhan Customer"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="Pribadi/Proyek">Pribadi/Proyek</label>
                    <select name="pribadi_proyek" class="form-control" required>
                      <option value="Pribadi">Pribadi</option>
                      <option value="Proyek">Proyek</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="penawaran">Penawaran / Estimasi Nilai Pekerjaan</label>
                    <input type="text" id="dengan-rupiah" class="form-control" name="penawaran">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="pages" value="newforecast">
                  <input type="submit" name="submit" value="submit_forecast" class="btn btn-primary">
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