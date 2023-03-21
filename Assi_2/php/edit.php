<?php
include 'db-connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $conn->select_db($dbname);
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $userid = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("UPDATE posts SET user_id=?, title=?, description=? WHERE id=?");
    $stmt->bind_param("isss", $userid, $title, $description, $id);
    $stmt->execute();


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

        $return_arr[] = array("message" => "bhai kya kar raha hei tu");
    }
}
