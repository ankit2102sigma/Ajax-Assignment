<?php
include  'db-connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['Id'];
    $fname = $_POST['fname'];
    $lname = $_POST['Lname'];
    $office = $_POST['Office'];
    $post = $_POST['Post'];

    $sql = "INSERT INTO employee (id, First_Name, Last_Name, Office_name, Post) 
            VALUES ('$id', '$fname', '$lname', '$office', '$post')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
    
   


