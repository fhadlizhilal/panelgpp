<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $get_sub_approval_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM approval_sub_list WHERE id = '$id'"));
    $get_approval_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM approval_list WHERE id = '$get_sub_approval_list[approval_list_id]'"));
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Sub List Approval</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Sub List Approval</li>
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
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
                <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listapproval&tahun=<?php echo $_SESSION['tahun']; ?>" enctype="multipart/form-data" style="font-size: 12px;">
                  <div class="card-body">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">ID</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="" value="<?php echo $id; ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama List Project</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama_project" value="<?php echo $get_approval_list['nama_project']; ?>" placeholder="Nama Project" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nama Sub List Project</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama_sublist" value="<?php echo $get_sub_approval_list['nama_sub']; ?>" placeholder="Nama Sub List Project">
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="submit" class="btn btn-primary float-right" name="ubah_sub_listapproval" value="Ubah">
                </div>
                <!-- /.card-footer -->
              </form>
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

<?php } ?>