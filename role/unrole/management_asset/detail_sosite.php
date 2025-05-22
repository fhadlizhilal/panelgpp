<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_sosite = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_stockopname_site WHERE id = '$id'"));
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_sosite[kd_project]'"));
	}
?>
 <div class="">
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
                  <h6>DATA STOCK OPNAME <br> PT GLOBAL PRATAMA POWERINDO</h6>
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
          <div class="col-lg-10 col-12">
            <table class="table table-sm table-striped" style="font-size: 11px">
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
                <td width="30%">Nama PIC</td>
                <td width="1%">:</td>
                <td><?php echo $get_sosite['pic']; ?></td>
              </tr>
              <tr>
                <td>Created_at</td>
                <td>:</td>
                <td><?php echo $get_sosite['created_at']; ?></td>
              </tr>
              <tr>
                <td>Submitted_at</td>
                <td>:</td>
                <td><?php echo $get_sosite['submitted_at']; ?></td>
              </tr>
              <tr>
                <td>Status</td>
                <td>:</td>
                <td>
                	<?php if($get_sosite['status'] == "open"){ ?>
                		<span class="badge badge-info"><?php echo $get_sosite['status']; ?></span>
                	<?php }elseif($get_sosite['status'] == "completed"){ ?>
                		<span class="badge badge-success"><?php echo $get_sosite['status']; ?></span>
                	<?php }elseif($get_sosite['status'] == "closed"){ ?>
                		<span class="badge badge-danger"><?php echo $get_sosite['status']; ?></span>
                	<?php } ?>
                </td>
              </tr>
            </table>

            <form id="myForm" method="POST" action="">
              <div class="row">
                <div class="col-lg-12 col-12">
                  <table class="table table-sm table-striped" style="font-size: 11px">
                    <tr>
                      <td colspan="8" align="center" style="vertical-align: middle;">
                        <b>
                          DATA STOCK OPNAME - TOOLS
                        </b>
                      </td>
                    </tr>
                      <tr>
                        <th width=""><b>Nama Barang</b></th>
                        <th width=""><b>Tipe Barang</b></th>
                        <th width=""><b>Tipe Detail</b></th>
                        <th width=""><b>Merek</b></th>
                        <th width=""><b>Baik</b></th>
                        <th width=""><b>Rusak</b></th>
                        <th width=""><b>Hilang</b></th>
                        <th width=""><b>Satuan</b></th>
                      </tr>
                      <?php
                        $q_get_db_detail = mysqli_query($conn, "SELECT t1.detail_code, t2.nama_barang, t2.tipe_barang, t1.tipe_detail, t3.merek, t2.satuan FROM asset_db_detail t1 JOIN asset_db_general t2 ON t1.general_code_id = t2.id JOIN asset_db_merek t3 ON t1.merek_id = t3.id INNER JOIN asset_stockopname_site_detail t4 ON t1.detail_code = t4.detail_code JOIN asset_stockopname_site t5 ON t4.id_so_site = t5.id WHERE t5.kd_project = '$get_sosite[kd_project]' AND t2.jenis = 'Tools' ORDER BY nama_barang ASC");
                        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                        	$get_sosite_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT baik, rusak, hilang FROM asset_stockopname_site_detail WHERE detail_code = '$get_db_detail[detail_code]' AND id_so_site = '$id'"));
                      ?>
                        <tr>
                          <td width=""><?php echo $get_db_detail['nama_barang']; ?></td>
                          <td width=""><?php echo $get_db_detail['tipe_barang']; ?></td>
                          <td width=""><?php echo $get_db_detail['tipe_detail']; ?></td>
                          <td width=""><?php echo $get_db_detail['merek']; ?></td>
                          <td width=""><?php echo $get_sosite_detail['baik']; ?></td>
                          <td width=""><?php echo $get_sosite_detail['rusak']; ?></td>
                          <td width=""><?php echo $get_sosite_detail['hilang']; ?></td>
                          <td width=""><?php echo $get_db_detail['satuan']; ?></td>
                        </tr>
                      <?php } ?>
                  </table>
                </div>


                <div class="col-lg-12 col-12">
                  <table class="table table-sm table-striped" style="font-size: 11px">
                    <tr>
                      <td colspan="8" align="center" style="vertical-align: middle;">
                        <b>
                          DATA STOCK OPNAME - APD
                        </b>
                      </td>
                    </tr>
                      <tr>
                        <th width=""><b>Nama Barang</b></th>
                        <th width=""><b>Tipe Barang</b></th>
                        <th width=""><b>Tipe Detail</b></th>
                        <th width=""><b>Merek</b></th>
                        <th width=""><b>Baik</b></th>
                        <th width=""><b>Rusak</b></th>
                        <th width=""><b>Hilang</b></th>
                        <th width=""><b>Satuan</b></th>
                      </tr>
                      <?php
                        $q_get_db_detail = mysqli_query($conn, "SELECT t1.detail_code, t2.nama_barang, t2.tipe_barang, t1.tipe_detail, t3.merek, t2.satuan FROM asset_db_detail t1 JOIN asset_db_general t2 ON t1.general_code_id = t2.id JOIN asset_db_merek t3 ON t1.merek_id = t3.id INNER JOIN asset_stockopname_site_detail t4 ON t1.detail_code = t4.detail_code JOIN asset_stockopname_site t5 ON t4.id_so_site = t5.id WHERE t5.kd_project = '$get_sosite[kd_project]' AND t2.jenis = 'APD' ORDER BY nama_barang ASC");
                        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                        	$get_sosite_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT baik, rusak, hilang FROM asset_stockopname_site_detail WHERE detail_code = '$get_db_detail[detail_code]' AND id_so_site = '$id'"));
                      ?>
                        <tr>
                          <td width=""><?php echo $get_db_detail['nama_barang']; ?></td>
                          <td width=""><?php echo $get_db_detail['tipe_barang']; ?></td>
                          <td width=""><?php echo $get_db_detail['tipe_detail']; ?></td>
                          <td width=""><?php echo $get_db_detail['merek']; ?></td>
                          <td width=""><?php echo $get_sosite_detail['baik']; ?></td>
                          <td width=""><?php echo $get_sosite_detail['rusak']; ?></td>
                          <td width=""><?php echo $get_sosite_detail['hilang']; ?></td>
                          <td width=""><?php echo $get_db_detail['satuan']; ?></td>
                        </tr>
                      <?php } ?>
                  </table>
                </div>


                <div class="col-lg-12 col-12">
                  <table class="table table-sm table-striped" style="font-size: 11px">
                    <tr>
                      <td colspan="8" align="center" style="vertical-align: middle;">
                        <b>
                          DATA STOCK OPNAME - INVENTARIS
                        </b>
                      </td>
                    </tr>
                      <tr>
                        <th width=""><b>Nama Barang</b></th>
                        <th width=""><b>Tipe Barang</b></th>
                        <th width=""><b>Tipe Detail</b></th>
                        <th width=""><b>Merek</b></th>
                        <th width=""><b>Baik</b></th>
                        <th width=""><b>Rusak</b></th>
                        <th width=""><b>Hilang</b></th>
                        <th width=""><b>Satuan</b></th>
                      </tr>
                      <?php
                        $q_get_db_detail = mysqli_query($conn, "SELECT t1.detail_code, t2.nama_barang, t2.tipe_barang, t1.tipe_detail, t3.merek, t2.satuan FROM asset_db_detail t1 JOIN asset_db_general t2 ON t1.general_code_id = t2.id JOIN asset_db_merek t3 ON t1.merek_id = t3.id INNER JOIN asset_stockopname_site_detail t4 ON t1.detail_code = t4.detail_code JOIN asset_stockopname_site t5 ON t4.id_so_site = t5.id WHERE t5.kd_project = '$get_sosite[kd_project]' AND t2.jenis = 'Inventaris' ORDER BY nama_barang ASC");
                        while($get_db_detail = mysqli_fetch_array($q_get_db_detail)){
                        	$get_sosite_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT baik, rusak, hilang FROM asset_stockopname_site_detail WHERE detail_code = '$get_db_detail[detail_code]' AND id_so_site = '$id'"));
                      ?>
                        <tr>
                          <td width=""><?php echo $get_db_detail['nama_barang']; ?></td>
                          <td width=""><?php echo $get_db_detail['tipe_barang']; ?></td>
                          <td width=""><?php echo $get_db_detail['tipe_detail']; ?></td>
                          <td width=""><?php echo $get_db_detail['merek']; ?></td>
                          <td width=""><?php echo $get_sosite_detail['baik']; ?></td>
                          <td width=""><?php echo $get_sosite_detail['rusak']; ?></td>
                          <td width=""><?php echo $get_sosite_detail['hilang']; ?></td>
                          <td width=""><?php echo $get_db_detail['satuan']; ?></td>
                        </tr>
                      <?php } ?>
                  </table>
                </div>
              </div>

              	<center>
	                <a href="../unrole/management_asset/cetak_stockopnamesite.php?id=<?php echo $id; ?>" target="_blank">
	                	<div class="btn btn-secondary"><span class="fa fa-print"></span> Cetak</div>
	                </a>
            	</center>
            </form>
            <br><br>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>