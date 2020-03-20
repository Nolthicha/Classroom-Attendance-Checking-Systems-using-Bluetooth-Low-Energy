<?php

$id = $_GET['id'];
//$std_token = $_GET['std_token'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laravel";

// Create connection
$conn = new mysqli($servername, $username,$password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 




$sql_query = $conn->query("SELECT day,time FROM tb_check WHERE DATE(day) = CURDATE() and id = $id");




$sql = "INSERT INTO tb_checkback(id,attend) VALUES ('$id','เข้าเรียน');";


if(mysqli_num_rows($sql_query) > 5){
    if($conn->query($sql)===TRUE){
        echo "find";
    }
}else{
    echo "error";  
}

$conn->close();
?>