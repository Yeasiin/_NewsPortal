<?php
require_once "DB/config.php";
session_start();
$action = $_POST["action"] ?? "";

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
    }else{
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
};
