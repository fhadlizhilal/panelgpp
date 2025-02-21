<?php
  session_start();
  require_once "../../dev/config.php";

  //Cek ada Kekurangan atau tidak
?>
  
  <form method="POST" action="">
    <p style="font-size: 11px;">barang yang diserahkan sudah sesuai dengan list detail nomor pinjam : <br><b><?php echo $_POST['getID']; ?></b> ?</p>
    <table>
      <tr style="font-size: 11px;">
        <td width="1%"><input type="checkbox" name="" value="Ya" style="float: left;" required></td>
        <td>Ya, Sudah</td>
      </tr>
    </table>
    <input type="hidden" name="no_pinjam" value="<?php echo $_POST['getID']; ?>">
    <input type="submit" class="btn btn-success" name="followup_pinjam_tools" value="Serahkan ke User" style="font-size: 11px; float: right;">
  </form> 