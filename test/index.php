<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ayo Ngoding - Membuat Dynamic Form jQuery</title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    </head>
    <body>
        <div class="container">
          <center>
            <h3>www.ayongoding.com</h3>
              <p>Membuat Dynamic Form jQuery</p>
          </center><br>
            <form method="POST" action="hasil.php">
            <div class="row" id="dynamic_form">
              <div class="form-group baru-data">
                <div class="col-md-3">
                    <input type="text" name="nama_produk" placeholder="Nama Produk" class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="number" name="jumlah_produk" placeholder="Jumlah Produk" class="form-control">
                </div>
                <div class="col-md-3">
                  <select class="form-control" name="kategori">
                    <option value="">- Pilih Kategori -</option>
                    <option value="1">Buku</option>
                    <option value="2">Elektronik</option>
                    <option value="3">Kesehatan</option>
                    <option value="4">Rumah Tangga</option>
                    <option value="5">Mainan Hobi</option>
                    <option value="6">Olahraga</option>
                  </select>
                </div>
                <div class="col-md-3">
                    <textarea name="deskripsi_produk" placeholder="Deskripsi Produk" class="form-control" rows="1"></textarea>
                </div>
                <div class="button-group">
                    <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-danger btn-hapus" style="display:none;"><i class="fa fa-times"></i></button>
                </div>
            </div>
          </div>
        <button type="submit" class="btn btn-primary btn-simpan"><i class="fa fa-save"></i> Submit</button>
          </form>
        </div>
        <!-- Javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="dynamic-form.js"></script>
    </body>
</html>