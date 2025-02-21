<?php
	error_reporting(0);
	session_start();
	require_once "../../../dev/config.php";

	function fRupiah($angka){
    return 'Rp ' . number_format($angka, 0, ',', '.');
	}

	if(isset($_POST['getID'])){
		$count_pertanggungjawaban = 0;
  	$kd_project = $_POST['getID'];
  	$get_project = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM project WHERE kd_project = '$kd_project'"));
  	$get_projectcardList = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM projectcard_list WHERE kd_project = '$kd_project'"));
  	$get_PM = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_projectcardList[pm]'"));
  	$get_SM = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan_sm WHERE id = '$get_projectcardList[sm]'"));

  	$q_get_pengajuanList = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kode_project = '$kd_project'");
  	$count_pengajuan = mysqli_num_rows($q_get_pengajuanList);
  	
  	while($get_pengjuanList = mysqli_fetch_array($q_get_pengajuanList)){
  		$nr_pertanggungjawaban = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$get_pengjuanList[no_npb]'"));
  		$count_pertanggungjawaban = $count_pertanggungjawaban + $nr_pertanggungjawaban;
  	}

	}
?>

<div class="row">
	<div class="col-lg-6 col-12">
		<div class="card-body p-0" style="background-color: white">
			<table width="100%" class="table table-sm" style="font-size: 11px;">
				<tr>
	        <td width="40%" style="font-size: 18px; background-color: #0091b5; color: white;"><b>PROJECT CARD</b></td>
	        <td width="3%" style="background-color: #ffafab"></td>
	        <td style="font-size: 18px; background-color: #ffafab"><b><?php echo $kd_project; ?></b></td>
	      </tr>
	      <tr>
	        <td colspan="3" align="center"><b><?php echo $get_project["nm_project"]; ?></b></td>
	      </tr>
			</table>
			<div class="row">
				<div class="col-6">
					<table width="100%" class="table table-sm" style="font-size: 11px;">
			      <tr>
			        <td>Nama PM</td>
			        <td>:</td>
			        <td>
			        	<?php
			        		$namaPM = explode(' ', trim($get_PM["nama"])); 
			        		echo $namaPM[0]." ".$namaPM[1]." ".$namaPM[2]
			        	?>	
			        </td>
			      </tr>
			      <tr>
			        <td>Nama SM</td>
			        <td>:</td>
			        <td>
			        	<?php
			        		$namaSM = explode(' ', trim($get_SM["nama"])); 
			        		echo $namaSM[0]." ".$namaSM[1]." ".$namaSM[2]
			        	?>
			        </td>
			      </tr>
			      <tr>
			        <td>HPP Barang</td>
			        <td>:</td>
			        <td><?php echo fRupiah($get_project["hpp_barang"]); ?></td>
			      </tr>
			      <tr>
			        <td>HPP Jasa</td>
			        <td>:</td>
			        <td><?php echo fRupiah($get_project["hpp_jasa"]); ?></td>
			      </tr>
			      <tr>
			        <td>HPP Asset</td>
			        <td>:</td>
			        <td><?php echo fRupiah($get_project["hpp_asset"]); ?></td>
			      </tr>
			      <tr>
			        <td>Total HPP</td>
			        <td>:</td>
			        <td><?php echo fRupiah($get_project["hpp_barang"]+$get_project["hpp_jasa"]+$get_project["hpp_asset"]); ?></td>
			      </tr>
			    </table>
			  </div>

			  <div class="col-6">
					<table width="100%" class="table table-sm" style="font-size: 11px;">
			      <tr>
			        <td>Plan Start</td>
			        <td width="2%">:</td>
			        <td><?php echo date("d F Y", strtotime($get_project['start'])); ?></td>
			      </tr>
			      <tr>
			        <td>Plan End</td>
			        <td>:</td>
			        <td><?php echo date("d F Y", strtotime($get_project['deadline'])); ?></td>
			      </tr>
			      <tr>
			        <td>Plan Days</td>
			        <td>:</td>
			        <td>
			        	<?php
			        		$plan_days = (strtotime($get_project['deadline']) - strtotime($get_project['start'])) / (60 * 60 * 24)+1;
			        		echo ceil($plan_days)." Hari";
			        	?>
			        </td>
			      </tr>
			      <tr>
			        <td>Actual Start</td>
			        <td width="2%">:</td>
			        <td><?php echo date("d F Y", strtotime($get_projectcardList['actual_start'])); ?></td>
			      </tr>
			      <tr>
			        <td>Actual End</td>
			        <td>:</td>
			        <td>
			        	<?php
			        		if($get_projectcardList['actual_end'] == "0000-00-00" || $get_projectcardList['actual_end'] == "0001-01-01"){
			        			echo "-";
			        		}else{
			        			echo date("d F Y", strtotime($get_projectcardList['actual_end']));
			        		}
			        	?>
			        </td>
			      </tr>
			      <tr>
			        <td>Actual Days <?php if($get_projectcardList['actual_end'] == "0000-00-00" || $get_projectcardList['actual_end'] == "0001-01-01"){ echo "(OG)"; } ?></td>
			        <td>:</td>
			        <td>
			        	<?php
			        		$tgl_now = date("Y-m-d");
			        		if($get_projectcardList['actual_end'] == "0000-00-00" || $get_projectcardList['actual_end'] == "0001-01-01"){ $get_projectcardList['actual_end'] = $tgl_now; }
			        		$plan_days = (strtotime($get_projectcardList['actual_end']) - strtotime($get_projectcardList['actual_start'])) / (60 * 60 * 24);
			        		echo (ceil($plan_days)+1)." Hari";
			        	?>
			        </td>
			      </tr>
			    </table>
			  </div>
		  </div>

	    <table width="100%" class="table table-sm" style="font-size: 11px;">
	      <tr>
	        <td width="35%">Realisasi</td>
	        <td width="2%">:</td>
	        <td><b><?php echo $count_pertanggungjawaban." dari ".$count_pengajuan; ?></b> Pengajuan</td>
	      </tr>
	      <tr>
	        <td>Penyerapan Barang</td>
	        <td>:</td>
	        <td>
	        	<!-- Penyerapan Barang -->
            <?php
              $t_penyerapanBarang = 0;
              $persen_penyerapan_barang = 0;
              $q_get_pengajuanProject = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kode_project = '$get_projectcardList[kd_project]' AND jenis = 'Barang'");
              while($get_pengajuanProject = mysqli_fetch_array($q_get_pengajuanProject)){
                $get_realisasiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$get_pengajuanProject[no_npb]'"));
                $t_penyerapanBarang = $t_penyerapanBarang + $get_realisasiProject["jml_realisasi"];
              }

              //hitung penyerapan barang
              $persen_penyerapan_barang = $t_penyerapanBarang/$get_project['hpp_barang']*100;
              if($t_penyerapanBarang<1){
                $persen_penyerapan_barang = 0;
              }
            ?>
	        	<div class="progress-bar-container">
	           	<div class="progress-bar bg-info" style="width: <?php echo $persen_penyerapan_barang; ?>%;"></div>
	            <div class="progress-text"><?php echo number_format($persen_penyerapan_barang,2); ?>%</div>
	          </div>
	        </td>
	      </tr>
	      <tr>
	        <td>Penyerapan Jasa</td>
	        <td>:</td>
	        <td>
	        	<!-- Penyerapan Jasa -->
            <?php
              $t_penyerapanJasa = 0;
              $persen_penyerapan_jasa = 0;
              $q_get_pengajuanProject = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kode_project = '$get_projectcardList[kd_project]' AND jenis = 'Jasa'");
              while($get_pengajuanProject = mysqli_fetch_array($q_get_pengajuanProject)){
                $get_realisasiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$get_pengajuanProject[no_npb]'"));
                $t_penyerapanJasa = $t_penyerapanJasa + $get_realisasiProject["jml_realisasi"];
              }

              //hitung penyerapan barang
              $persen_penyerapan_jasa = $t_penyerapanJasa/$get_project['hpp_jasa']*100;
              if($t_penyerapanJasa<1){
                $persen_penyerapan_jasa = 0;
              }
            ?>
	        	<div class="progress-bar-container">
	           	<div class="progress-bar bg-info" style="width: <?php echo $persen_penyerapan_jasa; ?>%;"></div>
	            <div class="progress-text"><?php echo number_format($persen_penyerapan_jasa,2); ?>%</div>
	          </div>
	        </td>
	      </tr>
	      <tr>
	        <td>Penyerapan Asset</td>
	        <td>:</td>
	        <td>
	        	<!-- Penyerapan Asset -->
            <?php
              $t_penyerapanAsset = 0;
              $persen_penyerapan_asset = 0;
              $q_get_pengajuanProject = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kode_project = '$get_projectcardList[kd_project]' AND jenis = 'Asset'");
              while($get_pengajuanProject = mysqli_fetch_array($q_get_pengajuanProject)){
                $get_realisasiProject = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$get_pengajuanProject[no_npb]'"));
                $t_penyerapanAsset = $t_penyerapanAsset + $get_realisasiProject["jml_realisasi"];
              }

              //hitung penyerapan barang
              $persen_penyerapan_asset = $t_penyerapanAsset/$get_project['hpp_asset']*100;
              if($t_penyerapanAsset<1){
                $persen_penyerapan_asset = 0;
              }
            ?>
	        	<div class="progress-bar-container">
	           	<div class="progress-bar bg-info" style="width: <?php echo $persen_penyerapan_asset; ?>%;"></div>
	            <div class="progress-text"><?php echo number_format($persen_penyerapan_asset,2); ?>%</div>
	          </div>
	        </td>
	      </tr>

	      <tr>
	        <td>&nbsp;</td>
	        <td></td>
	        <td></td>
	      </tr>

	      <tr>
	        <td>Tanggal Update</td>
	        <td>:</td>
	        <td><?php echo date("d F Y", strtotime($get_projectcardList['tgl_update'])); ?></td>
	      </tr>
	      <tr>
	        <td>Progress Plan</td>
	        <td>:</td>
	        <td>
	        	<div class="progress-bar-container">
	           	<div class="progress-bar bg-primary" style="width: <?php echo $get_projectcardList['update_plan']; ?>%;"></div>
	            <div class="progress-text"><?php echo $get_projectcardList['update_plan']; ?>%</div>
	          </div>
	        </td>
	      </tr>
	      <tr>
	        <td>Progress Actual</td>
	        <td>:</td>
	        <td>
	        	<div class="progress-bar-container">
	           	<div class="progress-bar bg-success" style="width: <?php echo $get_projectcardList['update_progress']; ?>%;"></div>
	            <div class="progress-text"><?php echo $get_projectcardList['update_progress']; ?>%</div>
	          </div>
	        </td>
	      </tr>
	      <tr>
	        <td>Deviasi Progress</td>
	        <td>:</td>
	        <td>
	        	<?php
	        		$deviasi_progress = $get_projectcardList['update_progress'] - $get_projectcardList['update_plan'];

	        		if($deviasi_progress > 0){
	        	?>
			        	<span class="description-percentage text-success">
		              <i class="fas fa-caret-up"></i>
		                <?php echo number_format($deviasi_progress,2)."%";?>
		            </span>

		        <?php }else{ ?>

		        		<span class="description-percentage text-danger">
		              <i class="fas fa-caret-down"></i>
		                <?php echo number_format($deviasi_progress,2)."%";?>
		            </span>
		       <?php } ?>
	        </td>
	      </tr>
	      <tr>
	        <td>Total Penyerapan</td>
	        <td>:</td>
	        <td>
	        	<!-- Total Penyerapan -->
            <?php
              $total_penyerapan = $t_penyerapanBarang + $t_penyerapanJasa + $t_penyerapanAsset;
              $persen_t_penyerapan = $total_penyerapan/($get_project['hpp_barang'] + $get_project['hpp_jasa'] + $get_project['hpp_asset'])*100;
              if($total_penyerapan < 1){
                $persen_t_penyerapan = 0;
              }
            ?>
	        	<div class="progress-bar-container">
	           	<div class="progress-bar bg-warning" style="width: <?php echo $persen_t_penyerapan; ?>%;"></div>
	            <div class="progress-text"><?php echo $persen_t_penyerapan; ?>%</div>
	          </div>
	        </td>
	      </tr>
	      <tr>
	        <td>Deviasi Penyerapan</td>
	        <td>:</td>
	        <td style="font-weight: bold;">
            <!-- Deviasi -->
            <?php 
              $deviasi_penyerapan = $get_projectcardList['update_progress'] - $persen_t_penyerapan;

              if($deviasi_penyerapan > 0){
            ?>
                <span class="description-percentage text-success">
                  <i class="fas fa-caret-up"></i>
                    <?php echo number_format($deviasi_penyerapan,2)."%";?>
                </span>
            <?php }else{ ?>
                <span class="description-percentage text-danger">
                  <i class="fas fa-caret-down"></i>
                    <?php echo number_format($deviasi_penyerapan,2)."%";?>
                </span>
            <?php } ?>
          </td>
	      </tr>
		  </table>

		</div>
	</div>
	<!-- COL END -->

	<div class="col-lg-6 col-12">
		<div class="card-body table-responsive p-0" style="height: 350px;">
			<table class="table table-striped table-head-fixed table-sm" style=" width: 100%; font-size: 10px;">
				<thead>
					<tr>
						<th width="1%">No</th>
						<th>Keterangan</th>
						<th>Jenis</th>
						<th>Pelaksana</th>
						<th>Pengajuan</th>
						<th>Realisasi</th>
						<th>Deviasi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						$total_pengajuan_belumrealisasi = 0;
						$q_get_pengajuanList = mysqli_query($conn, "SELECT * FROM pengajuan_list WHERE kode_project = '$kd_project'");
						while($get_pengajuanList = mysqli_fetch_array($q_get_pengajuanList)){
							$get_pertanggungjawaban = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pertanggungjawaban_list WHERE no_npb = '$get_pengajuanList[no_npb]'"));
							$get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_pengajuanList[pelaksana]'"));
							$namaPertama = explode(' ', trim($get_karyawan["nama"]));
					?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><?php echo $get_pengajuanList["keterangan"]; ?></td>
							<td><?php echo $get_pengajuanList["jenis"]; ?></td>
							<td><?php echo $namaPertama[0]; ?></td>
							<td><?php echo number_format($get_pengajuanList["nilai"], 0, ',', '.'); ?></td>
							<td><?php echo number_format($get_pertanggungjawaban["jml_realisasi"], 0, ',', '.'); ?></td>
							<td><?php echo number_format(($get_pengajuanList["nilai"] - $get_pertanggungjawaban["jml_realisasi"]), 0, ',', '.'); ?></td>
						</tr>
					<?php
							if($get_pengajuanList['jenis'] == "Barang"){
								$total_realisasi_barang = $total_realisasi_barang + $get_pertanggungjawaban["jml_realisasi"];
							}elseif($get_pengajuanList['jenis'] == "Jasa"){
								$total_realisasi_jasa = $total_realisasi_jasa + $get_pertanggungjawaban["jml_realisasi"];
							}elseif($get_pengajuanList['jenis'] == "Asset"){
								$total_realisasi_asset = $total_realisasi_asset + $get_pertanggungjawaban["jml_realisasi"];
							}

							$total_pengajuan = $total_pengajuan + $get_pengajuanList["nilai"];
							$total_realisasi = $total_realisasi + $get_pertanggungjawaban["jml_realisasi"];
							$selisih = $get_pengajuanList["nilai"] - $get_pertanggungjawaban["jml_realisasi"];
							$total_selisih = $total_selisih + $selisih;

							if($get_pertanggungjawaban["jml_realisasi"]<1){
								$total_pengajuan_belumrealisasi = $total_pengajuan_belumrealisasi + $get_pengajuanList["nilai"];
							}
							$no++;
						}
					?>

					<tr>
						<td colspan="4" align="center"><b>TOTAL</b></td>
						<td><b><?php echo number_format($total_pengajuan, 0, ',', '.'); ?></b></td>
						<td><b><?php echo number_format($total_realisasi, 0, ',', '.'); ?></b></td>
						<td><b><?php echo number_format($total_selisih, 0, ',', '.'); ?></b></td>
					</tr>
					<tr>
						<td colspan="4" align="center"><b>TOTAL PENGAJUAN BELUM REALISASI</b></td>
						<td colspan="3"><b><?php echo number_format($total_pengajuan_belumrealisasi, 0, ',', '.'); ?></b></td>
					</tr>
				</tbody>
			</table>

		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-12">
				<table class="table table-sm" style="font-size: 10px;">
					<tr>
						<td width="50%"><b>Total Realisasi Barang</b></td>
						<td width="2%">:</td>
						<td><?php echo number_format($total_realisasi_barang, 0, ',', '.'); ?></td>
					</tr>
					<tr>
						<td width=""><b>Total Realisasi Jasa</b></td>
						<td width="2%">:</td>
						<td><?php echo number_format($total_realisasi_jasa, 0, ',', '.'); ?></td>
					</tr>
					<tr>
						<td width=""><b>Total Realisasi Asset</b></td>
						<td width="2%">:</td>
						<td><?php echo number_format($total_realisasi_asset, 0, ',', '.'); ?></td>
					</tr>
					<tr style="background-color: yellow;">
						<td width=""><b>Total Realisasi</b></td>
						<td width="2%">:</td>
						<td><?php echo number_format($total_realisasi_barang+$total_realisasi_jasa+$total_realisasi_asset, 0, ',', '.'); ?></td>
					</tr>
				</table>
			</div>
			<div class="col-lg-6 col-12">
				<table class="table table-sm" style="font-size: 10px;">
					<tr>
						<td width="50%"><b>Deviasi Realisasi Barang</b></td>
						<td width="2%">:</td>
						<td><?php echo number_format($get_project["hpp_barang"] - $total_realisasi_barang, 0, ',', '.'); ?></td>
					</tr>
					<tr>
						<td width=""><b>Deviasi Realisasi Jasa</b></td>
						<td width="2%">:</td>
						<td><?php echo number_format($get_project["hpp_jasa"] - $total_realisasi_jasa, 0, ',', '.'); ?></td>
					</tr>
					<tr>
						<td width=""><b>Deviasi Realisasi Asset</b></td>
						<td width="2%">:</td>
						<td><?php echo number_format($get_project["hpp_asset"] - $total_realisasi_asset, 0, ',', '.'); ?></td>
					</tr>
					<tr style="background-color: yellow;">
						<td width=""><b>Total Deviasi</b></td>
						<td width="2%">:</td>
						<td><?php echo number_format($get_project["hpp_barang"]+$get_project["hpp_jasa"]+$get_project["hpp_asset"]-$total_realisasi_barang-$total_realisasi_jasa-$total_realisasi_asset, 0, ',', '.'); ?></td>
					</tr>
				</table>
			</div>
		</div>

		<?php if($_SESSION['nama'] == "Akbar Kurnia"){ ?>
			<form action="" method="POST">
				<?php if($get_projectcardList['status'] == "progress"){ ?>
					<div class="row">
						<input type="hidden" name="kd_project" value="<?php echo $kd_project; ?>">
						<div class="col-6">
							<input type="submit" class="btn btn-success" name="projectcard_done" value="Project Done" style="width: 100%" onclick="return confirm('Apakah anda yakin project ini sudah selesai?')">
						</div>
						<div class="col-6">
							<input type="submit" class="btn btn-danger" name="projectcard_delete" value="Delete Project" style="width: 100%" onclick="return confirm('Apakah anda yakin akan menghapus project card ini?')">
						</div>
					</div>
				<?php }elseif($get_projectcardList['status'] == "done"){ ?>
					<div class="row">
						<input type="hidden" name="kd_project" value="<?php echo $kd_project; ?>">
						<div class="col-12">
							<input type="submit" class="btn btn-warning" name="projectcard_to_progress" value="To Progress" style="width: 100%" onclick="return confirm('Apakah anda yakin project ini diprogress kembali?')">
						</div>
					</div>
				<?php } ?>
			</form>
		<?php } ?>

	</div>
</div>