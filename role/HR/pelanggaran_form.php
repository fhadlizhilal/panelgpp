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
            <h1 class="m-0">Form Pelanggaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Pelanggaran</li>
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
        <div class="row">
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <br>
              <form method="POST" action="index.php?pages=form_pelanggaran">
                <div class="inner">
                  <div class="row">
                    <div class="col-1"></div>
                    <div class="col-lg-2 col-sm-2 col-xs-2 col-2">
                      <div class="form-group">
                        <center><label>Tgl Pelanggaran</label></center>
                        <input type="date" name="tanggal_pelanggaran" maxlength="255" class="form-control" required style="font-size: 12px;">
                      </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-3 col-3">
                      <div class="form-group">
                        <center><label>Karyawan</label></center>
                        <select class="form-control" name="nik_karyawan" style="font-size: 11px;">
                          <option value="" selected disabled>----- Pilih Karyawan -----</option>
                          <?php
                            $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE status = 'aktif' AND nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150103100159' AND nik != '12150211080696' ORDER BY nama ASC");
                            while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                          ?>
                            <option value="<?php echo $get_karyawan['nik']; ?>"><?php echo $get_karyawan['nama']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-5 col-sm-5 col-xs-5 col-5">
                      <div class="form-group">
                        <center><label>Pelanggaran</label></center>
                        <select class="form-control" name="pelanggaran_id" style="font-size: 10px;" required>
                          <option value="" selected disabled>----- Pilih Pelanggaran -----</option>
                          <option value="" style="font-weight: bold;" disabled>RINGAN</option>
                          <?php
                            $no = 1;
                            $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'RINGAN'");
                            while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
                          ?>
                            <option value="<?php echo $get_pelanggaranList['id']; ?>"><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
                          <?php $no++; } ?>

                          <option value="" style="font-weight: bold;" disabled></option>
                          <option value="" style="font-weight: bold;" disabled>SEDANG</option>
                          <?php
                            $no = 1;
                            $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'SEDANG'");
                            while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
                          ?>
                            <option value="<?php echo $get_pelanggaranList['id']; ?>"><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
                          <?php $no++; } ?>

                          <option value="" style="font-weight: bold;" disabled></option>
                          <option value="" style="font-weight: bold;" disabled>SEDANG BERAT</option>
                          <?php
                            $no = 1;
                            $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'SEDANG BERAT'");
                            while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
                          ?>
                            <option value="<?php echo $get_pelanggaranList['id']; ?>"><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
                          <?php $no++; } ?>

                          <option value="" style="font-weight: bold;" disabled></option>
                          <option value="" style="font-weight: bold;" disabled>BERAT</option>
                          <?php
                            $no = 1;
                            $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'BERAT'");
                            while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
                          ?>
                            <option value="<?php echo $get_pelanggaranList['id']; ?>"><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
                          <?php $no++; } ?>

                          <option value="" style="font-weight: bold;" disabled></option>
                          <option value="" style="font-weight: bold;" disabled>SANGAT BERAT</option>
                          <?php
                            $no = 1;
                            $q_getpelanggaranList = mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE status_pelanggaran = 'SANGAT BERAT'");
                            while($get_pelanggaranList = mysqli_fetch_array($q_getpelanggaranList)){
                          ?>
                            <option value="<?php echo $get_pelanggaranList['id']; ?>"><?php echo $no.". ".$get_pelanggaranList['nama_pelanggaran']; ?></option>
                          <?php $no++; } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-1"></div>
                    <div class="col-10">
                      <center>
                        <center><label>Keterangan Tambahan</label></center>
                        <textarea class="form-control" name="keterangan" maxlength="255"></textarea>
                      </center>
                    </div>                  
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="form_pelanggaran">
                        <input type="submit" class="btn btn-info btn-md" onclick="return confirm('Yakin Submit pelanggaran ini?')" name="submit_pelanggaran" value="Submit">
                      </center>
                    </div>                  
                  </div>
                </div>
              </form>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <br>
            </div>
          </div>
        </div>

        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box" style="background-color: white;">
              <div class="card">
                <div class="card-body">
                  <br>
                  <table id="example2" class="table table-bordered table-sm table-striped" width="100%" style="font-size: 10px;">
                    <thead>
                    <tr style="text-align: center;">
                      <th width="6%">Tanggal Pelanggaran</th>
                      <th width="">NIK</th>
                      <th width="">Nama Karyawan</th>
                      <th width="">Pelanggaran</th>
                      <th width="5%">Status Pelanggaran</th>
                      <th width="">Keterangan</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $q_getPelanggaran = mysqli_query($conn, "SELECT * FROM pelanggaran ORDER BY creation_date DESC");
                        while($getPelanggaran = mysqli_fetch_array($q_getPelanggaran)){
                          $getKaryawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$getPelanggaran[nik]'"));
                          $getPelanggaran_List = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pelanggaran_list WHERE id = '$getPelanggaran[pelanggaran_id]'"));
                      ?>
                        <tr>
                          <td style="font-size: 10px;"><?php echo date("d-m-Y", strtotime($getPelanggaran['tanggal'])); ?></td>
                          <td style="font-size: 10px;"><?php echo $getPelanggaran['nik']; ?></td>
                          <td style="font-size: 10px;"><?php echo $getKaryawan['nama']; ?></td>
                          <td style="font-size: 10px;"><?php echo $getPelanggaran_List['nama_pelanggaran']; ?></td>
                          <td style="font-size: 11px;">
                            <?php
                              if($getPelanggaran_List['status_pelanggaran'] == "RINGAN"){
                                echo "<div class='badge badge-secondary'>".$getPelanggaran_List['status_pelanggaran']."</div>";
                              }elseif($getPelanggaran_List['status_pelanggaran'] == "SEDANG"){
                                echo "<div class='badge badge-success'>".$getPelanggaran_List['status_pelanggaran']."</div>";
                              }elseif($getPelanggaran_List['status_pelanggaran'] == "SEDANG BERAT"){
                                echo "<div class='badge badge-info'>".$getPelanggaran_List['status_pelanggaran']."</div>";
                              }elseif($getPelanggaran_List['status_pelanggaran'] == "BERAT"){
                                echo "<div class='badge badge-warning'>".$getPelanggaran_List['status_pelanggaran']."</div>";
                              }elseif($getPelanggaran_List['status_pelanggaran'] == "SANGAT BERAT"){
                                echo "<div class='badge badge-danger'>".$getPelanggaran_List['status_pelanggaran']."</div>";
                              }
                            ?>
                          </td>
                          <td style="font-size: 10px;"><?php echo $getPelanggaran['keterangan']; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_program" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Program</h4>
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