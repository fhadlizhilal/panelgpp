<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $pengembalian_id = $_POST['getID'];
    $get_pengembalian = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengembalian JOIN project ON asset_pengembalian.kd_project = project.kd_project JOIN karyawan ON asset_pengembalian.penanggungjawab = karyawan.nik JOIN asset_db_entitas ON asset_pengembalian.entitas_id = asset_db_entitas.id WHERE asset_pengembalian.id = '$pengembalian_id'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <div class="row">
      <div class="col-lg-6 col-12">
        <table class="table table-sm" style="font-size: 11px">
          <tr>
            <td width="28%">No Pengembalian</td>
            <td width="1%">:</td>
            <td><?php echo "RTN".$pengembalian_id."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
          </tr>
          <tr>
            <td width="28%">Kode Project</td>
            <td width="1%">:</td>
            <td><?php echo $get_pengembalian['kd_project']; ?></td>
          </tr>
          <tr>
            <td>Nama Project</td>
            <td>:</td>
            <td><?php echo $get_pengembalian['nm_project']; ?></td>
          </tr>
          <tr>
            <td>Peminjam</td>
            <td>:</td>
            <td>
              <?php
                $q_get_peminjam = mysqli_query($conn, "SELECT DISTINCT peminjam FROM asset_peminjaman WHERE kd_project = '$get_pengembalian[kd_project]' AND (status = 'on progress by MA' OR status = 'completed')");
                while($get_peminjam = mysqli_fetch_array($q_get_peminjam)){
                  $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjam[peminjam]'"));
                  echo $get_karyawan['nama'].", ";
                }
              ?>
            </td>
          </tr>
        </table>
      </div>


      <div class="col-lg-6 col-12">
        <table class="table table-sm" style="font-size: 11px">
          <tr>
            <td width="28%">Entitas Peminjam</td>
            <td width="1%">:</td>
            <td>
              <?php
                $q_get_entitas_id = mysqli_query($conn, "SELECT DISTINCT entitas_id FROM asset_suratjalan JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE kd_project = '$get_pengembalian[kd_project]'");
                while($get_entitas_id = mysqli_fetch_array($q_get_entitas_id)){
                  $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_entitas_id[entitas_id]'"));
                  echo $get_entitas['entitas'].", ";
                }
              ?>
            </td>
          </tr>
          <tr>
            <td width="28%">Penanggung Jawab</td>
            <td>:</td>
            <td><?php echo $get_pengembalian['nama']; ?></td>
          </tr>
          <tr>
            <td width="28%">Entitas Pengembalian</td>
            <td>:</td>
            <td><?php echo $get_pengembalian['entitas']; ?></td>
          </tr>
          <tr>
            <td>Tanggal Pengembalian</td>
            <td>:</td>
            <td><?php echo date("d/m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="table-responsive p-0">
      <table class="table table-sm table-striped" style="font-size: 11px">
        <thead>
          <tr>
            <th width="1%" style="vertical-align: bottom;">No</th>
            <th style="vertical-align: bottom;">Nama Barang</th>
            <th style="vertical-align: bottom;">Tipe Barang</th>
            <th style="vertical-align: bottom;">Tipe Detail</th>
            <th style="vertical-align: bottom;">Merek</th>
            <th width="8%" style="vertical-align: bottom;">Sub Barang</th>
            <th width="1%" style="text-align: center;">Jml Pinjam</th>
            <th width="1%" style="vertical-align: bottom;">Satuan</th>
            <th width="1%" style="text-align: center;">Kembali Baik</th>
            <th width="1%" style="text-align: center;">Kembali Habis</th>
            <th width="1%" style="text-align: center;">Rusak Sebagian</th>
            <th width="1%" style="text-align: center;">Rusak Total</th>
            <th width="1%" style="vertical-align: bottom;">Hilang</th>
          </tr>
        </thead>
        <?php
          $no=1;
          $q_get_asset_pengembalian_detail = mysqli_query($conn, "SELECT * FROM asset_pengembalian_detail JOIN asset_db_detail ON asset_pengembalian_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE pengembalian_id = '$pengembalian_id' ORDER BY nama_barang ASC, tipe_barang ASC");
          while($get_pengembalian_detail = mysqli_fetch_array($q_get_asset_pengembalian_detail)){
            $jml_pinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sum_pinjam FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE kd_project = '$get_pengembalian[kd_project]' AND detail_code = '$get_pengembalian_detail[detail_code]'"));
        ?>
            <tbody>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $get_pengembalian_detail['nama_barang']; ?></td>
                <td><?php echo $get_pengembalian_detail['tipe_barang']; ?></td>
                <td><?php echo $get_pengembalian_detail['tipe_detail']; ?></td>
                <td><?php echo $get_pengembalian_detail['merek']; ?></td>
                <td><?php echo $get_pengembalian_detail['sub_barang']; ?></td>
                <td align="center"><?php echo $jml_pinjam['sum_pinjam']; ?></td>
                <td align="center"><?php echo $get_pengembalian_detail['satuan']; ?></td>
                <td align="center"><?php echo $get_pengembalian_detail['kembali_baik']; ?></td>
                <td align="center"><?php echo $get_pengembalian_detail['habis']; ?></td>
                <td align="center"><?php echo $get_pengembalian_detail['rusak_sebagian']; ?></td>
                <td align="center"><?php echo $get_pengembalian_detail['rusak_total']; ?></td>
                <td align="center"><?php echo $get_pengembalian_detail['hilang']; ?></td>
              </tr>
            </tbody>
        <?php $no++; } ?>
      </table>
    </div>

    <?php if($get_pengembalian['status'] == 'waiting for approval'){ ?>
      <div>
        <center>
          <a href="index.php?pages=formbastpengembalian&pengembalianid=<?php echo $pengembalian_id; ?>">
            <div class="btn btn-success"><span class="fa fa-external-link"></span> Open BAST</div>
          </a>
        </center>
      </div>
    <?php }else{ ?>

      <div class="row">
        <div class="col-lg-2 col-0"></div>
        <div class="col-lg-8 col-12">
          <div class="card">
            <div class="card-body" style="background-color: lightgreen;">
              <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">BERITA ACARA PENGEMBALIAN ASSET</div>
              <table class="table table-sm" style="font-size: 12px;">
                <tr>
                  <td width="28%">No Pengembalian</td>
                  <td width="1%">:</td>
                  <td><?php echo "RTN".$pengembalian_id."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
                </tr>
                <tr>
                  <td width="28%">Pihak 1 / User</td>
                  <td width="1%">:</td>
                  <td><?php echo $get_pengembalian['nama']; ?></td>
                </tr>
                <tr>
                  <td>Pihak 2 / MA</td>
                  <td>:</td>
                  <td>Management Asset</td>
                </tr>
              </table>

              <table class="table table-bordered table-sm" style="font-size: 11px">
                <thead>
                  <tr>
                    <th width="40%" style="text-align: center;">Project</th>
                    <th width="60%" style="text-align: center;">Pernyataan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="height: 200px; vertical-align: middle; font-weight: bold; text-align: center;">
                      <?php echo $get_pengembalian['kd_project']."<br>".$get_pengembalian['nm_project']; ?>
                    </td>
                    <td style="font-size: 12px; vertical-align: middle; padding-left: 15px; padding-right: 15px">
                      Yang bertanda tangan dibawah ini :<br>
                      Pihak 1 & Pihak 2
                      <br><br>
                      <div style="text-align: justify;">Menyatakan bahwa barang yang dikembalikan sesuai dengan surat pengembalian no <b><?php echo "RTN".$pengembalian_id."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></b> adalah qty dan kondisi sesuai dengan surat pengembalian.</div>
                      <br>
                      <div style="text-align: justify;">Demikian pernyataan ini dibuat dengan sebenar-benarnya.</div>
                    </td>
                  </tr>
                </tbody>
              </table>

              <br>
              <table style="font-size: 11px; width: 100%;">
                <tr>
                  <td width="50%" style="vertical-align: middle; text-align: center;"></td>
                  <td width="50%" style="vertical-align: middle; text-align: center;">Bandung, <?php echo date("d-m-Y", strtotime($get_pengembalian["tgl_bast"])); ?></td>
                </tr>
                <tr>
                  <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 1/Menyerahkan</td>
                  <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 2/Penerima</td>
                </tr>
                <tr>
                  <td width="50%" style="height: 50px; vertical-align: middle; text-align: center;">
                    <img src="../unrole/management_asset/ttd_bast_pengembalian/<?php echo $get_pengembalian["ttd"]; ?>" width="80%">
                  </td>
                  <td width="50%" style="height: 100px; vertical-align: middle; text-align: center;">
                    <small>TTD<br>Management Asset</small>
                  </td>
                </tr>
                <tr>
                  <td width="50%" style="vertical-align: middle; text-align: center;">(<?php echo $get_pengembalian['nama']; ?>)</td>
                  <td width="50%" style="vertical-align: middle; text-align: center;">(Management Asset)</td>
                </tr>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


    <?php } ?>
  </div>
  