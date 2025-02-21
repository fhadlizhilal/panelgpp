<?php
  if(isset($_GET['nopinjam'])){
    $id = $_GET['nopinjam'];
    $get_peminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_peminjaman WHERE no_pinjam = '$id'"));
    $get_peminjaman_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_peminjaman_detail WHERE no_pinjam = '$id'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));
    $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[nik]'"));
  
    if($get_peminjaman['status_pinjam'] == "Diajukan" OR $get_peminjaman['status_pinjam'] == "Diproses"){
      $halaman = "review-peminjaman-tools&nopinjam=".$id;
    }elseif($get_peminjaman['status_pinjam'] == "Approved"){
      $halaman = "list-peminjaman-tools";
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
            <h1>Review Peminjaman Tools</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Review Peminjaman Tools</li>
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
            <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=<?php echo $halaman; ?>">
              <div class="card card-secondary" style="font-size: 11px;">
                <div class="card-header">
                  <h3 class="card-title">Info Peminjaman Tools</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0"> 
                  <div class="row">
                    <div class="col-12">  
                      <table class="table table-sm">
                        <tr>
                          <td width="25%">Nomor Pinjam</td>
                          <td width="1%">:</td>
                          <td><?php echo $id; ?></td>
                        </tr>
                        <tr>
                          <td width="25%">Peminjam</td>
                          <td width="1%">:</td>
                          <td><?php echo $get_peminjaman['nik']." - ".$get_karyawan['nama']; ?></td>
                        </tr>
                        <tr>
                          <td width="26%">Kode Project</td>
                          <td width="1%">:</td>
                          <td><?php echo $get_peminjaman['kd_project']." - ".$get_project['nm_project']." <b>[".$get_project['perusahaan']."]</b"; ?></td>
                        </tr>
                        <tr>
                          <td width="26%">Lokasi Project</td>
                          <td width="1%">:</td>
                          <td><?php echo $get_project['lokasi_project']; ?></td>
                        </tr>
                        <tr>
                          <td width="26%">Keterangan Pinjam</td>
                          <td width="1%">:</td>
                          <td><?php echo $get_peminjaman['deskripsi_pinjam']; ?></td>
                        </tr>
                        <tr>
                          <td width="26%">Status</td>
                          <td width="1%">:</td>
                          <td>
                            <?php
                              if($get_peminjaman['status_pinjam'] == "Diajukan"){
                                echo "<div class='badge badge-secondary'>".$get_peminjaman['status_pinjam']."</div>";
                              }elseif($get_peminjaman['status_pinjam'] == "Dibatalkan"){
                                echo "<div class='badge badge-danger'>".$get_peminjaman['status_pinjam']."</div>";
                              }elseif($get_peminjaman['status_pinjam'] == "Diproses"){
                                echo "<div class='badge badge-warning'>".$get_peminjaman['status_pinjam']."</div>";
                              }elseif($get_peminjaman['status_pinjam'] == "Approved"){
                                echo "<div class='badge badge-success'>".$get_peminjaman['status_pinjam']."</div>";
                              }elseif($get_peminjaman['status_pinjam'] == "Rejected"){
                                echo "<div class='badge badge-danger'>".$get_peminjaman['status_pinjam']."</div>";
                              }elseif($get_peminjaman['status_pinjam'] == "Diserahkan ke user"){
                                echo "<div class='badge badge-info'>".$get_peminjaman['status_pinjam']."</div>";
                              }elseif($get_peminjaman['status_pinjam'] == "Diterima User"){
                                echo "<div class='badge badge-success'>".$get_peminjaman['status_pinjam']."</div>";
                              }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td width="26%">Tanggal Update</td>
                          <td width="1%">:</td>
                          <td>
                            <?php 
                              if($get_peminjaman['status_pinjam'] == "Diajukan"){
                                echo date("d-m-Y", strtotime($get_peminjaman['diajukan']));
                              }elseif($get_peminjaman['status_pinjam'] == "Dibatalkan"){
                                echo date("d-m-Y", strtotime($get_peminjaman['dibatalkan']));
                              }elseif($get_peminjaman['status_pinjam'] == "Diproses"){
                                echo date("d-m-Y", strtotime($get_peminjaman['diproses']));
                              }elseif($get_peminjaman['status_pinjam'] == "Approved"){
                                echo date("d-m-Y", strtotime($get_peminjaman['approved_reject']));
                              }elseif($get_peminjaman['status_pinjam'] == "Rejected"){
                                echo date("d-m-Y", strtotime($get_peminjaman['approved_reject']));
                              }elseif($get_peminjaman['status_pinjam'] == "Diserahkan ke user"){
                                echo date("d-m-Y", strtotime($get_peminjaman['diserahkanke_user']));
                              }elseif($get_peminjaman['status_pinjam'] == "Diterima User"){
                                echo date("d-m-Y", strtotime($get_peminjaman['diterima_user']));
                              }
                            ?>    
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->

              <div class="card card-secondary" style="font-size: 11px;">
                <div class="card-header">
                  <h3 class="card-title">List Tools</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <table class="table table-sm">
                        <thead>
                          <tr>
                            <th width="1%">No</th>
                            <th>ID Tools</th>
                            <th>Nama Tools</th>
                            <th>Janis Tools</th>
                            <th width="5%">Qty</th>
                            <th width="5%">Kekurangan</th>
                            <th width="5%">Satuan</th>
                            <th>Catatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $no = 0;
                            $no_array = 0;
                            $q_gettoolsdetail = mysqli_query($conn, "SELECT * FROM tools_peminjaman_detail WHERE no_pinjam = '$id'");
                            while($tools_detail = mysqli_fetch_array($q_gettoolsdetail)){
                              $get_tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_db WHERE id_tools = '$tools_detail[id_tools]'"));
                              $sum_toolsmasuk = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sumQty FROM v_keluardetail_tmp WHERE tools_id = '$get_tools[id_tools]'"));

                              $stock_byID = $sum_toolsmasuk['sumQty'];
                              $no++;
                          ?>
                            <tr data-widget="expandable-table" aria-expanded="false">
                              <td><?php echo $no; ?></td>
                              <td><?php echo $get_tools['id_tools']; ?></td>
                              <td><?php echo $get_tools['nama_tools']; ?></td>
                              <td><?php echo $get_tools['jenis_tools']; ?></td>
                              <td><?php echo $tools_detail['qty']; ?></td>
                              <td align="center">
                                <?php
                                  echo $tools_detail['qty'] - $stock_byID;
                                ?>
                              </td>
                              <td><?php echo $get_tools['satuan']; ?></td>
                              <td><?php echo $tools_detail['catatan']; ?></td>
                            </tr>
                            <?php if($get_peminjaman['status_pinjam'] == "Diproses"){ ?>
                              <tr class="expandable-body">
                                <td colspan="9">
                                  <div class="card-body" style="background-color: #e6faf5;">
                                    <table class="table table-sm table-bordered">
                                      <thead>
                                        <tr>
                                          <th width="1%">No</th>
                                          <th>ID Detail</th>
                                          <th>Nama Tools</th>
                                          <th>Janis Tools</th>
                                          <th width="10%">Sub Tools</th>
                                          <th>Tipe</th>
                                          <th width="10%">Merek</th>
                                          <th width="5%">Stock</th>
                                          <th width="5%">Satuan</th>
                                          <th width="5%">Qty</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $no_2 = 0;
                                          $q_getToolsDetail = mysqli_query($conn, "SELECT * FROM tools_db_detail WHERE tools_id = '$tools_detail[id_tools]' ");
                                          while($get_toolsDetail = mysqli_fetch_array($q_getToolsDetail)){
                                            $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_toolsDetail[merek_id]'"));
                                            $sum_toolsmasukDetail = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sumQtyDetail FROM v_toolsmasuk_detail WHERE id_detail = '$get_toolsDetail[detail_id]'"));
                                            $stock_byDetail = 0+$sum_toolsmasukDetail['sumQtyDetail'];
                                            $value_keluardetail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM v_keluardetail_tmp WHERE id_detail = '$get_toolsDetail[detail_id]'"));

                                            $no_2++;
                                            $no_array++;
                                        ?>
                                          <tr>
                                            <td><?php echo $no_2; ?></td>
                                            <td>
                                              <?php echo $get_toolsDetail['detail_id']; ?>
                                              <input type="hidden" name="detailID_<?php echo $no_array; ?>" value="<?php echo $get_toolsDetail['detail_id']; ?>">
                                            </td>
                                            <td><?php echo $get_tools['nama_tools']; ?></td>
                                            <td><?php echo $get_tools['jenis_tools']; ?></td>
                                            <td><?php echo $get_toolsDetail['sub_tools']; ?></td>
                                            <td><?php echo $get_toolsDetail['tipe_detail']; ?></td>
                                            <td><?php echo $get_merek['merek']; ?></td>
                                            <td><?php echo $stock_byDetail; ?></td>
                                            <td><?php echo $get_tools['satuan']; ?></td>
                                            <td><input type="number" name="qty_<?php echo $no_array; ?>" value="<?php echo $value_keluardetail['qty']; ?>" style="width: 55px;" min="0" max="<?php echo $stock_byDetail; ?>"></td>
                                          </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </td>
                              </tr>
                            <?php }elseif($get_peminjaman['status_pinjam'] == "Approved"){ ?>
                              <tr class="expandable-body">
                                <td colspan="9">
                                  <div class="card-body" style="background-color: #e6faf5;">
                                    <table class="table table-sm table-bordered">
                                      <thead>
                                        <tr>
                                          <th width="1%">No</th>
                                          <th>ID Detail</th>
                                          <th>Nama Tools</th>
                                          <th>Janis Tools</th>
                                          <th width="10%">Sub Tools</th>
                                          <th>Tipe</th>
                                          <th width="10%">Merek</th>
                                          <th width="5%">Qty</th>
                                          <th width="5%">Satuan</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          $no_2 = 0;
                                          $q_getToolsDetail = mysqli_query($conn, "SELECT * FROM tools_db_detail WHERE tools_id = '$tools_detail[id_tools]' ");
                                          while($get_toolsDetail = mysqli_fetch_array($q_getToolsDetail)){
                                            $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_toolsDetail[merek_id]'"));
                                            $sum_toolsmasukDetail = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sumQtyDetail FROM v_toolsmasuk_detail WHERE id_detail = '$get_toolsDetail[detail_id]'"));
                                            $stock_byDetail = 0+$sum_toolsmasukDetail['sumQtyDetail'];
                                            $value_keluardetail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM v_keluardetail WHERE id_detail = '$get_toolsDetail[detail_id]'"));

                                            $no_2++;
                                            $no_array++;
                                        ?>
                                          <tr>
                                            <td><?php echo $no_2; ?></td>
                                            <td>
                                              <?php echo $get_toolsDetail['detail_id']; ?>
                                              <input type="hidden" name="detailID_<?php echo $no_array; ?>" value="<?php echo $get_toolsDetail['detail_id']; ?>">
                                            </td>
                                            <td><?php echo $get_tools['nama_tools']; ?></td>
                                            <td><?php echo $get_tools['jenis_tools']; ?></td>
                                            <td><?php echo $get_toolsDetail['sub_tools']; ?></td>
                                            <td><?php echo $get_toolsDetail['tipe_detail']; ?></td>
                                            <td><?php echo $get_merek['merek']; ?></td>
                                            <td><?php echo 0+$value_keluardetail['qty']; ?></td>
                                            <td><?php echo $get_tools['satuan']; ?></td>
                                          </tr>
                                        <?php } ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </td>
                              </tr>
                            <?php } ?>
                          <?php } ?>
                        </tbody>
                      </table>
                      <center>
                          <input type="hidden" name="jml_data" value="<?php echo $no_array; ?>">
                          <input type="hidden" name="no_pinjam" value="<?php echo $id; ?>">
                        <?php if($get_peminjaman['status_pinjam'] == "Diajukan"){ ?>
                          <input type="submit" class="btn btn-warning" name="followup_pinjam_tools" value="Process">
                          <input type="submit" class="btn btn-danger" name="followup_pinjam_tools" value="Reject">
                        <?php }elseif($get_peminjaman['status_pinjam'] == "Diproses"){ ?>
                          <a href="#modal" data-toggle='modal' data-target='#show_review_approve' data-id='<?php echo $id; ?>' data-toggle="tooltip" data-placement="bottom" title="Approve">
                            <button class="btn btn-success">Approve</button>
                          </a>
                          <input type="submit" class="btn btn-danger" name="followup_pinjam_tools" value="Reject">
                          <input type="submit" class="btn btn-info" name="followup_pinjam_tools" value="Simpan">
                        <?php }elseif($get_peminjaman['status_pinjam'] == "Approved"){ ?>
                          <a href="#modal" data-toggle='modal' data-target='#show_review_serahkankeuser' data-id='<?php echo $id; ?>' data-toggle="tooltip" data-placement="bottom" title="Approve">
                            <button class="btn btn-success" style="font-size: 11px;">Serahkan ke User</button>
                          </a>
                        <?php } ?>
                      </center>
                    </div>
                  </div>
                </div>
              </div>
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

  <!-- Modal start here -->
  <div class="modal fade" id="show_review_tools_pinjam" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Review Peminjaman Tools</h4>
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
  <div class="modal fade" id="show_batalkan_peminjaman_tools" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Batalkan Peminjaman</h4>
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
  <div class="modal fade" id="show_edit_peminjaman_tools" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Peminjaman Tools</h4>
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
  <div class="modal fade" id="show_review_approve" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Approve Peminjaman</h4>
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
  <div class="modal fade" id="show_review_serahkankeuser" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Serahkan ke User</h4>
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