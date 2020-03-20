<?php

include_once 'connect.php';

$std_id = $_POST['std_id'];

$name = $_POST['name'];
$password = $_POST['password'];

$sql1 = $dbcon->query("SELECT * FROM student_login WHERE std_id='$std_id'");

if(mysqli_num_rows($sql1) > 0){
    echo "id_error";
}else{
    $sql2 = $dbcon->query("INSERT INTO student_login(std_id,name,password) VALUES ('$std_id','$name','$password');");

    if($sql2){
        echo "register_ok";
    }else{
        echo "register_error";
    }
}

?>
