<?php
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
</table>

<table id="" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
    <tr>
      <th width="1%">No</th>
      <th width="">Nama Barang</th>
      <th width="20%">Jumlah</th>
      <th width="10%">Satuan</th>
    </tr>
    <tr>
      <td colspan="4"><div style="font-size: 12px; font-weight: bold;">APD</div></td>
    </tr>
    <?php
      $no = 1;
      $q_getAPD = mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite_detailapd WHERE id_onsite = '$id'");
      while($getAPD = mysqli_fetch_array($q_getAPD)){
        $get_apd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_apd WHERE id = '$getAPD[apd_id]'"));
    ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $get_apd['nama_apd']; ?></td>
        <td><?php echo $getAPD['jumlah']; ?></td>
        <td><?php echo $get_apd['satuan']; ?></td>
      </tr>
    <?php $no++; } ?>
    <tr>
      <td colspan="4"><div style="font-size: 12px; font-weight: bold;">Tools K3</div></td>
    </tr>
    <?php
      $no = 1;
      $q_getToolsk3 = mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite_detailtoolsk3 WHERE id_onsite = '$id'");
      while($getToolsk3 = mysqli_fetch_array($q_getToolsk3)){
        $get_Toolsk3 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_toolsk3 WHERE id = '$getToolsk3[toolsk3_id]'"));
    ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $get_Toolsk3['nama_tools']; ?></td>
        <td><?php echo $getToolsk3['jumlah']; ?></td>
        <td></td>
      </tr>
    <?php $no++; } ?>
    <tr>
      <td colspan="4"><div style="font-size: 12px; font-weight: bold;">Tools</div></td>
    </tr>
    <?php
      $no = 1;
      $q_getTools = mysqli_query($conn, "SELECT * FROM hse_toolsapdonsite_detailtools WHERE id_onsite = '$id'");
      while($getTools = mysqli_fetch_array($q_getTools)){
        $get_Tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_tools WHERE id = '$getTools[tools_id]'"));
    ?>
      <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $get_Tools['tools']; ?></td>
        <td><?php echo $getTools['jumlah']; ?></td>
        <td></td>
      </tr>
    <?php $no++; } ?>
</table>

<?php if(isset($_SESSION['role']) AND $_SESSION['role'] == "HSE"){ ?>
  <form method="POST" action="">
    <center>
      <input type="hidden" name="id_onsite" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger" name="delete_toolsapd_onsite" value="Delete">
    </center>
  </form>
<?php } ?>