<?php

include 'db.php';

$id = $_GET['id'];

$delete = "DELETE FROM books  WHERE id = '$id' ";

if(mysqli_query($linking, $delete) === true){
    header('Location:index2.php');
    exit;
}else{
    echo "Error";
} 
?> 