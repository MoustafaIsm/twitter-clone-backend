<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];

    $query = $conn->prepare("SELECT `u`.`username`, `u`.`name` FROM `users` AS u, `blocked` AS b WHERE `u`.`id`=`b`.`user_id` AND `b`.`blocked_user_id`=?");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();

    $response = [];

    while($row = $result->fetch_assoc()) {
        $response["blocked-users"][] = $row;
    }

    echo json_encode($response);
?>