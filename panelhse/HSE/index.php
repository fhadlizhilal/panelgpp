<?php
  error_reporting(0);
  ob_start(); 
  session_start();

  ini_set('memory_limit', '256M');

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "HSEUSER"){
    header("location: ../../login-hse.php");
  }

  date_default_timezone_set('Asia/Jakarta'); // Sesuaikan dengan lokasi

  require_once "../all_role/header.php";
  require_once "../../dev/config.php";
  $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$_SESSION[manpower_id]'"));

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
      $get_foto = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE id = '$_POST[id]'"));
      $delete_isuk3 = mysqli_query($conn, "DELETE FROM hse_dailyreport_isu WHERE id = '$_POST[id]'");

      if($delete_isuk3){
        unlink("../../role/HSE/foto_isuk3/".$get_foto['foto']);
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
                $compressedImage = compressImage($imageTemp, $imageUploadPath, 40);
                  
                if($compressedImage){ 
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

        // Check if file size is less than or equal to 2MB
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
                $compressedImage = compressImage($imageTemp, $imageUploadPath, 40);
                  
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
        unlink("../../role/HSE/dokumentasi_project/".$nama_foto);
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
        $tgl_now = date('Y-m-d H:i:s');
        $edit_status_dailyreport = mysqli_query($conn, "UPDATE hse_dailyreport SET status_report = 'completed', tgl_submit = '$tgl_now' WHERE kd_report = '$_POST[kd_report]'");

        if($edit_status_dailyreport){
          header("Location: success.php?msg=Berhasil! Report Project Berhasil Disubmit&topages=detailproject&kd=".$_POST['project_id']);
          exit;
        }else{
          $_SESSION['alert_error'] = "Gagal! Report project gagal disubmit";
        }
      }
    }
  }

  if(isset($_POST['project_hold'])){
    if($_POST['project_hold'] == "Project Hold"){
      $tgl_now = date('Y-m-d H:i:s');
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

          header("Location: success.php?msg=Berhasil! Project Hold Berhasil Disubmit&topages=detailproject&kd=".$_POST['project_id']);
          exit;
        }else{
          $_SESSION['alert_error'] = "Gagal! Project Hold gagal disubmit";
        }
    }
  }

  if(isset($_POST['project_libur'])){
    if($_POST['project_libur'] == "Libur / Tidak ada pekerjaan"){
      $tgl_now = date('Y-m-d H:i:s');
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

          header("Location: success.php?msg=Berhasil! Project Libur Berhasil Disubmit&topages=detailproject&kd=".$_POST['project_id']);
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

  if(isset($_POST['submit_add_list_induction'])){
    if($_POST['submit_add_list_induction'] == "Simpan"){
      $push_list_induction = mysqli_query($conn, "INSERT INTO hse_inductionreport VALUES('','$_POST[project_id]','$_POST[hse_officer]','$_POST[tgl_induction]','$_POST[tempat]','open')");

      if($push_list_induction){
        $_SESSION['alert_success'] = "Berhasil! List Induction Baru Berhasil Ditambahkan";
        echo "<meta http-equiv='refresh' content='0'>";
      }else{
        $_SESSION['alert_error'] = "Gagal! List Induction Baru Gagal Ditambahkan. ".mysqli_error($conn);
        echo "<meta http-equiv='refresh' content='0'>";
      }
    }
  }

  if(isset($_POST['edit_status_spk'])){
    if($_POST['edit_status_spk'] == "Ubah"){
      $edit_status_spk = mysqli_query($conn, "UPDATE hse_inductionreport SET status = '$_POST[status]' WHERE id = '$_POST[id]'");

      if($edit_status_spk){
        $_SESSION['alert_success'] = "Berhasil! Status SPK Berhasil Diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Status SPK Gagal Diubah. ".mysqli_error($conn);
      }
    }
  }

  if(isset($_GET['delete'])){
    if($_GET['delete'] == "data_spk"){
      $delete_dataspk = mysqli_query($conn, "DELETE FROM hse_inductionreport_spk WHERE id = '$_GET[id]'");

      if($delete_dataspk){
        echo "<meta http-equiv='refresh' content='0;url=index.php?pages=listspk'>";
        $_SESSION['alert_success'] = "Berhasil! Data SPK Berhasil Dihapus";
      }else{
        echo "<meta http-equiv='refresh' content='0;url=index.php?pages=listspk'>";
        $_SESSION['alert_error'] = "Gagal! Data SPK Gagal Dihapus. ".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_add_toolsapd_onsite'])){
    if($_POST['submit_add_toolsapd_onsite'] == "Simpan"){
      $cek_list_sebelumnya = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite WHERE project_id = '$_POST[project_id]' AND status = 'progress'"));

      if($cek_list_sebelumnya > 0){
        $_SESSION['alert_error'] = "Gagal Membuat List Onsite Baru! <br> Report Onsite Sebelumnya masih ada yang progress, tolong selesaikan terlebih dahulu!";
      }else{
        $push_toolsapd_onsite = mysqli_query($conn, "INSERT INTO hse_toolsapdonsite VALUES('','$_POST[project_id]','$_POST[hse_officer]','$_POST[tanggal]','$_POST[keterangan]','progress')");

        if($push_toolsapd_onsite){
          $_SESSION['alert_success'] = "Berhasil! Report Tools & APD Onsite Berhasil Dibuat";
          echo "<meta http-equiv='refresh' content='0'>";
        }else{
          $_SESSION['alert_error'] = "Gagal! Report Tools & APD Onsite Gagal Dibuat. ".mysqli_error($conn);
          echo "<meta http-equiv='refresh' content='0'>";
        }
      }
    }
  }

  if(isset($_POST['delete_form_onsite'])){
    if($_POST['delete_form_onsite'] = "Delete"){
      $delete_form_onsite = mysqli_query($conn, "DELETE FROM hse_toolsapdonsite WHERE id = '$_POST[kd_onsite]'");
      if($delete_form_onsite){
        $_SESSION['alert_success'] = "Berhasil! Form Tools APD Onsite Berhasil Di Delete";
      }else{
        $_SESSION['alert_error'] = "Gagal! Form Tools APD Onsite Gagal Di Hapus. ".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['delete_list_induction'])){
    if($_POST['delete_list_induction'] == 'Delete'){
      $delete_list_induction = mysqli_query($conn, "DELETE FROM hse_inductionreport WHERE id = '$_POST[id]'");

      if($delete_list_induction){
        $_SESSION['alert_success'] = "Berhasil! List Induction Berhasil Di Delete";
      }else{
        $_SESSION['alert_error'] = "Gagal! List Induction Gagal Di Hapus. ".mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['simpan_toolsapdonsite_detail'])){
    if($_POST['simpan_toolsapdonsite_detail'] == "Simpan"){
      //Push To toolsapdonsite_detailapd
      mysqli_query($conn, "DELETE FROM hse_toolsapdonsite_detailapd WHERE id_onsite = '$_POST[id_onsite]'");
      $q_getApd = mysqli_query($conn, "SELECT * FROM hse_apd");
      while($get_apd = mysqli_fetch_array($q_getApd)){
        $apd_id = $get_apd['id'];
        $jml_apd = $_POST['jml_apd_'.$apd_id];
        if($jml_apd > 0){
          mysqli_query($conn, "INSERT INTO hse_toolsapdonsite_detailapd VALUES('','$_POST[id_onsite]','$apd_id','$jml_apd')");
        }
      }

      //Push To toolsapdonsite_detailtoolsk3
      mysqli_query($conn, "DELETE FROM hse_toolsapdonsite_detailtoolsk3 WHERE id_onsite = '$_POST[id_onsite]'");
      $q_getToolsk3 = mysqli_query($conn, "SELECT * FROM hse_toolsk3");
      while($get_toolsk3 = mysqli_fetch_array($q_getToolsk3)){
        $toolsk3_id = $get_toolsk3['id'];
        $jml_toolsk3 = $_POST['jml_toolsk3_'.$toolsk3_id];
        if($jml_toolsk3 > 0){
          mysqli_query($conn, "INSERT INTO hse_toolsapdonsite_detailtoolsk3 VALUES('','$_POST[id_onsite]','$toolsk3_id','$jml_toolsk3')");
        }
      }

      //Push To toolsapdonsite_detailtools
      mysqli_query($conn, "DELETE FROM hse_toolsapdonsite_detailtools WHERE id_onsite = '$_POST[id_onsite]'");
      $q_getTools = mysqli_query($conn, "SELECT * FROM hse_tools");
      while($get_tools = mysqli_fetch_array($q_getTools)){
        $tools_id = $get_tools['id'];
        $jml_tools = $_POST['jml_tools_'.$tools_id];
        if($jml_tools > 0){
          mysqli_query($conn, "INSERT INTO hse_toolsapdonsite_detailtools VALUES('','$_POST[id_onsite]','$tools_id','$jml_tools')");
        }
      }
    }
  }

  if(isset($_POST['submit_toolsapdonsite_detail'])){
    if($_POST['submit_toolsapdonsite_detail']=="Submit"){
      $submit_toolsapdonsite  = mysqli_query($conn, "UPDATE hse_toolsapdonsite SET status = 'completed' WHERE id = '$_POST[kd_onsite]'");
      if($submit_toolsapdonsite){
        $_SESSION['alert_success'] = "Berhasil! Data Tools & APD onsite berhasil disubmit.";
        echo "<meta http-equiv='refresh' content='0'>";
      }
    }
  }

  if(isset($_POST['open_form_inspeksi'])){
    if($_POST['open_form_inspeksi'] == "Tambah Inspeksi"){
      $array = explode("/", $_POST['kd_weekly']);
      $x = "/".$array[2];
      $cek_inspeksilist_progress = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE kd_weekly LIKE '%$x' AND status = 'progress'"));
      
      if($cek_inspeksilist_progress > 0){
        $_SESSION['alert_warning'] = "Form Inspeksi masih ada yang berstatus progress, tolong selesaikan terlebih dahulu";
      }else{
        $open_form_inspeksi = mysqli_query($conn, "INSERT INTO hse_inspeksilist VALUES('','$_POST[kd_weekly]','$_SESSION[manpower_id]','$_POST[tgl_inspeksi]','','','','','$_POST[jenis_inspeksi]','','','','','progress')");
        
        if($open_form_inspeksi){
          $_SESSION['alert_success'] = "Berhasil!<br>Form Inspeksi berhasil dibuat!";
        }else{
          $_SESSION['alert_warning'] = "ERROR : ".mysqli_error($conn);
        }

      }
    }
  }

  if(isset($_POST['simpan_inspeksi_detailapd'])){
    if($_POST['simpan_inspeksi_detailapd'] == "Simpan"){
      //clear table inspeksi_detailapd by inspeksi_id
        mysqli_query($conn, "DELETE FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_POST[inspeksi_id]'");

      //Update rekomendasi
        mysqli_query($conn, "UPDATE hse_inspeksilist SET rekomendasi = '$_POST[rekomendasi]' WHERE id = '$_POST[inspeksi_id]'");

      // Get APD
      $q_get_apd = mysqli_query($conn, "SELECT * FROM hse_apd");
      while($get_apd = mysqli_fetch_array($q_get_apd)){

        $id_apd = $get_apd['id'];
        $total = $_POST['total_'.$id_apd];
        $baik = $_POST['baik_'.$id_apd];
        $rusak = $_POST['rusak_'.$id_apd];
        $hilang = $_POST['hilang_'.$id_apd];
        $jml_mingguini = $_POST['jml_mingguini_'.$id_apd];
        $total_asset = $_POST['total_asset_'.$id_apd];
        $deviasi = 100-((($jml_mingguini-$rusak-$hilang)/$total_asset)*100);
        //$deviasi = $_POST['deviasi_'.$id_apd];

        if($_POST['total_'.$id_apd] > 0){
          //Push To Inspeski List Detail APD
          mysqli_query($conn, "INSERT INTO hse_inspeksilist_detailapd VALUES('','$_POST[inspeksi_id]','$id_apd','$total','$jml_mingguini','$deviasi','$baik','$rusak','$hilang')");
        }
      }

    }
  }

  if(isset($_POST['delete_form_inspeksiapd'])){
    if($_POST['delete_form_inspeksiapd'] == "Delete"){
      //Delete data inspeksi_detailapd & Inpeksi list
      $delete_detail = mysqli_query($conn, "DELETE FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_POST[inspeksi_id]'");
      $delete_list = mysqli_query($conn, "DELETE FROM hse_inspeksilist WHERE id = '$_POST[inspeksi_id]'");
      if($delete_detail && $delete_list){
        echo "<meta http-equiv='refresh' content='0;index.php?pages=detailproject&kd=$_POST[kd_project]'>";
        $_SESSION['alert_success'] = "Berhasil! Inspeksi List Berhasil Dihapus";
      }
    }
  }

  if(isset($_POST['submit_inspeksi_detailapd'])){
    if($_POST['submit_inspeksi_detailapd'] == "Submit"){
      $submit_inspeksi = mysqli_query($conn, "UPDATE hse_inspeksilist SET status = 'completed' WHERE id = '$_POST[inspeksi_id]'");
      if($submit_inspeksi){
        echo "<meta http-equiv='refresh' content='0;index.php?pages=detailproject&kd=$_POST[kd_project]'>";
        $_SESSION['alert_success'] = "Berhasil! Inspeksi Berhasil Disubmit!";
      }else{
        $_SESSION['alert_error'] = "Gagal! Inspeksi Gagal Disubmit";
      }     
    }
  }

  if(isset($_POST['add_dokumentasi_inspeksiapd'])){
    if($_POST['add_dokumentasi_inspeksiapd'] == "Simpan"){
      $uploadPath = "../../role/HSE/foto_inspeksi_apd/";

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
                $push_dokumentasi_inspeksiapd = mysqli_query($conn, "INSERT INTO hse_inspeksilist_fotoapd VALUES('','$_POST[inspeksi_id]','$fileName','$_POST[keterangan]')");

                if($push_dokumentasi_inspeksiapd){
                  $_SESSION['alert_success'] = "Berhasil! Dokumentasi Inspeksi APD Berhasil Ditambahkan";
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

  if(isset($_POST['delete_foto_inspeksi_apd'])){
    if($_POST['delete_foto_inspeksi_apd'] == "Delete"){
      $get_data_inspeksiapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotoapd WHERE id = '$_POST[id]'"));
      $delete_foto_inspeksi_apd = mysqli_query($conn, "DELETE FROM hse_inspeksilist_fotoapd WHERE id = '$_POST[id]'");
      
      if($delete_foto_inspeksi_apd){
        unlink("../../role/HSE/foto_inspeksi_apd/".$get_data_inspeksiapd['foto']);
        $_SESSION['alert_success'] = "Berhasil! Dokumentasi Inspeksi APD Berhasil Di Delete";
      }else{
        $_SESSION['alert_error'] = "Gagal! Dokumentasi Inspeksi APD Gagal Di Hapus. ".mysqli_error($conn);
      }
    }
  }

  
  if(isset($_POST['ttd_apd_hse'])){
      $signatureImage = $_POST['signatureImage'];

      // Decode the base64 encoded image
      list($type, $data) = explode(';', $signatureImage);
      list(, $data) = explode(',', $data);
      $data = base64_decode($data);

      $file_name = "HSEinsAPD_".$_POST['inspeksi_id'].'_'.uniqid().'.png';
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

    $file_name = "SMinsAPD_".$_POST['inspeksi_id'].'_'.uniqid().'.png';
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
      <img src="../../dist/img/logo/logo-k3-v2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Panel HSE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if($get_manpower['foto'] == ""){ ?>
            <img class="img-circle elevation-2" src="../../dist/img/Vector-User.png" alt="User Image">
          <?php }else{ ?>
            <img class="img-circle elevation-2" src="../../role/HSE/foto_manpower/<?php echo $get_manpower['foto']; ?>" alt="User Image">
          <?php } ?>
        </div>
        <div class="info">
          <a href="?pages=profile" class="d-block"><?php echo implode(" ", array_slice(explode(" ", $get_manpower['nama']), 0, 2)); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
          <li class="nav-item">
            <a href="index.php?pages=dataproject" class="nav-link <?php if($_GET['pages']=="datauserhse" || $_GET['pages']=="datamanpower" || $_GET['pages']=="dataproject" || $_GET['pages']=="datajabatan" || $_GET['pages']=="datatools" || $_GET['pages']=="datatoolsk3" || $_GET['pages']=="dataapd" || $_GET['pages']=="datasertifikat" || $_GET['pages']=="datasertifikasi" || $_GET['pages']=="detailproject" || $_GET['pages']=="formdailyreporthse" || $_GET['pages']=="dailyreporthse" || $_GET['pages']=="weeklyreport"){ echo "active"; } ?>">
              <i class="fa fa-file-text-o nav-icon"></i>
              <p>My Project</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?pages=listspk" class="nav-link <?php if($_GET['pages']=="listspk"){ echo "active"; } ?>">
              <i class="fa fa-file-text-o nav-icon"></i>
              <p>Induction & SPK</p>
            </a>
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
    }elseif($_GET["pages"]=="dataproject"){
      require_once "dataproject.php";
    }elseif($_GET["pages"]=="detailproject"){
      require_once "detail_project.php";
    }elseif($_GET["pages"]=="formdailyreporthse"){
      require_once "form_dailyreport.php";
    }elseif($_GET["pages"]=="dailyreporthse"){
      require_once "dailyreport_hse.php";
    }elseif($_GET["pages"]=="weeklyreport"){
      require_once "weeklyreport_hse.php";
    }elseif($_GET["pages"]=="listspk"){
      require_once "listspk.php";
    }elseif($_GET["pages"]=="form_toolsapdonsite_detail"){
      require_once "form_toolsapd_onsite.php";
    }elseif($_GET["pages"]=="forminspeksiapd"){
      require_once "form_inspeksi_apd.php";
    }elseif($_GET["pages"]=="forminspeksiapar"){
      require_once "form_inspeksi_apar.php";
    }elseif($_GET["pages"]=="report_inspeksiapd"){
      require_once "report_inspeksi_apd.php";
    }elseif($_GET["pages"]=="reportinspeksiapar"){
      require_once "report_inspeksi_apar.php";
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