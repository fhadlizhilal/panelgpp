<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <?php
        if(!isset($_GET['msg'])){ $_GET['msg'] = ""; }
        if(!isset($_GET['topages'])){ $_GET['topages'] = ""; }
        if(!isset($_GET['kd'])){ $_GET['kd'] = ""; }
        if(!isset($_GET['kdproject'])){ $_GET['kdproject'] = ""; }
        if(!isset($_GET['tgl'])){ $_GET['tgl'] = ""; }
    ?>

    <script>
        // Tampilkan pemberitahuan berhasil menggunakan SweetAlert
        swal("Good Job!", "<?php echo $_GET['msg'] ?>", "success")
            .then((value) => {
                // Redirect kembali ke halaman input_form.php setelah pengguna menutup alert
                window.location = "index.php?pages=<?php echo $_GET['topages'] ?>&kd=<?php echo $_GET['kd']; ?>&kdproject=<?php echo $_GET['kdproject'] ?>&tgl=<?php echo $_GET['tgl'] ?>";
            });
    </script>
</body>
</html>