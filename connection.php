<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'weather_db';

$connection = mysqli_connect($host, $username, $password, $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
