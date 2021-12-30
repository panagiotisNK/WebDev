<?php

$connect = mysqli_connect("localhost","root","","pois");

$filename="starting_pois(scuffed).json";

$json_data= file_get_contents($filename);

$array= json_decode($json_data, true);

foreach ($array as $row) 
{

$type_array = array_column($row["types"],NULL,NULL);
$popTimes_array = array_column($row["populartimes"],NULL,NULL);
$data_array = array_column($row["populartimes"][0]["data"],NULL,NULL);

    

$sql_basics = "INSERT INTO poi(poiId,poiName,poiAddress,poiRating,poiRatingn,poiCurrPop) VALUES( '".$row["id"]."' , '".$row["name"]."' , '".$row["address"]."' , '".$row["rating"]."' , '".$row["rating_n"]."' , '".$row["current_popularity"]."' )";
$sql_coordinates= "INSERT INTO poicoordinates(poiId,lat,lng) VALUES( '".$row["id"]."' , '".$row["coordinates"]["lat"]."' , '".$row["coordinates"]["lng"]."' )";

    
mysqli_query($connect,$sql_basics);
mysqli_query($connect,$sql_coordinates);

for($i =0; $i<=sizeof($type_array)-1; $i++) 
{
$sql_types= "INSERT INTO poitypes(poiId,poiType) VALUES( '".$row["id"]."' , '".$row["types"][$i]."' )";
mysqli_query($connect,$sql_types);
}


for($j=0; $j<=6; $j++)
{
$sql_poiData="INSERT INTO populartimes(poiId,dataDay,dataVal0,dataVal1,dataVal2,dataVal3,dataVal4,dataVal5,dataVal6,dataVal7,dataVal8,dataVal9,dataVal10,dataVal11,dataVal12,dataVal13,dataVal14,dataVal15,dataVal16,dataVal17,dataVal18,dataVal19,dataVal20,dataVal21,dataVal22,dataVal23) VALUES('".$row["id"]."' ,'".$row["populartimes"][$j]["name"]."','".$row["populartimes"][$j]["data"][0]."','".$row["populartimes"][$j]["data"][1]."','".$row["populartimes"][$j]["data"][2]."','".$row["populartimes"][$j]["data"][3]."','".$row["populartimes"][$j]["data"][4]."','".$row["populartimes"][$j]["data"][5]."','".$row["populartimes"][$j]["data"][6]."','".$row["populartimes"][$j]["data"][7]."','".$row["populartimes"][$j]["data"][8]."','".$row["populartimes"][$j]["data"][9]."','".$row["populartimes"][$j]["data"][10]."','".$row["populartimes"][$j]["data"][11]."','".$row["populartimes"][$j]["data"][12]."','".$row["populartimes"][$j]["data"][13]."','".$row["populartimes"][$j]["data"][14]."','".$row["populartimes"][$j]["data"][15]."','".$row["populartimes"][$j]["data"][16]."','".$row["populartimes"][$j]["data"][17]."','".$row["populartimes"][$j]["data"][18]."','".$row["populartimes"][$j]["data"][19]."','".$row["populartimes"][$j]["data"][20]."','".$row["populartimes"][$j]["data"][21]."','".$row["populartimes"][$j]["data"][22]."','".$row["populartimes"][$j]["data"][23]."')";
mysqli_query($connect,$sql_poiData);
}

}

//

$filename="generic.json";

$json_data= file_get_contents($filename);

$array= json_decode($json_data, true);

