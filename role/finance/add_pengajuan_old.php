<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];

    $getHariLibur = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM harilibur WHERE id = '$id'"));
    $getHariLibur['keterangan'] = substr($getHariLibur['keterangan'], 3);
    $getHariLibur['keterangan'] = substr($getHariLibur['keterangan'],0,-4);
  }
?>


    <!-- Horizontal Form -->
      <!-- /.card-header -->
      <!-- form start -->
      <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listpengajuan" style="font-size: 12px;">
        <table width="100%" cellpadding="5px">
          <tr>
            <td width="20%" style="font-weight: bold;">No NPB</td>
            <td width="2%">:</td>
            <td><input type="text" name="no_npb" placeholder="No NPB" class="form-control form-control-sm" required></td>
          </tr>
          <tr>
            <td width="20%" style="font-weight: bold;">No Adendum</td>
            <td width="2%">:</td>
            <td><input type="text" name="no_adendum" placeholder="No Adendum (Optional)" class="form-control form-control-sm"></td>
          </tr>
          <tr>
            <td style="font-weight: bold;">Badan</td>
            <td>:</td>
            <td>
              <select name="badan" class="form-control form-control-sm" required>
                <option value="" disabled selected>-- Pilih Badan --</option>
                <option value="GPP">GPP</option>
                <option value="GPW">GPW</option>
                <option value="GPS">GPS</option>
                <option value="GSS">GSS</option>
                <option value="SI">SI</option>
              </select>
            </td>
          </tr>
          <tr>
            <td style="font-weight: bold;">Divisi</td>
            <td>:</td>
            <td>
              <select name="divisi" class="form-control form-control-sm" required>
                <option value="" disabled selected>-- Semua Divisi --</option>
                <option value="Keuangan">Keuangan</option>
                <option value="Logistik">Logistik</option>
                <option value="Engineering">Engineering</option>
                <option value="Marketing">Marketing</option>
                <option value="Asset">Asset</option>
                <option value="SDM">SDM</option>
                <option value="IT">IT</option>
                <option value="HSE">HSE</option>
              </select>
            </td>
          </tr>
          <tr>
            <td width="20%" style="font-weight: bold;">Tanggal</td>
            <td width="2%">:</td>
            <td><input type="date" name="tanggal" placeholder="Tanggal Pengajuan" class="form-control form-control-sm" style="width: 50%;" required></td>
          </tr>
          <tr>
            <td style="font-weight: bold;">Kategori</td>
            <td>:</td>
            <td>
              <select name="kategori" class="form-control form-control-sm" required>
                <option value="" selected disabled>-- Pilih Kategori --</option>
                <option value="Project">Project</option>
                <option value="Rutin">Rutin</option>
                <option value="Non-Rutin">Non-Rutin</option>
              </select>
            </td>
          </tr>
          <tr>
            <td width="20%" style="font-weight: bold;">Kode Project</td>
            <td width="2%">:</td>
            <td><input type="text" name="kode_project" placeholder="Kode Project (optional)" class="form-control form-control-sm" required></td>
          </tr>
          <tr>
            <td style="font-weight: bold;">Pelaksana</td>
            <td>:</td>
            <td>
              <select name="pelaksana" class="form-control form-control-sm" required>
                <option value="" disabled selected>-- Pilih Pelaksana --</option>
                <?php
                  $q_getKaryawan = mysqli_query($conn,"SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");
                  while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                ?>
                  <option value="<?php echo $get_karyawan['nik']; ?>"><?php echo $get_karyawan['nama']; ?></option>
                <?php } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td width="20%" style="font-weight: bold;">Keterangan / Keperluan</td>
            <td width="2%">:</td>
            <td><textarea name="keterangan" placeholder="Keterangan / Keperluan" class="form-control form-control-sm" required></textarea></td>
          </tr>
          <tr>
            <td width="20%" style="font-weight: bold;">Nominal</td>
            <td width="2%">:</td>
            <td><input type="text" step="0.001" name="nominal" class="form-control form-control-sm" required></td>
          </tr>
          <tr>
            <td style="font-weight: bold;">Approved</td>
            <td>:</td>
            <td>
              <select name="approved" class="form-control form-control-sm" required>
                <option value="" disabled selected>-- Pilih Approved --</option>
                <option value="Sudah">Sudah</option>
                <option value="Belum">Belum</option>
              </select>
            </td>
          </tr>
        </table>
        <!-- /.card-body -->
        <div class="card-footer">
          <input type="submit" class="btn btn-primary float-right" name="submit_add_pengajuan" value="Submit">
        </div>
        <!-- /.card-footer -->
      </form>
    <!-- /.card -->
  </div>
  <!-- /.card -->