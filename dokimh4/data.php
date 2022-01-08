
<?php

$con = mysqli_connect('localhost', 'root', '', 'pois');

$sql = "SELECT poiId, lat, lng FROM poiCoordinates"; 
$result = mysqli_query($con,$sql);
$json_array = array();
while($row = mysqli_fetch_assoc($result))
{
    $json_array[]=$row;
}

$js_array=json_encode($json_array,JSON_UNESCAPED_UNICODE);
echo("$js_array");

?>