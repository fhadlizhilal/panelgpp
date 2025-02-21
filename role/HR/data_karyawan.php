<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Karyawan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Karyawan</li>
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
              <div class="card-header">
                <h3 class="card-title float-sm-right" style="font-size: 12px;">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_karyawan' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Hari Libur">
                    <span class="fa fa-plus"></span> Tambah Karyawan
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">NIK</th>
                      <th width="">Nama Karyawan</th>
                      <th width="">Jabatan</th>
                      <th width="">Gaji</th>
                      <th width="">Tgl Masuk</th>
                      <th width="5%">Foto</th>
                      <th width="8%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan");
                      while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                        $getJabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jabatan where id = '$get_karyawan[jabatan_id]'"));
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_karyawan['nik']; ?></td>
                        <td><?php echo $get_karyawan['nama']; ?></td>
                        <td><?php echo $getJabatan['jabatan']; ?></td>
                        <td><?php echo rupiah($get_karyawan['gaji']); ?></td>
                        <td><?php echo date("d-m-Y",strtotime($get_karyawan['tgl_masuk'])); ?></td>
                        <td>
                          <?php
                            if($get_karyawan['foto'] == ""){
                          ?>
                              <img width="100%" src="../../dist/img/karyawan/<?php echo "vector_user.png"; ?>">
                          <?php
                            }else{
                          ?>
                              <img width="100%" src="../../dist/img/karyawan/<?php echo $get_karyawan['foto']; ?>">
                          <?php
                            }
                          ?>
                          
                        </td>
                        <td style="font-size: 14px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_data_karyawan' data-id='<?php echo $get_karyawan['nik']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_data_karyawan' data-id='<?php echo $get_karyawan['nik']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
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
  <div class="modal fade" id="show_add_data_karyawan" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Data Karyawan</h4>
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
  <div class="modal fade" id="show_edit_data_karyawan" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Karyawan</h4>
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
  <div class="modal fade" id="show_delete_hari_libur" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Hari Libur</h4>
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