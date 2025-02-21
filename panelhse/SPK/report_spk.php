<?php
  $getInductionSPK = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport_spk WHERE id = '$_GET[induction_spk_id]'"));
  $getInduction = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inductionreport WHERE id = '$getInductionSPK[induction_id]'"));
  $getProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$getInduction[project_id]'"));
  $get_hseOfficer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$getInduction[hse_officer]'"));

  if($getInduction['status'] == "closed"){
    header("location:page_closed.php");
  }
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

  @media print {
    .footer-image {
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
    }
  }
</style>

 <div class="" style="padding-left: 25px; padding-right: 25px">
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
            <table width="100%">
              <tr>
                <td><img src="../../dist/img/kop_gpp.png" width="200px"></td>
                <td align="right"><img src="../../dist/img/alamat_gpp.jpg" width="250px"></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="row" style="margin-top: 10px; margin-left: 100px; margin-right: 100px;">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
            <table class="table table-sm table-bordered" style="font-size: 12px">
              <tr>
                <td rowspan="3" align="center" style="vertical-align: middle;"><h5>INDUKSI DAN SURAT PERJANJIAN KERJA <br> PT GLOBAL PRATAMA POWERINDO</h5></td>
                <td width="15%">No Dokumen</td>
                <td width="15%">PP/18/HSE/22</td>
              </tr>
              <tr>
                <td>Revisi</td>
                <td>1/1</td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>01/06/2023</td>
              </tr>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row" style="margin-bottom: 10px; margin-left: 100px; margin-right: 100px;">
          <div class="col-lg-2 col-0"></div>
          <div class="col-lg-8 col-12">
              <table class="table table-sm table-bordered" style="font-size: 14px">
                <tr>
                  <td colspan="3" align="center"><h6>KETERANGAN PEKERJAAN</h6></td>
                </tr>
                <tr>
                  <td width="30%">Nama Project</td>
                  <td><?php echo $getProject['nama_project']; ?></td>
                </tr>
                <tr>
                  <td>Kota</td>
                  <td><?php echo $getProject['kota']; ?></td>
                </tr>
                <tr>
                  <td>HSE Officer</td>
                  <td><?php echo $get_hseOfficer['nama']; ?></td>
                </tr>
                <tr>
                  <td colspan="3" align="center" style="vertical-align: middle;">
                    <h6>
                      DATA PRIBADI 
                    </h6>
                  </td>
                </tr>
                <tr>
                  <td>NIK</td>
                  <td><?php echo $getInductionSPK['nik']; ?></td>
                </tr>
                <tr>
                  <td>Nama Lengkap</td>
                  <td><?php echo $getInductionSPK['nama']; ?></td>
                </tr>
                <tr>
                  <td>Tempat Lahir</td>
                  <td><?php echo $getInductionSPK['tempat_lahir']; ?></td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td><?php echo $getInductionSPK['tgl_lahir']; ?></td>
                </tr>
                <tr>
                  <td>Golongan Darah</td>
                  <td><?php echo $getInductionSPK['golongan_darah']; ?></td>
                </tr>
                <tr>
                  <td>Riwayat Penyakit</td>
                  <td><?php echo $getInductionSPK['riwayat_penyakit']; ?></td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td><?php echo $getInductionSPK['no_telpon']; ?></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td><?php echo $getInductionSPK['alamat']; ?></td>
                </tr>
                <tr>
                  <td>Posisi Kerja</td>
                  <td><?php echo $getInductionSPK['posisi_kerja']; ?></td>
                </tr>
                <tr>
                  <td colspan="3" align="center" style="vertical-align: middle;"><h6>INFORMASI KERABAT TERDEKAT</h6></td>
                </tr>
                <tr>
                  <td>Nama Kerabat</td>
                  <td><?php echo $getInductionSPK['nama_kerabat']; ?></td>
                </tr>
                <tr>
                  <td>Hubungan Kerabat</td>
                  <td><?php echo $getInductionSPK['hubungan_kerabat']; ?></td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td><?php echo $getInductionSPK['no_telpon_kerabat']; ?></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="no-print"><br><br><br></div>
          <div style="page-break-before:always;"></div>

          <div class="row">
            <div class="col-lg-2 col-0"></div>
            <div class="col-lg-8 col-12">
              <table width="100%">
                <tr>
                  <td><img src="../../dist/img/kop_gpp.png" width="200px"></td>
                  <td align="right"><img src="../../dist/img/alamat_gpp.jpg" width="250px"></td>
                </tr>
              </table>
            </div>
          </div>

          <div class="row" style="margin-bottom: -50px; margin-left: 100px; margin-right: 100px; margin-top: 10px;">
            <div class="col-lg-2 col-0"></div>
            <div class="col-lg-8 col-12">
              <div style="margin-bottom: 10px; text-align: justify;">
                Dengan ini saya menyatakan telah mengikuti induksi K3 dan LK3, saya bersedia mengikuti semua peraturan dan ketentuan yang telah disepakati secara lisan serta tulisan selama bekerja di lingkungan kerja PT Global Pratama Powerindo. Saya akan bertanggung jawab atas segala konsekuensi yang telah disepakati.
              </div>             
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
            <br><br>

            <table width="100%">
              <tr>
                <td width="33%" align="center">Yang bersangkutan,</td>
                <td width="33%" align="center">Penanggung Jawab,</td>
                <td width="33%" align="center">Mengetahui,</td>
              </tr>
              <tr>
                <td width="33%" align="center"><img src="signatures/<?php echo $getInductionSPK['ttd']; ?>" width="150px"></td>
                <td width="33%" align="center"><img src="../../dist/img/ttd_deny_santika.jpg" width="150px"></td>
                <td width="33%" align="center"><img src="../../dist/img/ttd_akbar_kurnia.jpg" width="150px"></td>
              </tr>
              <tr>
                <td width="33%" align="center"><?php echo $getInductionSPK['nama']; ?></td>
                <td width="33%" align="center"><u>Deny Santika Fermana</u><br>HSE Departement</td>
                <td width="33%" align="center"><u>Akbar Kurnia</u><br>Project Manager</td>
              </tr>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="no-print" style="margin-top: 100px">
          <center><button class="btn btn-secondary" onclick="window.print()">Print</button></center>
        </div>

        <div class="footer-image">
           <img src="../../dist/img/footer_gpp.jpg" width="100%" alt="Footer Image">
        </div>

      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>