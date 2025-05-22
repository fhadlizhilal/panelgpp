<style>
    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .preview-box {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        max-width: 140px;
    }
    .preview-box img {
        max-width: 100%;
        height: auto;
        margin-bottom: 10px;
    }
</style>
<script>
    function handleFiles(input) {
        const container = document.getElementById('preview-container');
        container.innerHTML = ''; // Clear preview sebelumnya

        const files = input.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            if (file.type.startsWith("image/")) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.classList.add('preview-box');
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" style="height: 100px">
                        <p><div style="font-weight: bold; font-size: 10px">${file.name}</div></p>
                        <input type="text" style="width: 120px" name="keterangan[]" placeholder="Keterangan untuk ${file.name}" required>
                    `;
                    container.appendChild(div);
                };

                reader.readAsDataURL(file);
            }
        }
    }
</script>

<?php
  date_default_timezone_set("Asia/Jakarta");
  $get_inspeksilist = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE id = '$_GET[kd]'"));
  $data_array = explode("/", $get_inspeksilist['kd_weekly']);
  $week = $data_array[1];
  $kd_project = $data_array[2];
  $datetime_now = date("Y-m-d H:i:s");

  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$kd_project'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inspeksilist[hse_officer]'"));

  if(isset($_POST['add_data_bordc'])){
    if($_POST['add_data_bordc'] == "Tambah Data Bor DC"){
      $add_data_bordc = mysqli_query($conn, "INSERT INTO hse_inspeksilist_detailbordc VALUES ('', '$_POST[inspeksi_id]', '$_POST[merek_tipe]', '$_POST[point_1]', '$_POST[point_2]', '$_POST[point_3]', '$_POST[point_4]', '$_POST[point_5]', '$_POST[point_6]', '$_POST[point_7]', '$_POST[point_8]', '$_POST[point_9]', '$_POST[hasil_akhir]', '$datetime_now')");

      if($add_data_bordc){
        $_SESSION['alert_success'] = "Berhasil! Data Bor DC Berhasil ditambah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Bor DC gagal ditambah";
      }
    }
  }

  if(isset($_POST['submit_inspeksi_bordc'])){
    if($_POST['submit_inspeksi_bordc'] == "submit"){
      $submit_inspeksi_bordc = mysqli_query($conn, "UPDATE hse_inspeksilist SET status = 'completed' WHERE id = '$_POST[inspeksi_id]'");
      $_SESSION['alert_success'] = "Berhasil! Inspeksi Bor DC Berhasil disubmit";

      if($submit_inspeksi_bordc){
        $_SESSION['alert_success'] = "Berhasil! Inspeksi Bor DC Berhasil disubmit";
        echo "<meta http-equiv='refresh' content='0; url=index.php?pages=detailproject&kd=$kd_project'>";
      }else{
        $_SESSION['alert_error'] = "Gagal! Inspeksi Bor DC Gagal disubmit";
      }
    }
  }

  if(isset($_POST['edit_data_bordc'])){
    if($_POST['edit_data_bordc'] == "Simpan Data Bor DC"){
      $edit_data_inspeksi_bordc = mysqli_query($conn, "UPDATE hse_inspeksilist_detailbordc SET merek_tipe = '$_POST[merek_tipe]', point_1 = '$_POST[point_1]', point_2 = '$_POST[point_2]', point_3 = '$_POST[point_3]', point_4 = '$_POST[point_4]', point_5 = '$_POST[point_5]', point_6 = '$_POST[point_6]', point_7 = '$_POST[point_7]', point_8 = '$_POST[point_8]', point_9 = '$_POST[point_9]', hasil_akhir = '$_POST[hasil_akhir]', tgl_submit = '$datetime_now' WHERE id = '$_POST[id_detail_bordc]'");

      if($edit_data_inspeksi_bordc){
        $_SESSION['alert_success'] = "Berhasil! Inspeksi Bor DC Berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Inspeksi Bor DC Gagal diubah";
      }
    }
  }

  if(isset($_POST['delete_data_bordc'])){
    if($_POST['delete_data_bordc'] == "Delete Data Bor DC"){
      $delete_data_inspeksi_bordc = mysqli_query($conn, "DELETE FROM hse_inspeksilist_detailbordc WHERE id = '$_POST[id_detail_bordc]'");

      if($delete_data_inspeksi_bordc){
        $_SESSION['alert_success'] = "Berhasil! Data Bor DC Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Bor DC Gagal dihapus";
      }
    }
  }

  if(isset($_POST['add_dokumentasi_inspeksibordc'])){
    if($_POST['add_dokumentasi_inspeksibordc'] == "Simpan"){
      $uploadPath = "../../role/HSE/foto_inspeksi_bordc/";

      // jika form upload file sudah di submit :
      $status = $statusMsg = ''; 
      if(!empty($_FILES["file"]["name"])){
          // File info 
          $nodate = date('YmdHis');
          $fileName = $nodate."_".basename($_FILES["file"]["name"]);
          $imageUploadPath = $uploadPath . $fileName;
          $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
            
          // Tipe format yang diperbolehkan 
          $allowTypes = array('jpg','png','jpeg','gif');
          if(in_array($fileType, $allowTypes)){
              // Image temp source 
              $imageTemp = $_FILES["file"]["tmp_name"]; 
                
              // Ukuran Kompresi 60 (bisa diganti dengan yang lain)
              $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
                
              if($compressedImage){
                $push_dokumentasi_inspeksibordc = mysqli_query($conn, "INSERT INTO hse_inspeksilist_fotobordc VALUES('','$_POST[inspeksi_id]','$fileName','$_POST[keterangan]')");

                if($push_dokumentasi_inspeksibordc){
                  $_SESSION['alert_success'] = "Berhasil! Dokumentasi Inspeksi Bor DC Berhasil Ditambahkan";
                }else{
                  unlink("../../role/HSE/foto_inspeksi_bordc/".$fileName);
                  $_SESSION['alert_error'] = "Gagal! Dokumentasi Gagal ditambahkan <br>".mysqli_error($conn);
                }
              }else{ 
                unlink("../../role/HSE/foto_inspeksi_bordc/".$fileName);
                $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
              } 
          }else{
            unlink("../../role/HSE/foto_inspeksi_bordc/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
          } 
      }else{
        $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
      } 
    }
  }

  if(isset($_POST['add_dokumentasi_inspeksibordc_v2'])){
    if($_POST['add_dokumentasi_inspeksibordc_v2'] == "Upload"){
      $jml_uploaddokumentasi_berhasil = 0;
      $jml_uploaddokumentasi_gagal = 0;
      $nodate = date('YmdHis');
      $inspeksi_id = $_POST['inspeksi_id'];
      $target_dir = "../../role/HSE/foto_inspeksi_bordc/";

      $total = count($_FILES['gambar']['name']);
      $keterangan = $_POST['keterangan'];

      for ($i = 0; $i < $total; $i++) {
        $tmpFilePath = $_FILES['gambar']['tmp_name'][$i];
        $filename = $nodate."_".basename($_FILES['gambar']['name'][$i]);
        $target_file = $target_dir . $filename;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        // Ukuran Kompresi 10 (bisa diganti dengan yang lain)
        $compressedImage = compressImage($tmpFilePath, $target_file, 10);
          
        if ($tmpFilePath != "" && in_array($imageFileType, $allowed_types)) {
            if($compressedImage){
                $push_dokumentasi_inspeksibordc = mysqli_query($conn, "INSERT INTO hse_inspeksilist_fotobordc VALUES('','$inspeksi_id','$filename','$keterangan[$i]')");
                $jml_uploaddokumentasi_berhasil++;
            }else{
                $jml_uploaddokumentasi_gagal++;
             }
        } else {
            $jml_uploaddokumentasi_gagal++;
        }
          
      }
      $_SESSION['alert_success'] = $jml_uploaddokumentasi_berhasil." Foto Berhasil Diupload! <br>".$jml_uploaddokumentasi_gagal." Foto Gagal Diupload!";
    }
  }

  if(isset($_POST['delete_dokumentasi_inspeksibordc'])){
    if($_POST['delete_dokumentasi_inspeksibordc'] == "Delete"){
      $delete_dokumentasi_inspeksi_bordc = mysqli_query($conn, "DELETE FROM hse_inspeksilist_fotobordc WHERE id = '$_POST[id]'");

      if($delete_dokumentasi_inspeksi_bordc){
        unlink("../../role/HSE/foto_inspeksi_bordc/".$_POST['foto']);
        $_SESSION['alert_success'] = "Berhasil! Foto Bor DC Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Foto Bor DC Gagal dihapus";
      }
    }
  }
?>

<style>
    #signaturePad {
        border: 1px solid #000;
        width: 100%;
        height: 200px;
    }
    #error-message {
        color: red;
        display: none;
    }

    #signaturePad_2 {
        border: 1px solid #000;
        width: 100%;
        height: 165px;
    }
    #error-message_2 {
        color: red;
        display: none;
    }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Inspeksi Bor DC</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Data Project</li>
              <li class="breadcrumb-item">Detail Project</li>
              <li class="breadcrumb-item active">Form Inspeksi Bor DC</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Info Project</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-sm" style="font-size: 11px;">
                  <tr>
                    <th width="30%">Nama Project</th>
                    <td width="1%">:</td>
                    <td><?php echo $get_project['nama_project']; ?></td>
                  </tr>
                  <tr>
                    <th>HSE Officer</th>
                    <td>:</td>
                    <td><?php echo $get_hseOfficer['nama']; ?></td>
                  </tr>
                  <tr>
                    <th>Tgl Inspeksi</th>
                    <td>:</td>
                    <td><?php echo date('d-m-Y', strtotime($get_inspeksilist['tanggal_inspeksi'])); ?></td>
                  </tr>
                  <tr>
                    <th>Week</th>
                    <td>:</td>
                    <td><?php echo "Week ".$week; ?></td>
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

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Inspeksi Bor DC</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_bordc' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data Bor DC">
                    <div class="btn btn-info btn-xs" style="font-size:11px;">
                      <span class="fa fa-plus"></span> Tambah Data Bor DC
                    </div>
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table class="table table-bordered table-hover" style="font-size: 12px; margin-bottom: 10px;">
                    <thead>
                      <tr>
                        <th width="1%">#</th>
                        <th>Merek / Tipe</th>
                        <th>Tgl Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no = 1;
                        $q_get_detailinspeksi_bordc = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailbordc WHERE inspeksi_id = '$_GET[kd]'");
                        while($get_detailinspeksi_bordc = mysqli_fetch_array($q_get_detailinspeksi_bordc)){
                      ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_detailinspeksi_bordc['merek_tipe']; ?></td>
                          <td><?php echo date("d-m-Y H:i:s", strtotime($get_detailinspeksi_bordc['tgl_submit'])); ?></td>
                        </tr>
                        <tr class="expandable-body">
                          <td colspan="3">
                            <p style="margin-top: -25px;">
                              <table class="table table-sm" style="background-color: #e8e8e8; margin-bottom: 10px;">
                                <tr>
                                  <td width="70%">1. Tombol pengatur kecepatan berfungsi dengan baik</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_bordc['point_1']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">2. Tombol switch pemutar kedalam dan keluar berfunsi dengan baik</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_bordc['point_2']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">3. Battery tersedia dan terdapat cadangan dalam kondisi baik</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_bordc['point_3']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">4. Mesin penggerak atau motor penggerak berfungsi baik</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_bordc['point_4']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">5. Tombol mode tersedia dan berrfungsi dengan baik</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_bordc['point_5']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">6. Rumah mata bor dapat mengunci dan dalam keadaan baik</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_bordc['point_6']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">7. Vent angin mesin bor tidak tertutup</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_bordc['point_7']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">8. Badan mesin bor dalam kondisi baik</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_bordc['point_8']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">9. Charger battery tersedia dan dalam kondisi baik</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_bordc['point_9']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%"><b>Hasil Akhir</b></td>
                                  <td width="1%">:</td>
                                  <td width=""><b><?php echo $get_detailinspeksi_bordc['hasil_akhir']; ?></b></td>
                                </tr>
                              </table>

                              <center>
                                <a href="#modal" data-toggle='modal' data-target='#show_edit_data_bordc' data-id='<?php echo $get_detailinspeksi_bordc['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Data Bor DC">
                                  <div class="btn btn-secondary btn-xs" style="font-size:11px;">
                                    <span class="fa fa-pencil"></span> Edit Data Bor DC
                                  </div>
                                </a>

                                <a href="#modal" data-toggle='modal' data-target='#show_delete_data_bordc' data-id='<?php echo $get_detailinspeksi_bordc['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Data Bor DC">
                                  <div class="btn btn-danger btn-xs" style="font-size:11px;">
                                    <span class="fa fa-close"></span> Delete Data Bor DC
                                  </div>
                                </a>
                              </center>
                            </p>
                          </td>
                        </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>

                  <table class="table table-bordered table-sm" style="font-size: 12px; margin-bottom: 10px;">
                    <tr>
                      <td align="center" colspan="5"><b>HASIL PEMERIKSAAN</b></td>
                    </tr>
                    <tr>
                      <td align="center" width="20%" style="vertical-align: middle;">BAIK</td>
                      <td align="center" width="20%" style="vertical-align: middle;">RUSAK</td>
                      <td align="center" width="20%" style="vertical-align: middle;">HILANG</td>
                      <td align="center" width="20%" style="vertical-align: middle;">JUMLAH ASSET DITERIMA</td>
                      <td align="center" width="20%" style="vertical-align: middle;">JUMLAH ASSET MINGGU INI</td>
                    </tr>
                    <?php
                      $get_num_bordc_baik = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailbordc WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Baik'"));
                      $get_num_bordc_rusak = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailbordc WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Rusak'"));
                      $get_num_bordc_hilang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailbordc WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Hilang'"));

                      $get_jml_bordc_onsite = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jumlah) AS jml_bordc_onsite FROM hse_toolsapdonsite_detailtools JOIN hse_tools ON hse_toolsapdonsite_detailtools.tools_id = hse_tools.id JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailtools.id_onsite = hse_toolsapdonsite.id WHERE hse_tools.tools = 'Bor DC' AND hse_toolsapdonsite.project_id = '$kd_project'"));

                      $t_bordc_hilangrusak_minggu_lalu = 0;
                      for($i=1;$i<$week;$i++){
                        $kd_weekly_cek = "week/".$i."/".$kd_project;
                        $get_inspeksilist_all = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$kd_weekly_cek'"));

                        $t_bordc_hilangrusak_minggu_lalu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailbordc WHERE inspeksi_id = '$get_inspeksilist_all[id]' AND (hasil_akhir = 'Rusak' OR hasil_akhir = 'Hilang')")) + $t_bordc_hilangrusak_minggu_lalu;
                      }

                      $cek_data_bordc = "Lengkap";
                    ?>
                    <tr>
                      <td align="center"><?php echo $get_num_bordc_baik; ?></td>
                      <td align="center"><?php echo $get_num_bordc_rusak; ?></td>
                      <td align="center"><?php echo $get_num_bordc_hilang; ?></td>
                      <td align="center"><?php echo $get_jml_bordc_onsite['jml_bordc_onsite']; ?></td>
                      <td align="center"><?php echo $get_jml_bordc_onsite['jml_bordc_onsite'] - $t_bordc_hilangrusak_minggu_lalu; ?></td>
                    </tr>

                    <?php if(($get_num_bordc_baik + $get_num_bordc_rusak + $get_num_bordc_hilang) < ($get_jml_bordc_onsite['jml_bordc_onsite'] - $t_bordc_hilangrusak_minggu_lalu)){ ?>
                      <tr>
                        <td colspan="5" align="center" style="color: white; background-color: red;"><small>Data Bor DC masih kurang dari jumlah Asset minggu ini!</small></td>
                      </tr>
                    <?php $cek_data_bordc = "Kurang"; } ?>
                  </table>

                  <table class="table table-sm table-bordered" style="font-size: 12px; margin-bottom: 15px;">
                    <tr>
                      <!-- <td align="center" colspan="3">
                        <b>DOKUMENTASI</b><a href="#modal" data-toggle='modal' data-target='#add_dokumentasi_inspeksibordc' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Dokumentasi">
                          <div class="badge badge-info"><span class="fa fa-plus"></span> Tambah</div><br>
                          <small style="color: red;">*Lampiran Foto Minimal 4 Foto</small>
                        </a>
                      </td> -->

                      <td align="center" colspan="3">
                        <b>DOKUMENTASI</b><br>
                        <form id="myForm4" action="" method="post" enctype="multipart/form-data">
                          <input type="file" name="gambar[]" multiple onchange="handleFiles(this)" accept="image/*" required><br>
                          <small style="color: red;">*Lampiran Foto Minimal 4 Foto</small><br>
                          <div id="preview-container" class="preview-container"></div>
                          <hr>
                          <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd'] ?>">
                          <input type="submit" class="btn btn-secondary btn-xs" name="add_dokumentasi_inspeksibordc_v2" value="Upload"><br><br>
                        </form>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" width="1%"><b>No</b></td>
                      <td align="center"><b>Foto</b></td>
                      <td align="center"><b><span class="fa fa-trash" style="font-size: 16px"></span></b></td>
                    </tr>
                    <?php
                      $no=1;
                      $jml_foto_bordc = 0;
                      $q_get_dokumentasi_inspeksi_bordc = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotobordc WHERE inspeksi_id = '$_GET[kd]'");
                      while($get_dokumentasi_inspeksi_bordc = mysqli_fetch_array($q_get_dokumentasi_inspeksi_bordc)){
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td align="center">
                          <img src="../../role/HSE/foto_inspeksi_bordc/<?php echo $get_dokumentasi_inspeksi_bordc['foto']; ?>" width="100%"><br>
                          (<?php echo $get_dokumentasi_inspeksi_bordc['keterangan']; ?>)
                        </td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_dokumentasi_bordc' data-id='<?php echo $get_dokumentasi_inspeksi_bordc['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Dokumentasi">
                            <span class="fa fa-trash" style="color: red; font-size: 16px;"></span>
                          </a>
                        </td>
                      </tr>
                    <?php $jml_foto_bordc++; $no++; } ?>
                  </table>

                  <div style="font-size: 12px; text-align: center; font-weight: bold; margin-bottom: 5px">APPROVAL</div>
                  <div class="row">
                    <div class="col-6">
                      <?php if($get_inspeksilist['ttd_hse']==""){ ?>
                        <form id="signatureForm" method="POST" action="">
                          <center>
                            <div class="form-group">
                              <label for="signaturePad">Diperiksa Oleh<br><small>HSE Officer</small></label>
                              <canvas id="signaturePad"></canvas>
                              <input type="hidden" id="signatureImage" name="signatureImage">
                              <div id="error-message"><small>Tanda tangan anda disini.</small></div>
                            </div>
                            <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd'] ?>">
                            <button type="button" class="btn btn-sm btn-secondary" id="clearButton">Clear</button>
                            <button type="submit" class="btn btn-sm btn-primary" id="submitButton" name="ttd_apd_hse" disabled>Simpan</button>
                          </center>
                        </form>
                      <?php }else{ ?>
                        <div class="btn btn-sm btn-success" style="width: 100%"><span class="fa fa-check"></span><br>HSE OFFICER</div>
                      <?php } ?>
                    </div>
                    <div class="col-6">
                      <?php if($get_inspeksilist['ttd_sm']==""){ ?>
                        <form id="signatureForm_2" method="POST" action="">
                          <center>
                            <div class="form-group">
                              <label for="signaturePad_2">Disetujui Oleh<br><small>Site Manager</small></label>
                              <input type="text" class="form-control form-control-sm" name="site_manager" style="margin-bottom: 5px;" placeholder="Nama Site Manager" required>
                              <canvas id="signaturePad_2"></canvas>
                              <input type="hidden" id="signatureImage_2" name="signatureImage_2">
                              <div id="error-message_2"><small>Tanda tangan anda disini.</small></div>
                            </div>
                            <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd'] ?>">
                            <button type="button" class="btn btn-sm btn-secondary" id="clearButton_2">Clear</button>
                            <button type="submit" class="btn btn-sm btn-primary" id="submitButton_2" name="ttd_apd_sm" disabled>Simpan</button>
                          </center>
                        </form>
                      <?php }else{ ?>
                        <div class="btn btn-sm btn-success" style="width: 100%"><span class="fa fa-check"></span><br>SITE MANAGER</div>
                      <?php } ?>
                    </div>
                  </div>

                  <br>
                  <div style="margin-top: 20px; text-align: center;">
                    <form method="POST" action="">
                      <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd']; ?>">
                      <a href="index.php?pages=detailproject&kd=<?php echo $kd_project; ?>" class="btn btn-info btn-sm"><span class="fa fa-reply"></span> Kembali</a>
                      
                      <button onclick="return confirm('Yakin inspeksi Bor DC ini sudah lengkap dan sesuai ?')" class="btn btn-success btn-sm" name="submit_inspeksi_bordc" value="submit" <?php if($get_inspeksilist['ttd_hse'] == "" OR $get_inspeksilist['ttd_sm'] == "" OR $jml_foto_bordc < 4 OR $cek_data_bordc == "Kurang"){ echo "disabled"; } ?>>Submit</button>

                    </form>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- Modal start here -->
  <div class="modal fade" id="show_add_data_bordc" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Bor DC</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" method="POST" target="">
            <table class="table table-sm" style="font-size: 12px;">
              <tr>
                <td width="25%">Merek / Tipe</td>
                <td width="1%">:</td>
                <td><input type="text" style="width: 100%" name="merek_tipe" required></td>
              </tr>
            </table>
            <table class="table table-sm" style="font-size: 12px;">
              <tr>
                <td width="75%">1. Tombol pengatur kecepatan berfungsi dengan baik</td>
                <td width="1%">:</td>
                <td width="24%">
                  <select style="width: 100%" name="point_1">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>2. Tombol switch pemutar kedalam dan keluar berfunsi dengan baik</td>
                <td>:</td>
                <td>
                  <select style="width: 100%" name="point_2">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>3. Battery tersedia dan terdapat cadangan dalam kondisi baik</td>
                <td>:</td>
                <td>
                  <select style="width: 100%" name="point_3">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>4. Mesin penggerak atau motor penggerak berfungsi baik</td>
                <td>:</td>
                <td>
                  <select style="width: 100%" name="point_4">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>5. Tombol mode tersedia dan berrfungsi dengan baik</td>
                <td>:</td>
                <td>
                  <select style="width: 100%" name="point_5">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>6. Rumah mata bor dapat mengunci dan dalam keadaan baik</td>
                <td>:</td>
                <td>
                  <select style="width: 100%" name="point_6">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>7. Vent angin mesin bor tidak tertutup</td>
                <td>:</td>
                <td>
                  <select style="width: 100%" name="point_7">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>8. Badan mesin bor dalam kondisi baik</td>
                <td>:</td>
                <td>
                  <select style="width: 100%" name="point_8">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>9. Charger battery tersedia dan dalam kondisi baik</td>
                <td>:</td>
                <td>
                  <select style="width: 100%" name="point_9">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><b>Hasil Akhir</b></td>
                <td>:</td>
                <td>
                  <select style="width: 100%" name="hasil_akhir">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                  </select>
                </td>
              </tr>
            </table>
            <div style="text-align: center;">
              <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd']; ?>">
              <input type="submit" class="btn btn-info btn-sm" name="add_data_bordc" value="Tambah Data Bor DC">
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_data_bordc" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Bor DC</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm2" method="POST" target="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_delete_data_bordc" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data Bor DC</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm3" method="POST" target="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <!-- <div class="modal fade" id="add_dokumentasi_inspeksibordc" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Dokumentasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm4" method="POST" action="" enctype="multipart/form-data">
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-3 col-form-label" style="font-size: 12px;">Foto</label>
              <div class="col-9">
                <input type="file" class="form-control form-control-sm" name="file">
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-3 col-form-label" style="font-size: 12px;">Keterangan</label>
              <div class="col-9">
                <textarea class="form-control form-control-sm" name="keterangan"></textarea>
              </div>
            </div>

            <br>
            <center>
              <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd'] ?>">
              <input type="submit" class="btn btn-info" name="add_dokumentasi_inspeksibordc" value="Simpan">
            </center>
          </form>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_delete_dokumentasi_bordc" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Dokumentasi Bor DC</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm5" method="POST" target="">
            <div class="modal-data"></div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>

<script>
  $(document).ready(function() {
      const canvas = document.getElementById('signaturePad');
      const ctx = canvas.getContext('2d');
      const submitButton = document.getElementById('submitButton');
      let isDrawing = false;

      // Adjust canvas size based on container dimensions
      function resizeCanvas() {
          const canvasContainer = canvas.parentNode;
          canvas.width = canvasContainer.offsetWidth;
          canvas.height = 200;
      }
      
      // Initial canvas size adjustment
      resizeCanvas();
      
      // Adjust the canvas size when window is resized
      window.addEventListener('resize', resizeCanvas);

      function getPointerPos(event) {
          const rect = canvas.getBoundingClientRect();
          let clientX, clientY;

          if (event.touches) {
              clientX = event.touches[0].clientX;
              clientY = event.touches[0].clientY;
          } else {
              clientX = event.clientX;
              clientY = event.clientY;
          }

          return {
              x: clientX - rect.left,
              y: clientY - rect.top
          };
      }

      function startDrawing(event) {
          isDrawing = true;
          const pos = getPointerPos(event);
          ctx.beginPath();
          ctx.moveTo(pos.x, pos.y);
          event.preventDefault();
          toggleSubmitButton();
      }

      function draw(event) {
          if (isDrawing) {
              const pos = getPointerPos(event);
              ctx.lineTo(pos.x, pos.y);
              ctx.stroke();
              toggleSubmitButton();
          }
          event.preventDefault();
      }

      function stopDrawing() {
          isDrawing = false;
          toggleSubmitButton();
      }

      function toggleSubmitButton() {
          if (isCanvasEmpty()) {
              submitButton.disabled = true;
              $('#error-message').show();
          } else {
              submitButton.disabled = false;
              $('#error-message').hide();
          }
      }

      function isCanvasEmpty() {
          const blank = document.createElement('canvas');
          blank.width = canvas.width;
          blank.height = canvas.height;
          return canvas.toDataURL() === blank.toDataURL();
      }

      // Mouse events
      canvas.addEventListener('mousedown', startDrawing);
      canvas.addEventListener('mousemove', draw);
      canvas.addEventListener('mouseup', stopDrawing);
      canvas.addEventListener('mouseout', stopDrawing);

      // Touch events
      canvas.addEventListener('touchstart', startDrawing);
      canvas.addEventListener('touchmove', draw);
      canvas.addEventListener('touchend', stopDrawing);
      canvas.addEventListener('touchcancel', stopDrawing);

      $('#clearButton').click(function() {
          ctx.clearRect(0, 0, canvas.width, canvas.height);
          $('#error-message').hide();
          toggleSubmitButton();
      });

      $('#signatureForm').submit(function(e) {
          if (isCanvasEmpty()) {
              e.preventDefault();
              $('#error-message').show();
          } else {
              const signatureDataURL = canvas.toDataURL();
              $('#signatureImage').val(signatureDataURL);
              $('#error-message').hide();
          }
      });

      toggleSubmitButton();
  });
</script>


<script>
  $(document).ready(function() {
      const canvas = document.getElementById('signaturePad_2');
      const ctx = canvas.getContext('2d');
      const submitButton = document.getElementById('submitButton_2');
      let isDrawing = false;

      // Adjust canvas size based on container dimensions
      function resizeCanvas() {
          const canvasContainer = canvas.parentNode;
          canvas.width = canvasContainer.offsetWidth;
          canvas.height = 200;
      }
      
      // Initial canvas size adjustment
      resizeCanvas();
      
      // Adjust the canvas size when window is resized
      window.addEventListener('resize', resizeCanvas);

      function getPointerPos(event) {
          const rect = canvas.getBoundingClientRect();
          let clientX, clientY;

          if (event.touches) {
              clientX = event.touches[0].clientX;
              clientY = event.touches[0].clientY;
          } else {
              clientX = event.clientX;
              clientY = event.clientY;
          }

          return {
              x: clientX - rect.left,
              y: clientY - rect.top
          };
      }

      function startDrawing(event) {
          isDrawing = true;
          const pos = getPointerPos(event);
          ctx.beginPath();
          ctx.moveTo(pos.x, pos.y);
          event.preventDefault();
          toggleSubmitButton();
      }

      function draw(event) {
          if (isDrawing) {
              const pos = getPointerPos(event);
              ctx.lineTo(pos.x, pos.y);
              ctx.stroke();
              toggleSubmitButton();
          }
          event.preventDefault();
      }

      function stopDrawing() {
          isDrawing = false;
          toggleSubmitButton();
      }

      function toggleSubmitButton() {
          if (isCanvasEmpty()) {
              submitButton.disabled = true;
              $('#error-message_2').show();
          } else {
              submitButton.disabled = false;
              $('#error-message_2').hide();
          }
      }

      function isCanvasEmpty() {
          const blank = document.createElement('canvas');
          blank.width = canvas.width;
          blank.height = canvas.height;
          return canvas.toDataURL() === blank.toDataURL();
      }

      // Mouse events
      canvas.addEventListener('mousedown', startDrawing);
      canvas.addEventListener('mousemove', draw);
      canvas.addEventListener('mouseup', stopDrawing);
      canvas.addEventListener('mouseout', stopDrawing);

      // Touch events
      canvas.addEventListener('touchstart', startDrawing);
      canvas.addEventListener('touchmove', draw);
      canvas.addEventListener('touchend', stopDrawing);
      canvas.addEventListener('touchcancel', stopDrawing);

      $('#clearButton_2').click(function() {
          ctx.clearRect(0, 0, canvas.width, canvas.height);
          $('#error-message_2').hide();
          toggleSubmitButton();
      });

      $('#signatureForm_2').submit(function(e) {
          if (isCanvasEmpty()) {
              e.preventDefault();
              $('#error-message_2').show();
          } else {
              const signatureDataURL = canvas.toDataURL();
              $('#signatureImage_2').val(signatureDataURL);
              $('#error-message_2').hide();
          }
      });

      toggleSubmitButton();
  });
</script>