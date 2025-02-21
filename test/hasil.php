<?php    
    //memasukkan data ke array
        $namaproduk       = $_POST['nama_produk'];

        $total = count($namaproduk);

    //melakukan perulangan input
    for($i=0; $i<$total; $i++){

        echo "Nama Produk : ".$namaproduk[$i];
        echo "<br>";
    }

?>