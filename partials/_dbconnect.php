<?php
$server = "127.0.0.1:3325";
$username = "root";
$password = "";
$database = "users";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

?>

 <!-- kannu.hanishsingla.com/hotel-management/login.php -->