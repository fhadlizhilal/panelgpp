<?php
  setlocale(LC_TIME, 'id_ID');
  $kd_project = $_GET['kd'];
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$_GET[kd]'"));
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Report Project - Detail</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Data Project</li>
              <li class="breadcrumb-item active">Detail Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-7 col-12">
            <div class="card" style="height: 140px">
              <div class="card-header">
                <h3 class="card-title">Informasi Project</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="row">
                  <div class="col-10">
                    <table class="table table-sm" style="font-size: 12px;">
                      <tbody>
                        <tr>
                          <td width="30%"><b>Kode Project</b></td>
                          <td width="1%">:</td>
                          <td><?php echo $_GET['kd']; ?></td>
                        </tr>
                        <tr>
                          <td><b>Nama Project</b></td>
                          <td>:</td>
                          <td><?php echo $get_project['nm_project']; ?></td>
                        </tr>
                        <tr>
                          <td><b>Lokasi / Kota</b></td>
                          <td>:</td>
                          <td><?php echo $get_project['lokasi_project']; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-2">
                    <a href="../unrole/management_asset/download_report_project.php?kd=<?php echo $kd_project; ?>" target="_blank">
                      <div class="btn btn-secondary btn-md" style="margin-right: 10px; margin-left: 10px; margin-top: 10px; font-size: 12px; font-family: cursive;">
                        <span class="fa fa-download"> Download Report</span>
                      </div>
                    </a>
                  </div>

                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-lg-5 col-12">
            <div class="card" style="height: 140px">
              <div class="card-body p-0">
                <center><img src="../../dist/img/ma_pict.jpg" width="70%" style="padding-top: 14px; padding-bottom: 14px;"></center>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-sm-left">Data Peminjaman</h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="18%">No Pinjam</th>
                      <th width="10%">Jenis</th>
                      <th width="18%">Peminjam</th>
                      <th width="18%">Tgl Pinjam</th>
                      <th width="">Keterangan</th>
                      <th width="12%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_peminjaman = mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE kd_project = '$kd_project'");
                      while($get_peminjaman = mysqli_fetch_array($q_get_peminjaman)){
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_peminjamansaya' data-id='<?php echo $get_peminjaman['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Peminjaman">
                            <?php echo $get_peminjaman['id']."/MA/".date('m/Y', strtotime($get_peminjaman['tgl_pinjam'])); ?>
                          </a>
                        </td>
                        <td align="left">
                          <?php if($get_peminjaman['jenis'] == "tools"){ ?>
                                  <span class="badge badge-info">Tools</span>
                                <?php }elseif($get_peminjaman['jenis'] == "apd"){ ?>
                                    <span class="badge badge-success">APD</span>
                                <?php }elseif($get_peminjaman['jenis'] == "inventaris"){ ?>
                                    <span class="badge badge-warning">Inventaris</span>
                                <?php }elseif($get_peminjaman['jenis'] == "alat ukur"){ ?>
                                    <span class="badge badge-danger">Alat Ukur</span>
                                <?php } ?>
                        </td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td><?php echo $get_peminjaman['tgl_pinjam']; ?></td>
                        <td><?php echo $get_peminjaman['keterangan']; ?></td>
                        <td>
                          <?php if($get_peminjaman['status'] == "waiting for MA"){ ?>
                                      <span class="badge badge-secondary">Waiting for MA</span>
                                  <?php }elseif($get_peminjaman['status'] == "on progress by MA"){ ?>
                                      <span class="badge badge-warning">On Progress by MA</span>
                                  <?php }elseif($get_peminjaman['status'] == "rejected by MA"){ ?>
                                      <span class="badge badge-danger">Rejected by MA</span>
                                  <?php }elseif($get_peminjaman['status'] == "canceled by user"){ ?>
                                      <span class="badge badge-danger">Canceled by User</span>
                                  <?php }elseif($get_peminjaman['status'] == "completed"){ ?>
                                      <span class="badge badge-success">Completed</span>
                                  <?php } ?>
                        </td>
                      </tr>
                     <?php $no++;} ?>
                      <tr>
                        <td colspan="7" align="center">
                          <div style="margin: 10px;">
                            <a href="#modal" data-toggle='modal' data-target='#show_detail_totalpeminjaman' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Total Peminjaman">
                              <b>Lihat Total Peminjaman <span class="fa fa-file-text-o"></span></b>
                            </a>
                          </div>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-sm-left">Data Pengajuan</h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="18%">No Pengajuan</th>
                      <th width="10%">Jenis</th>
                      <th width="18%">Pelaksana</th>
                      <th width="10%">Tgl Pengajuan</th>
                      <th width="10%">Tgl Realisasi</th>
                      <th width="">Keterangan</th>
                      <th width="12%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_pengajuan = mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE kd_project = '$kd_project'");
                      while($get_pengajuan = mysqli_fetch_array($q_get_pengajuan)){
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengajuan[pelaksana]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_fu_pengajuan_asset' data-id='<?php echo $get_pengajuan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Pengajuan">
                            <?php echo "PN".$get_pengajuan['id']."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?>
                          </a>
                        </td>
                        <td align="left">
                          <?php if($get_pengajuan['jenis'] == "tools"){ ?>
                                  <span class="badge badge-info">Tools</span>
                                <?php }elseif($get_pengajuan['jenis'] == "apd"){ ?>
                                    <span class="badge badge-success">APD</span>
                                <?php }elseif($get_pengajuan['jenis'] == "inventaris"){ ?>
                                    <span class="badge badge-warning">Inventaris</span>
                                <?php }elseif($get_pengajuan['jenis'] == "alat ukur"){ ?>
                                    <span class="badge badge-danger">Alat Ukur</span>
                                <?php } ?>
                        </td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td><?php echo $get_pengajuan['tgl_pengajuan']; ?></td>
                        <td><?php echo $get_pengajuan['tgl_realisasi']; ?></td>
                        <td><?php echo $get_pengajuan['keterangan']; ?></td>
                        <td>
                          <?php if($get_pengajuan['status'] == "belum realisasi"){ ?>
                                      <span class="badge badge-secondary">Belum Realisasi</span>
                                  <?php }elseif($get_pengajuan['status'] == "sudah realisasi"){ ?>
                                      <span class="badge badge-success">Sudah Realisasi</span>
                                  <?php } ?>
                        </td>
                      </tr>
                     <?php $no++;} ?>
                      <tr>
                        <td colspan="8" align="center">
                          <div style="margin: 10px;">
                            <a href="#modal" data-toggle='modal' data-target='#show_detail_totalpengajuan' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Total Peminjaman">
                              <b>Lihat Total Pengajuan <span class="fa fa-file-text-o"></span></b>
                            </a>
                          </div>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-sm-left">Data Realisasi</h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="18%">No Pengajuan</th>
                      <th width="10%">Jenis</th>
                      <th width="10%">Pelaksana</th>
                      <th width="10%">Tgl Pengajuan</th>
                      <th width="10%">Tgl Realisasi</th>
                      <th width="">Keterangan</th>
                      <th width="12%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_pengajuan = mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE kd_project = '$kd_project'");
                      while($get_pengajuan = mysqli_fetch_array($q_get_pengajuan)){
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengajuan[pelaksana]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_realisasi_asset' data-id='<?php echo $get_pengajuan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Pengajuan">
                            <?php echo "PN".$get_pengajuan['id']."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?>
                          </a>
                        </td>
                        <td align="left">
                          <?php if($get_pengajuan['jenis'] == "tools"){ ?>
                                  <span class="badge badge-info">Tools</span>
                                <?php }elseif($get_pengajuan['jenis'] == "apd"){ ?>
                                    <span class="badge badge-success">APD</span>
                                <?php }elseif($get_pengajuan['jenis'] == "inventaris"){ ?>
                                    <span class="badge badge-warning">Inventaris</span>
                                <?php }elseif($get_pengajuan['jenis'] == "alat ukur"){ ?>
                                    <span class="badge badge-danger">Alat Ukur</span>
                                <?php } ?>
                        </td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td><?php echo $get_pengajuan['tgl_pengajuan']; ?></td>
                        <td><?php echo $get_pengajuan['tgl_realisasi']; ?></td>
                        <td><?php echo $get_pengajuan['keterangan']; ?></td>
                        <td>
                          <?php if($get_pengajuan['status'] == "belum realisasi"){ ?>
                                      <span class="badge badge-secondary">Belum Realisasi</span>
                                  <?php }elseif($get_pengajuan['status'] == "sudah realisasi"){ ?>
                                      <span class="badge badge-success">Sudah Realisasi</span>
                                  <?php } ?>
                        </td>
                      </tr>
                     <?php $no++;} ?>
                      <tr>
                        <td colspan="8" align="center">
                          <div style="margin: 10px;">
                            <a href="#modal" data-toggle='modal' data-target='#show_detail_totalrealisasi' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Total Peminjaman">
                              <b>Lihat Total Realisasi <span class="fa fa-file-text-o"></span></b>
                            </a>
                          </div>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->



        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-sm-left">Data Surat Jalan</h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="18%">No Surat Jalan</th>
                      <th width="5%">Jenis</th>
                      <th width="5%">Entitas</th>
                      <th width="10%">Tanggal</th>
                      <th width="18%">Peminjam</th>
                      <th width="">Alamat Kirim</th>
                      <th width="">Expedisi</th>
                      <th width="5%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_suratjalan = mysqli_query($conn, "SELECT a.id AS suratjalan_id, a.entitas_id, a.tanggal, a.alamat_kirim, a.expedisi, a.status AS status_suratjalan, b.jenis, b.peminjam FROM asset_suratjalan a JOIN asset_peminjaman b ON a.peminjaman_id = b.id WHERE b.kd_project = '$kd_project'");
                      while($get_suratjalan = mysqli_fetch_array($q_get_suratjalan)){
                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_suratjalan[entitas_id]'"));

                              $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_suratjalan[peminjam]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_suratjalan' data-id='<?php echo $get_suratjalan['suratjalan_id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Lihat Surat Jalan">
                            <?php echo "SJ".$get_suratjalan['suratjalan_id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?>
                          </a>
                        </td>
                        <td align="left">
                          <?php if($get_suratjalan['jenis'] == "tools"){ ?>
                                  <span class="badge badge-info">Tools</span>
                                <?php }elseif($get_suratjalan['jenis'] == "apd"){ ?>
                                    <span class="badge badge-success">APD</span>
                                <?php }elseif($get_suratjalan['jenis'] == "inventaris"){ ?>
                                    <span class="badge badge-warning">Inventaris</span>
                                <?php }elseif($get_suratjalan['jenis'] == "alat ukur"){ ?>
                                    <span class="badge badge-danger">Alat Ukur</span>
                                <?php } ?>
                        </td>
                        <td><?php echo $get_entitas['entitas']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($get_suratjalan['tanggal'])); ?></td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td><?php echo $get_suratjalan['alamat_kirim']; ?></td>
                        <td><?php echo $get_suratjalan['expedisi']; ?></td>
                        <td>
                          <?php if($get_suratjalan['status_suratjalan'] == "dalam pengiriman"){ ?>
                                      <span class="badge badge-secondary">Dalam Pengiriman</span>
                                  <?php }elseif($get_suratjalan['status_suratjalan'] == "diterima & sesuai"){ ?>
                                      <span class="badge badge-success">Diterima & Sesuai</span>
                                  <?php } ?>
                        </td>
                      </tr>
                     <?php $no++;} ?>

                    <tr>
                      <td colspan="9" align="center">
                        <div style="margin: 10px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_totalsuratjalan' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Total Surat Jalan">
                            <b>Lihat Total Surat Jalan <span class="fa fa-file-text-o"></span></b>
                          </a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->



        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-sm-left">Data Pengembalian</h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%" style="font-weight: bold;">No</th>
                      <th width="18%" style="font-weight: bold;">No Pengembalian</th>
                      <th width="10%" style="font-weight: bold;">Entitas</th>
                      <th width="15%" style="font-weight: bold;">Tanggal</th>
                      <th width="25%" style="font-weight: bold;">Penanggungjawab</th>
                      <th width="" style="font-weight: bold;">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no=1;
                      $q_get_pengembalian = mysqli_query($conn, "SELECT * FROM asset_pengembalian WHERE kd_project = '$kd_project'");
                      while($get_pengembalian = mysqli_fetch_array($q_get_pengembalian)){
                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengembalian[entitas_id]'"));

                              $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengembalian[penanggungjawab]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_lihat_pengembalian' data-id='<?php echo $get_pengembalian['id'] ?>' data-toggle="tooltip" data-placement="bottom" title="Lihat Pengembalian">
                            <?php echo "RTN".$get_pengembalian['id']."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?>
                          </a>
                        </td>
                        <td><?php echo $get_entitas['entitas']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($get_pengembalian['tanggal'])); ?></td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td>
                          <?php if($get_pengembalian['status'] == "waiting for approval"){ ?>
                                      <span class="badge badge-secondary">Waiting for Approval</span>
                                  <?php }elseif($get_pengembalian['status'] == "BA approved"){ ?>
                                      <span class="badge badge-success">BA Approved</span>
                                  <?php } ?>
                        </td>
                      </tr>
                     <?php $no++;} ?>

                     <tr>
                      <td colspan="9" align="center">
                        <div style="margin: 10px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_totalpengembalian' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Total Pengembalian">
                            <b>Lihat Total Pengembalian <span class="fa fa-file-text-o"></span></b>
                          </a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->



      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_peminjamansaya" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Peminjaman</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myForm" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_totalpeminjaman" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Peminjaman</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myForm" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_fu_pengajuan_asset" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pengajuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myFormB" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_totalpengajuan" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Pengajuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myFormB" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_totalrealisasi" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Pengajuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myFormB" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_totalsuratjalan" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Pengajuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myFormB" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_totalpengembalian" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h4 class="modal-title">Detail Pengajuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          <form id="myForm2" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_suratjalan" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <form id="myFormB" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_lihat_pengembalian" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pengembalian</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-data"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_realisasi_asset" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Pengajuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myFormB" method="POST" action="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->