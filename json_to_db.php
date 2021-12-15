<?php

$connect = mysqli_connect("localhost","root","","pois");

$filename="starting_pois.json";

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

for($j=0; $j<=sizeof($popTimes_array)-1; $j++)
{

$sql_popTimes= "INSERT INTO populartimes(poiId,day) VALUES('".$row["id"]."' ,'".$row["populartimes"][$j]["name"]."')"; 

mysqli_query($connect,$sql_popTimes); 

for($k=0; $k<=23; $k++)
{
    $sql_poiData_1="INSERT INTO poidata(poiId,dataDay,dataVal0) VALUES('".$row["id"]."' ,'".$row["populartimes"][$j]["name"]."','".$row["populartimes"][$j]["data"][$k]."')";
    mysqli_query($connect,$sql_poiData_1); 
}

}


/*for($j=0; $j<=sizeof($popTimes_array)-1; $j++)
{

$sql_popTimes= "INSERT INTO populartimes(poiId,day) VALUES('".$row["id"]."' ,'".$row["populartimes"][$j]["name"]."')"; 
$sql_poiData="INSERT INTO poidata(poiId,dataDay) VALUES('".$row["id"]."' ,'".$row["populartimes"][$j]["name"]."')";

$sql_poiData0="INSERT INTO poidata(dataVal0) VALUES('".$row["populartimes"][$j]["data"][0]."')";
$sql_poiData1="INSERT INTO poidata(dataVal1) VALUES('".$row["populartimes"][$j]["data"][1]."')";
$sql_poiData2="INSERT INTO poidata(dataVal2) VALUES('".$row["populartimes"][$j]["data"][2]."')";
$sql_poiData3="INSERT INTO poidata(dataVal3) VALUES('".$row["populartimes"][$j]["data"][3]."')";
$sql_poiData4="INSERT INTO poidata(dataVal4) VALUES('".$row["populartimes"][$j]["data"][4]."')";
$sql_poiData5="INSERT INTO poidata(dataVal5) VALUES('".$row["populartimes"][$j]["data"][5]."')";
$sql_poiData6="INSERT INTO poidata(dataVal6) VALUES('".$row["populartimes"][$j]["data"][6]."')";
$sql_poiData7="INSERT INTO poidata(dataVal7) VALUES('".$row["populartimes"][$j]["data"][7]."')";
$sql_poiData8="INSERT INTO poidata(dataVal8) VALUES('".$row["populartimes"][$j]["data"][8]."')";
$sql_poiData9="INSERT INTO poidata(dataVal9) VALUES('".$row["populartimes"][$j]["data"][9]."')";
$sql_poiData10="INSERT INTO poidata(dataVal10) VALUES('".$row["populartimes"][$j]["data"][10]."')";
$sql_poiData11="INSERT INTO poidata(dataVal11) VALUES('".$row["populartimes"][$j]["data"][11]."')";
$sql_poiData12="INSERT INTO poidata(dataVal12) VALUES('".$row["populartimes"][$j]["data"][12]."')";
$sql_poiData13="INSERT INTO poidata(dataVal13) VALUES('".$row["populartimes"][$j]["data"][13]."')";
$sql_poiData14="INSERT INTO poidata(dataVal14) VALUES('".$row["populartimes"][$j]["data"][14]."')";
$sql_poiData15="INSERT INTO poidata(dataVal15) VALUES('".$row["populartimes"][$j]["data"][15]."')";
$sql_poiData16="INSERT INTO poidata(dataVal16) VALUES('".$row["populartimes"][$j]["data"][16]."')";
$sql_poiData17="INSERT INTO poidata(dataVal17) VALUES('".$row["populartimes"][$j]["data"][17]."')";
$sql_poiData18="INSERT INTO poidata(dataVal18) VALUES('".$row["populartimes"][$j]["data"][18]."')";
$sql_poiData19="INSERT INTO poidata(dataVal19) VALUES('".$row["populartimes"][$j]["data"][19]."')";
$sql_poiData20="INSERT INTO poidata(dataVal20) VALUES('".$row["populartimes"][$j]["data"][20]."')";
$sql_poiData21="INSERT INTO poidata(dataVal21) VALUES('".$row["populartimes"][$j]["data"][21]."')";
$sql_poiData22="INSERT INTO poidata(dataVal22) VALUES('".$row["populartimes"][$j]["data"][22]."')";
$sql_poiData23="INSERT INTO poidata(dataVal23) VALUES('".$row["populartimes"][$j]["data"][23]."')";

mysqli_query($connect,$sql_popTimes); 
mysqli_query($connect,$sql_poiData);
mysqli_query($connect,$sql_poiData0);
mysqli_query($connect,$sql_poiData1);
mysqli_query($connect,$sql_poiData2);
mysqli_query($connect,$sql_poiData3);
mysqli_query($connect,$sql_poiData4);
mysqli_query($connect,$sql_poiData5);
mysqli_query($connect,$sql_poiData6);
mysqli_query($connect,$sql_poiData7);
mysqli_query($connect,$sql_poiData8);
mysqli_query($connect,$sql_poiData9);
mysqli_query($connect,$sql_poiData10);
mysqli_query($connect,$sql_poiData11);
mysqli_query($connect,$sql_poiData12);
mysqli_query($connect,$sql_poiData13);
mysqli_query($connect,$sql_poiData14);
mysqli_query($connect,$sql_poiData15);
mysqli_query($connect,$sql_poiData16);
mysqli_query($connect,$sql_poiData17);
mysqli_query($connect,$sql_poiData18);
mysqli_query($connect,$sql_poiData19);
mysqli_query($connect,$sql_poiData20);
mysqli_query($connect,$sql_poiData21);
mysqli_query($connect,$sql_poiData22);
mysqli_query($connect,$sql_poiData23);
}*/



}






echo "Data was inserted.";
?>



