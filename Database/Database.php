<?php
$servename = "localhost";
$username = "vincent";
$database = "LifeHealth";
$password = "Vincent07$";


$conn = mysqli_connect($servename, $username, $password, $database);
$message = "";
if (!$conn) {
    $message = mysqli_connect_errno();
    return $conn = null;
}else{
    return $conn;
}
