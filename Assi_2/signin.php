<?php

include 'db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Insert the user data into the database
$sql = "INSERT INTO users (first_name, last_name, email, password) 
VALUES ('$firstName', '$lastName', '$email', '$password')";
mysqli_query($conn, $sql);

$return_arr[] = array(
    "sucess" => true,
    "message" => "Hoo raha hei bro",
);

echo json_encode($return_arr);

}
