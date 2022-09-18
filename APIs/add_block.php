<?php
	header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];
    $blockedUserId = $_GET["blockId"];

    $query = $conn->prepare("INSERT INTO `blocked`(`user_id`, `blocked_user_id`) VALUES (?, ?)");
    $query->bind_param("ii", $userId, $blockedUserId);
    $result = $query->execute();

    $query1 = $conn->prepare("DELETE FROM `following` WHERE `user_id`=? AND `following_user_id`=?");
    $query1->bind_param("ii", $userId, $blockedUserId);
    $result1 = $query1->execute();

    $response["result"] = $result;

    echo json_encode($response);
?>