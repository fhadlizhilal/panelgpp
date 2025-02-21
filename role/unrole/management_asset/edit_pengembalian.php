<?php
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $pengembalian_id = $_POST['getID'];
    $get_pengembalian = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengembalian JOIN project ON asset_pengembalian.kd_project = project.kd_project JOIN karyawan ON asset_pengembalian.penanggungjawab = karyawan.nik JOIN asset_db_entitas ON asset_pengembalian.entitas_id = asset_db_entitas.id WHERE asset_pengembalian.id = '$pengembalian_id'"));
    $kd_project = $get_pengembalian['kd_project'];
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    <div class="row">
      <div class="col-lg-6 col-12">
        <table class="table table-sm" style="font-size: 11px">
          <tr>
            <td width="25%">No Pengembalian</td>
            <td width="1%">:</td>
            <td><?php echo "RTN".$pengembalian_id."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
          </tr>
          <tr>
            <td width="25%">Kode Project</td>
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
                $q_get_peminjam = mysqli_query($conn, "SELECT DISTINCT peminjam FROM asset_peminjaman WHERE kd_project = '$get_pengembalian[kd_project]' AND status = 'on progress by MA'");
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
            <td width="25%">Entitas Peminjam</td>
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
            <td width="25%">Penanggung Jawab</td>
            <td>:</td>
            <td><?php echo $get_pengembalian['nama']; ?></td>
          </tr>
          <tr>
            <td width="25%">Entitas Pengembalian</td>
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

    <div class="table-responsive p-0" style="height: 320px;">
      <table class="table table-sm table-head-fixed table-hover" style="font-size: 11px">
        <thead>
          <tr>
            <th width="1%" style="vertical-align: bottom;">No</th>
            <th style="vertical-align: bottom;">Nama Barang</th>
            <th style="vertical-align: bottom;">Tipe Barang</th>
            <th style="vertical-align: bottom;">Tipe Detail</th>
            <th style="vertical-align: bottom;">Merek</th>
            <th width="8%" style="vertical-align: bottom;">Sub Barang</th>
            <th width="1%" style="text-align: center;">Qty Pinjam</th>
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
          $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id ORDER BY nama_barang ASC, tipe_barang ASC");
          while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
            $qty_pinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS qty_pinjam FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE asset_peminjaman.kd_project = '$kd_project' AND asset_suratjalan_detail.detail_code = '$get_db_detail[detail_code]'"));
            $get_pengembalian_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengembalian_detail WHERE pengembalian_id = '$pengembalian_id' AND detail_code = '$get_db_detail[detail_code]'"));
        ?>
            <tbody>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $get_db_detail['nama_barang']; ?></td>
                <td><?php echo $get_db_detail['tipe_barang']; ?></td>
                <td><?php echo $get_db_detail['tipe_detail']; ?></td>
                <td><?php echo $get_db_detail['merek']; ?></td>
                <td><?php echo $get_db_detail['sub_barang']; ?></td>
                <td align="center"><?php echo $qty_pinjam['qty_pinjam']; ?></td>
                <td><?php echo $get_db_detail['satuan']; ?></td>
                <td>
                  <input type="number" style="width: 50px" min="0" name="baik_<?php echo $get_db_detail['detail_code']; ?>" value="<?php if($get_pengembalian_detail['kembali_baik']>0){ echo $get_pengembalian_detail['kembali_baik']; } ?>">
                </td>
                <td>
                  <input type="number" style="width: 50px" min="0" name="habis_<?php echo $get_db_detail['detail_code']; ?>" value="<?php if($get_pengembalian_detail['habis']>0){ echo $get_pengembalian_detail['habis']; } ?>" <?php if($get_db_detail['sub_barang'] == "Continue"){ echo "disabled"; } ?>>
                </td>
                <td>
                  <input type="number" style="width: 50px" min="0" name="rusaksebagian_<?php echo $get_db_detail['detail_code']; ?>" value="<?php if($get_pengembalian_detail['rusak_sebagian']>0){ echo $get_pengembalian_detail['rusak_sebagian']; } ?>">
                </td>
                <td>
                  <input type="number" style="width: 50px" min="0" name="rusak_<?php echo $get_db_detail['detail_code']; ?>" value="<?php if($get_pengembalian_detail['rusak_total']>0){ echo $get_pengembalian_detail['rusak_total']; } ?>">
                </td>
                <td>
                  <input type="number" style="width: 50px" min="0" name="hilang_<?php echo $get_db_detail['detail_code']; ?>" value="<?php if($get_pengembalian_detail['hilang']>0){ echo $get_pengembalian_detail['hilang']; } ?>">
                </td>
              </tr>
            </tbody>
        <?php $no++; } ?>
      </table>
    </div>
  </div>
  <div class="card-footer" style="text-align: center;">
    <input type="hidden" name="pengembalian_id" value="<?php echo $pengembalian_id; ?>">
    <button type="submit" class="btn btn-info btn-sm" name="edit_pengembalian" value="edit" onclick="return confirm('Yakin ubah pengembalian ini?')"><span class="fa fa-save"></span> Simpan</button>
  </div>