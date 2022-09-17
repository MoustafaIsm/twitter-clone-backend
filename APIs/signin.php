<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');

include("connection.php"); 

$email = $_POST["email"];
$password = hash("sha256",$_POST["password"]);
$response = [];

$query = $mysqli->prepare("SELECT email FROM users WHERE email=?");
$query-> bind_param("s", $email);
$query->execute();
$result = $query->get_result();
if(mysqli_num_rows($result)==0) {
    $response["email"] = false;  
}
else {
    
    $query = $mysqli->prepare("SELECT email, password FROM users WHERE email=? AND password=?");
    $query-> bind_param("ss", $email, $password);
    $query->execute();
    $result = $query->get_result();
    if(mysqli_num_rows($result)>0) {
        $query = $mysqli->prepare("SELECT * FROM users WHERE email=? AND password=?");
        $query-> bind_param("ss", $email, $password);
        $query->execute();
        $result = $query->get_result(); 
        
        while($a = $result->fetch_assoc()){
            $response[] = $a;
        }
    }
    else {
        $response["email"] = true;
        $response["password"] = false;
    }
}

$json = json_encode($response);
echo $json; 
?>