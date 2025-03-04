<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_inspeksip3k = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailp3k WHERE id = '$id'"));
    }
?>
   
      <table class="table table-sm" style="font-size: 12px; margin-bottom: 0px;">
        <tr>
          <td width="75%"><b>Tipe Kotak</b></td>
          <td width="1%">:</td>
          <td><b><?php echo $get_data_inspeksip3k['tipe_kotak']; ?></b></td>
        </tr>
      </table>
      <table class="table table-sm" style="font-size: 12px;">
        <tr>
          <td width="75%">1. Kasa steril terbungkus</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_1']; ?></td>
        </tr>
        <tr>
          <td width="75%">2. Perban (lebar 5 cm)</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_2']; ?></td>
        </tr>
        <tr>
          <td width="75%">3. Perban (lebar 10 cm)</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_3']; ?></select>
          </td>
        </tr>
        <tr>
          <td width="75%">4. Plester (lebar 1,25 cm)</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_4']; ?></td>
        </tr>
        <tr>
          <td width="75%">5. Plester Cepat</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_5']; ?></td>
        </tr>
        <tr>
          <td width="75%">6. Kapas (25 gram)</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_6']; ?></td>
        </tr>
        <tr>
          <td width="75%">7. Kain segitiga / Mitela</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_7']; ?></td>
        </tr>
        <tr>
          <td width="75%">8. Gunting</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_8']; ?></td>
        </tr>
        <tr>
          <td width="75%">9. Peniti</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_9']; ?></td>
        </tr>
        <tr>
          <td width="75%">10. Sarung tangan sekali pakai</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_10']; ?></td>
        </tr>
        <tr>
          <td width="75%">11. Masker</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_11']; ?></td>
        </tr>
        <tr>
          <td width="75%">12. Pinest</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_12']; ?></td>
        </tr>
        <tr>
          <td width="75%">13. Lampu senter</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_13']; ?></td>
        </tr>
        <tr>
          <td width="75%">14. Gelas untuk cuci mata</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_14']; ?></td>
        </tr>
        <tr>
          <td width="75%">15. Kantong plastik bersih</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_15']; ?></td>
        </tr>
        <tr>
          <td width="75%">16. Aquades (100 ml)</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_16']; ?></td>
        </tr>
        <tr>
          <td width="75%">17. Pavidon lodin (60 ml)</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_17']; ?></td>
        </tr>
        <tr>
          <td width="75%">18. Alkohol 70%</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_18']; ?></td>
        </tr>
        <tr>
          <td width="75%">19. Buku panduan P3K</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_19']; ?></td>
        </tr>
        <tr>
          <td width="75%">20. Buku cararan daftar isi kotak</td>
          <td width="1%">:</td>
          <td width=""><?php echo $get_data_inspeksip3k['point_20']; ?></td>
        </tr>
      </table>
    
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_p3k" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger btn-sm" name="delete_data_p3k" value="Delete Data P3K" onclick="return confirm('Yakin delete data P3K ini?')">
    </div>