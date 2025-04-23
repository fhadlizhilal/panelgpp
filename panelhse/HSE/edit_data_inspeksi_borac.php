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
        <td><input type="text" style="width: 100%" name="merek_tipe" value="<?php echo $get_data_inspeksiborac['merek_tipe']; ?>" required></td>
      </tr>
    </table>
    <table class="table table-sm" style="font-size: 12px;">
      <tr>
        <td width="80%">1. Kabel power dalam kondisi baik, tidak ada yang terkelupas atau sobek</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_1">
            <option value="Baik" <?php if($get_data_inspeksiborac['point_1'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_1'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_1'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_1'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">2. Tombol switch on/off berfungsi dengan baik</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_2">
            <option value="Baik" <?php if($get_data_inspeksiborac['point_2'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_2'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_2'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_2'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">3. Tombol switch pemutar kedalam dan keluar berfunsi dengan baik</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_3">
            <option value="Baik" <?php if($get_data_inspeksiborac['point_3'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_3'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_3'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_3'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">4. Pegangan tambahan</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_4">
            <option value="Baik" <?php if($get_data_inspeksiborac['point_4'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_4'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_4'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_4'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">5. Mesin penggerak atau motor penggerak berfungsi baik</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_5">
            <option value="Baik" <?php if($get_data_inspeksiborac['point_5'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_5'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_5'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_5'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">6. Tombol pengunci tersedia dan dapat digunakan</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_6">
            <option value="Baik" <?php if($get_data_inspeksiborac['point_6'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_6'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_6'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_6'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">7. Kunci pembuka mata bor tersedia</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_7">
            <option value="Baik" <?php if($get_data_inspeksiborac['point_7'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_7'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_7'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_7'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">8. Vent angin mesin bor tidak tertutup</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_8">
           <option value="Baik" <?php if($get_data_inspeksiborac['point_8'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_8'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_8'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_8'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">9. Badan mesin bor dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_9">
            <option value="Baik" <?php if($get_data_inspeksiborac['point_9'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_9'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_9'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_9'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">10. Rumah mata bor dalam keadaan baik</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_10">
            <option value="Baik" <?php if($get_data_inspeksiborac['point_10'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['point_10'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['point_10'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiborac['point_10'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%"><b>Hasil Akhir</b></td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="hasil_akhir">
            <option value="Baik" <?php if($get_data_inspeksiborac['hasil_akhir'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiborac['hasil_akhir'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiborac['hasil_akhir'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
          </select>
        </td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_borac" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-success btn-sm" name="edit_data_borac" value="Simpan Data Bor AC">
    </div>