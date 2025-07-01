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
                          <option value="2025" <?php if($tahunGet == "2025"){ echo "selected"; } ?>>2025</option>
                          <option value="2026" <?php if($tahunGet == "2026"){ echo "selected"; } ?>>2026</option>
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
                      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY nama ASC");
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


                                    $q_getAbsensi = mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$getKaryawan[nik]' AND year(dari)='$tahunGet' ORDER BY dari ASC");
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