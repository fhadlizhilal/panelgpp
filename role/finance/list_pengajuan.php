<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Monitoring Pengajuan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Monitoring Pengajuan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row" style="font-size: 12px;">
          <div class="col-12">
            <div class="card">
              <!-- ./card-header -->
              <div class="card-body" style="font-size: 12px;">
                <form method="GET" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listpengajuan">
                  <div class="row">
                    <div class="col-2">
                      Badan : <br>
                      <select name="filterbadan" style="width: 100%;">
                        <option value="-" selected>-- Semua Badan --</option>
                        <option value="GPP" <?php if(isset($_GET['Filter']) AND $_GET['filterbadan'] == "GPP"){ echo "selected"; } ?>>GPP</option>
                        <option value="GPW" <?php if(isset($_GET['Filter']) AND $_GET['filterbadan'] == "GPW"){ echo "selected"; } ?>>GPW</option>
                        <option value="GPS" <?php if(isset($_GET['Filter']) AND $_GET['filterbadan'] == "GPS"){ echo "selected"; } ?>>GPS</option>
                        <option value="GSS" <?php if(isset($_GET['Filter']) AND $_GET['filterbadan'] == "GSS"){ echo "selected"; } ?>>GSS</option>
                        <option value="SI" <?php if(isset($_GET['Filter']) AND $_GET['filterbadan'] == "SI"){ echo "selected"; } ?>>SI</option>
                      </select>
                    </div>
                    <div class="col-2">
                      Divisi : <br>
                      <select name="filterdivisi" style="width: 100%;">
                        <option value="-" selected>-- Semua Divisi --</option>
                        <option value="Keuangan" <?php if(isset($_GET['Filter']) AND $_GET['filterdivisi'] == "Keuangan"){ echo "selected"; } ?>>Keuangan</option>
                        <option value="Logistik" <?php if(isset($_GET['Filter']) AND $_GET['filterdivisi'] == "Logistik"){ echo "selected"; } ?>>Logistik</option>
                        <option value="Engineering" <?php if(isset($_GET['Filter']) AND $_GET['filterdivisi'] == "Engineering"){ echo "selected"; } ?>>Engineering</option>
                        <option value="Marketing" <?php if(isset($_GET['Filter']) AND $_GET['filterdivisi'] == "Marketing"){ echo "selected"; } ?>>Marketing</option>
                        <option value="Asset" <?php if(isset($_GET['Filter']) AND $_GET['filterdivisi'] == "Asset"){ echo "selected"; } ?>>Asset</option>
                        <option value="SDM" <?php if(isset($_GET['Filter']) AND $_GET['filterdivisi'] == "SDM"){ echo "selected"; } ?>>SDM</option>
                        <option value="IT" <?php if(isset($_GET['Filter']) AND $_GET['filterdivisi'] == "IT"){ echo "selected"; } ?>>IT</option>
                        <option value="HSE" <?php if(isset($_GET['Filter']) AND $_GET['filterdivisi'] == "HSE"){ echo "selected"; } ?>>HSE</option>
                      </select>
                    </div>
                    <div class="col-2">
                      Kategori : <br>
                      <select name="filterkategori" style="width: 100%;">
                        <option value="-" selected>-- Semua Kategori --</option>
                        <option value="Project" <?php if(isset($_GET['Filter']) AND $_GET['filterkategori'] == "Project"){ echo "selected"; } ?>>Project</option>
                        <option value="Rutin" <?php if(isset($_GET['Filter']) AND $_GET['filterkategori'] == "Rutin"){ echo "selected"; } ?>>Rutin</option>
                        <option value="Non-Rutin" <?php if(isset($_GET['Filter']) AND $_GET['filterkategori'] == "Non-Rutin"){ echo "selected"; } ?>>Non-Rutin</option>
                      </select>
                    </div>
                    <div class="col-2">
                      Pelaksana : <br>
                      <select name="filterpelaksana" style="width: 100%;">
                        <option value="-" selected>-- Semua Pelaksana --</option>
                        <?php
                          $q_getKaryawan = mysqli_query($conn,"SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");
                          while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                        ?>
                          <option value="<?php echo $get_karyawan['nik']; ?>" <?php if(isset($_GET['Filter']) AND $_GET['filterpelaksana'] == $get_karyawan['nik']){ echo "selected"; } ?>><?php echo $get_karyawan['nama']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-2">
                      Status : <br>
                      <select name="filterstatus" style="width: 100%;">
                        <option value="-" selected>-- Semua Status --</option>
                        <option value="Sudah" <?php if(isset($_GET['Filter']) AND $_GET['filterstatus'] == "Sudah"){ echo "selected"; } ?>>Sudah</option>
                        <option value="Belum" <?php if(isset($_GET['Filter']) AND $_GET['filterstatus'] == "Belum"){ echo "selected"; } ?>>Belum</option>
                      </select>
                    </div>
                    <div class="col-2">
                      Kode Project : <br>
                      <select name="filterproject" style="width: 100%;">
                        <option value="-" selected>-- Semua Project --</option>
                        <?php
                          $q_getkdProject = mysqli_query($conn,"SELECT DISTINCT kode_project FROM pengajuan_list ORDER BY kode_project ASC");
                          while($get_kodeProject = mysqli_fetch_array($q_getkdProject)){
                        ?>
                          <option value="<?php echo $get_kodeProject['kode_project']; ?>" <?php if(isset($_GET['Filter']) AND $_GET['filterproject'] == $get_kodeProject['kode_project']){ echo "selected"; } ?>><?php echo $get_kodeProject['kode_project']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <br>
                  <center>
                    <input type="hidden" name="pages" value="listpengajuan">
                    <input type="submit" name="Filter" value="Show">
                    <input type="submit" name="clearFilter" value="Clear">
                  </center>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        <div class="row" style="font-size: 12px;">
          <div class="col-12">
            <div class="card">
              <!-- ./card-header -->
              <div class="card-header">
                <!-- <a href="#modal" data-toggle='modal' data-target='#show_add_pengajuan' data-id='<?php echo $getListPengajuan['id_form']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Data">
                  <span class="fa fa-plus"></span> Tambah Data
                </a> -->

               <!--  <a href="index.php?pages=addpengajuan" data-toggle="tooltip" data-placement="bottom" title="Tambah Data">
                  <span class="fa fa-plus"></span> Tambah Data
                </a> -->

                <a href="#modal" data-toggle="modal" data-target="#myModalAddPengajuan" data-toggle="tooltip" data-placement="bottom" title="Tambah Data"><span class="fa fa-plus"></span> Tambah Data
                </a>
                |
                <a href="#modal" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="bottom" title="Form Approved">
                  <span class="fa fa-check"></span> Approved
                </a>
              </div>
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-sm" style="font-size: 9px;">
                  <thead>
                    <tr align="center">
                      <th width="1%">No</th>
                      <th width="12%">No NPB</th>
                      <th width="2%">No Adendum</th>
                      <th width="1%">Badan</th>
                      <th width="5%">Divisi</th>
                      <th width="5%">Jenis</th>
                      <th width="5%">Tanggal</th>
                      <th width="5%">Kategori</th>
                      <th width="">Kode Project</th>
                      <th width="2%">Pelaksana</th>
                      <th width="">Keterangan Keperluan</th>
                      <th width="">Nominal</th>
                      <th width="">Realisasi</th>
                      <th width="">Selisih</th>
                      <th width="1%">Apprv</th>
                      <th width="1%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(isset($_GET['Filter'])){
                        //-- ALL
                        if($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list ORDER BY id DESC");

                        //-- Badan
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' ORDER BY id DESC");

                        //-- Divisi
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' ORDER BY id DESC");

                        //-- Kategori
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' ORDER BY id DESC");

                        //-- Pelaksana
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE pelaksana = '$_GET[filterpelaksana]' ORDER BY id DESC");
                        
                        //-- Status Belum
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                        
                        //-- Status Sudah
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kode_project = '$_GET[filterproject]' ORDER BY id DESC");
                        
                        //-- Badan & Divisi
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' ORDER BY id DESC");
                        
                        //-- Badan & Kategori
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND kategori = '$_GET[filterkategori]' ORDER BY id DESC");
                        
                        //-- Badan & Pelaksana
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND pelaksana = '$_GET[filterpelaksana]' ORDER BY id DESC");
                        
                        //-- Badan & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                        
                        //-- Badan & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Project
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");
                        
                        //-- Divisi & Kategori
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' ORDER BY id DESC");
                        
                        //-- Divisi & Pelaksana
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND pelaksana = '$_GET[filterpelaksana]' ORDER BY id DESC");
                        
                        //-- Divisi & Status Belum
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                        
                        //-- Divisi & Status Sudah
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Divisi & Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");
                        
                        //-- Kategori & Pelaksana
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' ORDER BY id DESC");
                        
                        //-- Kategori & Status Belum
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                        
                        //-- Kategori & Status Sudah
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Kategori & Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");
                        
                        //-- Pelaksana & Status Belum
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE pelaksana = '$_GET[filterpelaksana]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                        
                        //-- Pelaksana & Status Sudah
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE pelaksana = '$_GET[filterpelaksana]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Pelaksana & Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");
                        
                        //-- Badan & Divisi & Kategori
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' ORDER BY id DESC");

                        //-- Badan & Divisi & Pelaksana
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND pelaksana = '$_GET[filterpelaksana]' ORDER BY id DESC");
                        
                        //-- Badan & Divisi & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                        
                        //-- Badan & Divisi & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Divisi & Project
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");

                        //-- Badan & Kategori & Pelaksana
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' ORDER BY id DESC");
                        
                        //-- Badan & Kategori & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND kategori = '$_GET[filterkategori]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Kategori & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND kategori = '$_GET[filterkategori]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Kategori & Project
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND kategori = '$_GET[filterkategori]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");

                        //-- Badan & Pelaksana & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Pelaksana & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Pelaksana & Project
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");
                        
                        //-- Divisi & Kategori & Pelaksana
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' ORDER BY id DESC");
                        
                        //-- Divisi & Kategori & Status Belum
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                        
                        //-- Divisi & Kategori & Status Sudah
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Divisi & Kategori & Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");

                        //-- Divisi & Pelaksana & Status Belum
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Divisi & Pelaksana & Status Sudah
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Divisi & Pelaksana & Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");
                          
                        //-- Kategori & Pelaksana & Status Belum
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                        
                        //-- Kategori & Pelaksana & Status Sudah
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Kategori & Pelaksana & Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");

                        //-- Badan & Divisi & Kategori & Pelaksana
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' ORDER BY id DESC");

                        //-- Badan & Divisi & Kategori & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Divisi & Kategori & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Divisi & Kategori & Project
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");
                        
                        //-- Divisi & Kategori & Pelaksana & Status Belum
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Divisi & Kategori & Pelaksana & Status Sudah
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Divisi & Kategori & Pelaksana & Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");

                        //-- Kategori & Pelaksana & Status Belum & Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Kategori & Pelaksana & Status Sudah & Project
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Divisi & Kategori & Pelaksana & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                          
                        //-- Badan & Divisi & Kategori & Pelaksana & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] == "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Divisi & Kategori & Pelaksana & Project
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "-" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' ORDER BY id DESC");

                        //-- Badan & Divisi & Kategori & Project & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND kode_project = '$_GET[filterproject]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                          
                        //-- Badan & Divisi & Kategori & Project & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] == "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND kode_project = '$_GET[filterproject]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Divisi & Pelaksana & Project & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Divisi & Pelaksana & Project & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] == "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Kategori & Pelaksana & Project & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Kategori & Pelaksana & Project & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] == "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Divisi & Kategori & Pelaksana & Project & Status Belum
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Divisi & Kategori & Pelaksana & Project & Status Sudah
                        }elseif($_GET['filterbadan'] == "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Divisi & Kategori & Pelaksana & Project & Status Belum
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Belum" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        //-- Badan & Divisi & Kategori & Pelaksana & Project & Status Sudah
                        }elseif($_GET['filterbadan'] != "-" && $_GET['filterdivisi'] != "-" && $_GET['filterkategori'] != "-" && $_GET['filterpelaksana'] != "-" && $_GET['filterstatus'] == "Sudah" && $_GET['filterproject'] != "-"){
                          $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE badan = '$_GET[filterbadan]' AND divisi = '$_GET[filterdivisi]' AND kategori = '$_GET[filterkategori]' AND pelaksana = '$_GET[filterpelaksana]' AND kode_project = '$_GET[filterproject]' AND no_npb IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");

                        }
                      }else{
                        $q_getListPengajuan = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE no_npb NOT IN (SELECT no_npb FROM pertanggungjawaban_list) ORDER BY id DESC");
                      }

                      $no = 0;
                      while($getListPengajuan = mysqli_fetch_array($q_getListPengajuan)){
                        $no++;
 
                        $tgl1 = strtotime($getListPengajuan['tgl_pengajuan']);
                        $tgl2 = strtotime(date('Y-m-d'));
                        $jarak = $tgl2 - $tgl1;
                        $hari = $jarak / 60 / 60 / 24;

                        $q_get_pelaksana = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getListPengajuan[pelaksana]'");
                        $get_pelaksana = mysqli_fetch_array($q_get_pelaksana);

                        $q_get_pertanggungjawaban = mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$getListPengajuan[no_npb]'");
                        $cek_pertanggungjawaban = mysqli_num_rows($q_get_pertanggungjawaban);
                        $get_pertanggungjawaban = mysqli_fetch_array($q_get_pertanggungjawaban);
                    ?>
                      <tr <?php if($cek_pertanggungjawaban < 1 AND $hari >= 14){ echo "style='background-color: red;'"; }elseif($cek_pertanggungjawaban < 1 AND $hari > 2){ echo "style='background-color: orange;'"; } ?>>
                        <td align="center"><?php echo $no; ?></td>
                        <td>
                          <a style="color: black; font-weight: bold;" href="#modal" data-toggle='modal' data-target='#show_fu_pengajuan' data-id='<?php echo $getListPengajuan['id']; ?>' data-id2='<?php echo $_GET['Filter']; ?>' data-fbadan='<?php echo $_GET['filterbadan']; ?>' data-fdivisi='<?php echo $_GET['filterdivisi']; ?>' data-fkategori='<?php echo $_GET['filterkategori']; ?>' data-fpelaksana='<?php echo $_GET['filterpelaksana']; ?>' data-fstatus='<?php echo $_GET['filterstatus']; ?>' data-fproject='<?php echo $_GET['filterproject']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail">
                            <?php echo $getListPengajuan['no_npb']; ?>
                          </a>
                        </td>
                        <td><?php echo $getListPengajuan['no_adendum'] ?></td>
                        <td align="center"><?php echo $getListPengajuan['badan'] ?></td>
                        <td align="center"><?php echo $getListPengajuan['divisi'] ?></td>
                        <td align="center"><?php echo $getListPengajuan['jenis'] ?></td>
                        <td align="center"><?php echo date('d-m-Y', strtotime($getListPengajuan['tgl_pengajuan'])); ?></td>
                        <td align="center"><?php echo $getListPengajuan['kategori'] ?></td>
                        <td align="center"><?php echo $getListPengajuan['kode_project'] ?></td>
                        <td>
                          <?php
                            $text = $get_pelaksana['nama'];
                            $posisi=strpos($text," ");
                            echo substr($text,0,$posisi);
                          ?>    
                        </td>
                        <td><?php echo $getListPengajuan['keterangan'] ?></td>
                        <td>
                          <?php
                            $format_angka = number_format($getListPengajuan['nilai'], 0, ",", ".");
                            echo "Rp ".$format_angka;
                          ?>
                        </td>
                        <td>
                          <?php
                            $format_angka3 = number_format($get_pertanggungjawaban['jml_realisasi'], 0, ",", ".");
                            echo "Rp ".$format_angka3;
                          ?>
                        </td>
                        <td>
                          <?php
                            $format_angka2 = number_format($get_pertanggungjawaban['selisih'], 0, ",", ".");
                            echo "Rp ".$format_angka2;
                          ?>    
                        </td>
                        <td align="center">
                          <?php if($getListPengajuan['approved'] == "Sudah"){ ?>
                            <span class="badge badge-success" style="font-size: 8px;">Sudah</span>
                          <?php }else{ ?>
                            <span class="badge badge-danger" style="font-size: 8px;">Belum</span>
                          <?php } ?>
                        </td>
                        <td align="center">
                          <?php if($cek_pertanggungjawaban > 0){ ?>
                            <span class="badge badge-success" style="font-size: 8px;">Sudah</span>
                          <?php }else{ ?>
                            <span class="badge badge-danger" style="font-size: 8px;">Belum</span>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_fu_pengajuan" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-data"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_pengajuan" role="dialog">
    <div class="modal-dialog modal-ls" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Pengajuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-data"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Dinamis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listpengajuan" style="font-size: 12px;" onsubmit="return validateForm()">
                <div id="dynamicForm">
                    <div class="form-group row" style="margin-bottom: 4px;">
                        <select class="form-control form-control-sm col-10" name="input[]" style="width: 100%;" required>
                          <option value="" selected disabled>-- Pilih No NPB --</option>
                          <?php
                            $q_getNoNPB = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE approved = 'Belum' ORDER BY no_npb ASC");
                            while($getNoNPB = mysqli_fetch_array($q_getNoNPB)){
                          ?>
                              <option value="<?php echo $getNoNPB['id']; ?>"><?php echo $getNoNPB['no_npb']; ?></option>
                          <?php } ?>
                        </select>
                        <button type="button" class="btn btn-danger btn-sm remove-form col-2" onclick="removeForm(this)"><span class="fa fa-trash"></span> Hapus</button>
                    </div>
                    <!-- Tambahkan elemen formulir lainnya di sini -->
                </div>
                <hr>
                <button type="button" class="btn btn-primary btn-sm" onclick="addForm()"><span class="fa fa-plus"></span> Tambah</button>
                <button type="submit" name="submit_form_approved" value="Submit" class="btn btn-success btn-sm"><span class="fa fa-check"></span> Submit</button>
              </form>
            </div>
        </div>
    </div>
</div>
  <!-- /.modal -->


  <!-- Modal -->
    <div class="modal fade" id="myModalAddPengajuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Dinamis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listpengajuan" style="font-size: 12px;" onsubmit="return validateForm2()">
                <div id="dynamicForm2" style="padding-left: 10px; padding-right: 10px;">
                    <div class="form-group row" style="margin-bottom: 25px;">
                        <table width="100%" cellpadding="2px">
                          <tr>
                            <td width="20%" style="font-weight: bold;">No NPB</td>
                            <td width="2%">:</td>
                            <td><input type="text" name="no_npb[]" placeholder="No NPB" class="form-control form-control-sm" required></td>
                          </tr>
                          <tr>
                            <td width="20%" style="font-weight: bold;">No Adendum</td>
                            <td width="2%">:</td>
                            <td><input type="text" name="no_adendum[]" placeholder="No Adendum (Optional)" class="form-control form-control-sm"></td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold;">Badan</td>
                            <td>:</td>
                            <td>
                              <select name="badan[]" class="form-control form-control-sm" required>
                                <option value="" disabled selected>-- Pilih Badan --</option>
                                <option value="GPP">GPP</option>
                                <option value="GPW">GPW</option>
                                <option value="GPS">GPS</option>
                                <option value="GSS">GSS</option>
                                <option value="SI">SI</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold;">Divisi</td>
                            <td>:</td>
                            <td>
                              <select name="divisi[]" class="form-control form-control-sm" required>
                                <option value="" disabled selected>-- Semua Divisi --</option>
                                <option value="Keuangan">Keuangan</option>
                                <option value="Logistik">Logistik</option>
                                <option value="Engineering">Engineering</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Asset">Asset</option>
                                <option value="SDM">SDM</option>
                                <option value="IT">IT</option>
                                <option value="HSE">HSE</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold;">Jenis</td>
                            <td>:</td>
                            <td>
                              <select name="jenis[]" class="form-control form-control-sm" required>
                                <option value="" disabled selected>-- Pilih Jenis --</option>
                                <option value="Barang">Barang</option>
                                <option value="Jasa">Jasa</option>
                                <option value="Asset">Asset</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td width="20%" style="font-weight: bold;">Tanggal</td>
                            <td width="2%">:</td>
                            <td><input type="date" name="tanggal[]" placeholder="Tanggal Pengajuan" class="form-control form-control-sm" style="width: 50%;" required></td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold;">Kategori</td>
                            <td>:</td>
                            <td>
                              <select name="kategori[]" class="form-control form-control-sm" required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                <option value="Project">Project</option>
                                <option value="Rutin">Rutin</option>
                                <option value="Non-Rutin">Non-Rutin</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td width="20%" style="font-weight: bold;">Kode Projectttt</td>
                            <td width="2%">:</td>
                            <td>
                              <select name="kode_project[]" class="form-control form-control-sm" required>
                                <option value="" disabled>-- Pilih Kode Project --</option>
                                <option value="Lainnya" selected>Lainnya (Non Project)</option>
                                
                                <option value="" disabled>--------------- GPP ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                                <?php } ?>
                                <option value="" disabled>--------------- GPS ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                                <?php } ?>
                                <option value="" disabled>--------------- GPW ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPW' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                                <?php } ?>
                                <option value="" disabled>--------------- GSS ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                                <?php } ?>
                                <option value="" disabled>--------------- SI ------------------</option>
                                <?php
                                  $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI' ORDER BY CAST(RIGHT(kd_project, 4) AS UNSIGNED) DESC, kd_project DESC");
                                  while($get_project = mysqli_fetch_array($q_get_project)){
                                ?>
                                    <option value="<?php echo $get_project['kd_project']; ?>" <?php if($getPengajuanList['kode_project'] == $get_project['kd_project']){ echo "selected"; $lain2=1; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                                <?php } ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td><input type="text" class="form-control form-control-sm" name="deskripsi[]" placeholder="Isi jika Kode Project Lainnya (Non Project)"></td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold;">Pelaksana</td>
                            <td>:</td>
                            <td>
                              <select name="pelaksana[]" class="form-control form-control-sm" required>
                                <option value="" disabled selected>-- Pilih Pelaksana --</option>
                                <?php
                                  $q_getKaryawan = mysqli_query($conn,"SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");
                                  while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                                ?>
                                  <option value="<?php echo $get_karyawan['nik']; ?>"><?php echo $get_karyawan['nama']; ?></option>
                                <?php } ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td width="20%" style="font-weight: bold;">Keterangan / Keperluan</td>
                            <td width="2%">:</td>
                            <td>
                              <textarea class="form-control form-control-sm" name="keterangan[]" required></textarea>
                            </td>
                          </tr>
                          <tr>
                            <td width="20%" style="font-weight: bold;">Nominal</td>
                            <td width="2%">:</td>
                            <td><input type="text" name="nominal[]" class="formattedInput form-control form-control-sm" oninput="formatInput(this)" required></td>
                          </tr>
                          <tr>
                            <td style="font-weight: bold;">Approved</td>
                            <td>:</td>
                            <td>
                              <select name="approved[]" class="form-control form-control-sm" required>
                                <option value="" disabled selected>-- Pilih Approved --</option>
                                <option value="Sudah">Sudah</option>
                                <option value="Belum">Belum</option>
                              </select>
                            </td>
                          </tr>
                        </table>
                        <button type="button" style="width: 100%;" class="btn btn-danger btn-sm remove-form" onclick="removeForm2(this)"><span class="fa fa-trash"></span> Hapus</button>
                    </div>
                    <!-- Tambahkan elemen formulir lainnya di sini -->
                </div>
                <hr>
                <button type="button" class="btn btn-primary btn-sm" onclick="addForm2()"><span class="fa fa-plus"></span> Tambah</button>
                <button type="submit" class="btn btn-success btn-simpan btn-sm" name="submit_pengajuan" value="Submit"><i class="fa fa-save"></i> Submit</button>
              </form>
            </div>
        </div>
    </div>
</div>
  <!-- /.modal -->