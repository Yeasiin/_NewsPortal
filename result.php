<?php

include "DB/config.php";


$showCatagoriesQuery = "SELECT * FROM catagories";
$showCatagories = mysqli_query($connection, $showCatagoriesQuery);

