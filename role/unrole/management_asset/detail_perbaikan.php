<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $get_perbaikan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_perbaikan WHERE id = '$id'"));
    $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_perbaikan[entitas_id]'"));
    $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_perbaikan[pelaksana]'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_perbaikan[kd_project]'"));
  }
?>

  <div class="card-body" style="margin-top: -20px;">
    
    <div class="row">
      <div class="col-12">
        <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
          <tr>
            <td width="20%">No Perbaikan</td>
            <td width="1%">:</td>
            <td>
              <?php echo $id."FIX/MA/".date('m/Y', strtotime($get_perbaikan['tgl_pengajuan'])); ?>
            </td>
          </tr>
          <tr>
            <td width="20%">Nama Pelaksana</td>
            <td width="1%">:</td>
            <td>
              <?php echo $get_karyawan['nama'] ?>
            </td>
          </tr>
          <tr>
            <td>Entitas</td>
            <td>:</td>
            <td><?php echo $get_entitas['entitas']; ?></td>
          </tr>
          <tr>
            <td>Jenis Pengajuan</td>
            <td>:</td>
            <td><span class="badge badge-secondary">Perbaikan</span></td>
          </tr>
          <tr>
            <td>Tanggal Pengajuan</td>
            <td>:</td>
            <td><?php echo date("d F Y", strtotime($get_perbaikan['tgl_pengajuan'])); ?></td>
          </tr>
          <tr>
            <td>Tanggal Realisasi</td>
            <td>:</td>
            <td>
              <?php
                if($get_perbaikan['tgl_realisasi'] == "0000-00-00"){
                  echo "-";
                }else{
                  echo date("d F Y", strtotime($get_perbaikan['tgl_realisasi']));
                }
              ?> 
            </td>
          </tr>
          <tr>
            <td>Project</td>
            <td>:</td>
            <td><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></td>
          </tr>
          <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><?php echo $get_perbaikan['keterangan']; ?></td>
          </tr>
          <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>
              <?php
                if($get_perbaikan['status'] == "belum realisasi"){
                  echo "<div class='badge badge-warning'>Belum Realisasi</div>";
                }else{
                  echo "<div class='badge badge-success'>Sudah Realisasi</div>";
                }
              ?>    
            </td>
          </tr>
        </table>
      </div>

      <div class="col-12">
        <?php if($get_perbaikan['status'] == "belum realisasi"){ ?>
          <table class="table table-sm table-striped" style="font-size: 11px">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tipe</th>
                <th>Tipe Detail</th>
                <th>Merek</th>
                <th width="5%">Qty</th>
                <th width="1%">Satuan</th>
                <th width="8%">Harga Satuan</th>
                <th width="8%">Harga Total</th>
                <th width="12%">Keterangan Perbaikan</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no=1;
                $total_harga = 0;
                $q_get_asset_perbaikan_detail = mysqli_query($conn, "SELECT * FROM asset_perbaikan_detail JOIN asset_db_detail ON asset_perbaikan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE asset_perbaikan_detail.perbaikan_id = '$id' ORDER BY asset_db_general.nama_barang, asset_db_general.tipe_barang ASC");
                while($get_asset_perbaikan_detail = mysqli_fetch_array($q_get_asset_perbaikan_detail)){
              ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $get_asset_perbaikan_detail['nama_barang']; ?></td>
                      <td><?php echo $get_asset_perbaikan_detail['tipe_barang']; ?></td>
                      <td><?php echo $get_asset_perbaikan_detail['tipe_detail']; ?></td>
                      <td><?php echo $get_asset_perbaikan_detail['merek']; ?></td>
                      <td><?php echo $get_asset_perbaikan_detail['qty']; ?></td>
                      <td><?php echo $get_asset_perbaikan_detail['satuan']; ?></td>
                      <td><?php echo "Rp ".number_format($get_asset_perbaikan_detail['harga_satuan'], 0, ',', '.'); ?></td>
                      <td>
                        <?php
                          $harga_total = $get_asset_perbaikan_detail['qty']*$get_asset_perbaikan_detail['harga_satuan'];
                          echo "Rp ".number_format($harga_total, 0, ',', '.');
                        ?>
                        </td>
                      <td><?php echo $get_asset_perbaikan_detail['keterangan']; ?></td>
                    </tr>
              <?php $total_harga = $total_harga+$harga_total; $no++; } ?>

                    <tr style="background-color: yellow; font-weight: bold;">
                      <td colspan="8" align="center">TOTAL HARGA</td>
                      <td colspan="3"><?php echo "Rp ".number_format($total_harga, 0, ',', '.'); ?></td>
                    </tr>
            </tbody>
          </table>

        <?php }elseif($get_perbaikan['status'] == "sudah realisasi"){ ?>

          <table class="table table-sm table-striped" style="font-size: 11px">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Tipe</th>
                <th>Tipe Detail</th>
                <th>Merek</th>
                <th width="5%">Qty</th>
                <th width="1%">Satuan</th>
                <th width="8%">Harga Total</th>
                <th width="5%" style="background-color: lightgray;">Qty Realisasi</th>
                <th width="8%" style="background-color: lightgray;">Realisasi Satuan</th>
                <th width="8%" style="background-color: lightgray;">Total Realisasi</th>
                <th width="8%" style="background-color: lightgray;">Sisa Uang</th>
                <th width="12%">Keterangan Perbaikan</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no=1;
                $total_harga = 0;
                $total_realisasi = 0;
                $total_sisa_uang = 0;
                $q_get_perbaikan_realisasi = mysqli_query($conn, "SELECT * FROM asset_perbaikan_realisasi JOIN asset_db_detail ON asset_perbaikan_realisasi.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE asset_perbaikan_realisasi.perbaikan_id = '$id' ORDER BY asset_db_general.nama_barang, asset_db_general.tipe_barang ASC");
                while($get_perbaikan_realisasi = mysqli_fetch_array($q_get_perbaikan_realisasi)){
                  $get_perbaikan_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_perbaikan_detail WHERE perbaikan_id = '$id' AND detail_code = '$get_perbaikan_realisasi[detail_code]'"));
              ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $get_perbaikan_realisasi['nama_barang']; ?></td>
                      <td><?php echo $get_perbaikan_realisasi['tipe_barang']; ?></td>
                      <td><?php echo $get_perbaikan_realisasi['tipe_detail']; ?></td>
                      <td><?php echo $get_perbaikan_realisasi['merek']; ?></td>
                      <td><?php if($get_perbaikan_detail['qty']==""){ echo 0; }else{ echo $get_perbaikan_detail['qty']; }; ?></td>
                      <td><?php echo $get_perbaikan_realisasi['satuan']; ?></td>
                      <td>
                        <?php
                          $harga_total = $get_perbaikan_detail['qty']*$get_perbaikan_detail['harga_satuan'];
                          echo "Rp ".number_format($harga_total, 0, ',', '.');
                        ?>
                      </td>
                      <td><?php echo $get_perbaikan_realisasi['qty']; ?></td>
                      <td><?php echo "Rp ".number_format($get_perbaikan_realisasi['harga_satuan'],0,',','.'); ?></td>
                      <td>
                        <?php
                          $realisasi_total = $get_perbaikan_realisasi['qty']*$get_perbaikan_realisasi['harga_satuan'];
                          echo "Rp ".number_format($realisasi_total,0,',','.');
                        ?>
                      </td>
                      <td>
                        <?php
                          $sisa_uang = $harga_total-$realisasi_total;
                          echo "Rp ".number_format($sisa_uang,0,',','.');
                        ?>
                      </td>
                      <td><?php echo $get_perbaikan_detail['keterangan']; ?></td>
                    </tr>
              <?php
                  $total_harga = $total_harga+$harga_total;
                  $total_realisasi = $total_realisasi+$realisasi_total;
                  $total_sisa_uang = $total_sisa_uang+$sisa_uang;
                  $no++; 
                }
              ?>

                    <tr style="background-color: yellow; font-weight: bold;">
                      <td colspan="7" align="center">TOTAL HARGA</td>
                      <td><?php echo "Rp ".number_format($total_harga, 0, ',', '.'); ?></td>
                      <td colspan="2"></td>
                      <td><?php echo "Rp ".number_format($total_realisasi, 0, ',', '.'); ?></td>
                      <td><?php echo "Rp ".number_format($total_sisa_uang, 0, ',', '.'); ?></td>
                      <td></td>
                    </tr>
            </tbody>
          </table>

        <?php } ?>
      </div>
    </div>

    <div class="row">
      <div class="col-12" style="text-align: center;">
        
          <?php if($get_perbaikan['status'] == "belum realisasi"){ ?>
            <a href="index.php?pages=editpengajuanperbaikan&id=<?php echo $id; ?>">
              <div class="btn btn-secondary"><span class="fa fa-edit"></span> Edit Pengajuan</div>
            </a>

            <a href="../unrole/management_asset/cetak_pengajuan_perbaikan.php?id=<?php echo $id; ?>" target="_blank">
              <div class="btn btn-info"><span class="fa fa-download"></span> Cetak / Download</div>
            </a>

            <a href="index.php?pages=formrealisasiperbaikan&id=<?php echo $id; ?>">
              <div class="btn btn-success"><span class="fa fa-pencil"></span> Input Realisasi</div>
            </a>
          <?php }elseif($get_perbaikan['status'] == "sudah realisasi"){ ?>
            <input type="hidden" name="perbaikan_id" value="<?php echo $id; ?>">
            <input type="hidden" name="no_perbaikan" value="<?php echo $id."FIX/MA/".date('m/Y', strtotime($get_perbaikan['tgl_pengajuan'])); ?>">
            <button type="submit" class="btn btn-danger" name="delete_realisasi_perbaikan" value="delete" onclick="return confirm('Yakin delete realisasi pada pengajuan ini?')">
              <span class="fa fa-trash"></span> Delete Realisasi
            </button>

            <a href="../unrole/management_asset/cetak_pengajuan_perbaikan.php?id=<?php echo $id; ?>" target="_blank">
              <div class="btn btn-info"><span class="fa fa-download"></span> Cetak / Download</div>
            </a>

            <a href="index.php?pages=formrealisasiperbaikan&id=<?php echo $id; ?>">
              <div class="btn btn-warning"><span class="fa fa-edit"></span> Edit Realisasi</div>
            </a>
          <?php } ?>
     
      </div>
    </div>

  </div>