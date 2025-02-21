<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getID'])) {
    $id_list = $_POST['getID'];

    $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM approval_sub_list WHERE id = '$id_list'"));
?>

  <!-- Horizontal Form -->
  <div class="card card-info">
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listapproval&tahun=<?php echo $_SESSION['tahun']; ?>" enctype="multipart/form-data" style="font-size: 12px;">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama Project</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="nama_project" style="font-size: 12px;" disabled><?php echo $get_list['nama_sub']; ?></textarea>
          </div>
        </div> 
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Uploader</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="uploader" value="<?php echo $_SESSION['nama']; ?>" style="font-size: 12px;" disabled>
          </div>
        </div>
         <div class="form-group row">
          <label class="col-sm-3 col-form-label">File</label>
          <div class="col-sm-9">
            <input type="file" class="form-control" name="berkas_upload" style="font-size: 12px;" Accept="Application/Pdf" required>
            <p style="color: red">Ekstensi yang diperbolehkan .pdf .xls .xlsx</p>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <input type="hidden" name="id_list" value="<?php echo $id_list; ?>">
        <input type="submit" class="btn btn-primary float-right" name="upload_file" value="Upload">
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

<?php } ?>