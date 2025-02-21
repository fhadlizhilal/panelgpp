<?php
  function rupiah($angka){
  
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
 
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List Tools Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tools Masuk</li>
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
                  <a href="index.php?pages=add-masuk-tools"><span class="fa fa-plus"></span> Tambah Tools Masuk</a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">No Masuk</th>
                      <th width="10%">Tgl Masuk</th>
                      <th width="12%">Kode Project</th>
                      <th width="">Total Nilai</th>
                      <th width="">Keterangan</th>
                      <th width="4%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getToolsMasuk = mysqli_query($conn, "SELECT * FROM tools_masuk ORDER BY id DESC");
                      while($get_toolsMasuk = mysqli_fetch_array($q_getToolsMasuk)){
                        $i++;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_tools_masuk' data-id='<?php echo $get_toolsMasuk["no_masuk"]; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail">
                            <?php echo $get_toolsMasuk["no_masuk"]; ?>
                          </a>
                        </td>
                        <td><?php echo $get_toolsMasuk["tgl_masuk"]; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_project' data-id='<?php echo $get_toolsMasuk["kd_project"]; ?>' data-toggle="tooltip" data-placement="bottom" title="Detail Project">
                            <?php echo $get_toolsMasuk["kd_project"]; ?>
                          </a>
                        </td>
                        <td>
                          <?php
                            $total_nilai = 0;
                            $q_ToolsMasukDetail = mysqli_query($conn, "SELECT * FROM tools_masuk_detail WHERE no_masuk = '$get_toolsMasuk[no_masuk]'");
                            while($get_tools_detail = mysqli_fetch_array($q_ToolsMasukDetail)){
                              $total_nilai =  $total_nilai + ($get_tools_detail['qty'] * $get_tools_detail['harga_satuan']);
                            }

                            echo "Rp ".number_format($total_nilai,0);
                          ?>
                        </td>
                        <td><?php echo $get_toolsMasuk["keterangan"]; ?></td>
                        <td style="font-size: 14px;">
                          <a href="index.php?pages=edit-toolsmasuk&id=<?php echo $get_toolsMasuk['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a>
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
  <div class="modal fade" id="show_detail_tools_masuk" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Tools Masuk</h4>
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
  <div class="modal fade" id="show_detail_project" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Project</h4>
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