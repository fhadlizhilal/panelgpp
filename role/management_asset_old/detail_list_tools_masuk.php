<?php
  session_start();
  require_once "../../dev/config.php";

  $get_list_tools_masuk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tools_masuk WHERE no_masuk = '$_POST[getID]'"));
?>

  <div class="card">
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-sm" style="font-size: 11px;">
          <tr>
            <td width="14%"><b>Nomor Masuk<b></td>
            <td width="1%">:</td>
            <td><?php echo $get_list_tools_masuk["no_masuk"]; ?></td>
          </tr>
          <tr>
            <td><b>Tanggal Masuk</b></td>
            <td>:</td>
            <td><?php echo $get_list_tools_masuk["tgl_masuk"]; ?></td>
          </tr>
          <tr>
            <td><b>Kode Project</b></td>
            <td>:</td>
            <td><?php echo $get_list_tools_masuk["kd_project"]; ?></td>
          </tr>
          <tr>
            <td><b>Keterangan</b></td>
            <td>:</td>
            <td><?php echo $get_list_tools_masuk["keterangan"]; ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <table class="table table-sm table-striped" style="font-size: 10px;">
          <thead>
            <tr>
              <th width="1%">No</th>
              <th>Kode Tools</th>
              <th>Kode Detail</th>
              <th>Nama Tools</th>
              <th>Jenis Tools</th>
              <th>Sub Tools</th>
              <th>Tipe</th>
              <th>Merek</th>
              <th>Qty</th>
              <th>Satuan</th>
              <th>Harga Satuan</th>
              <th>Total Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no=0;
              $total_qty = 0;
              $total_harga = 0;
              $q_ToolsMasukDetail = mysqli_query($conn, "SELECT * FROM tools_masuk_detail WHERE no_masuk = '$_POST[getID]'");
              while($get_ToolsMasukDetail = mysqli_fetch_array($q_ToolsMasukDetail)){
                $get_toolsDetail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM v_tools_detail WHERE detail_id = '$get_ToolsMasukDetail[id_detail]'"));
                $no++;
            ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $get_toolsDetail['tools_id']; ?></td>
                  <td><?php echo $get_ToolsMasukDetail['id_detail']; ?></td>
                  <td><?php echo $get_toolsDetail['nama_tools']; ?></td>
                  <td><?php echo $get_toolsDetail['jenis_tools']; ?></td>
                  <td><?php echo $get_toolsDetail['sub_tools']; ?></td>
                  <td><?php echo $get_toolsDetail['tipe_detail']; ?></td>
                  <td>1</td>
                  <td><?php echo $get_ToolsMasukDetail['qty']; ?></td>
                  <td><?php echo $get_toolsDetail['satuan']; ?></td>
                  <td><?php echo "Rp ".number_format($get_ToolsMasukDetail['harga_satuan'],0); ?></td>
                  <td><?php echo "Rp ".number_format($get_ToolsMasukDetail['qty'] * $get_ToolsMasukDetail['harga_satuan'],0); ?></td>
                </tr>
            <?php
                $total_qty = $total_qty + $get_ToolsMasukDetail['qty'];
                $total_harga = $total_harga + ($get_ToolsMasukDetail['qty'] * $get_ToolsMasukDetail['harga_satuan']);
              } 
            ?>
                <tr>
                  <td colspan="8"><b>TOTAL</b></td>
                  <td><b><?php echo $total_qty; ?></b></td>
                  <td colspan="2"></td>
                  <td><b><?php echo "Rp ".number_format($total_harga,0); ?></b></td>
                </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->