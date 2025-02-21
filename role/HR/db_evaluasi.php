<?php
  require_once "../../dev/config.php";
  $today = date("dd-mm-yyyy H:i:s");
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">DB Evaluasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DB Evaluasi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card"><!-- 
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="formabsen1" class="table table-bordered table-sm table-striped" width="100%" style="font-size: 11px;">
                    <thead>
                      <tr style="text-align: center;">
                        <th width="">Nomor</th>
                        <th width="">Tgl Evaluasi</th>
                        <th width="">NIK</th>
                        <th width="">Nama Karyawan</th>
                        <th width="">Jabatan <br>(Saat Evaluasi)</th>
                        <th width="10%">Semester</th>
                        <th width="">Masa Kerja</th>
                        <th width="">Tanggal Penilaian</th>
                        <th width="">#</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                          $q_evaluasi = mysqli_query($conn, "SELECT * FROM evaluasi");
                          while($get_evaluasi = mysqli_fetch_array($q_evaluasi)){
                            $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_evaluasi[nik]'"));
                        ?>
                            <tr>
                              <td style="font-size: 10px;">
                                <a href="" data-toggle="modal" data-target="#show_evaluasi_detail" data-id='<?php echo $get_evaluasi['nomor']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail"><?php echo $get_evaluasi['nomor']; ?></a>    
                              </td>
                              <td style="font-size: 10px;"><?php echo date("d M Y",strtotime($get_evaluasi['tanggal_evaluasi'])); ?></td>
                              <td style="font-size: 10px;"><?php echo $get_evaluasi['nik']; ?></td>
                              <td style="font-size: 10px;"><?php echo $get_karyawan['nama']; ?></td>
                              <td style="font-size: 10px;"><?php echo $get_evaluasi['jabatan']; ?></td>
                              <td style="font-size: 10px;"><?php echo $get_evaluasi['semester']; ?></td>
                              <td style="font-size: 10px;"><?php echo $get_evaluasi['masa_kerja']; ?></td>
                              <td style="font-size: 10px;">
                                <?php 
                                  echo date('d M Y', strtotime($get_evaluasi['penilaian_dari']))." s/d ".date('d M Y', strtotime($get_evaluasi['penilaian_sampai']));
                                ?>
                              </td>
                              <td style="font-size: 10px;"><a href="" data-toggle="modal" data-target="#show_edit_evaluasi" data-id='<?php echo $get_evaluasi['nomor']; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail"><span class="fa fa-edit"></span></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div>
    </section>

  </div>

  <!-- Modal start here -->
  <div class="modal fade" id="show_evaluasi_detail" role="dialog"> 
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Evaluasi</h4>
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
  <div class="modal fade" id="show_edit_evaluasi" role="dialog"> 
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Evaluasi</h4>
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