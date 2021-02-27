<?php
require_once "DB/config.php";
session_start();
$action = $_POST["action"] ?? "";
$statusCode = "";

if ("login" == $action) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $query = "SELECT * FROM admin_login WHERE email='{$email}'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $_password = $data["password"];
        if (password_verify($password, $_password)) {
            $_SESSION["id"] = $data["id"];
            $_SESSION["name"] = $data["name"];
            header("location:dashboard.php");
            die();
        };
    }
    header("location:adminLogin.php");
} elseif ("addCatagorie" == $action) {
    $catagorieName = htmlspecialchars(trim($_POST["catagoriesName"]));
    $catagorieDescription = htmlspecialchars($_POST["catagorieDescription"]);

    $sQuery = "SELECT * FROM catagories WHERE catagories_name=\"{$catagorieName}\"";
    $sResult = mysqli_query($connection, $sQuery);

    if (mysqli_num_rows($sResult) < 1) {

        $query = "INSERT INTO catagories (catagories_name , catagories_description) VALUES(\"$catagorieName\" ,\"$catagorieDescription\")";
        $result = mysqli_query($connection, $query);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        } else {
            header("location:catagories.php");
        }
    } else {
        header("location:catagories.php");
    }
} elseif ("Update" == $action) {
    $catagorieName = htmlspecialchars($_POST["catagoriesName"]);
    $catagorieDescription = htmlspecialchars($_POST["catagorieDescription"]);
    $id = htmlspecialchars($_POST["id"]);

    $query = "UPDATE catagories
    SET catagories_name=\"{$catagorieName}\", catagories_description=\"{$catagorieDescription}\" WHERE id={$id}";
    $result = mysqli_query($connection, $query);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    } else {
        header("location:catagories.php");
    }
} elseif ("Delete" == $action) {
    $id = htmlspecialchars($_POST["id"]);
    $query = "DELETE FROM catagories WHERE id=\"{$id}\" ";
    mysqli_query($connection, $query);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    } else {
        header("location:catagories.php");
    }
} elseif ("addNews" == $action) {
    $imagePermit = array("jpg","png","jpeg","gif");
    $newsTitle = $_POST["newsTitle"];
    $newsDescription = $_POST["newsDescription"];
    $newsCatagories = $_POST["newsCatagories"];

    $fileName = $_FILES["newsImage"]["name"];
    $fileTmp = $_FILES["newsImage"]["tmp_name"];
    $fileSize = $_FILES["newsImage"]["size"];

    $divide = explode(".", $fileName);
    $fileExtension = strtolower(end($divide));
    $uniqueName = substr(md5(time()),0,10).'.'.$fileExtension;
    $uploadImage = "Upload/image/$uniqueName";

    if($fileSize > (3000*1024)){
        $statusCode = 7;
    }elseif(in_array($fileExtension,$imagePermit) === false ){
        $statusCode = 8;
    }

    if(!file_exists("Upload/image")){
        mkdir("Upload/image",0777,true);
    };
    if(!move_uploaded_file($fileTmp,$uploadImage)){
        $statusCode = 9;
    };

    header("location:news.php?status={$statusCode}");

};
