<?php

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "Assi_5";


$conn = new mysqli($servername, $username, $password,);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//creating database if exist
$createdb = "CREATE DATABASE IF NOT EXISTS $dbname";

if ($conn->query($createdb) === TRUE) {
} else {
  echo "Error creating database: " . $conn->error;
}
$conn->select_db($dbname);
$createtb = "CREATE TABLE IF NOT EXISTS movie (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Title VARCHAR(30),
    Rating INT
)";

if ($conn->query($createtb) === TRUE) {
} else {
  echo "Error creating table: " . $conn->error;
}
