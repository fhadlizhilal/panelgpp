<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_dailyreport_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower WHERE id = '$id'"));
    	$get_dailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$get_dailyreport_manpower[kd_report]'"));
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_dailyreport[project_id]'"));
    	$get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$get_dailyreport_manpower[manpower_id]'"));
    	$get_jabatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_jabatan WHERE id = '$get_dailyreport_manpower[jabatan_id]'"));
	}
?>

<div class="card">
    <form method="POST" action="">
      <div class="card-body">
        <table class="table table-sm" style="font-size: 12px; padding-bottom: -15px;">
          <tr>
            <td width="30%"><b>Nama Project</b></td>
            <td width="1%">:</td>
            <td><?php echo $get_project['nama_project']; ?></td>
          </tr>
          <tr>
            <td><b>Tgl Absen</b></td>
            <td>:</td>
            <td><?php echo date("d-m-Y", strtotime($get_dailyreport['tgl_report'])); ?></td>
          </tr>
          <tr>
            <td><b>Nama Manpower</b></td>
            <td>:</td>
            <td><?php echo $get_manpower['nama']; ?></td>
          </tr>
          <tr>
            <td><b>Jabatan</b></td>
            <td>:</td>
            <td><?php echo $get_jabatan['jabatan']; ?></td>
          </tr>
          <tr>
            <td><b>Absensi</b></td>
            <td>:</td>
            <td>
            	<div class="form-group" style="font-size: 14px; padding-right: 200px;">
	                <div class="form-check bg-success color-palette" style="padding-bottom: 3px; padding-left: 25px;">
		                <input class="form-check-input" type="radio" name="absensi" value="Hadir" <?php if($get_dailyreport_manpower['absensi'] == "Hadir"){ echo "checked"; } ?>>
		                <label class="form-check-label">Hadir</label>
	                </div>
	                <div class="form-check bg-warning color-palette" style="padding-bottom: 3px; padding-left: 25px;">
	                	<input class="form-check-input" type="radio" name="absensi" value="Izin" <?php if($get_dailyreport_manpower['absensi'] == "Izin"){ echo "checked"; } ?>>
	                	<label class="form-check-label">Izin</label>
	                </div>
	                <div class="form-check bg-secondary color-palette" style="padding-bottom: 3px; padding-left: 25px;">
	                	<input class="form-check-input" type="radio" name="absensi" value="Sakit" <?php if($get_dailyreport_manpower['absensi'] == "Sakit"){ echo "checked"; } ?>>
	                	<label class="form-check-label">Sakit</label>
	                </div>
	                <div class="form-check bg-danger color-palette" style="padding-bottom: 3px; padding-left: 25px;">
	                	<input class="form-check-input" type="radio" name="absensi" value="Alpa" <?php if($get_dailyreport_manpower['absensi'] == "Alpa"){ echo "checked"; } ?>>
	                	<label class="form-check-label">Alpa</label>
	                </div>
	            </div>
            </td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" class="btn btn-success" name="edit_absensi_manpower" value="Simpan">
      </div>
    </form>
 </div>
    <!-- /.card-body -->