<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_peminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE id = '$id'"));
    $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PEMINJAMAN</div>
    <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
      <tr>
        <td width="30%">Kode Pinjam</td>
        <td width="1%">:</td>
        <td><?php echo $id."/MA/".date("m/Y", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
      </tr>
      <tr>
        <td>Nama Peminjam</td>
        <td>:</td>
        <td><?php echo $get_karyawan['nama']; ?></td>
      </tr>
      <tr>
        <td>Tanggal Pinjam</td>
        <td>:</td>
        <td><?php echo date("d F Y H:i", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
      </tr>
      <tr>
        <td>Project</td>
        <td>:</td>
        <td>
          <?php
            if($get_peminjaman['kd_project'] == NULL){
              echo "Non Project";
            }else{
              echo $get_peminjaman['kd_project']." - ".$get_project['nm_project'];
            }                            
          ?>
        </td>
      </tr>
      <tr>
        <td>Keterangan Pinjam</td>
        <td>:</td>
        <td>
          <?php echo $get_peminjaman['keterangan']; ?></td>
      </tr>
      <tr>
        <td>Jenis / Status</td>
        <td>:</td>
        <td>
          <?php if($get_peminjaman['jenis'] == "tools"){ ?>
            <span class="badge badge-info">Tools</span>
          <?php }elseif($get_peminjaman['jenis'] == "apd"){ ?>
            <span class="badge badge-success">APD</span>
          <?php }elseif($get_peminjaman['jenis'] == "inventaris"){ ?>
            <span class="badge badge-warning">Inventaris</span>
          <?php }elseif($get_peminjaman['jenis'] == "alat ukur"){ ?>
            <span class="badge badge-danger">Alat Ukur</span>
          <?php } ?>

          <?php if($get_peminjaman['status'] == "waiting for MA"){ ?>
            <span class="badge badge-secondary">Waiting for MA</span>
          <?php }elseif($get_peminjaman['status'] == "on progress by MA"){ ?>
            <span class="badge badge-warning">On Progress by MA</span>
          <?php }elseif($get_peminjaman['status'] == "rejected by MA"){ ?>
            <span class="badge badge-danger">Rejected by MA</span>
          <?php }elseif($get_peminjaman['status'] == "canceled by user"){ ?>
            <span class="badge badge-danger">Canceled by User</span>
          <?php }elseif($get_peminjaman['status'] == "completed"){ ?>
            <span class="badge badge-success">Completed</span>
          <?php } ?>
        </td>
      </tr>
    </table>

    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI ASSET</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Tipe Barang</th>
          <th>Qty</th>
          <th>Satuan</th>
          <th>Catatan</th>
          <th width="4%">Sudah Kirim</th>
          <th width="4%">Sisa</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $q_get_peminjaman_detail = mysqli_query($conn, "SELECT * FROM asset_peminjaman_detail JOIN asset_db_general ON asset_peminjaman_detail.general_code = asset_db_general.general_code WHERE peminjaman_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
          while($get_peminjaman_detail = mysqli_fetch_array($q_get_peminjaman_detail)){
            $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE general_code = '$get_peminjaman_detail[general_code]'"));

            //sudah kirim dari surat jalan (non tidak sesuai)
            $sudahkirim_dari_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sudah_kirim FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_db_detail ON asset_suratjalan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_db_general.general_code = '$get_peminjaman_detail[general_code]' AND asset_suratjalan.status <> 'diterima tapi tidak sesuai' AND peminjaman_id = '$id'"));
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_db_general['nama_barang']; ?></td>
              <td><?php echo $get_db_general['tipe_barang']; ?></td>
              <td><?php echo $get_peminjaman_detail ['qty']; ?></td>
              <td><?php echo $get_db_general['satuan']; ?></td>
              <td><?php echo $get_peminjaman_detail['keterangan'];  ?></td>
              <td><?php if($sudahkirim_dari_suratjalan['sudah_kirim'] < 1){echo 0;}else{echo $sudahkirim_dari_suratjalan['sudah_kirim'];} ?></td>
              <td><?php echo $get_peminjaman_detail ['qty'] - $sudahkirim_dari_suratjalan['sudah_kirim']; ?></td>
            </tr>
        <?php $no++; } ?>
            <tr>
              <td colspan="8"></td>
            </tr>
      </tbody>
    </table>

    <?php if($get_peminjaman['status'] == "waiting for MA"){ ?>
    <div class="card-footer" style="text-align: center;">
      <a href="../unrole/management_asset/cetak_peminjaman_detail.php?id=<?php echo $id; ?>" target="_blank">
        <div class="btn btn-secondary"><span class="fa fa-print"></span> Cetak / Simpan</div>
      </a>
      <a href="index.php?pages=formeditpeminjaman&id=<?php echo $id; ?>">
        <div class="btn btn-info"><span class="fa fa-edit"></span> Edit</div>
      </a>

      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <button type="submit" class="btn btn-danger" name="batalkan_by_user" value="batalkan" onclick="return confirm('Yakin akan membatalkan peminjaman ini?')"><span class="fa fa-close"></span> Batalkan</button>
    </div>
    <?php }elseif($get_peminjaman['status'] == "rejected by MA" || $get_peminjaman['status'] == "canceled by user"){ ?>
      <div class="card-footer" style="text-align: center;">
        <a href="../unrole/management_asset/cetak_peminjaman_detail.php?id=<?php echo $id; ?>" target="_blank">
          <div class="btn btn-secondary"><span class="fa fa-print"></span> Cetak / Simpan</div>
        </a>
        
        <a href="index.php?pages=formeditpeminjaman&id=<?php echo $id; ?>">
          <div class="btn btn-info"><span class="fa fa-edit"></span> Edit</div>
        </a>
      </div>
    <?php } ?>

  </div>

  <hr><br>
  <div class="card-body" style="background-color: lightblue;">
    <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">SURAT JALAN</div>
    <table class="table table-sm" style="font-size: 11px">
      <thead>
        <tr>
          <th>No</th>
          <th>No Surat Jalan</th>
          <th>Tanggal</th>
          <th>Expedisi</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $q_get_suratjalan = mysqli_query($conn, "SELECT * FROM asset_suratjalan WHERE peminjaman_id = '$id' ORDER BY id DESC");
          $cek_suratjalan = mysqli_num_rows($q_get_suratjalan);
          if($cek_suratjalan < 1){
            echo "
              <tr>
                <td colspan='6' align='center'><div style='font-style: italic'>belum ada data surat jalan</div></td>
              </tr>
            ";
          }

          while($get_suratjalan = mysqli_fetch_array($q_get_suratjalan)){
            $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_suratjalan[entitas_id]'"));
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td>
                <a href="index.php?pages=detailsuratjalan&suratjalanid=<?php echo $get_suratjalan['id']; ?>">
                  <?php echo "SJ".$get_suratjalan['id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?>
                </a>
              </td>
              <td><?php echo date("d F Y", strtotime($get_suratjalan['tanggal'])); ?></td>
              <td><?php echo $get_suratjalan['expedisi']; ?></td>
              <td>
                <?php if($get_suratjalan['status'] == "dalam pengiriman"){ ?>
                  <span class="badge badge-warning">dalam pengiriman</span>
                <?php }elseif($get_suratjalan['status'] == "tiba ditujuan"){ ?>
                  <span class="badge badge-secondary">tiba ditujuan</span>
                <?php }elseif($get_suratjalan['status'] == "diterima & sesuai"){ ?>
                  <span class="badge badge-success">diterima & sesuai</span>
                <?php }elseif($get_suratjalan['status'] == "diterima tapi tidak sesuai"){ ?>
                  <span class="badge badge-danger">diterima tapi tidak sesuai</span>
                <?php } ?>
              </td>
            </tr>
        <?php $no++; } ?>
      </tbody>
    </table>
  </div>