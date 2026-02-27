<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cart']) || !isset($_POST['id']) || !isset($_POST['quantity'])) {
    echo json_encode(['success' => false]);
    exit;
}

$id = $_POST['id'];
$quantity = (int)$_POST['quantity'];

if (isset($_SESSION['cart'][$id]) {
    $_SESSION['cart'][$id]['quantity'] = max(1, $quantity);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>