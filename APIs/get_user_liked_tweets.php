<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];

    $query = $conn->prepare("SELECT `u`.`username`, `u`.`name`, `u`.`profile_picture_link`, `t`.`id` AS `twee_id`,`t`.`tweet_text`, `t`.`tweet_image_link`, `t`.`date_time_of_creation`
FROM `likes` AS l, `tweets` AS t, `users` AS u
WHERE `l`.`tweet_id`=`t`.`id` AND `u`.`id`=`t`.`user_id` AND `l`.`user_id`=?");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();

    $response = [];

    while($row = $result->fetch_assoc()) {
        $response["liked"][] = $row;
    }

    echo json_encode($response);
?>