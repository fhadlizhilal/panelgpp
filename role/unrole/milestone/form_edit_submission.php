<?php
  $tanggal_jam = date("Y-m-d H:i:s");

  $get_milestone_detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM milestone_list_detail WHERE id = '$_GET[id]'"));
  $get_milestone = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM milestone_list WHERE id = '$get_milestone_detail[milestone_id]'"));
  $get_person = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_milestone[person]'"));

  // Fungsi untuk kompres gamber sebelum upload
  function compressImage($source, $destination, $quality) {
    // Membaca metadata gambar
    $info = getimagesize($source);

    // Menyesuaikan orientasi gambar jika diperlukan
    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        $exif = @exif_read_data($source);
        if($exif && isset($exif['Orientation'])) {
            $orientation = $exif['Orientation'];
            if($orientation != 1){
                $deg = 0;
                switch ($orientation) {
                    case 3:
                        $deg = 180;
                        break;
                    case 6:
                        $deg = 270;
                        break;
                    case 8:
                        $deg = 90;
                        break;
                }
                $image = imagerotate($image, $deg, 0);
            }
        }
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    } elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
    } else {
        return false;
    }

    // Simpan gambar ke destinasi dengan kualitas tertentu
    imagejpeg($image, $destination, $quality);

    // Hapus gambar dari memori
    imagedestroy($image);

    return true;
  }

  if(isset($_POST['add_attachment_images_submission'])){
    if($_POST['add_attachment_images_submission'] == "Submit"){
      if($_FILES["file"]["name"] != ""){
        // ini adalah path folder upload yang sudah kita buat
        $uploadPath = "../unrole/milestone/lampiran_images/";
          
        if(!empty($_FILES["file"]["name"])) { 
            // File info 
            $nodate = date('YmdHis');
            $fileName = $nodate."_".basename($_FILES["file"]["name"]);
            $imageUploadPath = $uploadPath . $fileName;
            $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
              
            // Tipe format yang diperbolehkan 
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes)){ 
                // Image temp source 
                $imageTemp = $_FILES["file"]["tmp_name"];
                  
                // Ukuran Kompresi 25 (bisa diganti dengan yang lain)
                $compressedImage = compressImage($imageTemp, $imageUploadPath, 25);
                  
                if($compressedImage){
                  $push_lampiran_images = mysqli_query($conn, "INSERT INTO submission_list_lampiranimg VALUES('','$_POST[milestone_detail_id]','$fileName','$tanggal_jam')");
                  if($push_lampiran_images){
                    $_SESSION['alert_success'] = "Berhasil! Attachment Images Berhasil Ditambahkan";
                  }else{
                    $_SESSION['alert_error'] = "Gagal! Attachment Images Gagal Ditambahkan";
                  }
                }else{ 
                  unlink("../unrole/milestone/lampiran_images/".$fileName);
                  $_SESSION['alert_error'] = "Gagal! Attachment Images gagal disimpan, File foto tidak dapat dikompresi";
                } 
            }else{
              unlink("../unrole/milestone/lampiran_images/".$fileName);
              $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
            } 
        }else{
          $_SESSION['alert_error'] = "Gagal! Mohon pilih file untuk di upload";
        } 
      }else{
        $_SESSION['alert_error'] = "Gagal! Attachment Images Gagal Ditambahkan";
      }
    }
  }

  if(isset($_POST['delete_lampiran_img_submission'])){
    if($_POST['delete_lampiran_img_submission'] == "delete"){
      $delete_lampiran_img_submission = mysqli_query($conn, "DELETE FROM submission_list_lampiranimg WHERE id = '$_POST[id]'");
      if($delete_lampiran_img_submission){
        unlink("../unrole/milestone/lampiran_images/".$_POST['nama_img']);
      }
    }
  }

  if(isset($_POST['add_attachment_file_submission'])){
    if($_POST['add_attachment_file_submission'] == "Submit"){
      $target_dir = "../unrole/milestone/lampiran_file/"; // Direktori tempat file akan disimpan

      $nodate = date('YmdHis');
      $fileInfo = pathinfo($_FILES['file']['name']);
      $fileExtension = $fileInfo['extension'];
      $fileName = pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)."_".$nodate.".".$fileExtension;
      $target_file = $target_dir.$fileName;
      $uploadOk = 1;
      $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Cek apakah file adalah jenis yang diperbolehkan
      $allowedTypes = array("pdf", "doc", "docx", "xls", "xlsx");
      if (!in_array($fileType, $allowedTypes)) {
          $uploadOk = 0;
          $_SESSION['alert_error'] = "Maaf, hanya file PDF, XLS, XLSX, DOC, dan DOCX yang diperbolehkan.";
      }

      // Cek apakah file sudah ada
      if (file_exists($target_file)) {
          $uploadOk = 0;
          $_SESSION['alert_error'] = "Maaf, file sudah ada.";
      }

      // Cek ukuran file (misalnya maksimal 50MB)
      if ($_FILES["file"]["size"] > 50000000) {
          $uploadOk = 0;
          $_SESSION['alert_error'] = "Maaf, ukuran file tidak boleh lebih besar dari 50MB.";
      }

      // Jika semua cek berhasil, coba upload file
      if ($uploadOk == 1) {
          if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
              $push_lampiran_file = mysqli_query($conn, "INSERT INTO submission_list_lampiranfile VALUES('','$_POST[milestone_id]','$fileName','$tanggal_jam')");
              if($push_lampiran_file){
                $_SESSION['alert_success'] = "File Berhasil di upload.";
              }else{
                unlink("../unrole/milestone/lampiran_file/".$fileName);
                $_SESSION['alert_error'] = "Maaf, terjadi kesalahan insert ke database.";
              }
              
          } else {
              $_SESSION['alert_error'] = "Maaf, terjadi kesalahan saat mengunggah file.";
          }
      } else {
          $_SESSION['alert_error'] = "File tidak diunggah.";
      }
    }
  }

  if(isset($_POST['delete_lampiran_file_submission'])){
    if($_POST['delete_lampiran_file_submission'] == "delete"){
      $delete_lampiran_file_submission = mysqli_query($conn, "DELETE FROM submission_list_lampiranfile WHERE id = '$_POST[id]'");
      if($delete_lampiran_file_submission){
        unlink("../unrole/milestone/lampiran_file/".$_POST['nama_file']);
      }
    }
  }

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Submission</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Milestone</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 14px; font-weight: bold;">
                  Detail Task
                </h3>
              </div>
              <div class="card-body">
                <table class="table table-sm" style="font-size: 12px">
                  <tr>
                    <td width="20%">Job Description</td>
                    <td width="1%">:</td>
                    <td><?php echo $get_milestone_detail['job_description']; ?></td>
                  </tr>
                  <tr>
                    <td>Person</td>
                    <td width="1%">:</td>
                    <td><?php echo $get_person['nama']; ?></td>
                  </tr>
                  <tr>
                    <td>Due Date</td>
                    <td width="1%">:</td>
                    <td><?php echo date("d F Y H:i", strtotime($get_milestone_detail['due_date'])); ?></td>
                  </tr>
                </table>
                <br>

                <div class="card-body p-0">
                  <div class="row">
                    <?php
                      $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranimg WHERE milestone_detail_id = '$_GET[id]'");
                      while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                    ?>
                      <div class="col-lg-4 col-2" style="margin-bottom: 10px;">
                        <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">

                      </div>
                    <?php } ?>
                  </div>
                </div>

                <br>
                <div class="card-body p-0">
                  <table class="table table-sm" style="font-size: 12px;">
                    <thead>
                      <tr>
                        <th width="1%">No</th>
                        <th>Nama File</th>
                        <th width="5%">#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM milestone_list_lampiranfile WHERE milestone_detail_id = '$_GET[id]'");
                        while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                      ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                          <td style="font-size: 14px;">
                            <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                              <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                            </a>
                          </td>
                        </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

