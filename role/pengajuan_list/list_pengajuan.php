<?php
  $listqc_tmp = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM list_reportqc_tmp WHERE form = 'form_pv'"));
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>History Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">History Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row" style="font-size: 12px;">
          <div class="col-12">
            <div class="card">
              <!-- ./card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 12px;">
                  <thead>
                    <tr align="center">
                      <th width="1%">No</th>
                      <th width="">Nama Pekerjaan</th>
                      <th width="20%">Tanggal</th>
                      <th width="15%">Jenis</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 0;
                      $q_getListReportQC = mysqli_query($conn, "SELECT * FROM list_reportqc");
                      while($getListReportQC = mysqli_fetch_array($q_getListReportQC)){
                        $no++;
                    ?>
                      <tr>
                        <td align="center"><?php echo $no; ?></td>
                        <td>
                          <a href="#modal" data-toggle='modal' data-target='#show_detail_reportqc' data-id='<?php echo $getListReportQC['id_form']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit">
                            <?php echo $getListReportQC['nm_pekerjaan'] ?>
                          </a>
                        </td>
                        <td align="center"><?php echo $getListReportQC['tgl'] ?></td>
                        <td align="center"><?php echo $getListReportQC['form'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal start here -->
  <div class="modal fade" id="show_add_list" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Data PV Module</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="index.php?pages=form_pv" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <label>No Serial PV / Barcode</label>
                <input type="text" class="form-control" name="no_seri_pv" required>
              </div>
              <div class="form-group" style="width: 50%;">
                <label>Tegangan PV</label>
                <input type="number" class="form-control" name="tegangan" step="0.01" required>
              </div>
              <div class="form-group" style="width: 50%;">
                <label>Kondisi Fisik</label>
                <select class="form-control" name="kondisi_fisik" required>
                  <option disabled selected>-- Pilih Kondisi --</option>
                  <option value="Baik">Baik</option>
                  <option value="Tidak Baik">Tidak Baik</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jarak Lubang Frame</label>
                <input type="text" class="form-control" name="jarak_lubang_frame" placeholder="Panjang 0 Cm, Lebar 0 Cm">
              </div>
               <div class="form-group">
                <label>Keterangan Tambahan</label>
                <input type="text" class="form-control" name="keterangan_tambahan" placeholder="Kosongkan bila tidak ada">
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" class="form-control" name="foto" required>
              </div>
            </div>
            <div class="card-footer">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="submit" class="btn btn-success float-right" name="submit_form_pv" value="Simpan">
            </div>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_detail_reportqc" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Report QC</h4>
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