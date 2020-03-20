<?php
include_once 'connect.php';

$std_id=$_POST['std_id'];
$password=$_POST['password'];

$sql = $dbcon->query("SELECT * FROM student_login WHERE std_id='$std_id' AND password='$password'");

if(mysqli_num_rows($sql) > 0){
    echo "login_ok";
}else{
    echo "login_error";  
}

?>