<?php
  date_default_timezone_set('Asia/Jakarta');

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
            <h1>New Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Project</li>
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
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listproject" enctype="multipart/form-data" style="font-size: 14px;">
                  <div class="card-body">
                    
                    <?php
                      if($_SESSION['nama'] == 'Syifah Sofianty Dewi'){
                    ?>
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Kode Project</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="kode_project" placeholder="Kode Project">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sales</label>
                        <div class="col-sm-9">
                          <select class="form-control" name="nik_sales" required>
                            <option value="" selected disabled>--- Pilih Sales ---</option>
                            <?php
                              $q_sales = mysqli_query($conn, "SELECT * FROM karyawan WHERE jabatan_id >= '4' AND jabatan_id <= '7'");
                              while($get_sales = mysqli_fetch_array($q_sales)){
                            ?>
                              <option value="<?php echo $get_sales['nik']; ?>"><?php echo $get_sales['nik']." - ".$get_sales['nama']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                    <?php }else{ ?>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Sales</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="_nik" value="<?php echo $_SESSION['nik']." - ".$_SESSION['nama']; ?>" disabled>
                        </div>
                      </div>

                    <?php } ?>

                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Badan</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="badan" required>
                          <option value="" selected disabled>--- Pilih Badan ---</option>
                          <?php
                            $q_badan = mysqli_query($conn, "SELECT * FROM badan");
                            while($get_badan = mysqli_fetch_array($q_badan)){ 
                          ?>
                            <option value="<?php echo $get_badan['kd_badan']; ?>"><?php echo $get_badan['kd_badan']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Project</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama_project" value="<?php echo $get_forecast['kebutuhan']; ?>" placeholder="Deskripsi project">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">No Tiket</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="notiket" value="<?php echo $get_forecast['tiketcrm']; ?>" placeholder="nomor tiket crm (bila ada)">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">No SPH</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nosph" placeholder="nomor penawaran (bila ada)">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">No SPK</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nospk" placeholder="nomor PO/Kontrak (bila ada)">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Customer</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="namacustomer" value="<?php echo $get_forecast['nm_customer']; ?>" placeholder="nama lengkap customer" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">No Hp</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nohp" value="<?php echo $get_forecast['nohp']; ?>" placeholder="no kontak customer" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Perusahaan</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="perusahaan" value="<?php echo $get_forecast['perusahaan']; ?>" placeholder="nama perusahaan customer (bila ada)">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Kapasitas</label>
                      <div class="col-sm-9">
                        <input type="number" step="0.01" class="form-control" name="kapasitas" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Satuan Kapasitas</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="satuan_kapasitas">
                          <option value="Wp">Wp</option>
                          <option value="kWp">kWp</option>
                          <option value="MWp">MWp</option>
                          <option value="Watt">Watt</option>
                          <option value="Watt Hour">Watt Hour</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Jumlah Order</label>
                      <div class="col-sm-9">
                        <input type="number" step="0.01" class="form-control" name="jumlah_order" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Satuan Order</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="satuan_order">
                          <option value="Pcs">Pcs</option>
                          <option value="Unit">Unit</option>
                          <option value="Set">Set</option>
                          <option value="Lot">Lot</option>
                          <option value="Assembly">Assembly</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Lokasi</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="lokasi" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Tipe Proyek</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="tipe_proyek" required>
                          <?php
                            $q_kategori = mysqli_query($conn, "SELECT * FROM kategoripenjualan");
                            while($get_kategori = mysqli_fetch_array($q_kategori)){ 
                          ?>
                            <option value="<?php echo $get_kategori['kd_kategori']; ?>" <?php if($get_forecast['kategori_kd'] == $get_kategori['kd_kategori']){ echo "selected"; } ?>><?php echo $get_kategori['nm_kategori']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Project Start</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="start" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Deadline</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" name="deadline" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nilai Proyek</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="dengan-rupiah" name="nilai_proyek" value="<?php echo $get_forecast['penawaran']; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">HPP Barang</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="dengan-rupiah3" name="hpp_barang" value="<?php echo $get_forecast['penawaran']; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">HPP Jasa</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="dengan-rupiah4" name="hpp_jasa" value="<?php echo $get_forecast['penawaran']; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">HPP Asset</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="dengan-rupiah5" name="hpp_asset" value="<?php echo $get_forecast['penawaran']; ?>" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">PPN</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="ppn">
                          <option value="PPN">PPN</option>
                          <option value="NON PPN">NON PPN</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Cashback</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="dengan-rupiah2" name="cashback" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Remark</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" name="remark"></textarea>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <input type="submit" class="btn btn-primary float-right" name="newproject" value="New Project">
                  </div>
                  <!-- /.card-footer -->
                </form>
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