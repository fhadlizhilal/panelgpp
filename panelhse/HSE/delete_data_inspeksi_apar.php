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
        <td><?php echo $get_data_inspeksiapar['merek_tipe']; ?></td>
      </tr>
    </table>
    <table class="table table-sm" style="margin-bottom: 10px; font-size: 10px;">
      <tr>
        <td width="70%">1. Nomor tabung sesuai</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_1']; ?></td>
      </tr>
      <tr>
        <td width="70%">2. Penempatan APAR benar</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_2']; ?></td>
      </tr>
      <tr>
        <td width="70%">3. Penempatan APAR pada area kerja dan mudah dicapai</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_3']; ?></td>
      </tr>
      <tr>
        <td width="70%">4. APAR dalam kondisi bersih</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_4']; ?></td>
      </tr>
      <tr>
        <td width="70%">5. Terdapat data kelas kebakaran pada APAR</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_5']; ?></td>
      </tr>
      <tr>
        <td width="70%">6. Terdapat data media pemadam</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_6']; ?></td>
      </tr>
      <tr>
        <td width="70%">7. Terdapat instruk atau petunjuk penggunaan</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_7']; ?></td>
      </tr>
      <tr>
        <td width="70%">8. Terpasang tagging / label pemeriksaan</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_8']; ?></td>
      </tr>
      <tr>
        <td width="70%">9. Isi APAR cukup (tidak < 10% dari berat normal)</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_9']; ?></td>
      </tr>
      <tr>
        <td width="70%">10. Seal dan pin pengaman terpasang dengan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_10']; ?></td>
      </tr>
      <tr>
        <td width="70%">11. Jarum indikator tekanan menunjukan kondisi normal</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['point_11']; ?></td>
      </tr>
      <tr>
        <td width="70%"><b>Hasil Akhir</b></td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksiapar['hasil_akhir']; ?></td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_apar" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger btn-sm" name="delete_data_apar" value="Delete Data APAR" onclick="return confirm('Yakin delete data APAR ini?')">
    </div>