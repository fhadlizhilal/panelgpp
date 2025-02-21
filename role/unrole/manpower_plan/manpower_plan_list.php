<?php
  if(isset($_POST['add_powerplan_list'])){
    if($_POST['add_powerplan_list'] == "Tambah"){
      //push to hse_manpower_planlist
      $push_to_manpowerplan_list = mysqli_query($conn, "INSERT INTO hse_manpower_planlist VALUES('','$_POST[nama_project]','$_POST[keterangan]','$_SESSION[nik]')");

      if($push_to_manpowerplan_list){
        $_SESSION['alert_success'] = "Berhasil! Manpower Plan List Berhasil Dibuat";
      }else{
        $_SESSION['alert_error'] = "Gagal! Manpower Plan List Gagal Dibuat";
      }
    }
  }
?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manpower Plan List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manpower Plan List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-sm-right" style="font-size: 12px;">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_manpowerplanlist' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Tools">
                    <span class="fa fa-plus"></span> Tambah List
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm text-nowrap" style="font-size: 12px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="60%">Nama Project</th>
                      <th width="">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getManpowerPlanList = mysqli_query($conn, "SELECT * FROM hse_manpower_planlist");
                      while($get_manpowerPlanList = mysqli_fetch_array($q_getManpowerPlanList)){
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href="?pages=manpowerplan&id=<?php echo $get_manpowerPlanList['id']; ?>"><?php echo $get_manpowerPlanList['nama_project']; ?></a></td>
                        <td><?php echo $get_manpowerPlanList['keterangan']; ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_manpowerplanlist" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah List</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="">
             <div class="form-group row" style="margin-bottom: 8px;">
                <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
                <div class="col-sm-9">
                  <input type="text" name="nama_project" class="form-control form-control-sm" placeholder="Nama Project" required>
                </div>
              </div>
              <div class="form-group row" style="margin-bottom: 8px;">
                <label class="col-sm-3 col-form-label" style="font-size: 12px;">Keterangan</label>
                <div class="col-sm-9">
                  <textarea name="keterangan" class="form-control form-control-sm"></textarea>
                </div>
              </div>
              <br>
              <center><input type="submit" class="btn btn-success" name="add_powerplan_list" value="Tambah"></center>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_delete_hsetools" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Tools</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-data"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->