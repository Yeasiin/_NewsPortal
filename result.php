<?php


function getStatuscode($statusCode){

    $status = [
        0 => "",
        1 => "",
        7 => "<p class=\"text-danger\">Image Size Must Be Less Then 3MB </p>",
        8 => "<p class=\"text-danger\">You Can Upload Only jpg,jpeg,png,gif </p>",
        9 => "<p class=\"text-danger\">Something Is Wrong </p>", // Maybe Folder Is Not Created Yet
        10 => "<p class=\"text-success\"> News Uploaded Successfully </p>"
    ];

    return $status[$statusCode];

}
