<?php


function getStatuscode($statusCode){

    $status = [
        0 => "",
        1 => "<p class=\"text-danger\">Email Id Or UserName is Not Correct </p>",
        2 => "<p class=\"text-danger\">Password is Not Correct </p>",
        7 => "<p class=\"text-danger\">Image Size Must Be Less Then 3MB </p>",
        8 => "<p class=\"text-danger\">You Can Upload Only jpg,jpeg,png,gif </p>",
        9 => "<p class=\"text-danger\">Something Is Wrong </p>", // Maybe Folder Is Not Created Yet
        10 => "<p class=\"text-success\"> News Uploaded Successfully </p>",
        11 => "<p class=\"text-success\"> News Updated Successfully </p>",
        12 => "<p class=\"text-success\"> News Delete Successfully </p>",
        13 => "<p class=\"text-success\"> Catagories Added Successfully </p>",
        14 => "<p class=\"text-success\"> Catagories Updated Successfully </p>",
        15 => "<p class=\"text-success\"> Catagories Delete Successfully </p>",
        16 => "<p class=\"text-success\"> Message Successfully Send </p>",
        17 => "<p class=\"text-danger\"> Failed To Send Message </p>",
        18 => "<p class=\"text-danger\"> Failed To Delete Message </p>",
        19 => "<p class=\"text-success\"> Message Delete Successfully </p>",
    ];

    return $status[$statusCode];

}
