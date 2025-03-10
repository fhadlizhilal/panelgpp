<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_fotop3k = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotop3k WHERE id = '$id'"));
    }
?>
    <center>
      <img src="../../role/HSE/foto_inspeksi_p3k/<?php echo $get_data_fotop3k['foto']; ?>" style="width: 90%;">
      <br>
      <?php echo $get_data_fotop3k['keterangan']; ?>
    </center>
    <br>
      <div style="color: red;">Yakin Delete Foto ini?</div>
    <br>
    <center>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger" name="delete_dokumentasi_inspeksip3k" value="Delete">
    </center>