<?php
  require_once "../../dev/config.php";

  $count_forecast = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM forecast"));
  $kode_forecast = "FRC0".($count_forecast + 1);
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Forecast</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Forecast</li>
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
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Form New Forecast</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listforecast" method="POST">
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Forecast</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="<?php echo $kode_forecast; ?>" disabled>
                      <input type="hidden" name="kode_forecast" value="<?php echo $kode_forecast; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Badan</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="badan" required>
                        <?php
                          $q_badan = mysqli_query($conn, "SELECT * FROM badan");
                          while($get_badan = mysqli_fetch_array($q_badan)){ 
                        ?>
                          <option value="<?php echo $get_badan['kd_badan']; ?>"><?php echo $get_badan['kd_badan']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No Tiket</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="notiket" placeholder="nomor tiket crm (bila ada)">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Customer</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="namacustomer" placeholder="nama lengkap customer" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Perusahaan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="perusahaan" placeholder="nama perusahaan customer (bila ada)">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">No Hp</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nohp" placeholder="no kontak customer" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kategori</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="kategori" required>
                        <?php
                          $q_kategori = mysqli_query($conn, "SELECT * FROM kategoripenjualan");
                          while($get_kategori = mysqli_fetch_array($q_kategori)){ 
                        ?>
                          <option value="<?php echo $get_kategori['kd_kategori']; ?>"><?php echo $get_kategori['nm_kategori']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Deskripsi Proyek</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="deskripsi" required></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Pribadi/Proyek</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="pribadi_proyek" required>
                        <option value="Pribadi">Pribadi</option>
                        <option value="Proyek">Proyek</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nilai Proyek</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nilai_proyek" id="dengan-rupiah" required>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-info float-right" name="newforecast" value="Simpan">
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->