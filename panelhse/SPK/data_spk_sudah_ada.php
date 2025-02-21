<?php
  $get_inductionreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport WHERE id = '$_GET[spkid]'"));
  if($get_inductionreport['status'] == "closed"){
    header("location:page_closed.php");
  }

  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_inductionreport[project_id]'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inductionreport[hse_officer]'"));
  $get_inductionreport_spk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport_spk WHERE id = '$_GET[induction_spk_id]'"));
?>

<div class="" style="padding-left: 15px; padding-right: 15px">
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
          <form method="POST" action="">
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
              <tr>
                <td>NIK Manpower</td>
                <td>:</td>
                <td><?php echo $get_inductionreport_spk['nik']; ?></td>
              </tr>
              <tr>
                <td>Nama Manpower</td>
                <td>:</td>
                <td><?php echo $get_inductionreport_spk['nama']; ?></td>
              </tr>
            </table>
            <div class="alert alert-success alert-dismissible" style="font-size: 12px">
              <h6><i class="icon fas fa-check"></i> SPK Sudah Ditanda Tangan!</h6>
              Anda Sudah Menandatangani SPK untuk Project / Pekerjaan ini!
            </div>
          </form>
          <center>
              <a href="index.php?pages=reportspk&induction_spk_id=<?php echo $_GET['induction_spk_id']; ?>&file_name=<?php echo "SPK_".$get_project['nama_project']."_".$get_inductionreport_spk['nama']; ?>"><button class="btn btn-secondary btn-sm"><span class="fa fa-file-text-o"></span> Lihat SPK</button></a>
              <a href="index.php?pages=ceknik&spkid=<?php echo $_GET['spkid']; ?>"><button class="btn btn-danger btn-sm"><span class="fa fa-mail-reply"></span> Kembali</button></a>
            </center>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>