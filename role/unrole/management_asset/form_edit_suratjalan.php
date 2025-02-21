<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $get_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_suratjalan WHERE id = '$id'"));
    $get_peminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE id = '$get_suratjalan[peminjaman_id]'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));
    $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
    $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_suratjalan[entitas_id]'"));
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
      <td><input type="date" name="tgl_suratjalan" value="<?php echo $get_suratjalan['tanggal'];  ?>" required></td>
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
      <td><input type="text" style="width: 100%" name="alamat_kirim" value="<?php echo $get_suratjalan['alamat_kirim']; ?>" required></td>
    </tr>
    <tr>
      <td>Nama Expedisi</td>
      <td>:</td>
      <td><input type="text" name="expedisi" value="<?php echo $get_suratjalan['expedisi']; ?>" required></td>
    </tr>
    <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </table>

  <div style="text-align: center; font-weight: bold; margin-bottom: 10px; margin-top: 20px;">INFORMASI PEMINJAMAN ASSET</div>
  <table class="table table-bordered table-hover table-sm" style="font-size: 11px">
    <thead>
      <tr>
        <th width="1%">No</th>
        <th>Nama Barang</th>
        <th>Tipe Barang</th>
        <th width="8%">Sub Barang</th>
        <th width="1%">Qty</th>
        <th width="1%">Satuan</th>
        <th width="15%">Catatan</th>
        <th width="5%">Sudah Kirim</th>
        <th width="5%">Sisa</th>
      </tr>
    </thead>
    <tbody>

      <?php
        $no=1;
        $q_get_peminjaman_detail = mysqli_query($conn, "SELECT * FROM asset_peminjaman_detail JOIN asset_db_general ON asset_peminjaman_detail.general_code = asset_db_general.general_code WHERE peminjaman_id = '$get_peminjaman[id]' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");

        while($get_peminjaman_detail = mysqli_fetch_array($q_get_peminjaman_detail)){
          $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE general_code = '$get_peminjaman_detail[general_code]'"));

          //sudah kirim dari surat jalan (non tidak sesuai)
          $sudahkirim_dari_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sudah_kirim FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_db_detail ON asset_suratjalan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_db_general.general_code = '$get_peminjaman_detail[general_code]' AND asset_suratjalan.status <> 'diterima tapi tidak sesuai' AND peminjaman_id = '$get_peminjaman[id]'"));
      ?>
        <tr data-widget="expandable-table" aria-expanded="false">
          <td width="1%"><?php echo $no; ?></td>
          <td><?php echo $get_db_general['nama_barang']; ?></td>
          <td><?php echo $get_db_general['tipe_barang']; ?></td>
          <td><?php echo $get_db_general['sub_barang']; ?></td>
          <td><?php echo $get_peminjaman_detail ['qty']; ?></td>
          <td><?php echo $get_db_general['satuan']; ?></td>
          <td><?php echo $get_peminjaman_detail['keterangan']; ?></td>
          <td><?php if($sudahkirim_dari_suratjalan['sudah_kirim'] < 1){ echo 0; }else{ echo $sudahkirim_dari_suratjalan['sudah_kirim']; } ?></td>
          <td><?php echo $get_peminjaman_detail ['qty'] - $sudahkirim_dari_suratjalan['sudah_kirim']; ?></td>
        </tr>
        <tr class="expandable-body">
          <td colspan="9">
            <div>
              <table class="table table-sm" style="font-size: 11px; background-color: lightgrey;">
                <tr>
                  <th width="1%">No</th>
                  <th>Nama Barang</th>
                  <th>Tipe Barang</th>
                  <th>Tipe Detail</th>
                  <th width="1%">Satuan</th>
                  <th width="12%">Merek</th>
                  <th width="1%">Stock</th>
                  <th width="1%">Qty</th>
                </tr>

                <?php
                  $no2=1;
                  $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE general_code = '$get_peminjaman_detail[general_code]' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC ");
                  while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                    $get_db_general = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE id = '$get_db_detail[general_code_id]'"));
                    $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_merek WHERE id = '$get_db_detail[merek_id]'"));

                    $get_suratjalan_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_suratjalan_detail WHERE suratjalan_id = '$id' AND detail_code = '$get_db_detail[detail_code]'"));

                    // STOCK DARI REALISASI
                    $get_stock_from_realisasi = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(asset_realisasi.qty) AS total_realisasi FROM asset_realisasi JOIN asset_pengajuan ON asset_realisasi.pengajuan_id = asset_pengajuan.id WHERE asset_realisasi.detail_code = '$get_db_detail[detail_code]' AND asset_pengajuan.status = 'sudah realisasi' AND asset_pengajuan.entitas_id = '$get_suratjalan[entitas_id]'"));

                    //PENGURANG STOCK dari surat jalan
                    $sudahkirim_dari_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sudah_kirim FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id WHERE asset_suratjalan_detail.detail_code = '$get_db_detail[detail_code]' AND asset_suratjalan.entitas_id = '$get_suratjalan[entitas_id]'"));

                    //PENAMBAHAN DARI Pengembalian Approved
                        $pengembalian_approved = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(kembali_baik) AS jml_kembalibaik FROM asset_pengembalian_detail JOIN asset_pengembalian ON asset_pengembalian_detail.pengembalian_id = asset_pengembalian.id WHERE status = 'BA approved' AND detail_code = '$get_db_detail[detail_code]' AND entitas_id = '$get_suratjalan[entitas_id]'"));

                    //ADJUSMENT DARI STOCK OPNAME
                        $total_adjustment = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(adjustment) AS t_adjust FROM asset_stockopname_detail JOIN asset_stockopname ON asset_stockopname_detail.stockopname_id = asset_stockopname.id WHERE detail_code = '$get_db_detail[detail_code]' AND entitas_id = '$get_suratjalan[entitas_id]'"));

                    //DATA ASSET SUDAH DIPERBAIKI
                        $sudah_diperbaiki = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS t_perbaikan FROM asset_perbaikan_realisasi JOIN asset_perbaikan ON asset_perbaikan_realisasi.perbaikan_id = asset_perbaikan.id WHERE asset_perbaikan.status = 'sudah realisasi' AND asset_perbaikan_realisasi.detail_code = '$get_db_detail[detail_code]' AND entitas_id = '$get_suratjalan[entitas_id]'"));

                    $total_stock = $get_stock_from_realisasi['total_realisasi'] - $sudahkirim_dari_suratjalan['sudah_kirim'] + $pengembalian_approved['jml_kembalibaik'] + $total_adjustment['t_adjust'] + $sudah_diperbaiki['t_perbaikan'];
                ?>
                  <tr>
                    <td><?php echo $no2; ?></td>
                    <td><?php echo $get_db_general['nama_barang']; ?></td>
                    <td><?php echo $get_db_general['tipe_barang']; ?></td>
                    <td><?php echo $get_db_detail['tipe_detail']; ?></td>
                    <td><?php echo $get_db_general['satuan']; ?></td>
                    <td><?php echo $get_merek['merek']; ?></td>
                    <td>
                      <?php
                        if($total_stock < 1){
                          echo 0;
                        }else{
                          echo $total_stock; 
                        }
                      ?>
                    </td>
                    <td><input type="number" min="0" max="<?php echo $total_stock; ?>" style="width: 50px" name="qty_<?php echo $get_db_detail['detail_code']; ?>" value="<?php echo $get_suratjalan_detail['qty']; ?>"></td>
                  </tr>
                <?php $no2++; } ?>

              </table>
            </div>
          </td>
        </tr>
      <?php $no++; } ?>

    </tbody>
  </table>

  <div style="text-align: center; margin-bottom: 0px; margin-top: 20px;">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-info" name="simpan_surat_jalan" value="Simpan"><span class="fa fa-save"></span> Simpan Surat Jalan</button>
  </div>
</div>