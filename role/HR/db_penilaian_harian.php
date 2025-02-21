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
    $tgl_indo = $split[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[2];
    
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
            <h1 class="m-0">DB Penilaian Harian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DB Penilaian Harian</li>
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
          <div class="col-lg-9 col-9">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <br>
              <form action="index.php?pages=dbpenilaian" method="GET" enctype="multipart/form-data">
                <div class="inner">
                  <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-3 col-sm-3 col-xs-3 col-3">
                      <div class="form-group">
                        <center><label>Dari Tanggal</label></center>
                        <input type="date" name="dari_tanggal" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-3 col-3">
                      <div class="form-group">
                        <center><label>Sampai Tanggal</label></center>
                        <input type="date" name="sampai_tanggal" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-6 col-6">
                      <div class="form-group">
                        <center><label>Karyawan</label></center>
                        <select class="form-control" name="nik" required style="font-size: 12px;">
                          <option value="" selected disabled>--------- Pilih Karyawan ---------</option>
                          <?php
                            $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan ORDER BY nama ASC");
                            while($getKaryawan = mysqli_fetch_array($q_getKaryawan)){
                          ?>
                            <option value="<?php echo $getKaryawan["nik"] ?>"><?php echo $getKaryawan["nama"]." - ".$getKaryawan["nik"]; ?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="dbpenilaian">
                        <input type="submit" class="btn btn-info btn-md" name="penilaian_harian_karyawan" value="Get Data">
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
          <div class="col-lg-3 col-3">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <br>
              <form method="GET" action="index.php?pages=dbpenilaian">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10 col-sm-10 col-xs-10 col-10">
                      <div class="form-group">
                        <center><label>Tanggal</label></center>
                        <input type="date" name="tanggal" maxlength="255" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="dbpenilaian">
                        <input type="submit" class="btn btn-info btn-md" name="penilaian_harian_tanggal" value="Get Data">
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
        </div>
        <div class="card"><!-- 
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <?php
                  if(isset($_GET['penilaian_harian_tanggal'])){
                    if($_GET['penilaian_harian_tanggal'] == "Get Data"){
                ?>
                  <table id="example1" class="table table-bordered table-sm table-striped" width="100%" style="font-size: 12px;">
                    <thead>
                    <tr style="text-align: center;">
                      <th width="6%">Tgl Penilaian</th>
                      <th width="2%">NIK</th>
                      <th width="12%">Nama Karyawan</th>
                      <th width="6%">Program</th>
                      <th width="6%">Seragam</th>
                      <th width="8%">Nametag</th>
                      <th width="1%">#</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $q_getPenilaian = mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE tanggal = '$_GET[tanggal]'");
                        while($getPenilaian = mysqli_fetch_array($q_getPenilaian)){
                          $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getPenilaian[nik]'"));
                          $getAbsenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getPenilaian[nik]' AND tanggal = '$getPenilaian[tanggal]'"));
                      ?>
                        <tr>
                          <td style="font-size: 10px;"><?php echo date("d-m-Y", strtotime($getPenilaian['tanggal'])); ?></td>
                          <td style="font-size: 10px;"><?php echo $getPenilaian['nik']; ?></td>
                          <td style="font-size: 10px;"><?php echo $getKaryawan['nama']; ?></td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              if($getPenilaian['program'] == "-"){
                                echo $getAbsenMasuk['status'];
                              }else{
                                echo $getPenilaian['program'];
                              }
                            ?> 
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              if($getPenilaian['seragam'] == "-"){
                                echo $getAbsenMasuk['status'];
                              }else{
                                echo $getPenilaian['seragam'];
                              }
                            ?>                          
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              if($getPenilaian['nametag'] == "-"){
                                echo $getAbsenMasuk['status'];
                              }else{
                                echo $getPenilaian['nametag'];
                              }
                            ?>
                          </td>
                          <td style="font-size: 11px;">
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_penilaian_harian' data-id='<?php echo $getPenilaian['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit">
                              <span class="fa fa-edit"></span>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                  <!----------------------------- REPORT ABSEN KARYAWAN ----------------------------------->

                <?php
                    }
                  }elseif(isset($_GET['penilaian_harian_karyawan'])){
                    if($_GET['penilaian_harian_karyawan'] == "Get Data"){
                ?>
                  <table id="example1" class="table table-bordered table-sm table-striped" width="100%" style="font-size: 12px;">
                    <thead>
                    <tr style="text-align: center;">
                      <th width="6%">Tgl Penilaian</th>
                      <th width="2%">NIK</th>
                      <th width="12%">Nama Karyawan</th>
                      <th width="6%">Program</th>
                      <th width="6%">Seragam</th>
                      <th width="8%">Nametag</th>
                      <th width="1%">#</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $q_getPenilaian = mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE tanggal >= '$_GET[dari_tanggal]' AND tanggal <= '$_GET[sampai_tanggal]' AND nik = '$_GET[nik]'");
                        while($getPenilaian = mysqli_fetch_array($q_getPenilaian)){
                          $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getPenilaian[nik]'"));
                          $getAbsenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getPenilaian[nik]' AND tanggal = '$getPenilaian[tanggal]'"));
                      ?>
                        <tr>
                          <td style="font-size: 10px;"><?php echo date("d-m-Y", strtotime($getPenilaian['tanggal'])); ?></td>
                          <td style="font-size: 10px;"><?php echo $getPenilaian['nik']; ?></td>
                          <td style="font-size: 10px;"><?php echo $getKaryawan['nama']; ?></td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              if($getPenilaian['program'] == "-"){
                                echo $getAbsenMasuk['status'];
                              }else{
                                echo $getPenilaian['program'];
                              }
                            ?> 
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              if($getPenilaian['seragam'] == "-"){
                                echo $getAbsenMasuk['status'];
                              }else{
                                echo $getPenilaian['seragam'];
                              }
                            ?>                          
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              if($getPenilaian['nametag'] == "-"){
                                echo $getAbsenMasuk['status'];
                              }else{
                                echo $getPenilaian['nametag'];
                              }
                            ?>
                          </td>
                          <td style="font-size: 11px;">
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_penilaian_harian' data-id='<?php echo $getPenilaian['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit">
                              <span class="fa fa-edit"></span>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                <?php 
                    }
                  }else{
                ?>

                    <table id="example1" class="table table-bordered table-sm table-striped" width="100%" style="font-size: 12px;">
                    <thead>
                    <tr style="text-align: center;">
                      <th width="6%">Tgl Penilaian</th>
                      <th width="2%">NIK</th>
                      <th width="12%">Nama Karyawan</th>
                      <th width="6%">Program</th>
                      <th width="6%">Seragam</th>
                      <th width="8%">Nametag</th>
                      <th width="1%">#</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $q_getPenilaian = mysqli_query($conn, "SELECT * FROM penilaian_harian ORDER BY tanggal DESC LIMIT 500");
                        while($getPenilaian = mysqli_fetch_array($q_getPenilaian)){
                          $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getPenilaian[nik]'"));
                          $getAbsenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getPenilaian[nik]' AND tanggal = '$getPenilaian[tanggal]'"));
                      ?>
                        <tr>
                          <td style="font-size: 10px;"><?php echo date("d-m-Y", strtotime($getPenilaian['tanggal'])); ?></td>
                          <td style="font-size: 10px;"><?php echo $getPenilaian['nik']; ?></td>
                          <td style="font-size: 10px;"><?php echo $getKaryawan['nama']; ?></td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              if($getPenilaian['program'] == "-"){
                                echo $getAbsenMasuk['status'];
                              }else{
                                echo $getPenilaian['program'];
                              }
                            ?> 
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              if($getPenilaian['seragam'] == "-"){
                                echo $getAbsenMasuk['status'];
                              }else{
                                echo $getPenilaian['seragam'];
                              }
                            ?>                          
                          </td>
                          <td style="font-size: 10px; text-align: center;">
                            <?php
                              if($getPenilaian['nametag'] == "-"){
                                echo $getAbsenMasuk['status'];
                              }else{
                                echo $getPenilaian['nametag'];
                              }
                            ?>
                          </td>
                          <td style="font-size: 11px;">
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_penilaian_harian' data-id='<?php echo $getPenilaian['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit">
                              <span class="fa fa-edit"></span>
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>

                <?php
                  } 
                ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
    </section>

  </div>

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_penilaian_harian" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Penilaian Harian</h4>
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