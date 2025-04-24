<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Sweet Alarm -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>

<script src="../finance/dynamic-form.js"></script>

<script>
    function addForm2() {
        const form = document.getElementById('dynamicForm2');
        const clone = form.lastElementChild.cloneNode(true);
        
        // Mengosongkan nilai pada elemen formulir baru
        const inputFields = clone.querySelectorAll('input, select');
        inputFields.forEach(input => {
            input.value = '';
        });

        form.appendChild(clone);
    }

    function removeForm2(button) {
        const formGroup = button.parentElement;
        formGroup.remove();
    }

    function addForm() {
        const form = document.getElementById('dynamicForm');
        const clone = form.lastElementChild.cloneNode(true);
        
        // Mengosongkan nilai pada elemen formulir baru
        const inputFields = clone.querySelectorAll('input, select');
        inputFields.forEach(input => {
            input.value = '';
        });

        form.appendChild(clone);
    }

    function removeForm(button) {
        const formGroup = button.parentElement;
        formGroup.remove();
    }

    function validateForm() {
        var inputElements = document.getElementsByName('input[]');
        var inputValues = Array.from(inputElements).map(input => input.value);

        // Memeriksa apakah ada nilai yang sama
        var isDuplicate = inputValues.some((value, index) => inputValues.indexOf(value) !== index);

        if (isDuplicate) {
            alert('No NPB tidak boleh sama!');
            return false; // Form tidak dikirim jika nilai sama
        }

        // Add your additional validation logic here if needed
        return true; // Form dikirim jika nilai berbeda
    }

    function validateForm2() {
        var inputElements = document.getElementsByName('no_npb[]');
        var inputValues = Array.from(inputElements).map(input => input.value);

        // Memeriksa apakah ada nilai yang sama
        var isDuplicate = inputValues.some((value, index) => inputValues.indexOf(value) !== index);

        if (isDuplicate) {
            alert('No NPB tidak boleh sama!');
            return false; // Form tidak dikirim jika nilai sama
        }

        // Add your additional validation logic here if needed
        return true; // Form dikirim jika nilai berbeda
    }
</script>

