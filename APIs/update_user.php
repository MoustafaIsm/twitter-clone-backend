<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500 ");

    include("./connection.php");

    $userId = $_POST["userId"];
    $name = $_POST["name"];
    $bio = $_POST["bio"];
    $location = $_POST["location"];
    if (isset($_POST["profilePicture"]))
        $profilePicture = $_POST["profilePicture"];
    if (isset($_POST["bannerPicture"]))
        $bannerPicture = $_POST["bannerPicture"];
    $website = $_POST["website"];

    if (isset($_POST["profilePicture"]) && !isset($_POST["bannerPicture"])) {
        $profilePicture = convertBackToImage($profilePicture, $userId, "profile");

        $query = $conn->prepare("UPDATE `users` SET `name`=?,`bio`=?,`location`=?,`profile_picture_link`=?,`website`=? WHERE `id`=?");
        $query->bind_param("sssssi", $name, $bio, $location, $profilePicture, $website, $userId);

    } elseif (!isset($_POST["profilePicture"]) && isset($_POST["bannerPicture"])) {
        $bannerPicture = convertBackToImage($bannerPicture, $userId, "banner");

        $query = $conn->prepare("UPDATE `users` SET `name`=?,`bio`=?,`location`=?,`banner_picture_link`=?,`website`=? WHERE `id`=?");
        $query->bind_param("sssssi", $name, $bio, $location, $bannerPicture, $website, $userId);

    } elseif (isset($_POST["profilePicture"]) && isset($_POST["bannerPicture"])) {
        $profilePicture = convertBackToImage($profilePicture, $userId, "profile");
        $bannerPicture = convertBackToImage($bannerPicture, $userId, "banner");

        $query = $conn->prepare("UPDATE `users` SET `name`=?,`bio`=?,`location`=?,`profile_picture_link`=?,`banner_picture_link`=?,`website`=? WHERE `id`=?");
        $query->bind_param("ssssssi", $name, $bio, $location, $profilePicture, $bannerPicture, $website, $userId);

    } else {
        $query = $conn->prepare("UPDATE `users` SET `name`=?,`bio`=?,`location`=?,`website`=? WHERE `id`=?");
        $query->bind_param("ssssi", $name, $bio, $location, $website, $userId);
    }

    $result = $query->execute();

    $response["result"] = $result;

    echo json_encode($response);

    function convertBackToImage($base64Image, $user, $type) {
        // PHP permission and to create the directory if it doesnt exist
        $dir = $_SERVER['DOCUMENT_ROOT'] . "/SEF/twitter-clone-data/images/". $type . "/" . $user;
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