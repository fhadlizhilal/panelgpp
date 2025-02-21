<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_suratjalan WHERE id = '$id'"));
    $get_peminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE id = '$get_suratjalan[peminjaman_id]'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));
    $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
    $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_suratjalan[entitas_id]'"));
    $get_bast = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_suratjalan_bast WHERE suratjalan_id = '$id'"));
  }
?>

<div class="card-body" style="margin-top: -20px;">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI SURAT JALAN</div>
  <table class="table table-sm" style="font-size: 12px;">
    <tr>
      <td width="15%">No Surat Jalan</td>
      <td width="1%">:</td>
      <td><?php echo "SJ".$get_suratjalan['id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?></td>
    </tr>
    <tr>
      <td width="15%">Kode Pinjam</td>
      <td width="1%">:</td>
      <td><?php echo $get_peminjaman['id']."/MA/".date("m/Y", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
    </tr>
    <tr>
      <td width="15%">Jenis</td>
      <td width="1%">:</td>
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
      </td>
    </tr>
    <tr>
      <td width="15%">Entitas</td>
      <td width="1%">:</td>
      <td><?php echo $get_entitas['entitas']; ?></td>
    </tr>
    <tr>
      <td width="15%">Tanggal</td>
      <td width="1%">:</td>
      <td><?php echo date("d F Y", strtotime($get_suratjalan['tanggal'])); ?></td>
    </tr>
    <tr>
      <td>Project</td>
      <td>:</td>
      <td><?php echo $get_peminjaman['kd_project']." - ".$get_project['nm_project']; ?></td>
    </tr>
    <tr>
      <td>Peminjam</td>
      <td>:</td>
      <td><?php echo $get_karyawan['nama']; ?></td>
    </tr>
    <tr>
      <td>Alamat Kirim</td>
      <td>:</td>
      <td><?php echo $get_suratjalan['alamat_kirim']; ?></td>
    </tr>
    <tr>
      <td>Nama Expedisi</td>
      <td>:</td>
      <td><?php echo $get_suratjalan['expedisi']; ?></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>

  <div style="text-align: center; font-weight: bold; margin-bottom: 10px; margin-top: 20px;">INFORMASI PENGIRIMAN ASSET</div>
  <table class="table table-sm" style="font-size: 11px">
    <thead>
      <tr>
        <th width="1%">No</th>
        <th>Nama Barang</th>
        <th>Tipe Barang</th>
        <th>Tipe Detail</th>
        <th width="12%">Merek</th>
        <th width="12%">Sub Barang</th>
        <th width="1%">Qty</th>
        <th width="1%">Satuan</th>
      </tr>
    </thead>
    <tbody>

      <?php
        $no=1;
        $q_get_suratjalan_detail = mysqli_query($conn, "SELECT * FROM asset_suratjalan_detail JOIN asset_db_detail ON asset_suratjalan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_suratjalan_detail.suratjalan_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
        while($get_suratjalan_detail = mysqli_fetch_array($q_get_suratjalan_detail)){

      ?>
        <tr>
          <td width="1%"><?php echo $no; ?></td>
          <td><?php echo $get_suratjalan_detail['nama_barang']; ?></td>
          <td><?php echo $get_suratjalan_detail['tipe_barang']; ?></td>
          <td><?php echo $get_suratjalan_detail['tipe_detail']; ?></td>
          <td><?php echo $get_suratjalan_detail ['merek']; ?></td>
          <td><?php echo $get_suratjalan_detail['sub_barang']; ?></td>
          <td><?php echo $get_suratjalan_detail['qty']; ?></td>
          <td><?php echo $get_suratjalan_detail['satuan']; ?></td>
        </tr>
        
      <?php $no++; } ?>

    </tbody>
  </table>

  <div style="text-align: center; margin-bottom: 10px; margin-top: 30px;">
    <a href="../unrole/management_asset/cetak_suratjalan.php?id=<?php echo $id; ?>" target="_blank">
      <div class="btn btn-secondary"><span class="fa fa-print"></span> Cetak / Simpan</div>
    </a>
  </div>

  <?php
    $cek_bast = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_suratjalan_bast WHERE suratjalan_id = '$id'"));
    if($cek_bast > 0){
  ?>
  <hr>

  <div class="row">   
    <div class="col-12">
      <div class="card">
        <div class="card-body" style="background-color: lightgreen;">
          <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">BERITA ACARA SERAH TERIMA ASSET (BASTA)</div>
          <table class="table table-sm" style="font-size: 12px;">
            <tr>
              <td width="28%">No Surat Jalan</td>
              <td width="1%">:</td>
              <td><?php echo "BAST".$get_bast['id']."/MA/".date("m/Y", strtotime($get_bast['tanggal_bast'])); ?></td>
            </tr>
            <tr>
              <td width="28%">Pihak 1 / MA</td>
              <td width="1%">:</td>
              <td>Management Asset</td>
            </tr>
            <tr>
              <td>Pihak 2 / User</td>
              <td>:</td>
              <td><?php echo $get_karyawan['nama']; ?></td>
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
                  <?php echo $get_peminjaman['kd_project']."<br>".$get_project['nm_project']; ?>
                </td>
                <td style="font-size: 12px; vertical-align: middle; padding-left: 15px; padding-right: 15px">
                  Yang bertanda tangan dibawah ini :<br>
                  Pihak 1 & Pihak 2
                  <br><br>
                  <div style="text-align: justify;">Menyatakan bahwa barang yang diserahterimakan sesuai dengan surat jalan no <b><?php echo "SJ".$get_suratjalan['id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?></b> adalah dalam kondisi baik dan sesuai dengan surat jalan.</div>
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
              <td width="50%" style="vertical-align: middle; text-align: center;">Bandung, <?php echo date("d-m-Y", strtotime($get_bast["tanggal_bast"])); ?></td>
            </tr>
            <tr>
              <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 1/Menyerahkan</td>
              <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 2/Penerima</td>
            </tr>
            <tr>
              <td width="50%" style="height: 100px; vertical-align: middle; text-align: center;">
                <img src="../unrole/management_asset/ttd_bast/ttd_asset.png" width="40%">
              </td>
              <td width="50%" style="height: 50px; vertical-align: middle; text-align: center;">
                <img src="../unrole/management_asset/ttd_bast/<?php echo $get_bast["ttd"]; ?>" width="80%">
              </td>
            </tr>
            <tr>
              <td width="50%" style="vertical-align: middle; text-align: center;">(Management Asset)</td>
              <td width="50%" style="vertical-align: middle; text-align: center;">(<?php echo $get_karyawan['nama']; ?>)</td>
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