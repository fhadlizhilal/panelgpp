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
        <td><input type="text" style="width: 100%" name="merek_tipe" value="<?php echo $get_data_inspeksigerinda['merek_tipe']; ?>" required></td>
      </tr>
    </table>
    <table class="table table-sm" style="font-size: 12px;">
      <tr>
        <td width="80%">1. Body / kondisi fisik mesin gerinda dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_1">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_1'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_1'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_1'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_1'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">2. Kondisi kabel-kabel tidak terkelupas dan dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_2">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_2'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_2'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_2'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_2'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">3. Steker pada kabel gerinda dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_3">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_3'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_3'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_3'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_3'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">4. Kondisi power (On / Off) berfungsi dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_4">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_4'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_4'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_4'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_4'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">5. Side handle tersedia dan dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_5">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_5'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_5'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_5'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_5'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">6. Terdapat cover / proteksi batu berinda teresdia dan terpasang</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_6">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_6'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_6'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_6'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_6'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">7. Carbon brush dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_7">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_7'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_7'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_7'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_7'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">8. Ventilasi udara gerinda bersih</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_8">
           <option value="Bagus" <?php if($get_data_inspeksigerinda['point_8'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_8'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_8'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_8'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">9. Kondisi mesin atau motor dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_9">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_9'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_9'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_9'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_9'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">10. Flange / penjepit batu gerinda terpasang dengan kuat</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_10">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_10'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_10'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_10'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_10'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">11. Pastikan cakram / batu gerinda terpasang kuat dan dalam kondisi bagus</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_11">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_11'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_11'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_11'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_11'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">12. Terdapat kunci untuk membuka dan mengencangkan flange cakram</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_12">
            <option value="Bagus" <?php if($get_data_inspeksigerinda['point_12'] == "Bagus"){ echo "selected"; } ?>>Baik</option>
            <option value="Sedang" <?php if($get_data_inspeksigerinda['point_12'] == "Sedang"){ echo "selected"; } ?>>Rusak</option>
            <option value="Buruk" <?php if($get_data_inspeksigerinda['point_12'] == "Buruk"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksigerinda['point_12'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%"><b>Hasil Akhir</b></td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="hasil_akhir">
            <option value="Baik" <?php if($get_data_inspeksigerinda['hasil_akhir'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksigerinda['hasil_akhir'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksigerinda['hasil_akhir'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
          </select>
        </td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_gerinda" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-success btn-sm" name="edit_data_gerinda" value="Simpan Data Gerinda">
    </div>