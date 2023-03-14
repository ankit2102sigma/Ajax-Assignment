<?php

$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "table_add";


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
  $createtb = "CREATE TABLE IF NOT EXISTS employee (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    First_Name VARCHAR(15),
    Last_Name VARCHAR(15), 
    Office_name VARCHAR(15),
    Post VARCHAR(30)
)";

if ($conn->query($createtb) === TRUE) {
} else {
  echo "Error creating table: " . $conn->error;
}


  