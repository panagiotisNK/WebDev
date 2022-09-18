<?php
    $con = mysqli_connect('localhost', 'root', '', 'pois');

    $sql = "SELECT count(*) AS visitcount, DAYNAME(visitDate) AS dayy FROM visits WHERE visitDate BETWEEN DATE_ADD(CURRENT_DATE, INTERVAL -7 DAY) AND CURRENT_DATE GROUP BY dayy ";
    
    $result = mysqli_query($con, $sql);
   


    $data = array();

    foreach ($result as $row) {
        $data[] = $row;
    }

    $js_array=json_encode($data, JSON_UNESCAPED_UNICODE);

    echo  $js_array;

?>