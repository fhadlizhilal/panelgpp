<?php
  error_reporting(0);
  ob_start(); 
  session_start();
  date_default_timezone_set('Asia/Jakarta');

  require_once "../../dev/config.php";

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "technician"){
    header("location: ../../login.php");
  }

//------- Action Pimpro ----------
  if(isset($_POST['action'])){
    $updated_at = date('Y-m-d H:i:s');
    if($_POST['action'] == "Check/Approve"){
      $update_action = mysqli_query($conn, "UPDATE approval_file SET pimpro_status = 'checked', pimpro_updated_at = '$updated_at', pimpro_note = '$_POST[note]' WHERE id = '$_POST[id_file]'");

      if($update_action){
        $_SESSION['alert_success'] = "Berhasil! File selesai dicheck";
      }else{
        $_SESSION['alert_error'] = "Gagal! File gagal dicheck";
      }
    }elseif($_POST['action'] == "Reject"){
      $update_action = mysqli_query($conn, "UPDATE approval_file SET pimpro_status = 'rejected', pimpro_updated_at = '$updated_at', pimpro_note = '$_POST[note]' WHERE id = '$_POST[id_file]'");
      if($update_action){
        $_SESSION['alert_success'] = "Berhasil! File berhasil direject";
      }else{
        $_SESSION['alert_error'] = "Gagal! File gagal direject";
      }
    }
  }

//------ Upload File Approval -----------------------------
  if(isset($_POST['upload_file'])){
    if($_POST['upload_file'] == "Upload"){
      $id_list = $_POST['id_list'];
      $uploader = $_SESSION['nik'];
      $uploaded_at = date('Y-m-d H:i:s');

      $rand = date('ymd_His');
      $fileupload = $_FILES['berkas_upload']['tmp_name'];
      $ekstensi =  array('pdf','PDF', 'xlsx', 'xls', 'XLS', 'XLSX');
      $filename = $_FILES['berkas_upload']['name'];
      $ukuran = $_FILES['berkas_upload']['size'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);

      $cek_jml_file = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM approval_file WHERE approval_list_id = '$id_list'"));
       
      if(!in_array($ext,$ekstensi) ) {
        $_SESSION['alert_error'] = "Gagal! extensi yang anda upload bukan .pdf";
      }else{
        if($ukuran < 5000000){
          $xx = "[REV-".$cek_jml_file."] ".$rand."_".$filename;
          $move_file = move_uploaded_file($_FILES['berkas_upload']['tmp_name'], '../e_approval/file_approval/'.$xx);
          if($move_file){
            $reset_AI = mysqli_query($conn, "ALTER TABLE approval_file AUTO_INCREMENT = 1");
            $add_upload = mysqli_query($conn, "INSERT INTO approval_file VALUES('','$id_list','$xx','$uploader','$uploaded_at','checked','$uploaded_at','Uploaded by Pimpro','','','')");
            if($add_upload){
              $_SESSION['alert_success'] = "Berhasil! File berhasil diupload dan disimpan ke database";
            }else{
              $_SESSION['alert_error'] = "Gagal! File gagal diupload, hubungi admin [periksa koneksi]";
            }
          }else{
            $_SESSION['alert_error'] = "Gagal upload file, gunakan file yang lain";
          }
          
        }else{
          $_SESSION['alert_error'] = "Gagal upload file, ukuran file terlalu besar";
        }
      }
    }
  }

//-------- Add List Approval -----------------------------
  if(isset($_POST['submit_add_list'])){
    if($_POST['submit_add_list'] == "Simpan"){
      $today = Date("Y-m-d H:i:s");

      $reset_AI = mysqli_query($conn, "ALTER TABLE approval_list AUTO_INCREMENT = 1");
      $add_list_approval = mysqli_query($conn, "INSERT INTO approval_list VALUES ('','$_POST[nama_project]','$_POST[nik]',NULL,'$today')");

      if($add_list_approval){
        $_SESSION['alert_success'] = "Terimakasih! List Approval berhasil ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! List Approval gagal ditambahkan";
      }
    }
  }

//-------- Add List Sub Approval -----------------------------
  if(isset($_POST['submit_add_sublist'])){
    if($_POST['submit_add_sublist'] == "Simpan"){
      $today = Date("Y-m-d H:i:s");

      $reset_AI = mysqli_query($conn, "ALTER TABLE approval_sub_list AUTO_INCREMENT = 1");
      $add_list_subapproval = mysqli_query($conn, "INSERT INTO approval_sub_list VALUES ('','$_POST[approval_list_id]','$_POST[nama_subproject]','$today')");

      if($add_list_subapproval){
        $_SESSION['alert_success'] = "Terimakasih! Approval sub project berhasil ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Approval sub project gagal ditambahkan";
      }
    }
  }

  require_once "../all_role/header.php"
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
            <a href="index.php?pages=dailyreport" class="nav-link">
              <i class="fa fa-file-o nav-icon"></i>
              <p>Daily Report</p>
            </a>
          </li>

          <?php if($_SESSION['nama'] == "Janu Abdu Rohman"){ ?>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-file-text-o"></i>
                <p>
                  e-Approval
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?pages=listapproval&tahun=2023" class="nav-link">
                    <i class="fa fa-chevron-right nav-icon"></i>
                    <p>2023</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?pages=listapproval&tahun=2024" class="nav-link">
                    <i class="fa fa-chevron-right nav-icon"></i>
                    <p>2024</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?pages=listapproval&tahun=2025" class="nav-link">
                    <i class="fa fa-chevron-right nav-icon"></i>
                    <p>2025</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item <?php if($_GET['pages']=="milestonelist" || $_GET['pages']=="formsubmission" || $_GET['pages']=="formsubmission_revisi" || $_GET['pages'] == "reportmilestone"){ echo "menu-open"; } ?>">
              <a href="#" class="nav-link <?php if($_GET['pages']=="milestonelist" || $_GET['pages']=="formsubmission" || $_GET['pages']=="formsubmission_revisi" || $_GET['pages'] == "reportmilestone"){ echo "active"; } ?>">
                <i class="nav-icon fa fa-file-text-o"></i>
                <p>
                  Milestone List
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?pages=milestonelist&show=open" class="nav-link <?php if($_GET['show'] == "open" || $_GET['pages']=="formsubmission" || $_GET['pages']=="formsubmission_revisi"){ echo "active";} ?>">
                    <i class="fa fa-chevron-right nav-icon"></i>
                    <p>Open</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?pages=milestonelist&show=closed" class="nav-link <?php if($_GET['show'] == "closed"){ echo "active";} ?>">
                    <i class="fa fa-chevron-right nav-icon"></i>
                    <p>Closed</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?pages=reportmilestone" class="nav-link <?php if($_GET['pages'] == "reportmilestone"){ echo "active";} ?>">
                    <i class="fa fa-chevron-right nav-icon"></i>
                    <p>Report</p>
                  </a>
                </li>
              </ul>
            </li>
          <?php } ?>

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
                  <?php $jml_peminjaman_saya = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE peminjam = '$_SESSION[nik]' AND (status = 'waiting for MA' OR status = 'on progress by MA') ORDER BY tgl_pinjam DESC")); ?>
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
    }elseif($_GET["pages"]=="listapproval"){
      require_once "listapproval.php";
    }elseif($_GET["pages"]=="milestonelist"){
      require_once "../unrole/milestone/milestone_list.php";
    }elseif($_GET["pages"]=="formsubmission"){
      require_once "../unrole/milestone/form_submission.php";
    }elseif($_GET["pages"]=="reportmilestone"){
      require_once "../unrole/milestone/report_milestone_user.php";
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