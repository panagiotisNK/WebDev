<?php
   $con = mysqli_connect('localhost', 'root', '', 'pois');
   $date = $_POST['field1'];
   $userid = $_POST['field2'];
   


    $sql = "INSERT INTO positive (userId, positivetamp)
    VALUES ('$userid', '$date')";
    
    
   ?>