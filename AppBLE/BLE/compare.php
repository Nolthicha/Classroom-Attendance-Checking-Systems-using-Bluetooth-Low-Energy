<?php

$std_id = $_GET['std_id'];
$std_token = $_GET['std_token'];
$std_esp32 = $_GET['std_esp32'];
$std_subject = $_GET['std_subject'];

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



$sql_query = $conn->query("SELECT * FROM esp32 WHERE esp32_token ='$std_token'ORDER BY id DESC LIMIT 1");



if($std_token != null){
    $sql = "INSERT INTO check_std(std_id,std_token,std_esp32,std_subject) VALUES ('$std_id','$std_token','$std_esp32','$std_subject');";
}


if(mysqli_num_rows($sql_query) > 0){
    if($conn->query($sql)===TRUE){
        echo "find";
    }
}else{
    echo "error";  
}

$conn->close();
?>