<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_GET["userId"];

    $query = $conn->prepare("SELECT `u`.`username`, `u`.`name` FROM `users` AS u, `blocked` AS b WHERE `u`.`id`=`b`.`blocked_user_id` AND `b`.`user_id`=?");
    
>?