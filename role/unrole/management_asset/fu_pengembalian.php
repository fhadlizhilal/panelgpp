<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $kd_project = $_POST['getID'];
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$kd_project'"));
    $cek_pengembalian_selesai = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_pengembalian_selesai WHERE kd_project = '$kd_project'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
      <tr>
        <td width="20%">Kode Project</td>
        <td width="1%">:</td>
        <td><b><?php echo $kd_project; ?></b></td>
      </tr>
      <tr>
        <td width="20%">Nama Project</td>
        <td width="1%">:</td>
        <td><?php echo $get_project['nm_project']; ?></td>
      </tr>
      <tr>
        <td>Peminjam</td>
        <td>:</td>
        <td>
          <?php
            $q_get_peminjam = mysqli_query($conn, "SELECT DISTINCT peminjam FROM asset_peminjaman WHERE kd_project = '$kd_project' AND (status = 'on progress by MA' OR status = 'completed')");
            while($get_peminjam = mysqli_fetch_array($q_get_peminjam)){
              $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjam[peminjam]'"));
              echo $get_karyawan['nama'].", ";
            }
          ?>
        </td>
      </tr>
    </table>

    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">DETAIL BARANG KEMBALI</div>
    <table class="table table-sm table-striped" style="font-size: 11px">
      <thead>
        <tr>
          <th width="1%">No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th width="8%">Sub Barang</th>
          <th width="1%" style="text-align: center;">Qty Pinjam</th>
          <th width="1%">Satuan</th>
          <th width="1%" style="text-align: center;">Kembali Baik</th>
          <th width="1%" style="text-align: center;">Kembali Habis</th>
          <th width="1%" style="text-align: center;">Rusak Sebagian</th>
          <th width="1%" style="text-align: center;">Rusak Total</th>
          <th width="1%" style="text-align: center;">Hilang</th>
          <th width="1%" style="text-align: center;">Total Kembali</th>
          <th width="1%"></th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
          $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id ORDER BY nama_barang ASC, tipe_barang ASC");
          while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
            $qty_pinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS qty_pinjam FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE asset_peminjaman.kd_project = '$kd_project' AND asset_suratjalan_detail.detail_code = '$get_db_detail[detail_code]'"));

            $qty_pengembalian = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS sum_baik, SUM(habis) AS sum_habis, SUM(rusak_sebagian) AS sum_rusaksebagian, SUM(rusak_total) AS sum_rusaktotal, SUM(hilang) AS sum_hilang FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE kd_project = '$kd_project' AND detail_code = '$get_db_detail[detail_code]'"));

            if($qty_pinjam['qty_pinjam'] > 0 || $qty_pengembalian['sum_baik']>0 || $qty_pengembalian['sum_habis']>0 || $qty_pengembalian['sum_rusaksebagian']>0 || $qty_pengembalian['sum_rusaktotal']>0 || $qty_pengembalian['sum_hilang']>0){
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_db_detail['nama_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_detail']; ?></td>
              <td><?php echo $get_db_detail['merek']; ?></td>
              <td><?php echo $get_db_detail['sub_barang']; ?></td>
              <td><?php echo $qty_pinjam['qty_pinjam']; ?></td>
              <td><?php echo $get_db_detail['satuan']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_baik']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_habis']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_rusaksebagian']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_rusaktotal']; ?></td>
              <td align="center"><?php echo $qty_pengembalian['sum_hilang']; ?></td>
              <td align="center">
                <b>
                  <?php echo $total_kembali = $qty_pengembalian['sum_baik'] + $qty_pengembalian['sum_habis'] + $qty_pengembalian['sum_rusaksebagian'] + $qty_pengembalian['sum_rusaktotal'] + $qty_pengembalian['sum_hilang']; ?>
                </b>
              </td>
              <td>
                <?php if($total_kembali < $qty_pinjam['qty_pinjam']){ ?>
                  <span class="fa fa-close" style="color: red"></span>
                <?php }else{ ?>
                  <span class="fa fa-check" style="color: green"></span>
                <?php } ?>
              </td>
            </tr>
        <?php $no++; }} ?>
      </tbody>
    </table>
  </div>

  <div class="card-footer" style="text-align: center;">
    <form method="POST" action="">
      <input type="hidden" name="kd_project" value="<?php echo $kd_project; ?>">
      <?php if($cek_pengembalian_selesai > 0){ ?>
        <a href="index.php?pages=pengembaliandetailselesai&kdproject=<?php echo $kd_project; ?>">
          <div class="btn btn-secondary btn-sm"><span class="fa fa-file-text-o"></span> Buka Pengembalian</div>
        </a>
      <?php }else{ ?>
        <a href="index.php?pages=pengembaliandetail&kdproject=<?php echo $kd_project; ?>">
          <div class="btn btn-secondary btn-sm"><span class="fa fa-file-text-o"></span> Buka Pengembalian</div>
        </a>
      <?php } ?>

      <!-- <button class="btn btn-success btn-sm" name="pengembalian_completed" value="completed" onclick="return confirm('Yakin pengembalian ini sudah selesai?')"><span class="fa fa-check"></span> Pengembalian Completed</button> -->
    </form>
  </div>