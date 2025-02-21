<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getPelanggaran = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pelanggaran WHERE id = '$id'"));
    $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getPelanggaran[nik]'"));
  }
?>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=dbpelanggaran">
      <div class="card-body">
        <div class="form-group">
          <label style="font-size: 12px;">Tanggal Pelanggaran</label>
          <input type="date" name="tgl_pelanggaran" class="form-control" style="font-size: 11px;" value="<?php echo $getPelanggaran['tanggal']; ?>" required>
        </div>
        <div class="form-group">
          <label style="font-size: 12px;">Karyawan</label>
          <select class="form-control" name="nik_karyawan" style="font-size: 11px;">
            <option value="" selected disabled>----- Pilih Karyawan -----</option>
            <?php
              $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY nama ASC");
              while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
            ?>
              <option value="<?php echo $get_karyawan['nik']; ?>" <?php if($getPelanggaran['nik'] == $get_karyawan['nik']){ echo "selected"; } ?>><?php echo $get_karyawan['nama']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label style="font-size: 12px;">Pelanggaran</label>
          <select class="form-control" name="pelanggaran_id" style="font-size: 10px;" required>
            <option value="" selected disabled>----- Pilih Pelanggaran -----</option>
            <option value="" style="font-weight: bold;" disabled>RINGAN</option>
            <?php
              $no = 1;
              $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'RINGAN'");
              while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
            ?>
              <option value="<?php echo $get_pelanggaranList['id']; ?>" <?php if($getPelanggaran['pelanggaran_id'] == $get_pelanggaranList['id']){ echo "selected"; } ?>><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
            <?php $no++; } ?>

            <option value="" style="font-weight: bold;" disabled></option>
            <option value="" style="font-weight: bold;" disabled>SEDANG</option>
            <?php
              $no = 1;
              $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'SEDANG'");
              while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
            ?>
              <option value="<?php echo $get_pelanggaranList['id']; ?>" <?php if($getPelanggaran['pelanggaran_id'] == $get_pelanggaranList['id']){ echo "selected"; } ?>><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
            <?php $no++; } ?>

            <option value="" style="font-weight: bold;" disabled></option>
            <option value="" style="font-weight: bold;" disabled>SEDANG BERAT</option>
            <?php
              $no = 1;
              $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'SEDANG BERAT'");
              while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
            ?>
              <option value="<?php echo $get_pelanggaranList['id']; ?>" <?php if($getPelanggaran['pelanggaran_id'] == $get_pelanggaranList['id']){ echo "selected"; } ?>><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
            <?php $no++; } ?>

            <option value="" style="font-weight: bold;" disabled></option>
            <option value="" style="font-weight: bold;" disabled>BERAT</option>
            <?php
              $no = 1;
              $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'BERAT'");
              while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
            ?>
              <option value="<?php echo $get_pelanggaranList['id']; ?>" <?php if($getPelanggaran['pelanggaran_id'] == $get_pelanggaranList['id']){ echo "selected"; } ?>><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
            <?php $no++; } ?>

            <option value="" style="font-weight: bold;" disabled></option>
            <option value="" style="font-weight: bold;" disabled>SANGAT BERAT</option>
            <?php
              $no = 1;
              $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'SANGAT BERAT'");
              while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
            ?>
              <option value="<?php echo $get_pelanggaranList['id']; ?>" <?php if($getPelanggaran['pelanggaran_id'] == $get_pelanggaranList['id']){ echo "selected"; } ?>><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
            <?php $no++; } ?>
          </select>
        </div>
        <div class="form-group">
          <label style="font-size: 12px;">Keterangan Tambahan</label>
          <textarea name="keterangan" class="form-control" style="font-size: 10px;"><?php echo $getPelanggaran['keterangan'] ?></textarea>
        </div>
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <center><input type="submit" class="btn btn-info" name="edit_pelanggaran" value="Ubah"></center>
        </div>
      </div>
    </form>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->