<?php
include  'db-connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['Id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $office = $_POST['Office'];
    $post = $_POST['Post'];

    $sql = "INSERT INTO employee (First_Name, Last_Name, Office_name, Post) 
            VALUES ('$fname', '$lname', '$office', '$post')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$sql_select = "SELECT * FROM employee";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    // echo "<table><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Office Name</th><th>Post</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["First_Name"] . "</td><td>" 
        . $row["Last_Name"] . "</td><td>" . $row["Office_name"] 
        . "</td><td>" . $row["Post"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
