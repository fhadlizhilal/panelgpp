<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_inspeksigerinda = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailgerinda WHERE id = '$id'"));
    }
?>
    <table class="table table-sm" style="font-size: 12px;">
      <tr>
        <td width="25%">Merek / Tipe</td>
        <td width="1%">:</td>
        <td><?php echo $get_data_inspeksigerinda['merek_tipe']; ?></td>
      </tr>
    </table>
    <table class="table table-sm" style="margin-bottom: 10px; font-size: 10px;">
      <tr>
        <td width="70%">1. Body / kondisi fisik mesin gerinda dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_1']; ?></td>
      </tr>
      <tr>
        <td width="70%">2. Kondisi kabel-kabel tidak terkelupas dan dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_2']; ?></td>
      </tr>
      <tr>
        <td width="70%">3. Steker pada kabel gerinda dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_3']; ?></td>
      </tr>
      <tr>
        <td width="70%">4. Kondisi power (On / Off) berfungsi dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_4']; ?></td>
      </tr>
      <tr>
        <td width="70%">5. Side handle tersedia dan dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_5']; ?></td>
      </tr>
      <tr>
        <td width="70%">6. Terdapat cover / proteksi batu berinda teresdia dan terpasang</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_6']; ?></td>
      </tr>
      <tr>
        <td width="70%">7. Carbon brush dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_7']; ?></td>
      </tr>
      <tr>
        <td width="70%">8. Ventilasi udara gerinda bersih</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_8']; ?></td>
      </tr>
      <tr>
        <td width="70%">9. Kondisi mesin atau motor dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_9']; ?></td>
      </tr>
      <tr>
        <td width="70%">10. Flange / penjepit batu gerinda terpasang dengan kuat </td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_10']; ?></td>
      </tr>
      <tr>
        <td width="70%">11. Pastikan cakram / batu gerinda terpasang kuat dan dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_11']; ?></td>
      </tr>
      <tr>
        <td width="70%">12. Terdapat kunci untuk membuka dan mengencangkan flange cakram</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['point_12']; ?></td>
      </tr>
      <tr>
        <td width="70%"><b>Hasil Akhir</b></td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksigerinda['hasil_akhir']; ?></td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_gerinda" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger btn-sm" name="delete_data_gerinda" value="Delete Data Gerinda" onclick="return confirm('Yakin delete data Gerinda ini?')">
    </div>