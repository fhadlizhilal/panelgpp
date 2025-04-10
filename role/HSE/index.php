<?php
  error_reporting(0);
  ob_start(); 
  session_start();

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "HSE"){
    header("location: ../../login.php");
  }

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

  if(isset($_POST['submit_add_hseuser'])){
    if($_POST['submit_add_hseuser'] == "Submit"){
      $push_hseuser = mysqli_query($conn, "INSERT INTO hse_user VALUES('','$_POST[manpower_id]','$_POST[username]','$_POST[password]')");

      if($push_hseuser){
        $_SESSION['alert_success'] = "Berhasil! User HSE Baru Berhasil Disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! User HSE Baru Gagal Disimpan";
      }
    }
  }

  if(isset($_POST['submit_edit_hseuser'])){
    if($_POST['submit_edit_hseuser'] == "Simpan"){
      $push_edit_hseuser = mysqli_query($conn, "UPDATE hse_user SET username = '$_POST[username]', password = '$_POST[password]' WHERE id = '$_POST[id]'");

      if($push_edit_hseuser){
        $_SESSION['alert_success'] = "Berhasil! User HSE Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! User HSE Gagal Diubah";
      }
    }
  }

  if(isset($_POST['delete_userhse'])){
    if($_POST['delete_userhse'] == 'Delete'){
      $push_delete_hseuser = mysqli_query($conn, "DELETE FROM hse_user WHERE id = '$_POST[id]'");

      if($push_delete_hseuser){
        $_SESSION['alert_success'] = "Berhasil! User HSE Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! User HSE Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['submit_add_manpower'])){
    if($_POST['submit_add_manpower'] == "Submit"){
      if($_FILES["file"]["name"] != ""){
        $target_dir = "foto_manpower/";
        $nodate = date('YmdHis');
        $target_file = $target_dir.$nodate."_".basename($_FILES["file"]["name"]);
        $nama_file_foto = $nodate."_".basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file size is less than or equal to 1MB
        if ($_FILES["file"]["size"] > 1048576) {
            $alert_error = "Maaf, ukuran file terlalu besar. File harus kurang dari atau sama dengan 1MB.";
            $uploadOk = 0;
        }

        // Check file type
        if($fileType != "png" && $fileType != "jpg") {
            $alert_error = "Hanya file png atau jpg yang diperbolehkan.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['alert_error'] = $alert_error;
        }else{
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
              $push_manpower = mysqli_query($conn, "INSERT INTO hse_manpower VALUES('','$_POST[nik]','$_POST[nama]','$_POST[tempat_lahir]','$_POST[tgl_lahir]','$_POST[golongan_darah]','$_POST[riwayat_penyakit]','$_POST[no_telpon]','$_POST[alamat]','$_POST[posisi_kerja]','$_POST[nama_kerabat]','$_POST[hubungan_kerabat]','$_POST[no_telpon_kerabat]','$nama_file_foto')");
              
              if($push_manpower){
                $_SESSION['alert_success'] = "Berhasil! Data Manpower Baru Berhasil Disimpan";
              }else{
                $_SESSION['alert_error'] = "Gagal! Data Mapower Baru Gagal Disimpan";
              }
          }else{
            $_SESSION['alert_error'] = "Maaf, terjadi kesalahan saat mengunggah file.";
          }
        }
      }else{
        $push_manpower = mysqli_query($conn, "INSERT INTO hse_manpower VALUES('','$_POST[nik]','$_POST[nama]','$_POST[tempat_lahir]','$_POST[tgl_lahir]','$_POST[golongan_darah]','$_POST[riwayat_penyakit]','$_POST[no_telpon]','$_POST[alamat]','$_POST[posisi_kerja]','$_POST[nama_kerabat]','$_POST[hubungan_kerabat]','$_POST[no_telpon_kerabat]','')");

        if($push_manpower){
          $_SESSION['alert_success'] = "Berhasil! Data Manpower Baru Berhasil Disimpan";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Mapower Baru Gagal Disimpan";
        }
      }  
    }
  }

  if(isset($_POST['submit_add_manpower_v2'])){
    if($_POST['submit_add_manpower_v2'] == "Submit"){
      if($_FILES["file"]["name"] != "" OR $_FILES["file2"]["name"] != ""){
        
        $nodate = date('YmdHis');
        // ini adalah path folder upload yang sudah kita buat
        $uploadPath = "foto_manpower/"; 
        $uploadPath2 = "foto_ktp/"; 
          
        if(!empty($_FILES["file"]["name"]) AND empty($_FILES["file2"]["name"])) {
            // File info
            $fileName = $nodate."_".basename($_FILES["file"]["name"]);
            $imageUploadPath = $uploadPath . $fileName; 
            $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
              
            // Tipe format yang diperbolehkan
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes)){
                // Image temp source
                $imageTemp = $_FILES["file"]["tmp_name"];
                  
                // Ukuran Kompresi 20 (bisa diganti dengan yang lain)
                $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
                  
                if($compressedImage){
                  $push_manpower = mysqli_query($conn, "INSERT INTO hse_manpower VALUES('','$_POST[nik]','$_POST[nama]','$_POST[tempat_lahir]','$_POST[tgl_lahir]','$_POST[golongan_darah]','$_POST[riwayat_penyakit]','$_POST[no_telpon]','$_POST[alamat]','$_POST[posisi_kerja]','$_POST[nama_kerabat]','$_POST[hubungan_kerabat]','$_POST[no_telpon_kerabat]','$fileName','')");
        
                  if($push_manpower){
                    $_SESSION['alert_success'] = "Berhasil! Data Manpower Baru Berhasil Disimpan";
                  }else{
                    $_SESSION['alert_error'] = "Gagal! Data Mapower Baru Gagal Disimpan";
                  }
                }else{
                  $_SESSION['alert_error'] = "Gagal! Data Mapower Baru Gagal Disimpan, File foto tidak dapat dikompresi";
                }
            }else{
              $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            }

        }elseif(empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])) {
            // File info
            $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]);
            $imageUploadPath2 = $uploadPath2 . $fileName2;
            $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);
              
            // Tipe format yang diperbolehkan 
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType2, $allowTypes)){
              // Image temp source
              $imageTemp2 = $_FILES["file2"]["tmp_name"];
                
              // Ukuran Kompresi 20 (bisa diganti dengan yang lain)
              $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
                
              if($compressedImage2){
                $push_manpower = mysqli_query($conn, "INSERT INTO hse_manpower VALUES('','$_POST[nik]','$_POST[nama]','$_POST[tempat_lahir]','$_POST[tgl_lahir]','$_POST[golongan_darah]','$_POST[riwayat_penyakit]','$_POST[no_telpon]','$_POST[alamat]','$_POST[posisi_kerja]','$_POST[nama_kerabat]','$_POST[hubungan_kerabat]','$_POST[no_telpon_kerabat]','','$fileName2')");
      
                if($push_manpower){
                  $_SESSION['alert_success'] = "Berhasil! Data Manpower Baru Berhasil Disimpan";
                }else{
                  $_SESSION['alert_error'] = "Gagal! Data Mapower Baru Gagal Disimpan";
                }
              }else{
                  $_SESSION['alert_error'] = "Gagal! Data Mapower Baru Gagal Disimpan, File foto tidak dapat dikompresi";
              }
            }else{
              $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            }

        }elseif(!empty($_FILES["file"]["name"]) && !empty($_FILES["file2"]["name"])) {
            // File info 
            $fileName = $nodate."_".basename($_FILES["file"]["name"]); 
            $imageUploadPath = $uploadPath . $fileName; 
            $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

            //File2 Info
            $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]);
            $imageUploadPath2 = $uploadPath2 . $fileName2;
            $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);
              
            // Tipe format yang diperbolehkan
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes) AND in_array($fileType2, $allowTypes)){
                // Image temp source
                $imageTemp = $_FILES["file"]["tmp_name"];
                $imageTemp2 = $_FILES["file2"]["tmp_name"];
                  
                // Ukuran Kompresi 20 (bisa diganti dengan yang lain)
                $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
                $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
                  
                if($compressedImage AND $compressedImage2){ 
                  $push_manpower = mysqli_query($conn, "INSERT INTO hse_manpower VALUES('','$_POST[nik]','$_POST[nama]','$_POST[tempat_lahir]','$_POST[tgl_lahir]','$_POST[golongan_darah]','$_POST[riwayat_penyakit]','$_POST[no_telpon]','$_POST[alamat]','$_POST[posisi_kerja]','$_POST[nama_kerabat]','$_POST[hubungan_kerabat]','$_POST[no_telpon_kerabat]','$fileName','$fileName2')");
        
                  if($push_manpower){
                    $_SESSION['alert_success'] = "Berhasil! Data Manpower Baru Berhasil Disimpan";
                  }else{
                    $_SESSION['alert_error'] = "Gagal! Data Mapower Baru Gagal Disimpan";
                  }
                }else{ 
                    $_SESSION['alert_error'] = "Gagal! Data Mapower Baru Gagal Disimpan, File foto tidak dapat dikompresi";
                } 
            }else{
              $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            } 
        }else{
          $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
        }

      }else{
        $push_manpower = mysqli_query($conn, "INSERT INTO hse_manpower VALUES('','$_POST[nik]','$_POST[nama]','$_POST[tempat_lahir]','$_POST[tgl_lahir]','$_POST[golongan_darah]','$_POST[riwayat_penyakit]','$_POST[no_telpon]','$_POST[alamat]','$_POST[posisi_kerja]','$_POST[nama_kerabat]','$_POST[hubungan_kerabat]','$_POST[no_telpon_kerabat]','','')");

        if($push_manpower){
          $_SESSION['alert_success'] = "Berhasil! Data Manpower Baru Berhasil Disimpan";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Mapower Baru Gagal Disimpan";
        }
      }
    }
  }

  if(isset($_POST['submit_edit_manpower'])){
    if($_POST['submit_edit_manpower'] == "Simpan"){
      if($_FILES["file"]["name"] != ""){
        $target_dir = "foto_manpower/";
        $nodate = date('YmdHis');
        $target_file = $target_dir.$nodate."_".basename($_FILES["file"]["name"]);
        $nama_file_foto = $nodate."_".basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file size is less than or equal to 1MB
        if ($_FILES["file"]["size"] > 1048576) {
            $alert_error = "Maaf, ukuran file terlalu besar. File harus kurang dari atau sama dengan 1MB.";
            $uploadOk = 0;
        }

        // Check file type
        if($fileType != "png" && $fileType != "jpg") {
            $alert_error = "Hanya file png atau jpg yang diperbolehkan.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['alert_error'] = $alert_error;
        } else {
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
              $get_foto_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$_POST[id]'"));
              $foto_old = $get_foto_old['foto'];
              $push_edit_manpower = mysqli_query($conn, "UPDATE hse_manpower SET nik = '$_POST[nik]', nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]', foto = '$nama_file_foto' WHERE id = '$_POST[id]'");
              if($push_edit_manpower){
                unlink("foto_manpower/".$foto_old);
                $_SESSION['alert_success'] = "Berhasil! Data Manpower Berhasil Diubah";
              }else{
                $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Diubah";
              }
          } else {
              $_SESSION['alert_error'] = "Maaf, terjadi kesalahan saat mengunggah file.";
          }
        }
      }else{
        $push_edit_manpower = mysqli_query($conn, "UPDATE hse_manpower SET nik = '$_POST[nik]', nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]' WHERE id = '$_POST[id]'");

        if($push_edit_manpower){
          $_SESSION['alert_success'] = "Berhasil! Data Manpower Berhasil Diubah";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Diubah";
        }
      }
    }
  }

  if(isset($_POST['submit_edit_manpower_v2'])){
    if($_POST['submit_edit_manpower_v2'] == "Simpan"){
      if($_FILES["file"]["name"] != "" OR $_FILES["file2"]["name"] != ""){
        
        $nodate = date('YmdHis');
        // ini adalah path folder upload yang sudah kita buat
        $uploadPath = "foto_manpower/"; 
        $uploadPath2 = "foto_ktp/"; 
          
        if(!empty($_FILES["file"]["name"]) AND empty($_FILES["file2"]["name"])) {
            // File info
            $fileName = $nodate."_".basename($_FILES["file"]["name"]);
            $imageUploadPath = $uploadPath . $fileName; 
            $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
              
            // Tipe format yang diperbolehkan
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes)){
                // Image temp source
                $imageTemp = $_FILES["file"]["tmp_name"];
                  
                // Ukuran Kompresi 20 (bisa diganti dengan yang lain)
                $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
                  
                if($compressedImage){
                  $get_foto_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$_POST[id]'"));
                  $foto_old = $get_foto_old['foto'];
                  $push_edit_manpower = mysqli_query($conn, "UPDATE hse_manpower SET nik = '$_POST[nik]', nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]', foto = '$fileName' WHERE id = '$_POST[id]'");
        
                  if($push_edit_manpower){
                    unlink("foto_manpower/".$foto_old);
                    $_SESSION['alert_success'] = "Berhasil! Data Manpower Berhasil Diubah";
                  }else{
                    $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Diubah";
                  }
                }else{
                  $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Diubah, File foto tidak dapat dikompresi";
                }
            }else{
              $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            }

        }elseif(empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])) {
            // File info
            $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]);
            $imageUploadPath2 = $uploadPath2 . $fileName2;
            $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);
              
            // Tipe format yang diperbolehkan 
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType2, $allowTypes)){
              // Image temp source
              $imageTemp2 = $_FILES["file2"]["tmp_name"];
                
              // Ukuran Kompresi 20 (bisa diganti dengan yang lain)
              $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
                
              if($compressedImage2){
                $get_ktp_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$_POST[id]'"));
                $ktp_old = $get_ktp_old['ktp'];
                $push_edit_manpower = mysqli_query($conn, "UPDATE hse_manpower SET nik = '$_POST[nik]', nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]', ktp = '$fileName2' WHERE id = '$_POST[id]'");
      
                if($push_edit_manpower){
                  unlink("foto_ktp/".$ktp_old);
                  $_SESSION['alert_success'] = "Berhasil! Data Manpower Berhasil Diubah";
                }else{
                  $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Diubah";
                }
              }else{
                  $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Diubah, File foto tidak dapat dikompresi";
              }
            }else{
              $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            }

        }elseif(!empty($_FILES["file"]["name"]) && !empty($_FILES["file2"]["name"])) {
            // File info 
            $fileName = $nodate."_".basename($_FILES["file"]["name"]); 
            $imageUploadPath = $uploadPath . $fileName; 
            $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

            //File2 Info
            $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]);
            $imageUploadPath2 = $uploadPath2 . $fileName2;
            $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);
              
            // Tipe format yang diperbolehkan
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes) AND in_array($fileType2, $allowTypes)){
                // Image temp source
                $imageTemp = $_FILES["file"]["tmp_name"];
                $imageTemp2 = $_FILES["file2"]["tmp_name"];
                  
                // Ukuran Kompresi 20 (bisa diganti dengan yang lain)
                $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
                $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
                  
                if($compressedImage AND $compressedImage2){
                  $get_data_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$_POST[id]'"));
                  $foto_old = $get_data_old['foto'];
                  $ktp_old = $get_data_old['ktp'];

                  $push_edit_manpower = mysqli_query($conn, "UPDATE hse_manpower SET nik = '$_POST[nik]', nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]', foto = '$fileName', ktp = '$fileName2' WHERE id = '$_POST[id]'");
        
                  if($push_edit_manpower){
                    unlink("foto_manpower/".$foto_old);
                    unlink("foto_ktp/".$ktp_old);
                    $_SESSION['alert_success'] = "Berhasil! Data Manpower Berhasil Diubah";
                  }else{
                    $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Diubah";
                  }
                }else{
                    $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Diubah, File foto tidak dapat dikompresi";
                } 
            }else{
              $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            } 
        }else{
          $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
        }

      }else{
        $push_edit_manpower = mysqli_query($conn, "UPDATE hse_manpower SET nik = '$_POST[nik]', nama = '$_POST[nama]', tempat_lahir = '$_POST[tempat_lahir]', tgl_lahir = '$_POST[tgl_lahir]', golongan_darah = '$_POST[golongan_darah]', riwayat_penyakit = '$_POST[riwayat_penyakit]', no_telpon = '$_POST[no_telpon]', alamat = '$_POST[alamat]', posisi_kerja = '$_POST[posisi_kerja]', nama_kerabat = '$_POST[nama_kerabat]', hubungan_kerabat = '$_POST[hubungan_kerabat]', no_telpon_kerabat = '$_POST[no_telpon_kerabat]' WHERE id = '$_POST[id]'");

        if($push_edit_manpower){
          $_SESSION['alert_success'] = "Berhasil! Data Manpower Berhasil Diubah";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Diubah";
        }
      }
    }
  }

  if(isset($_POST['delete_manpower'])){
    if($_POST['delete_manpower'] == "Delete"){
      $get_dataOld = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$_POST[id]'"));
      $nama_foto = $get_dataOld["foto"];
      $nama_ktp = $get_dataOld["ktp"];
      $delete_manpower = mysqli_query($conn, "DELETE FROM hse_manpower WHERE id = '$_POST[id]'");

      if($delete_manpower){
        unlink("foto_manpower/".$nama_foto);
        unlink("foto_ktp/".$nama_ktp);
        $_SESSION['alert_success'] = "Berhasil! Data Manpower Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Mapower Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['submit_add_project'])){
    if($_POST['submit_add_project'] == "Submit"){
      $push_project = mysqli_query($conn, "INSERT INTO hse_project VALUES('','$_POST[nama_project]','$_POST[kota]','$_POST[hse_officer]','$_POST[tgl_start]',NULL,'$_POST[jam_masuk]','$_POST[jam_pulang]','ongoing')");
      $get_IDMax = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = (SELECT MAX(id) FROM hse_project)"));
      $push_project_log = mysqli_query($conn, "INSERT INTO hse_project_log VALUES('','$get_IDMax[id]','created','Project Dibuat',CURRENT_TIMESTAMP)");

      if($push_project && $push_project_log){
        $_SESSION['alert_success'] = "Berhasil! Data Project Berhasil ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Project Gagal Ditambahkan";
      }
    }
  }

  if(isset($_POST['submit_edit_project'])){
    if($_POST['submit_edit_project'] == "Simpan"){
      //get data project sebelum di ubah
      $get_projectold = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$_POST[id]'"));
      $nm_project_old = $get_projectold['nama_project'];
      $kota_old = $get_projectold['kota'];
      $tgl_start_old = $get_projectold['tgl_start'];
      $tgl_end_old = $get_projectold['tgl_end'];
      $jam_masuk_old = $get_projectold['jam_masuk'];
      $jam_pulang_old = $get_projectold['jam_pulang'];

      $keterangan_edit = "Data project dibuah, dari<br> Nama Project : ".$nm_project_old."<br> Kota : ".$kota_old."<br> Jam Masuk : ".$jam_masuk_old."<br> Jam Pulang : ".$jam_pulang_old."<br> Tgl Start : ".$tgl_start_old."<br> Tgl End : ".$tgl_end_old."<br><br>Menjadi<br> Nama Project : ".$_POST['nama_project']."<br> Kota : ".$_POST['kota']."<br> Jam Masuk : ".$_POST['jam_masuk']."<br> Jam Pulang : ".$_POST['jam_pulang']."<br> Tgl Start : ".$_POST['tgl_start']."<br> Tgl End : ".$_POST['tgl_end'];

      if($_POST['tgl_end'] == ""){
        $push_edit_project = mysqli_query($conn, "UPDATE hse_project SET nama_project = '$_POST[nama_project]', kota = '$_POST[kota]', tgl_start = '$_POST[tgl_start]', tgl_end = NULL, jam_masuk = '$_POST[jam_masuk]', jam_pulang = '$_POST[jam_pulang]' WHERE id = '$_POST[id]'");
      }else{
        $push_edit_project = mysqli_query($conn, "UPDATE hse_project SET nama_project = '$_POST[nama_project]', kota = '$_POST[kota]', tgl_start = '$_POST[tgl_start]', tgl_end = '$_POST[tgl_end]', jam_masuk = '$_POST[jam_masuk]', jam_pulang = '$_POST[jam_pulang]' WHERE id = '$_POST[id]'");
      }

      $push_project_log = mysqli_query($conn, "INSERT INTO hse_project_log VALUES('','$_POST[id]','edited','$keterangan_edit',CURRENT_TIMESTAMP)");

      if($push_edit_project && $push_project_log){
        $_SESSION['alert_success'] = "Berhasil! Data Project Berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Project Gagal diubah";
      }
    }
  }

  if(isset($_POST['submit_handover_project'])){
    if($_POST['submit_handover_project'] == "Handover"){
      $push_handover = mysqli_query($conn, "UPDATE hse_project SET hse_officer = '$_POST[handover_to]' WHERE id = '$_POST[id]'");

      $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$_POST[handover_to]'"));
      $ket_handover = "Handover HSE Officer dari <b>".$_POST['hse_officer_nama']."</b> Menjadi <b>".$get_manpower['nama']."</b>";
      $push_project_log = mysqli_query($conn, "INSERT INTO hse_project_log VALUES('','$_POST[id]','handover','$ket_handover',CURRENT_TIMESTAMP)");

      if($push_handover && $push_project_log){
        $_SESSION['alert_success'] = "Berhasil! Project Berhasil Dihandover";
      }else{
        $_SESSION['alert_error'] = "Gagal! Project Gagal Dihanover";
      }
    }
  }

  if(isset($_POST['delete_hseproject'])){
    if($_POST['delete_hseproject'] == "Delete"){
      // Try Delete Project Log
      $datake = 0;
      $q_get_project_log = mysqli_query($conn, "SELECT * FROM hse_project_log WHERE hse_projectid = '$_POST[id]'");
      while($get_project_log = mysqli_fetch_array($q_get_project_log)){
        $dataid[$datake] = $get_project_log['id'];
        $hse_projectid[$datake] = $get_project_log['hse_projectid'];
        $statusLog[$datake] = $get_project_log['status_log'];
        $keterangan[$datake] = $get_project_log['keterangan'];
        $created_at[$datake] = $get_project_log['created_at'];

        $datake++;
      }

      $delete_hseproject_log = mysqli_query($conn, "DELETE FROM hse_project_log WHERE hse_projectid = '$_POST[id]'");

      if($delete_hseproject_log){
        $delete_hseproject = mysqli_query($conn, "DELETE FROM hse_project WHERE id = '$_POST[id]'");

        if($delete_hseproject){
          $_SESSION['alert_success'] = "Berhasil! Data Project Berhasil Dihapus";
        }else{
          for($x=0;$x<=$datake;$x++){
            mysqli_query($conn, "INSERT INTO hse_project_log VALUES('$dataid[$x]','$hse_projectid[$x]','$statusLog[$x]','$keterangan[$x]','$created_at[$x]')");
          }
          $_SESSION['alert_error'] = "Gagal! Data Project Gagal Dihapus Karena Sudah Terisi Data";
        }
      }
    }
  }

  if(isset($_POST['submit_add_jabatan'])){
    if($_POST['submit_add_jabatan'] == "Submit"){
      $push_jabatan = mysqli_query($conn, "INSERT INTO hse_jabatan VALUES('','$_POST[jabatan]')");

      if($push_jabatan){
        $_SESSION['alert_success'] = "Berhasil! Data Jabatan Baru Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Jabatan Baru Gagal Ditambahkan";
      }
    }
  }

  if(isset($_POST['submit_edit_jabatan'])){
    if($_POST['submit_edit_jabatan'] == "Simpan"){
      $push_edit_jabatan = mysqli_query($conn, "UPDATE hse_jabatan SET id = '$_POST[id_jabatan]', jabatan = '$_POST[jabatan]' WHERE id = '$_POST[id]'");

      if($push_edit_jabatan){
        $_SESSION['alert_success'] = "Berhasil! Data Jabatan Berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Jabatan Gagal Diubah";
      }
    }
  }

  if(isset($_POST['delete_hsejabatan'])){
    if($_POST['delete_hsejabatan']){
      $delete_hsejabatan = mysqli_query($conn, "DELETE FROM hse_jabatan WHERE id = '$_POST[id]'");

      if($delete_hsejabatan){
        $_SESSION['alert_success'] = "Berhasil! Data Jabatan Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Jabatan Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['submit_add_tools'])){
    if($_POST['submit_add_tools'] == "Submit"){
      $push_hsetools = mysqli_query($conn, "INSERT INTO hse_tools VALUES('','$_POST[tools]')");

      if($push_hsetools){
        $_SESSION['alert_success'] = "Berhasil! Data Tools Baru Berhasil Disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Tools Baru Gagal Disimpan";
      }
    }
  }

  if(isset($_POST['submit_edit_tools'])){
    if($_POST['submit_edit_tools'] == "Simpan"){
      $push_edit_tools = mysqli_query($conn, "UPDATE hse_tools SET tools = '$_POST[tools]' WHERE id = '$_POST[id]'");

      if($push_edit_tools){
        $_SESSION['alert_success'] = "Berhasil! Data Tools Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Tools Gagal Diubah";
      }
    }
  }

  if(isset($_POST['delete_hsetools'])){
    if($_POST['delete_hsetools'] == 'Delete'){
      $delete_tools = mysqli_query($conn, "DELETE FROM hse_tools WHERE id = '$_POST[id]'");

      if($delete_tools){
        $_SESSION['alert_success'] = "Berhasil! Data Tools Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Tools Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['submit_add_toolsk3'])){
    if($_POST['submit_add_toolsk3'] == "Submit"){
      $push_toolsk3 = mysqli_query($conn, "INSERT INTO hse_toolsk3 VALUES('','$_POST[nama_tools]')");

      if($push_toolsk3){
        $_SESSION['alert_success'] = "Berhasil! Data Tools K3 Baru Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Tools K3 Baru Gagal Ditambahkan";
      }
    }
  }

  if(isset($_POST['submit_edit_toolsk3'])){
    if($_POST['submit_edit_toolsk3'] == "Simpan"){
      $edit_toolsk3 = mysqli_query($conn, "UPDATE hse_toolsk3 SET nama_tools = '$_POST[nama_tools]' WHERE id = '$_POST[id]'");

      if($edit_toolsk3){
        $_SESSION['alert_success'] = "Berhasil! Data Tools K3 Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Tools K3 Gagal Diubah";
      }
    }
  }

  if(isset($_POST['delete_hsetoolsk3'])){
    if($_POST['delete_hsetoolsk3'] == "Delete"){
      $delete_hsetoolsk3 = mysqli_query($conn, "DELETE FROM hse_toolsk3 WHERE id = '$_POST[id]'");

      if($delete_hsetoolsk3){
        $_SESSION['alert_success'] = "Berhasil! Data Tools K3 Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Tools K3 Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['submit_add_apd'])){
    if($_POST['submit_add_apd'] == "Submit"){
      $push_hseapd = mysqli_query($conn, "INSERT INTO hse_apd VALUES('','$_POST[jenis_apd]','$_POST[nama_apd]','$_POST[satuan]')");

      if($push_hseapd){
        $_SESSION['alert_success'] = "Berhasil! Data APD Baru Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data APD Baru Gagal Ditambahkan";
      }
    }
  }

  if(isset($_POST['submit_edit_hseapd'])){
    if($_POST['submit_edit_hseapd'] == "Simpan"){
      $edit_hseapd = mysqli_query($conn, "UPDATE hse_apd SET jenis = '$_POST[jenis_apd]', nama_apd = '$_POST[nama_apd]', satuan = '$_POST[satuan]' WHERE id = '$_POST[id]'");

      if($edit_hseapd){
        $_SESSION['alert_success'] = "Berhasil! Data APD Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data APD Gagal Diubah";
      }
    }
  }

  if(isset($_POST['delete_hseapd'])){
    if($_POST['delete_hseapd'] == "Delete"){
      $delete_hseapd = mysqli_query($conn, "DELETE FROM hse_apd WHERE id = '$_POST[id]'");

      if($delete_hseapd){
        $_SESSION['alert_success'] = "Berhasil! Data APD Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data APD Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['submit_add_sertifikat'])){
    if($_POST['submit_add_sertifikat'] == "Submit"){
      $push_sertifikat = mysqli_query($conn, "INSERT INTO hse_sertifikat VALUES('','$_POST[nama_sertifikat]')");

      if($push_sertifikat){
        $_SESSION['alert_success'] = "Berhasil! Data Sertifikat Baru Berhasil Ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Sertifikat Baru Gagal Ditambahkan";
      }
    }
  }

  if(isset($_POST['submit_edit_sertifikat'])){
    if($_POST['submit_edit_sertifikat'] == "Simpan"){
      $edit_sertifikat = mysqli_query($conn, "UPDATE hse_sertifikat SET nama_sertifikat = '$_POST[nama_sertifikat]' WHERE id = '$_POST[id]'");

      if($edit_sertifikat){
        $_SESSION['alert_success'] = "Berhasil! Data Sertifikat Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Sertifikat Gagal Diubah";
      }
    }
  }

  if(isset($_POST['delete_hsesertfikat'])){
    if($_POST['delete_hsesertfikat'] == "Delete"){
      $delete_sertifikat = mysqli_query($conn, "DELETE FROM hse_sertifikat WHERE id = '$_POST[id]'");

      if($delete_sertifikat){
        $_SESSION['alert_success'] = "Berhasil! Data Sertifikat Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Sertifikat Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['submit_add_sertifikasi'])){
    if($_POST['submit_add_sertifikasi'] == "Submit"){
      $target_dir = "sertifikat_file/";
      $nodate = date('YmdHis');
      $target_file = $target_dir.$nodate."_".basename($_FILES["file"]["name"]);
      $nama_file_sertifikat = $nodate."_".basename($_FILES["file"]["name"]);
      $uploadOk = 1;
      $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Check if file size is less than or equal to 5MB
      if ($_FILES["file"]["size"] > 5242880) {
          $alert_error = "Maaf, ukuran file terlalu besar. File harus kurang dari atau sama dengan 5MB.";
          $uploadOk = 0;
      }

      // Check file type
      if($fileType != "pdf") {
          $alert_error = "Hanya file PDF yang diperbolehkan.";
          $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          $_SESSION['alert_error'] = $alert_error;
      } else {
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
              mysqli_query($conn, "INSERT INTO hse_sertifikasi VALUES('','$_POST[sertifikat_id]','$_POST[hsemanpower_id]','$nama_file_sertifikat')");
              $_SESSION['alert_success'] = "Berhasil! Data dan File Sertifikat Berhasil Disimpan.";
          } else {
              $_SESSION['alert_error'] = "Maaf, terjadi kesalahan saat mengunggah file.";
          }
      }
    }
  }

  if(isset($_POST['submit_edit_statusproject'])){
    if($_POST['submit_edit_statusproject'] == "Simpan"){
      $push_edit_statusproject = mysqli_query($conn, "UPDATE hse_project SET status_project = '$_POST[status_project]' WHERE id = '$_POST[id]'");

      $push_project_log = mysqli_query($conn, "INSERT INTO hse_project_log VALUES('','$_POST[id]','edited','$keterangan_edit',CURRENT_TIMESTAMP)");

      if($push_edit_statusproject){
        $_SESSION['alert_success'] = "Berhasil! Status Project Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Status Project Gagal Diubah";
      }
    }
  }

  if(isset($_POST['submit_add_manpowerproject'])){
    if($_POST['submit_add_manpowerproject'] == "Tambah"){
      $push_manpower_project = mysqli_query($conn, "INSERT INTO hse_manpower_project VALUES('','$_POST[project_id]','$_POST[manpower_id]','$_POST[jabatan_id]')");

      if($push_manpower_project){
        $_SESSION['alert_success'] = "Berhasil! Manpower berhasil ditambahkan ke project";
      }else{
        $_SESSION['alert_error'] = "Gagal! Manpower gagal ditambahkan ke project";
      }
    }
  }

  if(isset($_POST['submit_edit_manpowerproject'])){
    if($_POST['submit_edit_manpowerproject'] == "Ubah"){
      if($_POST['manpower_id'] == ""){
        $edit_manpower_project = mysqli_query($conn, "UPDATE hse_manpower_project SET jabatan_id = '$_POST[jabatan_id]' WHERE id = '$_POST[manpowerproject_id]'");
      }else{
        $edit_manpower_project = mysqli_query($conn, "UPDATE hse_manpower_project SET manpower_id = '$_POST[manpower_id]', jabatan_id = '$_POST[jabatan_id]' WHERE id = '$_POST[manpowerproject_id]'");
      }

      if($edit_manpower_project){
        $_SESSION['alert_success'] = "Berhasil! Manpower Project berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Manpower Project gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['delete_manpowerproject'])){
    if($_POST['delete_manpowerproject'] == "Delete"){
      $delete_manpowerproject = mysqli_query($conn, "DELETE FROM hse_manpower_project WHERE id = '$_POST[id]'");

      if($delete_manpowerproject){
        $_SESSION['alert_success'] = "Berhasil! Manpower berhasil didelete dari project";
      }else{
        $_SESSION['alert_error'] = "Gagal! Manpower gagal didelete dari project <br>".mysqli_error($conn);
      }
    }
  }

  // if(isset($_POST['submit_add_tools_reporthse'])){
  //   if($_POST['submit_add_tools_reporthse'] == "Simpan"){
  //     $push_hse_dailyreport_tools = mysqli_query($conn, "INSERT INTO hse_dailyreport_tools VALUES('','$_POST[kd_report]','$_POST[tools_id]','$_POST[jumlah]')");

  //     if($push_hse_dailyreport_tools){
  //       $_SESSION['alert_success'] = "Berhasil! Tools berhasil ditambahkan ke project";
  //     }else{
  //       $_SESSION['alert_error'] = "Gagal! Tools gagal ditambahkan ke project <br>".mysqli_error($conn);
  //     }
  //   }
  // }

  if(isset($_POST['submit_add_tools_reporthse_new'])){
    if($_POST['submit_add_tools_reporthse_new'] == "Simpan"){
      $tools_id = $_POST['tools_id'];
      $jumlah = $_POST['jumlah'];
      $jml_array = count($jumlah);

      $data_berhasil = 0;
      $data_gagal = 0;

      for($i=0;$i<$jml_array;$i++){
        $cek_data_existing = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_tools WHERE kd_report = '$_POST[kd_report]' AND tools_id = '$tools_id[$i]'"));

        if($cek_data_existing > 0){
          $data_gagal++;
        }else{
          $push_hse_dailyreport_tools_new = mysqli_query($conn, "INSERT INTO hse_dailyreport_tools VALUES('','$_POST[kd_report]','$tools_id[$i]','$jumlah[$i]')");

          if($push_hse_dailyreport_tools_new){
            $data_berhasil++;
          }else{
            $data_gagal++;
          }
        }
      }

      if($jml_array == $data_berhasil AND $data_gagal == 0){
        $_SESSION['alert_success'] = "Berhasil! semua data Tools Berhasil diinput";
      }else{
        $_SESSION['alert_warning'] = "Beberapa Data Tools Gagal Diinput Karena Data Sudah Ada!";
      }
      
    }
  }

  if(isset($_POST['submit_add_toolsk3_reporthse_new'])){
    if($_POST['submit_add_toolsk3_reporthse_new'] == "Simpan"){
      $toolsk3_id = $_POST['toolsk3_id'];
      $jumlah = $_POST['jumlah'];
      $jml_array = count($jumlah);

      $data_berhasil = 0;
      $data_gagal = 0;

      for($i=0;$i<$jml_array;$i++){
        $cek_data_existing = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_toolsk3 WHERE kd_report = '$_POST[kd_report]' AND toolsk3_id = '$toolsk3_id[$i]'"));

        if($cek_data_existing > 0){
          $data_gagal++;
        }else{
          $push_hse_dailyreport_toolsk3_new = mysqli_query($conn, "INSERT INTO hse_dailyreport_toolsk3 VALUES('','$_POST[kd_report]','$toolsk3_id[$i]','$jumlah[$i]')");

          if($push_hse_dailyreport_toolsk3_new){
            $data_berhasil++;
          }else{
            $data_gagal++;
          }
        }
      }

      if($jml_array == $data_berhasil AND $data_gagal == 0){
        $_SESSION['alert_success'] = "Berhasil! semua data Tools K3 Berhasil diinput";
      }else{
        $_SESSION['alert_warning'] = "Beberapa Data Tools K3 Gagal Diinput Karena Data Sudah Ada! ".$data_gagal;
      }
      
    }
  }

  if(isset($_POST['submit_add_apd_reporthse_new'])){
    if($_POST['submit_add_apd_reporthse_new'] == "Simpan"){
      $apd_id = $_POST['apd_id'];
      $jumlah = $_POST['jumlah'];
      $jml_array = count($jumlah);

      $data_berhasil = 0;
      $data_gagal = 0;

      for($i=0;$i<$jml_array;$i++){
        $cek_data_existing = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_apd WHERE kd_report = '$_POST[kd_report]' AND apd_id = '$apd_id[$i]'"));

        if($cek_data_existing > 0){
          $data_gagal++;
        }else{
          $push_hse_dailyreport_apd_new = mysqli_query($conn, "INSERT INTO hse_dailyreport_apd VALUES('','$_POST[kd_report]','$apd_id[$i]','$jumlah[$i]')");

          if($push_hse_dailyreport_apd_new){
            $data_berhasil++;
          }else{
            $data_gagal++;
          }
        }
      }

      if($jml_array == $data_berhasil AND $data_gagal == 0){
        $_SESSION['alert_success'] = "Berhasil! semua data APD Berhasil diinput";
      }else{
        $_SESSION['alert_warning'] = "Beberapa Data APD Gagal Diinput Karena Data Sudah Ada! ".$data_gagal;
      }
      
    }
  }

  if(isset($_POST['edit_tools_reporthse'])){
    if($_POST['edit_tools_reporthse'] == "Ubah"){
      $edit_tools_reporthse = mysqli_query($conn, "UPDATE hse_dailyreport_tools SET jumlah = '$_POST[jumlah]' WHERE id = '$_POST[id]'");

      if($edit_tools_reporthse){
        $_SESSION['alert_success'] = "Berhasil! Tools Project berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools Project gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['delete_tools_reporthse'])){
    if($_POST['delete_tools_reporthse'] == "Delete"){
      $delete_tools_reporthse = mysqli_query($conn, "DELETE FROM hse_dailyreport_tools WHERE id = '$_POST[id]'");

      if($delete_tools_reporthse){
        $_SESSION['alert_success'] = "Berhasil! Tools Project berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools Project gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['edit_jamkerja'])){
    if($_POST['edit_jamkerja'] == "Ubah"){
      $edit_jamkerja = mysqli_query($conn, "UPDATE hse_project SET jam_masuk = '$_POST[jam_masuk]', jam_pulang = '$_POST[jam_pulang]' WHERE id = '$_POST[id]'");

      if($edit_jamkerja){
        $_SESSION['alert_success'] = "Berhasil! Jam Kerja berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Jam Kerja gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_add_cuacaproject'])){
    if($_POST['submit_add_cuacaproject'] == "Tambah"){
      $push_cuacaproject = mysqli_query($conn, "INSERT INTO hse_dailyreport_cuaca VALUES('','$_POST[kd_report]','$_POST[cuaca]','$_POST[jam_mulai]','$_POST[jam_selesai]')");

      if($push_cuacaproject){
        $_SESSION['alert_success'] = "Berhasil! Cuaca berhasil ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Cuaca gagal ditambahkan <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['delete_cuacaproject'])){
    if($_POST['delete_cuacaproject'] == "Delete"){
      $delete_cuacaproject = mysqli_query($conn, "DELETE FROM hse_dailyreport_cuaca WHERE id = '$_POST[id]'");

      if($delete_cuacaproject){
        $_SESSION['alert_success'] = "Berhasil! Cuaca berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Cuaca gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['get_datamanpower'])){
    if($_POST['get_datamanpower'] == "Get Data"){
      //Clear data first
      mysqli_query($conn, "DELETE FROM hse_dailyreport_manpower WHERE kd_report = '$_POST[kd_report]'");

      $q_get_manpowerproject = mysqli_query($conn, "SELECT * FROM hse_manpower_project WHERE project_id = '$_POST[project_id]'");
      $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$_POST[project_id]'"));
      $jml_manpowerproject = mysqli_num_rows($q_get_manpowerproject);

      $itterasi = 0;
      while($get_manpowerproject = mysqli_fetch_array($q_get_manpowerproject)){
        $push_to_dailyreport_manpower = mysqli_query($conn, "INSERT INTO hse_dailyreport_manpower VALUES('','$_POST[kd_report]','$get_manpowerproject[manpower_id]','$get_manpowerproject[jabatan_id]','Hadir','$get_project[jam_masuk]','$get_project[jam_pulang]')");

        if($push_to_dailyreport_manpower){
          $itterasi++;
        }
      }

      if($jml_manpowerproject == $itterasi){
        $_SESSION['alert_success'] = "Berhasil! Get Data Manpower berhasil 100%";
      }else{
        $_SESSION['alert_error'] = "Gagal! Get Data Manpower gagal <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['clear_datamanpower'])){
    if($_POST['clear_datamanpower'] == "Clear Data"){
      $clear_datamanpower = mysqli_query($conn, "DELETE FROM hse_dailyreport_manpower WHERE kd_report = '$_POST[kd_report]'");

      if($clear_datamanpower){
        $_SESSION['alert_success'] = "Berhasil! Data Manpower pada project ini berhasil dikosongkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Manpower pada project ini gagal dikosongkan <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['edit_absensi_manpower'])){
    if($_POST['edit_absensi_manpower'] == "Simpan"){
      $edit_absensi_manpower = mysqli_query($conn, "UPDATE hse_dailyreport_manpower SET absensi = '$_POST[absensi]' WHERE id = '$_POST[id]'");

      if($edit_absensi_manpower){
        $_SESSION['alert_success'] = "Berhasil! Absensi manpower berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Absensi manpower gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_add_toolsk3_reporthse'])){
    if($_POST['submit_add_toolsk3_reporthse'] == "Simpan"){
      $push_hse_dailyreport_toolsk3 = mysqli_query($conn, "INSERT INTO hse_dailyreport_toolsk3 VALUES('','$_POST[kd_report]','$_POST[toolsk3_id]','$_POST[jumlah]')");

      if($push_hse_dailyreport_toolsk3){
        $_SESSION['alert_success'] = "Berhasil! Tools K3 berhasil ditambahkan ke project";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools K3 gagal ditambahkan ke project <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['edit_toolsk3_reporthse'])){
    if($_POST['edit_toolsk3_reporthse'] == "Ubah"){
      $edit_toolsk3_reporthse = mysqli_query($conn, "UPDATE hse_dailyreport_toolsk3 SET jumlah = '$_POST[jumlah]' WHERE id = '$_POST[id]'");

      if($edit_toolsk3_reporthse){
        $_SESSION['alert_success'] = "Berhasil! Tools K3 Project berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools K3 Project gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['delete_toolsk3_reporthse'])){
    if($_POST['delete_toolsk3_reporthse'] == "Delete"){
      $delete_toolsk3_reporthse = mysqli_query($conn, "DELETE FROM hse_dailyreport_toolsk3 WHERE id = '$_POST[id]'");

      if($delete_toolsk3_reporthse){
        $_SESSION['alert_success'] = "Berhasil! Tools K3 Project berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools K3 Project gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_add_apd_reporthse'])){
    if($_POST['submit_add_apd_reporthse'] == "Simpan"){
      $submit_add_apd_reporthse = mysqli_query($conn, "INSERT INTO hse_dailyreport_apd VALUES('','$_POST[kd_report]','$_POST[apd_id]','$_POST[jumlah]')");

      if($submit_add_apd_reporthse){
        $_SESSION['alert_success'] = "Berhasil! APD Berhasil ditambahkan ke project";
      }else{
        $_SESSION['alert_error'] = "Gagal! APD gagal ditambahkan ke project <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_edit_apd_reporthse'])){
    if($_POST['submit_edit_apd_reporthse'] == "Simpan"){
      $submit_edit_apd_reporthse = mysqli_query($conn, "UPDATE hse_dailyreport_apd SET jumlah = '$_POST[jumlah]' WHERE id = '$_POST[id]'");

      if($submit_edit_apd_reporthse){
        $_SESSION['alert_success'] = "Berhasil! APD Project Berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! APD Project gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['delete_apd_reporthse'])){
    if($_POST['delete_apd_reporthse'] == "Delete"){
      $delete_apd_reporthse = mysqli_query($conn, "DELETE FROM hse_dailyreport_apd WHERE id = '$_POST[id]'");

      if($delete_apd_reporthse){
        $_SESSION['alert_success'] = "Berhasil! APD Project Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! APD Project gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['delete_apd_reporthse'])){
    $_SESSION['alert_success'] = "Berhasil! APD Project Berhasil dihapus";
  }

  if(isset($_POST['edit_jamKerjaManpower'])){
    if($_POST['edit_jamKerjaManpower'] == "Ubah"){
      $edit_jamKerjaManpower = mysqli_query($conn, "UPDATE hse_dailyreport_manpower SET jam_masuk = '$_POST[jam_masuk]', jam_pulang = '$_POST[jam_pulang]' WHERE id = '$_POST[id]'");

      if($edit_jamKerjaManpower){
        $_SESSION['alert_success'] = "Berhasil! Jam Kerja Manpower berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Jam Kerja Manpower gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_add_isuk3'])){
    if($_POST['submit_add_isuk3']){
      $push_isuk3 = mysqli_query($conn, "INSERT INTO hse_dailyreport_isu VALUES('','$_POST[kd_report]','$_POST[kejadian]','$_POST[manpower_id]','$_POST[jam]','$_POST[keterangan_kejadian]','$_POST[corrective_action]')");

      if($push_isuk3){
        $_SESSION['alert_success'] = "Berhasil! Isu K3 Berhasil ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Isu K3 Gagal ditambahkan <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_add_isuk3_v2'])){
    if($_POST['submit_add_isuk3_v2']){
      $uploadPath = "../../role/HSE/foto_isuk3/";

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
              $compressedImage = compressImage($imageTemp, $imageUploadPath, 40);
                
              if($compressedImage){
                $push_isuk3 = mysqli_query($conn, "INSERT INTO hse_dailyreport_isu VALUES('','$_POST[kd_report]','$_POST[kejadian]','$_POST[manpower_id]','$_POST[jam]','$_POST[keterangan_kejadian]','$_POST[corrective_action]','$fileName')");

                if($push_isuk3){
                  header("Location: success.php?msg=Berhasil! Isu K3 Berhasil ditambahkan&topages=formdailyreporthse&kdproject=".$_GET['kdproject']."&tgl=".$_GET['tgl']);
                  exit;
                }else{
                  unlink("../../role/HSE/foto_isuk3/".$fileName);
                  $_SESSION['alert_error'] = "Gagal! Isu K3 Gagal ditambahkan <br>".mysqli_error($conn);
                }
              }else{ 
                unlink("../../role/HSE/foto_isuk3/".$fileName);
                $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
              } 
          }else{
            unlink("../../role/HSE/foto_isuk3/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
          } 
      }else{
        $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
      } 
    }
  }

  if(isset($_POST['submit_ubah_isuk3'])){
    if($_POST['submit_ubah_isuk3']){
      $edit_isuk3 = mysqli_query($conn, "UPDATE hse_dailyreport_isu SET kejadian = '$_POST[kejadian]', manpower_id = '$_POST[manpower_id]', jam = '$_POST[jam]', keterangan_kejadian = '$_POST[keterangan_kejadian]', corrective_action = '$_POST[corrective_action]' WHERE id = '$_POST[id]'");

      if($edit_isuk3){
        $_SESSION['alert_success'] = "Berhasil! Isu K3 Berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Isu K3 Gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_ubah_isuk3_v2'])){
    if($_POST['submit_ubah_isuk3_v2']){
      $uploadPath = "../../role/HSE/foto_isuk3/";

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
              $compressedImage = compressImage($imageTemp, $imageUploadPath, 40);
                
              if($compressedImage){
                $edit_isuk3 = mysqli_query($conn, "UPDATE hse_dailyreport_isu SET kejadian = '$_POST[kejadian]', manpower_id = '$_POST[manpower_id]', jam = '$_POST[jam]', keterangan_kejadian = '$_POST[keterangan_kejadian]', corrective_action = '$_POST[corrective_action]', foto = '$fileName' WHERE id = '$_POST[id]'");

                if($edit_isuk3){
                  header("Location: success.php?msg=Berhasil! Isu K3 Berhasil diubah&topages=formdailyreporthse&kdproject=".$_GET['kdproject']."&tgl=".$_GET['tgl']);
                  exit;
                }else{
                  unlink("../../role/HSE/foto_isuk3/".$fileName);
                  $_SESSION['alert_error'] = "Gagal! Isu K3 Gagal diubah <br>".mysqli_error($conn);
                }
              }else{ 
                unlink("../../role/HSE/foto_isuk3/".$fileName);
                $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
              } 
          }else{
            unlink("../../role/HSE/foto_isuk3/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
          } 
      }else{
        $edit_isuk3 = mysqli_query($conn, "UPDATE hse_dailyreport_isu SET kejadian = '$_POST[kejadian]', manpower_id = '$_POST[manpower_id]', jam = '$_POST[jam]', keterangan_kejadian = '$_POST[keterangan_kejadian]', corrective_action = '$_POST[corrective_action]' WHERE id = '$_POST[id]'");
        if($edit_isuk3){
          header("Location: success.php?msg=Berhasil! Isu K3 Berhasil diubah&topages=formdailyreporthse&kdproject=".$_GET['kdproject']."&tgl=".$_GET['tgl']);
          exit;
        }else{
          $_SESSION['alert_error'] = "Gagal! Isu K3 Gagal diubah <br>".mysqli_error($conn);
        }
      }
    }
  }

  if(isset($_POST['delete_isuk3'])){
    if($_POST['delete_isuk3'] == "Delete"){
      $delete_isuk3 = mysqli_query($conn, "DELETE FROM hse_dailyreport_isu WHERE id = '$_POST[id]'");

      if($delete_isuk3){
        $_SESSION['alert_success'] = "Berhasil! Isu K3 Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Isu K3 Gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_add_dokumentasiproject'])){
    if($_POST['submit_add_dokumentasiproject'] == "Simpan"){
      $target_dir = "dokumentasi_project/";
      $nodate = date('YmdHis');
      $target_file = $target_dir.$nodate."_".basename($_FILES["file"]["name"]);
      $nama_foto = $nodate."_".basename($_FILES["file"]["name"]);
      $uploadOk = 1;
      $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Check if file size is less than or equal to 2MB
      if ($_FILES["file"]["size"] > 2242880) {
          $alert_error = "Maaf, ukuran file terlalu besar. File harus kurang dari atau sama dengan 2MB.";
          $uploadOk = 0;
      }

      // Check file type
      if($fileType != "jpg" AND $fileType != "png") {
          $alert_error = "Hanya file JPG atau PNG yang diperbolehkan.";
          $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          $_SESSION['alert_error'] = $alert_error;
      } else {
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
              $push_dokumentasi = mysqli_query($conn, "INSERT INTO hse_dailyreport_dokumentasi VALUES('','$_POST[kd_report]','$_POST[pekerjaan]','$nama_foto')");

              if($push_dokumentasi){
                $_SESSION['alert_success'] = "Berhasil! Dokumentasi Berhasil Disimpan.";
              }else{
                unlink("dokumentasi_project/".$nama_foto);
                $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan <br>".mysqli_error($conn);
              }
          } else {
              $_SESSION['alert_error'] = "Maaf, terjadi kesalahan saat mengunggah file.";
          }
      }
    }
  }

  if(isset($_POST['submit_add_dokumentasiproject_v2'])){
    if($_POST['submit_add_dokumentasiproject_v2'] == "Simpan"){
      if($_FILES["file"]["name"] != ""){
        // ini adalah path folder upload yang sudah kita buat
        $uploadPath = "../../role/HSE/dokumentasi_project/";
          
        // jika form upload file sudah di submit :
        $status = $statusMsg = '';
        if(!empty($_FILES["file"]["name"])) {
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
                  if($_POST['pekerjaan'] == "Lainnya"){
                    $_POST['pekerjaan'] = $_POST['lain_lain'];
                  } 
                  $push_dokumentasi = mysqli_query($conn, "INSERT INTO hse_dailyreport_dokumentasi VALUES('','$_POST[kd_report]','$_POST[pekerjaan]','$fileName')");
        
                  if($push_dokumentasi){
                    $_SESSION['alert_success'] = "Berhasil! Dokumentasi Berhasil Disimpan.";
                  }else{
                    unlink("../../role/HSE/dokumentasi_project/".$fileName);
                    $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan <br>".mysqli_error($conn);
                  }
                }else{ 
                  unlink("../../role/HSE/dokumentasi_project/".$fileName);
                  $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
                } 
            }else{
              unlink("../../role/HSE/dokumentasi_project/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            } 
        }else{
          $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
        } 
      }
    }
  }

  if(isset($_POST['submit_edit_dokumentasiproject'])){
    if($_POST['submit_edit_dokumentasiproject'] == "Simpan"){
      if($_FILES["file"]["name"] != ""){
        $target_dir = "dokumentasi_project/";
        $nodate = date('YmdHis');
        $target_file = $target_dir.$nodate."_".basename($_FILES["file"]["name"]);
        $nama_file_foto = $nodate."_".basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file size is less than or equal to 1MB
        if ($_FILES["file"]["size"] > 2242880) {
            $alert_error = "Maaf, ukuran file terlalu besar. File harus kurang dari atau sama dengan 2MB.";
            $uploadOk = 0;
        }

        // Check file type
        if($fileType != "png" && $fileType != "jpg") {
            $alert_error = "Hanya file JPG atau PNG yang diperbolehkan.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['alert_error'] = $alert_error;
        } else {
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
              $get_foto_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE id = '$_POST[id]'"));
              $foto_old = $get_foto_old['foto'];
              $push_edit_dokumentasiproject = mysqli_query($conn, "UPDATE hse_dailyreport_dokumentasi SET pekerjaan = '$_POST[pekerjaan]', foto = '$nama_file_foto' WHERE id = '$_POST[id]'");
              if($push_edit_dokumentasiproject){
                unlink("dokumentasi_project/".$foto_old);
                $_SESSION['alert_success'] = "Berhasil! Data Dokumentasi Berhasil Diubah";
              }else{
                $_SESSION['alert_error'] = "Gagal! Data Dokumentasi Gagal Diubah";
              }
          } else {
              $_SESSION['alert_error'] = "Maaf, terjadi kesalahan saat mengunggah file.";
          }
        }
      }else{
        $push_edit_dokumentasiproject = mysqli_query($conn, "UPDATE hse_dailyreport_dokumentasi SET pekerjaan = '$_POST[pekerjaan]' WHERE id = '$_POST[id]'");

        if($push_edit_dokumentasiproject){
          $_SESSION['alert_success'] = "Berhasil! Data Dokumentasi Berhasil Diubah";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Dokumentasi Gagal Diubah";
        }
      }
    }
  }

  if(isset($_POST['submit_edit_dokumentasiproject_v2'])){
    if($_POST['submit_edit_dokumentasiproject_v2'] == "Simpan"){
      if($_FILES["file"]["name"] != ""){
        // ini adalah path folder upload yang sudah kita buat
        $uploadPath = "../../role/HSE/dokumentasi_project/";
          
        // jika form upload file sudah di submit :
        $status = $statusMsg = ''; 
        if(!empty($_FILES["file"]["name"])) { 
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
                   $get_foto_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE id = '$_POST[id]'"));
                  $foto_old = $get_foto_old['foto'];
                  $push_edit_dokumentasiproject = mysqli_query($conn, "UPDATE hse_dailyreport_dokumentasi SET pekerjaan = '$_POST[pekerjaan]', foto = '$fileName' WHERE id = '$_POST[id]'");
                  if($push_edit_dokumentasiproject){
                    unlink("../../role/HSE/dokumentasi_project/".$foto_old);
                    $_SESSION['alert_success'] = "Berhasil! Data Dokumentasi Berhasil Diubah";
                  }else{
                    $_SESSION['alert_error'] = "Gagal! Data Dokumentasi Gagal Diubah";
                  }
                }else{ 
                  unlink("../../role/HSE/dokumentasi_project/".$fileName);
                  $_SESSION['alert_error'] = "Gagal! Dokumentasi gagal disimpan, File foto tidak dapat dikompresi";
                } 
            }else{
              unlink("../../role/HSE/dokumentasi_project/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            } 
        }else{
          $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
        } 
      }else{
        $push_edit_dokumentasiproject = mysqli_query($conn, "UPDATE hse_dailyreport_dokumentasi SET pekerjaan = '$_POST[pekerjaan]' WHERE id = '$_POST[id]'");

        if($push_edit_dokumentasiproject){
          $_SESSION['alert_success'] = "Berhasil! Data Dokumentasi Berhasil Diubah";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Dokumentasi Gagal Diubah";
        }
      }
    }
  }

  if(isset($_POST['delete_dokumentasiproject'])){
    if($_POST['delete_dokumentasiproject'] == "Delete"){
      $get_dataOld = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE id = '$_POST[id]'"));
      $nama_foto = $get_dataOld["foto"];
      $delete_dokumentasiproject = mysqli_query($conn, "DELETE FROM hse_dailyreport_dokumentasi WHERE id = '$_POST[id]'");

      if($delete_dokumentasiproject){
        unlink("dokumentasi_project/".$nama_foto);
        $_SESSION['alert_success'] = "Berhasil! Data Dokumentasi Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Dokumentasi Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['submit_add_dailyreportnote'])){
    if($_POST['submit_add_dailyreportnote'] == 'Simpan'){
      $push_dailyreport_note = mysqli_query($conn, "INSERT INTO hse_dailyreport_note VALUES('','$_POST[kd_report]','$_POST[note]')");
    
      if($push_dailyreport_note){
        $_SESSION['alert_success'] = "Berhasil! Note Berhasil Disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Note Gagal Disimpan";
      }
    }
  }

  if(isset($_POST['submit_edit_dailyreportnote'])){
    if($_POST['submit_edit_dailyreportnote'] == "Ubah"){
      $edit_dailyreportnote = mysqli_query($conn, "UPDATE hse_dailyreport_note SET note = '$_POST[note]' WHERE id = '$_POST[id]'");

      if($edit_dailyreportnote){
        $_SESSION['alert_success'] = "Berhasil! Note Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Note Gagal diubah";
      }
    }
  }

  if(isset($_POST['delete_dailyreportnote'])){
    if($_POST['delete_dailyreportnote'] == "Delete"){
      $delete_dailyreportnote = mysqli_query($conn, "DELETE FROM hse_dailyreport_note WHERE id = '$_POST[id]'");

      if($delete_dailyreportnote){
        $_SESSION['alert_success'] = "Berhasil! Note Berhasil Dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Note Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['report_complete'])){
    if($_POST['report_complete'] == "Report Complete"){
      $cek_cuaca = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_cuaca WHERE kd_report = '$_POST[kd_report]'"));
      $cek_manpower = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower WHERE kd_report = '$_POST[kd_report]'"));
      $cek_tools = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_tools WHERE kd_report = '$_POST[kd_report]'"));
      $cek_toolsk3 = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_toolsk3 WHERE kd_report = '$_POST[kd_report]'"));
      $cek_apd = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_apd WHERE kd_report = '$_POST[kd_report]'"));
      $cek_dokumentasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE kd_report = '$_POST[kd_report]'"));

      $jml_cek = 0;

      if($cek_cuaca < 1){
        $jml_cek++;
        $pesan_error[$jml_cek] = "- Data Cuaca Belum ada <br>";
      }

      if($cek_manpower < 1){
        $jml_cek++;
        $pesan_error[$jml_cek] = "- Data Manpower Belum ada <br>";
      }

      if($cek_tools < 1){
        $jml_cek++;
        $pesan_error[$jml_cek] = "- Data Tools Belum ada <br>";
      }

      if($cek_toolsk3 < 1){
        $jml_cek++;
        $pesan_error[$jml_cek] = "- Data Tools K3 Belum ada <br>";
      }

      if($cek_apd < 1){
        $jml_cek++;
        $pesan_error[$jml_cek] = "- Data APD Belum ada <br>";
      }

      if($cek_dokumentasi < 4){
        $jml_cek++;
        $pesan_error[$jml_cek] = "- Data Dokumentasi kurang dari 4 <br>";
      }

      if($jml_cek > 0){
        for($i=1;$i<=$jml_cek;$i++){
          $show_pesan_error = $show_pesan_error.$pesan_error[$i];
          $_SESSION['alert_error'] = $show_pesan_error;
        }
      }else{
        $tgl_now = date('Y-m-d');
        $edit_status_dailyreport = mysqli_query($conn, "UPDATE hse_dailyreport SET status_report = 'completed', tgl_submit = '$tgl_now' WHERE kd_report = '$_POST[kd_report]'");

        if($edit_status_dailyreport){
          $_SESSION['alert_success'] = "Berhasil! Report Project Berhasil Disubmit";
        }else{
          $_SESSION['alert_error'] = "Gagal! Report project gagal disubmit";
        }
      }
    }
  }

  if(isset($_POST['project_hold'])){
    if($_POST['project_hold'] == "Project Hold"){
      $tgl_now = date('Y-m-d');
      $submit_project_hold = mysqli_query($conn, "UPDATE hse_dailyreport SET status_report = 'hold', keterangan = '$_POST[keterangan]', tgl_submit = '$tgl_now' WHERE kd_report = '$_POST[kd_report]'");

      if($submit_project_hold){
          //delete data report
          mysqli_query($conn, "DELETE FROM hse_dailyreport_cuaca WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_manpower WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_tools WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_toolsk3 WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_apd WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_isu WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_note WHERE kd_report = '$_POST[kd_report]'");

          //delete dokumentasi
          $q_getDokumentasi = mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE kd_report = '$_POST[kd_report]'");
          while($get_dokumentasi = mysqli_fetch_array($q_getDokumentasi)){
            unlink("dokumentasi_project/".$get_dokumentasi['foto']);
          }
          mysqli_query($conn, "DELETE FROM hse_dailyreport_dokumentasi WHERE kd_report = '$_POST[kd_report]'");

          $_SESSION['alert_success'] = "Berhasil! Project Hold berhasil disubmit";
          echo "<meta http-equiv='refresh' content='0;url=index.php?pages=detailproject&kd=$_POST[project_id]'>";
        }else{
          $_SESSION['alert_error'] = "Gagal! Project Hold gagal disubmit";
        }
    }
  }

  if(isset($_POST['project_libur'])){
    if($_POST['project_libur'] == "Libur / Tidak ada pekerjaan"){
      $tgl_now = date('Y-m-d');
      $submit_project_libur = mysqli_query($conn, "UPDATE hse_dailyreport SET status_report = 'libur/tidak ada pekerjaan', keterangan = '$_POST[keterangan]', tgl_submit = '$tgl_now' WHERE kd_report = '$_POST[kd_report]'");

      if($submit_project_libur){
          //delete data report
          mysqli_query($conn, "DELETE FROM hse_dailyreport_cuaca WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_manpower WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_tools WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_toolsk3 WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_apd WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_isu WHERE kd_report = '$_POST[kd_report]'");
          mysqli_query($conn, "DELETE FROM hse_dailyreport_note WHERE kd_report = '$_POST[kd_report]'");

          //delete dokumentasi
          $q_getDokumentasi = mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE kd_report = '$_POST[kd_report]'");
          while($get_dokumentasi = mysqli_fetch_array($q_getDokumentasi)){
            unlink("dokumentasi_project/".$get_dokumentasi['foto']);
          }
          mysqli_query($conn, "DELETE FROM hse_dailyreport_dokumentasi WHERE kd_report = '$_POST[kd_report]'");

          $_SESSION['alert_success'] = "Berhasil! Project Libur berhasil disubmit";
          echo "<meta http-equiv='refresh' content='0;url=index.php?pages=detailproject&kd=$_POST[project_id]'>";
          exit;
        }else{
          $_SESSION['alert_error'] = "Gagal! Project Libur gagal disubmit";
        }
    }
  }

  if(isset($_POST['delete_dailyreport'])){
    if($_POST['delete_dailyreport'] == "Delete"){
      //delete data report
      mysqli_query($conn, "DELETE FROM hse_dailyreport_cuaca WHERE kd_report = '$_POST[kd_report]'");
      mysqli_query($conn, "DELETE FROM hse_dailyreport_manpower WHERE kd_report = '$_POST[kd_report]'");
      mysqli_query($conn, "DELETE FROM hse_dailyreport_tools WHERE kd_report = '$_POST[kd_report]'");
      mysqli_query($conn, "DELETE FROM hse_dailyreport_toolsk3 WHERE kd_report = '$_POST[kd_report]'");
      mysqli_query($conn, "DELETE FROM hse_dailyreport_apd WHERE kd_report = '$_POST[kd_report]'");
      mysqli_query($conn, "DELETE FROM hse_dailyreport_isu WHERE kd_report = '$_POST[kd_report]'");
      mysqli_query($conn, "DELETE FROM hse_dailyreport_note WHERE kd_report = '$_POST[kd_report]'");

      //delete dokumentasi
      $q_getDokumentasi = mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE kd_report = '$_POST[kd_report]'");
      while($get_dokumentasi = mysqli_fetch_array($q_getDokumentasi)){
        unlink("dokumentasi_project/".$get_dokumentasi['foto']);
      }
      mysqli_query($conn, "DELETE FROM hse_dailyreport_dokumentasi WHERE kd_report = '$_POST[kd_report]'");

      //delete dailyreport
      $deletedailyreport = mysqli_query($conn, "DELETE FROM hse_dailyreport WHERE kd_report = '$_POST[kd_report]'");

      if($deletedailyreport){
        $_SESSION['alert_success'] = "Berhasil! Dailyreport berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Dailyreport gagal dihapus";
      }
    }
  }

  if(isset($_POST['submit_edit_statusreport'])){
    if($_POST['submit_edit_statusreport'] == "Ubah"){
      $submit_edit_statusreport = mysqli_query($conn, "UPDATE hse_dailyreport SET status_report = '$_POST[status_report]' WHERE kd_report = '$_POST[id]'");

      if($submit_edit_statusreport){
        $_SESSION['alert_success'] = "Berhasil! Status Report berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Status Report gagal diubah";
      }
    }
  }

  if(isset($_POST['submit_add_weeklyreport'])){
    if($_POST['submit_add_weeklyreport'] == "Generate"){
      $kodeWeekly = "week/".$_POST['week']."/".$_POST['project_id'];
      $push_weeklyreport = mysqli_query($conn, "INSERT INTO hse_weeklyreport VALUES('$kodeWeekly','$_POST[project_id]','$_POST[week]','$_POST[tgl_awal]','$_POST[tgl_akhir]')");

      if($push_weeklyreport){
        $_SESSION['alert_success'] = "Berhasil! Weekly report berhasil dibuat";
      }else{
        $_SESSION['alert_error'] = "Gagal! Weekly report gagal dibuat";
      }
    }
  }

  if(isset($_POST['edit_weeklyreport'])){
    if($_POST['edit_weeklyreport'] == "Ubah"){
      $edit_weeklyreport = mysqli_query($conn, "UPDATE hse_weeklyreport SET tgl_awal = '$_POST[tgl_awal]', tgl_akhir = '$_POST[tgl_akhir]' WHERE kd_weekly = '$_POST[kd_weekly]'");

      if($edit_weeklyreport){
        $_SESSION['alert_success'] = "Berhasil! Weekly report berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Weekly report gagal diubah";
      }
    }
  }

  if(isset($_POST['delete_weeklyreport'])){
    if($_POST['delete_weeklyreport'] == "Delete"){
      $delete_deskripsipekerjaan = mysqli_query($conn, "DELETE FROM hse_dailyreport_deskripsipekerjaan WHERE kd_weekly = '$_POST[kd_weekly]'");
      
      //delete inspeksi
      $q_hse_inspeksilist = mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly = '$_POST[kd_weekly]'");
      while($get_hse_inspeksilist = mysqli_fetch_array($q_hse_inspeksilist)){
        $delete_inspeksilist_fotoapd = mysqli_query($conn, "DELETE FROM hse_inspeksilist_fotoapd WHERE inspeksi_id = '$get_hse_inspeksilist[id]'");
        $delete_inspeksi_detailapd = mysqli_query($conn, "DELETE FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$get_hse_inspeksilist[id]'");
      }

      $delete_inspeksilist = mysqli_query($conn, "DELETE FROM hse_inspeksilist WHERE kd_weekly = '$_POST[kd_weekly]'");
      $delete_weeklyreport = mysqli_query($conn, "DELETE FROM hse_weeklyreport WHERE kd_weekly = '$_POST[kd_weekly]'");

      if($delete_weeklyreport){
        $_SESSION['alert_success'] = "Berhasil! Weekly report berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Weekly report gagal dihapus";
      }
    }
  }

  if(isset($_POST['submit_add_deskripsipekerjaan'])){
    if($_POST['submit_add_deskripsipekerjaan'] == "Simpan"){
      $push_deskripsipekerjaan = mysqli_query($conn, "UPDATE hse_dailyreport_deskripsipekerjaan SET deskripsi_pekerjaan = '$_POST[deskripsi_pekerjaan]' WHERE id = '$_POST[id]'");

      if($push_deskripsipekerjaan){
        $_SESSION['alert_success'] = "Berhasil! Deskripsi Pekerjaan Berhasil Disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Deskripsi Pekerjaan Gagal Disimpan";
      }
    }
  }

  if(isset($_POST['delete_toolsapd_onsite'])){
    if($_POST['delete_toolsapd_onsite'] == "Delete"){
      //delete data tools & apd onsite
      $delete_toolsapdonsite_toolsk3 = mysqli_query($conn, "DELETE FROM hse_toolsapdonsite_detailtoolsk3 WHERE id_onsite = '$_POST[id_onsite]'");
      $delete_toolsapdonsite_tools = mysqli_query($conn, "DELETE FROM hse_toolsapdonsite_detailtools WHERE id_onsite = '$_POST[id_onsite]'");
      $delete_toolsapdonsite_apd = mysqli_query($conn, "DELETE FROM hse_toolsapdonsite_detailapd WHERE id_onsite = '$_POST[id_onsite]'");

      //delete toolsapd_onsite
      $delete_toolsapd_onsite = mysqli_query($conn, "DELETE FROM hse_toolsapdonsite WHERE id = '$_POST[id_onsite]'");
      if($delete_toolsapd_onsite){
        $_SESSION['alert_success'] = "Berhasil! Tools & APD Onsite Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools & APD Onsite Gagal Dihapus";
      }
    }
  }

  if(isset($_POST['onsite_to_progress'])){
    if($_POST['onsite_to_progress'] == "to progress"){
      $onsite_to_progress = mysqli_query($conn, "UPDATE hse_toolsapdonsite SET status = 'progress' WHERE id = '$_POST[id_onsite]'");
      if($onsite_to_progress){
        $_SESSION['alert_success'] = "Berhasil! Status Tools & APD Onsite kembali menjadi progress";
      }else{
        $_SESSION['alert_error'] = "Gagal! Status Tools & APD Onsite gagal menjadi progress";
      }
    }
  }

  if(isset($_POST['inspeksi_to_progress'])){
    if($_POST['inspeksi_to_progress'] == "to progress"){
      $inspeksi_to_progress = mysqli_query($conn, "UPDATE hse_inspeksilist SET status = 'progress' WHERE id = '$_POST[inspeksi_id]'");
      if($inspeksi_to_progress){
        $_SESSION['alert_success'] = "Berhasil! Inspeksi kembali menjadi progress";
      }else{
        $_SESSION['alert_error'] = "Gagal! Inspeksi gagal menjadi progress";
      }
    }
  }

?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/logo/Logo-Marketing.png" alt="AdminLTELogo" height="80" width="80">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     <!--  <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link">Logout</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
     <!--  <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <!-- <span class="badge badge-warning navbar-badge">15</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a> -->
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Belum ada notifikasi</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../all_role/logout.php" role="button">
          <i class="fa fa-sign-out" data-toggle="tooltip" data-placement="bottom" title="Logout"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../../dist/img/logo/gpp-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Panel GPP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img class="img-circle elevation-2" src="../../dist/img/karyawan/<?php echo $_SESSION['foto']; ?>" alt="User Image">
        </div>
        <div class="info">
          <a href="?pages=profile" class="d-block"><?php echo implode(" ", array_slice(explode(" ", $_SESSION['nama']), 0, 2)); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
          <li class="nav-item">
            <a href="index.php?pages=dailyreport" class="nav-link <?php if($_GET['pages']=="dailyreport"){ echo "active"; } ?>">
              <i class="fa fa-file-o nav-icon"></i>
              <p>Daily Report</p>
            </a>
          </li>

          <li class="nav-header"></li>
          <li class="nav-header">Kelola Data HSE</li>
          <li class="nav-item <?php if($_GET['pages']=="datauserhse" || $_GET['pages']=="datamanpower" || $_GET['pages']=="dataproject" || $_GET['pages']=="datajabatan" || $_GET['pages']=="datatools" || $_GET['pages']=="datatoolsk3" || $_GET['pages']=="dataapd" || $_GET['pages']=="datasertifikat" || $_GET['pages']=="datasertifikasi" || $_GET['pages']=="detailproject" || $_GET['pages']=="formdailyreporthse" || $_GET['pages']=="dailyreporthse" || $_GET['pages']=="weeklyreport" || $_GET['pages']=="manpowerplan_list" || $_GET['pages']=="manpowerplan" || $_GET['pages']=="report_inspeksiapd" || $_GET['pages']=="reportinspeksiapar"){ echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=="datauserhse" || $_GET['pages']=="datamanpower" || $_GET['pages']=="dataproject" || $_GET['pages']=="datajabatan" || $_GET['pages']=="datatools" || $_GET['pages']=="datatoolsk3" || $_GET['pages']=="dataapd" || $_GET['pages']=="datasertifikat" || $_GET['pages']=="datasertifikasi" || $_GET['pages']=="detailproject" || $_GET['pages']=="formdailyreporthse" || $_GET['pages']=="dailyreporthse" || $_GET['pages']=="weeklyreport" || $_GET['pages']=="manpowerplan_list" || $_GET['pages']=="manpowerplan" || $_GET['pages']=="report_inspeksiapd" || $_GET['pages']=="reportinspeksiapar"){ echo "active"; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Database HSE
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=datauserhse" class="nav-link <?php if($_GET['pages'] == "datauserhse"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=datamanpower" class="nav-link <?php if($_GET['pages'] == "datamanpower"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data Manpower</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dataproject" class="nav-link <?php if($_GET['pages'] == "dataproject" || $_GET['pages'] == "detailproject" || $_GET['pages']=="formdailyreporthse" || $_GET['pages']=="dailyreporthse" || $_GET['pages']=="weeklyreport" || $_GET['pages']=="report_inspeksiapd" || $_GET['pages']=="reportinspeksiapar"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data Project</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=datajabatan" class="nav-link <?php if($_GET['pages'] == "datajabatan"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=datatools" class="nav-link <?php if($_GET['pages'] == "datatools"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data Tools</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=datatoolsk3" class="nav-link <?php if($_GET['pages'] == "datatoolsk3"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data Tools K3</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dataapd" class="nav-link <?php if($_GET['pages'] == "dataapd"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data APD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=datasertifikat" class="nav-link <?php if($_GET['pages'] == "datasertifikat"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data Sertifikat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=datasertifikasi" class="nav-link <?php if($_GET['pages'] == "datasertifikasi"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data Sertifikasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=manpowerplan_list" class="nav-link <?php if($_GET['pages'] == "manpowerplan_list" || $_GET['pages'] == "manpowerplan"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Manpower Plan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                HSE Daily Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Monitoring Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>List Daily Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header"></li>
          <li class="nav-header">Peminjaman Asset</li>
          <li class="nav-item <?php if($_GET['pages']=='pilihformpeminjaman' || $_GET['pages']=='formpeminjamantools' || $_GET['pages']=='formpeminjamanapd' || $_GET['pages']=='formpeminjamaninventaris' || $_GET['pages']=='formpeminjamanalatukur' || $_GET['pages']=='peminjamansaya' || $_GET['pages']=='arsippeminjaman' || $_GET['pages']=='formeditpeminjaman' || $_GET['pages'] == 'detailsuratjalan'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=='pilihformpeminjaman' || $_GET['pages']=='formpeminjamantools' || $_GET['pages']=='formpeminjamanapd' || $_GET['pages']=='formpeminjamaninventaris' || $_GET['pages']=='formpeminjamanalatukur' || $_GET['pages']=='peminjamansaya' || $_GET['pages']=='arsippeminjaman' || $_GET['pages']=='formeditpeminjaman' || $_GET['pages'] == 'detailsuratjalan'){ echo 'active'; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Peminjaman Asset
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=pilihformpeminjaman" class="nav-link <?php if($_GET['pages']=='pilihformpeminjaman' || $_GET['pages']=='formpeminjamantools' || $_GET['pages']=='formpeminjamanapd' || $_GET['pages']=='formpeminjamaninventaris' || $_GET['pages']=='formpeminjamanalatukur'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Form Peminjaman</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=peminjamansaya" class="nav-link <?php if($_GET['pages']=='peminjamansaya' || $_GET['pages']=='formeditpeminjaman' || $_GET['pages'] == 'detailsuratjalan'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <?php $jml_peminjaman_saya = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE peminjam = '$_SESSION[nik]' AND status = 'waiting for MA' OR status = 'on progress by MA' ORDER BY tgl_pinjam DESC")); ?>
                  <p>Peminjaman Saya <span class="badge badge-warning"><?php echo $jml_peminjaman_saya; ?></span></p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=arsippeminjaman" class="nav-link <?php if($_GET['pages']=='arsippeminjaman'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Arsip Peminjaman</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php if($_GET['pages']=='listpengembalian' || $_GET['pages']=='arsippengembalian' || $_GET['pages']=='formbastpengembalian'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=='listpengembalian' || $_GET['pages']=='arsippengembalian' || $_GET['pages']=='formbastpengembalian'){ echo 'active'; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Pengembalian Asset
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=listpengembalian" class="nav-link <?php if($_GET['pages']=='listpengembalian' || $_GET['pages']=='formbastpengembalian'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <?php
                    $jml_pengembalian_project = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_pengembalian WHERE penanggungjawab = '$_SESSION[nik]' AND status = 'waiting for approval'"));

                    $jml_pengembalian_nonproject = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE peminjam = '$_SESSION[nik]' AND kd_project IS NULL AND id NOT IN (SELECT peminjaman_id FROM asset_pengembalian_selesai WHERE peminjaman_id IS NOT NULL) ORDER BY id DESC"));
                  ?>
                  <p>List Pengembalian <span class="badge badge-danger"><?php echo $jml_pengembalian_project + $jml_pengembalian_nonproject; ?></span></p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=arsippengembalian" class="nav-link <?php if($_GET['pages']=='arsippengembalian'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Arsip Pengembalian</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- KELOLA ASSET -->
          <li class="nav-header"></li>
          <li class="nav-header">Kelola Asset</li>
          <li class="nav-item <?php if($_GET['pages']=='dbmerek' || $_GET['pages']=='dbgeneral' || $_GET['pages']=='dbdetail' || $_GET['pages']=='dbentitas' || $_GET['pages']=='dbpeminjaman' || $_GET['pages']=='dbpengajuan' || $_GET['pages']=='dbsuratjalan' || $_GET['pages']=='dbpengembalian'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=='dbmerek' || $_GET['pages']=='dbgeneral' || $_GET['pages']=='dbdetail' || $_GET['pages']=='dbentitas' || $_GET['pages']=='dbpeminjaman' || $_GET['pages']=='dbpengajuan' || $_GET['pages']=='dbsuratjalan' || $_GET['pages']=='dbpengembalian'){ echo 'active'; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Database
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=dbentitas" class="nav-link <?php if($_GET['pages']=='dbentitas'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Entitas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbmerek" class="nav-link <?php if($_GET['pages']=='dbmerek'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Merek</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbgeneral" class="nav-link <?php if($_GET['pages']=='dbgeneral'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbdetail" class="nav-link <?php if($_GET['pages']=='dbdetail'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbpengajuan" class="nav-link <?php if($_GET['pages']=='dbpengajuan'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Pengajuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbpeminjaman" class="nav-link <?php if($_GET['pages']=='dbpeminjaman'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Peminjaman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbsuratjalan" class="nav-link <?php if($_GET['pages']=='dbsuratjalan'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Surat Jalan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbpengembalian" class="nav-link <?php if($_GET['pages']=='dbpengembalian'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Pengembalian</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php if($_GET['pages']=='listpeminjamanbaru' || $_GET['pages']=='peminjamanonprogress' || $_GET['pages']=='peminjamancompleted' || $_GET['pages']=='peminjamanreject' || $_GET['pages']=='detailpeminjamanonprogress' || $_GET['pages']=='detailpeminjamancompleted'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=='listpeminjamanbaru' || $_GET['pages']=='peminjamanonprogress' || $_GET['pages']=='peminjamancompleted' || $_GET['pages']=='peminjamanreject' || $_GET['pages']=='detailpeminjamanonprogress' || $_GET['pages']=='detailpeminjamancompleted'){ echo 'active'; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Kelola Peminjaman
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=listpeminjamanbaru" class="nav-link <?php if($_GET['pages']=='listpeminjamanbaru'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <?php $jml_pengajuan_baru = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE status = 'waiting for MA'")); ?>
                  <p>Peminjaman Baru <span class="badge badge-info"><?php echo $jml_pengajuan_baru; ?></span></p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=peminjamanonprogress" class="nav-link <?php if($_GET['pages']=='peminjamanonprogress' || $_GET['pages']=='detailpeminjamanonprogress'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <?php $jml_pengajuan_progress = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE status = 'on progress by MA'")); ?>
                  <p>On Progress <span class="badge badge-warning"><?php echo $jml_pengajuan_progress; ?></span></p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=peminjamancompleted" class="nav-link <?php if($_GET['pages']=='peminjamancompleted' || $_GET['pages']=='detailpeminjamancompleted'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Completed</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=peminjamanreject" class="nav-link <?php if($_GET['pages']=='peminjamanreject'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Reject / Canceled</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item <?php if($_GET['pages']=='listbelumkembali' || $_GET['pages']=='pengembaliandetail' || $_GET['pages']=='listpengembalianselesai' || $_GET['pages']=='pengembaliandetailselesai'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=='listbelumkembali' || $_GET['pages']=='pengembaliandetail' || $_GET['pages']=='listpengembalianselesai' || $_GET['pages']=='pengembaliandetailselesai'){ echo 'active'; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Kelola Pengembalian
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=listbelumkembali" class="nav-link <?php if($_GET['pages']=='listbelumkembali' || $_GET['pages']=='pengembaliandetail'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <?php 
                    $jml_belum_kembali_project = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_project IN (SELECT kd_project FROM asset_peminjaman) AND kd_project NOT IN (SELECT kd_project FROM asset_pengembalian_selesai WHERE kd_project IS NOT NULL)"));

                    $jml_belum_kembali_nonproject = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE kd_project IS NULL AND id NOT IN (SELECT peminjaman_id FROM asset_pengembalian_selesai WHERE peminjaman_id IS NOT NULL) ORDER BY id DESC"));

                  ?>
                  <p>Belum Kembali <span class="badge badge-danger"><?php echo $jml_belum_kembali_project+$jml_belum_kembali_nonproject; ?></span></p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=listpengembalianselesai" class="nav-link <?php if($_GET['pages']=='listpengembalianselesai' || $_GET['pages']=='pengembaliandetailselesai'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Selesai</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item <?php if($_GET['pages']=='pilihformpengajuan' || $_GET['pages']=='formpengajuantools' || $_GET['pages']=='formpengajuanapd' || $_GET['pages']=='formpengajuaninventaris' || $_GET['pages']=='formpengajuanalatukur' || $_GET['pages'] == 'pengajuanonprogress' || $_GET['pages'] == 'pengajuancompleted' || $_GET["pages"]=="formeditpengajuan" || $_GET['pages']=='formrealisasi' || $_GET['pages']=='formeditrealisasi'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=='pilihformpengajuan' || $_GET['pages']=='formpengajuantools' || $_GET['pages']=='formpengajuanapd' || $_GET['pages']=='formpengajuaninventaris' || $_GET['pages']=='formpengajuanalatukur' || $_GET['pages'] == 'pengajuanonprogress' || $_GET['pages'] == 'pengajuancompleted' || $_GET["pages"]=="formeditpengajuan" || $_GET['pages']=='formrealisasi' || $_GET['pages']=='formeditrealisasi'){ echo 'active'; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Pengajuan Asset
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=pilihformpengajuan" class="nav-link <?php if($_GET['pages']=='pilihformpengajuan' || $_GET['pages']=='formpengajuantools' || $_GET['pages']=='formpengajuanapd' || $_GET['pages']=='formpengajuaninventaris' || $_GET['pages']=='formpengajuanalatukur' || $_GET['pages']=='formpengajuanperbaikan'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Form Pengajuan</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=pengajuanonprogress" class="nav-link <?php if($_GET['pages']=='pengajuanonprogress' || $_GET["pages"]=="formeditpengajuan" || $_GET['pages']=='formrealisasi'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <?php $belum_realisasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE status = 'belum realisasi'")); ?>
                  <p>Belum Realisasi <span class="badge badge-danger"><?php echo $belum_realisasi; ?></span></p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=pengajuancompleted" class="nav-link <?php if($_GET['pages']=='pengajuancompleted' || $_GET['pages']=='formeditrealisasi'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Sudah Realisasi</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="index.php?pages=listperbaikan" class="nav-link <?php if($_GET['pages']=='listperbaikan' || $_GET['pages']=='formpengajuanperbaikan' || $_GET['pages']=='editpengajuanperbaikan' || $_GET['pages']=='formrealisasiperbaikan'){ echo 'active'; } ?>">
              <i class="fa fa-file-text-o nav-icon"></i>
              <p>Perbaikan Asset <div class="badge badge-warning"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_perbaikan WHERE status = 'belum realisasi'")); ?></div></p>
            </a>
          </li>

          <li class="nav-item <?php if($_GET['pages']=='pilihstock' || $_GET['pages']=='datastock' || $_GET['pages']=='pilihstockopname' || $_GET['pages']=='stockopname' || $_GET['pages']=='dataassetrusak' || $_GET['pages']=='reportpengembalianproject' || $_GET['pages']=='annualreport'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=='pilihstock' || $_GET['pages']=='datastock' || $_GET['pages']=='pilihstockopname' || $_GET['pages']=='stockopname' || $_GET['pages']=='dataassetrusak' || $_GET['pages']=='reportpengembalianproject' || $_GET['pages']=='annualreport'){ echo 'active'; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Data Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=pilihstock" class="nav-link <?php if($_GET['pages']=='pilihstock' || $_GET['pages']=='datastock'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Data Stock</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=pilihstockopname" class="nav-link <?php if($_GET['pages']=='pilihstockopname' || $_GET['pages']=='stockopname'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Stock Opname</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=dataassetrusak" class="nav-link <?php if($_GET['pages']=='dataassetrusak'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Asset Rusak</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=reportpengembalianproject" class="nav-link <?php if($_GET['pages']=='reportpengembalianproject'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Report - Project</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=annualreport" class="nav-link <?php if($_GET['pages']=='annualreport'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Report - Annual</p>
                </a>
              </li>
            </ul>
          </li>

          <br><br>
                                           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Konten Wrapper -->
  <?php
    if(!isset($_GET['pages'])){
      require_once "dashboard.php";
    }elseif($_GET["pages"]=="profile"){
      require_once "../all_role/profile.php";
    }elseif($_GET["pages"]=="dailyreport"){
      require_once "../all_role/dailyreport.php";
    }elseif($_GET["pages"]=="datauserhse"){
      require_once "datauserhse.php";
    }elseif($_GET["pages"]=="datamanpower"){
      require_once "datamanpower.php";
    }elseif($_GET["pages"]=="dataproject"){
      require_once "dataproject.php";
    }elseif($_GET["pages"]=="datajabatan"){
      require_once "datajabatan.php";
    }elseif($_GET["pages"]=="datatools"){
      require_once "datatools.php";
    }elseif($_GET["pages"]=="datatoolsk3"){
      require_once "datatoolsk3.php";
    }elseif($_GET["pages"]=="dataapd"){
      require_once "dataapd.php";
    }elseif($_GET["pages"]=="datasertifikat"){
      require_once "datasertifikat.php";
    }elseif($_GET["pages"]=="datasertifikasi"){
      require_once "datasertifikasi.php";
    }elseif($_GET["pages"]=="detailproject"){
      require_once "detail_project.php";
    }elseif($_GET["pages"]=="formdailyreporthse"){
      require_once "form_dailyreport.php";
    }elseif($_GET["pages"]=="dailyreporthse"){
      require_once "dailyreport_hse.php";
    }elseif($_GET["pages"]=="report_inspeksiapd"){
      require_once "../../panelhse/HSE/report_inspeksi_apd.php";
    }elseif($_GET["pages"]=="reportinspeksiapar"){
      require_once "../../panelhse/HSE/report_inspeksi_apar.php";
    }elseif($_GET["pages"]=="reportinspeksip3k"){
      require_once "../../panelhse/HSE/report_inspeksi_p3k.php"; 
    }elseif($_GET["pages"]=="weeklyreport"){
      require_once "weeklyreport_hse.php";
    }elseif($_GET["pages"]=="manpowerplan_list"){
      require_once "../unrole/manpower_plan/manpower_plan_list.php";
    }elseif($_GET["pages"]=="manpowerplan"){
      require_once "../unrole/manpower_plan/manpower_plan.php";
    // ---------------------------- PEMINJAMAN & PENGEMBALIAN ASSET AWAL -------------------------
    }elseif($_GET["pages"]=="pilihformpeminjaman"){
      require_once "../unrole/management_asset/form_pilih_peminjaman.php";
    }elseif($_GET["pages"]=="formpeminjamantools" || $_GET["pages"]=="formpeminjamanapd" || $_GET["pages"]=="formpeminjamaninventaris" || $_GET["pages"]=="formpeminjamanalatukur"){
      require_once "../unrole/management_asset/form_peminjaman.php";
    }elseif($_GET["pages"]=="peminjamansaya"){
      require_once "../unrole/management_asset/peminjaman_saya.php";
    }elseif($_GET["pages"]=="detailsuratjalan"){
      require_once "../unrole/management_asset/detail_suratjalan_saya.php";
    }elseif($_GET["pages"]=="arsippeminjaman"){
      require_once "../unrole/management_asset/arsip_peminjaman.php";
    }elseif($_GET["pages"]=="listpengembalian"){
      require_once "../unrole/management_asset/list_pengembalian.php";
    }elseif($_GET["pages"]=="arsippengembalian"){
      require_once "../unrole/management_asset/arsip_pengembalian.php";
    }elseif($_GET["pages"]=="formeditpeminjaman"){
      require_once "../unrole/management_asset/form_edit_peminjaman.php";
    }elseif($_GET["pages"]=="formbastpengembalian"){
      require_once "../unrole/management_asset/form_bast_pengembalian.php";
    // ----------------------------PEMINJAMAN & PENGEMBALIAN ASSET AKHIR ------------------------

    // --------------------------- KELOLA ASSET -----------------------------------------------
    }elseif($_GET["pages"]=="dbentitas"){
      require_once "../unrole/management_asset/db_entitas.php";
    }elseif($_GET["pages"]=="dbmerek"){
      require_once "../unrole/management_asset/db_merek.php";
    }elseif($_GET["pages"]=="dbgeneral"){
      require_once "../unrole/management_asset/db_general.php";
    }elseif($_GET["pages"]=="dbdetail"){
      require_once "../unrole/management_asset/db_detail.php";
    }elseif($_GET["pages"]=="dbpeminjaman"){
      require_once "../unrole/management_asset/db_peminjaman.php";
    }elseif($_GET["pages"]=="dbpengajuan"){
      require_once "../unrole/management_asset/db_pengajuan.php";
    }elseif($_GET["pages"]=="dbsuratjalan"){
      require_once "../unrole/management_asset/db_suratjalan.php";
    }elseif($_GET["pages"]=="dbpengembalian"){
      require_once "../unrole/management_asset/db_pengembalian.php";
    }elseif($_GET["pages"]=="listpeminjamanbaru"){
      require_once "../unrole/management_asset/peminjaman_baru_list.php";
    }elseif($_GET["pages"]=="peminjamanonprogress"){
      require_once "../unrole/management_asset/peminjaman_progress.php";
    }elseif($_GET["pages"]=="peminjamancompleted"){
      require_once "../unrole/management_asset/peminjaman_completed.php";
    }elseif($_GET["pages"]=="peminjamanreject"){
      require_once "../unrole/management_asset/peminjaman_reject.php";
    }elseif($_GET["pages"]=="detailpeminjamanonprogress"){
      require_once "../unrole/management_asset/detail_peminjaman_progress.php";
    }elseif($_GET["pages"]=="detailpeminjamancompleted"){
      require_once "../unrole/management_asset/detail_peminjaman_completed.php";
    }elseif($_GET["pages"]=="pilihformpengajuan"){
      require_once "../unrole/management_asset/form_pilih_pengajuan.php";
    }elseif($_GET["pages"]=="formpengajuantools" || $_GET["pages"]=="formpengajuanapd" || $_GET["pages"]=="formpengajuaninventaris" || $_GET["pages"]=="formpengajuanalatukur"){
      require_once "../unrole/management_asset/form_pengajuan.php";
    }elseif($_GET["pages"]=="listperbaikan"){
      require_once "../unrole/management_asset/perbaikan_asset_list.php";
    }elseif($_GET["pages"]=="formpengajuanperbaikan"){
      require_once "../unrole/management_asset/form_pengajuan_perbaikan.php";
    }elseif($_GET["pages"]=="editpengajuanperbaikan"){
      require_once "../unrole/management_asset/edit_pengajuan_perbaikan.php";
    }elseif($_GET["pages"]=="formrealisasiperbaikan"){
      require_once "../unrole/management_asset/form_realisasi_perbaikan.php";
    }elseif($_GET["pages"]=="pengajuanonprogress"){
      require_once "../unrole/management_asset/pengajuan_onprogress_list.php";
    }elseif($_GET["pages"]=="pengajuancompleted"){
      require_once "../unrole/management_asset/pengajuan_completed_list.php";
    }elseif($_GET["pages"]=="formeditpengajuan"){
      require_once "../unrole/management_asset/form_pengajuan_edit.php";
    }elseif($_GET["pages"]=="formrealisasi"){
      require_once "../unrole/management_asset/form_realisasi.php";
    }elseif($_GET["pages"]=="formeditrealisasi"){
      require_once "../unrole/management_asset/form_edit_realisasi.php";
    }elseif($_GET["pages"]=="pilihstock"){
      require_once "../unrole/management_asset/data_stock_pilih.php";
    }elseif($_GET["pages"]=="pilihstockopname"){
      require_once "../unrole/management_asset/data_stock_opname_pilih.php";
    }elseif($_GET["pages"]=="stockopname"){
      require_once "../unrole/management_asset/data_stock_opname.php";
    }elseif($_GET["pages"]=="datastock"){
      require_once "../unrole/management_asset/data_stock.php";
    }elseif($_GET["pages"]=="listbelumkembali"){
      require_once "../unrole/management_asset/belum_kembali_list.php";
    }elseif($_GET["pages"]=="listpengembalianselesai"){
      require_once "../unrole/management_asset/pengembalian_selesai_list.php";
    }elseif($_GET["pages"]=="pengembaliandetailselesai"){
      require_once "../unrole/management_asset/pengembalian_detail_selesai.php";
    }elseif($_GET["pages"]=="pengembaliandetail"){
      require_once "../unrole/management_asset/pengembalian_detail.php";
    }elseif($_GET["pages"]=="dataassetrusak"){
      require_once "../unrole/management_asset/data_asset_rusak.php";
    }elseif($_GET["pages"]=="reportpengembalianproject"){
      require_once "../unrole/management_asset/report_pengembalian_project.php";
    }elseif($_GET["pages"]=="annualreport"){
      require_once "../unrole/management_asset/report_annual.php";
    }

  ?>
  <!-- ./Konten Wrapper -->

   <footer class="main-footer no-print">
    <strong>Copyright &copy; 2023 Powersurya.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php require_once "../all_role/footer.php"; ?>