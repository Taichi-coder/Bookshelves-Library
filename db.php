<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "books_management";

$linking = mysqli_connect($servername, $username, $password, $db_name);

if($linking->connect_error) {
    die("connection failed");
} 

?>