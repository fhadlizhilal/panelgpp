<html>

<head>

<title>Belajar Membuat Peta, Part 4</title>
  
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
                    <td align="center"><img src="icon/pjuts.png" width="60px"></td>
                    <td align="center"><img src="icon/pats.png" width="60px"></td>
                    <td align="center"><img src="icon/onm.png" width="60px"></td>
                </tr>
                <tr style="color: white; font-family: cursive;">
                    <td align="center" width="20%">PLTS Ongrid / Hybrid</td>
                    <td align="center" width="20%">PLTS Offgrid</td>
                    <td align="center" width="20%">Penerangan Jalan Umum <br>Tenaga Surya</td>
                    <td align="center" width="20%">Pompa Air Tenaga Surya</td>
                    <td align="center" width="20%">Operation & Maintenance</td>
                </tr>               
            </table>
            
        </div>
    </center>


    <script>

var data_longitude_medan = 98.678513;
var data_latitude_medan = 3.597031;

var data_longitude_aceh = 95.323753;
var data_latitude_aceh = 5.548290;

var data_longitude_padang = 100.35427;
var data_latitude_padang = -0.94924;


var longitude = [data_longitude_medan, data_longitude_aceh, data_longitude_padang];
var latitude = [data_latitude_medan, data_latitude_aceh, data_latitude_padang];



      var map = L.map('map').setView([-1.1137887789906955, 119.3740105608166], 5);
      var gl = L.mapboxGL({
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
        accessToken: 'not-needed',
        style: 'https://api.maptiler.com/maps/voyager/style.json?key=1h7e1Z9S76PGy92uF3c5'
      }).addTo(map);


      var kota = ["Medan","Banda Aceh","Padang"];

var website_ya = ["'https://pemkomedan.go.id/'", "'https://bandaacehkota.go.id/'","'Padang.com'"]

var ukuran_animasi = 30;


      var icon_animasi1 = L.icon({
    iconUrl: 'icon/ongrid.png',
    //shadowUrl: 'icon1.png',

    iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
    shadowSize:   [10, 10], // size of the shadow
    iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
    shadowAnchor: [10, 10], // the same for the shadow
    popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
    
});

var icon_animasi2 = L.icon({
    iconUrl: 'icon/offgrid.png',
    //shadowUrl: 'icon1.png',

    iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
    shadowSize:   [10, 10], // size of the shadow
    iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
    shadowAnchor: [10, 10], // the same for the shadow
    popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
    
});
      
     
var icon_animasi3 = L.icon({
    iconUrl: 'icon/pjuts.png',
    //shadowUrl: 'icon1.png',

    iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
    shadowSize:   [10, 10], // size of the shadow
    iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
    shadowAnchor: [10, 10], // the same for the shadow
    popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
    
});


var icon_animasi = [icon_animasi1, icon_animasi2, icon_animasi3];
     

      var array_marker = [];

for(i = 0; i < 3; i++)
{
    array_marker[i] = new L.marker([latitude[i], longitude[i]], {icon:icon_animasi[i]}).
    bindPopup("<center><b>"+ kota[i] +"</b></center> <br> <img src = '" + i + ".png' width = '150px'> <br><br> " + "<b>Kota</b> : Karawang <br>" + "<b>Provinsi</b> : Jawa Barat <br> " + "<b>Kapasitas</b> : 3000 Wp <br>" + "<b>Sistem</b> : PLTS Ongrid <br>" + "<b>Atap</b> : Zinc Allumunium <br>" + "<b>Tahun</b> : 2023").openPopup();

array_marker[i].addTo(map);
}



      </script>

</body>

</html>