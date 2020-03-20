<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appstd";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE customer1(
    cust_code char(6) NOT NULL PRIMARY KEY,
    cust_name char(25),
    cust_city char(25),
    agent_code char(6),
    FOREIGN KEY(agent_code)
    REFERENCES MyGuests (id)
)";


    




if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>