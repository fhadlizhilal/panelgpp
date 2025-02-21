<?php
  if(isset($_GET['suratjalanid'])){
    $id = $_GET['suratjalanid'];
    $get_suratjalan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_suratjalan WHERE id = '$id'"));
    $get_peminjaman = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_peminjaman WHERE id = '$get_suratjalan[peminjaman_id]'"));
    $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_peminjaman[kd_project]'"));
    $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjaman[peminjam]'"));
    $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_suratjalan[entitas_id]'"));
  }

  if(isset($_POST['submit_bast'])) {
    $suratjalan_id = $_POST['suratjalan_id'];
    $signatureImage = $_POST['signatureImage'];
    $tanggal_bast = date("Y-m-d");

    // Decode the base64 encoded image
    list($type, $data) = explode(';', $signatureImage);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    // Set the file path to save the image (Format Name Image : nama manpower_spkid_uniqid.png)
    $fileName = $suratjalan_id.'_'.uniqid().'.png';
    $filePath = '../unrole/management_asset/ttd_bast/'.$fileName;
    // Save the image
    file_put_contents($filePath, $data);

    $push_bast = mysqli_query($conn, "INSERT INTO asset_suratjalan_bast VALUES('','$suratjalan_id','$tanggal_bast','$fileName')");

    if($push_bast){
      mysqli_query($conn, "UPDATE asset_suratjalan SET status = 'diterima & sesuai' WHERE id = '$suratjalan_id'");
      $_SESSION['alert_success'] = "Berhasil! BAST Berhasil Disubmit";
    }else{
      $_SESSION['alert_error'] = "Gagal! BAST Gagal Disubmit <br>".mysqli_error($conn);
    }
  }
?>

