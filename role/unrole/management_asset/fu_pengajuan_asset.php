<?php
  session_start();
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
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PENGAJUAN</div>
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

    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">DETAIL BARANG</div>
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
          <th>Harga Satuan</th>
          <th>Total Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $total_harga = 0;
          $q_get_pengajuan_detail = mysqli_query($conn, "SELECT * FROM asset_pengajuan_detail JOIN asset_db_detail ON asset_pengajuan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE pengajuan_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
          while($get_pengajuan_detail = mysqli_fetch_array($q_get_pengajuan_detail)){
            $get_db_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_detail WHERE detail_code = '$get_pengajuan_detail[detail_code]'"));
            $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_detail[general_code_id]'"));
            $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_detail[merek_id]'"));

            $total_harga = $total_harga + ($get_pengajuan_detail['qty'] * $get_pengajuan_detail['harga_satuan']);
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_db_general['nama_barang']; ?></td>
              <td><?php echo $get_db_general['tipe_barang']; ?></td>
              <td><?php echo $get_db_detail['tipe_detail']; ?></td>
              <td><?php echo $get_merek['merek']; ?></td>
              <td><?php echo $get_pengajuan_detail['qty']; ?></td>
              <td><?php echo $get_db_general['satuan']; ?></td>
              <td><?php echo "Rp ".number_format($get_pengajuan_detail['harga_satuan'], 0, ',', '.'); ?></td>
              <td><?php echo "Rp ".number_format($get_pengajuan_detail['qty']*$get_pengajuan_detail['harga_satuan'], 0, ',', '.'); ?></td>
            </tr>
        <?php $no++; } ?>
            <tr style="font-weight: bold; background-color: yellow;">
              <td colspan="8" align="center">TOTAL</td>
              <td><?php echo "Rp ".number_format($total_harga, 0, ',', '.'); ?></td>
            </tr>
      </tbody>
    </table>
  </div>

  <?php if($_SESSION['role'] == "management_asset" || $_SESSION['role'] == "HSE"){ ?>

    <div class="card-footer" style="text-align: center;">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      
      <?php if($get_pengajuan['status'] == 'belum realisasi'){ ?>
        <a href="index.php?pages=formeditpengajuan&id=<?php echo $id; ?>"><div class="btn btn-secondary"><span class="fa fa-edit"></span> Edit Pengajuan</div></a>
      <?php } ?>

      <a href="../unrole/management_asset/cetak_pengajuan_detail.php?id=<?php echo $id; ?>" target="_blank"><div class="btn btn-info"><span class="fa fa-download"></span> Cetak / Download</div></a>

      <?php if($get_pengajuan['status'] == 'belum realisasi'){ ?>
        <a href="index.php?pages=formrealisasi&id=<?php echo $id; ?>">
          <div class="btn btn-success"><span class="fa fa-file-text-o"></span> Input Realisasi</div>
        </a>
      <?php } ?>
    </div>

  <?php }else{ ?>

    <div class="card-footer" style="text-align: center;">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <a href="../unrole/management_asset/cetak_pengajuan_detail.php?id=<?php echo $id; ?>" target="_blank"><div class="btn btn-info"><span class="fa fa-download"></span> Cetak / Download</div></a>
    </div>

  <?php } ?>
  