<?php
  require_once "../../dev/config.php";
  $today = date("dd-mm-yyyy H:i:s");

  function tanggal_indo($tanggal, $cetak_hari = false)
  {
    $hari = array ( 1 =>    'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        );
        
    $bulan = array (1 =>   'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
        );
    $split    = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    
    if ($cetak_hari) {
      $num = date('N', strtotime($tanggal));
      return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
  }
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daily Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dailyreport</li>
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
            <div class="small-box">
              <br>
              <form method="GET" action="index.php?pages=dailyreport">
                <div class="inner">
                  <div class="row">
                    <div class="col-lg-4 col-sm-2 col-xs-2 col-2"></div>
                    <div class="col-lg-2 col-sm-4 col-xs-4 col-4">
                      <div class="form-group">
                        <center><label for="Bulan">Bulan</label></center>
                        <select class="form-control" name="bulan">
                          <option value="1" <?php if(Date('m') == "01"){ echo "selected" ; } ?> >Januari</option>
                          <option value="2" <?php if(Date('m') == "02"){ echo "selected" ; } ?> >Februari</option>
                          <option value="3" <?php if(Date('m') == "03"){ echo "selected" ; } ?> >Maret</option>
                          <option value="4" <?php if(Date('m') == "04"){ echo "selected" ; } ?> >April</option>
                          <option value="5" <?php if(Date('m') == "05"){ echo "selected" ; } ?> >Mei</option>
                          <option value="6" <?php if(Date('m') == "06"){ echo "selected" ; } ?> >Juni</option>
                          <option value="7" <?php if(Date('m') == "07"){ echo "selected" ; } ?> >Juli</option>
                          <option value="8" <?php if(Date('m') == "08"){ echo "selected" ; } ?> >Agustus</option>
                          <option value="9" <?php if(Date('m') == "09"){ echo "selected" ; } ?> >September</option>
                          <option value="10" <?php if(Date('m') == "10"){ echo "selected" ; } ?> >Oktober</option>
                          <option value="11" <?php if(Date('m') == "11"){ echo "selected" ; } ?> >November</option>
                          <option value="12" <?php if(Date('m') == "12"){ echo "selected" ; } ?> >Desember</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-4 col-xs-4 col-4">
                      <div class="form-group">
                        <center><label for="Bulan">Tahun</label></center>
                        <select class="form-control" name="tahun">
                          <option value="2022" <?php if(Date('Y') == "2022"){ echo "selected" ; } ?> >2022</option>
                          <option value="2023" <?php if(Date('Y') == "2023"){ echo "selected" ; } ?> >2023</option>
                          <option value="2024" <?php if(Date('Y') == "2024"){ echo "selected" ; } ?> >2024</option>
                          <option value="2025" <?php if(Date('Y') == "2025"){ echo "selected" ; } ?> >2025</option>
                          <option value="2026" <?php if(Date('Y') == "2026"){ echo "selected" ; } ?> >2026</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <center>
                        <input type="hidden" name="pages" value="dailyreport">
                        <input type="submit" class="btn btn-primary" value="Submit">
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
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <!-- /.row -->
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <!-- /.card-header -->
                              <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" style="font-size: 14px;">
                                  <thead>
                                    <tr align="center">
                                      <th width="1%">NO</th>
                                      <th width="30%">Tanggal</th>
                                      <th width="50%">Report</th>
                                      <th width="10%">#</th>
                                    </tr>
                                  </thead>
                                  <tbody align="center">
                                    <?php if (!isset($_GET['bulan']) OR !isset($_GET['tahun'])){ ?>
                                      <tr>
                                        <td colspan="5" style="text-align: center;"><i><small>silahkan pilih bulan dan tahun terlebih dahulu</small></i></td>
                                      </tr>
                                    <?php 
                                      }else{
                                        $jml_hari = cal_days_in_month(CAL_GREGORIAN, $_GET['bulan'], $_GET['tahun']);

                                        for($i=1;$i<=$jml_hari;$i++){
                                          $tgl_report = date('Y-m-d', strtotime($_GET['tahun']."-".$_GET['bulan']."-".$i));
                                          $cek_hari = date('l', strtotime($tgl_report));

                                    ?>
                                          <tr>
                                            <td><?php echo $i; ?></td>
                                            <td style="text-align: left;"><?php echo tanggal_indo($tgl_report, true); ?></td>
                                            <td>
                                              <?php
                                                $query = mysqli_query($conn, "SELECT * FROM dailyreport WHERE nik = '$_SESSION[nik]' AND tanggal = '$tgl_report'");
                                                $result = mysqli_num_rows($query);

                                                if ($result > 0 AND $cek_hari != "Saturday" AND $cek_hari != "Sunday") {
                                              ?>
                                                  <span class="badge badge-success">Sudah Mengisi Report</span>

                                              <?php }else if($cek_hari == "Saturday" OR $cek_hari == "Sunday"){ ?>

                                                  <span class="badge badge-default">Akhir Pekan / Libur</span>
                                                  
                                              <?php }else{ ?>
                                                  
                                                  <span class="badge badge-danger">Belum Mengisi Report</span>

                                              <?php } ?>
                                            </td>
                                            <?php if ($result > 0) { ?>
                                              <td style='text-align:center'>
                                                <a href="#modal" data-toggle='modal' data-target='#show_lihat' data-id='<?php echo $tgl_report; ?>'>Lihat </a>
                                                |
                                                <a href="#modal" data-toggle='modal' data-target='#show_hapus' data-id='<?php echo $tgl_report; ?>'> Hapus</a>
                                              </td>
                                            <?php }else if($cek_hari != "Saturday" AND $cek_hari != "Sunday"){ ?>
                                              <td style='text-align:center'><a href="#modal" data-toggle='modal' data-target='#show' data-id='<?php echo $tgl_report; ?>'>Insert</a></td>
                                            <?php }else{ ?>
                                              <td></td>
                                            <?php } ?>
                                          </tr>

                                    <?php }} ?>
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                        <!-- /.row -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
    </section>

  </div>

<!-- Modal start here -->
<div class="modal fade" id="show" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Daily Report</h4>
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
<div class="modal fade" id="show_lihat" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Daily Report</h4>
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
<div class="modal fade" id="show_hapus" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Daily Report</h4>
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