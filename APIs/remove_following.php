<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];
    $followingUserId = $_GET["followingUserId"];

    $query = $conn->prepare("DELETE FROM `following` WHERE `user_id`=? AND `following_user_id`=?");
    $query->bind_param("ii", $userId, $followingUserId);
    $result = $query->execute();

    $response["result"] = $result;

    echo json_encode($response);

?>