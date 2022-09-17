<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];
    $followingUserId = $_GET["followingUserId"];

    $query = $conn->prepare("INSERT INTO `following`(`user_id`, `following_user_id`) VALUES (?, ?)");
    $query->bind_param("ii", $userId, $followingUserId);
    $result = $query->execute();

    $response["result"] = $result;

    echo json_encode($response);

?>