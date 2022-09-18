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

// Check if input email already exists in the database
$query = $conn->prepare("SELECT email FROM users WHERE email=?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();
// If it exists
if(mysqli_num_rows($result)>0) {
    $response = [];
    $response["valid"] = false; 
    echo json_encode($response); 
}
// If it does'nt exist
else {
    $response = [];
    $response["valid"] = true; 
    echo json_encode($response); 
    // Create a new username
    $regex = '/\s/';
    $username = preg_replace($regex, '', $name);
    $usernamePermenant = $username; 
    $username_counter = 1;
    $repeat = true;
    // Check if the username exists in the database, if yes, add a number beside it and keep incrementing it till you reach a unique value
    $query = $conn->prepare("SELECT username FROM users WHERE username=?");
    $query-> bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    while(mysqli_num_rows($result)>0) {
        $username=$usernamePermenant.$username_counter;
        $username_counter++; 
        $query = $conn ->prepare("SELECT username FROM users WHERE username=?");
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();
    }
    
    // Insert all data into the users table in the database
    $query = $conn->prepare("INSERT INTO users(username ,email, name, password, date_of_birth, date_of_registration,bio, location, profile_picture_link,banner_picture_link,website) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("sssssssssss",$username, $email, $name, $password, $birth, $date_of_registration, $bio, $location, $profile_picture_link, $banner_picture_link, $website);
    $query->execute(); 
}
?>