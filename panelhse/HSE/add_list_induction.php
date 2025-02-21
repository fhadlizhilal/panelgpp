<?php
	session_start();
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
	}
?>

	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Project</label>
	    <div class="col-8">
	      <select class="form-control form-control-sm" name="project_id" required>
	      		<option value="" selected disabled>---- Pilih Project ----</option>
	      	<?php
	      		$q_getProject = mysqli_query($conn, "SELECT * FROM hse_project WHERE hse_officer = '$_SESSION[manpower_id]' AND id NOT IN (SELECT project_id FROM hse_inductionreport WHERE hse_officer = '$_SESSION[manpower_id]')");
	      		while($getProject = mysqli_fetch_array($q_getProject)){
	      	?>
	      			<option value="<?php echo $getProject['id']; ?>"><?php echo $getProject['nama_project']; ?></option>
	      	<?php } ?>
	      </select>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Tgl Induction</label>
	    <div class="col-5">
	      <input type="date" class="form-control form-control-sm" name="tgl_induction" required>
	    </div>
	 </div>
	 <div class="form-group row" style="margin-bottom: 8px;">
	    <label class="col-3 col-form-label" style="font-size: 12px;">Tempat</label>
	    <div class="col-8">
	      <input type="text" class="form-control form-control-sm" name="tempat" required>
	    </div>
	 </div>
	<hr>
	<input type="hidden" name="hse_officer" value="<?php echo $_SESSION['manpower_id']; ?>">