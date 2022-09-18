<?php
	header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];
    $userBlockedId = $_GET["blockedUserId"];

    $query = $conn->prepare("DELETE FROM `blocked` WHERE `user_id`=? AND `blocked_user_id`=?");
    $query->bind_param("ii", $userId, $userBlockedId);
    $result = $query->execute();

    $response["result"] = $result;

    echo json_encode($response);

?>