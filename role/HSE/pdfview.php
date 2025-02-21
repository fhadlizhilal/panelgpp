<?php
$nama_file = 'sertifikat_file/20240328051520_BA Progress.pdf';

// Set header untuk menampilkan konten secara langsung di dalam browser
header('Content-Disposition: inline; filename="' . $nama_file . '"');
header('Content-type: application/pdf');

// Membaca file PDF dan menampilkannya
readfile($nama_file);
?>