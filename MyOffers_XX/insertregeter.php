<?php
require_once 'config.php';

// جلب البيانات من النموذج
$firstName = mysqli_real_escape_string($con, $_POST['firstName']);
$lastName = mysqli_real_escape_string($con, $_POST['lastName']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$address = mysqli_real_escape_string($con, $_POST['address']);
$mobile = mysqli_real_escape_string($con, $_POST['mobile']);

// تحقق من اتصال قاعدة البيانات
if (!$con) {
    die("<script>alert('فشل الاتصال بقاعدة البيانات')</script>");
}

// استعلام SQL معدل
$query = "INSERT INTO `user` (`firstName`, `lastName`, `email`, `password`, `address`, `mobile`) 
          VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($con, $query);

// تحقق من نجاح التحضير
if ($stmt === false) {
    die("<script>alert('خطأ في إعداد الاستعلام: " . mysqli_error($con) . "')</script>");
}

// الربط مع المعلمات
$bind_result = mysqli_stmt_bind_param($stmt, "ssssss", 
    $firstName, 
    $lastName, 
    $email, 
    $password, 
    $address, 
    $mobile);

if (!$bind_result) {
    die("<script>alert('خطأ في ربط المعاملات')</script>");
}

// التنفيذ
$execute_result = mysqli_stmt_execute($stmt);

if ($execute_result) {
    echo "<script>
            alert('تم تسجيل البيانات بنجاح');
            window.location.href = 'MyOffersRegester.html';
          </script>";
} else {
    echo "<script>alert('خطأ في التسجيل: " . mysqli_stmt_error($stmt) . "')</script>";
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>