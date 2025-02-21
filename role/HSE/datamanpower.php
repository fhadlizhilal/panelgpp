<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Manpower</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Manpower</li>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_manpower' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Manpower Baru">
                    <span class="fa fa-plus"></span> Tambah Manpower
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">NIK</th>
                      <th width="">Nama</th>
                      <th width="">Tempat/Tgl Lahir</th>
                      <th width="2%">Gol Darah</th>
                      <th width="">Riwayat Penyakit</th>
                      <th width="5%">No Telpon</th>
                      <th width="">Alamat</th>
                      <th width="">Posisi Kerja</th>
                      <th width="">Nama Kerabat</th>
                      <th width="">Hubungan Kerabat</th>
                      <th width="">No Telpon Kerabat</th>
                      <th width="5%">Foto Diri</th>
                      <th width="8%">Foto KTP</th>
                      <th width="5%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getManpower = mysqli_query($conn, "SELECT * FROM hse_manpower");
                      while($get_Manpower = mysqli_fetch_array($q_getManpower)){
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_Manpower['nik']; ?></td>
                        <td><?php echo $get_Manpower['nama']; ?></td>
                        <td><?php echo $get_Manpower['tempat_lahir']." / ".date('d-m-Y', strtotime($get_Manpower['tgl_lahir'])); ?></td>
                        <td><?php echo $get_Manpower['golongan_darah']; ?></td>
                        <td><?php echo $get_Manpower['riwayat_penyakit']; ?></td>
                        <td><?php echo $get_Manpower['no_telpon']; ?></td>
                        <td><?php echo $get_Manpower['alamat']; ?></td>
                        <td><?php echo $get_Manpower['posisi_kerja']; ?></td>
                        <td><?php echo $get_Manpower['nama_kerabat']; ?></td>
                        <td><?php echo $get_Manpower['hubungan_kerabat']; ?></td>
                        <td><?php echo $get_Manpower['no_telpon_kerabat']; ?></td>
                        <td style="vertical-align: middle;">
                          <?php if($get_Manpower['foto'] == ""){ ?>
                            <img src="../../dist/img/karyawan/vector_user.png" width="100%">
                          <?php }else{ ?>
                            <img src="foto_manpower/<?php echo $get_Manpower['foto']; ?>" width="100%">
                          <?php } ?>
                        </td>
                        <td style="vertical-align: middle;">
                          <?php if($get_Manpower['ktp'] == ""){ ?>
                            <img src="../../dist/img/vector-ktp.png" width="100%">
                          <?php }else{ ?>
                            <img src="foto_ktp/<?php echo $get_Manpower['ktp']; ?>" width="100%">
                          <?php } ?>
                        </td>
                        <td style="font-size: 14px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_data_manpower' data-id='<?php echo $get_Manpower['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_manpower' data-id='<?php echo $get_Manpower['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
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
  <div class="modal fade" id="show_add_data_manpower" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Manpower</h4>
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
  <div class="modal fade" id="show_edit_data_manpower" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Manpower</h4>
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
  <div class="modal fade" id="show_delete_manpower" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Data Manpower</h4>
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