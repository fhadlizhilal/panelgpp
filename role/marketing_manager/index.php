<?php
  error_reporting(0);
  ob_start(); 
  session_start();

  date_default_timezone_set('Asia/Jakarta');
  $this_day = date('Y-m-d H:i:s');

  if(!isset($_SESSION["role"]) || $_SESSION["role"] != "marketing_manager"){
    header("location: ../../login.php");
  }

  require_once "../all_role/header.php";
  require_once "../../dev/config.php";

  //Push New Forecast
  if(isset($_POST['newforecast'])){
    if($_POST['newforecast'] == "Simpan"){
      $count_forecast = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM forecast"));
      $kode_forecast = "FRC0".($count_forecast + 1);

      $badan = $_POST['badan'];
      $notiket = $_POST['notiket'];
      $namacustomer = $_POST['namacustomer'];
      $perusahaan = $_POST['perusahaan'];
      $nohp = $_POST['nohp'];
      $kategori = $_POST['kategori'];
      $deskripsi = $_POST['deskripsi'];
      $pribadi_proyek = $_POST['pribadi_proyek'];
      $nilai_proyek = $_POST['nilai_proyek'];
      $nilai_proyek = preg_replace("/[^0-9]/","",$nilai_proyek);

      $hari_ini = date('Y-m-d H:i:s');

      //Push New Forecast
      $reset_AI = mysqli_query($conn, "ALTER TABLE forecast AUTO_INCREMENT = 1");
      $push_newforecast = mysqli_query($conn, "INSERT INTO forecast VALUES ('','$kode_forecast','$badan','$notiket','$namacustomer','$perusahaan','$nohp','$kategori','$deskripsi','$pribadi_proyek','$nilai_proyek','$_SESSION[nik]','1','view','$hari_ini')");

      //Push New Activity
      $reset_AI = mysqli_query($conn, "ALTER TABLE activity_update AUTO_INCREMENT = 1");
      $push_newactivity = mysqli_query($conn, "INSERT INTO activity_update VALUES ('','$kode_forecast','$hari_ini','1','New Forecast Created','-','-','-')");

      if($push_newforecast && $push_newactivity){
        $_SESSION['alert_success'] = "Berhasil! Forecast baru berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Forecast baru gagal disimpan";
      }
    }
  }

  //Push Activity Forecast
  if(isset($_POST['update_activity'])){
    if($_POST['update_activity'] == "Update"){
      $kd_forecast = $_POST['kd_forecast'];
      $status_forecast = $_POST['status_forecast'];
      $keterangan = $_POST['keterangan'];
      $plan_followup = $_POST['plan_followup'];
      $kendala = $_POST['kendala'];
      $peluang = $_POST['peluang'];
      $hari_ini = date('Y-m-d');
      $status_view = 'view';

      if($status_forecast == "10" || $status_forecast == "11" || $status_forecast == "12"){
        $status_view = 'archived';
      }

      //Push activity forecast
      $push_activityforecast = mysqli_query($conn, "INSERT INTO activity_update VALUES('','$kd_forecast','$hari_ini','$status_forecast','$keterangan','$plan_followup','$kendala','$peluang')");

      //Update status forecast
      $update_forecast = mysqli_query($conn, "UPDATE forecast SET status_forecast = '$status_forecast', status_view = '$status_view' WHERE kd_forecast = '$kd_forecast'");

      if($push_activityforecast && $update_forecast){
        $_SESSION['alert_success'] = "Berhasil! Update activity forecast berhasil";
      }else{
        $_SESSION['alert_error'] = "Gagal! Update activity forecast gagal";
      }
    }
  }

  //Edit Forecast
  if(isset($_POST['update_forecast'])){
    if($_POST['update_forecast'] == "Update"){
      $kd_forecast = $_POST['kd_forecast'];
      $badan = $_POST['badan'];
      $notiket = $_POST['notiket'];
      $namacustomer = $_POST['namacustomer'];
      $perusahaan = $_POST['perusahaan'];
      $nohp = $_POST['nohp'];
      $kategori = $_POST['kategori'];
      $deskripsi = $_POST['deskripsi'];
      $pribadi_proyek = $_POST['pribadi_proyek'];
      $nilai_proyek = $_POST['nilai_proyek'];

      //Update forecast
      $update_forecast = mysqli_query($conn, "UPDATE forecast SET badan = '$badan', tiketcrm = '$notiket', nm_customer = '$namacustomer', perusahaan = '$perusahaan', nohp = '$nohp', kategori_kd = '$kategori', kebutuhan = '$deskripsi', pribadi_proyek = '$pribadi_proyek', penawaran = '$nilai_proyek' WHERE kd_forecast = '$kd_forecast'");

      if($update_forecast){
        $_SESSION['alert_success'] = "Berhasil! Update forecast berhasil";
      }else{
        $_SESSION['alert_error'] = "Gagal! Update forecast gagal";
      }
    }
  }

  //To Project
  if(isset($_POST['newproject'])){
    if($_POST['newproject'] == "To Project"){
      $kd_forecast = $_POST['kd_forecast'];
      $nik = $_SESSION['nik'];
      $badan = $_POST['badan'];
      $nama_project = $_POST['nama_project'];
      $notiket = $_POST['notiket'];
      $nosph = $_POST['nosph'];
      $nospk = $_POST['nospk'];
      $namacustomer = $_POST['namacustomer'];
      $nohp = $_POST['nohp'];
      $perusahaan = $_POST['perusahaan'];
      $kapasitas = $_POST['kapasitas'];
      $satuan_kapasitas = $_POST['satuan_kapasitas'];
      $jumlah_order = $_POST['jumlah_order'];
      $satuan_order = $_POST['satuan_order'];
      $lokasi = $_POST['lokasi'];
      $tipe_proyek = $_POST['tipe_proyek'];
      $start = $_POST['start'];
      $deadline = $_POST['deadline'];
      $nilai_proyek = $_POST['nilai_proyek'];
      $ppn = $_POST['ppn'];
      $cashback = $_POST['cashback'];
      $remark = $_POST['remark'];

      $hari_ini = date('Y-m-d');

      $get_forecast = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM forecast WHERE kd_forecast = '$kd_forecast'"));
      $count_project = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = '$get_forecast[badan]'"));
      $count_project = $count_project + 1;
      //tambah nol
      if($count_project<10){
        $PR = "0".$count_project;
      }else{
        $PR = $count_project;
      }
      $kd_project = $get_forecast['badan'].$PR.date('Y');

      // var_dump($kapasitas." ".$jumlah_order." ".$nik." ".$badan." ".$nama_project);
      // die;

      //Push To Project
      $reset_AI = mysqli_query($conn, "ALTER TABLE project AUTO_INCREMENT = 1");
      $push_toproject = mysqli_query($conn, "INSERT INTO project VALUES ('','$kd_project','$kd_forecast','$nik','$badan','$nama_project','$notiket','$nosph','$nospk','$namacustomer','$nohp','$perusahaan','$kapasitas','$satuan_kapasitas','$jumlah_order','$satuan_order','$lokasi','$tipe_proyek','$start','$deadline','$nilai_proyek','$ppn','$cashback','$remark','$this_day')");
      
      //Push Forecast to Archive
      $update_forecast = mysqli_query($conn, "UPDATE forecast SET status_view = 'archive', status_forecast = '12' WHERE kd_forecast = '$kd_forecast'");

      //Push activity forecast
      $push_activityforecast = mysqli_query($conn, "INSERT INTO activity_update VALUES('','$kd_forecast','$hari_ini','12','To Project','-','-','100%')");

      if($push_toproject && $update_forecast){
        $_SESSION['alert_success'] = "Berhasil! Project baru berhasil dibuat";
      }else{
        $_SESSION['alert_error'] = "Gagal! Project baru gagal dibuat";
      }

    }
  }

  //New Project
  if(isset($_POST['newproject'])){
    if($_POST['newproject'] == "New Project"){
      $nik = $_SESSION['nik'];
      $badan = $_POST['badan'];
      $nama_project = $_POST['nama_project'];
      $notiket = $_POST['notiket'];
      $nosph = $_POST['nosph'];
      $nospk = $_POST['nospk'];
      $namacustomer = $_POST['namacustomer'];
      $nohp = $_POST['nohp'];
      $perusahaan = $_POST['perusahaan'];
      $kapasitas = $_POST['kapasitas'];
      $satuan_kapasitas = $_POST['satuan_kapasitas'];
      $jumlah_order = $_POST['jumlah_order'];
      $satuan_order = $_POST['satuan_order'];
      $lokasi = $_POST['lokasi'];
      $tipe_proyek = $_POST['tipe_proyek'];
      $start = $_POST['start'];
      $deadline = $_POST['deadline'];
      $nilai_proyek = $_POST['nilai_proyek'];
      $nilai_proyek = preg_replace("/[^0-9]/","",$nilai_proyek);
      $ppn = $_POST['ppn'];
      $cashback = $_POST['cashback'];
      $cashback = preg_replace("/[^0-9]/","",$cashback);
      $remark = $_POST['remark'];

      $count_project = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = '$badan'"));
      $count_project = $count_project + 1 ;
      //tambah nol
      if($count_project<10){
        $PR = "0".$count_project;
      }else{
        $PR = $count_project;
      }
      $kd_project = $badan.$PR.date('Y');

      // var_dump($kd_project." ".$jumlah_order." ".$nik." ".$badan." ".$nama_project);
      // die;

      //Push To Project
      $reset_AI = mysqli_query($conn, "ALTER TABLE project AUTO_INCREMENT = 1");
      $push_toproject = mysqli_query($conn, "INSERT INTO project VALUES ('','$kd_project','','$nik','$badan','$nama_project','$notiket','$nosph','$nospk','$namacustomer','$nohp','$perusahaan','$kapasitas','$satuan_kapasitas','$jumlah_order','$satuan_order','$lokasi','$tipe_proyek','$start','$deadline','$nilai_proyek','$ppn','$cashback','$remark','$this_day')");

      if($push_toproject){
        $_SESSION['alert_success'] = "Berhasil! Project baru berhasil dibuat";
      }else{
        $_SESSION['alert_error'] = "Gagal! Project baru gagal dibuat";
      }

    }
  }

  //Edit Project
  if(isset($_POST['editproject'])){
    if($_POST['editproject'] == "Simpan Project"){
      //Push Edit
      $update_project = mysqli_query($conn, "UPDATE project SET nm_project = '$_POST[nama_project]', no_ticket = '$_POST[notiket]', no_sph = '$_POST[nosph]', no_spk = '$_POST[nospk]', nm_customer = '$_POST[namacustomer]', nohp = '$_POST[nohp]', perusahaan = '$_POST[perusahaan]', kapasitas = '$_POST[kapasitas]', satuan_kapasitas = '$_POST[satuan_kapasitas]', jumlah_order = '$_POST[jumlah_order]', satuan = '$_POST[satuan_order]', lokasi_project = '$_POST[lokasi]', tipe_project = '$_POST[tipe_proyek]', start = '$_POST[start]', deadline = '$_POST[deadline]', nilai_project = '$_POST[nilai_proyek]', ppn = '$_POST[ppn]', cashback = '$_POST[cashback]', remark = '$_POST[remark]' WHERE kd_project = '$_POST[kode_project]'");

      if($update_project){
        $_SESSION['alert_success'] = "Berhasil! Project ".$_POST['kode_project']." berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Project gagal diubah <br><br>".mysqli_error($conn);
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
                <a href="index.php?pages=reporttiket" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Report Tiket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=reportdailyteam" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Report Daily Team</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="index.php?pages=reporttiket" class="nav-link">
              <i class="fa fa-file-o nav-icon"></i>
              <p>Report Tiket</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Forecast
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=newforecast" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>New Forecast</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=listforecast" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>My Forecast</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=listforecast_all" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>All Forecast</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="index.php?pages=archive" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Archive</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Project
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=newproject" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>New Project</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=listproject" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>List Project</p>
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

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Peminjaman
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Peminjaman Tools</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Peminjaman APD</p>
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
              <li class="nav-item">
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
              </li>
            </ul>
          </li> -->
                                           
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
    }elseif($_GET["pages"]=="listforecast"){
      require_once "../forecast&project/list_forecast.php";
    }elseif($_GET["pages"]=="newforecast"){
      require_once "../forecast&project/newforecast.php";
    }elseif($_GET["pages"]=="archive"){
      require_once "../forecast&project/archive.php";
    }elseif($_GET["pages"]=="listproject"){
      require_once "../forecast&project/list_project.php";
    }elseif($_GET["pages"]=="newproject"){
      require_once "../forecast&project/new_project.php";
    }elseif($_GET["pages"]=="listforecast_all"){
      require_once "listforecast_all.php";
    }elseif($_GET["pages"]=="reporttiket"){
      require_once "../report_tiket/summary_report.php";
    }elseif($_GET["pages"]=="reportdailyteam"){
      require_once "report_daily_team.php";
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