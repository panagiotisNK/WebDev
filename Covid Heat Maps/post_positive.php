<?php include('functions.php'); 


$query = "SELECT * FROM positive WHERE userId = '".$_SESSION['user']['id']."' ORDER BY userId DESC"; 
$result = mysqli_query($db, $query); 

$sql = "SELECT id FROM users WHERE username='".$_SESSION['user']['username']."' LIMIT 1";
$result1 = mysqli_query($db, $sql); 
$logged_in_user_id = mysqli_fetch_assoc($result1);
$userId = $logged_in_user_id["id"];



$sql1 = "SELECT visits.poiId,visits.visitDate,visits.visitTime,poi.poiName FROM visits INNER JOIN poi ON visits.poiId=poi.poiId WHERE visits.userId='$userId' ";
$result2 = mysqli_query($db, $sql1);  

$curr_visits=array();
$curr_poi=array();
$curr_date=array();
$curr_time=array();
$curr_poiNames=array();

if(mysqli_num_rows($result2)>0)
{
    while($row= mysqli_fetch_assoc($result2))
    {
        $curr_visits[]= $row;
        $curr_poi[]= $row['poiId'];
        $curr_date[]= $row['visitDate'];
        $curr_time[]=$row['visitTime'];
        $curr_poiNames[]=$row['poiName'];
    }
}



//echo $curr_poi;


$sql2= "SELECT visits.poiId,visits.visitDate,visits.visitTime FROM visits 
INNER JOIN positive ON visits.userId=positive.userId 
WHERE positive.userId <> '$userId'
AND (visits.visitDate >= positive.positivedate - INTERVAL 7 DAY)
AND (visits.visitDate >= positive.positivedate + INTERVAL 7 DAY)";

$result3 = mysqli_query($db, $sql2);

$positive_pois=array();
$positive_date=array();


if(mysqli_num_rows($result3)>0)
{
    while($row= mysqli_fetch_assoc($result3))
    {
        $positive_pois[]= $row['poiId'];
        $positive_date[]= $row['visitDate'];
        $positive_time[]= $row['visitTime'];
    }
}



$i=0;
$contacts=0;
$indexes=array();



foreach($curr_poi as $curr_store)
{ 
    $indexes= array_keys($positive_pois, $curr_store );
    
    if(!empty($indexes))
    {
        //echo"working";
        foreach($indexes as $index)
        {
            $myDate= date_create($curr_date[$i]);
            $myTime= date_create($curr_time[$i]);
            $posDate= date_create($positive_date[$index]);
            $posTime= date_create($positive_time[$index]);
            
            
            $datediff= $myDate->diff($posDate);
            $timediff= $myTime->diff($posTime);
            //echo $datediff->format('%R%a days');
            //echo $timediff;
            if( abs((intval($datediff->format("%r%a")))==0)  && (abs(intval($timediff->format("%r%h"))) <= 2) )
            {
                $contacts++;
            }
        }
        
    }

        $curr_visits[$i]['poiId']= $contacts;
        $contacts=0;
        $i++;
        
    
}


$JSON= json_encode($curr_visits,true);



echo $JSON;


?>