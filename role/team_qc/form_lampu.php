<?php
  $listqc_tmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM list_reportqc_tmp WHERE form = 'form_lampu'"));
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Report Lampu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Report Lampu</li>
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
              <div class="card-body">
                <form method="POST" action="index.php?pages=<?php echo $_GET['pages']; ?>">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-3 col-sm-1 col-xs-1 col-1"></div>
                    <div class="col-lg-4 col-sm-6 col-xs-6 col-6">
                      <div class="form-group">
                        <center><label for="Bulan">Nama Pekerjaan</label></center>
                        <input type="text" class="form-control form-control-sm" name="nama_pekerjaan" value="<?php echo $listqc_tmp['nm_pekerjaan']; ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-xs-4 col-4">
                      <div class="form-group">
                        <center><label for="Bulan">Tanggal QC</label></center>
                        <input type="date" class="form-control form-control-sm" name="tanggalqc" value="<?php echo $listqc_tmp['tgl']; ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="fr" value="form_lampu">
                        <input type="hidden" name="idqc" value="<?php echo $listqc_tmp['id']; ?>">
                        <input type="submit" class="btn btn-info btn-sm" name="list_formqc" value="Simpan">
                      </center>
                    </div>                  
                  </div>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
        <div class="row" style="font-size: 10px;">
          <div class="col-12">
            <div class="card">
              <!-- ./card-header -->
              <div class="card-body">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_list' data-id='' data-toggle="tooltip" data-placement="bottom" title="Tambah Hari Libur">
                    <span class="fa fa-plus"></span> Tambah Data
                  </a>
                <table id="example6" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr align="center">
                      <th width="1%">No</th>
                      <th width="">No Serial Lampu</th>
                      <th width="">Kondisi Lampu</th>
                      <th width="">Kondisi Aksesories</th>
                      <th width="10%">Foto</th>
                      <th width="10%">Random Check</th>
                      <th width="1%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_getDetailListLampu_tmp = mysqli_query($conn, "SELECT * FROM list_report_lampu_tmp");
                      while($getDetailListLampu_tmp = mysqli_fetch_array($q_getDetailListLampu_tmp)){
                        $no++;
                    ?>
                      <tr>
                        <td align="center"><?php echo $no; ?></td>
                        <td><?php echo $getDetailListLampu_tmp['no_seri'] ?></td>
                        <td align="center"><?php echo $getDetailListLampu_tmp['kondisi_lampu'] ?></td>
                        <td align="center"><?php echo $getDetailListLampu_tmp['kondisi_aksesories'] ?></td>
                        <td><img src="dokumentasi/<?php echo $getDetailListLampu_tmp['foto'] ?>" width="100%"></td>
                        <td><?php echo $getDetailListLampu_tmp['random_check'] ?></td>
                        <td align="center" style="font-size: 18px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_formlampu' data-id='<?php echo $getDetailListLampu_tmp['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_formlampu' data-id='<?php echo $getDetailListLampu_tmp['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
                <form method="POST" action="index.php?pages=history">
                  <input type="hidden" name="nm_form" value="Lampu">
                  <input type="hidden" name="nm_form_tmp" value="form_lampu">
                  <center><input type="submit" class="btn btn-success btn-sm" name="formlampu_submit" value="Submit" onclick="return confirm('Anda yakin form yang diisi sudah sesuai?')"></center>
                </form>
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
  <div class="modal fade" id="show_add_list" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Data PV Module</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=form_lampu" enctype="multipart/form-data" style="font-size: 12px;">
            <div class="card-body">
              <table width="100%" cellpadding="5px">
                <tr>
                  <td width="30%" style="font-weight: bold;">No Serial Lampu</td>
                  <td width="2%">:</td>
                  <td><input type="text" class="form-control form-control-sm" name="no_seri" required></td>
                </tr>
                <tr>
                  <td width="30%" style="font-weight: bold;">Kondisi Lampu</td>
                  <td width="2%">:</td>
                  <td>
                    <select class="form-control form-control-sm" name="kondisi_lampu" required>
                      <option disabled selected>-- Pilih Kondisi --</option>
                      <option value="Baik">Baik</option>
                      <option value="Tidak Baik">Tidak Baik</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td width="30%" style="font-weight: bold;">Kondisi Aksesories</td>
                  <td width="2%">:</td>
                  <td>
                    <select class="form-control form-control-sm" name="kondisi_aksesories" required>
                      <option disabled selected>-- Pilih Kondisi --</option>
                      <option value="Baik">Baik</option>
                      <option value="Tidak Baik">Tidak Baik</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td width="30%" style="font-weight: bold;">Foto</td>
                  <td width="2%">:</td>
                  <td><input type="file" class="form-control form-control-sm" name="foto" required></td>
                </tr>
              </table>
            </div>
            <div class="card-footer">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="submit" class="btn btn-success float-right" name="submit_form_lampu" value="Tambah">
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_formlampu" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Lampu</h4>
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
  <div class="modal fade" id="show_delete_formlampu" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data Lampu</h4>
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