<script>
  // Fungsi untuk memformat input field
  function formatInput(input) {
      // Hapus semua karakter selain angka
    const cleanedInput = input.value.replace(/[^\d]/g, '');

    // Pisahkan angka menjadi grup dengan titik setiap tiga digit
    const formattedInput = cleanedInput.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    input.value = formattedInput;
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
        <table width="100%" cellpadding="2px">
                    <tr>
                      <td width="20%" style="font-weight: bold;">No NPB</td>
                      <td width="2%">:</td>
                      <td><input type="text" name="no_npb[]" placeholder="No NPB" class="form-control form-control-sm" required></td>
                    </tr>
                    <tr>
                      <td width="20%" style="font-weight: bold;">No Adendum</td>
                      <td width="2%">:</td>
                      <td><input type="text" name="no_adendum[]" placeholder="No Adendum (Optional)" class="form-control form-control-sm"></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Badan</td>
                      <td>:</td>
                      <td>
                        <select name="badan[]" class="form-control form-control-sm" required>
                          <option value="" disabled selected>-- Pilih Badan --</option>
                          <option value="GPP">GPP</option>
                          <option value="GPW">GPW</option>
                          <option value="GPS">GPS</option>
                          <option value="GSS">GSS</option>
                          <option value="SI">SI</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Divisi</td>
                      <td>:</td>
                      <td>
                        <select name="divisi[]" class="form-control form-control-sm" required>
                          <option value="" disabled selected>-- Semua Divisi --</option>
                          <option value="Keuangan">Keuangan</option>
                          <option value="Logistik">Logistik</option>
                          <option value="Engineering">Engineering</option>
                          <option value="Marketing">Marketing</option>
                          <option value="Asset">Asset</option>
                          <option value="SDM">SDM</option>
                          <option value="IT">IT</option>
                          <option value="HSE">HSE</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td width="20%" style="font-weight: bold;">Tanggal</td>
                      <td width="2%">:</td>
                      <td><input type="date" name="tanggal[]" placeholder="Tanggal Pengajuan" class="form-control form-control-sm" style="width: 30%;" required></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Kategori</td>
                      <td>:</td>
                      <td>
                        <select name="kategori[]" class="form-control form-control-sm" required>
                          <option value="" selected disabled>-- Pilih Kategori --</option>
                          <option value="Project">Project</option>
                          <option value="Rutin">Rutin</option>
                          <option value="Non-Rutin">Non-Rutin</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td width="20%" style="font-weight: bold;">Kode Project</td>
                      <td width="2%">:</td>
                      <td><input type="text" name="kode_project[]" placeholder="Kode Project (optional)" class="form-control form-control-sm" required></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Pelaksana</td>
                      <td>:</td>
                      <td>
                        <select name="pelaksana[]" class="form-control form-control-sm" required>
                          <option value="" disabled selected>-- Pilih Pelaksana --</option>
                          <?php
                            $q_getKaryawan = mysqli_query($conn,"SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '12150211080696' ORDER BY nama ASC");
                            while($get_karyawan = mysqli_fetch_array($q_getKaryawan)){
                          ?>
                            <option value="<?php echo $get_karyawan['nik']; ?>"><?php echo $get_karyawan['nama']; ?></option>
                          <?php } ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td width="20%" style="font-weight: bold;">Keterangan / Keperluan</td>
                      <td width="2%">:</td>
                      <td><textarea name="keterangan[]" placeholder="Keterangan / Keperluan" class="form-control form-control-sm" required></textarea></td>
                    </tr>
                    <tr>
                      <td width="20%" style="font-weight: bold;">Nominal</td>
                      <td width="2%">:</td>
                      <td><input type="text" id="tanpa-rupiah" name="nominal[]" class="formattedInput form-control form-control-sm" required></td>
                    </tr>
                    <tr>
                      <td style="font-weight: bold;">Approved</td>
                      <td>:</td>
                      <td>
                        <select name="approved[]" class="form-control form-control-sm" required>
                          <option value="" disabled selected>-- Pilih Approved --</option>
                          <option value="Sudah">Sudah</option>
                          <option value="Belum">Belum</option>
                        </select>
                      </td>
                    </tr>
                  </table>

        <button style="float: right; margin-top:5px;" onclick="removeInputField(this)" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
        <br><br>     
        <hr>
    `;

    // Tambahkan event listener untuk menangani setiap kali input berubah
    const newInput = newInputField.querySelector('.formattedInput');
    newInput.addEventListener('input', function () {
      handleInput(newInput);
    });

    // Tambahkan elemen input baru ke dalam container
    inputFieldsContainer.appendChild(newInputField);
  }

  // Fungsi untuk menghapus field input
  function removeInputField(buttonElement) {
    const inputFieldsContainer = document.getElementById('inputFieldsContainer');
    const parentDiv = buttonElement.parentNode;
    inputFieldsContainer.removeChild(parentDiv);
  }
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, "displayLength" : 31,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 31,
    });
  });
</script>

<script>
  $(function () {
    $("#example3").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false, "ordering": false, "displayLength" : 10,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example4').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 25,
    });
  });
</script>

<script>
  $(function () {
    $("#example5").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false, "ordering": false, "displayLength" : 10,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example6').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 50,
    });
  });
</script>

<script>
  $(function () {
    $("#example5_2").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false, "ordering": false, "displayLength" : 5,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example6').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 50,
    });
  });
</script>

<script>
  $(function () {
    $("#showonly5_1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false, "ordering": false, "displayLength" : 5,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example6').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 50,
    });
  });
</script>

<script>
  $(function () {
    $("#showonly5_2").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false, "ordering": false, "displayLength" : 5,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example6').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 50,
    });
  });
</script>

<script>
  $(function () {
    $("#showonly5_3").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false, "ordering": false, "displayLength" : 5,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    $('#example6').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 50,
    });
  });
</script>

<script>
  $(function () {
    $("#setHariLibur1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false, "ordering": true, "displayLength" : 25,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#setHariLibur1_wrapper .col-md-6:eq(0)');
    $('#setHariLibur2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 25,
    });
  });
</script>

<script>
  $(function () {
    $("#show_search_and_pagging1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false, "ordering": true, "displayLength" : 25,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#setHariLibur1_wrapper .col-md-6:eq(0)');
    $('#show_search_and_pagging2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "displayLength" : 25,
    });
  });
</script>

<script>
  $(function () {
    $("#cc1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, "displayLength" : 9000,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#cc1 .col-md-6:eq(0)');
    $('#cc2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "displayLength" : 25,
    });
  });
</script>

<script>
  $(function () {
    $("#formabsen1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, "displayLength" : 100,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#formabsen1_wrapper .col-md-6:eq(0)');
    $('#formabsen2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 100,
    });
  });
</script>

<script>
  $(function () {
    $("#dbabsen1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": true, "ordering": true, "displayLength" : 100,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#dbabsen1_wrapper .col-md-6:eq(0)');
    $('#dbabsen2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "displayLength" : 100,
    });
  });
</script>

<script type="text/javascript">
     /* Dengan Rupiah */
    var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
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
</script>

<script type="text/javascript">
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
</script>

<script type="text/javascript">
     /* Dengan Rupiah */
    var dengan_rupiah3 = document.getElementById('dengan-rupiah2');
    dengan_rupiah3.addEventListener('keyup', function(e)
    {
        dengan_rupiah3.value = formatRupiah(this.value, 'Rp. ');
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
</script>

<script type="text/javascript">
     /* Dengan Rupiah */
    var dengan_rupiah4 = document.getElementById('dengan-rupiah3');
    dengan_rupiah4.addEventListener('keyup', function(e)
    {
        dengan_rupiah4.value = formatRupiah(this.value, 'Rp. ');
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
</script>

<script type="text/javascript">
     /* Dengan Rupiah */
    var dengan_rupiah5 = document.getElementById('dengan-rupiah4');
    dengan_rupiah5.addEventListener('keyup', function(e)
    {
        dengan_rupiah5.value = formatRupiah(this.value, 'Rp. ');
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
</script>

<script type="text/javascript">
     /* Dengan Rupiah */
    var dengan_rupiah6 = document.getElementById('dengan-rupiah5');
    dengan_rupiah6.addEventListener('keyup', function(e)
    {
        dengan_rupiah6.value = formatRupiah(this.value, 'Rp. ');
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
</script>

<!-- Ini merupakan script yang terpenting -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#show').on('show.bs.modal', function (e) {
            var getDetail = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../all_role/add_report.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getDetail='+ getDetail,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_lihat').on('show.bs.modal', function (e) {
            var getDetail = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../all_role/lihat_report.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getDetail='+ getDetail,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_hapus').on('show.bs.modal', function (e) {
            var getDetail = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../all_role/hapus_report.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getDetail='+ getDetail,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

<!-- ----- Add List E Approval ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_list').on('show.bs.modal', function (e) {
            var getNIK = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../e_approval/add_list.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getNIK='+ getNIK,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Add Sub List E Approval ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_sublist').on('show.bs.modal', function (e) {
            var getId = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../e_approval/add_sublist.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getId='+ getId,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

<!-- ----- Set Pimpro ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_setpimpro').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../e_approval/set_pimpro.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Upload File E approval ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_upload_file').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../e_approval/upload_file.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- File E-approval ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_file').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../e_approval/file_approval.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ACC / Reject File ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_action').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../e_approval/action.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Note Pimpro ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_note_pimpro').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../e_approval/note_pimpro.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Note PM ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_note_PM').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../e_approval/note_PM.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Forecast ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_forecast').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../forecast&project/detail_forecast.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Update Activity ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_update_activity').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../forecast&project/update_activity.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show History Activity ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_history_activity').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../forecast&project/history_activity.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show History Activity ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_forecast').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../forecast&project/edit_forecast.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show To Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_to_project').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../forecast&project/to_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_project').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../forecast&project/edit_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_project').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../forecast&project/delete_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show To Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_report_tiket').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../report_tiket/add_report_tiket.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Hari Libur ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_hari_libur').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'add_HariLibur.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Hari Libur ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_hari_libur').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'edit_HariLibur.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Hari Libur ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_hari_libur').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'delete_HariLibur.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Tugas Kantor ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_tugas_kantor').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'add_TugasKantor.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Absensi ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_absensi').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'add_Absensi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Tugas Kantor ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_tugas_kantor').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'edit_TugasKantor.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Tugas Kantor ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_tugas_kantor').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'delete_TugasKantor.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Merek ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_merek').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'add_merek.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

   <!-----------------------------------------MANAGEMENT ASSET AWAL----------------------------------------->

  <!-- ----- Show Edit Entitas ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_entitas').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/edit_entitas.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Merek ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_merek').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/edit_merek.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit DB General ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_dbgeneral').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/edit_db_general.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit DB Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_dbdetail').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/edit_db_detail.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Peminjaman Saya ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_peminjamansaya').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/detail_peminjamansaya.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show FU Peminjaman ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_fu_peminjaman').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/fu_peminjaman_baru.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show FU Peminjaman On Progress ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_fu_peminjaman_onprogress').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/fu_peminjaman_onprogress.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show FU peminjaman completed ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_fu_peminjaman_completed').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/fu_peminjaman_completed.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show FU peminjaman rejected ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_fu_peminjaman_rejected').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/fu_peminjaman_rejected.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show FU Pengajuan Asset ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_fu_pengajuan_asset').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/fu_pengajuan_asset.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD Barang Realisasi ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_barang_realisasi').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/form_tambah_barang_realisasi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show DELETE Barang Realisasi ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_barang_realisasi').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/delete_barang_realisasi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Realisasi Asset ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_realisasi_asset').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/detail_realisasi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Form Edit Surat Jalan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_suratjalan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/form_edit_suratjalan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Surat Jalan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_suratjalan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/detail_suratjalan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail pengembalian ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_pengembalian').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/fu_pengembalian.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show lihat Pengembalian ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_lihat_pengembalian').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/detail_pengembalian.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Pengembalian ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_pengembalian').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/edit_pengembalian.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Pengembalian Saya ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_pengembalian_saya').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/detail_pengembalian_saya.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Stockopname ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_stockopname').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/detail_stockopname.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Perbaikan Asset ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_perbaikan_detail').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/detail_perbaikan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Barang Realisasi Perbaikan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_barang_realisasi_perbaikan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/delete_barang_realisasi_perbaikan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

   <!-----------------------------------------MANAGEMENT ASSET END----------------------------------------->

  <!-- ----- Show Add Tools ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_tools').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'add_tools.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Tools Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_tools_detail').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'add_tools_detail.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Tools Detail Masuk ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_detail_tools_masuk').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'add_tools_detail_masuk.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Tools Detail Masuk ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_detail_tools_masuk').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'edit_tools_detail_masuk.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Tools ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_tools').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'edit_tools.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Tools Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_tools_detail').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'edit_tools_detail.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Tools ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_tools').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'delete_tools.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Tools Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_tools_detail').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'delete_tools_detail.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Assets ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_assets').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'add_assets.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Assets ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_assets').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'edit_assets.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Assets ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_assets').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'delete_assets.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Tools Masuk Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_detail_tools_masuk').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'delete_toolsMasukDetail.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add ToolsMasuk Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_toolsMasuk_detail').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            var getID2 = $(e.relatedTarget).data('id2');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'add_toolsmasuk_detail.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID + '&getID2='+ getID2,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit ToolsMasuk Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_toolsMasuk_detail').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            var getID2 = $(e.relatedTarget).data('id2');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'edit_toolsmasuk_detail.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID + '&getID2='+ getID2,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete ToolsMasuk Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_toolsMasuk_detail').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            var getID2 = $(e.relatedTarget).data('id2');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'delete_toolsmasuk_detail.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID + '&getID2='+ getID2,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit List Approval ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_listapproval').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../e_approval/edit_listapproval.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Barang Pinjam ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_barangpinjam').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../peminjaman/add_barangpinjam.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Barang Pinjam ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_barangpinjam').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../peminjaman/edit_barangpinjam.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Barang Pinjam ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_barangpinjam').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../peminjaman/delete_barangpinjam.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Peminjaman Tools ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_tools_pinjam').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../peminjaman/detail_peminjaman_tools.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Batalkan Peminjaman Tools ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_batalkan_peminjaman_tools').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../peminjaman/batalkan_peminjaman_tools.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Peminjaman Tools ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_peminjaman_tools').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../peminjaman/edit_peminjaman_tools.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Review Approve Peminjaman ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_review_approve').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'review_approve.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Review Serahkan ke User ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_review_serahkankeuser').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : 'review_serahkankeuser.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show add Data Karyawan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_data_karyawan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/add_dataKaryawan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Data Karyawan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_data_karyawan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_dataKaryawan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Jam Absen Masuk ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_jam_absen_masuk').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_jam_absen_masuk.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Jam Absen Pulang ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_jam_pulang').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_jam_absen_pulang.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Status Masuk ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_status').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_status.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Fingerprint ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_fingerprint').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_fingerprint.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Keterangan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_keterangan_absen').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_keterangan_absen.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Status Pulang ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_status_pulang').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_status_pulang.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Fingerprint Pulang ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_fingerprint_pulang').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_fingerprint_pulang.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Program ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_program').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_program.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Seragam ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_seragam').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_seragam.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Nametag ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_nametag').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_nametag.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Evaluasi ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_evaluasi_detail').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/detail_evaluasi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Evaluasi ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_evaluasi').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_evaluasi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Absen Masuk ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_absen_masuk').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_absen_masuk.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Absen Pulang ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_absen_pulang').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_absen_pulang.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Penilaian Harian ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_penilaian_harian').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_penilaian_harian.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Pelanggaran ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_pelanggaran').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/edit_pelanggaran.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Pelanggaran ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_pelanggaran').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HR/delete_pelanggaran.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail List Masuk Tools ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_tools_masuk').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../management_asset/detail_list_tools_masuk.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_project').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../management_asset/detail_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_formpv').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_formpv.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_formpv').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_formpv.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_reportqc').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/detail_reportqc.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_reportpv').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_reportpv.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Detail Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_reportpv').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_reportpv.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Data Form Lampu Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_formlampu').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_formlampu.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Data Form Lampu Detail ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_formlampu').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_formlampu.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Form Approved ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_approved').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../finance/form_approved.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show FU Pengajuan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_fu_pengajuan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            var getID2 = $(e.relatedTarget).data('id2');
            var FILTERBADAN = $(e.relatedTarget).data('fbadan');
            var FILTERDIVISI = $(e.relatedTarget).data('fdivisi');
            var FILTERKATEGORI = $(e.relatedTarget).data('fkategori');
            var FILTERPELAKSANA = $(e.relatedTarget).data('fpelaksana');
            var FILTERSTATUS = $(e.relatedTarget).data('fstatus');
            var FILTERPROJECT = $(e.relatedTarget).data('fproject');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../finance/fu_pengajuan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID+'&getID2='+ getID2 +'&FILTERBADAN='+ FILTERBADAN +'&FILTERDIVISI='+ FILTERDIVISI +'&FILTERKATEGORI='+ FILTERKATEGORI + '&FILTERPELAKSANA=' + FILTERPELAKSANA + '&FILTERSTATUS=' + FILTERSTATUS +'&FILTERPROJECT='+ FILTERPROJECT,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD Pengajuan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_pengajuan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../finance/add_pengajuan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD User HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_data_userhse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_userhse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show EDIT User HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_data_userhse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_userhse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show DELETE User HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_data_userhse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_userhse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD Manpower ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_data_manpower').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_manpower.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD Manpower ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_data_manpower').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_manpower.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show DELETE Manpower ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_manpower').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_manpower.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD Project HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_data_project').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show EDIT Project HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_data_project').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show DELETE Project HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_hseproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD Jabatan HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_hsejabatan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_jabatan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show EDIT Jabatan HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_hsejabatan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_jabatan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show DELETE Jabatan HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_hsejabatan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_jabatan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD Tools HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_hsetools').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_tools.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD Tools HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_hsetools').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_tools.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Tools HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_hsetools').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_tools.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD Tools K3 HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_hsetoolsk3').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_toolsk3.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Tools K3 HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_hsetoolsk3').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_toolsk3.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Tools K3 HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_hsetoolsk3').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_toolsk3.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD HSE APD ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_hseapd').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_apd.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show edit HSE APD ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_hseapd').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_apd.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show delete HSE APD ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_hseapd').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_apd.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show add HSE sertifikat ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_sertifikat').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_sertifikat.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show EDIT HSE sertifikat ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_hsesertifikat').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_sertifikat.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show DELETE HSE sertifikat ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_hsesertifikat').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_sertifikat.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show ADD HSE sertifikasi ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_hsesertifikasi').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_sertifikasi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Timeline Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_timelineproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/timeline_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Handover Pekerjaan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_handover').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/handover_pekerjaan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Handover Pekerjaan ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_statusproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/status_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Manpower Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_manpower_project').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_manpower_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Manpower Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_manpowerproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_manpower_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Manpower Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_manpowerproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_manpower_project.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Tools Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_tools_reporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_tools_reporthse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Tools Project Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_tools_reporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_tools_reporthse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Tools Project Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_tools_reporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_tools_reporthse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Edit Jam Kerja Porject HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_jamKerja').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_jamKerja.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Add Cuaca Porject HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_cuaca_project').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_cuacaProject.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Show Delete Cuaca Porject HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_cuacaproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_cuacaProject.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- GET Data Manpower Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#get_datamanpower').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/get_datamanpower.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- CLEAR Data Manpower Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#clear_datamanpower').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/clear_datamanpower.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- CLEAR Data Manpower Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_absensi_dailyreporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_absensi_manpower.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD Tools K3 Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_toolsk3_reporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_toolsk3_reporthse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Edit Tools K3 Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_toolsk3_reporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_toolsk3_reporthse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE Tools K3 Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_toolsk3_reporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_toolsk3_reporthse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD APD Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_apd_reporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_apd_reporthse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT APD Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_apd_reporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_apd_reporthse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE APD Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_apd_reporthse').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_apd_reporthse.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Edit Jam Kerja Manpower ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_jamKerjaManpower').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_jamKerjaManpower.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD Isu K3 ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_isuk3').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_isuk3.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Edit Isu K3 ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_isuk3').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_isuk3.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Delete Isu K3 ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_isuk3').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_isuk3.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD Dokumentasi Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_dokumentasiproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_dokumentasiproject.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Edit Dokumentasi Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_dokumentasiproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_dokumentasiproject.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Delete Dokumentasi Project ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_dokumentasiproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_dokumentasiproject.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Add Note Dailyreport ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_dailyreportnote').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_dailyreport_note.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Edit Note Dailyreport ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_dailyreportnote').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_dailyreport_note.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Delete Note Dailyreport ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_dailyreportnote').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_dailyreport_note.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Submit Dailyreport HSE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#report_complete').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/report_complete.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Submit Project Hold ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#project_hold').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/project_hold.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Submit Project Libur ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#project_libur').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/project_libur.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Submit Project Libur ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_report').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_dailyreport.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- Ad Weekly Report ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_weeklyreport').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_weeklyreport.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT Weekly Report ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_weeklyreport').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_weeklyreport.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE Weekly Report ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_weeklyreport').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/delete_weeklyreport.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT STATUS REPORT ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_ubah_statusreport').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_statusreport.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD Description Work ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_deskrippekerjaan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/add_deskripsi_pekerjaan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD REPORT PV ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_report_pv').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_report_pv.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD DATA PV ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_data_pv').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_data_pv.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT DATA PV ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_data_pv').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_data_pv.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE DATA PV ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_data_pv').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_data_pv.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT REPORT LIST ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_report').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_report.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE REPORT LIST ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_listreport').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_listreport.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD REPORT LAMPU AIO ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_report_lampuaio').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_report_lampuaio.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD DATA LAMPU AIO ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_data_lampuaio').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_data_lampuaio.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT DATA LAMPU AIO ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_data_lampuaio').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_data_lampuaio.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE DATA LAMPU AIO ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_data_lampuaio').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_data_lampuaio.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD REPORT TIANG OKTAGOLNAL ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_report_tiangoktagonal').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_report_tiangoktagonal.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD DATA TIANG OKTAGONAL ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_data_tiang').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_data_tiangoktagonal.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT DATA TIANG OKTAGONAL ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_data_tiangoktagonal').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_data_tiangoktagonal.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD DATA LAMPIRAN TIANG OKTAGONAL ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_lampiran_tiang').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_lampiran_tiangoktagonal.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT DATA LAMPIRAN TIANG OKTAGONAL ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_lampiran_tiang').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_lampiran_tiangoktagonal.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT DATA LAMPIRAN TIANG OKTAGONAL ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_lampiran_tiang').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_lampiran_tiangoktagonal.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD REPORT LAMPU AC ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_report_lampuac').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_report_lampuac.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD DATA LAMPU AC ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_data_lampuac').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_data_lampuac.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE DATA LAMPU AC ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_data_lampuac').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_data_lampuac.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT DATA LAMPU AC ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_data_lampuac').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_data_lampuac.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD LAMPIRAN LAMPU AC ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_lampiran_lampuac').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_lampiran_lampuac.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE LAMPIRAN LAMPU AC ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_lampiran_lampuac').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_lampiran_lampuac.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD DATA ENERGY LIMITER ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_data_energylimiter').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_data_energylimiter.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE DATA ENERGY LIMITER ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_data_energylimiter').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_data_energylimiter.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT DATA ENERGY LIMITER ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_data_energylimiter').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_data_energylimiter.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD LAMPIRAN ENERGY LIMITER ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_add_lampiran_energylimiter').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/add_lampiran_energylimiter.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE LAMPIRAN ENERGY LIMITER ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_lampiran_energylimiter').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/delete_lampiran_energylimiter.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT LAMPIRAN ENERGY LIMITER ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_lampiran_energylimiter').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../team_qc/edit_lampiran_energylimiter.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW LIST DATA SPK ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_data_spk').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/list_data_spk.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW REPORT TOOLSAPD ONSITE COMPLETED ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_report_toolsapdonsite').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../../panelhse/HSE/detail_toolsapd_onsite.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW REPORT INSPEKSI APD COMPLETED ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_report_inspeksiapd').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../../panelhse/HSE/detail_inspeksi_apd.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW REPORT INSPEKSI APAR COMPLETED ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_report_inspeksiapar').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../../panelhse/HSE/detail_inspeksi_apar.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW UBAH STATUS ONSITE TOOLS & APD ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_ubahstatus_onsite').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../../role/HSE/edit_status_onsite.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW UBAH STATUS INSPEKSI ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_inspeksi_to_progress').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../../role/HSE/edit_status_inspeksi.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT LIST MANPOWER PLAN ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_editlist_manpowerPlan').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../HSE/edit_list_manpowerplan.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD DATA CLEANING ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#add_data_cleaning').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/ga_penilaian/add_data_cleaning.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- VIEW DATA CLEANING ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_data_cleaning').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/ga_penilaian/view_data_cleaning.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- ADD DATA NEAT AND CLEAN ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#add_data_neatnclean').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/ga_penilaian/add_data_neatnclean.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- VIEW DATA NEAT AND CLEAN ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_data_neatnclean').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/ga_penilaian/view_data_neatnclean.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- DELETE DATA PETA PROJECT ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_delete_petaproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/petaproject/delete_petaproject.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- EDIT DATA PETA PROJECT ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_petaproject').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/petaproject/edit_petaproject.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW UPDATE PROGRESS S CURVE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_update_progress').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/project_card/update_progress.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW DETAIL PROJECT CARD ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_detail_projectcard').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/project_card/detail_projectcard.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW EDIT PROJECT CARD ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_edit_projectcard').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/project_card/edit_projectcard.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW EDIT MILESTONE LIST ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#edit_milestone_list').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/milestone/edit_milestone_list.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>


  <!-- ----- SHOW TIMELINE MILESTONE ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_timeline_milestone').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/milestone/timeline_milestone.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>

  <!-- ----- SHOW LIST PEMINJAMAN - REPORT PROJECT ASSET ------------------------ -->
  <script type="text/javascript">
    $(document).ready(function(){
        $('#show_list_peminjaman').on('show.bs.modal', function (e) {
            var getID = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '../unrole/management_asset/show_list_peminjaman.php',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'getID='+ getID,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>


    <!-- hitung data -->
    <?php 
        $this_year = date("Y");
        $this_month = '5';

        //----- DATA ABSEN MASUK --------------------------------------
        for($a=1;$a<=12;$a++){
            $terlambat[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE terlambat > 0 AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year'"));

            $izin[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year' AND (status = 'Izin Tidak Masuk' OR status = 'Sakit - Tanpa SKD')"));

            $cuti[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year' AND (status = 'Cuti - Tahunan' OR status = 'Cuti - Menikah' OR status = 'Cuti - Melahirkan' OR status = 'Cuti - Ibadah')"));
        }

        //----- DATA PENILAIAN HARIAN ------------------------------------
        for($a=1;$a<=12;$a++){
            $program[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE program = 'Tidak/Lupa' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year'"));

            $seragam[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE seragam = 'Tidak/Lupa' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year'"));

            $nametag[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nametag = 'Tidak/Lupa' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year'"));
        }

        //----- DATA PELANGGARAN ------------------------------------
        for($a=1;$a<=12;$a++){
            $ringan[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'RINGAN' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year'"));

            $sedang[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'SEDANG' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year'"));

            $sedang_berat[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'SEDANG BERAT' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year'"));

            $berat[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'BERAT' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year'"));

            $sangat_berat[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'SANGAT BERAT' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$this_year'"));
        }

        //------ DATA 10 TERLAMBAT -------------------------------------
        $q_terlambat = mysqli_query($conn, "SELECT nik, SUM(terlambat) AS t_terlambat FROM absen_masuk WHERE YEAR(tanggal) = '$this_year' AND status = 'Terlambat' GROUP BY nik ORDER BY t_terlambat DESC LIMIT 10");
        $a=1;
        while($get_terlambat = mysqli_fetch_array($q_terlambat)){
            $get_karyawan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM karyawan WHERE nik = '$get_terlambat[nik]'"));
            $count_terlambat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE YEAR(tanggal) = '$this_year' AND nik = '$get_terlambat[nik]' AND status = 'Terlambat'"));
            $xx = $get_karyawan['nama'];
            
            $nama[$a] = substr($xx,0,10);
            $waktu[$a] = number_format($get_terlambat['t_terlambat']/60,2);
            $jml_terlambat[$a] = $count_terlambat;

            $a++;
        }

        //----------- Data Nilai Evaluasi & Absensi Karyawan ----------------------
            //hitung jml hari masuk dalam setahun
            $tahunini = date("Y");
            $hari_ke=0;
            $jml_harikerja = 0;
            for($i=1;$i<=12;$i++){
            $jml_hari = cal_days_in_month(CAL_GREGORIAN, $i, date("Y"));
                for($j=1;$j<=$jml_hari;$j++){
                    $date = date("Y")."-".$i."-".$j;
                    $date_progress = strtotime($date);
                    $date_now = strtotime(date("Y-m-d"));
                    if($date_progress<=$date_now){
                        $hari_ke=$hari_ke+1;
                        $nama_hari = date("l", strtotime($date));
                        if($nama_hari != "Saturday" AND $nama_hari != "Sunday"){ 
                            $jml_harikerja = $jml_harikerja+1;
                        }
                    }
                }
            }

            $jml_harilibur = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM harilibur WHERE YEAR(tanggal) = '$tahunini'"));
            $jml_harikerja = $jml_harikerja - $jml_harilibur;

        $q_getKaryawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nik != '12150101190187' AND nik != '12150102020784' AND nik != '12150104100159' AND nik != '121506010100780' AND nik != '121506011130981' AND nik != '121506012120880' AND nik != '121506013010284' AND nik != '121506014020190' AND nik != '121506017070292' AND nik != '121506018060886' ORDER BY nama ASC");
        $b = 1;
        while($getNm_karyawan = mysqli_fetch_array($q_getKaryawan)){
            $nm_karyawan[$b] = substr($getNm_karyawan['nama'],0,10);

            $q_evaluasi = mysqli_query($conn, "SELECT * FROM evaluasi WHERE nik = '$getNm_karyawan[nik]' ORDER BY tanggal_evaluasi ASC");
            $c = 1;
            while($get_evaluasi = mysqli_fetch_array($q_evaluasi)){

                $avg_point1 = ($get_evaluasi['point1_dirut']+$get_evaluasi['point1_dirop']+$get_evaluasi['point1_leader'])/3;
                $avg_point2 = ($get_evaluasi['point2_dirut']+$get_evaluasi['point2_dirop']+$get_evaluasi['point2_leader'])/3;
                $avg_point3 = ($get_evaluasi['point3_dirut']+$get_evaluasi['point3_dirop']+$get_evaluasi['point3_leader'])/3;
                $avg_point4 = ($get_evaluasi['point4_dirut']+$get_evaluasi['point4_dirop']+$get_evaluasi['point4_leader'])/3;
                $nilai_point1 = number_format(($avg_point1+$avg_point2+$avg_point3+$avg_point4),2);

                    $avg_point1M = ($get_evaluasi['point1_dirut']+$get_evaluasi['point1_dirop'])/2;
                    $avg_point2M = ($get_evaluasi['point2_dirut']+$get_evaluasi['point2_dirop'])/2;
                    $avg_point3M = ($get_evaluasi['point3_dirut']+$get_evaluasi['point3_dirop'])/2;
                    $avg_point4M = ($get_evaluasi['point4_dirut']+$get_evaluasi['point4_dirop'])/2;
                    $nilai_point1M = number_format(($avg_point1M+$avg_point2M+$avg_point3M+$avg_point4M),2);

                $avg_point5 = ($get_evaluasi['point5_dirut']+$get_evaluasi['point5_dirop']+$get_evaluasi['point5_leader'])/3;
                $avg_point6 = ($get_evaluasi['point6_dirut']+$get_evaluasi['point6_dirop']+$get_evaluasi['point6_leader'])/3;
                $avg_point7 = ($get_evaluasi['point7_dirut']+$get_evaluasi['point7_dirop']+$get_evaluasi['point7_leader'])/3;
                $avg_point8 = ($get_evaluasi['point8_dirut']+$get_evaluasi['point8_dirop']+$get_evaluasi['point8_leader'])/3;
                $nilai_point2 = number_format(($avg_point5+$avg_point6+$avg_point7+$avg_point8),2);

                    $avg_point5M = ($get_evaluasi['point5_dirut']+$get_evaluasi['point5_dirop'])/2;
                    $avg_point6M = ($get_evaluasi['point6_dirut']+$get_evaluasi['point6_dirop'])/2;
                    $avg_point7M = ($get_evaluasi['point7_dirut']+$get_evaluasi['point7_dirop'])/2;
                    $avg_point8M = ($get_evaluasi['point8_dirut']+$get_evaluasi['point8_dirop'])/2;
                    $nilai_point2M = number_format(($avg_point5M+$avg_point6M+$avg_point7M+$avg_point8M),2);

                $avg_point9 = ($get_evaluasi['point9_dirut']+$get_evaluasi['point9_dirop']+$get_evaluasi['point9_leader'])/3;
                $avg_point10 = ($get_evaluasi['point10_dirut']+$get_evaluasi['point10_dirop']+$get_evaluasi['point10_leader'])/3;
                $avg_point11 = ($get_evaluasi['point11_dirut']+$get_evaluasi['point11_dirop']+$get_evaluasi['point11_leader'])/3;
                $avg_point12 = ($get_evaluasi['point12_dirut']+$get_evaluasi['point12_dirop']+$get_evaluasi['point12_leader'])/3;
                $nilai_point3 = number_format(($avg_point9+$avg_point10+$avg_point11+$avg_point12),2);

                    $avg_point9M = ($get_evaluasi['point9_dirut']+$get_evaluasi['point9_dirop'])/2;
                    $avg_point10M = ($get_evaluasi['point10_dirut']+$get_evaluasi['point10_dirop'])/2;
                    $avg_point11M = ($get_evaluasi['point11_dirut']+$get_evaluasi['point11_dirop'])/2;
                    $avg_point12M = ($get_evaluasi['point12_dirut']+$get_evaluasi['point12_dirop'])/2;
                    $nilai_point3M = number_format(($avg_point9M+$avg_point10M+$avg_point11M+$avg_point12M),2);
                
                $avg_point13 = ($get_evaluasi['point13_dirut']+$get_evaluasi['point13_dirop']+$get_evaluasi['point13_leader'])/3;
                $avg_point14 = ($get_evaluasi['point14_dirut']+$get_evaluasi['point14_dirop']+$get_evaluasi['point14_leader'])/3;
                $avg_point15 = ($get_evaluasi['point15_dirut']+$get_evaluasi['point15_dirop']+$get_evaluasi['point15_leader'])/3;
                $avg_point16 = ($get_evaluasi['point16_dirut']+$get_evaluasi['point16_dirop']+$get_evaluasi['point16_leader'])/3;
                $nilai_point4 = number_format(($avg_point13+$avg_point14+$avg_point15+$avg_point16),2);

                    $avg_point13M = ($get_evaluasi['point13_dirut']+$get_evaluasi['point13_dirop'])/2;
                    $avg_point14M = ($get_evaluasi['point14_dirut']+$get_evaluasi['point14_dirop'])/2;
                    $avg_point15M = ($get_evaluasi['point15_dirut']+$get_evaluasi['point15_dirop'])/2;
                    $avg_point16M = ($get_evaluasi['point16_dirut']+$get_evaluasi['point16_dirop'])/2;
                    $nilai_point4M = number_format(($avg_point13M+$avg_point14M+$avg_point15M+$avg_point16M),2);

                $nilai_point5 = number_format($get_evaluasi['point_grooming']+$get_evaluasi['point_kedisiplinan'],2);
                $nilai_point6 = number_format($get_evaluasi['point_kehadiran'],2);
                $nilai_point7 = number_format($get_evaluasi['point_owoj'],2);

                if($get_evaluasi['jabatan'] == "Manager"){
                    $nilai_akhir = number_format(($nilai_point1M+$nilai_point2M+$nilai_point3M+$nilai_point4M+$nilai_point5+$nilai_point6)/6+($nilai_point7/10),2);
                }elseif($get_evaluasi['jabatan'] == "Fungsional"){
                    if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){
                        $nilai_akhir = number_format(($nilai_point1M+$nilai_point2M+$nilai_point4M+$nilai_point5+$nilai_point6)/5+($nilai_point7/10),2);
                    }else{
                        $nilai_akhir = number_format(($nilai_point1+$nilai_point2+$nilai_point4+$nilai_point5+$nilai_point6)/5+($nilai_point7/10),2);
                    }
                }elseif($get_evaluasi['jabatan'] == "Staff"){
                    if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){
                        $nilai_akhir = number_format(($nilai_point1M+$nilai_point2M+$nilai_point4M+$nilai_point5+$nilai_point6)/4+($nilai_point7/10),2);
                    }else{
                        $nilai_akhir = number_format(($nilai_point1+$nilai_point2+$nilai_point4+$nilai_point5+$nilai_point6)/4+($nilai_point7/10),2);
                    }
                }elseif($get_evaluasi['jabatan'] == "Magang" OR $get_evaluasi['jabatan'] == "Kontrak"){
                    $nilai_akhir = number_format(($nilai_point1+$nilai_point2+$nilai_point4+$nilai_point5+$nilai_point6)/4+($nilai_point7/10),2);
                }

                $nilai_evaluasi[$b] = $nilai_evaluasi[$b]+$nilai_akhir;

                $c++;
            }
            $nilai_evaluasi[$b] = $nilai_evaluasi[$b]/($c-1);

            //Nilai Absensi Karyawan
            $count_masuk = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND (status = 'Masuk' OR status = 'Tugas Kantor' OR status = 'Terlambat' OR status = 'Izin Terlambat' OR status = 'Izin Masuk Siang' OR status = 'Pulang Tugas Kantor')"));

            $count_cuti_sakit = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND (status = 'Sakit - Dengan SKD' OR status = 'Cuti - Tahunan' OR status = 'Cuti - Menikah' OR status = 'Cuti - Melahirkan' OR status = 'Cuti - Ibadah')"));

            $sumTerlambat = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(terlambat) AS sumTerlambat FROM absen_masuk WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini'"));

            $sumCepat = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(cepat) AS sumCepat FROM absen_pulang WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini'"));

            $sum_telatcepat = ($sumTerlambat['sumTerlambat']+$sumCepat['sumCepat'])/60/8;
            $nilai_absensi[$b] = number_format(($count_masuk+$count_cuti_sakit-$sum_telatcepat)/$jml_harikerja*5,1);

            //Nilai Penilaian Harian Karyawan
            $program_y = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND (program = 'Ya' OR program = '-')"));
            $seragam_y = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND (seragam = 'Ya' OR seragam = '-')"));
            $nametag_y = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND (nametag = 'Ya' OR nametag = '-')"));
            $nilai_PHarian[$b] = number_format(($program_y + (($seragam_y + $nametag_y)/2))/2/$jml_harikerja*5,1);

            //Nilai Pelanggaran Karyawan
            $pelangaran_ringan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND status_pelanggaran = 'RINGAN'"));
            $pelangaran_sedang = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND status_pelanggaran = 'SEDANG'"));
            $pelangaran_sedangberat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND status_pelanggaran = 'SEDANG BERAT'"));
            $pelangaran_berat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND status_pelanggaran = 'BERAT'"));
            $pelangaran_sangatberat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE nik = '$getNm_karyawan[nik]' AND YEAR(tanggal) = '$tahunini' AND status_pelanggaran = 'SANGAT BERAT'"));
            $nilaiPelanggaranKaryawan[$b] = ($pelangaran_ringan*0.2)+($pelangaran_sedang*0.5)+($pelangaran_sedangberat*1)+($pelangaran_berat*2)+($pelangaran_sangatberat*3);

            //Nilai Report Karyawan
            $cek_nilai_evaluasi = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM evaluasi WHERE nik = '$getNm_karyawan[nik]'"));
            if($cek_nilai_evaluasi>0){
                $nilai_report_akhir[$b] = number_format((($nilai_evaluasi[$b]+$nilai_absensi[$b]+$nilai_PHarian[$b])/3)-($nilaiPelanggaranKaryawan[$b]),2);
            }else{
                $nilai_report_akhir[$b] = number_format((($nilai_absensi[$b]+$nilai_PHarian[$b])/2)-($nilaiPelanggaranKaryawan[$b]),2);
            }
            
            $b++;
        }

//------------------------------------------------ CODE NILAI GA CLEANING -----------------------
      if(isset($_GET['tglawal'])){
        $tglawal = $_GET['tglawal'];
      }else{
        $tglawal = date('Y')."-01-01";
      }

      if(isset($_GET['tglakhir'])){
        $tglakhir = $_GET['tglakhir'];
      }else{
        $tglakhir = date('Y')."-12-31";
      }

      $nilai_cleaning = mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(lobby) AS nilai_lobby, AVG(pacific_meeting) AS nilai_pacific_meeting, AVG(ruang_kerja_atas) AS nilai_ruang_kerja_atas, AVG(pantry_atas) AS nilai_pantry_atas, AVG(pantry_bawah_koridor) AS nilai_pantry_bawah_koridor, AVG(mushola) AS nilai_mushola, AVG(ruang_kerja_asset) AS nilai_ruang_kerja_asset, AVG(atlantic_meeting_room) AS nilai_atlantic_meeting_room, AVG(ruang_kerja_logistic) AS nilai_ruang_kerja_logistic, AVG(gudang_asset) AS nilai_gudang_asset, AVG(gudang_logistic) AS nilai_gudang_logistic, AVG(halaman_belakang) AS nilai_halaman_belakang, AVG(toilet) AS nilai_toilet FROM ga_cleaning WHERE tanggal >= '$tglawal' AND tanggal <= '$tglakhir'"));

//------------------------------------------------ AKHIR CODE NILAI GA CLEANING -----------------------


    ?>
  <!-- ------- CHART------ -->
  <script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    
    var barChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [
        {
          label               : 'Terlambat/Masuk Siang',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'rgba(210, 214, 222, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $terlambat[1].", ".$terlambat[2].", ".$terlambat[3].", ".$terlambat[4].", ".$terlambat[5].", ".$terlambat[6].", ".$terlambat[7].", ".$terlambat[8].", ".$terlambat[9].", ".$terlambat[10].", ".$terlambat[11].", ".$terlambat[12]; ?>]
        },
        {
          label               : 'Izin',
          backgroundColor     : 'rgba(60,141,188,0.8)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius         : false,
          pointColor          : 'rgba(60,141,188,0.8)',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $izin[1].", ".$izin[2].", ".$izin[3].", ".$izin[4].", ".$izin[5].", ".$izin[6].", ".$izin[7].", ".$izin[8].", ".$izin[9].", ".$izin[10].", ".$izin[11].", ".$izin[12]; ?>]
        },
        {
          label               : 'Cuti',
          backgroundColor     : 'RGBA( 0, 139, 139, 1 )',
          borderColor         : 'RGBA( 0, 139, 139, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 0, 139, 139, 1 )',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $cuti[1].", ".$cuti[2].", ".$cuti[3].", ".$cuti[4].", ".$cuti[5].", ".$cuti[6].", ".$cuti[7].", ".$cuti[8].", ".$cuti[9].", ".$cuti[10].", ".$cuti[11].", ".$cuti[12]; ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART PENILAIAN HARIAN -
    //-------------
    var barChartCanvas = $('#barChartPenilaian').get(0).getContext('2d')
    
    var barChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [
        {
          label               : 'Program (X)',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'rgba(210, 214, 222, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $program[1].", ".$program[2].", ".$program[3].", ".$program[4].", ".$program[5].", ".$program[6].", ".$program[7].", ".$program[8].", ".$program[9].", ".$program[10].", ".$program[11].", ".$program[12]; ?>]
        },
        {
          label               : 'Seragam (X)',
          backgroundColor     : 'rgba(60,141,188,0.8)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius         : false,
          pointColor          : 'rgba(60,141,188,0.8)',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $seragam[1].", ".$seragam[2].", ".$seragam[3].", ".$seragam[4].", ".$seragam[5].", ".$seragam[6].", ".$seragam[7].", ".$seragam[8].", ".$seragam[9].", ".$seragam[10].", ".$seragam[11].", ".$seragam[12]; ?>]
        },
        {
          label               : 'Nametag (X)',
          backgroundColor     : 'RGBA( 0, 139, 139, 1 )',
          borderColor         : 'RGBA( 0, 139, 139, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 0, 139, 139, 1 )',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $cuti[1].", ".$cuti[2].", ".$cuti[3].", ".$cuti[4].", ".$cuti[5].", ".$cuti[6].", ".$cuti[7].", ".$cuti[8].", ".$cuti[9].", ".$cuti[10].", ".$cuti[11].", ".$cuti[12]; ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART PELANGGARAN -
    //-------------
    var barChartCanvas = $('#barChartPelanggaran').get(0).getContext('2d')
    
    var barChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [
        {
          label               : 'Ringan',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'rgba(210, 214, 222, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $ringan[1].", ".$ringan[2].", ".$ringan[3].", ".$ringan[4].", ".$ringan[5].", ".$ringan[6].", ".$ringan[7].", ".$ringan[8].", ".$ringan[9].", ".$ringan[10].", ".$ringan[11].", ".$ringan[12]; ?>]
        },
        {
          label               : 'Sedang',
          backgroundColor     : 'RGBA( 240, 230, 140, 1 )',
          borderColor         : 'RGBA( 240, 230, 140, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 240, 230, 140, 1 )',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $sedang[1].", ".$sedang[2].", ".$sedang[3].", ".$sedang[4].", ".$sedang[5].", ".$sedang[6].", ".$sedang[7].", ".$sedang[8].", ".$sedang[9].", ".$sedang[10].", ".$sedang[11].", ".$sedang[12]; ?>]
        },
        {
          label               : 'Sedang Berat',
          backgroundColor     : 'RGBA( 255, 215, 0, 1 )',
          borderColor         : 'RGBA( 255, 215, 0, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 255, 215, 0, 1 )',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $sedang_berat[1].", ".$sedang_berat[2].", ".$sedang_berat[3].", ".$sedang_berat[4].", ".$sedang_berat[5].", ".$sedang_berat[6].", ".$sedang_berat[7].", ".$sedang_berat[8].", ".$sedang_berat[9].", ".$sedang_berat[10].", ".$sedang_berat[11].", ".$sedang_berat[12]; ?>]
        },
        {
          label               : 'Berat',
          backgroundColor     : 'RGBA( 255, 165, 0, 1 )',
          borderColor         : 'RGBA( 255, 165, 0, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 255, 165, 0, 1 )',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $berat[1].", ".$berat[2].", ".$berat[3].", ".$berat[4].", ".$berat[5].", ".$berat[6].", ".$berat[7].", ".$berat[8].", ".$berat[9].", ".$berat[10].", ".$berat[11].", ".$berat[12]; ?>]
        },
        {
          label               : 'Sangat Berat',
          backgroundColor     : 'RGBA( 255, 69, 0, 1 )',
          borderColor         : 'RGBA( 255, 69, 0, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 255, 69, 0, 1 )',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $sangat_berat[1].", ".$sangat_berat[2].", ".$sangat_berat[3].", ".$sangat_berat[4].", ".$sangat_berat[5].", ".$sangat_berat[6].", ".$sangat_berat[7].", ".$sangat_berat[8].", ".$sangat_berat[9].", ".$sangat_berat[10].", ".$sangat_berat[11].", ".$sangat_berat[12]; ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART 10 TERLAMBAT -
    //-------------
    var barChartCanvas = $('#barChart10Terlambat').get(0).getContext('2d')
    
    var barChartData = {
      labels  : [<?php echo "'".$nama[1]."', '".$nama[2]."', '".$nama[3]."', '".$nama[4]."', '".$nama[5]."', '".$nama[6]."', '".$nama[7]."', '".$nama[8]."', '".$nama[9]."', '".$nama[10]."'"; ?>],
      datasets: [
        {
          label               : 'Jml Terlambat',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'rgba(210, 214, 222, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $jml_terlambat[1].", ".$jml_terlambat[2].", ".$jml_terlambat[3].", ".$jml_terlambat[4].", ".$jml_terlambat[5].", ".$jml_terlambat[6].", ".$jml_terlambat[7].", ".$jml_terlambat[8].", ".$jml_terlambat[9].", ".$jml_terlambat[10]; ?>]
        },
        {
          label               : 'Jam Terlambat',
          backgroundColor     : 'RGBA( 240, 230, 140, 1 )',
          borderColor         : 'RGBA( 240, 230, 140, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 240, 230, 140, 1 )',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $waktu[1].", ".$waktu[2].", ".$waktu[3].", ".$waktu[4].", ".$waktu[5].", ".$waktu[6].", ".$waktu[7].", ".$waktu[8].", ".$waktu[9].", ".$waktu[10]; ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART Nilai Evaluasi Karyawan -
    //-------------
    var barChartCanvas = $('#barChartEvaluasiKaryawan').get(0).getContext('2d')
    
    var barChartData = {
      labels  : [<?php for($i=1;$i<$b;$i++){ echo "'".$nm_karyawan[$i]."',";} ?>],
      datasets: [
        {
          label               : 'Nilai Evaluasi <?php echo $tahunini; ?>',
          backgroundColor     : 'RGBA( 255, 215, 0, 1 )',
          borderColor         : 'RGBA( 255, 215, 0, 1 )',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'RGBA( 255, 215, 0, 1 )',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php for($i=1;$i<$b;$i++){ echo "'".number_format($nilai_evaluasi[$i],1)."',";} ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : true,
      datasetFill             : true,
      plugins: {
        datalabels: {
            anchor: 'end',
            align: 'bottom',
            offset: 5,
            font: {
                weight: 'normal',
                size: 9
            }
        }
      }
    }

    new Chart(barChartCanvas, {
      plugins : [ChartDataLabels],
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART Nilai Absensi Karyawan -
    //-------------
    var barChartCanvas = $('#barChartAbsensiKaryawan').get(0).getContext('2d')
    
    var barChartData = {
      labels  : [<?php for($i=1;$i<$b;$i++){ echo "'".$nm_karyawan[$i]."',";} ?>],
      datasets: [
        {
          label               : 'Nilai Absensi Tahun <?php echo $tahunini; ?>',
          backgroundColor     : 'RGBA( 0, 139, 139, 1 )',
          borderColor         : 'RGBA( 0, 139, 139, 1 )',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'RGBA( 0, 139, 139, 1 )',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php for($i=1;$i<$b;$i++){ echo "'".$nilai_absensi[$i]."',";} ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      plugins: {
        datalabels: {
            color: 'white',
            anchor: 'end',
            align: 'bottom',
            offset: 5,
            font: {
                weight: 'normal',
                size: 10
            }
        }
      }
    }

    new Chart(barChartCanvas, {
      plugins : [ChartDataLabels],
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART Nilai Penilaian Harian Karyawan -
    //-------------
    var barChartCanvas = $('#barChartPenilaianHarianKaryawan').get(0).getContext('2d')
    
    var barChartData = {
      labels  : [<?php for($i=1;$i<$b;$i++){ echo "'".$nm_karyawan[$i]."',";} ?>],
      datasets: [
        {
          label               : 'Nilai Penilaian Harian Tahun <?php echo $tahunini; ?>',
          backgroundColor     : 'RGBA( 60, 179, 113, 1 )',
          borderColor         : 'RGBA( 60, 179, 113, 1 )',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'RGBA( 60, 179, 113, 1 )',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php for($i=1;$i<$b;$i++){ echo "'".$nilai_PHarian[$i]."',";} ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      plugins: {
        datalabels: {
            color: 'white',
            anchor: 'end',
            align: 'bottom',
            offset: 5,
            font: {
                weight: 'normal',
                size: 10,
            }
        }
      }
    }

    new Chart(barChartCanvas, {
      plugins : [ChartDataLabels],
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART Nilai Pelanggaran Karyawan -
    //-------------
    var barChartCanvas = $('#barChartNilaiPelanggaranKaryawan').get(0).getContext('2d')
    
    var barChartData = {
      labels  : [<?php for($i=1;$i<$b;$i++){ echo "'".$nm_karyawan[$i]."',";} ?>],
      datasets: [
        {
          label               : 'Nilai Penilaian Pelanggaran Tahun <?php echo $tahunini; ?>',
          backgroundColor     : 'RGBA( 255, 69, 0, 1 )',
          borderColor         : 'RGBA( 255, 69, 0, 1 )',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'RGBA( 255, 69, 0, 1 )',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php for($i=1;$i<$b;$i++){ echo "'".$nilaiPelanggaranKaryawan[$i]."',";} ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      plugins: {
        datalabels: {
            color: 'white',
            anchor: 'end',
            align: 'bottom',
            offset: 5,
            font: {
                weight: 'normal',
                size: 10,
            }
        }
      }
    }

    new Chart(barChartCanvas, {
      plugins : [ChartDataLabels],
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART Report Nilai Karyawan -
    //-------------
    var barChartCanvas = $('#barChartReportNilaiKaryawan').get(0).getContext('2d')
    
    var barChartData = {
      labels  : [<?php for($i=1;$i<$b;$i++){ echo "'".$nm_karyawan[$i]."',";} ?>],
      datasets: [
        {
          label               : 'Report Nilai Karyawan Tahun <?php echo $tahunini; ?>',
          backgroundColor     : 'RGBA( 0, 139, 139, 1 )',
          borderColor         : 'RGBA( 0, 139, 139, 1 )',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'RGBA( 0, 139, 139, 1 )',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php for($i=1;$i<$b;$i++){ echo "'".number_format($nilai_report_akhir[$i],1)."',";} ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false,
      plugins: {
        datalabels: {
            color: 'white',
            anchor: 'end',
            align: 'bottom',
            offset: 5,
            font: {
                weight: 'normal',
                size: 8,
            }
        }
      }
    }

    new Chart(barChartCanvas, {
      plugins : [ChartDataLabels],
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })


    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Electronics',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo "22"; ?>, 59, 80, 81, 56, 55, 40]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>

<!-- ------------------------------------- CHART CLEANING GA ------------------------------- -->
<script>
  $(function () {
  //-------------
    //- BAR CHART - COBA -
    //-------------
    var barChartCanvas = $('#barChartCoba').get(0).getContext('2d')
    
    var barChartData = {
      labels  : ['Lobby', 'Pacific Meeting Room', 'Ruang Kerja Atas', 'Pantry Atas', 'Pantry Bawah & Koridor', 'Mushola', 'Ruang Kerja Asset', 'Attlantic Meeting Room', 'Ruang Kerja Logistic', 'Gudang Asset', 'Gudang Logistic', 'Halaman Belakang', 'Toilet'],
      datasets: [
        {
          label               : 'Target',
          backgroundColor     : 'rgba(60,185,106,1)',
          borderColor         : 'rgba(60,185,106,1)',
          pointRadius         : false,
          pointColor          : 'rgba(60,185,106,1)',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,185,106,1)',
          data                : [<?php echo "100,100,100,100,100,100,100,100,100,100,100,100,100"; ?>]
        },
        {
          label               : 'Progress',
          backgroundColor     : 'rgba(60,141,188,1)',
          borderColor         : 'rgba(60,141,188,1)',
          pointRadius         : false,
          pointColor          : 'rgba(60,141,188,1)',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $nilai_cleaning['nilai_lobby'].",".$nilai_cleaning['nilai_pacific_meeting'].",".$nilai_cleaning['nilai_ruang_kerja_atas'].",".$nilai_cleaning['nilai_pantry_atas'].",".$nilai_cleaning['nilai_pantry_bawah_koridor'].",".$nilai_cleaning['nilai_mushola'].",".$nilai_cleaning['nilai_ruang_kerja_asset'].",".$nilai_cleaning['nilai_atlantic_meeting_room'].",".$nilai_cleaning['nilai_ruang_kerja_logistic'].",".$nilai_cleaning['nilai_gudang_asset'].",".$nilai_cleaning['nilai_gudang_logistic'].",".$nilai_cleaning['nilai_halaman_belakang'].",".$nilai_cleaning['nilai_toilet']; ?>]
        },
        
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        y: {
          beginAtZero: false,
          min: 0, // Set nilai minimum untuk y-axis
          max: 100 // Set nilai maksimum untuk y-axis (sesuaikan sesuai kebutuhan)
        }
      },
      plugins: {
        datalabels: {
            anchor: 'end',
            align: 'bottom',
            offset: 5,
            color: 'white',
            formatter: (value, context) => {
              return value.toFixed(2); // Membulatkan nilai menjadi dua angka di belakang koma
            },
            font: {
                weight: 'normal',
                size: 9
            }
        }
      }
    }

    new Chart(barChartCanvas, {
      plugins : [ChartDataLabels],
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
  })
</script>

<!-- --------------------------------------------- CHART NEAT AND CLEAN GA ---------------------------- -->
<script>
  $(function () {
  //-------------
    //- BAR CHART - NEAT n CLEAN -
    //-------------
    var barChartCanvas = $('#barChartNeat').get(0).getContext('2d')
    
    var barChartData = {
      labels  : [
        <?php 
          $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama != 'Erwansyah HMS' AND nama != 'Fadhli Aoliana' AND nama != 'Heriyanto Kurniawan' AND nama != 'M. Badrudin' AND nama != 'Sutisman' AND nama != 'Dadang Romansyah' AND nama != 'Asep Saepul' AND nama != 'Suhaedin' AND nama != 'Solahudin Pebriana' AND nama != 'Iman Maryadi' ORDER BY nama ASC");
          while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
            echo "'".$get_karyawan['nama']."',";
          }
        ?>
        ],
      datasets: [
        {
          label               : 'Nilai',
          backgroundColor     : 'rgba(255, 169, 0,1)',
          borderColor         : 'rgba(255, 169, 0,1)',
          pointRadius         : false,
          pointColor          : 'rgba(255, 169, 0,1)',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(255, 169, 0,1)',
          data                : [
            <?php
              $q_get_karyawan = mysqli_query($conn, "SELECT * FROM karyawan WHERE nama != 'Erwansyah HMS' AND nama != 'Fadhli Aoliana' AND nama != 'Heriyanto Kurniawan' AND nama != 'M. Badrudin' AND nama != 'Sutisman' AND nama != 'Dadang Romansyah' AND nama != 'Asep Saepul' AND nama != 'Suhaedin' AND nama != 'Solahudin Pebriana' AND nama != 'Iman Maryadi' ORDER BY nama ASC");
              while($get_karyawan = mysqli_fetch_array($q_get_karyawan)){
                $get_sumNilai = mysqli_fetch_array(mysqli_query($conn, "SELECT SUM(nilai) AS nilai_sum FROM ga_neatnclean WHERE nik = '$get_karyawan[nik]' AND tanggal >= '$tglawal' AND tanggal <= '$tglakhir'"));
                $get_count_data = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ga_neatnclean WHERE nik = '$get_karyawan[nik]' AND tanggal >= '$tglawal' AND tanggal <= '$tglakhir'"));
                echo $get_sumNilai['nilai_sum']/$get_count_data.",";
              }
            ?>
          ]
        },
        
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        y: {
          beginAtZero: false,
          min: 0, // Set nilai minimum untuk y-axis
          max: 100 // Set nilai maksimum untuk y-axis (sesuaikan sesuai kebutuhan)
        }
      },
      plugins: {
        datalabels: {
            anchor: 'end',
            align: 'bottom',
            offset: 5,
            color: 'white',
            formatter: (value, context) => {
              return value.toFixed(1); // Membulatkan nilai menjadi dua angka di belakang koma
            },
            font: {
                weight: 'normal',
                size: 7
            }
        }
      }
    }

    new Chart(barChartCanvas, {
      plugins : [ChartDataLabels],
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

  })
</script>



<!-- ======================================================================================================================= -->
<!-- ---------------------DATA CHART KARYAWAN------------------------------ -->
<?php
    $krw_year = $_GET['tahun'];
    $krw_nik = $_GET['nik'];

    //----- DATA ABSEN MASUK KARYAWAN --------------------------------------
    for($a=1;$a<=12;$a++){
        $krw_terlambat[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE terlambat > 0 AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik'"));

        $krw_izin[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik' AND (status = 'Izin Tidak Masuk' OR status = 'Sakit - Tanpa SKD')"));

        $krw_cuti[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM absen_masuk WHERE MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik' AND (status = 'Cuti - Tahunan' OR status = 'Cuti - Menikah' OR status = 'Cuti - Melahirkan' OR status = 'Cuti - Ibadah')"));
    }

    //----- DATA PENILAIAN HARIAN KARYAWAN ------------------------------------
    for($a=1;$a<=12;$a++){
        $krw_program[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE program = 'Tidak/Lupa' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik'"));

        $krw_seragam[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE seragam = 'Tidak/Lupa' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik'"));

        $krw_nametag[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM penilaian_harian WHERE nametag = 'Tidak/Lupa' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik'"));
    }

    //----- DATA PELANGGARAN KARYAWAN ------------------------------------
    for($a=1;$a<=12;$a++){
        $ringan[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'RINGAN' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik'"));

        $sedang[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'SEDANG' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik'"));

        $sedang_berat[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'SEDANG BERAT' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik'"));

        $berat[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'BERAT' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik'"));

        $sangat_berat[$a] = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM v_pelanggaran WHERE status_pelanggaran = 'SANGAT BERAT' AND MONTH(tanggal) = '$a' AND YEAR(tanggal) = '$krw_year' AND nik = '$krw_nik'"));
    }

    //----- DATA EVALUASI KARYAWAN ------------------------------------
    $q_evaluasi = mysqli_query($conn, "SELECT * FROM evaluasi WHERE nik = '$krw_nik' ORDER BY tanggal_evaluasi ASC");
    $cc = 1;
    while($get_evaluasi = mysqli_fetch_array($q_evaluasi)){

        $avg_point1 = ($get_evaluasi['point1_dirut']+$get_evaluasi['point1_dirop']+$get_evaluasi['point1_leader'])/3;
                $avg_point2 = ($get_evaluasi['point2_dirut']+$get_evaluasi['point2_dirop']+$get_evaluasi['point2_leader'])/3;
                $avg_point3 = ($get_evaluasi['point3_dirut']+$get_evaluasi['point3_dirop']+$get_evaluasi['point3_leader'])/3;
                $avg_point4 = ($get_evaluasi['point4_dirut']+$get_evaluasi['point4_dirop']+$get_evaluasi['point4_leader'])/3;
                $nilai_point1 = number_format(($avg_point1+$avg_point2+$avg_point3+$avg_point4),2);

                    $avg_point1M = ($get_evaluasi['point1_dirut']+$get_evaluasi['point1_dirop'])/2;
                    $avg_point2M = ($get_evaluasi['point2_dirut']+$get_evaluasi['point2_dirop'])/2;
                    $avg_point3M = ($get_evaluasi['point3_dirut']+$get_evaluasi['point3_dirop'])/2;
                    $avg_point4M = ($get_evaluasi['point4_dirut']+$get_evaluasi['point4_dirop'])/2;
                    $nilai_point1M = number_format(($avg_point1M+$avg_point2M+$avg_point3M+$avg_point4M),2);

                $avg_point5 = ($get_evaluasi['point5_dirut']+$get_evaluasi['point5_dirop']+$get_evaluasi['point5_leader'])/3;
                $avg_point6 = ($get_evaluasi['point6_dirut']+$get_evaluasi['point6_dirop']+$get_evaluasi['point6_leader'])/3;
                $avg_point7 = ($get_evaluasi['point7_dirut']+$get_evaluasi['point7_dirop']+$get_evaluasi['point7_leader'])/3;
                $avg_point8 = ($get_evaluasi['point8_dirut']+$get_evaluasi['point8_dirop']+$get_evaluasi['point8_leader'])/3;
                $nilai_point2 = number_format(($avg_point5+$avg_point6+$avg_point7+$avg_point8),2);

                    $avg_point5M = ($get_evaluasi['point5_dirut']+$get_evaluasi['point5_dirop'])/2;
                    $avg_point6M = ($get_evaluasi['point6_dirut']+$get_evaluasi['point6_dirop'])/2;
                    $avg_point7M = ($get_evaluasi['point7_dirut']+$get_evaluasi['point7_dirop'])/2;
                    $avg_point8M = ($get_evaluasi['point8_dirut']+$get_evaluasi['point8_dirop'])/2;
                    $nilai_point2M = number_format(($avg_point5M+$avg_point6M+$avg_point7M+$avg_point8M),2);

                $avg_point9 = ($get_evaluasi['point9_dirut']+$get_evaluasi['point9_dirop']+$get_evaluasi['point9_leader'])/3;
                $avg_point10 = ($get_evaluasi['point10_dirut']+$get_evaluasi['point10_dirop']+$get_evaluasi['point10_leader'])/3;
                $avg_point11 = ($get_evaluasi['point11_dirut']+$get_evaluasi['point11_dirop']+$get_evaluasi['point11_leader'])/3;
                $avg_point12 = ($get_evaluasi['point12_dirut']+$get_evaluasi['point12_dirop']+$get_evaluasi['point12_leader'])/3;
                $nilai_point3 = number_format(($avg_point9+$avg_point10+$avg_point11+$avg_point12),2);

                    $avg_point9M = ($get_evaluasi['point9_dirut']+$get_evaluasi['point9_dirop'])/2;
                    $avg_point10M = ($get_evaluasi['point10_dirut']+$get_evaluasi['point10_dirop'])/2;
                    $avg_point11M = ($get_evaluasi['point11_dirut']+$get_evaluasi['point11_dirop'])/2;
                    $avg_point12M = ($get_evaluasi['point12_dirut']+$get_evaluasi['point12_dirop'])/2;
                    $nilai_point3M = number_format(($avg_point9M+$avg_point10M+$avg_point11M+$avg_point12M),2);
                
                $avg_point13 = ($get_evaluasi['point13_dirut']+$get_evaluasi['point13_dirop']+$get_evaluasi['point13_leader'])/3;
                $avg_point14 = ($get_evaluasi['point14_dirut']+$get_evaluasi['point14_dirop']+$get_evaluasi['point14_leader'])/3;
                $avg_point15 = ($get_evaluasi['point15_dirut']+$get_evaluasi['point15_dirop']+$get_evaluasi['point15_leader'])/3;
                $avg_point16 = ($get_evaluasi['point16_dirut']+$get_evaluasi['point16_dirop']+$get_evaluasi['point16_leader'])/3;
                $nilai_point4 = number_format(($avg_point13+$avg_point14+$avg_point15+$avg_point16),2);

                    $avg_point13M = ($get_evaluasi['point13_dirut']+$get_evaluasi['point13_dirop'])/2;
                    $avg_point14M = ($get_evaluasi['point14_dirut']+$get_evaluasi['point14_dirop'])/2;
                    $avg_point15M = ($get_evaluasi['point15_dirut']+$get_evaluasi['point15_dirop'])/2;
                    $avg_point16M = ($get_evaluasi['point16_dirut']+$get_evaluasi['point16_dirop'])/2;
                    $nilai_point4M = number_format(($avg_point13M+$avg_point14M+$avg_point15M+$avg_point16M),2);

                $nilai_point5 = number_format($get_evaluasi['point_grooming']+$get_evaluasi['point_kedisiplinan'],2);
                $nilai_point6 = number_format($get_evaluasi['point_kehadiran'],2);
                $nilai_point7 = number_format($get_evaluasi['point_owoj'],2);

        if($get_evaluasi['jabatan'] == "Manager"){
            $nilai_akhir = number_format(($nilai_point1M+$nilai_point2M+$nilai_point3M+$nilai_point4M+$nilai_point5+$nilai_point6)/6+($nilai_point7/10),2);
        }elseif($get_evaluasi['jabatan'] == "Fungsional"){
            if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){
                    $nilai_akhir = number_format(($nilai_point1M+$nilai_point2M+$nilai_point4M+$nilai_point5+$nilai_point6)/5+($nilai_point7/10),2);
                }else{
                    $nilai_akhir = number_format(($nilai_point1+$nilai_point2+$nilai_point4+$nilai_point5+$nilai_point6)/5+($nilai_point7/10),2);
                }
        }elseif($get_evaluasi['jabatan'] == "Staff"){
            if($get_evaluasi['nik']=='12150801030495' OR $get_evaluasi['nik']=='12150301230596' OR $get_evaluasi['nik']=='12150802250797' OR $get_evaluasi['nik']=='12150702180878' OR $get_evaluasi['nik']=='12150701180790' OR $get_evaluasi['nik']=='12150703291280'){
                    $nilai_akhir = number_format(($nilai_point1M+$nilai_point2M+$nilai_point4M+$nilai_point5+$nilai_point6)/4+($nilai_point7/10),2);
                }else{
                    $nilai_akhir = number_format(($nilai_point1+$nilai_point2+$nilai_point4+$nilai_point5+$nilai_point6)/4+($nilai_point7/10),2);
                }
        }elseif($get_evaluasi['jabatan'] == "Magang" OR $get_evaluasi['jabatan'] == "Kontrak"){
            $nilai_akhir = number_format(($nilai_point1+$nilai_point2+$nilai_point4+$nilai_point5+$nilai_point6)/4+($nilai_point7/10),2);
        }

        $nilai_evaluasi[$cc] = $nilai_akhir;
        $semester[$cc] = $get_evaluasi['semester'];
        $cc++;
    }

?>

<script>
    //-------------
    //- BAR CHART ABSEN KARYAWAN-
    //-------------
    var barChartCanvas = $('#barChart_absenKaryawan').get(0).getContext('2d')
    
    var barChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [
        {
          label               : 'Terlambat/Masuk Siang',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'rgba(210, 214, 222, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $krw_terlambat[1].", ".$krw_terlambat[2].", ".$krw_terlambat[3].", ".$krw_terlambat[4].", ".$krw_terlambat[5].", ".$krw_terlambat[6].", ".$krw_terlambat[7].", ".$krw_terlambat[8].", ".$krw_terlambat[9].", ".$krw_terlambat[10].", ".$krw_terlambat[11].", ".$krw_terlambat[12]; ?>]
        },
        {
          label               : 'Izin',
          backgroundColor     : 'rgba(60,141,188,0.8)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius         : false,
          pointColor          : 'rgba(60,141,188,0.8)',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $krw_izin[1].", ".$krw_izin[2].", ".$krw_izin[3].", ".$krw_izin[4].", ".$krw_izin[5].", ".$krw_izin[6].", ".$krw_izin[7].", ".$krw_izin[8].", ".$krw_izin[9].", ".$krw_izin[10].", ".$krw_izin[11].", ".$krw_izin[12]; ?>]
        },
        {
          label               : 'Cuti',
          backgroundColor     : 'RGBA( 0, 139, 139, 1 )',
          borderColor         : 'RGBA( 0, 139, 139, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 0, 139, 139, 1 )',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $krw_cuti[1].", ".$krw_cuti[2].", ".$krw_cuti[3].", ".$krw_cuti[4].", ".$krw_cuti[5].", ".$krw_cuti[6].", ".$krw_cuti[7].", ".$krw_cuti[8].", ".$krw_cuti[9].", ".$krw_cuti[10].", ".$krw_cuti[11].", ".$krw_cuti[12]; ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART PENILAIAN HARIAN KARYAWAN-
    //-------------
    var barChartCanvas = $('#barChart_penilaianKaryawan').get(0).getContext('2d')
    
    var barChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [
        {
          label               : 'Program (x)',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'rgba(210, 214, 222, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $krw_program[1].", ".$krw_program[2].", ".$krw_program[3].", ".$krw_program[4].", ".$krw_program[5].", ".$krw_program[6].", ".$krw_program[7].", ".$krw_program[8].", ".$krw_program[9].", ".$krw_program[10].", ".$krw_program[11].", ".$krw_program[12]; ?>]
        },
        {
          label               : 'Seragam (x)',
          backgroundColor     : 'rgba(60,141,188,0.8)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius         : false,
          pointColor          : 'rgba(60,141,188,0.8)',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $krw_seragam[1].", ".$krw_seragam[2].", ".$krw_seragam[3].", ".$krw_seragam[4].", ".$krw_seragam[5].", ".$krw_seragam[6].", ".$krw_seragam[7].", ".$krw_seragam[8].", ".$krw_seragam[9].", ".$krw_seragam[10].", ".$krw_seragam[11].", ".$krw_seragam[12]; ?>]
        },
        {
          label               : 'Nametag (x)',
          backgroundColor     : 'RGBA( 0, 139, 139, 1 )',
          borderColor         : 'RGBA( 0, 139, 139, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 0, 139, 139, 1 )',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $krw_nametag[1].", ".$krw_nametag[2].", ".$krw_nametag[3].", ".$krw_nametag[4].", ".$krw_nametag[5].", ".$krw_nametag[6].", ".$krw_nametag[7].", ".$krw_nametag[8].", ".$krw_nametag[9].", ".$krw_nametag[10].", ".$krw_nametag[11].", ".$krw_nametag[12]; ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART PELANGGARAN KARYAWAN-
    //-------------
    var barChartCanvas = $('#barChartPelanggaranKaryawan').get(0).getContext('2d')
    
    var barChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: [
        {
          label               : 'Ringan',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius          : false,
          pointColor          : '#c1c7d1',
          pointStrokeColor    : 'rgba(210, 214, 222, 1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $ringan[1].", ".$ringan[2].", ".$ringan[3].", ".$ringan[4].", ".$ringan[5].", ".$ringan[6].", ".$ringan[7].", ".$ringan[8].", ".$ringan[9].", ".$ringan[10].", ".$ringan[11].", ".$ringan[12]; ?>]
        },
        {
          label               : 'Sedang',
          backgroundColor     : 'RGBA( 240, 230, 140, 1 )',
          borderColor         : 'RGBA( 240, 230, 140, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 240, 230, 140, 1 )',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $sedang[1].", ".$sedang[2].", ".$sedang[3].", ".$sedang[4].", ".$sedang[5].", ".$sedang[6].", ".$sedang[7].", ".$sedang[8].", ".$sedang[9].", ".$sedang[10].", ".$sedang[11].", ".$sedang[12]; ?>]
        },
        {
          label               : 'Sedang Berat',
          backgroundColor     : 'RGBA( 255, 215, 0, 1 )',
          borderColor         : 'RGBA( 255, 215, 0, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 255, 215, 0, 1 )',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $sedang_berat[1].", ".$sedang_berat[2].", ".$sedang_berat[3].", ".$sedang_berat[4].", ".$sedang_berat[5].", ".$sedang_berat[6].", ".$sedang_berat[7].", ".$sedang_berat[8].", ".$sedang_berat[9].", ".$sedang_berat[10].", ".$sedang_berat[11].", ".$sedang_berat[12]; ?>]
        },
        {
          label               : 'Berat',
          backgroundColor     : 'RGBA( 255, 165, 0, 1 )',
          borderColor         : 'RGBA( 255, 165, 0, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 255, 165, 0, 1 )',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $berat[1].", ".$berat[2].", ".$berat[3].", ".$berat[4].", ".$berat[5].", ".$berat[6].", ".$berat[7].", ".$berat[8].", ".$berat[9].", ".$berat[10].", ".$berat[11].", ".$berat[12]; ?>]
        },
        {
          label               : 'Sangat Berat',
          backgroundColor     : 'RGBA( 255, 69, 0, 1 )',
          borderColor         : 'RGBA( 255, 69, 0, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 255, 69, 0, 1 )',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $sangat_berat[1].", ".$sangat_berat[2].", ".$sangat_berat[3].", ".$sangat_berat[4].", ".$sangat_berat[5].", ".$sangat_berat[6].", ".$sangat_berat[7].", ".$sangat_berat[8].", ".$sangat_berat[9].", ".$sangat_berat[10].", ".$sangat_berat[11].", ".$sangat_berat[12]; ?>]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //-------------
    //- BAR CHART PENILAIAN EVALUASI -
    //-------------
    var barChartCanvas = $('#barChart_penilaianEvaluasi').get(0).getContext('2d')
    
    var barChartData = {
      labels  : [
            <?php 
                for($a=1;$a<$cc;$a++){
                    if($semester[$a] == "6 bulan (Training) + Semester 1"){
                        $semester[$a] = "3 Bulan (Training 2)";
                    }elseif($semester[$a] == "3 Bulan (Training)"){
                        $semester[$a] = "3 Bulan (Training 1)";
                    }else{
                        $semester[$a] = "Semester ".$semester[$a];
                    }
                    echo "'".$semester[$a]."',";
                }
            ?>
        ],
      datasets: [
        {
          label               : 'Nila Evaluasi',
          backgroundColor     : 'RGBA( 240, 230, 140, 1 )',
          borderColor         : 'RGBA( 240, 230, 140, 1 )',
          pointRadius         : false,
          pointColor          : 'RGBA( 240, 230, 140, 1 )',
          pointStrokeColor    : '#3b8bba',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [

            <?php 
                for($a=1;$a<=$cc;$a++){
                    echo "'".number_format($nilai_evaluasi[$a],1)."', ";
                }
            ?>


            ]
        },
      ]
    }

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>

<?php if (@$_SESSION['alert_info']) { ?>
  <script>
    swal("Perhatian!", "<?php echo $_SESSION['alert_info']; ?>", "info");
  </script>
<?php unset($_SESSION['alert_info']); } ?>

<?php if (@$_SESSION['alert_success']) { ?>
  <script>
    swal("Good job!", "<?php echo $_SESSION['alert_success']; ?>", "success");
  </script>
<?php unset($_SESSION['alert_success']); } ?>

<?php if (@$_SESSION['alert_error']) { ?>
  <script>
    swal("Oh My Bad!", "<?php echo $_SESSION['alert_error']; ?>", "error");
  </script>
<?php unset($_SESSION['alert_error']); } ?>

<?php if (@$_SESSION['alert_warning']) { ?>
  <script>
    swal("Perhatian!", "<?php echo $_SESSION['alert_warning']; ?>", "warning");
  </script>
<?php unset($_SESSION['alert_warning']); } ?>

<script>
  initSample();
</script>

<script>
    document.getElementById('myForm').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm1').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm2').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm3').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm4').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm5').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm11').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm12').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm13').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm14').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myForm15').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myFormA').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('myFormB').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

<script>
    document.getElementById('signatureForm').addEventListener('submit', function() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    });
</script>

</body>
</html>