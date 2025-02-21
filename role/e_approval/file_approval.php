<?php
session_start();
require_once "../../dev/config.php";

  if(isset($_POST['getID'])) {
    $id_file = $_POST['getID'];

    $get_file = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM approval_file WHERE id = '$id_file'"));
    $get_uploader = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_file[uploader]'"));
?>

  <!-- Horizontal Form -->
  <div class="card card-info">
    <table class="table table-sm" style="font-size: 12px;">
      <tbody>
        <tr>
          <td width="20%"><b>Nama File</b></td>
          <td width="1%">:</td>
          <td><?php echo $get_file['nama_file']; ?></td>
        </tr>
        <tr>
          <td width="20%"><b>Uploader</b></td>
          <td width="1%">:</td>
          <td><?php echo $get_uploader['nama']; ?></td>
        </tr>
        <tr>
          <td width="20%"><b>Tgl Upload</b></td>
          <td width="1%">:</td>
          <td><?php echo $get_file['uploaded_at']; ?></td>
        </tr>
        <tr>
          <td width="20%"><b>Update by PM</b></td>
          <td width="1%">:</td>
          <td>
            <?php echo $get_file['pimpro_updated_at']; ?>
            <?php if($get_file['pimpro_status'] == ""){ ?>
              <span class="badge bg-secondary">waiting..</span>
            <?php }else if($get_file['pimpro_status'] == "checked"){ ?>
              <span class="badge bg-success">Checked</span>
            <?php }else{ ?>
              <span class="badge bg-danger">Rejected</span>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td width="20%"><b>Update by PE</b></td>
          <td width="1%">:</td>
          <td>
            <?php echo $get_file['PM_updated_at']; ?>
            <?php if($get_file['PM_status'] == ""){ ?>
              <span class="badge bg-secondary">waiting..</span>
            <?php }else if($get_file['PM_status'] == "approved"){ ?>
              <span class="badge bg-success">Approved</span>
            <?php }else{ ?>
              <span class="badge bg-danger">Rejected</span>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td width="20%"><b>Note PM</b></td>
          <td width="1%">:</td>
          <td><?php echo $get_file['pimpro_note']; ?></td>
        </tr>
        <tr>
          <td width="20%"><b>Note PE</b></td>
          <td width="1%">:</td>
          <td><?php echo $get_file['PM_note']; ?></td>
        </tr>
      </tbody>
    </table>
    <a href="../all_role/readpdf.php?file=<?php echo $get_file['nama_file']; ?>" target="_blank" class="btn btn-info" style="margin-bottom: 5px;"><span class="fa fa-eye"></span> Lihat</a>
    <a href="../e_approval/file_approval/<?php echo $get_file['nama_file']; ?>" class="btn btn-success"><span class="fa fa-download"></span> Download</a>
  </div>
  <!-- /.card -->

<?php } ?>