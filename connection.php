<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'myoffer';

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8mb4");
?>