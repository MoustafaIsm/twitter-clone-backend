<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');

include("connection.php"); 

$name = $_POST["name"];
$email = $_POST["email"];
$month = $_POST["month"];
$day = $_POST["day"];
$year = $_POST["year"];
$password = hash("sha256",$_POST["password"]);
$date = $month." ".$day." ".$year;
$birth = date('Y-m-d', strtotime($date));
$date_of_registration = date('Y-m-d');
$bio = "NA";
$location = "NA";
$profile_picture_link = "NA";
$banner_picture_link = "NA";
$website = "NA";

$query = $mysqli->prepare("INSERT INTO users(email, name, password, date_of_birth, date_of_registration,bio, location, profile_picture_link,banner_picture_link,website) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$query->bind_param("ssssssssss", $email, $name, $password, $birth, $date_of_registration, $bio, $location, $profile_picture_link, $banner_picture_link, $website);
$query->execute();

$response = [];
$response["success"] = true;

echo json_encode($response);
?>