<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_pemijaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_peminjaman WHERE no_pinjam = '$id'"));
    $get_pemijaman_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_peminjaman_detail WHERE no_pinjam = '$id'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_pemijaman[kd_project]'"));
    $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pemijaman[nik]'"));
  }
?>
  
  <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=list-peminjaman">
    <div class="card card-secondary" style="font-size: 11px;">
      <div class="card-header">
        <h3 class="card-title">Info Peminjaman Tools</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="row">
          <div class="col-12">  
            <table class="table table-sm">
              <tr>
                <td width="28%">Kode Peminjaman</td>
                <td width="1%">:</td>
                <td><?php echo $id; ?></td>
              </tr>
              <tr>
                <td width="28%">Peminjam</td>
                <td width="1%">:</td>
                <td><?php echo $get_pemijaman['nik']." - ".$get_karyawan['nama']; ?></td>
              </tr>
              <tr>
                <td width="28%">Kode Project</td>
                <td width="1%">:</td>
                <td><?php echo $get_pemijaman['kd_project']." - ".$get_project['nm_project']; ?></td>
              </tr>
              <tr>
                <td width="28%">Lokasi Project</td>
                <td width="1%">:</td>
                <td><?php echo $get_project['lokasi_project']; ?></td>
              </tr>
              <tr>
                <td width="28%">Keterangan Pinjam</td>
                <td width="1%">:</td>
                <td><?php echo $get_pemijaman['deskripsi_pinjam']; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="no_pinjam" value="<?php echo $id; ?>">
    <input type="submit" class="btn btn-danger" name="batalkan_tools" value="Batalkan">
    <!-- /.card -->
  </form>