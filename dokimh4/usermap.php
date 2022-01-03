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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- leaflet css  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.0/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
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
				</ul>

				<!-- logged in user information -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <?php  if (isset($_SESSION['user'])) : ?>
					        <strong>
                                <i style="color: white;"> <?php echo $_SESSION['user']['username']; ?>
                            </strong>

					        <small>
    		    				<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
		    		    		<a href="usermap.php?logout='1'" style="color: red;">logout</a>
			        		</small>

		        		<?php endif ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<img src="images/user_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="usermap.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
    <h1 style="text-align:center;">This is your location!</h1>
    <div class="topnav">
    <form action="" method="post">
        <input type="text" placeholder="Search" name="search">
        <button type="submit" name="submit">Search</button>
    </form>
</div>
    <div id="map">
    
        <div class="leaflet-control coordinate"></div>
    </div>
    
    </div>
    
    <p>
		Change your profile <a href="changes.php">Here!</a>
	</p>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>


<!-- leaflet js  -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="./data/point.js"></script>
<script src="./data/line.js"></script>
<script src="./data/polygon.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>
    // Map initialization 
    var map = L.map('map').setView([38.2466,21.7346], 200);



    /*==============================================
                TILE LAYER and WMS
    ================================================*/
    //osm layer
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map);
    // map.addLayer(osm)

   /* //Search Panel
    var searchLayer = L.layerGroup().addTo(map);


    map.addControl( new L.Control.Search({layer: searchLayer}) );
   */
   
    //USER LOCATION
    L.control.locate().addTo(map);




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
   
<?php
   $con = mysqli_connect('localhost', 'root', '', 'pois');


    $query = mysqli_query($con,"SELECT poiName, lat, lng FROM poi INNER JOIN poiCoordinates ON poiCoordinates.poiId = poi.poiId");
            while ($data = mysqli_fetch_array($query))
            {
                $name = $data['poiName'];
                $lat = $data['lat'];
                $lon = $data['lng'];

            /*    echo("var marker = L.marker([ $lat, $lon]);
                marker.addTo(map);
                console.log(marker.toGeoJSON());
                marker.bindPopup('<b>$name</b>');");
                */
               
                /* echo("   let marker = L.marker( $lat, $lon),
                    {$name: name});     
                    marker.bindPopup($name);
                    marker.addTo(markersLayer);");*/
            }
               echo("L.Control.geocoder().addTo(map)");



          /*  if (isset($_POST['submit'])) {
                $searchValue = $_POST['search'];
                $con = new mysqli("localhost", "root", "", "pois");
                if ($con->connect_error) {
                    echo "connection Failed: " . $con->connect_error;
                } else {
                    $sql = "SELECT poiName, lat, lng FROM poi INNER JOIN poiCoordinates ON poiCoordinates.poiId = poi.poiId WHERE poiName LIKE '%$searchValue%' ";
            
                    while ($data = mysqli_fetch_array($query)){
                        $name = $data['poiName'];
                        $lat = $data['lat'];
                        $lon = $data['lng'];  
                        
                        //let marker = L.marker([ lat, lng]);
                        echo ("var marker = L.marker([ $lat, $lon]);
                        marker.addTo(map);
                        console.log(marker.toGeoJSON());
                        marker.bindPopup('<b>$name</b>');\n"); 
                    }
            
                  
                }   
            }*/

?>



let markersLayer = new L.LayerGroup();
mymap.addLayer(markersLayer);
let controlSearch = new L.Control.Search({
position: "topright",layer:markersLayer,
initial: false, zoom: 15,
marker: false});
mymap.addControl(controlSearch);


   /*var singleMarker = L.marker([38.246275, 21.734931], { icon: myIcon, draggable: false });
    var popup = singleMarker.bindPopup('Plateia Georgiou,Patras ' + singleMarker.getLatLng()).openPopup()
    popup.addTo(map);

    var secondMarker = L.marker([38.2218,21.7366], { icon: myIcon, draggable: true});

    console.log(singleMarker.toGeoJSON())
*/

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