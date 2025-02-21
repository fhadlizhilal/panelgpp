<!-- general form elements -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?php echo $_POST['getDetail']; ?></h3>
    </div>
<!-- /.card-header -->
<!-- form start -->
	<form action="index.php?pages=listforecast" method="POST">
  		<div class="card-body">
    		<div class="form-group">
                <label for="tglUpdate">Tanggal Update</label>
                <input type="date" name="tglUpdate" class="form-control" id="tglUpdate" required>
            </div>
            <div class="form-group">
                <label for="StatusForecast">Status Forecast</label>
                <select name="StatusForecast" class="form-control" required>
                	<option value="" selected disabled > -- Pilih Status Forecast Terbaru --</option>
                <?php
                    require_once "../dev/config.php";
                    $data = mysqli_query($conn,"select * from status_forecast where id>1 and id<12");
                    while($d = mysqli_fetch_array($data)){
                ?>
                	<option value="<?php echo $d['id']; ?>"><?php echo $d['status']; ?></option>
                <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" class="form-control" name="keterangan" placeholder="Deskripsi keterangan update activity" required></textarea>
            </div>
            <div class="form-group">
                <label for="plan_followup">Plan Followup</label>
                <textarea id="plan_followup" class="form-control" name="plan_followup" placeholder="Deskripsi rencana followup" required></textarea>
            </div>
            <div class="form-group">
                <label for="kendala">Kendala</label>
                <textarea id="kendala" class="form-control" name="kendala" placeholder="Deskripsi kendala yang hadapi" required></textarea>
            </div>
            <div class="form-group">
                <label for="peluang">Peluang</label>
                <select name="peluang" class="form-control" required>
                	<option value="" selected disabled>-- Pilih Peluang Terbaru --</option>
                	<option value="0">0%</option>
                	<option value="10">10%</option>
                  	<option value="20">20%</option>
                  	<option value="30">30%</option>
                  	<option value="40">40%</option>
                  	<option value="50">50%</option>
                  	<option value="60">60%</option>
                  	<option value="70">70%</option>
                  	<option value="80">80%</option>
                  	<option value="90">90%</option>
                  	<option value="100">100%</option>
                </select>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        	<input type="hidden" name="kdforecast" value="<?php echo $_POST['getDetail']; ?>">
        	<input type="submit" name="updateforecast" value="Update" class="btn btn-primary float-right">
        </div>
    </form>
</div>
<!-- /.card -->