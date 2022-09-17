<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $tweetId = $_GET["tweetId"];

    $query = $conn->prepare("SELECT count(`user_id`) FROM `likes` WHERE tweet_id=?");
?>