<?php
  session_start();
  require_once "../../../dev/config.php";

  if(isset($_POST['getID'])){
      $id = $_POST['getID'];
      $get_sosite = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM asset_stockopname_site WHERE id = '$id'"));
      $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$get_sosite[kd_project]'"));
  }
?>

  <table class="table table-sm table-striped" style="font-size: 11px">
    <tr>
      <td colspan="3" align="center"><b>KETERANGAN PROJECT</b></td>
    </tr>
    <tr>
      <td width="30%">Nama Project</td>
      <td width="1%">:</td>
      <td><?php echo $get_project['nm_project']; ?></td>
    </tr>
    <tr>
      <td>Lokasi</td>
      <td>:</td>
      <td><?php echo $get_project['lokasi_project']; ?></td>
    </tr>
    <tr>
      <td width="30%">Nama PIC</td>
      <td width="1%">:</td>
      <td><?php echo $get_sosite['pic']; ?></td>
    </tr>
    <tr>
      <td>Created_at</td>
      <td>:</td>
      <td><?php echo $get_sosite['created_at']; ?></td>
    </tr>
    <tr>
      <td>Submitted_at</td>
      <td>:</td>
      <td><?php echo $get_sosite['submitted_at']; ?></td>
    </tr>
    <tr>
      <td>Status</td>
      <td>:</td>
      <td>
        <?php if($get_sosite['status'] == "open"){ ?>
          <span class="badge badge-info"><?php echo $get_sosite['status']; ?></span>
        <?php }elseif($get_sosite['status'] == "completed"){ ?>
          <span class="badge badge-success"><?php echo $get_sosite['status']; ?></span>
        <?php }elseif($get_sosite['status'] == "closed"){ ?>
          <span class="badge badge-danger"><?php echo $get_sosite['status']; ?></span>
        <?php } ?>
      </td>
    </tr>
  </table>

  <br>
  <b>Yakin Delete Data Ini? </b>
  <div style="color: red; font-size: 10px;">semua data detail dengan id yang sama akan terhapus</div><br>
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')" name="delete_data_sosite" value="Delete"><span class="fa fa-trash"></span> Delete</button>