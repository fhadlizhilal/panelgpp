<?php
  session_start();
  require_once "../../dev/config.php";

  $get_toolsPeminjaman_info = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_peminjaman_info WHERE nik = '$_SESSION[nik]'"));
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Peminjaman Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Peminjaman Baru</li>
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
            <!-- form start -->
            <form class="form-horizontal" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=add-peminjaman" method="POST">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Info Peminjaman</h3>
                </div>
              
                <div class="card-body">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nik Peminjam</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" value="<?php echo $_SESSION['nik']." - ".$_SESSION['nama']; ?>" disabled>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Project</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="kd_project" required>
                        <option value="" selected disabled>--- Pilih Project ---</option>
                        <option value="NON-PROJECT" <?php if($get_toolsPeminjaman_info['kode_project'] == "NON-PROJECT"){ echo "selected"; } ?>>NON-PROJECT</option>
                        <option value="" disabled>--------------------</option>
                        <?php
                          $q_project = mysqli_query($conn, "SELECT * FROM project");
                          while($get_project = mysqli_fetch_array($q_project)){ 
                        ?>
                          <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_toolsPeminjaman_info['kode_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Deskripsi Peminjaman</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="deskripsi" required><?php echo $get_toolsPeminjaman_info['deskripsi']; ?></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Detail Peminjaman Tools</h3>
                </div>
                <!-- /.card-header -->
              
                <div class="card-body p-0">
                  <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <table class="table table-sm table-striped" style="font-size: 10px;">
                        <thead>
                          <tr>
                            <th width="1%">No</th>
                            <th>Nama Tools</th>
                            <th>Jenis Tools</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Catatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no=0;
                            $count_dataTools = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tools_db"));
                            $mod = $count_dataTools % 2;
                            if($mod > 0){
                              $limit_1 = ($count_dataTools/2) + 0.5;
                            }else{
                              $limit_1 = ($count_dataTools/2);
                            }

                            $q_getTools = mysqli_query($conn,"SELECT * FROM tools_db ORDER BY nama_tools ASC LIMIT $limit_1");
                            while($getTools = mysqli_fetch_array($q_getTools)){
                              $get_toolsDetail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_peminjaman_tmp WHERE nik = '$_SESSION[nik]' AND id_tools = '$getTools[id_tools]'"));
                              $no++;
                          ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $getTools['nama_tools']; ?></td>
                              <td><?php echo $getTools['jenis_tools']; ?></td>
                              <td>
                                <input type="hidden" name="<?php echo "id_tools_".$no ?>" value="<?php echo $getTools['id_tools']; ?>">
                                <input type="number" min="0" name="<?php echo "qty_".$no; ?>" value="<?php echo $get_toolsDetail['qty']; ?>" style="width: 60px;">
                              </td>
                              <td><?php echo $getTools['satuan']; ?></td>
                              <td><input type="text" name="<?php echo "catatan_".$no; ?>" value="<?php echo $get_toolsDetail['catatan']; ?>" style="width: 80px;"></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-sm-12 col-md-6">
                      <table class="table table-sm table-striped" style="font-size: 10px;">
                        <thead>
                          <tr>
                            <th width="1%">No</th>
                            <th>Nama Tools</th>
                            <th>Jenis Tools</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Catatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $count_dataTools = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tools_db"));
                            $start_1 = $limit_1;
                            $limit_2 = $count_dataTools - $limit_1;

                            $q_getTools = mysqli_query($conn,"SELECT * FROM tools_db ORDER BY nama_tools ASC LIMIT $start_1, $limit_2");
                            while($getTools = mysqli_fetch_array($q_getTools)){
                              $get_toolsDetail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_peminjaman_tmp WHERE nik = '$_SESSION[nik]' AND id_tools = '$getTools[id_tools]'"));
                              $no++;
                          ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $getTools['nama_tools']; ?></td>
                              <td><?php echo $getTools['jenis_tools']; ?></td>
                              <td>
                                <input type="hidden" name="<?php echo "id_tools_".$no ?>" value="<?php echo $getTools['id_tools']; ?>">
                                <input type="number" min="0" name="<?php echo "qty_".$no; ?>" value="<?php echo $get_toolsDetail['qty']; ?>" style="width: 60px;">
                              </td>
                              <td><?php echo $getTools['satuan']; ?></td>
                              <td><input type="text" name="<?php echo "catatan_".$no; ?>" value="<?php echo $get_toolsDetail['catatan']; ?>" style="width: 80px;"></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" align="center">
                  <input type="hidden" name="data_max" value="<?php echo $no; ?>">
                  <input type="hidden" name="no_pinjam" value="<?php echo $id; ?>">
                  <input type="submit" class="btn btn-success" name="submit_peminjaman_tools" value="Ajukan">
                  <input type="submit" class="btn btn-info" name="simpan_peminjaman_tools" value="Simpan">
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </form>
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