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
  
  <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=list-peminjaman-tools">
    <div class="card card-secondary" style="font-size: 12px;">
      <div class="card-header">
        <h3 class="card-title">Info Peminjaman Tools</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="row">
          <div class="col-12">  
            <table class="table table-sm">
              <tr>
                <td width="25%">Nomor Pinjam</td>
                <td width="1%">:</td>
                <td><?php echo $id; ?></td>
              </tr>
              <tr>
                <td width="25%">Peminjam</td>
                <td width="1%">:</td>
                <td><?php echo $get_pemijaman['nik']." - ".$get_karyawan['nama']; ?></td>
              </tr>
              <tr>
                <td width="26%">Kode Project</td>
                <td width="1%">:</td>
                <td><?php echo $get_pemijaman['kd_project']." - ".$get_project['nm_project']." <b>[".$get_project['perusahaan']."]</b"; ?></td>
              </tr>
              <tr>
                <td width="26%">Lokasi Project</td>
                <td width="1%">:</td>
                <td><?php echo $get_project['lokasi_project']; ?></td>
              </tr>
              <tr>
                <td width="26%">Keterangan Pinjam</td>
                <td width="1%">:</td>
                <td><?php echo $get_pemijaman['deskripsi_pinjam']; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->

    <div class="card card-secondary" style="font-size: 12px;">
      <div class="card-header">
        <h3 class="card-title">List Tools</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-12">  
            <table class="table table-sm table-striped">
              <thead>
                <tr>
                  <th style="width: 10px;">No</th>
                  <th>Nama Tools</th>
                  <th>Janis Tools</th>
                  <th width="5%">Qty</th>
                  <th width="5%">Satuan</th>
                  <th>Catatan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 0;
                  $q_gettoolsdetail = mysqli_query($conn, "SELECT * FROM tools_peminjaman_detail WHERE no_pinjam = '$id'");
                  while($tools_detail = mysqli_fetch_array($q_gettoolsdetail)){
                    $get_tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_db WHERE id_tools = '$tools_detail[id_tools]'"));
                    $no++;
                ?>
                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $get_tools['nama_tools']; ?></td>
                    <td><?php echo $get_tools['jenis_tools']; ?></td>
                    <td><?php echo $tools_detail['qty']; ?></td>
                    <td><?php echo $get_tools['satuan']; ?></td>
                    <td><?php echo $tools_detail['catatan']; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </form>