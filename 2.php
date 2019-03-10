


<?php
header('Content-Type: application/json');

$con = mysqli_connect("localhost","root","gfybrth6","block_scanner");

if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{
    $data_points = array();
    
    $result = mysqli_query($con, "SELECT * FROM blocks");
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = ("block" => $row['id'], "blocktime" => $row['blocktime']);
        
        array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}

mysqli_close($con);

?>

var_dump($json_decode);

// , "systime" => $row['systimegentime'], "timestamp" => $row['gentimestamp']