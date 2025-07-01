<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$id'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=datakaryawan">
      <div class="card-body">
        <div class="form-group">
          <label>NIK</label>
          <input type="text" class="form-control" name="nik" value="<?php echo $getKaryawan['nik']; ?>" required>
        </div>
        <div class="form-group">
          <label>Nama Karyawan</label>
          <input type="text" class="form-control" name="nm_karyawan" value="<?php echo $getKaryawan['nama']; ?>" required>
        </div>
        <div class="form-group">
          <label>Jabatan</label>
          <select class="form-control" name="jabatan">
            <?php
              $q_jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
              while($getJabatan = mysqli_fetch_array($q_jabatan)){
            ?>
                <option value="<?php echo $getJabatan['id']; ?>" <?php if($getJabatan['id'] == $getKaryawan['jabatan_id']){ echo "selected"; } ?>>
                  <?php echo $getJabatan['jabatan']; ?>
                </option>
            <?php
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Gaji</label>
          <input type="text" class="form-control" name="gaji" value="<?php echo $getKaryawan['gaji']; ?>" required>
        </div>
        <div class="form-group">
          <label>Tgl Masuk</label>
          <input type="Date" class="form-control" name="tgl_masuk" value="<?php echo $getKaryawan['tgl_masuk']; ?>" required>
        </div>
        <div class="form-group">
          <label>Status</label>
          <select class="form-control" name="status" required>
              <option value="" disabled>-- Pilih Status --</option>
              <option value="aktif" <?php if($getKaryawan['status'] == "aktif"){ echo "selected"; } ?>>Aktif</option>
              <option value="non-aktif" <?php if($getKaryawan['status'] == "non-aktif"){ echo "selected"; } ?>>Non-Aktif</option>
          </select>
        </div>
        <div class="form-group">
          <label>Foto</label>
          <input type="text" class="form-control" name="foto" value="<?php echo $getKaryawan['foto']; ?>" required>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_data_karyawan" value="Ubah">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->