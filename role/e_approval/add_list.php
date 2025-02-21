<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getNIK'])) {
    $nik = $_POST['getNIK'];
?>
  
  <!-- Horizontal Form -->
  <div class="card card-info">
   <!--  <div class="card-header">
      <h3 class="card-title">Horizontal Form</h3>
    </div> -->
    <!-- /.card-header -->
    <!-- form start -->
    <form method="POST" action="../<?php echo $_SESSION['role'] ?>/index.php?pages=listapproval&tahun=<?php echo $_SESSION['tahun']; ?>" class="form-horizontal" style="font-size: 14px;">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama Project</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="nama_project"></textarea>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <input type="hidden" name="nik" value="<?php echo $nik; ?>">
        <input type="submit" class="btn btn-primary float-right" name="submit_add_list" value="Simpan">
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

<?php } ?>