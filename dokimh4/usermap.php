<?php 
//$con = mysqli_connect('localhost', 'root', '', 'pois');

	include('functions.php');
    if (!isLoggedIn()) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="style4.css">
    
    <!-- leaflet css  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.0/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="leaflet-search-master/dist/leaflet-search.min.css" />
    <link rel="stylesheet" href="leaflet-search-master/dist/leaflet-search.src.css" />
    <style>
        body {
            margin: 1;
            padding: 1;
        }

        #map {
            width: 50%;
            height: 50vh;
        }

        .coordinate {
            position: absolute;
            bottom: 10px;
            right: 50%;
        }

        .leaflet-popup-content-wrapper {
            background-color: #000000;
            color: #fff;
            border: 1px solid red;
            border-radius: 0px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Covid Heat Maps</a>
            
            <div class="collapse navbar-collapse">
				<ul class="navbar-nav">
					<li class="nav-item">
                    	<a href="usermap.php" class="nav-link">Home</a>
                    </li> 
					<li class="nav-item">
                    <a href="changes.php" class="nav-link">Change Your Profile</a>
                    </li> 
                    <li class="nav-item">
                    <a href="positive.php" class="nav-link">I'm positive!</a>
                    </li>
                    <li class="nav-item">
                    <a href="history.php" class="nav-link">My History</a>
                    </li>
				</ul>

				<!-- logged in user information -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <?php  if (isset($_SESSION['user'])) : ?>
					        <strong>
                                <i style="color: white;"> <?php echo $_SESSION['user']['username']; ?> </i>
                            </strong>

    		    			<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>) </i> 
			        
		        		<?php endif ?>
                    </li>

                    <li class="nav-item"> 
                            <a href="usermap.php?logout='1'" style="color: red;"> Log Out </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div id="map">
    
        <div class="leaflet-control coordinate"></div>
    </div>
    
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>


<!-- leaflet js  -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="./data/point.js"></script>
<script src="./data/line.js"></script>
<script src="./data/polygon.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script src="leaflet-search-master/dist/leaflet-search.min.js"></script>
<script src="leaflet-search-master/dist/leaflet-search.src.js"></script>





<script>
    // Map initialization 
    //var map = L.map('map').setView([38.2466,21.7346], 200);
    var map = L.map('map', {doubleClickZoom: false}).locate({setView: true, maxZoom: 200});



    /*==============================================
                TILE LAYER and WMS
    ================================================*/
    //osm layer
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map);
    // map.addLayer(osm)

   
    //USER LOCATION
   //L.control.locate().addTo(map);

   map.addControl(L.control.locate({locateOptions: {enableHighAccuracy: true}}));


    // water color 
    var watercolor = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
        attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        subdomains: 'abcd',
        minZoom: 1,
        maxZoom: 16,
        ext: 'jpg'
    });
    // watercolor.addTo(map)

    // dark map 
    var dark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: 'abcd',
        maxZoom: 19
    });
    // dark.addTo(map)

    // google street 
    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    // googleStreets.addTo(map);

    //google satellite
    googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    // googleSat.addTo(map)

    var wms = L.tileLayer.wms("http://localhost:8080/geoserver/wms", {
        layers: 'geoapp:admin',
        format: 'image/png',
        transparent: true,
        attribution: "wms test"
    });



    /*==============================================
                        MARKER
    ================================================*/
    var myIcon = L.icon({
        iconUrl: 'https://e7.pngegg.com/pngimages/453/571/png-clipart-location-marker-logo-picture-material-creative-logo-thumbnail.png',
        //iconUrl: 'red_marker2.png',
        iconSize: [40, 40],
    });
   

$.ajax(
  'data.php', 
  {

      success: function(data){
        data = JSON.parse(data);

        let markersLayer = new L.LayerGroup().addTo(map);

for(let i in data) {
   console.log(data[i].popnow)
        let title = data[i].poiName;    //value searched
        let    lat = data[i].lat;

        let lng = data[i].lng;        //position found

        let myIcon;
        
        if(data[i].popnow > 65){
            myIcon = L.icon({
                iconUrl: "redm.png",
                iconAnchor: pinAnchor
            });
        }else if(data[i].popnow < 33){
            myIcon = L.icon({
                iconUrl: "greenm.png",
                iconAnchor: pinAnchor
            });
        }else{
 myIcon = L.icon({
                iconUrl: "orangem.png",
                iconAnchor: pinAnchor
            });
        }
    
        let    marker = new L.Marker(new L.latLng([lat,lng]), {title: title , clickable: false , icon: myIcon  } );//se property searched


     //   var popup = L.popup()
 //   .setContent(title + "<br><button> Submit Visit </button>" , onclick="myFunction()");
//marker.bindPopup(popup).openPopup();
      

// marker.bindPopup( title );
function addvisit(){

    $.post('data1.php', { field1: poiId, field2 :userId , field3:new Date()});

    }
marker.bindPopup( title + "<br><button type='Submit' onclick='addvisit()' class='btn' name='visit_btn'> Submit </button>" );


        markersLayer.addLayer(marker);
        marker.setOpacity(0);
      

    }
    map.addControl( new L.Control.Search({layer:markersLayer ,position:"topright",zoom:17})
    .on('search:locationfound', function({latlng, title, layer}){
        layer.setOpacity(1);
     
    }) );
 


      },
      error: function() {
        alert('There was some error performing the AJAX call!');
      }
    
   }    
);

function myFunction() {
 let button = $(this).title;
    console.log(button);
  
}
    /*==============================================
                GEOJSON
    ================================================*/
    var pointData = L.geoJSON(pointJson).addTo(map)
    var lineData = L.geoJSON(lineJson).addTo(map)
    var polygonData = L.geoJSON(polygonJson, {
        onEachFeature: function (feature, layer) {
            layer.bindPopup(`<b>Name: </b>` + feature.properties.name)
        },
        style: {
            fillColor: 'red',
            fillOpacity: 1,
            color: '#c0c0c0',
        }
    }).addTo(map);


    var btn = document.getElementById("myBtn");
    /*==============================================
                    LAYER CONTROL
    ================================================*/
    var baseMaps = {
        "OSM": osm,
        "Water color map": watercolor,
        'Dark': dark,
        'Google Street': googleStreets,
        "Google Satellite": googleSat,
    };
    var overlayMaps = {
        "First Marker": singleMarker,
        'Second Marker': secondMarker,
        'Point Data': pointData,
        'Line Data': lineData,
        'Polygon Data': polygonData,
        'wms': wms
    };
    // map.removeLayer(singleMarker)

    L.control.layers(baseMaps, overlayMaps, { collapsed: false }).addTo(map);
  

    /*==============================================
                    LEAFLET EVENTS
    ================================================*/
    map.on('mouseover', function () {
        console.log('your mouse is over the map')
    })

    map.on('mousemove', function (e) {
        document.getElementsByClassName('coordinate')[0].innerHTML = 'lat: ' + e.latlng.lat + 'lng: ' + e.latlng.lng;
        console.log('lat: ' + e.latlng.lat, 'lng: ' + e.latlng.lng)
    })


    /*==============================================
                    STYLE CUSTOMIZATION
    ================================================*/


</script>