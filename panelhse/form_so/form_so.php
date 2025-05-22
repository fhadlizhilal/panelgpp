<?php
  date_default_timezone_set('Asia/Jakarta');
  $submitted_at = date("Y-m-d H:i:s");
  $get_so_site = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_stockopname_site WHERE id = '$_GET[id]'"));

  if($get_so_site['status'] == "closed" || $get_so_site['status'] == "completed"){
    header("location:page_closed.php");
  }

  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_so_site[kd_project]'"));

  if(isset($_POST['simpan_so'])){
    if($_POST['simpan_so'] == "Simpan"){
      $delete_data_so = mysqli_query($conn, "DELETE FROM asset_stockopname_site_detail WHERE id_so_site = '$_POST[id]'");
      $id = $_POST['id'];

      if($delete_data_so){
        $data_berhasil = 0;
        $data_gagal = 0;
        $q_get_db_detail = mysqli_query($conn, "SELECT detail_code FROM asset_db_detail");

        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $data_baik = "baik_".$get_db_detail['detail_code'];
          $data_rusak = "rusak_".$get_db_detail['detail_code'];
          $data_hilang = "hilang_".$get_db_detail['detail_code'];

          if($_POST[$data_baik] > 0 || $_POST[$data_rusak] > 0 || $_POST[$data_hilang] > 0){
            $simpan_so = mysqli_query($conn, "INSERT INTO asset_stockopname_site_detail VALUES('','$id','$get_db_detail[detail_code]','$_POST[$data_baik]','$_POST[$data_rusak]','$_POST[$data_hilang]')");
            if($simpan_so){
              $data_berhasil++;
            }else{
              $data_gagal++;
            }
          }
        }
        //ubah status completed
        mysqli_query($conn, "UPDATE asset_stockopname_site SET pic = '$_POST[nama_pic]' WHERE id = '$id'");
        $_SESSION['alert_success'] = "Berhasil! Data Stock Opname Berhasil Disimpan!<br> Data Berhasil : ".$data_berhasil."<br>Data Gagal : ".$data_gagal;
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Stock Sebelumnya Bermasalah!";
      }
    }
  }

  if(isset($_POST['submit_so'])){
    if($_POST['submit_so'] == "Submit"){
      $delete_data_so = mysqli_query($conn, "DELETE FROM asset_stockopname_site_detail WHERE id_so_site = '$_POST[id]'");
      $id = $_POST['id'];

      if($delete_data_so){
        $data_berhasil = 0;
        $data_gagal = 0;
        $q_get_db_detail = mysqli_query($conn, "SELECT detail_code FROM asset_db_detail");

        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
          $data_baik = "baik_".$get_db_detail['detail_code'];
          $data_rusak = "rusak_".$get_db_detail['detail_code'];
          $data_hilang = "hilang_".$get_db_detail['detail_code'];

          if($_POST[$data_baik] > 0 || $_POST[$data_rusak] > 0 || $_POST[$data_hilang] > 0){
            $simpan_so = mysqli_query($conn, "INSERT INTO asset_stockopname_site_detail VALUES('','$id','$get_db_detail[detail_code]','$_POST[$data_baik]','$_POST[$data_rusak]','$_POST[$data_hilang]')");
            if($simpan_so){
              $data_berhasil++;
            }else{
              $data_gagal++;
            }
          }
        }
        //ubah status completed
        mysqli_query($conn, "UPDATE asset_stockopname_site SET pic = '$_POST[nama_pic]', status = 'completed', submitted_at = '$submitted_at' WHERE id = '$id'");
        header("Refresh: 1");
        exit;
      }else{
        $_SESSION['alert_error'] = "Gagal! Data Stock Sebelumnya Bermasalah!";
      }
    }
  }


  $get_so_site = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_stockopname_site WHERE id = '$_GET[id]'"));
