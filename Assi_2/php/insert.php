<?php
include 'db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_POST['userId'];
    $Title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "CREATE TABLE IF NOT EXISTS posts (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id VARCHAR(10) NOT NULL,
        title VARCHAR(100) NOT NULL,
        description TEXT NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        // echo "Table posts created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $stmt = $conn->prepare("INSERT INTO posts (user_id, title, description) 
                             VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $userId, $Title, $description);
    if ($stmt->execute()) {
        $stmt->close();

        $stmt_select = $conn->prepare("SELECT * FROM posts");
        if ($stmt_select->execute()) {
            $result = $stmt_select->get_result();

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

            $stmt_select->close();
        } else {
            echo "Error selecting posts: " . $conn->error;
        }

    } else {
        echo "Error inserting post: " . $conn->error;
        $stmt->close();
    }
}
