<?php


function getStatuscode($statusCode){

    $status = [
        0 => "",
        1 => "",
        7 => "Image Size Must Be Less Then 3MB",
        8 => "You Can Upload Only jpg,jpeg,png,gif ",
        9 => "Something Is Wrong", // Maybe Folder Is Not Created Yet
    ];

    return $status[$statusCode];

}