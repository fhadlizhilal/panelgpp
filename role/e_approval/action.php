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
    <?php if($_SESSION['role'] == "engineering_manager"){ ?>

      <form action="../engineering_manager/index.php?pages=listapproval&tahun=<?php echo $_SESSION['tahun']; ?>" method="POST">
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
              <td width="20%"><b>Note</b></td>
              <td width="1%">:</td>
              <td>
                <textarea class="form-control" name="note" required></textarea>
              </td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="id_file" value="<?php echo $id_file; ?>">
        <input type="submit" name="action" value="Check/Approve" class="btn btn-success">
        <input type="submit" name="action" value="Reject" class="btn btn-danger">
      </form>

    <?php }elseif($_SESSION['role'] == "sistem_integrator"){ ?>

      <form action="../sistem_integrator/index.php?pages=listapproval&tahun=<?php echo $_SESSION['tahun']; ?>" method="POST">
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
              <td width="20%"><b>Note</b></td>
              <td width="1%">:</td>
              <td>
                <textarea class="form-control" name="note"></textarea>
              </td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="id_file" value="<?php echo $id_file; ?>">
        <input type="submit" name="action" value="Check/Approve" class="btn btn-success">
        <input type="submit" name="action" value="Reject" class="btn btn-danger">
      </form>

    <?php }elseif($_SESSION['role'] == "technician"){ ?>

      <form action="../technician/index.php?pages=listapproval&tahun=<?php echo $_SESSION['tahun']; ?>" method="POST">
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
              <td width="20%"><b>Note</b></td>
              <td width="1%">:</td>
              <td>
                <textarea class="form-control" name="note"></textarea>
              </td>
            </tr>
          </tbody>
        </table>
        <input type="hidden" name="id_file" value="<?php echo $id_file; ?>">
        <input type="submit" name="action" value="Check/Approve" class="btn btn-success">
        <input type="submit" name="action" value="Reject" class="btn btn-danger">
      </form>

    <?php } ?>

  </div>
  <!-- /.card -->

<?php } ?>