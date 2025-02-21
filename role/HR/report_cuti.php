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

  if(isset($_GET['report_cuti']) AND $_GET['report_cuti'] == "Get Data"){
    $tahunGet = $_GET['tahun'];
  }else{
    $tahunGet = date("Y");
  }

?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Report Cuti</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Report Cuti</li>
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
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <br>
              <form action="index.php?pages=reportcuti" method="GET" enctype="multipart/form-data">
                <div class="inner">
                  <div class="row" style="padding-left: 15px; padding-right: 15px;">
                    <div class="col-lg-5 col-sm-4 col-xs-4 col-4"></div>
                    <div class="col-lg-2 col-sm-4 col-xs-4 col-4">
                      <div class="form-group">
                        <center><label>Tahun</label></center>
                        <select name="tahun" class="form-control" style="font-size: 12px;">
                          <option value="2022" <?php if($tahunGet == "2022"){ echo "selected"; } ?>>2022</option>
                          <option value="2023" <?php if($tahunGet == "2023"){ echo "selected"; } ?>>2023</option>
                          <option value="2024" <?php if($tahunGet == "2024"){ echo "selected"; } ?>>2024</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="reportcuti">
                        <input type="submit" class="btn btn-info btn-md" name="report_cuti" value="Get Data">
                      </center>
                    </div>                  
                  </div>
                </div>
              </form>
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
                <table class="table table-bordered table-hover table-sm" style="font-size: 11px;">
                  <thead>
                    <tr align="center">
                      <th width="1%">No</th>
                      <th>Nik</th>
                      <th>Nama</th>
                      <th width="10%">Cuti Tahunan</th>
                      <th width="10%">Cuti Menikah</th>
                      <th width="10%">Cuti Melahirkan</th>
                      <th width="10%">Cuti Ibadah</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $getSetting = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM setting"));
                      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY nama ASC");
                      while($getKaryawan = mysqli_fetch_array($q_getKaryawan)){
                        $no = $no + 1;
                        $sisa_cuti_tahunan1 = $getSetting['cuti_tahunan'];
                        $sisa_cuti_menikah1 = $getSetting['cuti_menikah'];
                        $sisa_cuti_ibadah1 = $getSetting['cuti_ibadah'];
                        $sisa_cuti_melahirkan1 = $getSetting['cuti_melahirkanP'];
                    ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td><?php echo $no; ?></td>
                          <td><?php echo $getKaryawan['nik']; ?></td>
                          <td><?php echo $getKaryawan['nama']; ?></td>
                          <td align="center">
                            <?php
                              for($i=1;$i<=12;$i++){
                                $bulanke[$i] = 0;
                              }

                              //hitung cuti & izin terpakai perbulan
                              $q_getAbsensi1 = mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$getKaryawan[nik]' AND year(dari)='$tahunGet'");
                              while($getAbsensi1 = mysqli_fetch_array($q_getAbsensi1)){
                                $jarak = $getAbsensi1['sampai'] - $getAbsensi1['dari'];
                                $hari2 = $jarak / 60 / 60 / 24;
                                $hari2 = $hari2 + 1;

                                //hitung cuti & izin perbulan                                            
                                if(date('m', strtotime($getAbsensi1['dari'])) == '1' AND date('m', strtotime($getAbsensi1['sampai'])) == '1' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[1] = $bulanke[1] + 1;

                                  if($bulanke[1] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[1] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '2' AND date('m', strtotime($getAbsensi1['sampai'])) == '2' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[2] = $bulanke[2] + 1;

                                  if($bulanke[2] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[2] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '3' AND date('m', strtotime($getAbsensi1['sampai'])) == '3' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[3] = $bulanke[3] + 1;

                                  if($bulanke[3] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[3] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '4' AND date('m', strtotime($getAbsensi1['sampai'])) == '4' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[4] = $bulanke[4] + 1;

                                  if($bulanke[4] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[4] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '5' AND date('m', strtotime($getAbsensi1['sampai'])) == '5' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[5] = $bulanke[5] + 1;

                                  if($bulanke[5] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[5] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '6' AND date('m', strtotime($getAbsensi1['sampai'])) == '6' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[6] = $bulanke[6] + 1;

                                  if($bulanke[6] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[6] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '7' AND date('m', strtotime($getAbsensi1['sampai'])) == '7' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[7] = $bulanke[7] + 1;

                                  if($bulanke[7] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[7] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '8' AND date('m', strtotime($getAbsensi1['sampai'])) == '8' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[8] = $bulanke[8] + 1;

                                  if($bulanke[8] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[8] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '9' AND date('m', strtotime($getAbsensi1['sampai'])) == '9' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[9] = $bulanke[9] + 1;

                                  if($bulanke[9] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[9] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '10' AND date('m', strtotime($getAbsensi1['sampai'])) == '10' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[10] = $bulanke[10] + 1;

                                  if($bulanke[10] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[10] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '11' AND date('m', strtotime($getAbsensi1['sampai'])) == '11' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[11] = $bulanke[11] + 1;

                                  if($bulanke[11] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[11] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }elseif(date('m', strtotime($getAbsensi1['dari'])) == '12' AND date('m', strtotime($getAbsensi1['sampai'])) == '12' AND ($getAbsensi1['status'] == "Izin Tidak Masuk" OR $getAbsensi1['status'] == "Sakit - Tanpa SKD" OR $getAbsensi1['status'] == "Tanpa Keterangan")){

                                  $bulanke[12] = $bulanke[12] + 1;

                                  if($bulanke[12] < 1 AND $hari2 > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1-($hari2 - 1);
                                  }elseif($bulanke[12] > 1){
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                  }else{
                                    $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                  }

                                }else{
                                  $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1;
                                }

                                if($getAbsensi1['status'] == "Cuti - Tahunan"){
                                  $sisa_cuti_tahunan1 = $sisa_cuti_tahunan1 - $hari2;
                                }
                              }

                              echo $sisa_cuti_tahunan1." Hari";
                            ?>
                          </td>
                          <td align="center">
                            <?php
                            $q_getAbsensi1 = mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$getKaryawan[nik]' AND year(dari)='$tahunGet'");
                              while($getAbsensi1 = mysqli_fetch_array($q_getAbsensi1)){
                                if($getAbsensi1['status'] == "Cuti - Menikah"){
                                  $sisa_cuti_menikah1 = $sisa_cuti_menikah1 - $hari2;
                                }else{
                                  $sisa_cuti_menikah1;
                                }
                              }

                              echo $sisa_cuti_menikah1." Hari";
                            ?>
                          </td>
                          <td align="center">
                            <?php
                              $q_getAbsensi1 = mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$getKaryawan[nik]' AND year(dari)='$tahunGet'");
                              while($getAbsensi1 = mysqli_fetch_array($q_getAbsensi1)){
                                if($getAbsensi1['status'] == "Cuti - Melahirkan"){
                                  $sisa_cuti_melahirkan1 = $sisa_cuti_melahirkan1 - $hari2;
                                }else{
                                  $sisa_cuti_melahirkan1;
                                }
                              }

                              echo $sisa_cuti_melahirkan1." Hari";
                            ?>
                          </td>
                          <td align="center">
                            <?php
                            $q_getAbsensi1 = mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$getKaryawan[nik]' AND year(dari)='$tahunGet'");
                              while($getAbsensi1 = mysqli_fetch_array($q_getAbsensi1)){
                                if($getAbsensi1['status'] == "Cuti - Ibadah"){
                                  $sisa_cuti_ibadah1 = $sisa_cuti_ibadah1 - $hari2;
                                }else{
                                  $sisa_cuti_ibadah1;
                                }
                              }

                              echo $sisa_cuti_ibadah1." Hari";
                            ?>
                          </td>
                        </tr>
                        <tr class="expandable-body">
                          <td colspan="7">
                            <div class="card" style="background-color: #dee1ff; font-size: 10px;">
                              <table class="table table-sm">
                                <thead>
                                  <tr>
                                    <th width="1%">No</th>
                                    <th>Status</th>
                                    <th width="15%">Dari Tanggal</th>
                                    <th width="15%">Sampai Tanggal</th>
                                    <th width="6%">Lama Hari</th>
                                    <th width="6%">Sisa Cuti Tahunan</th>
                                    <th width="6%">Sisa Cuti Menikah</th>
                                    <th width="6%">Sisa Cuti Melahirkan</th>
                                    <th width="6%">Sisa Cuti Ibadah</th>
                                    <th>Keterangan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $no_2 = 0;
                                    $sisa_cuti_tahunan = $getSetting['cuti_tahunan'];
                                    $sisa_cuti_menikah = $getSetting['cuti_menikah'];
                                    $sisa_cuti_ibadah = $getSetting['cuti_ibadah'];
                                    $sisa_cuti_melahirkan = $getSetting['cuti_melahirkanP'];
                                    for($i=1;$i<=12;$i++){
                                      $bulan[$i] = 0;
                                    }


                                    $q_getAbsensi = mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$getKaryawan[nik]' AND year(dari)='$tahunGet'");
                                    while($getAbsensi = mysqli_fetch_array($q_getAbsensi)){
                                      $no_2 = $no_2 + 1;
                                  ?>
                                    <tr>
                                      <td><?php echo $no_2; ?></td>
                                      <td><?php echo $getAbsensi['status']; ?></td>
                                      <td><?php echo $getAbsensi['dari']; ?></td>
                                      <td><?php echo $getAbsensi['sampai']; ?></td>
                                      <td>
                                        <?php
                                          $jarak = $getAbsensi['sampai'] - $getAbsensi['dari'];
                                          $hari = $jarak / 60 / 60 / 24;
                                          $hari = $hari + 1;
                                          echo $hari." Hari";
                                        ?>
                                      </td>
                                      <td>
                                        <?php
                                          //hitung cuti & izin perbulan                                            
                                          if(date('m', strtotime($getAbsensi['dari'])) == '1' AND date('m', strtotime($getAbsensi['sampai'])) == '1' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[1] = $bulan[1] + 1;

                                            if($bulan[1] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[1] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '2' AND date('m', strtotime($getAbsensi['sampai'])) == '2' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[2] = $bulan[2] + 1;

                                            if($bulan[2] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[2] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '3' AND date('m', strtotime($getAbsensi['sampai'])) == '3' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[3] = $bulan[3] + 1;

                                            if($bulan[3] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[3] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '4' AND date('m', strtotime($getAbsensi['sampai'])) == '4' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[4] = $bulan[4] + 1;

                                            if($bulan[4] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[4] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '5' AND date('m', strtotime($getAbsensi['sampai'])) == '5' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[5] = $bulan[5] + 1;

                                            if($bulan[5] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[5] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '6' AND date('m', strtotime($getAbsensi['sampai'])) == '6' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[6] = $bulan[6] + 1;

                                            if($bulan[6] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[6] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '7' AND date('m', strtotime($getAbsensi['sampai'])) == '7' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[7] = $bulan[7] + 1;

                                            if($bulan[7] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[7] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '8' AND date('m', strtotime($getAbsensi['sampai'])) == '8' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[8] = $bulan[8] + 1;

                                            if($bulan[8] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[8] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '9' AND date('m', strtotime($getAbsensi['sampai'])) == '9' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[9] = $bulan[9] + 1;

                                            if($bulan[9] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[9] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '10' AND date('m', strtotime($getAbsensi['sampai'])) == '10' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[10] = $bulan[10] + 1;

                                            if($bulan[10] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[10] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '11' AND date('m', strtotime($getAbsensi['sampai'])) == '11' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[11] = $bulan[11] + 1;

                                            if($bulan[11] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[11] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }elseif(date('m', strtotime($getAbsensi['dari'])) == '12' AND date('m', strtotime($getAbsensi['sampai'])) == '12' AND ($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD" OR $getAbsensi['status'] == "Tanpa Keterangan")){

                                            $bulan[12] = $bulan[12] + 1;

                                            if($bulan[12] < 1 AND $hari > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan-($hari - 1);
                                            }elseif($bulan[12] > 1){
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                            }else{
                                              $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                            }

                                          }else{
                                            $sisa_cuti_tahunan = $sisa_cuti_tahunan;
                                          }

                                          if($getAbsensi['status'] == "Cuti - Tahunan"){
                                            $sisa_cuti_tahunan = $sisa_cuti_tahunan - $hari;
                                          }

                                          echo $sisa_cuti_tahunan." Hari";
                                        ?>
                                      </td>
                                      <td>
                                        <?php
                                          if($getAbsensi['status'] == "Cuti - Menikah"){
                                            $sisa_cuti_menikah = $sisa_cuti_menikah - $hari;
                                          }else{
                                            $sisa_cuti_menikah = $sisa_cuti_menikah;
                                          }

                                          echo $sisa_cuti_menikah." Hari";
                                        ?>
                                      </td>
                                      <td>
                                        <?php
                                          if($getAbsensi['status'] == "Cuti - Melahirkan"){
                                            $sisa_cuti_melahirkan = $sisa_cuti_melahirkan - $hari;
                                          }else{
                                            $sisa_cuti_melahirkan = $sisa_cuti_melahirkan;
                                          }

                                          echo $sisa_cuti_melahirkan." Hari";
                                        ?>
                                      </td>
                                      <td>
                                        <?php
                                          if($getAbsensi['status'] == "Cuti - Ibadah"){
                                            $sisa_cuti_ibadah = $sisa_cuti_ibadah - $hari;
                                          }else{
                                            $sisa_cuti_ibadah = $sisa_cuti_ibadah;
                                          }

                                          echo $sisa_cuti_ibadah." Hari";
                                        ?>
                                      </td>
                                      <td><?php echo $getAbsensi['keterangan']; ?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </td>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
    </section>

  </div>