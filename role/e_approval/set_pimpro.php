<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getID'])) {
    $id_approval = $_POST['getID'];
    $get_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM v_approval_list WHERE id = '$id_approval'"));
?>

  <!-- Horizontal Form -->
  <div class="card card-info">
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="post" action="../engineering_manager/index.php?pages=setpimpro" style="font-size: 12px;">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">ID</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="_id" value="<?php echo $id_approval; ?>" style="font-size: 12px;" disabled>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Nama Project</label>
          <div class="col-sm-9">
            <textarea class="form-control" name="nama_project" style="font-size: 12px;" disabled><?php echo $get_list['nama_project']; ?></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Pimpro</label>
          <div class="col-sm-9">
            <select class="form-control" name="pimpro" style="font-size: 12px;">
              <option value="" selected disabled>--- Pilih Pimpro ---</option>
              <option value="12150621160296">Hikmah Permana</option>
              <option value="12150622081294">Eldy Darmawan Sendy Pratama</option>
              <option value="12150604160795">Janu Abdu Rohman</option>
              <option value="12150631021297">Rai Purnama Rizki</option>
            </select>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $id_approval; ?>">
        <input type="submit" class="btn btn-primary float-right" name="set_pimpro" value="Set Pimpro">
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->

<?php } ?>