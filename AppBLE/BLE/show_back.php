<?php

$std_id = $_GET['std_id'];

$con = mysqli_connect("localhost","root","","laravel");

$sql = "SELECT DISTINCT day FROM `check_std` WHERE std_id = $std_id";

$result = mysqli_query($con,$sql)or die(mysqli_error."<hr/>Line:".__LINE__."<br/>$sql");

while($rs = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $json[] = $rs;
}

header('Content-Type: application/json');
echo json_encode($json,JSON_UNESCAPED_UNICODE);

mysqli_free_result($result);
mysqli_close($con);

?>