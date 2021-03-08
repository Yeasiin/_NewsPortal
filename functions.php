<?php
require_once "DB/config.php";
session_start();
$action = $_POST["action"] ?? "";
$updateAction = $_POST["updateAction"] ?? "";

$statusCode = "";

if ("login" == $action) {
    $email = $_POST["user"];
    $password = $_POST["password"];
    $query = "SELECT * FROM admin_login WHERE email=\"{$email}\" OR name=\"{$email} \"";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $_password = $data["password"];
        if (password_verify($password, $_password)) {
            $_SESSION["id"] = $data["id"];
            $_SESSION["name"] = $data["name"];
            header("location:dashboard.php");
            die();
        } else {
            $statusCode = 2;
        };
    } else {
        $statusCode = 1;
    }
    header("location:adminLogin.php?status={$statusCode}");
} elseif ("addCatagorie" == $action) {
    $catagorieName = htmlspecialchars(trim($_POST["catagoriesName"]));
    $catagorieDescription = htmlspecialchars($_POST["catagorieDescription"]);

    $sQuery = "SELECT * FROM catagories WHERE catagories_name=\"{$catagorieName}\"";
    $sResult = mysqli_query($connection, $sQuery);

    if (mysqli_num_rows($sResult) < 1) {

        $query = "INSERT INTO catagories (catagories_name , catagories_description) VALUES(\"$catagorieName\" ,\"$catagorieDescription\")";
        $result = mysqli_query($connection, $query);
        $statusCode = 13;
        if (mysqli_connect_errno()) {
            $statusCode = 9;
        }
    }
    header("location:catagories.php?status={$statusCode}");
} elseif ("Update" == $action && "catagoriesUpdate" == $updateAction) {
    $catagorieName = htmlspecialchars($_POST["catagoriesName"]);
    $catagorieDescription = htmlspecialchars($_POST["catagorieDescription"]);
    $id = htmlspecialchars($_POST["id"]);

    $query = "UPDATE catagories
    SET catagories_name=\"{$catagorieName}\", catagories_description=\"{$catagorieDescription}\" WHERE id={$id}";
    $result = mysqli_query($connection, $query);
    $statusCode = 14 ;
    if (mysqli_connect_errno()) {
        $statusCode = 9;
    }
    header("location:catagories.php?status={$statusCode}");
} elseif ("Delete" == $action && "catagoriesUpdate" == $updateAction) {
    $id = htmlspecialchars($_POST["id"]);
    $query = "DELETE FROM catagories WHERE id=\"{$id}\" ";
    mysqli_query($connection, $query);
    $statusCode = 15;
    if (mysqli_connect_errno()) {
        $statusCode = 9;
    }
    header("location:catagories.php?status={$statusCode}");
} elseif ("addNews" == $action) {
    $imagePermit = array("jpg", "png", "jpeg", "gif");
    $newsTitle = htmlspecialchars($_POST["newsTitle"]);
    $newsDescription = htmlspecialchars($_POST["newsDescription"]);
    $newsCatagories = htmlspecialchars($_POST["newsCatagories"]);
    $newsCreatedBy = htmlspecialchars($_POST["createdBy"]);

    $fileName = $_FILES["newsImage"]["name"];
    $fileTmp = $_FILES["newsImage"]["tmp_name"];
    $fileSize = $_FILES["newsImage"]["size"];

    $divide = explode(".", $fileName);
    $fileExtension = strtolower(end($divide));
    $uniqueName = substr(md5(time()), 0, 10) . '.' . $fileExtension;
    $uploadImage = "Upload/image/$uniqueName";

    if ($fileSize > (3000 * 1024)) {
        $statusCode = 7;
    } elseif (in_array($fileExtension, $imagePermit) === false) {
        $statusCode = 8;
    }

    if (!file_exists("Upload/image")) {
        mkdir("Upload/image", 0777, true);
    };
    if (!move_uploaded_file($fileTmp, $uploadImage)) {
        $statusCode = 9;
    } else {
        $query = "INSERT INTO news( newsTitle, newsDescription, newsCatagories, newsThumbnail, createdBy ) VALUES(
            \"{$newsTitle}\",
            \"{$newsDescription}\",
            \"{$newsCatagories}\",
            \"{$uploadImage}\",
            \"{$newsCreatedBy}\") ";
        mysqli_query($connection, $query);
        $statusCode = 10;
    };

    if (mysqli_connect_errno()) {
        $statusCode = 9;
    }
    header("location:news.php?status={$statusCode}");
} elseif ("Update" == $action && "newsUpdate" == $updateAction) {
    $newsTitle = htmlspecialchars($_POST["newsTitle"]);
    $newsDescription = htmlspecialchars($_POST["newsDescription"]);
    // $newsCatagories = htmlspecialchars($_POST["newsCatagories"]);
    $newsId = htmlspecialchars($_POST["id"]);

    $query = "UPDATE news SET newsTitle=\"{$newsTitle}\", newsDescription=\"{$newsDescription}\" WHERE id=\"{$newsId}\" ";

    $result = mysqli_query($connection, $query);
    $statusCode = 11;

    if (mysqli_connect_errno()) {
        echo "Failed To Connect to Mysql: " . mysqli_connect_error();
        exit();
    } else {
        header("location: news.php?status={$statusCode}");
    }
} elseif ("Delete" == $action && "newsUpdate" == $updateAction) {
    $newsId = htmlspecialchars($_POST["id"]);
    $query = "DELETE FROM news WHERE id=\"{$newsId}\" ";
    mysqli_query($connection, $query);
    if (mysqli_connect_errno()) {
        $statusCode = 9;
    } else {
        $statusCode = 12;
    }
    header("location:news.php?status={$statusCode}");
}elseif("messages" == $action  ){
    $name = htmlspecialchars($_POST["fullName"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["contactMessage"]);

    $query = "INSERT INTO message( name, email, message) VALUES ( \"{$name}\", \"{$email}\", \"{$message}\") ";
    $result = mysqli_query($connection, $query);

    if(mysqli_connect_errno()){
        $statusCode = 17;
    }else{
        $statusCode = 16;

    }
    header("location: contact.php?status={$statusCode}");
};
