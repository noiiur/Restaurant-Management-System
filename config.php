<?php
$con = mysqli_connect("localhost", "root", "", "myoffer");

if (!$con) {
    header('Content-Type: application/json');
    die(json_encode([
        'status' => 'error',
        'message' => 'فشل الاتصال بقاعدة البيانات: ' . mysqli_connect_error()
    ]));
}

mysqli_set_charset($con, "utf8mb4");
?>