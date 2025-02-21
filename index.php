<?php
  session_start();

  if(isset($_SESSION["LOGINMARKETING"]) || $_SESSION["LOGINMARKETING"] != "login_manager"){
    header("location: login.php");
    exit();
  }elseif(isset($_SESSION["LOGINMARKETING"]) || $_SESSION["LOGINMARKETING"] != "login_sales"){
    header("location: login.php");
    exit();
  }elseif(isset($_SESSION["LOGINMARKETING"]) || $_SESSION["LOGINMARKETING"] == "login_manager"){
    header("location: /manager/");
    exit();
  }elseif(isset($_SESSION["LOGINMARKETING"]) || $_SESSION["LOGINMARKETING"] == "login_sales"){
    header("location: /sales/");
    exit();
  }
?>