foreach ($array as $row) 
{

$type_array = array_column($row["types"],NULL,NULL);
$popTimes_array = array_column($row["populartimes"],NULL,NULL);
$data_array = array_column($row["populartimes"][0]["data"],NULL,NULL);

    

$sql_basics = "INSERT INTO poi(poiId,poiName,poiAddress,poiRating,poiRatingn,poiCurrPop) VALUES( '".$row["id"]."' , '".$row["name"]."' , '".$row["address"]."' , '".$row["rating"]."' , '".$row["rating_n"]."' , '".$row["current_popularity"]."' )";
$sql_coordinates= "INSERT INTO poicoordinates(poiId,lat,lng) VALUES( '".$row["id"]."' , '".$row["coordinates"]["lat"]."' , '".$row["coordinates"]["lng"]."' )";

    
mysqli_query($connect,$sql_basics);
mysqli_query($connect,$sql_coordinates);

for($i =0; $i<=sizeof($type_array)-1; $i++) 
{
$sql_types= "INSERT INTO poitypes(poiId,poiType) VALUES( '".$row["id"]."' , '".$row["types"][$i]."' )";
mysqli_query($connect,$sql_types);
}


for($j=0; $j<=6; $j++)
{
$sql_poiData="INSERT INTO populartimes(poiId,dataDay,dataVal0,dataVal1,dataVal2,dataVal3,dataVal4,dataVal5,dataVal6,dataVal7,dataVal8,dataVal9,dataVal10,dataVal11,dataVal12,dataVal13,dataVal14,dataVal15,dataVal16,dataVal17,dataVal18,dataVal19,dataVal20,dataVal21,dataVal22,dataVal23) VALUES('".$row["id"]."' ,'".$row["populartimes"][$j]["name"]."','".$row["populartimes"][$j]["data"][0]."','".$row["populartimes"][$j]["data"][1]."','".$row["populartimes"][$j]["data"][2]."','".$row["populartimes"][$j]["data"][3]."','".$row["populartimes"][$j]["data"][4]."','".$row["populartimes"][$j]["data"][5]."','".$row["populartimes"][$j]["data"][6]."','".$row["populartimes"][$j]["data"][7]."','".$row["populartimes"][$j]["data"][8]."','".$row["populartimes"][$j]["data"][9]."','".$row["populartimes"][$j]["data"][10]."','".$row["populartimes"][$j]["data"][11]."','".$row["populartimes"][$j]["data"][12]."','".$row["populartimes"][$j]["data"][13]."','".$row["populartimes"][$j]["data"][14]."','".$row["populartimes"][$j]["data"][15]."','".$row["populartimes"][$j]["data"][16]."','".$row["populartimes"][$j]["data"][17]."','".$row["populartimes"][$j]["data"][18]."','".$row["populartimes"][$j]["data"][19]."','".$row["populartimes"][$j]["data"][20]."','".$row["populartimes"][$j]["data"][21]."','".$row["populartimes"][$j]["data"][22]."','".$row["populartimes"][$j]["data"][23]."')";
mysqli_query($connect,$sql_poiData);
}

}

//

$filename="specific.json";

$json_data= file_get_contents($filename);

$array= json_decode($json_data, true);

foreach ($array as $row) 
{

$type_array = array_column($row["types"],NULL,NULL);
$popTimes_array = array_column($row["populartimes"],NULL,NULL);
$data_array = array_column($row["populartimes"][0]["data"],NULL,NULL);

    

$sql_basics = "INSERT INTO poi(poiId,poiName,poiAddress,poiRating,poiRatingn,poiCurrPop) VALUES( '".$row["id"]."' , '".$row["name"]."' , '".$row["address"]."' , '".$row["rating"]."' , '".$row["rating_n"]."' , '".$row["current_popularity"]."' )";
$sql_coordinates= "INSERT INTO poicoordinates(poiId,lat,lng) VALUES( '".$row["id"]."' , '".$row["coordinates"]["lat"]."' , '".$row["coordinates"]["lng"]."' )";

    
mysqli_query($connect,$sql_basics);
mysqli_query($connect,$sql_coordinates);

for($i =0; $i<=sizeof($type_array)-1; $i++) 
{
$sql_types= "INSERT INTO poitypes(poiId,poiType) VALUES( '".$row["id"]."' , '".$row["types"][$i]."' )";
mysqli_query($connect,$sql_types);
}


for($j=0; $j<=6; $j++)
{
$sql_poiData="INSERT INTO populartimes(poiId,dataDay,dataVal0,dataVal1,dataVal2,dataVal3,dataVal4,dataVal5,dataVal6,dataVal7,dataVal8,dataVal9,dataVal10,dataVal11,dataVal12,dataVal13,dataVal14,dataVal15,dataVal16,dataVal17,dataVal18,dataVal19,dataVal20,dataVal21,dataVal22,dataVal23) VALUES('".$row["id"]."' ,'".$row["populartimes"][$j]["name"]."','".$row["populartimes"][$j]["data"][0]."','".$row["populartimes"][$j]["data"][1]."','".$row["populartimes"][$j]["data"][2]."','".$row["populartimes"][$j]["data"][3]."','".$row["populartimes"][$j]["data"][4]."','".$row["populartimes"][$j]["data"][5]."','".$row["populartimes"][$j]["data"][6]."','".$row["populartimes"][$j]["data"][7]."','".$row["populartimes"][$j]["data"][8]."','".$row["populartimes"][$j]["data"][9]."','".$row["populartimes"][$j]["data"][10]."','".$row["populartimes"][$j]["data"][11]."','".$row["populartimes"][$j]["data"][12]."','".$row["populartimes"][$j]["data"][13]."','".$row["populartimes"][$j]["data"][14]."','".$row["populartimes"][$j]["data"][15]."','".$row["populartimes"][$j]["data"][16]."','".$row["populartimes"][$j]["data"][17]."','".$row["populartimes"][$j]["data"][18]."','".$row["populartimes"][$j]["data"][19]."','".$row["populartimes"][$j]["data"][20]."','".$row["populartimes"][$j]["data"][21]."','".$row["populartimes"][$j]["data"][22]."','".$row["populartimes"][$j]["data"][23]."')";
mysqli_query($connect,$sql_poiData);
}

}



echo "Data was inserted.";
?>



