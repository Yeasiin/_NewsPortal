<?php
session_start();
include_once "result.php";
$session = $_SESSION["id"] ?? "";
if($session){
    header("location: dashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://cdn.sstatic.net/Sites/stackoverflow/Img/apple-touch-icon.png?v=c78bd457575a" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.min.css">

    <title>Login</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 ">
                <div class="vh-100 d-flex align-items-center ">
                    <form class="admin__form w-100" action="functions.php" method="POST">
                        <h3 class="text-center ">Admin Login</h3>
                        <div class="form-group">
                        <?php 
                            $statusCode = $_GET["status"] ?? "";
                            if($statusCode){
                                echo getStatuscode($statusCode);
                            }

                        ?>
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" name="password" id="pwd">
                        </div>
                        <input type="hidden" name="action" value="login">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </form>

                </div>
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>