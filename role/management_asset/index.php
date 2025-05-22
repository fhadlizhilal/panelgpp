<?php
  error_reporting(0);
  ob_start(); 
  session_start();
  date_default_timezone_set('Asia/Jakarta');

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "management_asset"){
    header("location: ../../login.php");
  }

  $this_datetime = date('Y-m-d H:i:s');
  $this_date = date('Y-m-d');
  require_once "../all_role/header.php";
  require_once "../../dev/config.php";
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
            <a href="index.php?pages=dailyreport" class="nav-link <?php if($_GET['pages']=='dailyreport'){ echo 'active'; } ?>">
              <i class="fa fa-file-o nav-icon"></i>
              <p>Daily Report</p>
            </a>
          </li>

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

          <li class="nav-item <?php if($_GET['pages']=='pilihstock' || $_GET['pages']=='datastock' || $_GET['pages']=='pilihstockopname' || $_GET['pages']=='stockopname' || $_GET['pages']=='dataassetrusak' || $_GET['pages']=='reportpengembalianproject' || $_GET['pages']=='annualreport' || $_GET['pages']=='reportproject' || $_GET['pages']=='reportprojectdetail' || $_GET['pages']=='datastockopnamesite'){ echo 'menu-open'; } ?>">
            <a href="#" class="nav-link <?php if($_GET['pages']=='pilihstock' || $_GET['pages']=='datastock' || $_GET['pages']=='pilihstockopname' || $_GET['pages']=='stockopname' || $_GET['pages']=='dataassetrusak' || $_GET['pages']=='reportpengembalianproject' || $_GET['pages']=='annualreport' || $_GET['pages']=='reportproject' || $_GET['pages']=='reportprojectdetail' || $_GET['pages']=='datastockopnamesite'){ echo 'active'; } ?>">
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
                <a href="index.php?pages=datastockopnamesite" class="nav-link <?php if($_GET['pages']=='datastockopnamesite'){ echo 'active'; } ?>">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Stock Opname - Site</p>
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
                <a href="index.php?pages=reportproject" class="nav-link <?php if($_GET['pages']=='report_project'){ echo 'active'; } ?>">
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
    }elseif($_GET["pages"]=="formbastpengembalian"){
      require_once "../unrole/management_asset/form_bast_pengembalian.php";
    }elseif($_GET["pages"]=="dataassetrusak"){
      require_once "../unrole/management_asset/data_asset_rusak.php";
    }elseif($_GET["pages"]=="reportpengembalianproject"){
      require_once "../unrole/management_asset/report_pengembalian_project.php";
    }elseif($_GET["pages"]=="annualreport"){
      require_once "../unrole/management_asset/report_annual.php";
    }elseif($_GET["pages"]=="reportproject"){
      require_once "../unrole/management_asset/report_project.php";
    }elseif($_GET["pages"]=="reportprojectdetail"){
      require_once "../unrole/management_asset/report_project_detail.php";
    }elseif($_GET["pages"]=="datastockopnamesite"){
      require_once "../unrole/management_asset/data_stockopname_site.php";
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