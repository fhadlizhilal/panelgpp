<?php
  require_once "../../dev/config.php";
  $get_manpower = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_manpower WHERE id = '$_SESSION[manpower_id]'"));
  $get_hseuser = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_user WHERE manpower_id = '$_SESSION[manpower_id]'"));

  //Ubah password ----------------------------------------------------------
  if(isset($_POST["ubahpassword"])){
    $password_lama = $_POST["password_lama"];
    $password_baru = $_POST["password_baru"];
    $verifikasi_password_baru = $_POST["verifikasi_password_baru"];
    $manpower_id = $_SESSION["manpower_id"];

    $cek_pass_lama = mysqli_query($conn, "SELECT * FROM hse_user WHERE manpower_id = '$manpower_id' AND password = '$password_lama'");
    if(mysqli_num_rows($cek_pass_lama) > 0){
      if($password_baru == $verifikasi_password_baru){
        $edit_password = mysqli_query($conn, "UPDATE hse_user SET password = '$verifikasi_password_baru' WHERE manpower_id = '$manpower_id'");
        if ($edit_password) {
          $_SESSION['alert_success'] = "Password Berhasil Diubah!";
        } else {
          $_SESSION['alert_error'] = "Password Gagal Diubah! " . mysqli_error($conn);
        }
        $conn->close();
      }else{
        $_SESSION['alert_error'] = "Gagal, Verifikasi Password Tidak Sama Dengan Password Baru!";
      }
    }else{
      $_SESSION['alert_error'] = "Gagal, Password lama salah!";
    }
  }

  //Ubah username ----------------------------------------------------------
  if(isset($_POST["ubahusername"])){
    $username_lama = $_POST["username_lama"];
    $username_baru = $_POST["username_baru"];
    $verifikasi_username_baru = $_POST["verifikasi_username_baru"];
    $nik = $_SESSION["nik"];

    $cek_pass_lama = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$nik' AND username = '$username_lama'");
    if(mysqli_num_rows($cek_pass_lama) > 0){
      if($username_baru == $verifikasi_username_baru){
        $sql = "UPDATE karyawan SET username = '$verifikasi_username_baru' WHERE nik = '$nik'";
        if ($conn->query($sql) === TRUE) {
          $_SESSION["username"] = $verifikasi_username_baru; 
          $_SESSION['alert_success'] = "Username Berhasil Diubah!";
        } else {
          $_SESSION['alert_error'] = "Username Gagal Diubah! " . mysqli_error($conn);;
        }

        $conn->close();
      }else{
        $_SESSION['alert_error'] = "Gagal, Verifikasi Username Tidak Sama Dengan Username Baru!";
      }
    }else{
      $_SESSION['alert_error'] = "Gagal, Username lama salah!";
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
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php if($get_manpower['foto'] == ""){ ?>
                    <img class="profile-user-img img-fluid img-circle" src="../../dist/img/Vector-User.png" alt="User Image">
                  <?php }else{ ?>
                    <img class="profile-user-img img-fluid img-circle" src="../../role/HSE/foto_manpower/<?php echo $get_manpower['foto']; ?>" alt="User Image">
                  <?php } ?>
                </div>

                <h3 class="profile-username text-center"><?php echo $get_manpower['nama']; ?></h3>
                <br>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Username</b> <a class="float-right"><?php echo $get_hseuser['username']; ?></a>
                  </li>
                  <?php
                    $password = $get_hseuser['password'];
                    $hash_password = substr($password,-3);
                    $jmlchar = strlen($password)-3;
                  ?>
                  <li class="list-group-item">
                    <b>Password</b> <a class="float-right"><?php for($i=1;$i<=$jmlchar;$i++){echo "*";} echo $hash_password; ?></a>
                  </li>
                </ul>

              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#username" data-toggle="tab">Ubah Username</a></li>
                  <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Ubah Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- tab-panel -->
                  <div class="tab-pane active" id="username">
                    <form class="form-horizontal" action="" method="POST">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Username Lama</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Masukan Username Lama" name="username_lama" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Username Baru</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Masukan Username Baru" name="username_baru" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Verifikasi Username Baru</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" placeholder="Verifikasi Username Baru" name="verifikasi_username_baru" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                          <input type="submit" class="btn btn-danger" name="ubahusername" value="Ubah Username">
                        </div>
                      </div>
                    </form>
                  </div>

                  <!-- tab-panel -->
                  <div class="tab-pane" id="password">
                    <form class="form-horizontal" action="" method="POST">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Password Lama</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Masukan Password Lama" name="password_lama" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">Password Baru</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" placeholder="Masukan Password Baru" name="password_baru" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label">Verifikasi Password Baru</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" placeholder="Verifikasi Password Baru" name="verifikasi_password_baru" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                          <input type="submit" class="btn btn-danger" name="ubahpassword" value="Ubah Password">
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->