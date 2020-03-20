<?php
//$stdid = $_GET['stdid'];
//$std_key = $_GET['std_key'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laravel";


$dbcon = new MySQLi("$servername","$username","$password","$dbname");

if($dbcon->connect_error){
    echo "connect_error";
}/*else{
    echo "connect_ok";
}*/


?>
