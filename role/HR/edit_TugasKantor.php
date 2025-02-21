<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_TugasKantor = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tugas_kantor WHERE id = '$id'"));
    $get_TugasKantor['keterangan'] = substr($get_TugasKantor['keterangan'], 3);
    $get_TugasKantor['keterangan'] = substr($get_TugasKantor['keterangan'],0,-4);
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=STK">
      <div class="card-body">
        <div class="form-group">
          <label>Karyawan</label>
          <select name=" nik" class="form-control" required>
                <option value="" selected disabled>--- Pilih Karyawan ---</option>
            <?php
              $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan");
              while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
            ?>
                <option value="<?php echo $get_karyawan['nik']; ?>" <?php if($get_karyawan['nik']==$get_TugasKantor['nik']){ echo "selected"; } ?>><?php echo $get_karyawan['nama']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group"> 
          <label>Dari</label>
          <input type="date" class="form-control" name="dari" value="<?php echo $get_TugasKantor['dari']; ?>" required>
        </div>
        <div class="form-group">
          <label>Sampai</label>
          <input type="date" class="form-control" name="sampai" value="<?php echo $get_TugasKantor['sampai']; ?>" required>
        </div>
        <div class="form-group">
          <label>Keterangan</label>
          <textarea class="form-control" name="keterangan" required><?php echo $get_TugasKantor['keterangan']; ?></textarea>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="TugasKantor_id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_tugas_kantor" value="Ubah">
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->