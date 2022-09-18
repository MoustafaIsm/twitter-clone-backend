<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];

    $query = $conn->prepare("SELECT u.`id`, `u`.`username`, `u`.`name`, `u`.`profile_picture_link`, `t`.`id` AS `tweet_id`,`t`.`tweet_text`, `t`.`tweet_image_link`, `t`.`date_time_of_creation`  
    FROM `following` AS f, `tweets` AS t, `users` AS u
    WHERE `f`.`following_user_id` = `t`.`user_id` AND `f`.`following_user_id`= `u`.`id`  AND `f`.`user_id`=?
    ORDER BY `t`.`date_time_of_creation` DESC LIMIT 30");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();

    $response = [];

    while($row = $result->fetch_assoc()) {
        $response["feeds"][] = $row;
    }

    echo json_encode($response);
?>