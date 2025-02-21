<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getID'])) {
    $kd_forecast = $_POST['getID'];
    $count_activity = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM activity_update"));
    $q_get_statusF = mysqli_query($conn, "SELECT * FROM status_forecast");
?>

  <!-- Horizontal Form -->
  <div class="card card-info">
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listforecast" enctype="multipart/form-data" style="font-size: 12px;">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Kode Forecast</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="_kode_forecast" value="<?php echo $kd_forecast; ?>" disabled>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Status Forecast</label>
          <div class="col-sm-9">
            <select name="status_forecast" class="form-control" required>
                <option value="" selected disabled>-- Pilih Status Forecast Terbaru --</option>
              <?php while($get_statusF = mysqli_fetch_array($q_get_statusF)){ ?>
                <option value="<?php echo $get_statusF['id']; ?>"><?php echo $get_statusF['status']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Keterangan</label>
          <div class="col-sm-9">
            <textarea name="keterangan" class="form-control" required></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Plan Followup</label>
          <div class="col-sm-9">
            <textarea name="plan_followup" class="form-control"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">kendala</label>
          <div class="col-sm-9">
            <textarea name="kendala" class="form-control"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Peluang</label>
          <div class="col-sm-9">
            <select name="peluang" class="form-control" required>
              <option value="" selected disabled>-- Pilih Peluang Terbaru --</option>
              <option value="0%">0%</option>
              <option value="10%">10%</option>
              <option value="20%">20%</option>
              <option value="30%">30%</option>
              <option value="40%">40%</option>
              <option value="50%">50%</option>
              <option value="60%">60%</option>
              <option value="70%">70%</option>
              <option value="80%">80%</option>
              <option value="90%">90%</option>
              <option value="100%">100%</option>
            </select>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <input type="hidden" name="kd_forecast" value="<?php echo $kd_forecast; ?>">
        <input type="submit" class="btn btn-primary float-right" name="update_activity" value="Update">
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

<?php } ?>