<?php
  session_start();
  require_once "../../dev/config.php";

  //Cek ada Kekurangan atau tidak
  $lebih = 0;
  $kurang = 0;
  $q_peminjaman_detail = mysqli_query($conn, "SELECT * FROM tools_peminjaman_detail WHERE no_pinjam = '$_POST[getID]'");
  while($get_peminjaman_detail = mysqli_fetch_array($q_peminjaman_detail)){
    $get_toolsKeluarDetail = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sumQty FROM v_keluardetail_tmp WHERE tools_id = '$get_peminjaman_detail[id_tools]'"));

    if($get_toolsKeluarDetail['sumQty'] > $get_peminjaman_detail['qty']){
      $lebih++;
    }elseif($get_toolsKeluarDetail['sumQty'] < $get_peminjaman_detail['qty']){
      $kurang++;
    }
  }
?>
  
  <form method="POST" action="">
    <input type="hidden" name="no_pinjam" value="<?php echo $_POST['getID']; ?>">
    <?php if($lebih > 0 OR $kurang > 0){ ?>
      <p style="font-size: 11px; color: orange;">PERINGATAN! Beberapa tools tidak sesuai dengan jumlah peminjaman user</p>
      <table class="table table-sm table-striped" style="font-size: 12px;">
        <tr>
          <th width="">ID Tools</td>
          <th width="">Nama Tools</td>
          <th width="">Jenis Tools</td>
          <th width="">Kurang</td>
        </tr>
        <?php
        $no_array = 0;
          $q_peminjaman_detail = mysqli_query($conn, "SELECT * FROM tools_peminjaman_detail WHERE no_pinjam = '$_POST[getID]'");
          while($get_peminjaman_detail = mysqli_fetch_array($q_peminjaman_detail)){
            $get_toolsKeluarDetail = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(qty) AS sumQty FROM v_keluardetail_tmp WHERE tools_id = '$get_peminjaman_detail[id_tools]'"));
            if($get_toolsKeluarDetail['sumQty'] > $get_peminjaman_detail['qty'] OR $get_toolsKeluarDetail['sumQty'] < $get_peminjaman_detail['qty']){

              $get_tools = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_db WHERE id_tools = '$get_peminjaman_detail[id_tools]'"));
              $no_array++;
        ?>
          <tr>
            <td>
              <?php echo $get_peminjaman_detail['id_tools']; ?>
              <input type="hidden" name="id_tools<?php echo $no_array; ?>" value="<?php echo $get_peminjaman_detail['id_tools']; ?>">
            </td>
            <td><?php echo $get_tools['nama_tools']; ?></td>
            <td><?php echo $get_tools['jenis_tools']; ?></td>
            <td>
              <?php echo $get_peminjaman_detail['qty'] - $get_toolsKeluarDetail['sumQty']; ?>
              <input type="hidden" name="qty<?php echo $no_array; ?>" value="<?php echo $get_peminjaman_detail['qty'] - $get_toolsKeluarDetail['sumQty']; ?>">
            </td>
          </tr>
        <?php } } ?>
      </table>
      <?php if($kurang > 0 AND $lebih > 0){ ?>
        <p>
          <div style="color: orange; font-size: 11px;">*kekurangan barang akan dibuatkan pengajuan untuk melengkapi jumlah peminjaman</div>
          <div style="color: red; font-size: 11px;">*beberapa barang melebihi jumlah yang dipinjam</div>
        </p>
      <?php } ?>
      <?php if($kurang > 0 AND $lebih == 0){ ?>
        <p style="font-size: 11px; color: orange;">*kekurangan barang akan dibuatkan pengajuan untuk melengkapi jumlah peminjaman</p>
        <input type="hidden" name="no_pinjam" value="<?php echo $_POST['getID'] ?>">
        <input type="submit" class="btn btn-warning" name="buat_pengajuan" value="Buat Pengajuan">
      <?php } ?>
      <?php if($lebih > 0 AND $kurang == 0){ ?>
        <p style="font-size: 11px; color: red;">*beberapa barang melebihi jumlah yang dipinjam</p>
      <?php } ?>
    <?php }else{ ?>
      <p style="font-size: 11px; color: green;">Jumlah barang sudah sesuai dengan yang dipinjam oleh user, yakin approve peminjaman ini?</p>
      <input type="submit" class="btn btn-success" name="followup_pinjam_tools" value="Approve">
    <?php } ?>
  </form>