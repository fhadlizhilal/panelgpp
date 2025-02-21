<?php
  session_start();
  require_once "../../dev/config.php";

  if(isset($_POST['getID'])){
      $id = $_POST['getID'];
      $get_list_toolsapdonsite = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite WHERE id = '$id'"));
      $get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_project WHERE id = '$get_list_toolsapdonsite[project_id]'"));
  }
?>

<table id="" class="table table-sm" style="font-size: 11px;">
  <tr>
    <th width="35%">Nama Project</th>
    <td width="1%">:</td>
    <td><?php echo $get_project['nama_project']; ?></td>
  </tr>
  <tr>
    <th>Tgl Onsite</th>
    <td>:</td>
    <td><?php echo date("d-m-Y", strtotime($get_list_toolsapdonsite['tgl_onsite'])); ?></td>
  </tr>
  <tr>
    <th>Keterangan Onsite</th>
    <td>:</td>
    <td><?php echo $get_list_toolsapdonsite['keterangan']; ?></td>
  </tr>
  <tr>
    <th>Keterangan Onsite</th>
    <td>:</td>
    <td>
      <?php
        if($get_list_toolsapdonsite['status'] == "completed"){
          echo "<div class='badge badge-success'>".$get_list_toolsapdonsite['status']."</div>";
        }elseif($get_list_toolsapdonsite['status'] == "progress"){
          echo "<div class='badge badge-warning'>".$get_list_toolsapdonsite['status']."</div>";
        }
      ?>
    </td>
  </tr>
</table>

<?php if(isset($_SESSION['role']) AND $_SESSION['role'] == "HSE"){ ?>
  <form method="POST" action="">
    <center>
      <input type="hidden" name="id_onsite" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-warning btn-sm" name="onsite_to_progress" value="to progress" onclick="return confirm('Yakin ingin mengubah status onsite ini menjadi progress kembali?')">
    </center>
  </form>
<?php }else{ ?>
  <div style="font-size: 12px; color: red;"><small>*Hubungi Admin HSE untuk mengubah status kembali menjadi progress</small></div>
<?php } ?>