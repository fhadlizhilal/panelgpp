<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getID'])) {
    $kd_forecast = $_POST['getID'];

    $q_get_activity = mysqli_query($conn, "SELECT * FROM activity_update WHERE kd_forecast = '$kd_forecast' ORDER BY kd_activity DESC");
    $get_activity_forecast = mysqli_fetch_array($q_get_activity);

    $get_forecast = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM forecast WHERE kd_forecast = '$kd_forecast'"));
    $get_status_forecast = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM status_forecast WHERE id = '$get_forecast[status_forecast]'"));

    $get_kategori = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kategoripenjualan WHERE kd_kategori = '$get_forecast[kategori_kd]'"));


    function rupiah($angka){
    
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
   
    }
?>

  <div class="card">
    <div class="card-body p-0">
      <table class="table table-sm" style="font-size: 12px;">
        <tbody>
          <tr>
            <td width="27%"><b>Kode Forecast</b></td>
            <td width="1%">:</td>
            <td><?php echo $kd_forecast; ?></td>
          </tr>
          <tr>
            <td><b>Badan</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_forecast['badan']; ?></td>
          </tr>
          <tr>
            <td><b>No Tiket</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_forecast['tiketcrm']; ?></td>
          </tr>
          <tr>
            <td><b>Nama Customer</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_forecast['nm_customer']; ?></td>
          </tr>
          <tr>
            <td><b>Perusahaan</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_forecast['perusahaan']; ?></td>
          </tr>
          <tr>
            <td><b>No HP</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_forecast['nohp']; ?></td>
          </tr>
          <tr>
            <td><b>Kategori</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_kategori['nm_kategori']; ?></td>
          </tr>
          <tr>
            <td><b>Deskripsi</b></td> 
            <td width="1%">:</td>
            <td><?php echo $get_forecast['kebutuhan']; ?></td>
          </tr>
          <tr>
            <td><b>Pribadi/Proyek</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_forecast['pribadi_proyek']; ?></td>
          </tr>
          <tr>
            <td><b>Penawaran</b></td>
            <td width="1%">:</td>
            <td><?php echo rupiah($get_forecast['penawaran']); ?></td>
          </tr>
          <tr>
            <td><b>Status Forecast</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_status_forecast['status']; ?></td>
          </tr>
          <tr>
            <td><b>Peluang</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_activity_forecast['peluang']; ?></td>
          </tr>
          <tr>
            <td><b>Created at</b></td>
            <td width="1%">:</td>
            <td><?php echo date('d-m-Y H:i:s', strtotime($get_forecast['tgl_dibuat'])); ?></td>
          </tr>
          <tr>
            <td><b>Last Update</b></td>
            <td width="1%">:</td>
            <td><?php echo date('d-m-Y', strtotime($get_activity_forecast['tgl_update'])); ?>    
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

<?php } ?>