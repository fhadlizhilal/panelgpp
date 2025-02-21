  // Fungsi untuk memformat input field
  function formatInput(input) {
    // Hapus semua karakter selain angka
    const cleanedInput = input.replace(/[^\d]/g, '');

    // Pisahkan angka menjadi grup dengan titik setiap tiga digit
    const formattedInput = cleanedInput.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    return formattedInput;
  }

  // Fungsi untuk menangani setiap kali input berubah
  function handleInput(inputElement) {
    const inputValue = inputElement.value;

    // Format dan atur kembali nilai input
    inputElement.value = formatInput(inputValue);
  }

  // Fungsi untuk menambahkan field input secara dinamis
  function addInputField() {
    const inputFieldsContainer = document.getElementById('inputFieldsContainer');

    // Buat elemen input baru
    const newInputField = document.createElement('div');
    newInputField.innerHTML = `
      <label for="formattedInput">Input Field:</label>
      <input type="text" class="formattedInput" placeholder="Masukkan angka">
    `;

    // Tambahkan event listener untuk menangani setiap kali input berubah
    const newInput = newInputField.querySelector('.formattedInput');
    newInput.addEventListener('input', function () {
      handleInput(newInput);
    });

    // Tambahkan elemen input baru ke dalam container
    inputFieldsContainer.appendChild(newInputField);
  }

