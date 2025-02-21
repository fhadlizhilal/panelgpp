<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_pengajuan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE id = '$id'"));
    $get_pelaksana = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengajuan[pelaksana]'"));
    $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengajuan[entitas_id]'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_pengajuan[kd_project]'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI REALISASI</div>
    <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
      <tr>
        <td width="20%">No Pengajuan</td>
        <td width="1%">:</td>
        <td><b><?php echo "PN".$id."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></b></td>
      </tr>
      <tr>
        <td width="20%">Nama Pelaksana</td>
        <td width="1%">:</td>
        <td><?php echo $get_pelaksana['nama']; ?></td>
      </tr>
      <tr>
        <td>Entitas</td>
        <td>:</td>
        <td><?php echo $get_entitas['entitas']; ?></td>
      </tr>
      <tr>
        <td>Jenis Pengajuan</td>
        <td>:</td>
        <td>
          <?php if($get_pengajuan['jenis'] == "tools"){ ?>
            <span class="badge badge-info">Tools</span>
          <?php }elseif($get_pengajuan['jenis'] == "apd"){ ?>
            <span class="badge badge-success">APD</span>
          <?php }elseif($get_pengajuan['jenis'] == "inventaris"){ ?>
            <span class="badge badge-warning">Inventaris</span>
          <?php }elseif($get_pengajuan['jenis'] == "alat ukur"){ ?>
            <span class="badge badge-danger">Alat Ukur</span>
          <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Tanggal Pengajuan</td>
        <td>:</td>
        <td><?php echo date("d F Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></td>
      </tr>
      <tr>
        <td>Tanggal Realisasi</td>
        <td>:</td>
        <td><?php echo date("d F Y", strtotime($get_pengajuan['tgl_realisasi'])); ?></td>
      </tr>
      <tr>
        <td>Project</td>
        <td>:</td>
        <td><?php echo $get_pengajuan['kd_project']." - ".$get_project['nm_project']; ?></td>
      </tr>
      <tr>
        <td>Keterangan</td>
        <td>:</td>
        <td><?php echo $get_pengajuan['keterangan']; ?></td>
      </tr>
    </table>

    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">DETAIL BARANG REALISASI</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Tipe Detail</th>
          <th>Merek</th>
          <th width="1%">Qty</th>
          <th width="1%">Satuan</th>
          <th>Nilai Pengajuan</th>
          <th>Nilai Realisasi</th>
          <th>Sisa Uang</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;

          $nilai_pengajuan = 0;
          $nilai_realisasi = 0;
          $sisa_uang = 0;

          $total_pengajuan = 0;
          $total_realisasi = 0;
          $total_sisa_uang = 0;

          $q_get_realisasi = mysqli_query($conn, "SELECT * FROM asset_realisasi JOIN asset_db_detail ON asset_realisasi.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE pengajuan_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
          while($get_realisasi = mysqli_fetch_array($q_get_realisasi)){
            $get_db_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_detail WHERE detail_code = '$get_realisasi[detail_code]'"));
            $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_detail[general_code_id]'"));
            $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_detail[merek_id]'"));

            $get_pengajuan_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengajuan_detail WHERE pengajuan_id = '$id' AND detail_code = '$get_realisasi[detail_code]'"));
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_db_general['nama_barang']; ?></td>
              <td><?php echo $get_db_general['tipe_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_detail']; ?></td>
              <td><?php echo $get_merek['merek']; ?></td>
              <td><?php echo $get_realisasi['qty']; ?></td>
              <td><?php echo $get_db_general['satuan']; ?></td>
              <td><?php echo number_format($nilai_pengajuan = $get_pengajuan_detail['qty']*$get_pengajuan_detail['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo number_format($nilai_realisasi = $get_realisasi['qty']*$get_realisasi['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo number_format($sisa_uang = $nilai_pengajuan - $nilai_realisasi, 0, ',', '.'); ?></td>
            </tr>
        <?php 
            $no++;
            $total_pengajuan = $total_pengajuan + $nilai_pengajuan;
            $total_realisasi = $total_realisasi + $nilai_realisasi;
            $total_sisa_uang = $total_sisa_uang + $sisa_uang;
          } 
        ?>
            <tr style="font-weight: bold; background-color: yellow;">
              <td colspan="7" align="center">TOTAL</td>
              <td><?php echo "Rp ".number_format($total_pengajuan, 0, ',', '.'); ?></td>
              <td><?php echo "Rp ".number_format($total_realisasi, 0, ',', '.'); ?></td>
              <td><?php echo "Rp ".number_format($total_sisa_uang, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>
  </div>
  <div class="card-footer" style="text-align: center;">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <a href="index.php?pages=formeditrealisasi&id=<?php echo $id; ?>"><div class="btn btn-secondary"><span class="fa fa-edit"></span> Edit Realisasi</div></a>
    <a href="../unrole/management_asset/cetak_realisasi_detail.php?id=<?php echo $id; ?>" target="_blank"><div class="btn btn-info"><span class="fa fa-download"></span> Cetak / Download</div></a>
  </div>
  