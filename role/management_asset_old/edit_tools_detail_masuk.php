<?php
  session_start();
  require_once "../../dev/config.php";

  $get_toolsMasukDetailTMP = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_masuk_detail_tmp WHERE id = '$_POST[getID]'"));
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
    <form method="POST" action="../<?php echo $_SESSION['role']; ?>/index.php?pages=add-masuk-tools">
      <div class="card-body" style="font-size: 12px;">
        <div class="form-group">
          <label>Tools Detail</label>
          <select class="form-control select2" name="id_tools" required>
            <option value="" selected disabled>-- Pilih Tools Detail --</option>
            <?php
              $q_getToolsDetail = mysqli_query($conn, "SELECT * FROM v_tools_detail ORDER BY nama_tools ASC");
              while($get_tools_detail = mysqli_fetch_array($q_getToolsDetail)){
            ?>
              <option value="<?php echo $get_tools_detail['detail_id']; ?>" <?php if($get_tools_detail['detail_id'] == $get_toolsMasukDetailTMP['id_detail']){ echo "selected"; } ?>><?php echo $get_tools_detail['nama_tools']." / ".$get_tools_detail['jenis_tools']." / ".$get_tools_detail['tipe_detail']." / ".$get_tools_detail['merek']." [".$get_tools_detail['detail_id']."]"; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Jumlah (Qty)</label>
          <input type="number" min="1" class="form-control" name="qty" value="<?php echo $get_toolsMasukDetailTMP['qty']; ?>" style="font-size: 12px;" required>
        </div>
        <div class="form-group">
          <label>Harga Satuan</label>
          <input type="number" min="0" step="0.01" class="form-control" name="harga_satuan" value="<?php echo $get_toolsMasukDetailTMP['harga_satuan']; ?>" style="font-size: 12px;" required>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="id" value="<?php echo $_POST['getID']; ?>">
        <input type="submit" class="btn btn-info float-right" name="edit_tools_detail_masuk" value="Simpan">
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