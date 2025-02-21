<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$kd_project = $_POST['getID'];
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$kd_project'"));
    	$get_projectcardList = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM projectcard_list WHERE kd_project = '$kd_project'"));
	}
?>
	<form method="POST" action="">
		<table width="100%" style="font-size: 12px;">
	      <tr>
	        <td width="30%"><b>Kode Project</b></td>
	        <td width="3%">:</td>
	        <td>
	        	<input type="text" name="tanggal_update" class="form-control form-control-sm" value="<?php echo $kd_project; ?>" disabled>
	        </td>
	      </tr>
	      <tr>
	        <td><b>Nama Project</b></td>
	        <td width="3%">:</td>
	        <td>
	        	<input type="text" name="tanggal_update" class="form-control form-control-sm" value="<?php echo $get_project['nm_project']; ?>" disabled>
	        </td>
	      </tr>
	      <tr>
	        <td><b>Tanggal Update</b></td>
	        <td width="3%">:</td>
	        <td><input type="date" name="tanggal_update" class="form-control form-control-sm" value="<?php echo $get_projectcardList["tgl_update"]; ?>" style="width: 150px" required></td>
	      </tr>
	      <tr>
	        <td><b>Plan</b></td>
	        <td width="3%">:</td>
	        <td>
	        	<div class="input-group input-group-sm" style="width: 150px;">
                  <input type="number" step="0.01" class="form-control" name="update_plan" value="<?php echo $get_projectcardList['update_plan']; ?>">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
	        </td>
	      </tr>
	      <tr>
	        <td><b>Progress</b></td>
	        <td width="3%">:</td>
	        <td>
	        	<div class="input-group input-group-sm" style="width: 150px;">
                  <input type="number" step="0.01" class="form-control" name="update_progress" value="<?php echo $get_projectcardList['update_progress']; ?>">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
	        </td>
	      </tr>
	    </table>
		<br>
		<input type="hidden" name="kd_project" value="<?php echo $kd_project; ?>">
    	<input type="submit" class="btn btn-success" style="width: 100%" name="submit_update_projectcard" value="Update">
	</form>