<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once "../../dev/config.php";

//---------- Push report ke database ----------------------------
if(isset($_POST['submit_report'])){
  $nik = $_POST['nik'];
  $tanggal = $_POST['tgl'];
  $report = $_POST['report'];
  $today = Date("Y-m-d H:i:s");

  $m_ = Date("m", strtotime($tanggal));
  $y_ = Date("Y", strtotime($tanggal));

  if(strlen($report) < 1){
    header("location: ../".$_SESSION['role']."/index.php?bulan=".$m_."&tahun=".$y_."&pages=dailyreport&session_report=error_report");
  }else{
    $reset_AI = mysqli_query($conn, "ALTER TABLE dailyreport AUTO_INCREMENT = 1");
    $q_add = mysqli_query($conn, "INSERT INTO dailyreport VALUES ('','$nik','$tanggal','$report','$today')");
    if($q_add){
      header("location: ../".$_SESSION['role']."/index.php?bulan=".$m_."&tahun=".$y_."&pages=dailyreport&session_report=success_report");
    }
  }
}
?>

<!-- ---------- Data di Modal -------------------------------------- -->
<?php
  if(isset($_POST['getDetail'])) {
    $tgl = $_POST['getDetail'];
?>
  
  <script type="text/javascript">
   CKEDITOR.replace( 'content', {  enterMode : CKEDITOR.ENTER_BR, shiftEnterMode : CKEDITOR.ENTER_BR } );

        CKEDITOR.on( 'instanceReady', function( ev )
        {
         ev.editor.dataProcessor.writer.setRules( 'br',
         {
            indent : false,
            breakBeforeOpen : false,
            breakAfterOpen : false,
            breakBeforeClose : false,
            breakAfterClose : false
         });
   });
</script>

  <form method="POST" action="../all_role/add_report.php" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
        <div class="item form-group">
          <div class="row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Karyawan</label>
            <div class="col-md-9 col-sm-9 ">
              <?php
                require_once "../../dev/config.php";
                $q_data = mysqli_query($conn,"SELECT * FROM karyawan where nik = '$_SESSION[nik]'");
                $data = mysqli_fetch_array($q_data);
              ?>
              <input type="text" name="abc" required="required" class="form-control" value="<?php echo $data['nama']." - ".$_SESSION['nik']; ?>" disabled>
            </div>
          </div>
        </div>
        <div class="item form-group">
          <div class="row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tanggal</label>
            <div class="col-md-9 col-sm-9 ">
              <input type="date" name="def" required="required" class="form-control" value="<?php echo $tgl; ?>" disabled>
            </div>
          </div>
        </div>
        <div class="item form-group">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">
              Report
            </label>
            <div class="col-md-12 col-sm-12 ">
                <textarea name="report" id="content" class="form-control ckeditor" required="required"></textarea>
            </div>
        </div>
        <div class="ln_solid"></div>
        <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
        <input type="hidden" name="act" value="submit">
        <div class="item form-group">
          <div class="row">
            <div class="col-md-4 col-sm-4"></div>
            <div class="col-md-4 col-sm-4">
              <input type="hidden" name="nik" value="<?php echo $_SESSION['nik']; ?>">
              <input type="hidden" name="tgl" value="<?php echo $tgl; ?>">
              <input  type="submit" name="submit_report" value="Simpan" class="btn btn-info" style="width: 100%">
            </div>
          </div>
        </div>

    </form>

    <script>

 CKEDITOR.replace( 'content', {
  height: 300,
  filebrowserUploadUrl: 'upload.php',
  filebrowserUploadMethod: 'form'
 });

</script>

<?php
  }
?>