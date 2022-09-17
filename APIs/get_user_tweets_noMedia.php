<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];

    $query = $conn->prepare("SELECT `tweet_text`, `date_time_of_creation` FROM `tweets` WHERE `user_id`=? AND `tweet_image_link`= 'NA'");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();

    $response = [];

    while($row = $result->fetch_assoc()) {
        $response["tweets"][] = $row;
    }

    echo json_encode($response);

?>