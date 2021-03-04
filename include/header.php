<?php
require_once "DB/config.php";
include_once "result.php";
session_start();
$session = $_SESSION["id"] ?? "";
if (!$session) {
  header("location:adminLogin.php");
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="https://s2.logaster.com/static/v3/favicons/manifest/favicon.ico" type="image/x-icon">

  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.min.css">
</head>

