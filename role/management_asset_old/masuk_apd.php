<?php
  session_start();
  require_once "../../dev/config.php";
?>

     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form APD Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">APD Masuk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default col-md-6">
          <!-- <div class="card-header">
            <h3 class="card-title">Select2 (Default Theme)</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div> -->
          <!-- /.card-header -->
          <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=in-apd">
            <div class="card-body">
              <div class="form-group">
                <label>Nama APD</label>
                <select class="form-control select2" name="id_apd" style="width: 100%;" required>
                  <option value="" selected disabled>--- Pilih APD --- </option>
                  <?php
                    $q_getAPD = mysqli_query($conn, "SELECT * FROM apd_database");
                    while($get_apd = mysqli_fetch_array($q_getAPD)){
                      $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_apd[merek]'"));
                  ?>
                      <option value="<?php echo $get_apd['id_apd']; ?>"><?php echo "[".$get_apd['id_apd']."] - ".$get_apd['nama']." : ".$get_apd['tipe']." - [".$get_merek['merek']."][".$get_apd['jenis']."]"; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" class="form-control" name="tanggal_masuk" required>
              </div>
              <div class="form-group">
                <label>Harga Satuan</label>
                <input type="text" class="form-control" name="harga_satuan" id="dengan-rupiah" required>
              </div>
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required>
              </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-info float-right" name="masuk_apd" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>