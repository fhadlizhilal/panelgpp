<?php
  session_start();
  require_once "../../dev/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>

  <div class="card">
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=edit-toolsmasuk&id=<?php echo $_POST['getID2']; ?>">
      <div class="card-body" style="font-size: 12px;">
        <div class="form-group">
          <label>No Masuk</label>
          <input type="text" class="form-control" value="<?php echo $_POST['getID']; ?>" style='font-size: 12px;' disabled>
        </div>
        <div class="form-group">
          <label>Tools Detail</label>
          <select class="form-control select2" name="id_tools" required>
            <option value="" selected disabled>-- Pilih Tools Detail --</option>
            <?php
              $q_getToolsDetail = mysqli_query($conn, "SELECT * FROM v_tools_detail ORDER BY nama_tools ASC");
              while($get_tools_detail = mysqli_fetch_array($q_getToolsDetail)){
            ?>
              <option value="<?php echo $get_tools_detail['detail_id']; ?>"><?php echo $get_tools_detail['nama_tools']." / ".$get_tools_detail['jenis_tools']." / ".$get_tools_detail['tipe_detail']." / ".$get_tools_detail['merek']." [".$get_tools_detail['detail_id']."]"; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Jumlah (Qty)</label>
          <input type="number" min="1" class="form-control" name="qty" required>
        </div>
        <div class="form-group">
          <label>Harga Satuan</label>
          <input type="number" min="0" step="0.01" class="form-control" name="harga_satuan" required>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="no_masuk" value="<?php echo $_POST['getID']; ?>">
        <input type="submit" class="btn btn-info float-right" name="add_toolsmasuk_detail" value="Add Tools">
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