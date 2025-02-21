<?php
  session_start();
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
        <td width="20%">Nama Peminjam</td>
        <td width="1%">:</td>
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
          <th width="1%">Qty</th>
          <th width="1%">Satuan</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no=1;
          $q_get_peminjaman_detail = mysqli_query($conn, "SELECT * FROM asset_peminjaman_detail JOIN asset_db_general ON asset_peminjaman_detail.general_code = asset_db_general.general_code WHERE peminjaman_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
          while($get_peminjaman_detail = mysqli_fetch_array($q_get_peminjaman_detail)){
            $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE general_code = '$get_peminjaman_detail[general_code]'"));
        ?>
            <tr>
              <td width="1%"><?php echo $no; ?></td>
              <td><?php echo $get_db_general['nama_barang']; ?></td>
              <td><?php echo $get_db_general['tipe_barang']; ?></td>
              <td><?php echo $get_peminjaman_detail ['qty']; ?></td>
              <td><?php echo $get_db_general['satuan']; ?></td>
              <td><?php echo $get_peminjaman_detail['keterangan'];  ?></td>
            </tr>
        <?php $no++; } ?>
      </tbody>
    </table>
  </div>

  <?php if($_SESSION['role'] == "management_asset"){ ?>
    <div class="card-footer" style="text-align: center;">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="kd_project" value="<?php echo $get_peminjaman['kd_project']; ?>">
      <button type="submit" class="btn btn-success" name="fu_peminjaman" value="process"><span class="fa fa-check"></span> Process</button>
      <button type="submit" class="btn btn-danger" name="fu_peminjaman" value="reject"><span class="fa fa-close"></span> Reject</button>
      <a href="../unrole/management_asset/cetak_peminjaman.php?id=<?php echo $id; ?>" target="_blank">
        <div class="btn btn-secondary" name="" value=""><span class="fa fa-file-text-o"></span> Print</div>
      </a>
    </div>
  <?php } ?>
  