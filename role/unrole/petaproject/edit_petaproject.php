<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_petaproject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM am_petaproject WHERE id = '$id'"));
  }
?>

  <div class="card">
    <div class="card-body">
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" name="nama_project" value="<?php echo $get_petaproject['nama_project']; ?>" required>
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jenis Project</label>
          <div class="col-sm-9">
            <select class="form-control" name="jenis_project" style="font-size: 12px;" required>
              <option value="" selected disabled>--- Pilih Jenis Project ---</option>
              <option value="ongrid" <?php if($get_petaproject['jenis'] == "ongrid"){ echo "selected"; } ?>>Ongrid</option>
              <option value="hybrid" <?php if($get_petaproject['jenis'] == "hybrid"){ echo "selected"; } ?>>Hybrid</option>
              <option value="offgrid" <?php if($get_petaproject['jenis'] == "offgrid"){ echo "selected"; } ?>>Offgrid</option>
              <option value="pjuts" <?php if($get_petaproject['jenis'] == "pjuts"){ echo "selected"; } ?>>PJUTS</option>
              <option value="pats" <?php if($get_petaproject['jenis'] == "pats"){ echo "selected"; } ?>>PATS</option>
              <option value="onm" <?php if($get_petaproject['jenis'] == "onm"){ echo "selected"; } ?>>OnM</option>
            </select>
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kota</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" name="kota" value="<?php echo $get_petaproject['kota']; ?>" required>
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Provinsi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" name="provinsi" value="<?php echo $get_petaproject['provinsi']; ?>" required>
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Latitude</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" name="latitude" value="<?php echo $get_petaproject['latitude']; ?>" required>
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Longtitude</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" name="longtitude" value="<?php echo $get_petaproject['longtitude']; ?>" required>
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kapasitas</label>
          <div class="col-sm-9">
            <input type="text" class="form-control form-control-sm" name="kapasitas" value="<?php echo $get_petaproject['kapasitas']; ?>" required>
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jenis Atap</label>
          <div class="col-sm-9">
            <select class="form-control" name="jenis_atap" style="font-size: 12px;" required>
              <option value="" selected disabled>--- Pilih Jenis Atap ---</option>
              <option value="-" <?php if($get_petaproject['jenis_atap'] == "-"){ echo "selected"; } ?>>-</option>
              <option value="Genteng" <?php if($get_petaproject['jenis_atap'] == "Genteng"){ echo "selected"; } ?>>Genteng</option>
              <option value="Rooftop Dak" <?php if($get_petaproject['jenis_atap'] == "Rooftop Dak"){ echo "selected"; } ?>>Rooftop Dak</option>
              <option value="Zinc Allumunium" <?php if($get_petaproject['jenis_atap'] == "Zinc Allumunium"){ echo "selected"; } ?>>Zinc Allumunium</option>
              <option value="Kliplock" <?php if($get_petaproject['jenis_atap'] == "Kliplock"){ echo "selected"; } ?>>Kliplock</option>
              <option value="Ground Mounted" <?php if($get_petaproject['jenis_atap'] == "Ground Mounted"){ echo "selected"; } ?>>Ground Mounted</option>
              <option value="Canopy" <?php if($get_petaproject['jenis_atap'] == "Canopy"){ echo "selected"; } ?>>Asbes</option>
              <option value="Sirap" <?php if($get_petaproject['jenis_atap'] == "Sirap"){ echo "selected"; } ?>>Sirap</option>
              <option value="L Feet" <?php if($get_petaproject['jenis_atap'] == "L Feet"){ echo "selected"; } ?>>L Feet</option>
              <option value="Canopy" <?php if($get_petaproject['jenis_atap'] == "Canopy"){ echo "selected"; } ?>>Canopy</option>
            </select>
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tahun</label>
          <div class="col-sm-3">
            <input type="number" class="form-control form-control-sm" name="tahun" min="1900" max="2100" value="<?php echo $get_petaproject['tahun']; ?>" required>
          </div>
        </div>
        <div class="form-group row" style="margin-bottom: 8px;">
          <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
          <div class="col-sm-9">
            <img src="../unrole/petaproject/fotoproject/<?php echo $get_petaproject['foto']; ?>" width="70%">
            <input type="file" class="form-control form-control-sm" name="file">
          </div>
        </div>
        <br>
        <center>
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="Submit" class="btn btn-success" name="edit_data_petaproject" value="Simpan">
        </center>
      </form>
    </div>
  </div>
    <!-- /.card-body -->