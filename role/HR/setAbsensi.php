<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Absensi Karyawan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Set Tugas Kantor</li>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_absensi' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Absensi Karyawan">
                    <span class="fa fa-plus"></span> Tambah List
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama</th>
                      <th width="15%">Status</th>
                      <th width="8%">Dari</th>
                      <th width="8%">Sampai</th>
                      <th width="5%">Lama</th>
                      <th width="">Keterangan</th>
                      <th width="8%">Tanggal Dibuat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getAbsensi = mysqli_query($conn, "SELECT * FROM absensi ORDER BY id DESC");
                      while($getAbsensi = mysqli_fetch_array($q_getAbsensi)){
                        $get_NamaKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getAbsensi[nik]'")); 
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_NamaKaryawan['nama']; ?></td>
                        <td style="font-size: 12px;" align="center">
                          <?php 
                            if($getAbsensi['status'] == "Izin Tidak Masuk" OR $getAbsensi['status'] == "Sakit - Tanpa SKD"){
                              echo "<div class='badge badge-warning'>".$getAbsensi['status']."</div>";
                            }elseif($getAbsensi['status'] == "Tanpa Keterangan"){
                              echo "<div class='badge badge-danger'>".$getAbsensi['status']."</div>";
                            }else{
                              echo "<div class='badge badge-success'>".$getAbsensi['status']."</div>";
                            }
                          ?>
                         </td>
                        <td align="center"><?php echo date("d-m-Y", strtotime($getAbsensi['dari'])); ?></td>
                        <td align="center"><?php echo date("d-m-Y", strtotime($getAbsensi['sampai'])); ?></td>
                        <td align="center"><?php echo "1 Hari"; ?></td>
                        <td><?php echo $getAbsensi['keterangan']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($getAbsensi['created_at'])); ?></td>
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
  <div class="modal fade" id="show_add_absensi" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Absensi Karyawan</h4>
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
  <div class="modal fade" id="show_edit_absensi" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Absensi</h4>
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
  <div class="modal fade" id="show_delete_absensi" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Absensi</h4>
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