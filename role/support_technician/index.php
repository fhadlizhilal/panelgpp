<?php
  error_reporting(0);
  ob_start(); 
  session_start();

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "support_technician"){
    header("location: ../../login.php");
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