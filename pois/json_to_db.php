<?php

$connect = mysqli_connect("localhost","root","","pois");

$filename="starting_pois.json";

$json_data= file_get_contents($filename);

$array= json_decode($json_data, true);

foreach ($array as $row) 
{

$type_array = array_column($row["types"],NULL,NULL);
    

$sql_basics = "INSERT INTO poi(poiId,poiName,poiAddress,poiRating,poiRatingn,poiCurrPop) VALUES( '".$row["id"]."' , '".$row["name"]."' , '".$row["address"]."' , '".$row["rating"]."' , '".$row["rating_n"]."' , '".$row["current_popularity"]."' )";
$sql_coordinates= "INSERT INTO poicoordinates(poiId,lat,lng) VALUES( '".$row["id"]."' , '".$row["coordinates"]["lat"]."' , '".$row["coordinates"]["lng"]."' )";

    
mysqli_query($connect,$sql_basics);
mysqli_query($connect,$sql_coordinates);
for($i =0; $i <=sizeof($type_array)-1; $i++) 
{
$sql_types= "INSERT INTO poitypes(poiId,poiType) VALUES( '".$row["id"]."' , '".$row["types"][$i]."' )";
mysqli_query($connect,$sql_types);
}

}


echo "Data was inserted.";
?>



