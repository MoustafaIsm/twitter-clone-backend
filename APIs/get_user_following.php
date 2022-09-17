<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];

    $query = $conn->prepare("SELECT `u`.`id`, `u`.`username`, `u`.`name`
    FROM `following` AS f, `users` AS u
    WHERE `f`.`following_user_id`=`u`.`id`AND `f`.`user_id`=?");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();

    $response = [];

    while($row = $result->fetch_assoc()) {
        $response["following"][] = $row;
    }

    echo json_encode($response);
?>