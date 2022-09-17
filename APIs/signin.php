<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');

include("connection.php"); 

$email = $_POST["email"];
$password = hash("sha256",$_POST["password"]);

$query = $mysqli->prepare("SELECT email, password FROM users WHERE email=? AND password=?");
$query-> bind_param("ss", $email, $password);
$query->execute();
$result = $query->get_result();
?>