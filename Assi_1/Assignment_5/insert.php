<?php include 'db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $id = $_POST['Id'];
    $pattern = "/^[a-zA-Z ]{1,30}$/";
    $Title = $_POST['Title'];
    $rating = $_POST['Rating'];
    // $office = $_POST['Office'];
    // $post = $_POST['Post'];

    // if (!(preg_match('/^[a-zA-Z0-9 ]{1,30}$/', $fname))) {
    //     echo "<script>alert('Invalid First Name')</script>";
    //     return;
    // }

    // if (!(preg_match($pattern, $lname))) {
    //     echo "<script>alert('Invalid Last Name')</script>";
    //     return;
    // }

    // if (!(preg_match($pattern, $office))) {
    //     echo "<script>alert('Invalid Office Name')</script>";
    //     return;
    // }
    // if (!(preg_match('/^[a-zA-Z0-9 ]{1,30}$/', $post))) {
    //     echo "<script>alert('Invalid Office Name')</script>";
    //     return;
    // }

    $sql = "INSERT INTO movie (Title, Rating) 
            VALUES ('$Title', $rating )";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_select = "SELECT * FROM movie";
$result = $conn->query($sql_select);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Title"] . "</td>
        <td>". $row["Rating"] . "</td></tr>";
    }
} else {
    echo "0 results";
}
