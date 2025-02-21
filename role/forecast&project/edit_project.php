<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getID'])) {
    $kd_project = $_POST['getID'];
    $q_get_project = mysqli_query($conn, "SELECT * FROM v_project WHERE kd_project = '$kd_project'");
    $get_project = mysqli_fetch_array($q_get_project);
    $getProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$kd_project'"));
?>

  <!-- Horizontal Form -->
  <div class="card card-info">
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listproject" enctype="multipart/form-data" style="font-size: 12px;">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Kode Project</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="kode_project" value="<?php echo $kd_project; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Kode Forecast</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="kode_forecast" value="<?php echo $get_project['kd_forecast']; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Sales</label>
          <div class="col-sm-9">
            <select class="form-control" name="nik_sales" required>
              <option value="" selected disabled>--- Pilih Sales ---</option>
              <?php
                $q_sales = mysqli_query($conn, "SELECT * FROM karyawan WHERE jabatan_id >= '4' AND jabatan_id <= '7'");
                while($get_sales = mysqli_fetch_array($q_sales)){
              ?>
                <option value="<?php echo $get_sales['nik']; ?>" <?php if($get_sales['nik'] == $get_project['nik_sales']){ echo "Selected"; } ?>><?php echo $get_sales['nik']." - ".$get_sales['nama']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Badan</label>
          <div class="col-sm-9">
            <select class="form-control" name="badan" required>
              <option value="" selected disabled>--- Pilih Badan ---</option>
              <?php
                $q_badan = mysqli_query($conn, "SELECT * FROM badan");
                while($get_badan = mysqli_fetch_array($q_badan)){ 
              ?>
                <option value="<?php echo $get_badan['kd_badan']; ?>" <?php if($get_badan['kd_badan'] == $get_project['kd_badan']){ echo "selected"; } ?>><?php echo $get_badan['kd_badan']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama Project</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="nama_project" value="<?php echo $get_project['nm_project']; ?>" placeholder="Deskripsi project">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No Tiket</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="notiket" value="<?php echo $get_project['no_ticket']; ?>" placeholder="nomor tiket crm (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No SPH</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="nosph" value="<?php echo $get_project['no_sph']; ?>" placeholder="nomor penawaran (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No SPK</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="nospk" value="<?php echo $get_project['no_spk']; ?>" placeholder="nomor PO/Kontrak (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama Customer</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="namacustomer" value="<?php echo $get_project['nm_customer']; ?>" placeholder="nama lengkap customer" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">No Hp</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="nohp" value="<?php echo $get_project['nohp']; ?>" placeholder="no kontak customer" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Perusahaan</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="perusahaan" value="<?php echo $get_project['perusahaan']; ?>" placeholder="nama perusahaan customer (bila ada)">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Kapasitas</label>
          <div class="col-sm-9">
            <input type="number" step="0.01" class="form-control" name="kapasitas" value="<?php echo $get_project['kapasitas']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Satuan Kapasitas</label>
          <div class="col-sm-9">
            <select class="form-control" name="satuan_kapasitas">
              <option <?php if($get_project['satuan_kapasitas'] == "Wp"){ echo "selected"; } ?> value="Wp">Wp</option>
              <option <?php if($get_project['satuan_kapasitas'] == "kWp"){ echo "selected"; } ?> value="kWp">kWp</option>
              <option <?php if($get_project['satuan_kapasitas'] == "MWp"){ echo "selected"; } ?> value="MWp">MWp</option>
              <option <?php if($get_project['satuan_kapasitas'] == "Watt"){ echo "selected"; } ?> value="Watt">Watt</option>
              <option <?php if($get_project['satuan_kapasitas'] == "Watt Hour"){ echo "selected"; } ?> value="Watt Hour">Watt Hour</option>
              <option <?php if($get_project['satuan_kapasitas'] == "kVa"){ echo "selected"; } ?> value="kVa">kVa</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Jumlah Order</label>
          <div class="col-sm-9">
            <input type="number" step="0.01" class="form-control" name="jumlah_order" value="<?php echo $get_project['jumlah_order']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Satuan Order</label>
          <div class="col-sm-9">
            <select class="form-control" name="satuan_order">
              <option <?php if($get_project['satuan'] == "Pcs"){ echo "selected"; } ?> value="Pcs">Pcs</option>
              <option <?php if($get_project['satuan'] == "Unit"){ echo "selected"; } ?> value="Unit">Unit</option>
              <option <?php if($get_project['satuan'] == "Set"){ echo "selected"; } ?> value="Set">Set</option>
              <option <?php if($get_project['satuan'] == "Lot"){ echo "selected"; } ?> value="Lot">Lot</option>
              <option <?php if($get_project['satuan'] == "Assembly"){ echo "selected"; } ?> value="Assembly">Assembly</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Lokasi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="lokasi" value="<?php echo $get_project['lokasi_project']; ?>" required>
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
                <option value="<?php echo $get_kategori['kd_kategori']; ?>" <?php if($get_project['tipe_project'] == $get_kategori['kd_kategori']){ echo "selected"; } ?>><?php echo $get_kategori['nm_kategori']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Project Start</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" name="start" value="<?php echo $get_project['start']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Deadline</label>
          <div class="col-sm-9">
            <input type="date" class="form-control" name="deadline" value="<?php echo $get_project['deadline']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nilai Proyek</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="nilai_proyek" value="<?php echo $get_project['nilai_project']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">HPP Barang</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="hpp_barang" value="<?php echo $getProject['hpp_barang']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">HPP Jasa</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="hpp_jasa" value="<?php echo $getProject['hpp_jasa']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">HPP Asset</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="hpp_asset" value="<?php echo $getProject['hpp_asset']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">PPN</label>
          <div class="col-sm-9">
            <select class="form-control" name="ppn">
              <option value="PPN" <?php if($get_project['ppn'] == "PPN"){ echo "selected"; } ?> >PPN</option>
              <option value="NON PPN" <?php if($get_project['ppn'] == "NON PPN"){ echo "selected"; } ?> >NON PPN</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Cashback</label>
          <div class="col-sm-9">
            <input type="number" class="form-control" name="cashback" value="<?php echo $get_project['cashback']; ?>" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Remark</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="remark"><?php echo $get_project['remark']; ?></textarea>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <input type="hidden" class="form-control" name="id" value="<?php echo $get_project['id']; ?>">
        <input type="submit" class="btn btn-success float-right" name="editproject" value="Simpan Project">
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

<?php } ?>