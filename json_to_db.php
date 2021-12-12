<?php

$connect = mysqli_connect("localhost","root","","pois");

$filename="starting_pois.json";

$json_data= file_get_contents($filename);

$array= json_decode($json_data, true);

foreach ($array as $row) {

    $sql = "INSERT INTO poi(poiId,poiName,poiAddress,poiRating,poiRatingn,poiCurrPop) VALUES( '".$row["id"]."' , '".$row["name"]."' , '".$row["address"]."' , '".$row["rating"]."' , '".$row["rating_n"]."' , '".$row["current_popularity"]."' )";
    $sql1= "INSERT INTO poicoordinates(poiId,lat,lng) VALUES( ' ".$row["id"]." ' , '".$row["coordinates".$row["lat"]]."' , '".$row["lng"]."' )";
    
    mysqli_query($connect,$sql);
    mysqli_query($connect,$sql1);
}

echo "Data was inserted.";
?>