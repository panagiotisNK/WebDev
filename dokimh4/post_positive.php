<?php
   $con = mysqli_connect('localhost', 'root', '', 'pois');
   $date = $_POST['field1'];
   $userid = $_POST['field2'];
   
echo $

    $sql = "INSERT INTO positive (userId, positivetamp)
    VALUES ('$userid', '$date')";
    mysqli_query($con,$sql);
    
   ?>