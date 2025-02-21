<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $get_approval_list = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM approval_list WHERE id = '$id'"));
    $get_initiate = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_approval_list[initiate]'"));
    $get_pimpro = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_approval_list[pimpro]'"));
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Delete List Approval</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Delete List Approval</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div> -->
              <!-- /.card-header -->
              <form class="form-horizontal" method="post" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=listapproval&tahun=<?php echo $_SESSION['tahun']; ?>" enctype="multipart/form-data" style="font-size: 12px;">
                <div class="card-body">
                  <table class="table">
                    <tr>
                      <td width="30%">ID</td>
                      <th width="1%">:</th>
                      <td><?php echo $id; ?></td>
                    </tr>
                    <tr>
                      <td>Nama Project</td>
                      <th width="1%">:</th>
                      <td><?php echo $get_approval_list['nama_project']; ?></td>
                    </tr>
                    <tr>
                      <td>Initiate</td>
                      <th width="1%">:</th>
                      <td><?php echo $get_initiate['nama']; ?></td>
                    </tr>
                    <tr>
                      <td>Pimpro</td>
                      <th width="1%">:</th>
                      <td><?php echo $get_pimpro['nama']; ?></td>
                    </tr>
                    <tr>
                      <td>Created at</td>
                      <th width="1%">:</th>
                      <td><?php echo $get_approval_list['created_at']; ?></td>
                    </tr>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <div style="color: red;">Yakin delete list approval ini?</div>
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="submit" class="btn btn-danger float-right" name="delete_listapproval" value="Delete">
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