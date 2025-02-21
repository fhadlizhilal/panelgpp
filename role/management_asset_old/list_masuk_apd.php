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
            <h1>List APD Masuk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">APD Masuk</li>
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
                  <a href="index.php?pages=add-masuk-apd"><span class="fa fa-plus"></span> Tambah APD Masuk</a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 10px;">
                  <thead>
                    <tr>
                      <th width="2%">Tanggal Masuk</th>
                      <th width="8%">ID APD</th>
                      <th width="">Nama APD</th>
                      <th width="">Tipe</th>
                      <th width="">Merek</th>
                      <th width="8%">Jenis</th>
                      <th width="">Harga Satuan</th>
                      <th width="2%">Qty</th>
                      <th width="2%">Satuan</th>
                      <th width="6%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getAPDMasuk = mysqli_query($conn, "SELECT * FROM apd_masuk ORDER BY id DESC");
                      while($get_APDMasuk = mysqli_fetch_array($q_getAPDMasuk)){
                        $get_APD = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM apd_database WHERE id_apd = '$get_APDMasuk[id_apd]'"));
                        $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_APD[merek]'"));
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo date('d-m-Y', strtotime($get_APDMasuk['tgl_masuk'])); ?></td>
                        <td>
                          <span class="badge badge-info" style="padding: 4px;">
                            <?php echo $get_APDMasuk['id_apd']; ?>
                          </span>
                        </td>
                        <td><?php echo $get_APD['nama']; ?></td>
                        <td><?php echo $get_APD['tipe']; ?></td>
                        <td><?php echo $get_merek['merek']; ?></td>
                        <td><?php echo $get_APD['jenis']; ?></td>
                        <td><?php echo rupiah($get_APDMasuk['harga_satuan']); ?></td>
                        <td><?php echo $get_APDMasuk['jumlah']; ?></td>
                        <td><?php echo $get_APD['satuan']; ?></td>
                        <td style="font-size: 14px;">
                          <a href="index.php?pages=edit-apdmasuk&id=<?php echo $get_APDMasuk['id']; ?>" data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_apdmasuk' data-id='<?php echo $get_APDMasuk['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
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
  <div class="modal fade" id="show_masuk_apd" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah APD Masuk</h4>
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
  <div class="modal fade" id="show_edit_apdmasuk" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit APD Masuk</h4>
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
  <div class="modal fade" id="show_delete_apdmasuk" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete APD Masuk</h4>
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