<?php
  setlocale(LC_TIME, 'id_ID');
  $get_inspeksilist = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE id = '$_GET[idinspeksi]'"));
  $data_array = explode("/", $get_inspeksilist['kd_weekly']);
  $week = $data_array[1];
  $kd_project = $data_array[2];

  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$kd_project'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inspeksilist[hse_officer]'"));
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row" style="margin-bottom: 5px;">
                  <div class="col-6"><img src="../../dist/img/alamat_gpp_v2.jpg" width="210px"></div>
                  <div class="col-6"><div style="text-align: right;"><img src="../../dist/img/logo/logo-k3.png" width="90px"></div></div>
                </div>

                <div class="row" style="font-size: 11px; margin-bottom: -10px;">
                  <table class="table table-sm table-bordered">
                    <tr>
                      <td rowspan="3" width="25%" style="vertical-align: middle;">
                        <center><img src="../../dist/img/logo/gpp-logo.png" width="60px"></center>
                      </td>
                      <td style="vertical-align: middle; font-weight: bold;" align="center">CHECKLIST INSPEKSI APD</td>
                      <td width="10%" style="font-weight: bold;">No. Dok</td>
                      <td width="15%" style="font-weight: bold;">GPP/HSE07/17/22</td>
                    </tr>
                    <tr>
                      <td rowspan="2" style="vertical-align: middle; font-weight: bold;" align="center">PT GLOBAL PROTAMA POWERINDO</td>
                      <td style="font-weight: bold;">Rev</td>
                      <td style="font-weight: bold;">1/1</td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Tanggal</td>
                      <td style="font-weight: bold;">01/04/2024</td>
                    </tr>
                  </table>
                </div>

                <div class="row" style="font-size: 11px; margin-bottom: -10px;">
                  <table class="table table-sm table-bordered">
                    <tr>
                      <td width="15%" style="font-weight: bold;">Nama Inspektor</td>
                      <td width="40%"><?php echo $get_hseOfficer['nama']; ?></td>
                      <td width="15%" style="font-weight: bold;">Tanggal Inspeksi</td>
                      <td><?php echo date("d-m-Y", strtotime($get_inspeksilist['tanggal_inspeksi'])); ?></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Jabatan</td>
                      <td>HSE Officer</td>
                      <td style="font-weight: bold;">Lokasi Kerja</td>
                      <td><?php echo $get_project['nama_project']; ?></td>
                    </tr>
                  </table>
                </div>

                <div class="row" style="font-size: 11px; margin-bottom: -10px;">
                  <table class="table table-sm table-bordered">
                    <tr>
                      <th width="1%" style="vertical-align: middle; text-align: center;">No</th>
                      <th style="vertical-align: middle; text-align: center;">Nama Alat Pelindung Diri</th>
                      <th width="5%" style="vertical-align: middle; text-align: center;">Total Asset</th>
                      <th width="5%" style="vertical-align: middle; text-align: center;">Jumlah Minggu Ini</th>
                      <th width="5%" style="vertical-align: middle; text-align: center;">% Deviasi</th>
                      <th width="5%" style="vertical-align: middle; text-align: center;">Baik</th>
                      <th width="5%" style="vertical-align: middle; text-align: center;">Rusak</th>
                      <th width="5%" style="vertical-align: middle; text-align: center;">Hilang</th>
                    </tr>

                <!-- -------------------------------- PELINDUNG KEPALA ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Pelindung Kepala</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Pelindung Kepala' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>

                <!-- -------------------------------- PELINDUNG MATA ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Pelindung Mata</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Pelindung Mata' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>

                <!-- -------------------------------- PELINDUNG WAJAH ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Pelindung Wajah</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Pelindung Wajah' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>

                <!-- -------------------------------- PELINDUNG TELINGA ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Pelindung Telinga</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Pelindung Telinga' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>

                <!-- -------------------------------- PELINDUNG PERNAFASAN ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Pelindung Pernafasan</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Pelindung Pernafasan' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>

                <!-- -------------------------------- PELINDUNG TUBUH ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Pelindung Tubuh</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Pelindung Tubuh' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>

                <!-- -------------------------------- PELINDUNG TANGAN ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Pelindung Tangan</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Pelindung Tangan' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>

                <!-- -------------------------------- PELINDUNG KAKI ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Pelindung Kaki</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Pelindung Kaki' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>

                <!-- -------------------------------- FULL BODY HARNESS ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Full Body Harness</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Full Body Harness' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>

                <!-- -------------------------------- PELINDUNG ALAT KERJA / MATERIAL ----------------------------- -->
                    <tr>
                      <td colspan="8" style="font-size: 12px; font-weight: bold;">&nbsp;&nbsp;Pelindung Alat Kerja / Material</td>
                    </tr>
                    <?php
                      $no=1;
                      $q_get_inspeksilist_detailapd  = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd JOIN hse_apd ON hse_inspeksilist_detailapd.apd_id = hse_apd.id WHERE hse_apd.jenis = 'Pelindung Alat Kerja / Material' AND hse_inspeksilist_detailapd.inspeksi_id = '$_GET[idinspeksi]'");
                      while($get_inspeksi_detailapd = mysqli_fetch_array($q_get_inspeksilist_detailapd)){
                        $jumlah = $get_inspeksi_detailapd['baik']+$get_inspeksi_detailapd['rusak']+$get_inspeksi_detailapd['hilang'];
                        $deviasi = 100 - ($get_inspeksi_detailapd['baik'] / $get_inspeksi_detailapd['total_asset'] * 100);
                    ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_inspeksi_detailapd['nama_apd']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['total_asset']; ?></td>
                          <td align="center"><?php echo '<b>'.$get_inspeksi_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                          <td align="center"><?php echo number_format($deviasi,0)."%"; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['baik']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['rusak']; ?></td>
                          <td align="center"><?php echo $get_inspeksi_detailapd['hilang']; ?></td>
                        </tr>

                    <?php $no++; } ?>
                  </table>
                </div>

                <!-- Array Dokumentasi -->
                <?php
                  $foto_ke = 1;
                  $q_get_dokumentasi_inspeksiapd = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotoapd WHERE inspeksi_id = '$_GET[idinspeksi]'");
                  while($get_dokumentasi_inspeksiapd = mysqli_fetch_array($q_get_dokumentasi_inspeksiapd)){
                    $dokumentasi[$foto_ke] = $get_dokumentasi_inspeksiapd['foto'];
                    $keterangan[$foto_ke] = $get_dokumentasi_inspeksiapd['keterangan'];
                    $foto_ke++;
                  }
                ?>

                <div class="row" style="font-size: 11px; margin-bottom: -10px;">
                  <table class="table table-sm table-bordered">
                    <tr>
                      <td colspan="4" style="font-weight: bold; text-align: center;">Dokumentasi</td>
                    </tr>
                    <tr>
                      <td width="25%">
                        <img src="../../role/HSE/foto_inspeksi_apd/<?php echo $dokumentasi[1]; ?>" width="100%">
                      </td>
                      <td width="25%">
                        <img src="../../role/HSE/foto_inspeksi_apd/<?php echo $dokumentasi[2]; ?>" width="100%">
                      </td>
                      <td width="25%">
                        <img src="../../role/HSE/foto_inspeksi_apd/<?php echo $dokumentasi[3]; ?>" width="100%">
                      </td>
                      <td width="25%">
                        <img src="../../role/HSE/foto_inspeksi_apd/<?php echo $dokumentasi[4]; ?>" width="100%">
                      </td>
                    </tr>
                    <tr>
                      <td align="center"><?php echo $keterangan[1]; ?></td>
                      <td align="center"><?php echo $keterangan[2]; ?></td>
                      <td align="center"><?php echo $keterangan[3]; ?></td>
                      <td align="center"><?php echo $keterangan[4]; ?></td>
                    </tr>
                  </table>
                </div>

                <div class="row" style="font-size: 11px;">
                  <table class="table table-sm table-bordered">
                    <tr>
                      <td colspan="2" width="70%">
                        <b>Rekomendasi :</b><br>
                        <?php echo $get_inspeksilist['rekomendasi']; ?>
                      </td>
                      <td rowspan="2" align="center"><img src="../../dist/img/picture_apd.jpg" width="50%"></td>
                    </tr>
                    <tr>
                      <td colspan="2" style="vertical-align: bottom;">
                        <b>Catatan :</b><br>
                        1. Pengecekan APD dilakukan setiap minggu<br>
                        2. Pastikan APD disimpan pada area kering dan aman<br>
                        3. Pastikan penggunaan APD sesuai dengan bahaya yang ada<br>
                        4. Pastikan APD aman pada saat akan digunakan<br>
                        5. Pastikan APD yang akan dipakai tersedia, cukup,dan dalam keadaan baik
                      </td>
                    </tr>
                  </table>
                </div>

                <div class="row" style="font-size: 11px; margin-bottom: -10px;">
                  <table width="100%" border="0">
                    <tr>
                      <td></td>
                      <td align="center">Diperiksa Oleh</td>
                      <td></td>
                      <td align="center">Disetujui Oleh</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td align="center" height="100px"><img src="../../role/HSE/signatures/<?php echo $get_inspeksilist['ttd_hse']; ?>" width="20%"></td>
                      <td></td>
                      <td align="center" height="100px"><img src="../../role/HSE/signatures/<?php echo $get_inspeksilist['ttd_sm']; ?>" width="20%"></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td align="center"><?php echo $get_hseOfficer['nama']; ?></td>
                      <td></td>
                      <td align="center"><?php echo $get_inspeksilist['site_manager']; ?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td align="center">HSE Officer</td>
                      <td></td>
                      <td align="center">Site Manager</td>
                      <td></td>
                    </tr>
                  </table>
                </div>
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

  <script>
    window.onload = function() {
        window.print();
    };
  </script>

  <script>
    document.title = "<?php echo "Report Inspeksi APD W".$week." - ".$get_project['nama_project']; ?>";
  </script>