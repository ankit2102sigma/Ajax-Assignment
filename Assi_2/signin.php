<?php 
include 'db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conn->select_db($dbname);

    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 1) {
        $return_arr[] = array(
            "success" => false,
            "message" => "Email already exists",
        );
        echo json_encode($return_arr);
        return;
    } else {

        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) 
        VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $password);
        $stmt->execute();

        $return_arr[] = array(
            "success" => true,
            "message" => "User created successfully",
        );

        echo json_encode($return_arr);
    }
}
