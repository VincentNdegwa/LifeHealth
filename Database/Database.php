<?php
$servename = "mysql2.serv00.com";
$username = "m5708_Vincent";
$database = "m5708_LifeHealth";
$password = "User007$";

$conn = mysqli_connect($servename, $username, $password, $database);
$message = "";
if (!$conn) {
    $message = mysqli_connect_errno();
    return $conn = null;
}else{
    return $conn;
}
