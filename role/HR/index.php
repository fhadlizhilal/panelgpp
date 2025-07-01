<?php
  error_reporting(0);
  ob_start();
  session_start();

  date_default_timezone_set('Asia/Jakarta');
  $this_day = date('Y-m-d H:i:s');
  $this_date = date('Y-m-d');

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "HR"){
    header("location: ../../login.php");
  }

  require_once "../all_role/header.php";
  require_once "../../dev/config.php";
  require_once "excel_reader2.php";

  function rupiah($angka){
  
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
 
  }

  //Push Hari Libur
  if(isset($_POST['add_hari_libur'])){
    if($_POST['add_hari_libur'] == "Simpan Hari"){
      $_POST['keterangan'] = "<b>".$_POST['keterangan']."</b>";
      $push_hari_libur = mysqli_query($conn,"INSERT INTO harilibur VALUES('','$_POST[tanggal]','$_POST[keterangan]','$this_day')");

      $get_hari = $this_day;
      $q_getNik = mysqli_query($conn, "SELECT * FROM karyawan");
      while($get_nik = mysqli_fetch_array($q_getNik)){
        $reset_AI = mysqli_query($conn, "ALTER TABLE dailyreport AUTO_INCREMENT = 1");
        $push_to_all = mysqli_query($conn, "INSERT INTO dailyreport VALUES ('','$get_nik[nik]','$_POST[tanggal]','$_POST[keterangan]','$get_hari')");
      }

      if($push_hari_libur && $push_to_all){
        $_SESSION['alert_success'] = "Berhasil! Hari libur baru berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Hari libur baru gagal disimpan";
      }
    }
  }

  //Edit Hari Libur
  if(isset($_POST['edit_hari_libur'])){
    if($_POST['edit_hari_libur'] == "Ubah Hari"){
      $_POST['keterangan'] = "<b>".$_POST['keterangan']."</b>";
      $_POST['keterangan_old'] = "<b>".$_POST['keterangan_old']."</b>";
      
      //Ubah harilibur
      $ubah_harilibur = mysqli_query($conn,"UPDATE harilibur SET tanggal = '$_POST[tanggal]', keterangan = '$_POST[keterangan]', created_at = '$this_day' WHERE id = '$_POST[id]'");
      //Ubah All
      $ubah_all = mysqli_query($conn,"UPDATE dailyreport SET tanggal = '$_POST[tanggal]', report = '$_POST[keterangan]', creation_date = '$this_day' WHERE tanggal = '$_POST[tanggal_old]' AND report = '$_POST[keterangan_old]' AND creation_date = '$_POST[created_at_old]'");

      if($ubah_harilibur && $ubah_all){
        $_SESSION['alert_success'] = "Berhasil! Hari libur baru berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Hari libur baru gagal diubah";
      }
    }
  }

  //Delete Hari Libur
  if(isset($_POST['delete_hari_libur'])){
    if($_POST['delete_hari_libur'] == "Delete"){
      $_POST['keterangan'] = "<b>".$_POST['keterangan']."</b>";

      //Delete harilibur
      $delete_harilibur = mysqli_query($conn, "DELETE FROM harilibur WHERE id = '$_POST[id]'");

      //Delete All
      $delete_all = mysqli_query($conn, "DELETE FROM dailyreport WHERE tanggal = '$_POST[tanggal]' AND report = '$_POST[keterangan]' AND creation_date = '$_POST[created_at]'");

      if($delete_harilibur && $delete_all){
        $_SESSION['alert_success'] = "Berhasil! Hari libur baru berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Hari libur baru gagal dihapus";
      }
    }
  }

  //Push Tugas Kantor
  if(isset($_POST['add_tugas_kantor'])){
    if($_POST['add_tugas_kantor'] == "Simpan"){
      $dari = strtotime($_POST['dari']);
      $sampai = strtotime($_POST['sampai']);
      $report_tgl = $_POST['dari'];
      $_POST['keterangan'] = "<b>".$_POST['keterangan']."</b>";

      $jarak = $sampai - $dari;
      $j_hari = $jarak / 60 / 60 / 24;

      if($dari > $sampai){
        $_SESSION['alert_error'] = "Tanggal 'dari' tidak boleh lebih besar dari tanggal 'sampai'";
      }else{
        //Push tugas_kantor
        $push_tugas_kantor = mysqli_query($conn,"INSERT INTO tugas_kantor VALUES('','$_POST[nik]','$_POST[dari]','$_POST[sampai]','$_POST[keterangan]','$this_day')");

        for($i=0;$i<=$j_hari;$i++){
          $q_cek_report = mysqli_query($conn, "SELECT * FROM dailyreport WHERE nik = '$_POST[nik]' AND tanggal = '$report_tgl'");
          $count_report = mysqli_num_rows($q_cek_report);

          if($count_report<1){
            //Push to dailyreport
            $reset_AI = mysqli_query($conn, "ALTER TABLE dailyreport AUTO_INCREMENT = 1");
            $push_to_daily = mysqli_query($conn, "INSERT INTO dailyreport VALUES ('','$_POST[nik]','$report_tgl','$_POST[keterangan]','$this_day')");
          }
          $report_tgl = date('Y-m-d', strtotime('+1 days', strtotime($report_tgl)));
        }

        if($push_tugas_kantor){
          $_SESSION['alert_success'] = "Berhasil! Tugas kantor baru berhasil disimpan";
        }else{
          $_SESSION['alert_error'] = "Gagal! Tugas kantor baru gagal disimpan";
        }
      }
    }
  }

  //Edit Tugas Kantor
  if(isset($_POST['edit_tugas_kantor'])){
    if($_POST['edit_tugas_kantor'] == "Ubah"){
      
      if(strtotime($_POST['dari']) > strtotime($_POST['sampai'])){
        $_SESSION['alert_error'] = "Tanggal 'dari' tidak boleh lebih besar dari tanggal 'sampai'";
      }else{
        $get_TugasKantor_old = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tugas_kantor WHERE id = '$_POST[TugasKantor_id]'"));

        $dari = strtotime($get_TugasKantor_old['dari']);
        $sampai = strtotime($get_TugasKantor_old['sampai']);
        $report_tgl = $get_TugasKantor_old['dari'];

        $jarak = $sampai - $dari;
        $j_hari = $jarak / 60 / 60 / 24;

        //Delete tugas_kantor
        $delete_tugaskantor = mysqli_query($conn, "DELETE FROM tugas_kantor WHERE id = '$_POST[TugasKantor_id]'");

        for($i=0;$i<=$j_hari;$i++){
          //Delete Tugas Awal
          $delete_from_daily = mysqli_query($conn, "DELETE FROM dailyreport WHERE tanggal = '$report_tgl' AND report = '$get_TugasKantor_old[keterangan]' AND creation_date = '$get_TugasKantor_old[created_at]'");
          $report_tgl = date('Y-m-d', strtotime('+1 days', strtotime($report_tgl)));
        }

        //Push New Tugas Kantor from Edit
        $dari = strtotime($_POST['dari']);
        $sampai = strtotime($_POST['sampai']);
        $report_tgl = $_POST['dari'];
        $_POST['keterangan'] = "<b>".$_POST['keterangan']."</b>";

        $jarak = $sampai - $dari;
        $j_hari = $jarak / 60 / 60 / 24;

        //Push tugas_kantor
        $push_tugas_kantor = mysqli_query($conn,"INSERT INTO tugas_kantor VALUES('','$_POST[nik]','$_POST[dari]','$_POST[sampai]','$_POST[keterangan]','$this_day')");

        for($i=0;$i<=$j_hari;$i++){
          $q_cek_report = mysqli_query($conn, "SELECT * FROM dailyreport WHERE nik = '$_POST[nik]' AND tanggal = '$report_tgl'");
          $count_report = mysqli_num_rows($q_cek_report);

          if($count_report<1){
            //Push to dailyreport
            $reset_AI = mysqli_query($conn, "ALTER TABLE dailyreport AUTO_INCREMENT = 1");
            $push_to_daily = mysqli_query($conn, "INSERT INTO dailyreport VALUES ('','$_POST[nik]','$report_tgl','$_POST[keterangan]','$this_day')");
          }
          $report_tgl = date('Y-m-d', strtotime('+1 days', strtotime($report_tgl)));
        }

        if($push_tugas_kantor){
          $_SESSION['alert_success'] = "Berhasil! Tugas kantor baru berhasil disimpan";
        }else{
          $_SESSION['alert_error'] = "Gagal! Tugas kantor baru gagal disimpan";
        }
      }
    }
  }

  //Delete Tugas Kantor
  if(isset($_POST['delete_tugas_kantor'])){
    if($_POST['delete_tugas_kantor'] == "Delete"){
      //Delete tugas_kantor
      $delete_tugaskantor = mysqli_query($conn, "DELETE FROM tugas_kantor WHERE id = '$_POST[id]'");

      $dari = strtotime($_POST['dari']);
      $sampai = strtotime($_POST['sampai']);
      $report_tgl = $_POST['dari'];

      $jarak = $sampai - $dari;
      $j_hari = $jarak / 60 / 60 / 24;

      for($i=0;$i<=$j_hari;$i++){

        //Delete from dailyreport
        $delete_from_daily = mysqli_query($conn, "DELETE FROM dailyreport WHERE tanggal = '$report_tgl' AND report = '$_POST[keterangan]' AND creation_date = '$_POST[created_at]'");
        $report_tgl = date('Y-m-d', strtotime('+1 days', strtotime($report_tgl)));
      }

      if($delete_tugaskantor){
          $_SESSION['alert_success'] = "Berhasil! Tugas kantor berhasil dihapus";
      }else{
          $_SESSION['alert_error'] = "Gagal! Tugas kantor gagal dihapus";
      }
    }
  }

  //Edit Data Karyawan
  if(isset($_POST['edit_data_karyawan'])){
    if($_POST['edit_data_karyawan'] == "Ubah"){
      //edit data karyawan
      $edit_karyawan = mysqli_query($conn, "UPDATE karyawan SET nik = '$_POST[nik]', nama = '$_POST[nm_karyawan]', jabatan_id = '$_POST[jabatan]', gaji = '$_POST[gaji]', tgl_masuk = '$_POST[tgl_masuk]', status = '$_POST[status]' WHERE nik = '$_POST[id]'");

      if($edit_karyawan){
        $_SESSION['alert_success'] = "Berhasil! Data Karyawan berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Karyawan gagal diubah";
      }
    }
  }

  //Add Data Karyawan
  if(isset($_POST['add_data_karyawan'])){
    if($_POST['add_data_karyawan'] == "Simpan"){
      //edit data karyawan
      $add_karyawan = mysqli_query($conn, "INSERT INTO karyawan VALUES('','$_POST[nik]','$_POST[nm_karyawan]','$_POST[jabatan]','$_POST[username]','$_POST[password]','$_POST[role]','$_POST[nohp]','$_POST[email]','$_POST[gaji]','$_POST[foto]','$_POST[tgl_masuk]','aktif')");

      if($add_karyawan){
        $_SESSION['alert_success'] = "Berhasil! Data Karyawan baru berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Karyawan baru gagal disimpan ".mysqli_error($conn);
      }
    }
  }

  //Set Tanggal dan Jam Absen Masuk
  if(isset($_POST['set_absen_masuk'])){
    if($_POST['set_absen_masuk'] == "SET"){
      $_SESSION['tanggal_masuk_set'] = date("d-m-Y", strtotime($_POST['tanggal_masuk']));
      $_SESSION['jam_masuk_set'] = $_POST['jam_masuk'];
      $tgl = date("Y-m-d", strtotime($_SESSION['tanggal_masuk_set']));

      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' ORDER BY jabatan_id ASC");
      while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
        $getTmpAbsen = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk_tmp WHERE nik = '$get_karyawan[nik]'"));

        $jam_kantor = strtotime($_SESSION['tanggal_masuk_set']." ".$_SESSION['jam_masuk_set']);
        $jam_karyawan = strtotime($_SESSION['tanggal_masuk_set']." ".$getTmpAbsen['jam']);

        if($getTmpAbsen['jam'] != "-"){
          if($jam_karyawan > $jam_kantor){
            mysqli_query($conn, "UPDATE absen_masuk_tmp SET status = '-' WHERE id = '$getTmpAbsen[id]'");
          }else{
            mysqli_query($conn, "UPDATE absen_masuk_tmp SET status = 'Masuk' WHERE id = '$getTmpAbsen[id]'");
          }
        }

        //Update from TugasKantor
        $q_tugasKantor = mysqli_query($conn, "SELECT * FROM tugas_kantor WHERE nik = '$get_karyawan[nik]' AND dari <= '$tgl' AND sampai >= '$tgl'");
        $cek_tugasKantor = mysqli_num_rows($q_tugasKantor);
        $getTugasKantor = mysqli_fetch_array($q_tugasKantor);
        if($cek_tugasKantor > 0){
          $update_status = mysqli_query($conn, "UPDATE absen_masuk_tmp SET jam = '-', status = 'Tugas Kantor', fingerprint = '-', keterangan = '$getTugasKantor[keterangan]' WHERE nik = '$get_karyawan[nik]'");
        }

        //Update from absensi
        $q_absensi = mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$get_karyawan[nik]' AND dari <= '$tgl' AND sampai >= '$tgl'");
        $cek_Absensi = mysqli_num_rows($q_absensi);
        $getAbsensi = mysqli_fetch_array($q_absensi);
        if($cek_Absensi > 0){
          $update_status = mysqli_query($conn, "UPDATE absen_masuk_tmp SET jam = '-', status = '$getAbsensi[status]', fingerprint = '-', keterangan = '$getAbsensi[keterangan]' WHERE id = '$get_karyawan[id]'");
        }
      }

      mysqli_query($conn, "TRUNCATE TABLE absen_masuk_tmp");

      if($_SESSION['tanggal_masuk_set'] && $_SESSION['jam_masuk_set']){
        $_SESSION['alert_success'] = "Berhasil! Tanggal dan Jam Absen berhasil diset";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tanggal dan Jam Absen gagal diset";
      }

    }
  }


  //Edit Absen Masuk
  if(isset($_POST['edit_absen_masuk'])){
    if($_POST['edit_absen_masuk'] == "Ubah"){
      if($_POST['jam_tiba'] == ""){ $_POST['jam_tiba'] = "-"; }

      $jam = 0;
      $menit = 0;
      $diff = 0;
      $jam_kantor = strtotime($_POST['tanggal_absen']." ".$_POST['jam_masuk']);
      $jam_karyawan = strtotime($_POST['tanggal_absen']." ".$_POST['jam_tiba']);
      $diff = $jam_karyawan - $jam_kantor;
      $jam   = floor($diff / (60 * 60));
      $menit = $diff - ( $jam * (60 * 60) );
      $terlambat = 0;
      $bulan_ini = date("m", strtotime($_POST['tanggal_absen']));
      if($jam_karyawan > $jam_kantor){
        $terlambat = ($jam*60)+floor( $menit / 60 );
      }

      $nik = $_POST['nik'];
      $tanggal = $_POST['tanggal_absen'];
      $jam_tiba = $_POST['jam_tiba'];
      $jam_masuk = $_POST['jam_masuk'];
      $status = $_POST['status'];
      $fingerprint = $_POST['fingerprint'];
      $keterangan = $_POST['keterangan'];
      $awal_bulan = date("Y", strtotime($tanggal))."-".date("m", strtotime($tanggal))."-01";

      //Sum total terlambat sebelum hari ini
      $getTerlambatBulanIni = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(terlambat) AS terlambat_bulanini FROM absen_masuk WHERE tanggal >= '$awal_bulan' AND tanggal <= '$tanggal' AND nik = '$nik'"));
      //Sum total cepat sebelum hari ini
      $getCepatBulanIni = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(cepat) AS cepat_bulanini FROM absen_pulang WHERE tanggal >= '$awal_bulan' AND tanggal <= '$tanggal' AND nik = '$nik'"));
      //total terlambat
      $TelatCepat = $getTerlambatBulanIni['terlambat_bulanini'] + $getCepatBulanIni['cepat_bulanini'];

      //Push Edit Absen Masuk
      $edit_absen_masuk = mysqli_query($conn, "UPDATE absen_masuk SET jam = '$jam_tiba', status = '$_POST[status]', fingerprint = '$_POST[fingerprint]', terlambat = '$terlambat', keterangan = '$_POST[keterangan]' WHERE nik = '$nik' AND tanggal = '$tanggal'");

      //Edit to TugasKantor & Daily Report
        //Delete existing tugas kantor & dailyreport
        mysqli_query($conn, "DELETE FROM tugas_kantor WHERE nik = '$nik' AND dari = '$tanggal' AND sampai = '$tanggal'");
        mysqli_query($conn, "DELETE FROM dailyreport WHERE nik = '$nik' AND tanggal = '$tanggal'");

      $cekTugaskantor = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tugas_kantor WHERE nik = '$nik' AND dari <= '$tanggal' AND sampai >= '$tanggal'"));
      if($cekTugaskantor < 1 AND $status == "Tugas Kantor"){
        $report = "<b>".$status." [".$keterangan."]</b>";
        mysqli_query($conn, "INSERT INTO tugas_kantor VALUES('','$nik','$tanggal','$tanggal','$report','$this_day')");
        mysqli_query($conn, "INSERT INTO dailyreport VALUES('','$nik','$tanggal','$report','$this_day')");
      }

      //Edit to Absensi & Dailyreport
        //Delete Absensi
        mysqli_query($conn, "DELETE FROM absensi WHERE nik = '$nik' AND dari = '$tanggal' AND sampai = '$tanggal'");

      $cekAbsensi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$getAbsenTmp[nik]' AND dari <= '$tanggal' AND sampai >= '$tanggal'"));
      if($cekAbsensi < 1){
        if($status == "Izin Tidak Masuk" OR $status == "Sakit - Dengan SKD" OR $status == "Sakit - Tanpa SKD" OR $status == "Cuti - Tahunan" OR $status == "Cuti - Menikah" OR $status == "Cuti - Melahirkan" OR $status == "Cuti - Ibadah" OR $status == "Tanpa Keterangan"){
          $report = "<b>".$status." [".$keterangan."]</b>";
          mysqli_query($conn, "INSERT INTO absensi VALUES('','$nik','$status','$tanggal','$tanggal','$report','$this_day')");
          mysqli_query($conn, "INSERT INTO dailyreport VALUES('','$nik','$tanggal','$report','$this_day')");
        }
      }

      //Edit Potongan Terlambat
        //Delete potongan existing
        mysqli_query($conn, "DELETE FROM potongan WHERE nik = '$nik' AND tanggal = '$tanggal'");

      $param = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM setting"));
      $totalTelatCepat = $TelatCepat + $terlambat;
      if($TelatCepat < $param['toleransi'] AND $totalTelatCepat > $param['toleransi']){
        $terlambat = $totalTelatCepat - $param['toleransi'];
      }

      $cekDataPotongan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM potongan WHERE nik = '$nik' AND tanggal = '$tanggal'"));
      if($totalTelatCepat > $param['toleransi'] AND  $terlambat > 0 AND $cekDataPotongan < 1){
        $dataKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$nik'"));
        $potongan_terlambat = $terlambat/60/8*($dataKaryawan['gaji']/20)*($param['potongan_terlambat']/100);
        $push_potongan = mysqli_query($conn, "INSERT INTO potongan VALUES ('','$nik','$tanggal','$terlambat','$potongan_terlambat','0','0','0','0')");
      }elseif($totalTelatCepat > $param['toleransi'] AND  $terlambat > 0 AND $cekDataPotongan > 0){
        $dataKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$nik'"));
        $potongan_terlambat = $terlambat/60/8*($dataKaryawan['gaji']/20)*($param['potongan_terlambat']/100);
        $edit_potongan = mysqli_query($conn, "UPDATE potongan SET toleransi_bulanini = '$terlambat', $potongan_terlambat = '$potongan_terlambat' WHERE $nik = '$nik' AND tanggal = '$tanggal'");
      }

      $sisa_cuti = 0;
      $thisYear = date("Y", strtotime($tanggal));
      $cuti_tahunan_terpakai = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM absen_masuk WHERE nik = '$nik' AND YEAR(tanggal)='$thisYear' AND status = 'Cuti - Tahunan'"));
      
      $total_izin = 0;
      $sum_izin = 0;
      $sum_izin = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM absen_masuk WHERE nik = '$nik' AND tanggal < '$tanggal' AND tanggal >= '$awal_bulan' AND (status = 'Izin Tidak Masuk' OR status = 'Sakit - Tanpa SKD' OR status = 'Tanpa Keterangan')"));
      $total_izin = $total_izin + $sum_izin;

      if($total_izin > 0 AND ($status == "Izin Tidak Masuk" OR $status == "Sakit - Tanpa SKD" OR $status == "Tanpa Keterangan")){
        $dataKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$nik'"));
        $potongan_terlambat = ($dataKaryawan['gaji']/20)*($param['potongan_terlambat']/100);
        $potongan_program = ($dataKaryawan['gaji']/20)*($param['potongan_program']/100);
        $potongan_grooming = ($dataKaryawan['gaji']/20)*($param['potongan_grooming']/100);
        $potongan_kehadiran = ($dataKaryawan['gaji']/20)*($param['potongan_kehadiran']/100);
        $potongan_output = ($dataKaryawan['gaji']/20)*($param['potongan_output']/100);
        mysqli_query($conn, "INSERT INTO potongan VALUES('','$nik','$tanggal','480','$potongan_terlambat','$potongan_kehadiran','$potongan_program','$potongan_grooming','$potongan_output')");
      }else{

      }

      if($edit_absen_masuk){
          $_SESSION['alert_success'] = "Berhasil! Absen berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Absen gagal diubah <br>".mysqli_error($conn);
      }

    }
  }

  //Edit Absen Pulang
  if(isset($_POST['edit_absen_pulang'])){
    if($_POST['edit_absen_pulang'] == "Ubah"){
      if($_POST['jam_keluar'] == ""){ $_POST['jam_keluar'] = "-";}
      //hitung cepat
        $jam_kantor = strtotime($_POST['tanggal_absen']." ".$_POST['jam_pulang']);
        $jam_karyawan = strtotime($_POST['tanggal_absen']." ".$_POST['jam_keluar']);
        $diff = $jam_kantor - $jam_karyawan;
        $jam   = floor($diff / (60 * 60));
        $menit = $diff - ( $jam * (60 * 60) );
        $cepat = 0;
        if($jam_karyawan < $jam_kantor AND $_POST['jam_keluar'] != "-"){
          $cepat = ($jam*60)+floor( $menit / 60 );
        }
      //------------------
      $edit_absen_pulang = mysqli_query($conn, "UPDATE absen_pulang SET jam='$_POST[jam_keluar]', status='$_POST[status]', fingerprint='$_POST[fingerprint]', cepat='$cepat', keterangan='$_POST[keterangan]' WHERE id='$_POST[id]'");

      if($edit_absen_pulang){
          $_SESSION['alert_success'] = "Berhasil! Absen berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Absen gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  //Upload file XLS Absen Masuk
  if ($_POST['upload'] == "Upload") {
      //clear table absen tmp
      mysqli_query($conn, "TRUNCATE TABLE absen_masuk_tmp;");      

      $type = explode(".",$_FILES['namafile']['name']);
      
      if (empty($_FILES['namafile']['name'])) {
          ?>
              <script language="JavaScript">
                  alert('Oops! Please fill all / select file ...');
                  document.location='./';
              </script>
          <?php
      }
      else if(strtolower(end($type)) !='xls'){
          ?>
              <script language="JavaScript">
                  alert('Oops! Please upload only Excel XLS file ...');
                  document.location='./';
              </script>
          <?php
      }
      
      else{
      $target = basename($_FILES['namafile']['name']) ;
      move_uploaded_file($_FILES['namafile']['tmp_name'], $target);
  
      $data    =new Spreadsheet_Excel_Reader($_FILES['namafile']['name'],false);
  
      $baris = $data->rowcount($sheet_index=0);
  
      for ($i=2; $i<=$baris; $i++){
          $nik        =$data->val($i, 1);
          $jam    =$data->val($i, 3);

          if($jam == ""){
              $jam = null;
          }
          
          $query = mysqli_query($conn, "INSERT INTO absen_masuk_tmp (nik, jam) VALUES ('$nik', '$jam')");        
      }
  
          if(!$query){
              ?>
                  <script language="JavaScript">
                      alert('<b>Oops!</b> 404 Error Server.');
                      document.location='./';
                  </script>
              <?php
          }
          else{
              ?>
                  <script language="JavaScript">
                      alert('Good! Import Excel XLS file success...');
                      document.location='./';
                  </script>
              <?php
          }
      unlink($_FILES['namafile']['name']);
      }
      
      $q_get_absen_tmp = mysqli_query($conn, "SELECT * FROM absen_masuk_tmp");
      while($data_absen_tmp = mysqli_fetch_array($q_get_absen_tmp)){
        $jam_kantor = strtotime($_SESSION['tanggal_masuk_set']." ".$_SESSION['jam_masuk_set']);
        $jam_karyawan = strtotime($_SESSION['tanggal_masuk_set']." ".$data_absen_tmp['jam']);
        $tgl = date("Y-m-d", strtotime($_SESSION['tanggal_masuk_set']));

        if($data_absen_tmp['jam'] == ''){
          $update_status = mysqli_query($conn, "UPDATE absen_masuk_tmp SET jam = '-', status = '-', fingerprint = '-', keterangan = '-' WHERE id = '$data_absen_tmp[id]'");
        }else{
          if($jam_karyawan <= $jam_kantor){
            $update_status = mysqli_query($conn, "UPDATE absen_masuk_tmp SET status = 'Masuk', fingerprint = 'Ya', keterangan = '-' WHERE id = '$data_absen_tmp[id]'");
          }else{
            $update_status = mysqli_query($conn, "UPDATE absen_masuk_tmp SET status = '-', fingerprint = 'Ya', keterangan = '-' WHERE id = '$data_absen_tmp[id]'");
          }
        }

        //Update from tugas_kantor
        $q_tugasKantor = mysqli_query($conn, "SELECT * FROM tugas_kantor WHERE nik = '$data_absen_tmp[nik]' AND dari <= '$tgl' AND sampai >= '$tgl'");
        $cek_tugasKantor = mysqli_num_rows($q_tugasKantor);
        $getTugasKantor = mysqli_fetch_array($q_tugasKantor);
        if($cek_tugasKantor > 0){
          $update_status = mysqli_query($conn, "UPDATE absen_masuk_tmp SET jam = '-', status = 'Tugas Kantor', fingerprint = '-', keterangan = '$getTugasKantor[keterangan]' WHERE id = '$data_absen_tmp[id]'");
        }

        //Update from absensi
        $q_absensi = mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$data_absen_tmp[nik]' AND dari <= '$tgl' AND sampai >= '$tgl'");
        $cek_Absensi = mysqli_num_rows($q_absensi);
        $getAbsensi = mysqli_fetch_array($q_absensi);
        if($cek_Absensi > 0){
          $update_status = mysqli_query($conn, "UPDATE absen_masuk_tmp SET jam = '-', status = '$getAbsensi[status]', fingerprint = '-', keterangan = '$getAbsensi[keterangan]' WHERE id = '$data_absen_tmp[id]'");
        }

      }

      header("location:?pages=form_absen_masuk&up_in=ok");
  }

  //Upload file XLS Absen Pulang
  if ($_POST['upload_pulang'] == "Upload") {
      //clear table absen tmp
      mysqli_query($conn, "TRUNCATE TABLE absen_pulang_tmp;");      

      $type = explode(".",$_FILES['namafile']['name']);
      
      if (empty($_FILES['namafile']['name'])) {
          ?>
              <script language="JavaScript">
                  alert('Oops! Please fill all / select file ...');
                  document.location='./';
              </script>
          <?php
      }
      else if(strtolower(end($type)) !='xls'){
          ?>
              <script language="JavaScript">
                  alert('Oops! Please upload only Excel XLS file ...');
                  document.location='./';
              </script>
          <?php
      }
      
      else{
      $target = basename($_FILES['namafile']['name']) ;
      move_uploaded_file($_FILES['namafile']['tmp_name'], $target);
  
      $data    =new Spreadsheet_Excel_Reader($_FILES['namafile']['name'],false);
  
      $baris = $data->rowcount($sheet_index=0);
  
      for ($i=2; $i<=$baris; $i++){
          $nik        =$data->val($i, 1);
          $jam    =$data->val($i, 3);

          if($jam == ""){
              $jam = null;
          }
          
          $query = mysqli_query($conn, "INSERT INTO absen_pulang_tmp (nik, jam) VALUES ('$nik', '$jam')");        
      }
  
          if(!$query){
              ?>
                  <script language="JavaScript">
                      alert('<b>Oops!</b> 404 Error Server.');
                      document.location='./';
                  </script>
              <?php
          }
          else{
              ?>
                  <script language="JavaScript">
                      alert('Good! Import Excel XLS file success...');
                      document.location='./';
                  </script>
              <?php
          }
      unlink($_FILES['namafile']['name']);
      }

      $q_absen_pulang = mysqli_query($conn, "SELECT * FROM absen_pulang_tmp");
      while($absenPulang_tmp = mysqli_fetch_array($q_absen_pulang)){
        $jam_kantor = strtotime($_SESSION['tanggal_pulang_set']." ".$_SESSION['jam_pulang_set']);
        $jam_karyawan = strtotime($_SESSION['tanggal_pulang_set']." ".$absenPulang_tmp['jam']);
        $tanggal_pulang = date("Y-m-d", strtotime($_SESSION['tanggal_pulang_set']));

        //sesuaikan data absen masuk  
        $get_absenMasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$absenPulang_tmp[nik]' AND tanggal = '$tanggal_pulang'"));
        //sesuaikan status pulang
        if($jam_karyawan >= $jam_kantor){
          mysqli_query($conn, "UPDATE absen_pulang_tmp SET status = 'Pulang', fingerprint = 'Ya', keterangan = '-' WHERE nik = '$absenPulang_tmp[nik]'");
        }else{
          mysqli_query($conn, "UPDATE absen_pulang_tmp SET status = '', fingerprint = '', keterangan = '-' WHERE nik = '$absenPulang_tmp[nik]'");
        }

        if($get_absenMasuk['jam'] == "-"){
          mysqli_query($conn, "UPDATE absen_pulang_tmp SET jam = '-', status = '-', fingerprint = '-', keterangan = '-' WHERE nik = '$absenPulang_tmp[nik]'");
        }

      }

      header("location:?pages=form_absen_pulang&up_out=ok");
  }

  //Alert Upload Absen Masuk
  if(isset($_GET['up_in'])){
    if($_GET['up_in'] == "ok"){
      $count_data_upload = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM absen_masuk_tmp WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159'"));
      $_SESSION['alert_success'] = "Berhasil! File XLS berhasil diupload. <br> Total ".$count_data_upload." Data berhasil diupload";
    }
  }

  //Alert Upload Absen Pulang
  if(isset($_GET['up_out'])){
    if($_GET['up_out'] == "ok"){
      $count_data_upload = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM absen_pulang_tmp WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159'"));
      $_SESSION['alert_success'] = "Berhasil! File XLS berhasil diupload. <br> Total ".$count_data_upload." Data berhasil diupload";
    }
  }

  //Edit Jam Absen Masuk
  if(isset($_POST['edit_jam_absen_masuk'])){
    if($_POST['edit_jam_absen_masuk'] == "Ubah"){

      $jam_kantor = strtotime($_SESSION['tanggal_masuk_set']." ".$_SESSION['jam_masuk_set']);
      $jam_karyawan = strtotime($_SESSION['tanggal_masuk_set']." ".$_POST['jam_masuk']);

      if($_POST['jam_masuk'] == ""){
        $edit_jam_absen_masuk = mysqli_query($conn, "UPDATE absen_masuk_tmp SET jam = '-', status = '-', fingerprint = '-' WHERE id = '$_POST[id]'");
      }elseif($jam_karyawan > $jam_kantor){
        $edit_jam_absen_masuk = mysqli_query($conn, "UPDATE absen_masuk_tmp SET jam = '$_POST[jam_masuk]', status = '-', fingerprint = '-' WHERE id = '$_POST[id]'");
      }else{
        $edit_jam_absen_masuk = mysqli_query($conn, "UPDATE absen_masuk_tmp SET jam = '$_POST[jam_masuk]', status = 'Masuk', fingerprint = '-' WHERE id = '$_POST[id]'");
      }

      if($edit_jam_absen_masuk){
          $_SESSION['alert_success'] = "Berhasil! Jam masuk berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Jam masuk gagal diubah";
      }
    }
  }

  //Edit Jam Absen Pulang
  if(isset($_POST['edit_jam_absen_pulang'])){
    if($_POST['edit_jam_absen_pulang'] == "Ubah"){

      $jam_kantor = strtotime($_SESSION['tanggal_pulang_set']." ".$_SESSION['jam_pulang_set']);
      $jam_karyawan = strtotime($_SESSION['tanggal_pulang_set']." ".$_POST['jam_pulang']);

      if($_POST['jam_pulang'] == ""){
        $edit_jam_absen_pulang = mysqli_query($conn, "UPDATE absen_pulang_tmp SET jam = '', status = '', fingerprint = '' WHERE id = '$_POST[id]'");
      }elseif($jam_karyawan < $jam_kantor){
        $edit_jam_absen_pulang = mysqli_query($conn, "UPDATE absen_pulang_tmp SET jam = '$_POST[jam_pulang]', status = '', fingerprint = '' WHERE id = '$_POST[id]'");
      }else{
        $edit_jam_absen_pulang = mysqli_query($conn, "UPDATE absen_pulang_tmp SET jam = '$_POST[jam_pulang]', status = 'Pulang', fingerprint = '' WHERE id = '$_POST[id]'");
      }

      if($edit_jam_absen_pulang){
          $_SESSION['alert_success'] = "Berhasil! Jam pulang berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Jam pulang gagal diubah";
      }
    }
  }

  //Edit Status Masuk
  if(isset($_POST['edit_status_masuk'])){
    if($_POST['edit_status_masuk'] == "Ubah"){
      $edit_status_masuk = mysqli_query($conn, "UPDATE absen_masuk_tmp SET status = '$_POST[status]', keterangan = '$_POST[keterangan]', fingerprint = '$_POST[fingerprint]' WHERE id = '$_POST[id]'");

      if($edit_status_masuk){
          $_SESSION['alert_success'] = "Berhasil! Status absen berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Status Absen gagal diubah";
      }
    }
  }

  //Edit Status Pulang
  if(isset($_POST['edit_status_pulang'])){
    if($_POST['edit_status_pulang'] == "Ubah"){
      $edit_status_pulang = mysqli_query($conn, "UPDATE absen_pulang_tmp SET status = '$_POST[status]' WHERE id = '$_POST[id]'");

      if($edit_status_pulang){
          $_SESSION['alert_success'] = "Berhasil! Status absen berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Status Absen gagal diubah";
      }
    }
  }

  //Edit Fingerprint masuk
  if(isset($_POST['edit_fingerprint'])){
    if($_POST['edit_fingerprint'] == "Ubah"){
      $edit_fingerprint = mysqli_query($conn, "UPDATE absen_masuk_tmp SET fingerprint = '$_POST[fingerprint]' WHERE id = '$_POST[id]'");

      if($edit_fingerprint){
          $_SESSION['alert_success'] = "Berhasil! Fingerprint berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Fingerprint gagal diubah";
      }
    }
  }

  //Edit Fingerprint pulang
  if(isset($_POST['edit_fingerprint_pulang'])){
    if($_POST['edit_fingerprint_pulang'] == "Ubah"){
      $edit_fingerprint_pulang = mysqli_query($conn, "UPDATE absen_pulang_tmp SET fingerprint = '$_POST[fingerprint]' WHERE id = '$_POST[id]'");

      if($edit_fingerprint_pulang){
          $_SESSION['alert_success'] = "Berhasil! Fingerprint berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Fingerprint gagal diubah";
      }
    }
  }

  //Edit Keterangan Absen masuk
  if(isset($_POST['edit_keterangan_absen'])){
    if($_POST['edit_keterangan_absen'] == "Ubah"){
      $edit_keterangan_absen = mysqli_query($conn, "UPDATE absen_masuk_tmp SET keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'");

      if($edit_keterangan_absen){
          $_SESSION['alert_success'] = "Berhasil! Keterangan berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Keterangan gagal diubah";
      }
    }
  }

  //Submit Absen Masuk
  if(isset($_POST['submit_absen_masuk'])){
    if($_POST['submit_absen_masuk'] == "Submit"){
      if($_POST['data_absen'] == "lengkap"){
        if($_POST['cek_tanggal'] == "belum ada"){
          if($_POST['hari_libur'] == "tidak"){
            $q_getAbsenTmp = mysqli_query($conn, "SELECT * FROM absen_masuk_tmp");
            $jml_data_push = 0;
            $data_absen = $_POST['data_absen'];
            while($getAbsenTmp = mysqli_fetch_array($q_getAbsenTmp)){
              //hitung terlambat
              $jam_kantor = strtotime($_SESSION['tanggal_masuk_set']." ".$_SESSION['jam_masuk_set']);
              $jam_karyawan = strtotime($_SESSION['tanggal_masuk_set']." ".$getAbsenTmp['jam']);
              $diff = $jam_karyawan - $jam_kantor;
              $jam   = floor($diff / (60 * 60));
              $menit = $diff - ( $jam * (60 * 60) );
              $terlambat = 0;
              $bulan_ini = date("m", strtotime($_SESSION['tanggal_masuk_set']));
              if($jam_karyawan > $jam_kantor){
                $terlambat = ($jam*60)+floor( $menit / 60 );
              }
              //------------------

              $nik = $getAbsenTmp['nik'];
              $tanggal = $_POST['tgl_absen'];
              $jam_tiba = $getAbsenTmp['jam'];
              $jam_masuk = $_POST['jam_absen'];
              $status = $getAbsenTmp['status'];
              $fingerprint = $getAbsenTmp['fingerprint'];
              $keterangan = $getAbsenTmp['keterangan'];
              $awal_bulan = date("Y", strtotime($tanggal))."-".date("m", strtotime($tanggal))."-01";

              //Sum total terlambat sebelum hari ini
              $getTerlambatBulanIni = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(terlambat) AS terlambat_bulanini FROM absen_masuk WHERE month(tanggal) = '$bulan_ini' AND nik = '$nik'"));
              //Sum total cepat sebelum hari ini
              $getCepatBulanIni = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(cepat) AS cepat_bulanini FROM absen_pulang WHERE month(tanggal) = '$bulan_ini' AND nik = '$nik'"));
              //total terlambat
              $TelatCepat = $getTerlambatBulanIni['terlambat_bulanini'] + $getCepatBulanIni['cepat_bulanini'];

              //Push from absen_masuk_temp to absen_masuk
              $push_absenMasuk = mysqli_query($conn, "INSERT INTO absen_masuk VALUES('','$nik','$tanggal','$jam_tiba','$jam_masuk','$status','$fingerprint','$terlambat','$keterangan')");
              if($push_absenMasuk){
                $jml_data_push = $jml_data_push + 1;
              }

              //Push to TugasKantor & Daily Report
              $cekTugaskantor = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tugas_kantor WHERE nik = '$getAbsenTmp[nik]' AND dari <= '$tanggal' AND sampai >= '$tanggal'"));
              if($cekTugaskantor < 1 AND $status == "Tugas Kantor"){
                $report = "<b>".$status." [".$keterangan."]</b>";
                mysqli_query($conn, "INSERT INTO tugas_kantor VALUES('','$nik','$tanggal','$tanggal','$report','$this_day')");
                mysqli_query($conn, "INSERT INTO dailyreport VALUES('','$nik','$tanggal','$report','$this_day')");
              }

              //Push to Absensi & Dailyreport
              $cekAbsensi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absensi WHERE nik = '$getAbsenTmp[nik]' AND dari <= '$tanggal' AND sampai >= '$tanggal'"));
              if($cekAbsensi < 1){
                if($status == "Izin Tidak Masuk" OR $status == "Sakit - Dengan SKD" OR $status == "Sakit - Tanpa SKD" OR $status == "Cuti - Tahunan" OR $status == "Cuti - Menikah" OR $status == "Cuti - Melahirkan" OR $status == "Cuti - Ibadah" OR $status == "Tanpa Keterangan"){
                  $report = "<b>".$status." [".$keterangan."]</b>";
                  mysqli_query($conn, "INSERT INTO absensi VALUES('','$nik','$status','$tanggal','$tanggal','$report','$this_day')");
                  mysqli_query($conn, "INSERT INTO dailyreport VALUES('','$nik','$tanggal','$report','$this_day')");
                }
              }

              //Push Potongan Terlambat
              $param = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM setting"));
              $totalTelatCepat = $TelatCepat + $terlambat;
              if($TelatCepat < $param['toleransi'] AND $totalTelatCepat > $param['toleransi']){
                $terlambat = $totalTelatCepat - $param['toleransi'];
              }

              $cekDataPotongan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM potongan WHERE nik = '$nik' AND tanggal = '$tanggal'"));
                if($totalTelatCepat > $param['toleransi'] AND  $terlambat > 0 AND $cekDataPotongan < 1){
                  $dataKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$nik'"));
                  $potongan_terlambat = $terlambat/60/8*($dataKaryawan['gaji']/20)*($param['potongan_terlambat']/100);
                  $push_potongan = mysqli_query($conn, "INSERT INTO potongan VALUES ('','$nik','$tanggal','$terlambat','$potongan_terlambat','0','0','0','0')");
                }elseif($totalTelatCepat > $param['toleransi'] AND  $terlambat > 0 AND $cekDataPotongan > 0){
                  $dataKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$nik'"));
                  $potongan_terlambat = $terlambat/60/8*($dataKaryawan['gaji']/20)*($param['potongan_terlambat']/100);
                  $edit_potongan = mysqli_query($conn, "UPDATE potongan SET toleransi_bulanini = '$terlambat', $potongan_terlambat = '$potongan_terlambat' WHERE $nik = '$nik' AND tanggal = '$tanggal'");
                }

              //Potongan Jika Cuti Sudah Habis
              $sisa_cuti = 0;
              $thisYear = date("Y", strtotime($tanggal));
              $cuti_tahunan_terpakai = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM absen_masuk WHERE nik = '$nik' AND YEAR(tanggal)='$thisYear' AND status = 'Cuti - Tahunan'"));
              
              $total_izin = 0;
              $sum_izin = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM absen_masuk WHERE nik = '$nik' AND tanggal < '$tanggal' AND tanggal >= '$awal_bulan' AND (status = 'Izin Tidak Masuk' OR status = 'Sakit - Tanpa SKD' OR status = 'Tanpa Keterangan')"));
              $total_izin = $total_izin + $sum_izin;

              if($total_izin > 0 AND ($status = 'Izin Tidak Masuk' OR $status = 'Sakit - Tanpa SKD' OR $status = 'Tanpa Keterangan')){
                $dataKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$nik'"));
                $potongan_terlambat = ($dataKaryawan['gaji']/20)*($param['potongan_terlambat']/100);
                $potongan_program = ($dataKaryawan['gaji']/20)*($param['potongan_program']/100);
                $potongan_grooming = ($dataKaryawan['gaji']/20)*($param['potongan_grooming']/100);
                $potongan_kehadiran = ($dataKaryawan['gaji']/20)*($param['potongan_kehadiran']/100);
                $potongan_output = ($dataKaryawan['gaji']/20)*($param['potongan_output']/100);
                mysqli_query($conn, "INSERT INTO potongan VALUES('','$nik','$tanggal','480','$potongan_terlambat','$potongan_kehadiran','$potongan_program','$potongan_grooming','$potongan_output')");
              }else{

              }

            }

            $_SESSION['alert_success'] = "Berhasil! Submit data absen masuk berhasil <br> Total ".$jml_data_push." data berhasil disubmit";
            mysqli_query($conn, "TRUNCATE TABLE absen_masuk_tmp");
          }else{
            $_SESSION['alert_error'] = "Tanggal yang anda masukan adalah hari libur!";
          }
        }else{
          $_SESSION['alert_error'] = "Data Absen di tanggal ini sudah ada!";
        }
      }else{
        $_SESSION['alert_error'] = "Data Absen belum lengkap, lengkapi dulu!";
      }
    }
  }

  //Submit Absen Pulang
  if(isset($_POST['submit_absen_pulang'])){
    if($_POST['submit_absen_pulang'] == "Submit"){
      if($_POST['data_absen_pulang'] == "lengkap"){
        if($_POST['cek_AbsenPulang'] < 1){
          if($_POST['cek_tanggal'] == "sudah ada"){
            $q_getAbsenPulangTmp = mysqli_query($conn, "SELECT * FROM absen_pulang_tmp");
            $jml_data_push = 0;
            $data_absen_pulang = $_POST['data_absen_pulang'];
            while($getAbsenPulangTmp = mysqli_fetch_array($q_getAbsenPulangTmp)){
              //hitung cepat
              $jam_kantor = strtotime($_SESSION['tanggal_pulang_set']." ".$_SESSION['jam_pulang_set']);
              $jam_karyawan = strtotime($_SESSION['tanggal_pulang_set']." ".$getAbsenPulangTmp['jam']);
              $diff = $jam_kantor - $jam_karyawan;
              $jam   = floor($diff / (60 * 60));
              $menit = $diff - ( $jam * (60 * 60) );
              $cepat = 0;
              $bulan_ini = date("m", strtotime($_SESSION['tanggal_pulang_set']));
              if($jam_karyawan < $jam_kantor AND $getAbsenPulangTmp['jam'] != "-"){
                $cepat = ($jam*60)+floor( $menit / 60 );
              }
              //------------------

              $nik = $getAbsenPulangTmp['nik'];
              $tanggal = $_POST['tgl_absen'];
              $jam_tiba = $getAbsenPulangTmp['jam'];
              $jam_masuk = $_POST['jam_absen'];
              $status = $getAbsenPulangTmp['status'];
              $fingerprint = $getAbsenPulangTmp['fingerprint'];
              $keterangan = $getAbsenPulangTmp['keterangan'];

              //Sum total cepat sebelum hari ini
              $getCepatBulanIni = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(cepat) AS cepat_bulanini FROM absen_pulang WHERE month(tanggal) = '$bulan_ini' AND nik = '$nik'"));

              //Push from absen_pulang_temp to absen_pulang
              $push_absenMasuk = mysqli_query($conn, "INSERT INTO absen_pulang VALUES('','$nik','$tanggal','$jam_tiba','$jam_masuk','$status','$fingerprint','$cepat','$keterangan')");
              if($push_absenMasuk){
                $jml_data_push = $jml_data_push + 1;
              }

            }

            $_SESSION['alert_success'] = "Berhasil! Submit data absen masuk berhasil <br> Total ".$jml_data_push." data berhasil disubmit";
          }else{
            $_SESSION['alert_error'] = "Data Absen masuk di tanggal ini delum ada<br>Input data absen masuk terlebih dahulu!";
          }
        }else{
          $_SESSION['alert_error'] = "Data Absen pulang di tanggal ini sudah ada!";
        }
      }else{
        $_SESSION['alert_error'] = "Data Absen belum lengkap, lengkapi dulu!";
      }
    }
  }

  //Edit Program
  if(isset($_POST['edit_program'])){
    if($_POST['edit_program'] == "Ubah"){
      $edit_program = mysqli_query($conn, "UPDATE penilaian_harian_tmp SET program = '$_POST[program]' WHERE id = '$_POST[id]'");

      if($edit_program){
          $_SESSION['alert_success'] = "Berhasil! Program berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Program gagal diubah";
      }
    }
  }

  //Edit Seragam
  if(isset($_POST['edit_seragam'])){
    if($_POST['edit_seragam'] == "Ubah"){
      $edit_seragam = mysqli_query($conn, "UPDATE penilaian_harian_tmp SET seragam = '$_POST[seragam]' WHERE id = '$_POST[id]'");
    
      if($edit_seragam){
          $_SESSION['alert_success'] = "Berhasil! Seragam berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Seragam gagal diubah";
      }
    }
  }

  //Edit Nametag
  if(isset($_POST['edit_nametag'])){
    if($_POST['edit_nametag'] == "Ubah"){
      $edit_nametag = mysqli_query($conn, "UPDATE penilaian_harian_tmp SET nametag = '$_POST[nametag]' WHERE id = '$_POST[id]'");
    
      if($edit_nametag){
          $_SESSION['alert_success'] = "Berhasil! Nametag berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Nametag gagal diubah";
      }
    }
  }

  //Submit Penilaian
  if(isset($_POST['submit_penilaian'])){
    if($_POST['submit_penilaian'] == "Submit"){
      if($_POST['data_penilaian'] == "lengkap"){
        if($_POST['cek_absen_masuk'] == "sudah ada"){
          if($_POST['cek_tgl_penilaian'] < 1){
            $count = 0;
            //push from penilaian_harian_tmp to penilaian_harian
            $q_GetPenilaianTmp = mysqli_query($conn, "SELECT * FROM penilaian_harian_tmp");
            while($get_penilaianTmp = mysqli_fetch_array($q_GetPenilaianTmp)){
              $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_penilaianTmp[nik]'"));
              $getSetting = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM setting"));

              $potongan_program = 0;
              $potongan_seragam = 0;
              $potongan_nametag = 0;
              $potongan_grooming = 0;

              //Push from penilaian_harian_tmp to penilaian_harian
              $push = mysqli_query($conn, "INSERT INTO penilaian_harian VALUES ('','$get_penilaianTmp[nik]','$_POST[tgl_penilaian]','$get_penilaianTmp[program]','$get_penilaianTmp[seragam]','$get_penilaianTmp[nametag]')");
              
              if($push){
                $count = $count + 1;
              }

              //hitung potongan
              if($get_penilaianTmp['program'] == "Tidak"){
                $potongan_program = $getKaryawan['gaji']/20*$getSetting['potongan_program']/100;
              }

              if($get_penilaianTmp['seragam'] == "Lupa/Tidak"){
                $potongan_seragam = $getKaryawan['gaji']/20*$getSetting['potongan_grooming']/100/2;
              }
 
              if($get_penilaianTmp['nametag'] == "Lupa/Tidak"){
                $potongan_nametag = $getKaryawan['gaji']/20*$getSetting['potongan_grooming']/100/2;
              }

              $potongan_grooming = $potongan_seragam + $potongan_nametag;

              //cek data potongan
              $cekDataPotongan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM potongan WHERE nik = '$get_penilaianTmp[nik]' AND tanggal = '$_POST[tgl_penilaian]'"));
              if($cekDataPotongan < 1 AND ($get_penilaianTmp['program'] == "Tidak" OR $get_penilaianTmp['seragam'] == "Lupa/Tidak" OR $get_penilaianTmp['nametag'] == "Lupa/Tidak")){
                //push potongan
                $push_potongan = mysqli_query($conn, "INSERT INTO potongan VALUES ('','$get_penilaianTmp[nik]','$_POST[tgl_penilaian]','0','0','0','$potongan_program','$potongan_grooming','0')");

              }elseif($cekDataPotongan > 0 AND ($get_penilaianTmp['program'] == "Tidak" OR $get_penilaianTmp['seragam'] == "Lupa/Tidak" OR $get_penilaianTmp['nametag'] == "Lupa/Tidak")){
                //edit potongan
                if($get_penilaianTmp['program'] == "Tidak"){
                  $edit_potongan = mysqli_query($conn, "UPDATE potongan SET potongan_program = '$potongan_program' WHERE nik = '$get_penilaianTmp[nik]' AND tanggal = '$_POST[tgl_penilaian]'");
                }

                if($get_penilaianTmp['seragam'] == "Lupa/Tidak"){
                  $edit_potongan = mysqli_query($conn, "UPDATE potongan SET potongan_seragam = '$potongan_seragam' WHERE nik = '$get_penilaianTmp[nik]' AND tanggal = '$_POST[tgl_penilaian]'");
                }
   
                if($get_penilaianTmp['nametag'] == "Lupa/Tidak"){
                  $edit_potongan = mysqli_query($conn, "UPDATE potongan SET potongan_nametag = '$potongan_nametag' WHERE nik = '$get_penilaianTmp[nik]' AND tanggal = '$_POST[tgl_penilaian]'");
                }
                
              }

              
            }
            $_SESSION['alert_success'] = "Berhasil! Submit data penilaian berhasil <br> Total ".$count." data berhasil disubmit";

          }else{
            $_SESSION['alert_error'] = "Data penilaian di tanggal ini sudah ada! <br> silahkan ubah tanggal penilaian!";
          }
        }else{
          $_SESSION['alert_error'] = "Data absen masuk ditanggal ini tidak ditemukan! masukan dulu data absen masuk!";
        }
      }else{
        $_SESSION['alert_error'] = "Data penilaian belum lengkap! lengkapi dulu!";
      }
    }
  }

  //Edit Penilaian harian
  if(isset($_POST['edit_penilaian_harian'])){
    if($_POST['edit_penilaian_harian'] == "Ubah"){
      $edit_penilaian_harian = mysqli_query($conn, "UPDATE penilaian_harian SET program = '$_POST[program]', seragam = '$_POST[seragam]', nametag = '$_POST[nametag]' WHERE id = '$_POST[id]'");
      $dataKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$_POST[nik_karyawan]'"));
      $param = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM setting"));

      //Cek Data Potongan
      $cek_potongan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM potongan WHERE nik = '$_POST[nik_karyawan]' AND tanggal = '$_POST[tgl_penilaian]'"));

      //Edit Potongan Program
        if($_POST['program'] == 'Tidak'){
          $potongan_program = ($dataKaryawan['gaji']/20)*($param['potongan_program']/100);
          if($cek_potongan > 0){
            mysqli_query($conn, "UPDATE potongan SET potongan_program = '$potongan_program' WHERE nik = '$_POST[nik_karyawan]' AND tanggal = '$_POST[tgl_penilaian]'");
          }else{
            mysqli_query($conn, "INSERT INTO potongan VALUES('','$_POST[nik_karyawan]','$_POST[tgl_penilaian]','0','0','0','$potongan_program','0','0')");
          }
        }elseif($_POST['program'] == 'Ya'){
          mysqli_query($conn, "UPDATE potongan SET potongan_program = '0' WHERE nik = '$_POST[nik_karyawan]' AND tanggal = '$_POST[tgl_penilaian]'");
        }

      //Edit Potongan Grooming
        if($_POST['seragam'] == 'Lupa/Tidak'){
          $potongan_seragam = ($dataKaryawan['gaji']/20)*($param['potongan_grooming']/100)/2;
        }elseif($_POST['seragam'] == 'Ya'){
          $potongan_seragam = 0;
        }

        if($_POST['nametag'] == 'Lupa/Tidak'){
          $potongan_nametag = ($dataKaryawan['gaji']/20)*($param['potongan_grooming']/100)/2;
        }elseif($_POST['nametag'] == 'Ya'){
          $potongan_nametag = 0;
        }

        $potongan_grooming = $potongan_seragam + $potongan_nametag;

        if($cek_potongan > 0){
          mysqli_query($conn, "UPDATE potongan SET potongan_grooming = '$potongan_grooming' WHERE nik = '$_POST[nik_karyawan]' AND tanggal = '$_POST[tgl_penilaian]'");
        }else{
          mysqli_query($conn, "INSERT INTO potongan VALUES('','$_POST[nik_karyawan]','$_POST[tgl_penilaian]','0','0','0','0','$potongan_grooming','0')");
        }
        
        

      if($edit_penilaian_harian){
          $_SESSION['alert_success'] = "Berhasil! Penilaian Harian berhasil diubah : ".$potongan_grooming;
      }else{
          $_SESSION['alert_error'] = "Gagal! Penilaian Harian gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  //Input Pelanggaran
  if(isset($_POST['submit_pelanggaran'])){
    if($_POST['submit_pelanggaran'] == "Submit"){
      $edit_seragam = mysqli_query($conn, "INSERT INTO pelanggaran VALUES('','$_POST[nik_karyawan]','$_POST[tanggal_pelanggaran]','$_POST[pelanggaran_id]','$_POST[keterangan]','$this_day')");
    
      if($edit_seragam){
          $_SESSION['alert_success'] = "Berhasil! Pelanggaran berhasil disimpan";
      }else{
          $_SESSION['alert_error'] = "Gagal! Pelanggaran gagal disimpan";
      }
    }
  }

  //Edit Pelanggaran
  if(isset($_POST['edit_pelanggaran'])){
    if($_POST['edit_pelanggaran'] == 'Ubah'){
      $edit_pelanggaran = mysqli_query($conn, "UPDATE pelanggaran SET tanggal = '$_POST[tgl_pelanggaran]', nik = '$_POST[nik_karyawan]', pelanggaran_id = '$_POST[pelanggaran_id]', keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'");

      if($edit_pelanggaran){
          $_SESSION['alert_success'] = "Berhasil! Pelanggaran berhasil diubah";
      }else{
          $_SESSION['alert_error'] = "Gagal! Pelanggaran gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  //Delete Pelanggaran
  if(isset($_POST['delete_pelanggaran'])){
    if($_POST['delete_pelanggaran'] == "Delete"){
      $delete_pelanggaran = mysqli_query($conn, "DELETE FROM pelanggaran WHERE id = '$_POST[id]'");

      if($delete_pelanggaran){
          $_SESSION['alert_success'] = "Berhasil! Pelanggaran berhasil dihapus";
      }else{
          $_SESSION['alert_error'] = "Gagal! Pelanggaran gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  //Submit Evaluasi
  if(isset($_POST['submit_evaluasi']) AND $_POST['submit_evaluasi'] == "Submit"){
    mysqli_query($conn, "ALTER TABLE evaluasi AUTO_INCREMENT = 1;");
    //--------------------------- MANAGER -------------------------------
    if($_POST['jabatan'] == "Manager"){
      $push_evaluasi = mysqli_query($conn, "INSERT INTO evaluasi VALUES('','$_POST[nomor_fppk]','$_POST[nik_karyawan]','$_POST[jabatan]','$_POST[tgl_evaluasi]','$_POST[divisi]','$_POST[masa_kerja]','$_POST[semester]','$_POST[penilaian_dari]','$_POST[penilaian_sampai]','$_POST[point1_dirut]','$_POST[point1_dirop]','$_POST[point1_leader]','$_POST[point2_dirut]','$_POST[point2_dirop]','$_POST[point2_leader]','$_POST[point3_dirut]','$_POST[point3_dirop]','$_POST[point3_leader]','$_POST[point4_dirut]','$_POST[point4_dirop]','$_POST[point4_leader]','$_POST[point5_dirut]','$_POST[point5_dirop]','$_POST[point5_leader]','$_POST[point6_dirut]','$_POST[point6_dirop]','$_POST[point6_leader]','$_POST[point7_dirut]','$_POST[point7_dirop]','$_POST[point7_leader]','$_POST[point8_dirut]','$_POST[point8_dirop]','$_POST[point8_leader]','$_POST[point9_dirut]','$_POST[point9_dirop]','$_POST[point9_leader]','$_POST[point10_dirut]','$_POST[point10_dirop]','$_POST[point10_leader]','$_POST[point11_dirut]','$_POST[point11_dirop]','$_POST[point11_leader]','$_POST[point12_dirut]','$_POST[point12_dirop]','$_POST[point12_leader]','$_POST[point13_dirut]','$_POST[point13_dirop]','$_POST[point13_leader]','$_POST[point14_dirut]','$_POST[point14_dirop]','$_POST[point14_leader]','$_POST[point15_dirut]','$_POST[point15_dirop]','$_POST[point15_leader]','$_POST[point16_dirut]','$_POST[point16_dirop]','$_POST[point16_leader]','$_POST[point_grooming]','$_POST[point_kedisiplinan]','$_POST[point_kehadiran]','$_POST[point_owoj]','$_POST[saran_perbaikan]','$_POST[komitmen_perbaikan]')");
    
    }elseif($_POST['jabatan'] == "Fungsional"){
      $push_evaluasi = mysqli_query($conn, "INSERT INTO evaluasi VALUES('','$_POST[nomor_fppk]','$_POST[nik_karyawan]','$_POST[jabatan]','$_POST[tgl_evaluasi]','$_POST[divisi]','$_POST[masa_kerja]','$_POST[semester]','$_POST[penilaian_dari]','$_POST[penilaian_sampai]','$_POST[point1_dirut]','$_POST[point1_dirop]','$_POST[point1_leader]','$_POST[point2_dirut]','$_POST[point2_dirop]','$_POST[point2_leader]','$_POST[point3_dirut]','$_POST[point3_dirop]','$_POST[point3_leader]','$_POST[point4_dirut]','$_POST[point4_dirop]','$_POST[point4_leader]','$_POST[point5_dirut]','$_POST[point5_dirop]','$_POST[point5_leader]','$_POST[point6_dirut]','$_POST[point6_dirop]','$_POST[point6_leader]','$_POST[point7_dirut]','$_POST[point7_dirop]','$_POST[point7_leader]','$_POST[point8_dirut]','$_POST[point8_dirop]','$_POST[point8_leader]','-','-','-','-','-','-','-','-','-','-','-','-','$_POST[point13_dirut]','$_POST[point13_dirop]','$_POST[point13_leader]','$_POST[point14_dirut]','$_POST[point14_dirop]','$_POST[point14_leader]','$_POST[point15_dirut]','$_POST[point15_dirop]','$_POST[point15_leader]','$_POST[point16_dirut]','$_POST[point16_dirop]','$_POST[point16_leader]','$_POST[point_grooming]','$_POST[point_kedisiplinan]','$_POST[point_kehadiran]','$_POST[point_owoj]','$_POST[saran_perbaikan]','$_POST[komitmen_perbaikan]')");
    
    }elseif($_POST['jabatan'] == "Staff"){
      $push_evaluasi = mysqli_query($conn, "INSERT INTO evaluasi VALUES('','$_POST[nomor_fppk]','$_POST[nik_karyawan]','$_POST[jabatan]','$_POST[tgl_evaluasi]','$_POST[divisi]','$_POST[masa_kerja]','$_POST[semester]','$_POST[penilaian_dari]','$_POST[penilaian_sampai]','$_POST[point1_dirut]','$_POST[point1_dirop]','$_POST[point1_leader]','$_POST[point2_dirut]','$_POST[point2_dirop]','$_POST[point2_leader]','$_POST[point3_dirut]','$_POST[point3_dirop]','$_POST[point3_leader]','$_POST[point4_dirut]','$_POST[point4_dirop]','$_POST[point4_leader]','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','$_POST[point13_dirut]','$_POST[point13_dirop]','$_POST[point13_leader]','$_POST[point14_dirut]','$_POST[point14_dirop]','$_POST[point14_leader]','$_POST[point15_dirut]','$_POST[point15_dirop]','$_POST[point15_leader]','$_POST[point16_dirut]','$_POST[point16_dirop]','$_POST[point16_leader]','$_POST[point_grooming]','$_POST[point_kedisiplinan]','$_POST[point_kehadiran]','$_POST[point_owoj]','$_POST[saran_perbaikan]','$_POST[komitmen_perbaikan]')");
    
    }elseif($_POST['jabatan'] == "Magang" OR $_POST['jabatan'] == "Kontrak"){
      $push_evaluasi = mysqli_query($conn, "INSERT INTO evaluasi VALUES('','$_POST[nomor_fppk]','$_POST[nik_karyawan]','$_POST[jabatan]','$_POST[tgl_evaluasi]','$_POST[divisi]','$_POST[masa_kerja]','$_POST[semester]','$_POST[penilaian_dari]','$_POST[penilaian_sampai]','$_POST[point1_dirut]','$_POST[point1_dirop]','$_POST[point1_leader]','$_POST[point2_dirut]','$_POST[point2_dirop]','$_POST[point2_leader]','$_POST[point3_dirut]','$_POST[point3_dirop]','$_POST[point3_leader]','$_POST[point4_dirut]','$_POST[point4_dirop]','$_POST[point4_leader]','$_POST[point5_dirut]','$_POST[point5_dirop]','$_POST[point5_leader]','$_POST[point6_dirut]','$_POST[point6_dirop]','$_POST[point6_leader]','$_POST[point7_dirut]','$_POST[point7_dirop]','$_POST[point7_leader]','$_POST[point8_dirut]','$_POST[point8_dirop]','$_POST[point8_leader]','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','$_POST[point_grooming]','$_POST[point_kedisiplinan]','$_POST[point_kehadiran]','$_POST[point_owoj]','$_POST[saran_perbaikan]','$_POST[komitmen_perbaikan]')");
    }


    if($push_evaluasi){
        $_SESSION['alert_success'] = "Berhasil! Penilaian Prestasi Kerja Berhasil disimpan ";
    }else{
        $_SESSION['alert_error'] = "Gagal! Penilaian Prestasi Kerja Gagal disimpan";
    }
  }

  //Edit Nilai Evaluasi Manager
  if(isset($_POST['edit_evaluasi_manager'])){
    if($_POST['edit_evaluasi_manager'] == "Simpan"){
      $edit_nilaiEvaluasi_manager = mysqli_query($conn, "UPDATE evaluasi SET tanggal_evaluasi = '$_POST[tanggal_evaluasi]', point1_dirut = '$_POST[point1_dirut]', point1_dirop = '$_POST[point1_dirop]', point2_dirut = '$_POST[point2_dirut]', point2_dirop = '$_POST[point2_dirop]', point3_dirut = '$_POST[point3_dirut]', point3_dirop = '$_POST[point3_dirop]', point4_dirut = '$_POST[point4_dirut]', point4_dirop = '$_POST[point4_dirop]', point5_dirut = '$_POST[point5_dirut]', point5_dirop = '$_POST[point5_dirop]', point6_dirut = '$_POST[point6_dirut]', point6_dirop = '$_POST[point6_dirop]', point7_dirut = '$_POST[point7_dirut]', point7_dirop = '$_POST[point7_dirop]', point8_dirut = '$_POST[point8_dirut]', point8_dirop = '$_POST[point8_dirop]', point9_dirut = '$_POST[point9_dirut]', point9_dirop = '$_POST[point9_dirop]', point10_dirut = '$_POST[point10_dirut]', point10_dirop = '$_POST[point10_dirop]', point11_dirut = '$_POST[point11_dirut]', point11_dirop = '$_POST[point11_dirop]', point12_dirut = '$_POST[point12_dirut]', point12_dirop = '$_POST[point12_dirop]', point13_dirut = '$_POST[point13_dirut]', point13_dirop = '$_POST[point13_dirop]', point14_dirut = '$_POST[point14_dirut]', point14_dirop = '$_POST[point14_dirop]', point15_dirut = '$_POST[point15_dirut]', point15_dirop = '$_POST[point15_dirop]', point16_dirut = '$_POST[point16_dirut]', point16_dirop = '$_POST[point16_dirop]', point_grooming = '$_POST[point_grooming]', point_kedisiplinan = '$_POST[point_kedisiplinan]', point_kehadiran = '$_POST[point_kehadiran]', point_owoj = '$_POST[point_owoj]' WHERE nomor = '$_POST[no_fppk]'");

      if($edit_nilaiEvaluasi_manager){
        $_SESSION['alert_success'] = "Berhasil! Penilaian Prestasi Kerja Berhasil diubah ";
      }else{
        $_SESSION['alert_error'] = "Gagal! Penilaian Prestasi Kerja Gagal diubah";
      }
    }
  }

  //Edit Nilai Evaluasi Fungsional
  if(isset($_POST['edit_evaluasi_fungsional'])){
    if($_POST['edit_evaluasi_fungsional'] == "Simpan"){
      $edit_nilaiEvaluasi_fungsional = mysqli_query($conn, "UPDATE evaluasi SET point1_dirut = '$_POST[point1_dirut]', point1_dirop = '$_POST[point1_dirop]', point1_leader = '$_POST[point1_leader]', point2_dirut = '$_POST[point2_dirut]', point2_dirop = '$_POST[point2_dirop]', point2_leader = '$_POST[point2_leader]', point3_dirut = '$_POST[point3_dirut]', point3_dirop = '$_POST[point3_dirop]', point3_leader = '$_POST[point3_leader]', point4_dirut = '$_POST[point4_dirut]', point4_dirop = '$_POST[point4_dirop]', point4_leader = '$_POST[point4_leader]', point5_dirut = '$_POST[point5_dirut]', point5_dirop = '$_POST[point5_dirop]', point5_leader = '$_POST[point5_leader]', point6_dirut = '$_POST[point6_dirut]', point6_dirop = '$_POST[point6_dirop]', point6_leader = '$_POST[point6_leader]', point7_dirut = '$_POST[point7_dirut]', point7_dirop = '$_POST[point7_dirop]', point7_leader = '$_POST[point7_leader]', point8_dirut = '$_POST[point8_dirut]', point8_dirop = '$_POST[point8_dirop]', point8_leader = '$_POST[point8_leader]', point13_dirut = '$_POST[point13_dirut]', point13_dirop = '$_POST[point13_dirop]', point13_leader = '$_POST[point13_leader]', point14_dirut = '$_POST[point14_dirut]', point14_dirop = '$_POST[point14_dirop]', point14_leader = '$_POST[point14_leader]',  point15_dirut = '$_POST[point15_dirut]', point15_dirop = '$_POST[point15_dirop]', point15_leader = '$_POST[point15_leader]', point16_dirut = '$_POST[point16_dirut]', point16_dirop = '$_POST[point16_dirop]', point16_leader = '$_POST[point16_leader]', point_grooming = '$_POST[point_grooming]', point_kedisiplinan = '$_POST[point_kedisiplinan]', point_kehadiran = '$_POST[point_kehadiran]', point_owoj = '$_POST[point_owoj]' WHERE nomor = '$_POST[no_fppk]'");

      if($edit_nilaiEvaluasi_fungsional){
        $_SESSION['alert_success'] = "Berhasil! Penilaian Prestasi Kerja Berhasil diubah ";
      }else{
        $_SESSION['alert_error'] = "Gagal! Penilaian Prestasi Kerja Gagal diubah";
      }
    }
  }

  //Edit Nilai Evaluasi Staff
  if(isset($_POST['edit_evaluasi_staff'])){
    if($_POST['edit_evaluasi_staff'] == "Simpan"){
      $edit_nilaiEvaluasi_staff = mysqli_query($conn, "UPDATE evaluasi SET point1_dirut = '$_POST[point1_dirut]', point1_dirop = '$_POST[point1_dirop]', point1_leader = '$_POST[point1_leader]', point2_dirut = '$_POST[point2_dirut]', point2_dirop = '$_POST[point2_dirop]', point2_leader = '$_POST[point2_leader]', point3_dirut = '$_POST[point3_dirut]', point3_dirop = '$_POST[point3_dirop]', point3_leader = '$_POST[point3_leader]', point4_dirut = '$_POST[point4_dirut]', point4_dirop = '$_POST[point4_dirop]', point4_leader = '$_POST[point4_leader]', point13_dirut = '$_POST[point13_dirut]', point13_dirop = '$_POST[point13_dirop]', point13_leader = '$_POST[point13_leader]', point14_dirut = '$_POST[point14_dirut]', point14_dirop = '$_POST[point14_dirop]', point14_leader = '$_POST[point14_leader]',  point15_dirut = '$_POST[point15_dirut]', point15_dirop = '$_POST[point15_dirop]', point15_leader = '$_POST[point15_leader]', point16_dirut = '$_POST[point16_dirut]', point16_dirop = '$_POST[point16_dirop]', point16_leader = '$_POST[point16_leader]', point_grooming = '$_POST[point_grooming]', point_kedisiplinan = '$_POST[point_kedisiplinan]', point_kehadiran = '$_POST[point_kehadiran]', point_owoj = '$_POST[point_owoj]' WHERE nomor = '$_POST[no_fppk]'");

      if($edit_nilaiEvaluasi_staff){
        $_SESSION['alert_success'] = "Berhasil! Penilaian Prestasi Kerja Berhasil diubah ";
      }else{
        $_SESSION['alert_error'] = "Gagal! Penilaian Prestasi Kerja Gagal diubah";
      }
    }
  }

  //Edit Evaluasi Info
  if(isset($_POST['edit_evaluasi_info'])){
    if($_POST['edit_evaluasi_info'] == "Ubah"){
      if($_POST['jabatan'] == $_POST['jabatan_old']){
        $edit_evaluasi_info = mysqli_query($conn, "UPDATE evaluasi SET nik = '', tanggal_evaluasi = '' WHERE nomor = '$_POST[no_fppk]'");
      }else{
        $edit_evaluasi_info = mysqli_query($conn, "UPDATE evaluasi SET  WHERE nomor = '$_POST[no_fppk]'");
      }
      
    }
  }

  //SET Cuti Bersama
  if(isset($_POST['set_cuti_bersama'])){
    if($_POST['set_cuti_bersama'] == "SET"){
      //Clear Cuti Bersama TMP
      mysqli_query($conn, "TRUNCATE TABLE cutibersama_tmp");

      $_SESSION['tgl_cuti'] = $_POST['tanggal'];
      $_SESSION['keterangan_cuti'] = $_POST['keterangan'];
    }
  }

  //Simpan Cuti Bersama TMP
  if(isset($_POST['simpan_cutibersama_tmp'])){
    if($_POST['simpan_cutibersama_tmp']){
      //Clear Cuti Bersama TMP
      mysqli_query($conn, "TRUNCATE TABLE cutibersama_tmp");

      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");

      $jml_karyawan = mysqli_num_rows($q_getKaryawan);

      $jml_data = 0;
      while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
        $get_nik = $get_karyawan['nik'];
        $status = $_POST['options_'.$get_nik];
        $keterangan = $_POST['keterangancuti_'.$get_nik];

        $push_cutibersama_tmp = mysqli_query($conn, "INSERT INTO cutibersama_tmp VALUES('','$get_nik','$_POST[tanggal_cuti]','$status','$keterangan')");
        if($push_cutibersama_tmp){
          $jml_data++;
        }
      }

      if($jml_karyawan == $jml_data){
        // $_SESSION['alert_success'] = "Berhasil! Draft Data Absen Cuti Bersama Berhasil Disimpan";
      }else{
        $_SESSION['alert_warning'] = "Peringatan! Beberapa data gagal disimpan ke draft";
      }
    }
  }

  //Submit Cuti Bersama
  if(isset($_POST['submit_cutibersama_tmp'])){
    if($_POST['submit_cutibersama_tmp'] == "Submit"){
      if($_POST['cek_db'] < 1){
        $jml_success_absenmasuk = 0;
        $jml_success_absenpulang = 0;
        $jml_success_dailyreport = 0;

        $q_getCutiBersama_tmp = mysqli_query($conn, "SELECT * FROM cutibersama_tmp");
        $jml_data_cutibersama_tmp = mysqli_num_rows($q_getCutiBersama_tmp);

        while($get_cutibersama_tmp = mysqli_fetch_array($q_getCutiBersama_tmp)){
          //Push To Absen Masuk
          $push_to_absenmasuk = mysqli_query($conn, "INSERT INTO absen_masuk VALUES('','$get_cutibersama_tmp[nik]','$get_cutibersama_tmp[tanggal]','-','08:30','$get_cutibersama_tmp[status]','-','0','$get_cutibersama_tmp[keterangan]')");

          //Push To Absen Pulang
          $push_to_absenpulang = mysqli_query($conn, "INSERT INTO absen_pulang VALUES('','$get_cutibersama_tmp[nik]','$get_cutibersama_tmp[tanggal]','-','16:30','-','-','0','$get_cutibersama_tmp[keterangan]')");

          //Push To Dailyreport
          $push_to_dailyreport = mysqli_query($conn, "INSERT INTO dailyreport VALUES('','$get_cutibersama_tmp[nik]','$get_cutibersama_tmp[tanggal]','$get_cutibersama_tmp[keterangan]','$this_day')");

          if($push_to_absenmasuk){
            $jml_success_absenmasuk++;
          }
          if($push_to_absenpulang){
            $jml_success_absenpulang++;
          }
          if($push_to_dailyreport){
            $jml_success_dailyreport++;
          }

        }

        if($jml_data_cutibersama_tmp == $jml_success_absenmasuk && $jml_data_cutibersama_tmp == $jml_success_absenpulang && $jml_data_cutibersama_tmp == $jml_success_dailyreport){
            unset($_SESSION['tgl_cuti']);
            unset($_SESSION['keterangan_cuti']);
            mysqli_query($conn, "TRUNCATE TABLE cutibersama_tmp");

            $_SESSION['alert_success'] = "Berhasil! Data Absen Cuti Bersama Berhasil Disubmit";
          }else{
            //Role Back
            mysqli_query($conn, "DELETE FROM absen_masuk WHERE tanggal = '$_POST[tanggal_cuti]'");
            mysqli_query($conn, "DELETE FROM absen_pulang WHERE tanggal = '$_POST[tanggal_cuti]'");
            mysqli_query($conn, "DELETE FROM absen_dailyreport WHERE tanggal = '$_POST[tanggal_cuti]'");
            $_SESSION['alert_error'] = "Gagal! Data Absen Cuti Bersama Gagal Disubmit";

            // $_SESSION['alert_warning'] = "Sebagian Data Absen Cuti Bersama Gagal Disubmit!<br> Jml Data : ".$jml_data_cutibersama_tmp."<br> Jml Absen Masuk : ".$jml_success_absenmasuk."<br> Jml Absen Pulang : ".$jml_success_absenpulang."<br> Jml Dailyreport : ".$jml_success_dailyreport;
        }
      }else{
        $_SESSION['alert_error'] = "Data Absen Tanggal Ini Sudah Ada!";
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
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Daily Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=dailyreport" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Daily Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=STK" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Set Tugas Kantor</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=SHL" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Set Hari Libur</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=setAbsensi" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Set Absensi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=report_daily" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Get Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Form Input
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=form_absen_masuk" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Form Absen Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=form_absen_pulang" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Form Absen Pulang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=setCutiBersama&edit=on" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Form Cuti Bersama</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=form_penilaian_harian" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Form Penilaian Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=form_pelanggaran" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Form Pelanggaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=form_evaluasi" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Form Evaluasi</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i> 
              <p>
                Database
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=dbabsenmasuk" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Absen Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbabsenpulang" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Absen Pulang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbpenilaian" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Penilaian Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbpelanggaran" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Pelanggaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbpotongan" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Potongan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=dbevaluasi" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Evaluasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=datakaryawan" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=datajabatan" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>DB Jabatan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=reportabsen" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Report Absen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=reportpenilaian" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Report Penilaian Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=reportpelanggaran" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Report Pelanggaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=reportcuti" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Report Cuti</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=reportpotongan" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Report Potongan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=reportkaryawan" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Chart Karyawan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="index.php?pages=calender" class="nav-link">
              <i class="nav-icon fa fa-calendar"></i>
              <p>Kalender</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?pages=setting" class="nav-link">
              <i class="nav-icon fa fa-gears"></i>
              <p>Pengaturan</p>
            </a>
          </li>

          <li class="nav-header">General Affair</li>

          <li class="nav-item <?php if($_GET['pages'] == 'neatandclean' || $_GET['pages'] == 'cleaning'){ echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages'] == 'neatandclean' || $_GET['pages'] == 'cleaning'){ echo "active"; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Penilaian
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=neatandclean" class="nav-link <?php if($_GET['pages'] == 'neatandclean'){ echo "active"; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Neat & Clean</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=cleaning" class="nav-link <?php if($_GET['pages'] == 'cleaning'){ echo "active"; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Cleaning Progress</p>
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
    }elseif($_GET["pages"]=="report_daily"){
      require_once "report_daily.php";
    }elseif($_GET["pages"]=="SHL"){
      require_once "setHariLibur.php";
    }elseif($_GET["pages"]=="STK"){
      require_once "setTugasKantor.php";
    }elseif($_GET["pages"]=="datakaryawan"){
      require_once "data_karyawan.php";
    }elseif($_GET["pages"]=="form_absen_masuk"){
      require_once "absen_masuk_form.php";
    }elseif($_GET["pages"]=="form_absen_pulang"){
      require_once "absen_pulang_form.php";
    }elseif($_GET["pages"]=="history_absen"){
      require_once "history_absen.php";
    }elseif($_GET["pages"]=="form_penilaian_harian"){
      require_once "penilaian_harian_form.php";
    }elseif($_GET["pages"]=="dbabsenmasuk"){
      require_once "db_absen_masuk.php";
    }elseif($_GET["pages"]=="dbabsenpulang"){
      require_once "db_absen_pulang.php";
    }elseif($_GET["pages"]=="dbpenilaian"){
      require_once "db_penilaian_harian.php";
    }elseif($_GET["pages"]=="calender"){
      require_once "kalender.php";
    }elseif($_GET["pages"]=="setting"){
      require_once "pengaturan.php";
    }elseif($_GET["pages"]=="reportabsen"){
      require_once "report_absen.php";
    }elseif($_GET["pages"]=="setAbsensi"){
      require_once "setAbsensi.php";
    }elseif($_GET["pages"]=="dbpotongan"){
      require_once "db_potongan.php";
    }elseif($_GET["pages"]=="reportpenilaian"){
      require_once "report_penilaian.php";
    }elseif($_GET["pages"]=="reportcuti"){
      require_once "report_cuti.php";
    }elseif($_GET["pages"]=="reportpotongan"){
      require_once "report_potongan.php";
    }elseif($_GET["pages"]=="form_pelanggaran"){
      require_once "pelanggaran_form.php";
    }elseif($_GET["pages"]=="dbpelanggaran"){
      require_once "db_pelanggaran.php";
    }elseif($_GET["pages"]=="reportpelanggaran"){
      require_once "report_pelanggaran.php";
    }elseif($_GET["pages"]=="form_evaluasi"){
      require_once "evaluasi_form.php";
    }elseif($_GET["pages"]=="dbevaluasi"){
      require_once "db_evaluasi.php";
    }elseif($_GET["pages"]=="reportkaryawan"){
      require_once "report_karyawan.php";
    }elseif($_GET["pages"]=="datajabatan"){
      require_once "db_jabatan.php";
    }elseif($_GET["pages"]=="setCutiBersama"){
      require_once "setCutiBersama.php";
    }elseif($_GET["pages"]=="neatandclean"){
      require_once "../unrole/ga_penilaian/neat_and_clean.php";
    }elseif($_GET["pages"]=="cleaning"){
      require_once "../unrole/ga_penilaian/cleaning.php";
    }
  ?>
  <!-- ./Konten Wrapper -->

  <footer class="main-footer">
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