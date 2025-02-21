<?php
  require_once("dev/config.php");

  session_start();
  if(isset($_POST['signin']) && $_POST['signin']=="signin"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM v_karyawan WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $karyawan = mysqli_fetch_assoc($result);
        $_SESSION['nik'] = $karyawan['nik'];
        $_SESSION['nama'] = $karyawan['nama'];
        $_SESSION['jabatan'] = $karyawan['jabatan'];
        $_SESSION['username'] = $karyawan['username'];
        $_SESSION['password'] = $karyawan['password'];
        $_SESSION['role'] = $karyawan['role'];
        $_SESSION['foto'] = $karyawan['foto'];

        $_SESSION['tanggal_masuk_set'] = date("d-m-Y");
        $_SESSION['jam_masuk_set'] = "08:30";
        $_SESSION['tanggal_pulang_set'] = date("d-m-Y");
        $_SESSION['jam_pulang_set'] = "16:30";
        $_SESSION['tanggal_penilaian'] = date("d-m-Y");

          if($_SESSION['foto'] == ""){
            $_SESSION['foto'] = "vector_user.png";
          }

        //redirec to folder role
        if($_SESSION['role'] == "president_director"){
          header("Location: role/president_director/index.php");

        }elseif($_SESSION['role'] == "director"){
          header("Location: role/director/index.php");

        }elseif($_SESSION['role'] == "commissioner"){
          header("Location: role/commissioner/index.php");

        }elseif($_SESSION['role'] == "marketing_manager"){
          header("Location: role/marketing_manager/index.php");

        }elseif($_SESSION['role'] == "marketing"){
          header("Location: role/marketing/index.php");

        }elseif($_SESSION['role'] == "adm_marketing"){
          header("Location: role/adm_marketing/index.php");

        }elseif($_SESSION['role'] == "busdev"){
          header("Location: role/busdev/index.php");

        }elseif($_SESSION['role'] == "IT"){
          header("Location: role/IT/index.php");

        }elseif($_SESSION['role'] == "HR_finance_manager"){
          header("Location: role/HR_finance_manager/index.php");

        }elseif($_SESSION['role'] == "accounting"){
          header("Location: role/accounting/index.php");

        }elseif($_SESSION['role'] == "finance"){
          header("Location: role/finance/index.php");

        }elseif($_SESSION['role'] == "HR"){
          header("Location: role/HR/index.php");

        }elseif($_SESSION['role'] == "GA"){
          header("Location: role/GA/index.php");

        }elseif($_SESSION['role'] == "management_asset"){
          header("Location: role/management_asset/index.php");

        }elseif($_SESSION['role'] == "engineering_manager"){
          header("Location: role/engineering_manager/index.php");

        }elseif($_SESSION['role'] == "technician"){
          header("Location: role/technician/index.php");

        }elseif($_SESSION['role'] == "support_technician"){
          header("Location: role/support_technician/index.php");

        }elseif($_SESSION['role'] == "project_adm"){
          header("Location: role/project_adm/index.php");

        }elseif($_SESSION['role'] == "plan_design"){
          header("Location: role/plan_design/index.php");

        }elseif($_SESSION['role'] == "sistem_integrator"){
          header("Location: role/sistem_integrator/index.php");

        }elseif($_SESSION['role'] == "op_engineer"){
          header("Location: role/op_engineer/index.php");

        }elseif($_SESSION['role'] == "logistic"){
          header("Location: role/logistic/index.php");

        }elseif($_SESSION['role'] == "HSE"){
          header("Location: role/HSE/index.php");

        }elseif($_SESSION['role'] == "team_qc"){
          header("Location: role/team_qc/index.php");

        }else{
          $_SESSION['alert_error'] = "Role anda tidak ditemukan! Hubungi Admin! ";
        }

    } else {
        $_SESSION['alert_error'] = "Password atau Username Salah! ";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel GPP | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Sweet Alarm -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Panel</b> GPP</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="signin" value="signin" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sweet Alarm -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

<?php if (@$_SESSION['alert_success']) { ?>
  <script>
    swal("Good job!", "<?php echo $_SESSION['alert_success']; ?>", "success");
  </script>
<?php unset($_SESSION['alert_success']); } ?>

<?php if (@$_SESSION['alert_error']) { ?>
  <script>
    swal("Oh My Bad!", "<?php echo $_SESSION['alert_error']; ?>", "error");
  </script>
<?php unset($_SESSION['alert_error']); } ?>

</body>
</html>
