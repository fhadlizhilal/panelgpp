<?php
  session_start();
  require_once "../../dev/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Advanced form elements</title>

  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=db-tools-detail">
      <div class="card-body" style="font-size: 12px;">
        <div class="form-group">
          <label>General Tools</label>
          <select class="form-control select2" name="id_tools" style="font-size: 12px;" required>
            <option value="" selected disabled>-- Pilih General Tools --</option>
            <?php
              $q_getTools = mysqli_query($conn, "SELECT * FROM tools_db ORDER BY nama_tools ASC");
              while($get_tools = mysqli_fetch_array($q_getTools)){
            ?>
              <option value="<?php echo $get_tools['id_tools']; ?>"><?php echo $get_tools['nama_tools']." - ".$get_tools['jenis_tools']." [".$get_tools['id_tools']."]"; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>ID Tools Detail</label>
          <input type="text" class="form-control" name="id_tools_detail" required>
        </div>
        <div class="form-group">
          <label>Sub Tools</label>
          <select class="form-control" name="sub_tools" style="font-size: 12px;" required>
            <option value="" selected disabled>-- Pilih Sub Tools --</option>
            <option value="Continue">Continue</option>
            <option value="Habis Pakai">Habis Pakai</option>
          </select>
        </div>
        <div class="form-group">
          <label>Tipe</label>
          <input type="text" class="form-control" name="tipe" required>
        </div>
        <div class="form-group">
          <label>Merek</label>
          <select class="form-control select2" name="id_merek" style="font-size: 12px;" required>
            <option value="" selected disabled>-- Pilih Merek --</option>
            <?php
              $q_getMerek = mysqli_query($conn, "SELECT * FROM merek ORDER BY merek ASC");
              while($get_merek = mysqli_fetch_array($q_getMerek)){
            ?>
              <option value="<?php echo $get_merek['id']; ?>"><?php echo $get_merek['merek']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" class="btn btn-info float-right" name="add_tools_detail" value="Simpan Tools">
      </div>
    </form>
  </div>

<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
</script>
</body>
</html>