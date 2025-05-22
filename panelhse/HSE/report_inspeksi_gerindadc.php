  <?php
    $get_inspeksilist = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE id = '$_GET[kd]'"));
    $get_hse_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inspeksilist[hse_officer]'"));
    $data_array = explode("/", $get_inspeksilist['kd_weekly']);
    $week = $data_array[1];
    $kd_project = $data_array[2];

    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$kd_project'"));

    $get_num_inspeksi_gerinda = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$_GET[kd]'"));

    // GET DATA APAR FROM DB
    $i = 0;
    $q_get_inspeksilist_detailgerinda = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$_GET[kd]'");
    while($get_inspeksilist_detailgerinda = mysqli_fetch_array($q_get_inspeksilist_detailgerinda)){
      $merek_tipe[$i] = $get_inspeksilist_detailgerinda["merek_tipe"];
      $point_1[$i] = $get_inspeksilist_detailgerinda["point_1"];
      $point_2[$i] = $get_inspeksilist_detailgerinda["point_2"];
      $point_3[$i] = $get_inspeksilist_detailgerinda["point_3"];
      $point_4[$i] = $get_inspeksilist_detailgerinda["point_4"];
      $point_5[$i] = $get_inspeksilist_detailgerinda["point_5"];
      $point_6[$i] = $get_inspeksilist_detailgerinda["point_6"];
      $point_7[$i] = $get_inspeksilist_detailgerinda["point_7"];
      $point_8[$i] = $get_inspeksilist_detailgerinda["point_8"];
      $point_9[$i] = $get_inspeksilist_detailgerinda["point_9"];
      $point_10[$i] = $get_inspeksilist_detailgerinda["point_10"];
      $point_11[$i] = $get_inspeksilist_detailgerinda["point_11"];
      $point_12[$i] = $get_inspeksilist_detailgerinda["point_12"];

      $i++;
    }

    // GET DOKUMENTASI GERINDA
    $x=0;
    $q_get_dokumentasi_inspeksi_gerinda = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotogerinda WHERE inspeksi_id = '$_GET[kd]'");
    while($get_dokumentasi_inspeksi_gerinda = mysqli_fetch_array($q_get_dokumentasi_inspeksi_gerinda)){
      $foto_gerinda[$x] = $get_dokumentasi_inspeksi_gerinda["foto"];
      $keterangan_gerinda[$x] = $get_dokumentasi_inspeksi_gerinda["keterangan"];

      $x++;
    }
  ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card" style="margin-right: -10px;">

              <?php if($get_num_inspeksi_gerinda <= 3){ ?>
              <!--------------------------------- JUMLAH GERINDA <= 3 ---------------------------------------->
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
                        <td width="70%" style="font-size: 12px; font-weight: bold;"><center>CHECKLIST INSPEKSI GERINDA DC</center></td>
                        <td width="10%" style="font-size: 12px">No. Dok</td>
                        <td style="font-size: 12px">GPP/HSE07/25/25</td>
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
                        <td width="15%">&nbsp; Nama Inspektor</td>
                        <td width="40%"><?php echo $get_hse_manpower['nama']; ?></td>
                        <td width="15%">&nbsp; Tanggal Inspeksi</td>
                        <td width="30%"><?php echo $get_inspeksilist['tanggal_inspeksi']; ?></td>
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
                          <th style="vertical-align: middle;" width="1%" rowspan="4">No</th>
                          <th style="vertical-align: middle;" width="40%" rowspan="4">Item Pemeriksaan</th>
                          <th style="vertical-align: middle;" colspan="4">Merek</th>
                          <th style="vertical-align: middle;" colspan="4">Merek</th>
                          <th style="vertical-align: middle;" colspan="4">Merek</th>
                        </tr>
                        <tr>
                          <th colspan="4"><?php echo $merek_tipe[0]; ?></th>
                          <th colspan="4"><?php echo $merek_tipe[1]; ?></th>
                          <th colspan="4"><?php echo $merek_tipe[2]; ?></th>
                        </tr>
                        <tr>
                          <th colspan="4">Kondisi</th>
                          <th colspan="4">Kondisi</th>
                          <th colspan="4">Kondisi</th>
                        </tr>
                        <tr>
                          <th width="5%">Baik</th>
                          <th width="5%">Rusak</th>
                          <th width="5%">Hilang</th>
                          <th width="5%">NA</th>

                          <th width="5%">Baik</th>
                          <th width="5%">Rusak</th>
                          <th width="5%">Hilang</th>
                          <th width="5%">NA</th>

                          <th width="5%">Baik</th>
                          <th width="5%">Rusak</th>
                          <th width="5%">Hilang</th>
                          <th width="5%">NA</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Body / kondisi fisik mesin gerinda dalam kondisi baik</td>
                          <td align="center">
                            <?php if($point_1[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Kondisi kabel-kabel tidak terkelupas dan dalam kondisi baik</td>
                          <td align="center">
                            <?php if($point_2[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Steker pada kabel gerinda dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_3[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Kondisi power (On / Off) berfungsi dalam kondisi baik</td>
                          <td align="center">
                            <?php if($point_4[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Side handle tersedia dan dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_5[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Terdapat cover / proteksi batu berinda teresdia dan terpasang</td>
                          <td align="center">
                            <?php if($point_6[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>7</td>
                          <td>Carbon brush dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_7[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>8</td>
                          <td>Ventilasi udara gerinda bersih</td>
                          <td align="center">
                            <?php if($point_8[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>9</td>
                          <td>Kondisi mesin atau motor dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_9[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>10</td>
                          <td>Flange / penjepit batu gerinda terpasang dengan kuat</td>
                          <td align="center">
                            <?php if($point_10[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>11</td>
                          <td>Pastikan cakram / batu gerinda terpasang kuat dan dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_11[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>12</td>
                          <td>Terdapat kunci untuk membuka dan mengencangkan flange cakram</td>
                          <td align="center">
                            <?php if($point_12[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_12[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_12[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
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
                        <td width="25%" align="center">
                          <img src="../../role/HSE/foto_inspeksi_gerinda/<?php echo $foto_gerinda[0]; ?>" style="height: 150px;">
                          <div style="text-align: center;"><?php echo $keterangan_gerinda[0]; ?></div>
                        </td>
                        <td width="25%" align="center">
                          <img src="../../role/HSE/foto_inspeksi_gerinda/<?php echo $foto_gerinda[1]; ?>" style="height: 150px;">
                          <div style="text-align: center;"><?php echo $keterangan_gerinda[1]; ?></div>
                        </td>
                        <td width="25%" align="center">
                          <img src="../../role/HSE/foto_inspeksi_gerinda/<?php echo $foto_gerinda[2]; ?>" style="height: 150px;">
                          <div style="text-align: center;"><?php echo $keterangan_gerinda[2]; ?></div>
                        </td>
                        <td width="25%" align="center">
                          <img src="../../role/HSE/foto_inspeksi_gerinda/<?php echo $foto_gerinda[3]; ?>" style="height: 150px;">
                          <div style="text-align: center;"><?php echo $keterangan_gerinda[3]; ?></div>
                        </td>
                      </tr>
                      <?php
                        if($foto_gerinda[4] <> "" || $foto_gerinda[5] <> "" || $foto_gerinda[6] <> "" || $foto_gerinda[7] <> ""){ 
                      ?>
                        <tr>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[4] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_gerinda/<?php echo $foto_gerinda[4]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[4]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[5] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_gerinda/<?php echo $foto_gerinda[5]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[5]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[6] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_gerinda/<?php echo $foto_gerinda[6]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[6]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[7] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_gerinda/<?php echo $foto_gerinda[7]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[7]; ?></div>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php
                        if($foto_gerinda[8] <> "" || $foto_gerinda[9] <> "" || $foto_gerinda[10] <> "" || $foto_gerinda[11] <> ""){
                      ?>
                        <tr>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[8] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[8]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[8]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[9] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[9]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[9]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[10] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[10]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[10]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[11] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[11]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[11]; ?></div>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php
                        if($foto_gerinda[12] <> "" || $foto_gerinda[13] <> "" || $foto_gerinda[14] <> "" || $foto_gerinda[15] <> ""){
                      ?>
                        <tr>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[12] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[12]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[12]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[13] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[13]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[13]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[14] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[14]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[14]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[15] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[15]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[15]; ?></div>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </table>

                    <!-- TABEL HASIL PEMERIKSAAN -->
                    <table class="table table-bordered table-sm" style="font-size: 12px">
                      <tr>
                        <td rowspan="3" style="vertical-align: middle;">Hasil Pemeriksaan</td>
                        <td align="center" colspan="3">Kondisi</td>
                        <td align="center" rowspan="2" style="vertical-align: middle;">Jumlah Asset Diterima</td>
                        <td align="center" rowspan="2" style="vertical-align: middle;">Jumlah Asset Minggu Ini</td>
                      </tr>
                      <tr>
                        <td align="center">Baik</td>
                        <td align="center">Rusak</td>
                        <td align="center">Hilang</td>
                      </tr>
                      <?php
                        $get_num_gerinda_bagus = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Baik'"));
                        $get_num_gerinda_sedang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Rusak'"));
                        $get_num_gerinda_buruk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Hilang'"));

                        $get_jml_gerinda_onsite = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jumlah) AS jml_gerinda_onsite FROM hse_toolsapdonsite_detailtools JOIN hse_tools ON hse_toolsapdonsite_detailtools.tools_id = hse_tools.id JOIN hse_toolsapdonsite  ON hse_toolsapdonsite_detailtools.id_onsite = hse_toolsapdonsite.id WHERE hse_tools.tools = 'Gerinda DC' AND hse_toolsapdonsite.project_id = '$kd_project'"));

                        $t_apar_hilangrusak_minggu_lalu = 0;
                        for($i=1;$i<$week;$i++){
                          $kd_weekly_cek = "week/".$i."/".$kd_project;
                          $get_inspeksilist2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$kd_weekly_cek' AND jenis_inspeksi = 'inspeksi_gerindadc'"));

                          $t_apar_hilangrusak_minggu_lalu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$get_inspeksilist2[id]' AND (hasil_akhir = 'Rusak' OR hasil_akhir = 'Hilang')")) + $t_apar_hilangrusak_minggu_lalu;
                        }
                      ?>
                      <tr>
                        <td align="center"><?php echo $get_num_gerinda_bagus; ?></td>
                        <td align="center"><?php echo $get_num_gerinda_sedang; ?></td>
                        <td align="center"><?php echo $get_num_gerinda_buruk; ?></td>
                        <td align="center"><?php echo $get_jml_gerinda_onsite['jml_gerinda_onsite']; ?></td>
                        <td align="center"><?php echo $get_jml_gerinda_onsite['jml_gerinda_onsite'] - $t_apar_hilangrusak_minggu_lalu; ?></td>
                      </tr>
                    </table>

                    <!-- TABEL PEMERIKSAAN -->
                    <table class="table table-bordered table-sm" style="font-size: 11px">
                      <tr>
                        <td width="60%">
                          *Pemeriksaan : Apakah bagian / peralatan APAR yang akan dipakai tersedia, cukup, dalam keadaan baik dan berfungsi dengan benar.<br><span class="fa fa-check"></span> = Baik / Ada  |  <span class="fa fa-close"></span> = Rusak | <span class="fa fa-close"></span> = Hilang |  <span class="fa fa-minus"></span> = Tidak Tersedia
                        </td>
                        <td rowspan="3" style="vertical-align: middle;"><center><img src="../../dist/img/pict gerindadc.jpg" width="40%"></center></td>
                      </tr>
                      
                      <tr>
                        <td>
                            Catatan :<br>
                            1. Pengecekan Alat dilakukan setiap hari sebelum beroperasi<br>
                            2. Pastikan gerinda sudah aman apabila akan digunakan.<br>
                            3. Apabila ada kelainan pada unit, segera laporkan ke pengawas untuk diperbaiki<br>
                            4. Simpan mesin las pada area kering dan terhindar dari air / hujan
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
                            <img src="../../role/HSE/signatures/<?php echo $get_inspeksilist['ttd_hse']; ?>" width="25%">
                          </td>
                          <td style="text-align: center;" width="50%">
                            <img src="../../role/HSE/signatures/<?php echo $get_inspeksilist['ttd_sm']; ?>" width="25%">
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

              <?php }elseif($get_num_inspeksi_gerinda <= 6){ ?>


              <!--------------------------------- JUMLAH GERINDA <= 6 ---------------------------------------->
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
                        <td width="70%" style="font-size: 12px; font-weight: bold;"><center>CHECKLIST INSPEKSI GERINDA DC</center></td>
                        <td width="10%" style="font-size: 12px">No. Dok</td>
                        <td style="font-size: 12px">GPP/HSE07/25/25</td>
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
                        <td width="15%">&nbsp; Nama Inspektor</td>
                        <td width="40%"><?php echo $get_hse_manpower['nama']; ?></td>
                        <td width="15%">&nbsp; Tanggal Inspeksi</td>
                        <td width="30%"><?php echo $get_inspeksilist['tanggal_inspeksi']; ?></td>
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
                          <th style="vertical-align: middle;" width="1%" rowspan="4">No</th>
                          <th style="vertical-align: middle;" width="40%" rowspan="4">Item Pemeriksaan</th>
                          <th style="vertical-align: middle;" colspan="4">Merek</th>
                          <th style="vertical-align: middle;" colspan="4">Merek</th>
                          <th style="vertical-align: middle;" colspan="4">Merek</th>
                        </tr>
                        <tr>
                          <th colspan="4"><?php echo $merek_tipe[0]; ?></th>
                          <th colspan="4"><?php echo $merek_tipe[1]; ?></th>
                          <th colspan="4"><?php echo $merek_tipe[2]; ?></th>
                        </tr>
                        <tr>
                          <th colspan="4">Kondisi</th>
                          <th colspan="4">Kondisi</th>
                          <th colspan="4">Kondisi</th>
                        </tr>
                        <tr>
                          <th width="5%">Baik</th>
                          <th width="5%">Rusak</th>
                          <th width="5%">Hilang</th>
                          <th width="5%">NA</th>

                          <th width="5%">Baik</th>
                          <th width="5%">Rusak</th>
                          <th width="5%">Hilang</th>
                          <th width="5%">NA</th>

                          <th width="5%">Baik</th>
                          <th width="5%">Rusak</th>
                          <th width="5%">Hilang</th>
                          <th width="5%">NA</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Body / kondisi fisik mesin gerinda dalam kondisi baik</td>
                          <td align="center">
                            <?php if($point_1[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Kondisi kabel-kabel tidak terkelupas dan dalam kondisi baik</td>
                          <td align="center">
                            <?php if($point_2[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Steker pada kabel gerinda dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_3[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Kondisi power (On / Off) berfungsi dalam kondisi baik</td>
                          <td align="center">
                            <?php if($point_4[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Side handle tersedia dan dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_5[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Terdapat cover / proteksi batu berinda teresdia dan terpasang</td>
                          <td align="center">
                            <?php if($point_6[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>7</td>
                          <td>Carbon brush dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_7[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>8</td>
                          <td>Ventilasi udara gerinda bersih</td>
                          <td align="center">
                            <?php if($point_8[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>9</td>
                          <td>Kondisi mesin atau motor dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_9[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>10</td>
                          <td>Flange / penjepit batu gerinda terpasang dengan kuat</td>
                          <td align="center">
                            <?php if($point_10[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>11</td>
                          <td>Pastikan cakram / batu gerinda terpasang kuat dan dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_11[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>12</td>
                          <td>Terdapat kunci untuk membuka dan mengencangkan flange cakram</td>
                          <td align="center">
                            <?php if($point_12[0] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[0] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[0] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_12[1] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[1] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[1] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_12[2] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[2] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[2] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                    <table class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                      <thead style="text-align: center;">
                        <tr>
                          <th style="vertical-align: middle;" width="1%" rowspan="4">No</th>
                          <th style="vertical-align: middle;" width="40%" rowspan="4">Item Pemeriksaan</th>
                          <th style="vertical-align: middle;" colspan="4">Merek</th>
                          <th style="vertical-align: middle;" colspan="4">Merek</th>
                          <th style="vertical-align: middle;" colspan="4">Merek</th>
                        </tr>
                        <tr>
                          <th colspan="4"><?php echo $merek_tipe[3]; ?></th>
                          <th colspan="4"><?php echo $merek_tipe[4]; ?></th>
                          <th colspan="4"><?php echo $merek_tipe[5]; ?></th>
                        </tr>
                        <tr>
                          <th colspan="4">Kondisi</th>
                          <th colspan="4">Kondisi</th>
                          <th colspan="4">Kondisi</th>
                        </tr>
                        <tr>
                          <th width="5%">Baik</th>
                          <th width="5%">Rusak</th>
                          <th width="5%">Hilang</th>
                          <th width="5%">NA</th>

                          <th width="5%">Baik</th>
                          <th width="5%">Rusak</th>
                          <th width="5%">Hilang</th>
                          <th width="5%">NA</th>

                          <th width="5%">Baik</th>
                          <th width="5%">Rusak</th>
                          <th width="5%">Hilang</th>
                          <th width="5%">NA</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>Body / kondisi fisik mesin gerinda dalam kondisi baik</td>
                          <td align="center">
                            <?php if($point_1[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Kondisi kabel-kabel tidak terkelupas dan dalam kondisi baik</td>
                          <td align="center">
                            <?php if($point_2[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Steker pada kabel gerinda dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_3[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Kondisi power (On / Off) berfungsi dalam kondisi baik</td>
                          <td align="center">
                            <?php if($point_4[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Side handle tersedia dan dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_5[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Terdapat cover / proteksi batu berinda teresdia dan terpasang</td>
                          <td align="center">
                            <?php if($point_6[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>7</td>
                          <td>Carbon brush dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_7[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>8</td>
                          <td>Ventilasi udara gerinda bersih</td>
                          <td align="center">
                            <?php if($point_8[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>9</td>
                          <td>Kondisi mesin atau motor dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_9[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>10</td>
                          <td>Flange / penjepit batu gerinda terpasang dengan kuat</td>
                          <td align="center">
                            <?php if($point_10[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>11</td>
                          <td>Pastikan cakram / batu gerinda terpasang kuat dan dalam kondisi bagus</td>
                          <td align="center">
                            <?php if($point_11[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>12</td>
                          <td>Terdapat kunci untuk membuka dan mengencangkan flange cakram</td>
                          <td align="center">
                            <?php if($point_12[3] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[3] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[3] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_12[4] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[4] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[4] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_12[5] == "Bagus"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[5] == "Sedang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[5] == "Buruk"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_12[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                    <div style="page-break-before: always;"></div>

                    <!-- TABEL DOKUMENTASI -->
                    <table class="table table-bordered table-sm" style="font-size: 12px">
                      <tr>
                        <td colspan="4" style="text-align: center;">Dokumentasi</td>
                      </tr>
                      <tr>
                        <td width="25%" align="center">
                          <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[0]; ?>" style="height: 150px;">
                          <div style="text-align: center;"><?php echo $keterangan_gerinda[0]; ?></div>
                        </td>
                        <td width="25%" align="center">
                          <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[1]; ?>" style="height: 150px;">
                          <div style="text-align: center;"><?php echo $keterangan_gerinda[1]; ?></div>
                        </td>
                        <td width="25%" align="center">
                          <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[2]; ?>" style="height: 150px;">
                          <div style="text-align: center;"><?php echo $keterangan_gerinda[2]; ?></div>
                        </td>
                        <td width="25%" align="center">
                          <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[3]; ?>" style="height: 150px;">
                          <div style="text-align: center;"><?php echo $keterangan_gerinda[3]; ?></div>
                        </td>
                      </tr>
                      <?php
                        if($foto_gerinda[4] <> "" || $foto_gerinda[5] <> "" || $foto_gerinda[6] <> "" || $foto_gerinda[7] <> ""){ 
                      ?>
                        <tr>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[4] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[4]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[4]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[5] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[5]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[5]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[6] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[6]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[6]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[7] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[7]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[7]; ?></div>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php
                        if($foto_gerinda[8] <> "" || $foto_gerinda[9] <> "" || $foto_gerinda[10] <> "" || $foto_gerinda[11] <> ""){
                      ?>
                        <tr>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[8] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[8]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[8]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[9] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[9]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[9]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[10] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[10]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[10]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[11] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[11]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[11]; ?></div>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
                      <?php
                        if($foto_gerinda[12] <> "" || $foto_gerinda[13] <> "" || $foto_gerinda[14] <> "" || $foto_gerinda[15] <> ""){
                      ?>
                        <tr>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[12] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[12]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[12]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[13] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[13]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[13]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[14] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[14]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[14]; ?></div>
                            <?php } ?>
                          </td>
                          <td width="25%" align="center">
                            <?php if($foto_gerinda[15] <> ""){ ?>
                              <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $foto_gerinda[15]; ?>" style="height: 150px;">
                              <div style="text-align: center;"><?php echo $keterangan_gerinda[15]; ?></div>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </table>

                    <!-- TABEL HASIL PEMERIKSAAN -->
                    <table class="table table-bordered table-sm" style="font-size: 12px">
                      <tr>
                        <td rowspan="3" style="vertical-align: middle;">Hasil Pemeriksaan</td>
                        <td align="center" colspan="3">Kondisi</td>
                        <td align="center" rowspan="2" style="vertical-align: middle;">Jumlah Asset Diterima</td>
                        <td align="center" rowspan="2" style="vertical-align: middle;">Jumlah Asset Minggu Ini</td>
                      </tr>
                      <tr>
                        <td align="center">Baik</td>
                        <td align="center">Rusak</td>
                        <td align="center">Hilang</td>
                      </tr>
                      <?php
                        $get_num_gerinda_bagus = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Baik'"));
                        $get_num_gerinda_sedang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Rusak'"));
                        $get_num_gerinda_buruk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Hilang'"));

                        $get_jml_gerinda_onsite = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jumlah) AS jml_apar_onsite FROM hse_toolsapdonsite_detailtoolsk3 JOIN hse_toolsk3 ON hse_toolsapdonsite_detailtoolsk3.toolsk3_id = hse_toolsk3.id JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailtoolsk3.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsk3.nama_tools = 'APAR' AND hse_toolsapdonsite.project_id = '$kd_project'"));

                        $t_apar_hilangrusak_minggu_lalu = 0;
                        for($i=1;$i<$week;$i++){
                          $kd_weekly_cek = "week/".$i."/".$kd_project;
                          $get_inspeksilist2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$kd_weekly_cek'"));

                          $t_apar_hilangrusak_minggu_lalu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE inspeksi_id = '$get_inspeksilist2[id]' AND (hasil_akhir = 'Rusak' OR hasil_akhir = 'Hilang')")) + $t_apar_hilangrusak_minggu_lalu;
                        }
                      ?>
                      <tr>
                        <td align="center"><?php echo $get_num_gerinda_bagus; ?></td>
                        <td align="center"><?php echo $get_num_gerinda_sedang; ?></td>
                        <td align="center"><?php echo $get_num_gerinda_buruk; ?></td>
                        <td align="center"><?php echo $get_jml_gerinda_onsite['jml_apar_onsite']; ?></td>
                        <td align="center"><?php echo $get_jml_gerinda_onsite['jml_apar_onsite'] - $t_apar_hilangrusak_minggu_lalu; ?></td>
                      </tr>
                    </table>

                    <!-- TABEL PEMERIKSAAN -->
                    <table class="table table-bordered table-sm" style="font-size: 11px">
                      <tr>
                        <td width="60%">

                          <p>
                            *Pemeriksaan : Apakah bagian / peralatan APAR yang akan dipakai tersedia, cukup, dalam keadaan baik dan berfungsi dengan benar.<br><span class="fa fa-check"></span> = Baik / Ada  |  <span class="fa fa-close"></span> = Rusak | <span class="fa fa-close"></span> = Hilang |  <span class="fa fa-minus"></span> = Tidak Tersedia
                          </p>
                        </td>
                        <td rowspan="3" style="vertical-align: middle;"><center><img src="../../dist/img/pict APAR.jpg" width="100%"></center></td>
                      </tr>
                      <tr>
                        <td>
                            Catatan :<br>
                            1. Pengecekan APAR dilakukan setiap hari sebelum pekerjaan dimulai.<br>
                            2. Pastikan APAR dapat digunakan dengan aman.<br>
                            3. Apabila ada kelainan pada unit, segera laporkan ke pengawas untuk diperbaiki.<br>
                            4. Simpan APAR pada area yang mudah dijangkau
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
                            <img src="../../role/HSE/signatures/<?php echo $get_inspeksilist['ttd_hse']; ?>" width="25%">
                          </td>
                          <td style="text-align: center;" width="50%">
                            <img src="../../role/HSE/signatures/<?php echo $get_inspeksilist['ttd_sm']; ?>" width="25%">
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


              <?php } ?>

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- -------------------------------------------- ROW ------------------------------------- -->

        <center class="no-print">
            <button class="btn btn-secondary no-print" onclick="window.print()"><span class="fa fa-print"></span> Cetak / Simpan</button>
          </a>
        </center>

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
    document.title = "<?php echo "Report Inspeksi Gerinda DC W".$week." - ".$get_project['nama_project']; ?>";
  </script>