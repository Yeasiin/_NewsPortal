<?php
    require_once "DB/config.php";

if(isset($_POST["adminLogin"])){

    $email = $_POST["email"];
    $password = $_POST["password"];
    $query = "SELECT * FROM admin_login WHERE email='{$email}'";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0 ){
        $data = mysqli_fetch_assoc($result);
        $_password = $data["password"];
        if(password_verify($password, $_password)){
            header("location:home.php");
            die();
        }else{
            
        };
    }else{
        header("location:adminLogin.php");
    };



    
};