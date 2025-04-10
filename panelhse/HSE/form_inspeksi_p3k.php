<?php
  date_default_timezone_set("Asia/Jakarta");
  $get_inspeksilist = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE id = '$_GET[kd]'"));
  $data_array = explode("/", $get_inspeksilist['kd_weekly']);
  $week = $data_array[1];
  $kd_project = $data_array[2];
  $datetime_now = date("Y-m-d H:i:s");

  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$kd_project'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inspeksilist[hse_officer]'"));

  $jml_p3k_onsite = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(jumlah) AS total_p3k_onsite FROM hse_toolsapdonsite_detailtoolsk3 JOIN hse_toolsk3 ON hse_toolsapdonsite_detailtoolsk3.toolsk3_id = hse_toolsk3.id JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailtoolsk3.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsk3.nama_tools = 'P3K' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

  // ADD DATA P3K
  if(isset($_POST['add_data_p3k'])){
    if($_POST['add_data_p3k'] == "Tambah Data P3K"){
      $push_data_p3k = mysqli_query($conn, "INSERT INTO hse_inspeksilist_detailp3k VALUES('','$_POST[inspeksi_id]','$_POST[tipe_kotak]','$_POST[point_1]','$_POST[point_2]','$_POST[point_3]','$_POST[point_4]','$_POST[point_5]','$_POST[point_6]','$_POST[point_7]','$_POST[point_8]','$_POST[point_9]','$_POST[point_10]','$_POST[point_11]','$_POST[point_12]','$_POST[point_13]','$_POST[point_14]','$_POST[point_15]','$_POST[point_16]','$_POST[point_17]','$_POST[point_18]','$_POST[point_19]','$_POST[point_20]','$_POST[catatan]','$datetime_now')");

      if($push_data_p3k){
        $_SESSION['alert_success'] = "Berhasil! data P3K berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! data P3K gagal disimpan";
      }
    }
  }

  // DELETE DATA P3K
  if(isset($_POST['delete_data_p3k'])){
    if($_POST['delete_data_p3k'] == "Delete Data P3K"){
      $x = 0;
      $q_get_fotop3k = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotop3k WHERE detail_id = '$_POST[id_detail_p3k]'");
      while($get_fotop3k = mysqli_fetch_array($q_get_fotop3k)){
        $foto_ke[$x] = $get_fotop3k['foto'];
        $keterangan_ke[$x] = $get_fotop3k['keterangan'];
        $x++;
      }

      $delete_fotop3k = mysqli_query($conn, "DELETE FROM hse_inspeksilist_fotop3k WHERE detail_id = '$_POST[id_detail_p3k]'");
      if($delete_fotop3k){
         $delete_inspeksilist_detailp3k = mysqli_query($conn, "DELETE FROM hse_inspeksilist_detailp3k WHERE id = '$_POST[id_detail_p3k]'");
        if($delete_inspeksilist_detailp3k){
          for($cc=0;$cc<$x;$cc++){
            unlink("../../role/HSE/foto_inspeksi_p3k/".$foto_ke[$cc]);
            $_SESSION['alert_success'] = "Berhasil! Dokumentasi P3K Berhasil Dihapus";
          }
        }else{
          for($cc=0;$cc<$x;$cc++){
            mysqli_query($conn, "INSERT INTO hse_inspeksilist_fotop3k VALUES('','$_POST[id_detail_p3k]','$foto_ke[$cc]','$keterangan_ke[$cc]')");
            $_SESSION['alert_error'] = "Gagal! Dokumentasi P3K gagal dihapus [4]";
          }
        }
      }else{
        $_SESSION['alert_error'] = "Gagal! Dokumentasi P3K gagal dihapus [3]";
      }
    }else{
      $_SESSION['alert_error'] = "Gagal! Dokumentasi P3K gagal dihapus [2]";
    }
  }

  // EDIT DATA P3K
  if(isset($_POST['edit_data_p3k'])){
    if($_POST['edit_data_p3k'] == "Simpan Data P3K"){
      $edit_data_p3k = mysqli_query($conn, "UPDATE hse_inspeksilist_detailp3k SET tipe_kotak = '$_POST[tipe_kotak]', point_1 = '$_POST[point_1]', point_2 = '$_POST[point_2]', point_3 = '$_POST[point_3]', point_4 = '$_POST[point_4]', point_5 = '$_POST[point_5]', point_6 = '$_POST[point_6]', point_7 = '$_POST[point_7]', point_8 = '$_POST[point_8]', point_9 = '$_POST[point_9]', point_10 = '$_POST[point_10]', point_11 = '$_POST[point_11]', point_12 = '$_POST[point_12]', point_13 = '$_POST[point_13]', point_14 = '$_POST[point_14]', point_15 = '$_POST[point_15]', point_16 = '$_POST[point_16]', point_17 = '$_POST[point_17]', point_18 = '$_POST[point_18]', point_19 = '$_POST[point_19]', point_20 = '$_POST[point_20]', catatan = '$_POST[catatan]' WHERE id = '$_POST[id_detail_p3k]'");

      if($edit_data_p3k){
        $_SESSION['alert_success'] = "Berhasil! data P3K berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! data P3K gagal diubah";
      }
    }
  }

  // ADD DOKUMENTASI P3K
  if(isset($_POST['add_dokumentasi_inspeksip3k'])){
    if($_POST['add_dokumentasi_inspeksip3k'] == "Simpan"){
      $uploadPath = "../../role/HSE/foto_inspeksi_p3k/";

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
                $push_dokumentasi_inspeksiapd = mysqli_query($conn, "INSERT INTO hse_inspeksilist_fotop3k VALUES('','$_POST[detail_id]','$fileName','$_POST[keterangan]')");

                if($push_dokumentasi_inspeksiapd){
                  $_SESSION['alert_success'] = "Berhasil! Dokumentasi Inspeksi P3k Berhasil Ditambahkan";
                }else{
                  unlink("../../role/HSE/foto_inspeksi_apd/".$fileName);
                  $_SESSION['alert_error'] = "Gagal! Dokumentasi Gagal ditambahkan <br>".mysqli_error($conn);
                }
              }else{ 
                unlink("../../role/HSE/foto_inspeksi_apd/".$fileName);
                $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
              } 
          }else{
            unlink("../../role/HSE/foto_inspeksi_apd/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
          } 
      }else{
        $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
      } 
    }
  }

  // DELETE Dokumentasi P3K
  if(isset($_POST['delete_dokumentasi_inspeksip3k'])){
    if($_POST['delete_dokumentasi_inspeksip3k'] == "Delete"){
      $delete_fotop3k = mysqli_query($conn, "DELETE FROM hse_inspeksilist_fotop3k WHERE id = '$_POST[id]'");
      if($delete_fotop3k){
        unlink("../../role/HSE/foto_inspeksi_p3k/".$_POST["foto"]);
        $_SESSION['alert_success'] = "Berhasil, Dokumentasi P3K Berhasil dihapus!";
      }else{
        $_SESSION['alert_error'] = "Gagal, Dokumentasi P3K Gagal dihapus!";
      }
    }
  }

  // TTD HSE Officer
  if(isset($_POST['ttd_apd_hse'])){
    $signatureImage = $_POST['signatureImage'];

    // Decode the base64 encoded image
    list($type, $data) = explode(';', $signatureImage);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    $file_name = "HSEinsP3K_".$_POST['inspeksi_id'].'_'.uniqid().'.png';
    // Set the file path to save the image
    $filePath = '../../role/HSE/signatures/'.$file_name;

    // Save the image
    file_put_contents($filePath, $data);

    $push_ttd_apd_hse = mysqli_query($conn, "UPDATE hse_inspeksilist SET ttd_hse = '$file_name' WHERE id = '$_POST[inspeksi_id]'");
    if($push_ttd_apd_hse){
      $_SESSION['alert_success'] = "Berhasil! Tanda tangan HSE Officer berhasil disimpan";
    }else{
      unlink("../../role/HSE/signatures/".$file_name);
      $_SESSION['alert_error'] = "Gagal! Tanda tangan HSE Officer gagal disimpan. ".mysqli_error($conn);
    } 
  }

  if(isset($_POST['ttd_apd_sm'])){
    $signatureImage = $_POST['signatureImage_2'];

    // Decode the base64 encoded image
    list($type, $data) = explode(';', $signatureImage);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    $file_name = "SMinsP3K_".$_POST['inspeksi_id'].'_'.uniqid().'.png';
    // Set the file path to save the image
    $filePath = '../../role/HSE/signatures/'.$file_name;

    // Save the image
    file_put_contents($filePath, $data);

    $push_ttd_apd_hse = mysqli_query($conn, "UPDATE hse_inspeksilist SET ttd_sm = '$file_name', site_manager = '$_POST[site_manager]' WHERE id = '$_POST[inspeksi_id]'");
    if($push_ttd_apd_hse){
      $_SESSION['alert_success'] = "Berhasil! Tanda tangan HSE Officer berhasil disimpan";
    }else{
      unlink("../../role/HSE/signatures/".$file_name);
      $_SESSION['alert_error'] = "Gagal! Tanda tangan HSE Officer gagal disimpan. ".mysqli_error($conn);
    }
  }

  // Submit Inspeksi P3K
  if(isset($_POST['submit_inspeksi_p3k'])){
    if($_POST['submit_inspeksi_p3k'] == "submit"){
      $submit_inspeksi = mysqli_query($conn, "UPDATE hse_inspeksilist SET status = 'completed' WHERE id = '$_POST[inspeksi_id]'");
      if($submit_inspeksi){
        echo "<meta http-equiv='refresh' content='0;index.php?pages=detailproject&kd=$_POST[kd_project]'>";
        $_SESSION['alert_success'] = "Berhasil! Inspeksi Berhasil Disubmit!";
      }else{
        $_SESSION['alert_error'] = "Gagal! Inspeksi Gagal Disubmit";
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
            <h1>Form Inspeksi P3K</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Data Project</li>
              <li class="breadcrumb-item">Detail Project</li>
              <li class="breadcrumb-item active">Form Inspeksi P3K</li>
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
                <h3 class="card-title">Data Inspeksi P3K</h3>
                <div class="float-right">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_p3k' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data P3K">
                    <div class="btn btn-info btn-xs" style="font-size:11px;">
                      <span class="fa fa-plus"></span> Tambah Data P3K
                    </div>
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="callout callout-info">
                  <b>Jumlah P3K :</b><br> <?php echo $jml_p3k_onsite['total_p3k_onsite']." SET"; ?><br>
                  <small style="color: red;">
                    *data P3K tidak boleh kurang dari jumlah P3K<br>
                    *Dokumentasi minimal 4 foto masing-masing data P3K
                  </small>
                </div>
                  <table class="table table-bordered table-hover" style="font-size: 12px; margin-bottom: 10px; margin-top: 10px;">
                    <thead>
                      <tr>
                        <th width="1%">#</th>
                        <th>Tipe Kotak</th>
                        <th>Tgl Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $noList = 1;
                        $cek_dokumentasi = "OKE";
                        $q_get_detailinspeksi_p3k = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailp3k WHERE inspeksi_id = '$_GET[kd]'");
                        while($get_detailinspeksi_p3k = mysqli_fetch_array($q_get_detailinspeksi_p3k)){
                      ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td><?php echo $noList; ?></td>
                          <td><?php echo "Tipe ".$get_detailinspeksi_p3k['tipe_kotak']; ?></td>
                          <td><?php echo date("d-m-Y H:i:s", strtotime($get_detailinspeksi_p3k['tgl_submit'])); ?></td>
                        </tr>
                        <tr class="expandable-body">
                          <td colspan="3">
                            <p style="margin-top: -25px;">
                              <table class="table table-sm" style="background-color: #e8e8e8; margin-bottom: 10px;">
                                <tr style="font-weight: bold;">
                                  <td align="center" width="1%">No</td>
                                  <td align="center" width="45%">Item Pemeriksaan</td>
                                  <td align="center" width="1%">Tersedia</td>
                                  <td align="center">Keterangan</td>
                                </tr>
                                <tr>
                                  <td>1</td>
                                  <td>Kasa steril terbungkus</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_1']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_1'] == 20){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_1'] > 20){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_1']-20)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_1'] < 20){
                                          echo "<div style='color: red'>Kurang ".(20-$get_detailinspeksi_p3k['point_1'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_1'] == 40){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_1'] > 40){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_1']-40)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_1'] < 40){
                                          echo "<div style='color: red'>Kurang ".(40-$get_detailinspeksi_p3k['point_1'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_1'] == 40){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_1'] > 40){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_1']-40)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_1'] < 40){
                                          echo "<div style='color: red'>Kurang ".(40-$get_detailinspeksi_p3k['point_1'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>Perban (lebar 5 cm)</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_2']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_2'] == 2){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_2'] > 2){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_2']-2)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_2'] < 2){
                                          echo "<div style='color: red'>Kurang ".(2-$get_detailinspeksi_p3k['point_2'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_2'] == 4){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_2'] > 4){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_2']-4)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_2'] < 4){
                                          echo "<div style='color: red'>Kurang ".(4-$get_detailinspeksi_p3k['point_2'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_2'] == 6){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_2'] > 6){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_2']-6)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_2'] < 6){
                                          echo "<div style='color: red'>Kurang ".(6-$get_detailinspeksi_p3k['point_2'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Perban (lebar 10 cm)</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_3']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_3'] == 2){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_3'] > 2){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_3']-2)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_3'] < 2){
                                          echo "<div style='color: red'>Kurang ".(2-$get_detailinspeksi_p3k['point_3'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_3'] == 4){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_3'] > 4){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_3']-4)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_3'] < 4){
                                          echo "<div style='color: red'>Kurang ".(4-$get_detailinspeksi_p3k['point_3'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_3'] == 6){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_3'] > 6){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_3']-6)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_3'] < 6){
                                          echo "<div style='color: red'>Kurang ".(6-$get_detailinspeksi_p3k['point_3'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>Plester (lebar 1,25 cm)</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_4']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_4'] == 2){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_4'] > 2){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_4']-2)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_4'] < 2){
                                          echo "<div style='color: red'>Kurang ".(2-$get_detailinspeksi_p3k['point_4'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_4'] == 4){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_4'] > 4){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_4']-4)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_4'] < 4){
                                          echo "<div style='color: red'>Kurang ".(4-$get_detailinspeksi_p3k['point_4'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_4'] == 6){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_4'] > 6){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_4']-6)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_4'] < 6){
                                          echo "<div style='color: red'>Kurang ".(6-$get_detailinspeksi_p3k['point_4'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>5</td>
                                  <td>Plester Cepat</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_5']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_5'] == 10){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_5'] > 10){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_5']-10)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_5'] < 10){
                                          echo "<div style='color: red'>Kurang ".(10-$get_detailinspeksi_p3k['point_5'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_5'] == 15){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_5'] > 15){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_5']-15)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_5'] < 15){
                                          echo "<div style='color: red'>Kurang ".(15-$get_detailinspeksi_p3k['point_5'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_5'] == 20){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_5'] > 20){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_5']-20)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_5'] < 20){
                                          echo "<div style='color: red'>Kurang ".(20-$get_detailinspeksi_p3k['point_5'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>6</td>
                                  <td>Kapas (25 gram)</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_6']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_6'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_6'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_6']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_6'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_6'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_6'] == 2){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_6'] > 2){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_6']-2)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_6'] < 2){
                                          echo "<div style='color: red'>Kurang ".(2-$get_detailinspeksi_p3k['point_6'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_6'] == 3){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_6'] > 3){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_6']-3)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_6'] < 3){
                                          echo "<div style='color: red'>Kurang ".(3-$get_detailinspeksi_p3k['point_6'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>7</td>
                                  <td>Kain segitiga / Mitela</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_7']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_7'] == 2){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_7'] > 2){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_7']-2)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_7'] < 2){
                                          echo "<div style='color: red'>Kurang ".(2-$get_detailinspeksi_p3k['point_7'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_7'] == 4){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_7'] > 4){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_7']-4)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_7'] < 4){
                                          echo "<div style='color: red'>Kurang ".(4-$get_detailinspeksi_p3k['point_7'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_7'] == 6){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_7'] > 6){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_7']-6)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_7'] < 6){
                                          echo "<div style='color: red'>Kurang ".(6-$get_detailinspeksi_p3k['point_7'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>8</td>
                                  <td>Gunting</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_8']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_8'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_8'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_8']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_8'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_8'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_8'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_8'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_8']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_8'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_8'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_8'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_8'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_8']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_8'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_8'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>9</td>
                                  <td>Peniti</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_9']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_9'] == 12){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_9'] > 12){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_9']-12)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_9'] < 12){
                                          echo "<div style='color: red'>Kurang ".(12-$get_detailinspeksi_p3k['point_9'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_9'] == 12){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_9'] > 12){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_9']-12)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_9'] < 12){
                                          echo "<div style='color: red'>Kurang ".(12-$get_detailinspeksi_p3k['point_9'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_9'] == 12){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_9'] > 12){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_9']-12)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_9'] < 12){
                                          echo "<div style='color: red'>Kurang ".(12-$get_detailinspeksi_p3k['point_9'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>10</td>
                                  <td>Sarung tangan sekali pakai</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_10']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_10'] == 2){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_10'] > 2){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_10']-2)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_10'] < 2){
                                          echo "<div style='color: red'>Kurang ".(2-$get_detailinspeksi_p3k['point_10'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_10'] == 3){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_10'] > 3){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_10']-3)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_10'] < 3){
                                          echo "<div style='color: red'>Kurang ".(3-$get_detailinspeksi_p3k['point_10'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_10'] == 4){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_10'] > 4){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_10']-4)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_10'] < 4){
                                          echo "<div style='color: red'>Kurang ".(4-$get_detailinspeksi_p3k['point_10'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>11</td>
                                  <td>Masker</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_11']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_11'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_11'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_11']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_11'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_11'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_11'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_11'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_11']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_11'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_11'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_11'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_11'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_11']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_11'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_11'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>12</td>
                                  <td>Pinest</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_12']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_12'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_12'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_12']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_12'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_12'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_12'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_12'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_12']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_12'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_12'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_12'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_12'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_12']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_12'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_12'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>13</td>
                                  <td>Lampu senter</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_13']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_13'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_13'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_13']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_13'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_13'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_13'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_13'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_13']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_13'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_13'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_13'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_13'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_13']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_13'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_13'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>14</td>
                                  <td>Gelas untuk cuci mata</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_14']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_14'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_14'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_14']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_14'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_14'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_14'] == 2){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_14'] > 2){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_14']-2)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_14'] < 2){
                                          echo "<div style='color: red'>Kurang ".(2-$get_detailinspeksi_p3k['point_14'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_14'] == 3){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_14'] > 3){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_14']-3)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_14'] < 3){
                                          echo "<div style='color: red'>Kurang ".(3-$get_detailinspeksi_p3k['point_14'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>15</td>
                                  <td>Kantong plastik bersih</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_15']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_15'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_15'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_15']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_15'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_15'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_15'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_15'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_15']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_15'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_15'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_15'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_15'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_15']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_15'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_15'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>16</td>
                                  <td>Aquades (100 ml)</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_16']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_16'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_16'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_16']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_16'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_16'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_16'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_16'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_16']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_16'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_16'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_16'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_16'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_16']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_16'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_16'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>17</td>
                                  <td>Pavidon lodin (60 ml)</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_17']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_17'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_17'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_17']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_17'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_17'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_17'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_17'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_17']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_17'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_17'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_17'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_17'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_17']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_17'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_17'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>18</td>
                                  <td>Alkohol 70%</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_18']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_18'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_18'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_18']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_18'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_18'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_18'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_18'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_18']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_18'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_18'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_18'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_18'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_18']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_18'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_18'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>19</td>
                                  <td>Buku panduan P3K</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_19']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_19'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_19'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_19']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_19'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_19'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_19'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_19'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_19']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_19'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_19'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_19'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_19'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_19']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_19'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_19'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td>20</td>
                                  <td>Buku cararan daftar isi kotak</td>
                                  <td align="center"><?php echo $get_detailinspeksi_p3k['point_20']; ?></td>
                                  <td>
                                    <?php
                                      if($get_detailinspeksi_p3k['tipe_kotak'] == "A"){
                                        if($get_detailinspeksi_p3k['point_20'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_20'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_20']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_20'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_20'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "B"){
                                        if($get_detailinspeksi_p3k['point_20'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_20'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_20']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_20'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_20'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }elseif($get_detailinspeksi_p3k['tipe_kotak'] == "C"){
                                        if($get_detailinspeksi_p3k['point_20'] == 1){
                                          echo "<div style='color: green'>OKE</div>";
                                        }elseif($get_detailinspeksi_p3k['point_20'] > 1){
                                          echo "<div style='color: green'>Lebih ".($get_detailinspeksi_p3k['point_20']-1)."</div>";
                                        }elseif($get_detailinspeksi_p3k['point_20'] < 1){
                                          echo "<div style='color: red'>Kurang ".(1-$get_detailinspeksi_p3k['point_20'])."</div>";
                                        }else{
                                          echo "ERROR 2";
                                        }
                                      }else{
                                        echo "ERROR 1";
                                      }
                                    ?>
                                  </td>
                                </tr>
                              </table>

                              <table class="table table-sm" style="background-color: #e8e8e8; margin-bottom: 10px;">
                                <tr>
                                  <td><b>Catatan :</b> <?php echo $get_detailinspeksi_p3k['catatan']; ?></td>
                                </tr>
                              </table>

                              <table class="table table-sm" style="margin-top: 10px; margin-bottom: 10px; background-color: #e8e8e8;">
                                <tr>
                                  <td width="1%" align="center"><b>No</b></td>
                                  <td align="center"><b>Dokumentasi</b></td>
                                  <td width="1%" align="center"><b><span class="fa fa-trash" style="font-size: 16px"></span></b></td>
                                </tr>
                                <?php
                                  $jml_dokumentasi = 0;
                                  $no = 1;
                                  $q_get_dokumentasi_p3k = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotop3k WHERE detail_id = '$get_detailinspeksi_p3k[id]'");
                                  while($get_dokumentasi_p3k = mysqli_fetch_array($q_get_dokumentasi_p3k)){
                                ?>
                                  <tr>
                                    <td align="center" style="vertical-align: middle;"><?php echo $no; ?></td>
                                    <td align="center">
                                      <img src="../../role/HSE/foto_inspeksi_p3k/<?php echo $get_dokumentasi_p3k['foto']; ?>" width="70%"><br>
                                        <?php echo $get_dokumentasi_p3k['keterangan']; ?>
                                    </td>
                                    <td style="vertical-align: middle;">
                                      <a href="#modal" data-toggle='modal' data-target='#show_delete_dokumentasi_p3k' data-id='<?php echo $get_dokumentasi_p3k['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Foto">
                                        <span class="fa fa-trash" style="color: red; font-size: 14px;"></span>
                                      </a>
                                    </td>
                                  </tr>
                                <?php $jml_dokumentasi++; $no++; } ?>
                              </table>

                              <?php 
                                if($cek_dokumentasi == "Kurang"){
                                  $cek_dokumentasi = "Kurang";
                                }elseif($jml_dokumentasi >= 4){
                                  $cek_dokumentasi = "OKE";
                                }elseif($jml_dokumentasi < 4){
                                  $cek_dokumentasi = "Kurang";
                                }else{
                                  $cek_dokumentasi = "Error";
                                }
                              ?>

                              <?php if($jml_dokumentasi < 4){ ?>
                                <center style="margin-bottom: 5px;">
                                  <a href="#modal" data-toggle='modal' data-target='#show_add_dokumentasi_p3k' data-id='<?php echo $get_detailinspeksi_p3k['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Data P3K">
                                  <div class="btn btn-info btn-xs" style="font-size:11px;">
                                    <span class="fa fa-plus"></span> Tambah Dokumentasi
                                  </div>
                                  </a>
                                </center>
                              <?php } ?>
                              <center>
                                <a href="#modal" data-toggle='modal' data-target='#show_edit_data_p3k' data-id='<?php echo $get_detailinspeksi_p3k['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Data P3K">
                                  <div class="btn btn-secondary btn-xs" style="font-size:11px;">
                                    <span class="fa fa-pencil"></span> Edit Data P3K
                                  </div>
                                </a>

                                <a href="#modal" data-toggle='modal' data-target='#show_delete_data_p3k' data-id='<?php echo $get_detailinspeksi_p3k['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Data P3K">
                                  <div class="btn btn-danger btn-xs" style="font-size:11px;">
                                    <span class="fa fa-close"></span> Delete Data P3K
                                  </div>
                                </a>
                              </center>
                            </p>
                          </td>
                        </tr>
                      <?php $noList++; } ?>
                    </tbody>
                  </table>

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
                      <input type="hidden" name="kd_project" value="<?php echo $kd_project; ?>">
                      <a href="index.php?pages=detailproject&kd=<?php echo $kd_project; ?>" class="btn btn-info btn-sm"><span class="fa fa-reply"></span> Kembali</a>
                      
                      <?php $noList = $noList-1; ?>
                      <button onclick="return confirm('Yakin inspeksi P3K ini sudah lengkap dan sesuai ?')" class="btn btn-success btn-sm" name="submit_inspeksi_p3k" value="submit" <?php if($get_inspeksilist['ttd_hse'] == "" OR $get_inspeksilist['ttd_sm'] == "" OR $cek_dokumentasi == "Kurang" OR $jml_p3k_onsite['total_p3k_onsite'] > $noList){ echo "disabled"; } ?>>Submit</button>

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
  <div class="modal fade" id="show_add_data_p3k" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data P3K</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" method="POST" target="">
            <table class="table table-sm" style="font-size: 12px; margin-bottom: 0px;">
              <tr>
                <td width="60%"><b>Tipe Kotak</b></td>
                <td width="1%">:</td>
                <td>
                  <select name="tipe_kotak" style="width: 100%;" required>
                    <option value="" selected disabled>Pilih Tipe Kotak</option>
                    <option value="A">Tipe A</option>
                    <option value="B">Tipe B</option>
                    <option value="C">Tipe C</option>
                  </select>
                </td>
              </tr>
            </table>
            <table class="table table-sm" style="font-size: 12px;">
              <tr>
                <td width="75%">1. Kasa steril terbungkus</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_1" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">2. Perban (lebar 5 cm)</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_2" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">3. Perban (lebar 10 cm)</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_3" min="0" style="width: 100%" required></select>
                </td>
              </tr>
              <tr>
                <td width="75%">4. Plester (lebar 1,25 cm)</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_4" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">5. Plester Cepat</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_5" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">6. Kapas (25 gram)</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_6" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">7. Kain segitiga / Mitela</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_7" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">8. Gunting</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_8" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">9. Peniti</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_9" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">10. Sarung tangan sekali pakai</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_10" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">11. Masker</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_11" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">12. Pinest</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_12" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">13. Lampu senter</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_13" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">14. Gelas untuk cuci mata</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_14" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">15. Kantong plastik bersih</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_15" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">16. Aquades (100 ml)</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_16" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">17. Pavidon lodin (60 ml)</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_17" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">18. Alkohol 70%</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_18" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">19. Buku panduan P3K</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_19" min="0" style="width: 100%" required></td>
              </tr>
              <tr>
                <td width="75%">20. Buku cararan daftar isi kotak</td>
                <td width="1%">:</td>
                <td width=""><input type="number" name="point_20" min="0" style="width: 100%" required></td>
              </tr>
            </table>
            <table class="table table-sm" style="font-size: 12px;">
              <tr>
                <td width="20%">Catatan</td>
                <td width="1%">:</td>
                <td width=""><textarea name="catatan" style="width: 100%;" required></textarea></td>
              </tr>
            </table>
            <div style="text-align: center;">
              <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd']; ?>">
              <input type="submit" class="btn btn-info btn-sm" name="add_data_p3k" value="Tambah Data P3K">
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
  <div class="modal fade" id="show_edit_data_p3k" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data P3K</h4>
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
  <div class="modal fade" id="show_delete_data_p3k" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data P3K</h4>
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
  <div class="modal fade" id="show_add_dokumentasi_p3k" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Dokumentasi P3K</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm4" method="POST" target="" enctype="multipart/form-data">
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
  <div class="modal fade" id="show_delete_dokumentasi_p3k" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Dokumentasi P3K</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm5" method="POST" target="" enctype="multipart/form-data">
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