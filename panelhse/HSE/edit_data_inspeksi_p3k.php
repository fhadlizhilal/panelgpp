<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_inspeksip3k = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailp3k WHERE id = '$id'"));
    }
?>
    <table class="table table-sm" style="font-size: 12px; margin-bottom: 0px;">
      <tr>
        <td width="60%"><b>Tipe Kotak</b></td>
        <td width="1%">:</td>
        <td>
          <select name="tipe_kotak" style="width: 100%;" required>
            <option value="" selected disabled>Pilih Tipe Kotak</option>
            <option value="A" <?php if($get_data_inspeksip3k['tipe_kotak'] == "A"){ echo "selected"; } ?>>Tipe A</option>
            <option value="B" <?php if($get_data_inspeksip3k['tipe_kotak'] == "B"){ echo "selected"; } ?>>Tipe B</option>
            <option value="C" <?php if($get_data_inspeksip3k['tipe_kotak'] == "C"){ echo "selected"; } ?>>Tipe C</option>
          </select>
        </td>
      </tr>
    </table>
    <table class="table table-sm" style="font-size: 12px;">
      <tr>
        <td width="75%">1. Kasa steril terbungkus</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_1" min="0" value="<?php echo $get_data_inspeksip3k['point_1'] ?>" style="width: 100%" required>
        </td>
      </tr>
      <tr>
        <td width="75%">2. Perban (lebar 5 cm)</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_2" min="0" value="<?php echo $get_data_inspeksip3k['point_2'] ?>" style="width: 100%" required>
        </td>
      </tr>
      <tr>
        <td width="75%">3. Perban (lebar 10 cm)</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_3" min="0" value="<?php echo $get_data_inspeksip3k['point_3'] ?>" style="width: 100%" required></select>
        </td>
      </tr>
      <tr>
        <td width="75%">4. Plester (lebar 1,25 cm)</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_4" min="0" value="<?php echo $get_data_inspeksip3k['point_4'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">5. Plester Cepat</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_5" min="0" value="<?php echo $get_data_inspeksip3k['point_5'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">6. Kapas (25 gram)</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_6" min="0" value="<?php echo $get_data_inspeksip3k['point_6'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">7. Kain segitiga / Mitela</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_7" min="0" value="<?php echo $get_data_inspeksip3k['point_7'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">8. Gunting</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_8" min="0" value="<?php echo $get_data_inspeksip3k['point_8'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">9. Peniti</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_9" min="0" value="<?php echo $get_data_inspeksip3k['point_9'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">10. Sarung tangan sekali pakai</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_10" min="0" value="<?php echo $get_data_inspeksip3k['point_10'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">11. Masker</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_11" min="0" value="<?php echo $get_data_inspeksip3k['point_11'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">12. Pinest</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_12" min="0" value="<?php echo $get_data_inspeksip3k['point_12'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">13. Lampu senter</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_13" min="0" value="<?php echo $get_data_inspeksip3k['point_13'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">14. Gelas untuk cuci mata</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_14" min="0" value="<?php echo $get_data_inspeksip3k['point_14'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">15. Kantong plastik bersih</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_15" min="0" value="<?php echo $get_data_inspeksip3k['point_15'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">16. Aquades (100 ml)</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_16" min="0" value="<?php echo $get_data_inspeksip3k['point_16'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">17. Pavidon lodin (60 ml)</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_17" min="0" value="<?php echo $get_data_inspeksip3k['point_17'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">18. Alkohol 70%</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_18" min="0" value="<?php echo $get_data_inspeksip3k['point_18'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">19. Buku panduan P3K</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_19" min="0" value="<?php echo $get_data_inspeksip3k['point_19'] ?>" style="width: 100%" required></td>
      </tr>
      <tr>
        <td width="75%">20. Buku cararan daftar isi kotak</td>
        <td width="1%">:</td>
        <td width="">
          <input type="number" name="point_20" min="0" value="<?php echo $get_data_inspeksip3k['point_20'] ?>" style="width: 100%" required></td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_p3k" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-success btn-sm" name="edit_data_p3k" value="Simpan Data P3K">
    </div>