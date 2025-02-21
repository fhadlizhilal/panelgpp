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

  function hari_indo($tanggal){
    $hari = array ( 1 =>    'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        );

    $num = date('N', strtotime($tanggal));
    return $hari[$num];
  }

  $getSetting = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM setting WHERE id = '1'"));
?>

          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0">Pengaturan</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Pengaturan</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <h5 class="mb-2">Torelansi Perbulan</h5>
                <div class="row">
                  <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Toleransi</span>
                        <span class="info-box-number"><?php echo $getSetting['toleransi']." Menit" ?></span>
                      </div>
                    </div>
                  </div>
                </div>

                <h5 class="mb-2">Potongan</h5>

                <div class="row">
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Kehadiran</span>
                        <span class="info-box-number"><?php echo $getSetting['potongan_kehadiran']." %" ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Terlambat</span>
                        <span class="info-box-number"><?php echo $getSetting['potongan_terlambat']." %" ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Program</span>
                        <span class="info-box-number"><?php echo $getSetting['potongan_program']." %" ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Grooming</span>
                        <span class="info-box-number"><?php echo $getSetting['potongan_grooming']." %" ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Output</span>
                        <span class="info-box-number"><?php echo $getSetting['potongan_output']." %" ?></span>
                      </div>
                    </div>
                  </div>
                </div>

                <h5 class="mb-2">Cuti</h5>

                <div class="row">
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Tahunan</span>
                        <span class="info-box-number"><?php echo $getSetting['cuti_tahunan']." Hari" ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Melahirkan (P)</span>
                        <span class="info-box-number"><?php echo $getSetting['cuti_melahirkanP']." Hari" ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Melahirkan (L)</span>
                        <span class="info-box-number"><?php echo $getSetting['cuti_melahirkanL']." Hari" ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Ibadah</span>
                        <span class="info-box-number"><?php echo $getSetting['cuti_ibadah']." Hari" ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-6 col-12">
                    <div class="info-box">
                      <div class="info-box-content">
                        <span class="info-box-text">Menikah</span>
                        <span class="info-box-number"><?php echo $getSetting['cuti_menikah']." Hari" ?></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>


        </div>
        <!-- /.row -->
    </section>

  </div>