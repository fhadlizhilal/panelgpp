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
          <input type="text" class="form-control" name="nm_karyawan" required>
        </div>
        <div class="form-group">
          <label>Jabatan</label>
          <select class="form-control" name="jabatan">
            <option value="" disabled selected>---- Pilih Jabatan ----</option>
            <?php
              $q_jabatan = mysqli_query($conn, "SELECT * FROM jabatan");
              while($getJabatan = mysqli_fetch_array($q_jabatan)){
            ?>
                <option value="<?php echo $getJabatan['id']; ?>">
                  <?php echo $getJabatan['jabatan']; ?>
                </option>
            <?php
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>Role</label>
          <select class="form-control" name="role">
            <option value="" disabled selected>---- Pilih Role ----</option>
            <?php
              $q_role = mysqli_query($conn, "SELECT * FROM role");
              while($getRole = mysqli_fetch_array($q_role)){
            ?>
                <option value="<?php echo $getRole['id']; ?>">
                  <?php echo $getRole['role']; ?>
                </option>
            <?php
              }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label>No HP</label>
          <input type="text" class="form-control" name="nohp" required>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>
        <div class="form-group">
          <label>Tgl Masuk</label>
          <input type="Date" class="form-control" name="tgl_masuk" required>
        </div>
        <div class="form-group">
          <label>Gaji</label>
          <input type="number" class="form-control" name="gaji" required>
        </div>
        <div class="form-group">
          <label>Foto</label>
          <input type="text" class="form-control" name="foto" value="-" disabled required>
        </div>
        <br>
        <hr/>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" class="form-control" name="password" required>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-info float-right" name="add_data_karyawan" value="Simpan">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->