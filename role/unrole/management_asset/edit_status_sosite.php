<?php
	require_once "../../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];
    	$get_so_site = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_stockopname_site WHERE id = '$id'"));
    	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_so_site[kd_project]'"));
	}
?>

<div class="form-group row" style="margin-bottom: 8px;">
    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kode Project</label>
    <div class="col-sm-9">
      <input type="text" name="" class="form-control form-control-sm" value="<?php echo $get_so_site['kd_project']; ?>" disabled>
    </div>
</div>
<div class="form-group row" style="margin-bottom: 8px;">
    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
    <div class="col-sm-9">
      <input type="text" name="" class="form-control form-control-sm" value="<?php echo $get_project['nm_project']; ?>" disabled>
    </div>
</div>
<div class="form-group row" style="margin-bottom: 8px;">
    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Created_at</label>
    <div class="col-sm-9">
      <input type="text" name="" class="form-control form-control-sm" value="<?php echo $get_so_site['created_at']; ?>" disabled>
    </div>
</div>
<div class="form-group row" style="margin-bottom: 8px;">
    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Submitted_at</label>
    <div class="col-sm-9">
      <input type="text" name="" class="form-control form-control-sm" value="<?php echo $get_so_site['submitted_at']; ?>" disabled>
    </div>
</div>
<div class="form-group row" style="margin-bottom: 8px;">
    <label class="col-sm-3 col-form-label" style="font-size: 12px;">Status</label>
    <div class="col-sm-4">
      <select name="status" class="form-control form-control-sm">
      	<option value="open" <?php if($get_so_site['status'] == 'open'){ echo "selected"; } ?>>Open</option>
      	<option value="completed" <?php if($get_so_site['status'] == 'completed'){ echo "selected"; } ?>>Completed</option>
      	<option value="closed" <?php if($get_so_site['status'] == 'closed'){ echo "selected"; } ?>>Closed</option>
      </select>
    </div>
</div>
<!-- /.card-body -->
<hr>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<center>
	<input type="submit" class="btn btn-primary btn-sm" name="edit_status_sosite" value="Simpan">
</center>
<!-- /.card-footer -->