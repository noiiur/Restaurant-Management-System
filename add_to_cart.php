<?php
session_start();
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $offer_id = (int)$_POST['offer_id'];
    $quantity = (int)$_POST['quantity'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $price = (float)$_POST['price'];
    
    // إنشاء سلة المشتريات إذا لم تكن موجودة
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    // إضافة المنتج للسلة
    $_SESSION['cart'][] = [
        'id' => $offer_id,
        'title' => $title,
        'price' => $price,
        'quantity' => $quantity
    ];
    
    header('Location: cart.php');
    exit;
}
?>