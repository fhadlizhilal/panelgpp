<?php
  $get_inductionreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport WHERE id = '$_GET[spkid]'"));
  if($get_inductionreport['status'] == "closed"){
    header("location:page_closed.php");
  }

  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_inductionreport[project_id]'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inductionreport[hse_officer]'"));
?>

<div class="" style="padding-left: 15px; padding-right: 15px; margin-bottom: 50px">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1></h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-2 col-0"></div>
        <div class="col-lg-8 col-12">
          <table class="table table-sm table-bordered">
            <tr>
              <td width="20%" align="center" style="vertical-align: middle;">
                <img src="../../dist/img/logo/gpp-logo.png" style="width: 50px">
              </td>
              <td width="" align="center" style="vertical-align: middle;">
                <h6>INDUKSI DAN SURAT PERJANJIAN KERJA <br> PT GLOBAL PRATAMA POWERINDO</h6>
              </td>
              <td width="20%" align="center" style="vertical-align: middle;">
                <img src="../../dist/img/logo/logo-k3-v2.png" style="width: 50px">
              </td>
            </tr>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-lg-2 col-0"></div>
        <div class="col-lg-8 col-12">
          <form id="myForm" method="POST" action="index.php?pages=ceknik&spkid=<?php echo $_GET['spkid']; ?>" enctype="multipart/form-data">
            <table class="table table-sm table-striped" style="font-size: 12px">
              <tr>
                <td colspan="3" align="center"><b>KETERANGAN PEKERJAAN</b></td>
              </tr>
              <tr>
                <td width="30%">Nama Project</td>
                <td width="1%">:</td>
                <td><?php echo $get_project['nama_project']; ?></td>
              </tr>
              <tr>
                <td>Kota</td>
                <td>:</td>
                <td><?php echo $get_project['kota']; ?></td>
              </tr>
              <tr>
                <td>HSE Officer</td>
                <td>:</td>
                <td><?php echo $get_hseOfficer['nama']; ?></td>
              </tr>
            </table>

            <div class="alert alert-danger alert-dismissible" style="font-size: 12px">
              <h6><i class="icon fas fa-check"></i> NIK Belum Terdaftar!</h6>
              Data anda belum terdaftar pada database manpower kami, silahkan isi form berikut terlebih dahulu!
            </div>

            <table class="table table-sm" style="font-size: 12px; border: none;">
              <tr>
                <td colspan="3" align="center"><b>DATA PRIBADI</b></td>
              </tr>
              <tr>
                <td width="30%">NIK</td>
                <td width="1%">:</td>
                <td>
                  <input type="text" class="form-control form-control-sm" name="cc" value="<?php echo $_GET['nik']; ?>" disabled>
                  <input type="hidden" class="form-control form-control-sm" name="nik" value="<?php echo $_GET['nik']; ?>">
                </td>
              </tr>
              <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="nama" required></td>
              </tr>
              <tr>
                <td>Tempat Lahir</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="tempat_lahir" required></td>
              </tr>
              <tr>
                <td>Tanggal Lahir</td>
                <td>:</td>
                <td><input type="date" class="form-control form-control-sm" name="tgl_lahir" style="width: 150px;" required></td>
              </tr>
              <tr>
                <td>Golongan Darah</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="golongan_darah" style="width: 50px;" required></td>
              </tr>
              <tr>
                <td>Riwayat Penyakit</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="riwayat_penyakit" required></td>
              </tr>
              <tr>
                <td>No Telepon</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="no_telpon" required></td>
              </tr>
              <tr>
                <td>Alamat Lengkap</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="alamat" required></td>
              </tr>
              <tr>
                <td>Posisi Kerja</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="posisi_kerja" required></td>
              </tr>
              <tr>
                <td>Foto Diri</td>
                <td>:</td>
                <td><input type="file" class="form-control form-control-sm" name="file" required></td>
              </tr>
              <tr>
                <td>Foto KTP</td>
                <td>:</td>
                <td><input type="file" class="form-control form-control-sm" name="file2" required></td>
              </tr>
              
              <tr>
                <td colspan="3" align="center"><b>DATA KERABAT</b></td>
              </tr>
              <tr>
                <td>Nama Kerabat</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="nama_kerabat" required></td>
              </tr>
              <tr>
                <td>Hubungan Kerabat</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="hubungan_kerabat" required></td>
              </tr>
              <tr>
                <td>No Telepon</td>
                <td>:</td>
                <td><input type="text" class="form-control form-control-sm" name="no_telpon_kerabat" required></td>
              </tr>
            </table>

            <center>
              <input type="hidden" name="spkid" value="<?php echo $_GET['spkid']; ?>">
              <button type="submit" class="btn btn-success btn-sm" name="submit_addmanpower&spk">
                <span class="fa fa-paper-plane-o"></span> Submit
              </button>
              <a href="index.php?pages=ceknik&spkid=<?php echo $_GET['spkid']; ?>">
                <button type="button" class="btn btn-danger btn-sm"><span class="fa fa-mail-reply"></span> Kembali</button>
              </a>
            </center>
          </form>

          <div class="loading-overlay" id="loadingOverlay">
            <div class="loading-spinner"></div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>