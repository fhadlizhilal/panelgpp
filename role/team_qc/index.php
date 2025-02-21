<?php
  error_reporting(0);
  ob_start(); 
  session_start();
  date_default_timezone_set('Asia/Jakarta');
  $this_day = date("Y-m-d H:i:s");

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "team_qc"){
    header("location: ../../login.php");
  }

  require_once "../../dev/config.php";
  require_once "../all_role/header.php";

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

  
  if(isset($_POST['open_form_reportpv'])){
    if($_POST['open_form_reportpv'] == 'Buka Form'){
      $push_list_reportpv = mysqli_query($conn, "INSERT INTO qc_reportlist VALUES('','$_POST[nama_pekerjaan]','$_POST[tgl_report]','pv',CURRENT_TIMESTAMP)");
      $id_baru = mysqli_insert_id($conn);

      if($push_list_reportpv){
        header("Location: index.php?pages=formreportpv&id=".$id_baru);
      }else{
        $_SESSION['alert_error'] = "Gagal membuka form report pv!";
      }
    }
  }

  if(isset($_POST['add_data_pv'])){
    if($_POST['add_data_pv'] == "Simpan"){

      if(!empty($_FILES["file"]["name"]) AND empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
            
          if($compressedImage){
            $push_data_pv = mysqli_query($conn, "INSERT INTO qc_reportpv_detail VALUES('','$_POST[report_id]','$_POST[no_seri]','$_POST[tegangan]','$_POST[kondisi_fisik]','$_POST[jarak_lubang_frame]','$fileName','$_POST[random_check]','')");

            if($push_data_pv){
              $_SESSION['alert_success'] = "Berhasil! Data PV Berhasil ditambahkan";
            }else{
              unlink("dokumentasi_report/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Data PV gagal ditambahkan <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data PV gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }

      }elseif(!empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $imageUploadPath2 = $uploadPath . $fileName2;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes) AND in_array($fileType2, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $imageTemp2 = $_FILES["file2"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
            
          if($compressedImage AND $compressedImage2){
            $push_data_pv = mysqli_query($conn, "INSERT INTO qc_reportpv_detail VALUES('','$_POST[report_id]','$_POST[no_seri]','$_POST[tegangan]','$_POST[kondisi_fisik]','$_POST[jarak_lubang_frame]','$fileName','$_POST[random_check]','$fileName2')");

            if($push_data_pv){
              $_SESSION['alert_success'] = "Berhasil! Data PV Berhasil ditambahkan";
            }else{
              unlink("dokumentasi_report/".$fileName);
              unlink("dokumentasi_report/".$fileName2);
              $_SESSION['alert_error'] = "Gagal! Data PV gagal ditambahkan 2 <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            unlink("dokumentasi_report/".$fileName2);
            $_SESSION['alert_error'] = "Gagal! Data PV gagal disimpan 2, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          unlink("dokumentasi_report/".$fileName2);
          $_SESSION['alert_error'] = "Gagal 2! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }
      }else{
        $_SESSION['alert_error'] = "Gagal 2! Kesalahan pada form <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['edit_data_pv'])){
    if($_POST['edit_data_pv'] == "Ubah"){
      if(empty($_FILES["file"]["name"]) AND empty($_FILES["file2"]["name"])){
        $edit_data_pv = mysqli_query($conn, "UPDATE qc_reportpv_detail SET no_seri = '$_POST[no_seri]', tegangan = '$_POST[tegangan]', kondisi_fisik = '$_POST[kondisi_fisik]', jarak_lubang_frame = '$_POST[jarak_lubang_frame]', random_check = '$_POST[random_check]' WHERE id = '$_POST[id]'");

        if($edit_data_pv){
          $_SESSION['alert_success'] = "Berhasil! Data PV Berhasil diubah";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data PV gagal diubah <br>".mysqli_error($conn);
        }

      }if(!empty($_FILES["file"]["name"]) AND empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
            
          if($compressedImage){
            $get_data_pv_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportpv_detail WHERE id = '$_POST[id]'"));
            $edit_data_pv = mysqli_query($conn, "UPDATE qc_reportpv_detail SET no_seri = '$_POST[no_seri]', tegangan = '$_POST[tegangan]', kondisi_fisik = '$_POST[kondisi_fisik]', jarak_lubang_frame = '$_POST[jarak_lubang_frame]', foto = '$fileName', random_check = '$_POST[random_check]' WHERE id = '$_POST[id]'");

            if($edit_data_pv){
              unlink("dokumentasi_report/".$get_data_pv_old['foto']);
              $_SESSION['alert_success'] = "Berhasil! Data PV Berhasil Diubah";
            }else{
              unlink("dokumentasi_report/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Data PV gagal Diubah <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data PV gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }

      }if(empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file2"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes)){
          $imageTemp = $_FILES["file2"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
            
          if($compressedImage){
            $get_data_pv_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportpv_detail WHERE id = '$_POST[id]'"));
            $edit_data_pv = mysqli_query($conn, "UPDATE qc_reportpv_detail SET no_seri = '$_POST[no_seri]', tegangan = '$_POST[tegangan]', kondisi_fisik = '$_POST[kondisi_fisik]', jarak_lubang_frame = '$_POST[jarak_lubang_frame]', random_check = '$_POST[random_check]', foto_random_check = '$fileName' WHERE id = '$_POST[id]'");

            if($edit_data_pv){
              unlink("dokumentasi_report/".$get_data_pv_old['foto_random_check']);
              $_SESSION['alert_success'] = "Berhasil! Data PV Berhasil Diubah";
            }else{
              unlink("dokumentasi_report/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Data PV gagal Diubah <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data PV gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }

      }if(!empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $imageUploadPath2 = $uploadPath . $fileName2;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes) AND in_array($fileType2, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $imageTemp2 = $_FILES["file2"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
            
          if($compressedImage AND $compressedImage2){
            $get_data_pv_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportpv_detail WHERE id = '$_POST[id]'"));
            $edit_data_pv = mysqli_query($conn, "UPDATE qc_reportpv_detail SET no_seri = '$_POST[no_seri]', tegangan = '$_POST[tegangan]', kondisi_fisik = '$_POST[kondisi_fisik]', jarak_lubang_frame = '$_POST[jarak_lubang_frame]', foto = '$fileName', random_check = '$_POST[random_check]', foto_random_check = '$fileName2' WHERE id = '$_POST[id]'");

            if($edit_data_pv){
              unlink("dokumentasi_report/".$get_data_pv_old['foto']);
              unlink("dokumentasi_report/".$get_data_pv_old['foto_random_check']);
              $_SESSION['alert_success'] = "Berhasil! Data PV Berhasil Diubah";
            }else{
              unlink("dokumentasi_report/".$fileName);
              unlink("dokumentasi_report/".$fileName2);
              $_SESSION['alert_error'] = "Gagal! Data PV gagal Diubah 2 <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            unlink("dokumentasi_report/".$fileName2);
            $_SESSION['alert_error'] = "Gagal! Data PV gagal disimpan 2, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          unlink("dokumentasi_report/".$fileName2);
          $_SESSION['alert_error'] = "Gagal 2! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }
      }
    }
  }

  if(isset($_POST['delete_data_pv'])){
    if($_POST['delete_data_pv'] == "Delete"){
      $get_data_pv = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportpv_detail WHERE id = '$_POST[id]'"));
      $delete_data_pv = mysqli_query($conn, "DELETE FROM qc_reportpv_detail WHERE id = '$_POST[id]'");

      if($delete_data_pv){
        unlink("dokumentasi_report/".$get_data_pv['foto']);
        unlink("dokumentasi_report/".$get_data_pv['foto_random_check']);
        $_SESSION['alert_success'] = "Berhasil! Data PV Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data PV gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['edit_report'])){
    if($_POST['edit_report'] == "Ubah"){
      $edit_report = mysqli_query($conn, "UPDATE qc_reportlist SET nm_pekerjaan = '$_POST[nm_pekerjaan]', tgl = '$_POST[tgl_report]' WHERE id = '$_POST[id]'");

      if($edit_report){
        $_SESSION['alert_success'] = "Berhasil! Report Berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Report Gagal diubah";
      }
    }
  }

  if(isset($_POST['delete_list_report'])){
    if($_POST['delete_list_report'] == "Delete"){
      $delete_list_report = mysqli_query($conn, "DELETE FROM qc_reportlist WHERE id = '$_POST[id]'");

      if($delete_list_report){
        $_SESSION['alert_success'] = "Berhasil! Report Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Report Gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['open_form_reportlampuaio'])){
    if($_POST['open_form_reportlampuaio'] == 'Buka Form'){
      $push_list_reportpv = mysqli_query($conn, "INSERT INTO qc_reportlist VALUES('','$_POST[nama_pekerjaan]','$_POST[tgl_report]','lampu_aio',CURRENT_TIMESTAMP)");
      $id_baru = mysqli_insert_id($conn);

      if($push_list_reportpv){
        header("Location: index.php?pages=formreportlampuaio&id=".$id_baru);
      }else{
        $_SESSION['alert_error'] = "Gagal membuka form report pv!";
      }
    }
  }

  if(isset($_POST['add_data_lampuaio'])){
    if($_POST['add_data_lampuaio'] == "Simpan"){

      if(!empty($_FILES["file"]["name"]) AND empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
            
          if($compressedImage){
            $push_data_lampuaio = mysqli_query($conn, "INSERT INTO qc_reportlampuaio_detail VALUES('','$_POST[report_id]','$_POST[no_seri]','$fileName','$_POST[kondisi_lampu]','$_POST[aksesoris]','$_POST[random_check]','')");

            if($push_data_lampuaio){
              $_SESSION['alert_success'] = "Berhasil! Data Lampu All In One Berhasil ditambahkan";
            }else{
              unlink("dokumentasi_report/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal ditambahkan <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }

      }elseif(!empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $imageUploadPath2 = $uploadPath . $fileName2;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes) AND in_array($fileType2, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $imageTemp2 = $_FILES["file2"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
            
          if($compressedImage AND $compressedImage2){
            $push_data_lampuaio = mysqli_query($conn, "INSERT INTO qc_reportlampuaio_detail VALUES('','$_POST[report_id]','$_POST[no_seri]','$fileName','$_POST[kondisi_lampu]','$_POST[aksesoris]','$_POST[random_check]','$fileName2')");

            if($push_data_lampuaio){
              $_SESSION['alert_success'] = "Berhasil! Data Lampu All In One Berhasil ditambahkan";
            }else{
              unlink("dokumentasi_report/".$fileName);
              unlink("dokumentasi_report/".$fileName2);
              $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal ditambahkan 2 <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            unlink("dokumentasi_report/".$fileName2);
            $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal disimpan 2, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          unlink("dokumentasi_report/".$fileName2);
          $_SESSION['alert_error'] = "Gagal 2! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }
      }else{
        $_SESSION['alert_error'] = "Gagal 2! Kesalahan pada form <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['edit_data_lampuaio'])){
    if($_POST['edit_data_lampuaio'] == "Ubah"){

      if(empty($_FILES["file"]["name"]) AND empty($_FILES["file2"]["name"])){
        $edit_data_lampuaio = mysqli_query($conn, "UPDATE qc_reportlampuaio_detail SET no_seri = '$_POST[no_seri]', kondisi_lampu = '$_POST[kondisi_lampu]', aksesoris = '$_POST[aksesoris]', random_check = '$_POST[random_check]' WHERE id = '$_POST[id]'");

        if($edit_data_lampuaio){
          $_SESSION['alert_success'] = "Berhasil! Data Lampu All In One Berhasil diubah";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal diubah <br>".mysqli_error($conn);
        }

      }if(!empty($_FILES["file"]["name"]) AND empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
            
          if($compressedImage){
            $get_data_lampuaio_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuaio_detail WHERE id = '$_POST[id]'"));
            $edit_data_lampuaio = mysqli_query($conn, "UPDATE qc_reportlampuaio_detail SET no_seri = '$_POST[no_seri]', foto_lampu = '$fileName', kondisi_lampu = '$_POST[kondisi_lampu]', aksesoris = '$_POST[aksesoris]', random_check = '$_POST[random_check]' WHERE id = '$_POST[id]'");

            if($edit_data_lampuaio){
              unlink("dokumentasi_report/".$get_data_lampuaio_old['foto_lampu']);
              $_SESSION['alert_success'] = "Berhasil! Data Lampu All In One Berhasil Diubah";
            }else{
              unlink("dokumentasi_report/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal Diubah <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }

      }if(empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file2"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes)){
          $imageTemp = $_FILES["file2"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
            
          if($compressedImage){
            $get_data_lampuaio_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuaio_detail WHERE id = '$_POST[id]'"));
            $edit_data_lampuaio = mysqli_query($conn, "UPDATE qc_reportlampuaio_detail SET no_seri = '$_POST[no_seri]', kondisi_lampu = '$_POST[kondisi_lampu]', aksesoris = '$_POST[aksesoris]', random_check = '$_POST[random_check]', foto_random_check = '$fileName' WHERE id = '$_POST[id]'");

            if($edit_data_lampuaio){
              unlink("dokumentasi_report/".$get_data_lampuaio_old['foto_random_check']);
              $_SESSION['alert_success'] = "Berhasil! Data Lampu All In One Berhasil Diubah";
            }else{
              unlink("dokumentasi_report/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal Diubah <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal disimpan, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }

      }if(!empty($_FILES["file"]["name"]) AND !empty($_FILES["file2"]["name"])){
        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $fileName2 = $nodate."_".basename($_FILES["file2"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $imageUploadPath2 = $uploadPath . $fileName2;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $fileType2 = pathinfo($imageUploadPath2, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes) AND in_array($fileType2, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $imageTemp2 = $_FILES["file2"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          $compressedImage2 = compressImage($imageTemp2, $imageUploadPath2, 10);
            
          if($compressedImage AND $compressedImage2){
            $get_data_lampuaio_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuaio_detail WHERE id = '$_POST[id]'"));
            $edit_data_lampuaio = mysqli_query($conn, "UPDATE qc_reportlampuaio_detail SET no_seri = '$_POST[no_seri]', foto_lampu = '$fileName', kondisi_lampu = '$_POST[kondisi_lampu]', aksesoris = '$_POST[aksesoris]', random_check = '$_POST[random_check]', foto_random_check = '$fileName2' WHERE id = '$_POST[id]'");

            if($edit_data_lampuaio){
              unlink("dokumentasi_report/".$get_data_lampuaio_old['foto_lampu']);
              unlink("dokumentasi_report/".$get_data_lampuaio_old['foto_random_check']);
              $_SESSION['alert_success'] = "Berhasil! Data Lampu All In One Berhasil Diubah";
            }else{
              unlink("dokumentasi_report/".$fileName);
              unlink("dokumentasi_report/".$fileName2);
              $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal Diubah 2 <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            unlink("dokumentasi_report/".$fileName2);
            $_SESSION['alert_error'] = "Gagal! Data Lampu All In One gagal disimpan 2, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          unlink("dokumentasi_report/".$fileName2);
          $_SESSION['alert_error'] = "Gagal 2! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }
      }
    }
  }

  if(isset($_POST['delete_data_lampuaio'])){
    if($_POST['delete_data_lampuaio'] == 'Delete'){
      $get_data_lampuaio = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuaio_detail WHERE id = '$_POST[id]'"));
      $delete_data_lampuaio = mysqli_query($conn, "DELETE FROM qc_reportlampuaio_detail WHERE id = '$_POST[id]'");

      if($delete_data_lampuaio){
        unlink("dokumentasi_report/".$get_data_lampuaio['foto_lampu']);
        unlink("dokumentasi_report/".$get_data_lampuaio['foto_random_check']);
        $_SESSION['alert_success'] = "Berhasil! Data PV Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data PV gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['open_form_reporttiangoktagonal'])){
    if($_POST['open_form_reporttiangoktagonal'] == 'Buka Form'){
      $push_list_reportpv = mysqli_query($conn, "INSERT INTO qc_reportlist VALUES('','$_POST[nama_pekerjaan]','$_POST[tgl_report]','tiang_oktagonal',CURRENT_TIMESTAMP)");
      $id_baru = mysqli_insert_id($conn);

      if($push_list_reportpv){
        header("Location: index.php?pages=formreporttiangoktagonal&id=".$id_baru);
      }else{
        $_SESSION['alert_error'] = "Gagal membuka form report pv!";
      }
    }
  }

  if(isset($_POST['add_data_tiangoktagonal'])){
    if($_POST['add_data_tiangoktagonal'] == "Simpan"){
      $uploadPath = "dokumentasi_report/";
      $nodate = date('YmdHis');
      $fileName = $nodate."_".basename($_FILES["file"]["name"]);
      $imageUploadPath = $uploadPath . $fileName;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $allowTypes = array('jpg','png','jpeg','gif');

      if(in_array($fileType, $allowTypes)){
        $imageTemp = $_FILES["file"]["tmp_name"];
        $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          
        if($compressedImage){
          $push_data_tiangoktagonal = mysqli_query($conn, "INSERT INTO qc_reporttiangoktagonal_detail VALUES('','$_POST[report_id]','$_POST[panjang_segmen1]', '$_POST[panjang_segmen2]', '$_POST[panjang_arm]', '$_POST[tinggi_arm]', '$_POST[klem_murbaut]', '$_POST[support_modul]', '$_POST[anti_panjat]', '$_POST[jarak_lubang_baut]', '$_POST[panjanglebar_baseplate]', '$_POST[kemiringan_arm]', '$_POST[kemiringan_support_modul]', '$fileName')");

          if($push_data_tiangoktagonal){
            $_SESSION['alert_success'] = "Berhasil! Data Tiang Oktagonal Berhasil ditambahkan";
          }else{
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data Tiang Oktagonal gagal ditambahkan <br>".mysqli_error($conn);
          }
        }else{ 
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Data Tiang Oktagonal gagal disimpan, File foto tidak dapat dikompresi";
        } 
      }else{
        unlink("dokumentasi_report/".$fileName);
        $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
      }
    }
  }

  if(isset($_POST['edit_data_tiangoktagonal'])){
    if($_POST['edit_data_tiangoktagonal'] == "Ubah"){

    }
  }

  if(isset($_POST['delete_data_tiangoktagonal'])){
    if($_POST['delete_data_tiangoktagonal'] == "Ubah"){

    }
  }

  if(isset($_POST['add_lampiran_tiangoktagonal'])){
    if($_POST['add_lampiran_tiangoktagonal'] == "Simpan"){
      $uploadPath = "dokumentasi_report/";
      $nodate = date('YmdHis');
      $fileName = $nodate."_".basename($_FILES["file"]["name"]);
      $imageUploadPath = $uploadPath . $fileName;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $allowTypes = array('jpg','png','jpeg','gif');

      if(in_array($fileType, $allowTypes)){
        $imageTemp = $_FILES["file"]["tmp_name"];
        $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          
        if($compressedImage){
          $push_lampiran_tiangoktagonal = mysqli_query($conn, "INSERT INTO qc_reporttiangoktagonal_lampiran VALUES('','$_POST[report_id]','$_POST[keterangan]', '$fileName')");

          if($push_lampiran_tiangoktagonal){
            $_SESSION['alert_success'] = "Berhasil! Lampiran Tiang Oktagonal Berhasil ditambahkan";
          }else{
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Lampiran Tiang Oktagonal gagal ditambahkan <br>".mysqli_error($conn);
          }
        }else{ 
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Lampiran Tiang Oktagonal gagal disimpan, File foto tidak dapat dikompresi";
        } 
      }else{
        unlink("dokumentasi_report/".$fileName);
        $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
      }
    }
  }

  if(isset($_POST['edit_lampiran_tiangoktagonal'])){
    if($_POST['edit_lampiran_tiangoktagonal']){

      if(empty($_FILES["file"]["name"])){
        $edit_lampiran_tiangoktagonal = mysqli_query($conn, "UPDATE qc_reporttiangoktagonal_lampiran SET keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'");

        if($edit_lampiran_tiangoktagonal){
          $_SESSION['alert_success'] = "Berhasil! Lampiran berhasil diubah!";
        }else{
          $_SESSION['alert_error'] = "Gagal! Lampiran gagal diubah!";
        }
      }else{

      }
    }
  }

  if(isset($_POST['delete_lampiran_tiangoktagonal'])){
    if($_POST['delete_lampiran_tiangoktagonal'] == "Delete"){
      $get_data_lampiranTiangOktagonal = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reporttiangoktagonal_lampiran WHERE id = '$_POST[id]'"));
      $delete_lampiran_tiangoktagonal = mysqli_query($conn, "DELETE FROM qc_reporttiangoktagonal_lampiran WHERE id = '$_POST[id]'");

      if($delete_lampiran_tiangoktagonal){
        unlink("dokumentasi_report/".$get_data_lampiranTiangOktagonal['foto']);
        $_SESSION['alert_success'] = "Berhasil! Lampiran berhasil dihapus!";
      }else{
        $_SESSION['alert_error'] = "Gagal! Lampiran gagal dihapus!";
      }
    }
  }

  if(isset($_POST['open_form_reportlampuac'])){
    if($_POST['open_form_reportlampuac'] == "Buka Form"){
      $push_list_reporlampuac = mysqli_query($conn, "INSERT INTO qc_reportlist VALUES('','$_POST[nama_pekerjaan]','$_POST[tgl_report]','lampu_ac',CURRENT_TIMESTAMP)");
      $id_baru = mysqli_insert_id($conn);

      if($push_list_reporlampuac){
        header("Location: index.php?pages=formreportlampuaco&id=".$id_baru);
      }else{
        $_SESSION['alert_error'] = "Gagal membuka form report pv!";
      }
    }
  }

  if(isset($_POST['add_data_lampuac'])){
    if($_POST['add_data_lampuac'] == "Simpan"){
      $uploadPath = "dokumentasi_report/";
      $nodate = date('YmdHis');
      $fileName = $nodate."_".basename($_FILES["file"]["name"]);
      $imageUploadPath = $uploadPath . $fileName;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $allowTypes = array('jpg','png','jpeg','gif');

      if(in_array($fileType, $allowTypes)){
        $imageTemp = $_FILES["file"]["tmp_name"];
        $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          
        if($compressedImage){
          $push_data_lampuac = mysqli_query($conn, "INSERT INTO qc_reportlampuac_detail VALUES('','$_POST[report_id]','$_POST[kondisi]', '$_POST[stiker_qc]', '$fileName')");

          if($push_data_lampuac){
            $_SESSION['alert_success'] = "Berhasil! Data Lampu AC Berhasil ditambahkan";
          }else{
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data Lampu AC gagal ditambahkan <br>".mysqli_error($conn);
          }
        }else{ 
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Data Lampu AC gagal disimpan, File foto tidak dapat dikompresi";
        } 
      }else{
        unlink("dokumentasi_report/".$fileName);
        $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
      }
    }
  }

  if(isset($_POST['delete_data_lampuac'])){
    if($_POST['delete_data_lampuac'] == 'Delete'){
      $get_data_lampuac = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuac_detail WHERE id = '$_POST[id]'"));
      $delete_data_lampuac = mysqli_query($conn, "DELETE FROM qc_reportlampuac_detail WHERE id = '$_POST[id]'");

      if($delete_data_lampuac){
        unlink("dokumentasi_report/".$get_data_lampuac['foto']);
        $_SESSION['alert_success'] = "Berhasil! Data Lampu AC Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Lampu AC gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['edit_data_lampuac'])){
    if($_POST['edit_data_lampuac'] == "Ubah"){
      if(empty($_FILES["file"]["name"])){
        $edit_data_lampuac = mysqli_query($conn, "UPDATE qc_reportlampuac_detail SET kondisi = '$_POST[kondisi]', stiker_qc = '$_POST[stiker_qc]' WHERE id = '$_POST[id]'");

        if($edit_data_lampuac){
          $_SESSION['alert_success'] = "Berhasil! Data Lampu AC Berhasil Diubah!";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Lampu AC Gagal Diubah!";
        }
      }else{

        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
            
          if($compressedImage){
            $get_dalaOld = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuac_detail WHERE id = '$_POST[id]'"));
            $edit_data_lampuac = mysqli_query($conn, "UPDATE qc_reportlampuac_detail SET kondisi = '$_POST[kondisi]', stiker_qc = '$_POST[stiker_qc]', foto = '$fileName' WHERE id = '$_POST[id]'");

            if($edit_data_lampuac){
              unlink("dokumentasi_report/".$get_dalaOld['foto']);
              $_SESSION['alert_success'] = "Berhasil! Data Lampu AC Berhasil diubah";
            }else{
              unlink("dokumentasi_report/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Data Lampu AC gagal diubah <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data Lampu AC gagal diubah, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }
      }
    }
  }

  if(isset($_POST['add_lampiran_lampuac'])){
    if($_POST['add_lampiran_lampuac']){
      $uploadPath = "dokumentasi_report/";
      $nodate = date('YmdHis');
      $fileName = $nodate."_".basename($_FILES["file"]["name"]);
      $imageUploadPath = $uploadPath . $fileName;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $allowTypes = array('jpg','png','jpeg','gif');

      if(in_array($fileType, $allowTypes)){
        $imageTemp = $_FILES["file"]["tmp_name"];
        $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          
        if($compressedImage){
          $push_lampiran_lampuac = mysqli_query($conn, "INSERT INTO qc_reportlampuac_lampiran VALUES('','$_POST[report_id]','$_POST[keterangan]', '$fileName')");

          if($push_lampiran_lampuac){
            $_SESSION['alert_success'] = "Berhasil! Lampiran Lampu AC Berhasil ditambahkan";
          }else{
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Lampiran Lampu AC gagal ditambahkan <br>".mysqli_error($conn);
          }
        }else{ 
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Lampiran Lampu AC gagal disimpan, File foto tidak dapat dikompresi";
        } 
      }else{
        unlink("dokumentasi_report/".$fileName);
        $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
      }
    }
  }

  if(isset($_POST['delete_lampiran_lampuac'])){
    if($_POST['delete_lampiran_lampuac'] == "Delete"){
      $get_data_lampiran = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportlampuac_lampiran WHERE id = '$_POST[id]'"));
      $delete_lampiran_lampuac = mysqli_query($conn, "DELETE FROM qc_reportlampuac_lampiran WHERE id = '$_POST[id]'");

      if($delete_lampiran_lampuac){
        unlink("dokumentasi_report/".$get_data_lampiran['foto']);
        $_SESSION['alert_success'] = "Berhasil! Lampiran berhasil dihapus!";
      }else{
        $_SESSION['alert_error'] = "Gagal! Lampiran gagal dihapus!";
      }
    }
  }

  if(isset($_POST['open_form_reportenergylimiter'])){
    if($_POST['open_form_reportenergylimiter'] == "Buka Form"){
      $push_list_reporenergylimiter = mysqli_query($conn, "INSERT INTO qc_reportlist VALUES('','$_POST[nama_pekerjaan]','$_POST[tgl_report]','energy_limiter',CURRENT_TIMESTAMP)");
      $id_baru = mysqli_insert_id($conn);

      if($push_list_reporenergylimiter){
        header("Location: index.php?pages=formreportenergylimiter&id=".$id_baru);
      }else{
        $_SESSION['alert_error'] = "Gagal membuka form report!";
      }
    }
  }

  if(isset($_POST['add_data_energylimiter'])){
    if($_POST['add_data_energylimiter'] == "Simpan"){
      $uploadPath = "dokumentasi_report/";
      $nodate = date('YmdHis');
      $fileName = $nodate."_".basename($_FILES["file"]["name"]);
      $imageUploadPath = $uploadPath . $fileName;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $allowTypes = array('jpg','png','jpeg','gif');

      if(in_array($fileType, $allowTypes)){
        $imageTemp = $_FILES["file"]["tmp_name"];
        $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          
        if($compressedImage){
          $push_data_energylimiter = mysqli_query($conn, "INSERT INTO qc_reportenergylimiter_detail VALUES('','$_POST[report_id]','$_POST[barcode]', '$_POST[power_limit]', '$_POST[time_reset]', '$_POST[time_region]', '$_POST[credit_setting]', '$fileName')");

          if($push_data_energylimiter){
            $_SESSION['alert_success'] = "Berhasil! Data Energy Limiter Berhasil ditambahkan";
          }else{
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data Energy Limiter gagal ditambahkan <br>".mysqli_error($conn);
          }
        }else{ 
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Data Energy Limiter gagal disimpan, File foto tidak dapat dikompresi";
        } 
      }else{
        unlink("dokumentasi_report/".$fileName);
        $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
      }
    }
  }

  if(isset($_POST['delete_data_energylimiter'])){
    if($_POST['delete_data_energylimiter'] == 'Delete'){
      $get_data_energylimiter = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportenergylimiter_detail WHERE id = '$_POST[id]'"));
      $delete_data_energylimiter = mysqli_query($conn, "DELETE FROM qc_reportenergylimiter_detail WHERE id = '$_POST[id]'");

      if($delete_data_energylimiter){
        unlink("dokumentasi_report/".$get_data_energylimiter['foto']);
        $_SESSION['alert_success'] = "Berhasil! Data Energy Limiter Berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Energy Limiter gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['edit_data_energylimiter'])){
    if($_POST['edit_data_energylimiter'] == "Ubah"){
      if(empty($_FILES["file"]["name"])){
        $edit_data_energylimiter = mysqli_query($conn, "UPDATE qc_reportenergylimiter_detail SET barcode = '$_POST[barcode]', power_limit = '$_POST[power_limit]', time_reset = '$_POST[time_reset]', time_region = '$_POST[time_region]', credit_setting = '$_POST[credit_setting]' WHERE id = '$_POST[id]'");

        if($edit_data_energylimiter){
          $_SESSION['alert_success'] = "Berhasil! Data Energy Limiter Berhasil Diubah!";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Energy Limiter Gagal Diubah!";
        }
      }else{

        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
            
          if($compressedImage){
            $get_dataOld = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportenergylimiter_detail WHERE id = '$_POST[id]'"));
            $edit_data_energylimiter = mysqli_query($conn, "UPDATE qc_reportenergylimiter_detail SET barcode = '$_POST[barcode]', power_limit = '$_POST[power_limit]', time_reset = '$_POST[time_reset]', time_region = '$_POST[time_region]', credit_setting = '$_POST[credit_setting]', foto = '$fileName' WHERE id = '$_POST[id]'");

            if($edit_data_energylimiter){
              unlink("dokumentasi_report/".$get_dataOld['foto']);
              $_SESSION['alert_success'] = "Berhasil! Data Energy Limiter Berhasil diubah";
            }else{
              unlink("dokumentasi_report/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Data Energy Limiter gagal diubah <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Data Energy Limiter gagal diubah, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }
      }
    }
  }

  if(isset($_POST['add_lampiran_energylimiter'])){
    if($_POST['add_lampiran_energylimiter']){
      $uploadPath = "dokumentasi_report/";
      $nodate = date('YmdHis');
      $fileName = $nodate."_".basename($_FILES["file"]["name"]);
      $imageUploadPath = $uploadPath . $fileName;
      $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
      $allowTypes = array('jpg','png','jpeg','gif');

      if(in_array($fileType, $allowTypes)){
        $imageTemp = $_FILES["file"]["tmp_name"];
        $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
          
        if($compressedImage){
          $push_lampiran_lampuac = mysqli_query($conn, "INSERT INTO qc_reportenergylimiter_lampiran VALUES('','$_POST[report_id]','$_POST[keterangan]', '$fileName')");

          if($push_lampiran_lampuac){
            $_SESSION['alert_success'] = "Berhasil! Lampiran Energy Limiter Berhasil ditambahkan";
          }else{
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Lampiran Energy Limiter gagal ditambahkan <br>".mysqli_error($conn);
          }
        }else{ 
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Lampiran Energy Limiter gagal disimpan, File foto tidak dapat dikompresi";
        } 
      }else{
        unlink("dokumentasi_report/".$fileName);
        $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
      }
    }
  }

  if(isset($_POST['delete_lampiran_energylimiter'])){
    if($_POST['delete_lampiran_energylimiter'] == "Delete"){
      $get_data_lampiran = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportenergylimiter_lampiran WHERE id = '$_POST[id]'"));
      $delete_lampiran_energylimiter = mysqli_query($conn, "DELETE FROM qc_reportenergylimiter_lampiran WHERE id = '$_POST[id]'");

      if($delete_lampiran_energylimiter){
        unlink("dokumentasi_report/".$get_data_lampiran['foto']);
        $_SESSION['alert_success'] = "Berhasil! Lampiran berhasil dihapus!";
      }else{
        $_SESSION['alert_error'] = "Gagal! Lampiran gagal dihapus!";
      }
    }
  }

  if(isset($_POST['edit_lampiran_energylimiter'])){
    if($_POST['edit_lampiran_energylimiter'] == "Ubah"){
      if(empty($_FILES["file"]["name"])){
        $edit_lampiran_energylimiter = mysqli_query($conn, "UPDATE qc_reportenergylimiter_lampiran SET keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'");

        if($edit_lampiran_energylimiter){
          $_SESSION['alert_success'] = "Berhasil! Lampiran Energy Limiter Berhasil Diubah!";
        }else{
          $_SESSION['alert_error'] = "Gagal! Lampiran Energy Limiter Gagal Diubah!";
        }
      }else{

        $uploadPath = "dokumentasi_report/";
        $nodate = date('YmdHis');
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif');

        if(in_array($fileType, $allowTypes)){
          $imageTemp = $_FILES["file"]["tmp_name"];
          $compressedImage = compressImage($imageTemp, $imageUploadPath, 10);
            
          if($compressedImage){
            $get_dataOld = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM qc_reportenergylimiter_lampiran WHERE id = '$_POST[id]'"));
            $edit_lampiran_energylimiter = mysqli_query($conn, "UPDATE qc_reportenergylimiter_lampiran SET keterangan = '$_POST[keterangan]', foto = '$fileName' WHERE id = '$_POST[id]'");

            if($edit_lampiran_energylimiter){
              unlink("dokumentasi_report/".$get_dataOld['foto']);
              $_SESSION['alert_success'] = "Berhasil! Lampiran Energy Limiter Berhasil diubah";
            }else{
              unlink("dokumentasi_report/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Lampiran Energy Limiter gagal diubah <br>".mysqli_error($conn);
            }
          }else{ 
            unlink("dokumentasi_report/".$fileName);
            $_SESSION['alert_error'] = "Gagal! Lampiran Energy Limiter gagal diubah, File foto tidak dapat dikompresi";
          } 
        }else{
          unlink("dokumentasi_report/".$fileName);
          $_SESSION['alert_error'] = "Gagal! Tipe File yang diupload hanya boleh JPG, PNG, dan JPEG";
        }
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
          <!-- <span class="badge badge-warning navbar-badge">10</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <span class="dropdown-item dropdown-header">10 Notifications</span>
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
            <a href="index.php?pages=dailyreport" class="nav-link">
              <i class="fa fa-file-o nav-icon"></i>
              <p>Daily Report</p>
            </a>
          </li>

          <li class="nav-item <?php if($_GET['pages'] == "listreportpv" || $_GET['pages'] == "listreportlampuaio" || $_GET['pages'] == "formreportpv" || $_GET['pages'] == "formreportlampuaio" || $_GET['pages'] == "listreporttiangoktagonal" || $_GET['pages'] == "formreporttiangoktagonal" || $_GET['pages'] == "listreportlampuac" || $_GET['pages'] == "formreportlampuac" || $_GET['pages'] == "listreportenergylimiter" || $_GET['pages'] == "formreportenergylimiter"){ echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages'] == "listreportpv" || $_GET['pages'] == "listreportlampuaio" || $_GET['pages'] == "formreportpv" || $_GET['pages'] == "formreportlampuaio" || $_GET['pages'] == "listreporttiangoktagonal" || $_GET['pages'] == "formreporttiangoktagonal" || $_GET['pages'] == "listreportlampuac" || $_GET['pages'] == "formreportlampuac" || $_GET['pages'] == "listreportenergylimiter" || $_GET['pages'] == "formreportenergylimiter"){ echo "active"; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Report QC
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=listreportpv" class="nav-link <?php if($_GET['pages'] == "listreportpv" || $_GET['pages'] == "formreportpv"){ echo "active"; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>PV Module</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=listreportlampuaio" class="nav-link <?php if($_GET['pages'] == "listreportlampuaio" || $_GET['pages'] == "formreportlampuaio"){ echo "active"; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Lampu All In One</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=listreporttiangoktagonal" class="nav-link <?php if($_GET['pages'] == "listreporttiangoktagonal" || $_GET['pages'] == "formreporttiangoktagonal"){ echo "active"; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Tiang Oktagonal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=listreportlampuac" class="nav-link <?php if($_GET['pages'] == "listreportlampuac" || $_GET['pages'] == "formreportlampuac"){ echo "active"; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Lampu AC</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=listreportenergylimiter" class="nav-link <?php if($_GET['pages'] == "listreportenergylimiter" || $_GET['pages'] == "formreportenergylimiter"){ echo "active"; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Energy Limiter</p>
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
    }elseif($_GET["pages"]=="listreportpv"){
      require_once "list_report_pv.php";
    }elseif($_GET["pages"]=="formreportpv"){
      require_once "form_pv.php";
    }elseif($_GET["pages"]=="listreportlampuaio"){
      require_once "list_report_lampuaio.php";
    }elseif($_GET["pages"]=="formreportlampuaio"){
      require_once "form_lampu_aio.php";
    }elseif($_GET["pages"]=="listreporttiangoktagonal"){
      require_once "list_report_tiangoktagonal.php";
    }elseif($_GET["pages"]=="formreporttiangoktagonal"){
      require_once "form_tiangoktagonal.php";
    }elseif($_GET["pages"]=="listreportlampuac"){
      require_once "list_report_lampuac.php";
    }elseif($_GET["pages"]=="formreportlampuac"){
      require_once "form_lampu_ac.php";
    }elseif($_GET["pages"]=="listreportenergylimiter"){
      require_once "list_report_energylimiter.php";
    }elseif($_GET["pages"]=="formreportenergylimiter"){
      require_once "form_energy_limiter.php";
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
    }
    // ----------------------------PEMINJAMAN & PENGEMBALIAN ASSET AKHIR ------------------------

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