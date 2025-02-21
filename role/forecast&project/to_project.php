<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getID'])) {
    $kd_forecast = $_POST['getID'];
    $get_forecast = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM forecast WHERE kd_forecast = '$kd_forecast'"));
    $count_project = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = '$get_forecast[badan]'"));

    //tambah nol
    if($count_project<10){
      $PR = "0".($count_project+1);
    }else{
      $PR = $count_project+1;
    }

    $kd_project = $get_forecast['badan'].$PR.date('Y');
?>

  <!-- Horizontal Form -->
  <div class="card card-info">
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listforecast" enctype="multipart/form-data" style="font-size: 12px;">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Kode Project</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="_kode_project" value="<?php echo $kd_project; ?>" disabled>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Kode Forecast</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="_kode_forecast" value="<?php echo $kd_forecast; ?>" disabled>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Sales</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="_nik" value="<?php echo $_SESSION['nik']." - ".$_SESSION['nama']; ?>" disabled>
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
          <label class="col-sm-3 col-form-label">Nama Project</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="nama_project" value="<?php echo $get_forecast['kebutuhan']; ?>" placeholder="Deskripsi project">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No Tiket</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="notiket" value="<?php echo $get_forecast['tiketcrm']; ?>" placeholder="nomor tiket crm (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No SPH</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="nosph" placeholder="nomor penawaran (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No SPK</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="nospk" placeholder="nomor PO/Kontrak (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama Customer</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="namacustomer" value="<?php echo $get_forecast['nm_customer']; ?>" placeholder="nama lengkap customer" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No Hp</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="nohp" value="<?php echo $get_forecast['nohp']; ?>" placeholder="no kontak customer" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Perusahaan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="perusahaan" value="<?php echo $get_forecast['perusahaan']; ?>" placeholder="nama perusahaan customer (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Kapasitas</label>
          <div class="col-sm-9">
            <input type="number" step="0.01" class="form-control" name="kapasitas" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Satuan Kapasitas</label>
          <div class="col-sm-9">
            <select class="form-control" name="satuan_kapasitas">
              <option value="Wp">Wp</option>
              <option value="kWp">kWp</option>
              <option value="MWp">MWp</option>
              <option value="Watt">Watt</option>
              <option value="Watt Hour">Watt Hour</option>
              <option value="kVa">kVa</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Jumlah Order</label>
          <div class="col-sm-9">
            <input type="number" step="0.01" class="form-control" name="jumlah_order" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Satuan Order</label>
          <div class="col-sm-9">
            <select class="form-control" name="satuan_order">
              <option value="Pcs">Pcs</option>
              <option value="Unit">Unit</option>
              <option value="Set">Set</option>
              <option value="Lot">Lot</option>
              <option value="Assembly">Assembly</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Lokasi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="lokasi" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Tipe Proyek</label>
          <div class="col-sm-9">
            <select class="form-control" name="tipe_proyek" required>
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
          <label class="col-sm-3 col-form-label">Project Start</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" name="start" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Deadline</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" name="deadline" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nilai Proyek</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="nilai_proyek" value="<?php echo $get_forecast['penawaran']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">PPN</label>
          <div class="col-sm-9">
            <select class="form-control" name="ppn">
              <option value="PPN">PPN</option>
              <option value="NON PPN">NON PPN</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Cashback</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="cashback" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Remark</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="remark"></textarea>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <input type="hidden" name="kd_forecast" value="<?php echo $kd_forecast; ?>">
        <input type="submit" class="btn btn-primary float-right" name="newproject" value="To Project">
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

<?php } ?>