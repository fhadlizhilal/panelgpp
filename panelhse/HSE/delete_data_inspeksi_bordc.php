<?php
	require_once "../../dev/config.php";

	if(isset($_POST['getID'])){
    	$id = $_POST['getID'];

    	$get_data_inspeksibordc = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM hse_inspeksilist_detailbordc WHERE id = '$id'"));
    }
?>
    <table class="table table-sm" style="font-size: 12px;">
      <tr>
        <td width="25%">Merek / Tipe</td>
        <td width="1%">:</td>
        <td><?php echo $get_data_inspeksibordc['merek_tipe']; ?></td>
      </tr>
    </table>
    <table class="table table-sm" style="margin-bottom: 10px; font-size: 10px;">
      <tr>
        <td width="70%">1. Tombol pengatur kecepatan berfungsi dengan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['point_1']; ?></td>
      </tr>
      <tr>
        <td width="70%">2. Tombol switch pemutar kedalam dan keluar berfunsi dengan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['point_2']; ?></td>
      </tr>
      <tr>
        <td width="70%">3. Battery tersedia dan terdapat cadangan dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['point_3']; ?></td>
      </tr>
      <tr>
        <td width="70%">4. Mesin penggerak atau motor penggerak berfungsi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['point_4']; ?></td>
      </tr>
      <tr>
        <td width="70%">5. Tombol mode tersedia dan berrfungsi dengan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['point_5']; ?></td>
      </tr>
      <tr>
        <td width="70%">6. Rumah mata bor dapat mengunci dan dalam keadaan baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['point_6']; ?></td>
      </tr>
      <tr>
        <td width="70%">7. Vent angin mesin bor tidak tertutup</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['point_7']; ?></td>
      </tr>
      <tr>
        <td width="70%">8. Badan mesin bor dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['point_8']; ?></td>
      </tr>
      <tr>
        <td width="70%">9. Charger battery tersedia dan dalam kondisi baik</td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['point_9']; ?></td>
      </tr>
      <tr>
        <td width="70%"><b>Hasil Akhir</b></td>
        <td width="1%">:</td>
        <td width=""><?php echo $get_data_inspeksibordc['hasil_akhir']; ?></td>
      </tr>
    </table>
    <div style="text-align: center;">
      <input type="hidden" name="id_detail_bordc" value="<?php echo $id; ?>">
      <input type="submit" class="btn btn-danger btn-sm" name="delete_data_bordc" value="Delete Data Bor DC" onclick="return confirm('Yakin delete data Bor DC ini?')">
    </div>