<style>
    #signaturePad {
        border: 1px solid #000;
        width: 100%;
        height: 150px;
    }
    #error-message {
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
            <h1>Detail Surat Jalan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Surat Jalan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
            <div class="card">
              <div class="card-body">
                <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">SURAT JALAN</div>
                <table class="table table-sm" style="font-size: 12px;">
                  <tr>
                    <td width="32%">No Surat Jalan</td>
                    <td width="1%">:</td>
                    <td><?php echo "SJ".$get_suratjalan['id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?></td>
                  </tr>
                  <tr>
                    <td>No Pinjam</td>
                    <td>:</td>
                    <td><?php echo $get_peminjaman['id']."/MA/".date("m/Y", strtotime($get_peminjaman['tgl_pinjam'])); ?></td>
                  </tr>
                  <tr>
                    <td>Jenis</td>
                    <td>:</td>
                    <td>
                      <?php if($get_peminjaman['jenis'] == "tools"){ ?>
                        <span class="badge badge-info">Tools</span>
                      <?php }elseif($get_peminjaman['jenis'] == "apd"){ ?>
                        <span class="badge badge-success">APD</span>
                      <?php }elseif($get_peminjaman['jenis'] == "inventaris"){ ?>
                        <span class="badge badge-warning">Inventaris</span>
                      <?php }elseif($get_peminjaman['jenis'] == "alat ukur"){ ?>
                        <span class="badge badge-danger">Alat Ukur</span>
                      <?php } ?>
                    </td>
                  </tr>
                  <tr>
                    <td>Entitas</td>
                    <td>:</td>
                    <td><?php echo $get_entitas['entitas']; ?></td>
                  </tr>
                  <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td><?php echo date("d F Y", strtotime($get_suratjalan['tanggal'])); ?></td>
                  </tr>
                  <tr>
                    <td>Project</td>
                    <td>:</td>
                    <td><?php echo $get_peminjaman['kd_project']." - ".$get_project['nm_project']; ?></td>
                  </tr>
                  <tr>
                    <td>Peminjam</td>
                    <td>:</td>
                    <td><?php echo $get_karyawan['nama']; ?></td>
                  </tr>
                  <tr>
                    <td>Alamat Kirim</td>
                    <td>:</td>
                    <td><?php echo $get_suratjalan['alamat_kirim']; ?></td>
                  </tr>
                  <tr>
                    <td>Nama Expedisi</td>
                    <td>:</td>
                    <td><?php echo $get_suratjalan['expedisi']; ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </table>

                <table class="table table-sm" style="font-size: 11px">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th>Nama Barang</th>
                      <th>Tipe Barang</th>
                      <th>Tipe Detail</th>
                      <th width="12%">Merek</th>
                      <th width="12%">Sub Barang</th>
                      <th width="1%">Qty</th>
                      <th width="1%">Satuan</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                      $no=1;
                      $q_get_suratjalan_detail = mysqli_query($conn, "SELECT * FROM asset_suratjalan_detail JOIN asset_db_detail ON asset_suratjalan_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id WHERE asset_suratjalan_detail.suratjalan_id = '$id' ORDER BY asset_db_general.nama_barang ASC, asset_db_general.tipe_barang ASC");
                      while($get_suratjalan_detail = mysqli_fetch_array($q_get_suratjalan_detail)){

                    ?>
                      <tr>
                        <td width="1%"><?php echo $no; ?></td>
                        <td><?php echo $get_suratjalan_detail['nama_barang']; ?></td>
                        <td><?php echo $get_suratjalan_detail['tipe_barang']; ?></td>
                        <td><?php echo $get_suratjalan_detail['tipe_detail']; ?></td>
                        <td><?php echo $get_suratjalan_detail ['merek']; ?></td>
                        <td><?php echo $get_suratjalan_detail['sub_barang']; ?></td>
                        <td><?php echo $get_suratjalan_detail['qty']; ?></td>
                        <td><?php echo $get_suratjalan_detail['satuan']; ?></td>
                      </tr>
                      
                    <?php $no++; } ?>

                  </tbody>
                </table>

                <div style="text-align: center; margin-bottom: -10px; margin-top: 30px;">
                  <a href="../unrole/management_asset/cetak_suratjalan.php?id=<?php echo $id; ?>" target="_blank">
                    <div class="btn btn-secondary"><span class="fa fa-print"></span> Cetak / Simpan</div>
                  </a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


        <?php
          $cek_bast = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM asset_suratjalan_bast WHERE suratjalan_id = '$id'"));
          if($cek_bast < 1){
        ?>
        <!-- ----------------------------------------- FORM BAST ---------------------------------- -->
        <div class="row">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
            <div class="card">
              <div class="card-body" style="background-color: lightgoldenrodyellow;">
                <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">BERITA ACARA SERAH TERIMA ASSET (BASTA)</div>
                <table class="table table-sm" style="font-size: 12px;">
                  <tr>
                    <td width="28%">Pihak 1 / MA</td>
                    <td width="1%">:</td>
                    <td>Management Asset</td>
                  </tr>
                  <tr>
                    <td>Pihak 2 / User</td>
                    <td>:</td>
                    <td><?php echo $get_karyawan['nama']; ?></td>
                  </tr>
                </table>

                <table class="table table-bordered table-sm" style="font-size: 11px">
                  <thead>
                    <tr>
                      <th width="40%" style="text-align: center;">Project</th>
                      <th width="60%" style="text-align: center;">Pernyataan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="height: 200px; vertical-align: middle; font-weight: bold; text-align: center;">
                        <?php echo $get_peminjaman['kd_project']."<br>".$get_project['nm_project']; ?>
                      </td>
                      <td style="font-size: 12px; vertical-align: middle; padding-left: 15px; padding-right: 15px">
                        Yang bertanda tangan dibawah ini :<br>
                        Pihak 1 & Pihak 2
                        <br><br>
                        <div style="text-align: justify;">Menyatakan bahwa barang yang diserahterimakan sesuai dengan surat jalan no <b><?php echo "SJ".$get_suratjalan['id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?></b> adalah dalam kondisi baik dan sesuai dengan surat jalan.</div>
                        <br>
                        <div style="text-align: justify;">Demikian pernyataan ini dibuat dengan sebenar-benarnya.</div>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <br>
                <table style="font-size: 11px; width: 100%;">
                  <tr>
                    <td width="50%" style="vertical-align: middle; text-align: center;"></td>
                    <td width="50%" style="vertical-align: middle; text-align: center;">Bandung, <?php echo date("d-m-Y"); ?></td>
                  </tr>
                  <tr>
                    <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 1/Menyerahkan</td>
                    <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 2/Penerima</td>
                  </tr>
                  <tr>
                    <td width="50%" style="height: 100px; vertical-align: middle; text-align: center;">
                      <img src="../unrole/management_asset/ttd_bast/ttd_asset.png" width="40%">
                    </td>
                    <td width="50%" style="height: 50px; vertical-align: middle; text-align: center;">
                          
                      <form id="signatureForm" method="POST" action="">
                        <center> 
                          <div class="form-group" style="width: 100%;">
                            <!-- <label for="signaturePad">Tanda Tangan</label> -->
                            <canvas id="signaturePad"></canvas>
                            <input type="hidden" id="signatureImage" name="signatureImage">
                            <!-- <div id="error-message">Berikan tanda tangan anda disini.</div> -->
                          </div>
                          <input type="hidden" name="suratjalan_id" value="<?php echo $id; ?>">
                          <button type="button" class="btn btn-secondary btn-sm" id="clearButton">Hapus TTD</button>
                          <button type="submit" class="btn btn-primary btn-sm" id="submitButton" name="submit_bast" onclick="return confirm('Yakin tanda tangan BAST ini? Pastikan BAST sudah sesuai!')" disabled>Submit</button>
                        </center>
                      </form>
         
                    </td>
                  </tr>
                  <tr>
                    <td width="50%" style="vertical-align: middle; text-align: center;">(Management Asset)</td>
                    <td width="50%" style="vertical-align: middle; text-align: center;">(<?php echo $get_karyawan['nama']; ?>)</td>
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

        <!-- --------------------------------------- BAST SUDAH DI TANDA TANGAN -------------------------------- -->

        <?php
          }else{ 
            $get_bast = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_suratjalan_bast WHERE suratjalan_id = '$id'"));
        ?>

        <div class="row">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
            <div class="card">
              <div class="card-body" style="background-color: lightgreen;">
                <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">BERITA ACARA SERAH TERIMA ASSET (BASTA)</div>
                <table class="table table-sm" style="font-size: 12px;">
                  <tr>
                    <td width="28%">No Surat Jalan</td>
                    <td width="1%">:</td>
                    <td><?php echo "BAST".$get_bast['id']."/MA/".date("m/Y", strtotime($get_bast['tanggal_bast'])); ?></td>
                  </tr>
                  <tr>
                    <td width="28%">Pihak 1 / MA</td>
                    <td width="1%">:</td>
                    <td>Management Asset</td>
                  </tr>
                  <tr>
                    <td>Pihak 2 / User</td>
                    <td>:</td>
                    <td><?php echo $get_karyawan['nama']; ?></td>
                  </tr>
                </table>

                <table class="table table-bordered table-sm" style="font-size: 11px">
                  <thead>
                    <tr>
                      <th width="40%" style="text-align: center;">Project</th>
                      <th width="60%" style="text-align: center;">Pernyataan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="height: 200px; vertical-align: middle; font-weight: bold; text-align: center;">
                        <?php echo $get_peminjaman['kd_project']."<br>".$get_project['nm_project']; ?>
                      </td>
                      <td style="font-size: 12px; vertical-align: middle; padding-left: 15px; padding-right: 15px">
                        Yang bertanda tangan dibawah ini :<br>
                        Pihak 1 & Pihak 2
                        <br><br>
                        <div style="text-align: justify;">Menyatakan bahwa barang yang diserahterimakan sesuai dengan surat jalan no <b><?php echo "SJ".$get_suratjalan['id']."/MA/".date("m/Y", strtotime($get_suratjalan['tanggal'])); ?></b> adalah dalam kondisi baik dan sesuai dengan surat jalan.</div>
                        <br>
                        <div style="text-align: justify;">Demikian pernyataan ini dibuat dengan sebenar-benarnya.</div>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <br>
                <table style="font-size: 11px; width: 100%;">
                  <tr>
                    <td width="50%" style="vertical-align: middle; text-align: center;"></td>
                    <td width="50%" style="vertical-align: middle; text-align: center;">Bandung, <?php echo date("d-m-Y", strtotime($get_bast["tanggal_bast"])); ?></td>
                  </tr>
                  <tr>
                    <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 1/Menyerahkan</td>
                    <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 2/Penerima</td>
                  </tr>
                  <tr>
                    <td width="50%" style="height: 100px; vertical-align: middle; text-align: center;">
                      <img src="../unrole/management_asset/ttd_bast/ttd_asset.png" width="40%">
                    </td>
                    <td width="50%" style="height: 50px; vertical-align: middle; text-align: center;">
                      <img src="../unrole/management_asset/ttd_bast/<?php echo $get_bast["ttd"]; ?>" width="80%">
                    </td>
                  </tr>
                  <tr>
                    <td width="50%" style="vertical-align: middle; text-align: center;">(Management Asset)</td>
                    <td width="50%" style="vertical-align: middle; text-align: center;">(<?php echo $get_karyawan['nama']; ?>)</td>
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

        <?php } ?>  

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>

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
          canvas.height = 150;
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