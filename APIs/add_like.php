<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];
    $tweetId = $_GET["tweetId"];

    $query = $conn->prepare("INSERT INTO `likes`(`user_id`, `tweet_id`) VALUES (?, ?)");
    $query->bind_param("ii", $userId, $tweetId);
    $result = $query->execute();

    $response["result"] = $result;

    echo json_encode($response);

?>