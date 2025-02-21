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
            <h1>Stock APD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Database APD</li>
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
                  <a href="#modal" data-toggle='modal' data-target='#show_add_apd' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Hari Libur">
                    <span class="fa fa-plus"></span> Tambah APD Baru
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="8%">ID</th>
                      <th width="">Nama APD</th>
                      <th width="">Tipe</th>
                      <th width="">Merek</th>
                      <th width="9%">Jenis</th>
                      <th width="1%">Qty</th>
                      <th width="1%">Satuan</th>
                      <th width="18%">Harga Satuan <small>(rata-rata)</small></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getAPD = mysqli_query($conn, "SELECT * FROM apd_database ORDER BY id_apd ASC");
                      while($get_APD = mysqli_fetch_array($q_getAPD)){
                        //sum jumlah barang masuk
                        $qty_apdMasuk = 0;
                        $harga_apdMasuk = 0;
                        $q_sumAPDMasuk = mysqli_query($conn, "SELECT * FROM apd_masuk WHERE id_apd = '$get_APD[id_apd]'");
                        while($sum_APDMasuk = mysqli_fetch_array($q_sumAPDMasuk)){
                          $qty_apdMasuk = $qty_apdMasuk + $sum_APDMasuk['jumlah'];
                          $harga_apdMasuk = $harga_apdMasuk + ($sum_APDMasuk['harga_satuan'] * $sum_APDMasuk['jumlah']);
                        }

                        if(rupiah($harga_apdMasuk/$qty_apdMasuk) == "Rp nan"){
                          $harga_rata2 = 0;
                        }else{
                          $harga_rata2 = rupiah($harga_apdMasuk/$qty_apdMasuk);
                        }

                        $get_merek = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM merek WHERE id = '$get_APD[merek]'"));
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                          <span class="badge badge-info" style="padding: 4px;">
                            <?php echo $get_APD['id_apd']; ?>
                          </span>    
                        </td>
                        <td><?php echo $get_APD['nama']; ?></td>
                        <td><?php echo $get_APD['tipe']; ?></td>
                        <td><?php echo $get_merek['merek']; ?></td>
                        <td><?php echo $get_APD['jenis']; ?></td>
                        <td><?php echo $qty_apdMasuk; ?></td>
                        <td><?php echo $get_APD['satuan']; ?></td>
                        <td><?php echo $harga_rata2; ?></td>
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
  <div class="modal fade" id="show_add_apd" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah APD Baru</h4>
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
  <div class="modal fade" id="show_edit_apd" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit APD</h4>
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
  <div class="modal fade" id="show_delete_apd" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete APD</h4>
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