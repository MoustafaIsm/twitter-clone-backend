<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];

    $query = $conn->prepare("SELECT `u`.`id`, `u`.`username`, `u`.`name`, `u`.`profile_picture_link` FROM `users` AS u, `blocked` AS b WHERE `u`.`id`=`b`.`blocked_user_id` AND `b`.`user_id`=?");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();

    $response = [];

    while($row = $result->fetch_assoc()) {
        $response["blocked_users"][] = $row;
    }

    echo json_encode($response);
?>