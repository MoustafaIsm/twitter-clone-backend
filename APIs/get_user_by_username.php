<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $username = $_GET["username"];
    $username = "%" . $username ."%";

    $query = $conn->prepare("SELECT * FROM `users` WHERE `username` LIKE ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    $response = [];

    while($row = $result->fetch_assoc()) {
        $response["searchResults"][] = $row;
    }

    echo json_encode($response);
?>