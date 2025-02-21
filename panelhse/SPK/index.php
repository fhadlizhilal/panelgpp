<?php
  error_reporting(0);
  ob_start(); 
  session_start();

  ini_set('memory_limit', '256M');

  require_once "../all_role/header.php";
  require_once "../../dev/config.php";

  // Fungsi untuk kompres gamber sebelum upload
  function compressImage($source, $destination, $quality) {
    // Membaca metadata gambar
    $info = getimagesize($source);

    // Menyesuaikan orientasi gambar jika diperlukan
    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        $exif = @exif_read_data($source);
        if($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if($orientation != 1){
                $deg = 0;
                switch ($orientation) {
                    case 3:
                        $deg = 180;
                        break;
                    case 6:
                        $deg = 270;
                        break;
                    case 8:
                        $deg = 90;
                        break;
                }
                $image = imagerotate($image, $deg, 0);
            }
        }
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    } elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
    } else {
        return false;
    }

    // Simpan gambar ke destinasi dengan kualitas tertentu
    imagejpeg($image, $destination, $quality);

    // Hapus gambar dari memori
    imagedestroy($image);

    return true;
  }

  if(isset($_POST['cek_nik'])){
    $q_getManpower = mysqli_query($conn, "SELECT * FROM hse_manpower WHERE nik = '$_POST[nik_manpower]'");
    $cek_nik = mysqli_num_rows($q_getManpower);

    if($cek_nik>0){
      $q_dataSPK = mysqli_query($conn, "SELECT * FROM hse_inductionreport_spk WHERE induction_id = '$_POST[spkid]' AND nik = '$_POST[nik_manpower]'");
      $get_dataSPK = mysqli_fetch_array($q_dataSPK);
      $cek_data_spk = mysqli_num_rows($q_dataSPK);

      if($cek_data_spk>0){
        header("location: index.php?pages=toreportspk&spkid=".$_POST['spkid']."&induction_spk_id=".$get_dataSPK['id']);
      }else{
        header("location: index.php?pages=formspk&spkid=".$_POST['spkid']."&nik=".$_POST['nik_manpower']);
      }
    }else{
      header("location: index.php?pages=formaddmanpower&spkid=".$_POST['spkid']."&nik=".$_POST['nik_manpower']);
    }
  }

  if(isset($_POST['submit_addmanpower&spk'])){
    $nodate = date('YmdHis');
    $uploadPath = "../../role/HSE/foto_manpower/";
    $uploadPath2 = "../../role/HSE/foto_ktp/";

    // jika form upload file sudah di submit :
    $status = $statusMsg = ''; 
    if(!empty($_FILES["file"]["name"]) OR !empty($_FILES["file2"]["name"])){
      // File info
      $fileName = $nodate."_".basename($_FILES["file"]["name"]);
      $imageUploadPath = $uploadPath . $fileName;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

      // File2 info
      $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]);
      $imageUploadPath2 = $uploadPath2 . $fileName2; 
      $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION); 
        
      // Tipe format yang diperbolehkan 
      $allowTypes = array('jpg','png','jpeg','gif'); 
      if(in_array($fileType, $allowTypes) AND in_array($fileType, $allowTypes)){ 
          // Image temp source 
          $imageTemp = $_FILES["file"]["tmp_name"];
          $imageTemp2 = $_FILES["file2"]["tmp_name"]; 
            
          // Ukuran Kompresi 60 (bisa diganti dengan yang lain)
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
            
          if($compressedImage AND $compressedImage2){
            $push_manpower = mysqli_query($conn, "INSERT INTO hse_manpower VALUES('','$_POST[nik]','$_POST[nama]','$_POST[tempat_lahir]','$_POST[tgl_lahir]','$_POST[golongan_darah]','$_POST[riwayat_penyakit]','$_POST[no_telpon]','$_POST[alamat]','$_POST[posisi_kerja]','$_POST[nama_kerabat]','$_POST[hubungan_kerabat]','$_POST[no_telpon_kerabat]','$fileName', '$fileName2')");

            if($push_manpower){
              $_SESSION['alert_success'] = "Berhasil! Data anda berhasil disimpan didata manpower";
              // $spkid = $_POST['spkid'];
              // header("Location: index.php?pages=ceknik&spkid=".$_POST['spkid']);
              // exit;
            }else{
              unlink("../../role/HSE/foto_manpower/".$fileName);
              unlink("../../role/HSE/foto_ktp/".$fileName2);
              $_SESSION['alert_error'] = "Gagal! Data Anda Gagal Disubmit <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("../../role/HSE/foto_manpower/".$fileName);
            unlink("../../role/HSE/foto_ktp/".$fileName2);
            $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("../../role/HSE/foto_manpower/".$fileName);
          unlink("../../role/HSE/foto_ktp/".$fileName2);
          $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
        } 
    }else{
      $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
    }
  }

  if(isset($_POST['edit_data_pribadi'])){
    $nodate = date('YmdHis');
    $uploadPath = "../../role/HSE/foto_manpower/";
    $uploadPath2 = "../../role/HSE/foto_ktp/";

    // jika form upload file sudah di submit :
    if(!empty($_FILES["file"]["name"]) AND empty($_FILES["file2"]["name"])){ 
      // File info 
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
            //Delete Foto Lama
            $get_data_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE nik = '$_POST[nik_old]'"));

            $edit_data_pribadi = mysqli_query($conn, "UPDATE hse_manpower SET nik = '$_POST[nik]', nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', foto = '$fileName', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]' WHERE nik = '$_POST[nik_old]'");

            if($edit_data_pribadi){
              unlink("../../role/HSE/foto_manpower/".$get_data_old['foto']);
              $_SESSION['alert_success'] = "Berhasil! Data anda berhasil disimpan didata manpower";
              // $spkid = $_POST['spkid'];
              // header("Location: index.php?pages=ceknik&spkid=".$_POST['spkid']);
              // exit;
            }else{
              unlink("../../role/HSE/foto_manpower/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Data Anda Gagal Disubmit <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("../../role/HSE/foto_manpower/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("../../role/HSE/foto_manpower/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
        } 

    }elseif(empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])){ 
      // File info
      $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]); 
      $imageUploadPath2 = $uploadPath2.$fileName2; 
      $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION); 
        
      // Tipe format yang diperbolehkan 
      $allowTypes = array('jpg','png','jpeg','gif'); 
      if(in_array($fileType2, $allowTypes)){ 
          // Image temp source 
          $imageTemp2 = $_FILES["file2"]["tmp_name"]; 
            
          // Ukuran Kompresi 60 (bisa diganti dengan yang lain)
          $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
            
          if($compressedImage2){
            //Delete Foto Lama
            $get_data_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE nik = '$_POST[nik_old]'"));

            $edit_data_pribadi = mysqli_query($conn, "UPDATE hse_manpower SET nik = '$_POST[nik]', nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', ktp = '$fileName2', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]' WHERE nik = '$_POST[nik_old]'");

            if($edit_data_pribadi){
              unlink("../../role/HSE/foto_ktp/".$get_data_old['ktp']);
              $_SESSION['alert_success'] = "Berhasil! Data anda berhasil disimpan didata manpower";
              // $spkid = $_POST['spkid'];
              // header("Location: index.php?pages=ceknik&spkid=".$_POST['spkid']);
              // exit;
            }else{
              unlink("../../role/HSE/foto_ktp/".$fileName2);
              $_SESSION['alert_error'] = "Gagal! Data Anda Gagal Disubmit <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("../../role/HSE/foto_ktp/".$fileName2);
            $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("../../role/HSE/foto_ktp/".$fileName2);
          $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
        } 

    }elseif(!empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])){ 
      // File info 
      $fileName = $nodate."_".basename($_FILES["file"]["name"]); 
      $imageUploadPath = $uploadPath . $fileName; 
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

      // File2 info 
      $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]); 
      $imageUploadPath2 = $uploadPath2.$fileName2; 
      $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION); 
        
      // Tipe format yang diperbolehkan 
      $allowTypes = array('jpg','png','jpeg','gif'); 
      if(in_array($fileType, $allowTypes) AND in_array($fileType2, $allowTypes)){ 
          // Image temp source 
          $imageTemp = $_FILES["file"]["tmp_name"];
          $imageTemp2 = $_FILES["file2"]["tmp_name"]; 
            
          // Ukuran Kompresi 60 (bisa diganti dengan yang lain)
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
            
          if($compressedImage){
            //Delete Foto Lama
            $get_data_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE nik = '$_POST[nik_old]'"));

            $edit_data_pribadi = mysqli_query($conn, "UPDATE hse_manpower SET nik = '$_POST[nik]', nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', foto = '$fileName', ktp = '$fileName2', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]' WHERE nik = '$_POST[nik_old]'");

            if($edit_data_pribadi){
              unlink("../../role/HSE/foto_manpower/".$get_data_old['foto']);
              unlink("../../role/HSE/foto_ktp/".$get_data_old['ktp']);
              $_SESSION['alert_success'] = "Berhasil! Data anda berhasil disimpan didata manpower";
              // $spkid = $_POST['spkid'];
              // header("Location: index.php?pages=ceknik&spkid=".$_POST['spkid']);
              // exit;
            }else{
              unlink("../../role/HSE/foto_manpower/".$fileName);
              unlink("../../role/HSE/foto_ktp/".$fileName2);
              $_SESSION['alert_error'] = "Gagal! Data Anda Gagal Disubmit <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("../../role/HSE/foto_manpower/".$fileName);
            unlink("../../role/HSE/foto_ktp/".$fileName2);
            $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("../../role/HSE/foto_manpower/".$fileName);
          unlink("../../role/HSE/foto_ktp/".$fileName2);
          $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
        } 

    }else{
      $edit_data_pribadi = mysqli_query($conn, "UPDATE hse_manpower SET nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]' WHERE nik = '$_POST[nik_old]'");

      if($edit_data_pribadi){
        $_SESSION['alert_success'] = "Berhasil! Data anda berhasil disimpan didata manpowerzzzz";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Anda Gagal Disubmit <br>".mysqli_error($conn);
      }
    }
  }

  if (isset($_POST['submit_spk'])) {
    $spkid = $_POST['spkid'];
    $nik = $_POST['nik'];
    $signatureImage = $_POST['signatureImage'];

    $getManpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE nik = '$nik'"));

    // Decode the base64 encoded image
    list($type, $data) = explode(';', $signatureImage);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    // Set the file path to save the image (Format Name Image : nama manpower_spkid_uniqid.png)
    $fileName = $getManpower['nama'].'_'.$spkid.'_'.uniqid().'.png';
    $filePath = 'signatures/'.$fileName;
    // Save the image
    file_put_contents($filePath, $data);

    $fileFoto = '../../role/HSE/foto_manpower/'.$getManpower['foto'];
    $newfileFoto = '../../panelhse/SPK/foto_diri/'.$getManpower['foto'];

    if (!copy($fileFoto, $newfileFoto)) {
      $_SESSION['alert_error'] = "Gagal! Foto Diri Gagal Disalin. Silahkan ganti foto diri terlebih dahulu";
      echo "<meta http-equiv='refresh' content='0; url=index.php?pages=formspk&spkid=$spkid&nik=$nik'>";
    }else{
      $push_data_spk = mysqli_query($conn, "INSERT INTO hse_inductionreport_spk VALUES('','$spkid','$nik','$getManpower[nama]','$getManpower[tempat_lahir]','$getManpower[tgl_lahir]','$getManpower[golongan_darah]','$getManpower[riwayat_penyakit]','$getManpower[no_telpon]','$getManpower[alamat]','$getManpower[posisi_kerja]','$getManpower[nama_kerabat]','$getManpower[hubungan_kerabat]','$getManpower[no_telpon_kerabat]','$getManpower[foto]', '$fileName')");
       $last_id = $conn->insert_id;

      if($push_data_spk){
        $_SESSION['alert_success'] = "Berhasil! SPK Berhasil Ditanda Tangan";
        echo "<meta http-equiv='refresh' content='0; url=index.php?pages=reportspk&induction_spk_id=$last_id'>";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data SPK Gagal Disubmit ".mysqli_error($conn);
        echo "<meta http-equiv='refresh' content='0'>";
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
</style>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php
    if(!isset($_GET['pages'])){
      echo "Halaman Tidak Tersedia";
    }elseif($_GET['pages'] == "formspk"){
      require_once "form_spk.php";
    }elseif($_GET['pages'] == "ceknik"){
      require_once "cek_nik.php";
    }elseif($_GET['pages'] == "reportspk"){
      require_once "report_spk.php";
    }elseif($_GET['pages'] == "toreportspk"){
      require_once "data_spk_sudah_ada.php";
    }elseif($_GET['pages'] == "formaddmanpower"){
      require_once "data_spk_belum_ada.php";
    }
  ?>
  <!-- ISI KONTEN -->

</div>
</body>
<!-- ./wrapper -->

<?php require_once "../all_role/footer.php"; ?>