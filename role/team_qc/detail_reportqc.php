<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $id = $_POST['getID'];
    $getListReportQC = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM list_reportqc WHERE id_form = '$id'"));
  }
?>

  <div class="card">
    <div class="card-body">
      <table width="100%" style="font-size: 10px;">
        <tbody>
          <tr>
            <td width="14%"><b>Nama Pekerjaan</b></td>
            <td width="2%"><b>:</b></td>
            <td><?php echo $getListReportQC['nm_pekerjaan']; ?></td>
          </tr>
          <tr>
            <td width="14%"><b>Jenis Laporan</b></td>
            <td width="2%"><b>:</b></td>
            <td><?php echo $getListReportQC['form']; ?></td>
          </tr>
          <tr>
            <td><b>Tanggal QC</b></td>
            <td><b>:</b></td>
            <td><?php echo $getListReportQC['tgl']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!------------------------------------------------------------------ REPORT PV MODULE ------------------------------------- -->
  <?php if($getListReportQC['form'] == "PV Module"){ ?>
    <div class="card">
      <div class="card-body">
        <table id="example6" class="table table-bordered table-sm" style="font-size: 10px;">
          <thead>
            <tr align="center">
              <th width="2%">No</th>
              <th width="">No Serial PV / Barcode</th>
              <th width="8%">Tegangan</th>
              <th width="8%">Kondisi Fisik</th>
              <th width="">Jarak Lubang Frame</th>
              <th width="">Keterangan Tambahan</th>
              <th width="14%">Foto</th>
              <th width="5%">Random Check</th>
              <th width="5%">Keterangan Random Check</th>
              <th width="14%">Foto Random Check</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 0;
              $q_getDetailListPV = mysqli_query($conn, "SELECT * FROM list_report_pv where id_form = '$id'");
              while($getDetailListPV = mysqli_fetch_array($q_getDetailListPV)){
                $no++;
            ?>
              <tr>
                <td align="center"><?php echo $no; ?></td>
                <td><?php echo $getDetailListPV['no_seri'] ?></td>
                <td align="center"><?php echo $getDetailListPV['tegangan'] ?> V</td>
                <td align="center"><?php echo $getDetailListPV['kondisi_fisik'] ?></td>
                <td align="center"><?php echo $getDetailListPV['jarak_lubang_frame'] ?></td>
                <td><?php echo $getDetailListPV['ket_tambahan'] ?></td>
                <td><img src="dokumentasi/<?php echo $getDetailListPV['foto'] ?>" width="100%"></td>
                <td align="center"><?php echo $getDetailListPV['random_check'] ?></td>
                <td><?php echo $getDetailListPV['ket_random_check'] ?></td>
                <td>
                  <?php if($getDetailListPV['foto_random_check'] != ""){ ?>
                    <img src="dokumentasi/<?php echo $getDetailListPV['foto_random_check']; ?>" width="100%">
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <br>
        <center>
          <a href="index.php?pages=editreportpv&idform=<?php echo $id; ?>"><button class="btn btn-success"><span class="fa fa-edit"></span> Edit</button></a>
          <a href="cetak_report.php?form=pvmodule&idform=<?php echo $id; ?>" target="_blank"><button class="btn btn-primary"><span class="fa fa-print"></span> Cetak</button></a>
        </center>
      </div>
    </div>

  <!-- ----------------------------------------------------------- REPORT LAMPU JALAN ------------------------------------------- -->
  <?php }elseif($getListReportQC['form'] == "Lampu"){ ?>
    <div class="card">
      <div class="card-body">
        <table id="example6" class="table table-bordered table-sm" style="font-size: 10px;">
          <thead>
            <tr align="center">
              <th width="2%">No</th>
              <th width="">No Seri</th>
              <th width="8%">Kondisi Lampu</th>
              <th width="8%">Kondisi Aksesories</th>
              <th width="14%">Foto</th>
              <th width="5%">Random Check</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 0;
              $q_getDetailListLampu = mysqli_query($conn, "SELECT * FROM list_report_lampu where id_form = '$id'");
              while($getDetailListLampu = mysqli_fetch_array($q_getDetailListLampu)){
                $no++;
            ?>
              <tr>
                <td align="center"><?php echo $no; ?></td>
                <td><?php echo $getDetailListLampu['no_seri'] ?></td>
                <td align="center"><?php echo $getDetailListLampu['kondisi_lampu'] ?></td>
                <td align="center"><?php echo $getDetailListLampu['kondisi_aksesories'] ?></td>
                <td><img src="dokumentasi/<?php echo $getDetailListLampu['foto'] ?>" width="100%"></td>
                <td align="center"><?php echo $getDetailListLampu['random_check'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <br>
        <center>
          <a href="index.php?pages=editreportlampu&idform=<?php echo $id; ?>"><button class="btn btn-success"><span class="fa fa-edit"></span> Edit</button></a>
          <a href="cetak_report.php?form=lampu&idform=<?php echo $id; ?>" target="_blank"><button class="btn btn-primary"><span class="fa fa-print"></span> Cetak</button></a>
        </center>
      </div>
    </div>

  <?php } ?>

    <!-- /.card-body -->
  </div>
  <!-- /.card -->