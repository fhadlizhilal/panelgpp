<?php
    require_once "../../../dev/config.php";
?>

<html>

<head>

<title>Peta Project GPP</title>
  
   <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.js"></script>
    <script src="https://cdn.maptiler.com/mapbox-gl-js/v1.5.1/mapbox-gl.js"></script>
    <script src="https://cdn.maptiler.com/mapbox-gl-leaflet/latest/leaflet-mapbox-gl.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.maptiler.com/mapbox-gl-js/v1.5.1/mapbox-gl.css" />

</head>

<style>
    #map-container {
      height: 80vh;
      position: relative;
    }
    #map {
      height: 100%;
    }
    .dark-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.0); /* Adjust the alpha value for desired darkness */
      pointer-events: none; /* Allow clicks to pass through the overlay */
      z-index: 1000; /* Ensure the overlay is on top */
    }

    #map-legend{
        background-color: black;
        padding-top: 10px;
        padding-bottom: 10px;
    }
  </style>

<body>
    <center>
        <div id="map-container">
            <div id="map"></div>
        </div>
        <div id="map-legend">
            <table width="80%">
                <tr>
                    <td align="center"><img src="icon/ongrid.png" width="60px"></td>
                    <td align="center"><img src="icon/offgrid.png" width="60px"></td>
                    <td align="center"><img src="icon/shs.png" width="60px"></td>
                    <td align="center"><img src="icon/pjuts.png" width="60px"></td>
                    <td align="center"><img src="icon/pats.png" width="60px"></td>
                    <td align="center"><img src="icon/onm.png" width="60px"></td>
                </tr>
                <tr style="color: white; font-family: cursive;">
                    <td align="center" width="20%">PLTS Ongrid / Hybrid</td>
                    <td align="center" width="20%">PLTS Offgrid</td>
                    <td align="center" width="20%">Solar Home System</td>
                    <td align="center" width="20%">Penerangan Jalan Umum <br>Tenaga Surya</td>
                    <td align="center" width="20%">Pompa Air Tenaga Surya</td>
                    <td align="center" width="20%">Operation & Maintenance</td>
                </tr>
            </table>
            
        </div>
    </center>

