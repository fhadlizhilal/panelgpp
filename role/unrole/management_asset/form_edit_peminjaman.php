<?php
  $get_peminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE id = '$_GET[id]'"));
  $jenis_form = $get_peminjaman['jenis'];
  $judul = ucwords($get_peminjaman['jenis']);

  $total_tools = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_db_general WHERE jenis = '$jenis_form'"));
  $jml_tools1 = $total_tools/2;
  $jml_tools1 = ceil($jml_tools1);
  $jml_tools2 = $total_tools - $jml_tools1;
  
?>

<!-- Content Wrapper. Contains page content -->
  <form id="myForm" method="POST" action="index.php?pages=peminjamansaya">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Form Edit Peminjaman <?php echo $judul; ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Form Peminjaman</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-body">
                  <table class="table table-sm" style="font-size: 11px">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tipe Barang</th>
                        <th>Qty</th>
                        <th>Satuan</th>
                        <th>Catatan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        $q_get_db_tools_general1 = mysqli_query($conn, "SELECT * FROM asset_db_general WHERE jenis = '$jenis_form' ORDER BY nama_barang ASC, tipe_barang ASC LIMIT $jml_tools1");
                        while($get_db_tools_general1 = mysqli_fetch_array($q_get_db_tools_general1)){
                          
                          $get_peminjaman_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman_detail WHERE peminjaman_id = '$_GET[id]' AND general_code = '$get_db_tools_general1[general_code]'"));
                      ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $get_db_tools_general1['nama_barang']; ?></td>
                              <td><?php echo $get_db_tools_general1['tipe_barang']; ?></td>
                              <td>
                                <input type="number" min="0" style="width: 40px;" name="<?php echo "qty_".$get_db_tools_general1['general_code']; ?>" value="<?php echo $get_peminjaman_detail['qty'] ?>">
                              </td>
                              <td><?php echo $get_db_tools_general1['satuan']; ?></td>
                              <td>
                                <input type="text" style="width: 100%" name="<?php echo "keterangan_".$get_db_tools_general1['general_code']; ?>" value="<?php echo $get_peminjaman_detail['keterangan'] ?>">
                              </td>
                            </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-body">
                  <table class="table table-sm" style="font-size: 11px">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Tipe Barang</th>
                        <th>Qty</th>
                        <th>Satuan</th>
                        <th>Catatan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $q_get_db_tools_general1 = mysqli_query($conn, "SELECT * FROM asset_db_general WHERE jenis = '$jenis_form' ORDER BY nama_barang ASC, tipe_barang ASC LIMIT $jml_tools2 OFFSET $jml_tools2");
                        while($get_db_tools_general1 = mysqli_fetch_array($q_get_db_tools_general1)){

                          $get_peminjaman_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman_detail WHERE peminjaman_id = '$_GET[id]' AND general_code = '$get_db_tools_general1[general_code]'"));
                      ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_db_tools_general1['nama_barang']; ?></td>
                            <td><?php echo $get_db_tools_general1['tipe_barang']; ?></td>
                            <td>
                              <input type="number" min="0" style="width: 40px;" name="<?php echo "qty_".$get_db_tools_general1['general_code']; ?>" value="<?php echo $get_peminjaman_detail['qty'] ?>">
                            </td>
                            <td><?php echo $get_db_tools_general1['satuan']; ?></td>
                            <td><input type="text" style="width: 100%" name="<?php echo "keterangan_".$get_db_tools_general1['general_code']; ?>" value="<?php echo $get_peminjaman_detail['keterangan'] ?>"></td>
                          </tr>
                      <?php $no++; } ?>
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

          <!----------------------------------------- ROW ------------------------------------------>
          
          <div class="row">
            <div class="col-lg-8 col-12">
              <div class="card">
                <div class="card-body">
                  <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">INFORMASI PEMINJAMAN</div>
                  
                    <table class="table table-sm" style="font-size: 12px; margin-bottom: 10px;">
                      <tr>
                        <td width="20%">Nama Peminjam</td>
                        <td width="1%">:</td>
                        <td>
                          <input type="hidden" name="peminjam" value="<?php echo $_SESSION['nik']; ?>">
                          <?php echo $_SESSION['nama'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td width="20%">Jenis Peminjaman</td>
                        <td width="1%">:</td>
                        <td>
                          <?php if($jenis_form == "tools"){ ?>
                            <span class="badge badge-info">Tools</span>
                          <?php }elseif($jenis_form == "apd"){ ?>
                            <span class="badge badge-success">APD</span>
                          <?php }elseif($jenis_form == "inventaris"){ ?>
                            <span class="badge badge-warning">Inventaris</span>
                          <?php }elseif($jenis_form == "alat ukur"){ ?>
                            <span class="badge badge-danger">Alat Ukur</span>
                          <?php } ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Tanggal Pinjam</td>
                        <td>:</td>
                        <td><?php echo date("d F Y H:i:s", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
                      </tr>
                      <tr>
                        <td>Project</td>
                        <td>:</td>
                        <td>
                          <select class="" style="width: 100%" name="kode_project" required>
                            <option value="" selected disabled>--- Pilih Project ---</option>
                            <option value="non_project" <?php if($get_peminjaman['kd_project'] == NULL){ echo "selected"; } ?>>Non-Project</option>
                            <option value="" disabled>--------------- GPP ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPP' ORDER BY kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                            <option value="" disabled>--------------- GPS ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPS' ORDER BY kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                            <option value="" disabled>--------------- GPW ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GPW' ORDER BY kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                            <option value="" disabled>--------------- GSS ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'GSS' ORDER BY kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                            <option value="" disabled>--------------- SI ------------------</option>
                            <?php
                              $q_get_project = mysqli_query($conn, "SELECT * FROM project WHERE kd_badan = 'SI' ORDER BY kd_project DESC");
                              while($get_project = mysqli_fetch_array($q_get_project)){
                            ?>
                                <option value="<?php echo $get_project['kd_project']; ?>" <?php if($get_peminjaman['kd_project'] == $get_project['kd_project']){ echo "selected"; } ?>><?php echo $get_project['kd_project']." - ".$get_project['nm_project']; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                        <td>Keterangan Pinjam</td>
                        <td>:</td>
                        <td><input type="text" style="width: 100%" name="keterangan_pinjam" placeholder="Isi keterangan peminjaman disini" value="<?php echo $get_peminjaman['keterangan']; ?>" required></td>
                      </tr>
                    </table>
                    <center>
                      <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                      <input type="hidden" name="jenis_form" value="<?php echo $jenis_form; ?>">
                      <?php if($get_peminjaman['status'] == "waiting for MA"){ ?>
                        <button type="submit" class="btn btn-info btn-sm" name="update_peminjaman" value="update">
                          <span class="fa fa-save"></span> Update Peminjaman
                        </button>
                      <?php }else{ ?>
                        <button type="submit" class="btn btn-success btn-sm" name="update_peminjaman" value="submit">
                          <span class="fa fa-upload"></span> Submit Peminjaman
                        </button>
                      <?php } ?>
                    </center>
                  
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-12">
              <div class="card">
                <div class="card-body" style="text-align: center;">
                  <img src="../../dist/img/logo/gpp-logo.png" width="30%" style="margin-bottom: 30px;">
                  <div><b>FORM PEMINJAMAN <?php echo strtoupper($judul); ?></b></div>
                  <div style="margin-bottom: 15px"><b>PT GLOBAL PRATAMA POWERINDO</b></div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </form>

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>