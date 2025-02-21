<?php
  require_once "../../dev/config.php";
  $today = date("dd-mm-yyyy H:i:s");

  function tanggal_indo($tanggal, $cetak_hari = false)
  {
    $hari = array ( 1 =>    'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        );
        
    $bulan = array (1 =>   'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
        );
    $split    = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    
    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
  }

?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Form Cuti Bersama</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Absen Masuk</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <br>
              <form method="POST" action="index.php?pages=setCutiBersama&edit=on">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-4 col-sm-4 col-xs-4 col-4">
                      <div class="form-group">
                        <center><label>Set Tanggal</label></center>
                        <input type="date" name="tanggal" class="form-control" required style="font-size: 12px;" value="<?php echo $_SESSION['tgl_cuti']; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-6 col-6">
                      <div class="form-group">
                        <center><label>Set Keterangan</label></center>
                        <input type="text" name="keterangan" class="form-control" required style="font-size: 12px;" value="<?php echo $_SESSION['keterangan_cuti']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="submit" class="btn btn-info btn-sm" name="set_cuti_bersama" value="SET">
                      </center>
                    </div>                  
                  </div>
                </div>
              </form>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <br>
            </div>
          </div>
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <div class="inner">
                <div class="row">
                  <div class="col-lg-1"></div>
                  <div class="col-lg-10 col-sm-10 col-xs-10 col-10">
                    <div class="form-group">
                      <center><label>Summary</label></center>
                      <table width="100%" style=" font-size: 12px;">
                        <tr>
                          <td width="30%">Tanggal Absen</td>
                          <td width="3%">:</td>
                          <td><b>
                            <?php
                              $tgl = date("Y-m-d",strtotime($_SESSION['tgl_cuti']));
                              $hari = date('l', strtotime($_SESSION['tgl_cuti']));
                              $cekLibur = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM harilibur WHERE tanggal = '$tgl'"));
                              if($hari == "Saturday" OR $hari == "Sunday" OR $cekLibur > 0){
                                $hari_libur = "ya";
                                echo "<div style='color:red'>".tanggal_indo($_SESSION['tgl_cuti'], TRUE)."</div>";
                              }else{
                                $hari_libur = "tidak";
                                echo tanggal_indo($_SESSION['tgl_cuti'], TRUE);
                              }
                            ?>
                          </b></td>
                        </tr>
                        <tr>
                          <td>Keterangan</td>
                          <td>:</td>
                          <td><b><?php echo $_SESSION['keterangan_cuti']; ?></b></td>
                        </tr>
                        <tr>
                          <td>Cek Tanggal</td>
                          <td>:</td>
                          <td>
                            <?php
                              $tgl_masuk = date("Y-m-d", strtotime($_SESSION['tgl_cuti']));
                              $cek_db = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE tanggal = '$tgl_masuk'"));

                              if($cek_db < 1){
                                $cek_tanggal = "belum ada";
                                echo "<span class='badge badge-success'>data belum ada</span>";
                              }else{
                                $cek_tanggal = "sudah ada";
                                echo "<span class='badge badge-danger'>data sudah ada</span>";
                              }
                            ?>
                          </td>
                        </tr>
                      </table>
                      <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card"><!-- 
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">

                    <?php if(isset($_SESSION['tgl_cuti']) && isset($_SESSION['keterangan_cuti']) & $_GET['edit'] == "on"){ ?>
                      <form action="index.php?pages=setCutiBersama&edit=off" method="post">
                        <table id="formabsen2" class="table table-bordered table-sm table-hover" width="100%" style="font-size: 12px;">
                          <thead>
                          <tr style="text-align: center;">
                            <th width="1%">No</th>
                            <th width="15%">NIK</th>
                            <th width="25%">Nama Karyawan</th>
                            <th width="20%">Status</th>
                            <th width="">Keterangan</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no=1;
                              $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");
                              while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                                //Update from tugas_kantor
                                  $q_tugasKantor = mysqli_query($conn, "SELECT * FROM tugas_kantor WHERE nik = '$get_karyawan[nik]' AND dari <= '$_SESSION[tgl_cuti]' AND sampai >= '$_SESSION[tgl_cuti]'");
                                  $cek_tugasKantor = mysqli_num_rows($q_tugasKantor);
                            ?>
                              <tr>
                                <td style="font-size: 10px;"><?php echo $no; ?></td>
                                <td style="font-size: 10px;"><?php echo $get_karyawan['nik']; ?></td>
                                <td style="font-size: 10px;"><?php echo $get_karyawan['nama']; ?></td>
                                <td style="font-size: 10px; text-align: center;">
                                  <input type="radio" name="options_<?php echo $get_karyawan['nik']; ?>" value="Cuti - Tahunan" style="vertical-align: middle;" <?php if($cek_tugasKantor < 1){ echo "checked"; } ?>>
                                  <label>Cuti Bersama</label>&nbsp; &nbsp;
                                  <input type="radio" name="options_<?php echo $get_karyawan['nik']; ?>" value="Tugas Kantor" style="vertical-align: middle;" <?php if($cek_tugasKantor > 0){ echo "checked"; } ?>>
                                  <label>Tugas Kantor</label>&nbsp; &nbsp;
                                </td>
                                <td style="font-size: 10px; text-align: center;">
                                  <?php
                                    if($cek_tugasKantor > 0){ 
                                      $get_TugasKantor = mysqli_fetch_array($q_tugasKantor);
                                  ?>
                                    <input type="text" name="keterangancuti_<?php echo $get_karyawan['nik']; ?>" style="width: 100%" value="<?php echo $get_TugasKantor['keterangan']; ?>">
                                  <?php }else{ ?>
                                    <input type="text" name="keterangancuti_<?php echo $get_karyawan['nik']; ?>" style="width: 100%" value="<?php echo $_SESSION['keterangan_cuti']; ?>">
                                  <?php } ?>
                                </td>
                              </tr>
                            <?php $no++; } ?>
                          </tbody>
                        </table>
                        <input type="hidden" name="tanggal_cuti" value="<?php echo $_SESSION['tgl_cuti']; ?>">
                        <center><input type="submit" class="btn btn-info" onclick="return confirm('Yakin data absen sudah benar?')" name="simpan_cutibersama_tmp" value="Simpan"></center>
                      </form>

                    <?php }elseif(isset($_SESSION['tgl_cuti']) && isset($_SESSION['keterangan_cuti']) & $_GET['edit'] == "off"){ ?>

                      <form action="index.php?pages=setCutiBersama&edit=off" method="post">
                        <table id="formabsen2" class="table table-bordered table-sm table-hover" width="100%" style="font-size: 12px;">
                          <thead>
                          <tr style="text-align: center;">
                            <th width="1%">No</th>
                            <th width="15%">NIK</th>
                            <th width="25%">Nama Karyawan</th>
                            <th width="20%">Status</th>
                            <th width="">Keterangan</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no=1;
                              $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");
                              while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                                //Update from tugas_kantor
                                  $q_tugasKantor = mysqli_query($conn, "SELECT * FROM tugas_kantor WHERE nik = '$get_karyawan[nik]' AND dari <= '$_SESSION[tgl_cuti]' AND sampai >= '$_SESSION[tgl_cuti]'");
                                  $cek_tugasKantor = mysqli_num_rows($q_tugasKantor);
                                  $get_cutibersama_tmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM cutibersama_tmp WHERE nik = '$get_karyawan[nik]'"));
                            ?>
                              <tr>
                                <td style="font-size: 10px;"><?php echo $no; ?></td>
                                <td style="font-size: 10px;"><?php echo $get_karyawan['nik']; ?></td>
                                <td style="font-size: 10px;"><?php echo $get_karyawan['nama']; ?></td>
                                <td style="font-size: 10px; text-align: center;"><?php echo $get_cutibersama_tmp['status']; ?></td>
                                <td style="font-size: 10px;"><?php echo $get_cutibersama_tmp['keterangan']; ?></td>
                              </tr>
                            <?php $no++; } ?>
                          </tbody>
                        </table> 
                        <input type="hidden" name="tanggal_cuti" value="<?php echo $_SESSION['tgl_cuti']; ?>">
                        <input type="hidden" name="cek_db" value="<?php echo $cek_db; ?>">
                        <center> 
                          <input type="submit" class="btn btn-success" onclick="return confirm('Yakin data yang akan disubmit sudah benar?')" name="submit_cutibersama_tmp" value="Submit">
                          <a href="index.php?pages=setCutiBersama&edit=on"><div class="btn btn-warning">Edit</div></a>
                        </center>
                      </form>


                    <?php }else{ ?>
                      <table id="formabsen2" class="table table-bordered table-sm table-hover" width="100%" style="font-size: 12px;">
                        <thead>
                        <tr style="text-align: center;">
                          <th width="15%">NIK</th>
                          <th width="25%">Nama Karyawan</th>
                          <th width="20%">Status</th>
                          <th width="">Keterangan</th>
                        </tr>
                        </thead>
                      <tbody>
                        <tr>
                          <td colspan="4" style="font-size: 12px;"><center><i>Silahkan Set Tanggal dan Keterangan</i></center></td>
                        </tr>
                      </tbody>
                    </table>

                    <?php } ?>

                <br>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
    </section>

  </div>

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_jam_absen_masuk" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Jam Absen</h4>
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
  <div class="modal fade" id="show_edit_status" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Status</h4>
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
  <div class="modal fade" id="show_edit_fingerprint" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Fingerprint</h4>
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
  <div class="modal fade" id="show_edit_keterangan_absen" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Keterangan</h4>
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