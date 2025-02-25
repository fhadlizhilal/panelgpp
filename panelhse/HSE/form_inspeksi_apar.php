<?php
  date_default_timezone_set("Asia/Jakarta");
  $get_inspeksilist = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE id = '$_GET[kd]'"));
  $data_array = explode("/", $get_inspeksilist['kd_weekly']);
  $week = $data_array[1];
  $kd_project = $data_array[2];
  $datetime_now = date("Y-m-d H:i:s");

  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$kd_project'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inspeksilist[hse_officer]'"));

  if(isset($_POST['add_data_apar'])){
    if($_POST['add_data_apar'] == "Tambah Data APAR"){
      $add_data_apar = mysqli_query($conn, "INSERT INTO hse_inspeksilist_detailapar VALUES ('', '$_POST[inspeksi_id]', '$_POST[merek_tipe]', '$_POST[point_1]', '$_POST[point_2]', '$_POST[point_3]', '$_POST[point_4]', '$_POST[point_5]', '$_POST[point_6]', '$_POST[point_7]', '$_POST[point_8]', '$_POST[point_9]', '$_POST[point_10]', '$_POST[point_11]', '$_POST[hasil_akhir]', '$datetime_now')");

      if($add_data_apar){
        $_SESSION['alert_success'] = "Berhasil! Data APAR Berhasil ditambah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data APAR gagal ditambah";
      }
    }
  }

  if(isset($_POST['submit_inspeksi_apar'])){
    if($_POST['submit_inspeksi_apar'] == "submit"){
      $submit_inspeksi_apar = mysqli_query($conn, "UPDATE hse_inspeksilist SET status = 'completed' WHERE id = '$_POST[inspeksi_id]'");
      $_SESSION['alert_success'] = "Berhasil! Inspeksi APAR Berhasil disubmit";

      if($submit_inspeksi_apar){
        $_SESSION['alert_success'] = "Berhasil! Inspeksi APAR Berhasil disubmit";
        echo "<meta http-equiv='refresh' content='0; url=index.php?pages=detailproject&kd=$kd_project'>";
      }else{
        $_SESSION['alert_error'] = "Gagal! Inspeksi APAR Gagal disubmit";
      }
    }
  }

  if(isset($_POST['edit_data_apar'])){
    if($_POST['edit_data_apar'] == "Simpan Data APAR"){
      $edit_data_inspeksi_apar = mysqli_query($conn, "UPDATE hse_inspeksilist_detailapar SET merek_tipe = '$_POST[merek_tipe]', point_1 = '$_POST[point_1]', point_2 = '$_POST[point_2]', point_3 = '$_POST[point_3]', point_4 = '$_POST[point_4]', point_5 = '$_POST[point_5]', point_6 = '$_POST[point_6]', point_7 = '$_POST[point_7]', point_8 = '$_POST[point_8]', point_9 = '$_POST[point_9]', point_10 = '$_POST[point_10]', point_11 = '$_POST[point_11]', hasil_akhir = '$_POST[hasil_akhir]', tgl_submit = '$datetime_now' WHERE id = '$_POST[id_detail_apar]'");

      if($edit_data_inspeksi_apar){
        $_SESSION['alert_success'] = "Berhasil! Inspeksi APAR Berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Inspeksi APAR Gagal diubah";
      }
    }
  }

  if(isset($_POST['delete_data_apar'])){
    if($_POST['delete_data_apar'] == "Delete Data APAR"){
      $edit_data_inspeksi_apar = mysqli_query($conn, "DELETE FROM hse_inspeksilist_detailapar WHERE id = '$_POST[id_detail_apar]'");

      if($edit_data_inspeksi_apar){
        $_SESSION['alert_success'] = "Berhasil! Data APAR Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data APAR Gagal dihapus";
      }
    }
  }

  if(isset($_POST['add_dokumentasi_inspeksiapar'])){
    if($_POST['add_dokumentasi_inspeksiapar'] == "Simpan"){
      $uploadPath = "../../role/HSE/foto_inspeksi_apar/";

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
                $push_dokumentasi_inspeksiapar = mysqli_query($conn, "INSERT INTO hse_inspeksilist_fotoapar VALUES('','$_POST[inspeksi_id]','$fileName','$_POST[keterangan]')");

                if($push_dokumentasi_inspeksiapar){
                  $_SESSION['alert_success'] = "Berhasil! Dokumentasi Inspeksi APAR Berhasil Ditambahkan";
                }else{
                  unlink("../../role/HSE/foto_inspeksi_apar/".$fileName);
                  $_SESSION['alert_error'] = "Gagal! Dokumentasi Gagal ditambahkan <br>".mysqli_error($conn);
                }
              }else{ 
                unlink("../../role/HSE/foto_inspeksi_apar/".$fileName);
                $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
              } 
          }else{
            unlink("../../role/HSE/foto_inspeksi_apar/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
          } 
      }else{
        $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
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
            <h1>Form Inspeksi APAR</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Data Project</li>
              <li class="breadcrumb-item">Detail Project</li>
              <li class="breadcrumb-item active">Form Inspeksi APAR</li>
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
                <h3 class="card-title">Data Inspeksi APAR</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_apar' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data APAR">
                    <div class="btn btn-info btn-xs" style="font-size:11px;">
                      <span class="fa fa-plus"></span> Tambah Data APAR
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
                        $q_get_detailinspeksi_apar = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapar WHERE inspeksi_id = '$_GET[kd]'");
                        while($get_detailinspeksi_apar = mysqli_fetch_array($q_get_detailinspeksi_apar)){
                      ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_detailinspeksi_apar['merek_tipe']; ?></td>
                          <td><?php echo date("d-m-Y H:i:s", strtotime($get_detailinspeksi_apar['tgl_submit'])); ?></td>
                        </tr>
                        <tr class="expandable-body">
                          <td colspan="3">
                            <p style="margin-top: -25px;">
                              <table class="table table-sm" style="background-color: #e8e8e8; margin-bottom: 10px;">
                                <tr>
                                  <td width="70%">1. Nomor tabung sesuai</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_1']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">2. Penempatan APAR benar</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_2']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">3. Penempatan APAR pada area kerja dan mudah dicapai</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_3']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">4. APAR dalam kondisi bersih</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_4']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">5. Terdapat data kelas kebakaran pada APAR</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_5']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">6. Terdapat data media pemadam</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_6']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">7. Terdapat instruk atau petunjuk penggunaan</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_7']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">8. Terpasang tagging / label pemeriksaan</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_8']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">9. Isi APAR cukup (tidak < 10% dari berat normal)</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_9']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">10. Seal dan pin pengaman terpasang dengan baik</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_10']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%">11. Jarum indikator tekanan menunjukan kondisi normal</td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['point_11']; ?></td>
                                </tr>
                                <tr>
                                  <td width="70%"><b>Hasil Akhir</b></td>
                                  <td width="1%">:</td>
                                  <td width=""><?php echo $get_detailinspeksi_apar['hasil_akhir']; ?></td>
                                </tr>
                              </table>

                              <center>
                                <a href="#modal" data-toggle='modal' data-target='#show_edit_data_apar' data-id='<?php echo $get_detailinspeksi_apar['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Data APAR">
                                  <div class="btn btn-secondary btn-xs" style="font-size:11px;">
                                    <span class="fa fa-pencil"></span> Edit Data APAR
                                  </div>
                                </a>

                                <a href="#modal" data-toggle='modal' data-target='#show_delete_data_apar' data-id='<?php echo $get_detailinspeksi_apar['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Data APAR">
                                  <div class="btn btn-danger btn-xs" style="font-size:11px;">
                                    <span class="fa fa-close"></span> Delete Data APAR
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
                      $get_num_apar_baik = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapar WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Baik'"));
                      $get_num_apar_rusak = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapar WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Rusak'"));
                      $get_num_apar_hilang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapar WHERE inspeksi_id = '$_GET[kd]' AND hasil_akhir = 'Hilang'"));

                      $get_jml_apar_onsite = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jumlah) AS jml_apar_onsite FROM hse_toolsapdonsite_detailtoolsk3 JOIN hse_toolsk3 ON hse_toolsapdonsite_detailtoolsk3.toolsk3_id = hse_toolsk3.id JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailtoolsk3.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsk3.nama_tools = 'APAR' AND hse_toolsapdonsite.project_id = '$kd_project'"));

                      $t_apar_hilangrusak_minggu_lalu = 0;
                      for($i=1;$i<$week;$i++){
                        $kd_weekly_cek = "week/".$i."/".$kd_project;
                        $get_inspeksilist_all = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$kd_weekly_cek'"));

                        $t_apar_hilangrusak_minggu_lalu = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapar WHERE inspeksi_id = '$get_inspeksilist_all[id]' AND (hasil_akhir = 'Rusak' OR hasil_akhir = 'Hilang')")) + $t_apar_hilangrusak_minggu_lalu;
                      }

                      $cek_data_apar = "Lengkap";
                    ?>
                    <tr>
                      <td align="center"><?php echo $get_num_apar_baik; ?></td>
                      <td align="center"><?php echo $get_num_apar_rusak; ?></td>
                      <td align="center"><?php echo $get_num_apar_hilang; ?></td>
                      <td align="center"><?php echo $get_jml_apar_onsite['jml_apar_onsite']; ?></td>
                      <td align="center"><?php echo $get_jml_apar_onsite['jml_apar_onsite'] - $t_apar_hilangrusak_minggu_lalu; ?></td>
                    </tr>

                    <?php if(($get_num_apar_baik + $get_num_apar_rusak + $get_num_apar_hilang) < ($get_jml_apar_onsite['jml_apar_onsite'] - $t_apar_hilangrusak_minggu_lalu)){ ?>
                      <tr>
                        <td colspan="5" align="center" style="color: white; background-color: red;"><small>Data APAR masih kurang dari jumlah Asset minggu ini!</small></td>
                      </tr>
                    <?php $cek_data_apar = "Kurang"; } ?>
                  </table>

                  <table class="table table-sm table-bordered" style="font-size: 12px; margin-bottom: 15px;">
                    <tr>
                      <td align="center" colspan="3">
                        <b>DOKUMENTASI</b><a href="#modal" data-toggle='modal' data-target='#add_dokumentasi_inspeksiapar' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Dokumentasi">
                          <div class="badge badge-info"><span class="fa fa-plus"></span> Tambah</div><br>
                          <small style="color: red;">*Lampiran Foto Minimal 4 Foto</small>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" width="1%"><b>No</b></td>
                      <td align="center"><b>Foto</b></td>
                      <td align="center"><b><span class="fa fa-trash" style="font-size: 16px"></span></b></td>
                    </tr>
                    <?php
                      $no=1;
                      $jml_foto_apar = 1;
                      $q_get_dokumentasi_inspeksi_apar = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotoapar WHERE inspeksi_id = '$_GET[kd]'");
                      while($get_dokumentasi_inspeksi_apar = mysqli_fetch_array($q_get_dokumentasi_inspeksi_apar)){
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td align="center">
                          <img src="../../role/HSE/foto_inspeksi_apar/<?php echo $get_dokumentasi_inspeksi_apar['foto']; ?>" width="100%"><br>
                          (<?php echo $get_dokumentasi_inspeksi_apar['keterangan']; ?>)
                        </td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#delete_dokumentasi_inspeksiapar' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Dokumentasi">
                            <span class="fa fa-trash" style="color: red; font-size: 16px;"></span>
                          </a>
                        </td>
                      </tr>
                    <?php $jml_foto_apar++; $no++; } ?>
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
                      
                      <button onclick="return confirm('Yakin inspeksi APAR ini sudah lengkap dan sesuai ?')" class="btn btn-success btn-sm" name="submit_inspeksi_apar" value="submit" <?php if($get_inspeksilist['ttd_hse'] == "" OR $get_inspeksilist['ttd_sm'] == "" OR $jml_foto_apar < 4 OR $cek_data_apar == "Kurang"){ echo "disabled"; } ?>>Submit</button>

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
  <div class="modal fade" id="show_add_data_apar" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data APAR</h4>
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
                <td width="80%">1. Nomor tabung sesuai</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_1">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">2. Penempatan APAR benar</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_2">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">3. Penempatan APAR pada area kerja dan mudah dicapai</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_3">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">4. APAR dalam kondisi bersih</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_4">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">5. Terdapat data kelas kebakaran pada APAR</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_5">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">6. Terdapat data media pemadam</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_6">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">7. Terdapat instruk atau petunjuk penggunaan</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_7">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">8. Terpasang tagging / label pemeriksaan</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_8">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">9. Isi APAR cukup (tidak < 10% dari berat normal)</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_9">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">10. Seal dan pin pengaman terpasang dengan baik</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_10">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%">11. Jarum indikator tekanan menunjukan kondisi normal</td>
                <td width="1%">:</td>
                <td width="19%">
                  <select style="width: 100%" name="point_11">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Hilang">Hilang</option>
                    <option value="NA">NA</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td width="80%"><b>Hasil Akhir</b></td>
                <td width="1%">:</td>
                <td width="19%">
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
              <input type="submit" class="btn btn-info btn-sm" name="add_data_apar" value="Tambah Data APAR">
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
  <div class="modal fade" id="show_edit_data_apar" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data APAR</h4>
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
  <div class="modal fade" id="show_delete_data_apar" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data APAR</h4>
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
  <div class="modal fade" id="add_dokumentasi_inspeksiapar" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Dokumentasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="" enctype="multipart/form-data">
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
              <input type="submit" class="btn btn-info" name="add_dokumentasi_inspeksiapar" value="Simpan">
            </center>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

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