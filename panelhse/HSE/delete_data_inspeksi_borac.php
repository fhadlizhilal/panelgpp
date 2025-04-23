<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_inspeksiborac = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailborac WHERE id = '$id'"));
    }
?>
    <table class="table table-sm" style="font-size: 12px;">
      <tr>
        <td width="25%">Merek / Tipe</td>
        <td width="1%">:</td>
        <td><?php echo $get_data_inspeksiborac['merek_tipe']; ?></td>
      </tr>
    </table>
    <table class="table table-sm" style="margin-bottom: 10px; font-size: 10px;">
      <tr>
        <td width="70%">1. Kabel power dalam kondisi baik, tidak ada yang terkelupas atau sobek</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_1']; ?></td>
      </tr>
      <tr>
        <td width="70%">2. Tombol switch on/off berfungsi dengan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_2']; ?></td>
      </tr>
      <tr>
        <td width="70%">3. Tombol switch pemutar kedalam dan keluar berfunsi dengan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_3']; ?></td>
      </tr>
      <tr>
        <td width="70%">4. Pegangan tambahan</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_4']; ?></td>
      </tr>
      <tr>
        <td width="70%">5. Mesin penggerak atau motor penggerak berfungsi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_5']; ?></td>
      </tr>
      <tr>
        <td width="70%">6. Tombol pengunci tersedia dan dapat digunakan</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_6']; ?></td>
      </tr>
      <tr>
        <td width="70%">7. Kunci pembuka mata bor tersedia</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_7']; ?></td>
      </tr>
      <tr>
        <td width="70%">8. Vent angin mesin bor tidak tertutup</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_8']; ?></td>
      </tr>
      <tr>
        <td width="70%">9. Badan mesin bor dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_9']; ?></td>
      </tr>
      <tr>
        <td width="70%">10. Rumah mata bor dalam keadaan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['point_10']; ?></td>
      </tr>
      <tr>
        <td width="70%"><b>Hasil Akhir</b></td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiborac['hasil_akhir']; ?></td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_borac" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger btn-sm" name="delete_data_borac" value="Delete Data Bor AC" onclick="return confirm('Yakin delete data Bor AC ini?')">
    </div>