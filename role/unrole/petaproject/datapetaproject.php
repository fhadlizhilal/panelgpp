<?php
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

  if(isset($_POST['add_data_petaproject'])){
    if($_POST['add_data_petaproject'] == "Submit"){
      if(!empty($_FILES["file"]["name"])){
        $nodate = date('YmdHis');
        $uploadPath = "../unrole/petaproject/fotoproject/";

        // File info
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
          
        // Tipe format yang diperbolehkan
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            // Image temp source
            $imageTemp = $_FILES["file"]["tmp_name"];
              
            // Ukuran Kompresi 20 (bisa diganti dengan yang lain)
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 20);
              
            if($compressedImage){
              $push_datapeta = mysqli_query($conn, "INSERT INTO am_petaproject VALUES('','$_POST[nama_project]','$_POST[jenis_project]','$_POST[kota]','$_POST[provinsi]','$_POST[latitude]','$_POST[longtitude]','$_POST[kapasitas]','$_POST[jenis_atap]','$_POST[tahun]','$fileName')");
    
              if($push_datapeta){
                $_SESSION['alert_success'] = "Berhasil! Data Peta Project Baru Berhasil Disimpan";
              }else{
                unlink("../unrole/petaproject/fotoproject/".$filename);
                $_SESSION['alert_error'] = "Gagal! Data Peta Project Baru Gagal Disimpan";
              }
            }else{
              $_SESSION['alert_error'] = "Gagal! Data Peta Project Baru Gagal Disimpan, File foto tidak dapat dikompresi";
            }
        }else{
          $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan.";
        }
      }else{
        $_SESSION['alert_error'] = "Gagal! ERROR 99";
      }
    }
  }

  if(isset($_POST['edit_data_petaproject'])){
    if($_POST['edit_data_petaproject'] == "Simpan"){
      if(!empty($_FILES["file"]["name"])){
        $nodate = date('YmdHis');
        $uploadPath = "../unrole/petaproject/fotoproject/";

        // File info
        $fileName = $nodate."_".basename($_FILES["file"]["name"]);
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
          
        // Tipe format yang diperbolehkan
        $allowTypes = array('jpg','png','jpeg','gif');
        if(in_array($fileType, $allowTypes)){
            // Image temp source
            $imageTemp = $_FILES["file"]["tmp_name"];
              
            // Ukuran Kompresi 20 (bisa diganti dengan yang lain)
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 20);
              
            if($compressedImage){
              $get_dataold = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM am_petaproject WHERE id = '$_POST[id]'"));
              unlink("../unrole/petaproject/fotoproject/".$get_dataold['foto']);

              $edit_datapeta = mysqli_query($conn,"UPDATE am_petaproject SET nama_project = '$_POST[nama_project]', jenis = '$_POST[jenis_project]', kota = '$_POST[kota]', provinsi = '$_POST[provinsi]', latitude = '$_POST[latitude]', longtitude = '$_POST[longtitude]', kapasitas = '$_POST[kapasitas]', jenis_atap = '$_POST[jenis_atap]', tahun = '$_POST[tahun]', foto = '$fileName' WHERE id = '$_POST[id]'");
    
              if($edit_datapeta){
                $_SESSION['alert_success'] = "Berhasil! Data Peta Project Berhasil Diubah [1]";
              }else{
                unlink("../unrole/petaproject/fotoproject/".$filename);
                $_SESSION['alert_error'] = "Gagal! Data Peta Project Gagal Diubah [1]";
              }
            }else{
              $_SESSION['alert_error'] = "Gagal! Data Peta Project Gagal Diubah, File foto tidak dapat dikompresi";
            }
        }else{
          $_SESSION['alert_error'] = "Gagal! Maaf, hanya JPG, JPEG, PNG, & GIF yang diperbolehkan";
        }

      }else{
        $edit_datapeta = mysqli_query($conn,"UPDATE am_petaproject SET nama_project = '$_POST[nama_project]', jenis = '$_POST[jenis_project]', kota = '$_POST[kota]', provinsi = '$_POST[provinsi]', latitude = '$_POST[latitude]', longtitude = '$_POST[longtitude]', kapasitas = '$_POST[kapasitas]', jenis_atap = '$_POST[jenis_atap]', tahun = '$_POST[tahun]' WHERE id = '$_POST[id]'");

        if($edit_datapeta){
          $_SESSION['alert_success'] = "Berhasil! Data Peta Project Berhasil Diubah [2]";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Peta Project Gagal Diubah [2]";
        }
      }
    }
  }

  if(isset($_POST['delete_petaproject'])){
    if($_POST['delete_petaproject'] == "Delete"){
      $get_dataold = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM am_petaproject WHERE id = '$_POST[id]'"));
      unlink("../unrole/petaproject/fotoproject/".$get_dataold['foto']);

      $delete_petaproject = mysqli_query($conn, "DELETE FROM am_petaproject WHERE id = '$_POST[id]'");
      if($delete_petaproject){
          $_SESSION['alert_success'] = "Berhasil! Data Peta Project Berhasil Dihapus";
        }else{
          $_SESSION['alert_error'] = "Gagal! Data Peta Project Gagal Dihapus";
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
            <h1>Data Peta Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Peta Project</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title float-sm-right" style="font-size: 12px;">
                  <a href="#modal" data-toggle='modal' data-target='#show_add_data_petaproject' data-id='<?php echo $get_forecast['kd_forecast']; ?>' data-toggle="tooltip" data-placement="bottom" title="Tambah Project Baru">
                    <span class="fa fa-plus"></span> Tambah Peta Project
                  </a>
                </h3>
              </div>
              <!-- ///.card-header -->
              <div class="card-body">
                <table id="setHariLibur1" class="table table-bordered table-striped table-sm" style="font-size: 11px;">
                  <thead>
                    <tr>
                      <th width="1%">No</th>
                      <th width="">Nama Project</th>
                      <th width="10%">Jenis Project</th>
                      <th width="">Kota</th>
                      <th width="5%">Provinsi</th>
                      <th width="10%">Latitude</th>
                      <th width="10%">Longtitude</th>
                      <th width="10%">Kapasitas</th>
                      <th width="8%">Jenis Atap</th>
                      <th width="8%">Tahun</th>
                      <th width="8%">Foto</th>
                      <th width="5%">#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 0;
                      $q_getPetaProject = mysqli_query($conn, "SELECT * FROM am_petaproject");
                      while($get_PetaProject = mysqli_fetch_array($q_getPetaProject)){
                        $i = $i+1;
                    ?>
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $get_PetaProject['nama_project']; ?></td>
                        <td><?php echo $get_PetaProject['jenis']; ?></td>
                        <td><?php echo $get_PetaProject['kota']; ?></td>
                        <td><?php echo $get_PetaProject['provinsi']; ?></td>
                        <td><?php echo $get_PetaProject['latitude']; ?></td>
                        <td><?php echo $get_PetaProject['longtitude']; ?></td>
                        <td><?php echo $get_PetaProject['kapasitas']; ?></td>
                        <td><?php echo $get_PetaProject['jenis_atap']; ?></td>
                        <td><?php echo $get_PetaProject['tahun']; ?></td>
                        <td><img src="../unrole/petaproject/fotoproject/<?php echo $get_PetaProject['foto']; ?>" width="100px"></td>
                        <td style="font-size: 14px;">
                          <a href="#modal" data-toggle='modal' data-target='#show_edit_petaproject' data-id='<?php echo $get_PetaProject['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Edit"><span class="fa fa-edit"></span></a> | 
                          <a href="#modal" data-toggle='modal' data-target='#show_delete_petaproject' data-id='<?php echo $get_PetaProject['id']; ?>' data-toggle="tooltip" data-placement="bottom" title="Delete"><span class="fa fa-close"></span></a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
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
  <div class="modal fade" id="show_add_data_petaproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Peta Project</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Nama Project</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="nama_project" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jenis Project</label>
              <div class="col-sm-9">
                <select class="form-control" name="jenis_project" style="font-size: 12px;" required>
                  <option value="" selected disabled>--- Pilih Jenis Project ---</option>
                  <option value="ongrid">Ongrid</option>
                  <option value="hybrid">Hybrid</option>
                  <option value="offgrid">Offgrid</option>
                   <option value="shs">SHS</option>
                  <option value="pjuts">PJUTS</option>
                  <option value="pats">PATS</option>
                  <option value="onm">OnM</option>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kota</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="kota" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Provinsi</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="provinsi" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Latitude</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="latitude" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Longtitude</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="longtitude" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Kapasitas</label>
              <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" name="kapasitas" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Jenis Atap</label>
              <div class="col-sm-9">
                <select class="form-control" name="jenis_atap" style="font-size: 12px;" required>
                  <option value="" selected disabled>--- Pilih Jenis Atap ---</option>
                  <option value="-">-</option>
                  <option value="Genteng">Genteng</option>
                  <option value="Rooftop Dak">Rooftop Dak</option>
                  <option value="Zinc Allumunium">Zinc Allumunium</option>
                  <option value="Kliplock">Kliplock</option>
                  <option value="Ground Mounted">Ground Mounted</option>
                  <option value="Canopy">Asbes</option>
                  <option value="Sirap">Sirap</option>
                  <option value="L Feet">L Feet</option>
                  <option value="Canopy">Canopy</option>
                </select>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Tahun</label>
              <div class="col-sm-3">
                <input type="number" class="form-control form-control-sm" name="tahun" min="1900" max="2100" required>
              </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
              <label class="col-sm-3 col-form-label" style="font-size: 12px;">Foto</label>
              <div class="col-sm-9">
                <input type="file" class="form-control form-control-sm" name="file" required>
              </div>
            </div>
            <br>
            <center><input type="submit" class="btn btn-info" name="add_data_petaproject" value="Submit"></center>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_edit_petaproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Peta Project</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-data"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal start here -->
  <div class="modal fade" id="show_delete_petaproject" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Peta Project</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-data"></div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->