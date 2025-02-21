<?php
  if(isset($_GET['pengembalianid'])){
    $pengembalian_id = $_GET['pengembalianid'];
  }

  if(isset($_POST['submit_bast_pengembalian'])) {
    $pengembalian_id = $_POST['pengembalian_id'];
    $signatureImage = $_POST['signatureImage'];
    $tanggal_bast = date("Y-m-d");

    // Decode the base64 encoded image
    list($type, $data) = explode(';', $signatureImage);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

    // Set the file path to save the image (Format Name Image : nama manpower_spkid_uniqid.png)
    $fileName = $pengembalian_id.'_'.uniqid().'.png';
    $filePath = '../unrole/management_asset/ttd_bast_pengembalian/'.$fileName;
    // Save the image
    file_put_contents($filePath, $data);

    $edit_pengembalian = mysqli_query($conn, "UPDATE asset_pengembalian SET status = 'BA approved', tgl_bast = '$tanggal_bast', ttd = '$fileName' WHERE id = '$pengembalian_id'");

    if($edit_pengembalian){
      $_SESSION['alert_success'] = "Berhasil! BAST Berhasil Disubmit";
    }else{
      $_SESSION['alert_error'] = "Gagal! BAST Gagal Disubmit <br>".mysqli_error($conn);
    }
  }

  $get_pengembalian = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_pengembalian JOIN project ON asset_pengembalian.kd_project = project.kd_project JOIN karyawan ON asset_pengembalian.penanggungjawab = karyawan.nik JOIN asset_db_entitas ON asset_pengembalian.entitas_id = asset_db_entitas.id WHERE asset_pengembalian.id = '$pengembalian_id'"));
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
            <h1>Detail Pengembalian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail Pengembalian</li>
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
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <table class="table table-sm" style="font-size: 11px">
                      <tr>
                        <td width="28%">No Pengembalian</td>
                        <td width="1%">:</td>
                        <td><?php echo "RTN".$pengembalian_id."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
                      </tr>
                      <tr>
                        <td width="28%">Kode Project</td>
                        <td width="1%">:</td>
                        <td><?php echo $get_pengembalian['kd_project']; ?></td>
                      </tr>
                      <tr>
                        <td>Nama Project</td>
                        <td>:</td>
                        <td><?php echo $get_pengembalian['nm_project']; ?></td>
                      </tr>
                      <tr>
                        <td>Peminjam</td>
                        <td>:</td>
                        <td>
                          <?php
                            $q_get_peminjam = mysqli_query($conn, "SELECT DISTINCT peminjam FROM asset_peminjaman WHERE kd_project = '$get_pengembalian[kd_project]' AND (status = 'on progress by MA' OR status = 'completed')");
                            while($get_peminjam = mysqli_fetch_array($q_get_peminjam)){
                              $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_peminjam[peminjam]'"));
                              echo $get_karyawan['nama'].", ";
                            }
                          ?>
                        </td>
                      </tr>
                    </table>
                  </div>


                  <div class="col-lg-6 col-12">
                    <table class="table table-sm" style="font-size: 11px">
                      <tr>
                        <td width="28%">Entitas Peminjam</td>
                        <td width="1%">:</td>
                        <td>
                          <?php
                            $q_get_entitas_id = mysqli_query($conn, "SELECT DISTINCT entitas_id FROM asset_suratjalan JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE kd_project = '$get_pengembalian[kd_project]'");
                            while($get_entitas_id = mysqli_fetch_array($q_get_entitas_id)){
                              $get_entitas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_db_entitas WHERE id = '$get_entitas_id[entitas_id]'"));
                              echo $get_entitas['entitas'].", ";
                            }
                          ?>
                        </td>
                      </tr>
                      <tr>
                        <td width="28%">Penanggung Jawab</td>
                        <td>:</td>
                        <td><?php echo $get_pengembalian['nama']; ?></td>
                      </tr>
                      <tr>
                        <td width="28%">Entitas Pengembalian</td>
                        <td>:</td>
                        <td><?php echo $get_pengembalian['entitas']; ?></td>
                      </tr>
                      <tr>
                        <td>Tanggal Pengembalian</td>
                        <td>:</td>
                        <td><?php echo date("d/m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
                      </tr>
                    </table>
                  </div>
                </div>

                <div class="table-responsive p-0" style="height: 320px;">
                  <table class="table table-sm table-head-fixed table-hover" style="font-size: 11px">
                    <thead>
                      <tr>
                        <th width="1%" style="vertical-align: bottom;">No</th>
                        <th style="vertical-align: bottom;">Nama Barang</th>
                        <th style="vertical-align: bottom;">Tipe Barang</th>
                        <th style="vertical-align: bottom;">Tipe Detail</th>
                        <th style="vertical-align: bottom;">Merek</th>
                        <th width="8%" style="vertical-align: bottom;">Sub Barang</th>
                        <th width="1%" style="text-align: center;">Jml Pinjam</th>
                        <th width="1%" style="vertical-align: bottom;">Satuan</th>
                        <th width="1%" style="text-align: center;">Kembali Baik</th>
                        <th width="1%" style="text-align: center;">Kembali Habis</th>
                        <th width="1%" style="text-align: center;">Rusak Sebagian</th>
                        <th width="1%" style="text-align: center;">Rusak Total</th>
                        <th width="1%" style="vertical-align: bottom;">Hilang</th>
                      </tr>
                    </thead>
                    <?php
                      $no=1;
                      $q_get_asset_pengembalian_detail = mysqli_query($conn, "SELECT * FROM asset_pengembalian_detail JOIN asset_db_detail ON asset_pengembalian_detail.detail_code = asset_db_detail.detail_code JOIN asset_db_general ON asset_db_detail.general_code_id = asset_db_general.id JOIN asset_db_merek ON asset_db_detail.merek_id = asset_db_merek.id WHERE pengembalian_id = '$pengembalian_id' ORDER BY nama_barang ASC, tipe_barang ASC");
                      while($get_pengembalian_detail = mysqli_fetch_array($q_get_asset_pengembalian_detail)){
                        $jml_pinjam = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sum_pinjam FROM asset_suratjalan_detail JOIN asset_suratjalan ON asset_suratjalan_detail.suratjalan_id = asset_suratjalan.id JOIN asset_peminjaman ON asset_suratjalan.peminjaman_id = asset_peminjaman.id WHERE kd_project = '$get_pengembalian[kd_project]' AND detail_code = '$get_pengembalian_detail[detail_code]'"));
                    ?>
                        <tbody>
                          <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $get_pengembalian_detail['nama_barang']; ?></td>
                            <td><?php echo $get_pengembalian_detail['tipe_barang']; ?></td>
                            <td><?php echo $get_pengembalian_detail['tipe_detail']; ?></td>
                            <td><?php echo $get_pengembalian_detail['merek']; ?></td>
                            <td><?php echo $get_pengembalian_detail['sub_barang']; ?></td>
                            <td align="center"><?php echo $jml_pinjam['sum_pinjam']; ?></td>
                            <td align="center"><?php echo $get_pengembalian_detail['satuan']; ?></td>
                            <td align="center"><?php echo $get_pengembalian_detail['kembali_baik']; ?></td>
                            <td align="center"><?php echo $get_pengembalian_detail['habis']; ?></td>
                            <td align="center"><?php echo $get_pengembalian_detail['rusak_sebagian']; ?></td>
                            <td align="center"><?php echo $get_pengembalian_detail['rusak_total']; ?></td>
                            <td align="center"><?php echo $get_pengembalian_detail['hilang']; ?></td>
                          </tr>
                        </tbody>
                    <?php $no++; } ?>
                  </table>
                </div>

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
          if($get_pengembalian['status'] == "waiting for approval"){
        ?>
        <!-- ----------------------------------------- FORM BAST ---------------------------------- -->
        <div class="row">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
            <div class="card">
              <div class="card-body" style="background-color: lightgoldenrodyellow;">
                <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">BERITA ACARA PENGEMBALIAN ASSET</div>
                <table class="table table-sm" style="font-size: 12px;">
                  <tr>
                    <td width="28%">No Pengembalian</td>
                    <td width="1%">:</td>
                    <td><?php echo "RTN".$pengembalian_id."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
                  </tr>
                  <tr>
                    <td width="28%">Pihak 1 / User</td>
                    <td width="1%">:</td>
                    <td><?php echo $get_pengembalian['nama']; ?></td>
                  </tr>
                  <tr>
                    <td>Pihak 2 / MA</td>
                    <td>:</td>
                    <td>Management Asset</td>
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
                        <?php echo $get_pengembalian['kd_project']."<br>".$get_pengembalian['nm_project']; ?>
                      </td>
                      <td style="font-size: 12px; vertical-align: middle; padding-left: 15px; padding-right: 15px">
                        Yang bertanda tangan dibawah ini :<br>
                        Pihak 1 & Pihak 2
                        <br><br>
                        <div style="text-align: justify;">Menyatakan bahwa barang yang dikembalikan sesuai dengan surat pengembalian no <b><?php echo "RTN".$pengembalian_id."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></b> adalah qty dan kondisi sesuai dengan surat pengembalian.</div>
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
                    <td width="50%" style="height: 50px; vertical-align: middle; text-align: center;">
                          
                      <form id="signatureForm" method="POST" action="">
                        <center> 
                          <div class="form-group" style="width: 100%;">
                            <!-- <label for="signaturePad">Tanda Tangan</label> -->
                            <canvas id="signaturePad"></canvas>
                            <input type="hidden" id="signatureImage" name="signatureImage">
                            <!-- <div id="error-message">Berikan tanda tangan anda disini.</div> -->
                          </div>
                          <input type="hidden" name="pengembalian_id" value="<?php echo $pengembalian_id; ?>">
                          <button type="button" class="btn btn-secondary btn-sm" id="clearButton">Hapus TTD</button>
                          <button type="submit" class="btn btn-success btn-sm" id="submitButton" name="submit_bast_pengembalian" onclick="return confirm('Yakin tanda tangan BAST ini? Pastikan BAST sudah sesuai!')" disabled>Submit</button>
                        </center>
                      </form>
         
                    </td>
                    <td width="50%" style="height: 100px; vertical-align: middle; text-align: center;">
                      <img src="../unrole/management_asset/ttd_bast_pengembalian/ttd_asset.png" width="45%">
                    </td>
                  </tr>
                  <tr>
                    <td width="50%" style="vertical-align: middle; text-align: center;">(<?php echo $get_pengembalian['nama']; ?>)</td>
                    <td width="50%" style="vertical-align: middle; text-align: center;">(Management Asset)</td>
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
        ?>

        <div class="row">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
            <div class="card">
              <div class="card-body" style="background-color: lightgreen;">
                <div style="text-align: center; font-weight: bold; margin-bottom: 10px;">BERITA ACARA PENGEMBALIAN ASSET</div>
                <table class="table table-sm" style="font-size: 12px;">
                  <tr>
                    <td width="28%">No Pengembalian</td>
                    <td width="1%">:</td>
                    <td><?php echo "RTN".$pengembalian_id."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></td>
                  </tr>
                  <tr>
                    <td width="28%">Pihak 1 / User</td>
                    <td width="1%">:</td>
                    <td><?php echo $get_pengembalian['nama']; ?></td>
                  </tr>
                  <tr>
                    <td>Pihak 2 / MA</td>
                    <td>:</td>
                    <td>Management Asset</td>
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
                        <?php echo $get_pengembalian['kd_project']."<br>".$get_pengembalian['nm_project']; ?>
                      </td>
                      <td style="font-size: 12px; vertical-align: middle; padding-left: 15px; padding-right: 15px">
                        Yang bertanda tangan dibawah ini :<br>
                        Pihak 1 & Pihak 2
                        <br><br>
                        <div style="text-align: justify;">Menyatakan bahwa barang yang dikembalikan sesuai dengan surat pengembalian no <b><?php echo "RTN".$pengembalian_id."/MA/".date("m/Y", strtotime($get_pengembalian['tanggal'])); ?></b> adalah qty dan kondisi sesuai dengan surat pengembalian.</div>
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
                    <td width="50%" style="vertical-align: middle; text-align: center;">Bandung, <?php echo date("d-m-Y", strtotime($get_pengembalian["tgl_bast"])); ?></td>
                  </tr>
                  <tr>
                    <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 1/Menyerahkan</td>
                    <td width="50%" style="vertical-align: middle; text-align: center;">Pihak 2/Penerima</td>
                  </tr>
                  <tr>
                    <td width="50%" style="height: 50px; vertical-align: middle; text-align: center;">
                      <img src="../unrole/management_asset/ttd_bast_pengembalian/<?php echo $get_pengembalian["ttd"]; ?>" width="80%">
                    </td>
                    <td width="50%" style="height: 100px; vertical-align: middle; text-align: center;">
                      <img src="../unrole/management_asset/ttd_bast_pengembalian/ttd_asset.png" width="45%">
                    </td>
                  </tr>
                  <tr>
                    <td width="50%" style="vertical-align: middle; text-align: center;">(<?php echo $get_pengembalian['nama']; ?>)</td>
                    <td width="50%" style="vertical-align: middle; text-align: center;">(Management Asset)</td>
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