?>

 <div class="" style="padding-left: 15px; padding-right: 15px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-1 col-0"></div>
          <div class="col-lg-10 col-12">
            <table class="table table-sm table-bordered">
              <tr>
                <td width="20%" align="center" style="vertical-align: middle;">
                  <img src="../../dist/img/logo/gpp-logo.png" style="width: 50px">
                </td>
                <td width="" align="center" style="vertical-align: middle;">
                  <h6>FORM STOCK OPNAME <br> PT GLOBAL PRATAMA POWERINDO</h6>
                </td>
                <td width="20%" align="center" style="vertical-align: middle;">
                  <img src="../../dist/img/logo/logo-k3-v2.png" style="width: 50px">
                </td>
              </tr>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row" style="margin-bottom: -50px;">
          <div class="col-lg-1 col-0"></div>
          <div class="col-lg-12 col-12">
            <form id="myForm" method="POST" action="">
              <table class="table table-sm table-striped" style="font-size: 12px">
                <tr>
                  <td colspan="3" align="center"><b>KETERANGAN PROJECT</b></td>
                </tr>
                <tr>
                  <td width="30%">Nama Project</td>
                  <td width="1%">:</td>
                  <td><?php echo $get_project['nm_project']; ?></td>
                </tr>
                <tr>
                  <td>Lokasi</td>
                  <td>:</td>
                  <td><?php echo $get_project['lokasi_project']; ?></td>
                </tr>
                <tr>
                  <td>Created_at</td>
                  <td>:</td>
                  <td><?php echo $get_so_site['created_at']; ?></td>
                </tr>
                <tr>
                  <td>Nama PIC</td>
                  <td>:</td>
                  <td><input type="text" name="nama_pic" value="<?php echo $get_so_site['pic']; ?>" required></td>
                </tr>
              </table>
            
              <div class="row">
                <div class="col-lg-6 col-12">
                  <table class="table table-sm table-striped table-head-fixed" style="font-size: 12px">
                    <tr>
                      <td colspan="8" align="center" style="vertical-align: middle;">
                        <b>
                          
                        </b>
                      </td>
                    </tr>
                    <thead>
                      <tr style="font-size: 8px">
                        <th width=""><b>Nama Barang</b></th>
                        <th width=""><b>Tipe Barang</b></th>
                        <th width=""><b>Tipe Detail</b></th>
                        <th width=""><b>Merek</b></th>
                        <th width=""><b>Baik</b></th>
                        <th width=""><b>Rusak</b></th>
                        <th width=""><b>Hilang</b></th>
                        <th width=""><b>Satuan</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $q_get_db_detail = mysqli_query($conn, "SELECT t1.detail_code, t2.nama_barang, t2.tipe_barang, t1.tipe_detail, t3.merek, t2.satuan FROM asset_db_detail t1 JOIN asset_db_general t2 ON t1.general_code_id = t2.id JOIN asset_db_merek t3 ON t1.merek_id = t3.id WHERE t2.jenis = 'Tools' ORDER BY nama_barang ASC");
                        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                          $get_so_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT baik, rusak, hilang FROM asset_stockopname_site_detail WHERE id_so_site = '$_GET[id]' AND detail_code = '$get_db_detail[detail_code]'"));
                      ?>
                        <tr style="font-size: 8px">
                          <td width="30%"><?php echo $get_db_detail['nama_barang']; ?></td>
                          <td width="30%"><?php echo $get_db_detail['tipe_barang']; ?></td>
                          <td width="30%"><?php echo $get_db_detail['tipe_detail']; ?></td>
                          <td width="30%"><?php echo $get_db_detail['merek']; ?></td>
                          <td width="30%"><input type="number" value="<?php echo $get_so_detail['baik']; ?>" name="baik_<?php echo $get_db_detail['detail_code']; ?>" style="width: 26px;"></td>
                          <td width="30%"><input type="number" value="<?php echo $get_so_detail['rusak']; ?>" name="rusak_<?php echo $get_db_detail['detail_code']; ?>" style="width: 26px;"></td>
                          <td width="30%"><input type="number" value="<?php echo $get_so_detail['hilang']; ?>" name="hilang_<?php echo $get_db_detail['detail_code']; ?>" style="width: 26px;"></td>
                          <td width="30%"><?php echo $get_db_detail['satuan']; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>


                <div class="col-lg-6 col-12">
                  <table class="table table-sm table-striped table-head-fixed" style="font-size: 12px">
                    <tr>
                      <td colspan="8" align="center" style="vertical-align: middle;">
                        <b>
                          FORM STOCK OPNAME - APD
                        </b>
                      </td>
                    </tr>
                    <thead>
                      <tr style="font-size: 8px">
                        <th width=""><b>Nama Barang</b></th>
                        <th width=""><b>Tipe Barang</b></th>
                        <th width=""><b>Tipe Detail</b></th>
                        <th width=""><b>Merek</b></th>
                        <th width=""><b>Baik</b></th>
                        <th width=""><b>Rusak</b></th>
                        <th width=""><b>Hilang</b></th>
                        <th width=""><b>Satuan</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $q_get_db_detail = mysqli_query($conn, "SELECT t1.detail_code, t2.nama_barang, t2.tipe_barang, t1.tipe_detail, t3.merek, t2.satuan FROM asset_db_detail t1 JOIN asset_db_general t2 ON t1.general_code_id = t2.id JOIN asset_db_merek t3 ON t1.merek_id = t3.id WHERE t2.jenis = 'APD' ORDER BY nama_barang ASC");
                        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                          $get_so_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT baik, rusak, hilang FROM asset_stockopname_site_detail WHERE id_so_site = '$_GET[id]' AND detail_code = '$get_db_detail[detail_code]'"));
                      ?>
                        <tr style="font-size: 8px">
                          <td width="30%"><?php echo $get_db_detail['nama_barang']; ?></td>
                          <td width="30%"><?php echo $get_db_detail['tipe_barang']; ?></td>
                          <td width="30%"><?php echo $get_db_detail['tipe_detail']; ?></td>
                          <td width="30%"><?php echo $get_db_detail['merek']; ?></td>
                          <td width="30%"><input type="number" value="<?php echo $get_so_detail['baik']; ?>" name="baik_<?php echo $get_db_detail['detail_code']; ?>" style="width: 26px;"></td>
                          <td width="30%"><input type="number" value="<?php echo $get_so_detail['rusak']; ?>" name="rusak_<?php echo $get_db_detail['detail_code']; ?>" style="width: 26px;"></td>
                          <td width="30%"><input type="number" value="<?php echo $get_so_detail['hilang']; ?>" name="hilang_<?php echo $get_db_detail['detail_code']; ?>" style="width: 26px;"></td>
                          <td width="30%"><?php echo $get_db_detail['satuan']; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>


                <div class="col-lg-6 col-12">
                  <table class="table table-sm table-striped table-head-fixed" style="font-size: 12px">
                    <tr>
                      <td colspan="8" align="center" style="vertical-align: middle;">
                        <b>
                          FORM STOCK OPNAME - INVENTARIS
                        </b>
                      </td>
                    </tr>
                    <thead>
                      <tr style="font-size: 8px">
                        <th width=""><b>Nama Barang</b></th>
                        <th width=""><b>Tipe Barang</b></th>
                        <th width=""><b>Tipe Detail</b></th>
                        <th width=""><b>Merek</b></th>
                        <th width=""><b>Baik</b></th>
                        <th width=""><b>Rusak</b></th>
                        <th width=""><b>Hilang</b></th>
                        <th width=""><b>Satuan</b></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $q_get_db_detail = mysqli_query($conn, "SELECT t1.detail_code, t2.nama_barang, t2.tipe_barang, t1.tipe_detail, t3.merek, t2.satuan FROM asset_db_detail t1 JOIN asset_db_general t2 ON t1.general_code_id = t2.id JOIN asset_db_merek t3 ON t1.merek_id = t3.id WHERE t2.jenis = 'Inventaris' ORDER BY nama_barang ASC");
                        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                          $get_so_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT baik, rusak, hilang FROM asset_stockopname_site_detail WHERE id_so_site = '$_GET[id]' AND detail_code = '$get_db_detail[detail_code]'"));
                      ?>
                        <tr style="font-size: 8px">
                          <td width="30%"><?php echo $get_db_detail['nama_barang']; ?></td>
                          <td width="30%"><?php echo $get_db_detail['tipe_barang']; ?></td>
                          <td width="30%"><?php echo $get_db_detail['tipe_detail']; ?></td>
                          <td width="30%"><?php echo $get_db_detail['merek']; ?></td>
                          <td width="30%"><input type="number" value="<?php echo $get_so_detail['baik']; ?>" name="baik_<?php echo $get_db_detail['detail_code']; ?>" style="width: 26px;"></td>
                          <td width="30%"><input type="number" value="<?php echo $get_so_detail['rusak']; ?>" name="rusak_<?php echo $get_db_detail['detail_code']; ?>" style="width: 26px;"></td>
                          <td width="30%"><input type="number" value="<?php echo $get_so_detail['hilang']; ?>" name="hilang_<?php echo $get_db_detail['detail_code']; ?>" style="width: 26px;"></td>
                          <td width="30%"><?php echo $get_db_detail['satuan']; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody> 
                  </table>
                </div>
              </div>

              <center>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <input type="submit" class="btn btn-info" name="simpan_so" value="Simpan">
                <input type="submit" class="btn btn-success" name="submit_so" value="Submit" onclick="return confirm('Yakin Data Stock Opname Sudah Lengkap?')">
              </center>
            </form>
            <br>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- Modal start here -->
  <div class="modal fade" id="show_edit_datapribadi" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Pribadi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm2" method="POST" action="" enctype="multipart/form-data" style="font-size: 10px;">
            <div class="modal-data"></div>
            <hr>
            <input type="submit" id="submitBtn" class="btn btn-info" name="edit_data_pribadi" value="Ubah">
          </form>
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