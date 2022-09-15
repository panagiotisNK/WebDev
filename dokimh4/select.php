
<?php
   $con = mysqli_connect('localhost', 'root', '', 'pois');

    $theDate    = new DateTime();

    $Date = $theDate->format('l');
//echo $Date;
    $stringDate = $theDate->format('H')%24;
    //echo $stringDate1;
    $stringDate1 = ($theDate->format('H')+1)%24;
   
   // $sql ="SELECT userId, poiName, poi.poiId, lat, lng, dataVal$stringDate AS popnow FROM visits INNER JOIN poi ON poi.poiId = visits.poiId INNER JOIN poiCoordinates ON poiCoordinates.poiId = visits.poiId INNER JOIN populartimes ON populartimes.poiId = poiCoordinates.poiId INNER JOIN users ON users.id = visits.userId"; 
    //$sql = "SELECT poiName, lat, lng, poi.poiId AS poinow, dataVal$stringDate AS popnow, dataVal$stringDate1 AS popnow1 FROM poi INNER JOIN poiCoordinates ON poiCoordinates.poiId = poi.poiId INNER JOIN populartimes ON populartimes.poiId=poiCoordinates.poiId"; 
    $sql = "SELECT poiName, lat, lng, poi.poiId AS poinow, dataVal$stringDate AS popnow, dataVal$stringDate AS popnow1, AVG(visits.visitEstimate) AS averageEstimate FROM poi LEFT JOIN visits ON poi.poiId=visits.poiId INNER JOIN poiCoordinates ON poiCoordinates.poiId = poi.poiId INNER JOIN populartimes ON populartimes.poiId=poiCoordinates.poiId GROUP BY poi.poiId ";

    $result = mysqli_query($con,$sql);
 
    $json_array = array();
   
    while($row = mysqli_fetch_assoc($result) )
    {
        $json_array[]=$row;
        
    }

    

    
    $js_array=json_encode($json_array,JSON_UNESCAPED_UNICODE);
    
    echo  ("$js_array");
    
              
?>
