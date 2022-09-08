
<?php
   $con = mysqli_connect('localhost', 'root', '', 'pois');
   $poiid = $_GET['field1'] ;
   
echo $poid;

    $sql = "INSERT INTO visits (poiId,userId)
    VALUES ('$poiid',56)";
mysqli_query($con,$sql);
    
   ?>