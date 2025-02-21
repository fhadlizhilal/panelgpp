<?php
  
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Peminjaman Tools</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List Peminjaman Tools</li>
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
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="example3" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="14%">Nomor Pinjam</th>
                      <th width="10%">Kode Project</th>
                      <th width="">Nama Project</th>
                      <th width="">Lokasi</th>
                      <th width="">Deskripsi Pinjam</th>
                      <th width="12%">Status</th>
                      <th width="10%">Tanggal Update</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $q_getPeminjaman = mysqli_query($conn, "SELECT * FROM tools_peminjaman ORDER BY id DESC");
                      while($get_peminjaman = mysqli_fetch_array($q_getPeminjaman)){
                        $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));
                    ?>
                      <tr>
                        <td>
                          <a href="index.php?pages=review-peminjaman-tools&nopinjam=<?php echo $get_peminjaman['no_pinjam']; ?>" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail Pinjam"><?php echo $get_peminjaman['no_pinjam']; ?></a>
                        </td>
                        <td><?php echo $get_peminjaman['kd_project']; ?></td>
                        <td><?php echo $get_project['nm_project']." <b>[".$get_project['perusahaan']."]</b>"; ?></td>
                        <td><?php echo $get_project['lokasi_project']; ?></td>
                        <td><?php echo $get_peminjaman['deskripsi_pinjam']; ?></td>
                        <td style="font-size: 12px;">
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
                        <td>
                          <?php
                            if($get_peminjaman['status_pinjam'] == "Diajukan"){
                              echo date("d M Y", strtotime($get_peminjaman['diajukan']));
                            }elseif($get_peminjaman['status_pinjam'] == "Dibatalkan"){
                              echo date("d M Y", strtotime($get_peminjaman['dibatalkan']));
                            }elseif($get_peminjaman['status_pinjam'] == "Diproses"){
                              echo date("d M Y", strtotime($get_peminjaman['diproses']));
                            }elseif($get_peminjaman['status_pinjam'] == "Approved"){
                              echo date("d M Y", strtotime($get_peminjaman['approved_reject']));
                            }elseif($get_peminjaman['status_pinjam'] == "Rejected"){
                              echo date("d M Y", strtotime($get_peminjaman['approved_reject']));
                            }elseif($get_peminjaman['status_pinjam'] == "Diserahkan ke user"){
                              echo date("d M Y", strtotime($get_peminjaman['diserahkanke_user']));
                            }elseif($get_peminjaman['status_pinjam'] == "Diterima User"){
                              echo date("d M Y", strtotime($get_peminjaman['diterima_user']));
                            }
                          ?>
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