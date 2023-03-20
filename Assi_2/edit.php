<?php

include 'db-connection.php';

$dbname = "User_data";
$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

$sql = "UPDATE posts SET id='$id', 
Title='$title', description='$description' WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    echo 'success';
} else {
    echo 'error';
}