<!-- --------------------------------------------------- My Submission ------------------------------ -->

          <div class="col-lg-6 col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 14px; font-weight: bold;">
                  My Submission
                </h3>
              </div>
              <div class="card-body">
                <div style="font-size: 12px; margin-bottom: 5px;">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_attachmentimg_submission' data-id='<?php echo $get_milestoneList['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Add Attachment Images">
                    <span class="fa fa-paperclip"> Add Attachment Images</span>
                  </a>
                </div>

                <div class="card-body p-0">
                  <div class="row">
                    <?php
                      $q_get_lampiran_images = mysqli_query($conn, "SELECT * FROM submission_list_lampiranimg WHERE milestone_detail_id = '$_GET[id]'");
                      while($get_lampiran_images = mysqli_fetch_array($q_get_lampiran_images)){
                    ?>
                      <div class="col-lg-4 col-6" style="margin-bottom: 10px;">
                        <img src="../unrole/milestone/lampiran_images/<?php echo $get_lampiran_images["nama_img"]; ?>" alt="..." style="width: 100%">

                        <form id="myForm<?php echo $no; ?>" method="POST" action="" style="text-align: center;">
                          <input type="hidden" name="id" value="<?php echo $get_lampiran_images['id']; ?>">
                          <input type="hidden" name="nama_img" value="<?php echo $get_lampiran_images['nama_img']; ?>">
                          <button type="submit" class="btn btn-danger btn-xs" name="delete_lampiran_img_submission" value="delete" onclick="return confirm('Yakin delete gambar ini?')">
                            <span class="fa fa-trash"> Delete</span>
                          </button>
                        </form>
                      </div>
                    <?php } ?>
                  </div>
                </div>

                <br>
                <div style="font-size: 12px;">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_attachmentfile_submission' data-id='<?php echo $get_milestoneList['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Add Attachment File">
                    <span class="fa fa-paperclip"> Add Attachment File</span>
                  </a>
                </div>
                <div class="card-body p-0">
                  <table class="table table-sm" style="font-size: 12px;">
                    <thead>
                      <tr>
                        <th width="1%">No</th>
                        <th>Nama File</th>
                        <th width="16%">#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=1;
                        $q_get_lampiran_file = mysqli_query($conn, "SELECT * FROM submission_list_lampiranfile WHERE milestone_detail_id = '$_GET[id]'");
                        while($get_lampiran_file = mysqli_fetch_array($q_get_lampiran_file)){
                      ?>
                        <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $get_lampiran_file['nama_file']; ?></td>
                          <td style="font-size: 14px;">
                            <form id="myForm<?php echo $no; ?>" method="POST" action="" enctype="multipart/form-data">
                              <input type="hidden" name="nama_file" value="<?php echo $get_lampiran_file['nama_file']; ?>">
                              <input type="hidden" name="id" value="<?php echo $get_lampiran_file['id']; ?>">
                              <a href="../unrole/milestone/lampiran_file/<?php echo $get_lampiran_file['nama_file']; ?>" target="_blank">
                                <div class="btn btn-primary btn-xs"><span class="fa fa-download"></span></div>
                              </a>
                              <button type="submit" class="btn btn-danger btn-xs" name="delete_lampiran_file_submission" value="delete" onclick="return confirm('Yakin delete file ini?')">
                                <span class="fa fa-trash"></span>
                              </button>
                            </form>
                          </td>
                        </tr>
                      <?php $no++; } ?>
                    </tbody>
                  </table>
                </div>

                <br>
                <form method="POST" action="index.php?pages=milestonelist&show=open">
                  <div class="form-group row" style="margin-bottom: 8px;">
                    <div class="col-sm-12">
                      <label style="font-size: 12px;">Comments</label>
                      <textarea class="form-control form-control-sm" name="comments" required><?php echo $get_submissionList['comments']; ?></textarea>
                    </div>
                  </div>
                  <center>
                    <input type="hidden" name="milestone_detail_id" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="milestone_id" value="<?php echo $get_milestone_detail['milestone_id']; ?>">
                    <input type="submit" class="btn btn-success btn-flat" name="submit_submission" value="Submit Submission">
                  </center>
                </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_attachmentimg_submission" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Attachment Img</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myForm" method="POST" action="" enctype="multipart/form-data">
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Images</label>
              <div class="col-sm-9">
                <input type="file" class="form-control form-control-sm" name="file" accept=".jpg,.jpeg,.png,.gif" required>
              </div>
            </div>
            <br>
            <input type="hidden" name="milestone_detail_id" value="<?php echo $_GET['id']; ?>">
            <input type="submit" class="btn btn-success" name="add_attachment_images_submission" value="Submit">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_add_attachmentfile_submission" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Attachment File</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="myFormA" method="POST" action="" enctype="multipart/form-data">
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">File</label>
              <div class="col-sm-9">
                <input type="file" class="form-control form-control-sm" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
              </div>
            </div>
            <br>
            <input type="hidden" name="milestone_id" value="<?php echo $_GET['id']; ?>">
            <input type="submit" class="btn btn-success" name="add_attachment_file_submission" value="Submit">
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>