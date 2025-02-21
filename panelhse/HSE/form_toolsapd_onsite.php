<?php
  setlocale(LC_TIME, 'id_ID');
  $get_data_onsite = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite WHERE id = '$_GET[kdonsite]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_data_onsite[project_id]'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_data_onsite[hse_officer]'"));
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Tools & APD Onsite</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Data Project</li>
              <li class="breadcrumb-item">Detail Project</li>
              <li class="breadcrumb-item active">Form Tools & APD Onsite</li>
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
                    <th>Tgl Onsite</th>
                    <td>:</td>
                    <td><?php echo $get_data_onsite['tgl_onsite']; ?></td>
                  </tr>
                  <tr>
                    <th>Keterangan</th>
                    <td>:</td>
                    <td><?php echo $get_data_onsite['keterangan']; ?></td>
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
              <div class="card-header">
                <h3 class="card-title">Tools & APD Detail</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php if(!isset($_GET['edit'])){ ?>
                  <form id="myForm" method="POST" action="index.php?pages=detailproject&kd=<?php echo $_GET['kd']; ?>">
                    <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                        <tr>
                          <th width="1%">No</th>
                          <th width="">Nama Barang</th>
                          <th width="20%">Jumlah</th>
                          <th width="10%">Satuan</th>
                        </tr>
                        <tr>
                          <td colspan="4"><div style="font-size: 12px; font-weight: bold;">APD</div></td>
                        </tr>
                        <?php
                          $no = 1;
                          $q_getAPD = mysqli_query($conn, "SELECT * FROM hse_apd");
                          while($get_apd = mysqli_fetch_array($q_getAPD)){
                            $get_toolsapdonsite_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite_detailapd WHERE id_onsite = '$_GET[kdonsite]' AND apd_id = '$get_apd[id]'"));
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_apd['nama_apd']; ?></td>
                            <td><?php echo $get_toolsapdonsite_detailapd['jumlah']; ?></td>
                            <td><?php echo $get_apd['satuan']; ?></td>
                          </tr>
                        <?php $no++; } ?>
                        <tr>
                          <td colspan="4"><div style="font-size: 12px; font-weight: bold;">Tools K3</div></td>
                        </tr>
                        <?php
                          $no = 1;
                          $q_getToolsk3 = mysqli_query($conn, "SELECT * FROM hse_toolsk3");
                          while($get_ToolsK3 = mysqli_fetch_array($q_getToolsk3)){
                            $get_toolsapdonsite_detailtoolsk3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite_detailtoolsk3 WHERE id_onsite = '$_GET[kdonsite]' AND toolsk3_id = '$get_ToolsK3[id]'"));
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_ToolsK3['nama_tools']; ?></td>
                            <td><?php echo $get_toolsapdonsite_detailtoolsk3['jumlah']; ?></td>
                            <td></td>
                          </tr>
                        <?php $no++; } ?>
                        <tr>
                          <td colspan="4"><div style="font-size: 12px; font-weight: bold;">Tools</div></td>
                        </tr>
                        <?php
                          $no = 1;
                          $q_getTools = mysqli_query($conn, "SELECT * FROM hse_tools");
                          while($get_Tools = mysqli_fetch_array($q_getTools)){
                            $get_toolsapdonsite_detailtools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite_detailtools WHERE id_onsite = '$_GET[kdonsite]' AND tools_id = '$get_Tools[id]'"));
                        ?>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_Tools['tools']; ?></td>
                            <td><?php echo $get_toolsapdonsite_detailtools['jumlah']; ?></td>
                            <td></td>
                          </tr>
                        <?php $no++; } ?>
                    </table>
                    <div class="row">
                      <div class="col-md-4 col-4">
                        <a href="index.php?pages=form_toolsapdonsite_detail&kd=<?php echo $_GET['kd']; ?>&kdonsite=<?php echo $_GET['kdonsite']; ?>&edit=on" data-toggle="tooltip" data-placement="bottom" title="Edit">
                          <div class="btn btn-info" style="width: 100%">Edit</div>
                        </a>
                      </div>
                      <div class="col-md-4 col-4">
                        <input type="hidden" name="kd_onsite" value="<?php echo $_GET['kdonsite']; ?>">
                        <input type="submit" class="btn btn-success" name="submit_toolsapdonsite_detail" value="Submit" style="width: 100%" onclick="return confirm('Yakin data sudah sesuai? untuk edit setelah submit harus menghubungi HSE OFficer!')">
                      </div>
                      <div class="col-md-4 col-4">
                        <input type="submit" class="btn btn-danger" name="delete_form_onsite" value="Delete" style="width: 100%" onclick="return confirm('Yakin Delete Form Tools APD Onsite Ini?')">
                      </div>
                    </div>
                    <br>
                  </form>

                <?php }else{ ?>
                  <form id="myForm" method="POST" action="index.php?pages=form_toolsapdonsite_detail&kd=<?php echo $_GET['kd']; ?>&kdonsite=<?php echo $_GET['kdonsite']; ?>">
                    <table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                      <tr>
                        <th width="1%">No</th>
                        <th width="">Nama Barang</th>
                        <th width="25%">Jumlah</th>
                      </tr>
                      <tr>
                        <td colspan="3"><div style="font-size: 12px; font-weight: bold;">APD</div></td>
                      </tr>
                      <?php
                        $no = 1;
                        $q_getAPD = mysqli_query($conn, "SELECT * FROM hse_apd");
                        while($get_apd = mysqli_fetch_array($q_getAPD)){
                          $get_toolsapdonsite_detailapd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite_detailapd WHERE id_onsite = '$_GET[kdonsite]' AND apd_id = '$get_apd[id]'"));
                      ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_apd['nama_apd']; ?></td>
                          <td>
                            <input type="text" style="width: 90%" name="jml_apd_<?php echo $get_apd['id']; ?>" value="<?php echo $get_toolsapdonsite_detailapd['jumlah']; ?>">
                          </td>
                        </tr>
                      <?php $no++; } ?>
                      <tr>
                        <td colspan="3"><div style="font-size: 12px; font-weight: bold;">Tools K3</div></td>
                      </tr>
                      <?php
                        $no = 1;
                        $q_getToolsk3 = mysqli_query($conn, "SELECT * FROM hse_toolsk3");
                        while($get_ToolsK3 = mysqli_fetch_array($q_getToolsk3)){
                          $get_toolsapdonsite_detailtoolsk3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite_detailtoolsk3 WHERE id_onsite = '$_GET[kdonsite]' AND toolsk3_id = '$get_ToolsK3[id]'"));
                      ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_ToolsK3['nama_tools']; ?></td>
                          <td>
                            <input type="text" style="width: 90%" name="jml_toolsk3_<?php echo $get_ToolsK3['id']; ?>" value="<?php echo $get_toolsapdonsite_detailtoolsk3['jumlah']; ?>">
                          </td>
                        </tr>
                      <?php $no++; } ?>
                      <tr>
                        <td colspan="3"><div style="font-size: 12px; font-weight: bold;">Tools</div></td>
                      </tr>
                      <?php
                        $no = 1;
                        $q_getTools = mysqli_query($conn, "SELECT * FROM hse_tools");
                        while($get_Tools = mysqli_fetch_array($q_getTools)){
                          $get_toolsapdonsite_detailtools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite_detailtools WHERE id_onsite = '$_GET[kdonsite]' AND tools_id = '$get_Tools[id]'"));
                      ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_Tools['tools']; ?></td>
                          <td><input type="text" style="width: 90%" name="jml_tools_<?php echo $get_Tools['id']; ?>" value="<?php echo $get_toolsapdonsite_detailtools['jumlah']; ?>"></td>
                        </tr>
                      <?php $no++; } ?>
                    </table>
                    <div class="row">
                      <div class="col-md-4 col-4"></div>
                      <div class="col-md-4 col-4">
                        <input type="hidden" name="id_onsite" value="<?php echo $_GET['kdonsite'] ?>">
                        <input type="submit" class="btn btn-success btn-sm" name="simpan_toolsapdonsite_detail" value="Simpan">
                      </div>
                    </div>
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