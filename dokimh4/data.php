
<?php
   $con = mysqli_connect('localhost', 'root', '', 'pois');

    $theDate    = new DateTime();
    $stringDate = $theDate->format('H');
    $sql = "SELECT poiName,poiId, lat, lng, dataVal$stringDate AS popnow FROM poi INNER JOIN poiCoordinates ON poiCoordinates.poiId = poi.poiId INNER JOIN populartimes ON populartimes.poiId=poiCoordinates.poiId"; 
    $result = mysqli_query($con,$sql);
    $json_array = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $json_array[]=$row;
    }
    
    $js_array=json_encode($json_array,JSON_UNESCAPED_UNICODE);
    echo  ("$js_array");
              
?>
