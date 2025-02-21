<?php
  session_start();
  require_once("dev/config.php");

  if(isset($_SESSION['role']) AND $_SESSION['role'] == "HSEUSER"){
    header("Location: panelhse/HSE/index.php");
  }

  if(isset($_POST['signin']) && $_POST['signin']=="signin"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM hse_user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $hse_user = mysqli_fetch_assoc($result);
        $_SESSION['manpower_id'] = $hse_user['manpower_id'];
        $_SESSION['role'] = "HSEUSER";

        //redirec to folder role
        if($_SESSION['role'] == "HSEUSER"){
          header("Location: panelhse/HSE/index.php");

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
  <title>Panel HSE | Login</title>

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
<div class="login-box" style="margin-top: -100px">
  <center><img src=""> </center>
  <div class="login-logo">
   <img src="dist/img/logo/logo-k3-v2.png" width="12%" style="margin-right: 5px;"><a href="#"><b>Panel</b> HSE</a>
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
    <div style="margin-bottom: 5px; margin-top: -10px;"><center><small style="font-size: 8px;">Powered by <b>PT Global Pratama Powerindo</b></small></center></div>
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
