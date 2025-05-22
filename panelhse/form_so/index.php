<?php
  error_reporting(0);
  ob_start(); 
  session_start();

  require_once "../all_role/header.php";
  require_once "../../dev/config.php";

  if(isset($_POST['cek_nik'])){
    $q_getManpower = mysqli_query($conn, "SELECT * FROM hse_manpower WHERE nik = '$_POST[nik_manpower]'");
    $cek_nik = mysqli_num_rows($q_getManpower);

    if($cek_nik>0){
      $q_dataSPK = mysqli_query($conn, "SELECT * FROM hse_inductionreport_spk WHERE induction_id = '$_POST[spkid]' AND nik = '$_POST[nik_manpower]'");
      $get_dataSPK = mysqli_fetch_array($q_dataSPK);
      $cek_data_spk = mysqli_num_rows($q_dataSPK);

      if($cek_data_spk>0){
        header("location: index.php?pages=toreportspk&spkid=".$_POST['spkid']."&induction_spk_id=".$get_dataSPK['id']);
      }else{
        header("location: index.php?pages=formspk&spkid=".$_POST['spkid']."&nik=".$_POST['nik_manpower']);
      }
    }else{
      header("location: index.php?pages=formaddmanpower&spkid=".$_POST['spkid']."&nik=".$_POST['nik_manpower']);
    }
  }

?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php
    if(!isset($_GET['pages'])){
      header("location:../");
    }elseif($_GET['pages'] == "formso"){
      require_once "form_so.php";
    }
  ?>
  <!-- ISI KONTEN -->

</div>
</body>
<!-- ./wrapper -->

<?php require_once "../all_role/footer.php"; ?>