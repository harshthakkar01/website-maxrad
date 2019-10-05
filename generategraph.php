<?php

header('Content-Type: application/json');
include('accessdb.php');
include('accesscontrol.php');

$data_points=array();


while($row=mysqli_fetch_array($result)){
$point = array("x"=> $row['x'], "y"=> $row['y']);
array_push($data_points, $point);
}

print json_encode($data_points);
