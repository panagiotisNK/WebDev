<?php
    $con = mysqli_connect('localhost', 'root', '', 'pois');


    $sql = "SELECT count(*) AS countt, poiType FROM visits INNER JOIN poitypes ON visits.poiId = poitypes.poiId GROUP BY poiType ORDER BY countt DESC;";

    $result = mysqli_query($con, $sql);

    $data = array();

    foreach ($result as $row) {
        $data[] = $row;
    }

    
    $js_array=json_encode($data, JSON_UNESCAPED_UNICODE);
    
    echo  $js_array;
?>