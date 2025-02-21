<?php
    // require_once "koneksi.php";
    include "excel_reader2.php";
    
    if ($_POST['upload'] == "Upload") {
        $type         =explode(".",$_FILES['namafile']['name']);
        
        if (empty($_FILES['namafile']['name'])) {
            ?>
                <script language="JavaScript">
                    alert('Oops! Please fill all / select file ...');
                    document.location='./';
                </script>
            <?php
        }
        else if(strtolower(end($type)) !='xls'){
            ?>
                <script language="JavaScript">
                    alert('Oops! Please upload only Excel XLS file ...');
                    document.location='./';
                </script>
            <?php
        }
        
        else{
        $target = basename($_FILES['namafile']['name']) ;
        move_uploaded_file($_FILES['namafile']['tmp_name'], $target);
    
        $data    =new Spreadsheet_Excel_Reader($_FILES['namafile']['name'],false);
    
        $baris = $data->rowcount($sheet_index=0);
    
        for ($i=2; $i<=$baris; $i++){
            $nik        =$data->val($i, 1);
            $jam    =$data->val($i, 3);

            if($jam == ""){
                $jam = null;
            }
            
            $query = mysqli_query($conn, "INSERT INTO absen_masuk_tmp (nik, jam) VALUES ('$nik', '$jam')");        
        }
    
            if(!$query){
                ?>
                    <script language="JavaScript">
                        alert('<b>Oops!</b> 404 Error Server.');
                        document.location='./';
                    </script>
                <?php
            }
            else{
                ?>
                    <script language="JavaScript">
                        alert('Good! Import Excel XLS file success...');
                        document.location='./';
                    </script>
                <?php
            }
        unlink($_FILES['namafile']['name']);
        }
    }
?>