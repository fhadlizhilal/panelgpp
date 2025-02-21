<?php
  session_start();
  setlocale(LC_TIME, 'id_ID');
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
    $kodeReport = $_POST['getID'];
    $getDailyreport = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_dailyreport WHERE kd_report = '$kodeReport'"));
    $getProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$getDailyreport[project_id]'"));
  }
?>

  <div style="font-size: 12px">
    <b>*DAILY REPORT*</b><br><br>
    Pekerjaan : <?php echo $getProject['nama_project']; ?><br>
    Lokasi Kerja : <?php echo $getProject['kota']; ?><br>
    Hari, tanggal : <?php echo strftime("%A, %d %B %Y", strtotime($getDailyreport['tgl_report'])); ?><br>
    <br>
    <b>*MANPOWER LIST*</b>
    <?php
      $no=1;
      $q_getJabatan = mysqli_query($conn, "SELECT * FROM hse_jabatan");
      $q_getManpowerProject = mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower WHERE kd_report = '$kodeReport'");
      while($getJabatan = mysqli_fetch_array($q_getJabatan)){
        echo "<br>    ".$no.". ".$getJabatan['jabatan']." : ".mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_manpower WHERE kd_report = '$kodeReport' AND jabatan_id = '$getJabatan[id]'"));
        $no++;
      }
    ?>
    <br>Total Manpower : <?php echo mysqli_num_rows($q_getManpowerProject); ?><br><br>

    <b>*KONDISI CUACA*</b>
    <?php
      $no=1;
      $q_getCuaca = mysqli_query($conn, "SELECT * FROM hse_dailyreport_cuaca WHERE kd_report = '$kodeReport'");
      while($getCuaca = mysqli_fetch_array($q_getCuaca)){
        echo "<br>    ".$no.". ".$getCuaca['cuaca']." (".date("H:i", strtotime($getCuaca['jam_mulai']))." - ".date("H:i", strtotime($getCuaca['jam_selesai'])).")";
        $no++;
      }
    ?>
    <br><br>
    <b>*MANHOUR : <?php echo date("H:i", strtotime($getProject['jam_masuk']))." - ".date("H:i", strtotime($getProject['jam_pulang'])); ?>*</b><br>
    <?php
      $get_manHours = mysqli_fetch_array(mysqli_query($conn, "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(jam_pulang, jam_masuk)))) AS manhour_days FROM hse_dailyreport_manpower WHERE kd_report = '$kodeReport'"));
      list($jam, $menit, $detik) = explode(":", $get_manHours['manhour_days']);
    ?>
       Today  : <?php echo $jam; ?><br>
       Total    : 

    <br><br>
    <b>*HSE ACTIVITY*</b>
    <?php
      $no=1;
      $q_gethseActivity = mysqli_query($conn, "SELECT * FROM hse_dailyreport_dokumentasi WHERE kd_report = '$kodeReport'");
      while($gethseActivity = mysqli_fetch_array($q_gethseActivity)){
        echo "<br>    ".$no.". ".$gethseActivity['pekerjaan'];
        $no++;
      }
    ?>

    <br><br>
    <b>*TOOLS YANG DIGUNAKAN*</b>
    <?php
      $no=1;
      $q_getToolsProject = mysqli_query($conn, "SELECT * FROM hse_dailyreport_tools WHERE kd_report = '$kodeReport'");
      while($getToolsProject = mysqli_fetch_array($q_getToolsProject)){
        $getTools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_tools WHERE id = '$getToolsProject[tools_id]'"));
        echo "<br>    ".$no.". ".$getTools['tools']." [".$getToolsProject['jumlah']." pcs/unit]";
        $no++;
      }
    ?>

    <br><br>
    <b>*TOOLS K3 YANG DIGUNAKAN*</b>
    <?php
      $no=1;
      $q_getToolsK3Project = mysqli_query($conn, "SELECT * FROM hse_dailyreport_toolsk3 WHERE kd_report = '$kodeReport'");
      while($getToolsK3Project = mysqli_fetch_array($q_getToolsK3Project)){
        $getToolsK3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsk3 WHERE id = '$getToolsK3Project[toolsk3_id]'"));
        echo "<br>    ".$no.". ".$getToolsK3['nama_tools']." [".$getToolsK3Project['jumlah']." pcs/unit]";
        $no++;
      }
    ?>

    <br><br>
    <b>*APD YANG DIGUNAKAN*</b>
    <?php
      $no=1;
      $q_getAPDProject = mysqli_query($conn, "SELECT * FROM hse_dailyreport_apd WHERE kd_report = '$kodeReport'");
      while($getAPDProject = mysqli_fetch_array($q_getAPDProject)){
        $getAPD = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_apd WHERE id = '$getAPDProject[apd_id]'"));
        echo "<br>    ".$no.". ".$getAPD['nama_apd']." [".$getAPDProject['jumlah']." pcs/unit]";
        $no++;
      }
    ?>

    <br><br>
    <b>*HSE STATISTIK*</b>
    <br>    1. Fatality : <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Fatallity'")); ?>

    <br>    2. Loss Time Injury : <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Loss Time Injury'")); ?>

    <br>    3. Medical Treatment Injury : <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Medical Treatment Injury'")); ?>

    <br>    4. First Aid Injury : <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'First Aid Injury'")); ?>

    <br>    5. Near Miss : <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Near Miss'")); ?>

    <br>    6. Unsafe Action : <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Unsafe Action'")); ?>

    <br>    7. Unsafe Condition : <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Unsafe Condition'")); ?>

    <br>    8. Enviroment Incident : <?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM hse_dailyreport_isu WHERE kd_report = '$kodeReport' AND kejadian = 'Enviroment Incident'")); ?>

    <br><br>
    <b>*NOTE & KENDALA*</b>
    <?php
      $no=1;
      $q_getKendala = mysqli_query($conn, "SELECT * FROM hse_dailyreport_note WHERE kd_report = '$kodeReport'");
      while($getKendala = mysqli_fetch_array($q_getKendala)){
        echo "<br>    ".$no.". ".$getKendala['note'];
        $no++;
      }

      if(mysqli_num_rows($q_getKendala) < 1){ echo "<br>     - "; }
    ?>
  </div>