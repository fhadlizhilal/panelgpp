  <?php
    $get_num_inspeksi_apar = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapar WHERE inspeksi_id = '$_GET[kd]'"));

    // GET DATA APAR FROM DB
    $i = 0;
    $q_get_inspeksilist_detailapar = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapar WHERE inspeksi_id = '$_GET[kd]'");
    while($get_inspeksilist_detailapar = mysqli_fetch_array($q_get_inspeksilist_detailapar)){
      $merek_tipe[$i] = $get_inspeksilist_detailapar["merek_tipe"];
      $point_1[$i] = $get_inspeksilist_detailapar["point_1"];
      $point_2[$i] = $get_inspeksilist_detailapar["point_2"];
      $point_3[$i] = $get_inspeksilist_detailapar["point_3"];
      $point_4[$i] = $get_inspeksilist_detailapar["point_4"];
      $point_5[$i] = $get_inspeksilist_detailapar["point_5"];
      $point_6[$i] = $get_inspeksilist_detailapar["point_6"];
      $point_7[$i] = $get_inspeksilist_detailapar["point_7"];
      $point_8[$i] = $get_inspeksilist_detailapar["point_8"];
      $point_9[$i] = $get_inspeksilist_detailapar["point_9"];
      $point_10[$i] = $get_inspeksilist_detailapar["point_10"];
      $point_11[$i] = $get_inspeksilist_detailapar["point_11"];

      $i++;
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

              <?php if($get_num_inspeksi_apar <= 3){ ?>
              <!--------------------------------- JUMLAH APAR <= 3 ---------------------------------------->
              <div class="card-body">
                <div class="row" style="margin-bottom: 5px;">
                  <div class="col-6"><img src="../../dist/img/alamat_gpp_v2.jpg" width="210px"></div>
                  <div class="col-6"><div style="text-align: right;"><img src="../../dist/img/logo/logo-k3.png" width="90px"></div></div>
                </div>

                <div class="row" style="margin-bottom: 10px">
                  <div class="col-12">
                    <table class="table table-bordered table-sm">
                      <tr>
                        <td width="10%" rowspan="3" style="vertical-align: middle;">
                          <center>
                            <img src="../../dist/img/logo/gpp-logo.png" width="50%">
                          </center>
                        </td>
                        <td width="70%" style="font-size: 12px; font-weight: bold;"><center>CHECKLIST INSPEKSI APAR</center></td>
                        <td width="10%" style="font-size: 12px">No. Dok</td>
                        <td style="font-size: 12px">GPP/HSE07/15/22</td>
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
                        <td width="40%"></td>
                        <td width="15%">&nbsp; Tanggal Inspeksi</td>
                        <td width="30%"></td>
                      </tr>
                      <tr>
                        <td width="15%">&nbsp; Jabatan</td>
                        <td width="40%"></td>
                        <td width="15%">&nbsp; Lokasi Kerja</td>
                        <td width="30%"></td>
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
                          <th colspan="4">....</th>
                          <th colspan="4">....</th>
                          <th colspan="4">....</th>
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
                          <td>Nomor tabung sesuai</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Penempatan APAR benar</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Penempatan APAR pada area kerja dan mudah dicapai</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>APAR dalam kondisi bersih</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Terdapat data kelas kebakaran pada APAR</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Terdapat data media pemadam</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>7</td>
                          <td>Terdapat instruk atau petunjuk penggunaan</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>8</td>
                          <td>Terpasang tagging / label pemeriksaan</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>9</td>
                          <td>Isi APAR cukup (tidak < 10% dari berat normal)</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>10</td>
                          <td>Seal dan pin pengaman terpasang dengan baik</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                        <tr>
                          <td>11</td>
                          <td>Jarum indikator tekanan menunjukan kondisi normal</td>
                          <td align="center"><span class="fa fa-check"></span></td>
                          <td align="center"><span class="fa fa-close"></span></td>
                          <td align="center"><span class="fa fa-close"></td>
                          <td align="center"><span class="fa fa-minus"></td>

                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                          <td align="center"></td>
                        </tr>
                      </tbody>
                    </table>

                    <!-- TABEL DOKUMENTASI -->
                    <table class="table table-bordered table-sm" style="font-size: 12px">
                      <tr>
                        <td colspan="4" style="text-align: center;">Dokumentasi</td>
                      </tr>
                      <tr>
                        <td width="25%">....</td>
                        <td width="25%">....</td>
                        <td width="25%">....</td>
                        <td width="25%">....</td>
                      </tr>
                      <tr>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                      </tr>
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
                      <tr>
                        <td align="center">1</td>
                        <td align="center">2</td>
                        <td align="center">3</td>
                        <td align="center">4</td>
                        <td align="center">5</td>
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
                          Keterangan / Catatan :<br>
                          ................
                        </td>
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
                          <td style="text-align: center; height: 100px;">TTD</td>
                          <td style="text-align: center; height: 100px;">TTD</td>
                        </tr>
                        <tr>
                          <td align="center">Nama</td>
                          <td align="center">Nama</td>
                        </tr>
                        <tr>
                          <td align="center">Jabatan</td>
                          <td align="center">Jabatan</td>
                        </tr>
                      </table>
                    </center>

                  </div>
                </div>

              </div>
              <!-- /.card-body -->
              

              <?php }elseif($get_num_inspeksi_apar <= 6){ ?>


              <!--------------------------------- JUMLAH APAR <= 6 ---------------------------------------->
              <div class="card-body">
                <div class="row" style="margin-bottom: 5px;">
                  <div class="col-6"><img src="../../dist/img/alamat_gpp_v2.jpg" width="210px"></div>
                  <div class="col-6"><div style="text-align: right;"><img src="../../dist/img/logo/logo-k3.png" width="90px"></div></div>
                </div>

                <div class="row" style="margin-bottom: 10px">
                  <div class="col-12">
                    <table class="table table-bordered table-sm">
                      <tr>
                        <td width="10%" rowspan="3" style="vertical-align: middle;">
                          <center>
                            <img src="../../dist/img/logo/gpp-logo.png" width="50%">
                          </center>
                        </td>
                        <td width="70%" style="font-size: 12px; font-weight: bold;"><center>CHECKLIST INSPEKSI APAR</center></td>
                        <td width="10%" style="font-size: 12px">No. Dok</td>
                        <td style="font-size: 12px">GPP/HSE07/15/22</td>
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
                        <td width="40%"></td>
                        <td width="15%">&nbsp; Tanggal Inspeksi</td>
                        <td width="30%"></td>
                      </tr>
                      <tr>
                        <td width="15%">&nbsp; Jabatan</td>
                        <td width="40%"></td>
                        <td width="15%">&nbsp; Lokasi Kerja</td>
                        <td width="30%"></td>
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
                          <td>Nomor tabung sesuai</td>
                          <td align="center">
                            <?php if($point_1[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Penempatan APAR benar</td>
                          <td align="center">
                            <?php if($point_2[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Penempatan APAR pada area kerja dan mudah dicapai</td>
                          <td align="center">
                            <?php if($point_3[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>APAR dalam kondisi bersih</td>
                          <td align="center">
                            <?php if($point_4[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Terdapat data kelas kebakaran pada APAR</td>
                          <td align="center">
                            <?php if($point_5[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Terdapat data media pemadam</td>
                          <td align="center">
                            <?php if($point_6[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>7</td>
                          <td>Terdapat instruk atau petunjuk penggunaan</td>
                          <td align="center">
                            <?php if($point_7[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>8</td>
                          <td>Terpasang tagging / label pemeriksaan</td>
                          <td align="center">
                            <?php if($point_8[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>9</td>
                          <td>Isi APAR cukup (tidak < 10% dari berat normal)</td>
                          <td align="center">
                            <?php if($point_9[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>10</td>
                          <td>Seal dan pin pengaman terpasang dengan baik</td>
                          <td align="center">
                            <?php if($point_10[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>11</td>
                          <td>Jarum indikator tekanan menunjukan kondisi normal</td>
                          <td align="center">
                            <?php if($point_11[0] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[0] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[0] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[0] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[1] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[1] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[1] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[1] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[2] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[2] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[2] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[2] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
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
                          <td>Nomor tabung sesuai</td>
                          <td align="center">
                            <?php if($point_1[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_1[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_1[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Penempatan APAR benar</td>
                          <td align="center">
                            <?php if($point_2[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_2[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_2[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Penempatan APAR pada area kerja dan mudah dicapai</td>
                          <td align="center">
                            <?php if($point_3[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_3[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_3[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>APAR dalam kondisi bersih</td>
                          <td align="center">
                            <?php if($point_4[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_4[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_4[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Terdapat data kelas kebakaran pada APAR</td>
                          <td align="center">
                            <?php if($point_5[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_5[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_5[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Terdapat data media pemadam</td>
                          <td align="center">
                            <?php if($point_6[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_6[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_6[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>7</td>
                          <td>Terdapat instruk atau petunjuk penggunaan</td>
                          <td align="center">
                            <?php if($point_7[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_7[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_7[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>8</td>
                          <td>Terpasang tagging / label pemeriksaan</td>
                          <td align="center">
                            <?php if($point_8[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_8[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_8[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>9</td>
                          <td>Isi APAR cukup (tidak < 10% dari berat normal)</td>
                          <td align="center">
                            <?php if($point_9[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_9[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_9[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>10</td>
                          <td>Seal dan pin pengaman terpasang dengan baik</td>
                          <td align="center">
                            <?php if($point_10[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_10[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_10[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>
                        </tr>
                        <tr>
                          <td>11</td>
                          <td>Jarum indikator tekanan menunjukan kondisi normal</td>
                          <td align="center">
                            <?php if($point_11[3] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[3] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[3] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[3] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[4] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[4] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[4] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[4] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
                          </td>

                          <td align="center">
                            <?php if($point_11[5] == "Baik"){ ?><span class="fa fa-check"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[5] == "Rusak"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[5] == "Hilang"){ ?><span class="fa fa-close"></span><?php } ?>
                          </td>
                          <td align="center">
                            <?php if($point_11[5] == "NA"){ ?><span class="fa fa-minus"></span><?php } ?>
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
                        <td width="25%">....</td>
                        <td width="25%">....</td>
                        <td width="25%">....</td>
                        <td width="25%">....</td>
                      </tr>
                      <tr>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                      </tr>
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
                      <tr>
                        <td align="center">1</td>
                        <td align="center">2</td>
                        <td align="center">3</td>
                        <td align="center">4</td>
                        <td align="center">5</td>
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
                          Keterangan / Catatan :<br>
                          ................
                        </td>
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
                          <td style="text-align: center; height: 100px;">TTD</td>
                          <td style="text-align: center; height: 100px;">TTD</td>
                        </tr>
                        <tr>
                          <td align="center">Nama</td>
                          <td align="center">Nama</td>
                        </tr>
                        <tr>
                          <td align="center">Jabatan</td>
                          <td align="center">Jabatan</td>
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

        <center>
            <button class="btn btn-secondary no-print" onclick="window.print()"><span class="fa fa-print"></span> Cetak / Simpan</button>
          </a>
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