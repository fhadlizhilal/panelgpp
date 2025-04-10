  <?php
    $get_inspeksilist = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE id = '$_GET[kd]'"));
    $get_hse_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inspeksilist[hse_officer]'"));
    $data_array = explode("/", $get_inspeksilist['kd_weekly']);
    $week = $data_array[1];
    $kd_project = $data_array[2];

    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$kd_project'"));

    $point_1["A"] = 20; $point_1["B"] = 40; $point_1["C"] = 40;
    $point_2["A"] = 2; $point_2["B"] = 4; $point_2["C"] = 6;
    $point_3["A"] = 2; $point_3["B"] = 4; $point_3["C"] = 6;
    $point_4["A"] = 2; $point_4["B"] = 4; $point_4["C"] = 6;
    $point_5["A"] = 10; $point_5["B"] = 15; $point_5["C"] = 20;
    $point_6["A"] = 1; $point_6["B"] = 2; $point_6["C"] = 3;
    $point_7["A"] = 2; $point_7["B"] = 4; $point_7["C"] = 6;
    $point_8["A"] = 1; $point_8["B"] = 1; $point_8["C"] = 1;
    $point_9["A"] = 12; $point_9["B"] = 12; $point_9["C"] = 12;
    $point_10["A"] = 2; $point_10["B"] = 3; $point_10["C"] = 4;
    $point_11["A"] = 1; $point_11["B"] = 1; $point_11["C"] = 1;
    $point_12["A"] = 1; $point_12["B"] = 1; $point_12["C"] = 1;
    $point_13["A"] = 1; $point_13["B"] = 1; $point_13["C"] = 1;
    $point_14["A"] = 1; $point_14["B"] = 2; $point_14["C"] = 3;
    $point_15["A"] = 1; $point_15["B"] = 1; $point_15["C"] = 1;
    $point_16["A"] = 1; $point_16["B"] = 1; $point_16["C"] = 1;
    $point_17["A"] = 1; $point_17["B"] = 1; $point_17["C"] = 1;
    $point_18["A"] = 1; $point_18["B"] = 1; $point_18["C"] = 1;
    $point_19["A"] = 1; $point_19["B"] = 1; $point_19["C"] = 1;
    $point_20["A"] = 1; $point_20["B"] = 1; $point_20["C"] = 1;
  ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">




        <!-- PAGE REPORT -->
        <?php
          $q_get_detailinspeksi_p3k = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailp3k WHERE inspeksi_id = '$_GET[kd]'");
          while($get_detailinspeksi_p3k = mysqli_fetch_array($q_get_detailinspeksi_p3k)){
            $id_detail = $get_detailinspeksi_p3k['id'];
        ?>
            <div style="page-break-before: always;"></div>
            <div class="row">
              <div class="col-lg-12 col-12">
                <div class="card" style="margin-right: -10px;">
                  <div class="card-body">
                    <div class="row" style="margin-bottom: 5px;">
                      <div class="col-6"><img src="../../dist/img/alamat_gpp_v2.jpg" width="210px"></div>
                      <div class="col-6"><div style="text-align: right;"><img src="../../dist/img/logo/logo-k3.png" width="90px"></div></div>
                    </div>

                    <div class="row" style="margin-bottom: 0px">
                      <div class="col-12">
                        <table class="table table-bordered table-sm">
                          <tr>
                            <td width="10%" rowspan="3" style="vertical-align: middle;">
                              <center>
                                <img src="../../dist/img/logo/gpp-logo.png" width="50%">
                              </center>
                            </td>
                            <td width="70%" style="font-size: 12px; font-weight: bold;"><center>CHECKLIST INSPEKSI P3K</center></td>
                            <td width="10%" style="font-size: 12px">No. Dok</td>
                            <td style="font-size: 12px">GPP/HSE07/16/22</td>
                          </tr>
                          <tr>
                            <td rowspan="2" style="font-size: 12px; font-weight: bold;"><center>PT GLOBAL PROTAMA POWERINDO</center></td>
                            <td style="font-size: 12px">Rev.</td>
                            <td style="font-size: 12px">1/1</td>
                          </tr>
                          <tr>
                            <td style="font-size: 12px">Tanggal</td>
                            <td style="font-size: 12px">01/04/2024</td>
                          </tr>
                        </table>

                        <table style="margin-top: 10px; font-size: 12px;" class="table table-bordered table-sm" width="100%">
                          <tr>
                            <td width="10%">&nbsp; Nama Inspektor</td>
                            <td width="30%"><?php echo $get_hse_manpower['nama']; ?></td>
                            <td width="10%">&nbsp; Tanggal Inspeksi</td>
                            <td width="30%"><?php echo date("d-m-Y", strtotime($get_inspeksilist['tanggal_inspeksi'])); ?></td>
                            <td width="20%" rowspan="2" style="vertical-align: middle;">
                              <div style="font-size: 30px; font-weight: bold; margin-right: 10px; margin-left: 10px"><?php echo $get_detailinspeksi_p3k['tipe_kotak']; ?></div>
                            </td>
                          </tr>
                          <tr>
                            <td width="15%">&nbsp; Jabatan</td>
                            <td width="40%">HSE Officer</td>
                            <td width="15%">&nbsp; Lokasi Kerja</td>
                            <td width="30%"><?php echo $get_project['nama_project']." - ".$get_project['kota']; ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                          <thead style="text-align: center;">
                            <tr>
                              <th style="vertical-align: middle;" width="1%" rowspan="2">No</th>
                              <th style="vertical-align: middle;" width="40%" rowspan="2">Item Pemeriksaan</th>
                              <th style="vertical-align: middle;" colspan="3">Tipe Kotak</th>
                              <th style="vertical-align: middle;" width="10%" rowspan="2">Hasil Inspeksi<br>(qty)</th>
                              <th style="vertical-align: middle;" width="20%" rowspan="2">Keterangan</th>
                            </tr>
                            <tr>
                              <th width="5%">A</th>
                              <th width="5%">B</th>
                              <th width="5%">C</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Kasa steril terbungkus</td>
                              <td align="center">
                                <?php echo $point_1["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_1["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_1["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_1']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_1'] > $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_1'] - $point_1[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_1'] < $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_1[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_1'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_1'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Perban (lebar 5 cm)</td>
                              <td align="center">
                                <?php echo $point_2["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_2["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_2["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_2']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_2'] > $point_2[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_2'] - $point_2[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_2'] < $point_2[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_2[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_2'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_2'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Perban (lebar 10 cm)</td>
                              <td align="center">
                                <?php echo $point_3["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_3["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_3["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_3']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_3'] > $point_3[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_3'] - $point_3[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_3'] < $point_3[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_3[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_3'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_3'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>Plester (lebar 1,25 cm)</td>
                              <td align="center">
                                <?php echo $point_4["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_4["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_4["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_4']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_4'] > $point_4[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_4'] - $point_4[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_4'] < $point_4[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_4[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_4'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_4'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>5</td>
                              <td>Plester Cepat</td>
                              <td align="center">
                                <?php echo $point_5["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_5["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_5["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_5']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_5'] > $point_5[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_5'] - $point_5[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_5'] < $point_5[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_5[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_5'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_5'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>6</td>
                              <td>Kapas (25 gram)</td>
                              <td align="center">
                                <?php echo $point_6["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_6["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_6["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_6']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_6'] > $point_6[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_6'] - $point_6[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_6'] < $point_6[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_6[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_6'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_6'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>7</td>
                              <td>Kain segitiga / Mitela</td>
                              <td align="center">
                                <?php echo $point_7["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_7["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_7["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_7']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_7'] > $point_7[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_7'] - $point_7[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_7'] < $point_7[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_7[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_7'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_7'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>8</td>
                              <td>Gunting</td>
                              <td align="center">
                                <?php echo $point_8["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_8["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_8["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_8']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_8'] > $point_8[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_8'] - $point_8[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_8'] < $point_8[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_8[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_8'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_8'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>9</td>
                              <td>Peniti</td>
                              <td align="center">
                                <?php echo $point_9["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_9["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_9["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_9']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_9'] > $point_9[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_9'] - $point_9[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_9'] < $point_9[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_9[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_9'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_9'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>10</td>
                              <td>Sarung tangan sekali pakai</td>
                              <td align="center">
                                <?php echo $point_10["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_10["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_10["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_10']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_10'] > $point_10[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_10'] - $point_10[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_10'] < $point_10[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_10[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_10'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_10'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>11</td>
                              <td>Masker</td>
                             <td align="center">
                                <?php echo $point_11["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_11["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_11["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_11']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_11'] > $point_11[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_11'] - $point_11[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_11'] < $point_11[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_11[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_11'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_11'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>12</td>
                              <td>Pinest</td>
                              <td align="center">
                                <?php echo $point_12["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_12["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_12["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_12']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_12'] > $point_12[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_12'] - $point_12[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_12'] < $point_12[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_12[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_12'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_12'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>13</td>
                              <td>Lampu senter</td>
                              <td align="center">
                                <?php echo $point_13["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_13["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_13["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_13']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_13'] > $point_13[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_13'] - $point_13[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_13'] < $point_13[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_13[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_13'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_13'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>14</td>
                              <td>Gelas untuk cuci mata</td>
                              <td align="center">
                                <?php echo $point_14["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_14["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_14["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_14']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_14'] > $point_14[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_14'] - $point_14[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_14'] < $point_14[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_14[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_14'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_14'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>15</td>
                              <td>Kantong plastik bersih</td>
                              <td align="center">
                                <?php echo $point_15["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_15["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_15["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_15']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_15'] > $point_15[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_15'] - $point_15[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_15'] < $point_15[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_15[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_15'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_15'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>16</td>
                              <td>Aquades (100 ml)</td>
                              <td align="center">
                                <?php echo $point_16["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_16["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_16["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_16']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_16'] > $point_16[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_16'] - $point_16[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_16'] < $point_16[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_16[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_16'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_16'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>17</td>
                              <td>Pavidon lodin (60 ml)</td>
                              <td align="center">
                                <?php echo $point_17["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_17["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_17["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_17']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_17'] > $point_17[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_17'] - $point_17[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_17'] < $point_17[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_17[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_17'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_17'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>18</td>
                              <td>Alkohol 70%</td>
                              <td align="center">
                                <?php echo $point_18["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_18["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_18["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_18']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_18'] > $point_18[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_18'] - $point_18[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_18'] < $point_18[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_18[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_18'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_18'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>19</td>
                              <td>Buku panduan P3K</td>
                              <td align="center">
                                <?php echo $point_19["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_19["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_19["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_19']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_19'] > $point_19[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_19'] - $point_19[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_19'] < $point_19[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_19[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_19'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_19'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <td>20</td>
                              <td>Buku catatan daftar isi kotak</td>
                              <td align="center">
                                <?php echo $point_20["A"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_20["B"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $point_20["C"]; ?>
                              </td>
                              <td align="center">
                                <?php echo $get_detailinspeksi_p3k['point_20']; ?>
                              </td>
                              <td align="center">
                                <?php
                                  if($get_detailinspeksi_p3k['point_20'] > $point_20[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_20'] - $point_20[$get_detailinspeksi_p3k['tipe_kotak']])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_20'] < $point_20[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: red'>Kurang ".($point_20[$get_detailinspeksi_p3k['tipe_kotak']] - $get_detailinspeksi_p3k['point_20'])."</div>";
                                  }elseif($get_detailinspeksi_p3k['point_20'] = $point_1[$get_detailinspeksi_p3k['tipe_kotak']]){
                                    echo "<div style='color: green'>OKE</div>";
                                  }else{
                                    echo "<div style='color: green'>ERROR</div>";
                                  }
                                ?>
                              </td>
                            </tr>
                          </tbody>
                        </table>

                        <!-- TABEL DOKUMENTASI -->
                        <table class="table table-bordered table-sm" style="font-size: 12px">
                          <tr>
                            <td colspan="4" style="text-align: center;">Dokumentasi</td>
                          </tr>
                          <tr>
                            <?php
                              $q_get_fotop3k = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotop3k WHERE detail_id = '$id_detail'");
                              while($get_fotop3k = mysqli_fetch_array($q_get_fotop3k)){
                            ?>
                              <td width="25%" align="center">
                                <img src="../../role/HSE/foto_inspeksi_p3k/<?php echo $get_fotop3k['foto']; ?>" style="height: 100px;">
                                <div style="text-align: center;"><?php echo $get_fotop3k['keterangan']; ?></div>
                              </td>
                            <?php } ?>
                          </tr>
                        </table>

                        <!-- TABEL PEMERIKSAAN -->
                        <table class="table table-bordered table-sm" style="font-size: 11px">
                          <tr>
                            <td width="60%">
                              Keterangan / Catatan :<br>
                              <?php echo $get_detailinspeksi_p3k['catatan']; ?>
                            </td>
                            <td rowspan="2" style="vertical-align: middle;"><center><img src="../../dist/img/pict P3K.jpg" width="60%"></center></td>
                          </tr>
                          <tr>
                            <td>
                                Catatan :<br>
                                1. Pengecekan P3K dilakukan setiap minggu dan ketika digunakan.<br>
                                2. Pastikan kotak P3K disimpan pada area yang mudah dijangkau, tidak terkunci, dan aman.<br>
                                3. Pastikan isi P3K lengkap sesuai dengan spesifikasi kotak yang tersedia.<br>
                                4. Pastikan kotak P3K tersedia sesuai dengan jumah pekerja.
                            </td>
                          </tr>
                        </table>

                        <!-- TABEL TANDA TANGAN -->
                        <center>
                          <table class="table table-bordered table-sm" style="width: 60%; font-size: 12px;">
                            <tr>
                              <td align="center">Diperiksa Oleh</td>
                              <td align="center">Disetujui Oleh</td>
                            </tr>
                            <tr>
                              <td style="text-align: center;" width="50%">
                                <img src="../../role/HSE/signatures/<?php echo $get_inspeksilist['ttd_hse']; ?>" width="70%">
                              </td>
                              <td style="text-align: center;" width="50%">
                                <img src="../../role/HSE/signatures/<?php echo $get_inspeksilist['ttd_sm']; ?>" width="70%">
                              </td>
                            </tr>
                            <tr>
                              <td align="center"><?php echo $get_hse_manpower['nama']; ?></td>
                              <td align="center"><?php echo $get_inspeksilist['site_manager']; ?></td>
                            </tr>
                            <tr>
                              <td align="center">HSE Officer</td>
                              <td align="center">Site Manager</td>
                            </tr>
                          </table>
                        </center>

                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->

                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->


        <?php } ?>

        <!-- -------------------------------------------- ROW ------------------------------------- -->

        <center class="no-print">
            <button class="btn btn-secondary no-print" onclick="window.print()"><span class="fa fa-print"></span> Cetak / Simpan</button>
        </center>
        <br>

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_deskrippekerjaan" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Deskripsi Pekerjaan</h4>
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

  <script>
    document.title = "<?php echo "Report Inspeksi P3K W".$week." - ".$get_project['nama_project']; ?>";
  </script>