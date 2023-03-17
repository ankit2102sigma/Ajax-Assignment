<?php

include 'db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email'];
    $password = $_POST['password'];

    $conn->select_db($dbname);

    $query = "SELECT `email`,`password` FROM users";
    $result = $conn->query($query);

    if ($result === false) {
        // display any database errors
        echo 'Error: ' . mysqli_error($conn);
        exit;
    }

    // fetch all rows into an array
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    if (checkusername($rows, $username)) {
        if (checkpassword($rows, $password)) {
            $return_arr[] = array(
                "success" => true
            );
            echo json_encode($return_arr);
            die();
        } else {
            echo '<script>alert("Invalid password"); window.location.href = "index.php";</script>';
            exit;
        }
    } else {
        echo '<script>alert("Invalid Username"); window.location.href = "index.php";</script>';
        exit;
    }
}

function checkpassword($rows, $password)
{
    foreach ($rows as $row) {
        if ($row["password"] == $password) {
            return true;
        }
    }
    return false;
}

function checkusername($rows, $username)
{
    foreach ($rows as $row) {
        if ($row["email"] == $username) {
            return true;
        }
    }
    return false;
}
