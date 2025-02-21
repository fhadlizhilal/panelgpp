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

  //Push Merek Baru
  if(isset($_POST['add_merek'])){
    if($_POST['add_merek'] == "Tambah"){
      //Push merek
      $push_merek = mysqli_query($conn, "INSERT INTO merek VALUES('','$_POST[merek]')");

      if($push_merek){
        $_SESSION['alert_success'] = "Berhasil! Merek baru berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Merek baru gagal disimpan";
      }
    }
  }

  //Edit Merek
  if(isset($_POST['edit_merek'])){
    if($_POST['edit_merek'] == "Ubah"){
      //Edit Merek
      $edit_merek = mysqli_query($conn, "UPDATE merek SET merek = '$_POST[merek]' WHERE id = '$_POST[id]'");

      if($edit_merek){
        $_SESSION['alert_success'] = "Berhasil! Merek berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Merek gagal diubah";
      }
    }
  }

  //Delete merek
  if(isset($_POST['delete_merek'])){
    if($_POST['delete_merek'] == "Delete"){
      //delete merek
      $delete_merek = mysqli_query($conn, "DELETE FROM merek WHERE id = '$_POST[id]'");

      if($delete_merek){
        $_SESSION['alert_success'] = "Berhasil! Merek berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Merek gagal dihapus";
      }
    }
  }

  //Add Tools
  if(isset($_POST['add_tools'])){
    if($_POST['add_tools'] == "Simpan Tools"){
      mysqli_query($conn, "ALTER TABLE tools_db AUTO_INCREMENT = 1");
      //push Tools
      $push_tools = mysqli_query($conn, "INSERT INTO tools_db VALUES('','$_POST[id_tools]','$_POST[nama]','$_POST[jenis]','$_POST[satuan]')");

      if($push_tools){
        $_SESSION['alert_success'] = "Berhasil! Tools baru berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools baru gagal disimpan";
      }
    }
  }

  //Add Tools Detail
  if(isset($_POST['add_tools_detail'])){
    if($_POST['add_tools_detail'] == "Simpan Tools"){
      mysqli_query($conn, "ALTER TABLE tools_db_detail AUTO_INCREMENT = 1");
      //push Tools
      $push_tools_detail = mysqli_query($conn, "INSERT INTO tools_db_detail VALUES('','$_POST[id_tools]','$_POST[id_tools_detail]','$_POST[sub_tools]','$_POST[tipe]','$_POST[id_merek]')");

      if($push_tools_detail){
        $_SESSION['alert_success'] = "Berhasil! Tools baru berhasil disimpan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools baru gagal disimpan <br><small>".mysqli_errno($conn)." - ".mysqli_error($conn)."</small>";
      }
    }
  }

  //Edit Tools
  if(isset($_POST['edit_tools'])){
    if($_POST['edit_tools'] == "Ubah Tools"){
      //edit tools_database
      $edit_tools = mysqli_query($conn, "UPDATE tools_db SET id_tools = '$_POST[id_tools]', nama_tools = '$_POST[nama]', jenis_tools = '$_POST[jenis]', satuan = '$_POST[satuan]' WHERE id = '$_POST[id]'");

      if($edit_tools){
        $_SESSION['alert_success'] = "Berhasil! Tools berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools gagal diubah";
      }
    }
  }

  //Edit Tools Detail
  if(isset($_POST['edit_tools_detail'])){
    if($_POST['edit_tools_detail'] == "Ubah Tools"){
      //edit tools_database
      $edit_tools_detail = mysqli_query($conn, "UPDATE tools_db_detail SET detail_id = '$_POST[detail_id]', sub_tools = '$_POST[sub]', tipe_detail = '$_POST[tipe]', merek_id = '$_POST[merek_id]' WHERE id = '$_POST[id]'");

      if($edit_tools_detail){
        $_SESSION['alert_success'] = "Berhasil! Tools berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools gagal diubah";
      }
    }
  }

  //Edit Tools Masuk
  if(isset($_POST['edit_tools_masuk'])){
    if($_POST['edit_tools_masuk'] == 'Simpan Perubahan'){
      $edit_tools_masuk = mysqli_query($conn, "UPDATE tools_masuk SET tgl_masuk = '$_POST[tgl_masuk]', kd_project = '$_POST[kd_project]', keterangan = '$_POST[keterangan]' WHERE no_masuk = '$_POST[no_masuk]'");

      if($edit_tools_masuk){
        $_SESSION['alert_success'] = "Berhasil! Tools masuk berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools masuk gagal diubah".mysqli_error($conn);
      }
    }
  }

  //Add ToolMasuk Detail
  if(isset($_POST['add_toolsmasuk_detail'])){
    if($_POST['add_toolsmasuk_detail'] == "Add Tools"){
      $add_toolsmasuk_detail = mysqli_query($conn, "INSERT INTO tools_masuk_detail VALUES('','$_POST[no_masuk]','$_POST[id_tools]','$_POST[qty]','$_POST[harga_satuan]')");

      if($add_toolsmasuk_detail){
        $_SESSION['alert_success'] = "Berhasil! Tools berhasil ditambahkan";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools gagal ditambahkan".mysqli_error($conn);
      }
    }
  }

  //Edit ToolsMasuk Detail
  if(isset($_POST['edit_toolsmasuk_detail'])){
    if($_POST['edit_toolsmasuk_detail'] == "Ubah"){
      $edit_toolsmasuk_detail = mysqli_query($conn, "UPDATE tools_masuk_detail SET id_detail = '$_POST[id_tools]', qty = '$_POST[qty]', harga_satuan = '$_POST[harga_satuan]' WHERE id = '$_POST[id]'");

      if($edit_toolsmasuk_detail){
        $_SESSION['alert_success'] = "Berhasil! Tools detail berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools detail gagal diubah".mysqli_error($conn);
      }
    }
  }

  //Delete ToolsMasuk Detail
  if(isset($_POST['delete_toolsmasuk_detail'])){
    if($_POST['delete_toolsmasuk_detail'] == 'Delete'){
      $delete_toolsmasuk_detail = mysqli_query($conn, "DELETE FROM tools_masuk_detail WHERE id = '$_POST[id]'");

      if($delete_toolsmasuk_detail){
        $_SESSION['alert_success'] = "Berhasil! Tools detail berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools detail gagal dihapus".mysqli_error($conn);
      }
    }
  }

  //Delete tools
  if(isset($_POST['delete_tools'])){
    if($_POST['delete_tools'] == "Delete"){
      //delete tools
      $delete_tools = mysqli_query($conn, "DELETE FROM tools_db WHERE id_tools = '$_POST[id]'");

      if($delete_tools){
        $_SESSION['alert_success'] = "Berhasil! Tools berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools gagal dihapus";
      }
    }
  }

  //Edit Tools Detail Masuk
  if(isset($_POST['edit_tools_detail_masuk'])){
    if($_POST['edit_tools_detail_masuk'] == "Simpan"){
      $edit_tools_detail_masuk = mysqli_query($conn, "UPDATE tools_masuk_detail_tmp SET id_detail = '$_POST[id_tools]', qty = '$_POST[qty]', harga_satuan = '$_POST[harga_satuan]' WHERE id = '$_POST[id]'");

      if($edit_tools_detail_masuk){
        $_SESSION['alert_success'] = "Berhasil! Tools Detail berhasil diubah";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools Detail gagal diubah <br>".mysqli_error($conn);
      }
    }
  }

  //Delete tools detail
  if(isset($_POST['delete_tools_detail'])){
    if($_POST['delete_tools_detail'] == "Delete"){
      //delete tools
      $delete_tools_detail = mysqli_query($conn, "DELETE FROM tools_db_detail WHERE id = '$_POST[id]'");

      if($delete_tools_detail){
        $_SESSION['alert_success'] = "Berhasil! Tools Detail berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools Detail gagal dihapus";
      }
    }
  }

  //Delete Tools Masuk Detail
  if(isset($_POST['delete_toolsMasukDetail'])){
    if($_POST['delete_toolsMasukDetail'] == 'Delete'){
      $delete_toolsMasukDetail = mysqli_query($conn, "DELETE FROM tools_masuk_detail_tmp WHERE id = '$_POST[id]'");

      if($delete_toolsMasukDetail){
        $_SESSION['alert_success'] = "Berhasil! Tools Detail berhasil dihapus";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools Detail gagal dihapus <br>".mysqli_error($conn);
      }
    }
  }

  //Simpan Tools Masuk
  if(isset($_POST['simpan_tools_masuk'])){
    if($_POST['simpan_tools_masuk'] == "Simpan Draft"){
      mysqli_query($conn, "TRUNCATE TABLE tools_masuk_tmp");
      mysqli_query($conn, "INSERT INTO tools_masuk_tmp VALUES('','$_POST[tgl_masuk]','$_POST[kd_project]','$_POST[keterangan]')");

      header("location:index.php?pages=add-masuk-tools");
    }
  }

  //Submit Tools Masuk
  if(isset($_POST['submit_tools_masuk'])){
    if($_POST['submit_tools_masuk'] == "Submit"){
      $no_toolsMasuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tools_masuk")) + 1;
      if($no_toolsMasuk < 10){
        $no_toolsMasuk = "00".$no_toolsMasuk;
      }elseif($no_toolsMasuk < 100){
        $no_toolsMasuk = "0".$no_toolsMasuk;
      }

      //Push tools masuk
      $noMasuk = $no_toolsMasuk."/MA-IN/TLS/".date("m", strtotime($_POST['tgl_masuk']))."/".date("Y", strtotime($_POST['tgl_masuk']));
      $push_toolsMasuk = mysqli_query($conn, "INSERT INTO tools_masuk VALUES('','$noMasuk','$_POST[tgl_masuk]','$_POST[kd_project]','$_POST[keterangan]')");
      mysqli_query($conn, "TRUNCATE TABLE tools_masuk_tmp");

      $q_ToolsMasukDetailTmp = mysqli_query($conn, "SELECT * FROM tools_masuk_detail_tmp");
      while($get_tools_detail_tmp = mysqli_fetch_array($q_ToolsMasukDetailTmp)){
        mysqli_query($conn, "INSERT INTO tools_masuk_detail VALUES('','$noMasuk','$get_tools_detail_tmp[id_detail]','$get_tools_detail_tmp[qty]','$get_tools_detail_tmp[harga_satuan]')");
      }
      mysqli_query($conn, "TRUNCATE TABLE tools_masuk_detail_tmp");

      if($push_toolsMasuk){
        $_SESSION['alert_success'] = "Tools Masuk Berhasil Disimpan!";
      }else{
        $_SESSION['alert_error'] = "Gagal! Tools Masuk Gagal Disimpan!<br><small>".mysqli_error($conn)."</small>";
      }
    }
  }


  // --------------------------------------- AKSI PEMINJAMAN TOOLS --------------------------------------------

  if(isset($_POST['followup_pinjam_tools'])){
    if($_POST['followup_pinjam_tools'] == "Process"){
      $fu_pinjam_tools = mysqli_query($conn, "UPDATE tools_peminjaman SET status_pinjam = 'Diproses', diproses = '$this_date' WHERE no_pinjam = '$_POST[no_pinjam]'");
      $pesan = "Peminjaman ".$_POST['no_pinjam']." Berhasil Diproses!";
    }elseif($_POST['followup_pinjam_tools'] == "Approve"){
      //Push dari tools_keluardetail_tmp to tools_keluardetail
        $q_keluardetail_tmp = mysqli_query($conn, "SELECT * FROM tools_keluardetail_tmp WHERE no_pinjam = '$_POST[no_pinjam]'");
        while($get_toolsKeluarDetail = mysqli_fetch_array($q_keluardetail_tmp)){
          mysqli_query($conn, "INSERT INTO tools_keluardetail VALUES ('','$_POST[no_pinjam]','$get_toolsKeluarDetail[id_detail]','$get_toolsKeluarDetail[qty]')");
          mysqli_query($conn, "DELETE FROM tools_keluardetail_tmp WHERE no_pinjam = '$_POST[no_pinjam]'");
        }

      $fu_pinjam_tools = mysqli_query($conn, "UPDATE tools_peminjaman SET status_pinjam = 'Approved', approved_reject = '$this_date' WHERE no_pinjam = '$_POST[no_pinjam]'");
      $pesan = "Peminjaman ".$_POST['no_pinjam']." Approved!";
    }elseif($_POST['followup_pinjam_tools'] == "Reject"){
      $fu_pinjam_tools = mysqli_query($conn, "UPDATE tools_peminjaman SET status_pinjam = 'Rejected', approved_reject = '$this_date' WHERE no_pinjam = '$_POST[no_pinjam]'");
      $pesan = "Peminjaman ".$_POST['no_pinjam']." Rejected!";
    }elseif($_POST['followup_pinjam_tools'] == "Simpan"){
      //Delete keluardetail
      mysqli_query($conn, "DELETE FROM tools_keluardetail_tmp WHERE no_pinjam = '$_POST[no_pinjam]'");

      for($i=1;$i<=$_POST['jml_data'];$i++){
        $qty_array = "qty_".$i;
        $detailID_array = "detailID_".$i;
        if($_POST[$qty_array] > 0){
          $fu_pinjam_tools = mysqli_query($conn, "INSERT INTO tools_keluardetail_tmp VALUES('','$_POST[no_pinjam]','$_POST[$detailID_array]','$_POST[$qty_array]')");
        }
        $pesan = "Review Peminjaman ".$_POST['no_pinjam']." Berhasil Disimpan";
      }
    }elseif($_POST['followup_pinjam_tools'] == "Serahkan ke User"){
      mysqli_query($conn, "UPDATE tools_peminjaman SET diserahkanke_user = '$this_date', status_pinjam = 'Diserahkan ke user' WHERE no_pinjam = '$_POST[no_pinjam]'");
      $fu_pinjam_tools = true;
    }

    if($fu_pinjam_tools){
        $_SESSION['alert_success'] = $pesan;
      }else{
        $_SESSION['alert_error'] = "Gagal! Peminjaman ".$_POST['no_pinjam']." gagal difollowup!<br><small>".mysqli_error($conn)."</small>";
      }
  }

  //Add Tools Detail Masuk
  if(isset($_POST['add_tools_detail_masuk'])){
    if($_POST['add_tools_detail_masuk'] == "Add Tools"){
      mysqli_query($conn, "ALTER TABLE tools_masuk_detail_tmp AUTO_INCREMENT = 1");
      //push Tools
      $push_tools_masuk_detail_tmp = mysqli_query($conn, "INSERT INTO tools_masuk_detail_tmp VALUES('','$_POST[id_tools]','$_POST[qty]','$_POST[harga_satuan]')");

      if($push_tools_masuk_detail_tmp){
        $_SESSION['alert_success'] = "Berhasil! Add tools ".$_POST['id_tools']." berhasil";
      }else{
        $_SESSION['alert_error'] = "Gagal! Add tools gagal! <br><small>".mysqli_errno($conn)." - ".mysqli_error($conn)."</small>";
      }
    }
  }

  //Buat Pengajuan
  if(isset($_POST['buat_pengajuan'])){
    if($_POST['Buat Pengajuan']){
      mysqli_query($conn, "INSERT INTO pengajuan VALUES('','','')");
    }
  }

  // --------------------------------------- AKSI PEMINJAMAN TOOLS END --------------------------------------------

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

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Stock Barang
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=stock-tools" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Tools</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=stock-apd" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>APD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=stock-assets" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Assets</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Barang Masuk
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=in-tools" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Tools</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=in-apd" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>APD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=in-assets" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Assets</p>
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
                <a href="index.php?pages=db-tools" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Tools General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=db-tools-detail" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Tools Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=db-apd" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Database APD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=db-assets" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Database Assets</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=db-merek" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Database Merek</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Peminjaman Tools
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Form Peminjaman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=list-peminjaman-tools" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>List Peminjaman</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-chevron-right nav-icon"></i>
                  <p>Sedang Dipinjam</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text-o"></i>
              <p>
                Pengembalian
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
    }elseif($_GET["pages"]=="db-merek"){
      require_once "db_merek.php";
    }elseif($_GET["pages"]=="db-tools"){
      require_once "db_tools.php";
    }elseif($_GET["pages"]=="db-apd"){
      require_once "db_apd.php";
    }elseif($_GET["pages"]=="db-assets"){
      require_once "db_assets.php";
    }elseif($_GET["pages"]=="in-tools"){
      require_once "list_masuk_tools.php";
    }elseif($_GET["pages"]=="add-masuk-tools"){
      require_once "masuk_tools.php";
    }elseif($_GET["pages"]=="edit-toolsmasuk"){
      require_once "edit_toolsmasuk.php";
    }elseif($_GET["pages"]=="in-apd"){
      require_once "list_masuk_apd.php";
    }elseif($_GET["pages"]=="add-masuk-apd"){
      require_once "masuk_apd.php";
    }elseif($_GET["pages"]=="edit-apdmasuk"){
      require_once "edit_apdmasuk.php";
    }elseif($_GET["pages"]=="stock-tools"){
      require_once "stock_tools.php";
    }elseif($_GET["pages"]=="stock-apd"){
      require_once "stock_apd.php";
    }elseif($_GET["pages"]=="db-tools-detail"){
      require_once "db_tools_detail.php";
    }elseif($_GET["pages"]=="list-peminjaman-tools"){
      require_once "list_peminjaman_tools.php";
    }elseif($_GET["pages"]=="review-peminjaman-tools"){
      require_once "review_peminjaman_tools.php";
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