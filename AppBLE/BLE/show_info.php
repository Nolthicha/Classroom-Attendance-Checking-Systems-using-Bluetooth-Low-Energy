<?php

$std_id = $_GET['std_id'];

$con = mysqli_connect("localhost","root","","laravel");

$sql = "SELECT * FROM check_std WHERE DATE(day) = CURDATE() and std_id = $std_id";
//$sql = "SELECT * FROM tb_check WHERE (day between '2020-02-03' and '2020-02-04')";
//$sql = "SELECT * FROM tb_check WHERE id IN (SELECT id FROM tb_check WHERE current_date between 2020-01-13 and 2020-01-14)";
//$sql = "SELECT * FROM tb_check WHERE id = '$id'";

$result = mysqli_query($con,$sql)or die(mysqli_error."<hr/>Line:".__LINE__."<br/>$sql");

while($rs = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $json[] = $rs;
}

header('Content-Type: application/json');
echo json_encode($json,JSON_UNESCAPED_UNICODE);

mysqli_free_result($result);
mysqli_close($con);

?>