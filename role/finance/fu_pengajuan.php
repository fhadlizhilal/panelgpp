<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getPengajuanList = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE id = '$id'"));
    $getPertanggungjawabanList = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$getPengajuanList[no_npb]'"));

    //------ Selisih Hari ------------------
    $tgl1 = strtotime($getPengajuanList['tgl_pengajuan']); 
    $tgl2 = strtotime(date('Y-m-d'));
    $jarak = $tgl2 - $tgl1;
    $hari = $jarak / 60 / 60 / 24;

    //------ Selisih LPJ ------------------
    $tgl1LPJ = strtotime($getPengajuanList['tgl_pengajuan']); 
    $tgl2LPJ = strtotime($getPertanggungjawabanList['tanggal']);
    $jarakLPJ = $tgl2LPJ - $tgl1LPJ;
    $hariLPJ = $jarakLPJ / 60 / 60 / 24;
  }
?>

    <div class="row">
      <div class="col-6">
        <div align="center" style="font-weight: bold;">PENGAJUAN</div><br>
        <?php if($_POST['getID2'] == "Show"){ ?>
          <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?filterbadan=<?php echo $_POST['FILTERBADAN']; ?>&filterdivisi=<?php echo $_POST['FILTERDIVISI']; ?>&filterkategori=<?php echo $_POST['FILTERKATEGORI']; ?>&filterpelaksana=<?php echo $_POST['FILTERPELAKSANA']; ?>&filterstatus=<?php echo $_POST['FILTERSTATUS']; ?>&filterproject=<?php echo $_POST['FILTERPROJECT']; ?>&pages=listpengajuan&Filter=Show" style="font-size: 12px;">
        <?php }else{ ?>
          <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listpengajuan" style="font-size: 12px;">
        <?php } ?>
          <table id="setHariLibur1" class="table table-sm" style="font-size: 10px;" width="100%">
            <tr>
              <td width="22%">No NPB</td>
              <td width="1%">:</td>
              <td width=""><input type="text" name="no_npb" value="<?php echo $getPengajuanList['no_npb']; ?>" style="width: 100%;" required></td>
            </tr>
            <tr>
              <td width="22%">No Adendum</td>
              <td width="1%">:</td>
              <td width=""><input type="text" name="no_adendum" value="<?php echo $getPengajuanList['no_adendum']; ?>" style="width: 100%;"></td>
            </tr>
            <tr>
              <td>Badan</td>
              <td>:</td>
              <td>
                <select name="badan" style="width: 50%;" required>
                  <option value="" disabled selected>-- Pilih Badan --</option>
                  <option value="GPP" <?php if($getPengajuanList['badan'] == "GPP"){ echo "selected"; } ?>>GPP</option>
                  <option value="GPW" <?php if($getPengajuanList['badan'] == "GPW"){ echo "selected"; } ?>>GPW</option>
                  <option value="GPS" <?php if($getPengajuanList['badan'] == "GPS"){ echo "selected"; } ?>>GPS</option>
                  <option value="GSS" <?php if($getPengajuanList['badan'] == "GSS"){ echo "selected"; } ?>>GSS</option>
                  <option value="SI" <?php if($getPengajuanList['badan'] == "SI"){ echo "selected"; } ?>>SI</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Divisi</td>
              <td>:</td>
              <td>
                <select name="divisi" style="width: 50%;" required>
                  <option value="" disabled selected>-- Semua Divisi --</option>
                  <option value="Keuangan" <?php if($getPengajuanList['divisi'] == "Keuangan"){ echo "selected"; } ?>>Keuangan</option>
                  <option value="Logistik" <?php if($getPengajuanList['divisi'] == "Logistik"){ echo "selected"; } ?>>Logistik</option>
                  <option value="Engineering" <?php if($getPengajuanList['divisi'] == "Engineering"){ echo "selected"; } ?>>Engineering</option>
                  <option value="Marketing" <?php if($getPengajuanList['divisi'] == "Marketing"){ echo "selected"; } ?>>Marketing</option>
                  <option value="Asset" <?php if($getPengajuanList['divisi'] == "Asset"){ echo "selected"; } ?>>Asset</option>
                  <option value="SDM" <?php if($getPengajuanList['divisi'] == "SDM"){ echo "selected"; } ?>>SDM</option>
                  <option value="IT" <?php if($getPengajuanList['divisi'] == "IT"){ echo "selected"; } ?>>IT</option>
                  <option value="HSE" <?php if($getPengajuanList['divisi'] == "HSE"){ echo "selected"; } ?>>HSE</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Jenis</td>
              <td>:</td>
              <td>
                <select name="jenis" style="width: 50%;" required>
                  <option value="" disabled selected>-- Pilih Jenis --</option>
                  <option value="Barang" <?php if($getPengajuanList['jenis'] == "Barang"){ echo "selected"; } ?>>Barang</option>
                  <option value="Jasa" <?php if($getPengajuanList['jenis'] == "Jasa"){ echo "selected"; } ?>>Jasa</option>
                  <option value="Asset" <?php if($getPengajuanList['jenis'] == "Asset"){ echo "selected"; } ?>>Asset</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Tanggal</td>
              <td>:</td>
              <td><input type="date" name="tanggal" value="<?php echo $getPengajuanList['tgl_pengajuan']; ?>" style="width: 50%;" required></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td>:</td>
              <td>
                <select name="kategori" style="width: 50%;" required>
                  <option value="" selected disabled>-- Pilih Kategori --</option>
                  <option value="Project" <?php if($getPengajuanList['kategori'] == "Project"){ echo "selected"; } ?>>Project</option>
                  <option value="Rutin" <?php if($getPengajuanList['kategori'] == "Rutin"){ echo "selected"; } ?>>Rutin</option>
                  <option value="Non-Rutin" <?php if($getPengajuanList['kategori'] == "Non-Rutin"){ echo "selected"; } ?>>Non-Rutin</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Kode Project</td>
              <td>:</td>
              <td>
                <select name="kode_project" style="width: 100%;" required>
                  <option value="Lainnya" selected>Lainnya (Non Project)</option>
                  <option value="" disabled>-- Pilih Kode Project --</option>
                  
                  <?php
                    $lain2 = 0;
                  ?>

                  <option value="" disabled>--------------- GPP ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                  <option value="" disabled>--------------- GPS ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                  <option value="" disabled>--------------- GPW ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPW' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                  <option value="" disabled>--------------- GSS ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                  <option value="" disabled>--------------- SI ------------------</option>
                  <?php
                    $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                    while($get_project = mysqli_fetch_array($q_get_project)){
                  ?>
                      <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td><input type="text" name="deskripsi" placeholder="Isi jika Kode Project Lainnya (Non Project)" style="width: 100%" value="<?php if($lain2 == 0){ echo $getPengajuanList['kode_project']; } ?>"></td>
            </tr>
            <tr>
              <td>Pelaksana</td>
              <td>:</td>
              <td>
                <select name="pelaksana" style="width: 100%;" required>
                  <option value="" disabled selected>-- Pilih Pelaksana --</option>
                  <?php
                    $q_getKaryawan = mysqli_query($conn,"SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");
                    while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                  ?>
                    <option value="<?php echo $get_karyawan['nik']; ?>" <?php if($getPengajuanList['pelaksana'] == $get_karyawan['nik']){ echo "selected"; } ?>><?php echo $get_karyawan['nama']; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td>Keterangan</td>
              <td>:</td>
              <td>
                <textarea name="keterangan" placeholder="Keterangan / Keperluan" style="width: 100%;" required><?php echo $getPengajuanList['keterangan']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td>Nominal</td>
              <td>:</td>
              <td>
                <?php
                  $getPengajuanList['nilai'] = number_format($getPengajuanList['nilai'],0,',','.');
                ?>
                <input type="text" oninput="formatInput(this)" name="nominal" value="<?php echo $getPengajuanList['nilai']; ?>" style="width: 50%;" required>
              </td>
            </tr>
            <tr>
              <td>Approved</td>
              <td>:</td>
              <td>
                <select name="approved" style="width: 50%;" required>
                  <option value="" disabled selected>-- Pilih Approved --</option>
                  <option value="Sudah" <?php if($getPengajuanList['approved'] == "Sudah"){ echo "selected"; } ?>>Sudah</option>
                  <option value="Belum" <?php if($getPengajuanList['approved'] == "Belum"){ echo "selected"; } ?>>Belum</option>
                </select>
              </td>
            </tr>
          </table>
          <center>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" class="btn btn-secondary center btn-sm" name="submit_edit_pengajuan" value="Simpan">
            <input type="submit" class="btn btn-danger center btn-sm" name="submit_delete_pengajuan" value="Delete" onclick="return confirm('Yakin Delete Pengajuan ini ? (Pertanggungjawaban juga akan otomatis terhapus)')">
          </center>
        </form>
      </div>

      <?php
        $q_getLPJ = mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$getPengajuanList[no_npb]'");
        $cek_LPJ = mysqli_num_rows($q_getLPJ);
        if($cek_LPJ > 0 ){
      ?>
        <div class="col-6">
          <div align="center" style="font-weight: bold;">PERTANGGUNGJAWABAN</div><br>
          <?php if($_POST['getID2'] == "Show"){ ?>
            <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?filterbadan=<?php echo $_POST['FILTERBADAN']; ?>&filterdivisi=<?php echo $_POST['FILTERDIVISI']; ?>&filterkategori=<?php echo $_POST['FILTERKATEGORI']; ?>&filterpelaksana=<?php echo $_POST['FILTERPELAKSANA']; ?>&filterstatus=<?php echo $_POST['FILTERSTATUS']; ?>&filterproject=<?php echo $_POST['FILTERPROJECT']; ?>&pages=listpengajuan&Filter=Show" style="font-size: 12px;">
          <?php }else{ ?>
            <form method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listpengajuan" style="font-size: 12px;">
          <?php } ?>
            <table id="setHariLibur1" class="table table-sm" style="font-size: 10px;">
              <tr>
                <td width="22%">Status</td>
                <td width="1%">:</td>
                <td><span class="badge badge-success" style="font-size: 10px;">Sudah Pertanggungjawaban</span></td>
              </tr>
              <tr>
                <td width="22%">Due Date</td>
                <td width="1%">:</td>
                <td><?php echo $hariLPJ." Hari setelah pengajuan"; ?></td>
              </tr>
            </table>
            <table id="setHariLibur1" class="table table-sm" style="font-size: 10px;">
              <tr> 
                <td width="22%">No NPB</td>
                <td width="1%">:</td>
                <td><?php echo $getPertanggungjawabanList['no_npb']; ?></td>
              </tr>
              <tr>
                <td>Realisasi</td>
                <td>:</td>
                <td>
                  <?php
                    $getPertanggungjawabanList['jml_realisasi'] = number_format($getPertanggungjawabanList['jml_realisasi'],0,',','.');
                  ?>
                  <input type="text" oninput="formatInput(this)" name="realisasi" value="<?php echo $getPertanggungjawabanList['jml_realisasi']; ?>" style="width: 100%;">
                </td>
              </tr>
              <tr>
                <td>Selisih</td>
                <td>:</td>
                <td><?php echo "Rp " . number_format($getPertanggungjawabanList['selisih'], 0, ",", "."); ?></td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><input type="date" name="tanggal" value="<?php echo $getPertanggungjawabanList['tanggal']; ?>" style="width: 50%;"></td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea name="keterangan" style="width: 100%;"><?php echo $getPertanggungjawabanList['keterangan']; ?></textarea></td>
              </tr>
            </table>
            <center>
              <input type="hidden" name="no_npb" value="<?php echo $getPertanggungjawabanList['no_npb']; ?>">
              <input type="hidden" name="nilai_pengajuan" value="<?php echo $getPengajuanList['nilai']; ?>">
              <input type="submit" class="btn btn-secondary btn-sm" name="submit_edit_pertanggungjawaban" value="Simpan">
              <input type="submit" class="btn btn-danger btn-sm" name="submit_delete_pertanggungjawaban" value="Delete" onclick="return confirm('Yakin Delete Pertanggungjawaban ini ?')">
            </center>
          </form>
        </div>
      <?php }else{ ?>
        <div class="col-6">
          <div align="center" style="font-weight: bold;">PERTANGGUNGJAWABAN</div><br>
          <?php if($_POST['getID2'] == "Show"){ ?>
            <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?filterbadan=<?php echo $_POST['FILTERBADAN']; ?>&filterdivisi=<?php echo $_POST['FILTERDIVISI']; ?>&filterkategori=<?php echo $_POST['FILTERKATEGORI']; ?>&filterpelaksana=<?php echo $_POST['FILTERPELAKSANA']; ?>&filterstatus=<?php echo $_POST['FILTERSTATUS']; ?>&filterproject=<?php echo $_POST['FILTERPROJECT']; ?>&pages=listpengajuan&Filter=Show" style="font-size: 12px;">
          <?php }else{ ?>
            <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listpengajuan" style="font-size: 12px;">
          <?php } ?>
            <table id="setHariLibur1" class="table table-sm" style="font-size: 10px;">
              <tr>
                <td width="22%">Status</td>
                <td width="1%">:</td>
                <td>
                  <?php if($hari >= 14){ ?>
                    <span class="badge badge-danger" style="font-size: 10px;">Belum Melakukan Pertanggungjawaban</span>
                  <?php }else{ ?>
                    <span class="badge badge-warning" style="font-size: 10px;">Belum Melakukan Pertanggungjawaban</span>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td width="22%">Due Date</td>
                <td width="1%">:</td>
                <td><?php echo $hari." Hari setelah pengajuan"; ?></td>
              </tr>
            </table>
            <table id="setHariLibur1" class="table table-sm" style="font-size: 10px;">
              <tr> 
                <td width="22%">No NPB</td>
                <td width="1%">:</td>
                <td><?php echo $getPengajuanList['no_npb']; ?></td>
              </tr>
              <tr>
                <td>Realisasi</td>
                <td>:</td>
                <td>
                  <input type="text" oninput="formatInput(this)" name="realisasi" style="width: 100%;">
                </td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><input type="date" name="tanggal" style="width: 50%;"></td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td><textarea name="keterangan" style="width: 100%;"></textarea></td>
              </tr>
            </table>
            <center>
              <input type="hidden" name="nilai_pengajuan" value="<?php echo $getPengajuanList['nilai']; ?>">
              <input type="hidden" name="no_npb" value="<?php echo $getPengajuanList['no_npb']; ?>">
              <input type="submit" class="btn btn-secondary btn-sm" name="submit_pertanggungjawaban" value="Submit">
            </center>
          </form>
        </div>
      <?php } ?>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->