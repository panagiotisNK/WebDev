<?php 
$con=mysqli_connect("localhost","root","","pois");

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

	<link rel="stylesheet" type="text/css" href="style5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/ilmudetil.css">
    <script src='assets/js/jquery-1.10.1.min.js'></script>       
    <script src="assets/js/bootstrap.min.js"></script>
    
 
   <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHbdxQVNp0d0Soh_jPrUCOKI5PYJblGLU&callback=initMap"async defer></script>-->

   <script src="http://maps.google.com/maps/api/js?sensor=false"></script> 

    
    <script>
        
    var marker;
      function initialize() {
        var infoWindow = new google.maps.InfoWindow;
        
        var mapOptions = {
          mapTypeId: google.maps.MapTypeId.ROADMAP
        } 
 
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var bounds = new google.maps.LatLngBounds();

        // Retrieve data from database
        <?php
            $query = mysqli_query($con,"SELECT poiName, lat, lng FROM poi INNER JOIN poiCoordinates ON poiCoordinates.poiId = poi.poiId");
            while ($data = mysqli_fetch_array($query))
            {
                $nama = $data['poiName'];
                $lat = $data['lat'];
                $lon = $data['lng'];
                
                echo ("addMarker($lat, $lon, '<b>$nama</b>');\n");                      
            }
        ?>
          
        // Proses of making marker 
        function addMarker(lat, lng, info) {
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: map,
                position: lokasi
            });       
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
         }
        
        // Displays information on markers that are clicked
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }
 
        }
      google.maps.event.addDomListener(window, 'load', initialize);
    
    </script>
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
		<!-- logged in user information 
		<div class="profile_info">
			<img src="images/user_profile.png">

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
		</div>-->
	</div>
    <h1 style="text-align:center;">This is your location!</h1>
    <div class="topnav">
  <a class="active" href="#home"></a>
  
  <input type="text" placeholder="SEARCH A POI...">
  <button type="submit"><i class="fa fa-search"></i></button>
</div>
<div class="container" style="margin-top:10px"> 

<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Marker Google Maps</div>
                <div class="panel-body">
                    <div id="map-canvas" style="width: 700px; height: 600px;"></div>
                </div>
        </div>
    </div>  
</div>
</div>  
    
</div>
<!--
<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHbdxQVNp0d0Soh_jPrUCOKI5PYJblGLU&callback=initMap"
	async defer></script>
<script type="text/javascript">
var map;
function initMap() {
	var mapLayer = document.getElementById("map-layer");
	var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
	var defaultOptions = { center: centerCoordinates, zoom: 4 }

	map = new google.maps.Map(mapLayer, defaultOptions);
}

function locate(){
	document.getElementById("btnAction").disabled = true;
	document.getElementById("btnAction").innerHTML = "Processing...";
	if ("geolocation" in navigator){
		navigator.geolocation.getCurrentPosition(function(position){ 
			var currentLatitude = position.coords.latitude;
			var currentLongitude = position.coords.longitude;

			var infoWindowHTML = "Latitude: " + currentLatitude + "<br>Longitude: " + currentLongitude;
			var infoWindow = new google.maps.InfoWindow({map: map, content: infoWindowHTML});
			var currentLocation = { lat: currentLatitude, lng: currentLongitude };
			infoWindow.setPosition(currentLocation);
			document.getElementById("btnAction").style.display = 'none';
		});
	}
}
</script>-->

</body>
</html>

