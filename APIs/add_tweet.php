<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $tweetText = $_POST["tweetText"];
    $tweetImageText = $_POST["tweetImageText"];
    $dateOfCreation = $_POST["dateOfCreation"];
    $userId = $_POST["userId"];

    if ($tweetImageText != "NA") {
        $tweetImageText = convertBackToImage($tweetImageText, $userId);
    }

    $query = $conn->prepare('INSERT INTO `tweets`(`tweet_text`, `tweet_image_link`, `date_time_of_creation`, `user_id`) VALUES (?, ?, ?, ?)');
    $query->bind_param("ssss", $tweetText, $tweetImageText, $dateOfCreation, $userId);
    $result = $query->execute();

    $response["result"] = $result;

    echo json_encode($response);


    function convertBackToImage($base64Image, $user) {
        // PHP permission and to create the directory if it doesnt exist
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/SEF/twitter-clone-data/tweets/" . $user;
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        // Explode the original string

        // $base64String is the base64 image without any extra stuff
        $base64String = getBase64String($base64Image);
        // $imageExtention is the original extendtion of the image
        $imageExtention = getImageExtention($base64Image);
        
        // The path to save the image in
        $imageName = $dir . "/" . uniqid('') . "." . $imageExtention;

        // $data is the Data of the image after decoding
        $data = base64_decode($base64String);

        // Bind the decoded data to an image
        $success = file_put_contents($imageName, $data);
        return $imageName;
    }
    
    function getBase64String($image) {
        return explode(",", $image)[1];
    }

    function getImageExtention($image) {
        $extra1 = explode(",", $image)[0];
        $extra2 = explode(";", $extra1)[0];
        return explode("/", $extra2)[1];
    }
?>