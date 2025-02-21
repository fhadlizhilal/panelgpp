<?php
  require_once("../dev/config.php");

  if(isset($_GET['id'])){
    $kdforecast = $_GET['id'];

    $data = mysqli_query($conn,"select * from forecast where kd_forecast = '$kdforecast'");
    while($d = mysqli_fetch_array($data)){
      $badan = $d['badan'];
      $nama_badan = $d['badan'];
      $no_tiket = $d['tiketcrm'];
      $nm_customer = $d['nm_customer'];
      $perusahaan = $d['perusahaan'];
      $nohp = $d['nohp'];
      $nm_kategori = $d['kategori_kd'];
      $kebutuhan = $d['kebutuhan'];
      $pribadi_proyek = $d['pribadi_proyek'];
      $status = $d['status_forecast'];
      $status_view = $d['status_view'];
      $keterangan = $d['kebutuhan'];
      $penawaran = $d['penawaran'];
    }
  }

  if(isset($_POST['toproject'])){

    $sql_project = mysqli_query($conn,"SELECT * FROM project where kd_badan = '$kd_badan'");
    $jml_project = mysqli_num_rows($sql_project)+1;
    if($jml_project<10){
      $nol="0";
    }else{
      $nol="";
    }
    $jml_project = $nol.$jml_project;
    $tahun = date('Y');

    $kd_forecast = $_POST['kd_forecast'];
    $nik_sales = $_POST['nik_sales'];
    $kd_badan = $_POST['kd_badan'];
    $nm_project = $_POST['nm_project'];
    $no_ticket = $_POST['no_ticket'];
    $no_sph = $_POST['no_sph'];
    $no_spk = $_POST['no_spk'];
    $nm_customer = $_POST['nm_customer'];
    $nohp = $_POST['nohp'];
    $perusahaan = $_POST['perusahaan'];
    $kapasitas = $_POST['kapasitas'];
    $satuan_kapasitas = $_POST['satuan_kapasitas'];
    $jumlah_order = $_POST['jumlah_order'];
    $satuan = $_POST['satuan'];
    $lokasi_project = $_POST['lokasi_project'];
    $tipe_project = $_POST['tipe_project'];
    $start = $_POST['start'];
    $deadline = $_POST['deadline'];
    $nilai_project = $_POST['nilai_project'];
    $ppn = $_POST['ppn'];
    $cashbasck = $_POST['cashback'];
    $remark = $_POST['remark'];

    $kd_project = $kd_badan.$jml_project.$tahun;
    
    //add project to database
    $sql = "INSERT INTO project (id, kd_project, kd_forecast, nik_sales, kd_badan, nm_project, no_ticket, no_sph, no_spk, nm_customer, nohp, perusahaan, kapasitas, satuan_kapasitas, jumlah_order, satuan, lokasi_project, tipe_project, start, deadline, nilai_project, ppn, cashback, remark) VALUES ('', '$kd_project', '$kd_forecast', '$nik_sales', '$kd_badan', '$nm_project', '$no_ticket', '$no_sph', '$no_spk', '$nm_customer', '$nohp', '$perusahaan', '$kapasitas', '$satuan_kapasitas', '$jumlah_order', '$satuan', '$lokasi_project', '$tipe_project', '$start', '$deadline', '$nilai_project', '$ppn', '$cashback', '$remark')";
    if (mysqli_query($conn, $sql)) {
      mysqli_query($conn, "UPDATE forecast SET ")
      $_SESSION['alert_success'] = "Project Baru Berhasil Dibuat! <a href='index.php?pages=listproject'>Lihat Project</a>";
      // header("Location: index.php?pages=listproject&msg=success");
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
            <h1>Form New Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Project</li>
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
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">New Project</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" target="" method="POST">
                <div class="card-body">

                  <!-- <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                    </div>
                  </div> -->

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">KODE FORECAST</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-exclamation-circle"></i></span>
                      </div>
                      <input type="text" class="form-control" name="kdforecast" value="<?php echo $kdforecast; ?>" required disabled>
                      <input type="hidden" name="kd_forecast" value="<?php echo $kdforecast; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">SALES</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" name="sales_dis" value="<?php echo $_SESSION['nama']; ?>" required disabled>
                      <input type="hidden" name="nik_sales" value="<?php echo $_SESSION['nik']; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="badan" class="col-sm-3 col-form-label" style="font-weight: normal;">BADAN</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-tags"></i></span>
                      </div>
                      <select name="kd_badan" class="form-control" required>
                      <?php
                        $data_badan = mysqli_query($conn,"select * from badan");
                        while($d_badan = mysqli_fetch_array($data_badan)){
                      ?>
                        <option value="<?php echo $d_badan['kd_badan']; ?>" <?php if($d_badan['kd_badan'] == $badan){ echo "selected"; } ?> required><?php echo $d_badan['kd_badan']; ?></option>
                      <?php } ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">NAMA PROJECT</label>
                    <div class="input-group mb-3 col-sm-9">
                      <textarea class="form-control" name="nm_project" required><?php echo $kebutuhan; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">NO TIKET</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-ticket"></i></span>
                      </div>
                      <input type="text" class="form-control" name="no_ticket" value="<?php echo $no_tiket; ?>" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">NO SPH</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-ticket"></i></span>
                      </div>
                      <input type="text" class="form-control" name="no_sph" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">NO SPK/KONTRAK</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-ticket"></i></span>
                      </div>
                      <input type="text" class="form-control" name="no_spk" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">NAMA CUSTOMER</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" name="nm_customer" value="<?php echo $nm_customer; ?>" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">HP CUSTOMER</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                      </div>
                      <input type="text" class="form-control" name="nohp" value="<?php echo $nohp; ?>" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">PERUSAHAAN</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                      </div>
                      <input type="text" class="form-control" name="perusahaan" value="<?php echo $perusahaan; ?>" required>
                    </div>
                  </div>

                  <br>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal; color: blue;">KAPASITAS</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-circle-o"></i></span>
                      </div>
                      <input type="number" class="form-control" name="kapasitas" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal; color: blue;">SATUAN KAPASITAS</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-circle-o"></i></span>
                      </div>
                      <select name="satuan_kapasitas" class="form-control" required>
                        <option value="" selected disabled>-- Pilih Satuan Kapasitas --</option>
                        <option value="Wp">Wp</option>
                        <option value="kWp">kWp</option>
                        <option value="kWh">kWh</option>
                        <option value="Watt">Watt</option>
                        <option value="kW">kW</option>
                        <option value="Ah">Ah</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal; color: orange;">JUMLAH ORDER</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-circle"></i></span>
                      </div>
                      <input type="number" class="form-control" name="jumlah_order" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal; color: orange;">SATUAN</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-circle"></i></span>
                      </div>
                      <select name="satuan" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Satuan --</option>
                        <option value="Lot">Lot</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Set">Set</option>
                        <option value="Unit">Unit</option>
                      </select>
                    </div>
                  </div>

                  <br>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">LOKASI PROJECT</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-map-marker"></i></span>
                      </div>
                      <input type="text" class="form-control" name="lokasi_project" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">TIPE PROJECT</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-list"></i></span>
                      </div>
                      <select name="tipe_project" class="form-control" required>
                        <option value="" disabled selected>-- Pilih Tipe Project --</option>
                        <?php
                          $data = mysqli_query($conn,"select * from kategoripenjualan");
                          while($d = mysqli_fetch_array($data)){
                        ?>
                          <option value="<?php echo $d['kd_kategori']; ?>"><?php echo $d['nm_kategori']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">PROJECT START</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-hourglass-start"></i></span>
                      </div>
                      <input type="date" class="form-control" name="start" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">DEADLINE</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-hourglass-end"></i></span>
                      </div>
                      <input type="date" class="form-control" name="deadline" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">NILAI PROJECT</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                      </div>
                      <input type="text" id="dengan-rupiah" class="form-control" name="nilai_project" value="<?php echo $penawaran; ?>" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">PPN / NON PPN</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-list-ul"></i></span>
                      </div>
                      <select name="ppn" class="form-control" required>
                        <option value="" selected disabled>-- Pilih PPN/NON PPN --</option>
                        <option value="PPN">PPN</option>
                        <option value="NON PPN">NON PPN</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">CASHBACK</label>
                    <div class="input-group mb-3 col-sm-9">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-money"></i></span>
                      </div>
                      <input type="text" id="dengan-rupiah2" class="form-control" name="cashback" required>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: -5px;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label" style="font-weight: normal;">REMARK</label>
                    <div class="input-group mb-3 col-sm-9">
                      <textarea class="form-control" name="remark" required></textarea>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <!-- <button type="submit" class="btn btn-primary float-right">Submit</button> -->
                  <input type="submit" class="btn btn-primary float-right" name="toproject" value="Submit">
                </div>
                <!-- /.card-footer -->
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