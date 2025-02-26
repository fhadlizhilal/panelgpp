<?php
  if($get_inductionreport['status'] == "closed"){
    header("location:page_closed.php");
  }

  $getManpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE nik = '$_GET[nik]'"));
  $get_inductionreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport WHERE id = '$_GET[spkid]'"));
  $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_inductionreport[project_id]'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_inductionreport[hse_officer]'"));
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
</style>

 <div class="" style="padding-left: 15px; padding-right: 15px">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
            <table class="table table-sm table-bordered">
              <tr>
                <td width="20%" align="center" style="vertical-align: middle;">
                  <img src="../../dist/img/logo/gpp-logo.png" style="width: 50px">
                </td>
                <td width="" align="center" style="vertical-align: middle;">
                  <h6>INDUKSI DAN SURAT PERJANJIAN KERJA <br> PT GLOBAL PRATAMA POWERINDO</h6>
                </td>
                <td width="20%" align="center" style="vertical-align: middle;">
                  <img src="../../dist/img/logo/logo-k3-v2.png" style="width: 50px">
                </td>
              </tr>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row" style="margin-bottom: -50px;">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
            <form method="POST" action="">
              <table class="table table-sm table-striped" style="font-size: 12px">
                <tr>
                  <td colspan="3" align="center"><b>KETERANGAN PEKERJAAN</b></td>
                </tr>
                <tr>
                  <td width="30%">Nama Project</td>
                  <td width="1%">:</td>
                  <td><?php echo $get_project['nama_project']; ?></td>
                </tr>
                <tr>
                  <td>Kota</td>
                  <td>:</td>
                  <td><?php echo $get_project['kota']; ?></td>
                </tr>
                <tr>
                  <td>HSE Officer</td>
                  <td>:</td>
                  <td><?php echo $get_hseOfficer['nama']; ?></td>
                </tr>
              </table>

              <div class="alert alert-success alert-dismissible" style="font-size: 12px">
                <h6><i class="icon fas fa-check"></i> NIK Sudah Terdaftar!</h6>
                Silahkan baca dengan perlahan Form SPK ini dan ikuti arahan dari HSE Officer!
              </div>

              <table class="table table-sm table-striped" style="font-size: 12px">
                <tr>
                  <td colspan="3" align="center" style="vertical-align: middle;">
                    <b>
                      DATA PRIBADI 
                      <a href="#modal" data-toggle='modal' data-target='#show_edit_datapribadi' data-id='<?php echo $_GET['nik']."/".$_GET['spkid']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Project Baru">
                        <span class="fa fa-edit" style="float: right; font-size: 14px; vertical-align: middle;"> Edit</span>
                      </a>
                    </b>
                  </td>
                </tr>
                <tr>
                  <td width="30%">NIK</td>
                  <td width="1%">:</td>
                  <td><?php echo $getManpower['nik']; ?></td>
                </tr>
                <tr>
                  <td>Nama Lengkap</td>
                  <td>:</td>
                  <td><?php echo $getManpower['nama']; ?></td>
                </tr>
                <tr>
                  <td>Tempat Lahir</td>
                  <td>:</td>
                  <td><?php echo $getManpower['tempat_lahir']; ?></td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td>:</td>
                  <td><?php echo $getManpower['tgl_lahir']; ?></td>
                </tr>
                <tr>
                  <td>Golongan Darah</td>
                  <td>:</td>
                  <td><?php echo $getManpower['golongan_darah']; ?></td>
                </tr>
                <tr>
                  <td>Riwayat Penyakit</td>
                  <td>:</td>
                  <td><?php echo $getManpower['riwayat_penyakit']; ?></td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td>:</td>
                  <td><?php echo $getManpower['no_telpon']; ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td><?php echo $getManpower['alamat']; ?></td>
                </tr>
                <tr>
                  <td>Posisi Kerja</td>
                  <td>:</td>
                  <td><?php echo $getManpower['posisi_kerja']; ?></td>
                </tr>
                <tr>
                  <td>Foto Diri</td>
                  <td>:</td>
                  <td><img src="../../role/HSE/foto_manpower/<?php echo $getManpower['foto']; ?>" width="40%"></td>
                </tr>
                <tr>
                  <td>Foto KTP</td>
                  <td>:</td>
                  <td><img src="../../role/HSE/foto_ktp/<?php echo $getManpower['ktp']; ?>" width="60%"></td>
                </tr>
                <tr>
                  <td colspan="3" align="center" style="vertical-align: middle;"><b>INFORMASI KERABAT TERDEKAT</b></td>
                </tr>
                <tr>
                  <td>Nama Kerabat</td>
                  <td>:</td>
                  <td><?php echo $getManpower['nama_kerabat']; ?></td>
                </tr>
                <tr>
                  <td>Hubungan Kerabat</td>
                  <td>:</td>
                  <td><?php echo $getManpower['hubungan_kerabat']; ?></td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td>:</td>
                  <td><?php echo $getManpower['no_telpon_kerabat']; ?></td>
                </tr>
              </table>
              <div class="card">
                <div class="card-body" style="font-size: 12px">
                  <div style="margin-bottom: 10px">Sub Attitude</div>
                  <ol type="1" style="text-align: justify;">
                    <li>Menjaga nama baik PT Global Pratama Powerindo</li>
                    <li>Menjaga perilaku, tutur kata dan kebersihan selama dilokasi pekerjaan</li>
                    <li>Menjaga hubungan baik dengan pemberi kerja</li>
                    <li>Menjaga shalat 5 waktu</li>
                    <li>Tidak membuat onar, ceroboh ataupun membuat hal yang menghambat pekerjaan</li>
                  </ol>

                  <div style="margin-bottom: 10px;">Sub kinerja</div>
                  <ol type="1" style="text-align: justify;">
                    <li>Mengikuti jam kerja pukul 7:30 – 16:30</li>
                    <li>Mengikuti tool box meeting dan house keeping setiap hari</li>
                    <li>Tidak meroko di area lokasi pekerjaan</li>
                    <li>Tidak memainkan handphone saat bekerja, dokumentasi hanya dilakukan oleh salah satu pekerja yang ditunjuk</li>
                    <li>Menjaga stamina, menjaga asupan makan dan menjaga jam tidur selama pekerjaan berlangsung</li>
                    <li>Tidak melakukan hal-hal yang dilarang oleh pemberi kerja</li>
                    <li>Menaati peraturan internal dari lokasi bekerja ataupun aturan dari pemberi kerja</li>
                    <li>Mengikuti arahan dari pimpinan</li>
                  </ol>

                  <div style="margin-bottom: 10px;">Sub Kesehatan dan keselamatan kerja</div>
                  <ol type="1" style="text-align: justify;">
                    <li>Menggunakan APD sesuai dengan jenis pekerjaan nya</li>
                    <li>Menjaga dengan baik barang dan juga alat kerja yang digunakan</li>
                    <li>
                      Mengembalikan semua APD dan alat kerja yang dipinjamkan selama proyek berlangsung kepada perwakilan
                      perusahaan di lapangan
                    </li>
                    <li>Tidak sedang rutin menggunakan obat-obatan tertentu</li>
                    <li>Tidak memiliki penyakit yang sering kambuh sewaktu-waktu</li>
                    <li>
                      Bebas dari riwayat penyakit Hipertensi, diabetes, epilepsi, jantung, phobia ketinggian dan Riwayat penyakit berat lainnya
                    </li>
                    <li>Memberi info kepada Waspang bila keadaan tidak memungkinkan untuk bekerja</li>
                    <li>Sedang dalam keadaan sehat saat pekerjaan ini akan berlangsung</li>
                  </ol>

                  <div style="margin-bottom: 10px; text-align: justify;">Ketika point point diatas dilanggar, akan ada peringatan berupa teguran, surat peringatan atau tindakan lanjut lainnya seusai dengan pelanggaran yang dilakukan. Diharapkan yang bersangkutan dapat mengikuti semua peraturan yang ada dan menjadi mitra kerja yang baik, terimakasih.</div>
                    
                </div>
              </div>
            </form>
            <br><br>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">

            <div class="card">
              <div class="card-body" style="font-size: 12px">
                <form id="signatureForm" method="POST" action="" enctype="multipart/form-data">
                  <table style="background-color: yellow;">
                    <tr>
                      <td width="40px" style="text-align: center; vertical-align: middle;">
                        <input type="checkbox" name="setuju" required>
                      </td>
                      <td style="text-align: justify; padding-right: 10px; padding-bottom: 5px; padding-top: 5px">Dengan ini saya menyatakan telah mengikuti induksi K3 dan LK3, saya bersedia mengikuti semua peraturan dan ketentuan yang telah disepakati secara lisan serta tulisan selama bekerja di lingkungan kerja PT Global Pratama Powerindo. Saya akan bertanggung jawab atas segala konsekuensi yang telah disepakati.</td>
                    </tr>
                  </table><br>
                  <table>
                    <tr>
                      <td>Foto Diri Terbaru</td>
                      <td>:</td>
                      <td><input type="file" class="form-control form-control-sm" accept="image/*" capture="user" name="foto_terbaru" required></td>
                    </tr>
                  </table>
                  <center><br> 
                    <div class="form-group" style="width: 250px;">
                      <label for="signaturePad">Tanda Tangan</label>
                      <canvas id="signaturePad"></canvas>
                      <input type="hidden" id="signatureImage" name="signatureImage">
                      <div id="error-message">Berikan tanda tangan anda disini.</div>
                    </div>
                    <input type="hidden" name="nik" value="<?php echo $_GET['nik'] ?>">
                    <input type="hidden" name="spkid" value="<?php echo $_GET['spkid'] ?>">
                    <input type="hidden" name="file_name" value="<?php echo "SPK_".$get_project['nama_project']."_".$getManpower['nama']; ?>">
                    <button type="button" class="btn btn-secondary" id="clearButton">Hapus TTD</button>
                    <button type="submit" class="btn btn-primary" id="submitButton" name="submit_spk_v2" disabled>Submit</button>
                  </center>
                </form>

              </div>
            </div>

            <center>
              <a href="index.php?pages=ceknik&spkid=<?php echo $_GET['spkid']; ?>"><div class="btn btn-danger">Kembali</div></a>
            </center>
            <br><br>

          </div>
        </div>

      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<!-- Modal start here -->
  <div class="modal fade" id="show_edit_datapribadi" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data Pribadi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" method="POST" action="" enctype="multipart/form-data" style="font-size: 10px;">
            <div class="modal-data"></div>
            <hr>
            <input type="submit" id="submitBtn" class="btn btn-info" name="edit_data_pribadi" value="Ubah">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

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