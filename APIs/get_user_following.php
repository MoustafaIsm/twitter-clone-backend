<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];

    $query = $conn->prepare("SELECT `u`.`id`, `u`.`username`, `u`.`name`, `u`.`profile_picture_link`
    FROM `following` AS f, `users` AS u
    WHERE `f`.`following_user_id`=`u`.`id`AND `f`.`user_id`=?");
    
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();

    $response = [];

    while($row = $result->fetch_assoc()) {
        $response["following"][] = $row;
    }

    $response["count"] = mysqli_num_rows($result);

    echo json_encode($response);
?>