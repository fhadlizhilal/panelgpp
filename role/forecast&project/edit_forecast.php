<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getID'])) {
    $kd_forecast = $_POST['getID'];
    $get_forecast = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM forecast WHERE kd_forecast = '$kd_forecast'"));
?>

  <!-- Horizontal Form -->
  <div class="card card-info">
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listforecast" enctype="multipart/form-data" style="font-size: 12px;">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Kode Forecast</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="_kode_forecast" value="<?php echo $kd_forecast; ?>" disabled>
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
                <option value="<?php echo $get_badan['kd_badan']; ?>" <?php if($get_forecast['badan'] == $get_badan['kd_badan']){ echo "selected"; } ?>><?php echo $get_badan['kd_badan']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No Tiket</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="notiket" value="<?php echo $get_forecast['tiketcrm']; ?>" placeholder="nomor tiket crm (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama Customer</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="namacustomer" value="<?php echo $get_forecast['nm_customer']; ?>" placeholder="nama lengkap customer" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Perusahaan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="perusahaan" value="<?php echo $get_forecast['perusahaan']; ?>" placeholder="nama perusahaan customer (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No Hp</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="nohp" value="<?php echo $get_forecast['nohp']; ?>" placeholder="no kontak customer" required>
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
                <option value="<?php echo $get_kategori['kd_kategori']; ?>" <?php if($get_forecast['kategori_kd'] == $get_kategori['kd_kategori']){ echo "selected"; } ?>><?php echo $get_kategori['nm_kategori']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Deskripsi Proyek</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="deskripsi" required><?php echo $get_forecast['kebutuhan']; ?></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Pribadi/Proyek</label>
          <div class="col-sm-9">
            <select class="form-control" name="pribadi_proyek" required>
              <option value="Pribadi" <?php if($get_forecast['pribadi_proyek'] == "Pribadi"){ echo "selected"; } ?>>Pribadi</option>
              <option value="Proyek" <?php if($get_forecast['pribadi_proyek'] == "Proyek"){ echo "selected"; } ?>>Proyek</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nilai Proyek</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="nilai_proyek" value="<?php echo $get_forecast['penawaran']; ?>" required>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <input type="hidden" name="kd_forecast" value="<?php echo $kd_forecast; ?>">
        <input type="submit" class="btn btn-primary float-right" name="update_forecast" value="Update">
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

<?php } ?>