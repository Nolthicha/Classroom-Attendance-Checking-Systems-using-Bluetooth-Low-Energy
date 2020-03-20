<?php


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
$val = $_GET['esp32_token'];
$name = $_GET['esp32_name'];
$room = $_GET['room'];

$sql = "INSERT INTO esp32(esp32_token,esp32_name,room) VALUES ('$val','$name','$room');"; //esp32 is DB table

if ($conn->query($sql) === TRUE) {
    echo "save OK";
} else {
    echo "Error:" . $sql . "<br>" . $conn->error;
}

$conn->close();
?>