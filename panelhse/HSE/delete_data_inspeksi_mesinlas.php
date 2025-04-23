<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_inspeksimesinlas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailmesinlas WHERE id = '$id'"));
    }
?>
    <table class="table table-sm" style="font-size: 12px;">
      <tr>
        <td width="25%">Merek / Tipe</td>
        <td width="1%">:</td>
        <td><?php echo $get_data_inspeksimesinlas['merek_tipe']; ?></td>
      </tr>
    </table>
    <table class="table table-sm" style="margin-bottom: 10px; font-size: 10px;">
      <tr>
        <td width="70%">1. Body / kondisi fisik mesin las dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_1']; ?></td>
      </tr>
      <tr>
        <td width="70%">2. Kondisi kabel-kabel tidak terkelupas dan dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_2']; ?></td>
      </tr>
      <tr>
        <td width="70%">3. Steker pada kabel mesin las dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_3']; ?></td>
      </tr>
      <tr>
        <td width="70%">4. Kondisi power (On / Off) berfungsi dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_4']; ?></td>
      </tr>
      <tr>
        <td width="70%">5. Rotary switch temperatur dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_5']; ?></td>
      </tr>
      <tr>
        <td width="70%">6. Ampere meter berfungsi dengan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_6']; ?></td>
      </tr>
      <tr>
        <td width="70%">7. Lampu indikator berfungsi</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_7']; ?></td>
      </tr>
      <tr>
        <td width="70%">8. Mesin dan kipas pendingin berfungsi dengan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_8']; ?></td>
      </tr>
      <tr>
        <td width="70%">9. Kutub massa dan elektroda dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_9']; ?></td>
      </tr>
      <tr>
        <td width="70%">10. Kabel tidak terkelupas / terbakar dan holder massa pada kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_10']; ?></td>
      </tr>
      <tr>
        <td width="70%">11. Kabel tidak terkelupas / terbakar dan holder elektroda pada kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['point_11']; ?></td>
      </tr>
      <tr>
        <td width="70%"><b>Hasil Akhir</b></td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksimesinlas['hasil_akhir']; ?></td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_mesinlas" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger btn-sm" name="delete_data_mesinlas" value="Delete Data Mesin Las" onclick="return confirm('Yakin delete data Mesin Las ini?')">
    </div>