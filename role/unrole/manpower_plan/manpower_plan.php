<?php
  $get_manpowerplan_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower_planlist WHERE id = '$_GET[id]'"));

  if(isset($_POST['edit_list_manpowerplan'])){
    if($_POST['edit_list_manpowerplan'] == "Simpan"){
      mysqli_query($conn, "DELETE FROM hse_manpower_plan WHERE planlist_id = '$_POST[planlist_id]'");

      $jml_data = count($_POST['check']);
      $check = $_POST['check'];
      $posisi_kerja = $_POST['posisi_kerja'];

      for($i=0;$i<$jml_data;$i++){
        $push_manpowerplan = mysqli_query($conn, "INSERT INTO hse_manpower_plan VALUES('','$_POST[planlist_id]','$check[$i]','$posisi_kerja[$i]')");
      }

      $_SESSION['alert_success'] = "Berhasil! Manpower Plan List Berhasil Diubah";
    }
  }

  if(isset($_POST['delete_manpowerplan'])){
    if($_POST['delete_manpowerplan'] == "Delete"){
      $delete_manpowerplan = mysqli_query($conn, "DELETE FROM hse_manpower_plan WHERE planlist_id = '$_POST[id]'");
      if($delete_manpowerplan){
          $delete_manpowerplan_list = mysqli_query($conn, "DELETE FROM hse_manpower_planlist WHERE id = '$_POST[id]'");
          if($delete_manpowerplan_list){
            $_SESSION['alert_success'] = "Berhasil! Manpower Plan List Berhasil Dihapus ".$_POST['planlist_id'];
            echo "<meta http-equiv='refresh' content='0;url=index.php?pages=manpowerplan_list'>";
          }else{
            $_SESSION['alert_error'] = "Gagal! Manpower Plan List Gagal Dihapus [1]";

          }
      }else{
        $_SESSION['alert_error'] = "Gagal! Manpower Plan List Gagal Dihapus [2]";
      }
    }
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid card">
        
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table width="100%">
                  <tr>
                    <td><img src="../../dist/img/kop_gpp.png" width="200px"></td>
                    <td align="right"><img src="../../dist/img/alamat_gpp.jpg" width="250px"></td>
                  </tr>
                </table>

                <br>
                <center><h5 style="margin-bottom: -2px">LIST MANPOWER PLAN</h5><?php echo $get_manpowerplan_list['nama_project']; ?></center>
                <br>

                <table class="table table-sm table-bordered table-head-fixed" style="margin-top: 10px;">
                  <thead>
                    <tr style="font-size: 12px">
                      <th width="1%">No</th>
                      <th>Nama / TTL</th>
                      <th width="10%">NIK</th>
                      <th width="10%">No HP</th>
                      <th>Alamat Lengkap</th>
                      <th>Posisi Kerja</th>
                      <th width="10%">Sertifikasi</th>
                      <th width="15%">KTP</th>
                      <th width="15%">Foto Diri</th>
                    </tr>
                  </thead>
                  <tbody style="font-size: 12px">
                    <!-- ------------------------------- PROJECT MANAGER ------------------------------- -->
                    <?php
                      $no=1;
                      $q_getmanpowerPlan = mysqli_query($conn, "SELECT * FROM hse_manpower_plan WHERE planlist_id = '$_GET[id]' AND posisi_kerja = 'Project Manager'");
                      $jml_data = mysqli_num_rows($q_getmanpowerPlan);

                      if($jml_data < 1){
                        echo "<tr>
                        <td colspan='9'><center><i>Belum ada list data</i></center></td>
                        </tr>";
                      }

                      while($get_manpowerPlan = mysqli_fetch_array($q_getmanpowerPlan)){
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_manpowerPlan[manpower_id]'"));
                    ?>
                      <tr>
                        <td style="vertical-align: middle;"><center><?php echo $no; ?></center></td>
                        <td style="vertical-align: middle;">
                          <?php echo $get_manpower['nama']."<br><small>".$get_manpower['tempat_lahir']."/".$get_manpower['tgl_lahir']."</small>"; ?>
                        </td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['nik']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['no_telpon']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['alamat']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpowerPlan['posisi_kerja']; ?></td>
                        <td style="vertical-align: middle;">
                          <ul style='margin-left: -20px'>
                          <?php 
                            $q_getSertifikasi = mysqli_query($conn, "SELECT * FROM hse_sertifikasi WHERE hse_manpower_id = '$get_manpower[id]'");
                            while($get_sertifikasi = mysqli_fetch_array($q_getSertifikasi)){
                              $get_sertifikat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_sertifikat WHERE id = '$get_sertifikasi[sertifikat_id]'"));
                              echo "<li>".$get_sertifikat['nama_sertifikat']."</li>";
                            }
                          ?>
                          </ul>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['ktp'] <> ""){ ?>
                            <center><img src="foto_ktp/<?php echo $get_manpower['ktp']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['foto'] <> ""){ ?>
                            <center><img src="foto_manpower/<?php echo $get_manpower['foto']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php $no++; } ?>

                    <!-- -------------------------- SITE MANAGER ------------------------------- -->
                    <?php
                      $q_getmanpowerPlan = mysqli_query($conn, "SELECT * FROM hse_manpower_plan WHERE planlist_id = '$_GET[id]' AND posisi_kerja = 'Site Manager'");
                      $jml_data = mysqli_num_rows($q_getmanpowerPlan);

                      while($get_manpowerPlan = mysqli_fetch_array($q_getmanpowerPlan)){
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_manpowerPlan[manpower_id]'"));
                    ?>
                      <tr>
                        <td style="vertical-align: middle;"><center><?php echo $no; ?></center></td>
                        <td style="vertical-align: middle;">
                          <?php echo $get_manpower['nama']."<br><small>".$get_manpower['tempat_lahir']."/".$get_manpower['tgl_lahir']."</small>"; ?>
                        </td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['nik']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['no_telpon']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['alamat']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpowerPlan['posisi_kerja']; ?></td>
                        <td style="vertical-align: middle;">
                          <ul style='margin-left: -20px'>
                          <?php 
                            $q_getSertifikasi = mysqli_query($conn, "SELECT * FROM hse_sertifikasi WHERE hse_manpower_id = '$get_manpower[id]'");
                            while($get_sertifikasi = mysqli_fetch_array($q_getSertifikasi)){
                              $get_sertifikat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_sertifikat WHERE id = '$get_sertifikasi[sertifikat_id]'"));
                              echo "<li>".$get_sertifikat['nama_sertifikat']."</li>";
                            }
                          ?>
                          </ul>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['ktp'] <> ""){ ?>
                            <center><img src="foto_ktp/<?php echo $get_manpower['ktp']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['foto'] <> ""){ ?>
                            <center><img src="foto_manpower/<?php echo $get_manpower['foto']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php $no++; } ?>

                    <!-- -------------------------- HSE ------------------------------- -->
                    <?php
                      $q_getmanpowerPlan = mysqli_query($conn, "SELECT * FROM hse_manpower_plan WHERE planlist_id = '$_GET[id]' AND posisi_kerja = 'HSE'");
                      $jml_data = mysqli_num_rows($q_getmanpowerPlan);

                      while($get_manpowerPlan = mysqli_fetch_array($q_getmanpowerPlan)){
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_manpowerPlan[manpower_id]'"));
                    ?>
                      <tr>
                        <td style="vertical-align: middle;"><center><?php echo $no; ?></center></td>
                        <td style="vertical-align: middle;">
                          <?php echo $get_manpower['nama']."<br><small>".$get_manpower['tempat_lahir']."/".$get_manpower['tgl_lahir']."</small>"; ?>
                        </td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['nik']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['no_telpon']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['alamat']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpowerPlan['posisi_kerja']; ?></td>
                        <td style="vertical-align: middle;">
                          <ul style='margin-left: -20px'>
                          <?php 
                            $q_getSertifikasi = mysqli_query($conn, "SELECT * FROM hse_sertifikasi WHERE hse_manpower_id = '$get_manpower[id]'");
                            while($get_sertifikasi = mysqli_fetch_array($q_getSertifikasi)){
                              $get_sertifikat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_sertifikat WHERE id = '$get_sertifikasi[sertifikat_id]'"));
                              echo "<li>".$get_sertifikat['nama_sertifikat']."</li>";
                            }
                          ?>
                          </ul>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['ktp'] <> ""){ ?>
                            <center><img src="foto_ktp/<?php echo $get_manpower['ktp']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['foto'] <> ""){ ?>
                            <center><img src="foto_manpower/<?php echo $get_manpower['foto']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php $no++; } ?>

                    <!-- -------------------------- Project Engineer ------------------------------- -->
                    <?php
                      $q_getmanpowerPlan = mysqli_query($conn, "SELECT * FROM hse_manpower_plan WHERE planlist_id = '$_GET[id]' AND posisi_kerja = 'Project Engineer'");
                      $jml_data = mysqli_num_rows($q_getmanpowerPlan);

                      while($get_manpowerPlan = mysqli_fetch_array($q_getmanpowerPlan)){
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_manpowerPlan[manpower_id]'"));
                    ?>
                      <tr>
                        <td style="vertical-align: middle;"><center><?php echo $no; ?></center></td>
                        <td style="vertical-align: middle;">
                          <?php echo $get_manpower['nama']."<br><small>".$get_manpower['tempat_lahir']."/".$get_manpower['tgl_lahir']."</small>"; ?>
                        </td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['nik']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['no_telpon']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['alamat']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpowerPlan['posisi_kerja']; ?></td>
                        <td style="vertical-align: middle;">
                          <ul style='margin-left: -20px'>
                          <?php 
                            $q_getSertifikasi = mysqli_query($conn, "SELECT * FROM hse_sertifikasi WHERE hse_manpower_id = '$get_manpower[id]'");
                            while($get_sertifikasi = mysqli_fetch_array($q_getSertifikasi)){
                              $get_sertifikat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_sertifikat WHERE id = '$get_sertifikasi[sertifikat_id]'"));
                              echo "<li>".$get_sertifikat['nama_sertifikat']."</li>";
                            }
                          ?>
                          </ul>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['ktp'] <> ""){ ?>
                            <center><img src="foto_ktp/<?php echo $get_manpower['ktp']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['foto'] <> ""){ ?>
                            <center><img src="foto_manpower/<?php echo $get_manpower['foto']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php $no++; } ?>

                    <!-- -------------------------- Supervisor ------------------------------- -->
                    <?php
                      $q_getmanpowerPlan = mysqli_query($conn, "SELECT * FROM hse_manpower_plan WHERE planlist_id = '$_GET[id]' AND posisi_kerja = 'Supervisor'");
                      $jml_data = mysqli_num_rows($q_getmanpowerPlan);

                      while($get_manpowerPlan = mysqli_fetch_array($q_getmanpowerPlan)){
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_manpowerPlan[manpower_id]'"));
                    ?>
                      <tr>
                        <td style="vertical-align: middle;"><center><?php echo $no; ?></center></td>
                        <td style="vertical-align: middle;">
                          <?php echo $get_manpower['nama']."<br><small>".$get_manpower['tempat_lahir']."/".$get_manpower['tgl_lahir']."</small>"; ?>
                        </td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['nik']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['no_telpon']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['alamat']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpowerPlan['posisi_kerja']; ?></td>
                        <td style="vertical-align: middle;">
                          <ul style='margin-left: -20px'>
                          <?php 
                            $q_getSertifikasi = mysqli_query($conn, "SELECT * FROM hse_sertifikasi WHERE hse_manpower_id = '$get_manpower[id]'");
                            while($get_sertifikasi = mysqli_fetch_array($q_getSertifikasi)){
                              $get_sertifikat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_sertifikat WHERE id = '$get_sertifikasi[sertifikat_id]'"));
                              echo "<li>".$get_sertifikat['nama_sertifikat']."</li>";
                            }
                          ?>
                          </ul>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['ktp'] <> ""){ ?>
                            <center><img src="foto_ktp/<?php echo $get_manpower['ktp']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['foto'] <> ""){ ?>
                            <center><img src="foto_manpower/<?php echo $get_manpower['foto']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php $no++; } ?>

                    <!-- -------------------------- Teknisi ------------------------------- -->
                    <?php
                      $q_getmanpowerPlan = mysqli_query($conn, "SELECT * FROM hse_manpower_plan WHERE planlist_id = '$_GET[id]' AND posisi_kerja = 'Teknisi'");
                      $jml_data = mysqli_num_rows($q_getmanpowerPlan);

                      while($get_manpowerPlan = mysqli_fetch_array($q_getmanpowerPlan)){
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_manpowerPlan[manpower_id]'"));
                    ?>
                      <tr>
                        <td style="vertical-align: middle;"><center><?php echo $no; ?></center></td>
                        <td style="vertical-align: middle;">
                          <?php echo $get_manpower['nama']."<br><small>".$get_manpower['tempat_lahir']."/".$get_manpower['tgl_lahir']."</small>"; ?>
                        </td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['nik']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['no_telpon']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['alamat']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpowerPlan['posisi_kerja']; ?></td>
                        <td style="vertical-align: middle;">
                          <ul style='margin-left: -20px'>
                          <?php 
                            $q_getSertifikasi = mysqli_query($conn, "SELECT * FROM hse_sertifikasi WHERE hse_manpower_id = '$get_manpower[id]'");
                            while($get_sertifikasi = mysqli_fetch_array($q_getSertifikasi)){
                              $get_sertifikat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_sertifikat WHERE id = '$get_sertifikasi[sertifikat_id]'"));
                              echo "<li>".$get_sertifikat['nama_sertifikat']."</li>";
                            }
                          ?>
                          </ul>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['ktp'] <> ""){ ?>
                            <center><img src="foto_ktp/<?php echo $get_manpower['ktp']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['foto'] <> ""){ ?>
                            <center><img src="foto_manpower/<?php echo $get_manpower['foto']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php $no++; } ?>

                    <!-- -------------------------- Helper ------------------------------- -->
                    <?php
                      $q_getmanpowerPlan = mysqli_query($conn, "SELECT * FROM hse_manpower_plan WHERE planlist_id = '$_GET[id]' AND posisi_kerja = 'Helper'");
                      $jml_data = mysqli_num_rows($q_getmanpowerPlan);

                      while($get_manpowerPlan = mysqli_fetch_array($q_getmanpowerPlan)){
                        $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_manpowerPlan[manpower_id]'"));
                    ?>
                      <tr>
                        <td style="vertical-align: middle;"><center><?php echo $no; ?></center></td>
                        <td style="vertical-align: middle;">
                          <?php echo $get_manpower['nama']."<br><small>".$get_manpower['tempat_lahir']."/".$get_manpower['tgl_lahir']."</small>"; ?>
                        </td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['nik']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['no_telpon']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpower['alamat']; ?></td>
                        <td style="vertical-align: middle;"><?php echo $get_manpowerPlan['posisi_kerja']; ?></td>
                        <td style="vertical-align: middle;">
                          <ul style='margin-left: -20px'>
                          <?php 
                            $q_getSertifikasi = mysqli_query($conn, "SELECT * FROM hse_sertifikasi WHERE hse_manpower_id = '$get_manpower[id]'");
                            while($get_sertifikasi = mysqli_fetch_array($q_getSertifikasi)){
                              $get_sertifikat = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_sertifikat WHERE id = '$get_sertifikasi[sertifikat_id]'"));
                              echo "<li>".$get_sertifikat['nama_sertifikat']."</li>";
                            }
                          ?>
                          </ul>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['ktp'] <> ""){ ?>
                            <center><img src="foto_ktp/<?php echo $get_manpower['ktp']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_manpower['foto'] <> ""){ ?>
                            <center><img src="foto_manpower/<?php echo $get_manpower['foto']; ?>" height="100px"></center>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php $no++; } ?>
                  </tbody>
                </table>

                <br>
                <center>
                  <form method="POST" action="">
                    <a href="#modal" data-toggle='modal' data-target='#show_editlist_manpowerPlan' data-id='<?php echo $_GET['kd']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit">
                      <button class="btn btn-info btn-md no-print"><span class="fa fa-edit"></span> Edit List</button>
                    </a>
                    <div class="btn btn-secondary btn-md no-print" onclick="window.print()"><span class="fa fa-print"></span> Simpan</div>

                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <input type="submit" class="btn btn-md btn-danger" name="delete_manpowerplan" value="Delete" onclick="return confirm('Yakin ingin menghapus list manpower plan ini?')">
                  </form>
                </center>
                <br>
                
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
  <div class="modal fade" id="show_editlist_manpowerPlan" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">List Manpower Plan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- <div class="modal-data"></div> -->
            <form method="POST" action="">
              <table id="cc1" class="table table-striped table-sm text-nowrap" style="font-size: 12px">
                <thead>
                  <tr>
                    <th width="1%">No</th>
                    <th>Nama</th>
                    <th>Posisi Kerja</th>
                    <th width="1%">#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no=1;
                    $q_get_manpower = mysqli_query($conn, "SELECT * FROM hse_manpower ORDER BY nama ASC");
                    while($get_manpower = mysqli_fetch_array($q_get_manpower)){
                      $cek_manpowerPlan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower_plan WHERE manpower_id = '$get_manpower[id]' AND planlist_id = '$_GET[id]'"));
                  ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $get_manpower['nama']; ?></td>
                      <td>
                        <select name="posisi_kerja[]" style="width: 100%">
                          <option value="" selected disabled>--- Posisi Kerja ---</option>
                          <option value="Project Manager" <?php if($cek_manpowerPlan['posisi_kerja'] == 'Project Manager'){ echo "selected"; } ?>>Project Manager</option>
                          <option value="Site Manager" <?php if($cek_manpowerPlan['posisi_kerja'] == 'Site Manager'){ echo "selected"; } ?>>Site Manager</option>
                          <option value="HSE" <?php if($cek_manpowerPlan['posisi_kerja'] == 'HSE'){ echo "selected"; } ?>>HSE</option>
                          <option value="Project Engineer" <?php if($cek_manpowerPlan['posisi_kerja'] == 'Project Engineer'){ echo "selected"; } ?>>Project Engineer</option>
                          <option value="Supervisor" <?php if($cek_manpowerPlan['posisi_kerja'] == 'Supervisor'){ echo "selected"; } ?>>Supervisor</option>
                          <option value="Teknisi" <?php if($cek_manpowerPlan['posisi_kerja'] == 'Teknisi'){ echo "selected"; } ?>>Teknisi</option>
                          <option value="Helper" <?php if($cek_manpowerPlan['posisi_kerja'] == 'Helper'){ echo "selected"; } ?>>Helper</option>
                        </select>
                      </td>
                      <td>
                        <input type="checkbox" name="check[]" value="<?php echo $get_manpower['id']; ?>">
                      </td>
                    </tr>
                  <?php $no++; } ?>
                </tbody>
              </table>
              <br>
              <input type="hidden" name="planlist_id" value="<?php echo $_GET['id']; ?>">
              <center><input type="submit" class="btn btn-success btn-sm" name="edit_list_manpowerplan" value="Simpan"></center>
            </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->