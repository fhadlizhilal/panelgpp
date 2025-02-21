<?php
  date_default_timezone_set('Asia/Jakarta');

  function rupiah($angka){
  
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
 
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <form method="GET" action="">
                  <div class="row">
                    <div class="col-4"></div>
                    <div class="col-2">
                      <div class="form-group">
                        <select class="form-control" name="data">
                          <option value="semua" selected>Semua</option>
                          <option value="2023" <?php if($_GET['data']=="2023"){ echo "selected"; } ?>>2023</option>
                          <option value="2024" <?php if($_GET['data']=="2024"){ echo "selected"; } ?>>2024</option>
                          <option value="2025" <?php if($_GET['data']=="2025"){ echo "selected"; } ?>>2025</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-2">
                      <input type="hidden" name="pages" value="listproject">
                      <input type="submit" class="btn btn-info" name="" value="Show">
                    </div>
                  </div>
                </form>
                <hr>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <div class="row">
                          <div class="col-7">
                            <h3>GPP</h3>
                            <?php 
                              if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP'"));
                                }else{
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP'"));
                              } 
                            ?> 
                            Project
                          </div>
                          <div class="col-5">
                              <img src="../../dist/img/logo/GPP - white.png" width="100%">
                          </div>
                        </div>
                      </div>
                      <a href="#" class="small-box-footer">
                        <b>
                          <?php
                            if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GPP'"));
                                }else{
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GPP' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GPP'"));
                              }
                            echo rupiah($nilaiProject['TotalProject']);
                          ?>   
                        </b>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <div class="row">
                          <div class="col-7">
                            <h3>GPS</h3>
                            <?php
                              if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS'"));
                                }else{
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS'"));
                              }
                            ?>
                            Project
                          </div>
                          <div class="col-5">
                              <img src="../../dist/img/logo/GPS - white.png" width="100%">
                          </div>
                        </div>
                      </div>
                      <a href="#" class="small-box-footer">
                        <b>
                          <?php
                            if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GPS'"));
                                }else{
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GPS' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GPS'"));
                              }
                            echo rupiah($nilaiProject['TotalProject']);
                          ?>   
                        </b>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <div class="row">
                          <div class="col-7">
                            <h3>GPW</h3>
                            <?php
                              if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPW'"));
                                }else{
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPW' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPW'"));
                              }
                            ?>
                            Project
                          </div>
                          <div class="col-5">
                              <img src="../../dist/img/logo/GPW - white.png" width="100%">
                          </div>
                        </div>
                      </div>
                      <a href="#" class="small-box-footer">
                        <b>
                          <?php
                            if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GPW'"));
                                }else{
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GPW' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GPW'"));
                              }
                            echo rupiah($nilaiProject['TotalProject']);
                          ?>   
                        </b>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <div class="row">
                          <div class="col-7">
                            <h3>GSS</h3>
                            <div>
                              <?php
                                if(isset($_GET['data'])){
                                  if($_GET['data'] == "semua"){
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS'"));
                                  }else{
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS' AND kd_project LIKE '%$_GET[data]'"));
                                  }
                                }else{
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS'"));
                                }
                              ?>
                              Project
                            </div>
                          </div>
                          <div class="col-5">
                              <img src="../../dist/img/logo/GSS - white.png" width="100%">
                          </div>
                        </div>
                      </div>
                      <a href="#" class="small-box-footer">
                        <b>
                          <?php
                            if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GSS'"));
                                }else{
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GSS' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'GSS'"));
                              }
                            echo rupiah($nilaiProject['TotalProject']);
                          ?>   
                        </b>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->


                <!-- Small boxes (Stat box) -->
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <div class="row">
                          <div class="col-7">
                            <h3>SI</h3>
                            <div>
                              <?php
                                if(isset($_GET['data'])){
                                  if($_GET['data'] == "semua"){
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI'"));
                                  }else{
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI' AND kd_project LIKE '%$_GET[data]'"));
                                  }
                                }else{
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI'"));
                                }
                              ?>
                              Project
                            </div>
                          </div>
                          <div class="col-5">
                              <img src="../../dist/img/logo/SI - white.png" width="90%">
                          </div>
                        </div>
                      </div>
                      <a href="#" class="small-box-footer">
                        <b>
                          <?php
                            if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'SI'"));
                                }else{
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'SI' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'SI'"));
                              }
                            echo rupiah($nilaiProject['TotalProject']);
                          ?>   
                        </b>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <div class="row">
                          <div class="col-7">
                            <h3>PS</h3>
                            <div>
                              <?php
                                if(isset($_GET['data'])){
                                  if($_GET['data'] == "semua"){
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'PS'"));
                                  }else{
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'PS' AND kd_project LIKE '%$_GET[data]'"));
                                  }
                                }else{
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'PS'"));
                                }
                              ?>
                              Project
                            </div>
                          </div>
                          <div class="col-5">
                              <img src="../../dist/img/logo/PS - white.png" width="90%">
                          </div>
                        </div>
                      </div>
                      <a href="#" class="small-box-footer">
                        <b>
                          <?php
                            if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'PS'"));
                                }else{
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'PS' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'PS'"));
                              }
                            echo rupiah($nilaiProject['TotalProject']);
                          ?>   
                        </b>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <div class="row">
                          <div class="col-7">
                            <h3>REKA</h3>
                            <div>
                              <?php
                                if(isset($_GET['data'])){
                                  if($_GET['data'] == "semua"){
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'REKA'"));
                                  }else{
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'REKA' AND kd_project LIKE '%$_GET[data]'"));
                                  }
                                }else{
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'REKA'"));
                                }
                              ?>
                              Project
                            </div>
                          </div>
                          <div class="col-5">
                              <img src="../../dist/img/logo/REKA - white.png" width="90%">
                          </div>
                        </div>
                      </div>
                      <a href="#" class="small-box-footer">
                        <b>
                          <?php
                            if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'REKA'"));
                                }else{
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'REKA' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan = 'REKA'"));
                              }
                            echo rupiah($nilaiProject['TotalProject']);
                          ?>   
                        </b>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                      <div class="inner">
                        <div class="row" style="padding-bottom: 6px;">
                          <div class="col-7">
                            <h3 style="font-size: 25px;">GLOBAL</h3>
                            <div>
                              <?php
                                if(isset($_GET['data'])){
                                  if($_GET['data'] == "semua"){
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan != 'REKA'"));
                                  }else{
                                    echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan != 'REKA' AND kd_project LIKE '%$_GET[data]'"));
                                  }
                                }else{
                                  echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM project WHERE kd_badan != 'REKA'"));
                                }
                              ?>
                              Project
                            </div>
                          </div>
                          <div class="col-5">
                              <img src="../../dist/img/logo/global - white.png" width="90%">
                          </div>
                        </div>
                      </div>
                      <a href="#" class="small-box-footer">
                        <b>
                          <?php
                            if(isset($_GET['data'])){
                                if($_GET['data'] == "semua"){
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan != 'REKA'"));
                                }else{
                                  $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan != 'REKA' AND kd_project LIKE '%$_GET[data]'"));
                                }
                              }else{
                                $nilaiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai_project) AS TotalProject FROM project WHERE kd_badan != 'REKA'"));
                              }
                            echo rupiah($nilaiProject['TotalProject']);
                          ?>   
                        </b>
                      </a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped" style="font-size: 9px;">
                  <thead>
                  <tr>
                    <th width="1%">#</th>
                    <th>Kode Project</th>
                    <th>Kode Forecast</th>
                    <th>Nama Sales</th>
                    <th>Badan</th>
                    <th>Nama Project</th>
                    <th>No Tiket</th>
                    <th>No SPH</th>
                    <th>No SPK</th>
                    <th>Nama Customer</th>
                    <th>No Hp</th>
                    <th>Perusahaan</th>
                    <th>Kapasitas</th>
                    <th>Satuan</th>
                    <th>Jml Order</th>
                    <th>Satuan</th>
                    <th>Lokasi</th>
                    <th>Tipe Proyek</th>
                    <th>Start</th>
                    <th>Deadline</th>
                    <th>Nilai Proyek</th>
                    <th>HPP Barang</th>
                    <th>HPP Jasa</th>
                    <th>HPP Asset</th>
                    <th>PPN</th>
                    <th>Cashback</th>
                    <th>Remark</th>
                    <th>Created_at</th>
                    <?php if($_SESSION["role"] == "adm_marketing" || $_SESSION["role"] == "marketing_manager"){ ?>
                      <th>#</th>
                    <?php } ?>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(isset($_GET['data'])){
                        if($_GET['data'] == "semua"){
                          $q_listproject = mysqli_query($conn, "SELECT * FROM v_project ORDER BY created_at DESC");
                        }else{
                         $q_listproject = mysqli_query($conn, "SELECT * FROM v_project WHERE kd_project LIKE '%$_GET[data]' ORDER BY created_at DESC");
                        }
                      }else{
                        $q_listproject = mysqli_query($conn, "SELECT * FROM v_project ORDER BY created_at DESC");
                      }
                      
                      while($get_project = mysqli_fetch_array($q_listproject)){
                        $getProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_project[kd_project]'"));
                    ?>
                      <tr>
                        <td></td>
                        <td style="font-size: 12px;"><span class="badge badge-info"><?php echo $get_project['kd_project']; ?></span></td>
                        <td><?php echo $get_project['kd_forecast']; ?></td>
                        <td><?php echo $get_project['nama']; ?></td>
                        <td><?php echo $get_project['nama_badan']; ?></td>
                        <td><?php echo $get_project['nm_project']; ?></td>
                        <td><?php echo $get_project['no_ticket']; ?></td>
                        <td><?php echo $get_project['no_sph']; ?></td>
                        <td><?php echo $get_project['no_spk']; ?></td>
                        <td><?php echo $get_project['nm_customer']; ?></td>
                        <td><?php echo $get_project['nohp']; ?></td>
                        <td><?php echo $get_project['perusahaan']; ?></td>
                        <td><?php echo $get_project['kapasitas']; ?></td>
                        <td><?php echo $get_project['satuan_kapasitas']; ?></td>
                        <td><?php echo $get_project['jumlah_order']; ?></td>
                        <td><?php echo $get_project['satuan']; ?></td>
                        <td><?php echo $get_project['lokasi_project']; ?></td>
                        <td><?php echo $get_project['nm_kategori']; ?></td>
                        <td><?php echo $get_project['start']; ?></td>
                        <td><?php echo $get_project['deadline']; ?></td>
                        <td><?php echo rupiah($get_project['nilai_project']); ?></td>
                        <td><?php echo rupiah($getProject['hpp_barang']); ?></td>
                        <td><?php echo rupiah($getProject['hpp_jasa']); ?></td>
                        <td><?php echo rupiah($getProject['hpp_asset']); ?></td>
                        <td><?php echo $get_project['ppn']; ?></td>
                        <td><?php echo rupiah($get_project['cashback']); ?></td>
                        <td><?php echo $get_project['remark']; ?></td>
                        <td><?php echo $get_project['created_at']; ?></td>
                        <?php if($_SESSION["role"] == "adm_marketing" || $_SESSION["role"] == "marketing_manager"){ ?>  
                          <td>
                            <a href="#modal" data-toggle='modal' data-target='#show_edit_project' data-id='<?php echo $get_project['kd_project']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit Project">
                              <span class="fa fa-edit"></span> Edit
                            </a>
                            |
                            <a href="#modal" data-toggle='modal' data-target='#show_delete_project' data-id='<?php echo $get_project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete Project">
                              <span class="fa fa-trash"></span> Delete
                            </a>
                          </td>
                        <?php } ?>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_project" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Project</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-data"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_delete_project" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Project</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-data"></div>
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- Modal start here -->
  <div class="modal fade" id="show_update_activity" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Activity Forecast</h4>
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
  <div class="modal fade" id="show_history_activity" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">History Activity</h4>
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
  <div class="modal fade" id="show_edit_forecast" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Forecast</h4>
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
  <div class="modal fade" id="show_to_project" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Form To Project</h4>
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