<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $tweetId = $_GET["tweetId"];

    $query = $conn->prepare("SELECT count(`user_id`) FROM `likes` WHERE tweet_id=?");
    $query->bind_param("i", $tweetId);
    $query->execute();

    $result = $query->get_result();

    $response = [];
    $response["likes_count"] = $result->fetch_assoc()["count(`user_id`)"];

    echo json_encode($response);

?>