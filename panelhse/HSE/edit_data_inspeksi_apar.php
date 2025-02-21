<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_inspeksiapar = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailapar WHERE id = '$id'"));
    }
?>
    <table class="table table-sm" style="font-size: 12px;">
      <tr>
        <td width="25%">Merek / Tipe</td>
        <td width="1%">:</td>
        <td><input type="text" style="width: 100%" name="merek_tipe" value="<?php echo $get_data_inspeksiapar['merek_tipe']; ?>" required></td>
      </tr>
    </table>
    <table class="table table-sm" style="font-size: 12px;">
      <tr>
        <td width="80%">1. Nomor tabung sesuai</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_1">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_1'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_1'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_1'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_1'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">2. Penempatan APAR benar</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_2">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_2'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_2'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_2'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_2'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">3. Penempatan APAR pada area kerja dan mudah dicapai</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_3">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_3'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_3'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_3'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_3'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">4. APAR dalam kondisi bersih</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_4">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_4'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_4'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_4'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_4'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">5. Terdapat data kelas kebakaran pada APAR</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_5">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_5'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_5'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_5'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_5'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">6. Terdapat data media pemadam</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_6">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_6'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_6'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_6'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_6'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">7. Terdapat instruk atau petunjuk penggunaan</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_7">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_7'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_7'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_7'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_7'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">8. Terpasang tagging / label pemeriksaan</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_8">
           <option value="Baik" <?php if($get_data_inspeksiapar['point_8'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_8'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_8'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_8'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">9. Isi APAR cukup (tidak < 10% dari berat normal)</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_9">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_9'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_9'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_9'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_9'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">10. Seal dan pin pengaman terpasang dengan baik</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_10">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_10'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_10'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_10'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_10'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%">11. Jarum indikator tekanan menunjukan kondisi normal</td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="point_11">
            <option value="Baik" <?php if($get_data_inspeksiapar['point_11'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['point_11'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['point_11'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
            <option value="NA" <?php if($get_data_inspeksiapar['point_11'] == "NA"){ echo "selected"; } ?>>NA</option>
          </select>
        </td>
      </tr>
      <tr>
        <td width="80%"><b>Hasil Akhir</b></td>
        <td width="1%">:</td>
        <td width="19%">
          <select style="width: 100%" name="hasil_akhir">
            <option value="Baik" <?php if($get_data_inspeksiapar['hasil_akhir'] == "Baik"){ echo "selected"; } ?>>Baik</option>
            <option value="Rusak" <?php if($get_data_inspeksiapar['hasil_akhir'] == "Rusak"){ echo "selected"; } ?>>Rusak</option>
            <option value="Hilang" <?php if($get_data_inspeksiapar['hasil_akhir'] == "Hilang"){ echo "selected"; } ?>>Hilang</option>
          </select>
        </td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_apar" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-success btn-sm" name="edit_data_apar" value="Simpan Data APAR">
    </div>