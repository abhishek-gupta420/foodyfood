<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "foodyfood";

$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
    echo 'failed';
    die("Error" . mysqli_connect_error());
}


