<?php include 'db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_POST['userId'];
    $Title = $_POST['title'];
    $description = $_POST['description'];
    
    $sql = "CREATE TABLE IF NOT EXISTS posts (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED,
        title VARCHAR(100) NOT NULL,
        description TEXT NOT NULL
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table posts created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
    
    

    $sql = "INSERT INTO posts (user_id, title, description) 
    VALUES ('$userId', '$Title', '$description')";


    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $sql_select = "SELECT * FROM posts";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $id = $row['id'];
            $userId = $row['user_id'];
            $title = $row["title"];
            $description = $row["description"];

            $return_arr[] = array(
                "id" => $id,
                "user_id" => $userId,
                "Title" => $title,
                "description" => $description
            );
        }
        echo json_encode($return_arr);
    } else {
        echo "0 results";
    }
}
