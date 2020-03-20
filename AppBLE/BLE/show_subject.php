<?php



$con = mysqli_connect("localhost","root","","laravel");

//$sql = "SELECT * FROM `laravel`.`subject` WHERE `id` = 3 ORDER BY `created_at` ASC";
$sql = "SELECT * FROM webble WHERE DATE(date_ble) = CURDATE()";

$result = mysqli_query($con,$sql)or die(mysqli_error."<hr/>Line:".__LINE__."<br/>$sql");

while($rs = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $json[] = $rs;
}

header('Content-Type: application/json');
echo json_encode($json,JSON_UNESCAPED_UNICODE);

mysqli_free_result($result);
mysqli_close($con);

?>