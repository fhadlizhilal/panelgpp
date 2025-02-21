<?php
  if(isset($_POST['submit_pengajuan'])){
    if($_POST['submit_pengajuan'] == "submit"){
      if($_POST['kode_project'] == "non_project"){
        $push_pengajuan = mysqli_query($conn, "INSERT INTO asset_pengajuan VALUES('','$_POST[jenis_form]','$_POST[entitas_id]','$_POST[pelaksana]',NULL,'$_POST[tgl_pengajuan]',NULL,'$_POST[keterangan]','belum realisasi')");
      }else{
        $push_pengajuan = mysqli_query($conn, "INSERT INTO asset_pengajuan VALUES('','$_POST[jenis_form]','$_POST[entitas_id]','$_POST[pelaksana]','$_POST[kode_project]','$_POST[tgl_pengajuan]',NULL,'$_POST[keterangan]','belum realisasi')");
      }
      
      if($push_pengajuan){
        $last_id = $conn->insert_id;

        $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_db_general.jenis = '$_POST[jenis_form]'");
        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $post_qty = "qty_".$get_db_detail['detail_code'];
          $post_harga = "harga_satuan_".$get_db_detail['detail_code'];
          $_POST[$post_harga] = str_replace('.', '', $_POST[$post_harga]);
          $_POST[$post_qty] = str_replace('.', '', $_POST[$post_qty]);
          if($_POST[$post_qty] > 0){
            $push_pengajuan_detail = mysqli_query($conn, "INSERT INTO asset_pengajuan_detail VALUES('','$last_id','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga]')");
          }
        }

        $_SESSION['alert_success'] = 'Pengajuan Baru Berhasil Disimpan!';
      }else{
        $_SESSION['alert_error'] = 'Pengajuan Baru Gagal Disimpan! <br>'.mysqli_error($conn);
      }
    }
  }

  if(isset($_POST['submit_edit_pengajuan'])){
    if($_POST['submit_edit_pengajuan'] == "ubah"){
      
      if($_POST['kode_project'] == "non_project"){
        $edit_pengajuan = mysqli_query($conn, "UPDATE asset_pengajuan SET entitas_id = '$_POST[entitas_id]', kd_project = NULL, tgl_pengajuan = '$_POST[tgl_pengajuan]', keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'");
      }else{
        $edit_pengajuan = mysqli_query($conn, "UPDATE asset_pengajuan SET entitas_id = '$_POST[entitas_id]', kd_project = '$_POST[kode_project]', tgl_pengajuan = '$_POST[tgl_pengajuan]', keterangan = '$_POST[keterangan]' WHERE id = '$_POST[id]'");
      }

      if($edit_pengajuan){
        //delete data pengajuan detail
        $delete_pengajuan_detail = mysqli_query($conn, "DELETE FROM asset_pengajuan_detail WHERE pengajuan_id = '$_POST[id]'");

        //Input data pengajuan detail baru
        $q_get_db_detail = mysqli_query($conn, "SELECT * FROM asset_db_detail JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_db_general.jenis = '$_POST[jenis_form]'");
        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $post_qty = "qty_".$get_db_detail['detail_code'];
          $post_harga = "harga_satuan_".$get_db_detail['detail_code'];
          $_POST[$post_harga] = str_replace('.', '', $_POST[$post_harga]);
          if($_POST[$post_qty] > 0){
            $push_pengajuan_detail = mysqli_query($conn, "INSERT INTO asset_pengajuan_detail VALUES('','$_POST[id]','$get_db_detail[detail_code]','$_POST[$post_qty]','$_POST[$post_harga]')");
          }
        }

        if($_POST['status_old'] == "sudah realisasi"){
          echo "<meta http-equiv='refresh' content='0;url=index.php?pages=dbpengajuan'>";
          $_SESSION['alert_success'] = 'Pengajuan Berhasil Diubah!<br>Tunggu sampai halaman selesai diarahkan';
        }else{
          $_SESSION['alert_success'] = 'Pengajuan Berhasil Diubah!';
        }
        
      }else{

        if($_POST['status_old'] == "sudah realisasi"){
          echo "<meta http-equiv='refresh' content='0;url=index.php?pages=dbpengajuan'>";
          $_SESSION['alert_danger'] = 'Pengajuan Gagal Diubah!';
        }else{
          $_SESSION['alert_danger'] = 'Pengajuan Gagal Diubah!';
        }
        
      }
      
    }
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Pengajuan Belum Realisasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengajuan Belum Realisasi</li>
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
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="10%">No Pengajuan</th>
                      <th width="1%">Jenis</th>
                      <th>Entitas</th>
                      <th width="12%">Pelaksana</th>
                      <th>Project</th>
                      <th width="13%">Tanggal Pengajuan</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $q_get_pengajuan = mysqli_query($conn, "SELECT * FROM asset_pengajuan WHERE status = 'belum realisasi' ORDER BY id DESC");
                      while($get_pengajuan = mysqli_fetch_array($q_get_pengajuan)){
                        $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_pengajuan[entitas_id]'"));
                        $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengajuan[pelaksana]'"));
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_pengajuan[kd_project]'"));
                    ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" style="font-weight: bold;" data-toggle='modal' data-target='#show_fu_pengajuan_asset' data-id='<?php echo $get_pengajuan['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Followup Peminjaman">
                            <?php echo "PN".$get_pengajuan['id']."/".date("m/Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?>
                          </a>
                        </td>
                        <td>
                          <?php if($get_pengajuan['jenis'] == "tools"){ ?>
                            <span class="badge badge-info">Tools</span>
                          <?php }elseif($get_pengajuan['jenis'] == "apd"){ ?>
                            <span class="badge badge-success">APD</span>
                          <?php }elseif($get_pengajuan['jenis'] == "inventaris"){ ?>
                            <span class="badge badge-warning">Inventaris</span>
                          <?php }elseif($get_pengajuan['jenis'] == "alat ukur"){ ?>
                            <span class="badge badge-danger">Alat Ukur</span>
                          <?php } ?>
                        </td>
                        <td><?php echo $get_entitas['entitas']; ?></td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td>
                          <?php
                            if($get_project['nm_project'] == NULL){
                              echo "Non Project";
                            }else{
                              echo $get_pengajuan['kd_project']." - ".$get_project['nm_project'];
                            }
                          ?> 
                        </td>
                        <td><?php echo date("d F Y", strtotime($get_pengajuan['tgl_pengajuan'])); ?></td>
                        <td><?php echo $get_pengajuan['keterangan']; ?></td>
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
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_fu_pengajuan_asset" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="modal-data"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>