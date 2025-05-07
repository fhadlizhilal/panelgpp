<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_fotobordc = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_fotobordc WHERE id = '$id'"));
    }
?>
    <center>
      <img src="../../role/HSE/foto_inspeksi_bordc/<?php echo $get_data_fotobordc['foto']; ?>" style="width: 90%;">
      <br>
      <?php echo $get_data_fotobordc['keterangan']; ?>
    </center>
    <br>
      <div style="color: red;">Yakin Delete Foto ini?</div>
    <br>
    <center>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <input type="hidden" name="foto" value="<?php echo $get_data_fotobordc['foto']; ?>">
      <input type="submit" class="btn btn-danger" name="delete_dokumentasi_inspeksibordc" value="Delete">
    </center>