<script>
    var longitude = [
            <?php
                $q_longtitude = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_longtitude = mysqli_fetch_array($q_longtitude)){
                    echo $get_longtitude['longtitude'].",";
                }
            ?>
        ];

    var latitude = [
            <?php
                $q_latitude = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_latitude = mysqli_fetch_array($q_latitude)){
                    echo $get_latitude['latitude'].",";
                }
            ?>
        ];



      var map = L.map('map').setView([-1.1137887789906955, 119.3740105608166], 5);
      var gl = L.mapboxGL({
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
        accessToken: 'not-needed',
        style: 'https://api.maptiler.com/maps/voyager/style.json?key=1h7e1Z9S76PGy92uF3c5'
      }).addTo(map);

    var namaproject = [
            <?php
                $q_namaproject = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_namaproject = mysqli_fetch_array($q_namaproject)){
                    echo "'".$get_namaproject['nama_project']."',";
                }
            ?>
        ];

      var kota = [
            <?php
                $q_kota = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_kota = mysqli_fetch_array($q_kota)){
                    echo "'".$get_kota['kota']."',";
                }
            ?>
        ];

      var provinsi = [
            <?php
                $q_provinsi = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_provinsi = mysqli_fetch_array($q_provinsi)){
                    echo "'".$get_provinsi['provinsi']."',";
                }
            ?>
        ];

      var kapasitas = [
            <?php
                $q_kapasitas = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_kapasitas = mysqli_fetch_array($q_kapasitas)){
                    echo "'".$get_kapasitas['kapasitas']."',";
                }
            ?>
        ];

      var jenis = [
            <?php
                $q_jenis = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_jenis = mysqli_fetch_array($q_jenis)){
                    if($get_jenis['jenis'] == "ongrid"){
                        echo "'PLTS Ongrid',";
                    }elseif($get_jenis['jenis'] == "hybrid"){
                        echo "'PLTS Hybrid',";
                    }elseif($get_jenis['jenis'] == "offgrid"){
                        echo "'PLTS Offgrid',";
                    }elseif($get_jenis['jenis'] == "shs"){
                        echo "'Solar Home System',";
                    }elseif($get_jenis['jenis'] == "pjuts"){
                        echo "'PJUTS',";
                    }elseif($get_jenis['jenis'] == "pats"){
                        echo "'PATS',";
                    }elseif($get_jenis['jenis'] == "onm"){
                        echo "'OnM',";
                    }
                }
            ?>
        ];

      var atap = [
            <?php
                $q_atap = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_atap = mysqli_fetch_array($q_atap)){
                    echo "'".$get_atap['jenis_atap']."',";
                }
            ?>
        ];

      var tahun = [
            <?php
                $q_tahun = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_tahun = mysqli_fetch_array($q_tahun)){
                    echo "'".$get_tahun['tahun']."',";
                }
            ?>
        ];

      var foto = [
            <?php
                $q_foto = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
                while($get_foto = mysqli_fetch_array($q_foto)){
                    echo "'".$get_foto['foto']."',";
                }
            ?>
        ];

    var website_ya = ["'https://pemkomedan.go.id/'", "'https://bandaacehkota.go.id/'","'Padang.com'"]

    var ukuran_animasi = 30;


    var ongrid = L.icon({
        iconUrl: 'icon/ongrid.png',
        //shadowUrl: 'icon1.png',

        iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
        shadowSize:   [10, 10], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [10, 10], // the same for the shadow
        popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
        
    });

    var hybrid = L.icon({
        iconUrl: 'icon/ongrid.png',
        //shadowUrl: 'icon1.png',

        iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
        shadowSize:   [10, 10], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [10, 10], // the same for the shadow
        popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
        
    });

    var offgrid = L.icon({
        iconUrl: 'icon/offgrid.png',
        //shadowUrl: 'icon1.png',

        iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
        shadowSize:   [10, 10], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [10, 10], // the same for the shadow
        popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
        
    });

    var shs = L.icon({
        iconUrl: 'icon/shs.png',
        //shadowUrl: 'icon1.png',

        iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
        shadowSize:   [10, 10], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [10, 10], // the same for the shadow
        popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
        
    });   
         
    var pjuts = L.icon({
        iconUrl: 'icon/pjuts.png',
        //shadowUrl: 'icon1.png',

        iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
        shadowSize:   [10, 10], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [10, 10], // the same for the shadow
        popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
        
    });

    var pats = L.icon({
        iconUrl: 'icon/pats.png',
        //shadowUrl: 'icon1.png',

        iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
        shadowSize:   [10, 10], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [10, 10], // the same for the shadow
        popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
        
    });

    var onm = L.icon({
        iconUrl: 'icon/onm.png',
        //shadowUrl: 'icon1.png',

        iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
        shadowSize:   [10, 10], // size of the shadow
        iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
        shadowAnchor: [10, 10], // the same for the shadow
        popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
        
    });


    var icon_animasi = [
        <?php
            $q_icon = mysqli_query($conn, "SELECT * FROM am_petaproject ORDER BY id ASC");
            while($get_icon = mysqli_fetch_array($q_icon)){
                echo $get_icon['jenis'].",";
            }
        ?>
    ];

    var array_marker = [];

    <?php $jmlDataPeta = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM am_petaproject")) ?>
    for(i = 0; i < <?php echo $jmlDataPeta ?>; i++)
    {
        array_marker[i] = new L.marker([latitude[i], longitude[i]], {icon:icon_animasi[i]}).
        bindPopup("<center><b>"+ namaproject[i] +"</b></center> <br> <img src = 'fotoproject/" + foto[i] + "' width = '250px'> <br><br> " + "<b>Kota</b> : " + kota[i] + " <br>" + "<b>Provinsi</b> : " + provinsi[i] + " <br> " + "<b>Kapasitas</b> : " + kapasitas[i] + "<br>" + "<b>Sistem</b> : " + jenis[i] + " <br>" + "<b>Atap</b> : " + atap[i] + " <br>" + "<b>Tahun</b> : "+ tahun[i]).openPopup();

    array_marker[i].addTo(map);
    }


</script>

</body>

</html>