function addForm(){
   var addrow = '<div class="col-8 offset-md-0 baru-data">\
                  <table width="100%" cellpadding="2px">\
                    <tr>\
                      <td width="20%" style="font-weight: bold;">No NPB</td>\
                      <td width="2%">:</td>\
                      <td><input type="text" name="no_npb[]" placeholder="No NPB" class="form-control form-control-sm" required></td>\
                    </tr>\
                    <tr>\
                      <td width="20%" style="font-weight: bold;">No Adendum</td>\
                      <td width="2%">:</td>\
                      <td><input type="text" name="no_adendum[]" placeholder="No Adendum (Optional)" class="form-control form-control-sm"></td>\
                    </tr>\
                    <tr>\
                      <td style="font-weight: bold;">Badan</td>\
                      <td>:</td>\
                      <td>\
                        <select name="badan[]" class="form-control form-control-sm" required>\
                          <option value="" disabled selected>-- Pilih Badan --</option>\
                          <option value="GPP">GPP</option>\
                          <option value="GPW">GPW</option>\
                          <option value="GPS">GPS</option>\
                          <option value="GSS">GSS</option>\
                          <option value="SI">SII</option>\
                        </select>\
                      </td>\
                    </tr>\
                    <tr>\
                      <td style="font-weight: bold;">Divisi</td>\
                      <td>:</td>\
                      <td>\
                        <select name="divisi[]" class="form-control form-control-sm" required>\
                          <option value="" disabled selected>-- Semua Divisi --</option>\
                          <option value="Keuangan">Keuangan</option>\
                          <option value="Logistik">Logistik</option>\
                          <option value="Engineering">Engineering</option>\
                          <option value="Marketing">Marketing</option>\
                          <option value="Asset">Asset</option>\
                          <option value="SDM">SDM</option>\
                          <option value="IT">IT</option>\
                          <option value="HSE">HSE</option>\
                        </select>\
                      </td>\
                    </tr>\
                    <tr>\
                      <td width="20%" style="font-weight: bold;">Tanggal</td>\
                      <td width="2%">:</td>\
                      <td><input type="date" name="tanggal[]" placeholder="Tanggal Pengajuan" class="form-control form-control-sm" style="width: 50%;" required></td>\
                    </tr>\
                    <tr>\
                      <td style="font-weight: bold;">Kategori</td>\
                      <td>:</td>\
                      <td>\
                        <select name="kategori[]" class="form-control form-control-sm" required>\
                          <option value="" selected disabled>-- Pilih Kategori --</option>\
                          <option value="Project">Project</option>\
                          <option value="Rutin">Rutin</option>\
                          <option value="Non-Rutin">Non-Rutin</option>\
                        </select>\
                      </td>\
                    </tr>\
                    <tr>\
                      <td width="20%" style="font-weight: bold;">Kode Project</td>\
                      <td width="2%">:</td>\
                      <td><input type="text" name="kode_project[]" placeholder="Kode Project (optional)" class="form-control form-control-sm" required></td>\
                    </tr>\
                    <tr>\
                      <td style="font-weight: bold;">Pelaksana</td>\
                      <td>:</td>\
                      <td>\
                        <select name="pelaksana[]" class="form-control form-control-sm" required>\
                          <option value="" disabled selected>-- Pilih Pelaksana --</option>\
                          <option value="12150601081294">Akbar Kurnia</option>\
                          <option value="12150609110895">Andi Tyas</option>\
                          <option value="12150511020997">Andri Septiyana</option>\
                          <option value="121506013010284">Asep Saepul</option>\
                          <option value="12150201190392">Ati Nurhayati</option>\
                          <option value="12150202091084">Beni Suprayoga</option>\
                          <option value="12150204031297">Cheppy Rully Almaroghi N</option>\
                          <option value="121506012120880">Dadang Romansyah</option>\
                          <option value="12150602131072">Dedi Mulyana</option>\
                          <option value="12150801030495">Deny Santika Permana</option>\
                          <option value="12150622081294">Eldy Darmawan Sendy Pratama</option>\
                          <option value="12150704240298">Erina Nurfadilah</option>\
                          <option value="12150301230596">Fhadli Zhilal</option>\
                          <option value="12150607121291">Gian Hartaman</option>\
                          <option value="12150611271094">Gilvan Achmad Maulana Azhar</option>\
                          <option value="12150502130585">Heriyanto Kurniawan</option>\
                          <option value="12150621160296">Hikmah Permana</option>\
                          <option value="121506016151271">Ikin Nugraha</option>\
                          <option value="121506018060886">Iman Maryadi</option>\
                          <option value="12150604160795">Janu Abdu Rohman</option>\
                          <option value="12150802250797">Jatnika Maulana Rahmawan</option>\
                          <option value="12150608270500">M Ihsan Mansur</option>\
                          <option value="121506010100780">M. Badrudin</option>\
                          <option value="12150203080195">M. Fauzan Budiman</option>\
                          <option value="12150403100798">Maldiyanti Nispi Kurnia</option>\
                          <option value="121506015260402">Mimi Rohimi</option>\
                          <option value="12150702180878">Nanang Sahidin</option>\
                          <option value="12150612220997">Novandy Iqbal Fadhillah</option>\
                          <option value="12150701180790">Rachmat Aditio</option>\
                          <option value="12150631021297">Rai Purnama Rizki</option>\
                          <option value="12150512240902">Siska Anggi Prasetia</option>\
                          <option value="121506017070292">Solahudin Pebriana</option>\
                          <option value="121506014020190">Suhaedin</option>\
                          <option value="12150605010391">Suharno</option>\
                          <option value="121506011130981">Sutisman</option>\
                          <option value="12150205070702">Syifah Sofianty Dewi</option>\
                          <option value="12150501220698">Tami Putria</option>\
                          <option value="12150401061195">Trinoviany DDP</option>\
                          <option value="12150606180596">Whega Mahesa</option>\
                          <option value="12150402190200">Winda Fauziah</option>\
                          <option value="12150703291280">Yadi</option>\
                          <option value="12150503030801">Yoga Gustaman</option>\
                          <option value="12150603240395">Yosep Saepul Milah</option>\
                          <option value="121506019030702">Yusaribah Haliza</option>\
                        </select>\
                      </td>\
                    </tr>\
                    <tr>\
                      <td width="20%" style="font-weight: bold;">Keterangan / Keperluan</td>\
                      <td width="2%">:</td>\
                      <td><textarea name="keterangan[]" placeholder="Keterangan / Keperluan" class="form-control form-control-sm" required></textarea></td>\
                    </tr>\
                    <tr>\
                      <td width="20%" style="font-weight: bold;">Nominal</td>\
                      <td width="2%">:</td>\
                      <td><input type="text" id="dengan-rupiah"></td>\
                    </tr>\
                    <tr>\
                      <td style="font-weight: bold;">Approved</td>\
                      <td>:</td>\
                      <td>\
                        <select name="approved[]" class="form-control form-control-sm" required>\
                          <option value="" selected>-- Pilih Approved --</option>\
                          <option value="Sudah">Sudah</option>\
                          <option value="Belum">Belum</option>\
                        </select>\
                      </td>\
                    </tr>\
                  </table>\
                  <div class="button-group" align="right">\
                    <button type="button" class="btn btn-success btn-tambah"><i class="fa fa-plus"></i></button>\
                    <button type="button" class="btn btn-danger btn-hapus"><i class="fa fa-times"></i></button>\
                  </div>\
                  <hr>\
                </div>'
   $("#dynamic_form").append(addrow);
}

$("#dynamic_form").on("click", ".btn-tambah", function(){
   addForm()
   $(this).css("display","none")     
   var valtes = $(this).parent().find(".btn-hapus").css("display","");
})

$("#dynamic_form").on("click", ".btn-hapus", function(){
 $(this).parent().parent('.baru-data').remove();
 var bykrow = $(".baru-data").length;
 if(bykrow==1){
   $(".btn-hapus").css("display","none")
   $(".btn-tambah").css("display","");
 }else{
   $('.baru-data').last().find('.btn-tambah').css("display","");
 }
});

// $('.btn-simpan').on('click', function () {
//    $('#dynamic_form').find('input[type="text"], input[type="number"], select, textarea').each(function() {
//       if( $(this).val() == "" ) {
//          event.preventDefault()
//          $(this).css('border-color', 'red');
         
//          $(this).on('focus', function() {
//             $(this).css('border-color', '#ccc');
//          });
//       }
//    })
// })

/* Dengan Rupiah */
    var dengan_rupiah2 = document.getElementById('dengan-rupiah');
    dengan_rupiah2.addEventListener('keyup', function(e)
    {
        dengan_rupiah2.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }