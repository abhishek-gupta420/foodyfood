<?php

$server = "localhost";
$username = "root";
$password = "";
$db = "foodshala";

$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
    echo 'failed';
    die("Error" . mysqli_connect_error());
}


