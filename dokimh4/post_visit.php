
<?php
   $con = mysqli_connect('localhost', 'root', '', 'pois');
   $poiid = $_POST['field1'] ;
   $userid = $_POST['field2'];
   $date = $_POST['field3'];


    $sql = "INSERT INTO visits (poiId, userId, visitStamp)
    VALUES ('$poiid', '$userid', '$date')";
    
   ?>