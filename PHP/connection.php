<?php

// Database Connection
$host = "localhost";
$username = "root";
$password = "";
$database = "crud_db";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    //echo "Connection Successful!";
}
