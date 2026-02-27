<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cart']) || !isset($_POST['id'])) {
    echo json_encode(['success' => false]);
    exit;
}

$id = $_POST['id'];

if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>