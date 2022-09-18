<?php
    $con = mysqli_connect('localhost', 'root', '', 'pois');


    $sql = "SELECT count(*) AS countt, poiType FROM positive INNER JOIN visits ON visits.userId = positive.userId INNER JOIN poitypes ON poitypes.poiId = visits.poiId WHERE positiveDate BETWEEN DATE_ADD(CURRENT_DATE, INTERVAL -7 DAY) AND DATE_ADD(CURRENT_DATE, INTERVAL 14 DAY) GROUP BY poiType ORDER BY countt DESC;";

    $result = mysqli_query($con, $sql);

    $data = array();

    foreach ($result as $row) {
        $data[] = $row;
    }

    
    $js_array=json_encode($data, JSON_UNESCAPED_UNICODE);
    
    echo  $js_array;
?>