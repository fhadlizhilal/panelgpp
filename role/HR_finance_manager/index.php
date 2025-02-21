<?php
  error_reporting(0);
  ob_start(); 
  session_start();

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "HR_finance_manager"){
    header("location: ../../login.php");
  }

  require_once "../all_role/header.php";
  require_once "../../dev/config.php";

  //------ Push Add Pengajuan -----------------
  if(isset($_POST['submit_add_pengajuan'])){
    if($_POST['submit_add_pengajuan'] == "Submit"){
      if($_POST['no_adendum'] == ""){ $_POST['no_adendum'] = NULL; }
      $push_add_pengajuan = mysqli_query($conn, "INSERT INTO pengajuan_list VALUES('','$_POST[no_npb]', '$_POST[no_adendum]' ,'$_POST[badan]','$_POST[divisi]','$_POST[tanggal]','$_POST[kategori]','$_POST[kode_project]','$_POST[pelaksana]','$_POST[keterangan]','$_POST[nominal]','$_POST[approved]')");
      
      if($push_add_pengajuan){
        $_SESSION['alert_success'] = "Berhasil! Pengajuan baru berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Pengajuan baru gagal disimpan <br>".mysqli_error($conn);
      }
    }
  }

  //------- Push Add Pengajuan NEW ---------------
  if(isset($_POST['submit_pengajuan'])){
    if($_POST['submit_pengajuan'] == "Submit"){

      $nonpb = $_POST['no_npb'];
      $noadendum = $_POST['no_adendum'];
      $badan = $_POST['badan'];
      $divisi = $_POST['divisi'];
      $tanggal = $_POST['tanggal'];
      $kategori = $_POST['kategori'];
      $kode_project = $_POST['kode_project'];
      $pelaksana = $_POST['pelaksana'];
      $keterangan = $_POST['keterangan'];
      $nominal = $_POST['nominal'];
      $approved = $_POST['approved'];

      $total = count($nonpb);

      // cek no NPB
      $duplicate = 0;
      for($i=0;$i<$total-1;$i++){
        for($j=$i+1;$j<$total;$j++){
          if($nonpb[$i] == $nonpb[$j]){
            $duplicate = 1;
          }
        }
      }

      if($duplicate==1){
        $_SESSION['alert_error'] = "No NPB Duplicated";
      }else{
        $itteration = 0;
        for($i=0; $i<$total; $i++){
          $push_add_pengajuan = mysqli_query($conn, "INSERT INTO pengajuan_list VALUES('','$nonpb[$i]', '$noadendum[$i]' ,'$badan[$i]','$divisi[$i]','$tanggal[$i]','$kategori[$i]','$kode_project[$i]','$pelaksana[$i]','$keterangan[$i]','$nominal[$i]','$approved[$i]')");

          if($push_add_pengajuan){
            $itteration++;
          }
        }
      }

      if($itteration == $total){
        $_SESSION['alert_success'] = "Berhasil! ".$total." Pengajuan baru berhasil disimpan";
      }else{
        //roll back
        for($i=0; $i<$total; $i++){
          $rollback = mysqli_query($conn, "DELETE FROM pengajuan_list WHERE no_npb = '$nonpb[$i]'");
        }
        $_SESSION['alert_error'] = "Gagal! ".$total." Pengajuan baru gagal disimpan";
      }

    }
  }

  //------- Submit Edit Pengajuan -------------
  if(isset($_POST['submit_edit_pengajuan'])){
    if($_POST['submit_edit_pengajuan'] == "Simpan"){
      if($_POST['no_adendum'] == ""){
        $_POST['no_adendum'] = NULL;
      }

      $edit_pengajuan = mysqli_query($conn, "UPDATE pengajuan_list SET no_npb = '$_POST[no_npb]', no_adendum = '$_POST[no_adendum]', badan = '$_POST[badan]', divisi = '$_POST[divisi]', tgl_pengajuan = '$_POST[tanggal]', kategori = '$_POST[kategori]', kode_project = '$_POST[kode_project]', pelaksana = '$_POST[pelaksana]', keterangan = '$_POST[keterangan]', nilai = '$_POST[nominal]', approved = '$_POST[approved]' WHERE id = '$_POST[id]'");

      $q_cekPertanggungjawaban = mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$_POST[no_npb]'");
      $cek_pertanggungjawaban = mysqli_num_rows($q_cekPertanggungjawaban);
      if($cek_pertanggungjawaban > 0){
        $getPertanggungjawabanList = mysqli_fetch_array($q_cekPertanggungjawaban);
        $selisih = $_POST['nominal'] - $getPertanggungjawabanList['jml_realisasi'];
        $edit_pertanggungjawaban = mysqli_query($conn, "UPDATE pertanggungjawaban_list SET selisih = '$selisih' WHERE no_npb = '$_POST[no_npb]'");
      }

      if($edit_pengajuan){
        $_SESSION['alert_success'] = "Berhasil! Pengajuan berhasil diubah ";
      }else{
        $_SESSION['alert_error'] = "Gagal! Pengajuan gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  //------ Submit Pertanggungjawaban ------------
  if(isset($_POST['submit_pertanggungjawaban'])){
    if($_POST['submit_pertanggungjawaban'] == "Submit"){
      $selisih = $_POST['nilai_pengajuan'] - $_POST['realisasi'];
      $push_add_pertanggungjawaban = mysqli_query($conn, "INSERT INTO pertanggungjawaban_list VALUES('','$_POST[no_npb]','$_POST[realisasi]','$selisih','$_POST[tanggal]','$_POST[keterangan]')");

      if($push_add_pertanggungjawaban){
        $_SESSION['alert_success'] = "Berhasil! Pertanggungjawaban berhasil disubmit";
      }else{
        $_SESSION['alert_error'] = "Gagal! Pertanggungjawaban gagal disubmit <br>".mysqli_error($conn);
      }
    }
  }

  //----- Submit Edit Pertanggungjawaban -----------
  if(isset($_POST['submit_edit_pertanggungjawaban'])){
    if($_POST['submit_edit_pertanggungjawaban'] == "Simpan"){
      $selisih = $_POST['nilai_pengajuan'] - $_POST['realisasi'];
      $push_edit_pertanggungjawaban = mysqli_query($conn, "UPDATE pertanggungjawaban_list SET jml_realisasi = '$_POST[realisasi]', selisih = '$selisih', tanggal = '$_POST[tanggal]', keterangan = '$_POST[keterangan]' WHERE no_npb = '$_POST[no_npb]'");

      if($push_edit_pertanggungjawaban){
        $_SESSION['alert_success'] = "Berhasil! Pertanggungjawaban berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Pertanggungjawaban gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  //------ Delete Pengajuan -------------
  if(isset($_POST['submit_delete_pengajuan'])){
    if($_POST['submit_delete_pengajuan'] == "Delete"){
      $delete_pengajuanList = mysqli_query($conn, "DELETE FROM pengajuan_list WHERE no_npb = '$_POST[no_npb]'");

      if($delete_pengajuanList){
        $_SESSION['alert_success'] = "Berhasil! Pengajuan berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Pengajuan gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  //------ Delete Pertanggungjawaban ------------
  if(isset($_POST['submit_delete_pertanggungjawaban'])){
    if($_POST['submit_delete_pertanggungjawaban'] == "Delete"){
      $delete_pertanggungjawabanList = mysqli_query($conn, "DELETE FROM pertanggungjawaban_list WHERE no_npb = '$_POST[no_npb]'");

      if($delete_pertanggungjawabanList){
        $_SESSION['alert_success'] = "Berhasil! Pertanggungjawaban berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Pertanggungjawaban gagal dihapus <br>".mysqli_error($conn);
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
                  <p>My Dailyreport</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=myteamdailyreport" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>My Team</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Pengajuan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Pengajuan Baru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Pertanggungjawaban</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="index.php?pages=listpengajuan" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Monitoring Pengajuan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item <?php if($_GET['pages']=="projectcard"){ echo "menu-open"; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=="projectcard"){ echo "active"; } ?>">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Project Card
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=projectcard&status=progress" class="nav-link <?php if($_GET['status'] == "progress"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Progress</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=projectcard&status=done" class="nav-link <?php if($_GET['status'] == "done"){ echo "active";} ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Done</p>
                </a>
              </li>
            </ul>
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
    }elseif($_GET["pages"]=="listpengajuan"){
      require_once "../finance/list_pengajuan.php";
    }elseif($_GET["pages"]=="myteamdailyreport"){
      require_once "myteam_dailyreport.php";
    }elseif($_GET["pages"]=="neatandclean"){
      require_once "../unrole/ga_penilaian/neat_and_clean.php";
    }elseif($_GET["pages"]=="cleaning"){
      require_once "../unrole/ga_penilaian/cleaning.php";
    }elseif($_GET["pages"]=="projectcard"){
      require_once "../unrole/project_card/projectcard_list.php";
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