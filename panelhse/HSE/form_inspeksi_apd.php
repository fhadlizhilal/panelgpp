<?php
  setlocale(LC_TIME, 'id_ID');
  $get_inspeksilist = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist WHERE id = '$_GET[kd]'"));
  $data_array = explode("/", $get_inspeksilist['kd_weekly']);
  $week = $data_array[1];
  $kd_project = $data_array[2];

  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$kd_project'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inspeksilist[hse_officer]'"));
?>

<style>
    #signaturePad {
        border: 1px solid #000;
        width: 100%;
        height: 200px;
    }
    #error-message {
        color: red;
        display: none;
    }

    #signaturePad_2 {
        border: 1px solid #000;
        width: 100%;
        height: 165px;
    }
    #error-message_2 {
        color: red;
        display: none;
    }
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Inspeksi APD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Data Project</li>
              <li class="breadcrumb-item">Detail Project</li>
              <li class="breadcrumb-item active">Form Inspeksi APD</li>
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
                <h3 class="card-title">Info Project</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-sm" style="font-size: 11px;">
                  <tr>
                    <th width="30%">Nama Project</th>
                    <td width="1%">:</td>
                    <td><?php echo $get_project['nama_project']; ?></td>
                  </tr>
                  <tr>
                    <th>HSE Officer</th>
                    <td>:</td>
                    <td><?php echo $get_hseOfficer['nama']; ?></td>
                  </tr>
                  <tr>
                    <th>Tgl Inspeksi</th>
                    <td>:</td>
                    <td><?php echo date('d-m-Y', strtotime($get_inspeksilist['tanggal_inspeksi'])); ?></td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 350px;">

                <?php if(isset($_GET['edit'])){ ?>
                  <form id="myForm" method="POST" action="index.php?pages=forminspeksiapd&kd=<?php echo $_GET['kd']; ?>">
                    <table id="" class="table table-bordered table-head-fixed table-hover table-sm text-nowrap" style="font-size: 11px;">
                       <thead>
                        <tr>
                          <th width="1%" style="vertical-align: middle;">No</th>
                          <th width="" style="vertical-align: middle;">Nama APD</th>
                          <th width="1%" style="font-size: 8px; vertical-align: middle;"><center>Total<br>Asset</center></th>
                          <th width="1%" style="font-size: 8px; vertical-align: middle;"><center>Jumlah<br>Minggu<br>Ini</center></th>
                          <th width="1%" style="vertical-align: middle; font-size: 8px"><center>Baik</center></th>
                          <th width="1%" style="vertical-align: middle; font-size: 8px"><center>Rusak</center></th>
                          <th width="1%" style="vertical-align: middle; font-size: 8px"><center>Hilang</center></th>
                          <th width="1%" style="vertical-align: middle; font-size: 8px"><center>Satuan</center></th>
                        </tr>
                      </thead>

                    <!-- -----------------List APD Pelindung Kepala---------------------- -->
                      <tbody>
                        <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Pelindung Kepala</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungkepala = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Kepala' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungkepala = mysqli_fetch_array($q_get_apd_pelindungkepala)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_pelindungkepala[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_pelindungkepala[id]'"));

                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];
                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungkepala[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                        <input type="hidden" name="total_asset_<?php echo $get_apd_pelindungkepala['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungkepala['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_pelindungkepala['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_pelindungkepala['id']; ?>" value="<?php echo $jml_mingguini; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" min="0" style="width: 38px" name="baik_<?php echo $get_apd_pelindungkepala['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" min="0" style="width: 38px" name="rusak_<?php echo $get_apd_pelindungkepala['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" min="0" style="width: 38px" name="hilang_<?php echo $get_apd_pelindungkepala['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_pelindungkepala['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Mata---------------------- -->
                        <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Pelindung Mata</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungmata = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Mata' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungmata = mysqli_fetch_array($q_get_apd_pelindungmata)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_pelindungmata[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_pelindungmata[id]'"));
                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];

                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungmata[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                          
                          <input type="hidden" name="total_asset_<?php echo $get_apd_pelindungmata['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungmata['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_pelindungmata['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_pelindungmata['id']; ?>" value="<?php echo $jml_mingguini; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="baik_<?php echo $get_apd_pelindungmata['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="rusak_<?php echo $get_apd_pelindungmata['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="hilang_<?php echo $get_apd_pelindungmata['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_pelindungmata['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Wajah---------------------- -->
                        <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Pelindung Wajah</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungwajah = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Wajah' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungwajah = mysqli_fetch_array($q_get_apd_pelindungwajah)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_pelindungwajah[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_pelindungwajah[id]'"));
                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];

                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungwajah[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                        <input type="hidden" name="total_asset_<?php echo $get_apd_pelindungwajah['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungwajah['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_pelindungwajah['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_pelindungwajah['id']; ?>" value="<?php echo $jml_mingguini; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="baik_<?php echo $get_apd_pelindungwajah['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="rusak_<?php echo $get_apd_pelindungwajah['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="hilang_<?php echo $get_apd_pelindungwajah['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_pelindungwajah['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Telinga---------------------- -->
                      <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Pelindung Telinga</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungtelinga = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Telinga' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungtelinga = mysqli_fetch_array($q_get_apd_pelindungtelinga)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_pelindungtelinga[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_pelindungtelinga[id]'"));
                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];

                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungtelinga[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                        <input type="hidden" name="total_asset_<?php echo $get_apd_pelindungtelinga['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungtelinga['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_pelindungtelinga['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_pelindungtelinga['id']; ?>" value="<?php echo $jml_mingguini; ?>">    
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="baik_<?php echo $get_apd_pelindungtelinga['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="rusak_<?php echo $get_apd_pelindungtelinga['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="hilang_<?php echo $get_apd_pelindungtelinga['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_pelindungtelinga['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Pernafasan---------------------- -->
                      <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Pelindung Pernafasan</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungpernafasan = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Pernafasan' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungpernafasan = mysqli_fetch_array($q_get_apd_pelindungpernafasan)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_pelindungpernafasan[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_pelindungpernafasan[id]'"));
                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];

                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungpernafasan[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                        <input type="hidden" name="total_asset_<?php echo $get_apd_pelindungpernafasan['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungpernafasan['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_pelindungpernafasan['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_pelindungpernafasan['id']; ?>" value="<?php echo $jml_mingguini; ?>">    
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="baik_<?php echo $get_apd_pelindungpernafasan['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="rusak_<?php echo $get_apd_pelindungpernafasan['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="hilang_<?php echo $get_apd_pelindungpernafasan['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_pelindungpernafasan['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Tubuh---------------------- -->
                      <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Pelindung Tubuh</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungtubuh = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Tubuh' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungtubuh = mysqli_fetch_array($q_get_apd_pelindungtubuh)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_pelindungtubuh[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_pelindungtubuh[id]'"));
                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];

                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungtubuh[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                        <input type="hidden" name="total_asset_<?php echo $get_apd_pelindungtubuh['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungtubuh['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_pelindungtubuh['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_pelindungtubuh['id']; ?>" value="<?php echo $jml_mingguini; ?>">    
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="baik_<?php echo $get_apd_pelindungtubuh['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="rusak_<?php echo $get_apd_pelindungtubuh['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="hilang_<?php echo $get_apd_pelindungtubuh['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_pelindungtubuh['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Tangan---------------------- -->
                      <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Pelindung Tangan</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungtangan = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Tangan' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungtangan = mysqli_fetch_array($q_get_apd_pelindungtangan)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_pelindungtangan[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_pelindungtangan[id]'"));
                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];

                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungtangan[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                        <input type="hidden" name="total_asset_<?php echo $get_apd_pelindungtangan['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungtangan['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_pelindungtangan['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_pelindungtangan['id']; ?>" value="<?php echo $jml_mingguini; ?>">    
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="baik_<?php echo $get_apd_pelindungtangan['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="rusak_<?php echo $get_apd_pelindungtangan['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="hilang_<?php echo $get_apd_pelindungtangan['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_pelindungtangan['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Kaki---------------------- -->
                      <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Pelindung Kaki</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungkaki = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Kaki' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungkaki = mysqli_fetch_array($q_get_apd_pelindungkaki)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_pelindungkaki[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_pelindungkaki[id]'"));
                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];

                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungkaki[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                        <input type="hidden" name="total_asset_<?php echo $get_apd_pelindungkaki['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungkaki['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_pelindungkaki['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_pelindungkaki['id']; ?>" value="<?php echo $jml_mingguini; ?>">    
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="baik_<?php echo $get_apd_pelindungkaki['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="rusak_<?php echo $get_apd_pelindungkaki['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="hilang_<?php echo $get_apd_pelindungkaki['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_pelindungkaki['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Full Body Harness---------------------- -->
                      <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Full Body Harness</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_fullbodyharness = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Full Body Harness' ORDER BY nama_apd ASC");
                          while($get_apd_fullbodyharness = mysqli_fetch_array($q_get_apd_fullbodyharness)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_fullbodyharness[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_fullbodyharness[id]'"));
                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];

                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_fullbodyharness[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                        <input type="hidden" name="total_asset_<?php echo $get_apd_fullbodyharness['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_fullbodyharness['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_fullbodyharness['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_fullbodyharness['id']; ?>" value="<?php echo $jml_mingguini; ?>">    
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="baik_<?php echo $get_apd_fullbodyharness['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="rusak_<?php echo $get_apd_fullbodyharness['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="hilang_<?php echo $get_apd_fullbodyharness['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_fullbodyharness['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Alat Kerja / Material---------------------- -->
                      <tr>
                          <td colspan="8"><div style="font-size: 12px; font-weight: bold;">Pelindung Alat Kerja / Material</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungalatkerja = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Alat Kerja / Material' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungalatkerja = mysqli_fetch_array($q_get_apd_pelindungalatkerja)){
                            $total_asset = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(hse_toolsapdonsite_detailapd.jumlah) AS total_asset FROM hse_toolsapdonsite_detailapd JOIN hse_toolsapdonsite ON hse_toolsapdonsite_detailapd.id_onsite = hse_toolsapdonsite.id WHERE hse_toolsapdonsite_detailapd.apd_id = $get_apd_pelindungalatkerja[id] AND hse_toolsapdonsite.project_id = '$kd_project' AND hse_toolsapdonsite.status = 'completed' AND hse_toolsapdonsite.tgl_onsite <= '$get_inspeksilist[tanggal_inspeksi]'"));

                            $t_pengurang = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(rusak + hilang) AS t_rusak_hilang FROM hse_inspeksilist JOIN hse_inspeksilist_detailapd ON hse_inspeksilist.id = hse_inspeksilist_detailapd.inspeksi_id WHERE hse_inspeksilist.status = 'completed' AND hse_inspeksilist.kd_weekly LIKE '%/$kd_project' AND hse_inspeksilist_detailapd.apd_id = '$get_apd_pelindungalatkerja[id]'"));
                            $jml_mingguini = $total_asset['total_asset'] - $t_pengurang['t_rusak_hilang'];

                            $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungalatkerja[id]'"));
                            $deviasi = 100-($jml_mingguini/$total_asset['total_asset']*100);
                        ?>
                        <input type="hidden" name="total_asset_<?php echo $get_apd_pelindungalatkerja['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">

                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungalatkerja['nama_apd']; ?></td>
                            <td>
                              <?php echo $total_asset['total_asset']; ?>
                              <input type="hidden" name="total_<?php echo $get_apd_pelindungalatkerja['id']; ?>" value="<?php echo $total_asset['total_asset']; ?>">
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $jml_mingguini; } ?>
                              <input type="hidden" name="jml_mingguini_<?php echo $get_apd_pelindungalatkerja['id']; ?>" value="<?php echo $jml_mingguini; ?>">    
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="baik_<?php echo $get_apd_pelindungalatkerja['id']; ?>" value="<?php echo $get_list['baik']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="rusak_<?php echo $get_apd_pelindungalatkerja['id']; ?>" value="<?php echo $get_list['rusak']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ ?>
                                <input type="number" style="width: 38px" min="0" name="hilang_<?php echo $get_apd_pelindungalatkerja['id']; ?>" value="<?php echo $get_list['hilang']; ?>">
                              <?php } ?>
                            </td>
                            <td>
                              <?php if($total_asset['total_asset'] > 0){ echo $get_apd_pelindungalatkerja['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                    
                    <!-- ------------------ DOKUMENTASI INSPEKSI APD ------------------------- -->
                    <center>
                      <div style="font-size: 24px; font-weight: bold; margin-bottom: -5px;">Dokumentasi</div>
                      <a href="#modal" data-toggle='modal' data-target='#add_dokumentasi_inspeksiapd' data-id='<?php echo $get_Project['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Dokumentasi">
                        <div class="badge badge-info"><small><span class="fa fa-plus"></span> Tambah Dokumentasi</small></div>
                      </a>
                    </center>
                    <table class="table table-bordered table-head-fixed table-hover table-sm text-nowrap" style="font-size: 11px; margin-top: 15px;">
                      <thead>
                        <tr>
                          <th width="1%">No</th>
                          <th>Foto</th>
                          <th width="1#">#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no=1;
                          $q_getfoto_inspeksi_apd = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotoapd WHERE inspeksi_id = '$_GET[kd]'");
                          while($getfoto_inspeksi_apd = mysqli_fetch_array($q_getfoto_inspeksi_apd)){
                        ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td>
                                <img src="../../role/HSE/foto_inspeksi_apd/<?php echo $getfoto_inspeksi_apd["foto"]; ?>" width="100%"><br>
                                <center>Ket : <?php echo $getfoto_inspeksi_apd["keterangan"]; ?></center>
                              </td>
                              <td>
                                <a href="#modal" data-toggle='modal' data-target='#delete_dokumentasi_inspeksiapd' data-id='<?php echo $getfoto_inspeksi_apd['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Hapus">
                                  <span class="fa fa-close" style="font-size: 14px; color: red;"></span>
                                </a>
                              </td>
                            </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                    <br>

                <!-- ------------------------------------- REKOMENDASI --------------------- -->
                    <center>
                      <div style="font-size: 24px; font-weight: bold;">Rekomendasi</div>
                      <textarea class="form-control form-control-sm" style="margin-left: 10px; margin-right: 10px; height: 100px;" name="rekomendasi" placeholder="Harap isi rekomendasi jika diperlukan"><?php echo $get_inspeksilist['rekomendasi']; ?></textarea>
                    </center>
                    <br>

                    <div class="row">
                      <div class="col-md-4 col-4"></div>
                      <div class="col-md-4 col-4">
                        <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd']; ?>">
                        <input type="submit" class="btn btn-info" name="simpan_inspeksi_detailapd" value="Simpan" style="width: 100%">
                      </div>
                    </div>
                    <br>
                  </form>

  <!-- ---------------------------------------------------------------------------------------- -->

                <?php }else{ ?>

                    <table id="" class="table table-bordered table-head-fixed table-hover table-sm text-nowrap" style="font-size: 11px;">
                       <thead>
                        <tr>
                          <th width="1%" style="vertical-align: middle;">No</th>
                          <th width="" style="vertical-align: middle;">Nama APD</th>
                          <th width="1%" style="font-size: 8px; vertical-align: middle;"><center>Total<br>Asset</center></th>
                          <th width="1%" style="font-size: 8px; vertical-align: middle;"><center>Jumlah<br>Minggu<br>Ini</center></th>
                          <th width="1%" style="vertical-align: middle; font-size: 8px"><center>Baik</center></th>
                          <th width="1%" style="vertical-align: middle; font-size: 8px"><center>Rusak</center></th>
                          <th width="1%" style="vertical-align: middle; font-size: 8px"><center>Hilang</center></th>
                          <th width="1%" style="vertical-align: middle; font-size: 8px"><center>Jumlah</center></th>
                          <th width="1%" style="vertical-align: middle; font-size: 8px"><center>Satuan</center></th>
                        </tr>
                      </thead>

                    <!-- -----------------List APD Pelindung Kepala---------------------- -->
                      <tbody>
                        <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Pelindung Kepala</div></td>
                        </tr>
                        <?php
                          $cek_tidaksesuai = 0;
                          $cek_dokumentasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotoapd WHERE inspeksi_id = '$_GET[kd]'"));
                          $no=1;
                          $q_get_apd_pelindungkepala = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Kepala' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungkepala = mysqli_fetch_array($q_get_apd_pelindungkepala)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungkepala[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungkepala['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_pelindungkepala['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Mata---------------------- -->
                        <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Pelindung Mata</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungmata = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Mata' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungmata = mysqli_fetch_array($q_get_apd_pelindungmata)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungmata[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungmata['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_pelindungmata['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Wajah---------------------- -->
                        <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Pelindung Wajah</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungwajah = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Wajah' ORDER BY nama_apd ASC");
                          while($get_apd_pelindunwajah = mysqli_fetch_array($q_get_apd_pelindungwajah)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindunwajah[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindunwajah['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_pelindunwajah['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Telinga---------------------- -->
                      <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Pelindung Telinga</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungtelinga = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Telinga' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungtelinga = mysqli_fetch_array($q_get_apd_pelindungtelinga)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungtelinga[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungtelinga['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_pelindungtelinga['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Pernafasan---------------------- -->
                      <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Pelindung Pernafasan</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungpernafasan = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Pernafasan' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungpernafasan = mysqli_fetch_array($q_get_apd_pelindungpernafasan)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungpernafasan[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungpernafasan['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_pelindungpernafasan['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Tubuh---------------------- -->
                      <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Pelindung Tubuh</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungtubuh = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Tubuh' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungtubuh = mysqli_fetch_array($q_get_apd_pelindungtubuh)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungtubuh[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungtubuh['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_pelindungtubuh['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Tangan---------------------- -->
                      <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Pelindung Tangan</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungtangan = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Tangan' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungtangan = mysqli_fetch_array($q_get_apd_pelindungtangan)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungtangan[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungtangan['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_pelindungtangan['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Kaki---------------------- -->
                      <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Pelindung Kaki</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungkaki = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Kaki' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungkaki = mysqli_fetch_array($q_get_apd_pelindungkaki)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungkaki[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungkaki['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_pelindungkaki['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Full Body Harness---------------------- -->
                      <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Full Body Harness</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_fullbodyharness = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Full Body Harness' ORDER BY nama_apd ASC");
                          while($get_apd_fullbodyharness = mysqli_fetch_array($q_get_apd_fullbodyharness)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_fullbodyharness[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_fullbodyharness['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_fullbodyharness['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>

                      <!-- -----------------List APD Pelindung Alat Kerja / Material---------------------- -->
                      <tr>
                          <td colspan="9"><div style="font-size: 12px; font-weight: bold;">Pelindung Alat Kerja / Material</div></td>
                        </tr>
                        <?php
                          $no=1;
                          $q_get_apd_pelindungalatkerja = mysqli_query($conn, "SELECT * FROM hse_apd WHERE jenis = 'Pelindung Alat Kerja / Material' ORDER BY nama_apd ASC");
                          while($get_apd_pelindungalatkerja = mysqli_fetch_array($q_get_apd_pelindungalatkerja)){
                            $get_inspeksilist_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapd WHERE inspeksi_id = '$_GET[kd]' AND apd_id = '$get_apd_pelindungalatkerja[id]'"));
                            $jumlah = $get_inspeksilist_detailapd['baik']+$get_inspeksilist_detailapd['rusak']+$get_inspeksilist_detailapd['hilang'];
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd_pelindungalatkerja['nama_apd']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['total_asset']; ?></td>
                            <td><?php echo '<b>'.$get_inspeksilist_detailapd['jumlah_minggu_ini'].'</b>'; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['baik']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['rusak']; ?></td>
                            <td><?php echo $get_inspeksilist_detailapd['hilang']; ?></td>
                            <td <?php if($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] == $jumlah){ echo "style='background-color: #9cff9d'"; }elseif($get_inspeksilist_detailapd['total_asset'] > 0 AND $get_inspeksilist_detailapd['jumlah_minggu_ini'] <> $jumlah){ echo "style='background-color: pink'"; $cek_tidaksesuai++; } ?>>
                              <?php 
                                if($get_inspeksilist_detailapd['total_asset'] > 0){ 
                                  echo '<b>'.$jumlah.'</b>';
                                }
                              ?>
                            </td>
                            <td>
                              <?php if($get_inspeksilist_detailapd['total_asset'] > 0){ echo $get_apd_pelindungalatkerja['satuan']; }?>
                            </td>
                          </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>


                    <!-- ------------------ DOKUMENTASI INSPEKSI APD ------------------------- -->
                    <center>
                      <div style="font-size: 24px; font-weight: bold; margin-bottom: -5px;">Dokumentasi</div>
                      <?php
                        if($cek_dokumentasi < 4){
                          echo "<small style='color: red;'>* Dokumentasi Inspeksi Minimal 4 Foto</small>";
                        }
                      ?>
                    </center>
                    <table class="table table-bordered table-head-fixed table-hover table-sm text-nowrap" style="font-size: 11px; margin-top: 15px;">
                      <thead>
                        <tr>
                          <th width="1%">No</th>
                          <th>Foto</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no=1;
                          $q_getfoto_inspeksi_apd = mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotoapd WHERE inspeksi_id = '$_GET[kd]'");
                          while($getfoto_inspeksi_apd = mysqli_fetch_array($q_getfoto_inspeksi_apd)){
                        ?>
                            <tr>
                              <td><?php echo $no; ?></td>
                              <td>
                                <img src="../../role/HSE/foto_inspeksi_apd/<?php echo $getfoto_inspeksi_apd["foto"]; ?>" width="100%"><br>
                                <center>Ket : <?php echo $getfoto_inspeksi_apd["keterangan"]; ?></center>
                              </td>
                            </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                    <br>

                    <!-- ------------------------------------- REKOMENDASI --------------------- -->
                    <center>
                      <div style="font-size: 24px; font-weight: bold;">Rekomendasi</div>
                      <textarea class="form-control form-control-sm" style="margin-left: 10px; margin-right: 10px; height: 100px;" disabled><?php echo $get_inspeksilist['rekomendasi']; ?></textarea>
                    </center>
                    <br>

                    <!-- ------------------ APPROVAL ------------------------- -->
                    <center>
                      <div style="font-size: 24px; font-weight: bold; margin-bottom: -5px;">Approval</div>
                    </center>
                    <br>

                    <div class="row">
                      <div class="col-6">
                        <?php if($get_inspeksilist['ttd_hse']==""){ ?>
                          <form id="signatureForm" method="POST" action="">
                            <center>
                              <div class="form-group">
                                <label for="signaturePad">Diperiksa Oleh<br><small>HSE Officer</small></label>
                                <canvas id="signaturePad"></canvas>
                                <input type="hidden" id="signatureImage" name="signatureImage">
                                <div id="error-message"><small>Tanda tangan anda disini.</small></div>
                              </div>
                              <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd'] ?>">
                              <button type="button" class="btn btn-sm btn-secondary" id="clearButton">Clear</button>
                              <button type="submit" class="btn btn-sm btn-primary" id="submitButton" name="ttd_apd_hse" disabled>Simpan</button>
                            </center>
                          </form>
                        <?php }else{ ?>
                          <div class="btn btn-sm btn-success" style="width: 100%"><span class="fa fa-check"></span><br>HSE OFFICER</div>
                        <?php } ?>
                      </div>
                      <div class="col-6">
                        <?php if($get_inspeksilist['ttd_sm']==""){ ?>
                          <form id="signatureForm_2" method="POST" action="">
                            <center>
                              <div class="form-group">
                                <label for="signaturePad_2">Disetujui Oleh<br><small>Site Manager</small></label>
                                <input type="text" class="form-control form-control-sm" name="site_manager" style="margin-bottom: 5px;" placeholder="Nama Site Manager" required>
                                <canvas id="signaturePad_2"></canvas>
                                <input type="hidden" id="signatureImage_2" name="signatureImage_2">
                                <div id="error-message_2"><small>Tanda tangan anda disini.</small></div>
                              </div>
                              <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd'] ?>">
                              <button type="button" class="btn btn-sm btn-secondary" id="clearButton_2">Clear</button>
                              <button type="submit" class="btn btn-sm btn-primary" id="submitButton_2" name="ttd_apd_sm" disabled>Simpan</button>
                            </center>
                          </form>
                        <?php }else{ ?>
                          <div class="btn btn-sm btn-success" style="width: 100%"><span class="fa fa-check"></span><br>HSE OFFICER</div>
                        <?php } ?>
                      </div>
                    </div>
                    <hr>

                  <form id="myForm" method="POST" action="index.php?pages=forminspeksiapd&kd=<?php echo $_GET['kd']; ?>">
                    <div class="row">
                      <div class="col-md-4 col-4">
                        <a href="index.php?pages=forminspeksiapd&kd=<?php echo $_GET['kd']; ?>&edit=on">
                          <div class="btn btn-warning" style="width: 100%">Edit</div>
                        </a>
                      </div>
                      <div class="col-md-4 col-4">
                        <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd']; ?>">
                        <input type="hidden" name="kd_project" value="<?php echo $kd_project; ?>">
                        <input type="submit" class="btn btn-success" name="submit_inspeksi_detailapd" value="Submit" style="width: 100%" onclick="return confirm('Yakin data sudah sesuai? untuk edit setelah submit harus menghubungi HSE OFficer!')" <?php if($cek_tidaksesuai > 0 OR $cek_dokumentasi < 4 OR $get_inspeksilist['ttd_hse'] == "" OR $get_inspeksilist['ttd_sm'] == ""){ echo "disabled"; } ?>>
                      </div>
                      <div class="col-md-4 col-4">
                        <input type="submit" class="btn btn-danger" name="delete_form_inspeksiapd" value="Delete" style="width: 100%" onclick="return confirm('Yakin Delete Form Inspeksi Ini?')">
                      </div>
                    </div>
                    <br>
                  </form>

                <?php } ?>

                <div class="loading-overlay" id="loadingOverlay">
                  <div class="loading-spinner"></div>
                </div>

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
  <div class="modal fade" id="add_dokumentasi_inspeksiapd" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Dokumentasi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-3 col-form-label" style="font-size: 12px;">Foto</label>
              <div class="col-9">
                <input type="file" class="form-control form-control-sm" name="file">
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-3 col-form-label" style="font-size: 12px;">Keterangan</label>
              <div class="col-9">
                <textarea class="form-control form-control-sm" name="keterangan"></textarea>
              </div>
            </div>

            <br>
            <center>
              <input type="hidden" name="inspeksi_id" value="<?php echo $_GET['kd'] ?>">
              <input type="submit" class="btn btn-info" name="add_dokumentasi_inspeksiapd" value="Simpan">
            </center>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="delete_dokumentasi_inspeksiapd" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Dokumentasi</h4>
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

<script>
  $(document).ready(function() {
      const canvas = document.getElementById('signaturePad');
      const ctx = canvas.getContext('2d');
      const submitButton = document.getElementById('submitButton');
      let isDrawing = false;

      // Adjust canvas size based on container dimensions
      function resizeCanvas() {
          const canvasContainer = canvas.parentNode;
          canvas.width = canvasContainer.offsetWidth;
          canvas.height = 200;
      }
      
      // Initial canvas size adjustment
      resizeCanvas();
      
      // Adjust the canvas size when window is resized
      window.addEventListener('resize', resizeCanvas);

      function getPointerPos(event) {
          const rect = canvas.getBoundingClientRect();
          let clientX, clientY;

          if (event.touches) {
              clientX = event.touches[0].clientX;
              clientY = event.touches[0].clientY;
          } else {
              clientX = event.clientX;
              clientY = event.clientY;
          }

          return {
              x: clientX - rect.left,
              y: clientY - rect.top
          };
      }

      function startDrawing(event) {
          isDrawing = true;
          const pos = getPointerPos(event);
          ctx.beginPath();
          ctx.moveTo(pos.x, pos.y);
          event.preventDefault();
          toggleSubmitButton();
      }

      function draw(event) {
          if (isDrawing) {
              const pos = getPointerPos(event);
              ctx.lineTo(pos.x, pos.y);
              ctx.stroke();
              toggleSubmitButton();
          }
          event.preventDefault();
      }

      function stopDrawing() {
          isDrawing = false;
          toggleSubmitButton();
      }

      function toggleSubmitButton() {
          if (isCanvasEmpty()) {
              submitButton.disabled = true;
              $('#error-message').show();
          } else {
              submitButton.disabled = false;
              $('#error-message').hide();
          }
      }

      function isCanvasEmpty() {
          const blank = document.createElement('canvas');
          blank.width = canvas.width;
          blank.height = canvas.height;
          return canvas.toDataURL() === blank.toDataURL();
      }

      // Mouse events
      canvas.addEventListener('mousedown', startDrawing);
      canvas.addEventListener('mousemove', draw);
      canvas.addEventListener('mouseup', stopDrawing);
      canvas.addEventListener('mouseout', stopDrawing);

      // Touch events
      canvas.addEventListener('touchstart', startDrawing);
      canvas.addEventListener('touchmove', draw);
      canvas.addEventListener('touchend', stopDrawing);
      canvas.addEventListener('touchcancel', stopDrawing);

      $('#clearButton').click(function() {
          ctx.clearRect(0, 0, canvas.width, canvas.height);
          $('#error-message').hide();
          toggleSubmitButton();
      });

      $('#signatureForm').submit(function(e) {
          if (isCanvasEmpty()) {
              e.preventDefault();
              $('#error-message').show();
          } else {
              const signatureDataURL = canvas.toDataURL();
              $('#signatureImage').val(signatureDataURL);
              $('#error-message').hide();
          }
      });

      toggleSubmitButton();
  });
</script>


<script>
  $(document).ready(function() {
      const canvas = document.getElementById('signaturePad_2');
      const ctx = canvas.getContext('2d');
      const submitButton = document.getElementById('submitButton_2');
      let isDrawing = false;

      // Adjust canvas size based on container dimensions
      function resizeCanvas() {
          const canvasContainer = canvas.parentNode;
          canvas.width = canvasContainer.offsetWidth;
          canvas.height = 200;
      }
      
      // Initial canvas size adjustment
      resizeCanvas();
      
      // Adjust the canvas size when window is resized
      window.addEventListener('resize', resizeCanvas);

      function getPointerPos(event) {
          const rect = canvas.getBoundingClientRect();
          let clientX, clientY;

          if (event.touches) {
              clientX = event.touches[0].clientX;
              clientY = event.touches[0].clientY;
          } else {
              clientX = event.clientX;
              clientY = event.clientY;
          }

          return {
              x: clientX - rect.left,
              y: clientY - rect.top
          };
      }

      function startDrawing(event) {
          isDrawing = true;
          const pos = getPointerPos(event);
          ctx.beginPath();
          ctx.moveTo(pos.x, pos.y);
          event.preventDefault();
          toggleSubmitButton();
      }

      function draw(event) {
          if (isDrawing) {
              const pos = getPointerPos(event);
              ctx.lineTo(pos.x, pos.y);
              ctx.stroke();
              toggleSubmitButton();
          }
          event.preventDefault();
      }

      function stopDrawing() {
          isDrawing = false;
          toggleSubmitButton();
      }

      function toggleSubmitButton() {
          if (isCanvasEmpty()) {
              submitButton.disabled = true;
              $('#error-message_2').show();
          } else {
              submitButton.disabled = false;
              $('#error-message_2').hide();
          }
      }

      function isCanvasEmpty() {
          const blank = document.createElement('canvas');
          blank.width = canvas.width;
          blank.height = canvas.height;
          return canvas.toDataURL() === blank.toDataURL();
      }

      // Mouse events
      canvas.addEventListener('mousedown', startDrawing);
      canvas.addEventListener('mousemove', draw);
      canvas.addEventListener('mouseup', stopDrawing);
      canvas.addEventListener('mouseout', stopDrawing);

      // Touch events
      canvas.addEventListener('touchstart', startDrawing);
      canvas.addEventListener('touchmove', draw);
      canvas.addEventListener('touchend', stopDrawing);
      canvas.addEventListener('touchcancel', stopDrawing);

      $('#clearButton_2').click(function() {
          ctx.clearRect(0, 0, canvas.width, canvas.height);
          $('#error-message_2').hide();
          toggleSubmitButton();
      });

      $('#signatureForm_2').submit(function(e) {
          if (isCanvasEmpty()) {
              e.preventDefault();
              $('#error-message_2').show();
          } else {
              const signatureDataURL = canvas.toDataURL();
              $('#signatureImage_2').val(signatureDataURL);
              $('#error-message_2').hide();
          }
      });

      toggleSubmitButton();
  });
</script>