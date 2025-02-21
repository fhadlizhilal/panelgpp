<html>



<head>

<title>Belajar Membuat Peta, Part 3</title>


  
  
   <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.js"></script>
    <script src="https://cdn.maptiler.com/mapbox-gl-js/v1.5.1/mapbox-gl.js"></script>
    <script src="https://cdn.maptiler.com/mapbox-gl-leaflet/latest/leaflet-mapbox-gl.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.maptiler.com/mapbox-gl-js/v1.5.1/mapbox-gl.css" />

</head>




<style>
   #map { height: 900px; }
</style>







<body>






<center>
<img src = "../../gambar/ugi.png" width = "150px"></img>


</center>


<br><br>

<center>

<font style="color:#893BFF; text-align: justify; font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', sans-serif;">
        <font size = 3>
		
		Prana Ugiana Gio
		
		</font>
		</font>
		
		</center>
		

<center>

<br>

<font style="color:#893BFF; text-align: justify; font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', sans-serif;">
        <font size = 3>
		
		
The following is some of my website: </font><a href = "http://statkomat.com/" target = "_blank"><font color = "#F433FF">STATKOMAT</font></a> | <a href = "http://statcal.com/" target = "_blank"><font color = "#F433FF">STATCAL</font></a> | <a href = "http://ugigrafik.com/" target = "_blank"><font color = "#F433FF">UGIGRAFIK</font></a> | <a href = "http://pranaugi.com/" target = "_blank"><font color = "#F433FF">PRANAUGI</font></a> | <a href = "https://pranaugi-rshiny.com/" target = "_blank"><font color = "#F433FF">R-SHINY</font></a>  | <a href = "http://pranaugi-belajar-pemrograman.com/" target = "_blank"><font color = "#F433FF">PRANAUGI-BELAJAR-PEMROGRAMAN</font></a>  | <a href = "http://olahdata-statistik.org/" target = "_blank"><font color = "#F433FF">OLAHDATA-STATISTIK</font></a>.

	


</center>




<br><br>

<center>
    <div id="map"> </div>
	</center>


    <script>


var data_longitude_aceh = 96.749397;
var data_latitude_aceh = 4.695135;


var data_longitude_medan = 98.678513;
var data_latitude_medan = 3.597031;


var data_longitude_padang = 100.35427;
var data_latitude_padang = -0.94924;


var latitude = [4.695135, 3.597031, -0.94924];
var longitude = [96.749397, 98.678513, 100.35427];




      var map = L.map('map').setView([3.597031, 98.678513], 6);
      var gl = L.mapboxGL({
        attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>',
        accessToken: 'not-needed',
        style: 'https://api.maptiler.com/maps/streets/style.json?key=1h7e1Z9S76PGy92uF3c5'
      }).addTo(map);



var ukuran_animasi = 100;


      var icon_animasi1 = L.icon({
    iconUrl: 'gambar/pok11new.gif',
    //shadowUrl: 'icon1.png',

    iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
    shadowSize:   [10, 10], // size of the shadow
    iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
    shadowAnchor: [10, 10], // the same for the shadow
    popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
	
});

var icon_animasi2 = L.icon({
    iconUrl: 'gambar/pok9new.gif',
    //shadowUrl: 'icon1.png',

    iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
    shadowSize:   [10, 10], // size of the shadow
    iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
    shadowAnchor: [10, 10], // the same for the shadow
    popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
	
});
      
     
var icon_animasi3 = L.icon({
    iconUrl: 'gambar/pok8new.gif',
    //shadowUrl: 'icon1.png',

    iconSize:     [ukuran_animasi, ukuran_animasi], // size of the icon
    shadowSize:   [10, 10], // size of the shadow
    iconAnchor:   [10, 10], // point of the icon which will correspond to marker's location
    shadowAnchor: [10, 10], // the same for the shadow
    popupAnchor:  [10, 10] // point from which the popup should open relative to the iconAnchor
	
});


var icon_animasi = [icon_animasi1, icon_animasi2, icon_animasi3];


var array_marker = [];

for(i = 0; i <= 2; i++)
{
    array_marker[i] = new L.marker([latitude[i], longitude[i]], {icon:icon_animasi[i]});
array_marker[i].addTo(map);
}

      </script>

</body>



</html>